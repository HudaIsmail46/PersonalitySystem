<!DOCTYPE html>
<html>
	<head><link  id='GoogleFontsLink' href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet' type='text/css'>
		<script>
 WebFontConfig = {
 google: 
{families: ["Open Sans",]},active: function() { 
 DrawTheChart(ChartData,ChartOptions,"chart-01","bar")}
};
		</script>
		<script asyn src="js/webfont.js">
		</script><script src="js/Chart.min.js"></script>
		<script>
function DrawTheChart(ChartData,ChartOptions,ChartId,ChartType){
eval('var myLine = new Chart(document.getElementById(ChartId).getContext("2d"),{type:"'+ChartType+'",data:ChartData,options:ChartOptions});document.getElementById(ChartId).getContext("2d").stroke();')
}
		</script>
	</head>
	<body>
		<canvas  id="chart-01" width="1050" height="600"  style="background-color:rgba(255,255,255,1.00);border-radius:0px;width:700px;height:400px;padding-left:0px;padding-right:0px;padding-top:0px;padding-bottom:0px"></canvas>
		<script> function MoreChartOptions(){} 
var ChartData = {
	labels : ["FSKTM","FSSS","FS","APM","API","FBL","FK",],
	datasets : [
		{
		data : [300,200,450,210,180,144,320,],
		backgroundColor :'#51e072',
		borderColor : 'rgba(136,136,136,0.5)',
		label:"Respondent"},

]
	};
ChartOptions= {
responsive:false,
	layout:{padding:{top:10,left:10,bottom:10,},},
	 scales: {
	xAxes:[{
gridLines:{borderDash:[],},
}],

	yAxes:[{
gridLines:{borderDash:[],},
}],
 },plugins:{
datalabels:{display:true,
	anchor:'end',
	offset:2,
	font:{
		style:' bold',},},
},
legend:{
	labels:{
		generateLabels: function(chart){
			 return  chart.data.datasets.map( function( dataset, i ){
				return{
					text:dataset.label,
					lineCap:dataset.borderCapStyle,
					lineDash:[],
					lineDashOffset: 0,
					lineJoin:dataset.borderJoinStyle,
					fillStyle:dataset.backgroundColor,
					strokeStyle:dataset.borderColor,
					lineWidth:dataset.pointBorderWidth,
					lineDash:dataset.borderDash,
				}
			})
		},

	},
},

title:{
	display:true,
	text:'Total of Respondents by Faculties',
	padding:8,
	fontColor:'#2f78a8',
	fontSize:32,
	fontStyle:' bold',
	},
elements: {
	arc: {
},
	line: {
},
	rectangle: {
borderWidth:3,
},
},
tooltips:{
},
hover:{
	mode:'nearest',
	animationDuration:400,
},
};
 DrawTheChart(ChartData,ChartOptions,"chart-01","bar");</script></body></html>