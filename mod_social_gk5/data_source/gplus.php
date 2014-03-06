<?php
/**
 * Gavick Social GK5 - helper class
 * @package Joomla!
 * @ Copyright (C) 2009-2011 Gavick.com
 * @ All rights reserved
 * @ Joomla! is Free Software
 * @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
 * @version $Revision: GK4 1.0 $
 **/
// no direct access
defined('_JEXEC') or die('Restricted access');
// Main class
class SocialGK5GPLusHelper
{
	
	private $config;
	
	function __construct($module,$params)
    {
        jimport('joomla.filesystem.file');
        // configuration array
        $this->config = $params->toArray();
    }
	
	
	// RENDERING LAYOUT
	function render() {
		// create instances of basic Joomla! classes
		$document = JFactory::getDocument();

		
        if(in_array('plus.google.com', $headData_keys)) {
            $link_founded = true;
        }
        
		if($this->config['cookie_conset'] == 0) {
			$type = '<script type="text/javascript">';	
		} else {
			$type = '<script type="text/plain" class="cc-onconsent-social">';	
		}
		
        if($this->config['gplus_badge_style'] == 'standard_badge') { 
			// async script mode
			$content = $type.'window.___gcfg = {lang: \''.$this->config['gplus_lang_code'].'\'};
		        (function() {
		            var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
		            po.src = \'https://apis.google.com/js/platform.js\';
		            var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
		          })();</script>';
        } 
		// if gplus script file doesn't exists in document head section
        if($this->config['gplus_user'] != '' && ($this->config['gplus_badge_style'] == 'standard_badge')){ 
            echo $content;
     	} 
		// select proper layout to load
        if($this->config['gplus_badge_style'] == 'standard_badge') {
            require(JModuleHelper::getLayoutPath('mod_social_gk5', 'gplusBadge')); 
        } else {
            require(JModuleHelper::getLayoutPath('mod_social_gk5', 'gplusIcon')); 
        }
	}
}
/* eof */