<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Common_mdl extends CI_Model {
 
function amazons3Upload( $image_name , $fileTempName, $upload_folder ){
 
    $awsAccessKey = 'LMAN839Q5CTHX83TFAC7'; //AWS account access key
    $awsSecretKey = 'mq2YdlJMpfHiuszyrk6s834hujzDdrVbvQjgCWVBZ5'; //AWS account secret key
    $bucket_name  = 'vms';  //Bucket name 
    $s3           = new S3($awsAccessKey, $awsSecretKey);
    $s3->putBucket($bucket_name);
    var_dump($s3->putBucket($bucket_name));
        
    //move the file
    // if ($s3->putObjectFile($fileTempName, $bucket_name, $upload_folder.'/'.$image_name, S3::ACL_PUBLIC_READ)) {
    if ($s3->putObjectFile($fileTempName, $bucket_name, $image_name, S3::ACL_PUBLIC_READ)) {
      return '1'; //return 1 it will success
    }else{
      return '7';
    }
  }
}