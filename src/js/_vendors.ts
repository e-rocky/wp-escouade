import "virtual:uno.css";
import Icons from "uikit/dist/js/uikit-icons";
import autosize from "autosize";
import UIkit from "uikit";

UIkit.use(Icons);

autosize(document.querySelectorAll("textarea"));

declare global {
  interface Window {
    UIkit: typeof UIkit;
  }
}

window.UIkit = UIkit;
