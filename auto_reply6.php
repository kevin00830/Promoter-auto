<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//BUG IS IN LINE 205... LOOK THAT UP.

//BEFORE WE MOVE ANY FURTHER I WANT THE FULL LOGIC, STEP BY STEP OF THIS FILE DESCRIBED BELOW
//I AM ADDING NUMERIC COMMENTS SO ITS EASIER TO VIEW AND UNDERSTAND
// 1 Create db connection
// 2 Get POST data and save it to a file
// 3 If the message is from me, exit - It´s to ignore the message we SEND
// 4 Get data from the POST body - I think this is to read the json body, right?
// 5 Create a subscriber if not exists
// 6 Check SUBSCRIBERS STATE
// 7 Auto trigger bot for new conversations last 12 hours
// 8 update subscriber STATE
// 9 Match keyword with reply. CORE of the code. Controls auto triggering of next flow, answer to keywors typed, etc.

// we need to add a lot of descriptions for 9
// This part checks the conditional reply and decide the answer of the bot

// 10 Functions - very clear the use of each, although I think 2 or 3 may be not in use

//// 1st function: Decide the response data according to the url
//// 2nd function: Check if the phone number already exists in the table
//// 3rd function: Update the state of subscribers with number
//// 4th function: Retrieve the state of a subscriber from a db using number
//// 5th function: Retrieve the name of a subscriber from a db using number
//// 6th function: Sending typing status of a WhatsApp chat message to a server using cURL
//// 7th function: Sending a WhatsApp chat message to users asking for their name and enabling the typing status indicator while waiting for their response.
//// 8th function: Sending a WhatsApp chat message to a user using cURL
//// 9th function: Sending a media via the WhatsApp messaging service using the 321dbase API
//// 10th function: Automate message flows in response to specific keywords
//// 11th function: Updates a specific column in the table of a database, for a particular subscriber identified by their number
//// 12th function: Check if updated 12 hours ago
//// 13th function: Create or Update the record in the 'records' table of the database
//// 14th function: Retrieve a record from a database table named "records" based on the number
//// 15th function: Sends user data to an API endpoint




//////////////// 1 Create connection
$conn = mysqli_connect('127.0.0.1', 'dbase_auto','b4K.k$b^f^7e', 'dbase_auto');
mysqli_set_charset($conn, "utf8mb4");


//////////////// 2 Get POST data and save it to a file
// we receive the post from the wapi.js API , a node.js api we have installed at this server
// as I told you, its 3rd part, we only use it through POST/json
// https://documenter.getpostman.com/view/8125887/TzCV44wt#505a9990-df32-41ff-a5e6-8327a621e814
// the testfile.txt is just a test file, we dont use its data, but maybe it is helpfull for who is developing it
//


$post = json_decode(file_get_contents("php://input"));
file_put_contents("testfile.txt", file_get_contents("php://input"));


//////////////// 3 If the message is from me, exit - It´s to ignore the message we SEND
if ($post->msg->fromMe) {
    echo "";
    exit();
}



//////////////// 4  Get data from the POST body - I think this is to read the json body, right?
$instance = $post->instancia;
$number = $post->msg->sender->id;
$expnum = explode('@', $number)[0];
$groupmsg = $post->msg->isGroupMsg;
$keyword = $post->msg->body;
$groupid = explode("_", $instance)[0];


//////////////// 5 Create a subscriber if not exists
// create subscriber at subscriber table using cell phone number from the json above
// I dont know what $conn is ???????????
// $conn is for ...

create_subsriber($conn, $number, "null");



//////////////// 6 Check SUBSCRIBERS STATE
// subscribers = person talking to the bot
// state is saved to subscribers table and its used to STOP the bot to listen the subscriber reply to a Question
// it is what we call USER INPUT DATA and we have 2 types
// system fields : basically profile data (name, company), which we save to our main subscribers table, forever. Those are data used by all types of business (customer profile)
// we also call system fields as ASKs below
// generic fields (generic user input data) = fieldnames create at frontend by our customers for specific type of information
// generic fields are specific information of a type of business, for example, a pet shop will ask dog name, age, breed, etc, and this data is saved to table GENERIC INPUT.
// usually this data will be sent to external systems using Zapier and removed from our DB every 6 months
//////////////// so we check and change subscribers state to make the bot stop/restart

$user_state = get_subscriber_state($conn, $number);

