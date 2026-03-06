var lastScrollTop = 0;
const initHeaderScroll = () => {
  console.log('initHeaderScroll');
  return;
  
  const catalogRef = document.getElementById("catalog-menu");
  window.addEventListener(
    "scroll",
    function() {
      var st = window.pageYOffset || document.documentElement.scrollTop;
      if (st <= 64) {
        catalogRef?.classList.remove("header__catalog--visible");
      }
      if (st > lastScrollTop) {
        catalogRef?.classList.remove("header__catalog--visible");
      } else if (st < lastScrollTop && st > 64) {
        catalogRef?.classList.add("header__catalog--visible");
      }
      lastScrollTop = st <= 0 ? 0 : st;
    },
    false
  );
};
function initScroll() {
  initHeaderScroll();
}
export {
  initScroll as i
};
