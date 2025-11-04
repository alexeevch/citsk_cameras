import { z } from "zod";

export const AuthLoginSchema = z.object({
  email: z.email({ message: "Введите верный email" }),
  password: z.string().trim().min(1, { message: "Введите пароль" }),
  rememberMe: z.boolean().default(false),
});
