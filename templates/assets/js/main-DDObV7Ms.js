/* empty css               */
import { i as initSwipers, a as initHoverPhotoViewers } from "./_swipers-W78pJMEt.js";
import "./_shoelace-93ZMtKYV.js";
import { i as initEvents } from "./_events-B9TtzH4c.js";
import { i as initScroll } from "./_scroll-qwBtBhbR.js";
import { i as initCatalog } from "./_catalog-64HryAnt.js";
import { i as initClickOutsideHandlers } from "./_clickOutside-BYa46nKa.js";
import { i as initExpandableText } from "./_expandableText-Bi2QDYtX.js";
function startApp() {
  initEvents();
  initScroll();
  initCatalog();
  initClickOutsideHandlers();
  initSwipers();
  initExpandableText();
  initHoverPhotoViewers();
}
document.addEventListener("DOMContentLoaded", () => {
  startApp();
});
