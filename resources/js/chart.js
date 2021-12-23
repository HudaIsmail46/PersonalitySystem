require('chart.js');

var studentPerformance = document.getElementById('studentPerformance');
if(studentPerformance){
    var config = studentPerformance.getAttribute('config');

    new Chart(studentPerformance, JSON.parse(config));
}

var dimensionScores = document.getElementById('dimensionScores');
if(dimensionScores){
    var config = dimensionScores.getAttribute('config');

    new Chart(dimensionScores, JSON.parse(config));
}
