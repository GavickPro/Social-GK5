<?php

defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

class JFormFieldTwitterLists extends JFormField {
	protected $type = 'TwitterLists';

	protected function getInput() {
		// generate the select list
		$options = array();
		$file_select = '<select id="'.$this->id.'" name="'.$this->name.'">'.
		       '</select>';
		// return the standard formfield output
		$html = '';
		$html .= $file_select.'<button class="btn btn-info" id="twitter_load_lists">'.JText::_('MOD_SOCIAL_GK5_TWITTER_GET_LISTS_BUTTON').'</button>';
		// finish the output
		return $html;
	}
}

/* EOF */