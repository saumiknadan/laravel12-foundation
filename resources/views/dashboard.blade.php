@extends('layouts.master')

@section('title') Dashboard @endsection

@section('css')
    
@endsection

@section('content')
    <div class="col-xl-6">
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-6 col-sm-6 col-xxl-12">
                        <div class="card" id="user-activity">
                            <div class="card-header border-0 pb-0 flex-wrap">
                                <div>
                                    <span class="mb-3 d-block fs-16">Current Balance</span>
                                    <h4 class="fs-24 font-w700 mb-3">$ 24,567.33</h4>
                                    <span><small class="text-success">+2.7%</small>  than last week</span>
                                </div>
                                <div class="current-icon">
                                    <a href="javascript:void(0);"><i class="fas fa-long-arrow-alt-up"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="current-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#Daily" role="tab">Daily</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#Weekly" role="tab">Weekly</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#Monthly" role="tab">Monthly</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="Daily">
                                        <canvas id="activity" height="115"></canvas>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-6 col-xxl-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="redial"></div>
                                <span class="text-center d-block fs-18 font-w600">On Progress <small class="text-success">70%</small></span>	
                                <div class="mt-4 text-center">
                                    <h4 class="fs-20 font-w700">Workload Dashboard For CMS Websites</h4>
                                    <p class="mb-0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem</p>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="fs-20 font-w700">Project Statistics</h4>
                        <div class="dropdown ">
                            <div class="btn-link" data-bs-toggle="dropdown">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5"/>
                                    <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5"/>
                                    <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5"/>
                                </svg>
                            </div>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-3">
                        <div id="chartBar" class="chartBar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card bg-progradient manage-project">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-12">
                                <h4 class="fs-24 font-w700 text-white">Manage your project in one touch</h4>
                                <span class="fs-16 text-white d-block">Let Wokrload manage your project automatically with our best AI systems </span>
                            </div>
                            <div class="col-xl-6 col-12 text-end">
                                <a href="javascript:void(0);" class="btn  bg-white fs-18 btn-rounded">Try Free Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="fs-20 font-w700">Project Statistics</h4>
                        <div class="dropdown ">
                            <div class="btn-link" data-bs-toggle="dropdown">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5"/>
                                    <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5"/>
                                    <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5"/>
                                </svg>
                            </div>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div id="reservationChart" class="reservationChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex px-4 pb-0 justify-content-between">
                        <div>
                            <h4 class="fs-18 font-w600 mb-4 text-nowrap">Total Clients</h4>
                            <div class="d-flex align-items-center">
                                <h2 class="fs-32 font-w700 mb-0">68</h2>
                                <span class="d-block ms-4">
                                    <svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.49217 11C0.590508 11 0.149368 9.9006 0.800944 9.27736L9.80878 0.66117C10.1954 0.29136 10.8046 0.291359 11.1912 0.661169L20.1991 9.27736C20.8506 9.9006 20.4095 11 19.5078 11H1.49217Z" fill="#09BD3C"/>
                                    </svg>
                                    <small class="d-block fs-16 font-w400 text-success">+0,5%</small>
                                </span>
                            </div>
                        </div>
                        <div class="bg-gradient1 rounded text-center p-3">
                            <div class="d-inline-block position-relative donut-chart-sale mb-3">
                                <span class="donut1" data-peity='{ "fill": ["var(--primary)", "rgba(238, 238, 237, 1)"],   "innerRadius": 33, "radius": 10}'>5/8</span>
                                <small class="text-primary">71%</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-sm-6">
                <div class="card">
                    <div class="card-body px-4">
                        <h4 class="fs-18 font-w600 mb-5 text-nowrap">Total Clients</h4>
                        <div class="progress default-progress">
                            <div class="progress-bar progress-animated" style="width: 40%; height:10px;" role="progressbar">
                                <span class="sr-only">45% Complete</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-end mt-1 justify-content-between">
                            <span><small class="text-primary">76</small> left from target</span>
                            <h4 class="mb-0 fs-32 font-w800">42</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex px-4  justify-content-between">
                        <div>
                            <div class="">
                                <h2 class="fs-32 font-w700">562</h2>
                                <span class="fs-18 font-w500 d-block">Total Clients</span>
                                <span class="d-block fs-16 font-w400"><small class="text-danger">-2%</small> than last month</span>
                            </div>
                        </div>
                        <div id="NewCustomers"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex px-4  justify-content-between">
                        <div>
                            <div class="">
                                <h2 class="fs-32 font-w700">892</h2>
                                <span class="fs-18 font-w500 d-block">New Projects</span>
                                <span class="d-block fs-16 font-w400"><small class="text-success">-2%</small> than last month</span>
                            </div>
                        </div>
                        <div id="NewCustomers1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
                <div>
                    <h4 class="fs-20 font-w700">Important Projects</h4>
                    <span>Lorem ipsum dolor sit amet</span>
                </div>
                <div class="dropdown">
                    <div class="btn-link" data-bs-toggle="dropdown">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5"/>
                            <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5"/>
                            <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5"/>
                        </svg>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                        <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class=" owl-carousel card-slider">
                    <div class="items">
                        <div class="slide-info">
                            <div class="d-flex align-items-center mb-3">
                                <div class="slide-icon">
                                    <span class="bg-ombe">
                                        <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19 0C15.2422 -4.48119e-08 11.5687 1.11433 8.44417 3.20208C5.31963 5.28982 2.88435 8.25722 1.44629 11.729C0.00822388 15.2008 -0.36804 19.0211 0.36508 22.7067C1.0982 26.3924 2.90777 29.7778 5.56497 32.435C8.22217 35.0922 11.6076 36.9018 15.2933 37.6349C18.9789 38.368 22.7992 37.9918 26.271 36.5537C29.7428 35.1156 32.7102 32.6804 34.7979 29.5558C36.8857 26.4313 38 22.7578 38 19H28.456C28.456 20.8702 27.9014 22.6984 26.8624 24.2535C25.8233 25.8085 24.3465 27.0205 22.6187 27.7362C20.8908 28.4519 18.9895 28.6392 17.1552 28.2743C15.3209 27.9094 13.636 27.0088 12.3136 25.6864C10.9912 24.364 10.0906 22.6791 9.7257 20.8448C9.36084 19.0105 9.5481 17.1092 10.2638 15.3813C10.9795 13.6535 12.1915 12.1767 13.7465 11.1376C15.3016 10.0986 17.1298 9.54401 19 9.54401V0Z" fill="white"/>
                                        </svg>
                                    </span>
                                </div>
                                <div class="ms-3">
                                    <h4 class="fs-18 font-w500">Ombe Cafe</h4>
                                    <span>Cafe</span>
                                </div>
                            </div>
                            <p class="fs-16">Responsive Landing Page Website Projects</p>
                            <div class="slider-button mb-4">
                                <span class="badge-lg text-danger bgl-danger">MOBILE</span>
                                <span class="badge-lg text-blue bgl-blue">WEBSITES</span>
                            </div>
                            <div class="progress default-progress mb-2">
                                <div class="progress-bar progress-animated" style="width: 40%; height:10px;" role="progressbar">
                                </div>
                            </div>
                            <div class="d-flex align-items-end mt-1 justify-content-between">
                                <span><small class="text-black font-w700">12</small> Task Done</span>
                                <span>Due date: 12/05/2020</span>
                            </div>
                        </div>
                    </div>	
                    <div class="items">
                        <div class="slide-info">
                            <div class="d-flex align-items-center mb-3">
                                <div class="slide-icon">
                                    <span class="bg-pushup">
                                        <svg width="27" height="35" viewBox="0 0 27 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.64071 24.2591V33V34H6.64071H2H1V33V2.3725V1.3725H2H6.64071H7.64071V2.3725V3.23854C9.32631 1.9176 11.6215 1 14.4566 1C21.0001 1 26 6.38308 26 13.8785C26 21.3958 21.0207 26.5501 14.4566 26.5501C11.7277 26.5501 9.372 25.6258 7.64071 24.2591ZM19.2779 13.8785C19.2779 9.46345 16.3463 7.09747 13.4389 7.09747C10.5614 7.09747 7.64071 9.39188 7.64071 13.7957C7.64071 18.1544 10.5578 20.4526 13.4389 20.4526C16.3833 20.4526 19.2779 18.2557 19.2779 13.8785Z" fill="white" stroke="white" stroke-width="2"/>
                                        </svg>
                                    </span>
                                </div>
                                <div class="ms-3">
                                    <h4 class="fs-18 font-w500">Pushup Studios</h4>
                                    <span>Coffe Shops</span>
                                </div>
                            </div>
                            <p class="fs-16">Reservation Application Integrated with Desktop App</p>
                            <div class="slider-button mb-4">
                                <span class="badge-lg text-danger bgl-danger">DESKTOP APP</span>
                            </div>
                            <div class="progress default-progress mb-2">
                                <div class="progress-bar progress-animated" style="width: 40%; height:10px;" role="progressbar">
                                </div>
                            </div>
                            <div class="d-flex align-items-end mt-1 justify-content-between">
                                <span><small class="text-black font-w700">12</small> Task Done</span>
                                <span>Due date: 12/05/2020</span>
                            </div>
                        </div>
                    </div>	
                    <div class="items">
                        <div class="slide-info">
                            <div class="d-flex align-items-center mb-3">
                                <div class="slide-icon">
                                    <span class="bg-kleon">
                                        <svg width="24" height="31" viewBox="0 0 24 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.2782 31H24L10.1504 15.5223L23.7744 0H17.3233L5.14286 14.1396V0H0V31H5.14286V17.1281L17.2782 31Z" fill="white"/>
                                        </svg>

                                    </span>
                                </div>
                                <div class="ms-3">
                                    <h4 class="fs-18 font-w500">Kleon Team</h4>
                                    <span>Coffe Shops</span>
                                </div>
                            </div>
                            <p class="fs-16">Responsive Landing Page Website Projects</p>
                            <div class="slider-button mb-4">
                                <span class="badge-lg text-danger bgl-danger">DESKTOP APP</span>
                            </div>
                            <div class="progress default-progress mb-2">
                                <div class="progress-bar progress-animated" style="width: 40%; height:10px;" role="progressbar">
                                </div>
                            </div>
                            <div class="d-flex align-items-end mt-1 justify-content-between">
                                <span><small class="text-black font-w700">12</small> Task Done</span>
                                <span>Due date: 12/05/2020</span>
                            </div>
                        </div>
                    </div>	
                    <div class="items">
                        <div class="slide-info">
                            <div class="d-flex align-items-center mb-3">
                                <div class="slide-icon">
                                    <span class="bg-biji">
                                        <svg width="27" height="35" viewBox="0 0 27 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.64071 10.7409V2V1H6.64071H2H1V2V32.6275V33.6275H2H6.64071H7.64071V32.6275V31.7615C9.32631 33.0824 11.6215 34 14.4566 34C21.0001 34 26 28.6169 26 21.1215C26 13.6042 21.0207 8.44993 14.4566 8.44993C11.7277 8.44993 9.372 9.37416 7.64071 10.7409ZM19.2779 21.1215C19.2779 25.5366 16.3463 27.9025 13.4389 27.9025C10.5614 27.9025 7.64071 25.6081 7.64071 21.2043C7.64071 16.8456 10.5578 14.5474 13.4389 14.5474C16.3833 14.5474 19.2779 16.7443 19.2779 21.1215Z" fill="white" stroke="white" stroke-width="2"/>
                                        </svg>
                                    </span>
                                </div>
                                <div class="ms-3">
                                    <h4 class="fs-18 font-w500">Biji’s Coffee</h4>
                                    <span>Coffe Shops</span>
                                </div>
                            </div>
                            <p class="fs-16">Responsive Landing Page Website Projects</p>
                            <div class="slider-button mb-4">
                                <span class="badge-lg text-danger bgl-danger">DESKTOP APP</span>
                            </div>
                            <div class="progress default-progress mb-2">
                                <div class="progress-bar progress-animated" style="width: 40%; height:10px;" role="progressbar">
                                </div>
                            </div>
                            <div class="d-flex align-items-end mt-1 justify-content-between">
                                <span><small class="text-black font-w700">12</small> Task Done</span>
                                <span>Due date: 12/05/2020</span>
                            </div>
                        </div>
                    </div>	
                    
                </div>
                
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-sm-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div>
                            <h4 class="fs-20 font-w700">Project Categories</h4>
                            <span class="fs-14 font-w400 d-block">Lorem ipsum dolor sit amet</span>
                        </div>	
                        <div class="dropdown">
                            <div class="btn-link" data-bs-toggle="dropdown">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5"/>
                                    <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5"/>
                                    <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5"/>
                                </svg>
                            </div>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-xl-6">
                                <div>
                                    <span class="fs-18 font-w600 mb-3 d-block">Legend</span>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <span class="fs-18 font-w500">	
                                            <svg class="me-3" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="20" height="20" rx="6" fill="#886CC0"/>
                                            </svg>
                                            Primary (27%)
                                        </span>
                                        <span class="fs-18 font-w600">763</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between  mb-4">
                                        <span class="fs-18 font-w500">	
                                            <svg class="me-3" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="20" height="20" rx="6" fill="#26E023"/>
                                            </svg>
                                            Promotion (11%)
                                        </span>
                                        <span class="fs-18 font-w600">321</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between  mb-4">
                                        <span class="fs-18 font-w500">	
                                            <svg class="me-3" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="20" height="20" rx="6" fill="#61CFF1"/>
                                            </svg>
                                            Forum (22%)
                                        </span>
                                        <span class="fs-18 font-w600">69</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between  mb-4">
                                        <span class="fs-18 font-w500">	
                                            <svg class="me-3" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="20" height="20" rx="6" fill="#FFDA7C"/>
                                            </svg>
                                            Socials (15%) 
                                        </span>
                                        <span class="fs-18 font-w600">154</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between  mb-4">
                                        <span class="fs-18 font-w500">	
                                            <svg class="me-3" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="20" height="20" rx="6" fill="#FF86B1"/>
                                            </svg>
                                            Spam (25%) 
                                        </span>
                                        <span class="fs-18 font-w600">696</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 text-center">
                                <div id="emailchart" class="mb-3"></div>
                                <a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded">Update Progress</a>		
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
    </div>

    <div class="col-xl-6 col-sm-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0 flex-wrap">
                        <div class="mb-2">
                            <h4 class="fs-20 font-w700">Messages</h4>
                            <span>Lorem ipsum dolor sit amet</span>
                        </div>
                        <div class="mb-2">
                            <a href="javascript:void(0);" class="btn btn-primary btn-rounded">+New Messages</a>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        <div class="msg-bx d-flex justify-content-between align-items-center">
                            <div class="msg d-flex align-items-center w-100">
                                <div class="image-box active">
                                    <img src="{{ asset('assets/images/profile/small/pic6.jpg') }}" alt="">
                                </div>
                                <div class="ms-3 w-100 ">
                                    <h4 class="fs-18 font-w600">Maren Rosser</h4>
                                    <div class="d-flex justify-content-between">
                                        <span class="me-auto">Hei, dont forget to clear server cache!</span>
                                        <span class="me-4 fs-12">25min ago</span>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="dropdown">
                                <div class="btn-link" data-bs-toggle="dropdown">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5"/>
                                        <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5"/>
                                        <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5"/>
                                    </svg>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                                </div>
                            </div>
                        </div>
                        <div class="msg-bx d-flex justify-content-between align-items-center">
                            <div class="msg d-flex align-items-center w-100">
                                <div class="image-box">
                                    <img src="{{ asset('assets/images/profile/small/pic7.jpg') }}" alt="">
                                </div>	
                                <div class="ms-3 w-100">
                                    <h4 class="fs-18 font-w600">Kaiya Bergson</h4>
                                    <div class="d-flex justify-content-between">
                                        <span class="me-auto">I remember that project due is tomorrow.</span>
                                        <span class="me-4 fs-12">Yesterday, 8:24 AM</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <div class="btn-link" data-bs-toggle="dropdown">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5"/>
                                        <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5"/>
                                        <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5"/>
                                    </svg>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                                </div>
                            </div>
                        </div>
                        <div class="msg-bx d-flex justify-content-between align-items-center">
                            <div class="msg d-flex align-items-center w-100">
                                <div class="image-box active">
                                    <img src="{{ asset('assets/images/profile/small/pic4.jpg') }}" alt="">
                                </div>	
                                <div class="ms-3 w-100">
                                    <h4 class="fs-18 font-w600">Ruben Press</h4>
                                    <div class="d-flex justify-content-between">
                                        <span class="me-auto">Ok sir. I will fix it as soon as possible</span>
                                        <span class="me-4 fs-12">December 12th, 2020  10:24 AM</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <div class="btn-link" data-bs-toggle="dropdown">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5"/>
                                        <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5"/>
                                        <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5"/>
                                    </svg>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                                </div>
                            </div>
                        </div>
                        <div class="msg-bx d-flex justify-content-between align-items-center">
                            <div class="msg d-flex align-items-center w-100">
                                <div class="image-box active">
                                    <img src="{{ asset('assets/images/profile/small/pic3.jpg') }}" alt="">
                                </div>	
                                <div class="ms-3 w-100">
                                    <h4 class="fs-18 font-w600">Cristofer Torff</h4>
                                    <div class="d-flex justify-content-between">
                                        <span class="me-auto">Maybe we should schedule that meeting</span>
                                        <span class="me-4 fs-12">December 12th, 2020  10:24 AM</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <div class="btn-link" data-bs-toggle="dropdown">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5"/>
                                        <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5"/>
                                        <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5"/>
                                    </svg>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                                </div>
                            </div>
                        </div>
                        <div class="msg-bx d-flex justify-content-between align-items-center">
                            <div class="msg d-flex align-items-center w-100">
                                <div class="image-box active">
                                    <img src="{{ asset('assets/images/profile/small/pic5.jpg') }}" alt="">
                                </div>	
                                <div class="ms-3 w-100">
                                    <h4 class="fs-18 font-w600">Ann Rosser</h4>
                                    <div class="d-flex justify-content-between">
                                        <span class="me-auto">I dont’t know where that files saved dude.</span>
                                        <span class="me-4 fs-12">Yesterday, 8:24 AM</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <div class="btn-link" data-bs-toggle="dropdown">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5"/>
                                        <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5"/>
                                        <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5"/>
                                    </svg>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
    </div>

    
@endsection




@section('script')

@endsection