<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('email/header'); ?>

<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550">Hai, <?php if (isset($name)){ echo $name; } ?></div>
<br>

<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
    Pemulihan akun Anda berhasil. Berikut ini adalah password baru Anda:<br /><br />
	<center><b><?php echo $password; ?></b></center><br />
	Setelah Anda berhasil masuk menggunakan password baru tersebut, kami sangat menyarankan agar Anda segera mengganti password yang lebih aman dan mudah Anda ingat. 
  <br><br>
</div>

<?php $this->load->view('email/footer'); ?>