"use strict";
/** Datamap */
var mapbox = document.getElementById('dataMapWorld');
if (mapbox) {
  // example data from server
  var series = [
    ["AUS", 50],
    ["FRA", 77],
    ["SWZ", 58],
    ["USA", 26],
    ["RUS", 46]
  ];

  var dataset = {};

  // We need to colorize every country based on "numberOfWhatever"
  // colors should be uniq for every value.
  // For this purpose we create palette(using min/max series-value)
  var onlyValues = series.map(function(obj) {
    return obj[1];
  });
  var minValue = Math.min.apply(null, onlyValues),
    maxValue = Math.max.apply(null, onlyValues);

  // create color palette function
  // color can be whatever you wish
  var paletteScale = d3.scale.linear()
    .domain([minValue, maxValue])
    .range([extra.primaryColorDarker, extra.primaryColorLight]); // blue color

  // fill dataset in appropriate format
  series.forEach(function(item) { //
    // item example value ["USA", 70]
    var iso = item[0],
      value = item[1];
    dataset[iso] = {
      numberOfThings: value,
      fillColor: paletteScale(value)
    };
  });

  // render map
  var mapWorld = new Datamap({
    element: mapbox,
    projection: 'mercator', // big world map
    setProjection: function(element) {
      var projection = d3.geo.mercator()
        .center([12, 30])
        .scale(120)
      //.translate([element.offsetWidth / 2, element.offsetHeight / 2]);
      var path = d3.geo.path()
        .projection(projection);
      return {
        path: path,
        projection: projection
      };
    },

    // countries don't listed in dataset will be painted with this color
    fills: {
      defaultFill: colors.mutedColor
    },
    data: dataset,
    responsive: true,
    aspectRatio: 0.45,
    geographyConfig: {
      borderColor: colors.backgroundColor,
      highlightBorderWidth: 1,
      // don't change color on mouse hover
      highlightFillColor: function(geo) {
        return geo['fillColor'] || base.primaryColor;
      },
      // only change border
      highlightBorderColor: base.primaryColorLighter,
      // show desired information in tooltip
      popupTemplate: function(geo, data) {
        // don't show tooltip if country don't present in dataset
        if (!data) {
          return;
        }
        // tooltip content
        return ['<div class="hoverinfo">',
          '<strong>', geo.properties.name, '</strong>',
          '<br>Count: <strong>', data.numberOfThings, '</strong>',
          '</div>'
        ].join('');
      }
    }
  });

  // Setup the options for the zoom (defaults given)
  var zoomOpts = {
    scaleFactor: 1, // The amount to zoom
    center: {
      lat: '12', // latitude of the point to which you wish to zoom
      lng: '30', // longitude of the point to which you wish to zoom
      // NOTE: You cannot specify lat without lng or lng without lat.  It's all or nothing.
    },
    transition: {
      duration: 1000 // milliseconds
    },
    // onZoomComplete: function (zoomData) {
    //   // Called after zoomto completes.  Bound to the Datamaps instance.
    //   // Passes one argument, zoomData.
    //   zoomData = {
    //     translate: { x: element.offsetWidth / 2, y: element.offsetHeight / 2 },
    //     scale: 120
    //   }
    //   // no-op by default
    // }
  };

  // perform the zoom
  mapWorld.zoomto(zoomOpts);
  window.addEventListener('resize', function() {
    mapWorld.resize();
    mapWorld.zoomto(zoomOpts);
  });
}
var mapUSABox = document.getElementById('dataMapUSA');
if (mapUSABox) {
  var mapUSA = new Datamap({
    element: mapUSABox,
    scope: 'usa',
    responsive: true,
    aspectRatio: 0.45,
    data: {
        'CA': { fillKey: 'MEDIUM' },
        'TX': { fillKey: 'HIGH' },
        'WA': { fillKey: 'HIGH' },
        'OK': { fillKey: 'MEDIUM' },
        'NC': { fillKey: 'MEDIUM' },
        'IN': { fillKey: 'LOW' },
        'IL': { fillKey: 'LOW' },
        'MT':{ fillKey: 'HIGH' },
    },
    fills: {
      'HIGH': base.primaryColorLight,
      'MEDIUM': base.primaryColor,
      'LOW': base.primaryColorDark,
      defaultFill: colors.mutedColor,
    },
    geographyConfig: {
      borderColor: colors.borderColor,
      highlightBorderWidth: 1,
    }
  });

  window.addEventListener('resize', function() {
    mapUSA.resize();
  });
}

var mapEuropeBox = document.getElementById('dataMapEurope');
if (mapEuropeBox) {
  var mapEurope = new Datamap({
    element: document.getElementById('dataMapEurope'),
    geographyConfig: {
      popupOnHover: true,
      highlightOnHover: true,
      borderColor: colors.borderColor,
      highlightBorderWidth: 1,
      dataUrl: 'data/eu.topo.json',
      popupTemplate: function(geo, data) {
        return ['<div class="px-2 py-1 bg-white">',
          '<small class="text-muted">' + geo.properties.NAME,
          ': <strong>' + data.numberOfThings,
          '</strong></small></div>'
        ].join('');
      }
    },
    scope: 'europe',
    responsive: true,
    aspectRatio: 0.4,
    fills: {
      'MAJOR': base.primaryColorDarker,
      'MEDIUM': base.primaryColor,
      'MINOR': base.primaryColorLighter,
      defaultFill: colors.mutedColor
    },
    data: {
      'NL': {
        fillKey: 'MEDIUM',
        numberOfThings: 381
      },
      'FR': {
        fillKey: 'MEDIUM',
        numberOfThings: 101
      },
      'GB': {
        fillKey: 'MAJOR',
        numberOfThings: 101
      },
      'DE': {
        fillKey: 'MAJOR',
        numberOfThings: 101
      },
      'ES': {
        fillKey: 'MAJOR',
        numberOfThings: 101
      }
    },
    setProjection: function(element, options) {
      var projection, path;
      var projection = d3.geo.mercator()
        .center([25, 50])
        .rotate([0, 0])
        .scale(180)
        .translate([element.offsetWidth / 2, element.offsetHeight / 2]);
      var path = d3.geo.path()
        .projection(projection);
      return {
        path: path,
        projection: projection
      };
    }
  });
  window.addEventListener('resize', function() {
    mapEurope.resize();
  });
}
