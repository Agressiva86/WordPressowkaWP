export default {
  init() {
	if (window.CSS && CSS.supports('color', 'var(--fake-var)')) {
		new ThemeSwitcher()
	}
	siteHeader();

	if ( document.getElementById( 'algolia-search-input' ) !== null ) {
		pullScript( 'https://cdn.jsdelivr.net/npm/algoliasearch@4/dist/algoliasearch-lite.umd.js' );
		pullScript( 'https://cdn.jsdelivr.net/npm/instantsearch.js@4', () => { search(); } )

	}

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};

class ThemeSwitcher {
	constructor() {
		// define some state variables
		this.hasLocalStorage = typeof Storage !== 'undefined'
		this.activeTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : 'light';

		document.documentElement.setAttribute('data-theme', this.activeTheme)

		var btn = document.getElementById( 'themeswitcher' );
		btn.addEventListener('click', (event) => this.setTheme());
	}

	setTheme() {
		event.preventDefault();
		this.activeTheme = ( this.activeTheme === 'light' ) ? 'dark' : 'light';
		// set the theme id on the <html> element...
		document.documentElement.setAttribute('data-theme', this.activeTheme)

		// and save the selection in localStorage for later
		if (this.hasLocalStorage) {
			localStorage.setItem("theme", this.activeTheme)
		}
	}
}

function siteHeader() {
	var header = document.getElementById( 'site-name' );
	var hasLocalStorage = typeof Storage !== 'undefined';
	var isClosed = localStorage.getItem('headerStatus') ? localStorage.getItem('headerStatus') : false;
	var closeButton = document.getElementById( 'site-name-close' );

	if( closeButton !== null ){
		closeButton.addEventListener('click', (event) => {
			event.preventDefault();
			header.classList.toggle( 'hide' );
			localStorage.setItem( 'headerStatus', true );
		});

		if ( ! isClosed ) {
			header.classList.toggle( 'hide' );
		}
	}
}

function search() {
	const search = instantsearch({
		indexName: 'wp_posts_post',
		searchClient: algoliasearch('MD4D3NLGXH', 'e53a9f9a558c037d688d9ae8440d1362'),
	});

	search.addWidgets([
		instantsearch.widgets.searchBox({
			container: '#algolia-search-input',
		}),

		instantsearch.widgets.hits({
			container: '#algolia-results',
			templates: {
			  item: `
				<div>
					<div class="hit-name">
						<a href="{{ permalink }}" target="_blank">
							{{#helpers.highlight}}{ "attribute": "post_title" }{{/helpers.highlight}}
						</a>
					</div>
					<div class="hit-description">
						{{#helpers.snippet}}{ "attribute": "content" }{{/helpers.snippet}}
					</div>
				</div>
			  `,
			},
		  }),

		instantsearch.widgets.pagination({
			container: '#algolia-pagination',
		}),
	]);
	search.start();

}

function pullScript(url, callback) {
    pull(url, function loadReturn(data, status, xhr) { // If call returned with a good status
        if (status == 200) {
            var script = document.createElement('script');
            // Instead of setting .src set .innerHTML
            script.innerHTML = data;
            document.querySelector('head').appendChild(script);
        }
        if (typeof callback != 'undefined') { // If callback was given skip an execution frame and run callback passing relevant arguments
            setTimeout(function runCallback() {
                callback(data, status, xhr)
            }, 0);
        }
    });
}

function pull(url, callback, method = 'GET', async = true) {
    //Make sure we have a good method to run
    method = method.toUpperCase();
    if(!(method === 'GET'   ||   method === 'POST'   ||  method === 'HEAD')){
        throw new Error('method must either be GET, POST, or HEAD');
    }
    //Setup our request
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
            //Once the request has completed fire the callback with relevant arguments
            //you should handle in your callback if it was successful or not
            callback(xhr.responseText, xhr.status, xhr);
        }
    };
    //Open and send request
    xhr.open(method, url, async);
    xhr.send();
}
