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
// Main class
class SocialGK5TwitterHelper
{
    private $config;
    private $content;
    private $error;
    private $pData;
    private $json;
    /**
     *	INITIALIZATION 
     **/
    function __construct($module,$params)
    {
        jimport('joomla.filesystem.file');
        // configuration array
        $this->config = $params->toArray();
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
			$doc->addScript("http://platform.twitter.com/widgets.js");
		}
		if($this->config['twitter_use_css']) {
			$uri = JURI::getInstance();
			$doc->addStyleSheet( $uri->root().'modules/mod_social_gk5/styles/twitter/'.$this->config['twitter_tweet_style'].'.css', 'text/css' );
		}
  	
        if($this->config['twitter_cache'] == 1) {
            if(filesize(realpath('modules/mod_social_gk5/cache/cache.xml')) == 0 || ((filemtime(realpath('modules/mod_social_gk5/cache/cache.xml')) + $this->config['twitter_cache_time'] * 60) < time())) {
				
            // get the data from twitter
			$this->getTweets();
			
            if($this->error == '') {
                // saving cache
                if($this->pData != '') {
                JFile::write(realpath('modules/mod_social_gk5/cache/cache.xml'), json_encode($this->pData));
                JFile::write(realpath('modules/mod_social_gk5/cache/cache.backup.xml'), json_encode($this->pData));
            	}
            } else {
                $this->pData = json_decode(JFile::read(realpath('modules/mod_social_gk5/cache/cache.backup.xml')));
            }
            } else {
				$this->pData = json_decode(JFile::read(realpath('modules/mod_social_gk5/cache/cache.xml')));
			} /// close
        } else {
			$this->getTweets();	
		}
    }


    /**
     *	RENDERING LAYOUT
     **/
    function render()
    {
		if($this->config['twitter_widget'] == 'tweets') {
    		require (JModuleHelper::getLayoutPath('mod_social_gk5', 'twitterTweets'));
		} else if($this->config['twitter_widget'] == 'search') {
			require (JModuleHelper::getLayoutPath('mod_social_gk5', 'twitterSearch'));
		} else if($this->config['twitter_widget'] == 'profile') {
			require (JModuleHelper::getLayoutPath('mod_social_gk5', 'twitterProfile'));
		} else if($this->config['twitter_widget'] == 'faves') {
			require (JModuleHelper::getLayoutPath('mod_social_gk5', 'twitterFavs'));
		} else if($this->config['twitter_widget'] == 'list') {
			require (JModuleHelper::getLayoutPath('mod_social_gk5', 'twitterList'));
		}
    }

    function dateDifference($date)
    {
        return $this->dateDiff("now", $date);
    }
	
	function getTweets() {
		
		      $url = 'http://search.twitter.com/search.json?q=' . $this->config['twitter_search_query'].'&amp;rpp=' . $this->config['twitter_tweet_amount'].'&amp;result_type=recent';
       	
		if (function_exists('curl_init') && ($this->config['twitter_search_query'] != '' || $this->config['twitter_tweet_amount'] > 0)) {                
                // phrase results
                $curl = curl_init();
                // saves us before putting directly results of request
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                // check the source of request
                curl_setopt($curl, CURLOPT_URL, $url);
                // timeout in seconds
                curl_setopt($curl, CURLOPT_TIMEOUT, 20);
                // useragent
                curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                // reading content
                $json = curl_exec($curl);
                // closing connection
                curl_close($curl);
                $decode = json_decode($json, true); //getting the file content as array
                $count = count($decode['results']); //counting the number of status
				
                for ($i = 0; $i < $count; $i++) {       
                	$this->pData[$i]['id'] = $decode['results'][$i]['id'];
                	$this->pData[$i]['text'] = $decode['results'][$i]['text'];
					$this->pData[$i]['username'] = $decode['results'][$i]['from_user'];
					$this->pData[$i]['user_id'] = $decode['results'][$i]['from_user_id'];
					$this->pData[$i]['avatar'] = $decode['results'][$i]['profile_image_url'];
                 	$this->pData[$i]['name'] = $decode['results'][$i]['from_user_name'];
                	$this->pData[$i]['time'] = date("d M", strtotime($decode['results'][$i]['created_at']));
                	$this->pData[$i]['time_diff'] = $this->dateDifference($decode['results'][$i]['created_at']);
                 	$this->pData[$i]['url'] = $decode['results'][$i]['from_user'];
					
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
     						
                function cmp($a, $b)
                {
                    $a = $a['time'];
                    $b = $b['time'];
                    return ($a == $b) ? 0 : ($a > $b ? -1 : 1);
                }
                if($this->config['twitter_search_query'] == '' || $this->pData=='') {
                	$this->error = 'There is no feed to display';
                } else {
               		usort($this->pData, "cmp");
                	// only way to get it working with cache properly
                	$encoded = json_encode($this->pData);
                	$this->pData = json_decode($encoded);
				}
            } else {
                $this->error = 'cURL extension and file_get_content method is not available on your server';
            }	
		
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
        $this->pData = json_decode(JFile::read(realpath('modules/mod_social_gk5/cache/cache.xml')));
    }

}
/*eof*/
