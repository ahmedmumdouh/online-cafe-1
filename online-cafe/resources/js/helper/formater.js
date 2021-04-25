export default {
    formatPrice(price) {
        const formater = Intl.NumberFormat("eg-SA", {
            style: "currency",
            currency: "EGP",
        });
        return formater.format(price);
    },
    formatDate(date) {
        const newDate = new Date(date);
        return newDate.toLocaleString();
    },
    getTodayDate() {
        return new Date().getTime();
    },
};
