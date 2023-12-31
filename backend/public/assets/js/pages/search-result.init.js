var swiper = new Swiper(".images-menu", {
  slidesPerView: "auto",
  spaceBetween: 10,
  pagination: { el: ".swiper-pagination", clickable: !0 },
});
function _toConsumableArray(e) {
  if (Array.isArray(e)) {
    for (var r = 0, l = Array(e.length); r < e.length; r++) l[r] = e[r];
    return l;
  }
  return Array.from(e);
}
var galleryCardElm = document.querySelectorAll(
    "#gallery-element > .col-lg-4 .gallery-card"
  ),
  nextBtn = document.querySelector("#next-btn"),
  prevBtn = document.querySelector("#prev-btn");
function btnClickEvent() {
  var e = arguments.length <= 0 || void 0 === arguments[0] ? 0 : arguments[0],
    r = galleryCardElm.refIndex + e,
    e =
      (0 !== e &&
        (galleryCardElm[galleryCardElm.refIndex].classList.remove("bg-light"),
        galleryCardElm[r].classList.add("bg-light"),
        (galleryCardElm.refIndex = r)),
      (nextBtn.disabled = r == galleryCardElm.length - 1),
      (prevBtn.disabled = 0 == r),
      document.querySelector(
        "#gallery-element > .col-lg-4 .gallery-card.bg-light"
      )),
    r = e.querySelector(".gallery-img").src,
    l = e.querySelector(".card-caption-title").innerHTML,
    e = e.querySelector(".card-caption-desc").innerHTML;
  (document.getElementById("current").src = r),
    (document.querySelector("#gallerycard-overview .overview-title").innerHTML =
      l),
    (document.querySelector("#gallerycard-overview .overview-desc").innerHTML =
      e);
}
(galleryCardElm.refIndex = []
  .concat(_toConsumableArray(galleryCardElm))
  .findIndex(function (e) {
    return e.classList.contains("bg-light");
  })),
  btnClickEvent(),
  galleryCardElm.forEach(function (r, l, n) {
    r.onclick = function () {
      (galleryCardElm.refIndex = l),
        n.forEach(function (e) {
          return e.classList.toggle("bg-light", e === r);
        }),
        btnClickEvent();
      var e = document.getElementById("overview-cardelem");
      e.classList.contains("d-none") && e.classList.remove("d-none");
    };
  }),
  document
    .querySelector("#gallerycard-overview .btn-close")
    .addEventListener("click", function () {
      document.getElementById("overview-cardelem").classList.add("d-none");
    }),
  (nextBtn.onclick = function () {
    return btnClickEvent(1);
  }),
  (prevBtn.onclick = function () {
    return btnClickEvent(-1);
  });
