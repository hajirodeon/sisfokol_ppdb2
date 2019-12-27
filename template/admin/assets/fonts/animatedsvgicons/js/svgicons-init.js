(function() {
   // initialize all
   
   [].slice.call( document.querySelectorAll( '.si-icons-default > .si-icon' ) ).forEach( function( el ) {
      var svgicon = new svgIcon( el, svgIconConfig );
   } );

   // new svgIcon( document.querySelector( '.si-icons-easing .si-icon-nav-left-arrow' ), svgIconConfig, { easing : mina.backin } );
   // new svgIcon( document.querySelector( '.si-icons-easing .si-icon-hamburger' ), svgIconConfig, { easing : mina.backin } );
   // new svgIcon( document.querySelector( '.si-icons-easing .si-icon-plus' ), svgIconConfig, { easing : mina.backin } );
   // new svgIcon( document.querySelector( '.si-icons-easing .si-icon-volume' ), svgIconConfig, { easing : mina.backin } );
   // new svgIcon( document.querySelector( '.si-icons-easing .si-icon-hourglass' ), svgIconConfig, { easing : mina.backin } );
   // new svgIcon( document.querySelector( '.si-icons-easing .si-icon-equalizer' ), svgIconConfig, { easing : mina.backin } );
   // new svgIcon( document.querySelector( '.si-icons-easing .si-icon-hamburger-cross' ), svgIconConfig, { easing : mina.elastic, speed: 600 } );
   // new svgIcon( document.querySelector( '.si-icons-easing .si-icon-trash' ), svgIconConfig, { easing : mina.elastic, speed: 600 } );
   // new svgIcon( document.querySelector( '.si-icons-easing .si-icon-clock' ), svgIconConfig, { easing : mina.elastic, speed: 600 } );
   //new svgIcon( document.querySelector( '.si-icons-easing .si-icon-maximize' ), svgIconConfig, { easing : mina.elastic, speed: 600 } );
   // new svgIcon( document.querySelector( '.si-icons-easing .si-icon-contract' ), svgIconConfig, { easing : mina.elastic, speed: 600 } );
   // new svgIcon( document.querySelector( '.si-icons-easing .si-icon-glass-empty' ), svgIconConfig, { easing : mina.elastic, speed: 600 } );

   // new svgIcon( document.querySelector( '.si-icons-hover .si-icon-clock' ), svgIconConfig, { easing : mina.backin, evtoggle : 'mouseover', size : { w : 128, h : 128 } } );
   // new svgIcon( document.querySelector( '.si-icons-hover .si-icon-hamburger' ), svgIconConfig, { easing : mina.backin, evtoggle : 'mouseover', size : { w : 128, h : 128 } } );
   // new svgIcon( document.querySelector( '.si-icons-hover .si-icon-flag' ), svgIconConfig, { easing : mina.backin, evtoggle : 'mouseover', size : { w : 128, h : 128 } } );
   // new svgIcon( document.querySelector( '.si-icons-hover .si-icon-zoom' ), svgIconConfig, { easing : mina.backin, evtoggle : 'mouseover', size : { w : 128, h : 128 } } );
   // new svgIcon( document.querySelector( '.si-icons-hover .si-icon-maximize' ), svgIconConfig, { easing : mina.backin, evtoggle : 'mouseover', size : { w : 128, h : 128 } } );
   // new svgIcon( document.querySelector( '.si-icons-hover .si-icon-equalizer' ), svgIconConfig, { easing : mina.backin, evtoggle : 'mouseover', size : { w : 128, h : 128 } } );
})();