function getChartColorsArray(o) {
  if (null !== document.getElementById(o)) {
    var e = document.getElementById(o).getAttribute("data-colors");
    if (e)
      return (e = JSON.parse(e)).map(function (o) {
        var e = o.replace(" ", "");
        return -1 === e.indexOf(",")
          ? getComputedStyle(document.documentElement).getPropertyValue(e) || e
          : 2 == (o = o.split(",")).length
          ? "rgba(" +
            getComputedStyle(document.documentElement).getPropertyValue(o[0]) +
            "," +
            o[1] +
            ")"
          : e;
      });
    console.warn("data-colors Attribute not found on:", o);
  }
}
var worldlinemap,
  usmap,
  vectorMapWorldLineColors = getChartColorsArray("users-by-country"),
  barchartCountriesColors =
    (vectorMapWorldLineColors &&
      (worldlinemap = new jsVectorMap({
        map: "world_merc",
        selector: "#users-by-country",
        zoomOnScroll: !0,
        zoomButtons: !0,
        markers: [
          { name: "Greenland", coords: [72, -42] },
          { name: "Canada", coords: [56.1304, -106.3468] },
          { name: "Brazil", coords: [-14.235, -51.9253] },
          { name: "Egypt", coords: [26.8206, 30.8025] },
          { name: "Russia", coords: [61, 105] },
          { name: "China", coords: [35.8617, 104.1954] },
          { name: "United States", coords: [37.0902, -95.7129] },
          { name: "Norway", coords: [60.472024, 8.468946] },
          { name: "Ukraine", coords: [48.379433, 31.16558] },
        ],
        lines: [
          { from: "Canada", to: "Egypt" },
          { from: "Russia", to: "Egypt" },
          { from: "Greenland", to: "Egypt" },
          { from: "Brazil", to: "Egypt" },
          { from: "United States", to: "Egypt" },
          { from: "China", to: "Egypt" },
          { from: "Norway", to: "Egypt" },
          { from: "Ukraine", to: "Egypt" },
        ],
        regionStyle: {
          initial: {
            stroke: "#9599ad",
            strokeWidth: 0.25,
            fill: vectorMapWorldLineColors,
            fillOpacity: 1,
          },
        },
        lineStyle: { animation: !0, strokeDasharray: "6 3 6" },
      })),
    getChartColorsArray("countries_charts")),
  chartColumnStackedColors =
    (barchartCountriesColors &&
      ((options = {
        series: [
          {
            data: [1010, 1640, 490, 1255, 1050, 689, 800, 420, 1085, 589],
            name: "Sessions",
          },
        ],
        chart: { type: "bar", height: 436, toolbar: { show: !1 } },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: !0,
            distributed: !0,
            dataLabels: { position: "top" },
          },
        },
        colors: barchartCountriesColors,
        dataLabels: {
          enabled: !0,
          offsetX: 32,
          style: { fontSize: "12px", fontWeight: 400, colors: ["#adb5bd"] },
        },
        legend: { show: !1 },
        grid: { show: !1 },
        xaxis: {
          categories: [
            "India",
            "United States",
            "China",
            "Indonesia",
            "Russia",
            "Bangladesh",
            "Canada",
            "Brazil",
            "Vietnam",
            "UK",
          ],
        },
      }),
      (chart = new ApexCharts(
        document.querySelector("#countries_charts"),
        options
      )).render()),
    getChartColorsArray("column_stacked")),
  chartDonutBasicColors =
    (chartColumnStackedColors &&
      ((options = {
        series: [
          { name: "Avg Earning", data: [44, 55, 41, 67, 22, 43] },
          { name: "Total Customer", data: [13, 23, 20, 8, 13, 27] },
          { name: "Total Orders", data: [11, 17, 15, 15, 21, 14] },
        ],
        chart: {
          type: "bar",
          height: 350,
          stacked: !0,
          toolbar: { show: !1 },
          zoom: { enabled: !0 },
        },
        responsive: [
          {
            breakpoint: 480,
            options: {
              legend: { position: "bottom", offsetX: -10, offsetY: 0 },
            },
          },
        ],
        xaxis: {
          type: "datetime",
          categories: [
            "01/01/2011 GMT",
            "01/02/2011 GMT",
            "01/03/2011 GMT",
            "01/04/2011 GMT",
            "01/05/2011 GMT",
            "01/06/2011 GMT",
          ],
        },
        legend: { position: "right", offsetY: 40 },
        fill: { opacity: 1 },
        colors: chartColumnStackedColors,
      }),
      (chart = new ApexCharts(
        document.querySelector("#column_stacked"),
        options
      )).render()),
    getChartColorsArray("simple_dount_chart")),
  vectorMapUsaColors =
    (chartDonutBasicColors &&
      ((options = {
        series: [55, 49, 18, 34],
        chart: { height: 270, type: "donut" },
        labels: ["Marketing", "Offline", "Direct Sales", "Others"],
        legend: { position: "bottom", show: !1 },
        dataLabels: { dropShadow: { enabled: !1 } },
        colors: chartDonutBasicColors,
      }),
      (chart = new ApexCharts(
        document.querySelector("#simple_dount_chart"),
        options
      )).render()),
    getChartColorsArray("sales-by-locations")),
  donutchartportfolioColors =
    (vectorMapUsaColors &&
      (usmap = new jsVectorMap({
        map: "us_merc_en",
        selector: "#sales-by-locations",
        regionStyle: {
          initial: {
            stroke: "#9599ad",
            strokeWidth: 0.25,
            fill: vectorMapUsaColors,
            fillOpacity: 1,
          },
        },
        zoomOnScroll: !1,
        zoomButtons: !1,
      })),
    getChartColorsArray("portfolio_donut_charts"));
