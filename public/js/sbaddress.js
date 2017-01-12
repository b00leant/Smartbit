$.fn.searchAddress = function(){
  $('ul.dropdown-content').empty();
  $('input.autocomplete.address').keyup(function(){
    var $autocomplete = $('<ul class="autocomplete-content dropdown-content"></ul>');
    var $input = $(this).val();
    if($input!=''){
      $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
          });
      $.ajax({
        url:'https://maps.googleapis.com/maps/api/geocode/json',
        type: 'GET',
        data:{
            'key':'AIzaSyAAK6y8tZ4VlyEKfCUzV7LvxTNLN6Me6S8',
            'address':$input
        },
        success: function(result){
          console.log(result);
          $autocomplete.empty();
          $('ul.dropdown-content').empty();
          $('input.autocomplete.address').after($autocomplete);
          var length = result.results.length;
          var markers = [];
          if(result.results.length > 0){
            for(var i = 0; i < length; i++) {
              var it_lat = result.results[i].geometry.location.lat;
              var it_lng = result.results[i].geometry.location.lng;
              markers.push({'lat':it_lat,'lng':it_lng});
              if(i<2){
                var autocompleteOption = $('<li data-lat="'+it_lat+'" data-lng="'+it_lng+'" data-formatted="'+result.results[i].formatted_address+'"></li>');
                autocompleteOption.append('<span style="text-align: center">'+result.results[i].formatted_address+'</span>');
                $autocomplete.append(autocompleteOption);
              }
            }
            //center of preview
            var lat = result.results[0].geometry.location.lat;
            var lng = result.results[0].geometry.location.lng;
            var uluru = {lat: lat, lng: lng};
            //$('div#preview').hide();
            $('div#map').show();
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 12,
              center: uluru,
              disableDefaultUI: true,
              styles: [
                {elementType: 'geometry', stylers: [{color: '#a1887f'}]},
                {elementType: 'labels.text.stroke', stylers: [{color: '#a1887f'}]},
                {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                {
                  featureType: 'administrative.locality',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#212121'}]
                },
                {
                  featureType: 'poi.business',
                  stylers: [{visibility: 'off'}]
                },
                {
                  featureType: 'poi',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#212121'}]
                },
                {
                  featureType: 'poi.park',
                  elementType: 'geometry',
                  stylers: [{color: '#263c3f'}]
                },
                {
                  featureType: 'poi.park',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#6b9a76'}]
                },
                {
                  featureType: 'road',
                  elementType: 'geometry',
                  stylers: [{color: '#38414e'}]
                },
                {
                  featureType: 'road',
                  elementType: 'geometry.stroke',
                  stylers: [{color: '#212a37'}]
                },
                {
                  featureType: 'road',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#9ca5b3'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'geometry',
                  stylers: [{color: '#746855'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'geometry.stroke',
                  stylers: [{color: '#1f2835'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#f3d19c'}]
                },
                {
                  featureType: 'transit',
                  elementType: 'geometry',
                  stylers: [{color: '#2f3948'}]
                },
                {
                  featureType: 'transit.station',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#d59563'}]
                },
                {
                  featureType: 'water',
                  elementType: 'geometry',
                  stylers: [{color: '#17263c'}]
                },
                {
                  featureType: 'water',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#515c6d'}]
                },
                {
                  featureType: 'water',
                  elementType: 'labels.text.stroke',
                  stylers: [{color: '#17263c'}]
                }]
              });
            var marker = new google.maps.Marker({
              position: uluru,
              map: map
              });
            for( i = 0; i < markers.length; i++ ) {
              var position = markers[i];
              marker = new google.maps.Marker({
                  position: position,
                  map: map,
              });
            }
            }else{} 
          },
          error: function (xhr, b, c) {
            $('div#map').hide();
            var $insert_person_i = $('a.insert_person i');
            $insert_person_i.text('add');
            }
          });
      }else{
        $('ul.dropdown-content').empty();
        $autocomplete.empty();
        }
        $autocomplete.on('click', 'li', function () {
          $('input.autocomplete.address').val($(this).data('formatted'));
          $('input[name="id"]').val($(this).data('id'));
          $autocomplete.empty();
          $('ul.dropdown-content').empty();
        });
    });
};
function autocompleteAddress(){
        var uluru = {lat: 41.7754297, lng: 12.9219462};
        var map = new google.maps.Map(document.getElementById('maphome'), {
          scrollwheel: false,
          navigationControl: false,
          mapTypeControl: false,
          scaleControl: false,
          draggable: false,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          zoom: 14,
          center: uluru,
          styles: [
                {elementType: 'geometry', stylers: [{color: '#a1887f'}]},
                {elementType: 'labels.text.stroke', stylers: [{color: '#a1887f'}]},
                {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                {
                  featureType: 'administrative.locality',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#212121'}]
                },
                {
                  featureType: 'poi.business',
                  stylers: [{visibility: 'off'}]
                },
                {
                  featureType: 'poi',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#212121'}]
                },
                {
                  featureType: 'poi.park',
                  elementType: 'geometry',
                  stylers: [{color: '#263c3f'}]
                },
                {
                  featureType: 'poi.park',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#6b9a76'}]
                },
                {
                  featureType: 'road',
                  elementType: 'geometry',
                  stylers: [{color: '#38414e'}]
                },
                {
                  featureType: 'road',
                  elementType: 'geometry.stroke',
                  stylers: [{color: '#212a37'}]
                },
                {
                  featureType: 'road',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#9ca5b3'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'geometry',
                  stylers: [{color: '#746855'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'geometry.stroke',
                  stylers: [{color: '#1f2835'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#f3d19c'}]
                },
                {
                  featureType: 'transit',
                  elementType: 'geometry',
                  stylers: [{color: '#2f3948'}]
                },
                {
                  featureType: 'transit.station',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#d59563'}]
                },
                {
                  featureType: 'water',
                  elementType: 'geometry',
                  stylers: [{color: '#17263c'}]
                },
                {
                  featureType: 'water',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#515c6d'}]
                },
                {
                  featureType: 'water',
                  elementType: 'labels.text.stroke',
                  stylers: [{color: '#17263c'}]
                }]
        });
        var image = {
          url: 'http://smartbit.online/images/smartbit_marker.png',
          size: new google.maps.Size(150, 150),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(-75, 75),
          scaledSize: new google.maps.Size(65, 65)
        };
        var marker = new google.maps.Marker({
          icon: image,
          position: uluru,
          map: map
        });
    $('input#addr_complete.autocomplete.address').searchAddress();
}
$('input.autocomplete.address').keyup(function(){
    $('ul.dropdown-content').remove();
});






      


/*
function previewMap(){
  var uluru = {lat: 41.7745041, lng: 12.9190465};
  var map = new google.maps.Map(document.getElementById('preview'), {
              zoom: 12,
              center: uluru,
              disableDefaultUI: true,
              styles: [
                {elementType: 'geometry', stylers: [{color: '#a1887f'}]},
                {elementType: 'labels.text.stroke', stylers: [{color: '#a1887f'}]},
                {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                {
                  featureType: 'administrative.locality',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#212121'}]
                },
                {
                  featureType: 'poi.business',
                  stylers: [{visibility: 'off'}]
                },
                {
                  featureType: 'poi',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#212121'}]
                },
                {
                  featureType: 'poi.park',
                  elementType: 'geometry',
                  stylers: [{color: '#263c3f'}]
                },
                {
                  featureType: 'poi.park',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#6b9a76'}]
                },
                {
                  featureType: 'road',
                  elementType: 'geometry',
                  stylers: [{color: '#38414e'}]
                },
                {
                  featureType: 'road',
                  elementType: 'geometry.stroke',
                  stylers: [{color: '#212a37'}]
                },
                {
                  featureType: 'road',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#9ca5b3'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'geometry',
                  stylers: [{color: '#746855'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'geometry.stroke',
                  stylers: [{color: '#1f2835'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#f3d19c'}]
                },
                {
                  featureType: 'transit',
                  elementType: 'geometry',
                  stylers: [{color: '#2f3948'}]
                },
                {
                  featureType: 'transit.station',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#d59563'}]
                },
                {
                  featureType: 'water',
                  elementType: 'geometry',
                  stylers: [{color: '#17263c'}]
                },
                {
                  featureType: 'water',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#515c6d'}]
                },
                {
                  featureType: 'water',
                  elementType: 'labels.text.stroke',
                  stylers: [{color: '#17263c'}]
                }]
              });
}
*/