'use strict';
/*
 * http://themerex.com/
 * Copyright (c) 2015 ThemeREX;
*/

/*
 * Main functionality
*/

var Core = function(options) {

   // Variables
   var Window = $(window);
   var Body = $('body');
   var Navbar = $('.navbar');
   var Topbar = $('#topbar');

   var windowH = Window.height();
   var bodyH = Body.height();
   var navbarH = 0;
   var topbarH = 0;

   if (Navbar.is(':visible')) { navbarH = Navbar.height(); }
   if (Topbar.is(':visible')) { topbarH = Topbar.height(); }

   // Get content elements inner height
   var contentHeight = windowH - (navbarH + topbarH);

   // SideMenu
   var runSideMenu = function(options) {

      // Init Nano scrollbar if exist
      if ($('.nano.affix').length) {
          $(".nano.affix").nanoScroller({
             preventPageScrolling: true
          });
      }

      // Sidebar states:
      // "sb-l-o" - SideBar Left Open
      // "sb-l-c" - SideBar Left Closed
      // "sb-l-m" - SideBar Left Minified
      // "sb-r-o" - SideBar Right Open
      // "sb-r-c" - SideBar Right Closed
      // "sb-r-m" - SideBar Right Minified

      // SideBar Left Toggle Function
      var sidebarLeftToggle = function() {

         // If Horizontal Sidebar - return
         if ($('body.sb-top').length) { return; }

         // Reopen Sidebar if closed - it would appear minified.
         if (Body.hasClass('sb-l-c') && options.collapse === "sb-l-m") {
            Body.removeClass('sb-l-c');
         }

         // Sidebar open/close
         Body.toggleClass(options.collapse).removeClass('sb-r-o').addClass('sb-r-c');
         triggerResize();
      };

      // SideBar Right Toggle Function
      var sidebarRightToggle = function() {

         // If Horizontal Sidebar - return
         if ($('body.sb-top').length) { return; }

         // Sidebar open/close
         if (options.siblingRope === true && !Body.hasClass('mobile-view') && Body.hasClass('sb-r-o')) {
            Body.toggleClass('sb-r-o sb-r-c').toggleClass(options.collapse);
         }
         else {
            Body.toggleClass('sb-r-o sb-r-c').addClass(options.collapse);
         }
         triggerResize();
      };

      // SideBar Top Toggle Function
      var sidebarTopToggle = function() {

         // Sidebar open/close
         Body.toggleClass('sb-top-collapsed');

      };

      // Sidebar Left Collapse Entire Menu event
      $('.sidebar-toggler').on('click', function(e) {
         e.preventDefault();

         // If Horizontal Sidebar - return
         if ($('body.sb-top').length) { return; }

         // Close Menu
         Body.addClass('sb-l-c');
         triggerResize();

         // Toggle menu if state is not responsive
         if (!Body.hasClass('mobile-view')) {
            setTimeout(function() {
               Body.toggleClass('sb-l-m sb-l-o');
            }, 250);
         }
      });

      // Check window size on load
      // Toggles "mobile-view" class based on window size
      var sbOnLoadCheck = function() {

         // If sidebar menu Horizontal - add mobile classes
         if ($('body.sb-top').length) {
            // Add ".mobile-view" class if window width < 900
            if ($(window).width() < 900) {
               Body.addClass('sb-top-mobile').removeClass('sb-top-collapsed');
            }
            return;
         }

         // If Left/Right Sidebar class not found in body - add default sidebar settings
         if (!$('body.sb-l-o').length && !$('body.sb-l-m').length && !$('body.sb-l-c').length) {
            $('body').addClass(options.sbl);
         }
         if (!$('body.sb-r-o').length && !$('body.sb-r-c').length) {
            $('body').addClass(options.sbr);
         }

         if (Body.hasClass('sb-l-m')) { Body.addClass('sb-l-disable-animation'); }
         else { Body.removeClass('sb-l-disable-animation'); }

         // If window width is < 1281px - collapse sidebars and add ".mobile-view" class
         if ($(window).width() < 1281) {
            Body.removeClass('sb-r-o').addClass('mobile-view sb-l-m sb-r-c');
         }

         resizeBody();
      };


      // Check window size on resize
      // Toggle "mobile-view" class based on window size
      var sbOnResize = function() {

         // If horizontal sidebar menu - return
         if ($('body.sb-top').length) {
            // If window width < 900px - collapse sidebars and add ".mobile-view" class
            if ($(window).width() < 900 && !Body.hasClass('sb-top-mobile')) {
               Body.addClass('sb-top-mobile');
            } else if ($(window).width() > 900) {
               Body.removeClass('sb-top-mobile');
            }
            return;
         }

         // If window width < 1281px - collapse sidebars and add ".mobile-view" class
         if ($(window).width() < 1281 && !Body.hasClass('mobile-view')) {
            Body.removeClass('sb-r-o').addClass('mobile-view sb-l-m sb-r-c');
         } else if ($(window).width() > 1281) {
            Body.removeClass('mobile-view');
         } else {
            return;
         }

         resizeBody();
      };

      // Set content min-height equal body height so bgs have full height
      var resizeBody = function() {

         var sidebarH = $('#sidebar_left').outerHeight();
         var cHeight = (topbarH + navbarH + sidebarH + 21);

         Body.css('min-height', cHeight);
      };

      // Trigger global resize function to catch plugins after menu animation (300ms)
      var triggerResize = function() {
         setTimeout(function() {
            $(window).trigger('resize');

            if(Body.hasClass('sb-l-m')) {
               Body.addClass('sb-l-disable-animation');
            }
            else {
               Body.removeClass('sb-l-disable-animation');
            }
         }, 300)
      };

      sbOnLoadCheck();
      $("#sidebar_top_toggle").on('click', sidebarTopToggle);
      $("#sidebar_left_toggle").on('click', sidebarLeftToggle);
      $("#sidebar_right_toggle").on('click', sidebarRightToggle);

      // Attach debounced resize handler
      var rescale = function() {
         sbOnResize();
      };
      var lazyLayout = _.debounce(rescale, 300);
      $(window).resize(lazyLayout);

      //
      // 2. LEFT USER MENU TOGGLE
      //

      // Author Widget selector
      var authorWidget = $('#sidebar_left .author-widget');

      // Toggle open user menu
      $('.sidebar-menu-toggle').on('click', function(e) {
         e.preventDefault();

         // Sidebar widgets are not supported for Horizontal menu
         if ($('body.sb-top').length) { return; }

         // Let author widget sibling menu know if it is present
         if (authorWidget.is(':visible')) { authorWidget.toggleClass('menu-widget-open'); }

         // Class toggle for state change
         $('.menu-widget').toggleClass('menu-widget-open').slideToggle('fast');

      });

      // 3. LEFT MENU LINKS TOGGLE
      $('.sidebar-menu li a.accordion-toggle').on('click', function(e) {
         e.preventDefault();

         // If selected menu item is minified and is a submenu (has sub-nav parent) - return
         if ($('body').hasClass('sb-l-m') && !$(this).parents('ul.sub-nav').length) { return; }

         // If selected menu item is a dropdown - open it
         if (!$(this).parents('ul.sub-nav').length) {

            // If sidebar horizontal - return
            if ($(window).width() > 900) {
               if ($('body.sb-top').length) { return; }
            }

            $('a.accordion-toggle.menu-open').next('ul').slideUp('fast', 'swing', function() {
               $(this).attr('style', '').prev().removeClass('menu-open');
            });
         }
         // If selected menu item is a dropdown inside of a dropdown -
         // close menu items which are not children of the main top level menu
         else {
            var activeMenu = $(this).next('ul.sub-nav');
            var siblingMenu = $(this).parent().siblings('li').children('a.accordion-toggle.menu-open').next('ul.sub-nav');

            activeMenu.slideUp('fast', 'swing', function() {
               $(this).attr('style', '').prev().removeClass('menu-open');
            });
            siblingMenu.slideUp('fast', 'swing', function() {
               $(this).attr('style', '').prev().removeClass('menu-open');
            });
         }

         // Expand target menu item, add ".open-menu" class
         // and remove unneeded inline jQuery animation styles
         if (!$(this).hasClass('menu-open')) {
            $(this).next('ul').slideToggle('fast', 'swing', function() {
               $(this).attr('style', '').prev().toggleClass('menu-open');
            });
         }

      });
   };

   // Footer Functions
   var runFooter = function() {

      // Smoothscroll for "move-to-top" button
      var pageFooterBtn = $('.footer-return-top');
      if (pageFooterBtn.length) {
        pageFooterBtn.smoothScroll({offset: -55});
      }
   };

   jQuery(".flipswitch-cb:checkbox").change(function(){
      jQuery(this).next(".flipswitch-label").toggleClass("flipswitch-checked");
   });

   // jQuery Helper Functions
   var runHelpers = function() {

      // Disable element selection
      $.fn.disableSelection = function() {
         return this
            .attr('unselectable', 'on')
            .css('user-select', 'none')
            .on('selectstart', false);
      };

      // Get element scrollbar visibility
      $.fn.hasScrollBar = function() {
         return this.get(0).scrollHeight > this.height();
      };

      // If IE 9 - add class
      function msieversion() {
           var ua = window.navigator.userAgent;
           var msie = ua.indexOf("MSIE ");
           if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
              var ieVersion = parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
              if (ieVersion === 9) {$('body').addClass('no-js ie' + ieVersion);}
              return ieVersion;
           }
           else { return false; }
      }
      msieversion();

      // Define FF browser
      if(!(window.mozInnerScreenX == null)) $('html').addClass('ff');

      // Remove unneeded helper classes
      setTimeout(function() {
         $('#content').removeClass('animated fadeIn');
      },800);

   };

   // Delayed Animations
   var runAnimations = function() {

      // Prevent bluring pages with intensive resources
      if (!$('body.boxed-layout').length) {
         setTimeout(function() {
            $('body').addClass('onload-check');
         }, 100);
      }

      // Delayed Animations
      $('.animated-delay[data-animate]').each(function() {
         var This = $(this)
         var delayTime = This.data('animate');
         var delayAnimation = 'fadeIn';

         // Reset Defaults if data attribute is array (2 or more atts)
         if (delayTime.length > 1 && delayTime.length < 3) {
            delayTime = This.data('animate')[0];
            delayAnimation = This.data('animate')[1];
         }

         var delayAnimate = setTimeout(function() {
            This.removeClass('animated-delay').addClass('animated ' + delayAnimation)
               .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
                  This.removeClass('animated ' + delayAnimation);
               });
         }, delayTime);
      });

      // "In-View" Animations
      $('.animated-waypoint').each(function(i, e) {
         var This = $(this);
         var Animation = This.data('animate');
         var offsetVal = '35%';

         // Reset Defaults if data attribute is array (2 or more atts)
         if (Animation.length > 1 && Animation.length < 3) {
            Animation = This.data('animate')[0];
            offsetVal = This.data('animate')[1];
         }

         var waypoint = new Waypoint({
            element: This,
            handler: function(direction) {
               console.log(offsetVal)
               if (This.hasClass('animated-waypoint')) {
                  This.removeClass('animated-waypoint').addClass('animated ' + Animation)
                     .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
                        This.removeClass('animated ' + Animation);
                     });
               }
            },
            offset: offsetVal
         });
      });

   };

   // Header Functions
   var runHeader = function() {

      // Searchbar - Mobile hack
      $('.search-form').on('click', function(e) {
         var This = $(this);
         var searchForm = This.find('input');
         var searchRemove = This.find('.search-remove');

         // If mobile - start
         if ($('body.mobile-view').length || $('body.sb-top-mobile').length) {

            // Open search bar, add search remove icon if one there isn't one
            This.addClass('search-open');
            if (!searchRemove.length) {
               This.append('<div class="search-remove"></div>');
            }

            // Focus search input on animation (fadeIn) complete
            setTimeout(function() {
               This.find('.search-remove').fadeIn();
               searchForm.focus().one('keydown', function() {
                  $(this).val('');
               });
            },250);

            // Close search bar
            if ($(e.target).attr('class') == 'search-remove') {
               This.removeClass('search-open').find('.search-remove').remove();
            }

         }

      });

      if (jQuery(".info-circle").length > 0) {
         jQuery(".info-circle").each(function() {
            var circle_color = jQuery(this).attr("data-circle-color");
            var circle_color_class = 'circle-text-' + circle_color;
            jQuery(this).addClass(circle_color_class);
         });
      }

      if (jQuery(".progress.vertical").length > 0) {
         jQuery(".progress.vertical").each(function() {
            var skillBar = $(this).find('.progress-bar');
            var skillVal = skillBar.attr("aria-valuenow");
            $(skillBar).css({
               height: skillVal + '%'
            });
         });
      }
      if (jQuery(".progress:not(.vertical)").length > 0) {
         jQuery(".progress:not(.vertical)").each(function() {
            var skillBar = $(this).find('.progress-bar');
            var skillVal = skillBar.attr("aria-valuenow");
            $(skillBar).css({
               width: skillVal + '%'
            });
         });
      }


      // Init jQuery Multi-Select for navbar user dropdowns
      var btnClass = "btn-info";

      if ($("#user-status").length) {
          $('#user-status').multiselect({
            buttonClass: 'btn ' + btnClass + ' btn-sm',
            buttonWidth: 86,
            dropRight: false
         });
      }
      if ($("#user-role").length) {
          $('#user-role').multiselect({
            buttonClass: 'btn ' + btnClass + ' btn-sm',
            buttonWidth: 86,
            dropRight: true
         });
      }

      //Prevent closing when a child multiselect is clicked
      $('.dropdown-menu', '.navbar-user').on('click', function(e) {

         e.stopPropagation();
         var Target  = $(e.target);
         var TargetGroup = Target.parents('.btn-group');
         var SiblingGroup = Target.parents('.dropdown-menu').find('.btn-group');

         // Toggle multiselect menus
         if (Target.hasClass('multiselect') || Target.parent().hasClass('multiselect')) {
           SiblingGroup.removeClass('open');
           TargetGroup.addClass('open');
         }
         else { SiblingGroup.removeClass('open'); }

      });

      // Sliding Topbar Menu
      var menu = $('#topbar-dropmenu-wrapper');
      var items = menu.find('.service-box');
      var serviceModal = $('.service-modal');

      // Toggle topbar menu
      $('.topbar-dropmenu-toggle').on('click', function() {
            menu.slideToggle(230).toggleClass('topbar-dropmenu-open');
         serviceModal.fadeIn();
      });

      // Close menu on modal click
      $('body').on('click', '.service-modal', function() {
         serviceModal.fadeOut('fast');
         setTimeout(function() {
            menu.slideToggle(150).toggleClass('topbar-dropmenu-open');
         }, 250);
      });
   };

   // Columns related Functions
   var runChutes = function() {

      // Match column height with body height
      var chuteFormat = $('#content .chute');
      if (chuteFormat.length) {

         // Loop each column and set height to match body
         chuteFormat.each(function(i,e) {
            var This = $(e);
            var chuteScroll = This.find('.chute-scroller');

            This.height(contentHeight);
            chuteScroll.height(contentHeight);

            if (chuteScroll.length) {
              chuteScroll.scroller();
            }
         });

         // Scroll lock for fixed content overflow
         $('#content').scrollLock('on', 'div');

      }

      // Debounced resize handler
      var rescale = function() {
         if ($(window).width() < 1281) { Body.addClass('chute-rescale'); }
         else { Body.removeClass('chute-rescale chute-rescale-left chute-rescale-right'); }
      };
      var lazyLayout = _.debounce(rescale, 300);

      if (!Body.hasClass('disable-chute-rescale')) {
         // Rescale on window resize
         $(window).resize(lazyLayout);

         // Rescale on load
         rescale();
      }

      // Custom animation for chute-nav if exists
      var navAnimate = $('.chute-nav[data-nav-animate]');
      if (navAnimate.length) {
          var Animation = navAnimate.data('nav-animate');

          // Set default "fadeIn" animation if none is set
          if (Animation == null || Animation == true || Animation == "") { Animation = "fadeIn"; }

          // Add after set timeout for each li element
          setTimeout(function() {
            navAnimate.find('li').each(function(i, e) {
              var Timer = setTimeout(function() {
                $(e).addClass('animated animated-short ' + Animation);
              }, 50 * i);
            });
          }, 500);
      }

       // Responsive Column Javascript Data Helper. If browser window
       // If window width < 575px wide - relocate columns content
       var dataChute = $('.chute[data-chute-mobile]');
       var dataAppend = dataChute.children();
       function fcRefresh() {
         if ($('body').width() < 585) {
           dataAppend.appendTo($(dataChute.data('chute-mobile')));
         }
         else { dataAppend.appendTo(dataChute); }
       }
       fcRefresh();

       // Attach debounced resize handler
       var fcResize = function() { fcRefresh(); };
       var fcLayout = _.debounce(fcResize, 300);
       $(window).resize(fcLayout);

   };


   var chuteIconStyle = function() {
         $('.chute-icon').on("click", function(e) {
             if (jQuery(this).parent().hasClass("hover")) {
               jQuery('.chute-icon-style').removeClass( "hover" );
            } else{
               jQuery('.chute-icon-style').removeClass( "hover" );
               jQuery(this).parent().addClass( "hover" );
            }
         });
         $(document).on("click", function(e) {
             var target = e.target;

             if (!$(target).is('.chute-icon-style') && !$(target).parents().is('.chute-icon-style')) {
                 jQuery('.chute-icon-style').removeClass( "hover" );
             }
         });

   }

   var HorizontalMenu = function() {
      // if (jQuery("body.sb-top").length > 0) {
      //    $(".nav a").click(function(event) {
      //       if ($(this).attr('href') == '#') {
      //          $("a.menu-open", ".nav").removeClass("menu-open");
      //          $(this).toggleClass('menu-open')
      //          return false;
      //       } else {
      //       }
      //    });
      // }

      //float menu
      // if (jQuery("body.sb-top").length > 0) {

      //    $(".sidebar-menu > li > a", ".sidebar-left-content").click(function(event) {
      //       if ($(this).hasClass("menu-open")) {
      //          $("a.menu-open", ".sidebar-menu").removeClass("menu-open");
      //       } else {
      //          $("a.menu-open", ".sidebar-menu").removeClass("menu-open");
      //          $(this).toggleClass('menu-open')
      //       }
      //       if ($(this).attr('href') == '#') {
      //          return false;
      //       } else {
      //       }
      //    });
      //    $(".sidebar-menu > li > .sub-nav > li > a", ".sidebar-left-content").click(function(event) {
      //       if ($(this).hasClass("menu-open")) {
      //          $("a.menu-open", ".sub-nav").removeClass("menu-open");
      //       } else {
      //          $("a.menu-open", ".sub-nav").removeClass("menu-open");
      //          $(this).toggleClass('menu-open')
      //       }
      //       if ($(this).attr('href') == '#') {
      //          return false;
      //       } else {
      //       }
      //    });
      // }
   }

   // Form related Functions
   var runFormElements = function() {

      // Bootstrap tooltips init if exists
      var Tooltips = $("[data-toggle=tooltip]");
      if (Tooltips.length) {
         if (Tooltips.parents('#sidebar_left')) {
            Tooltips.tooltip({
               container: $('body'),
               template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
            });
         } else {
            Tooltips.tooltip();
         }
      }

      // Bootstrap Popovers Init if exist
      var Popovers = $("[data-toggle=popover]");
      if (Popovers.length) {
          Popovers.popover();
      }

      // Init Bootstrap persistent tooltips to prevent popup from closing
      // if a checkbox in it is clicked
      $('.dropdown-menu.keep-dropdown').on('click', function(e) {
         e.stopPropagation();
      });

      // Prevent close dropdown menu if a nav-tab in it is clicked
      $('.dropdown-menu .nav-tabs li a').on('click', function(e) {
         e.preventDefault();
         e.stopPropagation();
         $(this).tab('show')
      });

      // Prevents close dropdown menu if btn-group in it is clicked
      $('.dropdown-menu .btn-group-nav a').on('click', function(e) {
         e.preventDefault();
         e.stopPropagation();

         // Remove ".active" from btn-group > btn and toggle tab content
         $(this).siblings('a').removeClass('active').end().addClass('active').tab('show');
      });

      // Track btn with ".btn-state" for click to toggle classes
      if ($('.btn-states').length) {
          $('.btn-states').on('click', function() {
            $(this).addClass('active').siblings().removeClass('active');
         });
      }

      // If ".panel-scroller" - add fixed height content scroller
      var panelScroller = $('.panel-scroller');
      if (panelScroller.length) {
          panelScroller.each(function(i, e) {
           var This = $(e);
           var Delay = This.data('scroller-delay');
           var Margin = 5;

           // Check if scroller bar margin is required
           if (This.hasClass('scroller-thick')) { Margin = 0; }

           // If scroller bar is in dropdown - init it after dropdown is visible
           var DropMenuParent = This.parents('.dropdown-menu');
           if (DropMenuParent.length) {
               DropMenuParent.prevAll('.dropdown-toggle').on('click', function() {
                  setTimeout(function() {
                     This.scroller();
                     $('.navbar').scrollLock('on', 'div');
                  },50);
               });
               return;
           }

           if (Delay) {
             var Timer = setTimeout(function() {
                This.scroller({ trackMargin: Margin, });
               $('#content').scrollLock('on', 'div');
             }, Delay);
           }
           else {
             This.scroller({ trackMargin: Margin, });
             $('#content').scrollLock('on', 'div');
           }

         });
      }

      // Init smoothscroll for elements where data attr is set
      var SmoothScroll = $('[data-smoothscroll]');
      if (SmoothScroll.length) {
        SmoothScroll.each(function(i,e) {
          var This = $(e);
          var Offset = This.data('smoothscroll');
          var Links = This.find('a');

          // Init Smoothscroll with data stored offset
          Links.smoothScroll({
            offset: Offset
          });

        });
      }

   };
   return {
      init: function(options) {

         // Set Default Options
         var defaults = {
            sbl: "sb-l-o", // sidebar left open
            sbr: "sb-r-c", // sidebar right closed
            sbState: "save", //Enable local storage for sidebar states

            collapse: "sb-l-m", // sidebar left collapse
            // if true - reopen SL when SR is closed
            siblingRope: true
         };

         // Extend Default Options
         var options = $.extend({}, defaults, options);

         // Call Core Functions
         runHelpers();
         runAnimations();
         runHeader();
         runSideMenu(options);
         runFooter();
         runChutes();
         runFormElements();
         chuteIconStyle();
         HorizontalMenu();
      }

   }
}();

