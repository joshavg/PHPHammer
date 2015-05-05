<?php

class Output
{
    const BLACK = 30;
    const BLUE = 34;
    const GREEN = 32;
    const CYAN = 36;
    const RED = 31;
    const PURPLE = 35;
    const BROWN  = 33;
    //const LGRAY = 37;
    //const DGRAY = 30;
    //const LBLUE = 34;
    //const LGREEN = 32;
    //const LCYAN = 36;
    //const LRED = 31;
    //const LPURPLE = 35;
    //const YELLOW = 33;
    const WHITE = 37;

    public static function writeln($msg, $color = Output::WHITE) {
        echo "\033[" . $color . "m$msg\033[0m";
        static::newln();
    }
    public static function write($msg, $color = Output::WHITE) {
        echo "\033[" . $color . "m$msg\033[0m";
    }

    public static function newln() {
        echo "\n";
    }
}