$record = get_record_by_number($conn, $number);
if(!$record) {
    create_or_update_record($conn, $number, NULL, 0, NULL, NULL, $groupid, NULL);

    $record = get_record_by_number($conn, $number);
}


//////////////// 7 auto trigger bot for new conversations last 12 hours
// always start by auto triggering step of the flow related to  keyword WAKE
// this part is when I start to think logic is not nice and I get confused too


$is_12_hour_ago = was_updated_more_than_12_hours_ago($conn, $number);

if($is_12_hour_ago) {
    $keyword = 'WAKE';
    update_subscriber_state($conn, $number, "");
}

//////////////////// based on subscriber state, we will get the user reply <=== but this is buged
//////////////////// and save it to specific field


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////// 9  Match keyword with reply (message to be sent)
// THIS IS THE CORE OF THE CODE
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

$sql_key = "SELECT * from flows where keywords = '$keyword' AND group_id = '$groupid'";
$result_key = mysqli_query($conn, $sql_key);
$row_key = mysqli_fetch_assoc($result_key);

// Query to check for tmp_type 1
// tmp_type 1 is Generic Template (step with txt, image or video to send to user)
// 500 is zapier and 1000 is conditional reply, those are some specials STEPS in the flow

// $tmp_type_check_1 = "SELECT * FROM flows WHERE tmp_type = 1 AND keywords = '$keyword' AND group_id = '$groupid'";

// Query to check for tmp_type 500
$tmp_type_check_500 = "SELECT * FROM flows WHERE tmp_type = 500 AND keywords = '$keyword' AND group_id = '$groupid'";
$result_tmp_type_check_500 = mysqli_query($conn, $tmp_type_check_500);
$row_tmp_type_check_500 = mysqli_fetch_assoc($result_tmp_type_check_500);

// Query to check for tmp_type 1000
$tmp_type_check_1000 = "SELECT * FROM flows WHERE tmp_type = 1000 AND keywords = '$keyword' AND group_id = '$groupid'";
$result_tmp_type_check_1000 = mysqli_query($conn, $tmp_type_check_1000);
$row_tmp_type_check_1000 = mysqli_fetch_assoc($result_tmp_type_check_1000);


//////////////// 8 update subscriber STATE based on the question was sent to him (system or generic input fields)
// my curiosity (as not a coder) is how from this part of the code we "jump" to the ___ below

