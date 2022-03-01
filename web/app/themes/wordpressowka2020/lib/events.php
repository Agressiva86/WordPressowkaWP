<?php
add_filter('acf/update_value/type=date_picker', 'update_value_date_time_picker', 10, 3);

function update_value_date_time_picker($value, $post_id, $field)
{
    return strtotime($value);
}

/**
 *  ACF Admin Columns
 *
 */

function add_acf_columns($columns)
{
    return array_merge($columns, array (
      'event_date' => __('Event date'),
      'event_end_date' => __('Event end date'),
    ));
}
  add_filter('manage_events_posts_columns', 'add_acf_columns');

 /*
 * Add columns to Hosting CPT
 */
function events_custom_column($column, $post_id)
{
    switch ($column) {
        case 'event_date':
            echo date('d.M.Y', strtotime(get_field('date', $post_id)));
            break;
        case 'event_end_date':
			if ( strtotime(get_field('end_date', $post_id) > 0 ) ) {
            	echo date('d.M.Y', strtotime(get_field('end_date', $post_id)));
			} else {
				echo date('d.M.Y', strtotime(get_field('date', $post_id)));
			}
            break;
    }
}
add_action('manage_events_posts_custom_column', 'events_custom_column', 10, 2);


function set_admin_post_class($classes, $class, $post_id)
{

    // affect post classes only in dashboard context
    if (! is_admin()) {
         return $classes;
    }

    // Figure out where in dashboard we actually are
    // This will return early if we are not currently editing "pages"
    $screen = get_current_screen();
    if (empty($screen->post_type) || 'events' !== $screen->post_type) {
        return $classes;
    }

    $date = strtotime(get_field('date', $post_id));
    $end_date = strtotime(get_field('end_date', $post_id));

    if ($date >= time() || $end_date >= time()) {
        $classes[] = 'upcoming-event';
    } else {
        $classes[] = 'past-event';
    }

    return $classes;
}

add_filter('post_class', 'set_admin_post_class', 10, 3);

add_action('admin_head', 'events_styles');

function events_styles()
{
    echo '<style>
    .past-event {
		filter: grayscale(1);
	}
  </style>';
}

function upcoming_events() {
	global $wpdb;
	$sql = $wpdb->get_col( '
		SELECT post_id FROM ws_acf_events WHERE
		( date > CURDATE() AND YEAR(`end_date`) = 0 ) OR
		( end_date > CURDATE() )
		ORDER BY date ASC
	' );

	if ( count( $sql ) > 0 ) {
		$args                   = array(
			'posts_per_page' => -1,
			'post__in'   => $sql,
			'post_type'      => 'events',
			'orderby' => 'post__in',
		);
		$context['events'] = Timber::get_posts( $args, 'OwlPost' );
		Timber::render( 'views/templates/events.twig', $context );
	}
}
