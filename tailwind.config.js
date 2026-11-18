/** @type {import('tailwindcss').Config} */
const flowbitePlugin = require("flowbite/plugin");
const formsPlugin = require("@tailwindcss/forms");
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                car: ["Rubik"],
            },
            colors: {
                pr: {
                    50: "#fef5f5",
                    100: "#fdebec",
                    200: "#f5b4b6",
                    300: "#ea7a7e",
                    400: "#D53338",
                    500: "#c02b30",
                    600: "#a82529",
                    700: "#8f1f23",
                    800: "#761a1d",
                    900: "#5c1417",
                },
                brand: {
                    DEFAULT: "#303030",
                    dark: "#282828",
                    muted: "#404040",
                },
                sec: {
                    100: "#fafafa",
                    200: "#f0f0f0",
                    300: "#f7f7f8",
                    400: "#f5f5f6",
                    500: "#dddddd",
                    600: "#eeeeee",
                    700: "#c4c4c4",
                    800: "#acacac",
                    900: "#303030",
                },
            },
        },
    },
    plugins: [flowbitePlugin, formsPlugin,],
};

