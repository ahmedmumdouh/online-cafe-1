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
    async getOrders(userId, params, date) {
        if (typeof date === "object" && date != null) {
            console.log(date);
            return await axios.get(
                `${urls.getOrdersURL}?user_id=${userId}&start_date=${date.start_date}&end_date=${date.end_date}&page=${params}`
            );
        }
        if (Number.isInteger(params)) {
            return await axios.get(
                `${urls.getOrdersURL}?user_id=${userId}&page=${params}`
            );
        }
        if (typeof params === "object" && params != null) {
            return await axios.get(
                `${urls.getOrdersURL}?user_id=${userId}&start_date=${params.start_date}&end_date=${params.end_date}`
            );
        }
        if (!params) {
            return await axios.get(`${urls.getOrdersURL}?user_id=${userId}`);
        }
    },
    async getLatestOrder(userId) {
        return await axios.get(`${urls.getLatestOrderURL}?user_id=${userId}`);
    },
    async getOrderProducts(orderId) {
        return await axios.get(`${urls.getOrderProducts}/${orderId}`);
    },
    async getNextOrPrevOrdersWithPagination(userId, URL, params) {
        // this is a date pagination
        if (typeof params === "object" && params != null) {
            return await axios.get(
                `${URL}&user_id=${userId}&start_date=${params.start_date}&end_date=${params.end_date}`
            );
        } else {
            // this is all orders pagination
            return await axios.get(`${URL}&user_id=${userId}`);
        }
    },
};
