/**
 * Created by IRINA on 25.04.2017.
 */
var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 47.1559935, lng: 27.5905457},
        zoom: 20,
        disableDefaultUI: true,
    });

    var iconBase = 'http://icons.iconarchive.com/icons/martin-berube/people/24/';
    var marker = new google.maps.Marker({
        position: {lat: 47.1559988, lng: 27.5906657},
        title:"Aici este copilul tau!",
        icon: iconBase + 'child-icon.png'
    });

    var contentString = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h1 id="firstHeading" class="firstHeading">Copilul tau: Adrian</h1>'+
        '<div id="bodyContent">'+
        '<p>Informatii legate de pozitia copilului tau nu sunt disponibile!</p>'+
        '</div>'+
        '</div>';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

    marker.setMap(map);
}
