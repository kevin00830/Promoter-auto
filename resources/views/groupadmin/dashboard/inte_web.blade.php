@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    <style>
        #btn-save-main {
            float: right;
        }
        .new-row {
            background: #f1dae1;
        }
        .reply-table-td {
            position: relative;
        }
        
        .reply-table-td:nth-child(1) .reply-td-field{
            text-align:center;
            padding-left:20px;
            
        }
        .reply-td-field {
            position: absolute;
            display: block;
            top:0;
            left:0;
            margin: 0;
            height: 100%;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .child-updated {
            display: none;
        }

        .file-drop-area {
            position: relative;
            display: flex;
            align-items: center;
            width: 60%;
            max-width: 60%;
            border: 1px dashed rgba(255, 255, 255, 0.4);
            border-radius: 3px;
            transition: .2s;
            margin:0 auto;
            min-height: 116px;
        }
        .file-preview-div.no_img{
            visibility: hidden !important;
        }
        .file-preview-img {
            height: 116px;
        }
        
        label.file-upload:not(.display_it) {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 80%;
            cursor: pointer;
            opacity:0;
            z-index:9999;
            cursor: pointer;
        }
       
        
    label.file-upload.display_it {
    opacity: 1;
    width: 100%;
    /* height: 100%; */
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    max-width: 120px;
    z-index:9999;
        cursor: pointer;
        }
        .file-delete {
            right: 0;
            position: absolute;
            border: 0;
            top: 0;
            padding-top: 8px;
            width: 25px;
        }
        .form-box {
            background-color: white;
            border-radius: 10px;
            height: auto;
            width: 100%;
            box-shadow: 0 4px 20px 0 rgb(0 0 0 / 10%);
            padding: 50px;
        }
        .reply-table-tr {
            height: 143px;
        }
        .msgunique{
        font-size: 20px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
        }
        .vidunique{
    width:100%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
        }
            .file-upload {
      position: relative;
      display: inline-block;
     
    }
    
    .col-md-6
    {
        padding-bottom: 20px !important;
    }
    
    .file-upload__label {
      display: grid;
  
      color: #fff;
      background-color: #f6c358;
      border-radius: .4em;
      transition: background-color .3s;
      text-align:center;
      align-items:center;
      height:42px;
    }
    
    .file-upload__input {
      position: absolute;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      font-size: 1;
      width: 0;
      height: 100%;
      opacity: 0;
    }
    .file-uploadtop {
  position: relative;
  display: inline-block;
}


.filewidth
{
    width: 16rem !important;
}
.file-upload__labeltop {
  display: block;
  padding: 1em 2em;
  color: #fff;
  background-color: #f6c358;
  border-radius: .4em;
  transition: background-color .3s;
  cursor: pointer;
}

.file-upload__inputtop {
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  font-size: 1;
  width: 0;
  height: 100%;
  opacity: 0;
}
.radset{
    width: 100%;
    display: grid;
    grid-template-columns: max-content max-content;
    /* grid-gap: 1px; */
    margin: 0 auto 0 40px;
    grid-gap: 3rem;
}.radset label{
    font-size: 15px;
    padding: 0px 4px;
}
.main-file-delete{
    border: 0;
    top: 0;
    padding-top: 2px;
    width: 25px;
}
.padflex{
    display:flex;
    align-items:end;
    /*padding:20px;*/
}
.btnstyl{
    width:20%;
    margin-top:10px;
}   textarea{
    resize:none;
}
.btninputpaddings{
    display:flex;
    padding:12px;
}
.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
  background-color: #fff;
  border: 1px solid #cdcdcd;
  border-radius: 3px;
  padding: 8px 12px;
  height: 50px!important;
  width:calc(100% - 26px);
}

.upload-btn-wrapper .btnr {
  border: 1px solid gray;
  color: gray;
  background-color: #eee;
  padding: 5px 10px;
  border-radius: 1px;
  font-size: 14px;
  font-weight: bold;
  position: relative;
}
.upload-btn-wrapper .btnr + span {
  padding: 5px;
  font-weight: normal;
  }

.upload-btn-wrapper input[type=file] {
    font-size: 42px;
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
}
.icon-delete{
    right: 216px;
    position: absolute;
    border: 0;
    top: 23px;
    width: 31px;
}
.hidden {
    display:none;
}

