<?php

	if(!defined('__IN_SYMPHONY__')) die('<h2>Error</h2><p>You cannot directly access this file</p>');

	require_once(TOOLKIT . '/class.event.php');

	Class eventRedirect extends Event{
		
		public static function about(){
			
			$description = new XMLElement('p', 'This event redirects the users to the first subpage attached to the page');
					
			return array(
						 'name' => 'Subpage Redirect',
						 'author' => array('name' => 'Huib Keemink',
										   'website' => 'http://www.creativedutchmen.com',
										   'email' => 'huib@creativedutchmen.com'),
						 'version' => '1.0',
						 'release-date' => '2008-11-10',
						 'trigger-condition' => '');						 
		}
				
		public function load(){			
			return $this->__trigger();
		}

		public static function documentation(){
			return 'Redirects the user to the first subpage associated with the page';
		}
		
		protected function __trigger(){
			if($this->_env['param']['parent-path'] == '/'){
				$path = $this->_env['param']['current-page'];
			}
			else{
				$path = substr($this->_env['param']['parent-path'].'/'.$this->_env['param']['current-page'],1);
			}
            $row = $this->_Parent->Database->fetchRow(0, "SELECT * from tbl_pages where path = '".$path."' ORDER BY sortorder ASC");
			if(empty($row)){
				return false;
			}
			else{
				header ('Location: '.$this->_env['param']['root'].'/'.$path.'/'.$row['handle'] . '/');
				die();
			}
		}
	}

?>