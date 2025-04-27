let lastScrollTop = 0; // Nyomon követi az utolsó görgetési pozíciót

window.addEventListener("scroll", function () {
  let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

  if (currentScroll > lastScrollTop) {
    // Ha lefelé görgetsz, eltünteti a navbar-t
    document.querySelector("header").style.top = "-80px";
  } else {
    // Ha felfelé görgetsz, megjeleníti a navbar-t
    document.querySelector("header").style.top = "0";
  }

  lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Megakadályozza, hogy a scroll érték negatív legyen
});
