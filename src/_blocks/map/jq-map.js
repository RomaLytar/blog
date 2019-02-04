(function(){
  const mapElement = document.querySelector(`[data-map]`);

  if (mapElement) {
    const mapType = mapElement.dataset.map,
          mapStyle = [{"featureType":"all","elementType":"geometry.fill","stylers":[{"color":"#ff0000"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.stroke","stylers":[{"color":"#ff0000"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"saturation":"1"},{"lightness":"1"},{"gamma":"0.82"},{"color":"#e3f0ff"}]},{"featureType":"landscape","elementType":"labels.text","stylers":[{"color":"#c9312d"},{"visibility":"on"},{"weight":"1.00"}]},{"featureType":"landscape","elementType":"labels.text.fill","stylers":[{"color":"#c9312d"}]},{"featureType":"landscape","elementType":"labels.icon","stylers":[{"color":"#c9312d"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"hue":"#ff0000"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#6a9cd3"}]}],
          scale = parseFloat(mapElement.dataset.mapScale) || 11,
          drag = true,
          scroll = false,
          geolocation = mapElement.dataset.geolocation,
          zoomAuto = mapElement.dataset.autoZoom || false,
          villaCoordinate = mapElement.dataset.coordinateVilla,
          apartmentCoordinate = mapElement.dataset.coordinateApartment,
          bounds  = new google.maps.LatLngBounds();

    let apartmentCoordinateSplit,
        apartmentObj,
        apartmentMarker;

    if (apartmentCoordinate) {
      apartmentCoordinateSplit = mapElement.dataset.coordinateApartment.split(",");
      apartmentObj = {
        lat: parseFloat(apartmentCoordinateSplit[0].trim()),
        lang: parseFloat(apartmentCoordinateSplit[1].trim())
      };

      apartmentMarker = new google.maps.Marker({
        position: {lat: apartmentObj.lat, lng: apartmentObj.lang},
        map: map,
        icon: {
          url: `/wp-content/themes/albania/img/map/markerApartment.png`,
          size: new google.maps.Size(66, 90),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(33, 90)
        },
        title: `TIGRANA Hospilaty service - Apartments`,
        zIndex: 9999
      });

      if (zoomAuto) {
        bounds.extend(new google.maps.LatLng(apartmentMarker.position.lat(), apartmentMarker.position.lng()));
      }
    }

    let map = new google.maps.Map(mapElement, {
      zoom: scale,
      center: new google.maps.LatLng(apartmentObj.lat, apartmentObj.lang),
      panControl: false,
      zoomControl: false,
      mapTypeControl: false,
      streetViewControl: false,
      draggable: drag,
      styles: mapStyle,
      scrollwheel: scroll
    });

    if (apartmentCoordinate) apartmentMarker.setMap(map);

    if (geolocation) {
      const dataRouteBtn = document.querySelector(`[data-map-route]`),
            directionsDisplay = new google.maps.DirectionsRenderer,
            directionsService = new google.maps.DirectionsService,
            request = {
              destination:  new google.maps.LatLng(apartmentObj.lat, apartmentObj.lang),
              travelMode: google.maps.DirectionsTravelMode.DRIVING
            };

      if (!dataRouteBtn) return false;

      dataRouteBtn.addEventListener(`click`, (e) => {
        if (dataRouteBtn.dataset.mapRoute == `true`) return false;

        if (navigator.geolocation){
          navigator.geolocation.getCurrentPosition(function(pos){
            request.origin = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);

            directionsService.route(request, function(response, status) {
              if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
              }
            });
            directionsDisplay.setMap(map);
          });
        } else {
          directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(response);
            }
          });
          directionsDisplay.setMap(map);
        }

        google.maps.event.addListener(map, "click", function(event) {
          request.origin = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
          directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(response);
            }
          });
        });
      });
    }

    if (mapType) {
      let markers = [];
      const mapBtnMarker = document.querySelectorAll(`[data-btn-map-marker]`),
            objArr = JSON.parse(mapElement.dataset.mapItems),
            setMarker = (item) => {
              const createMapObject = (item) => {
                const image = {
                  url: `${window.location.origin}/wp-content/themes/albania/img/map/icons/marker/icon-marker-${item.type}.svg`,
                  size: new google.maps.Size(38, 60),
                  anchor: new google.maps.Point(19, 60),
                  origin: new google.maps.Point(0, 0)
                },
                marker = new google.maps.Marker({
                  position: {lat: parseFloat(item.lat), lng: parseFloat(item.lng)},
                  map: map,
                  icon: image,
                  title: item.title
                });

                if (zoomAuto) {
                  bounds.extend(new google.maps.LatLng(marker.position.lat(), marker.position.lng()));
                }

                return marker;
              };

              const mapObj = createMapObject(item);

              markers.push(mapObj);
              mapObj.setMap(map);
            },
            deleteMarkers = () => {
              markers.forEach(item => item.setMap(null));
              markers = [];
            };

      [...mapBtnMarker].forEach(item => {
        item.addEventListener(`click`, (e) => {
          const btnType = item.dataset.btnMapMarker.split(`-`)[1];

          deleteMarkers();

          if (item.dataset.active == `true`) {
            [...mapBtnMarker].forEach(item => item.removeAttribute(`data-active`));
            objArr.forEach(item => setMarker(item));
          } else {
            [...mapBtnMarker].forEach(item => item.removeAttribute(`data-active`));
            item.dataset.active = true;

            objArr.forEach(item => {
              if (item.type != btnType) return false;

              setMarker(item);
            });
          }

          document.querySelector(`[data-location-infra]`).removeAttribute(`data-active`);
        });
      });

      objArr.forEach(item => setMarker(item));
    }

    if (zoomAuto) {
      map.fitBounds(bounds);
      map.panToBounds(bounds);
    }
  }
})();
