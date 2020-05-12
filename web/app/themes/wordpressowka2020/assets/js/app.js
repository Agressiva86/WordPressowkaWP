import Router from './lib/router';

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
