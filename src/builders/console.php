<?php

function console($line) {
    Output::writeln("executing {$line->arg}");
    shell_exec($line->arg);
}
