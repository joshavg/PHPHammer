<?php

class Globals
{
    private static $vars;

    public static function set($name, $var) {
        static::$vars[$name] = $var;
    }

    public static function get($name) {
        return static::$vars[$name];
    }
}
