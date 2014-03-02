<?php

/**
 * Gavick Social GK5 - layout file
 * @package Joomla!
 * @ Copyright (C) 2009-2014 Gavick.com
 * @ All rights reserved
 * @ Joomla! is Free Software
 * @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
 * @version $Revision: GK4 1.0 $
 **/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<!-- standard layout -->
<!-- Place this tag where you want the widget to render. -->
<div class="g-page" 
	data-href="<?php echo $this->config['gplus_user']; ?>" 
	data-rel="publisher" 
	data-layout="<?php echo $this->config['gplus_badge_layout']; ?>" 
	data-theme="<?php echo $this->config['gplus_badge_color']; ?>" 
	data-showtagline="<?php echo $this->config['gplus_tagline']; ?>" 
	data-showcoverphoto="<?php echo $this->config['gplus_cover_photo']; ?>" 
	data-width="<?php echo $this->config['gplus_badge_width']; ?>">
</div>