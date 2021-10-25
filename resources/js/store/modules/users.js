import axios from "axios";

let baseUrl = "";
generateBaseUrl();
function generateBaseUrl() {
    baseUrl = window.location.origin;
}

const state = {
    userId: localStorage.getItem("userId") || "",
    userInfo: JSON.parse(localStorage.getItem("userInfo")) || [],
    userToken: localStorage.getItem("userToken") || "",
    orders: [],
    myOrders: [],
    productOrders: [],
    orderDetails: [],
    users: []
};
const getters = {
    UserInfo: state => {
        return state.userInfo;
    }
};
const actions = {
    // User Login
    UserLogin({ commit }, credentials) {
        return axios
            .post("/api/login", {
                email: credentials.email,
                password: credentials.password
            })
            .then(response => {
                localStorage.setItem(
                    "userInfo",
                    JSON.stringify(response.data.user)
                );
                commit("USER_INFO", response.data.user);
                localStorage.setItem("userToken", response.data.token);
                commit("USER_TOKEN", response.data.token);
                localStorage.setItem("userId", response.data.user.id);
                commit("USER_ID", response.data.user.id);

                axios.defaults.headers.common.Authorization = `Bearer ${response.data.token}`;

                if (response.data.user.role === "artist") {
                    window.location.assign("artist/dashboard");
                } else if (response.data.user.role === "admin") {
                    window.location.assign("admin/dashboard");
                } else if (response.data.user.role === "client") {
                    if (
                        localStorage.getItem("LoginReason") == "CheckoutReason"
                    ) {
                        window.location.assign("/checkout");
                    } else {
                        window.location.assign("buyer/dashboard");
                    }
                } else {
                    console.log("check your inputs!");
                }
            });
    },
    // User Login--END

    // User Logout
    UserLogout({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .post("/api/logout", {
                    userId: localStorage.getItem("userId")
                })
                .then(response => {
                    console.log(response.data);
                    if (response.data == "success") {
                        commit("CLEAR_USER_INFO", {});
                        localStorage.removeItem("userInfo");
                        commit("CLEAR_USER_ID", {});
                        localStorage.removeItem("userId");
                        commit("CLEAR_USER_TOKEN", "");
                        localStorage.removeItem("userToken");
                        localStorage.removeItem("LoginReason");
                        window.location.href = baseUrl + "/";
                        resolve(response);
                    }
                })
                .catch(error => {
                    console.log(error);
                    reject(error);
                });
        });
    },
    // User Logout

    // User Social Authentication
    SocialLogin({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/social-login/${data.provider}/redirect`)
                .then(response => {
                    localStorage.setItem(
                        "userInfo",
                        JSON.stringify(response.data.user)
                    );
                    commit("USER_INFO", response.data.user);
                    localStorage.setItem("userToken", response.data.token);
                    commit("USER_TOKEN", response.data.token);
                    localStorage.setItem("userId", response.data.user.id);
                    commit("USER_ID", response.data.user.id);

                    axios.defaults.headers.common.Authorization = `Bearer ${response.data.token}`;

                    if (response.data.user.role === "artist") {
                        window.location.assign("artist/dashboard");
                    } else if (response.data.user.role === "admin") {
                        window.location.assign("admin/dashboard");
                    } else if (response.data.user.role === "client") {
                        if (
                            localStorage.getItem("LoginReason") ==
                            "CheckoutReason"
                        ) {
                            window.location.assign("/checkout");
                        } else {
                            window.location.assign("buyer/dashboard");
                        }
                    } else {
                        console.log("check your inputs!");
                    }
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    SocialSignup({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/social-auth/${data.provider}/redirect`)
                .then(response => {
                    resolve(response);
                    if (response.data.url) {
                        window.location.href = response.data.url;
                    }
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    // User Social Authentication--END

    GoogleAuth({ commit }, data) {
        return new Promise((resolve, reject) => {
            let payload = {
                code: data.code,
                role: data.role,
                provider: data.provider
            };
            axios
                .get(`/api/social-auth/callback`, {
                    params: payload
                })
                .then(response => {
                    resolve(response);
                    console.log(response);

                    // localStorage.setItem(
                    //     "userInfo",
                    //     JSON.stringify(response.data.user)
                    // );
                    // commit("USER_INFO", response.data.user);
                    // localStorage.setItem("userToken", response.data.token);
                    // commit("USER_TOKEN", response.data.token);
                    // localStorage.setItem("userId", response.data.user.id);
                    // commit("USER_ID", response.data.user.id);

                    // axios.defaults.headers.common.Authorization = `Bearer ${response.data.token}`;

                    // if (response.data.user.role === "artist") {
                    //     window.location.assign("artist/dashboard");
                    // } else if (response.data.user.role === "admin") {
                    //     window.location.assign("admin/dashboard");
                    // } else if (response.data.user.role === "client") {
                    //     if (
                    //         localStorage.getItem("LoginReason") == "CheckoutReason"
                    //     ) {
                    //         window.location.assign("/checkout");
                    //     } else {
                    //         window.location.assign("buyer/dashboard");
                    //     }
                    // } else {
                    //     console.log("check your inputs!");
                    // }
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    // User Registration
    UserRegistration({ commit }, data) {
        return axios
            .post("/api/register", {
                names: data.names,
                email: data.email,
                phone: data.phone,
                address: data.address,
                country: data.country,
                city: data.city,
                zipCode: data.zipCode,
                role: data.role,
                password: data.password
            })
            .then(response => {
                console.log(response.data);
            });
    },
    // User Registration--END

    // Update user information
    updateUser({ commit }, data) {
        return axios
            .post("/api/update-user", data, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                localStorage.removeItem("userInfo");
                localStorage.setItem("userInfo", JSON.stringify(response.data));
                commit("UPDATE_USER", response.data);
            });
    },
    // Update user information--END

    // Change user password
    changePassword({}, data) {
        return axios
            .post("/api/change-password", data, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => console.log(response));
    },
    // Change user password--END

    // Get user orders
    getUserOrders({ commit }) {
        return axios
            .get("/api/get-orders", {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                commit("getOrders", response.data);
            })
            .catch(error => console.log(error));
    },
    // Get user orders--END

    // Get my orders
    getMyOrders({ commit }) {
        return axios
            .get("/api/get-my-orders", {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                commit("getMyOrders", response.data);
            })
            .catch(error => console.log(error));
    },
    // Get my orders--END

    getUserProductOrders({ commit }) {
        return axios
            .get("/api/get-product-orders", {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                commit("getProductOrders", response.data);
            })
            .catch(error => console.log(error));
    },
    artistConfirmation({ commit }, data) {
        return axios
            .post("/api/artist-confirmation", data, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                commit("getProductOrders", response.data);
                alert("Product Confirmed!!");
            })
            .catch(error => alert(error.response.data.message));
    },
    orderCompletion({ commit }, data) {
        return axios
            .post("/api/complete-order", data, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                commit("updateOrder", response.data);
                alert("Order marked as Completed!!");
            })
            .catch(error => alert(error.response.data.message));
    },
    getOrderDetails({ commit }) {
        return axios
            .get("/api/get-order-details", {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                commit("getOrderDetails", response.data);
            })
            .catch(error => console.log(error));
    },

    getUsers({ commit }) {
        return axios
            .get("/api/get-users", {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                commit("getUsers", response.data);
            })
            .catch(error => console.log(error));
    },
    get_single_user({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/get-user/${data.userId}`, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => console.log(error));
        });
    },

    // Removing a user
    remove_user({ commit }, id) {
        return axios
            .get(`/api/remove-user/${id}`, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(({ response }) => {
                commit("removeUser", response);
            });
    },

    // Adding a artist
    AddArtist({ commit }, data) {
        return axios
            .post(
                "/api/add-artist",
                {
                    names: data.names,
                    email: data.email,
                    phone: data.phone,
                    address: data.address,
                    country: data.country,
                    city: data.city,
                    zipCode: data.zipCode,
                    role: data.role,
                    password: data.password
                },
                {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                }
            )
            .then(response => {
                console.log(response.data);
            });
    },

    ResetPasswordRequest({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .post("/api/reset-password-request", data)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    ResetPassword({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .post("/api/reset-password", data)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    }
};
const mutations = {
    USER_INFO: (state, data) => (state.userInfo = data),
    CLEAR_USER_INFO: (state, data) => (state.userInfo = data),
    USER_ID: (state, data) => (state.userId = data),
    CLEAR_USER_ID: (state, data) => (state.userId = data),
    USER_TOKEN: (state, data) => (state.userToken = data),
    CLEAR_USER_TOKEN: (state, data) => (state.userToken = data),
    UPDATE_USER: (state, data) => (state.userInfo = data),
    getOrders: (state, data) => (state.orders = data),
    getMyOrders: (state, data) => (state.myOrders = data),
    updateOrder: (state, data) => {
        let i = state.myOrders.findIndex(t => t.id == data.id);
        state.myOrders.splice(i, 1, data);
    },
    getProductOrders: (state, data) => (state.productOrders = data),
    getOrderDetails: (state, data) => (state.orderDetails = data),
    getUsers: (state, data) => (state.users = data),
    removeUser(state, id) {
        let i = state.users.findIndex(t => t.id == id);
        state.users.splice(i, 1);
    }
};
export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
