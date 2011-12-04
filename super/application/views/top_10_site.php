
<?= append_top10_params($data_strings) ?> 
<script>
var chart;
$(document).ready(function() {
   
   var colors = Highcharts.getOptions().colors;
   var categories = [];
   var data = [];
   
   
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
         text: '出码量前十名'
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
<div id="container">
</div>

