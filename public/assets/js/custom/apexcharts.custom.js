
/** Apex charts*/
function generateData(baseval, count, yrange) {
  var i = 0;
  var series = [];
  while (i < count) {
    var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;;
    var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
    var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

    series.push([x, y, z]);
    baseval += 86400000;
    i++;
  }
  return series;
}

// column chart
var columnChartoptions = {
  series: [{
    name: 'Orders',
    data: [32, 66, 44, 55, 41, 24, 67, 22, 43, 32, 66, 44, 55, 41, 24, 67, 22, 43]
  }, {
    name: 'Visitors',
    data: [7, 30, 13, 23, 20, 12, 8, 13, 27, 7, 30, 13, 23, 20, 12, 8, 13, 27]
  }],
  chart: {
    type: 'bar',
    height: 350,
    stacked: false,
    columnWidth: '70%',
    zoom: {
      enabled: true
    },
    toolbar: {
      show:false
    },
    background: 'transparent',
  },
  dataLabels: {
    enabled: false,
  },
  theme: {
      mode: colors.chartTheme,
  },
  responsive: [{
    breakpoint: 480,
    options: {
      legend: {
        position: 'bottom',
        offsetX: -10,
        offsetY: 0
      }
    }
  }],
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '50%',
      radius: 30,
      enableShades: false,
      endingShape: 'rounded',
    },
  },
  xaxis: {
    type: 'datetime',
    categories: ['01/01/2020 GMT', '01/02/2020 GMT', '01/03/2020 GMT', '01/04/2020 GMT', '01/05/2020 GMT',
      '01/06/2020 GMT', '01/07/2020 GMT', '01/08/2020 GMT', '01/09/2020 GMT', '01/10/2020 GMT', '01/11/2020 GMT',
      '01/12/2020 GMT', '01/13/2020 GMT', '01/14/2020 GMT', '01/15/2020 GMT', '01/16/2020 GMT', '01/17/2020 GMT', '01/18/2020 GMT'
    ],
    labels: {
      show: true,
      trim: true,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    },
    axisBorder: {
      show: false,
    },
  },
  yaxis: {
    labels: {
      show: true,
      trim: false,
      offsetX: -10,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    },
  },
  legend: {
    position: 'top',
    fontFamily: cfFontFamily,
    fontWeight: 400,
    labels: {
      colors: colors.mutedColor,
      useSeriesColors: true,
    },
    markers: {
      width: 10,
      height: 10,
      strokeWidth: 0,
      strokeColor: colors.whiteColor,
      fillColors: [extra.primaryColor, extra.primaryColorLight],
      radius: 6,
      customHTML: undefined,
      onClick: undefined,
      offsetX: 0,
      offsetY: 0
    },
    itemMargin: {
      horizontal: 10,
      vertical: 0
    },
    onItemClick: {
      toggleDataSeries: true
    },
    onItemHover: {
      highlightDataSeries: true
    },
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent']
  },
  colors : chartColors,
  fill: {
    opacity: 1,
  },
  grid: {
    show: true,
    borderColor: colors.borderColor,
    strokeDashArray: 0,
    position: 'back',
    xaxis: {
      lines: {
        show: false
      }
    },
    yaxis: {
      lines: {
        show: true
      }
    },
    row: {
      colors: undefined,
      opacity: 0.5
    },
    column: {
      colors: undefined,
      opacity: 0.5
    },
    padding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: 0
    },
  }
};

var columnChartCtn = document.querySelector("#columnChart");
if (columnChartCtn) {
  var columnChart = new ApexCharts(columnChartCtn, columnChartoptions);
  columnChart.render();
}

// bar chart
var barChartoptions = {
  series: [{
    name: 'Desktop',
    data: [44, 55, 41, 64, 22, 43, 21, 53, 32, 33]
  }, {
    name: 'Mobile',
    data: [53, 32, 33, 52, 13, 44, 32, 53, 32, 33]
  }, {
    name: 'Tablet',
    data: [13, 12, 13, 32, 23, 24, 12, 33, 12, 13]
  }],
  chart: {
    type: 'bar',
    height: 350,
    stacked: true,
    columnWidth: '60%',
    background : 'transparent',
    zoom: {
      enabled: false
    },
    toolbar: {
      show: false
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  dataLabels: {
    enabled: true,
  },
  responsive: [{
    breakpoint: 480,
    options: {
      legend: {
        position: 'bottom',
        offsetX: -10,
        offsetY: 0
      }
    }
  }],
  plotOptions: {
    bar: {
      horizontal: true,
      columnWidth: '30%',
    },
  },
  xaxis: {
    categories: [01, 02, 03, 04, 05, 06, 07, 08, 09, 10],
    labels: {
      show: true,
      trim: false,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    },
    axisBorder: {
      show: false,
    },
  },
  yaxis: {
    labels: {
      show: true,
      trim: false,
      offsetX: 5,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    }
  },
  legend: {
    position: 'top',
    fontFamily: cfFontFamily,
    fontWeight: 400,
    labels: {
      colors: colors.mutedColor,
      useSeriesColors: false
    },
    offsetY: 10,
    markers: {
      width: 10,
      height: 10,
      strokeWidth: 0,
      strokeColor: colors.borderColor,
      fillColors: chartAdjColors,
      radius: 6,
      customHTML: undefined,
      onClick: undefined,
      offsetX: 0,
      offsetY: 0
    },
    itemMargin: {
      horizontal: 10,
      vertical: 0
    },
    onItemClick: {
      toggleDataSeries: true
    },
    onItemHover: {
      highlightDataSeries: true
    },
  },
  colors: chroma.scale(chartColors).colors(3),
  fill: {
    opacity: 1,
  },
  grid: {
    show: true,
    borderColor: colors.borderColor,
    strokeDashArray: 0,
    position: 'back',
    xaxis: {
      lines: {
        show: true
      }
    },
    yaxis: {
      lines: {
        show: false
      }
    },
    row: {
      colors: undefined,
      opacity: 0.5
    },
    column: {
      colors: undefined,
      opacity: 0.5
    },
    padding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: 10
    }
  }
};
var barChartCtn = document.querySelector("#barChart");
if (barChartCtn) {
  var barChart = new ApexCharts(barChartCtn, barChartoptions);
  barChart.render();
}

// line chart
var lineChartoptions = {
  series: [{
      name: 'Page views',
      data: [31, 28, 30, 51, 42, 109, 100, 31, 40, 56, 31, 58, 30, 51, 42, 109, 100, 116]
    }, {
      name: 'Visitors',
      data: [11, 45, 20, 32, 34, 52, 41, 11, 32, 45, 11, 45, 20, 32, 34, 52, 41, 81]
    },
    {
      name: 'Orders',
      data: [5, 25, 9, 14, 14, 32, 21, 5, 12, 25, 5, 25, 9, 14, 14, 32, 21, 65]
    }
  ],
  chart: {
    height: 350,
    type: 'line',
    background : 'transparent',
    zoom: {
      enabled: false
    },
    toolbar: {
      show : false
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  stroke: {
    show: true,
    curve: 'straight',
    lineCap: 'round',
    colors: chroma.scale(chartColors).colors(3),
    width: [3, 2, 3],
    dashArray: [0, 0, 0],
  },
  dataLabels: {
    enabled: false,
  },
  responsive: [{
    breakpoint: 480,
    options: {
      legend: {
        position: 'bottom',
        offsetX: -10,
        offsetY: 0
      }
    }
  }],
  markers: {
    size: 4,
    strokeColors: colors.whiteColor,
    strokeWidth: 2,
    strokeOpacity: 0.9,
    strokeDashArray: 0,
    fillOpacity: 1,
    discrete: [],
    shape: "circle",
    radius: 2,
    offsetX: 0,
    offsetY: 0,
    onClick: undefined,
    onDblClick: undefined,
    showNullDataPoints: true,
    hover: {
      size: undefined,
      sizeOffset: 3
    }
  },
  xaxis: {
    type: 'datetime',
    categories: ['01/01/2020 GMT', '01/02/2020 GMT', '01/03/2020 GMT', '01/04/2020 GMT', '01/05/2020 GMT',
      '01/06/2020 GMT', '01/07/2020 GMT', '01/08/2020 GMT', '01/09/2020 GMT', '01/10/2020 GMT', '01/11/2020 GMT',
      '01/12/2020 GMT', '01/13/2020 GMT', '01/14/2020 GMT', '01/15/2020 GMT', '01/16/2020 GMT', '01/17/2020 GMT', '01/18/2020 GMT'
    ],
    labels: {
      show: true,
      trim: false,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    },
    axisBorder: {
      show: false,
    },
  },
  yaxis: {
    labels: {
      show: true,
      trim: false,
      offsetX: -10,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    },
  },
  legend: {
    position: 'top',
    fontFamily: cfFontFamily,
    fontWeight: 400,
    labels: {
      colors: colors.mutedColor,
      useSeriesColors: false
    },
    markers: {
      width: 10,
      height: 10,
      strokeWidth: 0,
      strokeColor: colors.borderColor,
      radius: 6,
      customHTML: undefined,
      onClick: undefined,
      offsetX: 0,
      offsetY: 0
    },
    itemMargin: {
      horizontal: 10,
      vertical: 0
    },
    onItemClick: {
      toggleDataSeries: true
    },
    onItemHover: {
      highlightDataSeries: true
    },
  },
  grid: {
    show: true,
    borderColor: colors.borderColor,
    strokeDashArray: 0,
    position: 'back',
    xaxis: {
      lines: {
        show: false
      }
    },
    yaxis: {
      lines: {
        show: true
      }
    },
    row: {
      colors: undefined,
      opacity: 0.5
    },
    column: {
      colors: undefined,
      opacity: 0.5
    },
    padding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: 0
    },
  },
  colors: chroma.scale(chartColors).colors(3),
};
var lineChartCtn = document.querySelector("#lineChart");
if (lineChartCtn) {
  var lineChart = new ApexCharts(lineChartCtn, lineChartoptions);
  lineChart.render();
}

// area chart
var areaChartOptions = {
  series: [{
      name: 'Website',
      data: [28, 30, 51, 32, 48, 31, 66, 31, 40, 28, 31, 48, 30, 51, 42, 79, 60, 86]
    }, {
      name: 'Mobile Apps',
      data: [45, 20, 32, 14, 32, 11, 41, 11, 32, 45, 11, 45, 20, 32, 34, 35, 41, 61]
    }
  ],
  chart: {
    type: 'area',
    height: 350,
    background: 'transparent',
    stacked: true,
    toolbar: {
      show: false,
    },
    zoom: {
      enabled: false
    },
  },
  theme: {
      mode: colors.chartTheme,
  },
  xaxis: {
    type: 'datetime',
    categories: ['01/01/2020 GMT', '01/02/2020 GMT', '01/03/2020 GMT', '01/04/2020 GMT', '01/05/2020 GMT',
      '01/06/2020 GMT', '01/07/2020 GMT', '01/08/2020 GMT', '01/09/2020 GMT', '01/10/2020 GMT', '01/11/2020 GMT',
      '01/12/2020 GMT', '01/13/2020 GMT', '01/14/2020 GMT', '01/15/2020 GMT', '01/16/2020 GMT', '01/17/2020 GMT', '01/18/2020 GMT'
    ],
    labels: {
      show: true,
      trim: false,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    },
    axisBorder: {
      show: false,
    },
    tooltip: {
      enabled: false,
      offsetX: 0,
    },
  },
  yaxis: {
    labels: {
      show: true,
      trim: false,
      offsetX: -10,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    },
  },
  markers: {
    size: 0,
    strokeColors: '#fff',
    strokeWidth: 0,
    strokeOpacity: 0.9,
    strokeDashArray: 0,
    fillOpacity: 1,
    discrete: [],
    shape: "circle",
    radius: 2,
    offsetX: 0,
    offsetY: 0,
    onClick: undefined,
    onDblClick: undefined,
    showNullDataPoints: true,
    hover: {
      size: undefined,
      sizeOffset: 3
    }
  },
  colors: chartColors,
  dataLabels: {
    enabled: false,
    //enabledOnSeries: [1]
  },
  stroke: {
    curve: 'smooth',
    lineCap: 'round',
    width: 0,
  },
  fill: {
    type: 'gradient',
    gradient: {
        shade: 'light',
        shadeIntensity: 0.2,
        gradientToColors: chartColors,
        opacityFrom: 0.9,
        opacityTo: 0.5,
        stops: [0, 90, 100],
        //colorStops: []
    },
  },
  legend: {
    show: false,
    position: 'bottom',
    fontFamily: cfFontFamily,
    fontWeight: 400,
    labels: {
      colors: colors.mutedColor,
      useSeriesColors: false,
    },
    markers: {
      width: 10,
      height: 10,
      strokeWidth: 0,
      strokeColor: '#fff',
      radius: 6,
    },
    itemMargin: {
      horizontal: 10,
      vertical: 0
    },
    onItemClick: {
      toggleDataSeries: true
    },
    onItemHover: {
      highlightDataSeries: true
    },
  },
  grid: {
    show: true,
    borderColor: colors.borderColor,
    strokeDashArray: 0,
    position: 'back',
    xaxis: {
      lines: {
        show: false
      }
    },
    yaxis: {
      lines: {
        show: true
      }
    },
    row: {
      colors: undefined,
      opacity: 0.5
    },
    column: {
      colors: undefined,
      opacity: 0.5
    },
    padding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: 0
    },
  },
  tooltip: {
    style: {
      fontSize: '12px',
      fontFamily: cfFontFamily,
    },
  }
};
var areachartCtn = document.querySelector("#areaChart");
if (areachartCtn) {
  var areachart = new ApexCharts(areachartCtn, areaChartOptions);
  areachart.render();
}

// line chart widget
var lineChartWidgetoptions = {
  series: [{
    name: 'Page views',
    data: [31, 28, 30, 51, 42, 88, 86, 31, 40, 28, 31, 58, 30, 51, 42, 109, 100, 116]
  }, {
    name: 'Visitors',
    data: [11, 45, 20, 32, 34, 52, 41, 11, 32, 45, 11, 75, 20, 32, 34, 52, 41, 81]
  }],
  chart: {
    height: 140,
    type: 'line',
    background : 'transparent',
    toolbar: {
      show: false,
    },
    zoom: {
      enabled: false
    },
  },
  theme: {
      mode: colors.chartTheme,
  },
  stroke: {
    show: true,
    curve: 'straight',
    lineCap: 'butt',
    colors: chartColors,
    width: [3, 2],
    dashArray: [0, 0],
  },
  dataLabels: {
    enabled: false,
  },
  markers: {
    size: 0,
  },
  xaxis: {
    type: 'datetime',
    categories: ['01/01/2020 GMT', '01/02/2020 GMT', '01/03/2020 GMT', '01/04/2020 GMT', '01/05/2020 GMT',
      '01/06/2020 GMT', '01/07/2020 GMT', '01/08/2020 GMT', '01/09/2020 GMT', '01/10/2020 GMT', '01/11/2020 GMT',
      '01/12/2020 GMT', '01/13/2020 GMT', '01/14/2020 GMT', '01/15/2020 GMT', '01/16/2020 GMT', '01/17/2020 GMT', '01/18/2020 GMT'
    ],
    labels: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false, // hide bottom tick
    },
  },
  yaxis: {
    labels: {
      show: false,
    },
  },
  legend: {
    show: false,
  },
  grid: {
    show: false,
    padding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: -5,
    },
  }
};
var lineChartWidgetCtn = document.querySelector("#lineChartWidget");
if (lineChartWidgetCtn) {
  var lineChartWidget = new ApexCharts(lineChartWidgetCtn, lineChartWidgetoptions);
  lineChartWidget.render();
}

