/**
 * Created by IRINA on 25.04.2017.
 */
function initialize(){
    var position = new google.maps.LatLng(47.1739724, 27.5749111);
    // bounds.extend(position);
    var mapOptions = {
        zoom: 17,
        center: position,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    /*google.maps.event.addListener(map, 'click', function () {
     circles.forEach(function(item, idx){
     item.setMap(null);
     });
     });*/

    var marker = new google.maps.Marker({
        position: position,
        map: map,
        icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
    });

    marker.id = 0;
    marker.type = 'target';

    var contentString = '<div class="content">'+
        '<div class="siteNotice">'+'</div>'+
        '<h1 class="firstHeading">Tu</h1>'+
        '<div class="bodyContent">'+
        '<p>Te afli aici!</p>'+
        '</div>'+
        '</div>';

    infoWindow[marker.id] = new google.maps.InfoWindow({
        content: contentString
    });

    markers[marker.id] = marker;

    google.maps.event.addListener(marker, 'click', function () {
        infoWindow[marker.id].open(map, marker);
        removeOthersCircles();
        var circle = new google.maps.Circle({
            map: map,
            radius: 200,
            strokeColor: "#AA0000",
            strokeOpacity: 0.5,
            strokeWeight: 1,
            fillColor: '#AA0000',
            fillOpacity: 0.2,
        });
        circles.push(circle);
        markers[marker.id].circle = circle;
        circle.bindTo('center', marker, 'position');
    });
}

function initMap(){

    $('#myModal').modal({
        show: false
    });

    bounds = new google.maps.LatLngBounds();

    initialize();
    console.log(session);
    $.ajax({
        type: 'GET',
        url: 'http://localhost/KiMo/api/markers/get/token/' + session.user.user_token,
        data: {
            id: session.user.user_id
        },
        dataType: "json",
        success: function(data) {

            if(typeof(data.error) == 'undefined'){

            data.forEach(function(item, index){

                var icon = 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png';

                if(item.type === 'child'){
                    icon = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';
                }else if(item.type === 'animal'){
                    icon = 'http://maps.google.com/mapfiles/ms/icons/orange-dot.png';
                }else if(item.type === 'object'){
                    icon = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
                }

                var activeMarker = markers[0];

                var position = new google.maps.LatLng(parseFloat(item.lat), parseFloat(item.lng));
                var marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: item.title,
                    icon: icon/*,
                    draggable: true*/ // uncomment this to make markers draggable
                });

                marker.movable = item.movable;
                // uncomment this to make markers draggable
                /*if(marker.movable == '0'){
                 marker.setDraggable(false);
                 }else{
                 marker.setDraggable(true);
                 }*/
                var line = new google.maps.Polyline({
                    path: [
                        new google.maps.LatLng(activeMarker.position.lat(), activeMarker.position.lng()),
                        new google.maps.LatLng(item.lat, item.lng)
                    ],
                    strokeColor: "#333",
                    strokeOpacity: 1.0,
                    strokeWeight: 2,
                    map: map
                });

                marker.id = parseInt(item.id);
                marker.type = item.type;
                marker.lines = [];
                marker.lines.push(line);

                var contentString = '<div class="content">'+
                    '<div class="siteNotice">'+'</div>'+
                    '<h1 class="firstHeading">'+ item.title +'</h1>'+
                    '<div class="bodyContent">'+
                    '<button class="btn btn-danger remove-marker-btn" onclick="removeMarker(' + marker.id + ')">Elimina</button>' +
                    '</div>'+
                    '</div>';

                infoWindow[marker.id] = new google.maps.InfoWindow({
                    content: contentString
                });

                google.maps.event.addListener(marker, 'click', (function(marker) {
                    return function() {
                        /*if(
                         typeof(marker.type) != undefined &&
                         marker.type === 'target'
                         ){
                         markers.forEach(function(item, index){
                         if(
                         typeof(item.isActive) != undefined &&
                         item.isActive === true
                         ){
                         item.isActive = false;
                         }
                         });
                         activeMarker = marker;
                         }*/
                        infoWindow[marker.id].open(map, marker);

                        removeOthersCircles();

                        var circle = new google.maps.Circle({
                            map: map,
                            radius: 20,
                            strokeColor: "#FFFF00",
                            strokeOpacity: 0.5,
                            strokeWeight: 1,
                            fillColor: '#FFFF00',
                            fillOpacity: 0.3,
                        });
                        circles.push(circle);
                        marker.circle = circle;
                        circle.bindTo('center', marker, 'position');
                    }
                })(marker));

                google.maps.event.addListener(marker, 'drag', (function(marker) {
                    return function() {
                        // for(var i = 0; i < marker.lines.length; i++){
                        marker.lines.forEach(function(item, index){
                            item.getPath().pop();
                            item.getPath().push(new google.maps.LatLng(marker.position.lat(), marker.position.lng()));
                        });
                    }
                })(marker));

                markers.push(marker);
            });

            }else{
                switch(data.errorCode){
                    case 1000: (function(){
                        $.notify({
                            message: 'Exception occured. Please view the console.'
                        },{
                            type: 'danger'
                        });
                    })();
                        break;
                    case 1001: (function(){
                        $.notify({
                            message: 'User is not logged in.'
                        },{
                            type: 'danger'
                        });
                    })();
                        break;
                    case 1002: (function(){
                        $.notify({
                            message: 'Cannot authenticate user.'
                        },{
                            type: 'danger'
                        });
                    })();
                        break;
                    default: (function(){

                    })();

                        console.log(data.errorMessage);
                }
            }

            google.maps.event.addListener(map, 'click', function(event) {
                placeMarker(event.latLng);
            });

            // simulateMovements();
        }
    });

    updateNotifications();
}

