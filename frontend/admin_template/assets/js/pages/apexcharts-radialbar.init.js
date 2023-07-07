function getChartColorsArray(a) {
  if (null !== document.getElementById(a))
    return (
      (a = document.getElementById(a).getAttribute("data-colors")),
      (a = JSON.parse(a)).map(function (a) {
        var r = a.replace(" ", "");
        return -1 === r.indexOf(",")
          ? getComputedStyle(document.documentElement).getPropertyValue(r) || r
          : 2 == (a = a.split(",")).length
          ? "rgba(" +
            getComputedStyle(document.documentElement).getPropertyValue(a[0]) +
            "," +
            a[1] +
            ")"
          : r;
      })
    );
}
var chartRadialbarBasicColors = getChartColorsArray("basic_radialbar"),
  chartRadialbarMultipleColors =
    (chartRadialbarBasicColors &&
      ((options = {
        series: [70],
        chart: { height: 350, type: "radialBar" },
        plotOptions: { radialBar: { hollow: { size: "70%" } } },
        labels: ["Cricket"],
        colors: chartRadialbarBasicColors,
      }),
      (chart = new ApexCharts(
        document.querySelector("#basic_radialbar"),
        options
      )).render()),
    getChartColorsArray("multiple_radialbar")),
  chartRadialbarCircleColors =
    (chartRadialbarMultipleColors &&
      ((options = {
        series: [44, 55, 67, 83],
        chart: { height: 350, type: "radialBar" },
        plotOptions: {
          radialBar: {
            dataLabels: {
              name: { fontSize: "22px" },
              value: { fontSize: "16px" },
              total: {
                show: !0,
                label: "Total",
                formatter: function (a) {
                  return 249;
                },
              },
            },
          },
        },
        labels: ["Apples", "Oranges", "Bananas", "Berries"],
        colors: chartRadialbarMultipleColors,
      }),
      (chart = new ApexCharts(
        document.querySelector("#multiple_radialbar"),
        options
      )).render()),
    getChartColorsArray("circle_radialbar")),
  chartRadialbarGradientColors =
    (chartRadialbarCircleColors &&
      ((options = {
        series: [76, 67, 61, 55],
        chart: { height: 350, type: "radialBar" },
        plotOptions: {
          radialBar: {
            offsetY: 0,
            startAngle: 0,
            endAngle: 270,
            hollow: {
              margin: 5,
              size: "30%",
              background: "transparent",
              image: void 0,
            },
            dataLabels: { name: { show: !1 }, value: { show: !1 } },
          },
        },
        colors: chartRadialbarCircleColors,
        labels: ["Vimeo", "Messenger", "Facebook", "LinkedIn"],
        legend: {
          show: !0,
          floating: !0,
          fontSize: "16px",
          position: "left",
          offsetX: 160,
          offsetY: 15,
          labels: { useSeriesColors: !0 },
          markers: { size: 0 },
          formatter: function (a, r) {
            return a + ":  " + r.w.globals.series[r.seriesIndex];
          },
          itemMargin: { vertical: 3 },
        },
        responsive: [{ breakpoint: 480, options: { legend: { show: !1 } } }],
      }),
      (chart = new ApexCharts(
        document.querySelector("#circle_radialbar"),
        options
      )).render()),
    getChartColorsArray("gradient_radialbar")),
  chartStorkeRadialbarColors =
    (chartRadialbarGradientColors &&
      ((options = {
        series: [75],
        chart: { height: 350, type: "radialBar", toolbar: { show: !1 } },
        plotOptions: {
          radialBar: {
            startAngle: -135,
            endAngle: 225,
            hollow: {
              margin: 0,
              size: "70%",
              image: void 0,
              imageOffsetX: 0,
              imageOffsetY: 0,
              position: "front",
            },
            track: { strokeWidth: "67%", margin: 0 },
            dataLabels: {
              show: !0,
              name: { offsetY: -10, show: !0, color: "#888", fontSize: "17px" },
              value: {
                formatter: function (a) {
                  return parseInt(a);
                },
                color: "#111",
                fontSize: "36px",
                show: !0,
              },
            },
          },
        },
        fill: {
          type: "gradient",
          gradient: {
            shade: "dark",
            type: "horizontal",
            shadeIntensity: 0.5,
            gradientToColors: chartRadialbarGradientColors,
            inverseColors: !0,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100],
          },
        },
        stroke: { lineCap: "round" },
        labels: ["Percent"],
      }),
      (chart = new ApexCharts(
        document.querySelector("#gradient_radialbar"),
        options
      )).render()),
    getChartColorsArray("stroked_radialbar"));
chartStorkeRadialbarColors &&
  ((options = {
    series: [67],
    chart: { height: 326, type: "radialBar", offsetY: -10 },
    plotOptions: {
      radialBar: {
        startAngle: -135,
        endAngle: 135,
        dataLabels: {
          name: { fontSize: "16px", color: void 0, offsetY: 120 },
          value: {
            offsetY: 76,
            fontSize: "22px",
            color: void 0,
            formatter: function (a) {
              return a + "%";
            },
          },
        },
      },
    },
    fill: {
      type: "gradient",
      gradient: {
        shade: "dark",
        shadeIntensity: 0.15,
        inverseColors: !1,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 50, 65, 91],
      },
    },
    stroke: { dashArray: 4 },
    labels: ["Median Ratio"],
    colors: chartStorkeRadialbarColors,
  }),
  (chart = new ApexCharts(
    document.querySelector("#stroked_radialbar"),
    options
  )).render());
(chartStorkeRadialbarColors = getChartColorsArray("stroked_radialbar")) &&
  ((options = {
    series: [67],
    chart: { height: 315, type: "radialBar" },
    plotOptions: {
      radialBar: {
        hollow: {
          margin: 15,
          size: "65%",
          image: "assets/images/comingsoon.png",
          imageWidth: 56,
          imageHeight: 56,
          imageClipped: !1,
        },
        dataLabels: {
          name: { show: !1, color: "#fff" },
          value: { show: !0, color: "#333", offsetY: 65, fontSize: "22px" },
        },
      },
    },
    fill: { type: "image", image: { src: ["assets/images/small/img-4.jpg"] } },
    stroke: { lineCap: "round" },
    labels: ["Volatility"],
  }),
  (chart = new ApexCharts(
    document.querySelector("#radialbar_with_img"),
    options
  )).render());
var options,
  chart,
  chartSemiRadialbarColors = getChartColorsArray("semi_radialbar");
chartSemiRadialbarColors &&
  ((options = {
    series: [76],
    chart: {
      type: "radialBar",
      height: 350,
      offsetY: -20,
      sparkline: { enabled: !0 },
    },
    plotOptions: {
      radialBar: {
        startAngle: -90,
        endAngle: 90,
        track: {
          background: "#e7e7e7",
          strokeWidth: "97%",
          margin: 5,
          dropShadow: {
            enabled: !0,
            top: 2,
            left: 0,
            color: "#999",
            opacity: 1,
            blur: 2,
          },
        },
        dataLabels: {
          name: { show: !1 },
          value: { offsetY: -2, fontSize: "22px" },
        },
      },
    },
    grid: { padding: { top: -10 } },
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        shadeIntensity: 0.4,
        inverseColors: !1,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 50, 53, 91],
      },
    },
    labels: ["Average Results"],
    colors: chartSemiRadialbarColors,
  }),
  (chart = new ApexCharts(
    document.querySelector("#semi_radialbar"),
    options
  )).render());
