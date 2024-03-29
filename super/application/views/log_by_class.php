
<script>
var chart;
$(document).ready(function() {
   
   var colors = Highcharts.getOptions().colors;
   var categories = [];
   var data = [];
   
   <?= append_top10_params($data, 'class_id') ?> 
   
   // Build the data arrays
   var siteData = [];
   var correctnessData = [];
   for (var i = 0; i < data.length; i++) {
      
      // add site data
      siteData.push({
         name: categories[i],
         y: data[i].y,
         color: data[i].color
      });
      
      // add version data
      for (var j = 0; j < data[i].drilldown.data.length; j++) {
         var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
         correctnessData.push({
            name: data[i].drilldown.categories[j],
            y: data[i].drilldown.data[j],
            color: Highcharts.Color(data[i].color).brighten(brightness).get()
         });
      }
   }
   
   // Create the chart
   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'container', 
         type: 'pie'
      },
      title: {
        text: '<?= $recent_unit ?>各类出码量分布'
      },
      yAxis: {
         title: {
            text: '总出码量'
         }
      },
      plotOptions: {
         pie: {
            shadow: false
         }
      },
      tooltip: {
         formatter: function() {
            return '<b>'+ this.point.name +'</b>: '+ this.y;
         }
      },
      series: [{
         name: 'Sites',
         data: siteData,
         size: '60%',
         dataLabels: {
            formatter: function() {
               return this.point.name;
            },
            color: 'white',
            distance: -30
         }
      }, {
         name: 'Correctness',
         data: correctnessData,
         innerSize: '60%',
         dataLabels: {
            formatter: function() {
               // display only if larger than 1
               return null;
            }
         }
      }]
   });
   
   
});
</script>
<div style="float:right">
<a href="year">最近一年</a>
<a href="month">最近一个月</a>
<a href="day">最近一天</a>
<a href="hour">最近一小时</a>
</div>
<div id="container">
</div>
<script>
$(document).ready(function(){
	$('table').dataTable();
});
</script>
<div>
<?php 
    $this->table->set_heading(array('Class ID', '总数量', '正确', '错误', '超时'));
    echo $this->table->generate($data);
?>
</div>

