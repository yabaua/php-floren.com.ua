function submitForm(e) {
  e.preventDefault();
  const action = e.target.action;
  const method = e.target.method || "POST";
  const formData = new FormData(e.target);
  console.log("e", action, method, formData);
  fetch(action, {
    method,
    body: formData
  }).then((response) => {
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    return response.json();
  }).then((data) => {
    console.log("Form submitted successfully:", data);
  }).catch((error) => {
    console.error("There was a problem with the form submission:", error);
  });
}
export {
  submitForm as s
};
