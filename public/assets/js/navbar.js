 const menuBtn = document.getElementById("mobile-menu-btn");
  const mobileMenu = document.getElementById("mobile-menu");
  const hamburgerIcon = document.getElementById("hamburger-icon");
  const closeIcon = document.getElementById("close-icon");
  const dropdownBtn = document.getElementById("dropdownBtn");
  const dropdownMenu = document.getElementById("dropdownMenu");

  menuBtn.addEventListener("click", () => {
    mobileMenu.classList.toggle("-translate-x-full");
    hamburgerIcon.classList.toggle("hidden");
    closeIcon.classList.toggle("hidden");
  });

  dropdownBtn.addEventListener("click", () => {
    dropdownMenu.classList.toggle("hidden");
    dropdownBtn.querySelector("svg").classList.toggle("rotate-180");
  });

 let active = 'food';
  function setActive(cat) {
    active = cat;
    document.querySelectorAll('[data-panel]').forEach(p => {
      p.classList.toggle('hidden', p.getAttribute('data-panel') !== cat);
    });
    // Optional: style the active left link
    document.querySelectorAll('#categoryList [data-cat]').forEach(a => {
      const isActive = a.getAttribute('data-cat') === cat;
      a.classList.toggle('underline', isActive);
    });
  }
  function clearActive() {
    // keep current panel visible when mouse leaves the mega menu
    setActive(active);
  }
  // initialize once on load
  setActive(active);
