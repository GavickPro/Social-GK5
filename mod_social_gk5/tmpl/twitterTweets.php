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
	<p style="float: left"><?php echo JText::_( 'MOD_SOCIAL_ANY_DATA' ); ?></p>
<?php else : ?>

<?php $i = 0; ?>
<?php $width = 100/$this->config['twitter_columns']."%"; ?>


<?php for($r = 0; $r< $this->config['twitter_rows']; $r++) : ?>
	<?php if($i < $this->config['twitter_tweet_amount']) : ?>
	<div class="gkSocialRow">
	<?php else: ?>
		<?php break; ?>
	<?php endif; ?>
	<?php for($c = 0; $c<$this->config['twitter_columns']; $c++) : ?>
		<?php $i = $r*$this->config['twitter_rows'] + $c; ?>
				<?php if(isset($this->pData[$i]) && $i < $this->config['twitter_tweet_amount']) : ?>
				<div class="bubble" width="<?php echo $width ?>">
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
				<?php else : ?>
					<?php break; ?>
				<?php endif; ?>
	
	<?php endfor; ?>
	</div>
<?php endfor; ?>	

<?php for($i = 0; $i < $this->config['twitter_tweet_amount']; $i++) : ?>

<?php endfor; ?>
<?php endif; ?>
