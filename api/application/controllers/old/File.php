<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Name		: File (Controller)
| Author	: Brana Pandega
|--------------------------------------------------------------------------
*/

class File extends CI_Controller {

    function __construct() {
        parent::__construct();

    }

    public function index() {}

    /*
	untuk memberikan url upload (tujuan "action" form upload)
	web apps sih ngga butuh2 amat (bisa diset di config walau bakal ribet), tapi mobile apps akan butuh, jadinya sekalian dibuat fungsi di APInya
	*/
    public function get_s3_upload_url() {
        
        $this->lman_security->validate_request_method('GET');
        if ( $this->access_control->access_granted('UPLOAD_FILE') === true ) {
            // Konfigurasi S3 File Upload
            $this->load->config('s3');
            $result = array(
                'status' => 'success',
                'message' => '',
                'url' => 'https://'.$this->config->item('s3_endpoint').'/'.$this->config->item('s3_bucket_name').'/'
            );
        } else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    /*
    untuk memberikan parameter2 upload file ke server S3
    parameter2 tersebut nantinya harus dalam satu form (berbentuk data POST) bersama dengan file yang diupload
    */
    public function get_s3_upload_auth($folder = null) {
        
        $this->lman_security->validate_request_method('POST');
        if ( $this->access_control->access_granted('UPLOAD_FILE') === true ) {

            $this->load->config('s3');
            $this->load->library('s3');

            /// !!!!! PENDING FORM VALIDATION
            
            $asset_id = $this->input->post('asset_id',true);
            $asset_name = $this->input->post('asset_name',true);
            $file_ext = $this->input->post('file_ext',true);

            if ( !empty($asset_id) AND !empty($asset_name) AND !empty($file_ext) ){
                $file_prefix = $asset_id.'-';
                $file_name = url_title($asset_name,'-',true).'.'.$file_ext;
            }else{
                $file_prefix = null;
                $file_name = strtolower(str_replace(" ", "-", $this->input->post('file_name',true)));
            }
            
            // menentukan header file type
            switch ($folder){
            case 'FOTO' :
                $amzHeaders = array(
                    'content_type_starts_with' => 'image/jpg',
                    'starts-with' => 'image/jpg'
                );
            break;
            default :
                $amzHeaders = array();
            }

            $random_prefix = random_string('alnum',3);
            $new_filename = ((!empty($folder)) ? $folder.'/':null).date("Y").'/'.date("m").'/'.date("d").'/'.$file_prefix.$random_prefix.'-'.$file_name;

            $requestHeaders = array(
                //'Content-Type' => 'binary/octet-stream',
                'Content-Disposition' => 'attachment; filename='.$random_prefix.'-'.$file_prefix.$file_name
            );

            $mb = 1048576;
            $file_size_limit = 100 * $mb;

            $s3params = $this->s3->getHttpUploadPostParams($this->config->item('s3_bucket_name'), $new_filename, 'private', 3600, $file_size_limit, '201', $amzHeaders, $requestHeaders);

            if (!empty($s3params)) {
                foreach ($s3params as $name => $value) {
                    $data[$name] = $value;
                }

                $result = array(
                    'status' => 'success',
                    'message' => '',
                    'bucket' => $this->config->item('s3_bucket_name'),
                    'key' => $new_filename,
                    'data' => $data
                );

            } else {
                // create result
                $result = array(
                    'status' => 'error',
                    'message' => 'Gagal meminta data otentikasi ke server S3 (file storage).'
                );
            }

        } else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));

    }

    /*function view_file_from_s3() {
        $idfile = urldecode($this->input->get('idfile'));

        if ($idfile != '') {

            $this->load->model('Dokumen_permohonan_model');

            $file_name = $this->Dokumen_permohonan_model->detail($idfile)->s3_object;

            $this->load->config('s3');
            $this->load->library('s3');
            if ($authenticated_url = $this->s3->getAuthenticatedURL($this->config->item('s3_bucket_name'), $file_name, 3600)) {
                $search = 'http://'.$this->config->item('s3_bucket_name').'.'.$this->config->item('s3_endpoint');
                $replace = 'https://'.$this->config->item('s3_endpoint').'/'.$this->config->item('s3_bucket_name');
                $url = str_replace($search, $replace, $authenticated_url);

                $file = file_get_contents($url);

                header("Content-type:application/pdf");
                header("Content-Disposition: inline; filename='".$file_name."'");
                echo $file;
            }
        } else {
            echo 'Pemohon tidak melakukan upload pada dokumen ini.';
        }

    }*/

}
// akhir - class