module.exports = {
  plugins: [
    require("cssnano")({
      preset: ["default", { discardEmpty: true }],
    }),
  ],
};
