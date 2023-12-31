var url = "assets/json/",
  allmemberlist = "",
  editlist = !1,
  prevButton = document.getElementById("page-prev"),
  nextButton = document.getElementById("page-next"),
  currentPage = 1,
  itemsPerPage = 8,
  getJSON = function (e, t) {
    var r = new XMLHttpRequest();
    r.open("GET", url + e, !0),
      (r.responseType = "json"),
      (r.onload = function () {
        var e = r.status;
        t(200 === e ? null : e, r.response);
      }),
      r.send();
  };
function loadTeamData(e, t) {
  var r = Math.ceil(e.length / itemsPerPage);
  r < (t = t < 1 ? 1 : t) && (t = r),
    (document.querySelector("#team-member-list").innerHTML = "");
  for (
    var a = (t - 1) * itemsPerPage;
    a < t * itemsPerPage && a < e.length;
    a++
  ) {
    var n = e[a].bookmark ? "active" : "",
      m = e[a].memberImg
        ? '<img src="' +
          e[a].memberImg +
          '" alt="" class="member-img img-fluid d-block rounded-3" />'
        : '<div class="avatar-title border bg-light text-primary rounded-3 text-uppercase fs-22">' +
          e[a].nickname +
          "</div>",
      i = e[a].memberName.split(" ")[0].toLowerCase();
    document.querySelector("#team-member-list").innerHTML +=
      '<div class="col-xxl-3 col-md-6">        <div class="card team-box">            <div class="card-body p-4 m-2">                <div class="row mb-4 pb-2">                    <div class="col">                        <div class="flex-shrink-0 me-2">                            <button type="button" class="btn btn-outline-warning custom-toggle rounded-circle btn-icon btn-sm ' +
      n +
      '" data-bs-toggle="button">                                <span class="icon-on"><i class="ri-star-line fs-14"></i></span>                                <span class="icon-off"><i class="ri-star-fill fs-14"></i></span>                            </button>                        </div>                    </div>                    <div class="col text-end dropdown"> <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="ri-more-fill fs-17"></i> </a>                        <ul class="dropdown-menu dropdown-menu-end">                            <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="' +
      e[a].id +
      '"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>                            <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="' +
      e[a].id +
      '"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>                        </ul>                    </div>                </div>                <div class="text-center mb-4">                    <div class="avatar-md mx-auto">' +
      m +
      '</div>                </div>                <div class="text-center mb-4 pb-3">                    <a href="#member-overview" class="member-name" data-bs-toggle="offcanvas">                        <h5 class="fs-17">' +
      e[a].memberName +
      '</h5>                    </a>                    <p class="text-muted mb-4">@' +
      i +
      '</p>                    <div class="d-none member-contact">' +
      e[a].contactNo +
      '</div>                    <div class="d-none member-email">' +
      e[a].email +
      '</div>                    <span class="badge badge-soft-success member-designation">' +
      e[a].position +
      '</span>                </div>                <div class="progress animated-progress progress-sm progress-label">                    <div class="progress-bar bg-primary" role="progressbar" style="width: ' +
      e[a].progress +
      '" aria-valuenow="' +
      e[a].progress.split("%")[0] +
      '" aria-valuemin="0" aria-valuemax="100">                        <div class="label">' +
      e[a].progress +
      '</div>                    </div>                </div>                <div class="row text-muted text-center mt-4">                    <div class="col-4 border-end border-end-dashed">                        <h5 class="mb-1 projects-num">' +
      e[a].projects +
      '</h5>                        <p class="text-muted mb-0">Projects</p>                    </div>                    <div class="col-4 border-end border-end-dashed">                        <h5 class="mb-1 projects-num">' +
      e[a].overdue +
      '</h5>                        <p class="text-muted mb-0">Overdue</p>                    </div>                    <div class="col-4">                        <h5 class="mb-1 tasks-num">' +
      e[a].tasks +
      '</h5>                        <p class="text-muted mb-0">Tasks</p>                    </div>                </div>            </div>        </div>    </div>';
  }
  selectedPage(),
    1 == currentPage
      ? prevButton.parentNode.classList.add("disabled")
      : prevButton.parentNode.classList.remove("disabled"),
    currentPage == r
      ? nextButton.parentNode.classList.add("disabled")
      : nextButton.parentNode.classList.remove("disabled"),
    editMemberList(),
    removeItem(),
    memberDetailShow();
}
function selectedPage() {
  for (
    var e = document
        .getElementById("page-num")
        .getElementsByClassName("clickPageNumber"),
      t = 0;
    t < e.length;
    t++
  )
    t == currentPage - 1
      ? e[t].parentNode.classList.add("active")
      : e[t].parentNode.classList.remove("active");
}
function paginationEvents() {
  function e() {
    return Math.ceil(allmemberlist.length / itemsPerPage);
  }
  prevButton.addEventListener("click", function () {
    1 < currentPage && loadTeamData(allmemberlist, --currentPage);
  }),
    nextButton.addEventListener("click", function () {
      currentPage < e() && loadTeamData(allmemberlist, ++currentPage);
    });
  var t = document.getElementById("page-num");
  t.innerHTML = "";
  for (var r = 1; r < e() + 1; r++)
    t.innerHTML +=
      "<div class='page-item'><a class='page-link clickPageNumber' href='javascript:void(0);'>" +
      r +
      "</a></div>";
  document.addEventListener("click", function (e) {
    "A" == e.target.nodeName &&
      e.target.classList.contains("clickPageNumber") &&
      ((currentPage = e.target.textContent),
      loadTeamData(allmemberlist, currentPage));
  }),
    selectedPage();
}
function fetchIdFromObj(e) {
  return parseInt(e.id);
}
function findNextId() {
  var e, t;
  return 0 === allmemberlist.length
    ? 0
    : (e = fetchIdFromObj(allmemberlist[allmemberlist.length - 1])) <=
      (t = fetchIdFromObj(allmemberlist[0]))
    ? t + 1
    : e + 1;
}
function sortElementsById() {
  loadTeamData(
    allmemberlist.sort(function (e, t) {
      (e = fetchIdFromObj(e)), (t = fetchIdFromObj(t));
      return t < e ? -1 : e < t ? 1 : 0;
    }),
    currentPage
  );
}
function editMemberList() {
  var r;
  Array.from(document.querySelectorAll(".edit-list")).forEach(function (t) {
    t.addEventListener("click", function (e) {
      (r = t.getAttribute("data-edit-id")),
        (allmemberlist = allmemberlist.map(function (e) {
          return (
            e.id == r &&
              ((editlist = !0),
              console.log(
                (document.getElementById("createMemberLabel").innerHTML =
                  "Edit Member")
              ),
              (document.getElementById("createMemberLabel").innerHTML =
                "Edit Member"),
              (document.getElementById("addNewMember").innerHTML = "Save"),
              "" == e.memberImg
                ? (document.getElementById("member-img").src =
                    "assets/images/users/user-dummy-img.jpg")
                : (document.getElementById("member-img").src = e.memberImg),
              (document.getElementById("memberid-input").value = e.id),
              (document.getElementById("teammembersName").value = e.memberName),
              (document.getElementById("designation").value = e.position),
              document
                .getElementById("memberlist-form")
                .classList.remove("was-validated")),
            e
          );
        }));
    });
  });
}
function removeItem() {
  var r;
  Array.from(document.querySelectorAll(".remove-list")).forEach(function (t) {
    t.addEventListener("click", function (e) {
      (r = t.getAttribute("data-remove-id")),
        document
          .getElementById("remove-item")
          .addEventListener("click", function () {
            var t;
            (t = r),
              loadTeamData(
                (allmemberlist = allmemberlist.filter(function (e) {
                  return e.id != t;
                })),
                currentPage
              ),
              document.getElementById("close-removeMemberModal").click();
          });
    });
  });
}
function memberDetailShow() {
  Array.from(document.querySelectorAll(".team-box")).forEach(function (s) {
    s.querySelector(".member-name").addEventListener("click", function () {
      var e = s.querySelector(".member-name h5").innerHTML,
        t = s.querySelector(".member-designation").innerHTML,
        r = s.querySelector(".member-img")
          ? s.querySelector(".member-img").src
          : "assets/images/users/user-dummy-img.jpg",
        a = s.querySelector(".projects-num").innerHTML,
        n = s.querySelector(".tasks-num").innerHTML,
        m = s.querySelector(".member-contact").innerHTML,
        i = s.querySelector(".member-email").innerHTML;
      (document.querySelector("#member-overview .profile-img").src = r),
        (document.querySelector("#member-overview .profile-name").innerHTML =
          e),
        (document.querySelector(
          "#member-overview .profile-designation"
        ).innerHTML = t),
        (document.querySelector("#member-overview .profile-project").innerHTML =
          a),
        (document.querySelector("#member-overview .profile-task").innerHTML =
          n),
        (document.querySelector("#member-overview .profile-contact").innerHTML =
          m),
        (document.querySelector("#member-overview .profile-email").innerHTML =
          i);
    });
  });
}
getJSON("team-member-list.json", function (e, t) {
  null !== e
    ? console.log("Something went wrong: " + e)
    : (loadTeamData((allmemberlist = t), currentPage),
      paginationEvents(),
      sortElementsById());
}),
  document
    .querySelector("#member-image-input")
    .addEventListener("change", function () {
      var e = document.querySelector("#member-img"),
        t = document.querySelector("#member-image-input").files[0],
        r = new FileReader();
      r.addEventListener(
        "load",
        function () {
          e.src = r.result;
        },
        !1
      ),
        t && r.readAsDataURL(t);
    }),
  Array.from(document.querySelectorAll(".addMembers-modal")).forEach(function (
    e
  ) {
    e.addEventListener("click", function (e) {
      (document.getElementById("createMemberLabel").innerHTML =
        "Add New Members"),
        (document.getElementById("addNewMember").innerHTML = "Add Member"),
        (document.getElementById("teammembersName").value = ""),
        (document.getElementById("designation").value = ""),
        (document.getElementById("member-img").src =
          "assets/images/users/user-dummy-img.jpg"),
        document
          .getElementById("memberlist-form")
          .classList.remove("was-validated");
    });
  }),
  (function () {
    "use strict";
    var e = document.querySelectorAll(".needs-validation");
    Array.prototype.slice.call(e).forEach(function (c) {
      c.addEventListener(
        "submit",
        function (e) {
          if (c.checkValidity()) {
            e.preventDefault();
            for (
              var t,
                r,
                a = document.getElementById("teammembersName").value,
                n = document.getElementById("designation").value,
                m = document.getElementById("member-img").src,
                i =
                  "assets/images/users/user-dummy-img.jpg" ==
                  m.substring(m.indexOf("/as") + 1)
                    ? ""
                    : m,
                s = a
                  .match(/\b(\w)/g)
                  .join("")
                  .substring(0, 2),
                l =
                  ("" === a || "" === n || editlist
                    ? "" !== a &&
                      "" !== n &&
                      editlist &&
                      ((t = 0),
                      (t = document.getElementById("memberid-input").value),
                      (allmemberlist = allmemberlist.map(function (e) {
                        return e.id == t
                          ? {
                              id: t,
                              bookmark: e.bookmark,
                              memberImg: m,
                              nickname: s,
                              memberName: a,
                              position: n,
                              progress: e.progress,
                              projects: e.projects,
                              overdue: e.overdue,
                              tasks: e.tasks,
                            }
                          : e;
                      })),
                      (editlist = !1))
                    : ((r = findNextId()),
                      allmemberlist.push({
                        id: r,
                        bookmark: !1,
                        memberImg: i,
                        nickname: s,
                        memberName: a,
                        position: n,
                        progress: "0%",
                        projects: "0",
                        overdue: "0",
                        tasks: "0",
                      }),
                      sortElementsById()),
                  document.getElementById("page-num")),
                o =
                  ((l.innerHTML = ""),
                  Math.ceil(allmemberlist.length / itemsPerPage)),
                d = 1;
              d < o + 1;
              d++
            )
              l.innerHTML +=
                "<div class='page-item'><a class='page-link clickPageNumber' href='javascript:void(0);'>" +
                d +
                "</a></div>";
            loadTeamData(allmemberlist, currentPage),
              document.getElementById("createMemberBtn-close").click();
          } else e.preventDefault(), e.stopPropagation();
          c.classList.add("was-validated");
        },
        !1
      );
    });
  })();
var searchElementList = document.getElementById("searchMemberList");
searchElementList.addEventListener("keyup", function () {
  var e = searchElementList.value.toLowerCase();
  t = e;
  for (
    var t,
      e = allmemberlist.filter(function (e) {
        return (
          -1 !== e.memberName.toLowerCase().indexOf(t.toLowerCase()) ||
          -1 !== e.position.toLowerCase().indexOf(t.toLowerCase())
        );
      }),
      r =
        (0 == e.length
          ? (document.getElementById("pagination-element").style.display =
              "none")
          : (document.getElementById("pagination-element").style.display =
              "flex"),
        document.getElementById("page-num")),
      a = ((r.innerHTML = ""), Math.ceil(e.length / itemsPerPage)),
      n = 1;
    n < a + 1;
    n++
  )
    r.innerHTML +=
      "<div class='page-item'><a class='page-link clickPageNumber' href='javascript:void(0);'>" +
      n +
      "</a></div>";
  loadTeamData(e, currentPage);
});
