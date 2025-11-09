<script setup>
import SidebarUser from "~/components/layout/SidebarUser.vue";

const { sidebar } = useSidebar();

const items = ref([
  {
    label: "Router",
    icon: "pi pi-palette",
    items: [
      {
        label: "Styled",
        icon: "pi pi-eraser",
        route: "/theming/styled",
      },
      {
        label: "Unstyled",
        icon: "pi pi-heart",
        route: "/theming/unstyled",
      },
    ],
  },
  {
    label: "Programmatic",
    icon: "pi pi-link",
    command: () => {
      router.push("/introduction");
    },
  },
  {
    label: "External",
    icon: "pi pi-home",
    items: [
      {
        label: "Vue.js",
        icon: "pi pi-star",
        url: "https://vuejs.org/",
      },
      {
        label: "Vite.js",
        icon: "pi pi-bookmark",
        url: "https://vuejs.org/",
      },
    ],
  },
]);
</script>

<template>
  <div class="sidebar">
    <div class="sidebar__inner">
      <PanelMenu :model="items">
        <template #item="{ item }">
          <router-link
            v-if="item.route"
            v-slot="{ href, navigate }"
            :to="item.route"
            custom
          >
            <a
              v-ripple
              class="flex items-center cursor-pointer text-surface-700 dark:text-surface-0 px-4 py-2"
              :href="href"
              @click="navigate"
            >
              <span :class="item.icon" />
              <span class="ml-2">{{ item.label }}</span>
            </a>
          </router-link>
          <a
            v-else
            v-ripple
            class="flex items-center cursor-pointer text-surface-700 dark:text-surface-0 px-4 py-2"
            :href="item.url"
            :target="item.target"
          >
            <span :class="item.icon" />
            <span class="ml-2">{{ item.label }}</span>
            <span
              v-if="item.items"
              class="pi pi-angle-down text-primary ml-auto"
            />
          </a>
        </template>
      </PanelMenu>
    </div>
  </div>
</template>

<style scoped lang="scss">
.sidebar__menu {
  display: grid !important;
  grid-template-rows: auto 1fr auto !important;
  height: 100% !important;
}
.sidebar {
  width: pxToRem(240);
  height: 100%;
  padding: pxToRem(12);

  :deep(.p-menu) {
    display: grid;
    grid-template-rows: auto 1fr auto;
    height: 100%;
    border: none;
    overflow-y: auto;
  }

  :deep(.p-menu-list) {
    justify-content: center;
  }

  :deep(.p-menu-item-link) {
    width: 100%;
  }

  &__inner,
  &__menu {
    width: 100%;
    height: 100%;
  }

  &__logo {
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  &__logo,
  &__footer {
    padding: 1rem;
  }
}
</style>
