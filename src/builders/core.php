<?php

function console($line) {
    Output::writeln("executing {$line[1]}");
    shell_exec($line[1]);
}

function changeowner($arg) {
    $owner = $arg[1];
    $dirs = $arg[2];

    foreach($dirs as $dir) {
        shell_exec("chown -R {$owner} {$dir}");
    }
}

function changemod($arg) {
    $mode = $arg[1];
    $dirs = $arg[2];

    foreach($dirs as $dir) {
        shell_exec("chmod -R {$mode} {$dir}");
    }
}

function target($arg) {
    execTarget($arg[1]);
}

function output($arg) {
    Output::writeln("===== {$arg[1]}", Output::BLUE);
}
