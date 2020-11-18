require('chart.js');

var incompleteBooking = document.getElementById('incompleteBooking');
if(incompleteBooking){
    var config = incompleteBooking.getAttribute('config');

    new Chart(incompleteBooking, JSON.parse(config));
}

var monthlyBooking = document.getElementById('monthlyBooking');
if(monthlyBooking){
    var config = monthlyBooking.getAttribute('config');

    new Chart(monthlyBooking, JSON.parse(config));
}
