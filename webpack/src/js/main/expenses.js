import * as modal from "../modal";

let forms = document.querySelectorAll("form");
let cofirmBtn = document.querySelector(".cofirm");
let ignoreBtn = document.querySelector(".ignore");

Array.from(forms).forEach((form) => {
  form.addEventListener(
    "submit",
    function (evt) {
      evt.preventDefault();
      modal.modalEffect("normal", "block", "flex");
      cofirmBtn.addEventListener("click", () => {
        form.submit();
        modal.modalEffect("reverse", "none", "none");
      });
      ignoreBtn.addEventListener("click", () => {
        modal.modalEffect("reverse", "none", "none");
      });
    },
    true
  );
});
