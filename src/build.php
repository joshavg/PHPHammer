<?php

require 'output.php';
require 'globals.php';

foreach(scandir(__DIR__ . '/builders/') as $path) {
    if($path === '.' || $path === '..') continue;
    require __DIR__ . '/builders/' . $path;
}

$jsonPath = getcwd() . DIRECTORY_SEPARATOR . 'build.json';

if(!file_exists($jsonPath)) {
    Output::write('Build file ', Output::RED);
    Output::write($jsonPath, Output::CYAN);
    Output::writeln(' not found', Output::RED);
    return;
}

Output::writeln("===== PHPHAMMER", Output::CYAN);
Output::writeln("===== Buildfile: {$jsonPath}", Output::CYAN);

$jsonContent = file_get_contents($jsonPath);
$json = json_decode($jsonContent, true);

if($json === null) {
    Output::writeln('Build file invalid', Output::RED);
    return;
}

if(isset($json['globals'])) {
    array_walk_recursive($json, function(&$item, $key) use ($json) {
        if($item{0} === '$') {
            $globname = substr($item, 1);
            if(isset($json['globals'][$globname])) {
                $item = $json['globals'][$globname];
            }
        }
    });
}

Output::writeln("=====   Project: {$json['name']}", Output::CYAN);
Output::writeln("=====   Version: {$json['version']}", Output::CYAN);

if(count($argv) < 2) {
    Output::writeln('No target defined', Output::RED);
    return;
}
$targetParam = $argv[1];
Output::writeln("=====    Target: {$targetParam}", Output::CYAN);
Output::newln();

if(!isset($json['targets'][$targetParam])) {
    Output::write('Target ', Output::RED);
    Output::write($targetParam, Output::CYAN);
    Output::writeln(' not defined', Output::RED);
    return;
}

Globals::set('buildfile', $json);

function execTarget($name) {
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
execTarget($targetParam);
