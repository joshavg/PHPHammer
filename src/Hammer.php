<?php

class Hammer {

    const OS_UNKNOWN = 'UNKNOWN';
    const OS_WIN = 'WIN';
    const OS_LINUX = 'LINUX';
    const OS_OSX = 'OSX';

    public static function execTarget($name) {
        $target = Globals::get('buildfile')['targets'][$name];

        foreach($target as $line) {
            $builder = $line[0];
            Output::write('Executing builder ');
            Output::write($builder, Output::CYAN);

            if($builder === 'target') {
                Output::write(' with target ');
                Output::writeln($line[1], Output::CYAN);
            } else {
                Output::newln();
            }

            $builder = $line[0];
            $builder($line);
        }
    }

    public static function getOS() {
        if(stripos(PHP_OS, 'DAR') !== false) {
            return static::OS_OSX;
        } else if(stripos(PHP_OS, 'WIN') !== false) {
            return static::OS_WIN;
        } else if(stripos(PHP_OS, 'LINUX') !== false) {
            return static::OS_LINUX;
        }

        return static::OS_UNKNOWN;
    }
    
    public static function execConsole($line) {
	return shell_exec($line);
    }

}
