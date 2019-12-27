'use strict';
//  Author: ThemeREX.com
//  basic-calendar.html scripts
//

(function ($) {

    $(document).ready(function () {

        "use strict";

        // Init Demo JS
        Demo.init();


        // Init Theme Core
        Core.init();

        // Init FullCalendar events
        $('#external-events .fc-event').each(function () {
            // Calendar data stored until drop event
            $(this).data('event', {
                title: $.trim($(this).text()), // element text = event title
                stick: true,
                className: 'fc-event-' + $(this).attr('data-event')
            });

            // make the event draggable
            $(this).draggable({
                zIndex: 999,
                revert: true,
                revertDuration: 0 //  After drag position
            });

        });

        var Calendar = $('#calendar');
        var Picker = $('.inline-mp');

        // Init FullCalendar Plugin
        Calendar.fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            events: [{
                title: 'International Literacy Day 2016',
                start: '2016-03-01',
                end: '2016-03-01',
                className: 'fc-event-default'
            }, {
                title: 'International Literacy Day 2016',
                start: '2016-03-04',
                end: '2016-03-04',
                className: 'fc-event-default'
            }, {
                title: 'Leadership Strategies Conference',
                start: '2016-03-08',
                end: '2016-03-08',
                className: 'fc-event-success'
            }, {
                title: 'Seminar: Fundamentals of Strategic Planning',
                start: '2016-03-10',
                end: '2016-03-10',
                className: 'fc-event-warning'
            }, {
                title: 'Project Management Seminar',
                start: '2016-03-12',
                end: '2016-03-12',
                className: 'fc-event-warning'
            }, {
                title: 'Workshop:Customer Service Workshop',
                start: '2016-03-14',
                end: '2016-03-14',
                className: 'fc-event-primary'
            }, {
                title: 'Critical Thinking Workshop',
                start: '2016-03-15',
                end: '2016-03-15',
                className: 'fc-event-primary'
            }, {
                title: 'International Labor Day 2016',
                start: '2016-03-17',
                end: '2016-03-17',
                className: 'fc-event-alert'
            }, {
                title: 'Meeting: Leading Your Team to Success',
                start: '2016-03-19',
                end: '2016-03-19',
                className: 'fc-event-alert'
            }, {
                title: 'Tools and Techniques for Mastering Data',
                start: '2016-03-21',
                end: '2016-03-21',
                className: 'fc-event-success'
            }, {
                title: 'Leadership Strategies Conference',
                start: '2016-03-23',
                end: '2016-03-23',
                className: 'fc-event-success'
            }, {
                title: 'Seminar: Fundamentals of Strategic Planning',
                start: '2016-03-24',
                end: '2016-03-24',
                className: 'fc-event-warning'
            }, {
                title: 'Project Management Seminar',
                start: '2016-03-25',
                end: '2016-03-25',
                className: 'fc-event-warning'
            }, {
                title: 'Workshop:Customer Service Workshop',
                start: '2016-03-26',
                end: '2016-03-26',
                className: 'fc-event-primary'
            }, {
                title: 'Critical Thinking Workshop',
                start: '2016-03-28',
                end: '2016-03-28',
                className: 'fc-event-primary'
            }, {
                title: 'International Labor Day 2016',
                start: '2016-03-29',
                end: '2016-03-29',
                className: 'fc-event-alert'
            }, {
                title: 'Meeting: Leading Your Team to Success',
                start: '2016-03-30',
                end: '2016-03-30',
                className: 'fc-event-alert'
            }, {
                title: 'Tools and Techniques for Mastering Data',
                start: '2016-03-31',
                end: '2016-03-31',
                className: 'fc-event-success'
            }
            ],
            viewRender: function (view) {
                // Update monthpicker on change if init
                if (Picker.hasClass('hasMonthpicker')) {
                    var selectedDate = Calendar.fullCalendar('getDate');
                    var formatted = moment(selectedDate, 'MM-DD-YYYY').format('MM/YY');
                    Picker.monthpicker("setDate", formatted);
                }
                // Update mini calendar title
                var titleContainer = $('.fc-title-clone');
                if (!titleContainer.length) {
                    return;
                }
                titleContainer.html(view.title);
            },
            droppable: true, // allows things to be dropped onto the calendar
            drop: function () {
                // Check if "remove after drop" checkbox checked
                if (!$(this).hasClass('event-recurring')) {
                    $(this).remove();
                }
            },
            eventRender: function (event, element) {
                // Create event tooltip
                $(element).attr("data-original-title", event.title);
                $(element).tooltip({
                    container: 'body',
                    delay: {
                        "show": 100,
                        "hide": 200
                    }
                });
                // Tooltip auto close timer
                $(element).on('show.bs.tooltip', function () {
                    var autoClose = setTimeout(function () {
                        $('.tooltip').fadeOut();
                    }, 3500);
                });
            }
        });

        // Init MonthPicker and link it
        Picker.monthpicker({
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            showButtonPanel: false,
            onSelect: function (selectedDate) {
                var formatted = moment(selectedDate, 'MM/YYYY').format('MM/DD/YYYY');
                Calendar.fullCalendar('gotoDate', formatted)
            }
        });


        // Init Calendar Modal using Magnific Popup
        $('#compose-event-btn').magnificPopup({
            removalDelay: 500,
            callbacks: {
                beforeOpen: function (e) {
                    // Indicate active overlay
                    $('body').addClass('mfp-bg-open');
                    this.st.mainClass = this.st.el.attr('data-effect');
                },
                afterClose: function (e) {
                    $('body').removeClass('mfp-bg-open');
                }
            },
            midClick: true // Open popup on middle mouse click
        });

        // Modal Calendar Date picker
        $("#eventDate").datepicker({
            numberOfMonths: 1,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            showButtonPanel: false,
            beforeShow: function (input, inst) {
                var newclass = 'allcp-form';
                var themeClass = $(this).parents('.allcp-form').attr('class');
                var smartpikr = inst.dpDiv.parent();
                if (!smartpikr.hasClass(themeClass)) {
                    inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
                }
            }

        });
    });

})(jQuery);