// line chart widget
var lineChartWidget2options = {
  series: [{
    name: 'Page views',
    data: [31, 28, 30, 51, 42, 88, 86, 31, 40, 28, 31, 58, 30, 51, 42, 109, 100, 116]
  }, {
    name: 'Visitors',
    data: [11, 45, 20, 32, 34, 52, 41, 11, 32, 45, 11, 75, 20, 32, 34, 52, 41, 81]
  }],
  chart: {
    height: 140,
    type: 'line',
    background : 'transparent',
    toolbar: {
      show: false,
    },
    zoom: {
      enabled: false
    },
  },
  theme: {
      mode: colors.chartTheme,
  },
  stroke: {
    show: true,
    curve: 'smooth',
    lineCap: 'butt',
    colors: chartColors,
    width: [3, 1],
    dashArray: [0, 0],
  },
  dataLabels: {
    enabled: false,
  },
  markers: {
    size: 0,
  },
  xaxis: {
    type: 'datetime',
    categories: ['01/01/2020 GMT', '01/02/2020 GMT', '01/03/2020 GMT', '01/04/2020 GMT', '01/05/2020 GMT',
      '01/06/2020 GMT', '01/07/2020 GMT', '01/08/2020 GMT', '01/09/2020 GMT', '01/10/2020 GMT', '01/11/2020 GMT',
      '01/12/2020 GMT', '01/13/2020 GMT', '01/14/2020 GMT', '01/15/2020 GMT', '01/16/2020 GMT', '01/17/2020 GMT', '01/18/2020 GMT'
    ],
    labels: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false, // hide bottom tick
    },
  },
  yaxis: {
    labels: {
      show: false,
    },
  },
  legend: {
    show: false,
  },
  grid: {
    show: false,
    padding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: -5,
    },
  }
};
var lineChartWidget2Ctn = document.querySelector("#lineChartWidget2");
if (lineChartWidget2Ctn) {
  var lineChartWidget2 = new ApexCharts(lineChartWidget2Ctn, lineChartWidget2options);
  lineChartWidget2.render();
}

var radialbarWidgetOptions = {
  series: [86],
  chart: {
    height: 120,
    type: 'radialBar',
    background : 'transparent'
  },
  theme: {
      mode: colors.chartTheme,
  },
  plotOptions: {
    radialBar: {
      hollow: {
        size: '70%',
      },
      track: {
        background: colors.borderColor,
      },
      dataLabels: {
        show: true,
        name: {
          fontSize: '0.875rem',
          fontWeight: 400,
          offsetY: -10,
          show: false,
          color: colors.mutedColor,
          fontFamily: cfFontFamily,
        },
        value: {
          formatter: function(val) {
            return parseInt(val);
          },
          // color: '#111',
          fontSize: '1.53125rem',
          fontWeight: 700,
          fontFamily: cfFontFamily,
          offsetY: 10,
          show: true,
          color: colors.headingColor,
        },
        total: {
          show: false,
          fontSize: '0.875rem',
          fontWeight: 400,
          offsetY: -10,
          label: 'Percent',
          color: colors.mutedColor,
          fontFamily: cfFontFamily,
        }
      },
    },
  },
  colors : [extra.primaryColorLight],
  fill: {
    type: 'gradient',
    gradient: {
      shade: 'light',
      type: 'diagonal2',
      shadeIntensity: 0.2,
      gradientToColors: [base.primaryColor],
      inverseColors: true,
      opacityFrom: 1,
      opacityTo: 1,
      stops: [20, 100]
    }
  },
  stroke: {
    lineCap: 'round'
  },
};
var radialbarWidget = document.querySelector("#radialbarWidget");
if (radialbarWidget) {
  var radialbarWidgetChart = new ApexCharts(radialbarWidget, radialbarWidgetOptions);
  radialbarWidgetChart.render();
}

