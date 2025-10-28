const initCatalog = () => {
  const catalogButton = document.getElementById("catalog-button");
  const catalogSecondary = document.querySelectorAll(
    ".header__catalog--secondary .secondary-item"
  );
  const catalogOverlay = document.getElementById("catalog-overlay");
  const mainCategoryNavItems = document.querySelectorAll(
    ".header__catalog_list .category-list > li"
  );
  if (!catalogButton || !catalogOverlay || !mainCategoryNavItems.length) {
    return;
  }
  const onHoverCategory = (item) => {
    const category = item.dataset.category;
    const catalogItems = document.querySelectorAll(".category-content__item");
    mainCategoryNavItems.forEach((navItem) => {
      if (navItem.dataset.category === category) {
        navItem.classList.add("active");
      } else {
        navItem.classList.remove("active");
      }
    });
    catalogItems.forEach((el) => {
      if (el.dataset.category === category) {
        el.classList.add("active");
      } else {
        el.classList.remove("active");
      }
    });
  };
  catalogButton.addEventListener("click", () => {
    const firstCategoryItem = document.querySelector(
      ".header__catalog_list .category-list > li:first-child"
    );
    onHoverCategory(firstCategoryItem);
    document.body.classList.toggle("catalog-opened");
  });
  catalogSecondary.forEach((item) => {
    item.addEventListener("mouseenter", () => {
      document.body.classList.remove("catalog-opened");
      item.classList.add("active");
      document.body.classList.add("secondary-hovered");
    });
    item.addEventListener("mouseleave", () => {
      item.classList.remove("active");
      document.body.classList.remove("secondary-hovered");
    });
  });
  catalogOverlay.addEventListener("click", () => {
    document.body.classList.remove("catalog-opened");
  });
  mainCategoryNavItems.forEach((item) => {
    item.addEventListener("mouseenter", () => onHoverCategory(item));
  });
};
export {
  initCatalog as i
};
