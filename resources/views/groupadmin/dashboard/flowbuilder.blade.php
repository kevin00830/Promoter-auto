<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" theme="wi5-v1">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Title -->
    <title>{{ "DashBoard - Wi5" }} - {{ env('APP_NAME') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Social tags -->
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}" />

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!-- Theme Styles -->
    <link href="{{ asset('plugins/global') }}/plugins.bundle.css?v=1.0.0" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins') }}/prismjs/prismjs.bundle.css?v=1.0.0" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css') }}/style.bundle.css?v=1.0.0" rel="stylesheet" type="text/css" />

    {{--    extern css files--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/jerosoler/Drawflow/dist/drawflow.min.css">
    <script src="https://cdn.jsdelivr.net/gh/jerosoler/Drawflow/dist/drawflow.min.js"></script>
    <script src="dist/drawflow.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="src/drawflow.css" />
    <link rel="stylesheet" type="text/css" href="docs/beautiful.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- Custom Style -->
    <link href="{{ asset('css') }}/custom.css" rel="stylesheet" type="text/css" />

    @stack('css')
    <style>
        .header-tabs .nav-item .nav-link {

            padding:12px !important;
            font-size:15px;

        }
    </style>
    <script>var csrfToken = '{{ csrf_token() }}';</script>
    <!-- /. -->
</head>
<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
<div id="loader" style="display: block;">
    <div><img src="{{ asset('images/bars.svg') }}"><br><span></span></div>
</div>

<!-- Mobile Header -->
@include('layouts.mobile_header')
<!-- /. Mobile Header -->

<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">
        <!-- Wrapper -->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

            <!-- Main content -->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <div class="wrapper">
                    <div class="col">
                        <div class="drag-drawflow" draggable="true" ondragstart="drag(event)" data-node="menublock">
                            <i class="fas fa-file-alt" style="width: 10px;"></i><span>&nbsp; Menu</span>
                        </div>
                        <div class="drag-drawflow" draggable="true" ondragstart="drag(event)" data-node="template">
                            <i class="fas fa-file-alt" style="width: 10px;"></i><span>&nbsp; Generic Template</span>
                        </div>
                        <div class="drag-drawflow" draggable="true" ondragstart="drag(event)" data-node="audio">
                            <i class="fas fa-volume-up" style="width: 10px;"></i><span>&nbsp; Audio</span>
                        </div>
                        <div class="drag-drawflow" draggable="true" ondragstart="drag(event)" data-node="name">
                            <i class="fas fa-user" style="width: 10px;"></i><span>&nbsp; Ask for Name</span>
                        </div>
                        <div class="drag-drawflow" draggable="true" ondragstart="drag(event)" data-node="dob">
                            <i class="fas fa-calendar-alt" style="width: 10px;"></i><span>&nbsp; Ask for dob (dd-mm)</span>
                        </div>
                        <div class="drag-drawflow" draggable="true" ondragstart="drag(event)" data-node="company">
                            <i class="fas fa-building" style="width: 10px;"></i><span>&nbsp; Ask for Company</span>
                        </div>
                        <div class="drag-drawflow" draggable="true" ondragstart="drag(event)" data-node="email">
                            <i class="far fa-envelope" style="width: 10px;"></i><span>&nbsp; Ask for Email</span>
                        </div>
                        <div class="drag-drawflow" draggable="true" ondragstart="drag(event)" data-node="street">
                            <i class="fas fa-map-marker-alt" style="width: 10px;"></i><span>&nbsp; Ask for Street</span>
                        </div>
                        <div class="drag-drawflow" draggable="true" ondragstart="drag(event)" data-node="number">
                            <i class="fas fa-sort-numeric-up" style="width: 10px;"></i><span>&nbsp; Ask for Number</span>
                        </div>
                        <div class="drag-drawflow" draggable="true" ondragstart="drag(event)" data-node="complement">
                            <i class="fas fa-thumbtack" style="width: 10px;"></i><span>&nbsp; Ask for Complement</span>
                        </div>
                        <div class="drag-drawflow" draggable="true" ondragstart="drag(event)" data-node="district">
                            <i class="fas fa-road" style="width: 10px;"></i><span>&nbsp; Ask for District</span>
                        </div>
                        <div class="drag-drawflow" draggable="true" ondragstart="drag(event)" data-node="zipcode">
                            <i class="fas fa-map-pin" style="width: 10px;"></i><span>&nbsp; Ask for ZipCode</span>
                        </div>
                        <div class="drag-drawflow" draggable="true" ondragstart="drag(event)" data-node="city">
                            <i class="fas fa-city" style="width: 10px;"></i><span>&nbsp; Ask for City</span>
                        </div>
                        <div class="drag-drawflow" draggable="true" ondragstart="drag(event)" data-node="country">
                            <i class="fas fa-globe-americas" style="width: 10px;"></i><span>&nbsp; Ask for Country</span>
                        </div>
                        <div class="drag-drawflow" draggable="true" ondragstart="drag(event)" data-node="genricinput">
                            <i class="fas fa-globe-americas" style="width: 10px;"></i><span>&nbsp; Generic Input</span>
                        </div>
                    </div>
                    <div class="col-right">

                        <div class="btn-clear btn btn-primary btn-lg" onclick="editor.clearModuleSelected()">{{__('group.clear')}}</div>
                        <input class="btn-import btn btn-primary btn-lg" type="button" name="importJson" onchange="importJson(this.value)" value="{{__('group.import')}}" data-toggle="modal" data-target="#importModal">
                        <div class="btn-export btn btn-primary btn-lg" onclick="exportJson()" data-toggle="modal" data-target="#exportModal">{{__('group.export')}}</div>
                        <div class="btn-save btn btn-primary btn-lg" data-toggle="modal" data-target="#saveModal">{{__('group.save')}}</div>

                        <div id="drawflow" ondrop="drop(event)" ondragover="allowDrop(event)">
                            <div class="btn-lock">
                                <i id="lock" class="fas fa-lock" onclick="editor.editor_mode='fixed'; changeMode('lock');"></i>
                                <i id="unlock" class="fas fa-lock-open" onclick="editor.editor_mode='edit'; changeMode('unlock');" style="display:none;"></i>
                            </div>
                            <div class="bar-zoom">
                                <i class="fas fa-search-minus" onclick="editor.zoom_out()"></i>
                                <i class="fas fa-search" onclick="editor.zoom_reset()"></i>
                                <i class="fas fa-search-plus" onclick="editor.zoom_in()"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Save Buton Modal -->
                <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{__('group.save_modal_msg')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="addFlowData()">{{__('group.save')}}</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Export Buton Modal -->
                <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{__('group.export_modal_msg')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Import Buton Modal -->
                <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /. Main content -->

            <!-- Footer -->
            @include('layouts.footer')
            <!-- /. Footer -->
        </div>
        <!-- End Wrapper -->
    </div>
</div>

<!-- Quick User Side Panel -->
@include('layouts.components.quick_user_panel')
<!-- /. -->

@auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
        @csrf
    </form>
@endauth

<!-- Global Config(global config for global JS scripts) -->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
<!-- Global Config -->
<!-- Theme Bundle -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('plugins/global') }}/plugins.bundle.js?v=1.0.0"></script>
<script src="{{ asset('plugins') }}/prismjs/prismjs.bundle.js?v=1.0.0"></script>
<script src="{{ asset('js') }}/scripts.bundle.js?v=1.0.0"></script>
<script src="{{ asset('js/init.js') }}"></script>

<script>
    window.onload = function () {
        // preloader fadeout onload
        var preloader = document.querySelector('#loader');
        if (preloader) {
            document.querySelector('#loader').style.display = 'none';
        }
    }
</script>

{{--extern js files--}}
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>

    var id = document.getElementById("drawflow");
    const editor = new Drawflow(id);
    editor.reroute = true;
    editor.reroute_fix_curvature = true;
    editor.force_first_input = false;

    const dataToImport = {"drawflow":{"Home":{"data":{}}}};
    editor.start();
    editor.import(dataToImport);

    // Events!
    editor.on('nodeCreated', function(id) {
        console.log("Node created " + id);
    })

    editor.on('nodeRemoved', function(id) {
        console.log("Node removed " + id);
    })

    editor.on('nodeSelected', function(id) {
        console.log("Node selected " + id);
    })

    editor.on('moduleCreated', function(name) {
        console.log("Module Created " + name);
    })

    editor.on('moduleChanged', function(name) {
        console.log("Module Changed " + name);
    })

    editor.on('connectionCreated', function(connection) {
        console.log('Connection created');
        console.log(connection);
    })

    editor.on('connectionRemoved', function(connection) {
        console.log('Connection removed');
        console.log(connection);
    })

    editor.on('nodeMoved', function(id) {
        console.log("Node moved " + id);
    })

    editor.on('zoom', function(zoom) {
        console.log('Zoom level ' + zoom);
    })

    editor.on('translate', function(position) {
        console.log('Translate x:' + position.x + ' y:'+ position.y);
    })

    editor.on('addReroute', function(id) {
        console.log("Reroute added " + id);
    })

    editor.on('removeReroute', function(id) {
        console.log("Reroute removed " + id);
    })
    /* DRAG EVENT */

    /* Mouse and Touch Actions */

    var elements = document.getElementsByClassName('drag-drawflow');
    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener('touchend', drop, false);
        elements[i].addEventListener('touchmove', positionMobile, false);
        elements[i].addEventListener('touchstart', drag, false );
    }

    var mobile_item_selec = '';
    var mobile_last_move = null;
    function positionMobile(ev) {
        mobile_last_move = ev;
    }

    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        if (ev.type === "touchstart") {
            mobile_item_selec = ev.target.closest(".drag-drawflow").getAttribute('data-node');
        } else {
            ev.dataTransfer.setData("node", ev.target.getAttribute('data-node'));
        }
    }

    function drop(ev) {
        if (ev.type === "touchend") {
            var parentdrawflow = document.elementFromPoint( mobile_last_move.touches[0].clientX, mobile_last_move.touches[0].clientY).closest("#drawflow");
            if(parentdrawflow != null) {
                addNodeToDrawFlow(mobile_item_selec, mobile_last_move.touches[0].clientX, mobile_last_move.touches[0].clientY);
            }
            mobile_item_selec = '';
        } else {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("node");
            addNodeToDrawFlow(data, ev.clientX, ev.clientY);
        }

    }

    function addNodeToDrawFlow(name, pos_x, pos_y) {
        if(editor.editor_mode === 'fixed') {
            return false;
        }
        pos_x = pos_x * ( editor.precanvas.clientWidth / (editor.precanvas.clientWidth * editor.zoom)) - (editor.precanvas.getBoundingClientRect().x * ( editor.precanvas.clientWidth / (editor.precanvas.clientWidth * editor.zoom)));
        pos_y = pos_y * ( editor.precanvas.clientHeight / (editor.precanvas.clientHeight * editor.zoom)) - (editor.precanvas.getBoundingClientRect().y * ( editor.precanvas.clientHeight / (editor.precanvas.clientHeight * editor.zoom)));


        switch (name) {

            case 'menublock':
                var menublock = `
            <div>
              <div class="title-box">Menu</div>
              <div class="box">
                <input id="keyword" type="text" placeholder="keyword" df-keyword required>
                <textarea df-message></textarea>
                <input id="delay" type="number" min="1" max="20" placeholder="delay" df-delay>
                <input type="file" df-imagepath>
              </div>
            </div>
            `;
                editor.addNode('menublock', 1, 1, pos_x, pos_y, 'menublock', {}, menublock );
                break;

            case 'template':
                var template = `
            <div>
              <div class="title-box">Generic Template</div>
              <div class="box">
                <input id="keyword" type="text" placeholder="keyword" df-keyword required>
                <textarea df-message></textarea>
                <input id="delay" type="number" min="1" max="20" placeholder="delay" df-delay>
                <input type="file" df-imagepath>
              </div>
            </div>
            `;
                editor.addNode('template', 1, 1, pos_x, pos_y, 'template', {}, template );
                break;

            case 'audio':
                var audio = `
            <div>
              <div class="title-box">Audio</div>
              <div class="box">
                <input type="text" placeholder="keyword" df-keyword>
                <input type="number" min="1" max="20" placeholder="delay" df-delay>
              </div>
            </div>
            `;
                editor.addNode('audio', 1, 1, pos_x, pos_y, 'audio', {}, audio );
                break;

            case 'name':
                var name = `
            <div>
              <div class="title-box">Ask for Name</div>
              <div class="box">
                <input type="text" placeholder="keyword" df-keyword>
                <textarea df-message></textarea>
                <input type="number" min="1" max="20" placeholder="delay" df-delay>
              </div>
            </div>
            `;
                editor.addNode('name', 1, 1, pos_x, pos_y, 'name', {}, name );
                break;

            case 'dob':
                var dob = `
            <div>
              <div class="title-box">Ask for dob (dd-mm)</div>
              <div class="box">
                <input type="text" placeholder="keyword" df-keyword>
                <textarea df-message></textarea>
                <input type="number" min="1" max="20" placeholder="delay" df-delay>
              </div>
            </div>
            `;
                editor.addNode('dob', 1, 1, pos_x, pos_y, 'dob', {}, dob );
                break;

            case 'company':
                var company = `
            <div>
              <div class="title-box">Ask for Company</div>
              <div class="box">
                <input type="text" placeholder="keyword" df-keyword>
                <textarea df-message></textarea>
                <input type="number" min="1" max="20" placeholder="delay" df-delay>
              </div>
            </div>
            `;
                editor.addNode('company', 1, 1, pos_x, pos_y, 'company', {}, company );
                break;

            case 'email':
                var email = `
            <div>
              <div class="title-box">Ask for Email</div>
              <div class="box">
                <input type="text" placeholder="keyword" df-keyword>
                <textarea df-message></textarea>
                <input type="number" min="1" max="20" placeholder="delay" df-delay>
              </div>
            </div>
            `;
                editor.addNode('email', 1, 1, pos_x, pos_y, 'email', {}, email );
                break;

            case 'street':
                var street = `
            <div>
              <div class="title-box">Ask for Street</div>
              <div class="box">
                <input type="text" placeholder="keyword" df-keyword>
                <textarea df-message></textarea>
                <input type="number" min="1" max="20" placeholder="delay" df-delay>
              </div>
            </div>
            `;
                editor.addNode('street', 1, 1, pos_x, pos_y, 'street', {}, street );
                break;

            case 'number':
                var number = `
            <div>
              <div class="title-box">Ask for Number</div>
              <div class="box">
                <input type="text" placeholder="keyword" df-keyword>
                <textarea df-message></textarea>
                <input type="number" min="1" max="20" placeholder="delay" df-delay>
              </div>
            </div>
            `;
                editor.addNode('number', 1, 1, pos_x, pos_y, 'number', {}, number );
                break;

            case 'complement':
                var complement = `
            <div>
              <div class="title-box">Ask for Complement</div>
              <div class="box">
                <input type="text" placeholder="keyword" df-keyword>
                <textarea df-message></textarea>
                <input type="number" min="1" max="20" placeholder="delay" df-delay>
              </div>
            </div>
            `;
                editor.addNode('complement', 1, 1, pos_x, pos_y, 'complement', {}, complement );
                break;

            case 'district':
                var district = `
            <div>
              <div class="title-box">Ask for District</div>
              <div class="box">
                <input type="text" placeholder="keyword" df-keyword>
                <textarea df-message></textarea>
                <input type="number" min="1" max="20" placeholder="delay" df-delay>
              </div>
            </div>
            `;
                editor.addNode('district', 1, 1, pos_x, pos_y, 'district', {}, district );
                break;

            case 'zipcode':
                var zipcode = `
            <div>
              <div class="title-box">Ask for ZipCode</div>
              <div class="box">
                <input type="text" placeholder="keyword" df-keyword>
                <textarea df-message></textarea>
                <input type="number" min="1" max="20" placeholder="delay" df-delay>
              </div>
            </div>
            `;
                editor.addNode('zipcode', 1, 1, pos_x, pos_y, 'zipcode', {}, zipcode );
                break;

            case 'city':
                var city = `
            <div>
              <div class="title-box">Ask for City</div>
              <div class="box">
                <input type="text" placeholder="keyword" df-keyword>
                <textarea df-message></textarea>
                <input type="number" min="1" max="20" placeholder="delay" df-delay>
              </div>
            </div>
            `;
                editor.addNode('city', 1, 1, pos_x, pos_y, 'city', {}, city );
                break;

            case 'state':
                var zipcode = `
            <div>
              <div class="title-box">Ask for State</div>
              <div class="box">
                <input type="text" placeholder="keyword" df-keyword>
                <textarea df-message></textarea>
                <input type="number" min="1" max="20" placeholder="delay" df-delay>
              </div>
            </div>
            `;
                editor.addNode('state', 1, 1, pos_x, pos_y, 'state', {}, state );
                break;

            case 'country':
                var country = `
            <div>
              <div class="title-box">Ask for Country</div>
              <div class="box">
                <input type="text" placeholder="keyword" df-keyword>
                <textarea df-message></textarea>
                <input type="number" min="1" max="20" placeholder="delay" df-delay>
              </div>
            </div>
            `;
                editor.addNode('country', 1, 1, pos_x, pos_y, 'country', {}, country );
                break;

            case 'genricinput':
                var genricInput = `
            <div>
              <div class="title-box">Generic Input</div>
              <div class="box">
                <input type="text" placeholder="keyword" df-keyword>
                <input type="text" placeholder="Field name" df-fieldname>
                <textarea df-message></textarea>
                <input type="number" min="1" max="20" placeholder="delay" df-delay>
              </div>
            </div>
            `;
                editor.addNode('genricInput', 1, 1, pos_x, pos_y, 'genricInput', {}, genricInput );
                break;

            case 'facebook':
                var facebook = `
        <div>
          <div class="title-box"><i class="fab fa-facebook"></i> Facebook Message</div>
        </div>
        `;
                editor.addNode('facebook', 0,  1, pos_x, pos_y, 'facebook', {}, facebook );
                break;
            case 'slack':
                var slackchat = `
          <div>
            <div class="title-box"><i class="fab fa-slack"></i> Slack chat message</div>
          </div>
          `
                editor.addNode('slack', 1, 0, pos_x, pos_y, 'slack', {}, slackchat );
                break;
            case 'github':
                var githubtemplate = `
          <div>
            <div class="title-box"><i class="fab fa-github "></i> Github Stars</div>
            <div class="box">
              <p>Enter repository url</p>
            <input type="text" df-name>
            </div>
          </div>
          `;
                editor.addNode('github', 0, 1, pos_x, pos_y, 'github', { "name": ''}, githubtemplate );
                break;
            case 'telegram':
                var telegrambot = `
          <div>
            <div class="title-box"><i class="fab fa-telegram-plane"></i> Telegram bot</div>
            <div class="box">
              <p>Send to telegram</p>
              <p>select channel</p>
              <select df-channel>
                <option value="channel_1">Channel 1</option>
                <option value="channel_2">Channel 2</option>
                <option value="channel_3">Channel 3</option>
                <option value="channel_4">Channel 4</option>
              </select>
            </div>
          </div>
          `;
                editor.addNode('telegram', 1, 0, pos_x, pos_y, 'telegram', { "channel": 'channel_3'}, telegrambot );
                break;
            case 'aws':
                var aws = `
          <div>
            <div class="title-box"><i class="fab fa-aws"></i> Aws Save </div>
            <div class="box">
              <p>Save in aws</p>
              <input type="text" df-db-dbname placeholder="DB name"><br><br>
              <input type="text" df-db-key placeholder="DB key">
              <p>Output Log</p>
            </div>
          </div>
          `;
                editor.addNode('aws', 1, 1, pos_x, pos_y, 'aws', { "db": { "dbname": '', "key": '' }}, aws );
                break;
            case 'log':
                var log = `
            <div>
              <div class="title-box"><i class="fas fa-file-signature"></i> Save log file </div>
            </div>
            `;
                editor.addNode('log', 1, 0, pos_x, pos_y, 'log', {}, log );
                break;
            case 'google':
                var google = `
            <div>
              <div class="title-box"><i class="fab fa-google-drive"></i> Google Drive save </div>
            </div>
            `;
                editor.addNode('google', 1, 0, pos_x, pos_y, 'google', {}, google );
                break;
            case 'email':
                var email = `
            <div>
              <div class="title-box"><i class="fas fa-at"></i> Send Email </div>
            </div>
            `;
                editor.addNode('email', 1, 0, pos_x, pos_y, 'email', {}, email );
                break;
            case 'multiple':
                var multiple = `
            <div>
              <div class="box">
                Multiple!
              </div>
            </div>
            `;
                editor.addNode('multiple', 3, 4, pos_x, pos_y, 'multiple', {}, multiple );
                break;
            case 'personalized':
                var personalized = `
            <div>
              Personalized
            </div>
            `;
                editor.addNode('personalized', 1, 1, pos_x, pos_y, 'personalized', {}, personalized );
                break;
            case 'dbclick':
                var dbclick = `
            <div>
            <div class="title-box"><i class="fas fa-mouse"></i> Db Click</div>
              <div class="box dbclickbox" ondblclick="showpopup(event)">
                Db Click here
                <div class="modal" style="display:none">
                  <div class="modal-content">
                    <span class="close" onclick="closemodal(event)">&times;</span>
                    Change your variable {name} !
                    <input type="text" df-name>
                  </div>

                </div>
              </div>
            </div>
            `;
                editor.addNode('dbclick', 1, 1, pos_x, pos_y, 'dbclick', { name: ''}, dbclick );
                break;

            default:
        }
    }

    var transform = '';
    function showpopup(e) {
        e.target.closest(".drawflow-node").style.zIndex = "9999";
        e.target.children[0].style.display = "block";
        //document.getElementById("modalfix").style.display = "block";

        //e.target.children[0].style.transform = 'translate('+translate.x+'px, '+translate.y+'px)';
        transform = editor.precanvas.style.transform;
        editor.precanvas.style.transform = '';
        editor.precanvas.style.left = editor.canvas_x +'px';
        editor.precanvas.style.top = editor.canvas_y +'px';
        console.log(transform);

        //e.target.children[0].style.top  =  -editor.canvas_y - editor.container.offsetTop +'px';
        //e.target.children[0].style.left  =  -editor.canvas_x  - editor.container.offsetLeft +'px';
        editor.editor_mode = "fixed";

    }

    function closemodal(e) {
        e.target.closest(".drawflow-node").style.zIndex = "2";
        e.target.parentElement.parentElement.style.display  ="none";
        //document.getElementById("modalfix").style.display = "none";
        editor.precanvas.style.transform = transform;
        editor.precanvas.style.left = '0px';
        editor.precanvas.style.top = '0px';
        editor.editor_mode = "edit";
    }

    function changeModule(event) {
        var all = document.querySelectorAll(".menu ul li");
        for (var i = 0; i < all.length; i++) {
            all[i].classList.remove('selected');
        }
        event.target.classList.add('selected');
    }

    function changeMode(option) {

        //console.log(lock.id);
        if(option == 'lock') {
            lock.style.display = 'none';
            unlock.style.display = 'block';
        } else {
            lock.style.display = 'block';
            unlock.style.display = 'none';
        }

    }

    function addFlowData() {
        if($('#keyword').val() == "") {
            alert("Please enter Keyword in the form, This is required");
            return;
        } else if ($('#delay').val() > 20) {
            alert("Delay should be lower than 20");
            return;
        }
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '{{ route('groupadmin.addFlow') }}',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(editor.export().drawflow),
            success: function(data) {
                $('#saveModal').modal('hide');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    function exportJson() {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '{{ route('groupadmin.exportJson') }}',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(editor.export()),
            success: function(data) {
                alert('Data exported successfully.');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    function extractFilename(path) {
        if (path.substr(0, 12) == "C:\\fakepath\\")
            return path.substr(12); // modern browser
        var x;
        x = path.lastIndexOf('/');
        if (x >= 0) // Unix-based path
            return path.substr(x+1);
        x = path.lastIndexOf('\\');
        if (x >= 0) // Windows-based path
            return path.substr(x+1);
        return path; // just the filename
    }

    function importJson(path) {
        // var filepath = document.getElementById("importJson").value;
        // console.log(filepath);
        var filename = extractFilename(path);
        console.log(filename);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '{{ route('groupadmin.importJson') }}',
            type: 'POST',
            contentType: 'application/json',
            data: filename,
            success: function(res) {

                // const dataToImport =  {"drawflow":{"Home":{"data":{"1":{"id":1,"name":"welcome","data":{},"class":"welcome","html":"\n    <div>\n      <div class=\"title-box\">👏 Welcome!!</div>\n      <div class=\"box\">\n        <p>Simple flow library <b>demo</b>\n        <a href=\"https://github.com/jerosoler/Drawflow\" target=\"_blank\">Drawflow</a> by <b>Jero Soler</b></p><br>\n\n        <p>Multiple input / outputs<br>\n           Data sync nodes<br>\n           Import / export<br>\n           Modules support<br>\n           Simple use<br>\n           Type: Fixed or Edit<br>\n           Events: view console<br>\n           Pure Javascript<br>\n        </p>\n        <br>\n        <p><b><u>Shortkeys:</u></b></p>\n        <p>🎹 <b>Delete</b> for remove selected<br>\n        💠 Mouse Left Click == Move<br>\n        ❌ Mouse Right == Delete Option<br>\n        🔍 Ctrl + Wheel == Zoom<br>\n        📱 Mobile support<br>\n        ...</p>\n      </div>\n    </div>\n    ", "typenode": false, "inputs":{},"outputs":{},"pos_x":50,"pos_y":50},"2":{"id":2,"name":"slack","data":{},"class":"slack","html":"\n          <div>\n            <div class=\"title-box\"><i class=\"fab fa-slack\"></i> Slack chat message</div>\n          </div>\n          ", "typenode": false, "inputs":{"input_1":{"connections":[{"node":"7","input":"output_1"}]}},"outputs":{},"pos_x":1028,"pos_y":87},"3":{"id":3,"name":"telegram","data":{"channel":"channel_2"},"class":"telegram","html":"\n          <div>\n            <div class=\"title-box\"><i class=\"fab fa-telegram-plane\"></i> Telegram bot</div>\n            <div class=\"box\">\n              <p>Send to telegram</p>\n              <p>select channel</p>\n              <select df-channel>\n                <option value=\"channel_1\">Channel 1</option>\n                <option value=\"channel_2\">Channel 2</option>\n                <option value=\"channel_3\">Channel 3</option>\n                <option value=\"channel_4\">Channel 4</option>\n              </select>\n            </div>\n          </div>\n          ", "typenode": false, "inputs":{"input_1":{"connections":[{"node":"7","input":"output_1"}]}},"outputs":{},"pos_x":1032,"pos_y":184},"4":{"id":4,"name":"email","data":{},"class":"email","html":"\n            <div>\n              <div class=\"title-box\"><i class=\"fas fa-at\"></i> Send Email </div>\n            </div>\n            ", "typenode": false, "inputs":{"input_1":{"connections":[{"node":"5","input":"output_1"}]}},"outputs":{},"pos_x":1033,"pos_y":439},"5":{"id":5,"name":"template","data":{"template":"Write your template"},"class":"template","html":"\n            <div>\n              <div class=\"title-box\"><i class=\"fas fa-code\"></i> Template</div>\n              <div class=\"box\">\n                Ger Vars\n                <textarea df-template></textarea>\n                Output template with vars\n              </div>\n            </div>\n            ", "typenode": false, "inputs":{"input_1":{"connections":[{"node":"6","input":"output_1"}]}},"outputs":{"output_1":{"connections":[{"node":"4","output":"input_1"},{"node":"11","output":"input_1"}]}},"pos_x":607,"pos_y":304},"6":{"id":6,"name":"github","data":{"name":"https://github.com/jerosoler/Drawflow"},"class":"github","html":"\n          <div>\n            <div class=\"title-box\"><i class=\"fab fa-github \"></i> Github Stars</div>\n            <div class=\"box\">\n              <p>Enter repository url</p>\n            <input type=\"text\" df-name>\n            </div>\n          </div>\n          ", "typenode": false, "inputs":{},"outputs":{"output_1":{"connections":[{"node":"5","output":"input_1"}]}},"pos_x":341,"pos_y":191},"7":{"id":7,"name":"facebook","data":{},"class":"facebook","html":"\n        <div>\n          <div class=\"title-box\"><i class=\"fab fa-facebook\"></i> Facebook Message</div>\n        </div>\n        ", "typenode": false, "inputs":{},"outputs":{"output_1":{"connections":[{"node":"2","output":"input_1"},{"node":"3","output":"input_1"},{"node":"11","output":"input_1"}]}},"pos_x":347,"pos_y":87},"11":{"id":11,"name":"log","data":{},"class":"log","html":"\n            <div>\n              <div class=\"title-box\"><i class=\"fas fa-file-signature\"></i> Save log file </div>\n            </div>\n            ", "typenode": false, "inputs":{"input_1":{"connections":[{"node":"5","input":"output_1"},{"node":"7","input":"output_1"}]}},"outputs":{},"pos_x":1031,"pos_y":363}}},"Other":{"data":{"8":{"id":8,"name":"personalized","data":{},"class":"personalized","html":"\n            <div>\n              Personalized\n            </div>\n            ", "typenode": false, "inputs":{"input_1":{"connections":[{"node":"12","input":"output_1"},{"node":"12","input":"output_2"},{"node":"12","input":"output_3"},{"node":"12","input":"output_4"}]}},"outputs":{"output_1":{"connections":[{"node":"9","output":"input_1"}]}},"pos_x":764,"pos_y":227},"9":{"id":9,"name":"dbclick","data":{"name":"Hello World!!"},"class":"dbclick","html":"\n            <div>\n            <div class=\"title-box\"><i class=\"fas fa-mouse\"></i> Db Click</div>\n              <div class=\"box dbclickbox\" ondblclick=\"showpopup(event)\">\n                Db Click here\n                <div class=\"modal\" style=\"display:none\">\n                  <div class=\"modal-content\">\n                    <span class=\"close\" onclick=\"closemodal(event)\">&times;</span>\n                    Change your variable {name} !\n                    <input type=\"text\" df-name>\n                  </div>\n\n                </div>\n              </div>\n            </div>\n            ", "typenode": false, "inputs":{"input_1":{"connections":[{"node":"8","input":"output_1"}]}},"outputs":{"output_1":{"connections":[{"node":"12","output":"input_2"}]}},"pos_x":209,"pos_y":38},"12":{"id":12,"name":"multiple","data":{},"class":"multiple","html":"\n            <div>\n              <div class=\"box\">\n                Multiple!\n              </div>\n            </div>\n            ", "typenode": false, "inputs":{"input_1":{"connections":[]},"input_2":{"connections":[{"node":"9","input":"output_1"}]},"input_3":{"connections":[]}},"outputs":{"output_1":{"connections":[{"node":"8","output":"input_1"}]},"output_2":{"connections":[{"node":"8","output":"input_1"}]},"output_3":{"connections":[{"node":"8","output":"input_1"}]},"output_4":{"connections":[{"node":"8","output":"input_1"}]}},"pos_x":179,"pos_y":272}}}}}

                const dataToImport = res.importData;
                // const dataToImport = {"drawflow":{"Home":{"data":{"1":{"id":1,"name":"welcome","data":{},"class":"welcome","html":"\n    <div>\n      <div class=\"title-box\">👏 Welcome!!</div>\n      <div class=\"box\">\n        <p>Simple flow library <b>demo</b>\n        <a href=\"https://github.com/jerosoler/Drawflow\" target=\"_blank\">Drawflow</a> by <b>Jero Soler</b></p><br>\n\n        <p>Multiple input / outputs<br>\n           Data sync nodes<br>\n           Import / export<br>\n           Modules support<br>\n           Simple use<br>\n           Type: Fixed or Edit<br>\n           Events: view console<br>\n           Pure Javascript<br>\n        </p>\n        <br>\n        <p><b><u>Shortkeys:</u></b></p>\n        <p>🎹 <b>Delete</b> for remove selected<br>\n        💠 Mouse Left Click == Move<br>\n        ❌ Mouse Right == Delete Option<br>\n        🔍 Ctrl + Wheel == Zoom<br>\n        📱 Mobile support<br>\n        ...</p>\n      </div>\n    </div>\n    ", "typenode": false, "inputs":{},"outputs":{},"pos_x":50,"pos_y":50},"2":{"id":2,"name":"slack","data":{},"class":"slack","html":"\n          <div>\n            <div class=\"title-box\"><i class=\"fab fa-slack\"></i> Slack chat message</div>\n          </div>\n          ", "typenode": false, "inputs":{"input_1":{"connections":[{"node":"7","input":"output_1"}]}},"outputs":{},"pos_x":1028,"pos_y":87},"3":{"id":3,"name":"telegram","data":{"channel":"channel_2"},"class":"telegram","html":"\n          <div>\n            <div class=\"title-box\"><i class=\"fab fa-telegram-plane\"></i> Telegram bot</div>\n            <div class=\"box\">\n              <p>Send to telegram</p>\n              <p>select channel</p>\n              <select df-channel>\n                <option value=\"channel_1\">Channel 1</option>\n                <option value=\"channel_2\">Channel 2</option>\n                <option value=\"channel_3\">Channel 3</option>\n                <option value=\"channel_4\">Channel 4</option>\n              </select>\n            </div>\n          </div>\n          ", "typenode": false, "inputs":{"input_1":{"connections":[{"node":"7","input":"output_1"}]}},"outputs":{},"pos_x":1032,"pos_y":184},"4":{"id":4,"name":"email","data":{},"class":"email","html":"\n            <div>\n              <div class=\"title-box\"><i class=\"fas fa-at\"></i> Send Email </div>\n            </div>\n            ", "typenode": false, "inputs":{"input_1":{"connections":[{"node":"5","input":"output_1"}]}},"outputs":{},"pos_x":1033,"pos_y":439},"5":{"id":5,"name":"template","data":{"template":"Write your template"},"class":"template","html":"\n            <div>\n              <div class=\"title-box\"><i class=\"fas fa-code\"></i> Template</div>\n              <div class=\"box\">\n                Ger Vars\n                <textarea df-template></textarea>\n                Output template with vars\n              </div>\n            </div>\n            ", "typenode": false, "inputs":{"input_1":{"connections":[{"node":"6","input":"output_1"}]}},"outputs":{"output_1":{"connections":[{"node":"4","output":"input_1"},{"node":"11","output":"input_1"}]}},"pos_x":607,"pos_y":304},"6":{"id":6,"name":"github","data":{"name":"https://github.com/jerosoler/Drawflow"},"class":"github","html":"\n          <div>\n            <div class=\"title-box\"><i class=\"fab fa-github \"></i> Github Stars</div>\n            <div class=\"box\">\n              <p>Enter repository url</p>\n            <input type=\"text\" df-name>\n            </div>\n          </div>\n          ", "typenode": false, "inputs":{},"outputs":{"output_1":{"connections":[{"node":"5","output":"input_1"}]}},"pos_x":341,"pos_y":191},"7":{"id":7,"name":"facebook","data":{},"class":"facebook","html":"\n        <div>\n          <div class=\"title-box\"><i class=\"fab fa-facebook\"></i> Facebook Message</div>\n        </div>\n        ", "typenode": false, "inputs":{},"outputs":{"output_1":{"connections":[{"node":"2","output":"input_1"},{"node":"3","output":"input_1"},{"node":"11","output":"input_1"}]}},"pos_x":347,"pos_y":87},"11":{"id":11,"name":"log","data":{},"class":"log","html":"\n            <div>\n              <div class=\"title-box\"><i class=\"fas fa-file-signature\"></i> Save log file </div>\n            </div>\n            ", "typenode": false, "inputs":{"input_1":{"connections":[{"node":"5","input":"output_1"},{"node":"7","input":"output_1"}]}},"outputs":{},"pos_x":1031,"pos_y":363}}},"Other":{"data":{"8":{"id":8,"name":"personalized","data":{},"class":"personalized","html":"\n            <div>\n              Personalized\n            </div>\n            ", "typenode": false, "inputs":{"input_1":{"connections":[{"node":"12","input":"output_1"},{"node":"12","input":"output_2"},{"node":"12","input":"output_3"},{"node":"12","input":"output_4"}]}},"outputs":{"output_1":{"connections":[{"node":"9","output":"input_1"}]}},"pos_x":764,"pos_y":227},"9":{"id":9,"name":"dbclick","data":{"name":"Hello World!!"},"class":"dbclick","html":"\n            <div>\n            <div class=\"title-box\"><i class=\"fas fa-mouse\"></i> Db Click</div>\n              <div class=\"box dbclickbox\" ondblclick=\"showpopup(event)\">\n                Db Click here\n                <div class=\"modal\" style=\"display:none\">\n                  <div class=\"modal-content\">\n                    <span class=\"close\" onclick=\"closemodal(event)\">&times;</span>\n                    Change your variable {name} !\n                    <input type=\"text\" df-name>\n                  </div>\n\n                </div>\n              </div>\n            </div>\n            ", "typenode": false, "inputs":{"input_1":{"connections":[{"node":"8","input":"output_1"}]}},"outputs":{"output_1":{"connections":[{"node":"12","output":"input_2"}]}},"pos_x":209,"pos_y":38},"12":{"id":12,"name":"multiple","data":{},"class":"multiple","html":"\n            <div>\n              <div class=\"box\">\n                Multiple!\n              </div>\n            </div>\n            ", "typenode": false, "inputs":{"input_1":{"connections":[]},"input_2":{"connections":[{"node":"9","input":"output_1"}]},"input_3":{"connections":[]}},"outputs":{"output_1":{"connections":[{"node":"8","output":"input_1"}]},"output_2":{"connections":[{"node":"8","output":"input_1"}]},"output_3":{"connections":[{"node":"8","output":"input_1"}]},"output_4":{"connections":[{"node":"8","output":"input_1"}]}},"pos_x":179,"pos_y":272}}}}};
                console.log(dataToImport);
                console.log(res.importData);
                editor.start();
                editor.import(dataToImport);

                // editor.start();
                // editor.import(JSON.stringify(res.importData));
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

</script>
</body>
</html>
