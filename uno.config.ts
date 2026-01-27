import { defineConfig, presetWind3 } from "unocss";

export default defineConfig({
  presets: [presetWind3()],
  rules: [
    [/^fz\:(\d+(?:\.\d+)?)$/, ([, num]) => ({ "font-size": `${num}px` })],
  ],
});
