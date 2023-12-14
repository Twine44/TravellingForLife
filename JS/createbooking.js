// Ez majd JSON fájl lesz egyszer
 var bookings = {
    "bookings": [
      {
        "id": "001",
        "img1" : "../images/egypt1.jpg",
        "img2" : "../images/egypt2.jpg",
        "img3" : "../images/egypt3.jpg",
        "img4" : "../images/egypt4.jpg",
        "name": "Egypt",
        "location": "Cairo, Hotel Abdul-Ahim",
        "nights" : "4 nights",
        "price": "199.000 HUF",
        "rooms": "1",
        "description1" : "Travel to Cairo, the bustling capital city of Egypt, where ancient history meets modern culture. Make yourself at home at Hotel Abdul-Ahim, a charming and welcoming hotel located in the heart of the city.",
        "description2" : "Enjoy comfortable and spacious accommodations, with all the amenities you need for a comfortable stay. Explore the city's many attractions, from the magnificent pyramids of Giza to the world-famous Egyptian Museum."
      }, 
  
      {
        "id": "002",
        "img1" : "../images/firenze1.jpg",
        "img2" : "../images/firenze2.jpg",
        "img3" : "../images/firenze3.jpg",
        "img4" : "../images/firenze4.jpg",
        "name": "Italy",
        "location": "Firenze, Vespucci Villa",
        "nights" : "5 nights",
        "price": "429.000 HUF",
        "rooms": "2",
        "description1" : "Travel to Firenze, the stunning city of art and culture in the heart of Tuscany! Nestled among the rolling hills and vineyards of the Chianti region, Vespucci Villa offers the ultimate in luxury and sophistication.",
        "description2" : "This magnificent villa is steeped in history, with its exquisite frescoes, antique furnishings, and stunning gardens. Relax by the private pool and soak up the Tuscan sunshine, or explore the surrounding countryside on foot or by bicycle.",
      },
      {
        "id": "003",
        "img1" : "../images/iceland1.jpg",
        "img2" : "../images/iceland2.jpg",
        "img3" : "../images/iceland3.jpg",
        "img4" : "../images/iceland4.jpg",
        "name": "Iceland",
        "location": "Reykjavík, Aurora Hotel",
        "nights" : "3 nights",
        "price": "249.000 HUF",
        "rooms": "6",
        "description1": "Travel to Reykjavík, the stunning capital city of Iceland, where rugged wilderness meets urban sophistication. Stay in style at the Aurora Hotel, a modern and luxurious hotel located in the heart of the city.",
        "description2" : "Enjoy comfortable and stylish accommodations, with all the amenities you need for a memorable stay. Experience the natural wonders of Iceland, from the world-famous Northern Lights to the stunning glaciers and geysers of the Golden Circle."
      },
      {
        "id": "004",
        "img1" : "../images/szeged1.jpg",
        "img2" : "../images/szeged2.jpg",
        "img3" : "../images/szeged3.jpg",
        "img4" : "../images/szeged4.jpg",
        "name": "Szeged",
        "location": "Irinyi épület",
        "nights" : "420 nights",
        "price": "0 HUF",
        "rooms": "3",
        "description1" : "At least it's free (mostly)",
        "description2": ""
      },
      {
        "id": "005",
        "img1" : "../images/japan1.jpg",
        "img2" : "../images/japan2.jpg",
        "img3" : "../images/japan3.jpg",
        "img4" : "../images/japan4.jpg",
        "name": "Japan",
        "location": "Kyoto, Hamacho's Hut",
        "nights" : "6 nights",
        "price": "449.000 HUF",
        "rooms": "4",
        "description1": "Travel to Kyoto, the cultural heart of Japan! Immerse yourself in the city's rich history and tradition by staying at Hamacho's House, a stunning traditional Japanese home located in the charming neighborhood of Hamacho. ",
         "description2": "This beautifully preserved house offers a unique opportunity to experience Japanese architecture and design, with its tatami mat floors, sliding shoji doors, and elegant gardens. Relax in the peaceful surroundings and enjoy the views of the nearby temples and shrines."
      },
      {
        "id": "006",
        "img1" : "../images/hawaii1.jpg",
        "img2" : "../images/hawaii2.jpg",
        "img3" : "../images/hawaii3.jpg",
        "img4" : "../images/hawaii4.jpg",
        "name": "Hawaii",
        "location": "Honolulu, Waikiki Hotel",
        "nights" : "5 nights",
        "price": "509.000 HUF",
        "rooms": "7",
        "description1": "Travel to Honolulu, the tropical paradise of Hawaii, where golden sands meet crystal clear waters. Experience the ultimate in luxury and relaxation at the Waikiki Hotel, a stunning beachfront property located in the heart of the city.",
         "description2": "Enjoy spacious and stylish accommodations, with all the amenities you need for a comfortable stay. Soak up the sun on the pristine beaches, or take a refreshing dip in the sparkling waters of the Pacific Ocean."
      }
    ]
  }; 



  var bookingsContainer = document.getElementById("bookingcontent");

  function createBookingClickHandler(booking) {
    return function() {
      localStorage.clear();
      localStorage.setItem('selectedBooking', JSON.stringify(booking));
      window.location.href = 'bookingpage.php'; // Navigate to the booking page
    }
  }
  // HTML kreálás az összes elemre
for (var i = 0; i < bookings.bookings.length; i++) {
    var booking = bookings.bookings[i];
  
    var bookingItem = document.createElement("div");
    bookingItem.classList.add('box', 'animate-up'); 
  
    var bookingImg = document.createElement("img");
    bookingImg.setAttribute("src", booking.img1);
    bookingImg.setAttribute("alt", booking.name);
  
    var bookingInfobox = document.createElement("div");
    bookingInfobox.classList.add('infobox');
  
    var bookingLeftbox = document.createElement("div");
    bookingLeftbox.classList.add('leftbox');
  
    var bookingName = document.createElement("p");
    bookingName.classList.add('countrytext');
    bookingName.innerHTML = booking.name;
  
    var bookingLocation = document.createElement("p");
    bookingLocation.classList.add('additionaltext');
    bookingLocation.innerHTML = booking.location;
  
    var bookingRightbox = document.createElement("div");
    bookingRightbox.classList.add('rightbox');
  
    var bookingNigths = document.createElement("p");
    bookingNigths.classList.add('additionaltext');
    bookingNigths.innerHTML = booking.nights;
  
    var bookingPrice = document.createElement("p");
    bookingPrice.classList.add('moneytext');
    bookingPrice.innerHTML = booking.price;
  
    // Struktúra
    bookingLeftbox.appendChild(bookingName);
    bookingLeftbox.appendChild(bookingLocation);
  
    bookingRightbox.appendChild(bookingNigths);
    bookingRightbox.appendChild(bookingPrice);
  
    bookingInfobox.appendChild(bookingLeftbox);
    bookingInfobox.appendChild(bookingRightbox);
  
    bookingItem.appendChild(bookingImg);
    bookingItem.appendChild(bookingInfobox);

    bookingItem.addEventListener('click', createBookingClickHandler(booking));
  
    bookingsContainer.appendChild(bookingItem);
  }
  
  
  
  