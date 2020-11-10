<?php

 $rating_data = array(
 array('Employee', 'Rating'),
 array('Optimized',56),
 array('Error',37),
 array('Warning',50)
);

 $encoded_data = json_encode($rating_data);
?>

<html>
<head>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() 
{
 var data = google.visualization.arrayToDataTable(
 <?php  echo $encoded_data; ?>
 );
 var options = {
  title: "Onpage SEO Report"
 };
 var chart = new google.visualization.PieChart(document.getElementById("employee_piechart"));
 chart.draw(data, options);
}
</script>
<style>
body
{
 margin:0 auto;
 padding:0px;
 text-align:center;
 width:100%;
 font-family: "Myriad Pro","Helvetica Neue",Helvetica,Arial,Sans-Serif;
 background-color:#FAFAFA;
}
#wrapper
{
 margin:0 auto;
 padding:0px;
 text-align:center;
 width:995px;
}
#wrapper h1
{
 margin-top:50px;
 font-size:45px;
 color:#585858;
}
#wrapper h1 p
{
 font-size:18px;
}
#employee_piechart
{
 padding:0px;
 width:600px;
 height:400px;
 margin-left:190px;
}
</style>
</head>
<body>
 <div id="employee_piechart" style="width: 900px; height: 500px;"></div>
</body>
</html>