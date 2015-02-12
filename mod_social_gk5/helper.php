<?php

/**
* Helper class for Highlighter GK5 module
*
* GK Highligter
* @package Joomla!
* @Copyright (C) 2009-2012 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ version $Revision: GK5 1.0 $
**/

// access restriction
defined('_JEXEC') or die('Restricted access');
// import JString class for UTF-8 problems
jimport('joomla.utilities.string'); 


class HighlighterGK5Helper {
	
	private $config; // configuration array
	
	// constructor
	public function __construct($module, $params) {
		// put the module params to the $config variable
		$this->config = $params->toArray();
		// if the user set engine mode to Mootools
		if($this->config['engine_mode'] == 'mootools') {
			// load the MooTools framework to use with the module
			JHtml::_('behavior.framework', true);
		} else if($this->config['include_jquery'] == 1) {
			// if the user specify to include the jQuery framework - load newest jQuery 1.10.* 
			$doc = JFactory::getDocument();
			$doc->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.10/jquery.min.js');
		}
	}
	
}