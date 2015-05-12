<?php

chdir(dirname(__FILE__));
$phar = new Phar('bin/phphammer.phar', 0, 'phphammer.phar');
$phar->buildFromDirectory('src');
$phar->setDefaultStub('build.php');
