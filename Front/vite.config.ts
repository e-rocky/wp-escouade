import { defineConfig } from "vite";
import UnoCSS from "unocss/vite";
import react from "@vitejs/plugin-react";

export default defineConfig({
  // UnoCSS configuration goes here
  plugins: [UnoCSS(), react()],
});
