function addDays(days) {
    let inputField = $("#quantity");
    let newDays = parseInt(inputField.val()) + days;
    if(newDays < 1) newDays = 1;
    inputField.val(newDays);
}

// open streetmap integration with leaflet
$(function(){
    "use strict"; 
  // osm-map the id of div area where map should be shown
  var element = document.getElementById('osm-map');
  
  // lat & long of center of map and marker 
  var lat = '48.210033';
  var long =  '16.363449';
  
  // html info for popup on marker
  popupHtml = '<b>Company Bro</b><br><br> Bro Street 1<br>A-1010 City<br>and we may place also a small image<img src="assets/img/yourimage for popup.jpeg" width="100%" />';
  
  // Height can be set. Is done by style or css too.
  // element.style = 'height:400px;';
  
  // Create Leaflet map on map element.
  var map = L.map(element, {scrollWheelZoom: false });
  
  // Add Openstreetmap tile layer with attribution to the Leaflet map.
  // this is important and worth to honor openstreetmap contributors
  L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);
  
  // Your target's GPS coordinates.
  var target = L.latLng( lat , long );
  
  // Set map's center to target with zoom 15.
  map.setView(target, 15);
  
  // Place a marker on the same location.
  L.marker(target).addTo(map)
      .bindPopup(popupHtml,  '{keepInView: true}')
      .openPopup();
  
  // Optional, but useful: change behaviour of autoscrollwheel
  // only zoom after click, no autozoom on focus
  map.scrollWheelZoom.disable();
  map.on('click', () => { map.scrollWheelZoom.enable();});
  map.on('mouseout', () => { map.scrollWheelZoom.disable();});
  });


  function initializeMap(){
    var map = L.map('map', {
        center: [51.505, -0.09],
        zoom: 13
    });

  }