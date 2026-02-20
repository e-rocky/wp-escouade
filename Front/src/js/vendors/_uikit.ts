import UIkit from "uikit";
import Icons from "uikit/dist/js/uikit-icons";

declare global {
  interface Window {
    UIkit: typeof UIkit;
  }
}

UIkit.use(Icons);
window.UIkit = UIkit;
