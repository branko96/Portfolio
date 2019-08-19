      /* Imagenes de Fondo Slider */
      $.backstretch([
          "images/background/BarloventoFrente.jpg"
        , "images/background/Pileta.jpg"
      ], {duration: 5000, fade: 1000});
      /* Fin de Imagenes Fondo Slider */

      /* InfoBox Mapa - -38.692734, -62.276790 */
      var secheltLoc = new google.maps.LatLng(-38.691173, -62.274762);

      var myMapOptions = {
         zoom: 15
        ,scrollwheel: false 
        ,center: secheltLoc
        ,mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      var theMap = new google.maps.Map(document.getElementById("plano"), myMapOptions);

      var marker = new google.maps.Marker({
        map: theMap,
        draggable: true,
        position: new google.maps.LatLng(-38.691173, -62.274762),
        visible: true
      });

      var boxText = document.createElement("div");
      boxText.style.cssText = "border: 1px solid #0066cc; border-radius: 1em; margin-top: 8px; background: #0099cc; padding: 10px; box-shadow: .5em .5em 1em #333; font-size: 1.3em; text-shadow: 1px 1px ##0033cc";
      boxText.innerHTML = '<strong>Barlovento</strong> <br /> Corenfeld (Cuyo) 969, <br /> Bahía Blanca, Buenos Aires <br />Teléfono: (0291) 488 - 3732';

      var myOptions = {
         content: boxText
        ,disableAutoPan: false
        ,maxWidth: 0
        ,pixelOffset: new google.maps.Size(-140, 0)
        ,zIndex: null
        ,boxStyle: { 
          background: "url('http://google-maps-utility-library-v3.googlecode.com/svn/tags/infobox/1.1.9/examples/tipbox.gif') no-repeat"
          ,opacity: 0.75
          ,width: "280px"
         }
        ,closeBoxMargin: "16px 8px 2px 2px;"
        ,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
        ,infoBoxClearance: new google.maps.Size(1, 1)
        ,isHidden: false
        ,pane: "floatPane"
        ,enableEventPropagation: false
      };


      google.maps.event.addListener(marker, "click", function (e) {
        ib.open(theMap, this);
      });

      var ib = new InfoBox(myOptions);
      ib.open(theMap, marker);;
      /* Fin: InfoBox Mapa */