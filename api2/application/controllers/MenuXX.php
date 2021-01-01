<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Menu_model');

		// enable profiler cukup disini
		//$this->output->enable_profiler(true);
		
    }
    
    // "router" REST API
	public function index()
	{
	    $request_method = $this->input->method(TRUE);
	    switch ( $request_method ) {
	        case 'OPTIONS' :
	            $this->output->set_status_header(200,'Success');
	        break;
	        case 'GET' :
                $this->get();
            break;
	        case 'POST' :
	            $this->add();
	        break;
	        default:
	            $this->output->set_status_header(405,'Method Not Allowed');
	    }
	}
	// akhir - "router" REST API
   
	public function get()
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'MENU', 'R' ) === true ) {
	        
    		$menu = $this->Menu_model->get();

            if ( !empty($menu) ){
                    $menuArr = array();

                    foreach ( $menu as $menu ){
                        $parent_detail = $this->Menu_model->detail($menu->parent);
                        $menu_detail['id'] = $menu->id;
                        $menu_detail['name'] = $menu->name;
                        $menu_detail['parent'] = ( !empty($parent_detail) ) ? $parent_detail->name : '(Main Menu)';
                        $menu_detail['link'] = $menu->link;
                        
        		        array_push($menuArr,$menu_detail);
                    }

    			// create result
    			$result = array(
    				'status' => 'success',
    				'message' => null,
    				'elapsed_time' => $this->benchmark->elapsed_time(),
    				'menu' => $menuArr
    			);
    
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Data menu kosong.'
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
		
	} // end of - get
	
	public function tree()
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'MENU', 'R' ) === true ) {
	        
    		$flat = ( $this->input->get('flat') === 'true' ) ? true : false;
	        
    		$menu = $this->Menu_model->get('root');

            if ( !empty($menu) ){
                
                $menuArr = array();
                
                $menu_detail['id'] = 0;
                $menu_detail['name'] = "(Main Menu)";
                $menu_detail['link'] = "-";
                array_push($menuArr,$menu_detail);

                foreach ( $menu as $menu ){
                        //$parent_detail = $this->Menu_model->detail($menu->parent);
                        $menu_detail['id'] = $menu->id;
                        $menu_detail['name'] = $menu->name;
                        //$menu_detail['parent'] = ( !empty($parent_detail) ) ? $parent_detail->name : '(Main Menu)';
                        $menu_detail['link'] = $menu->link;
                        $menu_detail['child'] = array();
                        
                        $child_menu = $this->Menu_model->get($menu->id);
                        if ( !empty($child_menu) ){
                            foreach ( $child_menu as $child_menu ){
                                $child_menu_detail['id'] = $child_menu->id;
                                $child_menu_detail['name'] = $child_menu->name;
                                $child_menu_detail['link'] = $child_menu->link;
                                $child_menu_detail['child'] = array();
                                
                                $grandchild_menu = $this->Menu_model->get($child_menu->id);
                                if ( !empty($grandchild_menu) ){
                                    foreach ( $grandchild_menu as $grandchild_menu ){
                                        $grandchild_menu_detail['id'] = $grandchild_menu->id;
                                        $grandchild_menu_detail['name'] = $grandchild_menu->name;
                                        $grandchild_menu_detail['link'] = $grandchild_menu->link;
                                        $grandchild_menu_detail['child'] = array();
                                        
                                        array_push($child_menu_detail['child'],$grandchild_menu_detail);
                                    }
                                }
                                
                                array_push($menu_detail['child'],$child_menu_detail);
                            }
                        }
                        
        		        array_push($menuArr,$menu_detail);
                } // foreach
                
                if ( $flat === true ){
                    $menuArrFinal = array();
                    foreach ( $menuArr as $menuArr ){
                        $menuArrClean = $menuArr;
                        unset($menuArrClean['child']);
                        array_push($menuArrFinal,$menuArrClean);
                        if ( !empty($menuArr['child']) ){
                            foreach ( $menuArr['child'] as $child_menu){
                                $child_menu_detail['id'] = $child_menu['id'];
                                $child_menu_detail['name'] = '-- '.$child_menu['name'];
                                $child_menu_detail['link'] = $child_menu['link'];
                                $childMenuClean = $child_menu_detail;
                                unset($childMenuClean['child']);
                                array_push($menuArrFinal,$childMenuClean);
                                if ( !empty($child_menu['child']) ){
                                    foreach( $child_menu['child'] as $grandChildMenu ){
                                        $grandChildMenuDetail['id'] = $grandChildMenu['id'];
                                        $grandChildMenuDetail['name'] = '---- '.$grandChildMenu['name'];
                                        $grandChildMenuDetail['link'] = $grandChildMenu['link'];
                                        array_push($menuArrFinal,$grandChildMenuDetail);
                                    }
                                }
                            }
                        }
                    }
                }else{
                    $menuArrFinal = $menuArr;
                }

    			// create result
    			$result = array(
    				'status' => 'success',
    				'message' => null,
    				'elapsed_time' => $this->benchmark->elapsed_time(),
    				'menu' => $menuArrFinal
    			);
    
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Data menu kosong.'
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
		
	} // end of - tree

	public function add()
	{
	    
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'MENU', 'RW' ) === true ) {
	         
            // konversi JSON ke POST 
            $_POST = json_decode(file_get_contents("php://input"), true);
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Nama Menu', 'required');
            $this->form_validation->set_rules('link', 'Link', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $menu_detail = array(
                    'parent' => $this->lman_security->clean_post('parent'),
                    'name' => $this->lman_security->clean_post('name'),
                    'link' => $this->lman_security->clean_post('link'),
                );
                
                $menu_id = $this->Menu_model->insert($menu_detail);
                if ($menu_id != false) {
                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'menu_id' => $menu_id,
                    );
                } else {
                    $result = array(
                        'status' => 'error',
                        'message' => 'Gagal menyimpan data ke database, silakan coba lagi!'
                    );
                }
                
            }

    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - add
	
	public function update( $menu_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'MENU', 'RW' ) === true ) {
	         
            // konversi JSON ke POST 
            $_POST = json_decode(file_get_contents("php://input"), true);
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Nama Menu', 'required');
            $this->form_validation->set_rules('link', 'Link', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $menu_detail = array(
                    'parent' => $this->lman_security->clean_post('parent'),
                    'name' => $this->lman_security->clean_post('name'),
                    'link' => $this->lman_security->clean_post('link'),
                );
                
                $menu_id = $this->Menu_model->update($menu_id, $menu_detail);
                if ($menu_id != false) {
                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'menu_id' => $menu_id,
                    );
                } else {
                    $result = array(
                        'status' => 'error',
                        'message' => 'Gagal menyimpan data ke database, silakan coba lagi!'
                    );
                }
                
            }

    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
	} // end of - update
	
	public function delete( $menu_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'MENU', 'RW' ) === true ) {
	         
            $delete_menu = $this->Menu_model->delete($menu_id);
            if ($delete_menu != false) {
                $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                );
            } else {
                $result = array(
                        'status' => 'error',
                        'message' => 'Gagal menyimpan data ke database, silakan coba lagi!'
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
	} // end of - delete()

}
