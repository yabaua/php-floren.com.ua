import { a as fetchEditCart } from "./fetchApi.js";
const totalToPay = {
  deliveryCost: 0,
  productPrice: typeof cartState !== "undefined" ? Number(cartState.productPrice) : 0,
  total: 0
};
const initCart = async () => {
  console.log("initCart");
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
  document.getElementById("delivery-methods")?.addEventListener("sl-change", (e) => changeDeliveryOptions(e));
  document.getElementById("another-city-checkbox")?.addEventListener("sl-change", (e) => {
    const cityInput = document.querySelector('#courier-form sl-input[name="courier_city"]');
    console.log("another-city-checkbox", cityInput);
    if (e.target.checked) {
      cityInput.value = "";
      cityInput.removeAttribute("readonly");
      cityInput.focus();
      document.querySelector('sl-alert[data-name="city-delivery"]').show();
    } else {
      cityInput.value = defaultOptions.cityKiev;
      cityInput.setAttribute("readonly", "true");
      document.querySelector('sl-alert[data-name="city-delivery"]').hide();
    }
  });
  document.querySelectorAll("#basket-items-list .cart-item").forEach((item) => {
    item.querySelector("quantity-counter").addEventListener("change", () => changeBasketTotal(), { once: true });
  });
};
const addToCart = async (event) => {
  const productId = event.currentTarget.dataset.id;
  const name = event.currentTarget.dataset.name;
  const href = event.currentTarget.dataset.href;
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
              <div class="cart-item__details_controls-grid">
                <quantity-counter value="${item.cnt}" min="1"></quantity-counter>                    
                <span>${price} ₴</span>
              </div>              
              <div class="cart-item__details_price">${Number(item.cnt * Number(item.price)).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, " ")} ₴</div>
            </div>
          </div>
        </li>`;
    }).join("");
    const badgeEl = document.getElementById("cart-modal-button-badge");
    if (badgeEl) {
      if (data.basket_items.length > 0) {
        badgeEl.textContent = data.basket_items.length;
      } else {
        badgeEl.remove();
      }
    } else {
      document.querySelector('a[data-modal-id="cart-modal"]').insertAdjacentHTML("beforeend", `<span id="cart-modal-button-badge" class="badge success">${data.basket_items.length}</span>`);
    }
    initCart();
  }
  const totalEl = document.getElementById("cart-modal-total-ammount");
  if (totalEl && data.basket_sum !== void 0) {
    const total = Number(data.basket_sum).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    totalEl.textContent = `${total} ₴`;
  }
  console.log("changeDeliveryOptions", data);
  return data;
}
async function changeBasketTotal(cartData) {
  const { smallOrder, smallOrderDeliveryPrice, courierDeliveryPrice, novaPostaCost } = defaultOptions;
  const cartTotal = [];
  {
    document.querySelectorAll("#basket-items-list .cart-item").forEach((item) => {
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
              <div class="cart-item__details_controls-grid">
                <quantity-counter value="${item.cnt}" min="1"></quantity-counter>                    
                <span>${price} ₴</span>
              </div>              
              <div class="cart-item__details_price">${Number(item.cnt * Number(item.price)).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, " ")} ₴</div>
            </div>
          </div>
        </li>`;
    }).join("");
    const badgeEl = document.getElementById("cart-modal-button-badge");
    if (badgeEl) {
      if (data.basket_items.length > 0) {
        badgeEl.textContent = data.basket_items.length;
      } else {
        badgeEl.remove();
      }
    } else {
      document.querySelector('a[data-modal-id="cart-modal"]').insertAdjacentHTML("beforeend", `<span id="cart-modal-button-badge" class="badge success">${data.basket_items.length}</span>`);
    }
    initCart();
  }
  const totalEl = document.getElementById("cart-modal-total-ammount");
  const basketTotalprice = document.getElementById("basket_totalprice");
  if (data.basket_sum !== void 0) {
    const total = Number(data.basket_sum).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    if (totalEl) totalEl.textContent = `${total} ₴`;
    if (basketTotalprice) basketTotalprice.textContent = `${total} ₴`;
    totalToPay.productPrice = Number(data.basket_sum);
    totalToPay.total = Number(data.basket_sum) + totalToPay.deliveryCost;
    const productPrice = totalToPay.productPrice || 0;
    const deliveryMethod = document.getElementById("delivery-methods")?.value;
    if (deliveryMethod === "courier") {
      if (productPrice < smallOrder && totalToPay.deliveryCost === courierDeliveryPrice) {
        totalToPay.deliveryCost += smallOrderDeliveryPrice;
        document.querySelector('sl-alert[data-name="small-order"]').show();
      }
      if (productPrice > smallOrder && totalToPay.deliveryCost === courierDeliveryPrice + smallOrderDeliveryPrice) {
        totalToPay.deliveryCost -= smallOrderDeliveryPrice;
        document.querySelector('sl-alert[data-name="small-order"]').hide();
      }
    }
    refreshTotal(totalToPay);
  }
  return data;
}
function changeDeliveryOptions(e) {
  const { smallOrder, smallOrderDeliveryPrice, courierDeliveryPrice, novaPostaCost } = defaultOptions;
  refreshCart();
  switch (e.target.value) {
    case "courier":
      totalToPay.deliveryCost = courierDeliveryPrice;
      document.getElementById("courier-form").classList.remove("hidden");
      if (!!cartState.bigGoodCourier) {
        document.querySelector('sl-alert[data-name="delivery-biggoods"]').show();
      }
      const productPrice = totalToPay.productPrice || 0;
      if (productPrice < smallOrder) {
        totalToPay.deliveryCost += smallOrderDeliveryPrice;
        document.querySelector('sl-alert[data-name="small-order"]').show();
      }
      totalToPay.total = totalToPay.productPrice + totalToPay.deliveryCost;
      refreshTotal(totalToPay);
      break;
    case "nova-poshta":
      document.getElementById("nova-poshta-form").classList.remove("hidden");
      if (!!cartState.bigGoodCourier) {
        document.querySelector('sl-alert[data-name="delivery-biggoods"]').show();
      }
      document.querySelector('.summary__item_label[data-text="np-cost"]').classList.remove("hidden");
      document.querySelector('.summary__item_label[data-text="delivery-cost"]').classList.add("hidden");
      document.querySelector('#payment-cash-option [data-text="cash"]').classList.add("hidden");
      document.querySelector('#payment-cash-option [data-text="nova-poshta-money"]').classList.remove("hidden");
      if (cartState.isPlant) {
        document.querySelector('sl-alert[data-name="not-nova-poshta"]').show();
      }
      totalToPay.deliveryCost = novaPostaCost;
      refreshTotal(totalToPay);
      break;
    default:
      document.getElementById("magazin-form").classList.remove("hidden");
      totalToPay.deliveryCost = 0;
      refreshTotal(totalToPay);
      break;
  }
}
function refreshCart() {
  document.querySelectorAll("sl-alert[data-name]").forEach((alert) => alert.hide());
  document.getElementById("magazin-form").classList.add("hidden");
  document.getElementById("courier-form").classList.add("hidden");
  document.getElementById("nova-poshta-form").classList.add("hidden");
  document.querySelector('.summary__item_label[data-text="np-cost"]').classList.add("hidden");
  document.querySelector('.summary__item_label[data-text="delivery-cost"]').classList.remove("hidden");
  document.querySelector('#payment-cash-option [data-text="cash"]').classList.remove("hidden");
  document.querySelector('#payment-cash-option [data-text="nova-poshta-money"]').classList.add("hidden");
}
function refreshTotal(totalToPay2) {
  console.log("totalToPay", totalToPay2);
  document.querySelector("#delivery-cost").textContent = `${Number(totalToPay2.deliveryCost).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, " ")} ₴`;
  document.querySelector("#total-to-pay").textContent = `${Number(totalToPay2.productPrice + totalToPay2.deliveryCost).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, " ")} ₴`;
  document.getElementById("input-hidden-basket_totalprice").value = Number(totalToPay2.productPrice);
  document.getElementById("input-hidden-cost_delivery").value = Number(totalToPay2.deliveryCost);
  document.getElementById("input-hidden-to_pay").value = Number(totalToPay2.productPrice + totalToPay2.deliveryCost);
}
export {
  addToCart as a,
  initCart as i
};
