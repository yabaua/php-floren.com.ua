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
    tooltip.open = !tooltip.open;
    wrapper.classList.toggle("active");
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
    console.log("modal", modal);
    if (modal) {
      modal.show();
    }
  },
  closeModal: () => {
    const modals = document.querySelectorAll("sl-dialog");
    modals.forEach((modal) => modal.hide());
  }
};
const initEvents = () => {
  const targets = document.querySelectorAll("[data-event]");
  targets.forEach((el) => {
    const event = el.dataset.event;
    const callback = clickHandlers[el.dataset.callback];
    if (!callback) {
      console.warn(
        `Callback function "${el.dataset.callback}" not found for element:`,
        el
      );
      return;
    }
    el.addEventListener(event, callback);
  });
};
export {
  initEvents as i
};
