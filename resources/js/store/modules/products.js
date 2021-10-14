import axios from "axios";

const state = {
    cart: [],
    wishlist: [],
    AllProducts: [],
    MyProducts: [],
    products: [],
    BestartistProducts: [],
    categories: [],
    other_categories: [],
    extractedCategories: [],
    tags: [],
    reviews: [],
    allReviews: [],
    allEarnings: [],
    myEarnings: [],
    tagOptions: [],
    colorOptions: [],
    posts: [],
    adverts: [],
    slides: [],
    pages: [],
    singlePost: [],
    searched_posts: [],
    shop_searched_data: [],
    dashboard_searched_data: [],
    giveAway: null,
    giveAways: []
};
const getters = {
    reviews: state => state.reviews
};
const actions = {
    addToCart({ commit }, id) {
        commit("addToCart", id);
    },
    addToWishlist({ commit }, id) {
        commit("addToWishlist", id);
    },
    getCart({ commit }) {
        return new Promise((resolve, reject) => {
            commit("getCart", JSON.parse(localStorage.getItem("Cart")));
            resolve("getCart");
        });
    },
    getWishlist({ commit }) {
        return new Promise((resolve, reject) => {
            commit("getWishlist", JSON.parse(localStorage.getItem("Wishlist")));
            resolve("getWishlist");
        });
    },
    quantity_decrement({ commit }, id) {
        commit("decrementQty", id);
    },
    quantity_increment({ commit }, id) {
        commit("incrementQty", id);
    },
    add_product_category({ commit }, data) {
        return axios
            .post("/api/add-category", data, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                commit("addProductCategory", response.data);
            });
    },
    add_company_category({ commit }, data) {
        return axios
            .post("/api/add-company-category", data, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                console.log(response);
                commit("addCompanyCategory", response.data);
            });
    },
    get_product_categories({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-categories", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response);

                    commit("getProductCategories", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    get_other_categories({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-other-categories", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response);
                    commit("setOtherCategories", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    get_extracted_categories({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-extracted-categories", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response);
                    commit("getExtractedCategories", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    update_product_category({ commit }, data) {
        return axios
            .post(
                "/api/update-category",
                {
                    id: data.id,
                    name: data.name,
                    parent_category_id: data.parent_category_id
                },
                {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                }
            )
            .then(response => {
                if (response.data[0].message == "Success") {
                    commit("updateProductCategory", response.data[0]);
                }
            });
    },
    remove_product_category({ commit }, id) {
        return axios
            .get(`/api/remove-category/${id}`, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(({ response }) => {
                commit("removeProductCategory", id);
            });
    },
    add_product_tag({ commit }, data) {
        return axios
            .post("/api/add-tag", data, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                commit("addProductTag", response.data);
            });
    },

    get_product_tags({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-tags", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response);
                    commit("getProductTags", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    get_tags_options({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-tags", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response);
                    commit("getTagOptions", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    get_company_products({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-company-products", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response);
                    commit("getCompanyProducts", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    get_company_categories({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-company-categories", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response);
                    commit("getCompanyCategories", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    get_color_options({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-colors", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response);
                    commit("getColorOptions", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    update_product_tag({ commit }, data) {
        return axios
            .post("/api/update-tag", data, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                if (response.data == "Success") {
                    commit("updateProductTag", data);
                }
            });
    },

    remove_product_tag({ commit }, id) {
        return axios
            .get(`/api/remove-tag/${id}`, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(({ response }) => {
                commit("removeProductTag", id);
            });
    },

    get_products({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-products", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response);
                    commit("getProducts", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    get_shop_products({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-shop-products", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response);
                    commit("getShopProducts", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    get_give_aways({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/give-aways", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response);
                    commit("setGiveAways", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    toggleSentGiveAway({ commit }, id) {
        return new Promise((resolve, reject) => {
            return axios
                .post("/api/give-aways/" + id + "/toggle", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response);
                    return commit("changeGiveAwayStatus", response.data);
                })
                .catch(error => reject(error));
        });
    },

    get_my_products({ commit }) {
        let id = localStorage.getItem("userId");
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/get-my-products/${id}`, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response);
                    commit("getMyProducts", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    get_single_product({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/get-product/${data.productId}`, {
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

    get_single_category({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/get-category/${data.categoryId}`, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response.data[0]);
                })
                .catch(error => console.log(error));
        });
    },

    remove_product({ commit }, id) {
        return axios
            .get(`/api/remove-product/${id}`, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(({ response }) => {
                commit("removeProduct", id);
            });
    },
    checkout({ commit }, data) {
        return axios
            .post("api/checkout", data, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                if (response.data === "Success") {
                    commit("emptyCart", response.data);
                }
            });
    },

    add_review({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .post("/api/add-review", data)
                .then(response => {
                    resolve(response.data);
                    commit("addReview", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    get_reviews({ commit }, id) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/get-reviews/${id}`)
                .then(response => {
                    resolve(response.data);
                    commit("getReview", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    get_all_reviews({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-all-reviews")
                .then(response => {
                    resolve(response.data);
                    commit("getAllReview", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    add_rate({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .post("/api/add-rate", data)
                .then(response => {
                    resolve(response.data);
                    commit("addReview", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    update_product_review({ commit }, data) {
        return axios
            .post("/api/update-review", data, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                if (response.data == "Success") {
                    console.log("Success");
                }
            });
    },
    remove_product_review({ commit }, id) {
        return axios
            .get(`/api/remove-review/${id}`, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(({ response }) => {
                console.log(response);
            });
    },
    publish_product_review({ commit }, data) {
        return axios
            .post("/api/publish-review", data, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(({ response }) => {
                console.log(response);
            });
    },

    approve_product({ commit }, id) {
        return axios
            .get(`/api/approve-product/${id}`, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(({ response }) => {
                console.log(response);
            });
    },

    reject_product({ commit }, id) {
        return axios
            .get(`/api/reject-product/${id}`, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(({ response }) => {
                console.log(response);
            });
    },

    get_all_earnings({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-all-earnings", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response.data);
                    commit("getAllEarnings", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    get_my_earnings({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-my-earnings", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response.data);
                    commit("getMyEarnings", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    add_post({ commit }, data) {
        return axios
            .post("/api/add-post", data, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                commit("addPost", response.data);
            });
    },
    get_posts({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-posts")
                .then(response => {
                    resolve(response.data);
                    commit("getPosts", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    get_single_post({ commit }, id) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/get-single-post/${id}`)
                .then(response => {
                    resolve(response.data);
                    commit("getSinglePost", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    publish_post({ commit }, id) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/publish-post/${id}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    remove_post({ commit }, id) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/remove-post/${id}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    search_post({ commit }, search_for) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/search-post/${search_for}`)
                .then(response => {
                    resolve(response.data);
                    commit("SearchPost", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    getUserLocation({ commit }) {
        return axios.get("https://ipinfo.io", data, config).then(response => {
            console.log(response.city, response.country);
        });
    },

    add_advert({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .post("/api/add-advert", data, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response.data);
                    commit("addAdvert", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    get_adverts({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-adverts")
                .then(response => {
                    resolve(response.data);
                    commit("getAdverts", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    add_slide({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .post("/api/add-slide", data, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response.data);
                    commit("addSlide", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    get_slides({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-slides")
                .then(response => {
                    resolve(response.data);
                    commit("getSlides", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    get_single_slide({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/get-slide/${data.slideId}`, {
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
    update_slide({ commit }, data) {
        return axios
            .post("/api/update-slide", data, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                if (response.data == "Success") {
                    console.log("Success");
                }
            });
    },
    remove_slide({ commit }, id) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/remove-slide/${id}`, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    save_views({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/add-views/${data.product_id}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    add_page({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .post("/api/add-page", data, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response.data);
                    commit("addPage", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    get_pages({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/get-pages")
                .then(response => {
                    resolve(response.data);
                    commit("getPages", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    update_page({ commit }, data) {
        return axios
            .post("/api/update-page", data, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("userToken")
                }
            })
            .then(response => {
                if (response.data == "Success") {
                    console.log("Success");
                }
            });
    },
    remove_page({ commit }, id) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/remove-page/${id}`, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("userToken")
                    }
                })
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    get_single_page({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/get-page/${data.pageId}`, {
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

    ContactUsMail({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .post("/api/send-mail", data)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    shop_search({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/shop-search/${data.searchValue}`)
                .then(response => {
                    resolve(response.data);
                    commit("shopSearchedData", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    dashboard_search({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/api/dashboard-search/${data.type}/${data.searchValue}`)
                .then(response => {
                    resolve(response.data);
                    commit("dashboardSearchedData", response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    get_give_away({ commit }) {
        return new Promise((resolve, reject) =>
            axios
                .get(`api/give-away`)
                .then(res => {
                    commit("setGiveAway", res.data);
                    resolve(res.data);
                })
                .catch(err => reject(err))
        );
    },
    storeGiveAwayRequest(_, data) {
        return new Promise((resolve, reject) =>
            axios
                .post(`api/give-away`, data)
                .then(res => {
                    resolve(res.data);
                })
                .catch(err => reject(err))
        );
    }
};
const mutations = {
    setGiveAway(state, data) {
        state.giveAway = data;
    },
    setGiveAways(state, data) {
        state.giveAways = data;
        console.log(state.giveAways);
    },
    changeGiveAwayStatus(state, data) {
        console.log(data.id, state.giveAways);
        state.giveAways = state.giveAways.map(item =>
            item.id == data.id ? { ...item, ...data } : item
        );
        console.log(state.giveAways);
    },
    addToCart(state, id) {
        if (state.cart && state.cart.findIndex(r => r.id === id) === -1) {
            let data = state.products.filter(r => r.id === id);
            state.cart.push({
                id: data[0].id,
                price: data[0].price,
                discount: data[0].discount,
                discounted_price: data[0].discounted_price,
                quantity: 1,
                name: data[0].name,
                thumbnail: data[0].thumbnail,
                artist: data[0].artist_name,
                category_id: data[0].categoryId,
                category_name: data[0].category_name,
                book_pdf: data[0].book_pdf
            });
            localStorage.setItem("Cart", JSON.stringify(state.cart));
        } else if (
            state.cart &&
            state.cart.findIndex(r => r.id === id) !== -1
        ) {
            state.cart.splice(
                state.cart.findIndex(r => r.id === id),
                1
            );
            localStorage.setItem("Cart", JSON.stringify(state.cart));
        } else {
            let data = state.products.filter(r => r.id === id);
            state.cart = [
                {
                    id: data[0].id,
                    price: data[0].price,
                    discount: data[0].discount,
                    discounted_price: data[0].discounted_price,
                    quantity: 1,
                    name: data[0].name,
                    image: data[0].thumbnail,
                    page: data[0].page,
                    artist: data[0].artist_name,
                    category_id: data[0].categoryId,
                    category_name: data[0].category_name
                }
            ];
            localStorage.setItem("Cart", JSON.stringify(state.cart));
        }
    },

    addToWishlist(state, id) {
        if (
            state.wishlist &&
            state.wishlist.findIndex(r => r.id === id) === -1
        ) {
            let data = state.products.filter(r => r.id === id);
            state.wishlist.push({
                id: data[0].id,
                price: data[0].price,
                discount: data[0].discount,
                discounted_price: data[0].discounted_price,
                quantity: 1,
                name: data[0].name,
                thumbnail: data[0].thumbnail,
                artist: data[0].artist_name,
                category_id: data[0].category_id,
                category_name: data[0].category_name
            });
            localStorage.setItem("Wishlist", JSON.stringify(state.wishlist));
        } else if (
            state.wishlist &&
            state.wishlist.findIndex(r => r.id === id) !== -1
        ) {
            state.wishlist.splice(
                state.wishlist.findIndex(r => r.id === id),
                1
            );
            localStorage.setItem("Wishlist", JSON.stringify(state.wishlist));
        } else {
            let data = state.products.filter(r => r.id === id);
            state.wishlist = [
                {
                    id: data[0].id,
                    price: data[0].price,
                    discount: data[0].discount,
                    discounted_price: data[0].discounted_price,
                    quantity: 1,
                    name: data[0].name,
                    image: data[0].thumbnail,
                    page: data[0].page,
                    artist: data[0].artist_name,
                    category_id: data[0].category_id,
                    category_name: data[0].category_name
                }
            ];
            localStorage.setItem("Wishlist", JSON.stringify(state.wishlist));
        }
    },
    getCart(state, data) {
        if (data !== null) {
            state.cart = data;
        } else {
            state.cart = [];
        }
    },
    getWishlist(state, data) {
        if (data !== null) {
            state.wishlist = data;
        } else {
            state.wishlist = [];
        }
    },
    emptyCart(state, data) {
        localStorage.removeItem("Cart");
        state.cart = [];
    },
    decrementQty(state, id) {
        const cartIndex = state.cart.findIndex(c => {
            return c.id === id;
        });

        const single = {
            ...state.cart[cartIndex]
        };

        if (single.quantity !== 1) {
            single.quantity -= 1;
        }

        const cart = [...state.cart];

        cart[cartIndex] = single;
        state.cart = cart;
        localStorage.setItem("Cart", JSON.stringify(state.cart));
    },
    incrementQty(state, id) {
        const cartIndex = state.cart.findIndex(c => {
            return c.id === id;
        });

        const single = {
            ...state.cart[cartIndex]
        };

        single.quantity += 1;

        const cart = [...state.cart];

        cart[cartIndex] = single;
        state.cart = cart;
        localStorage.setItem("Cart", JSON.stringify(state.cart));
    },
    getProductCategories(state, data) {
        state.categories = data;
    },
    getExtractedCategories(state, data) {
        state.extractedCategories = data;
    },
    addProductCategory(state, data) {
        state.categories.push(data);
    },
    addCompanyCategory(state, data) {
        state.other_categories.push(data);
    },
    setOtherCategories(state, data) {
        state.other_categories = data;
    },
    updateProductCategory(state, data) {
        let i = state.categories.findIndex(cat => cat.id == data.id);
        state.categories.splice(i, 1, data);
    },
    removeProductCategory(state, id) {
        let i = state.categories.findIndex(cat => cat.id == id);
        state.categories.splice(i, 1);
    },
    getProducts(state, data) {
        state.AllProducts = data;
        state.products = data;
    },
    getMyProducts(state, data) {
        state.MyProducts = data;
        state.products = data;
    },
    getShopProducts(state, data) {
        state.AllProducts = data;
        state.BestartistProducts = data;
    },
    getProductTags(state, data) {
        state.tags = data;
    },
    getCompanyCategories(state, data) {
        state.tags = data;
    },
    getCompanyProducts(state, data) {
        state.tags = data;
    },
    getTagOptions(state, data) {
        for (let i = 0; i < data.length; i++) {
            state.tagOptions.push(data[i].name);
        }
    },
    getColorOptions(state, data) {
        for (let i = 0; i < data.length; i++) {
            state.colorOptions.push(data[i].name);
        }
    },
    addProductTag(state, data) {
        state.tags.push(data);
    },
    updateProductTag(state, data) {
        let i = state.tags.findIndex(t => t.id == data.id);
        state.tags.splice(i, 1, data);
    },
    removeProductTag(state, id) {
        let i = state.tags.findIndex(t => t.id == id);
        state.tags.splice(i, 1);
    },
    removeProduct(state, id) {
        let i = state.products.findIndex(t => t.id == id);
        state.products.splice(i, 1);
    },
    addReview(state, id) {
        state.reviews.push(data);
    },
    getReview(state, data) {
        state.reviews = data;
    },
    getAllReview(state, data) {
        state.allReviews = data;
    },
    getAllEarnings(state, data) {
        state.allEarnings = data;
    },
    getMyEarnings(state, data) {
        state.myEarnings = data;
    },
    addPost(state, data) {
        state.posts = data;
    },
    getPosts(state, data) {
        state.posts = data;
    },
    getSinglePost(state, data) {
        state.singlePost = data;
    },
    SearchPost(state, data) {
        state.posts = data;
    },
    getAdverts(state, data) {
        state.adverts = data;
    },
    getSlides(state, data) {
        state.slides = data;
    },
    addPage(state, data) {
        state.pages = data;
    },
    getPages(state, data) {
        state.pages = data;
    },
    shopSearchedData(state, data) {
        state.shop_searched_data = data;
    },
    dashboardSearchedData(state, data) {
        state.dashboard_searched_data = data;
    }
};
export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
