"use strict";

// enable tooltip anywhere
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

/** collapse sidebar */
$('.collapseSidebar').on('click', function(e) {
  //collapsed sidebar
  if(!$('.vertical').hasClass('condensed')) {
    $('.vertical').toggleClass('collapsed');

    if($('.vertical').hasClass('hover')) {
      $('.vertical').removeClass('hover');
    }
  //condensed sidebar
  }else{
    $('.vertical').toggleClass('open');
  }
  e.preventDefault();
});

$(".sidebar-left").hover(function(){
  // Hover for collapsed //
  if($('.vertical').hasClass('collapsed') ) {
    $('.vertical').addClass('hover');
  }
  // Hover for condensed
  if(!$('.condensed').hasClass('open') ) {
    $('.vertical').addClass('hover');
  }
}, function() {
  // Hover for collapsed //
  if($('.vertical').hasClass('collapsed')) {
    $('.vertical').removeClass('hover');
  }
  // Hover for condensed
  if(!$('.condensed').hasClass('open') ) {
    $('.vertical').removeClass('hover');
  }
});

$('.toggle-sidebar').on('click', function() {
    $('.navbar-slide').toggleClass('show');
});

/* secondary sidebar */
$('.toggle-secondary').on('click', function(e) {
  $('.vertical').toggleClass('toggled');
  e.preventDefault();
});

if ( md == true || xl == true || lg == true) { 
  $('.primary-nav .nav-link').on('click', function(e) {
    if($('.vertical').hasClass('toggled') ) {
      $('.vertical').removeClass('toggled');
    }
  });
}



// multiple level menu
(function($){
	$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
	  if (!$(this).next().hasClass('show')) {
		$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
	  }
	  var $subMenu = $(this).next(".dropdown-menu");
	  $subMenu.toggleClass('show');

	  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
		$('.dropdown-submenu .show').removeClass("show");
	  });

	  return false;
	});
})(jQuery)

/* custom dropdown */
$('.navbar .dropdown').on('hidden.bs.dropdown', function () {
    $(this).find('li.dropdown').removeClass('show open');
    $(this).find('ul.dropdown-menu').removeClass('show open');
});

/* file manager */
$('.file-panel .card').on('click', function() {
  if($(this).hasClass('selected')) {
    $(this).removeClass('selected');
    $(this).find('bg-light').removeClass('shadow-lg');
    //$('.file-container').removeClass('collapsed');
  }else{
    $(this).addClass('selected');
    $(this).addClass('shadow-lg');
    $('.file-panel .card').not(this).removeClass('selected');
    //$('.file-container').addClass('collapsed')
  }
});
// $('.close-info').on('click', function() {
//     if($('.file-container').hasClass('collapsed')) {
//       $('.file-container').removeClass('collapsed');
//       $('.file-panel').find('.selected').removeClass('selected');
//     }
// });
$(function() {
  $(".info-content")
    .stickOnScroll({
        topOffset: 0,
        setWidthOnStick : true
    });
});


/* wizard */
var basic_wizard = $("#example-basic");
if(basic_wizard.length) {
  basic_wizard.steps({
      headerTag: "h3",
      bodyTag: "section",
      transitionEffect: "slideLeft",
      autoFocus: true
  });
}

var vertical_wizard = $("#example-vertical");
if(vertical_wizard.length) {
  vertical_wizard.steps({
      headerTag: "h3",
      bodyTag: "section",
      transitionEffect: "slideLeft",
      stepsOrientation: "vertical"
  });
}


var form = $("#example-form");
if(form.length) {
  form.validate({
      errorPlacement: function errorPlacement(error, element) { element.before(error); },
      rules: {
          confirm: {
              equalTo: "#password"
          }
      }
  });
  form.children("div").steps({
      headerTag: "h3",
      bodyTag: "section",
      transitionEffect: "slideLeft",
      onStepChanging: function (event, currentIndex, newIndex)
      {
          form.validate().settings.ignore = ":disabled,:hidden";
          return form.valid();
      },
      onFinishing: function (event, currentIndex)
      {
          form.validate().settings.ignore = ":disabled";
          return form.valid();
      },
      onFinished: function (event, currentIndex)
      {
          alert("Submitted!");
      }
  });
}

