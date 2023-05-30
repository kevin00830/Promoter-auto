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
    padding:20px;
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
                                <button class="nav-link" id="customized-tab" data-toggle="tab" data-target="#customized" type="button" role="tab" aria-controls="customized" aria-selected="false">{{__('group.connection_info')}}</button>
                              </li>
                            </ul>
                            
                            <div class="tab-content" id="myTabContent">

                            
                             <div class="tab-pane   fade show active" id="customized" role="tabpanel" aria-labelledby="customized-tab">
                                                                     <div class="form-box">
                                     <form action="{{route('main_web_inte')}}" method="post" enctype="multipart/form-data">
                                     @csrf
                                    <div class="row padflex hideall">
                                          <div class="col-md-6" id="messagE_box">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 5px;">{{__('group.your_url')}} </label>
                                        </div>
                                        
                                         </div>
                                        <div class="row padflex hideall">
                                             <div class="col-md-6" id="messagE_box">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 5px;">{{__('group.monetize_token')}} </label>
                                             <input type="text" class="form-control" id="keywords-input-main" name="keyword"/>
                                        </div>
                                        <div class="col-md-6" id="messagE_box">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save"></i>{{ __('group.save') }}
                                            </button>
                                        </div>
                                         </div>
                                         
                                          
                                    </form>
                                    </div>
                                     </div>
                                      </div>
                                      <br>
                                 <!--new box end-->
                       
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                            
                             <li class="nav-item" role="presentation">
                                <button class="nav-link" id="customized-tab" data-toggle="tab" data-target="#customized" type="button" role="tab" aria-controls="customized" aria-selected="false">{{__('group.ul_monetizze')}}</button>
                              </li>
                            </ul>
                            
                            <div class="tab-content" id="myTabContent">

                            
                             <div class="tab-pane   fade show active" id="customized" role="tabpanel" aria-labelledby="customized-tab">
                                
                                <div class="form-box">
                                     <form action="{{route('submitdata')}}" method="post" enctype="multipart/form-data">
                                     @csrf
                                  
                                    
                                <input type="hidden" name="setting" value="monetizze">
                                  
                                    
                                
                                
                                     <div class="row padflex hideall">
                                          <div class="col-md-6" id="messagE_box">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 5px;">{{__('group.finalized')}} </label>
                                            <textarea rows="4" class="form-control sms_body_web" id="reply-input-main" name="finalized">{{$data->finalized}}</textarea>
                                        </div>
                                        
                                         </div>
                                        <div class="row padflex hideall">
                                             <div class="col-md-6" id="messagE_box">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 5px;">{{__('group.canceled')}} </label>
                                            <textarea rows="4" class="form-control sms_body_web" id="reply-input-main" name="canceled">{{$data->canceled}}</textarea>
                                        </div>
                                         </div>
                                          <div class="row padflex hideall">
                                             <div class="col-md-6" id="messagE_box">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 5px;">{{__('group.waiting')}} </label>
                                            <textarea rows="4" class="form-control sms_body_web" id="reply-input-main" name="waiting">{{$data->waiting}}</textarea>
                                        </div>
                                         </div>
                                         <div class="row padflex hideall">
                                             <div class="col-md-6" id="messagE_box">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 5px;">{{__('group.blocked')}} </label>
                                            <textarea rows="4" class="form-control sms_body_web" id="reply-input-main" name="blocked">{{$data->blocked}}</textarea>
                                        </div>
                                         </div>
                                         <div class="row padflex hideall">
                                             <div class="col-md-6" id="messagE_box">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 5px;">{{__('group.completed')}} </label>
                                            <textarea rows="4" class="form-control sms_body_web" id="reply-input-main" name="completed">{{$data->completed}}</textarea>
                                        </div>
                                         </div>

                                      
                                        <div class="col-lg-12 col-md-12" style="display: flex;align-items: flex-end;justify-content: end;padding: 10px 0px;">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save"></i>{{ __('group.save') }}
                                            </button>
                                        </div>
                                         
                                    </form>
                                    </div>
                                    
                                    <br>
                                    <br>
                                    
                               
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
    
     <script>
     $(document).ready(function() {
             $(".sms_body_web").emojioneArea({
                 pickerPosition: "bottom",
                 tonesStyle: "bullet"
             });
         });
     
     </script>



@endpush