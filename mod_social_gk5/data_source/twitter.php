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
require 'tmhOAuth'.DS.'tmhOAuth.php';
require 'tmhOAuth'.DS.'tmhUtilities.php';
// Main class
class SocialGK5TwitterHelper
{
    private $config;
    private $content;
    private $error;
    private $pData;
    private $json;
    private $id;
    
    /**
     *  INITIALIZATION 
     **/
    function __construct($module,$params)
    {
        jimport('joomla.filesystem.file');
        // configuration array
        $this->config = $params->toArray();
        $this->id = $module->id;
        // query validation process
        $this->config['twitter_search_query'] = str_replace('#','%23', $this->config['twitter_search_query']);
        $this->config['twitter_search_query'] = str_replace('@','%40', $this->config['twitter_search_query']);
        $this->config['twitter_search_query'] = str_replace(' ','%20', $this->config['twitter_search_query']);
    }
    function getData()
    {
        clearstatcache();
        setlocale(LC_ALL,"0");
        $doc = JFactory::getDocument();
        if($this->config['twitter_show_actions']) {
            if($this->config['cookie_conset'] == 0) {
                        $content = '<script type="text/javascript" ';   
            } else {
                        $content = '<script type="text/plain" class="cc-onconsent-social" ';    
            }
            $content .= 'src="//platform.twitter.com/widgets.js"></script>';
            echo $content;
        }
        if($this->config['twitter_use_css']) {
            $uri = JURI::getInstance();
            $doc->addStyleSheet( $uri->root().'modules/mod_social_gk5/styles/twitter/'.$this->config['twitter_tweet_style'].'.css', 'text/css' );
        }
    
        if($this->config['twitter_cache'] == 1) {
            if(filesize(realpath('modules/mod_social_gk5/cache/cache.'.$this->id.'.json')) == 0 || ((filemtime(realpath('modules/mod_social_gk5/cache/cache.'.$this->id.'.json')) + $this->config['twitter_cache_time'] * 60) < time())) {

            // get the data from twitter
            $this->getTweets();
            
            if($this->error == '') {
                // saving cache
                if($this->pData != '') {
                	JFile::write(realpath('modules/mod_social_gk5/cache/cache.'.$this->id.'.json'), json_encode($this->pData));
                	JFile::write(realpath('modules/mod_social_gk5/cache/cache.backup.'.$this->id.'.json'), json_encode($this->pData));
                }
            } else {
                if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
                    $this->pData = json_decode(JFile::read(realpath('modules/mod_social_gk5/cache/cache.backup.'.$this->id.'.json')), true, 512, JSON_BIGINT_AS_STRING);
                } else {
                    $this->pData = json_decode(JFile::read(realpath('modules/mod_social_gk5/cache/cache.backup.'.$this->id.'.json')));
                }
            }
            } else {
                if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
                    $this->pData = json_decode(JFile::read(realpath('modules/mod_social_gk5/cache/cache.'.$this->id.'.json')), true, 512, JSON_BIGINT_AS_STRING);
                } else {
                    $this->pData = json_decode(JFile::read(realpath('modules/mod_social_gk5/cache/cache.'.$this->id.'.json')));
                }
            } /// close
        } else {
            $this->getTweets(); 
                        
        }
    }
    /**
     *  RENDERING LAYOUT
     **/
    function render() {
        require (JModuleHelper::getLayoutPath('mod_social_gk5', 'twitterTweets'));
    }
    function dateDifference($date) {
        return $this->dateDiff("now", $date);
    }
    
    function getTweets() {
        if (function_exists('curl_init') && ($this->config['twitter_search_query'] != '' || $this->config['twitter_tweet_amount'] > 0)) {                
                $tmhOAuth = new tmhOAuth(array(
                 'consumer_key' => $this->config['twitter_consumer_key'],
                 'consumer_secret' => $this->config['twitter_consumer_secret'],
                 'user_token' => $this->config['twitter_user_token'],
                 'user_secret' => $this->config['twitter_user_secret'],
                 'curl_ssl_verifypeer' => true
                ));
               
                $tmhOAuth->request(
                   'GET',
                   'https://api.twitter.com/1.1/search/tweets.json',
                   array(
                    'q' => $this->config['twitter_search_query'],
                    'count' => $this->config['twitter_tweet_amount'],
                    'result_type' => 'recent'
                   )
                 );
               
                if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
                    $decode = json_decode($tmhOAuth->response['response'], true, 512, JSON_BIGINT_AS_STRING); //getting the file content as array
                } else {
                    $decode = json_decode($tmhOAuth->response['response'], true, 512);                  
                }
               
                $count = count($decode['statuses']); //counting the number of status        
                $save = json_encode($tmhOAuth->response['response']);
                file_put_contents('results.json', $save);
                            
                for ($i = 0; $i < $count; $i++) {       
                    $this->pData[$i]['id'] = $decode['statuses'][$i]['id'];
                    $this->pData[$i]['text'] = $decode['statuses'][$i]['text'];
                    $this->pData[$i]['username'] = $decode['statuses'][$i]['user']['screen_name'];
                    $this->pData[$i]['user_id'] = $decode['statuses'][$i]['user']['id'];
                    $this->pData[$i]['avatar'] = $decode['statuses'][$i]['user']['profile_image_url'];
                    $this->pData[$i]['name'] = $decode['statuses'][$i]['user']['name'];
                    $this->pData[$i]['time'] = date("d M", strtotime($decode['statuses'][$i]['created_at']));
                    $this->pData[$i]['timestamp'] = $decode['statuses'][$i]['created_at'];
                    $this->pData[$i]['time_diff'] = $this->dateDifference($decode['statuses'][$i]['created_at']);
                    $this->pData[$i]['url'] = $decode['statuses'][$i]['user']['screen_name'];
                    
                    preg_match_all('/#\w*/', $this->pData[$i]['text'], $matches, PREG_PATTERN_ORDER);
                    foreach($matches as $key => $match) {
                        foreach($match as $m) {
                            $m = substr($m, 1);
                            $this->pData[$i]['text'] = str_replace($m, "<a href='https://twitter.com/#!/search/".$m."'>".$m."</a>", $this->pData[$i]['text']);
                        }
                    }
                    
                    preg_match_all('/@\w*/', $this->pData[$i]['text'], $matches, PREG_PATTERN_ORDER);
                    foreach($matches as $key => $match) {
                        foreach($match as $m) {
                            $m = substr($m, 1);
                            $this->pData[$i]['text'] = str_replace($m, "<a href='https://twitter.com/#!/".$m."'>".$m."</a>", $this->pData[$i]['text']);
                        }
                    }
                    
                    preg_match_all('/http:\/\/\S*/', $this->pData[$i]['text'], $matches, PREG_PATTERN_ORDER);
                    foreach($matches as $key => $match) {
                        foreach($match as $m) {
                            $this->pData[$i]['text'] = str_replace($m, "<a href='".$m."'>".$m."</a>", $this->pData[$i]['text']);
                        }
                    }
                }
                
                if($this->config['twitter_search_query'] == '' || $this->pData=='') {
                    $this->error = 'There is no feed to display';
                } else {
                    usort($this->pData, array($this, "cmp"));
                }
            } else {
                $this->error = 'cURL extension and file_get_content method is not available on your server';
            }   
        
    }
    /*
    	Function used to get the data comparision
    */
    function cmp($a, $b)
  	{
        $a = strtotime($a['timestamp']);
        $b = strtotime($b['timestamp']);
        return ($a == $b) ? 0 : ($a > $b ? -1 : 1);
    }
    /*
    * Function to get the backup data
    * thanks to http://www.if-not-true-then-false.com/2010/php-calculate-real-differences-between-two-dates-or-timestamps/
    */
    function dateDiff($time1, $time2, $precision = 6)
    {
        date_default_timezone_set("UTC");
        // If not numeric then convert texts to unix timestamps
        if (!is_int($time1)) {
            $time1 = strtotime($time1);
        }
        if (!is_int($time2)) {
            $time2 = strtotime($time2);
        }
        // If time1 is bigger than time2
        // Then swap time1 and time2
        if ($time1 > $time2) {
            $ttime = $time1;
            $time1 = $time2;
            $time2 = $ttime;
        }
        // Set up intervals and diffs arrays
        $intervals = array('year', 'month', 'day', 'hour', 'minute');
        $diffs = array();
        // Loop thru all intervals
        foreach ($intervals as $interval) {
            // Set default diff to 0
            $diffs[$interval] = 0;
            // Create temp time from time1 and interval
            $ttime = strtotime("+1 " . $interval, $time1);
            // Loop until temp time is smaller than time2
            while ($time2 >= $ttime) {
                $time1 = $ttime;
                $diffs[$interval]++;
                // Create new temp time from time1 and interval
                $ttime = strtotime("+1 " . $interval, $time1);
            }
        }
        $count = 0;
        $times = array();
        // Loop thru all diffs
        foreach ($diffs as $interval => $value) {
            // Break if we have needed precission
            if ($count >= $precision) {
                break;
            }
            // Add value and interval
            // if value is bigger than 0
            if ($value > 0) {
                // Add s if value is not 1
                if ($value != 1) {
                    $interval .= "s";
                }
                // Add value and interval to times array
                $times[] = $value . " " . $interval;
                $count++;
            }
        }
        if (count($times) >= 3) {
            unset($times[count($times)]);
            unset($times[count($times) - 1]);
        }
        if (count($times) == 0) {
            return "few seconds ";
        }
        // Return string with times
        return implode(", ", $times);
    }
    function useBackup()
    {
        $this->error = '';
        if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
            $this->pData = json_decode(JFile::read(realpath('modules/mod_social_gk5/cache/cache.'.$this->id.'.json', true, 512, JSON_BIGINT_AS_STRING)));
        } else {
            $this->pData = json_decode(JFile::read(realpath('modules/mod_social_gk5/cache/cache.'.$this->id.'.json')));
        }
    }
}
/*eof*/
