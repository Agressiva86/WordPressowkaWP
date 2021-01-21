<?php
return array(
	'type'     => 'cpt',
	'name'     => 'articles',
	'supports' => array(
		'title',
		'editor',
		'thumbnail',
		'page-attributes',
		'author',
	),
	'labels'   => array(
		'has_one'     => __( 'Article', 'sasquatch' ),
		'has_many'     => __( 'Articles', 'sasquatch' ),
		'text_domain' => 'sasquatch',
	),
	'config'   => array(
		'show_in_rest' => true,
		'rewrite' => array(
			'slug' => __( 'articles', 'sasquatch' ),
		),
	),
);
