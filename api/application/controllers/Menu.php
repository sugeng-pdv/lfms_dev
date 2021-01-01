<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Menu extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function menu_data_post() {
        $postdata = ($_POST);
        $this->load->model('Menu_model');
        $result= $this->Menu_model->getData();
        if(!empty($result)){
            $menuArr = array();
            $num = 1;
            foreach ( $result as $menu ){
                $parent_detail = $this->Menu_model->detail($menu->parent);
                $menu_detail['no'] = $num;
                $menu_detail['id'] = $menu->id;
                $menu_detail['name'] = $menu->name;
                $menu_detail['parent_id'] = $menu->parent;
                $menu_detail['parent'] = ( !empty($parent_detail) ) ? $parent_detail->name : '(Main Menu)';
                $menu_detail['code'] = $menu->code;
                $menu_detail['link'] = $menu->link;
                $menu_detail['action'] = '<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details" onclick="edit_menu('."'$menu->id'".')"><i class="la la-edit"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" onclick="delete_menu('."'$menu->id'".')"><i class="la la-trash"></i></a>';
                $num++;
                array_push($menuArr,$menu_detail);
            }
            $this->response(array(
                'status'=>'success',
                'message'=>'',
                'elapsed_time' => $this->benchmark->elapsed_time(),
    			'menu' => $menuArr
            ));
        }else{
            $this->response( array('status'=>'failure',
                'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    function parent_data_post()
    {
        $postdata = ($_POST);
        $this->load->model('Menu_model');
        $result= $this->Menu_model->getData();
        $menuArr = array();
        $menu_detail['id'] = 0;
        $menu_detail['name'] = "(Main Menu)";
        array_push($menuArr,$menu_detail);
        if(!empty($result)){
            foreach ( $result as $menu ){
                $parent_detail = $this->Menu_model->detail($menu->parent);
                $menu_detail['id'] = $menu->id;
                // $menu_detail['name'] = $menu->name;
                // $menu_detail['parent'] = $menu->parent;
                $menu_detail['name'] = ( !empty($parent_detail) ) ? '-'.$menu->name : $menu->name;
                // $menu_detail['code'] = $menu->code;
                // $menu_detail['link'] = $menu->link;
                array_push($menuArr,$menu_detail);
            }
            $this->response(array(
                'status'=>'success',
                'message'=>'',
                'elapsed_time' => $this->benchmark->elapsed_time(),
    			'menu' => $menuArr
            ));
        }else{
            $this->response( array('status'=>'failure',
                'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    function menu_delete_post(){
        $this->load->model('menu_model');
        $data_id = $this->menu_model->update(array('status' => 'INACTIVE'),array('id'=>$this->post('id')));
            if (!$data_id){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                $this->response(array('status'=>'success','message'=>'Berhasil Dihapus'));
            }
    }
    function menu_save_post(){
        $postdata = ($_POST);
        $data = array(
                'parent'    => $postdata['parent'],
                'name'      => $postdata['name'],
                'code'      => $postdata['code'],
                'link'      => $postdata['link']
            );
            //   'status'    =>'ACTIVE'
        $this->load->model('menu_model');
        if($postdata['status'] == 'add'){
            $data_id = $this->menu_model->insert($data);
        }else{
            $data_id = $this->menu_model->update($data,array('id'=>$this->post('id')));
        }
        if (!$data_id){
            $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            $this->response(array('status'=>'success','message'=>'Berhasil Simpan'));
        }
        
    }
    
    function get_menu_post()
    {
        $postdata = $_POST;
        $userArr = array();
        // print_r("sghdsdjhbvj".VALID_LOGIN);die();
        if (VALID_LOGIN === true )
        {
            $_POST['is_default'] =0;
            $this->load->model('Acl_model');
            $resultUser= $this->Acl_model->user_detail_profile(USERID);
            $userArr = array();
            foreach ( $resultUser as $user ){
                $user_detail['name'] = $user->name;
                $user_detail['email'] = $user->email;
                $user_detail['role'] = $user->role_name;;
                $user_detail['company'] = $user->company_name;
                array_push($userArr,$user_detail);
            }
        }
        else {
            $_POST['is_default'] =1;
        }
        $menu_nav = "";
        $this->load->model('Menu_model');
        $result= $this->Menu_model->getMenu();
        if(!empty($result)){
            $dataArr = array();
            foreach ( $result as $menu ){
                $result_detail['id'] = $menu->id;
                $result_detail['name'] = $menu->name;
                $result_detail['link'] = $menu->link;
                if($_POST['is_default'] == 1){
                    if($menu->name == "Beranda"){
                        $menu->name = "Login";
                    }
                }
                
                $parent_menu = $this->Menu_model->getSubMenu($menu->id);
                if(!empty($parent_menu)){
                    $menu_nav .= '<li class="menu-item menu-li li-menu'.$menu->class_menu.' menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
    														<a href="javascript:;" data-url="" class="menu-link menu-toggle">
    															<span class="menu-text">'."$menu->name".'</span>
    															<span class="menu-desc"></span>
    															<i class="menu-arrow"></i>
    														</a>
    														<div class="menu-submenu menu-submenu-classic menu-submenu-left">
    															<ul class="menu-subnav">';
    				foreach ( $parent_menu as $submenu )
    				{					
    				    $menu_nav .= '<li class="menu-item menu-li" aria-haspopup="true">
    																	<a href="javascript:void(0)" data-url='."$submenu->link".' class="menu-link">
    																		<span class="svg-icon menu-icon">
    																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
    																					<rect x="0" y="0" width="24" height="24" />
    																					<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
    																					<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
    																				</g>
    																			</svg>
    																		</span>
    																		<span class="menu-text">'."$submenu->name".'</span>
    																	</a>
    																</li>';
    				}
    				$menu_nav  .='</ul></div></li>';
                    
                }else{
                    $menu_nav .= '<li class="menu-item menu-li li-menu'."$menu->class_menu".'" aria-haspopup="true">
        							        <a href="javascript:void(0)" data-url='."$menu->link".' class="menu-link">
        									    <span class="menu-text">'."$menu->name".'</span>
        										</a>
        								</li>';
                }
                
                
                array_push($dataArr,$result_detail);
                
            }
            
            $this->response(array(
                'status'=>'success',
                'message'=>'',
                'elapsed_time' => $this->benchmark->elapsed_time(),
    			'detail' => ( !empty($userArr) ) ? $userArr : null,
    			'menu' => $menu_nav,
    			'login'=> VALID_LOGIN
            ));
        }else{
            $this->response( array('status'=>'failure',
                'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
       
}
