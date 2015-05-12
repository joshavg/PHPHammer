<?php

function symfony($arg) {
    $target = $arg[1];
    Output::writeln("executing symfony target {$target}");
    Hammer::execConsole("php app/console {$target}");
}