const initTooltipClickOutside = () => {
  const tooltips = document.querySelectorAll('sl-tooltip[trigger="manual"]');
  tooltips.forEach((tooltip) => {
    const handleClickOutside = (event) => {
      if (!tooltip.open) return;
      const isClickInside = tooltip.contains(event.target);
      if (!isClickInside) {
        tooltip.hide();
      }
    };
    document.addEventListener("click", handleClickOutside);
    tooltip._cleanupClickOutside = () => {
      document.removeEventListener("click", handleClickOutside);
    };
  });
};
const initCatalogClickOutside = () => {
  const overlay = document.getElementById("catalog-overlay");
  const catalog = document.querySelector(".header__catalog_list");
  const catalogButton = document.querySelector(
    '[data-callback="toggleCatalog"]'
  );
  if (!overlay || !catalog) return;
  const handleClickOutside = (event) => {
    if (!overlay.classList.contains("active")) return;
    const isClickInCatalog = catalog.contains(event.target);
    const isClickOnButton = catalogButton && catalogButton.contains(event.target);
    if (!isClickInCatalog && !isClickOnButton) {
      overlay.classList.remove("active");
      catalog.classList.remove("active");
    }
  };
  document.addEventListener("click", handleClickOutside);
};
const initClickOutsideHandlers = () => {
  initTooltipClickOutside();
  initCatalogClickOutside();
};
export {
  initClickOutsideHandlers as i
};
