<script setup lang="ts">
import { useSidebar } from "~/composables/useSidebar";
import AppSideBar from "~/components/layout/AppSideBar.vue";

const { sidebar, close, open } = useSidebar();
</script>

<template>
  <div class="layout">
    <AppSideBar :class="{ 'is-closed': !sidebar.isOpen }" @close="close" />

    <div class="layout__content content">
      <main class="layout__main">
        <slot />
      </main>
    </div>

    <div v-if="sidebar.isOpen" class="layout__overlay" @click="close"></div>
  </div>
</template>

<style scoped lang="scss">
.layout {
  display: flex;
  height: 100vh;
  overflow: hidden;

  &__content {
    flex: 1;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    padding: pxToRem(12);
  }

  &__main {
    width: 100%;
    height: 100%;
    border-radius: pxToRem(22);
    overflow: hidden;
  }
}

.is-closed {
  display: none !important;
}
</style>
