// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false,
  modules: ["@nuxt/eslint", "@pinia/nuxt"],
  compatibilityDate: "2025-07-15",
  devtools: { enabled: true },
});
