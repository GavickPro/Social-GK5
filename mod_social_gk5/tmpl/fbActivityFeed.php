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

// check for SSL connection
$uri = JFactory::getURI();
if($uri->isSSL()) {
	$prefix = 'https';
} else {
	$prefix = 'http';
}

?>
<?php if($this->config['fb_code_type'] == 'iframe') : ?>
	<iframe src="<?php echo $prefix; ?>://www.facebook.com/plugins/activity.php?site=<?php echo urlencode($this->config['fb_site']); ?>&amp;width=<?php echo $this->config['fb_width']; ?>&amp;height=<?php echo $this->config['fb_height']; ?>&amp;header=<?php echo $this->config['fb_header']; ?>&amp;colorscheme=<?php echo $this->config['fb_colorscheme']; ?>&amp;linktarget=<?php echo $this->config['fb_link_target']; ?>&amp;font=<?php echo $this->config['fb_font']; ?>&amp;border_color=<?php echo $this->config['fb_border_color']; ?>&amp;recommendations=<?php echo $this->config['fb_recommendations']; ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $this->config['fb_width']; ?>px; height:<?php echo $this->config['fb_height']; ?>px;" allowtransparency="true"></iframe>
<?php elseif($this->config['fb_code_type'] == 'XFBML')  : ?>
	<?php echo '<fb:activity site="'.$this->config['fb_site'].'" width="'.$this->config['fb_width'].'" height="'.$this->config['fb_height'].'" header="'.$this->config['fb_header'].'" font="'.$this->config['fb_font'].'" border_color="" linktarget="_top"  recommendations="'.$this->config['fb_recommendations'].'" linktarget="'.$this->config['fb_link_target'].'"></fb:activity>'; ?>
<?php else : ?>
    <?php echo '<div class="fb-activity" data-width="'.$this->config['fb_width'].'" data-height="'.$this->config['fb_height'].'" data-header="'.$this->config['fb_header'].'" data-linktarget="'.$this->config['fb_link_target'].'" data-recommendations="'.$this->config['fb_recommendations'].'"></div>'; ?>
<?php endif; ?>