<?php

/**
* Social GK5 - main PHP file
* @package Joomla!
* @Copyright (C) 2009-2012 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ version $Revision: GK5 1.0 $
**/

// no direct access
defined('_JEXEC') or die;

// helper loading
$config = $params->toArray();
// load helper file depends of source type
if($config['module_data_source'] == 'twitter') {
	require_once (dirname(__FILE__).DS.'data_source'.DS.'twitter.php');
	$helper = new SocialGK5TwitterHelper($module, $params); 
	// try to parse the data
	try{
		$helper->getData();
		//$helper->parseData();    
	} catch (Exception $e) {
		// use backup
		$helper->useBackup();
	}
} else if ($config['module_data_source'] == 'fb') {
	require_once (dirname(__FILE__).DS.'data_source'.DS.'facebook.php');
	$helper = new SocialGK5FacebookHelper($module, $params); 
} else {
	require_once (dirname(__FILE__).DS.'data_source'.DS.'gplus.php');
	$helper = new SocialGK5GPLusHelper($module, $params); 
}

// creating HTML code	
$helper->render();

// EOF