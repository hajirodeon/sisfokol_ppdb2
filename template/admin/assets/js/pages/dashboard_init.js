"use strict";
//  Author: ThemeREX.com

(function($) {

    $(document).ready(function() {


        // Init Demo JS
        Demo.init();


        // Init Theme Core
        Core.init();

        // Page Demo JS
        if (jQuery('body').hasClass('user-interface-alerts')) {
	        $('#alert-demo-call-1').on('click', function () {
	            $('#alert-demo-1').slideToggle('fast');
	        });

	        $('#alert-demo-call-2').on('click', function () {
	            $('#alert-demo-2').fadeToggle();
	        });
	    }

        // Init Summernote
        //if ( (!$(this).hasClass("current")) && (!$("body").hasClass("home"))  ){
	    if ( (jQuery('body').hasClass('basic-messages')) && (jQuery(".summernote").length > 0) ) {
	        $('.summernote').summernote({
	            height: 255,
	            focus: false,
	            oninit: function () {
	            },
	            onChange: function (contents, $editable) {
	            },
	        });
	    }

        // Init D3Charts
	    if (jQuery('body').hasClass('charts-d3')) {
        	D3Charts.init();
	    }

        // Flot charts JS
	    if (jQuery('body').hasClass('charts-flot')) {
        	FlotCharts.init();
	    }

        // ChighCharts JS
	    if (jQuery('body').hasClass('charts-highcharts')) {
        	demoHighCharts.init();
	    }

        // Init FooTable
	    if (jQuery('body').hasClass('tables-sortable')) {
        	$('.footable').footable();
	    }

		// Select dropdowns
	    if (jQuery('body').hasClass('sales-stats-page')) {

	        var selectList = $('.allcp-form select');
	        selectList.each(function (i, e) {
	            $(e).on('change', function () {
	                if ($(e).val() == "0") $(e).addClass("empty");
	                else $(e).removeClass("empty")
	            });
	        });
	        selectList.each(function (i, e) {
	            $(e).change();
	        });
	    }


        // Init Highlight.js
	    if ( (jQuery('body').hasClass('user-interface-grid')) || (jQuery('body').hasClass('user-interface-typography')) ) {
	        $('pre.highlight').each(function (i, block) {
	            hljs.highlightBlock(block);
	        });
	    }

	    if ( (jQuery('body').hasClass('utility-page')) || (jQuery('body').hasClass('utility-page')) ) {
	        // Init CanvasBG
	        CanvasBG.init({
	            Loc: {
	                x: window.innerWidth / 10,
	                y: window.innerHeight / 20
	            }
	        });

	        // Init Countdown
	        var newYear = new Date();
	        newYear = new Date(2017, 12, 0);
	        $('#counter').countdown({
	            until: newYear
	        });
	    }


    });

})(jQuery);