/*for image preview and delete*/
/*input[type="file"] {*/
/*  display: block;*/
/*}*/
/*.imageThumb {*/
/*  max-height: 75px;*/
/*  border: 2px solid;*/
/*  padding: 1px;*/
/*  cursor: pointer;*/
/*}*/
/*.pip {*/
/*  display: inline-block;*/
/*  margin: 10px 10px 0 0;*/
/*}*/
/*.remove {*/
/*  display: block;*/
/*  background: #444;*/
/*  border: 1px solid black;*/
/*  color: white;*/
/*  text-align: center;*/
/*  cursor: pointer;*/
/*}*/
/*.remove:hover {*/
/*  background: white;*/
/*  color: black;*/
/*}*/
/*end of image preview*/
    </style>
    
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid mx-lg-5 mt-lg-5 mt-md-5 pt-lg-5 pt-md-5">

            <div class="row mt-0 mt-lg-5 mt-md-5 pt-lg-3 pt-md-3">
               
                <!-- @TODO -->
                <div class="col-lg-12 topdiv">
                    <div class="container-fluid">
                         <!--new box start-->
                          <ul class="nav nav-tabs" id="myTab" role="tablist">
                            
                             <li class="nav-item" role="presentation">
                                <button class="nav-link" id="customized-tab" data-toggle="tab" data-target="#customized" type="button" role="tab" aria-controls="customized" aria-selected="false">{{__('group.quick_setup')}}</button>
                              </li>
                            </ul>
                            
                            <div class="tab-content" id="myTabContent">

                            
                             <div class="tab-pane   fade show active" id="customized" role="tabpanel" aria-labelledby="customized-tab">
                                                                     <div class="form-box">
                                     <form action="{{route('clone_group')}}" method="post" enctype="multipart/form-data">
                                     @csrf
                                    <div class="row padflex">
                                        <div class="col-md-6">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 15px;">{{__('group.select_template')}}</label>
                                            <select class="form-control tmp_type_select" name="group_id">
                                                <option value="">{{__('group.select')}}</option>
                                                    @foreach($groups as $group)
                                                        <option value="{{ $group->id }}">{{ $group->gp_groupname  }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                        <div class="col-lg-12 col-md-12" style="display: flex;align-items: flex-end;justify-content: end;padding: 10px 0px;">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save"></i>{{ __('group.buttom') }}
                                            </button>
                                        </div>
                                    </form>
                                    </div>
                                     </div>
                                      </div>
                                      <br>
                                 <!--new box end-->
                       
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                            
                             <li class="nav-item" role="presentation">
                                <button class="nav-link" id="customized-tab" data-toggle="tab" data-target="#customized" type="button" role="tab" aria-controls="customized" aria-selected="false">{{__('group.webwithnobuttons')}}</button>
                              </li>
                            </ul>
                            
                            <div class="tab-content" id="myTabContent">

                            
                             <div class="tab-pane   fade show active" id="customized" role="tabpanel" aria-labelledby="customized-tab">
                                
                                <div class="form-box">
                                     <form action="{{route('main_web_inte')}}" method="post" enctype="multipart/form-data">
                                     @csrf
                                    <div class="row padflex">
                                        <div class="col-md-6">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 15px;">{{__('group.user_input_data')}}</label>
                                            <select class="form-control tmp_type_select" name="tmp_type" onchange="change_letoption(this.value)">
                                                <option value="Select">{{__('group.select')}}</option>
                                                <option value="1">{{__('group.generic_template')}}</option>
                                                <option value="2"> {{__('group.audio')}}</option>
                                                <option value="ask">{{__('group.ask')}}</option>
                                                <option value="1000"> {{__('group.button_blocks')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                     <div class="row padflex askbox">
                                        <div class="col-md-6">
                                            <select class="form-control tmp_type_select" id="tmp_typebox" onchange="change_letoption(this.value)">
                                                <option value="">{{__('group.select')}}</option>
                                                <option value="3"> {{__('group.ask_for_name')}}</option>
                                                <option value="4"> {{__('group.ask_for_dob')}}</option>
                                                <option value="5"> {{__('group.ask_for_company')}}</option>
                                                <option value="6"> {{__('group.ask_for_street')}}</option>
                                                <option value="7"> {{__('group.ask_for_number')}}</option>
                                                <option value="8"> {{__('group.ask_for_complement')}}</option>
                                                <option value="9"> {{__('group.ask_for_district')}}</option>
                                                <option value="10"> {{__('group.ask_for_zipcode')}}</option>
                                                <option value="11"> {{__('group.ask_for_city')}}</option>
                                                <option value="12"> {{__('group.ask_for_email')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                
                                
                                     <div class="row padflex hideall">
                                          <div class="col-md-6">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 5px;">{{__('group.keywords')}}</label>
                                            <input type="text" class="form-control" id="keywords-input-main" name="keyword"/>
                                        </div>
                                        
                                         <div class="col-md-6" id="messagE_box_demo" style="padding-bottom:0px !important">
                                             
                                             </div>
                                         
                                        <div class="col-md-6" id="messagE_box">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 5px;">{{__('group.message')}} </label>
                                            <textarea rows="4" class="form-control sms_body_web" id="reply-input-main" name="msg"></textarea>
                                        </div>
                                        <div class="col-md-6" style="display:grid">
                                        <!-- start new code-->
                                            <div class="btn btn-primary btnstyl-  filewidth" id="flow_img" style="text-align:left">
                                                
 <span> <button class="input_file_custom" type="button" style="border:0.5px solid black;font-size: 93%;">{{__('group.select_file')}} </button>  <span id="file_name" style="font-size: 97%;">{{__('group.no_file_selected')}} </span></span>

  <input type="file" id="files" name="flow_img"  style="display:none"  />
  <span class="icon-delete" style="display:none;"><i class="fas fa-trash" style="color: #464e5f;"></i></span>
</div>
                                           <!--end new-->
                                           
                                              <!--<input  type="file" name="flow_img" id="flow_img" class="btn btn-primary btnstyl-  w-50"/>-->
                                        </div>
                                    </div>
                                     <div class="row padflex hideall buttonblock" id="button01">
                                        <div class="col-md-12" id="messagE_box">
                                            <div class="col-md-6" id="messagE_box" style="padding: 0px !important;">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 5px;">{{__('group.button1')}} </label>
                                             <input type="text" class="form-control sms_body_web w-50"  id="reply1"  name="title1"/> <br>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6" id="messagE_box">
                                            <textarea rows="4" class="form-control sms_body_web " id="reply-input-main" name="msg1"></textarea>
                                        </div>
                                        <div class="col-md-6" style="display:grid">
                                               <!-- start new code-->
                                            <div class="btn btn-primary btnstyl-  filewidth" id="flow_img" style="text-align:left">
                                                
 <span> <button class="input_file_custom" type="button" style="border:0.5px solid black;font-size: 93%;">{{__('group.select_file')}} </button>  <span id="file_name" style="font-size: 97%;">{{__('group.no_file_selected')}} </span></span>

  <input type="file" name="flow_img3"  style="display:none"  />
    <span class="icon-delete" style="display:none;"><i class="fas fa-trash" style="color: #464e5f;"></i></span>
</div>
                                           <!--end new-->
                                            <!--<input  type="file" name="flow_img3" id="flow_img3" class="btn btn-primary btnstyl-  w-50"/>-->
                                        </div>
                                       
                                    </div>
                                     <div class="row padflex hideall buttonblock" id="button02">
                                       <div class="col-md-12" id="messagE_box">
                                            <div class="col-md-6" id="messagE_box" style="padding: 0px !important;">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 5px;"> {{__('group.button2')}} </label>
                                             <input type="text" class="form-control sms_body_web w-50"  id="reply2"  name="title2"/> <br>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="messagE_box">
                                           
                                            <textarea rows="4" class="form-control sms_body_web" id="reply-input-main" name="msg2"></textarea>
                                        </div>
                                        <div class="col-md-6" style="display:grid">
                                               <!-- start new code-->
                                            <div class="btn btn-primary btnstyl-  filewidth" id="flow_img" style="text-align:left">
                                                
 <span> <button class="input_file_custom" type="button" style="border:0.5px solid black;font-size: 91%;">{{__('group.select_file')}} </button>  <span id="file_name" style="font-size: 95%;">{{__('group.no_file_selected')}} </span></span>

  <input type="file" name="flow_img1"  style="display:none"  />
    <span class="icon-delete" style="display:none;"><i class="fas fa-trash" style="color: #464e5f;"></i></span>
</div>
                                           <!--end new-->
                                            <!--<input  type="file" name="flow_img1" id="flow_img1" class="btn btn-primary btnstyl-  w-50"/>-->
                                        </div>
                                       
                                    </div>
                                     <div class="row padflex hideall buttonblock" id="button03">
                                        <div class="col-md-12" id="messagE_box">
                                            <div class="col-md-6" id="messagE_box" style="padding: 0px !important;">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 5px;">{{__('group.button3')}} </label>
                                             <input type="text" class="form-control sms_body_web w-50 te"  id="reply3"  name="title3"/> <br>
                                            </div>
                                        </div>     
                                           
                                        <div class="col-md-6" id="messagE_box">

                                            <textarea rows="4" class="form-control sms_body_web" id="reply-input-main" name="msg3"></textarea>
                                        </div>
                                        <div class="col-md-6" style="display:grid">
                                               <!-- start new code-->
                                            <div class="btn btn-primary btnstyl-  filewidth" id="flow_img" style="text-align:left">
                                                
 <span> <button class="input_file_custom" type="button" style="border:0.5px solid black;font-size: 91%;">{{__('group.select_file')}} </button>  <span id="file_name" style="font-size: 95%;">{{__('group.no_file_selected')}} </span></span>

  <input type="file" name="flow_img2"  style="display:none"  />
    <span class="icon-delete" style="display:none;"><i class="fas fa-trash" style="color: #464e5f;"></i></span>
</div>
                                           <!--end new-->
                                            <!--<input  type="file" name="flow_img2" id="flow_img2" class="btn btn-primary btnstyl-  w-50"/>-->
                                    </div>
                                       
                                    </div>
                                    
                                    
                                    
                                    <div class=" hideall">
                                         <label style="font-weight: 600;font-size: 18px;margin-bottom: 5px;"> {{__('group.choose_next_block')}}</label>
                                                <div class="col-md-6" id="" style="padding-bottom:5px !important">
                                                    <input type="radio" value="0" id="actions1" name="actions" checked onchange="checkSelection(this)">
                                                    <label style="font-size: 18px;">{{__('group.no_action')}}
                                                    </label>
                                                </div>
                                        
                                            <div class="col-md-6" id="">                                     
                                                <input type="radio" value="1" id="actions2" name="actions" onchange="checkSelection(this)">
                                                <label for="actions2" style="font-size: 18px;margin-bottom: 5px;">{{__('group.auto_trigger')}}
                                                </label>
                                                <div id="appearNext" class="row padflex appear-next hidden">
                                                    <div class="col-md-6" style="padding-top:5px">
                                                        <?php //dd($flows); ?>
                                                    <select class="form-control auto_flow_select" name="auto_flow" id="autoflow">
                                                        <option value="">{{__('group.select_flow')}}</option>
                                                         @foreach($flows as $flow)
                                                        <option value="{{$flow->flow_id}}">{{$flow->flow_id . ' - ' . $flow->keywords}}</option>
                                                        @endforeach;
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6" id="">  
                                                <label for="actions2" style="font-weight: 600;font-size: 18px;margin-bottom: 5px;">{{__('group.delay')}} <span>{{__('group.in_seconds')}}</span></label>
                                                <div class="row padflex">
                                                    <div class="col-md-6">
                                                        <input class="form-control delay_select" type="number" value="3" name="delay" id="delay" />
                                                    </div>
                                                </div>
                                            </div>

                                       
                                    </div>
                                    
                                    
                                    
                                    
                                    <!--<div class="row padflex">-->
                                    <!--    <div class="col-md-6 p-3">-->
                                    <!--        <label style="font-weight: 600;font-size: 18px;margin-bottom: 15px; display:block;">3. {{__('group.user_input_data')}} </label>-->
                                    <!--        <div class="row form-check mb-2 ml-2">-->
                                    <!--            <input type="checkbox" id="checkbox_1" class="form-check-input auto_reply_setting" name="name" data-order="0" value="1">-->
                                    <!--            <label class="form-check-label">{{__('group.name')}}</label>-->
                                    <!--        </div>-->
                                                
                                    <!--        <div class="row form-check mb-2 ml-2">-->
                                    <!--            <input type="checkbox" id="checkbox_2" class="form-check-input auto_reply_setting" name="empress" data-order="1" value="1"  >-->
                                    <!--            <label class="form-check-label" >{{__('group.company')}}</label>-->
                                    <!--        </div>-->
                                                
                                    <!--        <div class="row form-check mb-2 ml-2">-->
                                    <!--            <input type="checkbox" id="checkbox_3" class="form-check-input auto_reply_setting" name="dob" data-order="2" value="1" >-->
                                    <!--            <label class="form-check-label" >{{__('group.dob')}}</label>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    
                                    <!--<div class="row padflex">-->
                                    <!--    <div class="col-md-6">-->
                                    <!--        <label style="font-weight: 600;font-size: 18px;margin-bottom: 15px;">4.Main Message </label>-->
                                    <!--        <textarea rows="9" class="form-control " id="reply-input-main-msg" name="main_msg"></textarea>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--    <div class="col-md-12" style="display:grid">-->
                                    <!--        <input type="file" name="main_img" class="btn btn-primary btnstyl "/>-->
                                    <!--    </div>-->
                                        <div class="col-lg-12 col-md-12" style="display: flex;align-items: flex-end;justify-content: end;padding: 10px 0px;">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save"></i>{{ __('group.save') }}
                                            </button>
                                        </div>
                                    </form>
                                    </div>
                                    
                                    <br>
                                    <br>
                                    
                                <div class="card p-3">
                                <label style="font-weight: 600;font-size: 18px;margin-bottom: 15px; display:block;"> {{__('group.active_flows')}}</label>
                                                            <hr>
                                <table class="table table-separate table-hover table-checkable" id="kt_datatable_users22">
                                <thead>
                                <tr>
                                    <th> {{__('group.id')}}</th>
                                    <th> {{__('group.flow_id')}}</th>
                                    <th> {{__('group.keyword')}}</th>
                                    <th> {{__('group.type')}}</th>
                                    <th> {{__('group.message')}}</th>
                                     <th> {{__('group.next')}}</th>
                                    <th style="width:200px;">{{__('group.actions')}}</th>
                                </tr>
                                </thead>
                                
                                <?php
                                 $type = array(
      "2" => __('group.audio'),
      "1" => __('group.generic_template'),
      "3" => __('group.ask_for_name'),
      "4" => __('group.ask_for_dob'),
      "5" => __('group.ask_for_company'),
      "6" => __('group.ask_for_street'),
      "7" => __('group.ask_for_number'),
      "8" => __('group.ask_for_complement'),
      "9" => __('group.ask_for_district'),
      "10" => __('group.ask_for_zipcode'),
      "11" => __('group.ask_for_city'),
      "12" => __('group.ask_for_email'),
    );
                                ?>
                                @foreach($flows as $flow)
                                <tr>
                                
                                    
                                    <td>{{$flow->id}}</td>
                                    <td>{{$flow->flow_id}}</td>
                                    <td>{{$flow->keywords}}</td>
                                    <td>@if(isset($type[$flow->tmp_type])) {{$type[$flow->tmp_type]}}  @endif</td>
                                    <td>{{$flow->reply}}</td>
                                     <td>{{$flow->auto_flow}}</td>
                                    <!--<td>{{$flow->main_msg}}</td>-->
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-main-btn"  data-id="{{$flow->id}}"> {{__('group.edit')}}</button>
                                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{$flow->id}}"> {{__('group.delete')}}</button>
                                    </td>
                                </tr>  
                                    @endforeach
                            </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
     <link href="https://cdn.jsdelivr.net/gh/mervick/emojionearea@master/dist/emojionearea.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/gh/mervick/emojionearea@master/dist/emojionearea.min.js"></script>
     <!--emoji8467-->
     <script>
     const langfilename = "{{__('group.no_file_selected')}}";
     const flow_delete_msg = "{{__('group.flow_delete_msg')}}";
      
      $('.askbox').hide();
     function change_letoption(val){
          if(val === '2'){
            $('.askbox').hide();
            $('#messagE_box').hide();
            $('#messagE_box_demo').hide();
            $('#flow_img').show();
            $('.buttonblock').hide();
          } else if(val === '3' || val === '4' || val === '5' || val === '6' || val === '7' || val === '8' || val === '9' || val === '10' || val === '11' ||val === '12'){
              $('#flow_img').hide();
              $('#messagE_box').show();
               $('#messagE_box_demo').show();
              $('.buttonblock').hide();
          }else if(val === 'Select'){
              $('.askbox').hide();
              $('#flow_img').hide();
              $('#messagE_box').hide();
               $('#messagE_box_demo').hide();
              $('.hideall').hide();   
          }else if(val === '100'){
              $('.askbox').hide();
                $('.buttonblock').show();
                $('#messagE_box').show();
                $('#messagE_box_demo').show();
                $('#flow_img').hide();
          }else if(val === 'ask'){
                $('#tmp_typebox').attr('name', 'tmp_type');
                $('.buttonblock').hide();
                $('.askbox').show();
          }
          
          else if(val === '1'){
                $('#flow_img').show();
                $('.askbox').hide();
                $('#messagE_box').show();
                $('#messagE_box_demo').show();
                $('.buttonblock').hide();
          }else {
            $('#messagE_box').show();
            $('#messagE_box_demo').show();
            $('#flow_img').show();
            $('.askbox').hide();
            
          }
        }
     $(document).ready(function() {
  const selectVal = $('select[name="tmp_type"]').val();
  if (selectVal === 'Select') {
    $('.hideall').hide();
  }
  
    //custom input type file button
             $(".input_file_custom").on("click", function () {
                 $(this).closest("div").find("input").trigger('click');
               
             });
});

// on select change
$('select[name="tmp_type"]').on('change', function() {
  const selectVal = $(this).val();
  $('.hideall').show();
  change_letoption(selectVal);
});
         $(document).ready(function() {
             $("#sms_body").emojioneArea({
                 pickerPosition: "bottom",
                 tonesStyle: "bullet"
             });
         });
         
         $(document).ready(function() {
             $("#sms_body1,#sms_body2,#sms_body3,#sms_body4,#sms_body5,#sms_body6,#sms_body7,#sms_body8,#sms_body9,.sms_body_main,.sms_body_main2,.sms_body_web").emojioneArea({
                 pickerPosition: "bottom",
                 tonesStyle: "bullet"
             });
         });
     </script>

    <script>
        $(document).ready(function () {
            // var user_table = $('#kt_datatable_users').DataTable({});
            let q_setting = [];
          
            $('.auto_reply_setting').each(function(){
                    console.log($(this));
                    console.log();
                    let order =  $(this).attr('data-order');
                    if($(this).prop('checked')){
                        if(q_setting.includes( $(this).val() ) ){
                           q_setting.splice(q_setting.indexOf($(this).val()), 1);
                       }else{
                           
                           q_setting.splice(order, 0, $(this).val() );
                           
                           
                       }
                    }
                })
                 $(document).on('click', '.edit-main-btn', function() {
                     $('.buttonblock').css("display", "none"); // 8467
                  
                    var flowId = $(this).data('id');
                     $.ajax({
                        url: '/flows/' + flowId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            // console.log(response);
                             window.scrollTo(0, 0);
                             var newInput1 = $('<input>').attr({
                                type: 'hidden',
                                name: 'flow_id',
                                value: flowId,
                                class: 'form-control'
                              });
                              var newInput2 = $('<input>').attr({
                                type: 'hidden',
                                name: 'is_update_main',
                                value: 1,
                                class: 'form-control'
                              });
                              $('.col-md-12').append(newInput1, newInput2);
                            // Populate the form inputs inside the modal with the response data
                            $('#keywords-input-main').val(response.keywords);
                            $('#reply-input-main').data("emojioneArea").setText(response.reply);
                            // $('#reply-input-main-msg').data("emojioneArea").setText(response.main_msg);
                            $('#reply-input-main-msg').val(response.main_msg);
                            
                            $(".tmp_type_select").val(response.tmp_type).trigger("change");
                            
                            // $("select[name='tmp_type'] opion").each(function() {
                            //     if ($(this).val() == response.tmp_type) {
                            //         $(this).prop("selected", true);
                            //     }
                            // });
                             $(".auto_flow_select").val(response.auto_flow).trigger("change");
                            // $("select[name='auto_flow'] option").each(function() {
                            //     if ($(this).val() == response.auto_flow) {
                            //         $(this).prop("selected", true);
                            //     }
                            // });

                            if(response.next === '0'){
                              $('#actions1').prop('checked', true);
                            } else {
                              $('#actions1').prop('checked', false);
                            }
                            if(response.next === '1'){
                              $('#actions2').prop('checked', true);
                            } else {
                              $('#actions2').prop('checked', false);
                            }
                            
                            var name = response.is_name;
                            var empress = response.is_empress;
                            var dob = response.is_dob;
                            var checkbox1 = $('#checkbox_1');
                            var checkbox2 = $('#checkbox_2');
                            var checkbox3 = $('#checkbox_3');
                            if (name == 1) {
                                  checkbox1.prop('checked', true);
                                } else {
                                  checkbox1.prop('checked', false);
                            }
                            if (empress == 1) {
                                  checkbox2.prop('checked', true);
                                } else {
                                  checkbox2.prop('checked', false);
                            }
                            if (dob == 1) {
                                  checkbox3.prop('checked', true);
                                } else {
                                  checkbox3.prop('checked', false);
                            }
                            $('.buttonblock').css("display", "none"); // 8467
                             
                           var div = document.getElementById('appearNext');
                            div.classList.remove('hidden');
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });
                
                $(document).on('click', '.edit-btn', function() {
                    var flowId = $(this).data('id');
                     $.ajax({
                        url: '/flows/' + flowId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            console.log(response)
                             var newInput1 = $('<input>').attr({
                                type: 'hidden',
                                name: 'flow_id',
                                value: flowId,
                                class: 'form-control'
                              });
                              var newInput2 = $('<input>').attr({
                                type: 'hidden',
                                name: 'is_update',
                                value: 1,
                                class: 'form-control'
                              });
                              $('.col-md-12').append(newInput1, newInput2);
                            // Populate the form inputs inside the modal with the response data
                            $('#keywords-input').val(response.keywords);
                            $('#reply-input').data("emojioneArea").setText(response.reply);
                            var name = response.is_name;
                            var empress = response.is_empress;
                            var dob = response.is_dob;
                            var checkbox1 = $('#checkbox1');
                            var checkbox2 = $('#checkbox2');
                            var checkbox3 = $('#checkbox3');
                            if (name == 1) {
                                  checkbox1.prop('checked', true);
                                } else {
                                  checkbox1.prop('checked', false);
                            }
                            if (empress == 1) {
                                  checkbox2.prop('checked', true);
                                } else {
                                  checkbox2.prop('checked', false);
                            }
                            if (dob == 1) {
                                  checkbox3.prop('checked', true);
                                } else {
                                  checkbox3.prop('checked', false);
                            }
                           $.each(response.blocks, function(blockIndex, block) {
                            $('input[name="block_title[]"]').eq(blockIndex).val(block.block_title);
                            
                            $.each(block.buttons, function(buttonIndex, button) {
                                $('input[name="btnname[' + blockIndex + '][]"]').eq(buttonIndex).val(button.name);
                                console.log(button);
                                // console.log(button.name)
                                if(button.msg != null){
                                    $('textarea[name="btnmsg[' + blockIndex + '][]"]').eq(buttonIndex).length > 0 && $('textarea[name="btnmsg[' + blockIndex + '][]"]').eq(buttonIndex).data("emojioneArea").setText(button.msg);
                                }
                                    
                                });
                        });
                            
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });
            $(document).on('click', '.delete-btn', function() {
                var flowId = $(this).data('id');
                if (confirm('Are you sure you want to delete this flow?')) {
                    $.ajax({
                        url: '/delete-flow',
                        type: 'POST',
                        headers: {
                                    _token: csrfToken,
                                },
                        data: {_token: csrfToken,id: flowId},
                        success: function(response) {
                            alert(flow_delete_msg);
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error deleting flow: ' + errorThrown);
                        }
                    });
                }
            });
            $('.defcus').on('change',  function(event) {
               
                let val =  $(this).val();
                
              $.ajax({
                      url: '{{ route('ajax.custom') }}',
                      type: 'post',
                        headers: {
                                    _token: csrfToken,
                                },
                        data: {_token: csrfToken,val:val},
                        dataType: 'JSON',
                        success: function (data) {
                           
                        }
                  });
            });
            
            $('.auto_reply_setting').on('change',  function(event) {
               
                 
               let order =  $(this).attr('data-order');
               if(q_setting.includes( $(this).val() ) ){
                   q_setting.splice(q_setting.indexOf($(this).val()), 1);
               }else{
                   
                   q_setting.splice(order, 0, $(this).val() );
                   
                   
               }
               
               console.log(q_setting);

              $.ajax({
                      url: '{{ route('ajax.message.save_setting') }}',
                      type: 'post',
                        headers: {
                                    _token: csrfToken,
                                },
                        data: {_token: csrfToken,setting:q_setting},
                        dataType: 'JSON',
                        success: function (data) {
                           
                        }
                  });
            });
            
            $('.main-file-delete').click(function() {
                 var that = $(this);
                let id = $(this).data('id');
                
                $.ajax({
                  url: '{{ route('ajax.message.del_main') }}',
                  type: 'POST',
                  headers: {
                        _token: csrfToken,
                        },
                  data: {_token: csrfToken,id:id},
                  success: function(result) {
                     that.hide();
                     location.reload();
                  }
                });
              });
              
            $('#btnSaveNew').on('click', function(){
                let json_data =  [];
                json_data.push({
                            id:$('#reply-main').attr('data-id'),
                            order_num:0,
                            keywords: "WAKE",
                            reply:$('#reply-main').val(),
                            is_image:0,
                            image_link:'',
                            to_upload:0,
                            reply_id:0
                    
                })
                $('.reply-table-tr').each(function(index,el){
                    if($(this).attr('data-id')!='' && $(this).attr('data-id')!=0){
                        console.log($(this).children().children('.opt-order_num').val());
                        console.log( $(this).children().children().children('.file-preview-div').children('.file-preview-img')  );
                        let img_link = [] ;
                        let is_img =  0;
                        let to_upload =  0;
                        if($(this).children().children().children('.file-input').prop('files')[0]  != null){
                            img_link = $(this).children().children().children('.file-input').prop('files')[0];
                            is_img = 1;
                            to_upload = 1;
                        }else if(   $(this).children().children().children('.file-preview-div:not(.no_img)').children('.file-preview-img').attr('src') != undefined  ){
                            img_link = $(this).children().children().children('.file-preview-div:not(.no_img)').children('.file-preview-img').attr('src');
                             is_img = 1
                             to_upload = 0
                        }
                        
                 
                    json_data.push(
                        {
                            id:$(this).attr('data-id'),
                            order_num:$(this).children().children('.opt-order_num').val(),
                            keywords: 'option' + $(this).children().children('.opt-order_num').val(),
                            reply:$(this).children().children('.opt-reply').val(),
                            is_image:is_img,
                            image_link:img_link,
                            to_upload:to_upload,
                            reply_id:$('#reply-main').attr('data-id'),
                            
                            
                            
                        }

                        );
                        
                          

                    }
                });
                
                 $.ajax({
                                url: '{{ route('ajax.message.save_new') }}',
                                type: 'POST',
                                headers: {
                                    _token: csrfToken,
                                },
                                data: {
                                    _token: csrfToken,
                                    data: JSON.stringify(json_data),
                                },
                                dataType: 'JSON',
                                success: function (data) {
                                    console.log('ajax_save_main', data);
                                    alert('{{ __('group.savemsg') }}');
                                    
                                    that.hide();
                                }
                        });

                console.log(json_data);

                
                
            })
            $('#btnAddOption').on('click', function() {
                if($('.new-row')[0]) {
                    alert('Already exist new editing option');
                    return;
                }
                
                let order_nums = [0];
                $('.opt-order_num').each(function(index, element){
                    order_nums.push( $(this).val() );
                });
                console.log(order_nums);
                var order_num = order_nums[0];

                for (var i = 0; i < order_nums.length; i++) {
                    if (order_num = order_nums[i] ) {
                        order_num = order_nums[i];
                    }
                }
                var htmlAdded = '<tr class="reply-table-tr new-row" data-id="0"> \
                        <td class="reply-table-td text-center"> \
                            <input type="number" class="reply-td-field form-control opt-order_num" value="'+(parseInt(order_num) +1)+'"> \
                        </td> \
                        <td class="reply-table-td"> \
                            <textarea class="reply-td-field form-control opt-reply" id="sms_body" rows="5"></textarea> \
                        </td> \
                        <td class="reply-table-td"> \
                            <div class="file-drop-area justify-content-center"> \
                                <div class="file-preview-div no_img"> \
                                    <img class="file-preview-img" src="/images/blank.jpg" /> \
                                </div> \
                                <label class="file-upload display_it">\
                                    <input type="file" class="file-input file-upload__input display_it btn btn-primary" accept=".jfif,.jpg,.jpeg,.png,.gif,.pdf,.ogg,.mp4" multiple style="z-index: 9999;">\
                                    <span class="file-upload__label">Select File</span> \
                                    </label> \
                                <p class="msgunique"></p> \
                            </div> \
                            <button class="file-delete" style="display: none;"><i class="fas fa-trash" style="color: #464e5f;"></i></button> \
                        </td> \
                        <td class="align-middle text-center"> \
                            <button type="button" class="btn btn-success btn-save btn-sm" style="/*display: none;*/"> \
                                {{ __('group.save') }} \
                            </button> \
                            <button type="button" class="btn btn-primary btn-remove btn-sm"> \
                                {{ __('group.remove') }} \
                            </button> \
                        </td> \
                    </tr> \
                    <tr style="height: 10px;"></tr>';
                $('#tbodyOptions').append(htmlAdded);
            });

            $('#tblOptions').on('keypress', '.reply-td-field', function(e) {
                $(this).closest('.reply-table-tr').find('.btn-save').show();
            });

            $('#tblOptions').on('change', '.opt-order_num', function(e) {
                var order_num = $(this).val();
                $(this).closest('.reply-table-tr').find('.opt-keywords').val('option' + order_num);
            });

            $('#tblOptions').on('click', '.btn-save', function(e) {
                var that = $(this);
                
                
                var trSelected = $(this).closest('.reply-table-tr');
                var imgSelected = trSelected.find('.file-preview-img');
                var oggSelected = trSelected.find('.msgunique');
                var vidSelected = trSelected.find('.vidunique');
                
             
          
                // imgSelected.attr('src')?imgSelected.attr('src'):oggSelected.val(),
                var postData = {
                    _token: csrfToken,
                    id: trSelected.data('id'),
                    order_num: trSelected.find('.opt-order_num').val(),
                    keywords: 'option' + trSelected.find('.opt-order_num').val(),
                    reply: trSelected.find('.opt-reply').val(),
                    image_link: '',
                    fImage: 0,  // image not chaged
                };
                
                if(imgSelected.attr('type') == 'img'){
                    postData.image_link = imgSelected.attr('src')
                }else if(vidSelected.attr('type') == 'vid' && imgSelected.attr('type') == 'none' ){
                     postData.image_link = vidSelected.attr('src')
                }else if(oggSelected.attr('type') == 'ogg'){
                    
                    postData.image_link = oggSelected.attr('src')
                    
                }
                
 
                if(imgSelected.hasClass('changed') || vidSelected.hasClass('changed') || oggSelected.hasClass('changed')){
                    postData.fImage = 1;
                }
                if(imgSelected.hasClass('removed')) {
                    postData.fImage = 2;
                }

                $.ajax({
                    url: '{{ route('ajax.message.option_save') }}',
                    type: 'POST',
                    data: postData,
                    dataType: 'JSON',
                               headers: {
        _token: csrfToken,
    },
                    success: function (data) {
                        console.log('ajax_save_option', data);
                        if(data.success) {
                            if(trSelected.data('id') === 0) {
                                trSelected.data('id', data.data.id);
                                trSelected.removeClass('new-row');
                              
                                if(!alert('{{ __('group.savemsg') }}')){window.location.reload();}
                            } else {
                                // alert('Successfully updated');
                                if(!alert('{{ __('group.savemsg') }}')){window.location.reload();}
                            }
                            that.closest('.reply-table-tr').find('.file-preview-img').removeClass('changed');
                            that.closest('.reply-table-tr').find('.file-preview-img').removeClass('removed');
                            that.closest('.reply-table-tr').find('.msgunique').removeClass('changed');
                            that.closest('.reply-table-tr').find('.msgunique').removeClass('removed');
                            that.closest('.reply-table-tr').find('.vidunique').removeClass('changed');
                            that.closest('.reply-table-tr').find('.vidunique').removeClass('removed');
                            that.hide();
                        } else {
                            alert(data.message);
                        }
                    }
                });
            });

            $('#tblOptions').on('click', '.btn-remove', function(e) {
                var that = $(this);
                var trSelected = $(this).closest('.reply-table-tr');
                var option_id = trSelected.data('id');
                if(option_id > 0) {
                    $.ajax({
                        url: '{{ route('ajax.message.option_del') }}',
                        type: 'POST',
                        data: {
                            _token: csrfToken,
                            id: option_id
                        },
                                   headers: {
        _token: csrfToken,
    },
                        dataType: 'JSON',
                        success: function (data) {
                            console.log('ajax_del_option', data);
                            if (data.success) {
                                alert('Successfully removed');
                                trSelected.next().remove();
                                trSelected.remove();
                            } else {
                                alert(data.message);
                            }
                        }
                    });
                } else {
                    trSelected.next().remove();
                    trSelected.remove();
                }
            });

            $('#tblOptions').on('click', '.file-delete', function(e) {
                var trSelected = $(this).closest('.reply-table-tr');
                trSelected.find('.file-preview-img').addClass('removed');
                trSelected.find('.file-preview-div').addClass('no_img');
                trSelected.find('.file-input').addClass('display_it btn btn-primary');
                trSelected.find('.btn-save').show();
                $(this).hide();
            });

            $('#reply-main').on('keypress', function(e) {
                $('#btn-save-main').show();
            });

         $('#btn-save-main').on('click', function(e) {
    e.preventDefault();
    var that = $(this);
    var files = $('#main_img')[0].files;
    var img_to_upload = '';
    var fd = new FormData();
    
    // If no file is selected, only send reply message
    if (files.length > 0) {
        // Loop through each file selected
        $($(files)).each(function () {
            var file = $(this);
            var reader = new FileReader();
            reader.onload = function (e) {
                img_to_upload = e.target.result;
                // Append the uploaded image file to the FormData object
                fd.append('image', e.target.result);
                // Append the reply message to the FormData object
                fd.append('reply', $('#reply-main').val());
                // Append the CSRF token to the FormData object
                fd.append('_token', '{{ csrf_token() }}');
                // Call the AJAX request to save the message
                saveMessage(fd);
            }
            reader.readAsDataURL(file[0]);
        });
    } else {
        // If no file is selected, only send reply message
        fd.append('reply', $('#reply-main').val());
        fd.append('_token', '{{ csrf_token() }}');
        saveMessage(fd);
    }
});


// AJAX function to save the message
function saveMessage(formData) {
    $.ajax({
        url: '{{ route('ajax.message.save_main') }}',
        type: 'POST',
        headers: {
            _token: '{{ csrf_token() }}',
        },
        data: formData,
        processData: false, // Don't process the FormData object
        contentType: false, // Don't set the content type header
        success: function (data) {
            console.log('ajax_save_main', data);
            alert('{{ __('group.savemsg') }}');
            location.reload();
            // that.hide();
        }
    });
}
            
            $('#btn-save-main-2').on('click', function(e) {
                var that = $(this);
                console.log(that)
                $.ajax({
                    url: '{{ route('ajax.message.save_main2') }}',
                    type: 'POST',
                    headers: {
        _token: csrfToken,
    },
                    data: {
                        _token: csrfToken,
                        reply: $('#reply-main-text').val(),
                        
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        console.log('ajax_save_main', data);
                        alert('{{ __('group.savemsg') }}');
                        
                        // that.hide();
                    }
                });
            });
            
            $('#keyword').on('click', function(e) {
                var that = $(this);
                $.ajax({
                    url: '{{ route('ajax.message.keyword') }}',
                    type: 'POST',
                    headers: {
                        _token: csrfToken,
                            },
                    data: {
                        _token: csrfToken,
                        keyword: $('#inputkey').val(),
                    },
                    success: function () {
                        alert('{{ __('group.savemsg') }}');
                        
                        // that.hide();
                    }
                });
            });


            $('#tblOptions').on('change', '.file-input', function() {
              
                let dat_id = $(this).attr('data-id');
                var filesCount = $(this)[0].files.length;
                var textbox = $(this).prev();
                if (filesCount === 1) {
                    var fileName = $(this).val().split('\\').pop();
                    //textbox.text(fileName);
                } else {
                    //textbox.text(filesCount + ' files selected');
                }
    let main_div = $(this).parent('.file-upload');
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = main_div.prev();
                
                   main_div.removeClass("display_it");
                   var fName = $(this)[0].files[0].name;
                 
                   if($(this)[0].files[0].type == 'audio/ogg'){
                        $($(this)[0].files).each(function () {
                        var file = $(this);
                        //  console.log(dvPreview);
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            // console.log(e);
                           var imgPreview = dvPreview.closest('.reply-table-tr').find('.msgunique')
                            var vidPreview = dvPreview.closest('.reply-table-tr').find('.vidunique');
                            imgPreview.attr('type','ogg');
                            imgPreview.attr("src", e.target.result);
                            imgPreview.removeClass('removed');
                            imgPreview.addClass('changed');
                            dvPreview.closest('.reply-table-tr').find('.btn-save').show();
                            dvPreview.closest('.reply-table-tr').find('.file-delete').show();
                            dvPreview.closest('.reply-table-tr').find('.file-preview-div').removeClass('no_img');
                            dvPreview.closest('.reply-table-tr').find('.file-preview-div').css('visibility','hidden')
                            $(".reply-table-tr[data-id = '"+dat_id+"'] .msgunique").css('visibility','visible');
                        }
                        reader.readAsDataURL(file[0]);
                    }); 
                     
                        $(".reply-table-tr[data-id = '"+dat_id+"'] .msgunique").html(fName);
                   }else if($(this)[0].files[0].type == 'video/mp4'){
                        $($(this)[0].files).each(function () {
                        var file = $(this);
                        //  console.log(dvPreview);
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            // console.log(e);
                            var imgPreview = dvPreview.find('.file-preview-img')
                            var vidPreview = dvPreview.closest('.reply-table-tr').find('.vidunique');
                             vidPreview.attr('type','vid');
                             imgPreview.attr('type','none');
                            console.log(e.target)
                            vidPreview.attr("src", e.target.result);
                            vidPreview.removeClass('removed');
                            vidPreview.addClass('changed');
                            dvPreview.closest('.reply-table-tr').find('.btn-save').show();
                            dvPreview.closest('.reply-table-tr').find('.file-delete').show();
                            dvPreview.closest('.reply-table-tr').find('.file-preview-div').removeClass('no_img');
                            dvPreview.closest('.reply-table-tr').find('.file-preview-div').css('visibility','hidden')
                            $(".reply-table-tr[data-id = '"+dat_id+"'] .vidunique").css('visibility','visible');
                        }
                        reader.readAsDataURL(file[0]);
                    }); 
                       
                        // $(".reply-table-tr[data-id = '"+dat_id+"'] .vidunique").attr('src',"321autoreply.com/"+e.target.result);
                   }else{
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        //  console.log(dvPreview);
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            // console.log(e);
                           var imgPreview = dvPreview.find('.file-preview-img')
                            var vidPreview = dvPreview.closest('.reply-table-tr').find('.vidunique');
                            imgPreview.attr('type','img');
                            imgPreview.attr("src", e.target.result);
                            imgPreview.removeClass('removed');
                            imgPreview.addClass('changed');
                            dvPreview.closest('.reply-table-tr').find('.btn-save').show();
                            dvPreview.closest('.reply-table-tr').find('.file-delete').show();
                            dvPreview.closest('.reply-table-tr').find('.file-preview-div').removeClass('no_img');
                            dvPreview.closest('.reply-table-tr').find('.file-preview-div').css('visibility','visible')
                        }
                        reader.readAsDataURL(file[0]);
                    }); 
                    
                     $(".reply-table-tr[data-id = '"+dat_id+"'] .msgunique").html('');
                      $(".reply-table-tr[data-id = '"+dat_id+"'] .msgunique").css('visibility','hidden');
                      $(".reply-table-tr[data-id = '"+dat_id+"'] .vidunique").html('');
                      $(".reply-table-tr[data-id = '"+dat_id+"'] .vidunique").css('visibility','hidden');
                       
                   }
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });

            $('#tblOptions').on('click', '.file-delete', function () {
                var imgPreview = $(this).closest('.reply-table-tr').find('.file-preview-img');
                imgPreview.attr('src', '/images/blank.jpg');
                imgPreview.removeClass('changed');
                imgPreview.addClass('removed');
                $(this).closest('.reply-table-tr').find('.btn-save').show();
            });
            
            // for image preview and delete
//             if (window.File && window.FileList && window.FileReader) {
//     $("#files").on("change", function(e) {
//       var files = e.target.files,
//         filesLength = files.length;
//       for (var i = 0; i < filesLength; i++) {
//         var f = files[i]
//         var fileReader = new FileReader();
//         fileReader.onload = (function(e) {
//           var file = e.target;
//           $("<span class=\"pip\">" +
//             "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
//             "<br/><span class=\"remove\"><i class=\"fas fa-trash\" style=\"color: #464e5f;\"></i></span>" +
//             "</span>").insertAfter("#files");
//           $(".remove").click(function(){
//             $(this).parent(".pip").remove();
//           });
          
//           // Old code here
//           /*$("<img></img>", {
//             class: "imageThumb",
//             src: e.target.result,
//             title: file.name + " | Click to remove"
//           }).insertAfter("#files").click(function(){$(this).remove();});*/
          
//         });
//         fileReader.readAsDataURL(f);
//       }
//     });
//   } else {
//     alert("Your browser doesn't support to File API")
//   }
//   end of preview
            
            
            // to get file name
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
         $(this).closest("div").find('#file_name').text(fileName);
         $(this).siblings('.icon-delete').show();
    });
    
     $(".icon-delete").click(function(){
         $(this).closest("div").find("input").val('');
          $(this).closest("div").find('#file_name').text(langfilename);
          $(this).hide();

     });
});
    </script>
    
    
    <script>
        function checkSelection(radio) {
            if (radio.checked) {
                var div = document.getElementById('appearNext');
                div.classList.remove('hidden');
            }
        }
    </script>

@endpush