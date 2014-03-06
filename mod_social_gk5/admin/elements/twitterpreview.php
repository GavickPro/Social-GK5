<?php

defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

class JFormFieldTwitterPreview extends JFormField {
	protected $type = 'TwitterLists';

	protected function getInput() {
		jimport('joomla.filesystem.file');
		// necessary Joomla! classes
		$uri = JURI::getInstance();
		$doc =JFactory::getDocument();
		$doc->addStyleSheet( './widget.css' );
		// generate the select list
		$options = (array) $this->getOptions();
		$file_select = JHtml::_('select.genericlist', $options, 'name', '', 'value', 'text', 'default', 'twitter_list_name');
		// return the standard formfield output
		$html = '';
		$html .= '<span class="sample">widget sample preview</span><div id="example-preview-widget" class="twtr-widget twtr-widget-profile"><div style="width: 200px;" class="twtr-doc">            <div class="twtr-hd"><a class="twtr-profile-img-anchor" href="http://twitter.com/intent/user?screen_name=gavickpro" target="_blank"><img src="https://s3.amazonaws.com/twitter_production/profile_images/1799796505/gavick_logo_normal.jpg" class="twtr-profile-img" alt="profile"></a>                      <h3>GavickPro</h3>                      <h4><a href="http://twitter.com/intent/user?screen_name=gavickpro" target="_blank">gavickpro</a></h4>             </div>            <div class="twtr-bd">              <div style="height: auto;" class="twtr-timeline">                <div class="twtr-tweets">                  <div class="twtr-reference-tweet"></div><div id="tweet-id-9" class="twtr-tweet"><div class="twtr-tweet-wrap">         <div class="twtr-avatar">           <div class="twtr-img"><a href="http://twitter.com/intent/user?screen_name=gavickpro" target="_blank"><img src="https://s3.amazonaws.com/twitter_production/profile_images/1799796505/gavick_logo_normal.jpg" alt="gavickpro profile"></a></div>         </div>         <div class="twtr-tweet-text">           <p>             <a class="twtr-user" href="http://twitter.com/intent/user?screen_name=gavickpro" target="_blank">gavickpro</a> Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. <a title="sample link" rel="nofollow" target="_blank" extrahtml="target=_blank" href="#"><span class="tco-ellipsis"><span style="font-size:0; line-height:0">&nbsp;</span></span><span style="font-size:0; line-height:0">http://</span><span class="js-display-url">lorem.ipsum.sit</span><span style="font-size:0; line-height:0"></span><span class="tco-ellipsis"><span style="font-size:0; line-height:0">&nbsp;</span></span></a>             <em>            <a href="#" time="Thu May 17 11:08:15 +0000 2012" class="twtr-timestamp" target="_blank">10 hours ago</a> ·            <a href="#" class="twtr-reply" target="_blank">reply</a> ·             <a href="#" class="twtr-rt" target="_blank">retweet</a> ·             <a href=#" class="twtr-fav" target="_blank">favorite</a>             </em>           </p>         </div>       </div></div>                  <!-- tweets show here -->                </div>              </div>            </div>            <div class="twtr-ft">              <div><a href="http://twitter.com" target="_blank"><img src="https://twitter-widgets.s3.amazonaws.com/i/widget-logo.png" alt=""></a>                <span><a href="http://twitter.com/gavickpro" style="color:#fff" class="twtr-join-conv" target="_blank">Join the conversation</a></span>              </div>            </div>          </div></div>';
		// finish the output
		return $html;
	}

	protected function getOptions() {
		$options = array();
		return array_merge($options);
	}
}

/* EOF */