import { f as fetchEditCart } from "./fetchApi.js";
const initCartModal = async () => {
  document
    .querySelectorAll("#cart-modal-items-list .cart-item")
    .forEach((item) => {
      item
        .querySelector("quantity-counter")
        .addEventListener("change", () => updateCartDisplay());
      item.querySelector(".cart-item__remove").addEventListener("click", () => {
        item.querySelector("quantity-counter").value = 0;
        updateCartDisplay();
      });
    });
};
async function updateCartDisplay() {
  const cartTotal = [];
  document
    .querySelectorAll("#cart-modal-items-list .cart-item")
    .forEach((item) => {
      const productId = item.dataset.id;
      const quantity = item.querySelector("quantity-counter").value;
      if (quantity > 0) {
        cartTotal.push({
          [productId]: quantity,
        });
      }
    });
  const data = await fetchEditCart(cartTotal);
  const list = document.getElementById("cart-modal-items-list");
  if (list && data.basket_items) {
    list.innerHTML = data.basket_items
      .map((item) => {
        const price = Number(item.price)
          .toFixed(2)
          .replace(/\B(?=(\d{3})+(?!\d))/g, " ");
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
      })
      .join("");
    initCartModal();
  }
  const totalEl = document.getElementById("cart-modal-total-ammount");
  if (totalEl && data.basket_sum !== void 0) {
    const total = Number(data.basket_sum)
      .toFixed(2)
      .replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    totalEl.textContent = `${total} ₴`;
  }
}
export { initCartModal as i };
