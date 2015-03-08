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

<?php if($this->pData == '' || count($this->pData) < 0) : ?>
	<p><?php echo JText::_( 'MOD_SOCIAL_ANY_DATA' ); ?></p>
<?php else : ?>

	<?php if(($this->config['twitter_rows'] * $this->config['twitter_columns']) > 0 && $this->config['twitter_tweet_amount'] >= ($this->config['twitter_rows'] * $this->config['twitter_columns'])) : ?>
			
		<?php 
			$amount = $this->config['twitter_rows'] * $this->config['twitter_columns']; 
			if($amount > count($this->pData)) {
				$amount = count($this->pData);
			}
		?>
				
		<?php for($i = 0; $i < $amount; $i++) : ?>
		<div class="gkTweet" style="width: <?php echo 100/$this->config['twitter_columns']."%!important"; ?>">
			<div>
				<?php if($this->config['twitter_show_avatar']) : ?>
				<img src="<?php echo str_replace('http://', '//', $this->pData[$i]['avatar']); ?>" alt="<?php echo $this->pData[$i]['name']; ?>" />
				<?php endif; ?>
		
			
				<?php if($this->config['twitter_show_uname'] || $this->config['twitter_show_fname']) : ?>
				<span class="gkTweetName">
						<?php if($this->config['twitter_show_uname']) : ?>
							<a href="<?php echo 'https://twitter.com/'.$this->pData[$i]['url']; ?>"><?php echo $this->pData[$i]['username']; ?></a>
						<?php endif; ?>
						<?php if($this->config['twitter_show_uname']) : ?>
							<small><?php echo $this->pData[$i]['name']; ?></small>
						<?php endif; ?>
				</span>
				<?php endif; ?>
				
				
				<p class="gkTweetContent"><?php echo $this->pData[$i]['text']; ?></p>
				
				
				<span class="gkTweetInfo">
				<?php if($this->config['twitter_time_mode'] == 'cdate') : ?>
					<?php echo $this->pData[$i]['time_diff'].' '.JText::_( 'MOD_SOCIAL_AGO' ); ?>
				<?php else : ?>
					<?php echo $this->pData[$i]['time']; ?>
				<?php endif; ?>
				
				<?php if($this->config['twitter_show_actions']) : ?>
					<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $this->pData[$i]['id']; ?>"><?php echo JText::_( 'MOD_SOCIAL_REPLY' ) ?></a>
					<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id=<?php echo $this->pData[$i]['id']; ?>"><?php echo JText::_( 'MOD_SOCIAL_RETWEET' ) ?></a>
					<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id=<?php echo $this->pData[$i]['id']; ?>"><?php echo JText::_( 'MOD_SOCIAL_FAVORITE' ) ?></a>
				<?php endif; ?>
				
				</span>
			</div>
		</div>
			
		<?php if(($i+1) % ($this->config['twitter_columns']) == 0) : ?>
		<div class="gkDivider"></div>
		<?php endif; ?>
		<?php endfor; ?>
	<?php else : ?>
		<p><?php echo JText::_( 'MOD_SOCIAL_NOT_SUFFICIENT_TWEETS_F' ).$this->config['twitter_columns']." columns *".$this->config['twitter_rows']. " rows = ".($this->config['twitter_rows'] * $this->config['twitter_columns'])." tweets, ".JText::_( 'MOD_SOCIAL_NOT_SUFFICIENT_TWEETS_S' ).$this->config['twitter_tweet_amount'].JText::_( 'MOD_SOCIAL_NOT_SUFFICIENT_TWEETS_T' ) ; ?></p>
	<?php endif; ?>
	
<?php endif; ?>
