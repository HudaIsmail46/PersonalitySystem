require('chart.js');

var monthlyBooking = document.getElementById('monthlyBooking');
if(monthlyBooking){
    var config = monthlyBooking.getAttribute('config');

    new Chart(monthlyBooking, JSON.parse(config));
}
