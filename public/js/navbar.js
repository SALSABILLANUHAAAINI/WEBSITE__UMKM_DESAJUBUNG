document.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.querySelector(".hamburger");
  const mobileMenu = document.querySelector(".mobile-menu");

  if (hamburger) {
    hamburger.addEventListener("click", () => {
      hamburger.classList.toggle("is-active");
      mobileMenu.classList.toggle("show");

      const expanded = hamburger.getAttribute("aria-expanded") === "true";
      hamburger.setAttribute("aria-expanded", !expanded);
    });
  }
});
