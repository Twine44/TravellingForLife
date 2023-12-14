//localStorageból megszerezni a JSON adatokat
var selectedBooking = JSON.parse(localStorage.getItem('selectedBooking'));
var price2 = selectedBooking.price;
var price = parseInt(price2)*1000; // will return 429
var personCount = document.getElementById('person-count');
var place = selectedBooking.location;
var nights = selectedBooking.nights;

document.cookie = "price = " + price +"; SameSite=None; Secure";
document.cookie = "location = " + place +"; SameSite=None; Secure";
document.cookie = "nights = " + nights +"; SameSite=None; Secure";
document.cookie = "person-count = 1; SameSite=None; Secure"; 

personCount.addEventListener('change', function() {
    // get the updated person-count value
    var updatedPersonCount = personCount.value;
    document.cookie = "person-count = " + updatedPersonCount + "; SameSite=None; Secure";
  
    // send the updated price and person-count values to the server-side PHP script via an HTTP request
   /*  var xhr = new XMLHttpRequest();
    var formData = new FormData();
formData.append('price', price);
formData.append('person-count', updatedPersonCount);
var xhr = new XMLHttpRequest();
xhr.open('POST', '/Travelling/html/savebooking.php', true);
xhr.send(formData); */
  });




//képek betöltése
for (let i = 1; i < 5; i++) {
    var imgKey = "img" + i;
    var imgValue = selectedBooking[imgKey];
    document.getElementById("img" + i).setAttribute("src", imgValue);
    document.getElementById("img" + i ).setAttribute("alt", selectedBooking.name);   
}

// adatok átvitele
document.getElementById("header1").innerHTML = selectedBooking.name;
document.getElementById("header2").innerHTML = selectedBooking.location;
document.getElementById("period").innerHTML = selectedBooking.nights;
document.getElementById("hotel").innerHTML = selectedBooking.location;
document.getElementById("price").innerHTML = selectedBooking.price;
document.getElementById("rooms").innerHTML = selectedBooking.rooms;
document.getElementById("article1").innerHTML = selectedBooking.description1;
document.getElementById("article2").innerHTML = selectedBooking.description2;
