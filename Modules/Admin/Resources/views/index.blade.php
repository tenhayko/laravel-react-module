@extends('admin::layouts.master')

@section('content')
    <div>
        <div class="sidebar bg-g mh-100vh w-280">
            <div class="sidebar-inner">
                <div class="sidebar-logo">
                    <div class="peers ai-c fxw-nw">
                        <div class="peer peer-greed">
                            <a class="sidebar-link td-n" href="{{ route('admin.dashboard') }}">
                                <div class="peers ai-c fxw-nw">
                                    <div class="peer">
                                        <div class="logo"><img src="https://colorlib.com/polygon/adminator/assets/static/images/logo.png" alt=""></div>
                                    </div>
                                    <div class="peer peer-greed">
                                        <h5 class="lh-1 mB-0 logo-text">Adminator</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- menu --}}
                <ul class="sidebar-menu scrollable pos-r ps ps--active-y">
                    <li class="nav-item mT-30 active">
                        <a class="sidebar-link" href="https://colorlib.com/polygon/adminator/index.html" default="">
                            <span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="sidebar-link" href="ui.html">
                            <span class="icon-holder"><i class="c-brown-500 ti-email"></i> </span>
                            <span class="title">UI Elements</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown open">
                        <a class="dropdown-toggle" href="javascript:void(0);">
                            <span class="icon-holder"><i class="c-indigo-500 ti-bar-chart"></i> </span>
                            <span class="title">Tables</span> <span class="arrow"><i class="ti-angle-right"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="sidebar-link" href="basic-table.html">Basic Table</a></li>
                            <li><a class="sidebar-link" href="datatable.html">Data Table</a></li>
                        </ul>
                    </li>
                </ul>
                {{-- end menu --}}
            </div>
        </div>
        <div class="main-conten bg-w mh-100vh">
            <div class="header navbar">
                <div class="header-container">
                        <ul class="nav-left">
                            <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu" aria-hidden="true"></i></a></li>
                            <li class="search-box active">
                                <a class="search-toggle no-pdd-right" href="javascript:void(0);">
                                    <i class="search-icon ti-search pdd-right-10" aria-hidden="true"></i>
                                    <i class="search-icon-close ti-close pdd-right-10"></i>
                                </a></li>
                            <li class="search-input active">
                                <input class="form-control" type="text" placeholder="Search...">
                            </li>
                        </ul>
                </div>
            </div>     
        </div>
    </div>
@stop
