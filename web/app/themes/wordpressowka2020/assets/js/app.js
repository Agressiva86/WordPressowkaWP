import Router from './lib/router';
import barba from '@barba/core';
import css from '@barba/css';
import 'lazysizes';

// Routes
import common from './routes/common';

/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
  common
});

/** Load Events */
document.addEventListener('DOMContentLoaded', () => routes.loadEvents(), false);

barba.use( css );
barba.init({
	views: [{
		namespace: 'home',
		before() {
			routes.loadEvents();
		},
	  }]
  });
