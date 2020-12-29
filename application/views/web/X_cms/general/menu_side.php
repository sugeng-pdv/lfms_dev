<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

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
					<span>Data</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>penyedia2/data-pengadaan">
					<i class="ti-bar-chart"></i>
					<span>Pengadaan Baru</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>penyedia2/message">
					<i class="ti-stats-down"></i>
					<span>Inbox</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>penyedia2/ganti-password">
					<i class="ti-pie-chart"></i>
					<span>Ganti Password</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>penyedia2/histori-login">
					<i class="ti-bar-chart-alt"></i>
					<span>Histori Login</span>
				</a>
			</li>


			<!-- <li>
				<a href="<?php echo base_url();?>penyedia2/master-user">
					<i class="ti-bar-chart-alt"></i>
					<span>Master User</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>penyedia2/User-baru">
					<i class="ti-bar-chart-alt"></i>
					<span>User Baru</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>penyedia2/master-kualifikasi">
					<i class="ti-bar-chart-alt"></i>
					<span>Master Kualifikasi</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>penyedia2/master-sub-kualifikasi">
					<i class="ti-bar-chart-alt"></i>
					<span>Master Sub Kualifikasi</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>penyedia2/master-sub-klasifikasi">
					<i class="ti-bar-chart-alt"></i>
					<span>Master Klasifikasi</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>penyedia2/FAQ">
					<i class="ti-bar-chart-alt"></i>
					<span>FAQ</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>penyedia2/">
					<i class="ti-bar-chart-alt"></i>
					<span>Master Pengadaan</span>
				</a> -->
			<!-- </li> -->

			<li class="header nav-small-cap">Administrator</li>
			<li>
				<a href="<?php echo base_url();?>menu-side">
					<i class="ti-bar-chart-alt"></i>
					<span>Menu Side</span>
				</a>
			</li>
			<!-- <li class="treeview">
				<a href="#">
					<i class="ti-email"></i> <span>Mailbox</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-right pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="mailbox_inbox.html"><i class="ti-more"></i>Inbox</a></li>
					<li><a href="mailbox_compose.html"><i class="ti-more"></i>Compose</a></li>
					<li><a href="mailbox_read_mail.html"><i class="ti-more"></i>Read</a></li>
				</ul>
			</li> -->
			<li>
				<a href="<?php echo base_url();?>penyedia2/logout">
					<i class="ti-power-off"></i>
					<span>Log Out</span>
				</a>
			</li>

		</ul>
	</section>
</aside>