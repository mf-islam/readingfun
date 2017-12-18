<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Installer helper for CodeIgniter
 *
 * @author Sujeet <sujeetkv90@gmail.com>
 * @link https://github.com/sujeet-kumar/ci-installer
 */

/**
 * Get Installer class instance
 */
if ( ! function_exists('get_installer'))
{
	function &get_installer(){
		static $instance = null;
        if (null === $instance) {
            $instance = new Installer_helper();
        }
        return $instance;
	}
}


/**
 * Check if installed
 */
if ( ! function_exists('is_installed'))
{
	function is_installed(){
		$installer =& get_installer();
		return $installer->isInstalled();
	}
}


/**
 * Set database config using installed config on the fly
 */
if ( ! function_exists('set_db_config'))
{
	function set_db_config(&$config, $active_group){
		$installer =& get_installer();
		if($db_config = $installer->installedConfig('db') and is_array($db_config)){
			$config[$active_group] = array_merge($config[$active_group], $db_config);
		}
	}
}


/**
 * Installer class
 */
class Installer_helper
{
	private $CI;
	private $_conf_arr = array();
	private $_config_path = '';
	private $_errors = array();
	
	public $installed_config = 'installed_config.php';
	public $db = NULL;
	public $dbforge = NULL;
	public $dbutil = NULL;
	
	public function __construct(){
		$this->CI =& get_instance(); 
		$this->_config_path = APPPATH.'config/';
	}
	
	public function __destruct(){
		if($this->db){
			$this->db->close();
		}
	}
	
	/**
	 * Get any config value
	 * @param	string	$config_file
	 * @param	string	$config_name
	 * @param	string	$config_key
	 */
	public function getConfig($config_file, $config_name = 'config', $config_key = ''){
		$config_path = $this->_config_path . $config_file;
		$_conf_key = $config_path .'__'. $config_name;
		
		if(! array_key_exists($_conf_key, $this->_conf_arr)){
			if(! is_file($config_path)){
				$this->_errors[] = 'Not existing config file: '.$config_file;
				return NULL;
			}else{
				require $config_path;
				if(isset($$config_name)){
					$this->_conf_arr[$_conf_key] = $$config_name;
				}else{
					$this->_errors[] = 'Not a valid config var: '.$config_name;
					return NULL;
				}
			}
		}
		
		if($config_key != ''){
			return array_key_exists($config_key, $this->_conf_arr[$_conf_key]) ? $this->_conf_arr[$_conf_key][$config_key] : NULL;
		}else{
			return $this->_conf_arr[$_conf_key];
		}
	}
	
