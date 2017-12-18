<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');/**
* Name:  Ion Auth
*
* Author: Ben Edmunds
*		  ben.edmunds@gmail.com
*         @benedmunds
*
* Added Awesomeness: Phil Sturgeon
*
* Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  10.01.2009
*
* Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
* Original Author name has been kept but that does not mean that the method has not been modified.
*
* Requirements: PHP5 or above
*
*/

class Sub_domain_check
{
	public function subDomainCheck(){
		if($_GET['lib_id']){
			$CI = get_instance();
			$CI->load->model('Libraries_model');
			$CI->load->model('Admin_model');
			$CI->load->library('session');
			
			if($f = $CI->Libraries_model->checkLibraryExists($_GET['lib_id'])){
				$_SESSION['in_sub_domain']['library_name'] = $f->library_name;
				$_SESSION['in_sub_domain']['original_library_id'] = $f->library_id;
				$_SESSION['in_sub_domain']['lib_id'] = $_GET['lib_id'];
				$_SESSION['in_sub_domain']['get_param_subdomain'] = "?lib_id=".$_SESSION['in_sub_domain']['lib_id'];
				
				$settings = $CI->Admin_model->get_all_setting($_GET['lib_id']);
				
				$_SESSION['in_sub_domain']['current_logo']	= $settings->current_logo;
				$_SESSION['in_sub_domain']['current_video']	= $settings->current_video;
				
				if($settings->style_settings != ''){
					$styleArray = json_decode($settings->style_settings);

					$_SESSION['in_sub_domain']['menu_color'] 		= $styleArray->menu_color;
					$_SESSION['in_sub_domain']['menu_color_hover'] 	= $styleArray->menu_color_hover;
					$_SESSION['in_sub_domain']['body_font_size'] 	= $styleArray->body_font_size;
					$_SESSION['in_sub_domain']['title_font_size'] 	= $styleArray->title_font_size;
					$_SESSION['in_sub_domain']['body_link_color'] 	= $styleArray->body_link_color;
					
				}else{
					$_SESSION['in_sub_domain']['menu_color'] 		= '#333333';
					$_SESSION['in_sub_domain']['menu_color_hover'] 	= '#fa3d03';
					$_SESSION['in_sub_domain']['body_font_size'] 	= 12;
					$_SESSION['in_sub_domain']['title_font_size'] 	= 16;
					$_SESSION['in_sub_domain']['body_link_color'] 	= '#23527c';
				}
				
				return true;
			}else{
				redirect('/');
			}
		}else{
			redirect('/');
		}
	}
}
