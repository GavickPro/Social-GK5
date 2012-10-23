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

if(($this->config['fb_code_type'] == 'iframe') || ($this->config['fb_code_type'] == 'XFBML') ) {
    echo '<fb:live-stream event_app_id="'.$this->config['fb_app_id'].'" width="'.$this->config['fb_livestream_width'].'" height="'.$this->config['fb_livestream_height'].'" xid="'.$this->config['fb_livestream_xid'].'" via_url="'.$this->config['fb_livestream_url'].'" always_post_to_friends="'.$this->config['fb_livestream_friends'].'"></fb:live-stream>';
} else {
    echo '<div class="fb-live-stream" data-event-app-id="'.$this->config['fb_app_id'].'" data-width="'.$this->config['fb_livestream_width'].'" data-height="'.$this->config['fb_livestream_height'].'" data-xid="'.$this->config['fb_livestream_xid'].'" data-via-url="'.$this->config['fb_livestream_url'].'" data-always-post-to-friends="'.$this->config['fb_livestream_friends'].'"></div>';
}

/* eof */