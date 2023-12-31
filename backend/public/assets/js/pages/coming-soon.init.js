document.addEventListener("DOMContentLoaded", function () {
  Array.from(document.querySelectorAll(".countdownlist")).forEach(function (o) {
    var t = o.getAttribute("data-countdown"),
      c = new Date(t).getTime(),
      s = setInterval(function () {
        var t = new Date().getTime(),
          t = c - t,
          n = Math.floor(t / 864e5),
          i = Math.floor((t % 864e5) / 36e5),
          e = Math.floor((t % 36e5) / 6e4),
          d = Math.floor((t % 6e4) / 1e3);
        o &&
          (o.innerHTML =
            '<div class="countdownlist-item"><div class="count-title">Days</div><div class="count-num">' +
            n +
            '</div></div><div class="countdownlist-item"><div class="count-title">Hours</div><div class="count-num">' +
            i +
            '</div></div><div class="countdownlist-item"><div class="count-title">Minutes</div><div class="count-num">' +
            e +
            '</div></div><div class="countdownlist-item"><div class="count-title">Seconds</div><div class="count-num">' +
            d +
            "</div></div>"),
          t < 0 &&
            (clearInterval(s),
            (o.innerHTML =
              '<div class="countdown-endtxt">The countdown has ended!</div>'));
      }, 1e3);
  });
});
