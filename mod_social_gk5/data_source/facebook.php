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
class SocialGK5FacebookHelper 
{
	private $config;
	
	function __construct($module,$params)
	{
       jimport('joomla.filesystem.file');
       // configuration array
       $this->config = $params->toArray();
	   if($this->config['fb_auto_url'] == 'true' && $this->config['fb_data_source'] != 'like_box') {
            $this->config['fb_site'] = JURI::current();
       } 
	}
	
	// RENDERING LAYOUT
	function render() {	
		// create instances of basic Joomla! classes
		$document = JFactory::getDocument();
		// init $headData variable
		$headData = false;	
		// getting module head section datas
		unset($headData);
		$headData = $document->getHeadData();
		// generate keys of script section
		$headData_keys = array_keys($headData["scripts"]);
		// set variable for false
		$script_founded = 0;
		// searching phrase facebook in scripts paths
		if($this->config['cookie_conset'] == 0) {
			$js = '<script type="text/javascript">';	
		} else {
			$js = '<script type="text/plain" class="cc-onconsent-social">';	
		}
		$js .= 'window.addEvent(\'load\', function() { if(document.id(\'fb-root\') == null){
			console.log("not found"); 
		var fbroot = new Element(\'div#fb-root\');
		$$(\'body\').grab(fbroot);
		(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/'.$this->config['fb_language'].'/all.js#xfbml=1';
		// include APP ID
		if($this->config['fb_app_id'] != '') {
			$js.='&appId='.$this->config['fb_app_id'] .'";';	
		} else { $js.='";'; }
		$js.= ' fjs.parentNode.insertBefore(js, fjs);}(document, \'script\', \'facebook-jssdk\'));}});</script>';
		// include script 
		echo $js;
		
		// select proper layout to load
        switch($this->config['fb_data_source']) {
            case 'activity_feed' : require(JModuleHelper::getLayoutPath('mod_social_gk5', 'fbActivityFeed')); break;
           	case 'comments'      : {
                    if($this->config['fb_comments_admin_id'] != ''){
                    	// add custom meta tags for comments administratrion
                    	$document->addCustomTag("<meta property=\"fb:admins\" content=\"".$this->config['fb_comments_admin_id']."\"/>");
           			}
            		if($this->config['fb_app_id'] != ''){
            			$document->addCustomTag("<meta property=\"fb:app_id\" content=\"".$this->config['fb_app_id']."\"/>");
            		}
	            require(JModuleHelper::getLayoutPath('mod_social_gk5', 'fbComments')); 
            	break;
            }
            case 'facepile'      :  require(JModuleHelper::getLayoutPath('mod_social_gk5', 'fbFacepile')); break;
            case 'like_box'      :  require(JModuleHelper::getLayoutPath('mod_social_gk5', 'fbLikebox')); break;
            case 'recommendations': require(JModuleHelper::getLayoutPath('mod_social_gk5', 'fbRecommendations')); break;
            default              :  break;
        }
	}
}
/* eof */