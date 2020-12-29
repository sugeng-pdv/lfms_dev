<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	  <div class="container">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title"><?php echo $page_title; ?></h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi <?php echo $breadcrumb_item_li;?>"></i></a></li>
								<li class="breadcrumb-item" aria-current="page"><?php echo $breadcrumb_item_page;?></li>
								<li class="breadcrumb-item active" aria-current="page"><?php echo $breadcrumb_item_active;?></li>
							</ol>
						</nav>
					</div>
				</div>
				<!-- <div class="right-title">
					<div class="dropdown">
						<button class="btn btn-outline dropdown-toggle no-caret" type="button" data-toggle="dropdown"><i class="mdi mdi-dots-horizontal"></i></button>
						<div class="dropdown-menu dropdown-menu-right">
						  <a class="dropdown-item" href="#"><i class="mdi mdi-share"></i>Activity</a>
						  <a class="dropdown-item" href="#"><i class="mdi mdi-email"></i>Messages</a>
						  <a class="dropdown-item" href="#"><i class="mdi mdi-help-circle-outline"></i>FAQ</a>
						  <a class="dropdown-item" href="#"><i class="mdi mdi-settings"></i>Support</a>
						  <div class="dropdown-divider"></div>
						  <button type="button" class="btn btn-success">Submit</button>
						</div>
					</div>
				</div> -->
			</div>
		</div>

		<!-- Main content -->
		<section class="content">