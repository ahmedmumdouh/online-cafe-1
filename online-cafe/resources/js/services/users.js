import axios from "axios";
import urls from "./apiURLS";

export default {
    async getAllUsers() {
        return await axios.get(urls.getAllUsers);
    },
};
