const path = require("path");

module.exports = {
  mode: "production",
  entry: {
    home: "./src/js/main/home.js",
    expenses: "./src/js/main/expenses.js",
    scss: "./src/js/main/scss.js",
  },
  output: {
    filename: "[name].js",
    path: path.resolve(__dirname, "../public/dist"),
  },
  module: {
    rules: [
      {
        test: /\.s[ac]ss$/i,
        use: [
          // Creates `style` nodes from JS strings
          "style-loader",
          // Translates CSS into CommonJS
          "css-loader",
          // Compiles Sass to CSS
          "sass-loader",
        ],
      },
    ],
  },
};
