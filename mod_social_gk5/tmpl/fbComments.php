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
?>

<?php if($this->config['fb_only_number_url'] == 'true') : ?>

<iframe src="//www.facebook.com/plugins/comments.php?href=<?php echo urlencode($this->config['fb_site']); ?>&permalink=1" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:130px; height:16px;" allowtransparency="true" ></iframe> 

<?php elseif($this->config['fb_only_number'] == 'true') : ?>

<?php echo '<fb:comments-count href="'. $this->config['fb_site'] .'"></fb:comments-count> '.$this->config['fb_only_number_add']; ?>

<?php else : ?>
        
    <?php if( ($this->config['fb_code_type'] == 'XFBML') || ($this->config['fb_code_type'] == 'iframe')) : ?>   
	   <?php echo '<fb:comments href="'.$this->config['fb_site'].'" num_posts="'.$this->config['fb_number_comments'].'" width="'.$this->config['fb_width_comments'].'" colorscheme="'.$this->config['fb_comments_colorscheme'].'"></fb:comments>'; ?>
    <?php else : ?>
        <?php echo '<div class="fb-comments" data-href="'.$this->config['fb_site'].'" data-num-posts="'.$this->config['fb_number_comments'].'" data-width="'.$this->config['fb_width_comments'].'" data-colorscheme="'.$this->config['fb_comments_colorscheme'].'"></div>'; ?>
    <?php endif; ?>
<?php endif; ?>