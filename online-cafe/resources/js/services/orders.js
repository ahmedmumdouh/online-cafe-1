import axios from "axios";
import urls from "./apiURLS";
export default {
    async submitOrder(order) {
        return await axios.post(`${urls.postOrderURL}`, {
            body: {
                order,
            },
            header: {
                Accept: "application/json",
            },
        });
    },
    async getProducts() {
        return (products = await axios.get(`${urls.getProducts}`));
    },
    async getRooms() {
        return (products = await axios.get(`${urls.getRooms}`));
    },
};
