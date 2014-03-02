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

<?php if($this->config['gplus_icon_size'] == '16') : ?>
	
	<a href="<?php echo $this->config['gplus_user']; ?>?prsrc=3"
	   rel="publisher" target="_top" style="text-decoration:none;display:inline-block;color:#333;text-align:center; font:13px/16px arial,sans-serif;white-space:nowrap;">
	<?php if($this->config['gplus_custom_name'] != '') : ?>   
	<span style="display:inline-block;font-weight:bold;vertical-align:top;margin-right:5px; margin-top:0px;">GKPRo</span><span style="display:inline-block;vertical-align:top;margin-right:13px; margin-top:0px;"><?php echo JText::_( 'MOD_SOCIAL_GPLUS_ON' ); ?></span>
	<?php endif; ?>
	<img src="//ssl.gstatic.com/images/icons/gplus-16.png" alt="Google+" style="border:0;width:16px;height:16px;"/>
	</a>
	
<?php elseif($this->config['gplus_icon_size'] == '32') : ?>
	<a href="<?php echo $this->config['gplus_user']; ?>?prsrc=3"
	   rel="publisher" target="_top" style="text-decoration:none;display:inline-block;color:#333;text-align:center; font:13px/16px arial,sans-serif;white-space:nowrap;">
	<?php if($this->config['gplus_custom_name'] != '') : ?>
		<span style="display:inline-block;font-weight:bold;vertical-align:top;margin-right:5px; margin-top:8px;">GKPRo</span><span style="display:inline-block;vertical-align:top;margin-right:15px; margin-top:8px;"><?php echo JText::_( 'MOD_SOCIAL_GPLUS_ON' ); ?></span>
	<?php endif; ?>
	<img src="//ssl.gstatic.com/images/icons/gplus-32.png" alt="Google+" style="border:0;width:32px;height:32px;"/>
	</a>
<?php else : ?>
	<a href="<?php echo $this->config['gplus_user']; ?>?prsrc=3"
	   rel="publisher" target="_top" style="text-decoration:none;display:inline-block;color:#333;text-align:center; font:13px/16px arial,sans-serif;white-space:nowrap;">
	<img src="//ssl.gstatic.com/images/icons/gplus-<?php echo $this->config['gplus_icon_size']; ?>.png" alt="Google+" style="border:0;width:64px;height:64px;"/>
	<?php if($this->config['gplus_custom_name'] != '') : ?>
	<br /><span style="font-weight:bold;"><?php echo $this->config['gplus_custom_name']; ?></span><br /><span><?php echo JText::_( 'MOD_SOCIAL_GPLUS_ON' ); ?> Google+</span>
	<?php endif; ?>
	</a>	
<?php endif; ?>