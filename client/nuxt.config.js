export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  server: {
    host: process.env.APP_URL, // default: localhost
  },
  head: {
    title: "client",
    htmlAttrs: {
      lang: "en",
    },
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      { hid: "description", name: "description", content: "" },
      { name: "format-detection", content: "telephone=no" },
    ],
    link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }],
  },

  // use these settings to use custom css

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    "@/assets/css/main.css",
    "@fortawesome/fontawesome-svg-core/styles.css",
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: ["~/plugins/fontawesome.js"],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/tailwindcss
  ],

  axios: {
    credentials: true,
    baseURL: process.env.API_BASE_URL,
  },

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: ["@nuxtjs/dotenv", "@nuxtjs/auth-next", "@nuxtjs/axios"],
  auth: {
    strategies: {
      userAuth: {
        provider: "laravel/sanctum",
        token: {
          property: "token",
          maxAge: 1800,
          type: "Bearer",
          required: true,
          global: true,
        },
        url: process.env.API_BASE_URL,
        endpoints: {
          login: { url: "/auth/login", method: "post" },
          logout: { url: "/auth/logout", method: "post" },
          user: { url: "/auth/user", method: "get" },
        },
        // redirect: { home: "/user/request" },
      },
      adminAuth: {
        provider: "laravel/sanctum",
        token: {
          property: "token",
          maxAge: 1800,
          type: "Bearer",
          required: true,
          global: true,
        },
        url: process.env.API_BASE_URL,
        endpoints: {
          login: { url: "/auth/admin/login", method: "post" },
          logout: { url: "/auth/logout", method: "post" },
          user: { url: "/auth/admin", method: "get" },
        },
      },
    },
    // redirect: {
    //   login: "/admin",
    //   logout: "/admin",
    //   callback: "/admin",
    //   home: "/admin/dashboard",
    // },
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    transpile: ["defu"],
    postcss: {
      postcssOptions: {
        plugins: {
          tailwindcss: {},
          autoprefixer: {},
        },
      },
    },
  },
};
