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

// access restriction
defined('_JEXEC') or die('Restricted access');

?>
<?php if($this->config['fb_code_type'] == 'iframe') : ?>
	<iframe src="//www.facebook.com/plugins/activity.php?site=<?php echo urlencode($this->config['fb_site']); ?>&amp;width=<?php echo $this->config['fb_width']; ?>&amp;height=<?php echo $this->config['fb_height']; ?>&amp;header=<?php echo $this->config['fb_header']; ?>&amp;colorscheme=<?php echo $this->config['fb_colorscheme']; ?>&amp;linktarget=<?php echo $this->config['fb_link_target']; ?>&amp;font=<?php echo $this->config['fb_font']; ?>&amp;border_color=<?php echo $this->config['fb_border_color']; ?>&amp;recommendations=<?php echo $this->config['fb_recommendations']; ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $this->config['fb_width']; ?>px; height:<?php echo $this->config['fb_height']; ?>px;" allowtransparency="true"></iframe>
<?php elseif($this->config['fb_code_type'] == 'XFBML')  : ?>
	<?php echo '<fb:activity 
		site="'.urlencode($this->config['fb_site']).'"
		width="'.$this->config['fb_width'].'px" 
		colorscheme="'. $this->config['fb_colorscheme'].'"
		height="'.$this->config['fb_height'].'px" 
		header="'.$this->config['fb_header'].'" 
		linktarget="'.$this->config['fb_link_target'].'" 
		max-age="'.$this->config['fb_max_age'].'"
		recommendations="'.$this->config['fb_recommendations'].'">
</fb:activity>'; ?>
<?php else : ?>
    <?php echo '<div class="fb-activity" 
    	data-site="'.urlencode($this->config['fb_site']).'"
    	data-width="'.$this->config['fb_width'].'" 
    	data-colorscheme="'. $this->config['fb_colorscheme'].'"
    	data-height="'.$this->config['fb_height'].'" 
    	data-header="'.$this->config['fb_header'].'" 
    	data-linktarget="'.$this->config['fb_link_target'].'" 
    	data-max-age="'.$this->config['fb_max_age'].'"
    	data-recommendations="'.$this->config['fb_recommendations'].'">
    </div>'; ?>
<?php endif; ?>