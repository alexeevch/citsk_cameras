import CITPreset from "./app/configs/primevue.config";

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

  modules: [
    "@nuxt/eslint",
    "@pinia/nuxt",
    "@primevue/nuxt-module",
    "vue-yandex-maps/nuxt",
    "@nuxt/image",
  ],

  pinia: {
    storesDirs: [".app/stores/**"],
  },

  yandexMaps: {
    apikey: import.meta.env.YX_MAPS_API_KEY,
  },

  css: ["~/assets/scss/style.scss"],

  vite: {
    css: {
      preprocessorOptions: {
        scss: {
          additionalData: `
            @use "~/assets/scss/common" as *;
            @use "~/assets/scss/core" as *;
          `,
        },
      },
    },
  },

  primevue: {
    autoImport: false,

    options: {
      theme: {
        preset: CITPreset,
        options: {
          darkModeSelector: "system",
        },
      },
    },

    components: {
      include: [
        "Form",
        "Button",
        "ButtonGroup",
        "FormField",
        "InputText",
        "Message",
        "Password",
        "Checkbox",
        "Menu",
        "Avatar",
        "PanelMenu",
      ],
    },
  },

  compatibilityDate: "2025-07-15",
});
