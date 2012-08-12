<?php

	if(!defined('__IN_SYMPHONY__')) die('<h2>Error</h2><p>You cannot directly access this file</p>');

	require_once(TOOLKIT . '/class.event.php');

	Class eventRedirect extends Event{

		public static function about(){

			$description = new XMLElement('p', 'This event redirects the users to the first subpage attached to the page.');

			return array(
						 'name' => 'Subpage Redirect',
						 'author' => array('name' => 'Huib Keemink',
										   'website' => 'http://www.creativedutchmen.com',
										   'email' => 'huib@creativedutchmen.com'),
						 'version' => '1.1',
						 'release-date' => '2012-08-13',
						 'trigger-condition' => 'Page load');
		}

		public function load(){
			return $this->__trigger();
		}

		public static function documentation(){
			return 'Redirects the user to the first subpage associated with the page';
		}

		protected function __trigger(){
			$params = Frontend::instance()->Page()->Params();
			if($params['parent-path'] == '/'){
				$path = $params['current-page'];
			}
			else{
				$path = substr($params['parent-path'].'/'.$params['current-page'],1);
			}
            $row = Symphony::Database()->fetchRow(0, "SELECT * from tbl_pages where path = '".$path."' ORDER BY sortorder ASC");
			if(empty($row)){
				return false;
			}
			else{
				header ('Location: '.$params['root'].'/'.$path.'/'.$row['handle'] . '/');
				die();
			}
		}
	}
