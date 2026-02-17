import "./_vendors";
import "./_blocks";
import UIkit from "uikit";

window.addEventListener("DOMContentLoaded", () => {
  alert("ok");
  UIkit.modal("[data-uk-modal*='show: true']").show();
});
