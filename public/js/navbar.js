document.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.querySelector(".hamburger");
  const mobileMenu = document.querySelector(".mobile-menu");

  if (hamburger && mobileMenu) {
    hamburger.addEventListener("click", () => {
      hamburger.classList.toggle("is-active");
      mobileMenu.classList.toggle("show");

      // Update aria-expanded for accessibility
      const expanded = hamburger.classList.contains("is-active");
      hamburger.setAttribute("aria-expanded", expanded);
    });
  }
});
