import type { LoginCredentials, User } from "~/types/auth";
import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", () => {
  const { $apiFetcher } = useNuxtApp();

  const user = ref<User | null>(null);
  const isLoading = ref(false);
  const errorMessage = ref<string | null>(null);

  const isAuthenticated = computed(() => !!user.value);

  async function login($credentials: LoginCredentials) {
    try {
      isLoading.value = true;
      errorMessage.value = null;

      await updateCSRFCookie();

      user.value = await $apiFetcher(`/auth/login`, {
        method: "POST",
        data: $credentials,
      });
    } catch (e) {
      console.error(e);
    } finally {
      isLoading.value = false;
    }
  }

  async function getMe() {
    try {
      isLoading.value = true;
      errorMessage.value = null;

      user.value = await $apiFetcher<User>(`/auth/me`);
    } catch (e) {
      console.error(e);
    } finally {
      isLoading.value = false;
    }
  }

  async function logout() {
    try {
      isLoading.value = true;
      errorMessage.value = null;

      await $apiFetcher(`/auth/logout`, { method: "POST" });
      user.value = null;
    } catch (e) {
      console.error(e);
    }
  }

  async function updateCSRFCookie() {
    try {
      isLoading.value = true;
      errorMessage.value = null;

      await $apiFetcher(`/auth/csrf-token`, {
        method: "GET",
      });
    } catch (e) {
      console.error(e);
      errorMessage.value = "Не удалось получить CSRF токен";
    } finally {
      isLoading.value = false;
    }
  }

  return {
    user,
    isAuthenticated,
    isLoading,
    errorMessage,

    login,
    logout,
    getMe,
    updateCSRFCookie,
  };
});
