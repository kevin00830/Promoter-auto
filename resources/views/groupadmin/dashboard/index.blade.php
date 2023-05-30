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
    </style>
    
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid mx-lg-5 mt-lg-5 mt-md-5 pt-lg-5 pt-md-5">

            <div class="row mt-0 mt-lg-5 mt-md-5 pt-lg-3 pt-md-3">
                <div class="radset">
                    <div class="form-check">
                      <input class="form-check-input defcus" type="radio" id="def" name="radio" value="0" {{ $radio->gp_customized == 0 ? 'checked' : '' }}  >
                      <label class="form-check-label" for="default">{{ __('group.default') }}</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input defcus" type="radio" id="cus" name="radio" value="1" {{ $radio->gp_customized == 1 ? 'checked' : '' }}>
                      <label class="form-check-label" for="customized">{{ __('group.custom') }}</label><br><br>
                    </div>
                </div>
                <!-- @TODO -->
                <div class="col-lg-12">
                    <div class="container-fluid">
                       
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="default-tab" data-toggle="tab" data-target="#default" type="button" role="tab" aria-controls="default" aria-selected="true">{{__('group.defaultauto')}}</button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button class="nav-link" id="customized-tab" data-toggle="tab" data-target="#customized" type="button" role="tab" aria-controls="customized" aria-selected="false">{{__('group.custoauto')}}</button>
                              </li>
                              <!--<li class="nav-item" role="web">-->
                              <!--  <button class="nav-link" id="web-tab" data-toggle="tab" data-target="#web" type="button" role="tab" aria-controls="web" aria-selected="false">{{__('group.webauto')}}</button>-->
                              <!--</li>-->
                             
                            </ul>
                            
                            <div class="tab-content" id="myTabContent">
                              <div class="tab-pane fade show active" id="default" role="tabpanel" aria-labelledby="default-tab">
                                <div class="form-box">
                                 <div class="row form-group mb-15">
                                    <div class="col-lg-12 d-flex justify-content-between pb-3">
                                        <label style="font-weight: 600;font-size: 18px;">{{ __('group.greet') }}</label>
                                        
                                    </div>
                                    <div class="col-lg-6 col-md-8">
                                        <textarea class="form-control sms_body_main" rows="5" id="reply-main" data-id="{{$autoReplyMsg->id}}">{{ $autoReplyMsg->reply }}</textarea>
                                    </div>
                                    <?php
                                    $ex = explode("/",$autoReplyMsg->image_link);
                                    $namef = end($ex);
                                    ?>
                                    <div class="col-lg-6 col-md-4" style="display: grid;align-items: flex-end;justify-content: flex-start;">
                                        <label class="file-uploadtop">
                                        <input type="file" class="btn btn-primary file-upload__inputtop" id="main_img" />
                                        <span class="file-upload__labeltop">{{ __('group.select') }}</span>
                                        </label>
                                        <div style="display: flex;">
                                        <p>{{$namef?$namef:""}}</p>
                                        <button class="main-file-delete" data-id="{{$autoReplyMsg->id}}" style="@if(empty($namef)) display: none; @endif">
                                            <i class="fas fa-trash" style="color: #464e5f;"></i>
                                        </button>
                                        </div>
                                        <button type="button" class="btn btn-success" id="btn-save-main">
                                            <i class="fas fa-save"></i>{{ __('group.save') }}
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-15">
                                    <label style="font-weight: 600;font-size: 18px;" class="mb-5">{{ __('group.after_recive_head') }}</label>
                                
                                    <!--<div class="row form-check mb-2">-->
                                    <!--        <input type="radio" class="form-check-input auto_reply_setting" name="after_recive" value="0" <?=$settings->asking == 0?'checked':'' ?>>-->
                                    <!--        <label class="form-check-label">{{__('group.after_recive_1')}}</label>-->
                                    <!--</div>-->
                                    
                                    <!--<div class="row form-check mb-2">-->
                                    <!--        <input type="radio" class="form-check-input auto_reply_setting" name="after_recive" value="1" <?=$settings->asking == 1?'checked':'' ?> >-->
                                    <!--        <label class="form-check-label" >{{__('group.after_recive_2')}}</label>-->
                                    <!--</div>-->
                                    
                                    <!--<div class="row form-check mb-2">-->
                                    <!--        <input type="radio" class="form-check-input auto_reply_setting" name="after_recive" value="2" <?=$settings->asking == 2?'checked':'' ?>>-->
                                    <!--        <label class="form-check-label" >{{__('group.after_recive_3')}}</label>-->
                                    <!--</div>-->
                                  
                                     <div class="row form-check mb-2">
                                            <input type="checkbox" class="form-check-input auto_reply_setting" name="after_recive[]" data-order="0" value="name" <?= array_search("name", $ask) !== false ?'checked':''    ?> >
                                            <label class="form-check-label">{{__('group.name')}}</label>
                                    </div>
                                    
                                    <div class="row form-check mb-2">
                                            <input type="checkbox" class="form-check-input auto_reply_setting" name="after_recive[]" data-order="1" value="company" <?=   array_search("company", $ask)!== false?'checked':'' ?>  >
                                            <label class="form-check-label" >{{__('group.company')}}</label>
                                    </div>
                                    
                                    <div class="row form-check mb-2">
                                            <input type="checkbox" class="form-check-input auto_reply_setting" name="after_recive[]" data-order="2" value="dob" <?=    array_search("dob", $ask)!== false?'checked':'' ?> >
                                            <label class="form-check-label" >{{__('group.dob')}}</label>
                                    </div>
                                    
                                    
                                </div>
                               
                                
                                 <div class="row form-group mb-15">
                                    <div class="col-lg-12 d-flex justify-content-between pb-3">
                                        <label style="font-weight: 600;font-size: 18px;">{{ __('group.menutext') }}</label>
                                        
                                    </div>
                                    <div class="col-lg-6 col-md-8">
                                        <textarea class="form-control sms_body_main2" rows="5" id="reply-main-text" data-id="{{$autoReplyTEXT->id}}">{{ $autoReplyTEXT->reply }}</textarea>
                                    </div>
                                    <div class="col-lg-6 col-md-4" style="display: flex;align-items: flex-end;justify-content: flex-start;">
                                        <button type="button" class="btn btn-success" id="btn-save-main-2">
                                            <i class="fas fa-save"></i>{{ __('group.save') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 15px;">{{ __('group.table_title') }}</label>
                                            
                                            <table class="table table-bordered table-hover" id="tblOptions">
                                                <thead>
                                                <tr>
                                                    <th class="col-md-1 text-center">{{ __('group.order') }}</th>
                                                    <!--<th class="col-md-2 text-center">{{ __('group.keywords') }}</th>-->
                                                    <th class="col-md-6 text-center">{{ __('group.reply_msg') }}</th>
                                                    <th class="col-md-3 text-center">{{ __('group.file') }}</th>
                                                    <th class="col-md-2 text-center">
                                                        {{ __('group.actions') }}
                                                    </th>
                                                </tr>
                                                </thead>

                                                @if($autoReplyMsg->children)
                                                    <tbody id="tbodyOptions">
                                                    @foreach($autoReplyMsg->children as $optionMsg)
                                                        <tr class="reply-table-tr" data-id="{{ $optionMsg->id }}">
                                                            <td class="reply-table-td text-center col-md-1" >
                                                                <input type="number" class="reply-td-field form-control opt-order_num" value="{{ $optionMsg->order_num }}">
                                                            </td>
                                                            <!--<td class="reply-table-td">
                                                                <input type="text" class="reply-td-field form-control opt-keywords" value="{{ $optionMsg->keywords }}" readonly />
                                                            </td>-->
                                                            <td class="reply-table-td col-md-6" >
                                                                <textarea class="reply-td-field form-control opt-reply" id="sms_body_<?= $optionMsg->order_num ?>" rows="5">{{ $optionMsg->reply }}</textarea>
                                                            </td>
                                                            <!--emoji8467-->
                                                             <script>
                                                                 $(document).ready(function() {
                                                                     $("#sms_body_<?= $optionMsg->order_num ?>").emojioneArea({
                                                                         pickerPosition: "bottom",
                                                                         tonesStyle: "bullet"
                                                                     });
                                                                 });
                                                             </script>
                                                            <td class="reply-table-td col-md-3" >
                                                                <div class="file-drop-area justify-content-center">
                                                                   <?php 
                                                                   $extension = '';
                                                                   if(!empty($optionMsg->image_link)){
                                                                    $img_check =  explode('.',$optionMsg->image_link);
                                                                    
                                                                   $extension =  $img_check[count($img_check)-1];
                                                                    
                                                                   }
                                                                   ?>
                                                                    <div class="file-preview-div @if(empty($optionMsg->image_link)) no_img @endif" style="visibility:<?=  $extension == 'ogg'||$extension == 'mp4' ? 'hidden' : 'visible' ?>">
                                                                        <img class="file-preview-img" src="@if(empty($optionMsg->image_link))/images/blank.jpg @elseif($extension == 'pdf') /images/pdf.png  @else {{$optionMsg->image_link}} @endif" />
                                                                    </div>
                                                                    <label class="file-upload  @if(empty($optionMsg->image_link))  display_it @endif">
                                                                    <input type="file" data-id="{{ $optionMsg->id }}" class="file-input file-upload__input @if(empty($optionMsg->image_link))  display_it btn btn-primary @endif" accept=".jfif,.jpg,.jpeg,.png,.gif,.pdf,.ogg,.mp4" multiple style="z-index: 9999;">
                                                                    <span class="file-upload__label">{{ __('group.select') }}</span>
                                                                    </label>
                                                                    <p class="msgunique" data-id="{{ $optionMsg->id }}" >
                                                                        <?php 
                                                                        $expl = explode('/',$optionMsg->image_link);
                                                                        
                                                                        ?>
                                                                        {{$extension == 'ogg'? end($expl)  :''}}
                                                                        
                                                                    </p>
                                                                    <video class="vidunique" style="@if(empty($optionMsg->image_link)) visibility: hidden; @endif" src="@if($extension == 'mp4'){{$optionMsg->image_link}}  @endif"></video>
                                                                   
                                                                </div>
                                                                <button class="file-delete" style="@if(empty($optionMsg->image_link)) display: none; @endif">
                                                                    <i class="fas fa-trash" style="color: #464e5f;"></i>
                                                                </button>
                                                            </td>
                                                            <td class="align-middle text-center col-md-2" >
                                                                <button type="button" class="btn btn-success btn-save btn-sm" style="/*display: none;*/">
                                                                    {{ __('group.save') }}<!--<i class="fas fa-save"></i>-->
                                                                </button>
                                                                <button type="button" class="btn btn-primary btn-remove btn-sm">
                                                                    {{ __('group.remove') }}<!--<i class="fas fa-minus"></i>-->
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr style="height: 20px;"></tr>
                                                    @endforeach
                                                    </tbody>
                                                @endif
                                            </table>
                                        </div>
                                        <div class="row justify-content-end" style="margin: 0px;">
                                            <button type="button" class="btn btn-danger" id="btnAddOption">
                                                <i class="fas fa-plus" style="padding: 0;"></i>
                                            </button>
                                            
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <!--<div class="row justify-content-center" style="margin: 0px;">-->
                                <!--            <button type="button" class="btn btn-primary btn-block col-md-4" id="btnSaveNew">-->
                                <!--                Save To New Table-->
                                <!--            </button>-->
                                            
                                <!--</div>-->
                            </div>
                              
                              </div>
                              
                             
                           
                            
                            
                            
                            <div class="tab-pane fade" id="customized" role="tabpanel" aria-labelledby="customized-tab">
                                <div class="form-box">
                                    <form action="{{route('custom_json')}}" method="post">
                                        @csrf
                                        <textarea class="form-control" rows="7" name="json_text" id="" data-id="">@if($jsontext){{ $jsontext->json_text }}@endif</textarea>
                                        <div class="col-lg-12 col-md-12" style="display: flex;align-items: flex-end;justify-content: end;padding: 10px 0px;">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save"></i>{{ __('group.save') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="web" role="tabpanel" aria-labelledby="web-tab">
                                <div class="form-box">
                                    <form action="{{route('web_inte')}}" method="post" enctype="multipart/form-data">
                                     @csrf
                                    <div class="row padflex">
                                        <div class="col-md-6">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 15px;">1. Keyword</label>
                                            <input type="text" class="form-control" id="keywords-input" name="keyword"/>
                                        </div>
                                        <!--<div class="col-md-6">-->
                                        <!--    <button type="button" class="btn btn-success btnstyl" id="keyword"><i class="fas fa-save"></i>{{ __('group.save') }}</button>-->
                                        <!--</div>-->
                                    </div>
                                
                                    <div class="row padflex">
                                        <div class="col-md-6">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 15px;">2. Message </label>
                                            <textarea rows="4" class="form-control" id="reply-input" name="msg"></textarea>
                                        </div>
                                        <!--<div class="col-md-6" style="display:grid">-->
                                        <!--    <button type="button" class="btn btn-primary btnstyl">{{ __('group.select') }}</button>-->
                                        <!--    <button type="button" class="btn btn-success btnstyl"><i class="fas fa-save"></i>{{ __('group.save') }}</button>-->
                                        <!--</div>-->
                                    </div>
                                    
                                    <div class="row padflex">
                                        <div class="col-md-6">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 15px; display:block;">3.Questions/Do you want to ask </label>
                                            <div class="row form-check mb-2">
                                                <input type="checkbox" id="checkbox1" class="form-check-input auto_reply_setting" name="name" data-order="0" value="1">
                                                <label class="form-check-label">{{__('group.name')}}</label>
                                            </div>
                                                
                                            <div class="row form-check mb-2">
                                                <input type="checkbox" id="checkbox2" class="form-check-input auto_reply_setting" name="empress" data-order="1" value="1"  >
                                                <label class="form-check-label" >{{__('group.company')}}</label>
                                            </div>
                                                
                                            <div class="row form-check mb-2">
                                                <input type="checkbox" id="checkbox3" class="form-check-input auto_reply_setting" name="dob" data-order="2" value="1" >
                                                <label class="form-check-label" >{{__('group.dob')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                     <div class="row padflex">
                                        <div class="col-md-12">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 15px;">4. Buttons Blocks </label>
                                        </div>
                                        <div class="col-md-12 btninputpaddings">
                                            <div class="col-md-1" >
                                                <label class="form-check-label"> Block No.</label>
                                                <input type="text" name="blockno[]" class="form-control" value="1" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-check-label"> Block Title</label>
                                                <input type="text" name="block_title[]" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 btninputpaddings">
                                            <div class="col-md-2" >
                                                <label class="form-check-label"> Button 1 Name</label>
                                                <input type="text" name="btnname[0][]" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-check-label"> Button 2 Name</label>
                                                <input type="text" name="btnname[0][]" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-check-label"> Button 3 Name</label>
                                                <input type="text" name="btnname[0][]" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 btninputpaddings">
                                            <div class="col-md-2" >
                                                <label class="form-check-label">Message/Reply</label>
                                                <textarea rows="5" name="btnmsg[0][]" id="sms_body1" class="form-control"></textarea>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-check-label">Message/Reply</label>
                                                <textarea rows="5" id="sms_body2" name="btnmsg[0][]" class="form-control"></textarea>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-check-label">Message/Reply</label>
                                                <textarea rows="5" id="sms_body3" name="btnmsg[0][]" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12" style="display:flex">
                                            <div class="col-md-2" style="justify-content: center;display: flex;">
                                                <input type="file" name="btnimg[0][]" class="btn btn-primary "/>
                                                <!--<span class="file-upload__label">{{ __('group.select') }}</span>-->
                                            </div>
                                            <div class="col-md-2" style="justify-content: center;display: flex;">
                                                <input type="file" name="btnimg[0][]" class="btn btn-primary "/>                                            
                                            </div>
                                            <div class="col-md-2" style="justify-content: center;display: flex;">
                                                <input type="file" name="btnimg[0][]" class="btn btn-primary "/>
                                            </div>
                                        </div>
                                        
                                    <div class="col-md-12">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 15px;"></label>
                                        </div>
                                        <div class="col-md-12 btninputpaddings">
                                            <div class="col-md-1" >
                                                <label class="form-check-label"> Block No.</label>
                                                <input type="text" name="blockno[]" class="form-control" value="2" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-check-label"> Block Title</label>
                                                <input type="text" name="block_title[]" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 btninputpaddings">
                                            <div class="col-md-2" >
                                                <label class="form-check-label"> Button 1 Name</label>
                                                <input type="text" name="btnname[1][]" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-check-label"> Button 2 Name</label>
                                                <input type="text" name="btnname[1][]" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-check-label"> Button 3 Name</label>
                                                <input type="text" name="btnname[1][]" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 btninputpaddings">
                                            <div class="col-md-2" >
                                                <label class="form-check-label">Message/Reply</label>
                                                <textarea rows="5" id="sms_body9" name="btnmsg[1][]" class="form-control"></textarea>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-check-label">Message/Reply</label>
                                                <textarea rows="5" id="sms_body4" name="btnmsg[1][]" class="form-control"></textarea>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-check-label">Message/Reply</label>
                                                <textarea rows="5" id="sms_body5" name="btnmsg[1][]" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12" style="display:flex">
                                            <div class="col-md-2" style="justify-content: center;display: flex;">
                                                <input type="file" name="btnimg[1][]" class="btn btn-primary "/>
                                                <!--<span class="file-upload__label">{{ __('group.select') }}</span>-->
                                            </div>
                                            <div class="col-md-2" style="justify-content: center;display: flex;">
                                                <input type="file" name="btnimg[1][]" class="btn btn-primary "/>                                            
                                            </div>
                                            <div class="col-md-2" style="justify-content: center;display: flex;">
                                                <input type="file" name="btnimg[1][]" class="btn btn-primary "/>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <label style="font-weight: 600;font-size: 18px;margin-bottom: 15px;"></label>
                                        </div>
                                        <div class="col-md-12 btninputpaddings">
                                            <div class="col-md-1" >
                                                <label class="form-check-label"> Block No.</label>
                                                <input type="text" name="blockno[]" class="form-control" value="3" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-check-label"> Block Title</label>
                                                <input type="text" name="block_title[]" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 btninputpaddings">
                                            <div class="col-md-2" >
                                                <label class="form-check-label"> Button 1 Name</label>
                                                <input type="text" name="btnname[2][]" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-check-label"> Button 2 Name</label>
                                                <input type="text" name="btnname[2][]" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-check-label"> Button 3 Name</label>
                                                <input type="text" name="btnname[2][]" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 btninputpaddings">
                                            <div class="col-md-2" >
                                                <label class="form-check-label">Message/Reply</label>
                                                <textarea rows="5" id="sms_body6" name="btnmsg[2][]" class="form-control"></textarea>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-check-label">Message/Reply</label>
                                                <textarea rows="5" id="sms_body7" name="btnmsg[2][]" class="form-control"></textarea>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-check-label">Message/Reply</label>
                                                <textarea rows="5" id="sms_body8" name="btnmsg[2][]" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12" style="display:flex">
                                            <div class="col-md-2" style="justify-content: center;display: flex;">
                                                <input type="file" name="btnimg[2][]" class="btn btn-primary "/>
                                                <!--<span class="file-upload__label">{{ __('group.select') }}</span>-->
                                            </div>
                                            <div class="col-md-2" style="justify-content: center;display: flex;">
                                                <input type="file" name="btnimg[2][]" class="btn btn-primary "/>                                            
                                            </div>
                                            <div class="col-md-2" style="justify-content: center;display: flex;">
                                                <input type="file" name="btnimg[2][]" class="btn btn-primary "/>
                                            </div>
                                        </div>
                                    
                                    <div class="col-lg-12 col-md-12" style="display: flex;align-items: flex-end;justify-content: end;padding: 10px 0px;">
                                    <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save"></i>{{ __('group.save') }}
                                            </button>
                                        </div>
                                    </form>
                                    
                                </div>
                                <hr>
                                <div class="row padflex">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label style="font-weight: 600;font-size: 18px;margin-bottom: 15px;" for="flow">Select a flow:</label>
                                                <select class="form-control" id="flow" name="flow">
                                                    @foreach($flows as $flow)
                                                        <option value="{{ $flow->id }}">{{ $flow->keywords }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <hr>
                                <table class="table table-separate table-hover table-checkable" id="kt_datatable_users">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Keyword</th>
                                    <th>msg</th>
                                </tr>
                                </thead>
                                    @foreach($flows as $flow)
                                <tr>
                                    <td>{{$flow->id}}</td>
                                    <td>{{$flow->keywords}}</td>
                                    <td>{{$flow->reply}}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-btn" data-id="{{$flow->id}}">Edit</button>
                                    </td>
                                     <td>
                                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{$flow->id}}">Delete</button>
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
                            $('#keywords-input').val(response.flows.keywords);
                            $('#reply-input').val(response.flows.reply);
                            var name = response.flows.is_name;
                            var empress = response.flows.is_empress;
                            var dob = response.flows.is_dob;
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
                            $.each(response.blocks, function(index, item) {
                                  // Do something with each item in the response
                                   $('input[name="block_title[]"]').eq(index).val(item.block_title);
                                });
                            $.each(response.buttons, function(index, item2) {
                                  // Do something with each item in the response
                                 $('input[name="btnname[0][]"]').eq(index).val(item2.name);
                                 $('input[name="btnname[1][]"]').eq(index).val(item2.name);
                                 $('input[name="btnname[2][]"]').eq(index).val(item2.name);
                                 $('textarea[name="btnmsg[0][]"]').eq(index).val(item2.msg);
                                 $('textarea[name="btnmsg[1][]"]').eq(index).val(item2.msg);
                                 $('textarea[name="btnmsg[2][]"]').eq(index).val(item2.msg);
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
                            alert('Flow deleted successfully!');
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
        });
    </script>
     <link href="https://cdn.jsdelivr.net/gh/mervick/emojionearea@master/dist/emojionearea.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/gh/mervick/emojionearea@master/dist/emojionearea.min.js"></script>
     <!--emoji8467-->
     <script>
         $(document).ready(function() {
             $("#sms_body").emojioneArea({
                 pickerPosition: "bottom",
                 tonesStyle: "bullet"
             });
         });
         
         $(document).ready(function() {
             $("#sms_body1,#sms_body2,#sms_body3,#sms_body4,#sms_body5,#sms_body6,#sms_body7,#sms_body8,#sms_body9,.sms_body_main,.sms_body_main2").emojioneArea({
                 pickerPosition: "bottom",
                 tonesStyle: "bullet"
             });
         });
     </script>

@endpush