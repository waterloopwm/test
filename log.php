<?php

namespace utils;

class Log{

    public static function log($content){
        file_put_contents(ROOT_PATH.'/runtime/logs/'.date("Y-m-d").".log",$content.PHP_EOL,FILE_APPEND | LOCK_EX);
        return;
    }

}