// Radar chart widget
var radarChartWidgetOptions = {
  series: [{
    name: 'Mac Os',
    data: [52, 50, 44, 40, 46, 44],
  }, {
    name: 'Windows',
    data: [20, 30, 40, 32, 20, 32],
  }, {
    name: 'iOS',
    data: [24, 26, 18, 23, 13, 20],
  }, {
    name: 'Android',
    data: [14, 16, 8, 13, 13, 12],
  }],
  chart: {
    height: 180,
    type: 'radar',
    background : 'transparent',
    toolbar: {
      show: false,
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  plotOptions: {
     radar: {
       polygons: {
         strokeColors: colors.borderColor,
         strokeWidth: 1,
         connectorColors: colors.borderColor,
         fill: {
           colors: ['transparent'],
         }
       }
     }
   },
  legend: {
    show: false,
  },
  stroke: {
    width: 1,
    colors: chroma.scale(chartColors).colors(4),
    lineCap: 'round',
  },
  fill: {
    opacity: 1,
    colors: chroma.scale(chartColors).colors(4),
  },
  markers: {
    size: 0
  },
  yaxis: {
    labels: {
      style: {
        colors: colors.mutedColor,
        fontFamily: cfFontFamily,
      }
    },
  },
  xaxis: {
    categories: ['01', '02', '03', '04', '05', '06'],
    labels: {
      title: {
        colors: colors.mutedColor,
        fontFamily: cfFontFamily,
      }
    },
  },
  grid: {
    borderColor: colors.borderColor,
    padding: {
      top: -10,
      bottom: -10,
    }
  },
};

var radarChartWidgetCtn = document.querySelector("#radarChartWidget");
if (radarChartWidgetCtn) {
  var radarChartWidget = new ApexCharts(radarChartWidgetCtn, radarChartWidgetOptions);
  radarChartWidget.render();
}

// pie chart widget
var pieChartWidgetOptions = {
  series: [686, 575, 426],
  chart: {
    type: 'donut',
    background : 'transparent',
    height: 160,
    zoom: {
      enabled: false
    },
    toolbar: {
      show: false,
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  plotOptions: {
    pie: {
      donut: {
        size: '0'
      },
      expandOnClick: false
    }
  },
  labels: ['Desktop', 'Tablet', 'Mobile'],
  dataLabels: {
    enabled: true,
    style: {
      fontSize: '10px',
      fontFamily: cfFontFamily,
      fontWeight: '300',
    },
  },
  legend: {
    show: false,
  },
  stroke: {
    show: true,
    colors: [colors.whiteColor],
    width: 5,
    dashArray: 0,
  },
  colors: [extra.primaryColorLighter, base.primaryColor, extra.primaryColorDark],
};

var pieChartWidgetCtn = document.querySelector("#pieChartWidget");
if (pieChartWidgetCtn) {
  var pieChartWidget = new ApexCharts(pieChartWidgetCtn, pieChartWidgetOptions);
  pieChartWidget.render();
}

var pieChartWidget2Options = {
  series: [686, 575, 426],
  chart: {
    type: 'donut',
    background : 'transparent',
    height: 160,
    zoom: {
      enabled: false
    },
    toolbar: {
      show: false,
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  plotOptions: {
    pie: {
      donut: {
        size: '0'
      },
      expandOnClick: true
    }
  },
  labels: ['Desktop', 'Tablet', 'Mobile'],
  dataLabels: {
    enabled: true,
    style: {
      fontSize: '10px',
      fontFamily: cfFontFamily,
      fontWeight: '300',
    },
  },
  legend: {
    show: false,
  },
  stroke: {
    show: false,
    colors: [colors.borderColor],
    width: 5,
    dashArray: 0,
  },
  colors:  chroma.scale(chartColors).colors(3),
  fill: {
    opacity: 1,
  },
};

var pieChartWidget2Ctn = document.querySelector("#pieChartWidget2");
if (pieChartWidget2Ctn) {
  var pieChartWidget2 = new ApexCharts(pieChartWidget2Ctn, pieChartWidget2Options);
  pieChartWidget2.render();
}


// donut chart widget
var donutChartWidgetOptions = {
  series: [44, 55, 20, 41],
  chart: {
    type: 'donut',
    background : 'transparent',
    height: 180,
    zoom: {
      enabled: false
    },
    toolbar: {
      show: false,
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  plotOptions: {
    pie: {
      donut: {
        size: '40%',
        background: 'transparent',
      },
      expandOnClick: false
    }
  },
  labels: ['Clothing', 'Shoes', 'Others', 'Electronics' ],
  dataLabels: {
    enabled: true,
    style: {
      fontSize: '10px',
      fontFamily: cfFontFamily,
      fontWeight: '300',
    },
  },
  legend: {
    show: false,
  },
  stroke: {
    show: false,
    colors: colors.borderColor,
    width: 1,
    dashArray: 0,
  },
  colors: chroma.scale(chartColors).colors(4),
  fill: {
    opacity: 1,
  }
};

var donutChartWidgetCtn = document.querySelector("#donutChartWidget");
if (donutChartWidgetCtn) {
  var donutChartWidget = new ApexCharts(donutChartWidgetCtn, donutChartWidgetOptions);
  donutChartWidget.render();
}

// bar chart widget
var barChartWidgetoptions = {
  series: [{
    name: 'Total',
    data: [22, 43, 36, 44, 55, 41, 54]
  }, {
    name: 'Revenue',
    data: [13, 24, 26, 33, 32, 33, 42]
  }],
  chart: {
    type: 'bar',
    height: 200,
    stacked: true,
    background : 'transparent',
    zoom: {
      enabled: true
    },
    toolbar: {
      show: false
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  dataLabels: {
    enabled: false,
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '40%',
      distributed: false,
      colors: {
          backgroundBarColors: [colors.backgroundColor, colors.backgroundColor, colors.backgroundColor, colors.backgroundColor],
      },
    },
  },
  xaxis: {
    categories: ['Monday', 'Tuesday', 'Wednesday', 'Thusday', 'Friday', 'Saturday', 'Sunday'],
    labels: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false, // hide bottom tick
    },
  },
  yaxis: {
    labels: {
      show: false,
    },
  },
  legend: {
    show: false,
  },
  colors: [base.primaryColor, extra.primaryColorLighter],
  fill: {
    opacity: 1,
  },
  grid: {
    show: false,
    padding: {
      bottom : -10,
    },
    position: 'back'
  }
};
var barChartWidgetCtn = document.querySelector("#barChartWidget");
if (barChartWidgetCtn) {
  var barChartWidget = new ApexCharts(barChartWidgetCtn, barChartWidgetoptions);
  barChartWidget.render();
}

// bar chart widget 2
var barChartWidget2options = {
  series: [{
    name: 'Revenue',
    data: [84, 75, 62, 54, 50, 45, 42]
  }],
  chart: {
    type: 'bar',
    height: 220,
    stacked: true,
    background : 'transparent',
    zoom: {
      enabled: true
    },
    toolbar: {
      show: false
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  dataLabels: {
    enabled: true,
    textAnchor: 'start',
    style: {
      fontFamily: base.fontFamily,
      fontWeight: 300,
    },
    formatter: function (val, opt) {
      return opt.w.globals.labels[opt.dataPointIndex]
    },
  },
  plotOptions: {
    bar: {
      barHeight: '100%',
      distributed: true,
      horizontal: true,
      dataLabels: {
        position: 'bottom'
      }
    }
  },
  xaxis: {
    categories: ['Monday', 'Tuesday', 'Wednesday', 'Thusday', 'Friday', 'Saturday', 'Sunday'],
    labels: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false, // hide bottom tick
    },
  },
  yaxis: {
    labels: {
      show: false,
    },
    //reversed: true,
  },
  legend: {
    show: false,
  },
  fill: {
    type: 'solid',
    opacity: 1,
    colors: chroma.scale([base.primaryColor, colors.whiteColor]).colors(8),
  },
  grid: {
    show: false,
    padding: {
      top: -15,
      right: -15,
      bottom: -15,
      left: -10,
    },
  },
};
var barChartWidget2Ctn = document.querySelector("#barChartWidget2");
if (barChartWidget2Ctn) {
  var barChartWidget2 = new ApexCharts(barChartWidget2Ctn, barChartWidget2options);
  barChartWidget2.render();
}



// area chart widget
var areaChartWidgetOptions = {
  series: [{
      name: 'Website',
      data: [ 49, 40, 31, 40, 28, 31, 38, 30, 51, 42, 60, 55, 62]
    }, {
      name: 'Mobile Apps',
      data: [32, 31, 11, 32, 45, 11, 45, 20, 32, 34, 52, 41, 50]
    }
  ],
  chart: {
    type: 'area',
    height: 190,
    stacked: true,
    background : 'transparent',
    toolbar: {
      show: false
    },
    zoom: {
      enabled: true
    },
  },
  theme: {
      mode: colors.chartTheme,
  },
  xaxis: {
    type: 'datetime',
    categories: ['01/01/2020 GMT', '01/02/2020 GMT', '01/03/2020 GMT', '01/04/2020 GMT', '01/05/2020 GMT',
      '01/06/2020 GMT', '01/07/2020 GMT', '01/08/2020 GMT', '01/09/2020 GMT', '01/10/2020 GMT', '01/11/2020 GMT',
      '01/12/2020 GMT', '01/13/2020 GMT'
    ],
    labels: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false, // hide bottom tick
    },
    floating: true,
  },
  yaxis: {
    labels: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
  },
  colors: chartColors,
  dataLabels: {
    show: false,
    enabled: false,
  },
  stroke: {
    curve: 'smooth',
    width: 0,
  },
  fill: {
    type: 'gradient',
    gradient: {
      shade: 'light',
      type: "vertical",
      shadeIntensity: 0.5,
      gradientToColors: undefined, // optional, if not defined - uses the shades of same color in series
      //inverseColors: true,
      opacityFrom: .9,
      opacityTo: .2,
      stops: [0, 90, 100],
      colorStops: []
    }
  },
  legend: {
    show: false,
  },
  grid: {
    show: false,
    padding: {
      top: -15,
      right: 0,
      bottom: -10,
      left: -15,
    },
  },
};
var areaChartWidgetCtn = document.querySelector("#areaChartWidget");
if (areaChartWidgetCtn) {
  var areaChartWidget = new ApexCharts(areaChartWidgetCtn, areaChartWidgetOptions);
  areaChartWidget.render();
}

// combo chart
var comboChartoptions = {
  series: [{
    name: 'Visitors',
    type: 'column',
    data: [11, 45, 20, 32, 34, 52, 41, 22, 32, 45, 11, 75, 20, 32, 34, 52, 41, 81]
  },{
    name: 'Page views',
    type: 'line',
    data: [31, 28, 30, 51, 42, 109, 100, 31, 40, 28, 31, 58, 30, 51, 42, 109, 100, 116]
  }, 
  {
    name: 'Visitors',
    type: 'column',
    data: [31, 28, 30, 51, 42, 109, 100, 31, 40, 28, 31, 58, 30, 51, 42, 109, 100, 116]
  }],
  chart: {
    height: 350,
    type: 'line',
    background : 'transparent',
    // columnWidth: '20%',
    zoom: {
      enabled: false
    },
    toolbar: {
      show : false
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  dataLabels: {
    enabled: true,
    enabledOnSeries: [1],
    style: {
        fontSize: '10px',
        fontFamily: base.fontFamily,
        colors : chartColors,
    },
    background: {
      enabled: true,
      padding: 4,
      borderRadius: 4,
      borderColor : chroma(chartColors[1]).darken(2),
    }
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '40%',
      enableShades: false,
      barHeight: '100%',
    },
  },
  stroke: {
    show: true,
    curve: 'straight',
    lineCap: 'round',
    colors: ['transparent', chartColors[1], 'transparent'], // add spacing 
    width: [2, 1, 2],
    dashArray: [0, 0, 0],
  },
  responsive: [{
    breakpoint: 480,
    options: {
      legend: {
        position: 'bottom',
        offsetX: -10,
        offsetY: 0
      }
    }
  }],
  colors: chartColors,
  fill: {
    type: 'solid'
  },
  markers: {
    size: 4,
    colors: chartColors,
    strokeColors: ['#fff'],
    strokeWidth: 2,
    strokeOpacity: 0.9,
    strokeDashArray: 0,
    fillOpacity: 1,
    discrete: [],
    shape: "circle",
    radius: 2,
    offsetX: 0,
    offsetY: 0,
    onClick: undefined,
    onDblClick: undefined,
    showNullDataPoints: true,
    hover: {
      size: undefined,
      sizeOffset: 3
    }
  },
  xaxis: {
    type: 'datetime',
    categories: ['01/01/2020 GMT', '01/02/2020 GMT', '01/03/2020 GMT', '01/04/2020 GMT', '01/05/2020 GMT',
      '01/06/2020 GMT', '01/07/2020 GMT', '01/08/2020 GMT', '01/09/2020 GMT', '01/10/2020 GMT', '01/11/2020 GMT',
      '01/12/2020 GMT', '01/13/2020 GMT', '01/14/2020 GMT', '01/15/2020 GMT', '01/16/2020 GMT', '01/17/2020 GMT', '01/18/2020 GMT'
    ],
    labels: {
      show: true,
      trim: false,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    },
    axisBorder: {
      show: false,
    },
  },
  yaxis: {
    labels: {
      show: true,
      trim: false,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    },
  },
  legend: {
    position: 'top',
    fontFamily: cfFontFamily,
    offsetX: 10,
    fontWeight: 400,
    labels: {
      colors: colors.mutedColor,
      useSeriesColors: false,
    },
    markers: {
      width: 10,
      height: 10,
      strokeWidth: 0,
      strokeColor: colors.borderColor,
      radius: 6,
      customHTML: undefined,
      onClick: undefined,
      offsetX: 0,
      offsetY: 0
    },
    itemMargin: {
      horizontal: 10,
      vertical: 0
    },
    onItemClick: {
      toggleDataSeries: true
    },
    onItemHover: {
      highlightDataSeries: true
    },
  },
  grid: {
    show: true,
    borderColor: colors.borderColor,
    strokeDashArray: 0,
    position: 'back',
    xaxis: {
      lines: {
        show: false
      }
    },
    yaxis: {
      lines: {
        show: true
      }
    },
    row: {
      colors: undefined,
      opacity: 0.5
    },
    column: {
      colors: undefined,
      opacity: 0.5
    },
    padding: {
      top: 0,
      right: 15,
      bottom: 0,
      left: 0
    },
  },
};
var comboChartCtn = document.querySelector("#comboChart");
if (comboChartCtn) {
  var comboChart = new ApexCharts(comboChartCtn, comboChartoptions);
  comboChart.render();
}

// column chart widget
var columnChartWidgetoptions = {
  series: [{
    name: 'Orders',
    data: [32, 66, 44, 55, 41, 24, 67, 22, 43, 32, 66, 44, 55]
  }, {
    name: 'Visitors',
    data: [7, 30, 13, 23, 20, 12, 8, 13, 27, 7, 30, 13, 23]
  }],
  chart: {
    type: 'bar',
    height: 150,
    stacked: false,
    // columnWidth: '60%',
    background : 'transparent',
    toolbar: {
      show: false,
    },
    zoom: {
      enabled: false
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  dataLabels: {
    enabled: false,
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '50%',
      radius: 30,
      enableShades: false,
      endingShape: 'rounded',
    },
  },
  xaxis: {
    type: 'datetime',
    categories: ['01/01/2020 GMT', '01/02/2020 GMT', '01/03/2020 GMT', '01/04/2020 GMT', '01/05/2020 GMT',
      '01/06/2020 GMT', '01/07/2020 GMT', '01/08/2020 GMT', '01/09/2020 GMT', '01/10/2020 GMT', '01/11/2020 GMT',
      '01/12/2020 GMT', '01/13/2020 GMT'
    ],
    labels: {
      show: false,
    },
    axisTicks: {
      show: false, // hide bottom tick
    },
    axisBorder: {
      show: false,
    },
  },
  yaxis: {
    labels: {
      show: false,
    },
  },
  legend: {
    show: false,
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent']
  },
  colors: chartColors,
  fill: {
    opacity: 1,
  },
  grid: {
    show: false,
    padding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: -15,
    },
  }
};

var columnChartWidgetCtn = document.querySelector("#columnChartWidget");
if (columnChartWidgetCtn) {
  var columnChartWidget = new ApexCharts(columnChartWidgetCtn, columnChartWidgetoptions);
  columnChartWidget.render();
}

// column chart widget
var columnChartWidget2options = {
  series: [{
    name: 'Orders',
    data: [32, 66, 44, 55, 41, 24, 67, 22, 43, 32, 66, 44, 55, 41, 24, 67, 22, 43]
  }, {
    name: 'Visitors',
    data: [7, 30, 13, 23, 20, 12, 8, 13, 27, 7, 30, 13, 23, 20, 12, 8, 13, 27]
  }],
  chart: {
    type: 'bar',
    height: 240,
    stacked: false,
    columnWidth: '70%',
    toolbar: {
      show: false,
    },
    zoom: {
      enabled: false
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  dataLabels: {
    enabled: false,
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '40%',
      radius: 30,
      enableShades: false,
      endingShape: 'rounded',
    },
  },
  xaxis: {
    type: 'datetime',
    categories: ['01/01/2020 GMT', '01/02/2020 GMT', '01/03/2020 GMT', '01/04/2020 GMT', '01/05/2020 GMT',
      '01/06/2020 GMT', '01/07/2020 GMT', '01/08/2020 GMT', '01/09/2020 GMT', '01/10/2020 GMT', '01/11/2020 GMT',
      '01/12/2020 GMT', '01/13/2020 GMT', '01/14/2020 GMT', '01/15/2020 GMT', '01/16/2020 GMT', '01/17/2020 GMT', '01/18/2020 GMT'
    ],
    labels: {
      show: true,
      trim: true,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    },
    axisTicks: {
      show: false, // hide bottom tick
    },
    axisBorder: {
      show: false,
    },
  },
  yaxis: {
    labels: {
      show: false,
    },
  },
  legend: {
    show: false,
  },
  fill: {
    opacity: 1,
    colors: [base.primaryColor, extra.primaryColorLighter]
  },
  grid: {
    show: false,
    padding: {
      top: 0,
      right: 0,
      bottom: -15,
      left: -15,
    },
  }
};

var columnChartWidget2Ctn = document.querySelector("#columnChartWidget2");
if (columnChartWidget2Ctn) {
  var columnChartWidget2 = new ApexCharts(columnChartWidget2Ctn, columnChartWidget2options);
  columnChartWidget2.render();
}

// heatmap chart widget
var heatmapChartWidgetOptions = {
  series: [{
      name: 'Mon',
      data: [61, 98, 16, 9, 97, 20, 14, 18, 19, 33, 76, 78]
    }, {
      name: 'Tue',
      data: [77, 76, 10, 47, 13, 56, 71, 83, 32, 57, 87, 96]
    },
    {
      name: 'Wed',
      data: [48, 23, 27, 90, 37, 32, 88, 96, 65, 46, 63, 17]
    },
    {
      name: 'Thu',
      data: [70, 33, 71, 90, 34, 63, 93, 80, 39, 40, 41, 67]
    },
    {
      name: 'Fri',
      data: [78, 98, 19, 74, 41, 59, 95, 99, 37, 17, 11, 60]
    },
    {
      name: 'Sat',
      data: [46, 95, 52, 36, 34, 65, 2, 3, 13, 77, 72, 71]
    },
    {
      name: 'Sun',
      data: [2, 93, 68, 3, 53, 56, 79, 64, 46, 14, 22, 94]
    }
  ],
  chart: {
    height: 190,
    type: 'heatmap',
    background : 'transparent',
    toolbar: {
      show: false
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  dataLabels: {
    enabled: false
  },
  colors: chroma.scale(chartColors).colors(7),
  xaxis: {
    type: 'category',
    categories: ['09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '01:00', '01:30', '02:00', '02:30'],
    labels: {
      show: false,
      maxHeight: 0,
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false, // hide bottom tick
    },
  },
  yaxis: {
    labels: {
      show: false,
      maxHeight: 0,
    },
  },
  grid: {
    show: false,
    padding: {
      top: -10,
      right: 10,
      bottom: 0,
      left: 0
    },
  },
  stroke: {
      show: true,
      colors: [colors.borderColor],
      width: 1,
      dashArray: 0,
  }
};
var heatmapChartWidgetCtn = document.querySelector("#heatmapChartWidget");
if (heatmapChartWidgetCtn) {
  var heatmapChartWidget = new ApexCharts(heatmapChartWidgetCtn, heatmapChartWidgetOptions);
  heatmapChartWidget.render();
}

// heatmap chart
var heatmapChartOptions = {
  series: [{
      name: 'Set 1',
      data: [61, 98, 16, 9, 97, 20, 14, 18, 19, 33, 76, 78, 63, 89, 99, 30]
    }, {
      name: 'Set 2',
      data: [77, 76, 10, 47, 13, 56, 71, 83, 32, 57, 87, 96, 99, 85, 1, 15]
    },
    {
      name: 'Set 3',
      data: [48, 23, 27, 90, 37, 32, 88, 96, 65, 46, 63, 17, 40, 42, 77, 41]
    },
    {
      name: 'Set 4',
      data: [70, 33, 71, 90, 34, 63, 93, 80, 39, 40, 41, 67, 86, 8, 91, 79]
    },
    {
      name: 'Set 5',
      data: [78, 98, 19, 74, 41, 59, 95, 99, 37, 17, 11, 60, 44, 7, 61, 39]
    },
    {
      name: 'Set 6',
      data: [46, 95, 52, 36, 34, 65, 2, 3, 13, 77, 72, 71, 93, 25, 83, 98]
    },
    {
      name: 'Set 7',
      data: [2, 93, 68, 3, 53, 56, 79, 64, 46, 14, 22, 94, 60, 81, 51, 15]
    },
    {
      name: 'Set 8',
      data: [13, 1, 45, 30, 19, 71, 86, 51, 59, 9, 28, 95, 61, 6, 37, 54]
    }
  ],
  chart: {
    height: 350,
    type: 'heatmap',
    background : 'transparent',
    toolbar: {
      show: false
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  dataLabels: {
    enabled: false,
  },
  colors: chartAdjColors,
  xaxis: {
    type: 'category',
    categories: ['09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '01:00', '01:30', '02:00', '02:30', '03:00', '03:30', '04:00', '04:30'],
    labels: {
      show: true,
      trim: false,
      minHeight: undefined,
      maxHeight: 100,
      style: {
        fontSize: '0.875rem',
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      },
    },
    axisBorder: {
      show: false,
    },
  },
  yaxis: {
    labels: {
      show: true,
      trim: false,
      offsetX: -10,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        fontSize: '0.875rem',
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    },
  },
  grid: {
    show: true,
    borderColor: colors.borderColor,
    strokeDashArray: 0,
    position: 'back',
    xaxis: {
      lines: {
        show: false
      }
    },
    yaxis: {
      lines: {
        show: true
      }
    },
    row: {
      colors: undefined,
      opacity: 0.5
    },
    column: {
      colors: undefined,
      opacity: 0.5
    },
    padding: {
      top: 0,
      right: 10,
      bottom: 0,
      left: 0
    },
  },
  stroke: {
    colors: [colors.borderColor],
    width: 1,
  }
};
var heatmapchartCtn = document.querySelector("#heatmapChart");
if (heatmapchartCtn) {
  var heatmapchart = new ApexCharts(heatmapchartCtn, heatmapChartOptions);
  heatmapchart.render();
}


// bubble chart
var bubbleChartOptions = {
  series: [{
      name: 'Type 1',
      data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
        min: 10,
        max: 60
      })
    },
    {
      name: 'Type 2',
      data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
        min: 10,
        max: 60
      })
    },
    {
      name: 'Type 3',
      data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
        min: 10,
        max: 60
      })
    },
    {
      name: 'Type 4',
      data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
        min: 10,
        max: 60
      })
    }
  ],
  chart: {
    height: 350,
    type: 'bubble',
    background : 'transparent',
    zoom: {
      enabled: false
    },
    sparkline: {
        enabled: false,
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  dataLabels: {
    enabled: false
  },
  colors: chartAdjColors,
  xaxis: {
    tickAmount: 12,
    type: 'category',
    labels: {
      show: true,
      trim: false,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    },
    axisBorder: {
      show: false,
    },
  },
  yaxis: {
    labels: {
      show: true,
      trim: false,
      offsetX: -10,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    },
  },
  legend: {
    position: 'top',
    fontFamily: cfFontFamily,
    fontWeight: 400,
    labels: {
      colors: colors.mutedColor,
      useSeriesColors: false
    },
    markers: {
      width: 10,
      height: 10,
      strokeWidth: 0,
      strokeColor: colors.borderColor,
      radius: 6,
    },
    itemMargin: {
      horizontal: 10,
      vertical: 0
    },
    onItemClick: {
      toggleDataSeries: true
    },
    onItemHover: {
      highlightDataSeries: true
    },
  },
  markers: {
     // size: 6,
     strokeWidth: 0,
     //strokeColors: [colors.borderColor]
  },
  grid: {
    show: true,
    borderColor: colors.borderColor,
    strokeDashArray: 0,
    position: 'back',
    xaxis: {
      lines: {
        show: false
      }
    },
    yaxis: {
      lines: {
        show: true
      }
    },
    row: {
      colors: undefined,
      opacity: 0.5
    },
    column: {
      colors: undefined,
      opacity: 0.5
    },
    padding: {
      top: 0,
      right: 10,
      bottom: 0,
      left: 0
    },
  },
};
var bubblechartCtn = document.querySelector("#bubbleChart");
if (bubblechartCtn) {
  var bubblechart = new ApexCharts(bubblechartCtn, bubbleChartOptions);
  bubblechart.render();
}
// Donut Chart
var donutChartOptions = {
  series: [44, 55, 20, 41, 17],
  chart: {
    type: 'donut',
    background : 'transparent',
    height: 305,
    zoom: {
      enabled: false
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  plotOptions: {
    pie: {
      donut: {
        size: '40%'
      },
      expandOnClick: false
    }
  },
  labels: ['Clothing', 'Shoes', 'Others', 'Electronics', 'Books', ],
  legend: {
    position: 'bottom',
    fontFamily: cfFontFamily,
    fontWeight: 400,
    labels: {
      colors: colors.mutedColor,
      useSeriesColors: false,
    },
    horizontalAlign: 'left',
    fontFamily: cfFontFamily,
    markers: {
      width: 10,
      height: 10,
      strokeWidth: 0,
      strokeColor: '#fff',
      radius: 6,
    },
    itemMargin: {
      horizontal: 10,
      vertical: 2
    },
    onItemClick: {
      toggleDataSeries: true
    },
    onItemHover: {
      highlightDataSeries: true
    },
  },
  stroke: {
    colors: [colors.borderColor],
    width: 1,
  },
  colors: chroma.scale(chartColors).colors(5),
  fill: {
    opacity: 1,
  },
};

var donutchartCtn = document.querySelector("#donutChart");
if (donutchartCtn) {
  var donutchart = new ApexCharts(donutchartCtn, donutChartOptions);
  donutchart.render();
}
// Radar Chart
var radarChartOptions = {
  series: [{
    name: 'Mac Os',
    data: [65, 66, 84, 82, 70, 68],
  }, {
    name: 'Windows',
    data: [25, 30, 40, 60, 50, 40],
  }, {
    name: 'iOS',
    data: [44, 56, 58, 43, 43, 30],
  }],
  chart: {
    height: 245,
    type: 'radar',
    background : 'transparent',
    toolbar: {
      show:false,
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  plotOptions: {
     radar: {
       polygons: {
         strokeColors: colors.borderColor,
         strokeWidth: 1,
         connectorColors: colors.borderColor,
         fill: {
           colors: ['transparent'],
         }
       }
     }
   },
  legend: {
    fontFamily: cfFontFamily,
    fontWeight: 400,
    labels: {
      colors: colors.mutedColor,
    },
  },
  stroke: {
    width: 2,
    colors: chartAdjColors
  },
  colors: chartAdjColors,
  fill: {
    opacity: 1,
  },
  markers: {
    size: 0
  },
  xaxis: {
    categories: ['01', '02', '03', '04', '05', '06']
  }
};

var radarChartCtn = document.querySelector("#radarChart");
if (radarChartCtn) {
  var radarchart = new ApexCharts(radarChartCtn, radarChartOptions);
  radarchart.render();
}
// Candle Stick Chart
var candleChartOptions = {
  series: [{
    data: [{
        x: new Date(1538778600000),
        y: [6629.81, 6650.5, 6623.04, 6633.33]
      },
      {
        x: new Date(1538780400000),
        y: [6632.01, 6643.59, 6620, 6630.11]
      },
      {
        x: new Date(1538782200000),
        y: [6630.71, 6648.95, 6623.34, 6635.65]
      },
      {
        x: new Date(1538784000000),
        y: [6635.65, 6651, 6629.67, 6638.24]
      },
      {
        x: new Date(1538785800000),
        y: [6638.24, 6640, 6620, 6624.47]
      },
      {
        x: new Date(1538787600000),
        y: [6624.53, 6636.03, 6621.68, 6624.31]
      },
      {
        x: new Date(1538789400000),
        y: [6624.61, 6632.2, 6617, 6626.02]
      },
      {
        x: new Date(1538791200000),
        y: [6627, 6627.62, 6584.22, 6603.02]
      },
      {
        x: new Date(1538793000000),
        y: [6605, 6608.03, 6598.95, 6604.01]
      },
      {
        x: new Date(1538794800000),
        y: [6604.5, 6614.4, 6602.26, 6608.02]
      },
      {
        x: new Date(1538796600000),
        y: [6608.02, 6610.68, 6601.99, 6608.91]
      },
      {
        x: new Date(1538798400000),
        y: [6608.91, 6618.99, 6608.01, 6612]
      },
      {
        x: new Date(1538800200000),
        y: [6612, 6615.13, 6605.09, 6612]
      },
      {
        x: new Date(1538802000000),
        y: [6612, 6624.12, 6608.43, 6622.95]
      },
      {
        x: new Date(1538803800000),
        y: [6623.91, 6623.91, 6615, 6615.67]
      },
      {
        x: new Date(1538805600000),
        y: [6618.69, 6618.74, 6610, 6610.4]
      },
      {
        x: new Date(1538807400000),
        y: [6611, 6622.78, 6610.4, 6614.9]
      },
      {
        x: new Date(1538809200000),
        y: [6614.9, 6626.2, 6613.33, 6623.45]
      },
      {
        x: new Date(1538811000000),
        y: [6623.48, 6627, 6618.38, 6620.35]
      },
      {
        x: new Date(1538812800000),
        y: [6619.43, 6620.35, 6610.05, 6615.53]
      },
      {
        x: new Date(1538814600000),
        y: [6615.53, 6617.93, 6610, 6615.19]
      },
      {
        x: new Date(1538816400000),
        y: [6615.19, 6621.6, 6608.2, 6620]
      },
      {
        x: new Date(1538818200000),
        y: [6619.54, 6625.17, 6614.15, 6620]
      },
      {
        x: new Date(1538820000000),
        y: [6620.33, 6634.15, 6617.24, 6624.61]
      },
      {
        x: new Date(1538821800000),
        y: [6625.95, 6626, 6611.66, 6617.58]
      },
      {
        x: new Date(1538823600000),
        y: [6619, 6625.97, 6595.27, 6598.86]
      },
      {
        x: new Date(1538825400000),
        y: [6598.86, 6598.88, 6570, 6587.16]
      },
      {
        x: new Date(1538827200000),
        y: [6588.86, 6600, 6580, 6593.4]
      },
      {
        x: new Date(1538829000000),
        y: [6593.99, 6598.89, 6585, 6587.81]
      },
      {
        x: new Date(1538830800000),
        y: [6587.81, 6592.73, 6567.14, 6578]
      },
      {
        x: new Date(1538832600000),
        y: [6578.35, 6581.72, 6567.39, 6579]
      },
      {
        x: new Date(1538834400000),
        y: [6579.38, 6580.92, 6566.77, 6575.96]
      },
      {
        x: new Date(1538836200000),
        y: [6575.96, 6589, 6571.77, 6588.92]
      },
      {
        x: new Date(1538838000000),
        y: [6588.92, 6594, 6577.55, 6589.22]
      },
      {
        x: new Date(1538839800000),
        y: [6589.3, 6598.89, 6589.1, 6596.08]
      },
      {
        x: new Date(1538841600000),
        y: [6597.5, 6600, 6588.39, 6596.25]
      },
      {
        x: new Date(1538843400000),
        y: [6598.03, 6600, 6588.73, 6595.97]
      },
      {
        x: new Date(1538845200000),
        y: [6595.97, 6602.01, 6588.17, 6602]
      },
      {
        x: new Date(1538847000000),
        y: [6602, 6607, 6596.51, 6599.95]
      },
      {
        x: new Date(1538848800000),
        y: [6600.63, 6601.21, 6590.39, 6591.02]
      },
      {
        x: new Date(1538850600000),
        y: [6591.02, 6603.08, 6591, 6591]
      },
      {
        x: new Date(1538852400000),
        y: [6591, 6601.32, 6585, 6592]
      },
      {
        x: new Date(1538854200000),
        y: [6593.13, 6596.01, 6590, 6593.34]
      },
      {
        x: new Date(1538856000000),
        y: [6593.34, 6604.76, 6582.63, 6593.86]
      },
      {
        x: new Date(1538857800000),
        y: [6593.86, 6604.28, 6586.57, 6600.01]
      },
      {
        x: new Date(1538859600000),
        y: [6601.81, 6603.21, 6592.78, 6596.25]
      },
      {
        x: new Date(1538861400000),
        y: [6596.25, 6604.2, 6590, 6602.99]
      },
      {
        x: new Date(1538863200000),
        y: [6602.99, 6606, 6584.99, 6587.81]
      },
      {
        x: new Date(1538865000000),
        y: [6587.81, 6595, 6583.27, 6591.96]
      },
      {
        x: new Date(1538866800000),
        y: [6591.97, 6596.07, 6585, 6588.39]
      },
      {
        x: new Date(1538868600000),
        y: [6587.6, 6598.21, 6587.6, 6594.27]
      },
      {
        x: new Date(1538870400000),
        y: [6596.44, 6601, 6590, 6596.55]
      },
      {
        x: new Date(1538872200000),
        y: [6598.91, 6605, 6596.61, 6600.02]
      },
      {
        x: new Date(1538874000000),
        y: [6600.55, 6605, 6589.14, 6593.01]
      },
      {
        x: new Date(1538875800000),
        y: [6593.15, 6605, 6592, 6603.06]
      },
      {
        x: new Date(1538877600000),
        y: [6603.07, 6604.5, 6599.09, 6603.89]
      },
      {
        x: new Date(1538879400000),
        y: [6604.44, 6604.44, 6600, 6603.5]
      },
      {
        x: new Date(1538881200000),
        y: [6603.5, 6603.99, 6597.5, 6603.86]
      },
      {
        x: new Date(1538883000000),
        y: [6603.85, 6605, 6600, 6604.07]
      },
      {
        x: new Date(1538884800000),
        y: [6604.98, 6606, 6604.07, 6606]
      },
    ]
  }],
  chart: {
    type: 'candlestick',
    height: 245,
    background : 'transparent',
    zoom: {
      enabled: false,
    },
    toolbar: {
      show: false,
    }
  },
  theme: {
      mode: colors.chartTheme,
  },
  plotOptions: {
    candlestick: {
      colors: {
        upward: base.successColor,
        downward: base.dangerColor
      }
    }
  },
  xaxis: {
    type: 'datetime',
    labels: {
      show: true,
      trim: false,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    },
    axisBorder: {
      show: false,
    },
  },
  yaxis: {
    labels: {
      show: true,
      trim: false,
      offsetX: -10,
      minHeight: undefined,
      maxHeight: 120,
      style: {
        colors: colors.mutedColor,
        cssClass: 'text-muted',
        fontFamily: cfFontFamily,
      }
    },
  },
  grid: {
    show: true,
    borderColor: colors.borderColor,
    strokeDashArray: 0,
    position: 'back',
    xaxis: {
      lines: {
        show: false
      }
    },
    yaxis: {
      lines: {
        show: true
      }
    },
    row: {
      colors: undefined,
      opacity: 0.5
    },
    column: {
      colors: undefined,
      opacity: 0.5
    },
    padding: {
      top: 0,
      right: 10,
      bottom: 0,
      left: 0
    },
  },
  colors : [base.successColor, base.dangerColor]
};
var candlechartCtn = document.querySelector("#candleChart");
if (candlechartCtn) {
  var candlechart = new ApexCharts(candlechartCtn, candleChartOptions);
  candlechart.render();
}


/** Apex Gauge */
var radialbarOptions = {
  series: [70],
  chart: {
    height: 200,
    type: 'radialBar',
  },
  plotOptions: {
    radialBar: {
      hollow: {
        size: '75%',
      },
      track: {
        background: colors.borderColor,
      },
      dataLabels: {
        show: true,
        name: {
          fontSize: '0.875rem',
          fontWeight: 400,
          offsetY: -10,
          show: true,
          color: colors.mutedColor,
          fontFamily: cfFontFamily,
        },
        value: {
          formatter: function(val) {
            return parseInt(val);
          },
          color: colors.headingColor,
          fontSize: '1.53125rem',
          fontWeight: 700,
          fontFamily: cfFontFamily,
          offsetY: 5,
          show: true,
        },
        total: {
          show: true,
          fontSize: '0.875rem',
          fontWeight: 400,
          offsetY: -10,
          show: true,
          label: 'Percent',
          color: colors.mutedColor,
          fontFamily: cfFontFamily,
        }
      },
    },
  },
  colors : [extra.primaryColorLight],
  fill: {
    type: 'gradient',
    gradient: {
      shade: 'light',
      type: 'diagonal2',
      shadeIntensity: 0.2,
      gradientToColors: [base.primaryColor],
      inverseColors: true,
      opacityFrom: 1,
      opacityTo: .5,
      stops: [20, 100]
    }
  },
  stroke: {
    lineCap: 'round'
  },
  labels: ['CPU'],
};
var radialbar = document.querySelector("#radialbar");
if (radialbar) {
  var radialbarChart = new ApexCharts(radialbar, radialbarOptions);
  radialbarChart.render();
}

var radialbar2Options = {
  series: [70],
  chart: {
    height: 200,
    type: 'radialBar',
  },
  plotOptions: {
    radialBar: {
      hollow: {
        size: '68%',
      },
      track: {
        background: extra.primaryColorLight,
      },
      dataLabels: {
        show: true,
        name: {
          fontSize: '0.875rem',
          fontWeight: 400,
          offsetY: -10,
          show: true,
          color: colors.mutedColor,
          fontFamily: cfFontFamily,
        },
        value: {
          formatter: function(val) {
            return parseInt(val);
          },
          color: extra.primaryColorLighter,
          fontSize: '1.53125rem',
          fontWeight: 700,
          fontFamily: cfFontFamily,
          offsetY: 5,
          show: true,
        },
        total: {
          show: true,
          fontSize: '0.875rem',
          fontWeight: 400,
          offsetY: -10,
          show: true,
          label: 'Percent',
          color: extra.primaryColorLighter,
          fontFamily: cfFontFamily,
        }
      },
    },
  },
  colors : [colors.whiteColor],
  fill: {
    type: 'solid',
  },
  stroke: {
    lineCap: 'round'
  },
  labels: ['CPU'],
};
var radialbar2 = document.querySelector("#radialbar2");
if (radialbar2) {
  var radialbar2Chart = new ApexCharts(radialbar2, radialbar2Options);
  radialbar2Chart.render();
}

var multiRadialbarOptions = {
  series: [44, 55, 67, 83],
  chart: {
    height: 200,
    type: 'radialBar',
  },
  plotOptions: {
    radialBar: {
      track: {
        background: colors.borderColor,
      },
      dataLabels: {
        name: {
          fontSize: '0.875rem',
          fontWeight: 400,
          offsetY: -10,
          show: true,
          color: colors.mutedColor,
          fontFamily: cfFontFamily,
        },
        value: {
          fontSize: '1.53125rem',
          fontWeight: 700,
          fontFamily: cfFontFamily,
          offsetY: 0,
          show: true,
          color: colors.headingColor,
        },
        total: {
          show: true,
          fontSize: '0.825rem',
          fontWeight: 400,
          offsetY: -5,
          show: true,
          color: colors.mutedColor,
          fontFamily: cfFontFamily,
          formatter: function(w) {
            // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
            return 249
          }
        }
      }
    }
  },
  stroke: {
    lineCap: 'round'
  },
  labels: ['Apples', 'Oranges', 'Bananas', 'Berries'],
};

var multiRadialbar = document.querySelector("#multiRadialbar");
if (multiRadialbar) {
  var multiRadialbarChart = new ApexCharts(multiRadialbar, multiRadialbarOptions);
  multiRadialbarChart.render();
}

var customAngleOptions = {
  series: [76, 67, 61, 90],
  chart: {
    id: 'cta',
    height: 200,
    type: 'radialBar',
  },
  plotOptions: {
    radialBar: {
      offsetY: 0,
      startAngle: 0,
      endAngle: 270,
      track: {
        background: colors.borderColor,
      },
      hollow: {
        margin: 5,
        size: '40%',
        background: 'transparent',
        image: undefined,
      },
      dataLabels: {
        name: {
          show: false,
        },
        value: {
          show: false,
        }
      }
    }
  },
  colors: chroma.scale(chartColors).colors(4),
  fill: {
    opacity: 1,
  },
  labels: ['Vimeo', 'Messenger', 'Facebook', 'LinkedIn'],
  legend: {
    show: false,
    floating: true,
    labels: {
      useSeriesColors: true,
    },
    markers: {
      size: 0
    },
    formatter: function(seriesName, opts) {
      return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
    },
    itemMargin: {
      vertical: 3
    }
  },
  stroke: {
    lineCap: 'round'
  },
};

var customAngle = document.querySelector("#customAngle");
if (customAngle) {
  var customAngleChart = new ApexCharts(customAngle, customAngleOptions);
  customAngleChart.render();
}
var gradientRadialOptions = {
  series: [75],
  chart: {
    height: 200,
    type: 'radialBar',
    toolbar: {
      show: false
    }
  },
  plotOptions: {
    radialBar: {
      startAngle: -135,
      endAngle: 225,
      hollow: {
        margin: 0,
        size: '70%',
        background: 'transparent',
        image: undefined,
        imageOffsetX: 0,
        imageOffsetY: 0,
        position: 'front',
      },
      track: {
        background: colors.backgroundColor,
        strokeWidth: '67%',
        margin: 0, // margin is in pixels
      },
      dataLabels: {
        show: true,
        name: {
          fontSize: '0.875rem',
          fontWeight: 400,
          offsetY: -10,
          show: true,
          color: colors.mutedColor,
          fontFamily: cfFontFamily,
        },
        value: {
          formatter: function(val) {
            return parseInt(val);
          },
          color: colors.headingColor,
          fontSize: '1.53125rem',
          fontWeight: 700,
          fontFamily: cfFontFamily,
          offsetY: 5,
          show: true,
        },
        total: {
          show: true,
          fontSize: '0.875rem',
          fontWeight: 400,
          offsetY: -10,
          show: true,
          color: colors.mutedColor,
          fontFamily: cfFontFamily,
        }
      }
    }
  },
  colors: [chartColors[0]],
  fill: {
    type: 'gradient',
    gradient: {
      shade: 'dark',
      type: 'horizontal',
      shadeIntensity: 0.5,
      gradientToColors: [chartColors[1]],
      inverseColors: true,
      opacityFrom: 1,
      opacityTo: 1,
      stops: [0, 100]
    }
  },
  stroke: {
    lineCap: 'round'
  },
  labels: ['Percent'],
};

var gradientRadial = document.querySelector("#gradientRadial");
if (gradientRadial) {
  var gradientRadialChart = new ApexCharts(gradientRadial, gradientRadialOptions);
  gradientRadialChart.render();
}
var strokeRadialOptions = {
  series: [67],
  chart: {
    height: 185,
    type: 'radialBar',
    offsetY: -10
  },
  plotOptions: {
    radialBar: {
      startAngle: -135,
      endAngle: 125,
      track: {
        background: colors.borderColor,
      },
      dataLabels: {
        name: {
          fontSize: '12px',
          color: colors.mutedColor,
          offsetY: 90,
          fontFamily: cfFontFamily,
          fontWeight:400,
        },
        value: {
          offsetY: 56,
          fontSize: '20px',
          fontWeight: 700,
          color: colors.headingColor,
          fontFamily: cfFontFamily,
          formatter: function(val) {
            return val + "%";
          }
        }
      }
    }
  },
  colors: [base.primaryColor],
  fill: {
    type: 'gradient',
    gradient: {
      shade: 'dark',
      shadeIntensity: 0.15,
      inverseColors: false,
      opacityFrom: 1,
      opacityTo: 1,
      stops: [0, 50, 65, 91]
    },
  },
  stroke: {
    dashArray: 4,
    colors: '#fff',
  },
  labels: ['Median Ratio'],
};

var strokeRadial = document.querySelector("#strokeRadial");
if (strokeRadial) {
  var strokeRadialChart = new ApexCharts(strokeRadial, strokeRadialOptions);
  strokeRadialChart.render();
}
var semiRadialOptions = {
  series: [76],
  chart: {
    type: 'radialBar',
    offsetY: -10,
    sparkline: {
      enabled: true
    },
  },
  plotOptions: {
    radialBar: {
      startAngle: -90,
      endAngle: 90,
      track: {
        background: colors.borderColor,
        strokeWidth: '60%',
        margin: 5, // margin is in pixels
      },
      dataLabels: {
        name: {
          show: false
        },
        value: {
          offsetY: -2,
          fontSize: '20px',
          fontWeight: 700,
          color:colors.headingColor,
          fontFamily: cfFontFamily,
        }
      }
    }
  },
  grid: {
    padding: {
      top: -10
    }
  },
  fill: {
    type: 'solid',
    colors: [base.primaryColor],
  },
  labels: ['Average Results'],
};
var semiRadial = document.querySelector("#semiRadial");
if (semiRadial) {
  var semiRadialChart = new ApexCharts(semiRadial, semiRadialOptions);
  semiRadialChart.render();
}

/* apex sparkline */
// line chart spark
var spark1options = {
  series: [{
    name: 'Set 8',
    data: [13, 31, 25, 30, 19, 31, 46, 51, 29, 29, 28, 45, 61, 36, 37, 54, 45, 61, 36, 39, 54]
}],
  chart: {
  type: 'area',
  height: 55,
  sparkline: {
    enabled: true
  },
},
stroke: {
  curve: 'straight',
  width : 2
},
fill: {
  opacity: 0.3,
},
yaxis: {
  min: 0
},
colors: [extra.primaryColorLight],
};
var spark1 = document.querySelector("#spark1Chart");
if(spark1) {
  var spark1Chart = new ApexCharts(spark1, spark1options);
  spark1Chart.render();
}

// column chart spark
var spark2options = {
  series: [{
  data: [25, 66, 41, 89, 63, 25, 44, 22, 36, 29, 54, 25, 66, 41, 89, 63, 25, 44, 22, 36, 29, 54, 25, 66, 41, 89, 63, 25, 44, 54, 25, 66, 41, 89, 63, 25, 44]
}],
  chart: {
  type: 'bar',
  height: 60,
  sparkline: {
    enabled: true
  }
},
plotOptions: {
  bar: {
    columnWidth: '70%'
  }
},
xaxis: {
  crosshairs: {
    width: 1
  },
},
tooltip: {
  fixed: {
    enabled: false
  },
  x: {
    show: false
  },
  y: {
    title: {
      formatter: function (seriesName) {
        return ''
      }
    }
  },
  marker: {
    show: false
  }
},
fill: {
  opacity: 1,
  colors: [extra.primaryColorLighter]
},
states: {
  hover: {
      filter: {
          type: 'darken',
          value: 0.5,
      }
  }
}
};
var spark2 = document.querySelector("#spark2Chart");
if(spark2) {
  var spark2Chart = new ApexCharts(spark2, spark2options);
  spark2Chart.render();
}

// line chart spark
var spark3options = {
  series: [{
    name: 'Set 8',
    data: [25, 46, 25, 44, 22, 36, 29, 54, 25, 66, 41, 63, 89, 25, 44, 54, 25, 66, 41, 25, 69, 33, 44]
}],
chart: {
  type: 'area',
  height: 60,
  sparkline: {
    enabled: true
  },
},
stroke: {
  curve: 'straight',
  width : 2
},
fill: {
  opacity: 0.3,
},
yaxis: {
  min: 0
},
tooltip: {
  fixed: {
    enabled: false
  },
  x: {
    show: false
  },
  y: {
    title: {
      formatter: function (seriesName) {
        return ''
      }
    }
  },
  marker: {
    show: false
  }
},
colors: [extra.primaryColorLight],
};
var spark3 = document.querySelector("#spark3Chart");
if(spark3) {
  var spark3Chart = new ApexCharts(spark3, spark3options);
  spark3Chart.render();
}

// line chart spark
var spark4options = {
  series: [{
    name: 'Set 8',
    data: [25, 46, 25, 44, 22, 36, 29, 54, 25, 66]
}],
chart: {
  type: 'line',
  height: 40,
  sparkline: {
    enabled: true
  },
},
stroke: {
  curve: 'straight',
  width : 2,
  colors: [base.primaryColor],
},
fill: {
  colors: [base.primaryColor],
},
yaxis: {
  min: 0
},
tooltip: {
  fixed: {
    enabled: false
  },
  x: {
    show: false
  },
  y: {
    title: {
      formatter: function (seriesName) {
        return ''
      }
    }
  },
  marker: {
    show: false
  }
},
};
var spark4 = document.querySelector("#spark4Chart");
if(spark4) {
  var spark4Chart = new ApexCharts(spark4, spark4options);
  spark4Chart.render();
}

// line chart spark
var spark5options = {
  series: [{
    name: 'Set 8',
    data: [35, 46, 25, 44, 32, 36, 59, 24, 35, 66]
}],
chart: {
  type: 'line',
  height: 40,
  sparkline: {
    enabled: true
  },
},
stroke: {
  curve: 'straight',
  width : 2,
  colors: [base.primaryColor],
},
fill: {
  colors: [base.primaryColor],
},
yaxis: {
  min: 0
},
tooltip: {
  fixed: {
    enabled: false
  },
  x: {
    show: false
  },
  y: {
    title: {
      formatter: function (seriesName) {
        return ''
      }
    }
  },
  marker: {
    show: false
  }
},
};
var spark5 = document.querySelector("#spark5Chart");
if(spark5) {
  var spark5Chart = new ApexCharts(spark5, spark5options);
  spark5Chart.render();
}

// line chart spark
var spark6options = {
  series: [{
    name: 'Set 8',
    data: [36, 59, 24, 35, 66, 35, 46, 25, 44, 32]
}],
chart: {
  type: 'line',
  height: 40,
  sparkline: {
    enabled: true
  },
},
stroke: {
  curve: 'straight',
  width : 2,
  colors: [base.primaryColor],
},
fill: {
  colors: [base.primaryColor],
},
yaxis: {
  min: 0
},
tooltip: {
  fixed: {
    enabled: false
  },
  x: {
    show: false
  },
  y: {
    title: {
      formatter: function (seriesName) {
        return ''
      }
    }
  },
  marker: {
    show: false
  }
},
};
var spark6 = document.querySelector("#spark6Chart");
if(spark6) {
  var spark6Chart = new ApexCharts(spark6, spark6options);
  spark6Chart.render();
}

// column chart spark
var spark7options = {
  series: [{
  data: [25, 66, 41, 89, 63, 25, 44, 22, 36, 29, 54, 25, 66, 41, 89, 63, 25, 44, 22]
}],
  chart: {
  type: 'bar',
  height: 55,
  sparkline: {
    enabled: true
  }
},
plotOptions: {
  bar: {
    columnWidth: '70%'
  }
},
xaxis: {
  crosshairs: {
    width: 1
  },
},
tooltip: {
  fixed: {
    enabled: false
  },
  x: {
    show: false
  },
  y: {
    title: {
      formatter: function (seriesName) {
        return ''
      }
    }
  },
  marker: {
    show: false
  }
},
colors: [extra.primaryColorLighter],
fill: {
  opacity: 1,
},
states: {
  hover: {
      filter: {
          type: 'darken',
          value: 0.5,
      }
  }
}
};
var spark7 = document.querySelector("#spark7Chart");
if(spark7) {
  var spark7Chart = new ApexCharts(spark7, spark7options);
  spark7Chart.render();
}

// column chart spark
var spark8options = {
  series: [{
    name: 'Set 8',
    data: [33, 51, 45, 50, 29, 51, 66, 61, 49, 49, 48, 65, 71, 56, 57, 74, 65, 81, 56]
  },{
    name: 'Set 9',
    type: 'column',
    data: [25, 66, 41, 89, 63, 25, 44, 22, 36, 29, 54, 25, 66, 41, 89, 63, 25, 44, 22]
  }],
chart: {
  type: 'line',
  height: 55,
  sparkline: {
    enabled: true
  }
},
plotOptions: {
  bar: {
    columnWidth: '70%'
  }
},
xaxis: {
  crosshairs: {
    width: 1
  },
},
stroke: {
  width: [2, 0],
  dashArray: [0, 0],
  colors: [base.primaryColor],
},
tooltip: {
  fixed: {
    enabled: false
  },
  x: {
    show: false
  },
  y: {
    title: {
      formatter: function (seriesName) {
        return ''
      }
    }
  },
  marker: {
    show: false
  }
},
colors: [base.primaryColor],
fill: {
  opacity: 1,
  colors: [extra.primaryColorLight, colors.borderColor]
},
states: {
  hover: {
      filter: {
          type: 'darken',
          value: 0.5,
      }
  }
}
};
var spark8 = document.querySelector("#spark8Chart");
if(spark8) {
  var spark8Chart = new ApexCharts(spark8, spark8options);
  spark8Chart.render();
}

var timelineOptions = {
  series: [{
  data: [
    [1327359600000,30.95],
    [1327446000000,31.34],
    [1327532400000,31.18],
    [1327618800000,31.05],
    [1327878000000,31.00],
    [1327964400000,30.95],
    [1328050800000,31.24],
    [1328137200000,31.29],
    [1328223600000,31.85],
    [1328482800000,31.86],
    [1328569200000,32.28],
    [1328655600000,32.10],
    [1328742000000,32.65],
    [1328828400000,32.21],
    [1329087600000,32.35],
    [1329174000000,32.44],
    [1329260400000,32.46],
    [1329346800000,32.86],
    [1329433200000,32.75],
    [1329778800000,32.54],
    [1329865200000,32.33],
    [1329951600000,32.97],
    [1330038000000,33.41],
    [1330297200000,33.27],
    [1330383600000,33.27],
    [1330470000000,32.89],
    [1330556400000,33.10],
    [1330642800000,33.73],
    [1330902000000,33.22],
    [1330988400000,31.99],
    [1331074800000,32.41],
    [1331161200000,33.05],
    [1331247600000,33.64],
    [1331506800000,33.56],
    [1331593200000,34.22],
    [1331679600000,33.77],
    [1331766000000,34.17],
    [1331852400000,33.82],
    [1332111600000,34.51],
    [1332198000000,33.16],
    [1332284400000,33.56],
    [1332370800000,33.71],
    [1332457200000,33.81],
    [1332712800000,34.40],
    [1332799200000,34.63],
    [1332885600000,34.46],
    [1332972000000,34.48],
    [1333058400000,34.31],
    [1333317600000,34.70],
    [1333404000000,34.31],
    [1333490400000,33.46],
    [1333576800000,33.59],
    [1333922400000,33.22],
    [1334008800000,32.61],
    [1334095200000,33.01],
    [1334181600000,33.55],
    [1334268000000,33.18],
    [1334527200000,32.84],
    [1334613600000,33.84],
    [1334700000000,33.39],
    [1334786400000,32.91],
    [1334872800000,33.06],
    [1335132000000,32.62],
    [1335218400000,32.40],
    [1335304800000,33.13],
    [1335391200000,33.26],
    [1335477600000,33.58],
    [1335736800000,33.55],
    [1335823200000,33.77],
    [1335909600000,33.76],
    [1335996000000,33.32],
    [1336082400000,32.61],
    [1336341600000,32.52],
    [1336428000000,32.67],
    [1336514400000,32.52],
    [1336600800000,31.92],
    [1336687200000,32.20],
    [1336946400000,32.23],
    [1337032800000,32.33],
    [1337119200000,32.36],
    [1337205600000,32.01],
    [1337292000000,31.31],
    [1337551200000,32.01],
    [1337637600000,32.01],
    [1337724000000,32.18],
    [1337810400000,31.54],
    [1337896800000,31.60],
    [1338242400000,32.05],
    [1338328800000,31.29],
    [1338415200000,31.05],
    [1338501600000,29.82],
    [1338760800000,30.31],
    [1338847200000,30.70],
    [1338933600000,31.69],
    [1339020000000,31.32],
    [1339106400000,31.65],
    [1339365600000,31.13],
    [1339452000000,31.77],
    [1339538400000,31.79],
    [1339624800000,31.67],
    [1339711200000,32.39],
    [1339970400000,32.63],
    [1340056800000,32.89],
    [1340143200000,31.99],
    [1340229600000,31.23],
    [1340316000000,31.57],
    [1340575200000,30.84],
    [1340661600000,31.07],
    [1340748000000,31.41],
    [1340834400000,31.17],
    [1340920800000,32.37],
    [1341180000000,32.19],
    [1341266400000,32.51],
    [1341439200000,32.53],
    [1341525600000,31.37],
    [1341784800000,30.43],
    [1341871200000,30.44],
    [1341957600000,30.20],
    [1342044000000,30.14],
    [1342130400000,30.65],
    [1342389600000,30.40],
    [1342476000000,30.65],
    [1342562400000,31.43],
    [1342648800000,31.89],
    [1342735200000,31.38],
    [1342994400000,30.64],
    [1343080800000,30.02],
    [1343167200000,30.33],
    [1343253600000,30.95],
    [1343340000000,31.89],
    [1343599200000,31.01],
    [1343685600000,30.88],
    [1343772000000,30.69],
    [1343858400000,30.58],
    [1343944800000,32.02],
    [1344204000000,32.14],
    [1344290400000,32.37],
    [1344376800000,32.51],
    [1344463200000,32.65],
    [1344549600000,32.64],
    [1344808800000,32.27],
    [1344895200000,32.10],
    [1344981600000,32.91],
    [1345068000000,33.65],
    [1345154400000,33.80],
    [1345413600000,33.92],
    [1345500000000,33.75],
    [1345586400000,33.84],
    [1345672800000,33.50],
    [1345759200000,32.26],
    [1346018400000,32.32],
    [1346104800000,32.06],
    [1346191200000,31.96],
    [1346277600000,31.46],
    [1346364000000,31.27],
    [1346709600000,31.43],
    [1346796000000,32.26],
    [1346882400000,32.79],
    [1346968800000,32.46],
    [1347228000000,32.13],
    [1347314400000,32.43],
    [1347400800000,32.42],
    [1347487200000,32.81],
    [1347573600000,33.34],
    [1347832800000,33.41],
    [1347919200000,32.57],
    [1348005600000,33.12],
    [1348092000000,34.53],
    [1348178400000,33.83],
    [1348437600000,33.41],
    [1348524000000,32.90],
    [1348610400000,32.53],
    [1348696800000,32.80],
    [1348783200000,32.44],
    [1349042400000,32.62],
    [1349128800000,32.57],
    [1349215200000,32.60],
    [1349301600000,32.68],
    [1349388000000,32.47],
    [1349647200000,32.23],
    [1349733600000,31.68],
    [1349820000000,31.51],
    [1349906400000,31.78],
    [1349992800000,31.94],
    [1350252000000,32.33],
    [1350338400000,33.24],
    [1350424800000,33.44],
    [1350511200000,33.48],
    [1350597600000,33.24],
    [1350856800000,33.49],
    [1350943200000,33.31],
    [1351029600000,33.36],
    [1351116000000,33.40],
    [1351202400000,34.01],
    [1351638000000,34.02],
    [1351724400000,34.36],
    [1351810800000,34.39],
    [1352070000000,34.24],
    [1352156400000,34.39],
    [1352242800000,33.47],
    [1352329200000,32.98],
    [1352415600000,32.90],
    [1352674800000,32.70],
    [1352761200000,32.54],
    [1352847600000,32.23],
    [1352934000000,32.64],
    [1353020400000,32.65],
    [1353279600000,32.92],
    [1353366000000,32.64],
    [1353452400000,32.84],
    [1353625200000,33.40],
    [1353884400000,33.30],
    [1353970800000,33.18],
    [1354057200000,33.88],
    [1354143600000,34.09],
    [1354230000000,34.61],
    [1354489200000,34.70],
    [1354575600000,35.30],
    [1354662000000,35.40],
    [1354748400000,35.14],
    [1354834800000,35.48],
    [1355094000000,35.75],
    [1355180400000,35.54],
    [1355266800000,35.96],
    [1355353200000,35.53],
    [1355439600000,37.56],
    [1355698800000,37.42],
    [1355785200000,37.49],
    [1355871600000,38.09],
    [1355958000000,37.87],
    [1356044400000,37.71],
    [1356303600000,37.53],
    [1356476400000,37.55],
    [1356562800000,37.30],
    [1356649200000,36.90],
    [1356908400000,37.68],
    [1357081200000,38.34],
    [1357167600000,37.75],
    [1357254000000,38.13],
    [1357513200000,37.94],
    [1357599600000,38.14],
    [1357686000000,38.66],
    [1357772400000,38.62],
    [1357858800000,38.09],
    [1358118000000,38.16],
    [1358204400000,38.15],
    [1358290800000,37.88],
    [1358377200000,37.73],
    [1358463600000,37.98],
    [1358809200000,37.95],
    [1358895600000,38.25],
    [1358982000000,38.10],
    [1359068400000,38.32],
    [1359327600000,38.24],
    [1359414000000,38.52],
    [1359500400000,37.94],
    [1359586800000,37.83],
    [1359673200000,38.34],
    [1359932400000,38.10],
    [1360018800000,38.51],
    [1360105200000,38.40],
    [1360191600000,38.07],
    [1360278000000,39.12],
    [1360537200000,38.64],
    [1360623600000,38.89],
    [1360710000000,38.81],
    [1360796400000,38.61],
    [1360882800000,38.63],
    [1361228400000,38.99],
    [1361314800000,38.77],
    [1361401200000,38.34],
    [1361487600000,38.55],
    [1361746800000,38.11],
    [1361833200000,38.59],
    [1361919600000,39.60],
  ]
}],
  chart: {
  //id: 'area-datetime',
  type: 'area',
  height: 350,
  zoom: {
    autoScaleYaxis: true
  },
  toolbar: {
    show:false
  },
  background: 'transparent',
},
stroke: {
  show: true,
  curve: 'straight',
  lineCap: 'round',
  width: [2, 0],
},
dataLabels: {
  enabled: false
},
markers: {
  size: 0,
  style: 'hollow',
},
xaxis: {
  type: 'datetime',
  min: new Date('01 Mar 2012').getTime(),
  tickAmount: 6,
  labels: {
    show: true,
    trim: false,
    minHeight: undefined,
    maxHeight: 120,
    style: {
      colors: colors.mutedColor,
      cssClass: 'text-muted',
      fontFamily: cfFontFamily,
    }
  },
  axisBorder: {
    show: false,
  },
},
yaxis: {
  labels: {
    show: true,
    trim: false,
    offsetX: -10,
    minHeight: undefined,
    maxHeight: 120,
    style: {
      colors: colors.mutedColor,
      fontFamily: cfFontFamily,
      cssClass: 'text-muted',
    }
  },
},
grid: {
  show: true,
  borderColor: colors.borderColor,
  strokeDashArray: 0,
  position: 'back',
  xaxis: {
    lines: {
      show: true
    }
  },
  yaxis: {
    lines: {
      show: true
    }
  },
  row: {
    colors: undefined,
    opacity: 1
  },
  column: {
    colors: undefined,
    opacity: 0.5
  },
},
tooltip: {
  x: {
    format: 'dd MMM yyyy'
  }
},
colors : [base.primaryColor],
fill: {
  type: 'gradient',
  gradient: {
    shadeIntensity: 1,
    gradientToColors: [extra.primaryColorLight, base.primaryColor],
    opacityFrom: 0.7,
    opacityTo: .2,
    stops: [20, 100]
  }
},
};

var timelineCtn = document.querySelector("#timelineChart")
if (timelineCtn) {
  var timelineChart = new ApexCharts(timelineCtn, timelineOptions);
  timelineChart.render();
}
