var options = {
    series: [{
    name: 'Active',
    data: [31, 40, 28, 51, 42, 109, 100]
  }, {
    name: 'Inactive',
    data: [11, 32, 45, 32, 34, 52, 41]
  }],
    chart: {
    height: 315,
    type: 'area'
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    width: [0, 0], 
  },
  colors: ['#1D3573','#09BD3C'],
  grid: {
    show: true,
    borderColor: '#D7D7D7',
    strokeDashArray: 0,
    position: 'back',
    xaxis: {
        lines: {
            show: false 
        }
    },    
    yaxis: {
        lines: {
            show: true,
            opacity: .1,
        }
    },    
},
  xaxis: {
    type: 'datetime',
    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
  },
  tooltip: {
    x: {
      format: 'dd/MM/yy HH:mm'
    },
  },
  };

  var chart = new ApexCharts(document.querySelector("#lineChart"), options);
  chart.render();