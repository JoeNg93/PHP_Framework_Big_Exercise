var map = null;

function initMap() {
    map = new google.maps.Map($('#map')[0], {
        center: {lat: 65.0120888, lng: 25.46507719996},
        zoom: 13
    });

    if (locations.length) {
        var newlyAddedLocation = locations[locations.length - 1];
        map.setCenter({lat: newlyAddedLocation.lat, lng: newlyAddedLocation.lng});
        locations.forEach(function (location) {
            addMarker(location)
        });
    }
}

function addMarker(location) {
    var marker = null;
    if (location.markerType) {
        if (location.markerType === 'dot' || location.markerType === 'pushpin') {
            marker = new google.maps.Marker({
                position: {lat: location.lat, lng: location.lng},
                animation: google.maps.Animation.DROP,
                icon: 'https://maps.google.com/mapfiles/ms/micons/' + location.markerColor + '-' + location.markerType + '.png',
                map: map
            });
        } else {
            marker = new google.maps.Marker({
                position: {lat: location.lat, lng: location.lng},
                animation: google.maps.Animation.DROP,
                icon: 'https://maps.google.com/mapfiles/ms/micons/' + location.markerType + '.png',
                map: map
            });
        }
    }

    marker.addListener('click', function () {
        var infowindow = new google.maps.InfoWindow({
            content: "Lat: " + location.lat + " - Lng: " + location.lng + " - Info: " + location.info
        });
        infowindow.open(map, marker);
    });
}