// Create map
var map = L.map('map').setView([41.8902338,12.4907832], 13);
let searchList  = new Array();
var elementList 
var itineraryDays = new Array();

function addDays(days) {
    let inputField = $("#quantity");
    let newDays = parseInt(inputField.val()) + days;
    if(newDays < 1) newDays = 1;
    inputField.val(newDays);
}

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

            $(".list-result").append(' <div class="row list-search-element"> <div class="col"> <li class="list-group-item " > ' + val["display_name"] + '</li> </div> <div class="col">  <button class="btn btn-secondary"> <i class="bi bi-arrow-bar-down"></i> </button> </div> <div class="col">  <button class="btn btn-secondary"> <i class="bi bi-arrow-bar-up"></i> </button> </div> </div>')
          });
    })
}


function addItineraryDays(){


    $(".itinerary-days").append(' <li class="list-group-item d-flex-row"> <div class="container d-flex py-4"> <p class="p-0 m-0 flex-grow-1">Day ' + itineraryDays.length +'</p> <button class="btn btn-secondary" onclick=moveUp()> <i class="bi bi-arrow-bar-up"></i> </button> <button class="btn btn-secondary" onclick=moveDown()> <i class="bi bi-arrow-bar-down"></i> </button> <button class="btn btn-secondary" onclick=removePlace()> <i class="bi bi-x-lg"></i> </button> </div> <div class="container list-Place"> <ul class="list-group list-group-numbered place-list"> </ul> </div> </li>')
    itineraryDays.append("Day " + itineraryDays.length +1 )
}

function removeItineraryDays(){


}

function moveUp(){


}

function moveDown(){

    
}