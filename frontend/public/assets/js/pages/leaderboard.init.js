function getChartColorsArray(r) {
  if (null !== document.getElementById(r)) {
    var e = document.getElementById(r).getAttribute("data-colors");
    if (e)
      return (e = JSON.parse(e)).map(function (r) {
        var e = r.replace(" ", "");
        return -1 === e.indexOf(",")
          ? getComputedStyle(document.documentElement).getPropertyValue(e) || e
          : 2 == (r = r.split(",")).length
          ? "rgba(" +
            getComputedStyle(document.documentElement).getPropertyValue(r[0]) +
            "," +
            r[1] +
            ")"
          : e;
      });
    console.warn("data-colors atributes not found on", r);
  }
}
var areachartmini1Colors = getChartColorsArray("mini-chart-1"),
  barchartColors =
    (areachartmini1Colors &&
      ((options1 = {
        series: [{ data: [7, 22, 11, 21, 17, 25] }],
        chart: {
          type: "line",
          width: 48,
          height: 34,
          sparkline: { enabled: !0 },
        },
        colors: areachartmini1Colors,
        stroke: { width: 2.2 },
        tooltip: {
          fixed: { enabled: !1 },
          x: { show: !1 },
          y: {
            title: {
              formatter: function (r) {
                return "";
              },
            },
          },
          marker: { show: !1 },
        },
      }),
      (chart1 = new ApexCharts(
        document.querySelector("#mini-chart-1"),
        options1
      )).render()),
    getChartColorsArray("hours_spent_chart"));
barchartColors &&
  ((options = {
    series: [{ data: [7, 11, 15, 20, 18, 23, 20, 23, 21, 19] }],
    chart: {
      toolbar: { show: !1 },
      height: 170,
      type: "bar",
      events: { click: function (r, e, t) {} },
    },
    plotOptions: { bar: { columnWidth: "70%", distributed: !0 } },
    dataLabels: { enabled: !1 },
    legend: { show: !1 },
    colors: barchartColors,
    grid: { show: !1 },
    xaxis: {
      categories: ["M", "T", "W", "T", "F", "S", "S", "M", "T", "W"],
      axisBorder: { show: !1 },
      labels: { style: { colors: barchartColors, fontSize: "12px" } },
    },
  }),
  (chart = new ApexCharts(
    document.querySelector("#hours_spent_chart"),
    options
  )).render());
(barchartColors = getChartColorsArray("chart-radialBar")) &&
  ((options = {
    series: [44, 55, 67],
    chart: { height: 260, type: "radialBar" },
    plotOptions: {
      radialBar: {
        offsetY: 0,
        startAngle: 0,
        endAngle: 270,
        dataLabels: { name: { show: !1 }, value: { show: !1 } },
        hollow: { margin: 4, size: "14%" },
        track: { strokeWidth: "60%", opacity: 1, margin: 16 },
      },
    },
    stroke: { lineCap: "round" },
    colors: barchartColors,
    labels: ["Productive", "Neutral", "Unproductive"],
    legend: {
      show: !0,
      floating: !0,
      fontSize: "16px",
      position: "left",
      offsetX: -24,
      offsetY: 15,
      labels: { useSeriesColors: !0 },
      markers: { size: 0 },
      formatter: function (r, e) {
        return r + ":  " + e.w.globals.series[e.seriesIndex];
      },
      itemMargin: { vertical: 5 },
    },
    responsive: [{ breakpoint: 480, options: { legend: { show: !1 } } }],
  }),
  (chart = new ApexCharts(
    document.querySelector("#chart-radialBar"),
    options
  )).render());
