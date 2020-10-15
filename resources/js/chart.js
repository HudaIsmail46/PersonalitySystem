require('chart.js');

var incompleteBooking = document.getElementById('incompleteBooking');
if(incompleteBooking){
    var config = incompleteBooking.getAttribute('config');

    new Chart(incompleteBooking, JSON.parse(config));    
}

var weeklyBooking = document.getElementById('weeklyBooking');
if(weeklyBooking){
    var config = weeklyBooking.getAttribute('config');

    new Chart(weeklyBooking, JSON.parse(config));    
}
