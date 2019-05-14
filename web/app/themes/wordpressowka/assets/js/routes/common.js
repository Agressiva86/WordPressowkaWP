import fontawesome from '@fortawesome/fontawesome';
import faFacebookF from '@fortawesome/fontawesome-free-brands/faFacebookF';
import faTwitter from '@fortawesome/fontawesome-free-brands/faTwitter';
import faInstagram from '@fortawesome/fontawesome-free-brands/faInstagram';
fontawesome.library.add(faFacebookF, faTwitter, faInstagram);

export default {
  init() {
    // JavaScript to be fired on all pages
    $( '.hamburger-wrapper .hamburger' ).click(function(){
      $(this).toggleClass('is-active');
      $( '.navigation' ).toggleClass('open' );
      $( 'html, body' ).toggleClass( "nooverflow" );
    });

    $( "#gotonewsletter" ).click(function() {
        $( "html, body" ).animate({
            scrollTop: $( "#newsletter" ).offset().top
        }, 1000)
    });

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