if($user_state && $user_state != "null" &&  $user_state != NULL) {
    switch ($user_state) {
        case "waiting-for-name":
            update_subscriber_state($conn, $number, "");
            update_subscriber_column($conn, "name", $keyword, $number);
            sendUserData($number, ['name' => $keyword]);
            break;
        case "waiting-for-dob_day":
            update_subscriber_state($conn, $number, "");
            update_subscriber_column($conn, "dob", $keyword, $number);
            sendUserData($number, ['dob' => $keyword]);
            break;
        case "waiting-for-company":
            update_subscriber_state($conn, $number, "");
            update_subscriber_column($conn, "company", $keyword, $number);
            sendUserData($number, ['company' => $keyword]);
            break;
        case "waiting-for-street":
            update_subscriber_state($conn, $number, "");
            update_subscriber_column($conn, "street", $keyword, $number);
            sendUserData($number, ['street' => $keyword]);
            break;
        case "waiting-for-number":
            update_subscriber_state($conn, $number, "");
            update_subscriber_column($conn, "number2", $keyword, $number);
            sendUserData($number, ['number' => $keyword]);
            break;
        case "waiting-for-compl":
            update_subscriber_state($conn, $number, "");
            update_subscriber_column($conn, "complement", $keyword, $number);
            sendUserData($number, ['complement' => $keyword]);
            break;
        case "waiting-for-district":
            update_subscriber_state($conn, $number, "");
            update_subscriber_column($conn, "district", $keyword, $number);
            sendUserData($number, ['district' => $keyword]);
            break;
        case "waiting-for-zipcode":
            update_subscriber_state($conn, $number, "");
            update_subscriber_column($conn, "zipcode", $keyword, $number);
            sendUserData($number, ['zipcode' => $keyword]);
            break;
        case "waiting-for-city":
            update_subscriber_state($conn, $number, "");
            update_subscriber_column($conn, "city", $keyword, $number);
            sendUserData($number, ['city' => $keyword]);
            break;
        case "waiting-for-email":
            update_subscriber_state($conn, $number, "");
            update_subscriber_column($conn, "email", $keyword, $number);
            sendUserData($number, ['email' => $keyword]);
            break;
        case "waiting-for-generic":
            update_subscriber_state($conn, $number, "");
            update_generic_state($conn, $number, $groupid, $keyword);

            break;
    }

    // get last flow id from records table
    $last_flow_id = "SELECT * FROM records WHERE number = '$number' AND group_id = '$groupid'"; // get last flow_id from records table
    $result_last_flow_id = mysqli_query($conn, $last_flow_id);
    $row_last_flow_id = mysqli_fetch_assoc($result_last_flow_id);
    $last_flow_id_get = $row_last_flow_id['next_flow'];
    $last_flow_type = $row_last_flow_id['tmp_type'];

    $test = "SELECT * FROM flows WHERE group_id = '$groupid' AND flow_id = $last_flow_id_get";
    $result_test = mysqli_query($conn, $test);
    $row_test = mysqli_fetch_assoc($result_test);

    if($row_test['tmp_type'] == 1000) {

        switch($row_test['cond_opt']) {
            case 2:
                if($row_test['reply'] == $keyword) {
                    $first_flow_id = $row_test['cond_true'];
                } else {
                    $first_flow_id = $row_test['cond_false'];
                }
                break;
            case 1:
                if($keyword >= $row_test['reply']) {
                    $first_flow_id = $row_test['cond_true'];
                } else {
                    $first_flow_id = $row_test['cond_false'];
                }
                break;
            case 3:
                if($keyword <= $row_test['reply']) {
                    $first_flow_id = $row_test['cond_true'];
                } else {
                    $first_flow_id = $row_test['cond_false'];
                }
                break;
        }


    } else {
        $first_flow_id = $last_flow_id_get;
    }

    $can_recall =  true;
} else {

    //////////// explain below, it was.. // Match keyword with reply (message to be sent)

    ////// If initial state select the flow where the keyword is WAKE
    if(!$row_key) {
        $sql_key = "SELECT * from flows where keywords = 'WAKE'";
        $result_key = mysqli_query($conn, $sql_key);
        $row_key = mysqli_fetch_assoc($result_key);
    }



    //////////// this keyword unique is just complicating the code

    if (mysqli_num_rows($result_key) == 1) { // If keyword is unique

        $can_recall =  true;
        $first_flow_id = $row_key['flow_id'];


        /////////// Below, we are finding correct child flow_id for NON unique cases

    } else if(mysqli_num_rows($result_key) > 1) { //If keyword id not unique

        $last_flow_id = "SELECT flow_id FROM records WHERE number = '$number' AND group_id = '$groupid'"; // get last flow_id from records table
        $result_last_flow_id = mysqli_query($conn, $last_flow_id);
        $row_last_flow_id = mysqli_fetch_assoc($result_last_flow_id);
        $last_flow_id_get = $row_last_flow_id['flow_id'];

        $next_flow_id = "SELECT child_flow_id FROM menu_connections WHERE menu_flow_id = '$last_flow_id_get' AND group_id = '$groupid' AND keywords = '$keyword'";
        $result_next_flow_id = mysqli_query($conn, $next_flow_id);
        $row_next_flow_id = mysqli_fetch_assoc($result_next_flow_id);
        $next_flow_id_get = $row_next_flow_id['child_flow_id'];

        $sql2 = "SELECT * from flows where keywords = '$keyword' AND group_id = '$groupid' AND flow_id = '$next_flow_id_get'";
        $flow_result = mysqli_query($conn, $sql2);
        $row_flow_result = mysqli_fetch_assoc($flow_result);

        $can_recall =  true;
        $first_flow_id = $row_flow_result['flow_id'];

    }
}



///////////////// explain below

