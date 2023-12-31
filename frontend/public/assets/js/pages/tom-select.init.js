new TomSelect("#select-links", {
  valueField: "id",
  searchField: "title",
  options: [
    { id: 1, title: "DIY", url: "https://diy.org" },
    { id: 2, title: "Google", url: "http://google.com" },
    { id: 3, title: "Yahoo", url: "http://yahoo.com" },
  ],
  render: {
    option: function (e, t) {
      return (
        '<div><span class="title">' +
        t(e.title) +
        '</span><span class="url">' +
        t(e.url) +
        "</span></div>"
      );
    },
    item: function (e, t) {
      return '<div title="' + t(e.url) + '">' + t(e.title) + "</div>";
    },
  },
});
var REGEX_EMAIL =
    "([a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)",
  formatName = function (e) {
    return ((e.first || "") + " " + (e.last || "")).trim();
  },
  my_select =
    (new TomSelect("#select-to", {
      persist: !1,
      maxItems: null,
      valueField: "email",
      labelField: "name",
      searchField: ["first", "last", "email"],
      sortField: [
        { field: "first", direction: "asc" },
        { field: "last", direction: "asc" },
      ],
      options: [
        { email: "nikola@tesla.com", first: "Nikola", last: "Tesla" },
        { email: "brian@thirdroute.com", first: "Brian", last: "Reavis" },
        { email: "someone@gmail.com" },
        { email: "example@gmail.com" },
      ],
      render: {
        item: function (e, t) {
          var i = formatName(e);
          return (
            "<div>" +
            (i ? '<span class="name">' + t(i) + "</span>" : "") +
            (e.email ? '<span class="email">' + t(e.email) + "</span>" : "") +
            "</div>"
          );
        },
        option: function (e, t) {
          var i = formatName(e),
            a = i || e.email,
            i = i ? e.email : null;
          return (
            '<div><span class="label">' +
            t(a) +
            "</span>" +
            (i ? '<span class="caption">' + t(i) + "</span>" : "") +
            "</div>"
          );
        },
      },
      createFilter: function (e) {
        var t = new RegExp("^" + REGEX_EMAIL + "$", "i"),
          i = new RegExp("^([^<]*)<" + REGEX_EMAIL + ">$", "i");
        return t.test(e) || i.test(e);
      },
      create: function (e) {
        var t, i, a;
        return new RegExp("^" + REGEX_EMAIL + "$", "i").test(e)
          ? { email: e }
          : (e = e.match(new RegExp("^([^<]*)<" + REGEX_EMAIL + ">$", "i")))
          ? ((t = (a = e[1].trim()).indexOf(" ")),
            (i = a.substring(0, t)),
            (a = a.substring(t + 1)),
            { email: e[2], first: i, last: a })
          : (alert("Invalid email address."), !1);
      },
    }),
    new TomSelect("#select-person", {
      create: !0,
      sortField: { field: "text", direction: "asc" },
    }),
    new TomSelect("#select-bootstrap")),
  form = document.getElementById("bootstrap-form");
form.addEventListener(
  "submit",
  function (e) {
    form.classList.add("was-validated"),
      form.checkValidity() || (e.preventDefault(), e.stopPropagation());
  },
  !1
),
  new TomSelect("#pattern", { create: !0 }),
  new TomSelect(".data-attr", {
    render: {
      option: function (e, t) {
        return `<div><img class="me-2" src="${e.src}">${e.text}</div>`;
      },
      item: function (e, t) {
        return `<div><img class="me-2" src="${e.src}">${e.text}</div>`;
      },
    },
  }),
  new TomSelect(".data-flag", {
    render: {
      option: function (e, t) {
        return `<div><img class="me-2 avatar-xxs rounded" src="${e.src}">${e.text}</div>`;
      },
      item: function (e, t) {
        return `<div><img class="me-2 avatar-xxs rounded" src="${e.src}">${e.text}</div>`;
      },
    },
  });
