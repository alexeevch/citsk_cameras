<script setup lang="ts">
import { useAuthStore } from "~/stores/auth";
import type { LoginCredentials } from "~/types/auth";
import { zodResolver } from "@primevue/forms/resolvers/zod";
import { AuthLoginSchema } from "~/utils/zod";
import type { FormSubmitEvent } from "@primevue/forms";

definePageMeta({
  requiresAuth: false,
  layout: false,
});

useSeoMeta({
  title: `Вход - ${useRuntimeConfig().public.appName}`,
});

const authStore = useAuthStore();
const { isLoading } = storeToRefs(authStore);

const initialValues: LoginCredentials = {
  email: "",
  password: "",
  rememberMe: false,
};

const resolver = ref(zodResolver(AuthLoginSchema));

const onFormSubmit = async (event: FormSubmitEvent) => {
  if (!event.valid) {
    return;
  }

  try {
    await authStore.login(event.values as LoginCredentials);
    await navigateTo("/");
  } catch (e) {
    console.error(e);
  }
};
</script>

<template>
  <div class="login-page">
    <div>
      <Form
        v-slot="$form"
        :initial-values
        :resolver
        :validate-on-value-update="false"
        :validate-on-blur="true"
        @submit="onFormSubmit"
      >
        <div class="login-form__fields">
          <FormField v-slot="$field" name="email">
            <label for="email">Email</label>
            <InputText id="email" />
            <Message
              v-if="$field?.invalid"
              severity="error"
              size="small"
              variant="simple"
            >
              {{ $field.error.message }}
            </Message>
          </FormField>

          <FormField v-slot="$field" name="password">
            <label for="password">Пароль</label>
            <Password id="password" :feedback="false" />
            <Message
              v-if="$field?.invalid"
              severity="error"
              size="small"
              variant="simple"
            >
              {{ $field.error.message }}
            </Message>
          </FormField>

          <FormField v-slot="$field" name="rememberMe">
            <Checkbox binary input-id="rememberMe" :invalid="$field?.invalid" />
            <label for="rememberMe">Запомнить меня</label>
            <Message
              v-if="$field?.invalid"
              severity="error"
              size="small"
              variant="simple"
            >
              {{ $field.error.message }}
            </Message>
          </FormField>
        </div>
        <Button
          :loading="isLoading"
          type="submit"
          severity="primary"
          label="Submit"
        />
      </Form>
    </div>
  </div>
</template>

<style scoped>
.login-page {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100%;
  width: 100%;
}
</style>
