/**
 * Created by IRINA on 28.05.2017.
 */
$(document).ready(function(){

    $('#marker-type-select').on('change', function(){
        var movable = $('#marker-movable-select');
        var value = $(this).val();

        if(value === 'animal' || value === 'child'){
            movable.val('1');
        }else if(value === 'object'){
            movable.val('0');
        }
    });

    $('#save-config').click(function(){
        $.ajax({
            url: 'http://localhost/KiMo/api/markers/add/token/' + session.user.user_token,
            method: 'POST',
            data: $('#modal-config-form').serialize(),
            dataType: 'json',
            success: function(data){
                if(typeof(data.error) == 'undefined'){
                    $('.configMarkerFormErrorMessage').css({'display': 'none'});
                var marker;

                markers.forEach(function(item, idx){
                    if(item.id == $('#modal-config-form').attr('data-marker-id')){
                        marker = item;
                    }
                });

                var title = $('#modal-config-form').find('#marker-title').val();

                if(data == 1){

                    var selectedMarkerType = $('#modal-config-form').find('#marker-type-select').val();

                    var newContent = '<div class="content">'+
                        '<div class="siteNotice">'+'</div>'+
                        '<h1 class="firstHeading">'+ title +'</h1>'+
                        '<div class="bodyContent">'+
                        '<h1>' +
                        '<button class="btn btn-danger remove-marker-btn" onclick="removeMarker(' + marker.id + ')">Elimina</button>' +
                        '</h1>' +
                        '</div>'+
                        '</div>';
                    if(selectedMarkerType === 'child'){
                        marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');
                    }else if(selectedMarkerType === 'object'){
                        marker.setIcon('http://maps.google.com/mapfiles/ms/icons/blue-dot.png');
                    }else if(selectedMarkerType === 'animal'){
                        marker.setIcon('http://maps.google.com/mapfiles/ms/icons/orange-dot.png');
                    }

                    marker.title = $('#modal-config-form').find('#marker-title').val();
                    marker.type = selectedMarkerType;
                    marker.movable = $('#modal-config-form').find('#marker-movable-select').val();

// uncomment this part to make markers draggable
/*
                    if(marker.movable == '0'){
                        marker.setDraggable(false);
                    }else{
                        marker.setDraggable(true);
                    }
 */
                    infoWindow[marker.id].setContent(newContent);

                    $('#myModal').modal('hide');
                }else{
                    marker.lines.forEach(function(item, idx){
                        item.setMap(null);
                    });
                    marker.circle.setMap(null);
                    marker.setMap(null);
                }
                }else{
                    $('.configMarkerFormErrorMessage').text(data.errorMessage).css({'display': 'block'});
                }
            }
        });
    });
});