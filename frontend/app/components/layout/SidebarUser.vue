<script setup lang="ts">
import { useAuthStore } from "~/stores/auth";
const { user } = storeToRefs(useAuthStore());

console.log(user.value);
</script>

<template>
  <div class="user">
    <div class="user__post">
      {{ user?.email }}
    </div>
    <div class="user__name">
      {{ user?.fullName }}
    </div>
  </div>
</template>

<style scoped lang="scss">
.user {
  background-color: #384252;
  padding: 0.5rem;
  border-radius: pxToRem(20);
}

.user__post {
  font-size: pxToRem(14);
}

.user__name {
  text-transform: uppercase;
  font-weight: 500;
}
</style>
