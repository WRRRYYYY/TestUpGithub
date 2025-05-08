<script type="text/javascript">
    $(function () {
    var areaChartData = {
      labels  : [
      	$("#datagrafik tr:eq(0)").find("td").eq(0).text(), 
      	$("#datagrafik tr:eq(1)").find("td").eq(0).text(), 
      	$("#datagrafik tr:eq(2)").find("td").eq(0).text(), 
      	$("#datagrafik tr:eq(3)").find("td").eq(0).text(), 
      	$("#datagrafik tr:eq(4)").find("td").eq(0).text(), 
      	$("#datagrafik tr:eq(5)").find("td").eq(0).text()
      ],
      datasets: [
        {
          label               : 'Proyeksi',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 0, 0, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [
          	parseFloat($("#datagrafik tr:eq(0)").find("td").eq(1).text()), 
          	parseFloat($("#datagrafik tr:eq(1)").find("td").eq(1).text()), 
          	parseFloat($("#datagrafik tr:eq(2)").find("td").eq(1).text()), 
          	parseFloat($("#datagrafik tr:eq(3)").find("td").eq(1).text()), 
          	parseFloat($("#datagrafik tr:eq(4)").find("td").eq(1).text()), 
          	parseFloat($("#datagrafik tr:eq(5)").find("td").eq(1).text()), 
          ]
        },
        {
          label               : 'Penerimaan',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
          	parseFloat($("#datagrafik tr:eq(0)").find("td").eq(2).text()), 
          	parseFloat($("#datagrafik tr:eq(1)").find("td").eq(2).text()), 
          	parseFloat($("#datagrafik tr:eq(2)").find("td").eq(2).text()), 
          	parseFloat($("#datagrafik tr:eq(3)").find("td").eq(2).text()), 
          	parseFloat($("#datagrafik tr:eq(4)").find("td").eq(2).text()), 
          	parseFloat($("#datagrafik tr:eq(5)").find("td").eq(2).text()), 
          ]
        },
      ]
    }
var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
//    var areaChart       = new Chart(areaChartCanvas, { 
//      type: 'line',
//      data: areaChartData, 
//      options: areaChartOptions
//    })
        //-------------
        //- LINE CHART -
        //--------------
        var lineChartCanvas = $('#lineChart').get(0).getContext('2d')

        var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)

        var lineChartData = jQuery.extend(true, {}, areaChartData)

        lineChartData.datasets[0].fill = false;

        lineChartData.datasets[1].fill = false;

        lineChartOptions.datasetFill = false

        var lineChart = new Chart(lineChartCanvas, { 
          type: 'line',
          data: lineChartData, 
          options: lineChartOptions
        });

    });
    
</script>