<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Name        : File_s3 (Controller)
| Author    : Brana Pandega
|--------------------------------------------------------------------------
*/

class File_s3 extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: authorization");

    }

    public function index() {}

    /*
    untuk memberikan url upload (tujuan "action" form upload)
    web apps sih ngga butuh2 amat (bisa diset di config walau bakal ribet), tapi mobile apps akan butuh, jadinya sekalian dibuat fungsi di APInya
    */
    public function get_s3_upload_url() {
        
        $valid_login = true; // WARNING: nanti ditambah script cek login di sini //

        if ( $valid_login === true ) {
            // Konfigurasi S3 File Upload
            $result = array(
                'status' => 'success',
                'message' => null,
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
    } // akhir - get_s3_upload_url

    /*
    untuk memberikan parameter2 upload file ke server S3
    parameter2 tersebut nantinya harus dalam satu form (berbentuk data POST) bersama dengan file yang diupload
    */
    public function get_s3_upload_auth($folder = null, $access_type = 'private') {
        
        $access_type = ( $access_type == 'public' ? 'public' : 'private' );
        
        $valid_login = true; // WARNING: nanti ditambah script cek login di sini //

        if ( $valid_login === true ) {

            $this->load->library('s3');
            
            /// !!!!! PENDING FORM VALIDATION
            $_POST = json_decode(file_get_contents("php://input"), true);
            $file_name = strtolower(str_replace(" ", "-", $this->input->post('file_name',true)));

            // menentukan header file type
            switch ($folder){
            case 'IMAGE' :
                $amzHeaders = array(
                    'content_type_starts_with' => 'image/jpg',
                    'starts-with' => 'image/jpg'
                );
            break;
            default :
                $amzHeaders = array();
            }

            $random_prefix = random_string('alnum',3);
            $new_filename = ((!empty($folder)) ? $folder.'/':null).date("Y").'/'.date("m").'/'.date("d").'/'.$random_prefix.'-'.$file_name;

            $requestHeaders = array(
                //'Content-Type' => 'binary/octet-stream',
                'Content-Disposition' => 'attachment; filename='.$random_prefix.'-'.$file_name
            );

            $mb = 1048576;
            $file_size_limit = 100 * $mb;

            $s3params = $this->s3->getHttpUploadPostParams($this->config->item('s3_bucket_name'), $new_filename, $access_type, 3600, $file_size_limit, '201', $amzHeaders, $requestHeaders);

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

    } // akhir - get_s3_upload_auth

    // contoh cara view file di server S3 yang ACL-nya private
    function contoh_view_private_file() {

        // contoh lokasi objeknya
        $s3_object = "IMAGE/2020/07/29/8dk-screen-shot-2020-07-21-at-15.53.35.png";

        $this->load->config('s3');
        $this->load->library('s3');
        if ($authenticated_url = $this->s3->getAuthenticatedURL($this->config->item('s3_bucket_name'), $s3_object, 3600)) {
            $search = 'http://'.$this->config->item('s3_bucket_name').'.'.$this->config->item('s3_endpoint');
            $replace = 'https://'.$this->config->item('s3_endpoint').'/'.$this->config->item('s3_bucket_name');
            $url = str_replace($search, $replace, $authenticated_url);
            
            /*
            // jika ingin generate "Authenticated URL" nya saja untuk didownload (mode download file):
            echo $url;
            */

            /* 
            // jika ingin diview inline (contohnya view file PDF):
            $file = file_get_contents($url);
            header("Content-type:application/pdf"); // <<<<<<<< SESUAIKAN MIME TYPENYA
            header("Content-Disposition: inline; filename='".$s3_object."'");
            echo $file;
            */

            // jika ingin diview inline (contohnya image berformat PNG):
            $file = file_get_contents($url);
            header("Content-type:image/png"); // <<<<<<<< SESUAIKAN MIME TYPENYA
            header("Content-Disposition: inline; filename='".$s3_object."'");
            echo $file;
            
        }

    } // akhir - contoh_view_private_file

}
// akhir - class
