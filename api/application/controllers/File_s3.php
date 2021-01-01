<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Name        : File_s3 (Controller)
| Author    : Brana Pandega
|--------------------------------------------------------------------------
*/
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class File_s3 extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    public function index() {}

    /*
    untuk memberikan url upload (tujuan "action" form upload)
    web apps sih ngga butuh2 amat (bisa diset di config walau bakal ribet), tapi mobile apps akan butuh, jadinya sekalian dibuat fungsi di APInya
    */
    public function get_s3_upload_url_post() {
        
        // $valid_login = true; // WARNING: nanti ditambah script cek login di sini //

        if ( VALID_LOGIN === true ) {
            $this->response(array(
                'status' => 'success',
                'message' => null,
                'url' => 'https://'.$this->config->item('s3_endpoint').'/'.$this->config->item('s3_bucket_name').'/'
            ));
        } else {
            // $result = array(
            //     'status' => 'error',
            //     'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            // );
            $this->response( array('status'=>'error',
                'message'=>'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }

        // json result
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
    } // akhir - get_s3_upload_url

    /*
    untuk memberikan parameter2 upload file ke server S3
    parameter2 tersebut nantinya harus dalam satu form (berbentuk data POST) bersama dengan file yang diupload
    */
    public function get_s3_upload_auth($folder = null, $access_type = 'private') {
        
        $access_type = ( $access_type == 'public' ? 'public' : 'private' );
        $_POST = json_decode(file_get_contents("php://input"), true);
        print_r($_POST);die();
        $valid_login = true; // WARNING: nanti ditambah script cek login di sini //
        if(!empty($this->session->userdata('id'))){
            $this->load->library('form_validation');
			$this->form_validation->set_rules('nama_foto', 'Keterangan', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");
             
            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors(),
                    'token_csrf'=> $this->security->get_csrf_hash()
                );
            } else {
                $this->load->library('s3');
                
                /// !!!!! PENDING FORM VALIDATION
                
                $file_name_input = strtolower(str_replace(" ", "-", $this->input->post('file_name',true)));
                $nama_foto = strtolower(str_replace(" ", "-", $this->input->post('nama_foto',true)));
                $file_id    = $this->mx_encryption->decrypt($this->session->userdata('id'));
                $ext = $this->getExtension($file_name_input);
                $file_name ="foto-kantor-".$nama_foto."-".$file_id.".".$ext ;
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
                        'data' => $data,
                        'token_csrf'=> $this->security->get_csrf_hash()
                    );

                } else {
                    // create result
                    $result = array(
                        'status' => 'error',
                        'token_csrf'=> $this->security->get_csrf_hash(),
                        'message' => 'Gagal meminta data otentikasi ke server S3 (file storage).'
                    );
                }
            }

        } else {
            $result = array(
                'status' => 'error',
                'token_csrf'=> $this->security->get_csrf_hash(),
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));

    } // akhir - get_s3_upload_auth
    public function get_s3_upload_auth2($folder = null, $access_type = 'private') {
        
        $access_type = ( $access_type == 'public' ? 'public' : 'private' );
        // $_POST = json_decode(file_get_contents("php://input"), true);
        // print_r($_POST);die();
        $valid_login = true; // WARNING: nanti ditambah script cek login di sini //
        if(!empty($this->session->userdata('id'))){
            $this->load->library('form_validation');
			$this->form_validation->set_rules('nama_foto', 'Keterangan', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");
             
            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors(),
                    'token_csrf'=> $this->security->get_csrf_hash()
                );
            } else {
                $this->load->library('s3');
                
                /// !!!!! PENDING FORM VALIDATION
                
                $file_name_input = strtolower(str_replace(" ", "-", $this->input->post('file_name',true)));
                $nama_foto = strtolower(str_replace(" ", "-", $this->input->post('nama_foto',true)));
                $file_id    = $this->mx_encryption->decrypt($this->session->userdata('id'));
                $ext = $this->getExtension($file_name_input);
                $file_name ="foto-kantor-".$nama_foto."-".$file_id.".".$ext ;
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
                        'data' => $data,
                        'token_csrf'=> $this->security->get_csrf_hash()
                    );

                } else {
                    // create result
                    $result = array(
                        'status' => 'error',
                        'token_csrf'=> $this->security->get_csrf_hash(),
                        'message' => 'Gagal meminta data otentikasi ke server S3 (file storage).'
                    );
                }
            }

        } else {
            $result = array(
                'status' => 'error',
                'token_csrf'=> $this->security->get_csrf_hash(),
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

    public function get_s3_upload_document_post($folderDoc = null,$folder = null, $access_type = 'private') {
        $access_type = ( $access_type == 'public' ? 'public' : 'private' );
        // $_POST = json_decode(file_get_contents("php://input"), true);
        if(VALID_LOGIN === true){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('file_name', 'file_name', 'required');
            
            $this->form_validation->set_error_delimiters("", "\r\n");
             
            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                 $this->response(array(
                    'status' => 'error',
                    'message' => validation_errors(),
                ));
            } else{
                
                $this->load->library('s3');
                
                /// !!!!! PENDING FORM VALIDATION
                
                $file_name_input = strtolower(str_replace(" ", "-", $this->input->post('file_name',true)));
                // $nama_dokumen = strtolower(str_replace(" ", "-", $this->input->post('nama_dokumen',true)));
                // $file_id    = $this->mx_encryption->decrypt($this->session->userdata('id'));
                $ext = $this->getExtension($file_name_input);
                // $file_name =strtolower($folder)."-".$nama_dokumen."-".$file_id.".".$ext ;
                $file_name =time().".".$ext ;
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
                
                $random_prefix = random_string('alnum',10);
                $new_filename = ((!empty($folder)) ? $folderDoc.'/'.$folder.'/':null).date("Y").'/'.date("m").'/'.date("d").'/'.$random_prefix.'-'.$file_name;
                // print_r($new_filename);die();

                $requestHeaders = array(
                    //'Content-Type' => 'binary/octet-stream',
                    'Content-Disposition' => 'attachment; filename='.$random_prefix.'-'.$new_filename
                );

                $mb = 1048576;
                $file_size_limit = 100 * $mb;

                $s3params = $this->s3->getHttpUploadPostParams($this->config->item('s3_bucket_name'), $new_filename, $access_type, 3600, $file_size_limit, '201', $amzHeaders, $requestHeaders);

                if (!empty($s3params)) {
                    foreach ($s3params as $name => $value) {
                        $data[$name] = $value;
                    }

                    // $result = array(
                    //     'status' => 'success',
                    //     'message' => '',
                    //     'bucket' => $this->config->item('s3_bucket_name'),
                    //     'key' => $new_filename,
                    //     'data' => $data,
                    //     'token_csrf'=> $this->security->get_csrf_hash()
                    // );
                    $this->response(array(
                        'status' => 'success',
                        'message' => '',
                        'bucket' => $this->config->item('s3_bucket_name'),
                        'key' => $new_filename,
                        'data' => $data,
                    ));
                    

                } else {
                    // create result
                    $this->response(array(
                        'status' => 'error',
                        'message' => 'Gagal meminta data otentikasi ke server S3 (file storage).'
                    ));
                }
            }

        } else {
            $this->response(array(
                        'status' => 'error',
                        'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
                    ));
        }

        // json result
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));

    } // akhir - get_s3_upload_auth
    public function get_s3_upload_document2($folderDoc = null,$folder = null, $access_type = 'private') {
        $access_type = ( $access_type == 'public' ? 'public' : 'private' );
        // $_POST = json_decode(file_get_contents("php://input"), true);
        $valid_login = true; // WARNING: nanti ditambah script cek login di sini //
        if(!empty($this->session->userdata('id'))){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('token_dokumen', 'token_dokumen', 'required');
            $this->form_validation->set_rules('id_dokumen', 'id_dokumen', 'required');
            $this->form_validation->set_rules('nama_dokumen', 'nama_dokumen', 'required');
            
            
            
            $this->form_validation->set_error_delimiters("", "\r\n");
             
            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => 'Session Habis silahkan refresh halaman atau login ulang',
                    'token_csrf'=> $this->security->get_csrf_hash()
                );
            } else {
                $this->load->library('s3');
                
                /// !!!!! PENDING FORM VALIDATION
                
                $file_name_input = strtolower(str_replace(" ", "-", $this->input->post('file_name',true)));
                $nama_dokumen = strtolower(str_replace(" ", "-", $this->input->post('nama_dokumen',true)));
                $file_id    = $this->mx_encryption->decrypt($this->session->userdata('id'));
                $ext = $this->getExtension($file_name_input);
                $file_name =strtolower($folder)."-".$nama_dokumen."-".$file_id.".".$ext ;
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
                $new_filename = ((!empty($folder)) ? $folderDoc.'/'.$folder.'/':null).date("Y").'/'.date("m").'/'.date("d").'/'.$random_prefix.'-'.$file_name;
                // print_r($new_filename);die();

                $requestHeaders = array(
                    //'Content-Type' => 'binary/octet-stream',
                    'Content-Disposition' => 'attachment; filename='.$random_prefix.'-'.$new_filename
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
                        'data' => $data,
                        'token_csrf'=> $this->security->get_csrf_hash()
                    );

                } else {
                    // create result
                    $result = array(
                        'status' => 'error',
                        'token_csrf'=> $this->security->get_csrf_hash(),
                        'message' => 'Gagal meminta data otentikasi ke server S3 (file storage).'
                    );
                }
            }

        } else {
            $result = array(
                'status' => 'error',
                'token_csrf'=> $this->security->get_csrf_hash(),
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));

    } // akhir - get_s3_upload_auth

    function getExtension($str)
	{
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
	
	
	//untuk save file
	public function save_file_post()
	{
	    if(VALID_LOGIN === true){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'id', 'required');
            $this->form_validation->set_rules('s3_bucket', 's3_bucket', 'required');
            $this->form_validation->set_rules('s3_object', 's3_object', 'required');
            
            $this->form_validation->set_error_delimiters("", "\r\n");
             
            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                 $this->response(array(
                    'status' => 'error',
                    'message' => validation_errors(),
                ));
            } else{
                $postdata = ($_POST);
                $data = array(
                        'document_id'    => $postdata['id'],
                        's3_bucket'      => $postdata['s3_bucket'],
                        's3_object'      => $postdata['s3_object']
                    );
                    //   'status'    =>'ACTIVE'
                $this->load->model('File_model');
                $data_id = $this->File_model->insert_document($data);
                if ($data_id != false){
                    $this->response(array('status'=>true,'id'=>$data_id,'message'=>'Berhasil Simpan'),200);
                } else {
                    $this->response( array('status'=>false,'id'=>'',
                        'message'=>'Terjadi kesalahan saat Upload Dokumen, silakan ulangi lagi.'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
                    // $this->response(array(
                    //     'status' => 'success',
                    //     'message' => '',
                    //     'bucket' => $this->config->item('s3_bucket_name'),
                    //     'key' => $new_filename,
                    //     'data' => $data,
                    // ));
                    

               
            }

        } else {
            $result = array(
                'status' => 'error',
                'token_csrf'=> $this->security->get_csrf_hash(),
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }
	}
	
	public function get_s3_upload_bidang_post($folderDoc = null,$folder = null, $access_type = 'private') {
        $access_type = ( $access_type == 'public' ? 'public' : 'private' );
        // $_POST = json_decode(file_get_contents("php://input"), true);
        if(VALID_LOGIN === true){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('file_name', 'file_name', 'required');
            $this->form_validation->set_rules('id', 'id', 'required');
            
            $this->form_validation->set_error_delimiters("", "\r\n");
             
            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                 $this->response(array(
                    'status' => 'error',
                    'message' => validation_errors(),
                ));
            } else{
                
                $this->load->library('s3');
                
                /// !!!!! PENDING FORM VALIDATION
                
                $file_name_input = strtolower(str_replace(" ", "-", $this->input->post('file_name',true)));
                $folderDetail = strtoupper(str_replace(" ", "-", $this->input->post('folder',true)));
                // $nama_dokumen = strtolower(str_replace(" ", "-", $this->input->post('nama_dokumen',true)));
                // $file_id    = $this->mx_encryption->decrypt($this->session->userdata('id'));
                $ext = $this->getExtension($file_name_input);
                // $file_name =strtolower($folder)."-".$nama_dokumen."-".$file_id.".".$ext ;
                $file_name =time().".".$ext ;
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
                
                $random_prefix = random_string('alnum',10);
                $new_filename = ((!empty($folder)) ? $folderDoc.'/'.$folder.'/'.$folderDetail.'/':null).date("Y").'/'.date("m").'/'.date("d").'/'.$random_prefix.'-'.$file_name;
                // print_r($new_filename);die();

                $requestHeaders = array(
                    //'Content-Type' => 'binary/octet-stream',
                    'Content-Disposition' => 'attachment; filename='.$random_prefix.'-'.$new_filename
                );

                $mb = 1048576;
                $file_size_limit = 100 * $mb;

                $s3params = $this->s3->getHttpUploadPostParams($this->config->item('s3_bucket_name'), $new_filename, $access_type, 3600, $file_size_limit, '201', $amzHeaders, $requestHeaders);

                if (!empty($s3params)) {
                    foreach ($s3params as $name => $value) {
                        $data[$name] = $value;
                    }

                    // $result = array(
                    //     'status' => 'success',
                    //     'message' => '',
                    //     'bucket' => $this->config->item('s3_bucket_name'),
                    //     'key' => $new_filename,
                    //     'data' => $data,
                    //     'token_csrf'=> $this->security->get_csrf_hash()
                    // );
                    $this->response(array(
                        'status' => 'success',
                        'message' => '',
                        'bucket' => $this->config->item('s3_bucket_name'),
                        'key' => $new_filename,
                        'data' => $data,
                    ));
                    

                } else {
                    // create result
                    $this->response(array(
                        'status' => 'error',
                        'message' => 'Gagal meminta data otentikasi ke server S3 (file storage).'
                    ));
                }
            }

        } else {
            $this->response(array(
                        'status' => 'error',
                        'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
                    ));
        }

        // json result
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));

    } // akhir
    //untuk save file
	public function save_file_field_post()
	{
	    if(VALID_LOGIN === true){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'id', 'required');
            $this->form_validation->set_rules('s3_bucket', 's3_bucket', 'required');
            $this->form_validation->set_rules('s3_object', 's3_object', 'required');
            
            $this->form_validation->set_error_delimiters("", "\r\n");
             
            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                 $this->response(array(
                    'status' => 'error',
                    'message' => validation_errors(),
                ));
            } else{
                $postdata = ($_POST);
                $data = array(
                        'document_id'    => $postdata['id'],
                        's3_bucket'      => $postdata['s3_bucket'],
                        's3_object'      => $postdata['s3_object'],
                        'date'           => date('Y-m-d H:i:s')
                    );
                    //   'status'    =>'ACTIVE'
                $this->load->model('File_model');
                $data_id = $this->File_model->insert_field_document($data);
                if ($data_id != false){
                    $this->response(array('status'=>true,'id'=>$data_id,'message'=>'Berhasil Simpan'),200);
                } else {
                    $this->response( array('status'=>false,'id'=>'',
                        'message'=>'Terjadi kesalahan saat Upload Dokumen, silakan ulangi lagi.'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
                    // $this->response(array(
                    //     'status' => 'success',
                    //     'message' => '',
                    //     'bucket' => $this->config->item('s3_bucket_name'),
                    //     'key' => $new_filename,
                    //     'data' => $data,
                    // ));
                    

               
            }

        } else {
            $result = array(
                'status' => 'error',
                'token_csrf'=> $this->security->get_csrf_hash(),
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }
	}
}
// akhir - class
