<?php

function aura_register_blocks()
{
	wp_register_block_types_from_metadata_collection(
		__DIR__ . '/build',
		__DIR__ . '/build/blocks-manifest.php'
	);
}
add_action('init', 'aura_register_blocks');
