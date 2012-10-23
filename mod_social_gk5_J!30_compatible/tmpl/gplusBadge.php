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

// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<!-- standard layout -->
   <?php if($this->config['gplus_html5_valid'] == 1) : ?>
        <div class="g-plus" data-href="https://plus.google.com/<?php echo $this->config['gplus_id']?>?rel=author" data-width="<?php echo $this->config['gplus_badge_width']?>" data-height="69" data-theme="<?php echo $this->config['gplus_badge_color']?>"></div>
    <?php else : ?>
        <g:plus href="https://plus.google.com/<?php echo $this->config['gplus_id']?>" rel="author" width="<?php echo $this->config['gplus_badge_width']?>" height="69" theme="<?php echo $this->config['gplus_badge_color']?>"></g:plus>
    <?php endif; ?>