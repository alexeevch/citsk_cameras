export default defineNuxtPlugin((nuxtApp) => {
  const CSRF_ERROR_CODE = 419;
  const UNAUTHORIZED_ERROR_CODE = 401;

  const baseURL = useRuntimeConfig().public.apiUrl;

  const apiFetcher = $fetch.create({
    baseURL,
    redirect: "manual",
    credentials: "include",
    onRequest(request) {
      request.options.headers.set("Accept", "application/json");
      const xsrfToken = useCookie("XSRF-TOKEN");

      if (xsrfToken) {
        request.options.headers.set("X-XSRF-TOKEN", xsrfToken.value!);
      }
    },
    async onResponseError({ response }) {
      if (
        response.status === CSRF_ERROR_CODE ||
        response.status === UNAUTHORIZED_ERROR_CODE
      ) {
        await nuxtApp.runWithContext(() => navigateTo("/auth/login"));
      }
    },
  });

  return {
    provide: {
      apiFetcher,
    },
  };
});
