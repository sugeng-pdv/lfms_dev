<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* SSO LMAN */
$config['sso_endpoint'] = 'https://asetnegara.id/sso/';

$config['email_api_endpoint'] = 'https://asetnegara.id/mail-api/v1/';


/* 
base url untuk view file di server S3
penggunaan :
$this->config->item('view_file_url').$LOKASI_FILE
*/
$config['view_file_url'] = 'https://file.asetnegara.id/file/view';

/* 
gambar ukuran full
penggunaan :
$this->config->item('image_url_full').$LOKASI_FILE
*/
$config['image_url_full'] = 'https://file.asetnegara.id/image/full/';
/* 
thumbnail (kotak)
penggunaan :
$this->config->item('image_url_thumb').$RESOLUSI_W.'/'.$RESOLUSI_H.'/'.$LOKASI_FILE
*/
//$config['image_url_thumb'] = 'https://lman.klik.co.id/img-thumb/';
$config['image_url_thumb'] = 'https://file.asetnegara.id/image/crop/';
$config['image_url_crop'] = 'https://file.asetnegara.id/image/crop/';
/* 
image lite (aspek rasio tetap)
penggunaan :
$this->config->item('image_url_lite').$LEBAR.'/'.$LOKASI_FILE
*/
$config['image_url_lite'] = 'https://file.asetnegara.id/image/lite/';
