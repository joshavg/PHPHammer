<?php

function changeowner($arg) {
    $owner = $arg['owner'];
    $dirs = $arg['dirs'];

    foreach($dirs as $dir) {
        shell_exec("chown -R {$owner} {$dir}");
    }
}

function changemode($arg) {
    $mode = $arg['mode'];
    $dirs = $arg['dirs'];

    foreach($dirs as $dir) {
        shell_exec("chmod -R {$mode} {$dir}");
    }
}
