@extends('layouts.general_layout')

@section('page')
    <div class="full-page">
        <div class="sidebar-container">
            <aside class="sidebar sidebar-left sidebar-fixed sidebar-dark">
                <div class="scroll">
                    <div class="sidebar-header text-white bg-info">
                        <div class="sidebar-brand d-flex justify-content-between align-items-center">
                            <div class="title text-truncate">
                                Simplify Admin
                            </div>
                            <div class="logo align-items-center justify-content-around">
                                <i class="material-icons">all_inclusive</i>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-nav-container">
                        <ul class="list-nav sidebar-nav list-nav-dark list-nav-dark-info">
                            <li class="list-nav-group-title">
                            <span>
                              DASHBOARDS
                            </span>
                            </li>
                            <li class="list-nav-item">
                                <a href="{{route('home')}}" class="list-nav-link">
                                  <span class="list-nav-icon">
                                    <i class="material-icons">home</i>
                                  </span>
                                    <span class="list-nav-label">Dashboard Pro</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
        <div class="page">
            <div class="topbar-container">
                <nav class="navbar bg-white text-secondary navbar-expand-sm py-0 topbar fixed">
                    <button class="btn btn-flat-secondary btn-sm btn-icon mr-1 no-shadow d-none d-xl-block sidebar-toggle">
                        <i class="material-icons">menu</i>
                    </button>
                    <button class="btn btn-flat-secondary btn-sm btn-icon mr-1 d-xl-none no-shadow sidebar-hide">
                        <i class="material-icons">menu</i>
                    </button>
                    <div class="navbar-text ml-3 d-none d-sm-block">
                        <h5 class="m-0 text-dark"> Dashboard </h5>
                    </div>
                    <div class="ml-auto d-sm-flex">
                        <div class="d-none d-sm-flex align-items-center">
                            <input class="form-control collapsed topbar-search border-top-0 border-left-0 border-right-0 "
                                   type="search" placeholder="Search" aria-label="Search">
                        </div>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown no-caret ml-4">
                                <a class="text-xs nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="http://via.placeholder.com/256x256" class="img-thumb-xs mr-1 align-middle"
                                         alt="">
                                    <i class="material-icons">expand_more</i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item empty-link">Profile</a>
                                    <a class="dropdown-item empty-link">Account</a>
                                    <a class="dropdown-item empty-link">Security</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endsection
