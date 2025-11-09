import { useStorage } from "@vueuse/core";

interface SidebarSettings {
  isOpen: boolean;
  isCollapsed: boolean;
}

const defaultSettings: SidebarSettings = {
  isOpen: true,
  isCollapsed: false,
};

export function useSidebar() {
  const sidebar = useStorage<SidebarSettings>("ui.sidebar", defaultSettings);

  const toggleOpen = () => (sidebar.value.isOpen = !sidebar.value.isOpen);
  const toggleCollapse = () =>
    (sidebar.value.isCollapsed = !sidebar.value.isCollapsed);
  const open = () => (sidebar.value.isOpen = true);
  const close = () => (sidebar.value.isOpen = false);

  return { sidebar, toggleOpen, toggleCollapse, open, close };
}
