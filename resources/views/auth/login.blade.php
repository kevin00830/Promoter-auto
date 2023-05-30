<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Title -->
    <title>Login para Wi5</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Social tags -->
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,600,600i,700,700i" rel="stylesheet" />
    <!-- Bootstrap Css -->
    <link href="{{ asset('vendor/bootstrap/css') }}/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css') }}/custom.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<style>
ol#vid-list, ol#vid-list li a{
        background-color: #fdebef !important;
}

/* second slide start */
ol#vid-list li {
    height: 126px;
}
ol#vid-list li a {
    text-decoration: none;
    background-color: #222;
    height: 125px;
    width:100% !important;
    display: block;
    padding: 10px;
}
 #vid-list .desc {
    display:none !important;
}
.vid-list-container {
    height: auto !important;
}
.vid-thumb img{
    border-radius:4px;
}
/* second slide end */

    .encrypt {
        padding: 30px;   
    }
    
  
    .vid-container iframe, .vid-container object, .vid-container embed {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        min-height: 500px;
    }
    
    
    .vid-list-container {
       height: 120px;
        overflow: hidden;
    }
      .vid-list-container:hover, .vid-list-container:focus {
        overflow-x: auto;
    }
    
    ol#vid-list {
        margin: 0;
        padding: 0;
        background: #222;
        display:flex;
    }
    ol#vid-list li {
        list-style: none;
    }

    a {
        margin: 0;
        padding: 0;
        font-size: 100%;
        text-decoration: none;
        vertical-align: baseline;
        background: transparent;
    }
    a {
        color: #0d6efd;
        text-decoration: underline;
    }
    .clearfix::after {
        display: block;
        clear: both;
        content: "";
    }
    .vid-thumb {
        float: left;
        margin-right: 8px;
    }
    #vid-list .desc {
        color: #CACACA;
        font-size: 13px;
        margin-top: 5px;
    }
    ol#vid-list li a:hover {
        background-color: #666666;
    }
    ol#vid-list li a {

        padding: 10px;
    }
    a:hover {
        transform: scale(1.1);
        transition: 0.3s;
    }
    a:focus, a:hover {
        font-size: 100%;
        text-decoration: none;
        vertical-align: baseline;
        background: transparent;
    }
    a:hover {
        color: #0a58ca;
    }
    .my-float{
    	margin-top:16px;
    }
    .float{
	    position:fixed;
    	width:60px;
    	height:60px;
    	bottom:40px;
    	right:40px;
    	background-color:#25d366;
    	color:#FFF;
    	border-radius:50px;
    	text-align:center;
        font-size:30px;
    	box-shadow: 2px 2px 3px #999;
        z-index:100;
    }   
    .float:hover {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 40px;
        background-color: #25d366;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 2px 2px 3px #999;
        z-index: 100;
        color: #0a58ca;
    }
    .vid-main-wrapper {
        width: 100%;
       
        background: #fff;
        margin: 0 auto;
        display:inline-flex;
    }
     img#only_onload{
    height: 500px;
    width: auto;
    max-width: unset;
    }
    .vid-des h1{
    font-size: 70px;
    font-family: 'Cooper';
    color: #f96116;
    padding-bottom:35px;
    }
    .vid-des p{
    font-size: 20px;
    font-family: 'Arial';
    font-weight: 520;
        padding-right: 170px;
    }
      .vid-des{
    padding:20px;
    }
    
       @media only screen and (min-width: 1400px) {
         .vid-main-wrapper{
              grid-template-columns: 1fr 1fr;
         }
          
     }
      @media only screen and (min-width: 1200px) and (max-width:1400px) {
         .vid-main-wrapper{
              grid-template-columns: 800px 1fr;
         }
         
         img#only_onload{
             max-width: 100% !important;
         }
          
     }
     
      @media only screen and (min-width: 800px) and (max-width:1200px) {
         .vid-main-wrapper{
              grid-template-columns: 600px 1fr;
         }
         
         img#only_onload{
             max-width: 100% !important;
                 height: auto !important;
         }
          
     }
     
       @media only screen and (max-width:800px){
       
         
          .vid-main-wrapper{
              grid-template-columns: 1;
         }
         
          img#only_onload{
             max-width: 100% !important;
                 height: auto !important;
         }
          
     }
     @media (max-width: 600px) {
    .vid-main-wrapper{
        display:grid;
    }
    .infodiv {
        padding-top: 30px;
}
.vidd{
    display:grid !important;
}
.vidcss{
    width:100%;
}
.vid-des p{
    padding-right:0px;
}
.vid-des h1{
    font-size:50px;
}

    }
     
     .back_link {
    color: black;
    font-weight: 500;
     text-decoration: none; 
    border-bottom: 1px solid black;
}
     
     .main_row {
    align-items: end;
}
     .main_row > div:nth-child(1) {
    padding:30px 0px;
    
}
  .main_row > div:nth-child(2) > .row {
    align-items: end;
    
}
.infobtn{
        background-color: yellow;
    color: #0f2249;
    width: 210px;
    display: inline-block;
    text-align: center;
    border-radius: 20px;
    text-decoration: none;
    padding: 0.45rem 1.5rem;
    margin: 0 0 0 0px;
    font-size: 16px;
    font-weight: bolder;
    font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
}
.infodiv{
    padding:90px 0px 10px;;
    display: flex;
    justify-content: center;
}
.vidd{
    display:flex;
}
 
 .vid-scroller #vid-list{
     overflow-x:auto;
 }  
 
 @media only screen and (max-width:991px){
     .how-it-works2-row{
         flex-direction:column-reverse;
     }
     .how-it-works2-row .col-works-2{
         text-align:end;
     }
     
     .back_tomain{
             padding: 16px 15px !important;
     }
 }
 .login-page-v2 .login-btn {
    background: #212121;
    color: white;
    border: 0px;
    border-radius: 5px;
    line-height: 0px;
    height: 38px;
    padding: 0.3629rem 0;
    font-weight: 600;
    width: 100%;
    text-align: center;
}
 .navbar-form {
    margin: 0px;
    padding: 0px;
    height: 40px !important;
}
.login-btn{
    line-height: 30px; 
}
.login-page-v2 .login-btn:hover {
    background: #111111;
}
</style>
<body>
    
    
<nav class="navbar navbar-inverse bg-danger">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/"><img src="{{URL::asset('/images/notifire_transparent.png')}}" width="45px" onmouseover="get_moadal()" ></a>
    </div>

    <!-- <ul class="nav navbar-nav navbar-right"> -->
        <form action="{{ route('login') }}" method="POST" class="navbar-form navbar-right d-flex m-0 p-0">
               @csrf
               <div class="login-form-group col-lg-4 col-md-6 mt-sm-2 mt-md-0 col-sm-6 col-6">
                   <!-- <label for="login">{{ __('auth.group_name') }}</label> -->
                   <input type="text" name="login" id="login" class="form-control" placeholder="{{ __('auth.username') }}" value="{{ old('login') }}" />
                    @if ($errors->has('login'))
                    <span class="text-danger">Este campo 谷 obrigat車rio.</span>
                    @endif
               </div>
    
                <div class="login-form-group col-lg-4 col-sm-4 col-4">
                   <!-- <label for="password">{{ __('auth.password') }}</label> -->
                   <input type="password" name="password" id="password" placeholder="{{ __('auth.password') }}" class="form-control"
                       value="{{ old('password') }}" />
                    @if ($errors->has('password'))
                    <span class="text-danger">Por favor insira a senha.</span>
                    @endif
                </div>
             
               <!--<div class="login-form-group col-lg-2 pt-4 d-flex justify-content-between align-items-center d-lg-inline-block">-->
               <!--    <label class="color-checkbox primary-color">{{ __('auth.remember_me') }}-->
               <!--        <input type="checkbox" name="remember" />-->
               <!--        <span class="checkmark"></span>-->
               <!--    </label><br>-->
               <!--    <a href="" class="forgot">{{ __('auth.forgot_password') }}</a>-->
               <!--</div>-->

               <button type="submit" class="login-btn col-3 mr-1" >{{ __('auth.login') }}</button>

        </form>
    <!-- </ul> -->
    <!-- Lang Switch -->
   <ul class="nav navbar-nav navbar-right">
       <li>
           <a href="{{ url('lang', 'en') }}">
               <img class="me-2" src="{{ asset('images/flag_usa.png') }}" width="30" />
           </a>
       </li>
       
       <li>
           <a href="{{ url('lang', 'pt') }}">
               <img src="{{ asset('images/flag_brazil.png') }}" width="30" />
           </a>
       </li> 
   </ul>
   <!-- /. Lang Switch -->
    
  </div>
