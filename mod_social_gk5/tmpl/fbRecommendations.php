<?php
/**
 * Gavick Social GK5 - layout file
 * @package Joomla!
 * @ Copyright (C) 2009-2011 Gavick.com
 * @ All rights reserved
 * @ Joomla! is Free Software
 * @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
 * @version $Revision: GK4 1.0 $
 **/


defined('_JEXEC') or die('Restricted access');
// check for SSL connection
$uri = JFactory::getURI();
if($uri->isSSL()) {
	$prefix = 'https';
} else {
	$prefix = 'http';
}

if($this->config['fb_code_type'] == 'iframe') {
	echo '<iframe src="'.$preifx.'://www.facebook.com/plugins/recommendations.php?site='.urlencode($this->config['fb_site']).'&amp;width='.$this->config['fb_rec_width'].'&amp;height='.$this->config['fb_rec_height'].'&amp;header='.$this->config['fb_rec_header'].'&amp;colorscheme='.$this->config['fb_rec_colorscheme'].'&amp;font='.$this->config['fb_rec_font'].'&amp;linktarget='.$this->config['fb_rec_link_target'].'&amp;border_color="'.$this->config['fb_rec_border_color'].'scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$this->config['fb_rec_width'].'px; height:'.$this->config['fb_rec_height'].'px;" allowTransparency="true"></iframe>';
} elseif($this->config['fb_code_type'] == 'XFBML') {
	echo '<fb:recommendations site="'.$this->config['fb_site'].'" width="'.$this->config['fb_rec_width'].'" height="'.$this->config['fb_rec_height'].'" linktarget="'.$this->config['fb_rec_link_target'].'" header="'.$this->config['fb_rec_header'].'" colorscheme="'.$this->config['fb_rec_colorscheme']. '" font="'.$this->config['fb_rec_font'].'" border_color="'.$this->config['fb_rec_border_color'].'"></fb:recommendations>';
} else {
    echo '<div class="fb-recommendations" data-site="'.$this->config['fb_site'].'" data-width="'.$this->config['fb_rec_width'].'" data-height="'.$this->config['fb_rec_height'].'" data-linktarget="'.$this->config['fb_rec_link_target'].'" header="'.$this->config['fb_rec_header'].'" data-colorscheme="'.$this->config['fb_rec_colorscheme']. '" data-font="'.$this->config['fb_rec_font'].'" data-border-color="'.$this->config['fb_rec_border_color'].'"></div>';
}
/* eof */