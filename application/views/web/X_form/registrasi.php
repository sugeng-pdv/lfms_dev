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
                                <a class="nav-link" href="<?php echo base_url();?>#home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url();?>#pengumuman">Pengumuman</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url();?>#kontenkhusus">Master File</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url();?>#faq">FAQ's</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url();?>#">Terms &amp; Conditions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url();?>#contact">Kontak Kami</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url();?>#home">Pendaftaran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url();?>#login">Login</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <!-- ***** Header End ***** -->

        <section class="section breadcrumb-area bg-overlay d-flex align-items-center" style="height: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content d-flex flex-column align-items-center text-center">
                            <!-- <h2 class="text-white text-capitalize">Contact Us</h2> -->
                            <!-- <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-uppercase text-white" href="index.html">Home</a></li>
                                <li class="breadcrumb-item text-white active">Contact</li>
                            </ol> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        <section id="form-registrasi" class="register-area bg-gray ptb_50" style="padding-top: 10px;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-8" style="height: 110px;">
                        <!-- Section Heading -->
                        <div class="section-heading">
                            <span class="d-inline-block rounded-pill shadow-sm fw-5 px-4 py-2 mb-3">
                                <i class="far fa-lightbulb text-primary mr-1"></i>
                                <span class="text-primary">Form</span>
                                Registrasi 
                            </span>
                            <h4>Vendor Manajemen Sistem LMAN</h4>
                            <!-- <p class="d-none d-sm-block mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati dignissimos quae quo ad iste ipsum officiis deleniti asperiores sit.</p>
                            <p class="d-block d-sm-none mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati.</p> -->
                        </div>
                    </div>
                </div>
                <form id="registrasi-form">
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-6 pt-2 pt-md-0">
                            <!-- Register Box -->
                            <div class="register-box text-center">
                                <!-- Register Form -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="token" required="required" value="<?php echo $tokenid?>" readonly>
                                                <input type="hidden" class="form-control" name="token_link" required="required" value="<?php echo $token?>" readonly>
                                            </div>
                                            <!-- <div class="form-group">
                                                <input type="text" class="form-control" name="id_penyedia" placeholder="ID Penyedia" required="required">
                                            </div> -->
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="user_id" placeholder="User ID / Email" value="<?php echo $email?>" required="required" readonly>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" name="jenis_usaha" required="required">
                                                    <option value="" selected>Bentuk Usaha</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="nm_perusahaan" placeholder="Nama Perusahaan" required="required">
                                            </div>
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="thn_pendirian" placeholder="Tahun Pendirian" required="required">
                                            </div>
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="npwp" placeholder="NPWP" required="required">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="no_siup_siujk_nib" placeholder="Nomor SIUP/SIUJK/NIB" required="required">
                                            </div>
                                        <!-- </div>
                                        <div class="col-12"> -->
                                            <div class="form-group">
                                                <textarea class="form-control" rows="1" name="alamat" placeholder="Alamat Perusahaan" required="required"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <!-- <button type="submit" class="btn btn-lg btn-block mt-3"><span class="text-white pr-3"><i class="fas fa-paper-plane"></i></span>Send Message</button> -->
                                        </div>
                                    </div>
                                <!-- </form> -->
                                <!-- <p class="form-message"></p> -->
                            </div>
                        </div>
                        <div class="col-12 col-md-6 pt-2 pt-md-0">
                            <!-- Register Box -->
                            <div class="register-box text-center">
                                <!-- Register Form -->
                                <!-- <form id="register-form" method="POST" action="assets/php/mail.php"> -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select class="form-control" name="provinsi" required="required">
                                                    <option value="" selected>Provinsi</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" name="kab_kota" required="required">
                                                    <option value="" selected>Kabupaten/Kota</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="no_tlp" placeholder="No. Telepon (Kode Area + No.Tlp)" required="required">
                                            </div>
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="no_fax" placeholder="No. Fax Perusahaan" required="required">
                                            </div>
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="no_hp" placeholder="No. Handphone Perusahaan" required="required">
                                            </div>
                                            <div class="form-group">
                                                <input type="url" class="form-control" name="website" placeholder="Website (Misal http://google.com)" required="required">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="nm_lengkap" placeholder="Nama Lengkap" required="required">
                                            </div>
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="nik" placeholder="Nomor Induk Pegawai" required="required">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" required="required">
                                            </div>
                                        </div>
                                        <!-- <div class="col-12">
                                            <button type="submit" class="btn btn-lg btn-block mt-3"><span class="text-white pr-3"><i class="fas fa-paper-plane"></i></span>Send Message</button>
                                        </div> -->
                                    </div>
                                <!-- </form> -->
                                <!-- <p class="form-message"></p> -->
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-12 col-lg-6 order-2 order-lg-1">
                            <!-- Discover Text -->
                            <div class="discover-text pt-4 pt-lg-0">
                                <h4 class="pb-4 pb-sm-0">Menyatakan dengan sebenarnya bahwa:</h4>
                                <!-- Check List -->
                                <ul class="check-list">
                                    <li class="py-1">
                                        <!-- List Box -->
                                        <div class="list-box media">
                                            <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                            <span class="media-body pl-2">Saya secara hukum mempunyai kapasitas untuk menandatangani penawaran, kontrak, surat penawaran dan dokumen lainnya (sesuai akte pendirian/perubahannya/surat kuasa).</span>
                                        </div>
                                    </li>
                                    <li class="py-1">
                                        <!-- List Box -->
                                        <div class="list-box media">
                                            <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                            <span class="media-body pl-2">2.	Saya/perusahaan saya tidak sedang dinyatakan pailit atau kegiatan usahanya tidak sedang dihentikan atau tidak sedang menjalani sanksi pidana atau sedang dalam pengawasan pengadilan.</span>
                                        </div>
                                    </li>
                                    <li class="py-1">
                                        <!-- List Box -->
                                        <div class="list-box media">
                                            <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                            <span class="media-body pl-2">Saya dan semua jajaran pengurus perusahaan tidak sedang tersangkut perkara pidana dan/atau perdata.</span>
                                        </div>
                                    </li>
                                    <li class="py-1">
                                        <!-- List Box -->
                                        <div class="list-box media">
                                            <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                            <span class="media-body pl-2">Saya tidak pernah dihukum berdasarkan keputusan pengadilan atas tindakan yang berkaitan dengan kondite profesional saya.</span>
                                        </div>
                                    </li>
                                    <li class="py-1">
                                        <!-- List Box -->
                                        <div class="list-box media">
                                            <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                            <span class="media-body pl-2">Saya/perusahaan saya tidak termasuk dalam daftar hitam instansi pemerintah, perusahaan BUMN/BUMD atau perusahaan swasta</span>
                                        </div>
                                    </li>
                                    <li class="py-1">
                                        <!-- List Box -->
                                        <div class="list-box media">
                                            <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                            <span class="media-body pl-2">Informasi/dokumen/formulir yang akan saya sampaikan adalah benar dan dapat dipertanggungjawabkan secara hukum.</span>
                                        </div>
                                    </li>
                                    <li class="py-1">
                                        <!-- List Box -->
                                        <div class="list-box media">
                                            <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                            <span class="media-body pl-2">Jika kemudian ditemukan bahwa dokumen yang kami berikan tidak benar, maka kami bersedia diproses secara hukum dan dimasukkan ke Daftar Hitam LMAN</span>
                                        </div>
                                    </li>
                                    <li class="py-1">
                                        <!-- List Box -->
                                        <div class="list-box media">
                                            <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                            <span class="media-body pl-2">Bersedia menerima segala Keputusan UKP LMAN dan tidak akan mengganggu gugat</span>
                                        </div>
                                    </li>
                                </ul>
                                <!-- <div class="icon-box d-flex mt-3">
                                    <div class="service-icon">
                                        <span><i class="fas fa-bell"></i></span>
                                    </div>
                                    <div class="service-icon px-3">
                                        <span><i class="fas fa-envelope-open"></i></span>
                                    </div>
                                    <div class="service-icon">
                                        <span><i class="fas fa-video"></i></span>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 order-1 order-lg-2">
                            <!-- Discover Text -->
                            <div class="discover-text pt-4 pt-lg-0">
                                <h4 class="pb-4 pb-sm-0">PAKTA INTEGRITAS</h4>
                                <p class="d-none d-sm-block pt-3 pb-4">Dalam pelaksanaan pekerjaan pengadaan barang dan jasa di lingkungan Lembaga Manajemen Aset Negara (LMAN), Penyedia barang/jasa dan jasa sanggup :</p>
                                <!-- Check List -->
                                <ul class="check-list">
                                    <li class="py-1">
                                        <!-- List Box -->
                                        <div class="list-box media">
                                            <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                            <span class="media-body pl-2">Tidak akan melakukan praktek Korupsi, Kolusi dan Nepotisme (KKN) dengan oknum karyawan Lembaga Manajemen Aset Negara (LMAN) atau sesama Penyedia Barang dan Jasa dalam proses pengadaan barang dan jasa di lingkungan Lembaga Manajemen Aset Negara (LMAN);</span>
                                        </div>
                                    </li>
                                    <li class="py-1">
                                        <!-- List Box -->
                                        <div class="list-box media">
                                            <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                            <span class="media-body pl-2">Memenuhi segala persyaratan yang tercantum pada dokumen pengadaan dan tunduk pada peraturan‐peraturan yang berlaku di lingkungan Lembaga Manajemen Aset Negara (LMAN) serta peraturan perundang‐undangan yang berlaku di Negara Republik Indonesia; </span>
                                        </div>
                                    </li>
                                    <li class="py-1">
                                        <!-- List Box -->
                                        <div class="list-box media">
                                            <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                            <span class="media-body pl-2">Berjanji untuk menyampaikan informasi yang benar dan dapat dipertanggungjawabkan serta melaksanakan tugas secara bersih, transparan, dan profesional dengan mengerahkan segala kemampuan dan sumber daya secara optimal untuk memberikan hasil kerja terbaik mulai dari penyiapan penawaran, pelaksanaan, dan penyelesaian pekerjaan/ pengiriman barang/ penyampaian jasa;</span>
                                        </div>
                                    </li>
                                    <li class="py-1">
                                        <!-- List Box -->
                                        <div class="list-box media">
                                            <span class="icon align-self-center"><i class="fas fa-check"></i></span>
                                            <span class="media-body pl-2">Mendukung dan menerapkan kebijakan yang sejalan dengan Program Pelestarian Lingkungan hidup.</span>
                                        </div>
                                    </li>
                                </ul>
                                <p class="d-none d-sm-block pt-3 pb-4">Apabila di kemudian hari Penyedia barang dan Jasa mengingkari pernyataan di atas atau ditemui bahwa keterangan/data penawaran yang kami berikan tidak benar, maka kami bersedia dituntut di muka pengadilan dan bersedia dikeluarkan dari Daftar Penyedia Barang dan Jasa serta dimasukkan dalam Daftar Hitam (black list) Lembaga Manajemen Aset Negara (LMAN).</p>
                                <!-- <div class="icon-box d-flex mt-3">
                                    <div class="service-icon">
                                        <span><i class="fas fa-bell"></i></span>
                                    </div>
                                    <div class="service-icon px-3">
                                        <span><i class="fas fa-envelope-open"></i></span>
                                    </div>
                                    <div class="service-icon">
                                        <span><i class="fas fa-video"></i></span>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-12">
                            <div class="register-box text-center">
                                <div class="form-group row">
                                    <div class="col-sm-1">
                                        <input type="checkbox" class="form-control" id="accept" required="required">
                                    </div>
                                    <label for="accept_form" class="col-sm-1 col-form-label col-form-label-sm pl-2"><h3>Setuju</h3></label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-block mt-3"><span class="text-white pr-3"><i class="fas fa-paper-plane"></i></span>Kirim Data</button>
                                </div>
                                <div class="col-12">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!--====== Register Area End ======-->

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
	    'js/lman-vms/form_registrasi2.js'
	    );
    ?>
<?php
$this->load->view( PLATFORM_PATH.'general/footer', $footer);
?>
