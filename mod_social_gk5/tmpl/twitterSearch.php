<?php

/**
 * Gavick Social GK5 
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

<?php if($this->config['twitter_search_query'] == '' || $this->config['twitter_tweet_amount']< 1)  : ?>
	<p><?php echo JText::_( 'MOD_SOCIAL_ANY_DATA' ); ?></p>
<?php else : ?>
<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'search',
  search: '<?php echo $this->config['twitter_search_query']; ?>',
  interval: <?php echo $this->config['twitter_interval']; ?>,
  rpp:  <?php echo $this->config['twitter_tweet_amount']; ?>,
  title: '<?php echo $this->config['twitter_title']; ?>',
  subject: '<?php echo $this->config['twitter_desc']; ?>',
  width: 'auto',
  height: <?php echo $this->config['twitter_height']; ?>,
  theme: {
    shell: {
      background: '<?php echo $this->config['twitter_widget_color']; ?>',
      color: '<?php echo $this->config['twitter_widget_text_color']; ?>'
    },
    tweets: {
      background: '<?php echo $this->config['twitter_tweet_color']; ?>',
      color: '<?php echo $this->config['twitter_tweet_text_color']; ?>',
      links: '<?php echo $this->config['twitter_link_color']; ?>'
    }
  },
  features: {
    scrollbar: <?php echo $this->config['twitter_include_scrollbar']; ?>,
    loop: <?php echo $this->config['twitter_loop']; ?>,
    live:  <?php echo $this->config['twitter_auto_refresh']; ?>,
    behavior: '<?php echo $this->config['twitter_behaviour']; ?>'
  }
}).render().start();
</script>
	
	
<?php endif; ?>
