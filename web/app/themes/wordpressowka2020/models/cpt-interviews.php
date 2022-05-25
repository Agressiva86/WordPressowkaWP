<?php
return array(
	'type'     => 'cpt',
	'name'     => 'interviews',
	'supports' => array(
		'title',
		'editor',
		'thumbnail',
		'page-attributes',
		'author',
	),
	'labels'   => array(
		'has_one'     => __( 'Interview', 'sasquatch' ),
		'has_many'     => __( 'Interview', 'sasquatch' ),
		'text_domain' => 'sasquatch',
	),
	'config'   => array(
		'show_in_rest' => true,
		'rewrite' => array(
			'slug' => __( 'interviews', 'sasquatch' ),
		),
	),
);
