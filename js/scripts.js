//Global variables
var itineraryDays = 0;
var itinerary = [];
var map;

function addDays(days) {
    let inputField = $("#quantity");
    let newDays = parseInt(inputField.val()) + days;
    if(newDays < 1) newDays = 1;
    inputField.val(newDays);
}


function createMap(){
    map = L.map('map').setView([41.8902338,12.4907832], 13);
    // Map layer
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // per cancellarlo basta fare markername.remove()
}


function findPlace(){
    if(document.getElementById("search-place").value.length <=3)
        return;

    $(".list-search-element").remove();

    const place = encodeURI(document.getElementById("search-place").value);
    $.getJSON('https://nominatim.openstreetmap.org/search?q='+place+'&format=json&addressdetails=1&accept-language=en&limit=10', function(data) {
        $(".list-result").append('<li class="list-group-item list-search-element"><div class="row"><div class="col fw-bolder">Select Day: </div><div class="col"><input min="1" max="365" value="1" type="number" id="numberDays" class="form-control" onKeyDown="return false" style="width: 5em"></div></div></li>');
        $.each( data, function(key, val) {
            var parameter = val["display_name"].replace(/'/g, "")+'&'+val["lat"] +','+val["lon"]+'';
            $(".list-result").append('<li class="list-group-item list-search-element" ><div class="row"><div class="col">' + val["display_name"] + '</div><div class="col"><button type="button" id="add-button" onclick="addPlaceToDay(\''+parameter+'\')" class="btn-primary btn">Add</button></div></div></li>');
          });
    })
}


function addItineraryDays(days) {
    
    if(days==1){
        var day = [];
        itineraryDays++;
        $(".add-day").append('<div class="row py-3 add-day-'+itineraryDays+'"><label class="ft-2 fw-bolder py-3">Day '+itineraryDays+'</label><div class="container"><ul class="list-group list-group-numbered item-day-'+itineraryDays+'"></ul></div></div>');
        itinerary.push(day); 
    }
    else if(days==-1 && itineraryDays>0){
        $(".add-day-"+itineraryDays+"").remove();
        itinerary.pop();
        itineraryDays--;
    }
}

function addPlaceToDay(parameter){
    var place = parameter.split('&');
    var inputNumber = parseInt(document.getElementById("numberDays").value);
    if(inputNumber>itineraryDays){
        alert(`Select Days error! Your itinerary is only ${itineraryDays} days long!`);
        return false;
    }
    else{
        $(".item-day-"+inputNumber+"").append('<li class="list-group-item"><div class="row"><div class="col">'+place[0]+'</div><div class="col"><button type="button" id="remove-button" onclick="removePlaceToDay(\''+parameter+'\')" class="btn-primary btn">Remove</button></div></div></li>');
        itinerary[inputNumber-1].push(parameter);
        //Ad marker to map
        var coord = place[1].split(',');
        var placeMarker = L.marker([coord[0],coord[1]]).addTo(map)
        .bindPopup(place[0]+'')
        .openPopup();
    }
}

function removePlaceToDay(parameter){
    var index = -1;
    for(var i=0;i<itinerary.length && index==-1;i++){
        index = itinerary[i].indexOf(parameter);
        if(index!=-1){
            itinerary[i].splice(index,1);
        }
    }

}