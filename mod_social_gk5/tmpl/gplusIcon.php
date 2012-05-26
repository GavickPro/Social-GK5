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

<?php if($this->config['gplus_badge_style'] == 'small_icon') : ?>
    <?php if($this->config['gplus_custom_name'] == '') : ?>
        <a href="https://plus.google.com/<?php echo $this->config['g_id']?>?prsrc=3" style="text-decoration:none;"><img src="https://ssl.gstatic.com/images/icons/gplus-16.png" alt="" style="border:0;width:16px;height:16px;"/></a>
    <?php else : ?>
    	<?php if($this->config['gplus_custom_name_pos'] == 'before') : ?>
        	<a href="https://plus.google.com/<?php echo $this->config['gplus_id']?>?prsrc=3" style="display:inline-block;text-decoration:none;color:#333;text-align:center;font:13px/16px arial,sans-serif;white-space:nowrap;"><span style="display:inline-block;font-weight:bold;vertical-align:top;margin-right:5px;margin-top:0px;"><?php echo $this->config['gplus_custom_name']?></span>
        	<span style="display:inline-block;vertical-align:top;margin-right:10px;margin-top:0px;"><?php echo JText::_('MOD_SOCIAL_GPLUS_ON'); ?></span><img src="https://ssl.gstatic.com/images/icons/gplus-16.png" alt="" style="border:0;width:16px;height:16px;"/></a>
    	<?php else : ?>
    		<a href="https://plus.google.com/<?php echo $this->config['gplus_id']?>?prsrc=3" style="display:inline-block;text-decoration:none;color:#333;text-align:center;font:13px/16px arial,sans-serif;white-space:nowrap;"><img src="https://ssl.gstatic.com/images/icons/gplus-16.png" alt="" style="border:0;width:16px;height:16px;"/>
    		<span style="display:inline-block;font-weight:bold;vertical-align:top;margin-left:5px;margin-top:0px;"><?php echo $this->config['gplus_custom_name']?></span>
        	</a>
    	<?php endif; ?>
    <?php endif; ?>
<?php elseif($this->config['gplus_badge_style'] == 'medium_icon') : ?>
    <?php if($this->config['gplus_custom_name'] == '') : ?>
        <a href="https://plus.google.com/<?php echo $this->config['g_id']?>?prsrc=3" style="text-decoration:none;"><img src="https://ssl.gstatic.com/images/icons/gplus-32.png" alt="" style="border:0;width:32px;height:32px;"/></a>
    <?php else : ?>
    	<?php if($this->config['gplus_custom_name_pos'] == 'before') : ?>
        	<a href="https://plus.google.com/<?php echo $this->config['g_id']?>?prsrc=3" style="display:inline-block;text-decoration:none;color:#333;text-align:center;font:13px/16px arial,sans-serif;white-space:nowrap;"><span style="display:inline-block;font-weight:bold;vertical-align:top;margin-right:5px;margin-top:8px;"><?php echo $this->config['gplus_custom_name']?></span>
        	<span style="display:inline-block;vertical-align:top;margin-right:15px;margin-top:8px;"><?php echo JText::_('MOD_SOCIAL_GPLUS_ON'); ?></span><img src="https://ssl.gstatic.com/images/icons/gplus-32.png" alt="" style="border:0;width:32px;height:32px;"/></a>
    	<?php else : ?>
    		<a href="https://plus.google.com/<?php echo $this->config['gplus_id']?>?prsrc=3" style="display:inline-block;text-decoration:none;color:#333;text-align:center;font:13px/16px arial,sans-serif;white-space:nowrap;"><img src="https://ssl.gstatic.com/images/icons/gplus-32.png" alt="" style="border:0;width:32px;height:32px;"/>
    		<span style="display:inline-block;font-weight:bold;vertical-align:top;margin-left:5px;margin-top:8px;"><?php echo $this->config['gplus_custom_name']?></span>
        	</a>
    	<?php endif; ?>
    <?php endif; ?>
<?php else : ?>
    <?php if($this->config['gplus_custom_name'] == '') : ?>
        <a href="https://plus.google.com/<?php echo $this->config['gplus_id']?>?prsrc=3" style="text-decoration:none;"><img src="https://ssl.gstatic.com/images/icons/gplus-64.png" alt="" style="border:0;width:64px;height:64px;"/></a>
    <?php else : ?>
        <a href="https://plus.google.com/<?php echo $this->config['gplus_id']?>?prsrc=3" style="display:inline-block;text-decoration:none;color:#333;text-align:center;font:13px/16px arial,sans-serif;white-space:nowrap;"><img src="https://ssl.gstatic.com/images/icons/gplus-64.png" alt="" style="border:0;width:64px;height:64px;margin-bottom:7px;"><br/>
        <span style="font-weight:bold;"><?php echo $this->config['gplus_custom_name']?></span><br/><span><?php echo JText::_('MOD_SOCIAL_GPLUS_ON'); ?> Google+ </span></a>
    <?php endif; ?>
<?php endif; ?>