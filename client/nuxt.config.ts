// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  publicRuntimeConfig: {
      appName: process.env.NUXT_ENV_APP_NAME,
    
  },
    css: ['~/assets/css/main.css', '@fortawesome/fontawesome-svg-core/styles.css'],
    postcss: {
      plugins: {
        tailwindcss: {},
        autoprefixer: {},
      },
    },
    components: [
        {
          path: '~/components',
          extensions: ['.vue'],
          pathPrefix: false,
          global: true,
          
        }
      ]
  })