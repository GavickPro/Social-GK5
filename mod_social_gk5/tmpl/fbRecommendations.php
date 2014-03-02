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


if($this->config['fb_code_type'] == 'iframe') {
	echo '<iframe src="//www.facebook.com/plugins/recommendations.php?site='.urlencode($this->config['fb_site']).'&amp;width='.$this->config['fb_rec_width'].'&amp;height='.$this->config['fb_rec_height'].'&amp;header='.$this->config['fb_rec_header'].'&amp;colorscheme='.$this->config['fb_rec_colorscheme'].'&amp;linktarget='.$this->config['fb_rec_link_target'].'&amp;max_age="'.$this->config['fb_rec_max_age'].'scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$this->config['fb_rec_width'].'px; height:'.$this->config['fb_rec_height'].'px;" allowTransparency="true"></iframe>';
} elseif($this->config['fb_code_type'] == 'XFBML') {
	echo '<fb:recommendations 
		site="'.$this->config['fb_site'].'" 
		width="'.$this->config['fb_rec_width'].'px" 
		height="'.$this->config['fb_rec_height'].'px" 
		linktarget="'.$this->config['fb_rec_link_target'].'" 
		header="'.$this->config['fb_rec_header'].'" 
		max_age="'.$this->config['fb_rec_max_age'].'"
		colorscheme="'.$this->config['fb_rec_colorscheme']. '">
	</fb:recommendations>';
} else {
    echo '<div class="fb-recommendations" 
    data-site="'.$this->config['fb_site'].'" 
    data-width="'.$this->config['fb_rec_width'].'px" 
    data-height="'.$this->config['fb_rec_height'].'px" 
    data-linktarget="'.$this->config['fb_rec_link_target'].'" 
    data-header="'.$this->config['fb_rec_header'].'" 
    data-max-age="'.$this->config['fb_rec_max_age'].'"
    data-colorscheme="'.$this->config['fb_rec_colorscheme']. '">
</div>';
}
/* eof */