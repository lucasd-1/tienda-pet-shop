<?php

class dataBase{
    public static function connect(){
        $db = new mysqli(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_NAME'));
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}