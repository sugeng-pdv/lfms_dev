<!DOCTYPE html><!--Template Name: Metronic - Bootstrap 4 HTML, React, Angular 9 & VueJS Admin Dashboard ThemeAuthor: KeenThemesWebsite: http://www.keenthemes.com/Contact: support@keenthemes.comFollow: www.twitter.com/keenthemesDribbble: www.dribbble.com/keenthemesLike: www.facebook.com/keenthemesPurchase: https://1.envato.market/EA4JPRenew Support: https://1.envato.market/EA4JPLicense: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.--><html lang="en">	<!--begin::Head-->	<head><base href="">		<meta charset="utf-8" />		<title><?php echo $title; ?></title>		<meta name="description" content="Updates and statistics" />		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />		<link rel="canonical" href="https://keenthemes.com/metronic" />		<!--begin::Fonts-->		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />		<!--end::Fonts-->		<!--begin::Page Vendors Styles(used by this page)-->		<link href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />		<!--end::Page Vendors Styles-->		<!--begin::Global Theme Styles(used by all pages)-->		<link href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />		<link href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />		<link href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />		<!--end::Global Theme Styles-->		<!--begin::Layout Themes(used by all pages)-->		<!--end::Layout Themes-->		<link rel="shortcut icon" href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>assets/media/logos/logo-lman-35.png" />	</head>	<!--end::Head-->	<!--begin::Body-->	<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">		<!--begin::Main-->		<!--begin::Header Mobile-->		<div id="kt_header_mobile" class="header-mobile bg-lman header-mobile-fixed">			<!--begin::Logo-->			<a href="index.html">				<img alt="Logo" src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>assets/media/logos/logo-lman-40-teks.png" class="max-h-30px" />			</a>			<!--end::Logo-->			<!--begin::Toolbar-->			<div class="d-flex align-items-center">				<button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">					<span></span>				</button>				<button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">					<span class="svg-icon svg-icon-xl">						<!--begin::Svg Icon | path:<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>assets/media/svg/icons/General/User.svg-->						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">								<polygon points="0 0 24 0 24 24 0 24" />								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />							</g>						</svg>						<!--end::Svg Icon-->					</span>				</button>			</div>			<!--end::Toolbar-->		</div>		<!--end::Header Mobile-->		<div class="d-flex flex-column flex-root">			<!--begin::Page-->			<div class="d-flex flex-row flex-column-fluid page">				<!--begin::Wrapper-->				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">					<!--begin::Header-->					<div id="kt_header" class="header flex-column header-fixed">						<!--begin::Top-->						<div class="header-top">							<!--begin::Container-->							<div class="container">								<!--begin::Left-->								<div class="d-none d-lg-flex align-items-center mr-3">									<!--begin::Logo-->									<a href="index.html" class="mr-20">										<img alt="Logo" src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>assets/media/logos/logo-lman-40-teks.png" class="max-h-35px" />									</a>									<!--end::Logo-->									<!--begin::Tab Navs(for desktop mode)-->																		<ul class="header-tabs nav align-self-end font-size-lg" role="tablist">										<!--begin::Item-->																				<li class="nav-item">											<a href="#" class="nav-link menu-link py-4 px-6 active" data-toggle="" data-target="" >Homee</a>										</li>										<!--end::Item-->										<!--begin::Item-->										<li class="nav-item mr-3">											<a href="#" class="nav-link menu-link py-4 px-6" data-toggle="tab" data-target="" role="">Reports</a>										</li>										<!--end::Item-->										<!--begin::Item-->										<li class="nav-item mr-3">											<a href="#" class="nav-link menu-link py-4 px-6" data-toggle="" data-target="" role="tab">Orders</a>										</li>										<!--end::Item-->										<!--begin::Item-->										<li class="nav-item mr-3">											<a href="#" class="nav-link py-4 px-6" data-toggle="tab" data-target="" role="tab">Help Ceter</a>										</li>										<!--end::Item-->									</ul>									<div class="tab-content">										<!--begin::Tab Pane-->										<div class="tab-pane py-5 p-lg-0 show active" id="kt_header_tab_1">											<!--begin::Menu-->											<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">												<!--begin::Nav-->												<ul class="menu-nav">													<li class="menu-item menu-item-active" aria-haspopup="true">														<a href="#" class="menu-link">															<span class="menu-text"><?php echo $menu_text; ?></span>														</a>													</li>																									</ul>												<!--end::Nav-->											</div>											<!--end::Menu-->										</div>										<!--begin::Tab Pane-->										<!--begin::Tab Pane-->										<div class="tab-pane p-5 p-lg-0 justify-content-between">											<div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center">												<!--begin::Actions-->												<a href="#" class="btn btn-light-success font-weight-bold mr-3 my-2 my-lg-0">Latest Orders</a>												<a href="#" class="btn btn-light-primary font-weight-bold my-2 my-lg-0">Customer Service</a>												<!--end::Actions-->											</div>											<div class="d-flex align-items-center">												<!--begin::Actions-->												<a href="#" class="btn btn-danger font-weight-bold my-2 my-lg-0">Generate Reports</a>												<!--end::Actions-->											</div>										</div>										<!--begin::Tab Pane-->									</div>									<!--begin::Tab Navs-->								</div>								<!--end::Left-->								<!--begin::Topbar-->								<div class="topbar bg-lman">									<!--begin::User-->									<div class="topbar-item">										<div class="btn btn-icon btn-hover-transparent-white w-lg-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">										 <!--   <span class="symbol symbol-35">-->											<!--	<span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-30">S</span>-->											<!--</span>-->											<div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Mark Stone">														<img alt="Pic" src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>assets/media/users/300_25.jpg" />												</div>											<div class="d-flex flex-column text-right pr-lg-3">												<!--<span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-md-inline">Sean</span>-->												<span class="text-white font-weight-bolder font-size-sm d-none d-md-inline"> PPK</span>											</div>																					</div>									</div>									<!--end::User-->								</div>								<!--end::Topbar-->							</div>							<!--end::Container-->						</div>						<!--end::Top-->						<!--begin::Bottom-->						<div class="header-bottom">							<!--begin::Container-->							<div class="container">								<!--begin::Header Menu Wrapper-->								<div class="header-navs header-navs-left" id="kt_header_navs">									<!--begin::Tab Navs(for tablet and mobile modes)-->									<ul class="header-tabs p-5 p-lg-0 d-flex d-lg-none nav nav-bold nav-tabs" role="tablist">										<!--begin::Item-->										<li class="nav-item mr-2">											<a href="#" class="nav-link btn btn-clean active" data-toggle="tab" data-target="#kt_header_tab_1" role="tab">home</a>										</li>										<!--end::Item-->										<!--begin::Item-->										<li class="nav-item mr-2">											<a href="#" class="nav-link btn btn-clean" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Reports</a>										</li>										<!--end::Item-->										<!--begin::Item-->										<li class="nav-item mr-2">											<a href="#" class="nav-link btn btn-clean" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Orders</a>										</li>										<!--end::Item-->										<!--begin::Item-->										<li class="nav-item mr-2">											<a href="#" class="nav-link btn btn-clean" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Help Ceter</a>										</li>										<!--end::Item-->									</ul>									<!--begin::Tab Navs-->									<!--begin::Tab Content-->									<div class="tab-content">										<!--begin::Tab Pane-->										<div class="tab-pane py-5 p-lg-0 show active" id="kt_header_tab_1">											<!--begin::Menu-->											<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">												<!--begin::Nav-->												<ul class="menu-nav">													<li class="menu-item menu-item-active" aria-haspopup="true">														<a href="#" class="menu-link">															<span class="menu-text"><?php echo $menu_text; ?></span>														</a>													</li>																									</ul>												<!--end::Nav-->											</div>											<!--end::Menu-->										</div>										<!--begin::Tab Pane-->										<!--begin::Tab Pane-->										<div class="tab-pane p-5 p-lg-0 justify-content-between">											<div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center">												<!--begin::Actions-->												<a href="#" class="btn btn-light-success font-weight-bold mr-3 my-2 my-lg-0">Latest Orders</a>												<a href="#" class="btn btn-light-primary font-weight-bold my-2 my-lg-0">Customer Service</a>												<!--end::Actions-->											</div>											<div class="d-flex align-items-center">												<!--begin::Actions-->												<a href="#" class="btn btn-danger font-weight-bold my-2 my-lg-0">Generate Reports</a>												<!--end::Actions-->											</div>										</div>										<!--begin::Tab Pane-->									</div>									<!--end::Tab Content-->								</div>								<!--end::Header Menu Wrapper-->							</div>							<!--end::Container-->						</div>						<!--end::Bottom-->					</div>					<!--end::Header-->					<!--begin::Content-->					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">						<!--begin::Entry-->						<div class="d-flex flex-column-fluid">							<!--begin::Container-->							<div class="container">