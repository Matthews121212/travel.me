function addDays(days) {
    let inputField = $("#quantity");
    let newDays = parseInt(inputField.val()) + days;
    if(newDays < 1) newDays = 1;
    inputField.val(newDays);
}

// Create map
var map = L.map('map').setView([41.8902338,12.4907832], 13);
let searchList  = new Array();
var elementList 

// Map layer
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var foro = L.marker([41.8903461,12.4895719]).addTo(map)
    .bindPopup('Foro Romano')
    .openPopup();

// per cancellarlo basta fare foro.remove()

function findPlace(){
    if(document.getElementById("search-place").value.length <=3)
        return;

    $(".list-search-element").remove();

    const place = encodeURI(document.getElementById("search-place").value);
    console.log('https://nominatim.openstreetmap.org/search?q='+place+'&format=json&addressdetails=1$limit=10');
    $.getJSON('https://nominatim.openstreetmap.org/search?q='+place+'&format=json&addressdetails=1&limit=10', function(data) {
        var items = [];
        

        $.each( data, function(key, val) {
            $(".list-result").append('<li class="list-group-item list-search-element" >' + val["display_name"] + "</li>" )
          });
    })
}