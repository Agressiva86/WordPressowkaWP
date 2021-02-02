<?php
add_filter( 'timber/twig', 'add_to_twig' );

function add_to_twig( $twig ) {
	/* this is where you can add your own functions to twig */
	$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
	$twig->addFilter( new Twig\TwigFilter( 'fb_share_url', 'fb_share_url' ) );
	$twig->addFilter( new Twig\TwigFilter( 'tt_share_url', 'tt_share_url' ) );
	$twig->addFilter( new Twig\TwigFilter( 'ln_share_url', 'ln_share_url' ) );
	return $twig;
}

// Display the links to the general feeds: Post and Comment Feed.
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );

/**
 * Share url to FB
 *
 * @param string $url
 * @return string
 * @todo other params
 */
function fb_share_url( $url ) {
	$url = str_replace( 'https://app.wordpressowka.pl/', 'https://wordpressowka.pl/', $url );
	$url = 'https://www.facebook.com/sharer.php?u=' . urlencode( $url );
	return $url;
}

/**
 * Share url to TT
 *
 * @param string $url
 * @param string $title
 * @return string
 * @todo other params
 */
function tt_share_url( $url, $title = '' ) {
	$url = str_replace( 'https://app.wordpressowka.pl/', 'https://wordpressowka.pl/', $url );
	$url = 'https://twitter.com/intent/tweet?url=' . urlencode( $url );

	if ( $title != '' ) {
		$url .= '&text=' . urlencode( $title );
	}
	return $url;
}

/**
 * Share url to Linkdin
 *
 * @param string $url
 * @return string
 * @todo other params
 */
function ln_share_url( $url ) {
	$url = str_replace( 'https://app.wordpressowka.pl/', 'https://wordpressowka.pl/', $url );
	$url = 'https://www.linkedin.com/shareArticle?url=' . urlencode( $url );
	return $url;
}

add_filter(
	'timber/acf-gutenberg-blocks-data/owl-entries',
	function( $context ) {
		$args               = array(
			'posts_per_page' => 3,
			'post_type'      => 'post',
		);
		$context['entries'] = Timber::get_posts( $args );

		return $context;
	}
);
