import { useAuthStore } from "~/stores/auth";

export default defineNuxtRouteMiddleware(async (to) => {
  const auth = useAuthStore();

  if (!auth.authChecked) {
    await auth.getMe();
  }

  if (to.meta.requiresAuth !== false && !auth.isAuthenticated) {
    return navigateTo("/auth/login");
  }

  if (to.path === "/auth/login" && auth.isAuthenticated) {
    return navigateTo("/");
  }
});
