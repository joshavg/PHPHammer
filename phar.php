<?php

chdir(dirname(__FILE__));

@mkdir('bin');
@unlink('bin/phphammer.phar');

$phar = new Phar('bin/phphammer.phar', 0, 'phphammer.phar');
$phar->startBuffering();

$defaultStub = $phar->createDefaultStub('build.php');
$phar->buildFromDirectory('src');

$stub = "#!/usr/bin/env php\n" . $defaultStub;
$phar->setStub($stub);
$phar->stopBuffering();
