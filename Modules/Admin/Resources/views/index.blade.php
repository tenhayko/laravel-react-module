@extends('admin::layouts.master')

@section('content')
    <div>
        <div class="sidebar bg-g mh-100vh w-280 float-left">
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
                                        <h5 class="lh-1 mB-0 logo-text">Adminator</h5></div>
                                </div>
                            </a>
                        </div>
                        <div class="peer">
                            <div class="mobile-toggle sidebar-toggle"><a href="" class="td-n"><i class="ti-arrow-circle-left"></i></a></div>
                        </div>
                    </div>
                </div>
                {{-- menu --}}
                <ul class="sidebar-menu scrollable pos-r ps ps--active-y">
                    <li class="nav-item mT-30 active">
                        <a class="sidebar-link" href="https://colorlib.com/polygon/adminator/index.html" default="">
                            <span class="icon-holder"><i class="fa fa-home" aria-hidden="true"></i> </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="sidebar-link" href="ui.html">
                            <span class="icon-holder"><i class="fa fa-home" aria-hidden="true"></i> </span>
                            <span class="title">UI Elements</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle" href="javascript:void(0);">
                            <span class="icon-holder"><i class="fa fa-home" aria-hidden="true"></i> </span>
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
        <div class="main-conten bg-w mh-100vh w-100-280 float-left">

        </div>
    </div>
@stop
