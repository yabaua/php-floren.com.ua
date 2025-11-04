function initExpandableText() {
  const expandableTextBlocks = document.querySelectorAll(".expandable-text");
  expandableTextBlocks.forEach((block) => {
    const content = block.querySelector(".expandable-text__content");
    const button = block.querySelector(".expandable-text__button");
    const maxChars = parseInt(block.dataset.maxChars, 10) || 300;
    const originalHTML = content.innerHTML;
    const textContent = content.textContent || "";
    if (textContent.length <= maxChars) {
      button.style.display = "none";
      return;
    }
    let truncatedHTML = "";
    let currentCharCount = 0;
    const nodes = Array.from(content.childNodes);
    function processNodes(nodeList) {
      for (const node of nodeList) {
        if (currentCharCount >= maxChars) {
          break;
        }
        if (node.nodeType === Node.TEXT_NODE) {
          const remainingChars = maxChars - currentCharCount;
          if (node.textContent.length > remainingChars) {
            truncatedHTML += node.textContent.substring(0, remainingChars);
            currentCharCount = maxChars;
          } else {
            truncatedHTML += node.textContent;
            currentCharCount += node.textContent.length;
          }
        } else if (node.nodeType === Node.ELEMENT_NODE) {
          const tagName = node.tagName.toLowerCase();
          const attributes = Array.from(node.attributes).map((attr) => `${attr.name}="${attr.value}"`).join(" ");
          truncatedHTML += `<${tagName} ${attributes}>`;
          processNodes(node.childNodes);
          if (currentCharCount < maxChars) {
            truncatedHTML += `</${tagName}>`;
          }
        }
      }
    }
    processNodes(nodes);
    truncatedHTML += "...";
    const tempDiv = document.createElement("div");
    tempDiv.innerHTML = truncatedHTML;
    const fixedTruncatedHTML = tempDiv.innerHTML;
    content.innerHTML = fixedTruncatedHTML;
    button.addEventListener("click", () => {
      if (block.classList.contains("is-expanded")) {
        block.classList.remove("is-expanded");
        content.innerHTML = fixedTruncatedHTML;
        button.textContent = "Читати повністю";
      } else {
        block.classList.add("is-expanded");
        content.innerHTML = originalHTML;
        button.textContent = "Згорнути";
      }
    });
  });
}
export {
  initExpandableText as i
};
