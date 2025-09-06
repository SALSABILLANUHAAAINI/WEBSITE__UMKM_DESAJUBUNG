document.addEventListener("DOMContentLoaded", () => {
  const items = document.querySelectorAll(".accordion-item");

  items.forEach(item => {
    const header = item.querySelector(".accordion-header");

    header.addEventListener("click", () => {
      // Tutup semua yang lain
      items.forEach(i => {
        if (i !== item) i.classList.remove("active");
      });

      // Toggle yang diklik
      item.classList.toggle("active");
    });
  });
});
