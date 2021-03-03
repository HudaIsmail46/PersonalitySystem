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

var dailyReport = document.getElementById('dailyReport');
if(dailyReport){
    var config = dailyReport.getAttribute('config');

    new Chart(dailyReport, JSON.parse(config));
}