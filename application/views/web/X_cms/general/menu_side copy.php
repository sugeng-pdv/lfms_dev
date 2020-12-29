<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
