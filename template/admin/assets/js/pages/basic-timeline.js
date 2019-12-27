'use strict';
//  Author: ThemeREX.com
//  basic-timeline.html scripts
//

(function ($) {

    $(document).ready(function () {

        "use strict";

        // Init Theme Core
        Core.init();

        // Init Demo JS
        Demo.init();


        // Initialize Gmap
        if ($('#map_canvas1').length) {
            $('#map_canvas1').gmap({
                'center': '40.7127837,-74.00594130000002',
                'zoom': 11,
                styles : 
                    [
                        {
                            "featureType": "administrative",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#444444"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.province",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.province",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#ff0000"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.province",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#ffffff"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.province",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.province",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#285f53"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.province",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.locality",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.locality",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#285f53"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.locality",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.neighborhood",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#285f53"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#f7f7f7"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "saturation": -100
                                },
                                {
                                    "lightness": 45
                                },
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#ffffff"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "simplified"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "color": "#cadce6"
                                },
                                {
                                    "visibility": "on"
                                }
                            ]
                        }
                    ],
                'disableDefaultUI': true,
                'callback': function() {
                    // var self = this;
                    // self.addMarker({
                    //     'position': this.get('map').getCenter()
                    // }).click(function() {
                    //     self.openInfoWindow({
                    //         'content': 'Welcome to New York!'
                    //     }, this);
                    // });
                }
            });
        }

        function runVectorMaps() {

            // Jvector Map
            var runJvectorMap = function () {
                // Set data
                var mapData = [900, 700, 350, 500];
                // Init map
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

        runVectorMaps();

        // Timeline toggle
        $('#timeline-toggle').on('click', function () {
            $('#timeline').toggleClass('timeline-single');
            Holder.run();
        });

        // Attach debounced resize handler
        var rescale = function () {
            if ($(window).width() < 1250) {
                $('#timeline').addClass('timeline-single');
                $('#timeline-toggle').hide();
            } else {
                $('#timeline').removeClass('timeline-single');
                $('#timeline-toggle').show();
            }
            Holder.run();
        };
        var lazyLayout = _.debounce(rescale, 300);

        // Rebuild on resize
        $(window).resize(lazyLayout);
        rescale();

        // Summernote
        $('.summernote-quick').summernote({
            height: 179,
            focus: false,
            toolbar: [
                ['style', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });

        // Init Magnific Popup
        $('a.gallery-item').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });

})(jQuery);
