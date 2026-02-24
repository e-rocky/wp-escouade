<?php

require_once __DIR__ . '/hero-block/hero-block.php';
$blocks = glob(__DIR__ . '/*/');
foreach ($blocks as $block_init) {
	$path = $block_init;
	$filename = basename($block_init);
	require_once $path . $filename . '.php';
}
