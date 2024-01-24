/* eslint-env node */
require('@rushstack/eslint-patch/modern-module-resolution')

module.exports = {
  root: true,
  env: {
    browser: true,
    node: true,
    es6: true,
    jest: true,
  },
  extends: [
    "airbnb-base",
    "plugin:@typescript-eslint/recommended",
    "plugin:vue/vue3-strongly-recommended",
    "@vue/eslint-config-typescript",
  ],
  parserOptions: {
    parser: "@typescript-eslint/parser",
    ecmaVersion: "latest",
  },
  plugins: ["@typescript-eslint", "import", "vue", "vite"],
  rules: {
    "@typescript-eslint/no-explicit-any": "off",
    "class-methods-use-this": 0,
    "func-names": 0,
    "import/extensions": [
      "error",
      "ignorePackages",
      {
        js: "never",
        jsx: "never",
        ts: "never",
        tsx: "never",
      },
    ],
    "import/no-extraneous-dependencies": [
      "error",
      {
        devDependencies: [
          "**/__tests__/**/*.js",
          "**/__tests__/**/*.spec.ts",
          "webpack.config.js",
        ],
      },
    ],
    "max-len": 0,
    "no-console": 0,
    "no-plusplus": ["error", { allowForLoopAfterthoughts: true }],
    "no-underscore-dangle": 0,
    "no-alert": 0,
    "no-bitwise": 0,
    "no-new": 0,
    "import/no-relative-packages": 0,
    "no-param-reassign": ["error", { props: false }],
    "prefer-destructuring": ["error", { object: true, array: false }],
    "vue/comma-spacing": ["error"],
    "vue/no-v-for-template-key": 0, // Because of Vue3
    "vue/no-mutating-props": 0,
    "vue/no-template-shadow": 0,
  },
  settings: {
    "import/resolver": {
      vite: {
        project: "./",
      },
    },
  },
  ignorePatterns: ["node_modules/"],
  overrides: [
    {
      files: ["*.vue"],
      rules: {
        indent: 0,
      },
    },
  ],
};
