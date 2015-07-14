document.addEventListener("DOMContentLoaded", function(event) {
  window.wl = new Waitlisted.Modal({domain: wlParams.domain, color: wlParams.color, title: wlParams.social, target: 'waitlisted-cta'});
  window.wl.bootstrap()
});