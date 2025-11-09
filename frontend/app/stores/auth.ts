import type { LoginCredentials, User } from "~/types/auth";
import { defineStore } from "pinia";
import type { ApiResponse } from "~/types/api";

export const useAuthStore = defineStore("auth", () => {
  const { $apiFetcher } = useNuxtApp();

  const user = ref<User | null>(null);
  const authChecked = ref(false);
  const isLoading = ref(false);
  const errorMessage = ref<string | null>(null);

  const isAuthenticated = computed(() => !!user.value);

  async function login($credentials: LoginCredentials) {
    try {
      isLoading.value = true;
      errorMessage.value = null;

      await updateCSRFCookie();

      const response = await $apiFetcher<ApiResponse<User>>(`/auth/login`, {
        method: "POST",
        body: $credentials,
      });

      if (response.data) {
        user.value = response.data;
      }
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

      const response = await $apiFetcher<ApiResponse<User>>(`/auth/me`);

      if (response.data) {
        user.value = response.data;
      }
    } catch (e) {
      user.value = null;
      console.error(e);
    } finally {
      authChecked.value = true;
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
    } finally {
      isLoading.value = false;
    }
  }

  async function updateCSRFCookie() {
    try {
      isLoading.value = true;
      errorMessage.value = null;

      await $apiFetcher(`/csrf/csrf-cookie`, {
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
    authChecked,
    isAuthenticated,
    isLoading,
    errorMessage,

    login,
    logout,
    getMe,
    updateCSRFCookie,
  };
});
