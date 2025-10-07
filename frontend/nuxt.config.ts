export default defineNuxtConfig({
  devtools: { enabled: true },
  ssr: false,

  runtimeConfig: {
    public: {
      apiUrl: import.meta.env.NUXT_API_URL ?? "",
    },
  },

  modules: ["@nuxt/eslint", "@pinia/nuxt"],

  pinia: {
    storesDirs: [".app/stores/**"],
  },

  compatibilityDate: "2025-07-15",
});
