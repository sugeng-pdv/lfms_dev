<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view( PLATFORM_PATH.'general/header' );
?>

    <div class="main">
        <!-- ***** Header Start ***** -->
        <header class="navbar navbar-sticky navbar-expand-lg navbar-dark">
            <div class="container position-relative">
                <a class="navbar-brand" href="">
                    <img class="navbar-brand-regular" src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>img/logo/logo-lman-40-teks.png" alt="brand-logo">
                    <img class="navbar-brand-sticky" src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>img/logo/logo-lman-40-teks-green.png" alt="sticky brand-logo">
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-inner">
                    <!--  Mobile Menu Toggler -->
                    <button class="navbar-toggler d-lg-none" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <nav>
                        <ul class="navbar-nav" id="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link scroll" href="#home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll" href="#pengumuman">Pengumuman</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll" href="#kontenkhusus">Master File</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll" href="#faq">FAQ's</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll" href="#">Terms &amp; Conditions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll" href="#contact">Kontak Kami</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll" href="#home">Pendaftaran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll" href="#login">Login</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <!-- ***** Header End ***** -->

        <!-- ***** Welcome Area Start ***** -->
        <section id="home" class="section welcome-area bg-overlay d-flex align-items-center ptb-100">
            
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!-- Welcome Intro Start -->
                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="welcome-intro">
                            
                            <!-- <div class="col-12 col-md-8 col-lg-12"> -->
                                <!-- App Screenshot Slider Area -->
                                <div class="app-screenshots">
                                    <!-- Single Screenshot Item -->
                                    <div class="single-screenshot">
                                        <a class="nav-link scroll" href="#kontenkhusus">
                                            <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>img/banner/Banner Website DJKN_Untuk Web VMS.png" alt="">
                                        </a>
                                    </div>
                                    
                                    <!-- Single Screenshot Item -->
                                    <div class="single-screenshot">
                                        <a class="nav-link scroll" href="#kontenkhusus">
                                            <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>img/banner/Banner Website DJKN_Untuk Web VMS 2.png" alt="">
                                        </a>
                                    </div>
                                    <!-- Single Screenshot Item -->
                                    <!-- <div class="single-screenshot">
                                        <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>img/screenshots/3.jpg" alt="">
                                    </div> -->
                                    <!-- Single Screenshot Item -->
                                    <!-- <div class="single-screenshot">
                                        <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>img/screenshots/4.jpg" alt="">
                                    </div> -->
                                    <!-- Single Screenshot Item -->
                                    <!-- <div class="single-screenshot">
                                        <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>img/screenshots/5.jpg" alt="">
                                    </div> -->
                                </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 col-lg-4">
                        <!-- Contact Box -->
                        <div class="contact-box bg-white text-center rounded p-4 p-sm-5 mt-5 mt-lg-0 shadow-lg">
                            <!-- Contact Form -->
                            <form id="form-pendaftaran">
                                <div class="contact-top">
                                    <h4 class="contact-title">Pendaftaran Penyedia</h4>
                                    <h5 class="text-info fw-3 py-3">Pastikan Alamat Email Benar</h5>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <!-- <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Name" required="required">
                                        </div> -->
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
                                        </div>
                                        <div class="form-group row">
                                            <!-- <div class="row"> -->
                                            <div class="col-12 col-lg-6">
                                                <p id="captImg" class="captcha-img"><?php echo $cap_image; ?></p>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><a href="#" class="reload-captcha" ><i class="fas fa-sync fa-spin"></i></a></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="captcha" placeholder="captcha" required="required">
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                        </div>
                                        <!-- <div class="form-group">
                                            <input type="text" class="form-control" name="phone" placeholder="Phone" required="required">
                                        </div> -->
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-bordered w-50 mt-3 mt-sm-4" type="submit">Submit</button>
                                        <div class="contact-bottom">
                                            <span class="d-inline-block mt-3">By signing up, you accept our <a href="#">Terms and Privacy Policy</a></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <p class="form-message"></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shape Bottom -->
            <div class="shape-bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
                    <path class="shape-fill" fill="#FFFFFF" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7  c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4  c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
                </svg>
            </div>
        </section>
        <!-- ***** Welcome Area End ***** -->

        <!-- ***** Pengumuman Area Start ***** -->
        <section id="pengumuman" class="section features-area bg-gray style-two overflow-hidden ptb_100">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-6">
                        <div class="section-heading">
                            <h2>Pengumuman Pengadaan</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 ">
                        <table id="tbl_list_pengadaan" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">Kode</th>
                                    <th width="50%">Nama Pengadaan</th>
                                    <th width="20%">Instansi</th>
                                    <th width="20%">Tahap</th>
                                    <th width="5%">HPS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>3435</td>
                                    <td>Pengadaan </td>
                                    <td>LMAN </td>
                                    <td>8 Juni 2020 </td>
                                    <td>345 JT</td>
                                </tr>
                                <tr>
                                    <td>34345</td>
                                    <td>Form Pendaftaran</td>
                                    <td>LMAN</td>
                                    <td>Form Pendaftaran</td>
                                    <td>2 M </td>
                                </tr>
                                <tr>
                                    <td>24324</td>
                                    <td>Form Pendaftaran</td>
                                    <td>LMAN</td>
                                    <td>Form Pendaftaran</td>
                                    <td>345,6 JT </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Features Area End ***** -->

        <!-- ***** Screenshots Area Start ***** -->
        <section id="kontenkhusus" class="section screenshots-area ptb_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-7">
                        <!-- Section Heading -->
                        <div class="section-heading text-center">
                            <h2 class="text-capitalize">Pengumuman dan Master File</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table id="tbl_master_file" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="75%">Konten Download (Klik untuk download)</th>
                                    <th width="20%">Waktu Posting</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Screenshots Area End ***** -->

        <!-- ***** Price Plan Area Start ***** -->
        <section id="faq" class="section price-plan-area bg-gray overflow-hidden ptb_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-7" style="height: 81px;">
                        <!-- Section Heading -->
                        <div class="section-heading text-center">
                            <h2>Frequently Ask Questions</h2>
                            <!-- <p class="d-none d-sm-block mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati dignissimos quae quo ad iste ipsum officiis deleniti asperiores sit.</p>
                            <p class="d-block d-sm-none mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati.</p> -->
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <!-- FAQ Content -->
                        <div class="faq-content">
                            <!-- <span class="d-block text-center mt-5">Not sure what to choose? <a href="#">Contact Us</a></span> -->
                            <!-- sApp Accordion -->
                            <div class="accordion pt-2" id="apolo-accordion">
                                <div class="row">
                                    <!-- <div class="col-12 col-md-12"> -->
                                    <div class="col-12">
                                        <!-- Single Accordion Item -->
                                        <div class="card my-2">
                                            <!-- Card Header -->
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <!-- <span class="icon align-self-center"><i class="fas fa-check fa"></i></span> -->
                                                    <!-- <div class="social-icon mr-3">
                                                        <i class="fas fa-home"></i>
                                                    </div> -->
                                                    <button class="btn collapsed p-2" type="button" data-toggle="collapse" data-target="#collapseOne">
                                                        <div class="list-box media">
                                                            <span class="icon align-self-center"><i class="fas fa-question fa-spin"></i></span>
                                                            &nbsp; How to install sApp
                                                        </div>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseOne" class="collapse" data-parent="#apolo-accordion">
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa.
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Accordion Item -->
                                        <div class="card my-2">
                                            <!-- Card Header -->
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn collapsed p-2" type="button" data-toggle="collapse" data-target="#collapseTwo">
                                                    <div class="list-box media">
                                                            <span class="icon align-self-center"><i class="fas fa-question fa-spin"></i></span>
                                                            &nbsp; Can I get support from the Author?
                                                        </div>
                                                        
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#apolo-accordion">
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa.
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Accordion Item -->
                                        <div class="card my-2">
                                            <!-- Card Header -->
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn collapsed p-2" type="button" data-toggle="collapse" data-target="#collapseThree">
                                                        Contact form isn't working?
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseThree" class="collapse" data-parent="#apolo-accordion">
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa.
                                                </div>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                    <!-- <div class="col-12 col-lg-6"> -->
                                        <div class="card my-2">
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn collapsed p-2" type="button" data-toggle="collapse" data-target="#collapseFour">
                                                        What about the events?
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseFour" class="collapse" data-parent="#apolo-accordion">
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card my-2">
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn collapsed p-2" type="button" data-toggle="collapse" data-target="#collapseFive">
                                                        How can I get product update?
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseFive" class="collapse" data-parent="#apolo-accordion">
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card my-2">
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn collapsed p-2" type="button" data-toggle="collapse" data-target="#collapseSix">
                                                        Is this template support rtl?
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseSix" class="collapse" data-parent="#apolo-accordion">
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Price Plan Area End ***** -->

        <!-- ***** Subscribe Area End ***** -->

        <!--====== Contact Area Start ======-->
        <section id="contact" class="contact-area ptb_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-7">
                        <!-- Section Heading -->
                        <div class="section-heading text-center">
                            <h2 class="text-capitalize">Kontak Kami</h2>
                            <p class="d-none d-sm-block mt-4">Lembaga Manajemen Aset Negara</p>
                            <!-- <p class="d-block d-sm-none mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati.</p> -->
                        </div>
                    </div>
                    
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-5">
                        <!-- Contact Us -->
                        <div class="contact-us">
                            <!-- <p class="mb-3">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p> -->
                            <ul>
                                <li class="py-2">
                                    <a class="media" href="#">
                                        <div class="social-icon mr-3">
                                            <i class="fas fa-home"></i>
                                        </div>
                                        <span class="media-body align-self-center">Jl. Diponegoro No. 62A, Pegangsaan, Kec. Menteng, Jakarta Pusat</span>
                                    </a>
                                </li>
                                <li class="py-2">
                                    <a class="media" href="#">
                                        <div class="social-icon mr-3">
                                            <i class="fas fa-phone-alt"></i>
                                        </div>
                                        <span class="media-body align-self-center">(021) 1500-417</span>
                                    </a>
                                </li>
                                <li class="py-2">
                                    <a class="media" href="#">
                                        <div class="social-icon mr-3">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <span class="media-body align-self-center">procurement.lman@kemenkeu.go.id</span>
                                    </a>
                                </li>
                                <li class="py-2">
                                    <a class="media" href="#">
                                        <div class="social-icon mr-3">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <span class="media-body align-self-center">Senin - Jum'at - 8:00 s.d. 17:00 WIB <br> Sabtu dan Minggu - tutup</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="login" class="section work-area bg-overlay overflow-hidden ptb_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        <!-- Work Content -->
                        <div class="work-content text-center">
                            <h2 class="text-white">Login Aplikasi</h2>
                            <p class="text-white my-2 mt-sm-2 mb-sm-2">Masukkan UserId(email) dan Password</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                        <div class="col-12 col-lg-6">
                            <!-- Contact Box -->
                            <div class="contact-box bg-white text-center p-5 p-sm-5 mt-5 mt-lg-0 shadow-lg">
                                <!-- Contact Form -->
                                <form id="form-login">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="email" class="form-control" name="email" placeholder="UserID (Email)" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                                </div>
                                                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <!-- <div class="row"> -->
                                                <div class="col-12 col-lg-6">
                                                    <div id="captImg" class="captcha-img"><?php echo $cap_image; ?></div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><a href="#" class="reload-captcha" ><i class="fas fa-sync fa-spin"></i></a></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="captcha" placeholder="captcha" required="required">
                                                    </div>
                                                </div>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-bordered w-100 mt-3 mt-sm-4" type="submit">Login</button>
                                            <div class="contact-bottom">
                                                <span class="d-inline-block mt-3">By signing, you accept our <a href="#">Terms &amp; Privacy Policy</a></span>
                                            </div>
                                        </div>
                                        <!-- <div class="col-12">
                                            <span class="d-block pt-2 mt-4 border-top">Don't have an account? <a class="nav-link scroll" href="#home">Sign Up</a></span>
                                        </div> -->
                                    </div>
                                </form>
                                <!-- <p class="form-message">tes</p> -->
                            </div>
                        </div>
                </div>
            </div>
        </section>
        <!--====== Contact Area End ======-->

        <!--====== Height Emulator Area Start ======-->
        <div class="height-emulator d-none d-lg-block"></div>
        <!--====== Height Emulator Area End ======-->

        <!--====== Footer Area Start ======-->
        <footer class="footer-area footer-fixed">
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="container">
                    <!-- <div class="row"> -->
                        <div class="col-12">
                            <!-- Copyright Area -->
                            <div class="copyright-area d-flex flex-wrap justify-content-center justify-content-sm-between text-center py-4">
                                <!-- Copyright Left -->
                                <div class="copyright-left">
                                    <img class="logo" src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>img/logo/logo-lman-40-teks-green.png" alt="">
                                </div>
                                <div class="copyright-center">
                                    <p>
                                       <strong>&copy; Lembaga Manajemen Aset Negara,</strong> hak cipta dilindungi Undang-Undang.
                                    </p>
                                </div>
                                <!-- Copyright Right -->
                                <div class="copyright-right">
                                    <div class="social-icons d-flex" style="margin-right: 10px;">
                                        <a class="website" href="https://lman.kemenkeu.go.id" target="_blank" >
                                            <i class="fab fa-internet-explorer"></i>
                                            <i class="fab fa-internet-explorer"></i>
                                        </a>
                                        <a class="facebook" href="https://www.facebook.com/LembagaManajemenAsetNegara/" target="_blank" >
                                            <i class="fab fa-facebook-f"></i>
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a class="instagram" href="https://www.instagram.com/blu.lman" target="_blank" >
                                            <i class="fab fa-instagram"></i>
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                        <a class="linkedin" href="https://id.linkedin.com/company/lembaga-manajemen-aset-negara" target="_blank" >
                                            <i class="fab fa-linkedin"></i>
                                            <i class="fab fa-linkedin"></i>
                                        </a>
                                        <a class="youtube" href="https://www.youtube.com/channel/UCS-LYM9HjcP9_XyW4G1zHqA" target="_blank" >
                                            <i class="fab fa-youtube"></i>
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </div>
                                    <!-- Made with <i class="fas fa-heart"></i> By <a href="#">Theme Land</a> -->
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </footer>
        <!--====== Footer Area End ======-->
    </div>

    <?php
$footer['js'] = array(
	'js/lman-vms/landing.js'
	);
?>
<?php
$this->load->view( PLATFORM_PATH.'general/footer', $footer);
?>
