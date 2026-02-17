import React from "react";
import { createRoot } from "react-dom/client";
import Search from "../components/search";

const el = document.getElementById("search");
if (el) {
  const root = createRoot(el);
  root.render(<Search />);
}