if(!$row_tmp_type_check_500) { // Check if block is MENU

    if(!$row_tmp_type_check_1000) { // Check if block is Conditional Reply

        while($can_recall) {

            $sql = "SELECT * from flows where group_id = '$groupid' AND flow_id = '$first_flow_id'";

            $result = mysqli_query($conn, $sql);

            if ($row = mysqli_fetch_assoc($result)) {

                $reply = $row['reply'];
                $image = $row['image_link'];
                $tmp_type = $row['tmp_type'];
                $auto_flow = $row['auto_flow'];
                $next = $row['next'];
                $delay = $row['delay'];
                $fieldname = $row['fieldname'];


//////////////////////// If the tmp_type OF ASKs...

                if ($tmp_type == 3) {
                    update_subscriber_state($conn, $number, "waiting-for-name", $conn);
                    $can_recall = false;
                } else if ($tmp_type == 4) {
                    update_subscriber_state($conn, $number, "waiting-for-dob_day", $conn);
                    $can_recall = false;
                } else if ($tmp_type == 5) {
                    update_subscriber_state($conn, $number, "waiting-for-company", $conn);
                    $can_recall = false;
                } else if($tmp_type == 6) {
                    update_subscriber_state($conn, $number, "waiting-for-email", $conn);
                    $can_recall = false;
                } else if ($tmp_type == 7) {
                    update_subscriber_state($conn, $number, "waiting-for-street", $conn);
                    $can_recall = false;
                } else if ($tmp_type == 8) {
                    update_subscriber_state($conn, $number, "waiting-for-number", $conn);
                    $can_recall = false;
                } else if ($tmp_type == 9) {
                    update_subscriber_state($conn, $number, "waiting-for-compl", $conn);
                    $can_recall = false;
                } else if ($tmp_type == 10) {
                    update_subscriber_state($conn, $number, "waiting-for-district", $conn);
                    $can_recall = false;
                } else if ($tmp_type == 11) {
                    update_subscriber_state($conn, $number, "waiting-for-zipcode", $conn);
                    $can_recall = false;
                } else if ($tmp_type == 12) {
                    update_subscriber_state($conn, $number, "waiting-for-city", $conn);
                    $can_recall = false;
                } else if ($tmp_type == 13) {
                    update_subscriber_state($conn, $number, "waiting-for-state", $conn);
                    $can_recall = false;
                } else if ($tmp_type == 14) {
                    update_subscriber_state($conn, $number, "waiting-for-country", $conn);
                    $can_recall = false;

                    /////////////  if type is GENERIC USER INPUT
                } else if ($tmp_type == 100) {
                    update_subscriber_state($conn, $number, "waiting-for-generic", $conn);
                    create_generic_state($conn, $number, $groupid, $fieldname);
                    $can_recall = false;


/////////////  if type is ZAPIER
                } else if ($tmp_type == 200) {

                    if($url && $reply) {

                        $feedback = callZapierApi($url, $reply);
                        $feedback = json_encode($feedback);

                        create_integration_reply($conn, $number, $groupid,$tid,$feedback);

                    }

                    $can_recall = false;

                }

                if ($image) {
                    send_media($instance, $number, $image, $reply, $conn, $delay);
                } else {
                    send_message($instance, $number, $reply, $conn, $delay);
                }

////////////// below we are updating records table after check

                create_or_update_record($conn, $number, 'server_action1', $tmp_type, '', $auto_flow, $groupid, $row['flow_id']);
                if($next) {

                    $next_flow_id = "SELECT * FROM records WHERE number = '$number' AND group_id = '$groupid'"; // get last flow_id from records table
                    $result_next_flow_id = mysqli_query($conn, $next_flow_id);

                    if($row_next_flow_id = mysqli_fetch_assoc($result_next_flow_id)) {

                        $first_flow_id =  $row_next_flow_id['next_flow'];

                    } else {
                        $can_recall = false;
                    }

                } else {
                    $can_recall = false;
                }

            } else {

                $can_recall = false;
            }

        }
    }

}



//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////////////////// 10 Functions

//////// 1st Function
//////// Decide the response data according to the url

function callZapierApi($url, $body) {
    // Initialize a new cURL resource.
    $ch = curl_init();

    // Set the required HTTP headers for the request.
    $headers = array('Content-Type: application/json');

    // Set the options for the cURL resource.
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyJson);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the cURL request and save the response.
    $response = curl_exec($ch);

    // Check for errors in the cURL request.
    if ($response === false) {
        $info = curl_getinfo($ch);
        curl_close($ch);

        die('Error occurred: ' . var_export($info));
    }

    // Close the cURL resource.
    curl_close($ch);

    // Decode the response.
    $responseData = json_decode($response, true);

    // Return the response data.
    return $responseData;
}

////// 2nd Function
////// Check if the phone number already exists in the table

function create_subsriber($conn, $number, $initial_state = "null")
{
    // Check if the user already exists in the database
    $sql = "SELECT * FROM subscribers WHERE number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // User does not exist, insert them into the database
        $sql = "INSERT INTO subscribers (number, state) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $number, $initial_state);
        $stmt->execute();
    }

    $stmt->close();
}

