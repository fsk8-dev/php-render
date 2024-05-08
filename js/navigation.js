(() => {
  const btnNavOpen = document.getElementById("btn-nav-open");
  const btnNavClose = document.getElementById("btn-nav-close");
  const navPanel = document.getElementById("nav-panel");
  const body = document.getElementById("body");
  const overlay = document.getElementById("overlay");

  btnNavOpen.addEventListener("click", () => {
    navPanel.classList.add("nav__panel--open");
    body.classList.add("modal-opened");
    overlay.classList.add("modal-opened");
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
