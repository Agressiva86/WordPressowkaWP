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
}
