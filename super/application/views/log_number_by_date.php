<script>
$(function() {
	var seriesOptions = [];
  var yAxisOptions = [];
  var seriesCounter = 0;
	var names = ['总出码', '正确回答', '错误回答', '超时'];
	var colors = Highcharts.getOptions().colors;
  <?= print_number_by_date_js_seriesOption($captcha_num) ?>
  createChart();


	// create the chart when all data is loaded
	function createChart() {

		chart = new Highcharts.StockChart({
		    chart: {
		        renderTo: 'container'
		    },
        rangeSelector: {
          buttons: [{
              type: 'day',
              count: 1,
              text: '1d'
          },{
              type: 'all',
              text: 'All'
		      }],
          selected: 0
        },

		    yAxis: {
		    	plotLines: [{
		    		value: 0,
		    		width: 2,
		    		color: 'silver'
		    	}]
		    },
		    
        tooltip: {
		    	pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>'
		    },
		    
		    series: seriesOptions
		});
	}

});
</script>
  <?php if(isset($class_id)){echo "<h2>Class ID: $class_id</h2>";}?>
<div id="container">
</div>
<!--TODO finish the table -->
<div id="data_table">
<!-- site_contact_table($data_array) -->
</div>
