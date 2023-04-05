// https://nuxt.com/docs/api/configuration/nuxt-config
import dotenv from 'dotenv'
dotenv.config()

export default defineNuxtConfig({
  runtimeConfig: {
    public: {
      appName: process.env.NUXT_ENV_APP_NAME
    }
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
      ],
    modules: [
      'nuxt-sanctum-auth',
    ],
    axios: {
      credentials: true,
    },
    ssr: false,
    nuxtSanctumAuth: {
      token: true, // set true to use jwt-token auth instead of cookie. default is false
      baseUrl: 'http://localhost:8000',
      endpoints: {
        csrf: '/sanctum/csrf-cookie',
        login: '/auth/login',
        logout: '/auth/logout',
        user: '/api/user/fetch-user'
      },
      redirects: {
        home: '/user/dashboard',
        login: '/',
        logout: '/'
      }
    },
    auth:{
      strategies: {
        laravelSanctum: {
          provider: 'laravel/sanctum',
          url: 'http://your-api-domain.com',
          endpoints: {
            login: { url: '/login', method: 'post', propertyName: 'token' },
            logout: { url: '/logout', method: 'post' },
            user: { url: '/user', method: 'get', propertyName: false },
          },
          tokenRequired: true,
          tokenType: 'Bearer',
        },
      },
      redirect: {
        login: '/login',
        logout: '/logout',
        home: '/',
      },
    },
    
    
    
})