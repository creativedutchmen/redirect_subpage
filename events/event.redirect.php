<?php

if (!defined('__IN_SYMPHONY__')) die('<h2>Error</h2><p>You cannot directly access this file</p>');

require_once(TOOLKIT . '/class.event.php');

class eventRedirect extends Event
{
    public static function about()
    {
        return array(
            'name' => 'Subpage Redirect',
            'author' => array(
                'name' => 'Huib Keemink',
                'website' => 'http://www.creativedutchmen.com',
                'email' => 'huib@creativedutchmen.com'
            ),
            'version' => '1.1',
            'release-date' => '2013-09-01',
            'trigger-condition' => ''
        );
    }

    public static function documentation()
    {
        return 'Redirects the user to the first subpage associated with the page. Provided by the Subpage Redirect extension.';
    }

    public function load()
    {
        return $this->__trigger();
    }

    protected function __trigger()
    {
        $page_id = $this->_env['param']['current-page-id'];
        $child_pages = PageManager::fetchChildPages($page_id);
        $child_page_id = $child_pages[0]['id'];
        if (empty($child_page_id)) {
            return false;
        } else {
            $child_page_path = PageManager::resolvePagePath($child_page_id);
            header ('Location: '.$this->_env['param']['root'].'/'.$child_page_path.'/');
            die();
        }
    }
}
