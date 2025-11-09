import { definePreset } from "@primeuix/themes";
import Aura from "@primevue/themes/aura";

const CITPreset = definePreset(Aura, {
  primitive: {
    borderRadius: {
      none: "0",
      xs: "2px",
      sm: "4px",
      md: "24px",
      lg: "24px",
      xl: "48px",
    },
  },
  semantic: {
    primary: {
      50: "{blue.50}",
      100: "{blue.100}",
      200: "{blue.200}",
      300: "{blue.300}",
      400: "{blue.400}",
      500: "{blue.500}",
      600: "{blue.600}",
      700: "{blue.700}",
      800: "{blue.800}",
      900: "{blue.900}",
      950: "{blue.950}",
    },

    colorScheme: {
      light: {
        primary: {
          color: "{blue.700}",
          inverseColor: "{blue.950}",
          hoverColor: "{blue.800}",
          activeColor: "{blue.900}",
        },
      },
      dark: {},
    },
  },
});

export default CITPreset;
