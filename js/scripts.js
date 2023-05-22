//Global variables
var itineraryDays = 0;
var itinerary = [];
var markers = [];
var map;

function addDays(days) {
    let inputField = $("#quantity");
    let newDays = parseInt(inputField.val()) + days;
    if(newDays < 1) newDays = 1;
    inputField.val(newDays);
}


function createMap(){
    map.append(L.map('map').setView([41.8902338,12.4907832], 13));
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
            $(".list-result").append('<li class="list-group-item list-search-element" ><div class="row"><div class="col">' + val["display_name"].replace(/'/g, "") + '</div><div class="col"><button type="button" id="add-button" onclick="addPlaceToDay(\''+parameter+'\')" class="btn-primary btn">Add</button></div></div></li>');
          });
    })
}


function addItineraryDays(days) {
    console.log("Aggiungo un giorno")
    if(days==1){
        var day = [];
        itineraryDays++;
        $(".add-day").append('<div class="row py-3 add-day-'+itineraryDays+'"><label class="ft-2 fw-bolder py-3">Day '+itineraryDays+'</label><div class="container"><ul class="list-group item-day-'+itineraryDays+'"></ul></div></div>');
        itinerary.push(day);
    }
    else if(days==-1 && itineraryDays>0){
        if(itinerary[itineraryDays-1].length > 0){
            alert('Unable to remove! Day '+ itineraryDays +' has places entered, remove them first!');
            return false;
        }
        else{
            $(".add-day-"+itineraryDays+"").remove();
            itinerary.pop();
            itineraryDays--;
        }  
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
        itinerary[inputNumber-1].push(parameter);
        var position = itinerary[inputNumber-1].length;
        $(".item-day-"+inputNumber+"").append('<li class="list-group-item list-group-numbered element-'+inputNumber+'-'+position+'"> <div class="row "> <div class="col-8 align-middle"> '+place[0]+' </div> <div class="col-4 align-middle"> <div class="btn-toolbar btn-group"><button type="button" id="remove-button" onclick="removePlaceToDay(\''+parameter+'\',\''+inputNumber+'\',\''+position+'\')" class="btn-secondary btn"><i class="bi bi-x-circle"></i></button> <button type="button" id="move-down-button" onclick="moveUpPlaceToDay(\''+parameter+'\',\''+inputNumber+'\',\''+position+'\')" class="btn-secondary btn"><i class="bi bi-arrow-bar-up"></i></button> <button type="button" id="move-up-button" onclick="moveDownPlaceToDay(\''+parameter+'\',\''+inputNumber+'\',\''+position+'\')" class="btn-secondary btn"><i class="bi bi-arrow-bar-down"></i></button> </div> </div> </div> </li>');
        
        
        //Ad marker to map
        var coord = place[1].split(',');
        var placeMarker = L.marker([coord[0],coord[1]]).addTo(map)
        .bindPopup(place[0]+'')
        .openPopup();
        markers.push(placeMarker);
    }
}

function moveDownPlaceToDay(parameter,inputNumber,position){
    var indexMoveElem = $(".element-"+inputNumber+"-"+position+"").index();
    var nDay = inputNumber-1;
    var max = itinerary[nDay].length - 1;
    if(indexMoveElem<max){
        
        var indexDownElem = indexMoveElem + 1;
        
        var listElem = $('ul.item-day-' +inputNumber+ ' li');
        

        var moveElem = listElem.eq(indexMoveElem);
        var downElem = listElem.eq(indexDownElem); 
        
        // Scambia gli elementi
        moveElem.insertAfter(downElem);
    
        //Aggiorno array
        var temp =  itinerary[nDay][indexDownElem];
        itinerary[nDay][indexDownElem] = itinerary[nDay][indexMoveElem];
        itinerary[nDay][indexMoveElem] = temp;
    }
}

function moveUpPlaceToDay(parameter,inputNumber,position){
    var indexMoveElem = $(".element-"+inputNumber+"-"+position+"").index();
    if(indexMoveElem>0){
        var nDay = inputNumber-1;
        var indexUpElem = indexMoveElem - 1;
        
        var listElem = $('ul.item-day-' +inputNumber+ ' li');
        

        var moveElem = listElem.eq(indexMoveElem);
        var upElem = listElem.eq(indexUpElem); 
        
        // Scambia gli elementi
        moveElem.insertBefore(upElem);
    
        //Aggiorno array
        var temp =  itinerary[nDay][indexUpElem];
        itinerary[nDay][indexUpElem] = itinerary[nDay][indexMoveElem];
        itinerary[nDay][indexMoveElem] = temp;
    }
}

function removePlaceToDay(parameter,inputNumber,position){
    var place = parameter.split('&');
    var nDay = inputNumber-1;
    var index = $(".element-"+inputNumber+"-"+position+"").index();
    $(".element-"+inputNumber+"-"+position+"").remove();
    itinerary[nDay].splice(index,1);
    //delete marker on the map
    for(var k=0;k<markers.length;k++){
        if(markers[k]._popup._content == place[0] ){
            markers[k].remove();
            markers.splice(k,1);
        }
    }
}

function checksubmit(){
    if(itinerary.length < 1){
        alert(`Unable to save! Your itinerary has 0 days!`);
        return false;
    }
    else{
        for(var j=0;j<itinerary.length;j++){
            if(itinerary[j].length < 1){
                alert('Unable to save! Day '+ (j+1) +' must have at least one location!');
                return false;
            }
        }
        //Passo l'itinerario
        var itineraryObj = document.getElementById("saveitinerary");
        itineraryObj.value = JSON.stringify(itinerary);
        var daysObj = document.getElementById("daysitinerary");
        daysObj.value = itineraryDays;
    }
}

function setAction(action) {
    // Imposta l'attributo action del form
    document.getElementById('myForm').action = action;
  }