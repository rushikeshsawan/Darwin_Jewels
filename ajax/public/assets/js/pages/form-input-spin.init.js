function isData() {
  var t = document.getElementsByClassName("plus"),
    e = document.getElementsByClassName("minus"),
    n = document.getElementsByClassName("product");
  t &&
    Array.from(t).forEach(function (t) {
      t.addEventListener("click", function (e) {
        parseInt(t.previousElementSibling.value) <
          e.target.previousElementSibling.getAttribute("max") &&
          (e.target.previousElementSibling.value++, n) &&
          Array.from(n).forEach(function (t) {
            updateQuantity(e.target);
          });
      });
    }),
    e &&
      Array.from(e).forEach(function (t) {
        t.addEventListener("click", function (e) {
          parseInt(t.nextElementSibling.value) >
            e.target.nextElementSibling.getAttribute("min") &&
            (e.target.nextElementSibling.value--, n) &&
            Array.from(n).forEach(function (t) {
              updateQuantity(e.target);
            });
        });
      });
}
isData();
