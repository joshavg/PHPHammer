<?php

$phar = new Phar('bin/phphammer.phar', 0, 'phphammer.phar');
$phar->buildFromDirectory('src');
$phar->setDefaultStub('build.php');

copy('bin/phphammer.phar', 'test/phphammer.phar');