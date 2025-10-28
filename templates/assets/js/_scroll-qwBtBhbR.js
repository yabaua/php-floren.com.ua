const initHeaderScroll = () => {
  const header = document.querySelector(".header");
  if (!header) return;
  let lastScrollTop = 0;
  let isScrolling = false;
  const handleScroll = () => {
    if (isScrolling) return;
    isScrolling = true;
    requestAnimationFrame(() => {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      if (scrollTop > lastScrollTop && scrollTop > 100) {
        header.classList.add("header--hidden");
      } else if (scrollTop < lastScrollTop) {
        header.classList.remove("header--hidden");
      }
      lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
      isScrolling = false;
    });
  };
  window.addEventListener("scroll", handleScroll, { passive: true });
};
function initScroll() {
  initHeaderScroll();
}
export {
  initScroll as i
};
