import { defineConfig } from "vite";
import UnoCSS from "unocss/vite";
import { resolve } from "path";

export default defineConfig({
  // UnoCSS configuration goes here
  plugins: [UnoCSS()],
});
