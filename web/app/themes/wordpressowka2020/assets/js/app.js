import Router from './lib/router';
import barba from '@barba/core';
import css from '@barba/css';
import 'lazysizes';

// Routes
import common from './routes/common';

barba.use( css );
barba.init({
	views: [{
		namespace: 'bhome',
		before() {
		},
		afterLeave() {
			routes.loadEvents();
			window.scrollTo(0, 0);
		}
	}]
});

/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
  common
});

/** Load Events */
document.addEventListener('DOMContentLoaded', () => routes.loadEvents(), false);
