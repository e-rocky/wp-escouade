import autosize from "autosize";
import UIkit from "uikit";

const textarea = document.querySelectorAll("textarea");
autosize(textarea);
const modals = document.querySelectorAll("[class*='uk-modal']");
modals.forEach((modal) => {
  UIkit.util.on(modal, "shown", () => {
    autosize.update(textarea);
  });
});