function generateData(o, e) {
  for (var t = 0, a = []; t < o; ) {
    var r = "w" + (t + 1).toString(),
      n = Math.floor(Math.random() * (e.max - e.min + 1)) + e.min;
    a.push({ x: r, y: n }), t++;
  }
  return a;
}
donutchartportfolioColors &&
  ((options = {
    series: [19405, 40552, 15824, 30635],
    labels: ["Bitcoin", "Ethereum", "Litecoin", "Dash"],
    chart: { type: "donut", height: 210 },
    plotOptions: {
      pie: {
        size: 100,
        offsetX: 0,
        offsetY: 0,
        donut: {
          size: "70%",
          labels: {
            show: !0,
            name: { show: !0, fontSize: "18px", offsetY: -5 },
            value: {
              show: !0,
              fontSize: "20px",
              color: "#343a40",
              fontWeight: 500,
              offsetY: 5,
              formatter: function (o) {
                return "$" + o;
              },
            },
            total: {
              show: !0,
              fontSize: "13px",
              label: "Total value",
              color: "#9599ad",
              fontWeight: 500,
              formatter: function (o) {
                return (
                  "$" +
                  o.globals.seriesTotals.reduce(function (o, e) {
                    return o + e;
                  }, 0)
                );
              },
            },
          },
        },
      },
    },
    dataLabels: { enabled: !1 },
    legend: { show: !1 },
    yaxis: {
      labels: {
        formatter: function (o) {
          return "$" + o;
        },
      },
    },
    stroke: { lineCap: "round", width: 2 },
    colors: donutchartportfolioColors,
  }),
  (chart = new ApexCharts(
    document.querySelector("#portfolio_donut_charts"),
    options
  )).render());
var options,
  chart,
  chartHeatMapColors = getChartColorsArray("color_heatmap"),
  areachartBasicColors =
    (chartHeatMapColors &&
      ((options = {
        series: [
          { name: "Jan", data: generateData(20, { min: -30, max: 55 }) },
          { name: "Feb", data: generateData(20, { min: -30, max: 55 }) },
          { name: "Mar", data: generateData(20, { min: -30, max: 55 }) },
          { name: "Apr", data: generateData(20, { min: -30, max: 55 }) },
          { name: "May", data: generateData(20, { min: -30, max: 55 }) },
          { name: "Jun", data: generateData(20, { min: -30, max: 55 }) },
          { name: "Jul", data: generateData(20, { min: -30, max: 55 }) },
          { name: "Aug", data: generateData(20, { min: -30, max: 55 }) },
          { name: "Sep", data: generateData(20, { min: -30, max: 55 }) },
        ],
        chart: { height: 310, type: "heatmap", toolbar: { show: !1 } },
        legend: { show: !1 },
        plotOptions: {
          heatmap: {
            shadeIntensity: 0.5,
            radius: 0,
            useFillColorAsStroke: !0,
            colorScale: {
              ranges: [
                {
                  from: -30,
                  to: 5,
                  name: "Youtube",
                  color: chartHeatMapColors[0],
                },
                { from: 6, to: 20, name: "Meta", color: chartHeatMapColors[1] },
                {
                  from: 21,
                  to: 45,
                  name: "Google",
                  color: chartHeatMapColors[2],
                },
                {
                  from: 46,
                  to: 55,
                  name: "Medium",
                  color: chartHeatMapColors[3],
                },
                {
                  from: 36,
                  to: 40,
                  name: "Other",
                  color: chartHeatMapColors[4],
                },
              ],
            },
          },
        },
        dataLabels: { enabled: !1 },
        stroke: { width: 1 },
        title: { style: { fontWeight: 500 } },
      }),
      (chart = new ApexCharts(
        document.querySelector("#color_heatmap"),
        options
      )).render()),
    getChartColorsArray("area_chart_basic"));
areachartBasicColors &&
  ((options = {
    series: [{ name: "Total Income", data: series.monthDataSeries1.prices }],
    chart: {
      type: "area",
      height: 325,
      offsetX: 0,
      zoom: { enabled: !1 },
      sparkline: { enabled: !0 },
      toolbar: { show: !1 },
    },
    dataLabels: { enabled: !1 },
    stroke: { curve: "smooth" },
    labels: series.monthDataSeries1.dates,
    legend: { horizontalAlign: "left" },
    colors: areachartBasicColors,
  }),
  (chart = new ApexCharts(
    document.querySelector("#area_chart_basic"),
    options
  )).render());
