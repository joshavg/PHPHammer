<?php

function console($line) {
    Output::writeln("executing {$line[1]}");
    Output::writeln(trim(shell_exec($line[1])));
}

function changeowner($arg) {
    if(Hammer::getOs() == Hammer::OS_WIN) {
        return;
    }
    
    $owner = $arg[1];
    $dirs = $arg[2];

    foreach($dirs as $dir) {
        Output::writeln(trim(shell_exec("chown -R {$owner} {$dir}")));
    }
}

function changemod($arg) {
    if(Hammer::getOs() == Hammer::OS_WIN) {
        return;
    }
    
    $mode = $arg[1];
    $dirs = $arg[2];

    foreach($dirs as $dir) {
        Output::writeln(trim(shell_exec("chmod -R {$mode} {$dir}")));
    }
}

function changegroup($arg) {
    if(Hammer::getOs() == Hammer::OS_WIN) {
        return;
    }
    
    $grp = $arg[1];
    $dirs = $arg[2];
    
    foreach($dirs as $dir) {
        Output::writeln(trim(shell_exec("chgrp -R {$grp} {$dir}")));
    }
}

function target($arg) {
    Hammer::execTarget($arg[1]);
}

function output($arg) {
    Output::writeln("===== {$arg[1]}", Output::BLUE);
}
