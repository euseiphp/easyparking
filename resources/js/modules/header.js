export default () => ({
    show: false,

    open() {
        this.show = !this.show;
    },

    close() {
        this.show = false;
    }
});
