<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
$config['access_control'] = array(
    
		// Huruf Kapital = Kontrol hak akses berdasarkan nama kewenangan, tidak terikat ke salah satu class/method
		'GENERAL' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
		'ASSET_READ' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
		'REFERENCE' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
		'UPLOAD_FILE' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
		
		
		// Huruf Kecil = Kontrol hak akses spesifik berdasarkan nama class/method :
        'dashboard' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'), // read (view)
		
        'employee' => array('DEVELOPER'), 
		
		'asset/add_basic_data' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
		//'asset/update_handover_data' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
		'asset/update_basic_data' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
		'asset/update_location' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
		// tanah
		'asset/add_land_data' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
		'asset/update_land_data' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
		'asset/add_land_document' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
		// bangunan
		'asset/add_structure_data' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
		'asset/update_structure_data' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
		'asset/add_structure_document' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
		// image & video
        'asset/add_asset_image' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'asset/set_primary_image' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'), 
        'asset/delete_image' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'), 
        'asset/add_asset_video' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'asset/delete_video' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        // fasilitas
        'asset/get_facility' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'asset/add_facility' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'asset/update_facility' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'asset/delete_facility' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'asset/get_public_facility' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'asset/add_public_facility' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'asset/update_public_facility' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'asset/delete_public_facility' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'asset/update_readiness' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        
        // kegiatan pengamanan
        'operational_activity/get_security' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'operational_activity/add_security' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'operational_activity/update_security' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        
        // kegiatan konstruksi
        'operational_activity/get_construction' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'operational_activity/add_construction' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'operational_activity/update_construction' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        
        // kegiatan pemeliharaan
        'operational_activity/get_maintenance' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'operational_activity/add_maintenance' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'operational_activity/update_maintenance' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        
        // kegiatan pemasaran
        'operational_activity/get_marketing' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'operational_activity/add_marketing' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'operational_activity/update_marketing' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        
        // kegiatan business case
        'operational_activity/get_business_case' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'operational_activity/add_business_case' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'operational_activity/update_business_case' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'operational_activity/add_business_case_document' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'operational_activity/delete_business_case_document' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        
        // dokumen kegiatan
        'operational_activity/add_document' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'operational_activity/delete_document' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        
        // kontrak / perjanjian
        'contract' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'contract/get_contract' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'contract/contract_detail' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'contract/add_contract' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'contract/update_contract' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'contract/update_tenant' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'contract/remove_tenant' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'contract/update_tenant_data' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'contract/add_document' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'contract/delete_document' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'contract/search_tenant' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        
        // nilai aset
        'asset_value' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'), // read (view)
        'asset_value/add' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'asset_value/update' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'asset_value/add_document' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'asset_value/delete_document' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),

        // invoice
        'invoice' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'), // read (view)
        'invoice/create' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'invoice/update' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'invoice/issue' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'invoice/delete' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        
        // pembayaran
        'payment' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'), // read (view)
        'payment/update' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'payment/delete' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        
        // kewajiban
        'duty' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'), // read (view)
        'duty/add' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'duty/update' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'duty/add_document' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        'duty/delete_document' => array('STAF_PUKHK','KADIV_PUKHK','DEVELOPER'),
        
		);
 */
 