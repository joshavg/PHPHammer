<?php

function console($line) {
    Output::writeln("executing {$line['arg']}");
    shell_exec($line['arg']);
}

function changeowner($arg) {
    $owner = $arg['owner'];
    $dirs = $arg['dirs'];

    foreach($dirs as $dir) {
        shell_exec("chown -R {$owner} {$dir}");
    }
}

function changemod($arg) {
    $mode = $arg['mode'];
    $dirs = $arg['dirs'];

    foreach($dirs as $dir) {
        shell_exec("chmod -R {$mode} {$dir}");
    }
}

function target($arg) {
    execTarget($arg['target']);
}
