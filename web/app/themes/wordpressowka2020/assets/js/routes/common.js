export default {
  init() {
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

	// this whole thing only makes sense if custom properties are supported -
	// so let's check for that before initializing our switcher.
	if (window.CSS && CSS.supports('color', 'var(--fake-var)')) {
		new ThemeSwitcher()
	}




  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
