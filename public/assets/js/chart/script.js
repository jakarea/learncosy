Apex.grid = {
    padding: {
        right: 0,
        left: 0
    }
}

Apex.dataLabels = {
    enabled: false
}

var randomizeArray = function (arg) {
    var array = arg.slice();
    var currentIndex = array.length, temporaryValue, randomIndex;

    while (0 !== currentIndex) {

        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}

// data for the sparklines that appear below header area
var sparklineData = [65, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 146];
var sparklineData2 = [1, 5, 27, 93, 3, 61, 27, 4, 3, 19, 5, 45, 4, 38, 6, 4, 65, 31, 7, 9, 2, 1, 35, 6];
var sparklineData3 = [50, 4, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 45, 54, 38, 56, 253, 61, 27, 54, 43, 19, 146];

// the default colorPalette for this dashboard
//var colorPalette = ['#01BFD6', '#5564BE', '#F7A600', '#EDCD24', '#F74F58'];
var colorPalette = ['#00D8B6', '#008FFB', '#FEB019', '#FF4560', '#775DD0']

var spark1 = {
    chart: {
        id: 'sparkline1',
        group: 'sparklines',
        type: 'area',
        height: 160,
        sparkline: {
            enabled: true
        },
    },
    stroke: {
        curve: 'straight'
    },
    fill: {
        opacity: 1,
    },
    series: [{
        name: 'Sales',
        data: sparklineData
    }],
    labels: [...Array(24).keys()].map(n => `2018-09-0${n + 1}`),
    yaxis: {
        min: 0
    },
    xaxis: {
        type: 'datetime',
    },
    colors: ['#DCE6EC'],
    title: {
        text: '$424',
        offsetX: 30,
        style: {
            fontSize: '24px',
            cssClass: 'apexcharts-yaxis-title'
        }
    },
    subtitle: {
        text: 'Sales',
        offsetX: 30,
        style: {
            fontSize: '14px',
            cssClass: 'apexcharts-yaxis-title'
        }
    }
}






var spark2 = {
    chart: {
        id: 'sparkline2',
        group: 'sparklines',
        type: 'area',
        height: 160,
        sparkline: {
            enabled: true
        },
    },
    stroke: {
        curve: 'straight'
    },
    fill: {
        opacity: 1,
    },
    series: [{
        name: 'Expenses',
        data: sparklineData2
    }],
    labels: [...Array(24).keys()].map(n => `2018-09-0${n + 1}`),
    yaxis: {
        min: 0
    },
    xaxis: {
        type: 'datetime',
    },
    colors: ['#DCE6EC'],
    title: {
        text: '$235,312',
        offsetX: 30,
        style: {
            fontSize: '24px',
            cssClass: 'apexcharts-yaxis-title'
        }
    },
    subtitle: {
        text: 'Expenses',
        offsetX: 30,
        style: {
            fontSize: '14px',
            cssClass: 'apexcharts-yaxis-title'
        }
    }
}







var spark3 = {
    chart: {
        id: 'sparkline3',
        group: 'sparklines',
        type: 'area',
        height: 160,
        sparkline: {
            enabled: true
        },
    },
    stroke: {
        curve: 'straight'
    },
    fill: {
        opacity: 1,
    },
    series: [{
        name: 'Profits',
        data: sparklineData3
    }],
    labels: [...Array(24).keys()].map(n => `2018-09-0${n + 1}`),
    xaxis: {
        type: 'datetime',
    },
    yaxis: {
        min: 0
    },
    colors: ['#008FFB'],
    //colors: ['#5564BE'],
    title: {
        text: '$135,965',
        offsetX: 30,
        style: {
            fontSize: '24px',
            cssClass: 'apexcharts-yaxis-title'
        }
    },
    subtitle: {
        text: 'Profits',
        offsetX: 30,
        style: {
            fontSize: '14px',
            cssClass: 'apexcharts-yaxis-title'
        }
    }
}

var monthlyEarningsOpt = {
    chart: {
        type: 'area',
        height: 260,
        background: '#eff4f7',
        sparkline: {
            enabled: true
        },
        offsetY: 20
    },
    stroke: {
        curve: 'straight'
    },
    fill: {
        type: 'solid',
        opacity: 1,
    },
    series: [{
        data: randomizeArray(sparklineData)
    }],
    xaxis: {
        crosshairs: {
            width: 1
        },
    },
    yaxis: {
        min: 0,
        max: 130
    },
    colors: ['#dce6ec'],

    title: {
        text: 'Total Earned',
        offsetX: -30,
        offsetY: 100,
        align: 'right',
        style: {
            color: '#7c939f',
            fontSize: '16px',
            cssClass: 'apexcharts-yaxis-title'
        }
    },
    subtitle: {
        text: '$135,965',
        offsetX: -30,
        offsetY: 100,
        align: 'right',
        style: {
            color: '#7c939f',
            fontSize: '24px',
            cssClass: 'apexcharts-yaxis-title'
        }
    }
}


new ApexCharts(document.querySelector("#spark1"), spark1).render();
new ApexCharts(document.querySelector("#spark2"), spark2).render();
new ApexCharts(document.querySelector("#spark3"), spark3).render();

var monthlyEarningsChart = new ApexCharts(document.querySelector("#monthly-earnings-chart"), monthlyEarningsOpt);


var optionsBar = {
    chart: {
        type: 'bar',
        height: 380,
        width: '100%',
        stacked: true,
    },
    dataLabels: {
        enabled: true,
    },
    plotOptions: {
        bar: {
            columnWidth: '45%',
        }
    },
    colors: colorPalette,
    series: [{
        name: "Clothing",
        data: [0, 0, 0, 0, 9, 42, 52, 16, 55, 59, 51, 45, 32, 26, 0, 33, 44, 51, 42, 56],
    }, {
        name: "Food Products",
        data: [0, 0, 0, 0, 6, 12, 4, 7, 5, 3, 6, 4, 0, 3, 3, 5, 6, 7, 4],
    }],
    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
    xaxis: {
        labels: {
            show: false
        },
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        },
    },
    yaxis: {
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        },
        labels: {
            style: {
                colors: '#78909c'
            }
        }
    },
    title: {
        text: 'Monthly Sales',
        align: 'left',
        style: {
            fontSize: '18px'
        }
    }

}

