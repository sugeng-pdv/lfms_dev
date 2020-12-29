<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view(PLATFORM_PATH.'email/header'); ?>

<div class='body-text' style='font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333'>
  
    <table align='center' role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%' style='margin:0 auto'>
            
            <tbody>
            <tr>
                <td style='padding:0px 0px 0px 20px;text-align:center;font-family:sans-serif;background-color:#2e6768;color:white'>
                    <h3>Vendor Management System LMAN</h3>
                </td>
            </tr>
            <tr>
                <td style='background-color:#ffffff'>
                    
                  <table   role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%'>
                      <tbody>
                          <tr>
                              <td>
                                  <p style='margin:0'>Kepada Yth.</p>
                                  <p style='margin:0'>Pemilik Email <strong><a href='mailto:<?php if (isset($email_to)){ echo $email_to; } ?>' target='_blank'><?php if (isset($email_to)){ echo $email_to; } ?></a></strong></p>
                                  <p style='margin:0'>di</p>
                                  <p style='margin:0'>Tempat</p>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  <p style='margin:0'>
                                  Kami ucapkan terima kasih atas partisipasi Saudara pada Vendor Management System Lembaga Manajemen Aset Negara (LMAN). Dengan menerima email ini berarti Saudara telah melakukan pendaftaran secara online pada Vendor Management System LMAN.
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  <p style='margin:0'>
                                    Pendaftaran akun Vendor Management System LMAN telah berhasil, dengan informasi akun sebagai berikut:
                                    <br /><br />
                                    Alamat Email : <strong><?php if (isset($email_to)){ echo $email_to; } ?></strong><br/>
                                    Password   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <strong><?php if (isset($default_password)){ echo $default_password; } ?></strong><br />
                                      <br />
                                      Untuk masuk silakan buka tautan berikut ini:<br />
                                    <center><h2><a href='<?php echo $this->config->item('static_base_url'); ?>' target='_blank'><?php echo $this->config->item('static_base_url'); ?></a></h2></center>
                                    Gunakan email sebagai user-id dan password di atas untuk login. Segera ganti password default dengan standar password yang aman.
                                    Untuk menghindari penggunaan user-id dan password anda oleh pihak2 yang tidak bertanggung jawab, ubah password secara berkala.
                                    Jika memerlukan informasi atau bantuan lebih lanjut silakan menghubungi layanan kami di nomor whatsapp <strong>0878-7001-6878</strong> (text only) di jam operasional atau melalui email <a href='mailto:procurement.lman@kemenkeu.go.id'>procurement.lman@kemenkeu.go.id</a>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  <p style='margin:0'>
                                      Untuk menghindari penggunaan kode akses oleh pihak-pihak yang tidak bertanggung jawab, kami mohon Bapak/Ibu
                                      menghubungi petugas pengadaan di Lembaga Manajemen Aset Negara jika Bapak/Ibu lupa baik User ID/email  dan password.
                                  </p>
                              </td>
                          </tr>
                          <tr>
                              <td style='padding:40px 20px 20px 20px;font-family:sans-serif;font-size:15px;line-height:20px;color:#555555'>
                                  <p style='margin:0'>Hormat Kami,</p>
                                  <p style='margin:0'>Unit Kerja Pengadaan LMAN</p>
                              </td>
                          </tr>
                      </tbody>
                  </table>
                </td>
            </tr>
      </table>
      <table align='center' role='presentation' cellspacing='0' cellpadding='0' width='100%' style='margin:0 auto'>
            <tbody><tr>
                <td style='padding:20px;background-color:#ffffff;font-family:sans-serif;font-size:14px;color:#888888'>
                    Email ini dihasilkan secara otomatis, mohon untuk tidak membalas email ini.
                </td>
            </tr>
        </tbody></table>
</div>

<?php $this->load->view(PLATFORM_PATH.'email/footer'); ?>