	/**
	 * Update config file
	 * @param	string	$config_file
	 * @param	array	$config_array
	 * @param	string	$config_name
	 */
	public function updateConfig($config_file, $config_array, $config_name = 'config'){
		$config_path = $this->_config_path . $config_file;
		$config_tmp_path = $this->_config_path . $config_file . '.old';
		
		if(! is_array($config_array)){
			$this->_errors[] = 'Not a valid config array passed.';
			return false;
		}

		if(is_file($config_path)){

			@chmod($config_path, FILE_WRITE_MODE);
			if(is_really_writable($config_path)){
				if($config_file_content = @file_get_contents($config_path) and @copy($config_path, $config_tmp_path)){
					$pattern = array();
					$replace = array();
					
					
					foreach($config_array as $key => $value){
						$pattern[] = '|\r?\n\s?\$'.$config_name.'\[\\\''.$key.'\\\'\]\s+=\s+[^;]+|';
						$replace[] = "\n".'$'.$config_name.'[\''.$key.'\'] = ' . var_export($value, true);
					}
					
					if($updated_file_content = preg_replace($pattern, $replace, $config_file_content) 
						and file_put_contents($config_path, $updated_file_content, LOCK_EX)){
						@chmod($config_path, FILE_READ_MODE);
						return true;
					}else{
						$this->_errors[] = 'Config file write error: '.$config_file;
						return false;
					}
				}else{
					$this->_errors[] = 'Config file read error: '.$config_file;
					return false;
				}
			}else{
				$this->_errors[] = 'Config file not writable: '.$config_file;
				return false;
			}
		}else{
			$this->_errors[] = 'Config file not exists: '.$config_file;
			return false;
		}
	}
	
	
	/**
	 * Create custom config file
	 * @param	string	$config_file
	 * @param	string	$config_name
	 * @param	array	$config_array
	 * @param	bool	$overwrite
	 */
	public function createCustomConfig($config_file, $config_name, $config_array, $overwrite = false){
		$config_path = $this->_config_path . $config_file;

		if(! file_exists($config_path) or $overwrite){
			$file_content = '<?php'."\n".'defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');'."\n\n";
			$file_content .= '$'.$config_name . ' = ' . var_export($config_array, true) . ';'."\n";
			return file_put_contents($config_path, $file_content, LOCK_EX);
		}else{
			$this->_errors[] = 'Config file already exists: '.$config_file;
			return false;
		}
	}
	
	/**
	 * Update custom config file
	 * @param	string	$config_file
	 * @param	array	$config_array
	 * @param	string	$config_name
	 */
	public function updateCustomConfig($config_file, $config_array, $config_name = 'config'){
		if(! is_array($config_array)){
			$this->_errors[] = 'Not a valid config array passed.';
			return false;
		}
		
		if($config = $this->getConfig($config_file, $config_name)){
			$config = array_merge($config, $config_array);
			return $this->createCustomConfig($config_file, $config_name, $config, true);
		}else{
			return false;
		}
	}
	
	/**
	 * Delete config file
	 * @param	string	$config_file
	 */
	public function destroyConfig($config_file){
		$config_path = $this->_config_path . $config_file;
		return @unlink($config_path);
	}
	
	/**
	 * Get installed config value
	 * @param	string	$config_key
	 */
	public function installedConfig($config_key = ''){
		return $this->getConfig($this->installed_config, 'config', $config_key);
	}
	
	/**
	 * Check if installed
	 */
	public function isInstalled(){
		if($installed_config = $this->getConfig($this->installed_config, 'config')){
			return (isset($installed_config['db']) and is_array($installed_config['db']) 
					and isset($installed_config['install_date']) and strtotime($installed_config['install_date']));
		}else{
			$this->_errors = array();
			return false;
		}
	}
	
	/**
	 * Create database based on installed config
	 */
	public function createDatabase(){
		if($active_group = $this->getConfig('database.php', 'active_group') and 
			$main_config = $this->getConfig('database.php', 'db', $active_group) and 
			$installed_config = $this->installedConfig('db')){
			
			$db_config = array_merge($main_config, $installed_config);
			$db_config['db_debug'] = false;
			
			$host_config = $db_config;
			$host_config['database'] = '';
			
			if($db = $this->CI->load->database($host_config, true) 
				and $dbforge = $this->CI->load->dbforge($db, true) 
				and $dbutil = $this->CI->load->dbutil($db, true)){
				
				if(! $dbutil->database_exists($installed_config['database'])){
					if(! $dbforge->create_database($installed_config['database'])){
						$this->_errors[] = 'Could not create database. '.$this->_db_error($db)->message;
						return false;
					}
				}
				
				$db->close();
				
				if($this->db = $this->CI->load->database($db_config, true, true)){
					$this->dbforge = $this->CI->load->dbforge($this->db, true);
					$this->dbutil = $this->CI->load->dbutil($this->db, true);
					return $this->db;
				}else{
					$this->_errors[] = 'Could not connect database. '.$this->_db_error($this->db)->message;
					return false;
				}
				
			}else{
				$this->_errors[] = 'Could not connect database host. '.$this->_db_error($db)->message;
				return false;
			}
		}else{
			$this->_errors[] = 'Could not load database config.';
			return false;
		}
	}
	
	/**
	 * Load and execute database forged schema
	 * @param	string	$file_path
	 */
	public function loadSchema($file_path){
		if($this->db === NULL){
			$this->_errors[] = 'loadSchema cannot be used exclusively without createDatabase.';
			return false;
		}else{
			if(is_file($file_path)){
				$result = include $file_path;
				if($result){
					return true;
				}else{
					$this->_errors[] = 'Load schema error: '.$this->_db_error($this->db)->message;
					return false;
				}
			}else{
				$this->_errors[] = 'Schema file not exist: '.basename($file_path);
				return false;
			}
		}
	}
	
	/**
	 * Load and execute database SQL schema
	 * @param	string	$file_path
	 */
	public function loadSchemaSql($file_path){
		if($this->db === NULL){
			$this->_errors[] = 'loadSchemaSql cannot be used exclusively without createDatabase.';
			return false;
		}else{
			if($this->db->platform() != 'mysqli'){
				$this->_errors[] = 'Load SQL error: batch query only supported for mysqli driver.';
				return false;
			}else{
				if($sql = trim(@file_get_contents($file_path), ';') and mysqli_multi_query($this->db->conn_id, $sql)){
					while(mysqli_more_results($this->db->conn_id) and mysqli_next_result($this->db->conn_id));
					if(mysqli_errno($this->db->conn_id)){
						$this->_errors[] = 'Load SQL error: '.$this->_db_error($this->db)->message;
						return false;
					}else{
						return true;
					}
				}else{
					$this->_errors[] = 'Load SQL error: '.$this->_db_error($this->db)->message;
					return false;
				}
			}
		}
	}
	
	/**
	 * Inject installed db config in default db config
	 * @param	string	$config_file
	 */
	public function injectDbConfig($config_file = 'database.php'){
		$file_path = $this->_config_path . $config_file;
		if(is_file($file_path)){
			@chmod($file_path, FILE_WRITE_MODE);
			if(is_really_writable($file_path)){
				$code = "\n".'/* Set Installed Database Config. */'."\n".'set_db_config($db, $active_group);'."\n";
				if(file_put_contents($file_path, $code, FILE_APPEND | LOCK_EX)){
					@chmod($file_path, FILE_READ_MODE);
					return true;
				}else{
					$this->_errors[] = 'Could not inject database config.';
					return false;
				}
			}else{
				$this->_errors[] = 'Config file not writable: '.$config_file;
				return false;
			}
		}else{
			$this->_errors[] = 'Config file not exists: '.$config_file;
			return false;
		}
	}
	
	/**
	 * Check dependencies
	 * @param	string	$php_version
	 * @param	bool $custom_check_result
	 */
	public function validDependency($php_version, $custom_check_result = NULL){
		$version = strval($php_version);
		
		if(! is_php($version)){
			$this->_errors[] = 'Minimum PHP version required: '.$version;
			return false;
		}
		
		if($custom_check_result !== NULL){
			return (bool) $custom_check_result;
		}
		
		return true;
	}
	
	/**
	 * Set installer errors
	 * @param	string	$error_msg
	 */
	public function setError($error_msg){
		$this->_errors[] = $error_msg;
	}
	
	/**
	 * Get installer errors
	 * @param	bool	$all_errors
	 */
	public function getError($all_errors = false){
		return $all_errors ? $this->_errors : end($this->_errors);
	}
	
	private function _db_error(&$db){
		$err = array('code'=>'', 'message'=>'');
		if(is_object($db) and method_exists($db, 'error')){
			$err = $db->error();
		}
		return (object) $err;
	}
}

/* End of file installer_helper.php */