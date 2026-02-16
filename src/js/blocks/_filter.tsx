import React from "react";
import { createRoot } from "react-dom/client";
import Filter from "../components/filter";

const root = createRoot(document.getElementById("filter-card")!);
root.render(<Filter />);
