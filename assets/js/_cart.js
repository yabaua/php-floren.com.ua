import { a as fetchEditCart } from "./fetchApi.js";
const initCart = async () => {
  document.querySelectorAll("#cart-modal-items-list .cart-item").forEach((item) => {
    item.querySelector("quantity-counter").addEventListener("change", () => updateCartDisplay());
    item.querySelector(".cart-item__remove").addEventListener("click", () => {
      item.querySelector("quantity-counter").value = 0;
      updateCartDisplay();
    });
  });
  document.getElementById("cart-modal").addEventListener("sl-hide", (e) => {
    e.target.querySelector(".cart-modal__message").style.display = "none";
  });
  document.getElementById("cart-recipient-checkbox")?.addEventListener("sl-change", (e) => {
    const isChecked = e.target.checked;
    document.getElementById("cart-recipient-grid").classList.toggle("hidden", isChecked);
  });
};
async function updateCartDisplay(cartData) {
  const cartTotal = cartData || [];
  if (!cartData) {
    document.querySelectorAll("#cart-modal-items-list .cart-item").forEach((item) => {
      const productId = item.dataset.id;
      const quantity = item.querySelector("quantity-counter").value;
      if (quantity > 0) {
        cartTotal.push({
          [productId]: quantity
        });
      }
    });
  }
  const data = await fetchEditCart(cartTotal);
  const list = document.getElementById("cart-modal-items-list");
  if (list && data.basket_items) {
    list.innerHTML = data.basket_items.map((item) => {
      const price = Number(item.price).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, " ");
      return `
        <li class="cart-item" data-id="${item.formID}">
          <div class="cart-item__image">
            <a href="${item.product_path}">
              <img src="${item.img_path}" alt="${item.name}">
            </a>
          </div>
          <div class="cart-item__details">
            <button class="cart-item__remove">
              <svg class="icon icon-trash"></svg>
            </button>
            <h3>
              <a href="${item.product_path}">${item.name}</a>
            </h3>
            <div class="cart-item__details_options">${item.formName}</div>
            <div class="cart-item__details_controls">
              <quantity-counter value="${item.cnt}" min="1"></quantity-counter>                    
              <div class="cart-item__details_price">${price} ₴</div>
            </div>
          </div>
        </li>`;
    }).join("");
    initCart();
  }
  const totalEl = document.getElementById("cart-modal-total-ammount");
  if (totalEl && data.basket_sum !== void 0) {
    const total = Number(data.basket_sum).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    totalEl.textContent = `${total} ₴`;
  }
  return data;
}
const addToCart = async (event) => {
  const productId = event.currentTarget.dataset.id;
  const name = event.currentTarget.dataset.name;
  const href = event.currentTarget.dataset.href;
  console.log("addToCart", productId, name, href);
  const cartList = [];
  document.querySelectorAll("#cart-modal-items-list .cart-item").forEach((item) => {
    const id = item.dataset.id;
    const quantity = item.querySelector("quantity-counter").value;
    if (quantity > 0) {
      cartList.push({
        [id]: quantity
      });
    }
  });
  const existingItemIndex = cartList.findIndex((item) => item[productId]);
  if (existingItemIndex !== -1) {
    cartList[existingItemIndex][productId] = Number(cartList[existingItemIndex][productId]) + 1;
  } else {
    cartList.push({
      [productId]: 1
    });
  }
  const data = await updateCartDisplay(cartList);
  const modal = document.getElementById("cart-modal");
  document.getElementById("cart-modal-product-name").textContent = name;
  document.getElementById("cart-modal-product-name").href = href;
  document.querySelector(".cart-modal__message").style.display = "block";
  if (modal) {
    modal.show();
  }
  console.log("addToCart", data);
};
export {
  addToCart as a,
  initCart as i
};