</nav>

   <!-- Login failed alert -->
   @if ($errors->has('login_failed'))
    <div class="alert alert-danger d-flex alert-dismissible fade show">
        {{ $errors->first('login_failed') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    
    
    
    

    <!-- THE PLAYLIST -->
                           <div class="vid-list-container vid-scroller">
                    <ol id="vid-list">
                        <li>
                            <a href="https://youtube.com/embed/Q6I2roEgFOc?autoplay=1&rel=0&showinfo=0&autohide=1" target="_BLANK">
                                <span class="vid-thumb"><img width=140 src="https://notifire-api.com/youtubecover/auto_integrador_desktop.jpg" /></span>
                                
                            </a>
                        </li>

    <li>
                                    <a href="https://youtube.com/embed/SJAOGhq2vME?autoplay=1&rel=0&showinfo=0&autohide=1" target="_BLANK">
                                        <span class="vid-thumb"><img width=140 src="https://notifire-api.com/youtubecover/recomendacoes.jpg" /></span>
                                    
                                    </a>
                                </li>

  <li>
                                    <a href="https://youtube.com/embed/Yc7Rr8NCzGg?autoplay=1&rel=0&showinfo=0&autohide=1" target="_BLANK">
                                        <span class="vid-thumb"><img width=140 src="https://notifire-api.com/youtubecover/desktop.jpg" /></span>
                                        
                                    </a>
                                </li>


            <li>
                                    <a href="https://youtube.com/embed/4GQwSl-KO_A?autoplay=1&rel=0&showinfo=0&autohide=1" target="_BLANK">
                                        <span class="vid-thumb"><img width=140 src="https://notifire-api.com/youtubecover/tutorialwhatsappwindows.jpg" /></span>
                                        
                                    </a>
                                </li>                                  
                           
                                                
                                
                            </ol>
                        </div>
    <section class="encrypt">
        <div class="container">
             <div class="row">
            <!--img src="https://321bots.com/images/banner.jpg" class="login_banner_img" width="100%" /-->
            
                <div class="col-md-8 col-12 col-sm-12">
                    <div class="vid-des">
                    <h1>{{ __('auth.genhe') }}</h1>
                    <p> {{ __('auth.subtitle_desc') }}</p>
                    </div>
                </div>

                <!-- THE PLAYLIST -->
                <div class="col-md-4 col-12 col-sm-12">
                <video class="vidcss" width="400" height="290" controls autoplay muted>
                  <source src="https://321autoreply.com/video_atendimentoautomatico.mp4" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
                </div>
                <!-- THE YOUTUBE PLAYER -->
                <!--<div class="vid-container">-->
                <!--    <img src="https://321dbase.com/0/banners/leads.jpg" id="only_onload"/>-->
                <!--    <iframe id="vid_frame" style="display:none" src="https://321dbase.com/0/banners/leads.jpg" frameborder="0" width="560" height="315"></iframe>-->
                <!--</div>-->

                <div class="infodiv">
            <a class="infobtn" href="https://api.whatsapp.com/send?phone=5511951215800&amp;text=Ol%C3%A1%2C%20gostaria%20de%20saber%20mais%20sobre%20as%20solu%C3%A7%C3%B5es%20e%20planos%20da%20plataforma.%0A" target="_blank" style="cursor: pointer;">
          {{ __('auth.contactbtn') }}
            </a>
        </div>
            
        </div>
        </div>
    </section>
    <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="vid-container">
                    <iframe id="vid_frame" style="display:none" src="" frameborder="0" width="560" height="315"></iframe>
                </div>
        </div>
        
      </div>
    </div>
  </div>
    <section class="encrypt grey_box">
        <div class="container">
            <div class="row">
                <h3>{{__('auth.maintitle')}} </h3>
                <p>{{__('auth.mainsubtitle')}} </p>
            </div>
        </div>
    </section>
    <section class="encrypt lrboxes">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h4><span style="font-size: 36px;">1.</span>{{__('auth.1title')}} </h4>
                    <p>{{__('auth.1subtitle')}}</p>
                    <p style="font-size: 15px;">{{__('auth.1body')}}</p>
                </div>
                <div class="col-lg-6 text_right">
                    <img src="{{ asset(__('auth.1banner')) }}" width="100%" />
                </div>
            </div>
        </div>
    </section>
    <section class="encrypt">
        <div class="col-lg-12 text-center">
            <img class="separat" src="{{ asset('images/separator-ltr.svg') }}" width="100%" />
        </div>
    </section>
    <section class="encrypt lrboxes">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-left order2">
                    <img src="{{ asset(__('auth.1banner')) }}" width="100%" />
                </div>
                <div class="col-lg-6">
                    <h4><span style="font-size: 36px;">2.</span>{{__('auth.2title')}} </h4>
                    <p>{{__('auth.2subtitle')}}</p>
                    <p style="font-size: 15px;">{{__('auth.2body')}}</p>
                </div>
            </div>
        </div>
    </section>
    <section class="encrypt">
        <div class="col-lg-12 text-center">
            <img class="separat" src="{{ asset('images/separator-ltr.svg') }}" width="100%" />
        </div>
    </section>
    <section class="encrypt lrboxes">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h4><span style="font-size: 36px;">3.</span>{{__('auth.3title')}} </h4>
                    <p>{{__('auth.3subtitle')}}</p>
                    <p style="font-size: 15px;">{{__('auth.3body')}}</p>
                </div>
                <div class="col-lg-6 text_right">
                    <img src="{{ asset('images/howto-encryption_on_client_side.svg') }}" width="100%" />
                </div>
            </div>
        </div>
    </section>
    <section class="lrboxes section">
        <div class="container">
            <div class="row">
                <h2 class="text-center p-4">{{__('auth.10title')}}</h2>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="yellowbox">
                        <p><b>{{__('auth.10subtitle_a')}}</b> </p>
                        <p>{{__('auth.10body_a')}}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="yellowbox">
                        <p><b>{{__('auth.10subtitle_b')}}</b> </p>
                        <p>{{__('auth.10body_b')}}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="yellowbox">
                        <p><b>{{__('auth.10subtitle_c')}}</b> </p>
                        <p>{{__('auth.10body_c')}}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="yellowbox">
                        <p><b>{{__('auth.10subtitle_d')}}</b> </p>
                        <p>{{__('auth.10body_d')}}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="yellowbox">
                        <p><b>{{__('auth.10subtitle_e')}}</b> </p>
                        <p>{{__('auth.10body_e')}}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="yellowbox">
                        <p><b>{{__('auth.10subtitle_f')}}</b> </p>
                        <p>{{__('auth.10body_f')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--<section class="section grey_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="imgboxes">
                        <div class="d-flex gap-3">
                            <img src="{{ asset('images/icon-secure-silver.svg') }}" />
                            <div>
                                <h2>Secure Data Collection</h2>
                                <p>
                                    Collect information securely with advanced encryption technology. Protect your
                                    business data effortlessly.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="imgboxes">
                        <div class="d-flex gap-3">
                            <img src="{{ asset('images/icon-secure-silver.svg') }}" />
                            <div>
                                <h2>Secure Data Collection</h2>
                                <p>
                                    Collect information securely with advanced encryption technology. Protect your
                                    business data effortlessly.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="imgboxes">
                        <div class="d-flex gap-3">
                            <img src="{{ asset('images/icon-secure-silver.svg') }}" />
                            <div>
                                <h2>Secure Data Collection</h2>
                                <p>
                                    Collect information securely with advanced encryption technology. Protect your
                                    business data effortlessly.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    @include('layouts.modals.lmodal')
    
    <!-- Bootstrap JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor') }}/bootstrap/js/bootstrap.bundle.js"></script>
<script>
    $(document).ready(function () {
        $('.vid-item').each(function(index){
            $(this).on('click', function(){
                var current_index = index+1;
                $('.vid-item .thumb').removeClass('active');
                $('.vid-item:nth-child('+current_index+') .thumb').addClass('active');
            });
        });
    });
       function TurnVideo(src){
        document.getElementById('vid_frame').src=src;
        document.getElementById('vid_frame').style.display = 'block';
        document.getElementById('only_onload').style.display = 'none';
        
    }
</script>
</body>

</html>