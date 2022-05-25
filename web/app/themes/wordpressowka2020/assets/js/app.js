import Router from './lib/router';
//import barba from '@barba/core';
//import css from '@barba/css';

// Routes
import common from './routes/common';

// barba.use(css);
// barba.init({
// 	debug: false,
// 	logLevel: 4,
//     views: [
//         {
//             namespace: 'bhome',
//             afterLeave() {
// 				window.scrollTo(0, 0);
// 			},
// 			afterEnter() {
// 				routes.loadEvents();
// 			}
//         }
//     ]
// });

/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({common});

/** Load Events */
document.addEventListener('DOMContentLoaded', () => routes.loadEvents(), false);
