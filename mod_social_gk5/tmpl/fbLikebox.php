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
	<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo urlencode($this->config['fb_site']); ?>&amp;width=<?php echo $this->config['fb_likebox_width']; ?>&amp;colorscheme=<?php echo $this->config['fb_likebox_colorscheme']; ?>&amp;show_faces=<?php echo $this->config['fb_likebox_faces']; ?>&amp;stream=<?php echo $this->config['fb_likebox_stream'] ?>&amp;header=<?php echo $this->config['fb_likebox_header']; ?>&amp;height=<?php echo $this->config['fb_likebox_height']; ?>&amp;show_border=<?php echo $this->config['fb_likebox_show_border']; ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $this->config['fb_likebox_width'] ?>px; height:<?php echo $this->config['fb_likebox_height']; ?>px;" allowtransparency="true"></iframe>
<?php elseif($this->config['fb_code_type'] == 'XFBML') : ?>
	<?php echo '<fb:like-box 
	href="'.$this->config['fb_site'].'" 
	width="'.$this->config['fb_likebox_width'].'px" 
	height="'.$this->config['fb_likebox_height'].'px" 
	colorscheme="'.$this->config['fb_likebox_colorscheme'].'" 
	show_faces="'.$this->config['fb_likebox_faces'].'" 
	stream="'.$this->config['fb_likebox_stream'].'" 
	header="'.$this->config['fb_likebox_header'].'" 
	show_border="'.$this->config['fb_likebox_show_border'].'">
	</fb:like-box>'; ?>
<?php else : ?>
<?php echo '<div class="fb-like-box" 
	data-href="'.$this->config['fb_site'].'" 
	data-width="'.$this->config['fb_likebox_width'].'px" 
	data-height="'.$this->config['fb_likebox_height'].'px" 
	data-colorscheme="'.$this->config['fb_likebox_colorscheme'].'" 
	data-show-faces="'.$this->config['fb_likebox_faces'].'" 
	data-stream="'.$this->config['fb_likebox_stream'].'" 
	data-header="'.$this->config['fb_likebox_header'].'" 
	data-show-border="'.$this->config['fb_likebox_show_border'].'">
</div>'; ?>
<?php endif; ?>