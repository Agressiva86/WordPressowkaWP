<?php
/**
 * Class for parsing all the options to get only the one responsible for Appearance.
 *
 * @since 0.1
 * @package robbo_framework
 */

namespace sowka\css_vars;

/**
 * Parses and show options responsible for Appearance.
 */
class Css_Vars {
	/**
	 * Prefix for Appearance variables.
	 *
	 * @var string
	 */
	private $prefix = '';

	/**
	 * Var for stroing all options
	 *
	 * @var array
	 */
	private $options;

	/**
	 * Var for storing only Apperance options.
	 *
	 * @var array
	 */
	private $appearance_options;

	/**
	 * Private instance - to keep the once init object here.
	 *
	 * @var object
	 */
	private static $instance = null;

	/**
	 * Inits all nessesary functions.
	 */
	private function __construct() {
		$this->set_options();
		$this->set_appearance_options();

		if ( is_array( $this->appearance_options ) ) {
			add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
			add_action( 'wp_head', array( $this, 'generate_style' ), 2 );
		}
	}

	/**
	 * Prevent this class to be run more than once.
	 *
	 * @return CSS_Vars object
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new Css_Vars();
		}

		return self::$instance;
	}

	/**
	 * Gets all options from Customizer Class
	 *
	 * @return void
	 */
	private function set_options() {
		$this->options = \sowka\customizer\Customizer::get_instance()->get_fields_parsed();
	}

	/**
	 * Creates array that will be later pass to get_theme_mod function.
	 *
	 * @return void
	 */
	private function set_appearance_options() {
		if ( is_array( $this->options ) ) {
			foreach ( $this->options as $key => $value ) {
				$key_name                         = $this->prefix . $key;
				$this->appearance_options[ $key ] = array(
					'key_name' => $key_name,
					'default'  => $value,
				);
			}
		}
	}

	/**
	 * Generates a raw <style> with varaibles.
	 *
	 * @return void
	 */
	public function generate_style() {
		if ( class_exists( 'Timber' ) ) {
			$context['appearance_options'] =  array_filter(
				$this->appearance_options,
				function( $v, $k ) {
					return $k !== 'font_families';
				},
				ARRAY_FILTER_USE_BOTH
			);


			\Timber::render( 'views/parts/css-vars.twig', $context );
		}
	}

	/**
	 * Generates a raw <style> with fonts.
	 *
	 * @return void
	 */
	public function include_fonts() {
		if ( class_exists( 'Timber' ) ) {
			$context['appearance_options'] = array_filter(
				$this->appearance_options,
				function( $v, $k ) {
					return $k === 'font_families';
				},
				ARRAY_FILTER_USE_BOTH
			);

			\Timber::render( 'views/parts/google-fonts.twig', $context );
		}
	}

	/**
	 * Adds filters to Twig
	 *
	 * @param object $twig Twig object
	 * @return object $twig extended twig object
	 */
	public function add_to_twig( $twig ) {
		$twig->addFilter( new \Timber\Twig_Filter( 'prepare_css_var', array( $this, 'prepare_css_var_filter' ) ) );
		return $twig;
	}

	/**
	 * Wraps values containing spaces in quotes.
	 *
	 * @param string $val any CSS value
	 * @return string
	 */
	public function prepare_css_var_filter( $val ) {
		if ( strpos( trim( $val ), ' ' ) !== false ) {
			$val = sprintf( '"%s"', $val );
		}

		return $val;
	}
}