// Theme colors Global Library
var bgPrimary = '#11a8bb',  
   bgPrimaryL = '#2dd6ec',
   bgPrimaryLr = '#73e4f2',
   bgPrimaryD = '#109bad',
   bgPrimaryDr = '#0e8898',
   bgPrimaryDrAlt = '#009688',
   bgSuccess = '#47d1af',
   bgSuccessL = '#84e0a5',
   bgSuccessLr = '#c1f0d2',
   bgSuccessD = '#3bce6f',
   bgSuccessDr = '#30c164',
   bgInfo = '#47d1af',
   bgInfoL = '#84e0ca',
   bgInfoLr = '#c1f0e4',
   bgInfoD = '#3bceaa',
   bgInfoDr = '#23cac0',
   bgInfoDrAlt = '#156565',
   bgWarning = '#ff7444',
   bgWarningL = '#ffad91',
   bgWarningLr = '#ffe6dd',
   bgWarningLrAlt = '#ffca4c',
   bgWarningD = '#ff6935',
   bgWarningDr = '#ff581e',
   bgDanger = '#ee5744',
   bgDangerL = '#f4968a',
   bgDangerLr = '#fbd5d0',
   bgDangerD = '#ed4a36',
   bgDangerDr = '#eb3821',
   bgAlert = '#fdba4b',
   bgAlertL = '#f4968a',
   bgAlertLr = '#fbd5d0',
   bgAlertD = '#fdb43c',
   bgAlertDr = '#fdab25',
   bgSystem = '#6852b2',
   bgSystemL = '#9687ca',
   bgSystemLr = '#c4bce1',
   bgSystemD = '#614ba9',
   bgSystemDr = '#584499',
   bgLight = '#fafafa',
   bgLightL = '#ffffff',
   bgLightLr = '#ffffff',
   bgLightD = '#f0f0f0',
   bgLightDr = '#e7e7e7',
   bgDark = '#2a3342',
   bgDarkL = '#bbc4d4',
   bgDarkLr = '#394559',
   bgDarkD = '#384458',
   bgDarkDr = '#1b212b',
   bgBlack = '#273847',
   bgBlackL = '#2a3241',
   bgBlackLr = '#34495a',
   bgBlackD = '#1a2620',
   bgBlackDr = '#0e151a';

