window.Apex = {
    chart: {
      foreColor: '#ccc',
      toolbar: {
        show: false
      },
    },
    stroke: {
      width: 3
    },
    dataLabels: {
      enabled: false
    },
    tooltip: {
      theme: 'dark'
    },
    grid: {
      borderColor: "#535A6C",
      xaxis: {
        lines: {
          show: true
        }
      }
    }
  };
  
  var clients = {
    chart: {
      id: 'clients',
      group: 'clients',
      type: 'line',
      height: 80,
      sparkline: {
        enabled: true
      },
      dropShadow: {
        enabled: false, 
      }
    },
    series: [{
      data: [45,25, 66, 41]
    }],
    stroke: {
      curve: 'smooth',
      width: 11,
    },
    markers: {
      size: 0
    },
    grid: {
      padding: {
        top: 0,
        bottom: 0,
        left: 0
      }
    },
    fill: {
        colors: ['#1D3573'],
        opacity: 0.9,
        type: 'solid',
    },
    colors: ['#1D3573'],
    tooltip: {
      x: {
        show: false
      },
      y: {
        title: {
          formatter: function formatter(val) {
            return '';
          }
        }
      }
    }
  }
  var projects = {
    chart: {
      id: 'projects',
      group: 'projects',
      type: 'line',
      height: 80,
      sparkline: {
        enabled: true
      },
      dropShadow: {
        enabled: false, 
      }
    },
    series: [{
      data: [22,75,15, 36]
    }],
    stroke: {
      curve: 'smooth',
      width: 11,
    },
    markers: {
      size: 0
    },
    grid: {
      padding: {
        top: 0,
        bottom: 0,
        left: 0
      }
    },
    fill: {
        colors: ['#1D3573'],
        opacity: 0.9,
        type: 'solid',
    },
    colors: ['#1D3573'],
    tooltip: {
      x: {
        show: false
      },
      y: {
        title: {
          formatter: function formatter(val) {
            return '';
          }
        }
      }
    }
  }
   
  
  new ApexCharts(document.querySelector("#clients"), clients).render();
  new ApexCharts(document.querySelector("#projects"), projects).render(); 