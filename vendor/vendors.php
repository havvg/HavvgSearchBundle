#!/usr/bin/env php
<?php

set_time_limit(0);

$vendorDir = __DIR__;
$deps = array(
    array('symfony', 'git://github.com/symfony/symfony.git', 'origin/2.1'),
    array('twig', 'git://github.com/fabpot/Twig.git', 'origin/master'),
    array('Havvg/Bundle/DRYBundle', 'git://github.com/havvg/HavvgDRYBundle.git', 'origin/master'),
    array('Havvg/Component/Search', 'git://github.com/havvg/Search.git', 'origin/master'),
);

foreach ($deps as $dep) {
    list($name, $url, $rev) = $dep;

    echo "> Installing/Updating $name\n";

    $installDir = $vendorDir.'/'.$name;
    if (!is_dir($installDir)) {
        system(sprintf('git clone -q %s %s', escapeshellarg($url), escapeshellarg($installDir)));
    }

    system(sprintf('cd %s && git fetch -q origin && git reset --hard %s', escapeshellarg($installDir), escapeshellarg($rev)));
}
