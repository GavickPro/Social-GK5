<?php

defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

class JFormFieldTwitterLists extends JFormField {
	protected $type = 'TwitterLists';

	protected function getInput() {
		jimport('joomla.filesystem.file');
		// necessary Joomla! classes
		$uri = JURI::getInstance();
		$doc = JFactory::getDocument();
		
		$style = '';
		
		$doc->addStyleDeclaration( $style );
		// generate the select list
		$options = (array) $this->getOptions();
		$file_select = JHtml::_('select.genericlist', $options, 'name', '', 'value', 'text', 'default', 'twitter_list_name');
		// return the standard formfield output
		$html = '';
		$html .= $msg;
		$html .= $file_select.'<button id="twitter_load_lists">'.JText::_('MOD_SOCIAL_GK5_TWITTER_GET_LISTS_BUTTON').'</button>';
		// finish the output
		return $html;
	}

	protected function getOptions() {
		$options = array();
		$jsonurl = "https://api.twitter.com/1/lists/all.json?screen_name=";
		$json = file_get_contents($jsonurl,0,null,null);
		$json_output = json_decode($json);

		return array_merge($options);
	}
}

/* EOF */