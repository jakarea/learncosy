var options = {
    series: [{
    name: 'Up',
    type: 'column',
    data: [4.5, 4, 3.9, 4, 4]
  }, {
    name: 'Down',
    type: 'column',
    data: [4, 3.6, 4.1, 4.5, 4.1]
  }],
    chart: {
    height: 290,
    type: 'line',
    stacked: false
  },
  dataLabels: {
    enabled: false
  }, 
  colors: ['#1D3573','#09BD3C'],
//   fill: {
//     type: 'gradient',
//     gradient: {
//       type: 'vertical',
//       colorStops: [
//         {
//           offset: 0,
//           color: '#1D3573'
//         },
//         {
//           offset: 25,
//           color: '#11859E'
//         }
//       ]
//     }
//   },
  stroke: {
    width: [0, 0], 
  },   
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
    categories: ['April', 'may', 'June', 'July', 'Augest'],
  }, 
  tooltip: {
    fixed: {
      enabled: true,
      position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
      offsetY: 30,
      offsetX: 60
    },
  }, 
  };

  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();