@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    <style>
        .new-row {
            background: #f1dae1;
        }
        .reply-table-td {
            position: relative;
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
            width: 80%;
            max-width: 80%;
            border: 1px dashed rgba(255, 255, 255, 0.4);
            border-radius: 3px;
            transition: .2s
        }
        .file-preview-img {
            height: 75px;
        }
        .file-input {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 80%;
            cursor: pointer;
            opacity: 0
        }
        .file-delete {
            right: 0;
            position: absolute;
            border: 0;
            top: 0;
            padding-top: 8px;
            width: 25px;
        }
    </style>
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid mx-lg-5">
            <div class="row"><h1>Beta version</h1></div>
            <div class="row mt-0 mt-lg-3">
                <!-- @TODO -->
                <div class="offset-lg-2 col-lg-8">
                    <div class="row form-group">
                        <div class="col-lg-12 d-flex justify-content-between pb-3">
                            <label>Greetings Message</label>
                            <button type="button" class="btn btn-success" id="btn-save-main" style="display: none;">
                                <i class="fas fa-save"></i>Save
                            </button>
                        </div>
                        <textarea class="form-control" rows="10" id="reply-main">{{ $autoReplyMsg->reply }}</textarea>
                    </div>
                    <div class="row">
                        <div class="offset-lg-1 col-lg-11">
                            <div class="row">
                                <table class="table table-bordered table-hover" id="tblOptions">
                                    <thead>
                                    <tr>
                                        <th class="col-md-1">Order:</th>
                                        <th class="col-md-2">Keywords:</th>
                                        <th class="col-md-5">Reply Message:</th>
                                        <th class="col-md-2">File:</th>
                                        <th class="text-center">
                                            Actions:
                                        </th>
                                    </tr>
                                    </thead>

                                    @if($autoReplyMsg->children)
                                        <tbody id="tbodyOptions">
                                        @foreach($autoReplyMsg->children as $optionMsg)
                                            <tr style="height: 100px;" class="reply-table-tr" data-id="{{ $optionMsg->id }}">
                                                <td class="reply-table-td">
                                                    <input type="number" class="reply-td-field form-control opt-order_num" value="{{ $optionMsg->order_num }}">
                                                </td>
                                                <td class="reply-table-td">
                                                    <input type="text" class="reply-td-field form-control opt-keywords" value="{{ $optionMsg->keywords }}" />
                                                </td>
                                                <td class="reply-table-td">
                                                    <textarea class="reply-td-field form-control opt-reply" rows="4">{{ $optionMsg->reply }}</textarea>
                                                </td>
                                                <td class="reply-table-td">
                                                    <div class="file-drop-area justify-content-center">
                                                        <div class="file-preview-div">
                                                            <img class="file-preview-img" src="@if(empty($optionMsg->image_link))/images/blank.jpg @else {{$optionMsg->image_link}} @endif" />
                                                        </div>
                                                        <input type="file" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif" multiple>
                                                    </div>
                                                    <button class="file-delete" style="@if(empty($optionMsg->image_link)) display: none; @endif">
                                                        <i class="fas fa-trash" style="color: #464e5f;"></i>
                                                    </button>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <button type="button" class="btn btn-success btn-save" style="display: none;">
                                                        <i class="fas fa-save"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-primary btn-remove">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                            <div class="row">
                                <button type="button" class="btn btn-danger" id="btnAddOption">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <span class="mt-3 ml-2">Add Answers / Options</span>
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
            $('#btnAddOption').on('click', function() {
                if($('.new-row')[0]) {
                    alert('Already exist new editing option');
                    return;
                }
                var htmlAdded = '<tr class="reply-table-tr new-row" style="height: 100px;" data-id="0"> \
                        <td class="reply-table-td"> \
                            <input type="number" class="reply-td-field form-control opt-order_num" value="0"> \
                        </td> \
                        <td class="reply-table-td"> \
                            <input type="text" class="reply-td-field form-control opt-keywords" value="" /> \
                        </td> \
                        <td class="reply-table-td"> \
                            <textarea class="reply-td-field form-control opt-reply" rows="4"></textarea> \
                        </td> \
                        <td class="reply-table-td"> \
                            <div class="file-drop-area justify-content-center"> \
                                <div class="file-preview-div"> \
                                    <img class="file-preview-img" src="/images/blank.jpg" /> \
                                </div> \
                                <input type="file" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif" multiple> \
                            </div> \
                            <button class="file-delete" style="display: none;"><i class="fas fa-trash" style="color: #464e5f;"></i></button> \
                        </td> \
                        <td class="align-middle text-center"> \
                            <button type="button" class="btn btn-success btn-save" style="display: none;"> \
                                <i class="fas fa-save"></i> \
                            </button> \
                            <button type="button" class="btn btn-primary btn-remove"> \
                                <i class="fas fa-minus"></i> \
                            </button> \
                        </td> \
                    </tr>';
                $('#tbodyOptions').append(htmlAdded);
            });

            $('#tblOptions').on('keypress', '.reply-td-field', function(e) {
                $(this).closest('.reply-table-tr').find('.btn-save').show();
            });

            $('#tblOptions').on('click', '.btn-save', function(e) {
                var that = $(this);
                var trSelected = $(this).closest('.reply-table-tr');
                var imgSelected = trSelected.find('.file-preview-img');
                var postData = {
                    _token: csrfToken,
                    id: trSelected.data('id'),
                    order_num: trSelected.find('.opt-order_num').val(),
                    keywords: trSelected.find('.opt-keywords').val(),
                    reply: trSelected.find('.opt-reply').val(),
                    image_link: imgSelected.attr('src'),
                    fImage: 0,  // image not chaged
                };
                if(imgSelected.hasClass('changed')) {
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
                    success: function (data) {
                        console.log('ajax_save_option', data);
                        if(data.success) {
                            if(trSelected.data('id') === 0) {
                                trSelected.data('id', data.data.id);
                                trSelected.removeClass('new-row');
                                alert('Successfully added');
                            } else {
                                alert('Successfully updated');
                            }
                            that.closest('.reply-table-tr').find('.file-preview-img').removeClass('changed');
                            that.closest('.reply-table-tr').find('.file-preview-img').removeClass('removed');
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
                        dataType: 'JSON',
                        success: function (data) {
                            console.log('ajax_del_option', data);
                            if (data.success) {
                                alert('Successfully removed');
                                trSelected.remove();
                            } else {
                                alert(data.message);
                            }
                        }
                    });
                } else {
                    trSelected.remove();
                }
            });

            $('#tblOptions').on('click', '.file-delete', function(e) {
                var trSelected = $(this).closest('.reply-table-tr');
                trSelected.find('.file-preview-img').addClass('removed');
                trSelected.find('.btn-save').show();
            });

            $('#reply-main').on('keypress', function(e) {
               $('#btn-save-main').show();
            });

            $('#btn-save-main').on('click', function(e) {
                var that = $(this);
                $.ajax({
                    url: '{{ route('ajax.message.save_main') }}',
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        reply: $('#reply-main').val()
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        console.log('ajax_save_main', data);
                        alert('Successfully saved');
                        that.hide();
                    }
                });
            });

            $('#tblOptions').on('change', '.file-input', function() {
                var filesCount = $(this)[0].files.length;
                var textbox = $(this).prev();
                if (filesCount === 1) {
                    var fileName = $(this).val().split('\\').pop();
                    //textbox.text(fileName);
                } else {
                    //textbox.text(filesCount + ' files selected');
                }

                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $(this).prev();
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var imgPreview = dvPreview.find('.file-preview-img');
                            imgPreview.attr("src", e.target.result);
                            imgPreview.removeClass('removed');
                            imgPreview.addClass('changed');
                            dvPreview.closest('.reply-table-tr').find('.btn-save').show();
                            dvPreview.closest('.reply-table-tr').find('.file-delete').show();
                        }
                        reader.readAsDataURL(file[0]);
                    });
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
@endpush