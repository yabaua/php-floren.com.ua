import { a as addToCart } from "./_cart.js";
import { u as updateGoodsList } from "./_catalog.js";
import { f as fetchShowMoreGoods } from "./fetchApi.js";
const clickHandlers = {
  toggleLocation: (event) => {
    const element = event.currentTarget;
    const tooltip = element.closest("#location-tooltip");
    const wrapper = tooltip.querySelector(".header__main--location");
    tooltip.open = !tooltip.open;
    wrapper.classList.toggle("active");
  },
  togglePhones: (event) => {
    const element = event.currentTarget;
    const tooltip = element.closest("#phones-tooltip");
    const wrapper = tooltip.querySelector(".header__main--phones");
    if (wrapper.classList.contains("active")) {
      return;
    }
    // tooltip.open = !tooltip.open;
    wrapper.classList.toggle("active");
  },
  toggleTooltip: (event) => {
    const element = event.currentTarget;
    const tooltip = document.getElementById(element.dataset.tooltip);
    console.log('element', element);
    if (tooltip) {
      tooltip.open = !tooltip.open;  
    }    
  },
  toggleFooterPhones: (event) => {
    event.currentTarget.closest(".contacts-phone").classList.toggle("active");
  },
  toggleAdvicesPhones: (event) => {
    event.currentTarget.closest(".homepage__advices_content--phones").classList.toggle("active");
  },
  openModal: (e) => {    
    const modalId = e.currentTarget.dataset.modalId;
    const modal = document.getElementById(modalId);
    console.log('modalId', modalId);
    console.log('modal', modal);
    if (modal) {
      modal.show();
    }
  },
  closeModal: () => {
    const modals = document.querySelectorAll("sl-dialog");
    modals.forEach((modal) => modal.hide());
  },
  showMoreGoods: async () => {    
    try {
      const data = await fetchShowMoreGoods(window.currentPage + 1);
      updateGoodsList(data);
    } catch (error) {
      console.error("Error fetching more goods:", error);
    }
  },
  addToCart,
  toggleMobileSearch: (event) => {    
    const search = document.querySelector("#main-search-form");
    console.log('toggleMobileSearch', search);
    
    search.classList.toggle("active");
  }
};
const initEvents = () => {
  const targets = document.querySelectorAll("[data-event]");
  targets.forEach((el) => {
    const event = el.dataset.event;
    const callback = clickHandlers[el.dataset.callback];
    if (!callback) {
      console.warn(`Callback function "${el.dataset.callback}" not found for element:`, el);
      return;
    }
    el.addEventListener(event, callback);
  });
};
export {
  initEvents as i
};
