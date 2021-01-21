export default {
    init() {
        if (window.CSS && CSS.supports('color', 'var(--fake-var)')) {
            new ThemeSwitcher()
        }

        if (document.getElementById('algolia-search-input') !== null) {
            pullScript('https://cdn.jsdelivr.net/npm/algoliasearch@4/dist/algoliasearch-lite.umd.js', () => {}, 'algoliasearch');
            pullScript('https://cdn.jsdelivr.net/npm/instantsearch.js@4', () => {
                search();
            }, 'instantsearch');
		}

		if (document.getElementsByClassName('wordpressowka-code').length > 0 ) {
			pullScript('/app/themes/wordpressowka2021/static/prism.js', () => {}, 'prismjs');
			pullStyle('/app/themes/wordpressowka2021/static/prism2.css', () => {}, 'prismcss');
        }

        search_animation();

    },
    finalize() { // JavaScript to be fired on all pages, after page specific JS is fired
    }
};

class ThemeSwitcher {
    constructor() { // define some state variables
        this.hasLocalStorage = typeof Storage !== 'undefined'
        this.activeTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : 'light';

        document.documentElement.setAttribute('data-theme', this.activeTheme)

        var btn = document.getElementById('themeswitcher');
        btn.addEventListener('click', (event) => this.setTheme());
    }

    setTheme() {
        event.preventDefault();
        this.activeTheme = (this.activeTheme === 'light') ? 'dark' : 'light';
        // set the theme id on the <html> element...
        document.documentElement.setAttribute('data-theme', this.activeTheme)

        // and save the selection in localStorage for later
        if (this.hasLocalStorage) {
            localStorage.setItem("theme", this.activeTheme)
        }
    }
}

function search() {
    const search = instantsearch({
        indexName: 'wp_posts_post',
        searchClient: algoliasearch(window.algolia_ID, window.algolia_API)
    });

    search.addWidgets([
        instantsearch.widgets.searchBox(
            {
                container: '#algolia-search-input',
                templates: {
                    submit: `<svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M13.8086 12.8633L11.0742 10.1289C10.9375 10.0195 10.7734 9.9375 10.6094 9.9375H10.1719C10.9102 8.98047 11.375 7.77734 11.375 6.4375C11.375 3.32031 8.80469 0.75 5.6875 0.75C2.54297 0.75 0 3.32031 0 6.4375C0 9.58203 2.54297 12.125 5.6875 12.125C7 12.125 8.20312 11.6875 9.1875 10.9219V11.3867C9.1875 11.5508 9.24219 11.7148 9.37891 11.8516L12.0859 14.5586C12.3594 14.832 12.7695 14.832 13.0156 14.5586L13.7812 13.793C14.0547 13.5469 14.0547 13.1367 13.8086 12.8633ZM5.6875 9.9375C3.74609 9.9375 2.1875 8.37891 2.1875 6.4375C2.1875 4.52344 3.74609 2.9375 5.6875 2.9375C7.60156 2.9375 9.1875 4.52344 9.1875 6.4375C9.1875 8.37891 7.60156 9.9375 5.6875 9.9375Z" fill="#1F233D"/>
				</svg>`
                }
            }
        ),


        instantsearch.widgets.hits(
            {
                container: '#algolia-results',
                templates: {
                    item: `
				<div>
					<div class="hit-name">
						<a href="{{ permalink }}">
							{{#helpers.highlight}}{ "attribute": "post_title" }{{/helpers.highlight}}
						</a>
					</div>
					<div class="hit-description">
						{{#helpers.snippet}}{ "attribute": "content" }{{/helpers.snippet}}
					</div>
				</div>
			  `
                }
            }
        ),

        instantsearch.widgets.pagination(
            {container: '#algolia-pagination'}
        ),
    ]);
    search.start();

}

function pullScript(url, callback, id) {
    pull(url, function loadReturn(data, status, xhr) { // If call returned with a good status
        if (status == 200 && document.getElementById(id) === null) {
            var script = document.createElement('script');
            // Instead of setting .src set .innerHTML
            script.innerHTML = data;
            script.id = id;
            document.querySelector('head').appendChild(script);
        }
        if (typeof callback != 'undefined') { // If callback was given skip an execution frame and run callback passing relevant arguments
            setTimeout(function runCallback() {
                callback(data, status, xhr)
            }, 0);
        }
    });
}

function pullStyle(url, callback, id) {
    pull(url, function loadReturn(data, status, xhr) { // If call returned with a good status
        if (status == 200 && document.getElementById(id) === null) {
            var script = document.createElement('style');
            // Instead of setting .src set .innerHTML
            script.innerHTML = data;
			script.id = id;
            document.querySelector('head').appendChild(script);
        }
        if (typeof callback != 'undefined') { // If callback was given skip an execution frame and run callback passing relevant arguments
            setTimeout(function runCallback() {
                callback(data, status, xhr)
            }, 0);
        }
    });
}

function pull(url, callback, method = 'GET', async = true) { // Make sure we have a good method to run
    method = method.toUpperCase();
    if (!(method === 'GET' || method === 'POST' || method === 'HEAD')) {
        throw new Error('method must either be GET, POST, or HEAD');
    }
    // Setup our request
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            // XMLHttpRequest.DONE == 4
            // Once the request has completed fire the callback with relevant arguments
            // you should handle in your callback if it was successful or not
            callback(xhr.responseText, xhr.status, xhr);
        }
    };
    // Open and send request
    xhr.open(method, url, async);
    xhr.send();
}

function search_animation() {
    if ("IntersectionObserver" in window && "IntersectionObserverEntry" in window && "intersectionRatio" in window.IntersectionObserverEntry.prototype) {
        var search = document.getElementById('search-icon');
        let observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                search.classList.remove("hide-span");
            } else {
                search.classList.add("hide-span");
            }
        });

        observer.observe(document.querySelector("#header"));
    }
}
