
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
			
		
  