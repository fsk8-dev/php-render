(() => {
  const btnNavOpen = document.getElementById("btn-nav-open");
  const navPanel = document.getElementById("nav");
  const body = document.getElementById("body");
  const overlay = document.getElementById("overlay");

  btnNavOpen.addEventListener("click", () => {
    navPanel.classList.toggle("nav--close");
    body.classList.toggle("modal-opened");
    overlay.classList.toggle("modal-opened");
    overlay.addEventListener("click", closeNavPanel);
  });

  btnNavClose.addEventListener("click", closeNavPanel);

  function closeNavPanel() {
    navPanel.classList.remove("nav__panel--open");
    body.classList.remove("modal-opened");
    overlay.classList.remove("modal-opened");
    overlay.removeEventListener("click", closeNavPanel);
  }
})();
