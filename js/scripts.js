function addDays(days) {
    let inputField = $("#quantity");
    let newDays = parseInt(inputField.val()) + days;
    if(newDays < 1) newDays = 1;
    inputField.val(newDays);
}

// Create map
var map = L.map('map').setView([41.8902338,12.4907832], 13);

// Map layer
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var foro = L.marker([41.8903461,12.4895719]).addTo(map)
    .bindPopup('Foro Romano')
    .openPopup();

// per cancellarlo basta fare foro.remove()

