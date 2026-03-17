const isTouchDevice = () => window.matchMedia("(hover: none)").matches;

const initCatalog = () => {
  window.currentPage = 1;
  const catalogButton = document.getElementById("catalog-button");
  const catalogSecondary = document.querySelectorAll(".header__catalog--secondary .secondary-item");
  const catalogOverlay = document.getElementById("catalog-overlay");
  const mainCategoryNavItems = document.querySelectorAll(".header__catalog_list .category-list > li");
  if (!catalogButton || !catalogOverlay || !mainCategoryNavItems.length) {
    return;
  }

  const setActiveCategory = (category) => {
    const catalogItems = document.querySelectorAll(".category-content__item");
    mainCategoryNavItems.forEach((navItem) => {
      navItem.classList.toggle("active", navItem.dataset.category === category);
    });
    catalogItems.forEach((el) => {
      el.classList.toggle("active", el.dataset.category === category);
    });
  };

  const onHoverCategory = (item) => {
    setActiveCategory(item.dataset.category);
  };

  const onTouchCategory = (item) => {
    console.log('onTouchCategory!!!!!');
    // setActiveCategory(item.dataset.category);
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
    if (isTouchDevice()) {
      item.addEventListener("click", () => onTouchCategory(item));
    } else {
      item.addEventListener("mouseenter", () => onHoverCategory(item));
    }
  });
};

const updateGoodsList = (data) => {
  const productsContainer = document.querySelector(".catalog-page__content_products");
  
  // If data is just an array, it's the old format. If it's an object with goods, it's the new format.
  let goods = Array.isArray(data) ? data : data.goods;
  
  const productsHTML = goods.map((item) => createProductCard(item)).join("");
  productsContainer.insertAdjacentHTML("beforeend", productsHTML);

  // Try to find current active page and total pages from DOM before update
  let currentPage = 1;
  let totalPages = 1;
  
  const paginationContainer = document.getElementById("goods-pagination");
  if (paginationContainer) {
      const activeLink = paginationContainer.querySelector('.pagination__link.active');
      if (activeLink) {
        currentPage = parseInt(activeLink.textContent.trim());
      }
      
      // Try to find total pages from the last numbered link (before the "Next" arrow)
      // The structure is: ... [Page N] [Next Arrow]
      // We need to be careful not to pick "..." or arrows
      const links = Array.from(paginationContainer.querySelectorAll('.pagination__link'));
      // Filter out arrows (links with images) and non-numeric text
      const numericLinks = links.filter(link => !link.querySelector('img') && !isNaN(parseInt(link.textContent)));
      
      if (numericLinks.length > 0) {
          const lastPageLink = numericLinks[numericLinks.length - 1];
          totalPages = parseInt(lastPageLink.textContent);
      }
  }

  // Update pagination if data contains pagination info
  if (data.pagination) {
    updatePagination(data.pagination);
  } else {
    // Fallback: simple increment if no pagination data provided
    // We assume we just loaded the next page successfully
    
    const newPage = currentPage + 1;
    // If newPage exceeds known totalPages, we update totalPages too
    if (newPage > totalPages) {
        totalPages = newPage;
    }

    updatePagination({
      current_page: newPage,
      total_pages: totalPages
    });
  }
};

const updatePagination = (paginationData) => {  
  const paginationContainer = document.getElementById("goods-pagination");
  if (!paginationContainer) return;

  const { current_page, total_pages } = paginationData;
  const C = parseInt(current_page);
  const N = parseInt(total_pages);

  if (N <= 1) {
    paginationContainer.innerHTML = '';
    return;
  }

  // Helper to generate URL (preserves current query params, updates 'p')
  const getUrl = (page) => {
    const url = new URL(window.location.href);
    url.searchParams.delete('page');
    let pathname = url.pathname;
    pathname = pathname.replace(/\/page\d+\/?/, '');
    if (!pathname.endsWith('/')) {
      pathname += '/';
    }
    if (page > 1) {
      pathname += `page${page}/`;
    }
    url.pathname = pathname;
    return url.toString();
  };

  let html = '';

  // MUI algorithm: siblingCount=1, boundaryCount=1
  // siblingsStart = max(min(C-1, N-4), 3)
  let ss = Math.max(Math.min(C - 1, N - 4), 3);
  if (ss < 3) ss = 3;

  // siblingsEnd = min(max(C+1, 5), N-2)
  let se = Math.min(Math.max(C + 1, 5), N - 2);
  if (se > N - 2) se = N - 2;

  // Prev button
  if (C <= 1) {
    html += `
      <a class="pagination__link disabled" aria-disabled="true">
        <img src="/img/icons/icon-arrow-left-long.svg" alt="Попередня сторінка" />
      </a>`;
  } else {
    html += `
      <a class="pagination__link" href="${getUrl(C - 1)}">
        <img src="/img/icons/icon-arrow-left-long.svg" alt="Попередня сторінка" />
      </a>`;
  }

  // Page 1 (always visible)
  html += `<a class="pagination__link${C === 1 ? ' active' : ''}" href="${getUrl(1)}">1</a>`;

  // Left section
  if (ss > 3) {
    html += `<span class="pagination__ellipsis">...</span>`;
  } else if (ss === 3 && N > 2) {
    html += `<a class="pagination__link${C === 2 ? ' active' : ''}" href="${getUrl(2)}">2</a>`;
  }

  // Sibling pages loop
  for (let pn = ss; pn <= se; pn++) {
    html += `<a class="pagination__link${C === pn ? ' active' : ''}" href="${getUrl(pn)}">${pn}</a>`;
  }

  // Right section
  if (se < N - 2) {
    html += `<span class="pagination__ellipsis">...</span>`;
  } else if (se === N - 2 && N > 3) {
    const pNm1 = N - 1;
    html += `<a class="pagination__link${C === pNm1 ? ' active' : ''}" href="${getUrl(pNm1)}">${pNm1}</a>`;
  }

  // Last page (always visible)
  if (N > 1) {
    html += `<a class="pagination__link${C === N ? ' active' : ''}" href="${getUrl(N)}">${N}</a>`;
  }

  // Next button
  if (C >= N) {
    html += `
      <a class="pagination__link disabled" aria-disabled="true">
        <img src="/img/icons/icon-arrow-right-long.svg" alt="Наступна сторінка" />
      </a>`;
  } else {
    html += `
      <a class="pagination__link" href="${getUrl(C + 1)}">
        <img src="/img/icons/icon-arrow-right-long.svg" alt="Наступна сторінка" />
      </a>`;
  }

  paginationContainer.innerHTML = html;
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
  } else if (product.good_status === "in_stock") {
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
