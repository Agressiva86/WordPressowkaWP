import Router from './lib/router';
import barba from '@barba/core';

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

barba.init({
	transitions: [{
	  name: 'default-transition',
	  leave() {
		// create your stunning leave animation here
	  },
	  enter() {
		// create your amazing enter animation here
	  },
	}],
	views: [{
		namespace: 'home',
		before() {
			routes.loadEvents();
		},
	  }]
  });
