'use strict';
//  Author: ThemeREX.com
//  index.html scripts
//

(function($) {

    $(document).ready(function() {

        "use strict";

        // Init Demo JS
        Demo.init();


        // Init Theme Core
        Core.init();

        // Init AllCP Panels
        $('.allcp-panels').allcppanel({
            grid: '.allcp-grid',
            draggable: true,
            preserveGrid: true,
            onStart: function() {},
            onFinish: function() {
                $('.allcp-panels').addClass('animated fadeIn').removeClass('fade-onload');
                demoHighCharts.init();
                runVectorMaps();
            },
            onSave: function() {
                $(window).trigger('resize');
            }
        });

        //Vector Map
        // Map Height = browser window height
        //var wHeight = $(window).height();
        //$('#map1').height(wHeight - 60);

        // Init JVectorMap
        $('#map1').vectorMap({
            map: 'world_mill_en',
            zoomButtons : false,
            focusOn: {
                x: 0.5,
                y: 0.5,
                scale: 1
            },
            backgroundColor: '#f2f3f5',
            series: {
                regions: [{
                    scale: ['#80DAE5', '#4ECCDB'],
                    normalizeFunction: 'polynomial',
                    values: {
                        "AF": 16.63,
                        "AL": 11.58,
                        "DZ": 158.97,
                        "AO": 85.81,
                        "AG": 1.1,
                        "AR": 351.02,
                        "AM": 8.83,
                        "AU": 1219.72,
                        "AT": 366.26,
                        "AZ": 52.17,
                        "BS": 7.54,
                        "BH": 21.73,
                        "BD": 105.4,
                        "BB": 3.96,
                        "BY": 52.89,
                        "BE": 461.33,
                        "BZ": 1.43,
                        "BJ": 6.49,
                        "BT": 1.4,
                        "BO": 19.18,
                        "BA": 16.2,
                        "BW": 12.5,
                        "BR": 2023.53,
                        "BN": 11.96,
                        "BG": 44.84,
                        "BF": 8.67,
                        "BI": 1.47,
                        "KH": 11.36,
                        "CM": 21.88,
                        "CA": 1563.66,
                        "CV": 1.57,
                        "CF": 2.11,
                        "TD": 7.59,
                        "CL": 199.18,
                        "CN": 5745.13,
                        "CO": 283.11,
                        "KM": 0.56,
                        "CD": 12.6,
                        "CG": 11.88,
                        "CR": 35.02,
                        "CI": 22.38,
                        "HR": 59.92,
                        "CY": 22.75,
                        "CZ": 195.23,
                        "DK": 304.56,
                        "DJ": 1.14,
                        "DM": 0.38,
                        "DO": 50.87,
                        "EC": 61.49,
                        "EG": 216.83,
                        "SV": 21.8,
                        "GQ": 14.55,
                        "ER": 2.25,
                        "EE": 19.22,
                        "ET": 30.94,
                        "FJ": 3.15,
                        "FI": 231.98,
                        "FR": 2555.44,
                        "GA": 12.56,
                        "GM": 1.04,
                        "GE": 11.23,
                        "DE": 3305.9,
                        "GH": 18.06,
                        "GR": 305.01,
                        "GD": 0.65,
                        "GT": 40.77,
                        "GN": 4.34,
                        "GW": 0.83,
                        "GY": 2.2,
                        "HT": 6.5,
                        "HN": 15.34,
                        "HK": 226.49,
                        "HU": 132.28,
                        "IS": 12.77,
                        "IN": 1430.02,
                        "ID": 695.06,
                        "IR": 337.9,
                        "IQ": 84.14,
                        "IE": 204.14,
                        "IL": 201.25,
                        "IT": 2036.69,
                        "JM": 13.74,
                        "JP": 5390.9,
                        "JO": 27.13,
                        "KZ": 129.76,
                        "KE": 32.42,
                        "KI": 0.15,
                        "KR": 986.26,
                        "KW": 117.32,
                        "KG": 4.44,
                        "LA": 6.34,
                        "LV": 23.39,
                        "LB": 39.15,
                        "LS": 1.8,
                        "LR": 0.98,
                        "LY": 77.91,
                        "LT": 35.73,
                        "LU": 52.43,
                        "MK": 9.58,
                        "MG": 8.33,
                        "MW": 5.04,
                        "MY": 218.95,
                        "MV": 1.43,
                        "ML": 9.08,
                        "MT": 7.8,
                        "MR": 3.49,
                        "MU": 9.43,
                        "MX": 1004.04,
                        "MD": 5.36,
                        "MN": 5.81,
                        "ME": 3.88,
                        "MA": 91.7,
                        "MZ": 10.21,
                        "MM": 35.65,
                        "NA": 11.45,
                        "NP": 15.11,
                        "NL": 770.31,
                        "NZ": 138,
                        "NI": 6.38,
                        "NE": 5.6,
                        "NG": 206.66,
                        "NO": 413.51,
                        "OM": 53.78,
                        "PK": 174.79,
                        "PA": 27.2,
                        "PG": 8.81,
                        "PY": 17.17,
                        "PE": 153.55,
                        "PH": 189.06,
                        "PL": 438.88,
                        "PT": 223.7,
                        "QA": 126.52,
                        "RO": 158.39,
                        "RU": 1476.91,
                        "RW": 5.69,
                        "WS": 0.55,
                        "ST": 0.19,
                        "SA": 434.44,
                        "SN": 12.66,
                        "RS": 38.92,
                        "SC": 0.92,
                        "SL": 1.9,
                        "SG": 217.38,
                        "SK": 86.26,
                        "SI": 46.44,
                        "SB": 0.67,
                        "ZA": 354.41,
                        "ES": 1374.78,
                        "LK": 48.24,
                        "KN": 0.56,
                        "LC": 1,
                        "VC": 0.58,
                        "SD": 65.93,
                        "SR": 3.3,
                        "SZ": 3.17,
                        "SE": 444.59,
                        "CH": 522.44,
                        "SY": 59.63,
                        "TW": 426.98,
                        "TJ": 5.58,
                        "TZ": 22.43,
                        "TH": 312.61,
                        "TL": 0.62,
                        "TG": 3.07,
                        "TO": 0.3,
                        "TT": 21.2,
                        "TN": 43.86,
                        "TR": 729.05,
                        "TM": 0,
                        "UG": 17.12,
                        "UA": 136.56,
                        "AE": 239.65,
                        "GB": 2258.57,
                        "US": 14624.18,
                        "UY": 40.71,
                        "UZ": 37.72,
                        "VU": 0.72,
                        "VE": 285.21,
                        "VN": 101.99,
                        "YE": 30.02,
                        "ZM": 15.69,
                        "ZW": 5.57
                    }
                }]
            }
        });

        // Get location and refocus
        $('.flag-sm').on('click', function() {
            var Loc = $(this).data('loc');
            $('#map1').vectorMap('set', 'focus', Loc);
        });

        // Get new location refocus
        $('#country-list').on('change', function() {
            $('#map1').vectorMap('set', 'focus', $(this).val());
        });

        // Toggle expand/collapse
        $('.map-toggle-menu .map-header-icon').on('click', function() {
            $(this).parent('.map-toggle-menu').toggleClass('collapsed');
        });

        // Init ".task-widget" plugins
        var taskWidget = $('div.task-widget');
        var taskItems = taskWidget.find('li.task-item');

        // Init TaskWidget Sortable
        taskWidget.sortable({
            items: taskItems,
            handle: '.task-menu',
            axis: 'y',
            scroll: false,
            connectWith: ".task-list",
            update: function( event, ui ) {
                var Item = ui.item;
                var ParentList = Item.parent();

                // If checked - move it to the "current items list"
                if (ParentList.hasClass('task-current')) {
                    Item.removeClass('item-checked').find('input[type="checkbox"]').prop('checked', false);
                }
                if (ParentList.hasClass('task-completed')) {
                    Item.addClass('item-checked').find('input[type="checkbox"]').prop('checked', true);
                }

            }
        });

        // Handle filter behavior
        taskItems.on('click', function(e) {
            e.preventDefault();
            var This = $(this);
            var Target = $(e.target);

            if (Target.is('.task-menu') && Target.parents('.task-completed').length) {
                This.remove();
                return;
            }

            if (Target.parents('.task-handle').length) {
                // If checked - move it to the "current items list"
                if (This.hasClass('item-checked')) {
                    This.removeClass('item-checked').find('input[type="checkbox"]').prop('checked', false);
                }
                // Otherwise - move it to the "completed items list"
                else {
                    This.addClass('item-checked').find('input[type="checkbox"]').prop('checked', true);
                }
            }

        });


        var highColors = [bgSystem, bgSuccess, bgWarning, bgPrimary];

        // var pie_chart_col = [
        //     ['Option 1', 40],
        //     ['Option 2', 31],
        //     ['Option 3', 19],
        // ];
        // pie_chart_col[0][0] = pie_chart_col[0][0] + " " + pie_chart_col[0][1] + "%";
        // pie_chart_col[1][0] = pie_chart_col[1][0] + " " + pie_chart_col[1][1] + "%";
        // pie_chart_col[2][0] = pie_chart_col[2][0] + " " + pie_chart_col[2][1] + "%";

        var chart101 = c3.generate({
            bindto: '#pie-chart1',
            color: {
                pattern: [bgDangerLr, bgSuccessLr, bgPrimaryL]
            },
            padding: {
                top: 0,
                right: 0,
                bottom: 40,
                left: 0,
            },
            data: {
                //columns: pie_chart_col,
                columns: [
                    ['Option 1', 40],
                    ['Option 2', 31],
                    ['Option 3', 19]
                ],
                type : 'pie',
                onclick: function (d, i) { console.log("onclick", d, i); },
                onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                onmouseout: function (d, i) { console.log("onmouseout", d, i); }
            },
            pie: {
                label: {
                    show: false
                }
            }
        });

        var chart101 = c3.generate({
            bindto: '#donut-chart1',
            color: {
                pattern: [bgDanger, bgAlert, bgInfo]
            },
            data: {
                columns: [
                    ['Option1', 50],
                    ['Option2', 30],
                    ['Option3', 20]
                ],
                type : 'donut'
                // onclick: function (d, i) { console.log("onclick", d, i); },
                // onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                // onmouseout: function (d, i) { console.log("onmouseout", d, i); }
            },
            donut: {
                title: "",
                width: 60
            },
            padding: {
              bottom: 10
            }
        });

        var ecomChart = $('#sales_chart1');
        if (ecomChart.length) {
            ecomChart.highcharts({
                credits: false,
                colors: highColors,
                chart: {
                    backgroundColor: 'transparent',
                    className: '',
                    type: 'line',
                    zoomType: 'x',
                    panning: true,
                    panKey: 'shift',
                    marginTop: 45,
                    marginRight: 1
                },
                title: {
                    text: null
                },
                xAxis: {
                    gridLineColor: '#EEE',
                    lineColor: '#EEE',
                    tickColor: '#EEE',
                    categories: ['Jan', 'Feb', 'Mar', 'Apr',
                        'May', 'Jun', 'Jul', 'Aug',
                        'Sep', 'Oct', 'Nov', 'Dec'
                    ]
                },
                yAxis: {
                    min: 0,
                    tickInterval: 5,
                    gridLineColor: '#EEE',
                    title: {
                        text: null
                    }
                },
                plotOptions: {
                    spline: {
                        lineWidth: 3
                    },
                    area: {
                        fillOpacity: 0.2
                    }
                },
                legend: {
                    enabled: true,
                    floating: false,
                    align: 'right',
                    verticalAlign: 'top',
                    x: -15
                },
                series: seriesData
            });
        }

        // Widget VectorMap
        function runVectorMaps() {

            // Jvector Map Plugin
            var runJvectorMap = function() {
                // Set data
                var mapData = [900, 700, 350, 500];
                // Init Jvector Map
                $('#WidgetMap').vectorMap({
                    map: 'us_lcc_en',
                    backgroundColor: 'transparent',
                    series: {
                        markers: [{
                            attribute: 'r',
                            scale: [3, 7],
                            values: mapData
                        }]
                    },
                    regionStyle: {
                        initial: {
                            fill: '#cfdce2'
                        },
                        hover: {
                            "fill-opacity": 0.3
                        }
                    }
                    // markers: [{
                    //     latLng: [47.036359, -109.262568],
                    //     name: 'Montana,MT'
                    // },{
                    //     latLng: [30, -100],
                    //     name: 'Texas,TX'
                    // }, {
                    //     latLng: [27, -81],
                    //     name: 'Florida,Fl'
                    // }],
                    // markerStyle: {
                    //     initial: {
                    //         fill: '#a288d5',
                    //         stroke: '#b49ae0',
                    //         "fill-opacity": 1,
                    //         "stroke-width": 10,
                    //         "stroke-opacity": 0.3,
                    //         r: 3
                    //     },
                    //     hover: {
                    //         stroke: 'black',
                    //         "stroke-width": 2
                    //     },
                    //     selected: {
                    //         fill: 'blue'
                    //     },
                    //     selectedHover: {}
                    // }
                });
                // Set States
                var states = ['US-MT', 'US-NV', 'US-IA'];
                var colors = [bgInfo, bgPrimaryL, bgSystemL];
                // var colors2 = [bgSuccess, bgWarning, bgPrimary];
                $.each(states, function(i, e) {
                    $("#WidgetMap path[data-code=" + e + "]").css({
                        fill: colors[i]
                    });
                });
                // $('#WidgetMap').find('.jvectormap-marker')
                //     .each(function(i, e) {
                //         $(e).css({
                //             fill: colors2[i],
                //             stroke: colors2[i]
                //         });
                //     });
            };

            if ($('#WidgetMap').length) {
                runJvectorMap();
            }
        }

        // Init FullCalendar external events
        // $('#external-events .fc-event').each(function() {
        //     $(this).data('event', {
        //         title: $.trim($(this).text()), // element's text = event title
        //         stick: true,
        //         className: 'fc-event-' + $(this).attr('data-event')
        //     });

        //     // make event draggable
        //     $(this).draggable({
        //         zIndex: 999,
        //         revert: true,
        //         revertDuration: 0
        //     });

        // });

        // var Calendar = $('#calendar');
        // var Picker = $('.inline-mp');

        // Init FullCalendar
        // Calendar.fullCalendar({
        //     dayNamesShort: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        //     header: {
        //         left: 'prev,next today',
        //         center: 'title',
        //         right: 'month,agendaWeek,agendaDay'
        //     },
        //     editable: true,
        //     firstDay: 1,
        //     events: [{
        //         title: 'International Literacy Day 2016',
        //         start: '2016-03-04',
        //         end: '2016-03-04',
        //         className: 'fc-event-default'
        //     },{
        //         title: 'International Literacy Day 2016',
        //         start: '2016-03-28',
        //         end: '2016-03-28',
        //         className: 'fc-event-default'
        //     },{
        //         title: 'Leadership Strategies Conference',
        //         start: '2016-03-5',
        //         end: '2016-03-5',
        //         className: 'fc-event-success'
        //     }, {
        //         title: 'Seminar: Fundamentals of Strategic Planning',
        //         start: '2016-03-13',
        //         end: '2016-03-13',
        //         className: 'fc-event-warning'
        //     }, {
        //         title: 'Project Management Seminar',
        //         start: '2016-03-20',
        //         end: '2016-03-20',
        //         className: 'fc-event-warning'
        //     }, {
        //         title: 'Workshop:Customer Service Workshop',
        //         start: '2016-03-8',
        //         end: '2016-03-8',
        //         className: 'fc-event-primary'
        //     }, {
        //         title: 'Critical Thinking Workshop',
        //         start: '2016-03-9',
        //         end: '2016-03-9',
        //         className: 'fc-event-primary'
        //     }, {
        //         title: 'International Labor Day 2016',
        //         start: '2016-03-21',
        //         end: '2016-03-21',
        //         className: 'fc-event-alert'
        //     }, {
        //         title: 'Meeting: Leading Your Team to Success',
        //         start: '2016-03-23',
        //         end: '2016-03-23',
        //         className: 'fc-event-alert'
        //     }, {
        //         title: 'Tools and Techniques for Mastering Data',
        //         start: '2016-03-29',
        //         end: '2016-03-29',
        //         className: 'fc-event-success'
        //     },{
        //         title: 'Leadership Strategies Conference',
        //         start: '2016-03-15',
        //         end: '2016-03-15',
        //         className: 'fc-event-success'
        //     }, {
        //         title: 'Seminar: Fundamentals of Strategic Planning',
        //         start: '2016-03-25',
        //         end: '2016-03-25',
        //         className: 'fc-event-warning'
        //     }, {
        //         title: 'Project Management Seminar',
        //         start: '2016-03-19',
        //         end: '2016-03-19',
        //         className: 'fc-event-warning'
        //     }, {
        //         title: 'Workshop:Customer Service Workshop',
        //         start: '2016-03-18',
        //         end: '2016-03-18',
        //         className: 'fc-event-primary'
        //     }, {
        //         title: 'Critical Thinking Workshop',
        //         start: '2016-03-14',
        //         end: '2016-03-14',
        //         className: 'fc-event-primary'
        //     }, {
        //         title: 'International Labor Day 2016',
        //         start: '2016-03-22',
        //         end: '2016-03-22',
        //         className: 'fc-event-alert'
        //     }, {
        //         title: 'Meeting: Leading Your Team to Success',
        //         start: '2016-03-24',
        //         end: '2016-03-24',
        //         className: 'fc-event-alert'
        //     }, {
        //         title: 'Tools and Techniques for Mastering Data',
        //         start: '2016-03-30',
        //         end: '2016-03-30',
        //         className: 'fc-event-success'
        //     }
        //     ],
        //     viewRender: function(view) {
        //         // Update monthpicker date on change
        //         if (Picker.hasClass('hasMonthpicker')) {
        //             var selectedDate = Calendar.fullCalendar('getDate');
        //             var formatted = moment(selectedDate, 'MM-DD-YYYY').format('MM/YY');
        //             Picker.monthpicker("setDate", formatted);
        //         }
        //         // Update mini calendar title
        //         var titleContainer = $('.fc-title-clone');
        //         if (!titleContainer.length) {
        //             return;
        //         }
        //         titleContainer.html(view.title);
        //     },
        //     droppable: true, // allow dropping on the calendar
        //     drop: function() {
        //         if (!$(this).hasClass('event-recurring')) {
        //             $(this).remove();
        //         }
        //     },
        //     eventRender: function(event, element) {
        //         // create event tooltip
        //         $(element).attr("data-original-title", event.title);
        //         $(element).tooltip({
        //             container: 'body',
        //             delay: {
        //                 "show": 100,
        //                 "hide": 200
        //             }
        //         });
        //         // Set tooltip auto close timer
        //         $(element).on('show.bs.tooltip', function() {
        //             var autoClose = setTimeout(function() {
        //                 $('.tooltip').fadeOut();
        //             }, 3500);
        //         });
        //     }
        // });

        // Link MonthPicker to Calendar after init
        // Picker.monthpicker({
        //     prevText: '<i class="fa fa-chevron-left"></i>',
        //     nextText: '<i class="fa fa-chevron-right"></i>',
        //     showButtonPanel: false,
        //     onSelect: function(selectedDate) {
        //         var formatted = moment(selectedDate, 'MM/YYYY').format('MM/DD/YYYY');
        //         Calendar.fullCalendar('gotoDate', formatted)
        //     }
        // });


        // Init Calendar Modal
        $('#compose-event-btn').magnificPopup({
            removalDelay: 500,
            callbacks: {
                beforeOpen: function(e) {
                    // Indicate active overlay with class
                    $('body').addClass('mfp-bg-open');
                    this.st.mainClass = this.st.el.attr('data-effect');
                },
                afterClose: function(e) {
                    $('body').removeClass('mfp-bg-open');
                }
            },
            midClick: true
        });

        // Init Date picker
        $("#eventDate").datepicker({
            numberOfMonths: 1,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            showButtonPanel: false,
            beforeShow: function(input, inst) {
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