/* Add custom sidebar */
if (jQuery("body.with-customizer").length > 0) {
   var custom_options ='<div id="customizer" class="hidden-xs">';
   custom_options  +=    '<div class="panel">';
   custom_options  +=        '<div class="panel-heading">';
   custom_options  +=            '<span class="panel-icon">';
   custom_options  +=                '<i class="icon-construction fs30"></i>';
   custom_options  +=            '</span>';
   custom_options  +=            '<span class="panel-title"> Theme Options</span>';
   custom_options  +=        '</div>';
   custom_options  +=        '<div class="panel-body pn">';
   custom_options  +=            '<ul class="nav nav-list nav-list-sm" role="tablist">';
   custom_options  +=                '<li class="active">';
   custom_options  +=                    '<a href="#customizer-header" role="tab" data-toggle="tab">Navbar</a>';
   custom_options  +=                '</li>';
   custom_options  +=                '<li>';
   custom_options  +=                    '<a href="#customizer-sidebar" role="tab" data-toggle="tab">Sidebar</a>';
   custom_options  +=                '</li>';
   custom_options  +=                '<li>';
   custom_options  +=                    '<a href="#customizer-settings" role="tab" data-toggle="tab">Misc</a>';
   custom_options  +=                '</li>';
   custom_options  +=            '</ul>';
   custom_options  +=            '<div class="tab-content p20 ptn pb15">';
   custom_options  +=                '<div role="tabpanel" class="tab-pane active" id="customizer-header">';
   custom_options  +=                    '<form id="customizer-header-skin">';
   custom_options  +=                        '<h6 class="mv20">Header Skins</h6>';
   custom_options  +=                        '<div class="customizer-sample">';
   custom_options  +=                            '<table>';
   custom_options  +=                                '<tr>';
   custom_options  +=                                    '<td>';
   custom_options  +=                                        '<div class="checkbox-custom fill checkbox-dark mb10">';
   custom_options  +=                                            '<input type="radio" name="headerSkin" id="headerSkin5" value="bg-dark">';
   custom_options  +=                                            '<label for="headerSkin5">Dark</label>';
   custom_options  +=                                        '</div>';
   custom_options  +=                                    '</td>';
   custom_options  +=                                    '<td>';
   custom_options  +=                                        '<div class="checkbox-custom fill checkbox-warning mb10">';
   custom_options  +=                                            '<input type="radio" name="headerSkin" id="headerSkin2" value="bg-warning">';
   custom_options  +=                                            '<label for="headerSkin2">Warning</label>';
   custom_options  +=                                        '</div>';
   custom_options  +=                                    '</td>';
   custom_options  +=                                '</tr>';
   custom_options  +=                                '<tr>';
   custom_options  +=                                    '<td>';
   custom_options  +=                                        '<div class="checkbox-custom fill checkbox-danger mb10">';
   custom_options  +=                                            '<input type="radio" name="headerSkin" id="headerSkin3" value="bg-danger">';
   custom_options  +=                                            '<label for="headerSkin3">Danger</label>';
   custom_options  +=                                        '</div>';
   custom_options  +=                                    '</td>';
   custom_options  +=                                    '<td>';
   custom_options  +=                                        '<div class="checkbox-custom fill checkbox-success mb10">';
   custom_options  +=                                            '<input type="radio" name="headerSkin" id="headerSkin4" value="bg-success">';
   custom_options  +=                                            '<label for="headerSkin4">Success</label>';
   custom_options  +=                                        '</div>';
   custom_options  +=                                    '</td>';
   custom_options  +=                                '</tr>';
   custom_options  +=                                '<tr>';
   custom_options  +=                                    '<td>';
   custom_options  +=                                        '<div class="checkbox-custom fill checkbox-primary mb10">';
   custom_options  +=                                            '<input type="radio" name="headerSkin" id="headerSkin6" value="bg-primary">';
   custom_options  +=                                            '<label for="headerSkin6">Primary</label>';
   custom_options  +=                                        '</div>';
   custom_options  +=                                    '</td>';
   custom_options  +=                                    '<td>';
   custom_options  +=                                        '<div class="checkbox-custom fill checkbox-info mb10">';
   custom_options  +=                                            '<input type="radio" name="headerSkin" id="headerSkin7" value="bg-info">';
   custom_options  +=                                            '<label for="headerSkin7">Info</label>';
   custom_options  +=                                        '</div>';
   custom_options  +=                                    '</td>';
   custom_options  +=                                '</tr>';
   custom_options  +=                                '<tr>';
   custom_options  +=                                    '<td>';
   custom_options  +=                                        '<div class="checkbox-custom fill checkbox-alert mb10">';
   custom_options  +=                                            '<input type="radio" name="headerSkin" id="headerSkin8" value="bg-alert">';
   custom_options  +=                                            '<label for="headerSkin8">Alert</label>';
   custom_options  +=                                        '</div>';
   custom_options  +=                                    '</td>';
   custom_options  +=                                    '<td>';
   custom_options  +=                                        '<div class="checkbox-custom fill checkbox-system mb10">';
   custom_options  +=                                            '<input type="radio" name="headerSkin" id="headerSkin9" value="bg-system">';
   custom_options  +=                                            '<label for="headerSkin9">System</label>';
   custom_options  +=                                        '</div>';
   custom_options  +=                                    '</td>';
   custom_options  +=                                '</tr>';
   custom_options  +=                            '</table>';
   custom_options  +=                            '<div class="checkbox-custom checkbox-disabled fill mb10">';
   custom_options  +=                                '<input type="radio" name="headerSkin" id="headerSkin1" checked value="bgc-light">';
   custom_options  +=                                '<label for="headerSkin1">Light</label>';
   custom_options  +=                            '</div>';
   custom_options  +=                        '</div>';
   custom_options  +=                    '</form>';
   custom_options  +=                    '<form id="customizer-footer-skin">';
   custom_options  +=                        '<h6 class="mv20">Footer Skins</h6>';
   custom_options  +=                        '<div class="customizer-sample">';
   custom_options  +=                            '<table>';
   custom_options  +=                                '<tr>';
   custom_options  +=                                    '<td>';
   custom_options  +=                                        '<div class="checkbox-custom fill checkbox-dark mb10">';
   custom_options  +=                                            '<input type="radio" name="footerSkin" id="footerSkin1" checked value="">';
   custom_options  +=                                            '<label for="footerSkin1">Dark</label>';
   custom_options  +=                                        '</div>';
   custom_options  +=                                    '</td>';
   custom_options  +=                                    '<td>';
   custom_options  +=                                        '<div class="checkbox-custom checkbox-disabled fill mb10">';
   custom_options  +=                                            '<input type="radio" name="footerSkin" id="footerSkin2" value="footer-light">';
   custom_options  +=                                            '<label for="footerSkin2">Light</label>';
   custom_options  +=                                        '</div>';
   custom_options  +=                                    '</td>';
   custom_options  +=                                '</tr>';
   custom_options  +=                            '</table>';
   custom_options  +=                        '</div>';
   custom_options  +=                    '</form>';
   custom_options  +=                '</div>';
   custom_options  +=                '<div role="tabpanel" class="tab-pane" id="customizer-sidebar">';
   custom_options  +=                    '<form id="customizer-sidebar-skin">';
   custom_options  +=                        '<h6 class="mv20">Sidebar Skins</h6>';
   custom_options  +=                        '<div class="customizer-sample">';
   custom_options  +=                            '<div class="checkbox-custom fill checkbox-dark mb10">';
   custom_options  +=                                '<input type="radio" name="sidebarSkin" checked id="sidebarSkin2" value="">';
   custom_options  +=                                '<label for="sidebarSkin2">Dark</label>';
   custom_options  +=                            '</div>';
   custom_options  +=                            '<div class="checkbox-custom fill checkbox-disabled mb10">';
   custom_options  +=                                '<input type="radio" name="sidebarSkin" id="sidebarSkin1" value="sidebar-light">';
   custom_options  +=                                '<label for="sidebarSkin1">Light</label>';
   custom_options  +=                            '</div>';
   custom_options  +=                        '</div>';
   custom_options  +=                    '</form>';
   custom_options  +=                '</div>';
   custom_options  +=                '<div role="tabpanel" class="tab-pane" id="customizer-settings">';
   custom_options  +=                    '<form id="customizer-settings-misc">';
   custom_options  +=                        '<h6 class="mv20 mtn">Layout Options</h6>';
   custom_options  +=                        '<div class="form-group">';
   custom_options  +=                            '<div class="checkbox-custom fill mb10">';
   custom_options  +=                                '<input type="checkbox" checked="" id="header-option">';
   custom_options  +=                                '<label for="header-option">Fixed Header</label>';
   custom_options  +=                            '</div>';
   custom_options  +=                        '</div>';
   custom_options  +=                        '<div class="form-group">';
   custom_options  +=                            '<div class="checkbox-custom fill mb10">';
   custom_options  +=                                '<input type="checkbox" checked="" id="sidebar-option">';
   custom_options  +=                                '<label for="sidebar-option">Fixed Sidebar</label>';
   custom_options  +=                            '</div>';
   custom_options  +=                        '</div>';
   custom_options  +=                        '<div class="form-group">';
   custom_options  +=                            '<div class="checkbox-custom fill mb10">';
   custom_options  +=                                '<input type="checkbox" id="breadcrumb-option">';
   custom_options  +=                                '<label for="breadcrumb-option">Fixed Breadcrumbs</label>';
   custom_options  +=                            '</div>';
   custom_options  +=                        '</div>';
   custom_options  +=                        '<div class="form-group">';
   custom_options  +=                            '<div class="checkbox-custom fill mb10">';
   custom_options  +=                                '<input type="checkbox" id="breadcrumb-hidden">';
   custom_options  +=                                '<label for="breadcrumb-hidden">Hide Breadcrumbs</label>';
   custom_options  +=                            '</div>';
   custom_options  +=                        '</div>';
   custom_options  +=                    '</form>';
   custom_options  +=                '</div>';
   custom_options  +=            '</div>';
   custom_options  +=            '<div class="form-group mn pb35 pt25 text-center">';
   custom_options  +=                '<a href="#" id="clearAll" class="btn btn-primary btn-bordered btn-sm">Clear All</a>';
   custom_options  +=            '</div>';
   custom_options  +=        '</div>';
   custom_options  +=    '</div>';
   custom_options  +='</div>';

   jQuery('body').append(custom_options);
}
