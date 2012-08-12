<?php

	require_once(TOOLKIT . '/class.entrymanager.php');


	Class extension_redirect_subpage extends Extension{

		public function about(){
			return array('name' => 'Redirect to Subpage',
						 'version' => '1.0',
						 'release-date' => '2009-10-05',
						 'author' => array('name' => 'Huib Keemink',
										   'website' => 'http://www.creativedutchmen.com',
										   'email' => 'huib@creativedutchmen.com')
				 		);
		}
	}
