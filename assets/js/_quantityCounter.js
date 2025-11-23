class QuantityCounter extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: "open" });
  }
  static get observedAttributes() {
    return ["value", "min", "max"];
  }
  connectedCallback() {
    this.render();
    this.addEventListeners();
  }
  attributeChangedCallback(name, oldValue, newValue) {
    if (oldValue !== newValue && this.input) {
      if (name === "value") {
        this.input.value = newValue;
      } else {
        this.input.setAttribute(name, newValue);
      }
    }
  }
  get value() {
    return parseInt(this.getAttribute("value")) || 0;
  }
  set value(val) {
    this.setAttribute("value", val);
  }
  addEventListeners() {
    const btnMinus = this.shadowRoot.querySelector(".btn-minus");
    const btnPlus = this.shadowRoot.querySelector(".btn-plus");
    this.input = this.shadowRoot.querySelector("input");
    btnMinus.addEventListener("click", () => this.decrement());
    btnPlus.addEventListener("click", () => this.increment());
    this.input.addEventListener("change", (e) => {
      let val = parseInt(e.target.value);
      const min = parseInt(this.getAttribute("min"));
      const max = parseInt(this.getAttribute("max"));
      if (!isNaN(min) && val < min) val = min;
      if (!isNaN(max) && val > max) val = max;
      this.value = val;
      this.dispatchEvent(new CustomEvent("change", { detail: { value: this.value } }));
    });
  }
  increment() {
    const max = this.getAttribute("max");
    let newValue = this.value + 1;
    if (max !== null && newValue > parseInt(max)) return;
    this.value = newValue;
    this.input.value = newValue;
    this.dispatchEvent(new CustomEvent("change", { detail: { value: this.value } }));
  }
  decrement() {
    const min = this.getAttribute("min");
    let newValue = this.value - 1;
    if (min !== null && newValue < parseInt(min)) return;
    this.value = newValue;
    this.input.value = newValue;
    this.dispatchEvent(new CustomEvent("change", { detail: { value: this.value } }));
  }
  render() {
    this.shadowRoot.innerHTML = `
                <style>
                    :host {
                        display: inline-block;
                    }
                    .counter-input {
                        width: 96px;
                        height: 32px;
                        border: 1px solid var(--color-gray-40, #999); /* fallback color */
                        border-radius: 0.375rem; /* 6px */
                        display: grid;
                        grid-template-columns: 32px 1fr 32px;
                        overflow: hidden;
                        background-color: var(--color-white, #fff);
                        box-sizing: border-box;
                    }
                    button {
                        width: 100%;
                        height: 100%;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        background: none;
                        border: none;
                        cursor: pointer;
                        padding: 0;
                        transition: background-color 0.2s ease;
                    }
                    button:hover {
                        background-color: var(--color-button-hover, #eee);
                    }
                    button svg {
                        width: 16px;
                        height: 16px;
                        stroke: #333;
                    }
                    input {
                        all: unset;
                        width: 100%;
                        height: 100%;
                        text-align: center;
                        background-color: var(--color-white, #fff);
                        font-size: 14px;
                        font-weight: 500;
                        color: #333;
                        -moz-appearance: textfield;
                    }
                    /* Видалення стрілок input type number */
                    input::-webkit-outer-spin-button,
                    input::-webkit-inner-spin-button {
                        -webkit-appearance: none;
                        margin: 0;
                    }
                </style>

                <div class="counter-input">
                    <button type="button" class="btn-minus" aria-label="Зменшити">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </button>
                    
                    <input type="number" value="${this.value}" />
                    
                    <button type="button" class="btn-plus" aria-label="Збільшити">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </button>
                </div>
                `;
  }
}
export {
  QuantityCounter as Q
};