function placeMarker(location) {
    var marker = new google.maps.Marker({
        position: location,
        map: map,
        icon: 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png'/*,
         draggable: true*/ // uncomment this to make markers draggable
    });

    var activeMarker = markers[0];

    /*markers.forEach(function(item, index){
     if(
     typeof(item.isActive) != undefined &&
     item.isActive === true
     ){
     activeMarker = item;
     }
     });*/

    var line = new google.maps.Polyline({
        path: [
            new google.maps.LatLng(activeMarker.position.lat(), activeMarker.position.lng()),
            location
        ],
        strokeColor: "#333",
        strokeOpacity: 1.0,
        strokeWeight: 2,
        map: map
    });

    marker.id = markers[markers.length - 1].id + 1;
    marker.lines = [];
    marker.lines.push(line);
    markers.push(marker);

    var contentString = '<div class="content">'+
        '<div class="siteNotice">'+'</div>'+
        '<div class="bodyContent">'+
        '<h1>' +
        '<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success configure-marker-btn" onclick="configMarker(' + marker.id + ')">Configureaza</button>' +
        '<button class="btn btn-danger remove-marker-btn" onclick="removeMarker(' + marker.id + ')">Elimina</button>' +
        '</h1>' +
        '</div>'+
        '</div>';

    infoWindow[marker.id] = new google.maps.InfoWindow({
        content: contentString
    });

    // $('#modal-config-form').attr('data-marker-id', marker.id);

    google.maps.event.addListener(marker, 'click', (function(marker) {
        return function() {
            /*if(
             typeof(marker.type) != undefined &&
             marker.type === 'target'
             ){
             markers.forEach(function(item, index){
             if(
             typeof(item.isActive) != undefined &&
             item.isActive === true
             ){
             item.isActive = false;
             }
             });
             activeMarker = marker;
             }*/
            $('#modal-config-form').attr('data-marker-id', marker.id);

            infoWindow[marker.id].open(map, marker);

            removeOthersCircles();

            var circle = new google.maps.Circle({
                map: map,
                radius: 20,
                strokeColor: "#FFFF00",
                strokeOpacity: 0.5,
                strokeWeight: 1,
                fillColor: '#FFFF00',
                fillOpacity: 0.3,
            });
            circles.push(circle);
            /*var mrk;
             markers.forEach(function(item, index){
             if(item.id == marker.id){
             mrk = item;
             }
             });
             mrk.circle = circle;*/
            marker.circle = circle;
            circle.bindTo('center', marker, 'position');
        }
    })(marker));

    google.maps.event.addListener(marker, 'drag', (function(marker) {
        return function() {
            // for(var i = 0; i < marker.lines.length; i++){
            marker.lines.forEach(function(item, index){
                item.getPath().pop();
                item.getPath().push(new google.maps.LatLng(marker.position.lat(), marker.position.lng()));
            });
        }
    })(marker));
}

