var lastScrollTop = 0;
const initHeaderScroll = () => {
  const catalogRef = document.getElementById("catalog-menu");
  window.addEventListener(
    "scroll",
    function() {
      var st = window.pageYOffset || document.documentElement.scrollTop;
      console.log("st", st);
      if (st <= 64) {
        catalogRef?.classList.remove("header__catalog--visible");
      }
      if (st > lastScrollTop) {
        catalogRef?.classList.remove("header__catalog--visible");
        console.log("Scrolling down");
      } else if (st < lastScrollTop && st > 64) {
        console.log("Scrolling up");
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
