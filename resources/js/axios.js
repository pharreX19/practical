import axios from "axios";
import Cookies from "js-cookie";

const instance = axios.create({
    baseURL: import.meta.env.VITE_BACKEND_URL,
    headers: {
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "application/json",
        Accept: "application/json",
        // Referer: "http://localhost:5173",
    },
    withCredentials: true,
});

instance.interceptors.request.use(
    async (config) => {
        if (config.method.toString().toLowerCase() !== "get") {
            config.headers["X-XSRF-TOKEN"] = Cookies.get("XSRF-TOKEN");
        }
        return config;
    },
    (error) => {
        Promise.reject(error);
    }
);

instance.interceptors.response.use(
    (response) => {
        // if (
        //     response.statusText === "OK" &&
        //     response.data &&
        //     response.data.token
        // ) {
        //     // localStorage.setItem("EXAMPLE_APP", response.data.token);
        // }
        return response;
    },
    (error) => {
        let errors;
        if (error && error.response.data && error.response.data.errors) {
            errors = error.response.data.errors;
        } else {
            errors = error.response.data.message || "";
        }
        throw errors;
    }
);

export default instance;