var options,
  chart,
  options1,
  chart1,
  areachartuser1Colors = getChartColorsArray("user-chart-1"),
  areachartuser2Colors =
    (areachartuser1Colors &&
      ((options1 = {
        series: [{ data: [2, 22, 11, 21, 17, 25] }],
        chart: {
          type: "line",
          width: 80,
          height: 40,
          sparkline: { enabled: !0 },
        },
        colors: areachartuser1Colors,
        stroke: { curve: "smooth", width: 2.2 },
        tooltip: {
          fixed: { enabled: !1 },
          x: { show: !1 },
          y: {
            title: {
              formatter: function (r) {
                return "";
              },
            },
          },
          marker: { show: !1 },
        },
      }),
      (chart1 = new ApexCharts(
        document.querySelector("#user-chart-1"),
        options1
      )).render()),
    getChartColorsArray("user-chart-2")),
  areachartuser3Colors =
    (areachartuser2Colors &&
      ((options1 = {
        series: [{ data: [18, 17, 21, 11, 21, 5] }],
        chart: {
          type: "line",
          width: 80,
          height: 40,
          sparkline: { enabled: !0 },
        },
        colors: areachartuser2Colors,
        stroke: { curve: "smooth", width: 2.2 },
        tooltip: {
          fixed: { enabled: !1 },
          x: { show: !1 },
          y: {
            title: {
              formatter: function (r) {
                return "";
              },
            },
          },
          marker: { show: !1 },
        },
      }),
      (chart1 = new ApexCharts(
        document.querySelector("#user-chart-2"),
        options1
      )).render()),
    getChartColorsArray("user-chart-3")),
  areachartother1Colors =
    (areachartuser3Colors &&
      ((options1 = {
        series: [{ data: [22, 7, 18, 7, 17, 8] }],
        chart: {
          type: "line",
          width: 80,
          height: 40,
          sparkline: { enabled: !0 },
        },
        colors: areachartuser3Colors,
        stroke: { curve: "smooth", width: 2.2 },
        tooltip: {
          fixed: { enabled: !1 },
          x: { show: !1 },
          y: {
            title: {
              formatter: function (r) {
                return "";
              },
            },
          },
          marker: { show: !1 },
        },
      }),
      (chart1 = new ApexCharts(
        document.querySelector("#user-chart-3"),
        options1
      )).render()),
    getChartColorsArray("other-chart-1")),
  areachartother2Colors =
    (areachartother1Colors &&
      ((options1 = {
        series: [{ data: [5, 12, 30, 7, 25, 15] }],
        chart: {
          type: "line",
          width: 80,
          height: 30,
          sparkline: { enabled: !0 },
        },
        colors: areachartother1Colors,
        stroke: { curve: "smooth", width: 2.2 },
        tooltip: {
          fixed: { enabled: !1 },
          x: { show: !1 },
          y: {
            title: {
              formatter: function (r) {
                return "";
              },
            },
          },
          marker: { show: !1 },
        },
      }),
      (chart1 = new ApexCharts(
        document.querySelector("#other-chart-1"),
        options1
      )).render()),
    getChartColorsArray("other-chart-2")),
  areachartother3Colors =
    (areachartother2Colors &&
      ((options1 = {
        series: [{ data: [22, 7, 18, 7, 17, 8] }],
        chart: {
          type: "line",
          width: 80,
          height: 30,
          sparkline: { enabled: !0 },
        },
        colors: areachartother2Colors,
        stroke: { curve: "smooth", width: 2.2 },
        tooltip: {
          fixed: { enabled: !1 },
          x: { show: !1 },
          y: {
            title: {
              formatter: function (r) {
                return "";
              },
            },
          },
          marker: { show: !1 },
        },
      }),
      (chart1 = new ApexCharts(
        document.querySelector("#other-chart-2"),
        options1
      )).render()),
    getChartColorsArray("other-chart-3")),
  areachartother4Colors =
    (areachartother3Colors &&
      ((options1 = {
        series: [{ data: [25, 32, 12, 25, 17, 25] }],
        chart: {
          type: "line",
          width: 80,
          height: 30,
          sparkline: { enabled: !0 },
        },
        colors: areachartother3Colors,
        stroke: { curve: "smooth", width: 2.2 },
        tooltip: {
          fixed: { enabled: !1 },
          x: { show: !1 },
          y: {
            title: {
              formatter: function (r) {
                return "";
              },
            },
          },
          marker: { show: !1 },
        },
      }),
      (chart1 = new ApexCharts(
        document.querySelector("#other-chart-3"),
        options1
      )).render()),
    getChartColorsArray("other-chart-4")),
  areachartother5Colors =
    (areachartother4Colors &&
      ((options1 = {
        series: [{ data: [23, 25, 12, 23, 17, 5] }],
        chart: {
          type: "line",
          width: 80,
          height: 30,
          sparkline: { enabled: !0 },
        },
        colors: areachartother4Colors,
        stroke: { curve: "smooth", width: 2.2 },
        tooltip: {
          fixed: { enabled: !1 },
          x: { show: !1 },
          y: {
            title: {
              formatter: function (r) {
                return "";
              },
            },
          },
          marker: { show: !1 },
        },
      }),
      (chart1 = new ApexCharts(
        document.querySelector("#other-chart-4"),
        options1
      )).render()),
    getChartColorsArray("other-chart-5"));
areachartother5Colors &&
  ((options1 = {
    series: [{ data: [23, 25, 12, 23, 17, 5] }],
    chart: { type: "line", width: 80, height: 30, sparkline: { enabled: !0 } },
    colors: areachartother5Colors,
    stroke: { curve: "smooth", width: 2.2 },
    tooltip: {
      fixed: { enabled: !1 },
      x: { show: !1 },
      y: {
        title: {
          formatter: function (r) {
            return "";
          },
        },
      },
      marker: { show: !1 },
    },
  }),
  (chart1 = new ApexCharts(
    document.querySelector("#other-chart-5"),
    options1
  )).render());
    