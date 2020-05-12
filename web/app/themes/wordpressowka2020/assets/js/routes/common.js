export default {
  init() {

	if (window.CSS && CSS.supports('color', 'var(--fake-var)')) {
		new ThemeSwitcher()
	}

	siteHeader();

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
		btn.addEventListener('click', () => this.setTheme());
	}

	setTheme() {
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

	closeButton.addEventListener('click', () => {
		header.classList.toggle( 'hide' );
		localStorage.setItem( 'headerStatus', true );
	});

	if ( ! isClosed ) {
		header.classList.toggle( 'hide' );
	}
}
