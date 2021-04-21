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
        return await axios.get(`${urls.getProducts}`);
    },
    async getRooms() {
        return await axios.get(`${urls.getRooms}`);
    },
    async getOrders(userId) {
        return await axios.get(`${urls.getOrdersURL}?user_id=${userId}`);
    },
    async getLatestOrder(userId) {
        return await axios.get(`${urls.getLatestOrderURL}?user_id=${userId}`);
    },
};
