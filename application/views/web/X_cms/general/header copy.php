<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, no-transform, proxy-revalidate, max-age=1, s-maxage=1');
$this->output->set_header('Pragma: no-cache');
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/favicon.ico">

    <title>Vendor Manajemen Sistem - Lman</title>
    
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/vendor_components/bootstrap/dist/css/bootstrap.css">
	<!-- Bootstrap extend-->
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/css/bootstrap-extend.css">
	
	<!-- theme style -->
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/css/master_style.css">
	
	<!-- UltimatePro Admin skins -->
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/css/skins/_all-skins.css">
	

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

     
  </head>

<!-- <body class="hold-transition skin-info dark-sidebar sidebar-mini fixed"> -->
<body class="hold-transition skin-info dark-sidebar sidebar-mini">

<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index.html" class="logo">
            <!-- mini logo -->
            <div class="logo-mini">
                <span class="light-logo"><img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/logo-light.png" alt="logo"></span>
                <span class="dark-logo"><img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/logo-dark.png" alt="logo"></span>
            </div>
            <!-- logo-->
            <div class="logo-lg">
                <span class="light-logo"><img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/logo-light-text.png" alt="logo"></span>
                <span class="dark-logo"><img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/logo-dark-text.png" alt="logo"></span>
            </div>
        </a>
            <!-- Header Navbar -->
        <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
            <div>
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <i class="ti-align-left"></i>
                </a>
                <a id="toggle_res_search" data-toggle="collapse" data-target="#search_form" class="res-only-view" href="javascript:void(0);"><i class="mdi mdi-magnify"></i></a>
                <form id="search_form" role="search" class="top-nav-search pull-left collapse ml-20">
                    <div class="input-group">
                        <input type="text" name="example-input1-group2" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                        <button type="button" class="btn  btn-default" data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="mdi mdi-magnify"></i></button>
                        </span>
                    </div>
                </form> 
                
            </div>
            <div class="navbar-custom-menu r-side">
                <ul class="nav navbar-nav">
                <!-- Messages -->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="mdi mdi-email"></i>
                    </a>
                    <ul class="dropdown-menu animated bounceIn">

                    <li class="header">
                        <div class="p-20 bg-light">
                            <div class="flexbox">
                                <div>
                                    <h4 class="mb-0 mt-0">Messages</h4>
                                </div>
                                <div>
                                    <a href="#" class="text-danger">Clear All</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu sm-scrol">
                        <li><!-- start message -->
                            <a href="#">
                            <div class="pull-left">
                                <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/user2-160x160.jpg" class="rounded-circle" alt="User Image">
                            </div>
                            <div class="mail-contnet">
                                <h4>
                                Lorem Ipsum
                                <small><i class="fa fa-clock-o"></i> 15 mins</small>
                                </h4>
                                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                            </div>
                            </a>
                        </li>
                        <!-- end message -->
                        <li>
                            <a href="#">
                            <div class="pull-left">
                                <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/user3-128x128.jpg" class="rounded-circle" alt="User Image">
                            </div>
                            <div class="mail-contnet">
                                <h4>
                                Nullam tempor
                                <small><i class="fa fa-clock-o"></i> 4 hours</small>
                                </h4>
                                <span>Curabitur facilisis erat quis metus congue viverra.</span>
                            </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <div class="pull-left">
                                <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/user4-128x128.jpg" class="rounded-circle" alt="User Image">
                            </div>
                            <div class="mail-contnet">
                                <h4>
                                Proin venenatis
                                <small><i class="fa fa-clock-o"></i> Today</small>
                                </h4>
                                <span>Vestibulum nec ligula nec quam sodales rutrum sed luctus.</span>
                            </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <div class="pull-left">
                                <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/user3-128x128.jpg" class="rounded-circle" alt="User Image">
                            </div>
                            <div class="mail-contnet">
                                <h4>
                                Praesent suscipit
                                <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                </h4>
                                <span>Curabitur quis risus aliquet, luctus arcu nec, venenatis neque.</span>
                            </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <div class="pull-left">
                                <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/user4-128x128.jpg" class="rounded-circle" alt="User Image">
                            </div>
                            <div class="mail-contnet">
                                <h4>
                                Donec tempor
                                <small><i class="fa fa-clock-o"></i> 2 days</small>
                                </h4>
                                <span>Praesent vitae tellus eget nibh lacinia pretium.</span>
                            </div>

                            </a>
                        </li>
                        </ul>
                    </li>
                    <li class="footer">				  
                        <a href="#" class="bg-light">See all e-Mails</a>
                    </li>
                    </ul>
                </li>
                <!-- Notifications -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="mdi mdi-bell"></i>
                    </a>
                    <ul class="dropdown-menu animated bounceIn">

                    <li class="header">
                        <div class="bg-light p-20">
                            <div class="flexbox">
                                <div>
                                    <h4 class="mb-0 mt-0">Notifications</h4>
                                </div>
                                <div>
                                    <a href="#" class="text-danger">Clear All</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu sm-scrol">
                        <li>
                            <a href="#">
                            <i class="fa fa-users text-info"></i> Curabitur id eros quis nunc suscipit blandit.
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <i class="fa fa-warning text-warning"></i> Duis malesuada justo eu sapien elementum, in semper diam posuere.
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <i class="fa fa-users text-danger"></i> Donec at nisi sit amet tortor commodo porttitor pretium a erat.
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <i class="fa fa-shopping-cart text-success"></i> In gravida mauris et nisi
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <i class="fa fa-user text-danger"></i> Praesent eu lacus in libero dictum fermentum.
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <i class="fa fa-user text-primary"></i> Nunc fringilla lorem 
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <i class="fa fa-user text-success"></i> Nullam euismod dolor ut quam interdum, at scelerisque ipsum imperdiet.
                            </a>
                        </li>
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="#" class="bg-light">View all</a>
                    </li>
                    </ul>
                </li>
                <!-- Tasks-->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="mdi mdi-bulletin-board"></i>
                    </a>
                    <ul class="dropdown-menu animated bounceIn">

                    <li class="header">
                        <div class="p-20 bg-light">
                            <div class="flexbox">
                                <div>
                                    <h4 class="mb-0 mt-0">Tasks</h4>
                                </div>
                                <div>
                                    <a href="#" class="text-danger">Clear All</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu sm-scrol">
                        <li><!-- Task item -->
                            <a href="#">
                            <h3>
                                Lorem ipsum dolor sit amet
                                <small class="pull-right">30%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-danger" style="width: 30%" role="progressbar"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">30% Complete</span>
                                </div>
                            </div>
                            </a>
                        </li>
                        <!-- end task item -->
                        <li><!-- Task item -->
                            <a href="#">
                            <h3>
                                Vestibulum nec ligula
                                <small class="pull-right">20%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-info" style="width: 20%" role="progressbar"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">20% Complete</span>
                                </div>
                            </div>
                            </a>
                        </li>
                        <!-- end task item -->
                        <li><!-- Task item -->
                            <a href="#">
                            <h3>
                                Donec id leo ut ipsum
                                <small class="pull-right">70%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-success" style="width: 70%" role="progressbar"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">70% Complete</span>
                                </div>
                            </div>
                            </a>
                        </li>
                        <!-- end task item -->
                        <li><!-- Task item -->
                            <a href="#">
                            <h3>
                                Praesent vitae tellus
                                <small class="pull-right">40%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-warning" style="width: 40%" role="progressbar"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">40% Complete</span>
                                </div>
                            </div>
                            </a>
                        </li>
                        <!-- end task item -->
                        <li><!-- Task item -->
                            <a href="#">
                            <h3>
                                Nam varius sapien
                                <small class="pull-right">80%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-primary" style="width: 80%" role="progressbar"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">80% Complete</span>
                                </div>
                            </div>
                            </a>
                        </li>
                        <!-- end task item -->
                        <li><!-- Task item -->
                            <a href="#">
                            <h3>
                                Nunc fringilla
                                <small class="pull-right">90%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-info" style="width: 90%" role="progressbar"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">90% Complete</span>
                                </div>
                            </div>
                            </a>
                        </li>
                        <!-- end task item -->
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="#" class="bg-light">View all tasks</a>
                    </li>
                    </ul>
                </li>	
                
                <!-- User Account-->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/avatar/7.jpg" class="user-image rounded-circle" alt="User Image">
                    </a>
                    <ul class="dropdown-menu animated flipInX">
                    <!-- User image -->
                    <li class="user-header bg-img" style="background-image: url(../images/user-info.jpg)" data-overlay="3">
                        <div class="flexbox align-self-center">					  
                            <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/avatar/7.jpg" class="float-left rounded-circle" alt="User Image">					  
                            <h4 class="user-name align-self-center">
                            <span>Samuel Brus</span>
                            <small>samuel@gmail.com</small>
                            </h4>
                        </div>
                    </li>
                    <!-- Menu Body -->
                    <li class="user-body">
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ion ion-person"></i> My Profile</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ion ion-bag"></i> My Balance</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ion ion-email-unread"></i> Inbox</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ion ion-settings"></i> Account Setting</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ion-log-out"></i> Logout</a>
                            <div class="dropdown-divider"></div>
                            <div class="p-10"><a href="javascript:void(0)" class="btn btn-sm btn-rounded btn-success">View Profile</a></div>
                    </li>
                    </ul>
                </li>	
                    
                
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-cog fa-spin"></i></a>
                </li>
                    
                </ul>
            </div>
        </nav>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
	    <div class="container">
            <!-- Content Header (Page header) -->	  
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="page-title">Dashboard</h3>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Control</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="right-title w-170">
                        <span class="subheader_daterange font-weight-600" id="dashboard_daterangepicker">
                            <span class="subheader_daterange-label">
                                <span class="subheader_daterange-title"></span>
                                <span class="subheader_daterange-date text-primary"></span>
                            </span>
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fa fa-angle-down"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
  