<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Installer controller for CodeIgniter
 *
 * @author Sujeet <sujeetkv90@gmail.com>
 * @link https://github.com/sujeet-kumar/ci-installer
 */
class Install extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'installer'));
		$this->load->library(array('session', 'form_validation'));
		
		$this->installer =& get_installer();
		
		if($this->installer->isInstalled()) redirect('');
		
		set_time_limit(120);
	}
	
	private function _dependencyCheck(){
		// do dependency checks here and set errors
		// $this->installer->setError('error message');
		return true;
	}
	
	public function index(){
		$data['title'] = 'Application Installation';

		echo '<pre>';
		print_r($this->input->post('config'));
		echo '</pre>';
		exit;
		
		$this->form_validation->set_rules('config[site_title]', 'App Title', 'required');
		$this->form_validation->set_rules('config[admin_email]', 'Admin Email', 'required|valid_email');
		$this->form_validation->set_rules('base_url', 'Base URL', 'required|valid_url');
		$this->form_validation->set_rules('hostname', 'DB Host', 'required');
		$this->form_validation->set_rules('username', 'DB User', 'required');
		//$this->form_validation->set_rules('password', 'DB Password', 'required');
		$this->form_validation->set_rules('database', 'DB Name', 'required');
		
		if($this->form_validation->run() === FALSE){
			$data['errors'] = $this->form_validation->error_array();
			$data['installed'] = false;
		}else{
			$hash = sha1(uniqid(microtime(true)));
			
			$installed_config = array(
				'install_date' => date('Y-m-d H:i:s'),
				'db' => array(
					'hostname' => $this->input->post('hostname'),
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password'),
					'database' => $this->input->post('database')
				),
				'integrity' => $hash
			);
			
			if(! $this->installer->validDependency('5.3', $this->_dependencyCheck())){
				$data['errors'] = $this->installer->getError(true);
				$data['installed'] = false;
			}else{
				if($this->installer->createCustomConfig($this->installer->installed_config, 'config', $installed_config, true) 
				and $db = $this->installer->createDatabase()){
					
					$sql_load1 = $this->installer->loadSchemaSql(APPPATH.'sql/demo_schema.sql');
					$sql_load2 = $this->installer->loadSchema(APPPATH.'sql/demo_schema.php');

					$content = array();
      		
		      		foreach ($this->input->post('config') as $key => $value) {
		      			$content[$key] = $value;
		      		}
					
					$config1 = $this->installer->createCustomConfig('app_config.php', 'config', $content);
					
					$config2 = $this->installer->updateConfig('autoload.php', array(
						'libraries' => array('database', 'session'),
						'helper' => array('installer', 'url'),
						'config' => array('app_config')
					), 'autoload');
					
					$config3 = $this->installer->updateConfig('config.php', array(
						'base_url' => $this->input->post('base_url'),
						'encryption_key' => $hash
					));
					
					if($sql_load1 and $sql_load2 and $config1 and $config2 and $config3 and $this->installer->injectDbConfig()){
						$data['installed'] = true;
					}else{
						$data['errors'] = $this->installer->getError(true);
						$data['installed'] = false;
					}
					
				}else{
					$this->installer->destroyConfig($this->installer->installed_config);
					$data['errors'] = $this->installer->getError(true);
					$data['installed'] = false;
				}
			}
			
		}
		$this->load->view('install', $data);
	}
}
