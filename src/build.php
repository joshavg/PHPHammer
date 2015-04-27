<?php

require 'output.php';

foreach(scandir(__DIR__ . '/builders/') as $path) {
    if($path === '.' || $path === '..') continue;
    require __DIR__ . '/builders/' . $path;
}

$jsonPath = getcwd() . DIRECTORY_SEPARATOR . 'build.json';

if(!file_exists($jsonPath)) {
    Output::write('Build file ');
    Output::write($jsonPath, Output::CYAN);
    Output::writeln(' not found');
    return;
}

$jsonContent = file_get_contents($jsonPath);
$json = json_decode($jsonContent);

Output::writeln("===== PHPHAMMER", Output::CYAN);
Output::writeln("===== Buildfile: {$jsonPath}", Output::CYAN);
Output::writeln("=====   Project: {$json->name}", Output::CYAN);
Output::writeln("=====   Version: {$json->version}", Output::CYAN);

if(count($argv) < 2) {
    Output::writeln('No target defined');
    return;
}
$targetParam = $argv[1];
Output::writeln("=====    Target: {$targetParam}", Output::CYAN);
Output::newln();

if(!isset($json->targets->{$targetParam})) {
    Output::write('Target ');
    Output::write($targetParam, Output::CYAN);
    Output::writeln(' not defined');
    return;
}
$target = $json->targets->{$targetParam};

foreach($target as $builder => $line) {
    Output::write('Executing builder ');
    Output::write($builder, Output::CYAN);
    Output::write(' with value ');
    Output::writeln($line, Output::CYAN);
    $builder($line);
}
