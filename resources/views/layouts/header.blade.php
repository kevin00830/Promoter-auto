<!-- Header -->

<div id="kt_header" class="header flex-column header-fixed">
    <!-- Top -->
    <div class="header-top my-primary-bg- bg-danger">
        <div class="container-fluid mx-lg-5">
            <div class="d-none d-lg-flex align-items-center mr-3">
                <!-- Brand -->
                <a class="navbar-brand mr-20" href="/"><img src="{{URL::asset('/images/notifire_transparent.png')}}" width="45px" onmouseover="get_moadal()" ></a>

                <!-- /. Brand -->
                <!-- Header Navs(for desktop mode) -->
                <ul class="header-tabs nav align-self-end font-size-lg" role="tablist">
                    <!-- Group Admin Menu -->
                    <!--<li class="nav-item">-->
                    <!--    <a href="{{ route('groupadmin.dashboard') }}"-->
                    <!--        class="nav-link py-4 px-6 {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}"> {{__('group.auto_integrador_desktop')}}</a>-->
                    <!--</li>-->
                    
                    <!--<li class="nav-item">-->
                    <!--    <a href="{{ route('groupadmin.int_web') }}" -->
                    <!--        class="nav-link py-4 px-6 {{ request()->segment(1) == 'int_web' ? 'active' : '' }}">{{__('group.auto_integrador_web')}}</a>-->
                    <!--</li>-->
                    
                    <li class="nav-item">
                        <a href="{{ route('groupadmin.int_web_') }}" 
                            class="nav-link py-4 px-6 {{ request()->segment(1) == 'int_web_' ? 'active' : '' }}">{{__('group.auto_integrador_web_nobuttons')}}</a>
                    </li>
                      <li class="nav-item">
                        <a href="{{ route('groupadmin.dashboard') }}"
                            class="nav-link py-4 px-6 {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}"> {{__('group.auto_integrador_desktop')}}</a>
                    </li>
                
                      <!-- <li class="nav-item">
                        <a href="{{ route('groupadmin.hotmart') }}"
                            class="nav-link py-4 px-6 {{ request()->segment(1) == 'hotmart' ? 'active' : '' }}"> {{__('group.hotmart')}}</a>
                    </li>
                         <li class="nav-item">
                        <a href="{{ route('groupadmin.eduzz') }}" 
                            class="nav-link py-4 px-6 {{ request()->segment(1) == 'eduzz' ? 'active' : '' }}">{{__('group.eduzz')}}</a>
                    </li>
                    
                     <li class="nav-item">
                        <a href="{{ route('groupadmin.rdstation') }}" 
                            class="nav-link py-4 px-6 {{ request()->segment(1) == 'rdstation' ? 'active' : '' }}">{{__('group.rd_station')}}</a>
                    </li>
                     <li class="nav-item">
                        <a href="{{ route('groupadmin.monetizze') }}" 
                            class="nav-link py-4 px-6 {{ request()->segment(1) == 'monetizze' ? 'active' : '' }}">{{__('group.monetizze')}}</a>
                    </li>
                    
                     <li class="nav-item">
                        <a href="{{ route('groupadmin.woocommerce') }}" 
                            class="nav-link py-4 px-6 {{ request()->segment(1) == 'woocommerce' ? 'active' : '' }}">{{__('group.woocommerce')}}</a>
                    </li> -->

                    <!-- End Group Admin Menu -->
                </ul>
                <!-- End Header Navs -->
            </div>
            <div class="topbar my-primary-bg-dark- bg-danger">
                <!-- User -->
                <div class="topbar-item">
                    <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2"
                        id="kt_quick_user_toggle">
                        <div class="d-flex flex-column text-right pr-3">
                            <span
                                class="text-white opacity-50 font-weight-bold font-size-sm d-none d-md-inline">{{ auth()->user()->gp_groupname }}</span>
                            <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">
                                ID {{ auth()->user()->id }}
                            </span>

                        </div>

                        <span class="symbol symbol-35">

                            <span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-30">

                                <span class="svg-icon svg-icon-white svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo7\dist/../src/media/svg/icons\General\User.svg-->

                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                            <polygon points="0 0 24 0 24 24 0 24" />

                                            <path
                                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                fill="#000000" fill-rule="nonzero" />

                                            <path
                                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                fill="#000000" fill-rule="nonzero" />

                                        </g>

                                    </svg>
                                    <!--end::Svg Icon-->

                                </span>
                            </span>

                        </span>

                    </div>

                </div>

                <!-- End user -->

            </div>

        </div>

    </div>

    <!-- End Top -->

    <!-- Bottom -->

    <div class="header-bottom d-none">

        <div class="container">

            <div class="header-navs header-navs-left">

                <div class="header-menu header-menu-mobile header-menu-layout-default">

                    <!--begin::Nav-->

                    <ul class="menu-nav">

                        <li class="menu-item menu-item-active" aria-haspopup="true">

                            <a href="index.html" class="menu-link">

                                <span class="menu-text">Dashboard</span>

                            </a>

                        </li>

                    </ul>

                    <!--end::Nav-->

                </div>

            </div>

        </div>

    </div>

    <!-- End Bottom -->



    <!-- Mobile Toggle Menu -->

    <div class="header-navs header-navs-left mobile-toggle-menu d-lg-none" id="kt_header_navs">

        <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">

            <ul class="menu-nav">

                <li class="menu-item menu-item-active" aria-haspopup="true">

                    <a href="index.html" class="menu-link">

                        <span class="menu-text">Dashboard</span>

                    </a>

                </li>

            </ul>

        </div>

    </div>

    <!-- End Mobile Toggle Menu -->

</div>

<!-- End Header -->

@include('layouts.modals.menus')
