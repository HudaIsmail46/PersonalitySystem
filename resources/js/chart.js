require('chart.js');

var monthlyBooking = document.getElementById('monthlyBooking');
if(monthlyBooking){
    var config = monthlyBooking.getAttribute('config');

    new Chart(monthlyBooking, JSON.parse(config));
}


var todayTeamSales = document.getElementById('todayTeamSales');
if(todayTeamSales){
    var config = todayTeamSales.getAttribute('config');

    new Chart(todayTeamSales, JSON.parse(config));
}