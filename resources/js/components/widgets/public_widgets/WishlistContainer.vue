<template>
    <section id="pageContent">
        <div class="container">
            <div
                id="shopify-section-vela-template-cart"
                class="shopify-section"
            >
                <div
                    class="cartContainer"
                    v-if="
                        !wishlist || wishlist === null || wishlist.length === 0
                    "
                >
                    <h1 class="cartTitle hidden">Shopping wishlist</h1>
                    <div class="cartContent">
                        <div class="cartEmptyContent">
                            <p class="cartEmpty">
                                Your wishlist is currently empty.
                            </p>

                            <p>
                                <router-link
                                    class="btn btnVelaOne"
                                    to="/shop"
                                    title="Go to Shopping"
                                    >Go to Shopping</router-link
                                >
                            </p>
                        </div>
                    </div>
                </div>
                <div class="cartContainer" v-else>
                    <h1 class="cartTitle">Shopping wishlist</h1>
                    <div class="cartContent">
                        <form
                            action="/wishlist"
                            method="post"
                            novalidate=""
                            class="cartForm"
                        >
                            <div class="cartTable">
                                <div class="row noGutter cartHeaderLabels">
                                    <div class="col-xs-3 col-sm-2">Image</div>
                                    <div class="col-xs-9 col-sm-8">Product</div>
                                    <div
                                        class="col-xs-12 col-sm-2 hidden-xs text-right"
                                    >
                                        Total
                                    </div>
                                </div>
                                <div
                                    class="cartItemWrap"
                                    v-for="ct in wishlist"
                                    :key="ct.id"
                                >
                                    <div class="flexRow noGutter">
                                        <div
                                            class="productImage col-xs-3 col-sm-2"
                                            data-label="Product"
                                        >
                                            <a href="#" class="cartImage">
                                                <img
                                                    class="img-responsive"
                                                    :src="
                                                        `${baseUrl}/uploads/images/${ct.thumbnail}`
                                                    "
                                                    data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]"
                                                    data-aspectratio="0.8048289738430584"
                                                    data-ratio="0.8048289738430584"
                                                    data-sizes="auto"
                                                    :alt="ct.name"
                                                />
                                            </a>
                                        </div>
                                        <div
                                            class="productInfo col-xs-9 col-sm-8"
                                        >
                                            <a
                                                :href="ct.page"
                                                class="productName"
                                            >
                                                {{ ct.name }}
                                            </a>

                                            <p>{{ ct.artist }}</p>

                                            <div data-label="Price">
                                                <span class="priceProduct">
                                                    <span
                                                        v-if="
                                                            ct.discounted_price >
                                                                0
                                                        "
                                                        class="money"
                                                        data-currency-usd="RWF 59,00"
                                                        data-currency-gbp="&amp;pound;46.25"
                                                        data-currency="GBP"
                                                        >RWF
                                                        {{
                                                            ct.discounted_price
                                                        }}</span
                                                    >
                                                    <span
                                                        v-else
                                                        class="money"
                                                        data-currency-usd="RWF 59,00"
                                                        data-currency-gbp="&amp;pound;46.25"
                                                        data-currency="GBP"
                                                        >RWF
                                                        {{ ct.price }}</span
                                                    >
                                                </span>
                                            </div>
                                        </div>
                                        <div
                                            class="text-right col-xs-12 col-sm-2 hidden-xs"
                                            data-label="Total"
                                        >
                                            <span
                                                class="h3 cartSubtotal priceProduct"
                                            >
                                                <span
                                                    v-if="
                                                        ct.discounted_price > 0
                                                    "
                                                    class="money"
                                                    data-currency-usd="RWF 59,00"
                                                    data-currency-gbp="&amp;pound;46.25"
                                                    data-currency="GBP"
                                                    >RWF
                                                    {{
                                                        parseFloat(
                                                            ct.discounted_price
                                                        ) *
                                                            parseFloat(
                                                                ct.quantity
                                                            )
                                                    }}</span
                                                >
                                                <span
                                                    v-else
                                                    class="money"
                                                    data-currency-usd="RWF 59,00"
                                                    data-currency-gbp="&amp;pound;46.25"
                                                    data-currency="GBP"
                                                    >RWF
                                                    {{
                                                        parseFloat(ct.price) *
                                                            parseFloat(
                                                                ct.quantity
                                                            )
                                                    }}</span
                                                >
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
    name: "WishlistContainer",
    data() {
        return {
            baseUrl: ""
        };
    },
    mounted() {
        this.generateBaseUrl();
        this.loadWishlist();
    },
    computed: {
        ...mapState("products", ["wishlist"])
    },
    methods: {
        ...mapActions("products", ["getWishlist"]),
        loadWishlist() {
            this.getWishlist();
        },
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
        }
    }
};
</script>
