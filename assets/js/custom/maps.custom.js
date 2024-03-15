var mstyle = {
  stroke: true,
  fill: true,
  fillColor: base.lightColor,
  color: colors.borderColor,
  weight: 1,
  fillOpacity: 1,
};
// get color depending on population density value
function getColor(d) {
  return d > 1000
    ? chroma(base.primaryColor).darken(2)
    : d > 500
    ? chroma(base.primaryColor).darken(1.5)
    : d > 200
    ? chroma(base.primaryColor).darken(1)
    : d > 100
    ? chroma(base.primaryColor).darken(0.5)
    : d > 50
    ? chroma(base.primaryColor).brighten(0.5)
    : d > 20
    ? chroma(base.primaryColor).brighten(1)
    : d > 10
    ? chroma(base.primaryColor).brighten(1.5)
    : base.lightColor;
}

// get color depending on population density value
function getSize(d) {
  return d > 1000
    ? 16
    : d > 500
    ? 12
    : d > 200
    ? 10
    : d > 100
    ? 8
    : d > 50
    ? 6
    : d > 20
    ? 4
    : d > 10
    ? 2
    : 1;
}

function style(feature) {
  return {
    weight: 1,
    opacity: 1,
    color: colors.borderColor,
    fillOpacity: 0.8,
    fillColor: getColor(feature.properties.density),
  };
}

function styleSize(feature) {
  return {
    opacity: 0.3,
    color: base.primaryColor,
    radius: 3,
    fillOpacity: 1,
    className : 'anniCicle',
    weight: getSize(feature.properties.density) * 2.5,
    fillColor: base.primaryColor,
  };
}

var cityData = {
  type: "FeatureCollection",
  features: [
    {
      type: "Feature",
      properties: {
        shape: "Circle",
        radius: 141.05343805012416,
        name: "Miami",
        category: "default",
        density: "50",
      },
      geometry: {
        type: "Point",
        coordinates: [-80.2002, 25.7207],
      },
    },
    {
      type: "Feature",
      properties: {
        shape: "Circle",
        radius: 141.05343805012416,
        name: "Newyork",
        category: "default",
        density: "950",
      },
      geometry: {
        type: "Point",
        coordinates: [-73.7842, 40.7348],
      },
    },
    {
      type: "Feature",
      properties: {
        shape: "Circle",
        radius: 141.05343805012416,
        name: "Sydney",
        category: "default",
        density: "1950",
      },
      geometry: {
        type: "Point",
        coordinates: [150.9961, -33.8704],
      },
    },
    {
      type: "Feature",
      properties: {
        shape: "Circle",
        radius: 141.05343805012416,
        name: "Singapore",
        category: "default",
        density: "40",
      },
      geometry: {
        type: "Point",
        coordinates: [104.1504, 1.1425],
      },
    },
    {
      type: "Feature",
      properties: {
        shape: "Circle",
        radius: 141.05343805012416,
        name: "Rome",
        category: "default",
        density: "40",
      },
      geometry: {
        type: "Point",
        coordinates: [12.4585, 41.8696],
      },
    },
    {
      type: "Feature",
      properties: {
        shape: "Circle",
        radius: 141.05343805012416,
        name: "L2",
        category: "default",
        density: "120",
      },
      geometry: {
        type: "Point",
        coordinates: [28.9784, 41.0082],
      },
    },
    {
      type: "Feature",
      properties: {
        shape: "Circle",
        radius: 141.05343805012416,
        name: "Tokyo",
        category: "default",
        density: "300",
      },
      geometry: {
        type: "Point",
        coordinates: [139.6917, 35.6895],
      },
    },
    {
      type: "Feature",
      properties: {
        shape: "Circle",
        radius: 141.05343805012416,
        name: "Seoul",
        category: "default",
        density: "500",
      },
      geometry: {
        type: "Point",
        coordinates: [126.978, 37.5665],
      },
    },
    {
      type: "Feature",
      properties: {
        shape: "Circle",
        radius: 141.05343805012416,
        name: "Bangkok",
        category: "default",
        density: "230",
      },
      geometry: {
        type: "Point",
        coordinates: [100.5018, 13.7563],
      },
    },
    {
      type: "Feature",
      properties: {
        shape: "Circle",
        radius: 141.05343805012416,
        name: "London",
        category: "default",
        density: "1200",
      },
      geometry: {
        type: "Point",
        coordinates: [-0.0879, 51.4951],
      },
    }
  ],
};

const lctn = document.getElementById("lbox");
if (lctn) {

  //d3.geo(countryData).then(function (data) {
  var lmap = L.map("lbox").setView([47, 2], 2);

  // create vector map
  L.geoJson(countryData, {
    clickable: false,
    style: mstyle,
  }).addTo(lmap);

  //add cicle base on data
  L.geoJSON(cityData, {
    pointToLayer: function (feature, latlng) {
      return L.circleMarker(latlng, styleSize(feature))
        .bindTooltip('<strong>'+feature.properties.name+'</strong><br /><small>'+feature.properties.density+'</small>', {
          offset: [0, -20],
          direction: "top",
        })
        .openTooltip();
    },
  }).addTo(lmap);

  // Add a svg layer to the map
  L.svg().addTo(lmap);

  // Function that update circle position if something change
  function update() {
    d3.select("#lbox")
      .selectAll("circle")
      .attr("cx", function (d) {
        return lmap.latLngToLayerPoint([d.coordinates[1], d.coordinates[0]]).x;
      })
      .attr("cy", function (d) {
        return lmap.latLngToLayerPoint([d.coordinates[1], d.coordinates[0]]).y;
      });
  }

  // // If the user change the map (zoom or drag), I update circle position:
  lmap.on("moveend", update);
}