////// 3rd Function
////// Update the state of subscribers with umber

function update_subscriber_state($conn, $number, $new_state)
{
    $sql = "UPDATE subscribers SET state = ? WHERE number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $new_state, $number);
    $stmt->execute();
    $stmt->close();
}


///////////////////////////////////////////////////////////////////////////
function create_generic_state($conn, $number, $groupid, $fieldname)
{
    // User does not exist, insert them into the database
    $answer = "waiting";
    $transaction_id = 1;


    $sql = "SELECT * FROM generic_input WHERE number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $data = $result->fetch_assoc();
        $transaction_id =  $data['transaction_id'] + 1;

    }

    $sql = "INSERT INTO generic_input (group_id,fieldname,content,transaction_id,number) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issis", $groupid, $fieldname,$answer,$transaction_id,$number);
    $stmt->execute();

    $stmt->close();
}

function update_generic_state($conn, $number, $groupid, $answer)
{

    $sql = "UPDATE generic_input SET content = ? WHERE number = ? AND content = 'waiting' AND group_id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sii", $answer, $number, $groupid);
    $stmt->execute();
    $stmt->close();
}

///////////////////////////////////////////////////////////////////////////////////////





////// 4th Function
////// Retrieve the state of a subscriber from a db using number

function get_subscriber_state($conn, $number)
{
    $sql = "SELECT state FROM subscribers WHERE number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $number);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        return $user['state'];
    } else {
        return NULL;
    }
}

////// 5th Function
////// Retrieve the name of a subscriber from a db using number

function get_subscriber_name($conn, $number)
{
    $sql = "SELECT name FROM subscribers WHERE number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $number);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        return $user['name'];
    } else {
        return NULL;
    }
}

////// 6th Function
////// Sending typing status of a WhatsApp chat message to a server using cURL

function typeMessage($instance, $number, $state)
{
    $ch = curl_init();

    // Set the JSON payload
    $payload = json_encode(array(
        'instancia' => $instance,
        'number' => $number,
        'digitando' => $state
    ));

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, "https://app.321dbase.com/wp/setupInfoDigitando");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the cURL request
    $server_output = curl_exec($ch);

    // Check for possible cURL errors
    if (curl_errno($ch)) {
        // Handle the error
        echo 'cURL error: ' . curl_error($ch);
    } else {
        // Process the server output (if necessary)
    }

    // Close the cURL session
    curl_close($ch);
}

////// 8th Function
////// Sending a WhatsApp chat message to a user using cURL


function send_message($instance, $number, $reply, $conn = null, $delay = 3)
{

    if($conn != null) {

        // Checks if the reply message contains the '%nome%' or '%name%' placeholders
        if (strpos($reply, '%nome%') !== false) {

            $name = get_subscriber_name($conn, $number);

            if($name) {
                $reply = str_replace('%nome%', $name, $reply);
            } else {
                $reply = str_replace('%nome%', "", $reply);
            }

        }

        if (strpos($reply, '%name%') !== false) {

            $name = get_subscriber_name($conn, $number);

            if($name) {
                $reply = str_replace('%name%', $name, $reply);
            } else {
                $reply = str_replace('%name%', "", $reply);
            }

        }

    }

    // Encode the reply message and decide the server output using curl request

    $encoded_reply = rawurlencode($reply);
    $headers = array(
        'Content-Type: text/plain; charset=utf-8',
    );
    typeMessage($instance, $number, true);
    sleep($delay);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://app.321dbase.com/wp/sendMsg");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "instancia=$instance&number=$number&msg=$encoded_reply");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close($ch);
    typeMessage($instance, $number, false);
}

////// 9th Function
////// Sending a media via the WhatsApp messaging service using the 321dbase API

function send_media($instance, $number, $image, $reply, $delay = 3)
{
    typeMessage($instance, $number, true);
    sleep($delay);
    $exploded = explode('.', $image);
    $exten = end($exploded);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://app.321dbase.com/wp/SendMedia");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
        "instancia=$instance&number=$number&msg=$reply&tipo=minha-lamborguini.$exten&arquivo=$image");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close($ch);

    typeMessage($instance, $number, false);
}

////// 10th Function
////// Automate message flows in response to specific keywords

