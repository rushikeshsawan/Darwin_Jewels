function getChartColorsArray(e) {
  if (null !== document.getElementById(e))
    return (
      (e = document.getElementById(e).getAttribute("data-colors")),
      (e = JSON.parse(e)).map(function (e) {
        var t = e.replace(" ", "");
        return -1 === t.indexOf(",")
          ? getComputedStyle(document.documentElement).getPropertyValue(t) || t
          : 2 == (e = e.split(",")).length
          ? "rgba(" +
            getComputedStyle(document.documentElement).getPropertyValue(e[0]) +
            "," +
            e[1] +
            ")"
          : t;
      })
    );
}
var options,
  chart,
  chartTreemapBasicColors = getChartColorsArray("basic_treemap"),
  chartTreemapMultiColors =
    (chartTreemapBasicColors &&
      ((options = {
        series: [
          {
            data: [
              { x: "New Delhi", y: 218 },
              { x: "Kolkata", y: 149 },
              { x: "Mumbai", y: 184 },
              { x: "Ahmedabad", y: 55 },
              { x: "Bangaluru", y: 84 },
              { x: "Pune", y: 31 },
              { x: "Chennai", y: 70 },
              { x: "Jaipur", y: 30 },
              { x: "Surat", y: 44 },
              { x: "Hyderabad", y: 68 },
              { x: "Lucknow", y: 28 },
              { x: "Indore", y: 19 },
              { x: "Kanpur", y: 29 },
            ],
          },
        ],
        legend: { show: !1 },
        chart: { height: 350, type: "treemap", toolbar: { show: !1 } },
        colors: chartTreemapBasicColors,
        title: { text: "Basic Treemap", style: { fontWeight: 500 } },
      }),
      (chart = new ApexCharts(
        document.querySelector("#basic_treemap"),
        options
      )).render()),
    getChartColorsArray("multi_treemap")),
  chartTreemapDistributedColors =
    (chartTreemapMultiColors &&
      ((options = {
        series: [
          {
            name: "Desktops",
            data: [
              { x: "ABC", y: 10 },
              { x: "DEF", y: 60 },
              { x: "XYZ", y: 41 },
            ],
          },
          {
            name: "Mobile",
            data: [
              { x: "ABCD", y: 10 },
              { x: "DEFG", y: 20 },
              { x: "WXYZ", y: 51 },
              { x: "PQR", y: 30 },
              { x: "MNO", y: 20 },
              { x: "CDE", y: 30 },
            ],
          },
        ],
        legend: { show: !1 },
        chart: { height: 350, type: "treemap", toolbar: { show: !1 } },
        title: {
          text: "Multi-dimensional Treemap",
          align: "center",
          style: { fontWeight: 500 },
        },
        colors: chartTreemapMultiColors,
      }),
      (chart = new ApexCharts(
        document.querySelector("#multi_treemap"),
        options
      )).render()),
    getChartColorsArray("distributed_treemap")),
  chartTreemapRangeColors =
    (chartTreemapDistributedColors &&
      ((options = {
        series: [
          {
            data: [
              { x: "New Delhi", y: 218 },
              { x: "Kolkata", y: 149 },
              { x: "Mumbai", y: 184 },
              { x: "Ahmedabad", y: 55 },
              { x: "Bangaluru", y: 84 },
              { x: "Pune", y: 31 },
              { x: "Chennai", y: 70 },
              { x: "Jaipur", y: 30 },
              { x: "Surat", y: 44 },
              { x: "Hyderabad", y: 68 },
              { x: "Lucknow", y: 28 },
              { x: "Indore", y: 19 },
              { x: "Kanpur", y: 29 },
            ],
          },
        ],
        legend: { show: !1 },
        chart: { height: 350, type: "treemap", toolbar: { show: !1 } },
        title: {
          text: "Distibuted Treemap (different color for each cell)",
          align: "center",
          style: { fontWeight: 500 },
        },
        colors: chartTreemapDistributedColors,
        plotOptions: { treemap: { distributed: !0, enableShades: !1 } },
      }),
      (chart = new ApexCharts(
        document.querySelector("#distributed_treemap"),
        options
      )).render()),
    getChartColorsArray("color_range_treemap"));
chartTreemapRangeColors &&
  ((options = {
    series: [
      {
        data: [
          { x: "INTC", y: 1.2 },
          { x: "GS", y: 0.4 },
          { x: "CVX", y: -1.4 },
          { x: "GE", y: 2.7 },
          { x: "CAT", y: -0.3 },
          { x: "RTX", y: 5.1 },
          { x: "CSCO", y: -2.3 },
          { x: "JNJ", y: 2.1 },
          { x: "PG", y: 0.3 },
          { x: "TRV", y: 0.12 },
          { x: "MMM", y: -2.31 },
          { x: "NKE", y: 3.98 },
          { x: "IYT", y: 1.67 },
        ],
      },
    ],
    legend: { show: !1 },
    chart: { height: 350, type: "treemap", toolbar: { show: !1 } },
    title: { text: "Treemap with Color scale", style: { fontWeight: 500 } },
    dataLabels: {
      enabled: !0,
      style: { fontSize: "12px" },
      formatter: function (e, t) {
        return [e, t.value];
      },
      offsetY: -4,
    },
    plotOptions: {
      treemap: {
        enableShades: !0,
        shadeIntensity: 0.5,
        reverseNegativeShade: !0,
        colorScale: {
          ranges: [
            { from: -6, to: 0, color: chartTreemapRangeColors[0] },
            { from: 0.001, to: 6, color: chartTreemapRangeColors[1] },
          ],
        },
      },
    },
  }),
  (chart = new ApexCharts(
    document.querySelector("#color_range_treemap"),
    options
  )).render());
