<?php
class OwlPost extends Timber\Post {

	public function next_post() {
		$ret = false;

		$next_post = get_adjacent_post(false, '', true);
		if ( ! empty($next_post) ) {
			$ret = get_permalink($next_post->ID);
		}

		return $ret;
	}

	public function prev_post() {
		$ret = false;

		$prev_post = get_adjacent_post(false, '', false);
		if ( ! empty($prev_post) ) {
			$ret = get_permalink($prev_post->ID);
		}

		return $ret;
	}

	public function guest_editor() {
		$blocks = parse_blocks( $this->post_content );

		$guest = array();

		if ( $blocks ) {
			foreach( $blocks as $block ) {
				if ( $block['blockName'] === 'acf/guest-wrapper' ) {

					if ( ! empty ( get_field( 'guest_photo', $this->ID ) ) ) {
						$guest['photo'] = get_field( 'guest_photo', $this->ID );
					} elseif ( ! empty( $block['attrs']['data']['photo'] ) ) {
						$guest['photo'] = $block['attrs']['data']['photo'];
					}

					if ( ! empty ( get_field( 'guest_name', $this->ID ) ) ) {
						$guest['name'] = get_field( 'guest_name', $this->ID );
					} elseif ( !empty( $block['attrs']['data']['name'] ) ) {
						$guest['name'] = $block['attrs']['data']['name'];
					}

					if ( ! empty ( get_field( 'guest_description', $this->ID ) ) ) {
						$guest['description'] = get_field( 'guest_description', $this->ID );
					} elseif ( !empty( $block['attrs']['data']['description'] ) ) {
						$guest['description'] = $block['attrs']['data']['description'];
					}

					break;
				}
			}
		}

		return $guest;
	}
}