/** Chartjs */
var ChartOptions = {
  maintainAspectRatio: false,
  responsive: true,
  legend: {
    display: false
  },
  scales: {
    xAxes: [{
      gridLines: {
        display: false,
      }
    }],
    yAxes: [{
      gridLines: {
        display: false,
        color: colors.borderColor,
        zeroLineColor: colors.borderColor,
      }
    }]
  },
}

var ChartData = {
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
  datasets: [{
      label: 'Visitors',
      barThickness: 10,
      backgroundColor: base.primaryColor,
      borderColor: base.primaryColor,
      pointRadius: false,
      pointColor: base.primaryColor,
      pointStrokeColor: base.primaryColor,
      pointHighlightFill: colors.whiteColor,
      pointHighlightStroke: base.primaryColor,
      data: [28, 48, 40, 19, 64, 27, 90, 85, 92],
      fill: '',
      lineTension: 0.1,
    },
    {
      label: 'Orders',
      barThickness: 10,
      backgroundColor: base.successColor,
      borderColor: base.successColor,
      pointRadius: false,
      pointColor: base.successColor,
      pointStrokeColor: base.successColor,
      pointHighlightFill: colors.whiteColor,
      pointHighlightStroke: colors.whiteColor,
      data: [65, 59, 80, 42, 43, 55, 40, 36, 68],
      fill: '',
      borderWidth: 2,
      lineTension: 0.1,
    },
  ]
}

var lineChartData = {
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
  datasets: [{
      label: 'Visitors',
      barThickness: 10,
      borderColor: base.primaryColor,
      pointRadius: false,
      pointColor: base.primaryColor,
      pointStrokeColor: base.primaryColor,
      pointHighlightFill: base.primaryColor,
      pointHighlightStroke: base.primaryColor,
      data: [28, 48, 30, 19, 64, 27, 90, 85, 92],
      fill: '',
      lineTension: 0.2,
    },
    {
      label: 'Sales',
      barThickness: 10,
      borderColor: extra.primaryColorLighter,
      pointRadius: false,
      pointColor: extra.primaryColorLighter,
      pointStrokeColor: extra.primaryColorLighter,
      pointHighlightFill: colors.whiteColor,
      pointHighlightStroke: extra.primaryColorLighter,
      data: [8, 18, 20, 29, 26, 7, 30, 25, 48],
      fill: '',
      borderWidth: 2,
      lineTension: 0.2,
    },
    {
      label: 'Orders',
      backgroundColor: base.successColor,
      borderColor: base.successColor,
      pointRadius: false,
      pointColor: base.successColor,
      pointStrokeColor: colors.borderColor,
      pointHighlightFill: colors.whiteColor,
      pointHighlightStroke: colors.whiteColor,
      data: [65, 59, 80, 42, 43, 55, 40, 36, 68],
      fill: '',
      borderWidth: 2,
      lineTension: 0.2,
    },
  ]
}


var pieChartData = {
  labels: ['Clothing', 'Shoes', 'Electronics', 'Books', 'Cosmetics'],
  datasets: [{
    data: [18, 30, 42, 12, 7],
    backgroundColor: chroma.scale(chartColors).colors(5),
    borderColor : colors.whiteColor,
  }]
}

var areaChartData = {
  labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  datasets: [{
      label: 'Visitors',
      barThickness: 10,
      backgroundColor: base.primaryColor,
      borderColor: base.primaryColor,
      pointRadius: false,
      pointColor: base.primaryColor,
      pointStrokeColor: colors.borderColor,
      pointHighlightFill: extra.primaryColorLighter,
      pointHighlightStroke: base.primaryColor,
      data: [19, 64, 37, 76, 68, 88, 54, 46, 58],
      lineTension: 0.1,
    },
    {
      label: 'Orders',
      barThickness: 10,
      backgroundColor: base.successColor,
      borderColor: base.successColor,
      pointRadius: false,
      pointColor: base.successColor,
      pointStrokeColor: colors.borderColor,
      pointHighlightFill: colors.whiteColor,
      pointHighlightStroke: colors.whiteColor,
      data: [42, 43, 55, 40, 36, 68, 22, 66, 49],
      lineTension: 0.1,
    },
  ]
}

