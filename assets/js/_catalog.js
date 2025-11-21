const initCatalog = () => {
  window.currentPage = 1;
  const catalogButton = document.getElementById("catalog-button");
  const catalogSecondary = document.querySelectorAll(".header__catalog--secondary .secondary-item");
  const catalogOverlay = document.getElementById("catalog-overlay");
  const mainCategoryNavItems = document.querySelectorAll(".header__catalog_list .category-list > li");
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
    const firstCategoryItem = document.querySelector(".header__catalog_list .category-list > li:first-child");
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
const updateGoodsList = (data) => {
  const productsContainer = document.querySelector(".catalog-page__content_products");
  const productsHTML = data.map((item) => createProductCard(item)).join("");
  productsContainer.insertAdjacentHTML("beforeend", productsHTML);
};
function createProductCard(product) {
  let priceContent;
  if (product.good_status === "preorder") {
    priceContent = `
                    <div class="product-card__custom-order">Під замовлення</div>                    
                `;
  } else if (product.good_status === "not_available") {
    priceContent = `
        <div class="product-card__custom-order">Немає в наявності</div>                    
    `;
  } else {
    priceContent = `
      <div class="product-card__price">
        ${product.price}
        <div class="product-card__in-cart" title="Додати в кошик">
          <span class="icon icon-basket"></span>
        </div>
      </div>      
    `;
  }
  let variantsHtml = "";
  if (product.forms && product.forms.length > 0) {
    const listItems = product.forms.map((item) => `<li>${item.form_measure}</li>`).join("");
    variantsHtml = `
                    <section>
                        <h5>Доступні варіанти:</h5>
                        <ul>${listItems}</ul>
                    </section>
                `;
  }
  let colorsHtml = "";
  if (product.colors && product.colors.length > 0) {
    const colorSpans = product.colors.map((color) => `<span style="background-color: ${color};" title="${color}"></span>`).join("");
    colorsHtml = `
                    <section>
                        <h5>Кольори:</h5>
                        <div class="colors-list">
                            ${colorSpans}
                        </div>
                    </section>
                `;
  }
  const optionsBlock = variantsHtml || colorsHtml ? `<div class="product-card__options">${variantsHtml}${colorsHtml}</div>` : "";
  return `
            <div class="catalog-page__content_product-card">
              <div class="product-card__wrapper">
                
                <div class="product-card__image">
                  <a href="${product.product_path}">
                    <img src="${product.img_path}" alt="${product.name}" onerror="this.src='https://placehold.co/300?text=No+Image'"/>
                  </a>
                </div>
                
                <div class="product-card__name">
                  <a href="${product.product_path}">${product.name}</a>
                </div>

                ${priceContent}

                

                ${optionsBlock}

              </div>
            </div>
            `;
}
export {
  initCatalog as i,
  updateGoodsList as u
};
