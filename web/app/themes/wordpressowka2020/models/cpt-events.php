<?php
return array(
	'type'     => 'cpt',
	'name'     => 'events',
	'supports' => array(
		'title',
		'editor',
		'thumbnail',
		'page-attributes',
		'author',
	),
	'labels'   => array(
		'has_one'     => __( 'Event', 'sasquatch' ),
		'has_many'     => __( 'Events', 'sasquatch' ),
		'text_domain' => 'sasquatch',
	),
	'config'   => array(
		'show_in_rest' => true,
		'rewrite' => array(
			'slug' => __( 'events', 'sasquatch' ),
		),
        'publicly_queryable' => false,
        'has_archive' => false,
        'exclude_from_search' => true,
	),
);