var chartBar = new ApexCharts(document.querySelector('#bar'), optionsBar);
chartBar.render();


var optionDonut = {
    chart: {
        type: 'donut',
        width: '100%',
        height: 400
    },
    dataLabels: {
        enabled: true,
    },
    plotOptions: {
        pie: {
            customScale: 0.8,
            donut: {
                size: '75%',
            },
            offsetY: 20,
        },
        stroke: {
            colors: undefined
        }
    },
    colors: colorPalette,
    title: {
        text: 'Department Sales',
        style: {
            fontSize: '18px'
        }
    },
    series: [21, 23, 19, 14, 6],
    labels: ['Clothing', 'Food Products', 'Electronics', 'Kitchen Utility', 'Gardening'],
    legend: {
        position: 'left',
        offsetY: 80
    }
}

var donut = new ApexCharts(
    document.querySelector("#donut"),
    optionDonut
)
donut.render();



// on smaller screen, change the legends position for donut
var mobileDonut = function () {
    if ($(window).width() < 768) {
        donut.updateOptions({
            plotOptions: {
                pie: {
                    offsetY: -15,
                }
            },
            legend: {
                position: 'bottom'
            }
        }, false, false)
    }
    else {
        donut.updateOptions({
            plotOptions: {
                pie: {
                    offsetY: 20,
                }
            },
            legend: {
                position: 'left'
            }
        }, false, false)
    }
}

$(window).resize(function () {
    mobileDonut()
});