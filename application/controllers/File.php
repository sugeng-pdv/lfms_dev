<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class File extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: authorization");

    }

    public function index() {}

    public function get_s3_url(){
        $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('File_s3/get_s3_upload_url',$postdata,'POST');
		echo json_encode($result);
    }
    public function upload_file(){
        // file-s3/get_s3_upload_document2/DOKUMEN/SPP/public
        $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('file-s3/get_s3_upload_document/DOKUMEN/SPP/public',$postdata,'POST');
		echo json_encode($result);
    }
    public function save_file()
    {
        $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('file-s3/save_file',$postdata,'POST');
		echo json_encode($result);
    }
    
    public function upload_file_field()
    {
        $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('file-s3/get_s3_upload_bidang/DOKUMEN/BIDANG/public',$postdata,'POST');
		echo json_encode($result);
    }
    public function save_file_field()
    {
        $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('file-s3/save_file_field',$postdata,'POST');
		echo json_encode($result);
    }

}
// akhir - class
