import "uppy/dist/uppy.min.css";

import Uppy from "@uppy/core";
import Dashboard from "@uppy/dashboard";
//import RemoteSources from "@uppy/remote-sources";
import Tus from "@uppy/tus";

new Uppy()
  .use(Dashboard, { inline: true, target: "#uppy-dashboard" })
  //.use(RemoteSources, { companionUrl: "https://companion.uppy.io" })
  .use(Tus, { endpoint: "https://tusd.tusdemo.net/files/" })
  .on("complete", (result) => {
    console.log("Upload result:", result);
  });