var barChartjs = document.getElementById('barChartjs');
if (barChartjs) {
  new Chart(barChartjs, {
    type: 'bar',
    data: ChartData,
    options: ChartOptions
  });
}

var lineChartjs = document.getElementById('lineChartjs');
if (lineChartjs) {
  new Chart(lineChartjs, {
    type: 'line',
    data: lineChartData,
    options: ChartOptions
  });
}

var pieChartjs = document.getElementById('pieChartjs');
if (pieChartjs) {

  new Chart(pieChartjs, {
    type: 'pie',
    data: pieChartData,
    options: {
      maintainAspectRatio: false,
      responsive: true
    }
  });
}

var areaChartjs = document.getElementById('areaChartjs');
if (areaChartjs) {
  new Chart(areaChartjs, {
    type: 'line',
    data: areaChartData,
    options: ChartOptions
  });
}

/** jQuery Sparkline */
if ($('.sparkline').length) {
  $(".inlinebar").sparkline([3, 2, 7, 5, 4, 6, 8], {
    type: 'bar',
    width: "100%",
    height: "32",
    barColor: base.primaryColor,
    barWidth: 4,
    barSpacing: 2
  });

  $(".inlineline").sparkline([2, 0, 5, 7, 4, 6, 8], {
    type: 'line',
    width: "100%",
    height: "32",
    defaultPixelsPerValue: 5,
    lineColor: base.primaryColor,
    fillColor: 'transparent',
    minSpotColor: false,
    spotColor: false,
    highlightSpotColor: '',
    maxSpotColor: false,
    lineWidth: 2
  });

  $(".inlinepie").sparkline([5, 7, 4, 6, 8], {
    type: 'pie',
    height: "32",
    width: "32",
    sliceColors: chroma.scale(chartColors).colors(4),
  });
}
/** SVG gauge */
var svgg1 = document.getElementById("gauge1");
if (svgg1) {
  var gauge1 = Gauge(
    svgg1, {
      max: 100,
      dialStartAngle: -90,
      dialEndAngle: -90.001,
      value: 10,
      showValue: false,
      label: function(value) {
        return Math.round(value * 100) / 100;
      },
      color: function(value) {
        if (value < 20) {
          return base.primaryColor; // dark
        } else if (value < 40) {
          return base.successColor; // green
        } else if (value < 60) {
          return base.warningColor; // yellow
        } else {
          return base.dangerColor; // red
        }
      }
    }
  );
  (function loop() {
    // Set value and animate (value, animation duration in seconds)
    gauge1.setValueAnimated(35, 1);
    window.setTimeout(loop, 6000);
  })();
}

var svgg2 = document.getElementById("gauge2");
if (svgg2) {
  var gauge2 = Gauge(
    svgg2, {
      max: 100,
      value: 46,
      dialStartAngle: -0,
      dialEndAngle: -90.001,
      // showValue:false,
    }
  );
  (function loop() {
    gauge2.setValue(40);
    // Set value and animate (value, animation duration in seconds)
    gauge2.setValueAnimated(30, 1);
    window.setTimeout(loop, 6000);
  })();
}

var svgg3 = document.getElementById("gauge3");
if (svgg3) {
  var gauge3 = Gauge(
    svgg3, {
      max: 100,
      dialStartAngle: -90,
      dialEndAngle: -90.001,
      value: 80,
      showValue: false,
      label: function(value) {
        return Math.round(value * 100) / 100;
      }
    }
  );
}

var svgg4 = document.getElementById("gauge4");
if (svgg4) {
  var gauge4 = Gauge(
    document.getElementById("gauge4"), {
      max: 500,
      dialStartAngle: 90,
      dialEndAngle: 0,
      value: 50
    }
  );
}



