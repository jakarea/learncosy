var options = {
    series: [27, 11, 22, 15,25],
    chart: {
    type: 'donut', 
    width: '100%'
  },
  plotOptions: {
    pie: {
      customScale: 1,
      size: '70%'
    }
  },   
  fill: {
    colors: ['#763FE4', '#09BD3C', '#3BC0EA', '#FFAB2D','#FF4E8D'], 
  }, 
  legend: { 
    fontSize: '14px', 
  },
  stroke: {
    show: false, 
    width: 0, 
},
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 200
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
  };

  var chart = new ApexCharts(document.querySelector("#categories"), options);
  chart.render();