function removeMarker(index){
    var marker;
    var indexOfMarker = -1;
    markers.forEach(function(item, idx){
        if(item.id === index){
            marker = item;
            indexOfMarker = markers.indexOf(marker);
        }
    });

    $.ajax({
        url: 'http://localhost/KiMo/api/markers/delete/id/' + marker.id + '/token/' + session.user.user_token,
        method: 'DELETE',
        success: function(data){

            if(typeof(data.error) == 'undefined'){
            if(data == 1){
                marker.lines.forEach(function(item, index){
                    item.setMap(null);
                });
                marker.circle.setMap(null);
                marker.setMap(null);
                markers.splice(indexOfMarker, 1);
                infoWindow[marker.id] = undefined;}
            }else{
                switch(data.errorCode){
                    case 1000: (function(){
                        $.notify({
                            message: 'Exception occured. Please view the console.'
                        },{
                            type: 'danger'
                        });
                    })();
                        break;
                    case 1001: (function(){
                        $.notify({
                            message: 'User is not logged in.'
                        },{
                            type: 'danger'
                        });
                    })();
                        break;
                    case 1002: (function(){
                        $.notify({
                            message: 'Cannot authenticate user.'
                        },{
                            type: 'danger'
                        });
                    })();
                        break;
                    default: (function(){

                    })();

                        console.log(data.errorMessage);
                }
            }
        }
    });
}

function configMarker(index){
    var marker;
    markers.forEach(function(item, idx){
        if(item.id === index){
            marker = item;
            return;
        }
    });

    $('input[name="id"]').val(marker.id);
    $('input[name="lat"]').val(marker.position.lat());
    $('input[name="lng"]').val(marker.position.lng());
}

function removeOthersCircles(){
    circles.forEach(function(item, idx){
        item.setMap(null);
    });
}

function updateNotifications(){
    setInterval(function(){

        markers.forEach(function(marker, index){
            if(marker.movable == 1){
                $.ajax({
                    url: 'http://localhost/KiMo/api/markers/get/id/' + marker.id + '/token/' + session.user.user_token,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data){
                        var newPosition = new google.maps.LatLng(parseFloat(data[0].lat), parseFloat(data[0].lng));
                        marker.setPosition(newPosition);
                        marker.lines.forEach(function(item, idx){
                            item.getPath().pop();
                            item.getPath().push(newPosition);
                        });

                        markers.forEach(function(item, idx){
                            if(
                                item.id != marker.id &&
                                marker.type === 'child'
                            ){
                                var betweenDistance = google.maps.geometry.spherical.computeDistanceBetween(
                                    new google.maps.LatLng(item.position.lat(), item.position.lng()),
                                    newPosition
                                );

                                var id = item.id.toString() + marker.id.toString();

                                if(item.type != 'target'){
                                    if(betweenDistance < 40){
                                        var notification = {'item1': item, 'item2': marker, 'type': 'interaction'};
                                        notifications[id] = notification;
                                    }
                                }else if(item.type === 'target'){
                                    if(betweenDistance > 200){
                                        var notification = {'item1': item, 'item2': marker, 'type': 'outOfRange'};
                                        notifications[id] = notification;
                                    }
                                }
                            }
                        });
                    }
                });
            }
        });

        var notificationsHtml = '';
        var count = 0;

        for (var property in notifications) {
            if (
                notifications.hasOwnProperty(property) &&
                typeof(property.item1) != undefined &&
                typeof(property.item2) != undefined
            ) {
                count++;
                if(notifications[property].type === 'interaction'){
                    notificationsHtml += '<li class="notification">' + notifications[property].item2.title + ' este langa ' + notifications[property].item1.title + '</li>';
                }else if(notifications[property].type === 'outOfRange'){
                    notificationsHtml += '<li class="notification">' + notifications[property].item2.title + ' nu mai este in vizor</li>';
                }
            }
        }

        $('#dropdownMenu1 .badge').text(count);

        $('.notification-btn .dropdown-menu').html(notificationsHtml);

        notifications = [];
    }, 1000);
}