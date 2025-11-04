export default defineNuxtConfig({
  devtools: { enabled: true },
  experimental: {
    renderJsonPayloads: false,
  },
  ssr: false,

  runtimeConfig: {
    public: {
      appName: import.meta.env.NUXT_APP_NAME ?? "",
      apiUrl: import.meta.env.NUXT_API_URL ?? "",
    },
  },

  modules: ["@nuxt/eslint", "@pinia/nuxt", "@primevue/nuxt-module"],

  primevue: {
    options: {
      theme: {
        theme: "none",
      },
    },
    components: {
      exclude: ["Editor", "Chart"],
    },
  },

  pinia: {
    storesDirs: [".app/stores/**"],
  },

  css: ["~/assets/scss/style.scss"],

  compatibilityDate: "2025-07-15",
});