function auto_flow($instance, $number, $conn, $keywords, $gp_id)
{
    $sql = "SELECT * from flows where group_id = " . $gp_id . " AND keywords = '$keywords'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $reply = $row['reply'];
            $auto_flow_2 = $row['auto_flow'];
            sleep(2);
            send_message($instance, $number, $reply);

            if (!empty($auto_flow_2)) {
                auto_flow($instance, $number, $conn, $auto_flow_2, $gp_id);
            }
        }
    }
}

////// 11th Function
////// Updates a specific column in the table of a database, for a particular subscriber identified by their number

function update_subscriber_column($conn, $column_name, $value, $number) {
    $sql = "UPDATE subscribers SET $column_name = ? WHERE number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $value, $number);
    $stmt->execute();
    $stmt->close();
}

////// 12th Function
////// Check if updated 12 hours ago


function was_updated_more_than_12_hours_ago($conn, $number) {
    // Prepare the SQL query
    $sql = "SELECT updated_at FROM records WHERE number = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // Error preparing the statement
        error_log("Error preparing SQL statement: " . $conn->error);
        return false;
    }

    // Bind the number parameter
    $stmt->bind_param("s", $number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the record
        $record = $result->fetch_assoc();
        $updated_at = $record['updated_at'];

        // Get the current timestamp and calculate the difference
        $current_time = new DateTime();
        $updated_time = new DateTime($updated_at);
        $interval = $updated_time->diff($current_time);

        // Check if the difference is more than 12 hours
        if ($interval->m >= 5 || $interval->days > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        // Record not found
        return false;
    }
}

////// 13th Function
////// Create or Update the record in the 'records' table of the database.

function create_or_update_record($conn, $number = null, $action = null, $tmp_type = null, $current_flow = null, $next_flow = null, $groupid = null, $flowid = null) {

    if ($number === null) {
        return;
    }

    // $flowid = (!empty($flowid)) ? $flowid : 3; //  only for testing

    // Check if the record already exists in the database
    $sql = "SELECT id FROM records WHERE number = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        // Error preparing the statement
        error_log("Error preparing SQL statement: " . $conn->error);
        return;
    }

    $stmt->bind_param("s", $number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Record exists, update it
        $record = $result->fetch_assoc();
        $record_id = $record['id'];

        $sql = "UPDATE records SET flow_id = ?, group_id = ?, action = ?, tmp_type = ?, current_flow = ?, next_flow = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            // Error preparing the statement
            error_log("Error preparing SQL statement: " . $conn->error);
            return;
        }

        $stmt->bind_param("iissssi",$flowid, $groupid, $action, $tmp_type, $current_flow, $next_flow, $record_id);
    } else {
        // Record does not exist, create a new one

        $sql = "INSERT INTO records (flow_id, group_id ,number, action, tmp_type, current_flow, next_flow) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            // Error preparing the statement
            error_log("Error preparing SQL statement: " . $conn->error);
            return;
        }

        $stmt->bind_param("iisssss",$flowid, $groupid, $number, $action, $tmp_type, $current_flow, $next_flow);
    }

    if (!$stmt->execute()) {
        // Error executing the statement
        error_log("Error executing SQL statement: " . $stmt->error);
    }

    $stmt->close();
}

////// 14th Function
////// Retrieve a record from a database table named "records" based on the number

function get_record_by_number($conn, $number) {
    // Prepare the SQL query to fetch the record
    $sql = "SELECT * FROM records WHERE number = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        // Error preparing the statement
        error_log("Error preparing SQL statement: " . $conn->error);
        return false;
    }

    $stmt->bind_param("s", $number);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a record was found and return it
    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();
        $result->close(); // Close the result object
        $stmt->close();
        return $record;
    } else {
        $result->close(); // Close the result object
        $stmt->close();
        return false;
    }
}

////// 15th Function
////// Sends user data to an API endpoint


function sendUserData($mobile, $data) {
    // API URL
    $url = 'https://321dbase.com/api/save_user_profile.php';

    // Add the mobile number to the data array
    $data['mobile'] = $mobile;

    // Create a new cURL resource
    $ch = curl_init($url);

    // Setup request to send json via POST
    $payload = json_encode($data);

    // Attach encoded JSON string to the POST fields
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    // Return response instead of outputting
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the POST request
    $result = curl_exec($ch);

    // Close cURL resource
    curl_close($ch);

    return $result;
}

?>

