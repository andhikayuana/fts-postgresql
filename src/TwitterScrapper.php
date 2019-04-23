<?php

namespace Yuana;

class TwitterScrapper
{

    public static function getTweets($username, $get_dates=false){
        $page = file_get_contents("https://mobile.twitter.com/$username");
        preg_match_all(
            '{<div class="tweet-text" data-id="(\d+)">\s*<div class="dir-ltr" dir="ltr">\s*(.+?)\s*</div>\s*</div>}',
            $page,
            $matches
        );
        if (empty($matches[1])) return [];
        $ids   = array_values($matches[1]);
        $texts = array_values($matches[2]);
        unset($matches);
    
        $results = [];
        for ($i=1,$c=count($ids) ; $i<$c ; $i++ ){
            $results[] = [
                'id' 	=> $ids[$i],
                'text'  => strip_tags($texts[$i]),
                'username' => $username,
            ];
        }
        
        if ($get_dates) {
            $dates = [];
            preg_match_all(
                '{<a name="tweet_(\d+)"[^>]+>([^>]+)</a>}',
                $page,
                $dates
            );
            $dds = [];
            if (!empty($dates[1])) for ($i=0,$c=count($dates[1]) ; $i<$c ; $i++ ) $dds[$dates[1][$i]] = $dates[2][$i];
            if ($dds) foreach($results as &$tweet){
                if (isset($dds[$tweet['id']])){
                    $tweet['date'] = $dds[$tweet['id']];
                }
            }
        }
        
        return $results;
    }
    
}
