export const isMobile = () =>  {

    return window.innerWidth < 993;
};

export const changeNav = () => {
    const desktop = isDesktop();
    this.docked = this.home ? false : desktop;
    if (desktop === this.desktop) {
        return;
    }
    if (!desktop && this.desktop && this.open) {
        this.open = false;
    }
    if (desktop && !this.desktop && !this.open && !this.home) {
        this.open = true;
    }
    this.desktop = desktop;

};
