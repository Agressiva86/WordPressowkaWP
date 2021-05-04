<?php
return array(
	'type'     => 'cpt',
	'name'     => 'Podcast',
	'supports' => array(
		'title',
		'editor',
		'thumbnail',
		'page-attributes',
		'author',
	),
	'labels'   => array(
		'has_one'     => __( 'Podcast', 'sasquatch' ),
		'has_many'     => __( 'Podcasts', 'sasquatch' ),
		'text_domain' => 'sasquatch',
	),
	'config'   => array(
		'show_in_rest' => true,
		'rewrite' => array(
			'slug' => __( 'podcast', 'sasquatch' ),
		),
	),
);
