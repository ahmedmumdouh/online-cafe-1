import axios from "axios";
import urls from "./apiURLS";
axios.defaults.withCredentials = true;
axios.defaults.baseURL = "http://localhost:8000";
export default {
    async submitOrder(order) {
        return await axios.post(`${urls.postOrderURL}`, {
            body: {
                order,
            },
        });
    },
    async getProducts() {
        return await axios.get(`${urls.getOrdersURL}`);
    },
};
