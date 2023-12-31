document.querySelectorAll(".plan-nav .nav-item .nav-link") &&
  Array.from(
    document.querySelectorAll(".plan-nav .nav-item .nav-link")
  ).forEach(function (e) {
    var i,
      t = document.getElementsByClassName("month"),
      l = document.getElementsByClassName("annual");
    1 == e.classList.contains("active") &&
      ((i = 0),
      Array.from(t).forEach(function (e) {
        (l[i].style.display = "none"), (e.style.display = "block"), i++;
      }));
  }),
  document.getElementById("month-tab") &&
    document.getElementById("month-tab").addEventListener("click", function () {
      var e = document.getElementsByClassName("month"),
        i = document.getElementsByClassName("annual"),
        t =
          (document.querySelectorAll(".plan-radio").forEach(function (e) {
            e.setAttribute("name", "plan-month");
          }),
          0);
      Array.from(e).forEach(function (e) {
        i[t] && (i[t].style.display = "none"),
          e && (e.style.display = "block"),
          t++;
      }),
        planMonth();
    }),
  document.getElementById("annual-tab") &&
    document
      .getElementById("annual-tab")
      .addEventListener("click", function () {
        var e = document.getElementsByClassName("month"),
          i = document.getElementsByClassName("annual"),
          t =
            (document.querySelectorAll(".plan-radio").forEach(function (e) {
              e.setAttribute("name", "plan-annual");
            }),
            0);
        Array.from(e).forEach(function (e) {
          i[t] && (i[t].style.display = "block"),
            e && (e.style.display = "none"),
            t++;
        }),
          planyear();
      });
var planList = [
  {
    project: "3",
    customers: "229",
    bandwidth: "scalable Bandwidth",
    ftp: "7",
    support: "No",
    storage: "2GB",
    domain: "domain",
  },
];
function planListData(e) {
  (document.getElementById("plan-list").innerHTML = ""),
    e.forEach(function (e) {
      document.getElementById("plan-list").innerHTML +=
        '<li>            <div class="d-flex">                <div class="flex-shrink-0 me-1">                    <i class="ri-checkbox-circle-fill text-success fs-15 align-middle"></i>                </div>                <div class="flex-grow-1">                    <b>' +
        e.project +
        '</b> Projects                </div>            </div>        </li>        <li>            <div class="d-flex">                <div class="flex-shrink-0 me-1">                    <i class="ri-checkbox-circle-fill text-success fs-15 align-middle"></i>                </div>                <div class="flex-grow-1">                    <b>' +
        e.customers +
        '</b> Customers                </div>            </div>        </li>        <li>            <div class="d-flex">                <div class="flex-shrink-0 me-1">                    <i class="ri-checkbox-circle-fill text-success fs-15 align-middle"></i>                </div>                <div class="flex-grow-1">' +
        e.bandwidth +
        '</div>            </div>        </li>        <li>            <div class="d-flex">                <div class="flex-shrink-0 me-1">                    <i class="ri-checkbox-circle-fill text-success fs-15 align-middle"></i>                </div>                <div class="flex-grow-1">                    <b>' +
        e.ftp +
        '</b> FTP Login                </div>            </div>        </li>        <li>            <div class="d-flex">                <div class="flex-shrink-0 me-1">                    <i class="ri-checkbox-circle-fill text-success fs-15 align-middle"></i>                </div>                <div class="flex-grow-1">                    <b>' +
        e.support +
        '</b> Support                </div>            </div>        </li>        <li>            <div class="d-flex">                <div class="flex-shrink-0 me-1">                    <i class="ri-checkbox-circle-fill text-success fs-15 align-middle"></i>                </div>                <div class="flex-grow-1">                    <b>' +
        e.storage +
        '</b> Storage                </div>            </div>        </li>        <li>            <div class="d-flex">                <div class="flex-shrink-0 me-1">                    <i class="ri-checkbox-circle-fill text-success fs-15 align-middle"></i>                </div>                <div class="flex-grow-1">' +
        e.domain +
        "</div>            </div>        </li>";
    });
}
function planMonth() {
  document.querySelectorAll("[name='plan-month']").forEach(function (i) {
    i.addEventListener("change", function () {
      var e = i.value;
      (planList = []),
        i.checked &&
          ("startup" == e
            ? planList.push({
                project: "3",
                customers: "229",
                bandwidth: "scalable Bandwidth",
                ftp: "7",
                support: "No",
                storage: "2GB",
                domain: "domain",
              })
            : "professional" == e
            ? planList.push({
                project: "8",
                customers: "449",
                bandwidth: "scalable Bandwidth",
                ftp: "7",
                support: "24/7",
                storage: "8GB",
                domain: "domain",
              })
            : "enterprise" == e
            ? planList.push({
                project: "15",
                customers: "999",
                bandwidth: "scalable Bandwidth",
                ftp: "12",
                support: "24/7",
                storage: "16GB",
                domain: "domain",
              })
            : "unlimited" == e &&
              planList.push({
                project: "Unlimited",
                customers: "Unlimited",
                bandwidth: "scalable Bandwidth",
                ftp: "Unlimited",
                support: "24/7",
                storage: "Unlimited",
                domain: "domain",
              }),
          planListData(planList));
    });
  });
}
function planyear() {
  document.querySelectorAll("[name='plan-annual']").forEach(function (i) {
    i.addEventListener("change", function () {
      var e = i.value;
      (planList = []),
        i.checked &&
          ("startup" == e
            ? planList.push({
                project: "13",
                customers: "2229",
                bandwidth: "scalable Bandwidth",
                ftp: "7",
                support: "24/7",
                storage: "Unlimited",
                domain: "domain",
              })
            : "professional" == e
            ? planList.push({
                project: "18",
                customers: "4449",
                bandwidth: "scalable Bandwidth",
                ftp: "7",
                support: "24/7",
                storage: "Unlimited",
                domain: "domain",
              })
            : "enterprise" == e
            ? planList.push({
                project: "215",
                customers: "9999",
                bandwidth: "scalable Bandwidth",
                ftp: "12",
                support: "24/7",
                storage: "Unlimited",
                domain: "domain",
              })
            : "unlimited" == e &&
              planList.push({
                project: "Unlimited",
                customers: "Unlimited",
                bandwidth: "scalable Bandwidth",
                ftp: "Unlimited",
                support: "24/7",
                storage: "Unlimited",
                domain: "domain",
              }),
          planListData(planList));
    });
  });
}
planListData(planList),
  document.querySelectorAll(".plan-radio").forEach(function (e) {
    e.setAttribute("name", "plan-month");
  }),
  planMonth(),
  planyear();