const sctn = document.getElementById("sbox");
if (sctn) {

  var smap = L.map("sbox").setView([47, 2], 1);

  // create vector map
  L.geoJson(countryData, {
    clickable: false,
    style: mstyle,
  }).addTo(smap);

  //add cicle base on data
  L.geoJSON(cityData, {
    pointToLayer: function (feature, latlng) {
      return L.circleMarker(latlng, styleSize(feature))
        .bindTooltip('<strong>'+feature.properties.name+'</strong><br /><small>'+feature.properties.density+'</small>', {
          offset: [0, -20],
          direction: "top",
        })
        .openTooltip();
    },
  }).addTo(smap);

  // Add a svg layer to the map
  L.svg().addTo(smap);

  // Function that update circle position if something change
  function update() {
    d3.select("#sbox")
      .selectAll("circle")
      .attr("cx", function (d) {
        return smap.latLngToLayerPoint([d.coordinates[1], d.coordinates[0]]).x;
      })
      .attr("cy", function (d) {
        return smap.latLngToLayerPoint([d.coordinates[1], d.coordinates[0]]).y;
      });
  }

  // // If the user change the map (zoom or drag), I update circle position:
  smap.on("moveend", update);
}

const cmbx = document.getElementById("cmap");
if (cmbx) {
  var cmap = L.map("cmap").setView([37.8, -96], 3);

  // control that shows state info on hover
  var info = L.control();

  info.onAdd = function (cmap) {
    this._div = L.DomUtil.create("div", "info");
    this.update();
    return this._div;
  };

  info.update = function (props) {
    this._div.innerHTML =
      '<h6 class="mb-0">US Population Density</h6>' +
      (props
        ? "<b>" +
          props.name +
          "</b><br />" +
          props.density +
          " people / mi<sup>2</sup>"
        : '<span class="text-muted">Hover over a state</span>');
  };

  info.addTo(cmap);

  function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
      weight: 2,
      color: base.lightColor,
      dashArray: "",
      fillOpacity: 0.7,
    });

    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
      layer.bringToFront();
    }

    info.update(layer.feature.properties);
  }

  var geojson;

  function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
  }

  function zoomToFeature(e) {
    cmap.fitBounds(e.target.getBounds());
  }

  function onEachFeature(feature, layer) {
    layer.on({
      mouseover: highlightFeature,
      mouseout: resetHighlight,
      click: zoomToFeature,
    });
  }

  geojson = L.geoJson(statesData, {
    style: style,
    onEachFeature: onEachFeature,
  }).addTo(cmap);

  var legend = L.control({ position: "bottomright" });

  legend.onAdd = function (cmap) {
    var div = L.DomUtil.create("div", "info legend"),
      grades = [0, 10, 20, 50, 100, 200, 500, 1000],
      labels = [],
      from,
      to;

    for (var i = 0; i < grades.length; i++) {
      from = grades[i];
      to = grades[i + 1];

      labels.push(
        '<i style="background:' +
          getColor(from + 1) +
          '"></i> ' +
          from +
          (to ? "&ndash;" + to : "+")
      );
    }

    div.innerHTML = labels.join("<br>");
    return div;
  };

  legend.addTo(cmap);
} // end interactive choropleth map


const wmbx = document.getElementById("wmap");
if (wmbx) {
  var wmap = L.map("wmap", { zoomControl: false }).setView([47, 2], -1);

  // create vector map
  L.geoJson(countryData, {
    clickable: false,
    style: mstyle,
  }).addTo(wmap);

  //add cicle base on data
  L.geoJSON(cityData, {
    pointToLayer: function (feature, latlng) {
      return L.circleMarker(latlng, styleSize(feature))
        .bindTooltip('<strong>'+feature.properties.name+'</strong><br /><small>'+feature.properties.density+'</small>', {
          offset: [0, -20],
          direction: "top",
        })
        .openTooltip();
    },
  }).addTo(wmap);

  // Add a svg layer to the map
  L.svg().addTo(wmap);

  // Function that update circle position if something change
  function update() {
    d3.select("#wmap")
      .selectAll("circle")
      .attr("cx", function (d) {
        return wmap.latLngToLayerPoint([d.coordinates[1], d.coordinates[0]]).x;
      })
      .attr("cy", function (d) {
        return wmap.latLngToLayerPoint([d.coordinates[1], d.coordinates[0]]).y;
      });
  }

  // // If the user change the map (zoom or drag), I update circle position:
  wmap.on("moveend", update);
  
} // end widget map

//euro leaflet map
var emctn = document.getElementById("emap");
if (emctn) {
  var eumap = L.map("emap").setView([57.1839, 15.1172], 3);

  L.geoJSON(euroData, {
    clickable: false,
    style: mstyle,
  }).addTo(eumap);
}

// mapbox display using leatlef
var mctn = document.getElementById("mbox");
if (mctn) {
  var mmap = L.map("mbox").setView([51.505, -0.09], 14);
  L.tileLayer(
    "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}@2x?access_token={accessToken}",
    {
      attribution:
        'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      maxZoom: 18,
      id: "mapbox/streets-v11",
      tileSize: 512,
      zoomOffset: -1,
      accessToken:
        "pk.eyJ1IjoiM3N0ciIsImEiOiJja2QxM2l2cTIwamp3MnJtdDZsbWNuazg5In0.zgYi73CRvbXH-R-tPOOqcA",
    }
  ).addTo(mmap);
}
