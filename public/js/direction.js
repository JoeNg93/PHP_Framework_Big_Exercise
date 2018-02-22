var map = null;

function initMap() {
    map = new google.maps.Map($('#map')[0], {
        center: {lat: 65.0120888, lng: 25.46507719996},
        zoom: 13
    });

    var directionsService = new google.maps.DirectionsService();
    directionsService.route(
        {
            origin: from,
            destination: to,
            travelMode: google.maps.DirectionsTravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC
        },
        function (response, status) {
            if (status === google.maps.DirectionsStatus.OK) {
                var directionsRenderer = new google.maps.DirectionsRenderer({
                    map: map,
                    directions: response
                });
            }
        }
    );
}
