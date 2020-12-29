<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('email/header'); ?>

<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550">Hai, <?php if (isset($nama_owner)){ echo $nama_owner; } ?></div>
<br>

<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
    Perusahaan Anda (<?php if (isset($nama_vendor)){ echo $nama_vendor; } ?>) diundang untuk mengikuti tender berikut ini:
    <br /><br />
	Kode Tender : <?php if (isset($kode_tender)){ echo $kode_tender; } ?><br />
	Nama Tender : <?php if (isset($nama_tender)){ echo $nama_tender; } ?><br />
	URL (link) Tender : <?php if (isset($url_tender)){ echo $url_tender; } ?><br />
    <br />
  <br><br>
</div>

<?php $this->load->view('email/footer'); ?>