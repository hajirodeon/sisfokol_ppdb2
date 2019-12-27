'use strict';
//  Author: ThemeREX.com
//  user-forms-additional-inputs.html scripts
//

(function($) {

    $(document).ready(function() {

        "use strict";

        // Init Theme Core
        Core.init();

        // Init Demo JS
        Demo.init();


        // Init Select2
        $(".select2-single").select2();

        // Init Select2 Multiple
        $(".select2-multiple").select2({
            placeholder: "Select model",
            allowClear: true
        });

        // Init Select2 Contextuals
        $(".select2-primary").select2();
        $(".select2-success").select2();
        $(".select2-info").select2();
        $(".select2-warning").select2();

        // Init Bootstrap Maxlength
        $('input[maxlength]').maxlength({
            threshold: 15,
            placement: "right"
        });

        // Init Bootstrap Dual List
        var demo1 = $('.demo1').bootstrapDualListbox({
            nonSelectedListLabel: 'Options',
            selectedListLabel: 'Selected',
            preserveSelectionOnMove: 'moved',
            moveOnSelect: true,
            nonSelectedFilter: 'tion ([1-3]|[1][0-5])'
        });

        $("#demoform").submit(function() {
            alert("Options Selected: " + $('.demo1').val());
            return false;
        });

        // Init Twitter Typeahead.js
        var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substrRegex;

                matches = [];

                // check if string contain "q"
                substrRegex = new RegExp(q, 'i');

                // if "q" - add to matches []
                $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                        matches.push({
                            value: str
                        });
                    }
                });

                cb(matches);
            };
        };

        var states = ['LG', 'Nokia', 'Samsung', 'Actel', 'Google',
            'SonyEricson', 'iPhone'];

        // Init Typeahead
        $('.typeahead').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'states',
            displayKey: 'value',
            source: substringMatcher(states)
        });

        // Set DateRange Options
        var rangeOptions = {
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                'Last 7 Days': [moment().subtract('days', 6), moment()],
                'Last 30 Days': [moment().subtract('days', 29), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
            },
            startDate: moment().subtract('days', 29),
            endDate: moment()
        };

        // Init DateRange 1
        $('#daterangepicker1').daterangepicker();

        // Init DateRange 2
        $('#daterangepicker2').daterangepicker(
            rangeOptions,
            function(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        );

        // Init DateRange inline
        $('#inline-daterange').daterangepicker(
            rangeOptions,
            function(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        );

        // Init  fields
        $('#datetimepicker1').datetimepicker();
        $('#datetimepicker2').datetimepicker();

        // Init inline + range detection
        $('#datetimepicker3').datetimepicker({
            defaultDate: "01/01/2016",
            inline: true
        });

        // Init fields + disabled date
        $('#datetimepicker5').datetimepicker({
            defaultDate: "01/01/2016",
            pickDate: false
        });
        // Init fields + disabled date
        $('#datetimepicker6').datetimepicker({
            defaultDate: "01/01/2016",
            pickDate: false
        });
        // Init fields + disabled date
        $('#datetimepicker7').datetimepicker({
            defaultDate: "01/01/2016",
            pickDate: false,
            inline: true
        });

        // Init Colorpicker
        $('#demo_apidemo').colorpicker({
            color: bgPrimary
        });
        $('.demo-auto').colorpicker();

        // Init Tags Manager
        $(".tm-input").tagsManager({
            tagsContainer: '.tags',
            prefilled: ["Safari", "Apple", "Apple Macintosh", "browser"],
            tagClass: 'tm-tag-info'
        });

        // Init Boostrap Multiselects
        $('#multiselect1').multiselect({
            buttonClass: 'btn btn-default btn-info'
        });
        $('#multiselect2').multiselect({
            includeSelectAllOption: true,
            buttonClass: 'btn btn-default btn-info'
        });
        $('#multiselect3').multiselect({
            buttonClass: 'btn btn-default btn-info'
        });
        $('#multiselect4').multiselect({
            enableFiltering: true,
            buttonClass: 'btn btn-default btn-info'
        });
        $('#multiselect5').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-primary'
        });
        $('#multiselect6').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-info'
        });
        $('#multiselect7').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-success'
        });
        $('#multiselect8').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-warning'
        });

        // Init Spinner
        $("#spinner1").spinner();

        // Init Spinner - currency
        $("#spinner2").spinner({
            min: 5,
            max: 2500,
            step: 25,
            start: 1000
        });

        // Init Spinner - decimal
        $("#spinner3").spinner({
            step: 0.01,
            numberFormat: "n"
        });

        // Set Time Spinner settings
        $.widget("ui.timespinner", $.ui.spinner, {
            options: {
                step: 60 * 1000, // seconds
                page: 60 // hours
            },
            _parse: function(value) {
                if (typeof value === "string") {
                    if (Number(value) == value) {
                        return Number(value);
                    }
                    return +Globalize.parseDate(value);
                }
                return value;
            },

            _format: function(value) {
                return Globalize.format(new Date(value), "t");
            }
        });

        // Init Time Spinner
        $("#spinner4").timespinner();

        // Init Masked inputs
        $('.date').mask("99/99/9999");
        $('.time').mask('99:99:99');
        $('.date_time').mask('99/99/9999 99:99:99');
        $('.zip').mask('999999');
        $('.phone').mask('(999) 999-9999');
        $('.phoneext').mask("(999) 999-9999 999999");
        $(".money").mask("999,999,999.999");
        $(".product").mask("aa9.aa9.aa9.999");
        $(".tin").mask("999-99-999");
        $(".ssn").mask("999-99-9999");
        $(".ip").mask("999.999.999.999");
        $(".eyescript").mask("~9.99 ~9.99 999");
        $(".custom").mask("9.99.999.9999");
    });

})(jQuery);
