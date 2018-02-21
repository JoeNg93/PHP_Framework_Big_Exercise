var map = null;

function initMap() {
    map = new google.maps.Map($('#map')[0], {
        center: {lat: 65.0120888, lng: 25.46507719996},
        zoom: 13
    });

    if (locations) {
        var newlyAddedLocation = locations[locations.length - 1];
        map.setCenter({lat: newlyAddedLocation.lat, lng: newlyAddedLocation.lng});
        locations.forEach(function (location) { addMarker(location) });
    }
}

function addMarker(location) {
    var marker = new google.maps.Marker({
        position: {lat: location.lat, lng: location.lng},
        animation: google.maps.Animation.DROP,
        map: map
    });
}