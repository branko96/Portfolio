function sucursal1() {
    var latlng = new google.maps.LatLng(-38.733197, -62.284919); 

    var options = {
      zoom: 18, 
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById('sucColon'), options);
    var image = new google.maps.MarkerImage('/images/marker.png',
      new google.maps.Size(44, 61),
      new google.maps.Point(0,0),
      new google.maps.Point(44, 61)
    );
    var marker1 = new google.maps.Marker({
      position: new google.maps.LatLng(-38.733200, -62.284850),
      map: map,
      icon: image 
    });

    google.maps.event.addListener(marker1, 'click', function() {
      infowindow1.open(map, marker1);
    });

    var infowindow1 = new google.maps.InfoWindow({
      content: createInfo('Servipetro', 'Av Colón 1645. Bahía Blanca')
    });
    function createInfo(title, content) {
      return '<div class="infowindow"><strong>'+ title +'</strong><br>'+content+'</div>';
    }
}

function sucursal2() {
    var latlng = new google.maps.LatLng(-38.733317, -62.286149); 

    var options = {
      zoom: 18, 
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById('sucJujuy'), options);
    var image = new google.maps.MarkerImage('/images/marker.png',
      new google.maps.Size(44, 61),
      new google.maps.Point(0,0),
      new google.maps.Point(44, 61)
    );
    var marker1 = new google.maps.Marker({
      position: new google.maps.LatLng(-38.733317, -62.286109),
      map: map,
      icon: image 
    });

    google.maps.event.addListener(marker1, 'click', function() {
      infowindow1.open(map, marker1);
    });

    var infowindow1 = new google.maps.InfoWindow({
      content: createInfo('Servipetro', 'Jujuy 55. Bahía Blanca')
    });
    function createInfo(title, content) {
      return '<div class="infowindow"><strong>'+ title +'</strong><br>'+content+'</div>';
    }
};

sucursal1();
sucursal2();