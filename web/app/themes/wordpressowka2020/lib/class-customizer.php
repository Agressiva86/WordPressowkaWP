<?php
/**
 * All things related to WP Customizer.
 *
 * @since 0.1
 */
namespace sowka\customizer;

class Customizer {
	/**
	 * Private instance - to keep the once init object here.
	 *
	 * @var object
	 */
	private static $instance = null;

	/**
	 * Prefix for Appearance variables.
	 *
	 * @var string
	 */
	private $prefix = '';

	private $fields;
	private $fields_parsed;

	/**
	 * Prevent this class to be run more than once.
	 *
	 * @return Customizer object
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new Customizer();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->get_fields();

		add_action('customize_register', array( $this, 'register_fields' ));
	}

	public function get_fields() {
		$this->fields = array(
			'light_mode'           => array(
				'section' => array(
					'title'       => 'Light mode',
					'priority'    => 35,
					'capability'  => 'edit_theme_options',
					'description' => 'You can modify Light Mode colors here:',
				),
				'fields'  => array(
					'light_kolor_primary'                  => array(
						'type' => 'color_picker',
						'args' => array( 'Primary', '#ffc700' ),
					),
					'light_kolor_secondary'                  => array(
						'type' => 'color_picker',
						'args' => array( 'Secondary', '#061058' ),
					),
					'light_kolor_tla_formularzy'                  => array(
						'type' => 'color_picker',
						'args' => array( 'Forms background', '#ffffff' ),
					),
					'light_kolor_placeholder_formularzy'                => array(
						'type' => 'color_picker',
						'args' => array( 'Forms placeholder', '#B4B7CC' ),
					),
					'light_kolor_ikony_switcher'                  => array(
						'type' => 'color_picker',
						'args' => array( 'Icon switcher', '#061058' ),
					),
					'light_kolor_tla_ikony_switcher'                => array(
						'type' => 'color_picker',
						'args' => array( 'Icon switcher background', '#ffffff' ),
					),
					'light_kolor_tla_strony'           => array(
						'type' => 'color_picker',
						'args' => array( 'Alternative background', '#ffffff' ),
					),
					'light_kolor_tla_strony_gradient'                   => array(
						'type' => 'color_picker',
						'args' => array( 'Background gradient', '#F7F7FB' ),
					),
					'light_kolor_tekstu'                        => array(
						'type' => 'color_picker',
						'args' => array( 'Text', '#061058' ),
					),
					'light_kolor_linkow'     => array(
						'type' => 'color_picker',
						'args' => array( 'Links', '#ffc700' ),
					),
					'light_kolor_cienia'     => array(
						'type' => 'color_picker',
						'args' => array( 'Shadows', '#061058' ),
					),
				),
			),
			'dark_mode'           => array(
				'section' => array(
					'title'       => 'Dark mode',
					'priority'    => 35,
					'capability'  => 'edit_theme_options',
					'description' => 'You can modify Dark Mode colors here:',
				),
				'fields'  => array(
					'dark_kolor_primary'                  => array(
						'type' => 'color_picker',
						'args' => array( 'Primary', '#ffc700' ),
					),
					'dark_kolor_secondary'                  => array(
						'type' => 'color_picker',
						'args' => array( 'Secondary', '#ffffff' ),
					),
					'dark_kolor_tla_formularzy'                  => array(
						'type' => 'color_picker',
						'args' => array( 'Forms background', '#1a1f34' ),
					),
					'dark_kolor_placeholder_formularzy'                => array(
						'type' => 'color_picker',
						'args' => array( 'Forms placeholder', '#ffffff' ),
					),
					'dark_kolor_ikony_switcher'                  => array(
						'type' => 'color_picker',
						'args' => array( 'Icon switcher', '#ffffff' ),
					),
					'dark_kolor_tla_ikony_switcher'                => array(
						'type' => 'color_picker',
						'args' => array( 'Icon switcher background', '#1a1f34' ),
					),
					'dark_kolor_tla_strony'           => array(
						'type' => 'color_picker',
						'args' => array( 'Alternative background', '#101325' ),
					),
					'dark_kolor_tla_strony_gradient'                   => array(
						'type' => 'color_picker',
						'args' => array( 'Background gradient', '#101325' ),
					),
					'dark_kolor_tekstu'                        => array(
						'type' => 'color_picker',
						'args' => array( 'Text', '#f9e8f2' ),
					),
					'dark_kolor_linkow'     => array(
						'type' => 'color_picker',
						'args' => array( 'Links', '#ffffff' ),
					),
					'dark_kolor_cienia'     => array(
						'type' => 'color_picker',
						'args' => array( 'Shadows', '#061058' ),
					),
				),
			),
		);

		return $this->fields;
	}

	public function get_fields_parsed() {
		foreach ( $this->fields as $values ) {
			foreach ( $values['fields'] as $field_name => $value ) {
				$this->fields_parsed[ $field_name ] = $value['args'][1];
			}
		}

		return $this->fields_parsed;
	}

	public function register_fields( $wp_customize ) {
		if ( ! empty($this->fields) ) {
			foreach ( $this->fields as $section => $fieldsets ) {
				$this->create_section($section, $fieldsets['section'], $wp_customize);

				if ( ! empty($fieldsets['fields']) ) {
					$this->create_field($fieldsets['fields'], $section, $wp_customize);
				}
			}
		}
	}

	private function create_section( $name, $args, $wp_customize ) {
		$wp_customize->add_section(
			$name,
			$args
		);
	}

	private function create_field( $fieldset, $section, $wp_customize ) {
		foreach ( $fieldset as $key => $values ) {
			if ( 'color_picker' === $values['type'] ) {
				$this->register_color_picker($key, $values['args'][0], $values['args'][1], $section, $wp_customize);
			} elseif ( 'input' === $values['type'] ) {
				$this->register_input($key, $values['args'][0], $values['args'][1], $section, $wp_customize);
			} elseif ( 'textarea' === $values['type'] ) {
				$this->register_textarea($key, $values['args'][0], $values['args'][1], $section, $wp_customize);
			}
		}
	}

	private function register_color_picker( $name, $label, $default, $section, $wp_customize ) {
		$wp_customize->add_setting(
			$this->prefix . $name,
			array(
				'default'    => $default,
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				$this->prefix . $name,
				array(
					'label'    => $label,
					'settings' => $this->prefix . $name,
					'priority' => 10,
					'section'  => $section,
				)
			)
		);
	}

	private function register_input( $name, $label, $default, $section, $wp_customize ) {
		$wp_customize->add_setting(
			$this->prefix . $name,
			array(
				'default'    => $default,
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
			)
		);

		$wp_customize->add_control(
			$this->prefix . $name,
			array(
				'label'    => $label,
				'settings' => $this->prefix . $name,
				'priority' => 10,
				'section'  => $section,
				'type'     => 'input',
			)
		);
	}

	private function register_textarea( $name, $label, $default, $section, $wp_customize ) {
		$wp_customize->add_setting(
			$this->prefix . $name,
			array(
				'default'    => $default,
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
			)
		);

		$wp_customize->add_control(
			$this->prefix . $name,
			array(
				'label'    => $label,
				'settings' => $this->prefix . $name,
				'priority' => 10,
				'section'  => $section,
				'type'     => 'textarea',
			)
		);
	}
}
