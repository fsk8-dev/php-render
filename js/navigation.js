(() => {
  const btnNavOpen = document.getElementById("btn-nav-open");
  const navPanel = document.getElementById("nav");
  const body = document.getElementById("body");
  const overlay = document.getElementById("overlay");
  const burger = document.querySelector(".burger");

  btnNavOpen.addEventListener("click", () => {
    transformBurger();
    toggleNavPanel();
    overlay.addEventListener("click", closeNavPanel);
  });

  function toggleNavPanel() {
    navPanel.classList.toggle("nav--close");
    body.classList.toggle("modal-opened");
    overlay.classList.toggle("modal-opened");
  }

  function closeNavPanel() {
    navPanel.classList.remove("nav__panel--open");
    body.classList.remove("modal-opened");
    overlay.classList.remove("modal-opened");
    overlay.removeEventListener("click", closeNavPanel);
  }

  function transformBurger() {
    if (!burger.classList.contains("transform-to-burger")) {
      burger.classList.add("transform-to-burger");
    }
    burger.classList.toggle("transform-to-cross");
  }
})();
