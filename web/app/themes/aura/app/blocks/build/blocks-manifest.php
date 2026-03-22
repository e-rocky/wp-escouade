<?php
// This file is generated. Do not modify it manually.
return array(
	'hero-block' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/hero-block',
		'version' => '0.1.0',
		'title' => 'Hero Block',
		'category' => 'widgets',
		'icon' => 'smiley',
		'description' => 'Example block scaffolded with Create Block tool.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'attributes' => array(
			'smallText' => array(
				'type' => 'string',
				'default' => 'Une <strong>Escouade</strong>, c\'est <em>plus qu\'une équipe</em> :'
			),
			'headingText' => array(
				'type' => 'string',
				'default' => 'c\'est une aventure humaine'
			),
			'buttonText' => array(
				'type' => 'string',
				'default' => 'Rejoindre l\'aventure'
			),
			'button' => array(
				'type' => 'object',
				'default' => array(
					'text' => 'Rejoindre l\'aventure',
					'url' => '#',
					'openInNewTab' => false
				)
			)
		),
		'textdomain' => 'hero-block',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'viewScript' => 'file:./view.js'
	)
);
