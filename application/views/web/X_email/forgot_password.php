<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('email/header'); ?>

<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550">Hai, <?php if (isset($name)){ echo $name; } ?></div>
<br>

<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
    Kami telah menerima permintaan pemulihan akun Anda. Silakan buka tautan berikut ini untuk mendapatkan password baru (reset password):<br /><br />
	<center><b><a href="<?php echo base_url().'accounts/password-reset/'.$user_id.'/'.$recovery_code; ?>">Reset Password</a></b></center><br />
	Tautan tersebut hanya berlaku sampai dengan <?php echo $expired; ?>.<br/><br/>
	Abaikan email ini jika Anda tidak pernah meminta pemulihan akun.
  <br><br>
</div>

<?php $this->load->view('email/footer'); ?>