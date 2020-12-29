<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view(PLATFORM_PATH.'email/header'); ?>

<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550">Hai, <?php if (isset($name)){ echo $name; } ?></div>
<br>

<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
Kepada Yth.<br>
Pemilik Email <strong><?php if (isset($email)){ echo $email; } ?></strong><br>
di<br>
Tempat<br><br>
    <p>Sebelumnya perkenankan kami mengucapkan terima kasih atas partisipasi Bapak/Ibu pada Layanan Pengadaan Secara Elektronik di Lembaga Manajemen Aset Negara. 
    Dengan menerima email ini maka Bapak/Ibu telah melakukan pendaftaran secara online pada Sistem Pengadaan Secara Elektronik.</p>
    Pendaftaran akun e-Procurement di Lembaga Manajemen Aset Negara telah berhasil. Berikut ini informasi akun Anda:
    <br /><br />
	Alamat Email : <strong><?php if (isset($email)){ echo $email; } ?></strong><br/>
	Password   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <strong><?php if (isset($default_password)){ echo $default_password; } ?></strong><br />
    <br />
    Untuk masuk silakan buka tautan berikut ini:<br /><br />
	<center><b><a href="<?php echo $this->config->item('static_base_url'); ?>" target="_blank"><?php echo $this->config->item('static_base_url'); ?></a></b></center><br />
	Kemudian gunakan alamat e-mail dan password di atas untuk masuk. Setelah berhasil masuk, segera ganti password default tersebut menjadi password yang lebih aman dan mudah Anda ingat.
  <br><br>
</div>

<?php $this->load->view(PLATFORM_PATH.'email/footer'); ?>