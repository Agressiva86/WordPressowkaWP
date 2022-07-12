<?php
require_once __DIR__ . '/vendor/autoload.php';
$timber = new \Timber\Timber();
if ( class_exists( 'Timber' ) ) {
	add_filter(
		'timber/twig/environment/options',
		function( $options ) {
			$options['cache'] = true;
			return $options;
		}
	);

	add_filter(
		'timber/post/classmap',
		function( $classmap ) {
			$custom_classmap = array(
				'post' => OwlPost::class,
			);

			return array_merge( $classmap, $custom_classmap );
		}
	);
}

$sage_includes = array(
	'lib/timber.php',
	'lib/setup.php',
	'lib/gutenberg.php',
	'lib/Class-owl-post.php',
	'lib/filters.php',
	'lib/class-css-vars.php',
	'lib/class-customizer.php',
	'lib/events.php',
);

foreach ( $sage_includes as $file ) {
	$filepath = locate_template( $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( __( 'Error locating %s for inclusion', 'sasquatch' ), $file ), E_USER_ERROR );
	}

	require_once $filepath;
}

add_action(
	'wp_head',
	function() {
		?>
		<script>
			var algolia_ID = '<?php echo get_option( 'algolia_application_id' ); ?>';
			var algolia_API = '<?php echo get_option( 'algolia_search_api_key' ); ?>';
		</script>
		<?php
	}
);

add_action( 'init', array( 'sowka\css_vars\Css_Vars', 'get_instance' ) );
add_action( 'init', array( 'sowka\customizer\Customizer', 'get_instance' ), 99 );

add_filter( 'gettext', 'theme_change_comment_field_names', 20, 3 );
/**
 * Change comment form default field names.
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function theme_change_comment_field_names( $translated_text, $text, $domain ) {

	if ( get_locale() === 'pl_PL' ) {

		switch ( $translated_text ) {
			case 'Article':
				$translated_text = 'Artykuł';
				break;
			case 'Articles':
				$translated_text = 'Artykuły';
				break;
			case 'articles':
				$translated_text = 'artykuly';
				break;
			case 'read more':
				$translated_text = 'czytaj dalej';
				break;
			case 'Previous':
				$translated_text = 'poprzednia';
				break;
			case 'Next':
				$translated_text = 'następna';
				break;
		}
	}

	return $translated_text;
}

function add_ad_blocks( $content ) {
	global $post;

	if ( $post->post_type === 'post' && is_singular() ) {

		libxml_use_internal_errors(true);
		$tpl = new DOMDocument;
		$tpl->loadHtml( '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />' . $content );

		$xpath = new DomXPath( $tpl );
		$blocks_as_guest = count( $xpath->query("//*[@class='wordpressowka-guest']//*[contains(@class, 'wordpressowka-block')]") );
		if ( $blocks_as_guest > 0 ) {
			$blocks_as_guest++;
		}

		$all_blocks = $xpath->query("//*[contains(@class, 'wordpressowka-block')]");

		$when_insert = 3 + $blocks_as_guest;

		$ad = $all_blocks->item( $when_insert  );

		if ( $ad === null ) {
			return;
		}

		$frag = $tpl->createDocumentFragment();
		$frag->appendXML( insert_ad() );

		$ad->parentNode->insertBefore( $frag, $ad );

		$content = $tpl->saveHTML();
	}

	if ( $post->post_type === 'articles' && is_singular() ) {
		libxml_use_internal_errors(true);
		$tpl = new DOMDocument;
		$tpl->loadHtml( '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />' . $content );

		$xpath = new DomXPath( $tpl );

		$all_headings = $xpath->query("//h2");

		$has_owl_link = $xpath->query("//*[contains(@class, 'wordpressowka-block')]");

		$modifier = 1;
		if ( count( $has_owl_link ) > 0 ) {
			$modifier = 2;
		}

		$frag = $tpl->createDocumentFragment();
		$frag->appendXML( insert_ad() );

		$heading1 = $all_headings->item( 0 );
		$heading2 = $all_headings->item( count( $all_headings ) - $modifier );

		if ( $heading1 === null || $heading2 === null ) {
			return;
		}

		$heading1->parentNode->insertBefore( $frag, $heading1 );

		$frag = $tpl->createDocumentFragment();
		$frag->appendXML( insert_ad() );

		$heading2->parentNode->insertBefore( $frag, $heading2 );

		$content = $tpl->saveHTML();
	}

    return $content;
}

add_filter( 'the_content', 'add_ad_blocks', 99 );

function insert_ad() {
	$context = Timber::get_context();
	if ( get_field( 'enable_ads', 'options' ) ) {
		if ( get_field( 'ad_logo', 'options' ) ) {
			return Timber::compile( 'views/parts/owl-ads-logo.twig', $context );
		} else {
			return Timber::compile( 'views/parts/owl-ads-row.twig', $context );
		}
	}
}
