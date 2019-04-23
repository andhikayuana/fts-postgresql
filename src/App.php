<?php

namespace Yuana;

class App
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db->getInstance();
    }

    public function run() 
    {
        echo '---- START CONSOLE APP ----' . PHP_EOL;

        foreach ($this->getUsers() as $user) {
            echo '---- BEGIN FETCH DATA ----' . PHP_EOL;
            $data = TwitterScrapper::getTweets($user);
            echo '---- END FETCH DATA ----' . PHP_EOL;

            echo '---- BEGIN INSERT DATA ----' . PHP_EOL;
            foreach ($data as $item) {
                echo json_encode($item);
                echo '' . PHP_EOL;
                $this->db
                    ->posts_v1()
                    ->insert([
                        'title' => $item['id'],
                        'content' => $item['text'],
                        'author' => $item['username'],
                    ]);
            }
            echo '---- END INSERT DATA ----' . PHP_EOL;
        }

        echo '---- FINISH CONSOLE APP ----' . PHP_EOL;
    }

    private function getUsers()
    {
        return [
            'jokowi',
            'prabowo',
            'KHMarufAmin_',
            'sandiuno',
            'aniesbaswedan',
            'ridwankamil',
            'ganjarpranowo',
            'onnowpurbo',
            'tifsembiring',
            'detikcom',
            'Metro_TV',
            'tvOneNews',
            'TRANS7',
            'TRANSTV_CORP',
            'OfficialRCTI',
            'SCTV_',
            'IndosiarID',
            'petanikode',
            'hariankompas',
            'vivacoid',
            'mediaindonesia',
            'okezonenews',
            'sudjiwotedjo',
            'itbofficial',
            'kaskus',
            'kemkominfo',
            'lewatmana',
            'Dompet_Dhuafa',
            'UGMYogyakarta',
            'watchdoc_ID',
            'GreenpeaceID',
            'WWF_ID',
            'voaindonesia',
            'jpnncom',
            'unpad',
            'soloposdotcom',
            'rumahzakat',
            'hariankompas',
            'Kemdikbud_RI'
        ];
    }
}
