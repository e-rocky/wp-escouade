import React from "react";
import { createRoot } from "react-dom/client";
import Search from "../components/search";

const root = createRoot(document.getElementById("search")!);
root.render(<Search />);
