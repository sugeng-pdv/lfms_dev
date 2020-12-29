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
				<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar-->

				<section class="sidebar">
					<!-- sidebar menu-->
					<ul class="sidebar-menu" data-widget="tree">
						<li class="header nav-small-cap">VMS</li>

						<li>
							<a href="<?php echo base_url();?>penyedia2">
								<i class="ti-stats-up"></i>
								<span>Beranda</span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>penyedia2/data-profile">
								<i class="ti-pulse"></i>
								<span>Data Penyedia</span>
							</a>
						</li>
						<li>
							<a href="pages/charts_inline.html">
								<i class="ti-bar-chart"></i>
								<span>Pengadaan Baru</span>
							</a>
						</li>
						<li>
							<a href="pages/charts_morris.html">
								<i class="ti-stats-down"></i>
								<span>Inbox</span>
							</a>
						</li>
						<li>
							<a href="pages/charts_peity.html">
								<i class="ti-pie-chart"></i>
								<span>Ganti Password</span>
							</a>
						</li>
						<li>
							<a href="pages/charts_chartist.html">
								<i class="ti-bar-chart-alt"></i>
								<span>Histori Login</span>
							</a>
						</li>


						<li>
							<a href="pages/auth_login.html">
								<i class="ti-power-off"></i>
								<span>Log Out</span>
							</a>
						</li>

					</ul>
				</section>
			</aside>

		  	<div class="row">
				<div class="col-xl-8 col-12">
					<div class="row">
						<div class="col-12">							
							<div class="box">
								<div class="box-header">							
									<h4 class="box-title">Product Sales</h4>
									<p class="subtitle mb-0">Overview of Latest Month</p>
								</div>
								<div class="box-body analytics-info">
									<div id="basic-bar" style="height:450px;"></div>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">							  
							  <!-- Basic bar chart -->
							<div class="box">
								<div class="box-body">
									<div class="d-flex">
										<h3 class="font-weight-600 mb-0">1,125</h3>
										<span class="badge badge-info badge-pill align-self-center ml-auto">+55,6%</span>
									</div>

									<div>
										User online
										<div class="text-muted font-size-16">845 avg</div>
									</div>
								</div>

								<div class="container-fluid">
									<div id="chart_bar_basic" class="mt-10"></div>
								</div>
							</div>
							<!-- /basic bar chart -->
							  
						</div>

						  <div class="col-md-6">
								<div class="box">
								  <div class="box-body">
									  <div class="media align-items-center p-0">
										  <h3 class="mx-0 mb-5 font-weight-500">Member Profit</h3>
									  </div>
									  <div class="flexbox align-items-center mt-5">
										<div>
										  <h4 class="no-margin"><span class="text-success">+$17,800</span></h4>
										</div>
										<div class="text-right">
										  <h4 class="no-margin"><span class="text-danger">-1.35%</span></h4>
										</div>
									  </div>
								</div>
								<div class="box-footer p-0 no-border">
									<div class="chart"><canvas id="chartjs2" class="h-80"></canvas></div>
								</div>
							 </div>
						  </div>
					</div>
					
					

					
				</div>

				<div class="col-12 col-xl-4">
					
					
					<div class="box">
					  <div class="box-body">
						  <div class="media align-items-center p-0">
							  <h3 class="mx-0 mb-5 font-weight-500">Daily Sales</h3>
						  </div>
						  <div class="flexbox align-items-center mt-5">
							<div>
							  <h4 class="no-margin"><span class="text-primary">+$17,800</span></h4>
							</div>
							<div class="text-right">
							  <h4 class="no-margin"><span class="text-success">+1.35%</span></h4>
							</div>
						  </div>
					</div>
					<div class="box-footer p-0 no-border">
						<div class="chart"><canvas id="chartjs1" class="h-80"></canvas></div>
					</div>
				   </div>
					
					<!-- Basic sparklines -->
					<div class="box">
						<div class="box-body">
							<div class="d-flex">
								<h3 class="font-weight-600 mb-0">85.4%</h3>
								<div class="list-icons ml-auto">
									<div class="list-icons-item dropdown">
										<a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="#" class="dropdown-item">Update data</a>
											<a href="#" class="dropdown-item">Detailed log</a>
											<a href="#" class="dropdown-item">Statistics</a>
											<a href="#" class="dropdown-item">Clear list</a>
										</div>
									</div>
								</div>
							</div>

							<div>
								Current server loading
								<div class="text-muted font-size-16">24.6% avg</div>
							</div>
						</div>

						<div id="sparklines_basic"></div>
					</div>
					<!-- /basic sparklines -->
					
					<div class="box">
					  <div class="box-header with-border">
						<h5 class="box-title">Top Advertisers</h5>
						<div class="box-tools pull-right">
							<ul class="card-controls">
							  <li class="dropdown">
								<a data-toggle="dropdown" href="#"><i class="ion-android-more-vertical"></i></a>
								<div class="dropdown-menu dropdown-menu-right">
								  <a class="dropdown-item active" href="#">Today</a>
								  <a class="dropdown-item" href="#">Yesterday</a>
								  <a class="dropdown-item" href="#">Last week</a>
								  <a class="dropdown-item" href="#">Last month</a>
								</div>
							  </li>
							  <li><a href="" class="link card-btn-reload" data-toggle="tooltip" title="" data-original-title="Refresh"><i class="fa fa-circle-thin"></i></a></li>
							</ul>
						</div>
					  </div>

					  <div class="box-body">
						<div class="text-center py-20">                  
						  <div class="donut" data-peity='{ "fill": ["#ff4c52", "#faa700", "#3e8ef7"], "radius": 78, "innerRadius": 58  }' >9,6,5</div>
						</div>

						<ul class="list-inline">
						  <li class="flexbox mb-5">
							<div>
							  <span class="badge badge-dot badge-lg mr-1" style="background-color: #ff4c52"></span>
							  <span>Abu Dhabi</span>
							</div>
							<div>8952</div>
						  </li>

						  <li class="flexbox mb-5">
							<div>
							  <span class="badge badge-dot badge-lg mr-1" style="background-color: #faa700"></span>
							  <span>Miami</span>
							</div>
							<div>7458</div>
						  </li>

						  <li class="flexbox">
							<div>
							  <span class="badge badge-dot badge-lg mr-1" style="background-color: #3e8ef7"></span>
							  <span>London</span>
							</div>
							<div>3254</div>
						  </li>
						</ul>
					  </div>
					</div>

				</div>	
				
				<div class="col-xl-4 col-12">
					<div class="box">
						<div class="box-body">
							<div class="d-flex flex-row">
								<div class=""><img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/avatar/1.jpg" alt="user" class="rounded-circle" width="100"></div>
								<div class="pl-20">
									<h3>Johen Doe</h3>
									<h6>Web Designer</h6>
									<button class="btn btn-success"><i class="ti-plus"></i> Follow</button>
								</div>
							</div>
							<div class="row mt-35">
								<div class="col b-r text-center">
									<h2 class="font-light">1254</h2>
									<h6>Photos</h6></div>
								<div class="col b-r text-center">
									<h2 class="font-light">1254</h2>
									<h6>Videos</h6></div>
								<div class="col text-center">
									<h2 class="font-light">1587</h2>
									<h6>Tasks</h6></div>
							</div>
						</div>
						<div class="box-body">
							<p class="text-center aboutscroll">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. Quisque mauris augue, molestie tincidunt.
							</p>
							<ul class="list-inline text-center">
								<li><a href="javascript:void(0)" data-toggle="tooltip" title="" data-original-title="Website"><i class="fa fa-globe font-size-20"></i></a></li>
								<li><a href="javascript:void(0)" data-toggle="tooltip" title="" data-original-title="twitter"><i class="fa fa-twitter font-size-20"></i></a></li>
								<li><a href="javascript:void(0)" data-toggle="tooltip" title="" data-original-title="Facebook"><i class="fa fa-facebook-square font-size-20"></i></a></li>
							</ul>
						</div>
					</div>
				  </div>
				
				   <div class="col-xl-5 col-12">
					  <!-- Default box -->
					  <div class="box bg-img box-inverse" style="background-image: url(../images/gallery/thumb/4.jpg);" data-overlay="5">			
						<div class="box-body">
						  <div class="p-5">
							  <h3 class="white">
								<span class="font-size-30">City, </span>Country
							  </h3>
							  <p class="weather-day-date mb-70">
								<span class="mr-5">MONDAY</span> May 11, 2017
							  </p>
							  <div class="mb-25 weather-icon">
								<canvas class="mr-40 text-top" id="icon1" width="90" height="90"></canvas>
								<div class="inline-block">
								  <span class="font-size-50">29°
									<span class="font-size-40">C</span>
								  </span>
								  <p class="text-left">DAY RAIN</p>
								</div>
							  </div>
							  <div class="row no-space">
								<div class="col-2">
								  <div>
									<div class="mb-10">TUE</div>
									<i class="wi-day-sunny font-size-30 mb-10"></i>
									<div>24°
									  <span class="font-size-12">C</span>
									</div>
								  </div>
								</div>
								<div class="col-2">
								  <div>
									<div class="mb-10">WED</div>
									<i class="wi-day-cloudy font-size-30 mb-10"></i>
									<div>21°
									  <span class="font-size-12">C</span>
									</div>
								  </div>
								</div>
								<div class="col-2">
								  <div>
									<div class="mb-10">THU</div>
									<i class="wi-day-sunny font-size-30 mb-10"></i>
									<div>25°
									  <span class="font-size-12">C</span>
									</div>
								  </div>
								</div>
								<div class="col-2">
								  <div>
									<div class="mb-10">FRI</div>
									<i class="wi-day-cloudy-gusts font-size-30 mb-10"></i>
									<div>20°
									  <span class="font-size-12">C</span>
									</div>
								  </div>
								</div>
								<div class="col-2">
								  <div>
									<div class="mb-10">SAT</div>
									<i class="wi-day-lightning font-size-30 mb-10"></i>
									<div>18°
									  <span class="font-size-12">C</span>
									</div>
								  </div>
								</div>
								<div class="col-2">
								  <div>
									<div class="mb-10">SUN</div>
									<i class="wi-day-storm-showers font-size-30 mb-10"></i>
									<div>14°
									  <span class="font-size-12">C</span>
									</div>
								  </div>
								</div>
							  </div>
							</div>
						</div>
						<!-- /.box-body -->
					  </div>
					  <!-- /.box --> 
					</div>
				
					<div class="col-xl-3 col-12">
						<div class="box box-body">
						  <h6>
							<span class="text-uppercase">Revenue</span>
							<span class="float-right"><a class="btn btn-xs btn-primary" href="#">View</a></span>
						  </h6>
						  <p class="font-size-26">$845,1258</p>

						  <div class="progress progress-xxs mt-0 mb-10">
							<div class="progress-bar bg-danger" role="progressbar" style="width: 35%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
						  </div>
						  <div class="font-size-12"><i class="ion-arrow-graph-down-right text-success mr-1"></i> %18 decrease from last month</div>
						</div>
						
						<div class="box box-inverse box-success">
							<div class="box-body">
							  <a class="avatar float-left mr-20" href="javascript:void(0)">
								<img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/avatar/5.jpg" alt="">
							  </a>
							  <div>
								<small class="float-right">Today, 05:05</small>
								<div class="font-size-18">Johen Doe</div>
								<div class="font-size-14 mb-10">Designer</div>
								<blockquote class="blockquote px-10 my-10 font-size-16 text-white">Phasellus aliquet enim vel augue porttitor posuere<br> tristique.</blockquote>
							  </div>
							</div>
						  </div>						
					</div>
				
				<div class="col-12 col-xl-8">
				  <div class="box">
					<div class="box-header with-border">
					  <h4 class="box-title">Sales Analytics</h4>
					</div>
					<div class="box-body">
					  <ul class="flexbox flex-justified text-center my-10">
							<li class="br-1">
							  <p class="mb-0">Traffic</p>
							  <div class="font-size-20 mb-5">4854,22k</div>
							  <div class="font-size-18 text-success">
								<i class="fa fa-arrow-up pr-5"></i><span>+18%</span>
							  </div>
							</li>

							<li class="br-1">
							  <p class="mb-0">Orders</p>
							  <div class="font-size-20 mb-5">854,512k</div>
							  <div class="font-size-18 text-success">
								<i class="fa fa-arrow-up pr-5"></i><span>+9%</span>
							  </div>
							</li>

							<li>
							  <p class="mb-0">Revenue</p>
							  <div class="font-size-20 mb-5">4875,84k</div>
							  <div class="font-size-18 text-danger">
								<i class="fa fa-arrow-down pr-5"></i><span>-8%</span>
							  </div>
							</li>
						</ul>
					  <div class="chart-responsive">
						  <div id="basic-line" style="height:400px;"></div>
					  </div>
					</div>
					<!-- /.box-body -->
				  </div>
				  <!-- /.box -->			
				</div>
				
				<div class="col-12 col-xl-4">							
				  <div class="box">				  
					  <div class="box-header no-border">
						  <h4 class="box-title">Earnings</h4>
						  <p class="subtitle mb-0">Total earnings of the month</p>
						<div class="box-tools pull-right">
							<ul class="box-controls">
							  <li class="dropdown">
								<a data-toggle="dropdown" href="#"><i class="fa fa-cog"></i></a>
								<div class="dropdown-menu dropdown-menu-right">
								  <a class="dropdown-item active" href="#">Today</a>
								  <a class="dropdown-item" href="#">Yesterday</a>
								  <a class="dropdown-item" href="#">Last week</a>
								  <a class="dropdown-item" href="#">Last month</a>
								</div>
							  </li>
							  <li><a href="#" class="link card-btn-reload" data-toggle="tooltip" title="" data-original-title="Refresh"><i class="fa fa-circle-thin"></i></a></li>
							</ul>
						</div>
					  </div>

					  <div class="box-body pt-0">
						  <h1 class="font-weight-600">$45,215.22</h1>
						  <p>17.10% ($954.23) <i class="fa fa-arrow-up text-success ml-10"></i></p>

						  <div id="baralc" class="text-center py-20 bb-1"></div>

						  <p class="mb-0 pt-20">Last Month Earnings<i class="fa fa-arrow-up text-success ml-10"></i></p>
						  <h1 class="font-weight-600 text-info">$18,124.74</h1>
						  <button type="button" class="btn btn-success mb-5">Check Whole Report</button>

					  </div>
				  </div>
				
					<a class="box box-inverse box-body bg-img" href="#" style="background-image: url(../images/gallery/thumb-sm/1.jpg)" data-overlay="4">
					  <div class="flexbox align-items-center">
						<img class="avatar avatar-lg avatar-bordered" src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/avatar/3.jpg" alt="...">
						<div class="text-right">
						  <h6 class="mb-0">Monty Hulk</h6>
						  <small>Project Mg.</small>
						</div>
					  </div>
					</a>
					
				</div>
				
				<!-- col -->
				<div class="col-12">
					<div class="box">
						<div class="box-body">
							<h4 class="box-title">Yearly Sales Groth</h4>
							<ul class="list-inline text-center mt-40">
								<li>
									<h5><i class="fa fa-circle mr-5 text-success"></i>Data 1</h5>
								</li>
								<li>
									<h5><i class="fa fa-circle mr-5 text-info"></i>Data 2</h5>
								</li>
								<li>
									<h5><i class="fa fa-circle mr-5 text-warning"></i>Data 3</h5>
								</li>
							</ul>
							<div id="area-chart3" style="height: 400px;"></div>
						</div>
					</div>
				</div>
				<!-- /col -->
				
			</div>
			
			</section>
            <!-- /.content -->
        </div>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right d-none d-sm-inline-block">
            <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Purchase Now</a>
                </li>
            </ul>
        </div>
        &copy; 2018 <a href="https://www.multipurposethemes.com/">Multi-Purpose Themes</a>. All Rights Reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-light">
        <div class="rpanel-title"><span class="btn pull-right"><i class="ion ion-close" data-toggle="control-sidebar"></i></span> </div>
        <!-- Create the tabs -->
        <ul class="nav nav-tabs control-sidebar-tabs">
            <li class="nav-item"><a href="#control-sidebar-home-tab" data-toggle="tab">Chat</a></li>
            <li class="nav-item"><a href="#control-sidebar-settings-tab" data-toggle="tab">Todo</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <div class="flexbox">
                    <a href="javascript:void(0)" class="text-grey">
                        <i class="ti-more"></i>
                    </a>
                    <p>Users</p>
                    <a href="javascript:void(0)" class="text-right text-grey"><i class="ti-plus"></i></a>
                </div>
                <div class="lookup lookup-sm lookup-right d-none d-lg-block">
                    <input type="text" name="s" placeholder="Search" class="w-p100">
                </div>
                <div class="media-list media-list-hover mt-20">
                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-success" href="#">
                            <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/avatar/1.jpg"
                                alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Tyler</strong></a>
                            </p>
                            <p>Praesent tristique diam...</p>
                            <span>Just now</span>
                        </div>
                    </div>

                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-danger" href="#">
                            <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/avatar/2.jpg"
                                alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Luke</strong></a>
                            </p>
                            <p>Cras tempor diam ...</p>
                            <span>33 min ago</span>
                        </div>
                    </div>

                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-warning" href="#">
                            <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/avatar/3.jpg"
                                alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Evan</strong></a>
                            </p>
                            <p>In posuere tortor vel...</p>
                            <span>42 min ago</span>
                        </div>
                    </div>

                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-primary" href="#">
                            <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/avatar/4.jpg"
                                alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Evan</strong></a>
                            </p>
                            <p>In posuere tortor vel...</p>
                            <span>42 min ago</span>
                        </div>
                    </div>

                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-success" href="#">
                            <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/avatar/1.jpg"
                                alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Tyler</strong></a>
                            </p>
                            <p>Praesent tristique diam...</p>
                            <span>Just now</span>
                        </div>
                    </div>

                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-danger" href="#">
                            <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/avatar/2.jpg"
                                alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Luke</strong></a>
                            </p>
                            <p>Cras tempor diam ...</p>
                            <span>33 min ago</span>
                        </div>
                    </div>

                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-warning" href="#">
                            <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/avatar/3.jpg"
                                alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Evan</strong></a>
                            </p>
                            <p>In posuere tortor vel...</p>
                            <span>42 min ago</span>
                        </div>
                    </div>

                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-primary" href="#">
                            <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/avatar/4.jpg"
                                alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Evan</strong></a>
                            </p>
                            <p>In posuere tortor vel...</p>
                            <span>42 min ago</span>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <div class="flexbox">
                    <a href="javascript:void(0)" class="text-grey">
                        <i class="ti-more"></i>
                    </a>
                    <p>Todo List</p>
                    <a href="javascript:void(0)" class="text-right text-grey"><i class="ti-plus"></i></a>
                </div>
                <ul class="todo-list mt-20">
                    <li class="py-15 px-5 by-1">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_1" class="filled-in">
                        <label for="basic_checkbox_1" class="mb-0 h-15"></label>
                        <!-- todo text -->
                        <span class="text-line">Nulla vitae purus</span>
                        <!-- Emphasis label -->
                        <small class="badge bg-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                        <!-- General tools such as edit or delete-->
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_2" class="filled-in">
                        <label for="basic_checkbox_2" class="mb-0 h-15"></label>
                        <span class="text-line">Phasellus interdum</span>
                        <small class="badge bg-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5 by-1">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_3" class="filled-in">
                        <label for="basic_checkbox_3" class="mb-0 h-15"></label>
                        <span class="text-line">Quisque sodales</span>
                        <small class="badge bg-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_4" class="filled-in">
                        <label for="basic_checkbox_4" class="mb-0 h-15"></label>
                        <span class="text-line">Proin nec mi porta</span>
                        <small class="badge bg-success"><i class="fa fa-clock-o"></i> 3 days</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5 by-1">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_5" class="filled-in">
                        <label for="basic_checkbox_5" class="mb-0 h-15"></label>
                        <span class="text-line">Maecenas scelerisque</span>
                        <small class="badge bg-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_6" class="filled-in">
                        <label for="basic_checkbox_6" class="mb-0 h-15"></label>
                        <span class="text-line">Vivamus nec orci</span>
                        <small class="badge bg-info"><i class="fa fa-clock-o"></i> 1 month</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5 by-1">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_7" class="filled-in">
                        <label for="basic_checkbox_7" class="mb-0 h-15"></label>
                        <!-- todo text -->
                        <span class="text-line">Nulla vitae purus</span>
                        <!-- Emphasis label -->
                        <small class="badge bg-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                        <!-- General tools such as edit or delete-->
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_8" class="filled-in">
                        <label for="basic_checkbox_8" class="mb-0 h-15"></label>
                        <span class="text-line">Phasellus interdum</span>
                        <small class="badge bg-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5 by-1">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_9" class="filled-in">
                        <label for="basic_checkbox_9" class="mb-0 h-15"></label>
                        <span class="text-line">Quisque sodales</span>
                        <small class="badge bg-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_10" class="filled-in">
                        <label for="basic_checkbox_10" class="mb-0 h-15"></label>
                        <span class="text-line">Proin nec mi porta</span>
                        <small class="badge bg-success"><i class="fa fa-clock-o"></i> 3 days</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->



<!-- jQuery 3 -->
<!-- <script src="<?php //echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script> -->
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- popper -->
<script type="text/javascript" charset="utf8"
	src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/vendor_components/popper/dist/popper.min.js">
</script>

<!-- Bootstrap 4.0-->
<script type="text/javascript" charset="utf8"
	src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/vendor_components/bootstrap/dist/js/bootstrap.js">
</script>

<!-- Slimscroll -->
<script type="text/javascript" charset="utf8"
	src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/vendor_components/jquery-slimscroll/jquery.slimscroll.js">
</script>

<!-- FastClick -->
<script type="text/javascript" charset="utf8"
	src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/vendor_components/fastclick/lib/fastclick.js">
</script>

<!-- UltimatePro Admin App -->
<script type="text/javascript" charset="utf8"
	src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/js/template.js"></script>

<!-- UltimatePro Admin for demo purposes -->
<script type="text/javascript" charset="utf8"
	src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/js/demo.js"></script>


</body>

</html>


<!-- Active js -->
<!-- <script src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>js/active.js"></script> -->

<?php if( isset($js) ){ foreach ($js as $js){ ?>
<script src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH.$js; ?>" type="text/javascript"></script>
<?php }} ?>

</body>

</html>

  