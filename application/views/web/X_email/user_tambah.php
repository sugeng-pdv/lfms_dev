<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('email/header'); ?>

<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550">Hai, <?php if (isset($name)){ echo $name; } ?></div>
<br>

<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
    Pendaftaran akun Anda di back-end e-Procurement berhasil. Berikut ini informasi akun Anda:
    <br /><br />
	Alamat Email : <?php if (isset($email)){ echo $email; } ?><br />
	Password : <?php if (isset($default_password)){ echo $default_password; } ?><br />
    <br />
    Untuk masuk silakan buka tautan berikut ini:<br /><br />
	<center><b><a href="<?php echo base_url(); ?>"><?php echo base_url(); ?></a></b></center><br />
	Kemudian gunakan alamat e-mail dan password di atas untuk masuk. Setelah berhasil masuk, segera ganti password default tersebut menjadi password yang lebih aman dan mudah Anda ingat.
  <br><br>
</div>

<?php $this->load->view('email/footer'); ?>