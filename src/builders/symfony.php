<?php

function symfony($arg) {
    $target = $arg[1];
    Output::writeln("executing symfony target {$target}");
    Hammer::execConsole("php app" . DS . "console {$target}");
}

function symfony_dbupdate($arg) {
    if($arg[1] === "dump") {
        $dest = $arg[2];
        $filename = $dest . date("omd-His") . ".sql";
        
        Output::writeln("writing sql to file {$filename}");
        Hammer::execConsole("php app" . DS . "console doctrine:schema:update --dump-sql > {$filename}");
    } else if($arg[1] === "force") {
        Output::writeln("updating database with the following script");
        echo Hammer::execConsole("php app" . DS . "console doctrine:schema:update --dump-sql");
        Hammer::execConsole("php app" . DS . "console doctrine:schema:update --force");
    }
}
