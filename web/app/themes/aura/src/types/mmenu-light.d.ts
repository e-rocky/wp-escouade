declare module 'mmenu-light' {
  interface mmNavigationOptions {
    selectedClass?: string;
    slidingSubmenus?: boolean;
    theme?: 'light' | 'dark';
    title?: string;
  }

  interface mmOffcanvasOptions {
    position?: 'left' | 'right';
  }

  interface MmenuLightDrawer {
    open(): void;
    close(): void;
  }

  class MmenuLight {
    constructor(menu: HTMLElement, mediaQuery?: string);
    navigation(options?: mmNavigationOptions): void;
    offcanvas(options?: mmOffcanvasOptions): MmenuLightDrawer;
  }

  export default MmenuLight;
}
