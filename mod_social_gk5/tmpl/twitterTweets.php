<?php

/**
 * Gavick Social GK5 - helper class
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

<?php if($this->pData == '')  : ?>
	<p style="float: left">Any feed to display</p>
<?php else : ?>
<?php for($i = 0; $i < $this->config['twitter_tweet_amount']; $i++) : ?>
<?php if(isset($this->pData[$i])) : ?>
<div class="bubble">
	<span>
		<a href="<?php echo 'http://twitter.com/'.$this->pData[$i]->url; ?>"><?php echo $this->pData[$i]->name.': '; ?></a>
		<a href="https://twitter.com/#!/<?php echo $this->pData[$i]->name; ?>/status/<?php echo $this->pData[$i]->id; ?>"><?php echo $this->pData[$i]->text; ?></a>
	</span>
	<span><?php echo $this->pData[$i]->time_diff. " ago"; ?></span>
	<cite></cite>
	
	<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>

<p><a href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $this->pData[$i]->id; ?>">Reply</a></p>

<p><a href="https://twitter.com/intent/retweet?tweet_id=<?php echo $this->pData[$i]->id; ?>">Retweet</a></p>

<p><a href="https://twitter.com/intent/favorite?tweet_id=<?php echo $this->pData[$i]->id; ?>">Favorite</a></p>
	
</div>
<?php endif; ?>
<?php endfor; ?>
<?php endif; ?>
