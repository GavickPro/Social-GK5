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
<iframe src="//www.facebook.com/plugins/facepile.php?href=<?php echo urlencode($this->config['fb_site']); ?>&amp;width=<?php echo $this->config['fb_facepile_width']; ?>&amp;max_rows=<?php echo $this->config['fb_facepile_num_rows']; ?>&amp;size=<?php echo $this->config['fb_facepile_size']; ?>&amp;colorscheme=<?php echo $this->config['fb_facepile_colorscheme']; ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $this->config['fb_facepile_width'] ?>px;" allowtransparency="true"></iframe>
<?php elseif($this->config['fb_code_type'] == 'XFBML') : ?>
<?php echo '<fb:facepile 
	href="'.$this->config['fb_site'].'" 
	width="'.$this->config['fb_facepile_width'].'px" 
	max_rows="'.$this->config['fb_facepile_num_rows'].'" 
	size="'.$this->config['fb_facepile_size'].'" 
	show_count="true" 
	colorscheme="'.$this->config['fb_facepile_colorscheme'].'">
</fb:facepile>'; ?>
<?php else : ?>
<?php echo '<div class="fb-facepile" 
	data-href="'.$this->config['fb_site'].'" 
	data-width="'.$this->config['fb_facepile_width'].'" 
	data-max-rows="'.$this->config['fb_facepile_num_rows'].'" 
	data-size="'.$this->config['fb_facepile_size'].'" 
	data-show-count="true" 
	data-colorscheme="'.$this->config['fb_facepile_colorscheme'].'">
</div>'; ?>
<?php endif; ?>