export interface User {
  id: number;
  firstName: string;
  lastName: string;
  middleName?: string;
  fullName: string;
  email: string;
  phone?: string;
  role: Role[];
  permissions: string[];
  createdAt?: string;
  updatedAt?: string;
}

export type Role = "admin" | "user" | "root";

export type LoginCredentials = {
  email: string;
  password: string;
  rememberMe?: boolean;
};
