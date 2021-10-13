<template>
    <main class="mainContent" role="main">
        <section id="pageContent" class="pageSearchContent">
            <div class="container">
                <div
                    v-if="searchResults.length == 0"
                    class="velaSearchContainer mb20 pb-md-30"
                >
                    <h1 class="velaSearchTitle">
                        Your search for "{{ searchValue }}" did not yield any
                        results.
                    </h1>
                    <form
                        @submit.prevent="ShopSearch()"
                        class="formSearchPage"
                        method="get"
                    >
                        <div class="input-group">
                            <input type="hidden" name="type" value="product" />
                            <input
                                type="search"
                                name="q"
                                v-model="searchValue"
                                placeholder="Enter keywords to search..."
                                class="formSearchPageInput form-control"
                                autocomplete="off"
                            />
                            <div class="input-group-addon">
                                <button
                                    type="submit"
                                    class="btn formSearchPageButton"
                                >
                                    <i class="icons icon-magnifier"></i>
                                    <span class="searchPageButtonText"
                                        >Search</span
                                    >
                                </button>
                            </div>
                        </div>
                        <ul class="velaAjaxSearch" style="display: none;"></ul>
                    </form>
                </div>

                <div v-else class="velaSearchContainer mb20 pb-md-30">
                    <h1 class="velaSearchTitle">
                        Your search for "{{ searchValue }}" revealed the
                        following:
                    </h1>
                    <form
                        @submit.prevent="ShopSearch()"
                        class="formSearchPage"
                        method="get"
                    >
                        <div class="input-group">
                            <input type="hidden" name="type" value="product" />
                            <input
                                type="search"
                                name="q"
                                v-model="searchValue"
                                placeholder="Enter keywords to search..."
                                class="formSearchPageInput form-control"
                                autocomplete="off"
                            />
                            <div class="input-group-addon">
                                <button
                                    type="submit"
                                    class="btn formSearchPageButton"
                                >
                                    <i class="icons icon-magnifier"></i>
                                    <span class="searchPageButtonText"
                                        >Search</span
                                    >
                                </button>
                            </div>
                        </div>
                        <ul class="velaAjaxSearch" style="display: none;"></ul>
                    </form>
                    <div class="proList grid">
                        <div class="velaFlexRow flexRow">
                            <div
                                v-for="item in searchResults"
                                :key="item.id"
                                class="velaProBlock grid col-xs-12 col-sm-6 col-md-3"
                                data-price="39.00"
                            >
                                <div class="velaProBlockInner">
                                    <div
                                        class="proHImage d-flex flexJustifyCenter"
                                    >
                                        <a
                                            class="proFeaturedImage"
                                            href="/products/arctander-chair?_pos=1&amp;_sid=088db46fd&amp;_ss=r"
                                        >
                                            <div class="wrap proSwatch">
                                                <div class="p-relative">
                                                    <div
                                                        class="product-card__image"
                                                        style="padding-top:124.25%;"
                                                    >
                                                        <img
                                                            class="product-card__img lazyautosizes lazyloaded"
                                                            :scr="
                                                                `${baseUrl}/storage/${item.forwardImage}`
                                                            "
                                                            data-widths="[1,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808]"
                                                            data-aspectratio="0.8048289738430584"
                                                            data-ratio="0.8048289738430584"
                                                            data-sizes="auto"
                                                            alt=""
                                                            data-srcset="//cdn.shopify.com/s/files/1/0376/9440/6700/products/21_1_1x.jpg?v=1586317078 1w, //cdn.shopify.com/s/files/1/0376/9440/6700/products/21_1_360x.jpg?v=1586317078 360w, //cdn.shopify.com/s/files/1/0376/9440/6700/products/21_1_540x.jpg?v=1586317078 540w, //cdn.shopify.com/s/files/1/0376/9440/6700/products/21_1_720x.jpg?v=1586317078 720w, //cdn.shopify.com/s/files/1/0376/9440/6700/products/21_1_900x.jpg?v=1586317078 900w, //cdn.shopify.com/s/files/1/0376/9440/6700/products/21_1_1080x.jpg?v=1586317078 1080w, //cdn.shopify.com/s/files/1/0376/9440/6700/products/21_1_1296x.jpg?v=1586317078 1296w, //cdn.shopify.com/s/files/1/0376/9440/6700/products/21_1_1512x.jpg?v=1586317078 1512w, //cdn.shopify.com/s/files/1/0376/9440/6700/products/21_1_1728x.jpg?v=1586317078 1728w, //cdn.shopify.com/s/files/1/0376/9440/6700/products/21_1_1944x.jpg?v=1586317078 1944w, //cdn.shopify.com/s/files/1/0376/9440/6700/products/21_1_2160x.jpg?v=1586317078 2160w, //cdn.shopify.com/s/files/1/0376/9440/6700/products/21_1_2376x.jpg?v=1586317078 2376w, //cdn.shopify.com/s/files/1/0376/9440/6700/products/21_1_2592x.jpg?v=1586317078 2592w, //cdn.shopify.com/s/files/1/0376/9440/6700/products/21_1_2808x.jpg?v=1586317078 2808w"
                                                            sizes="267px"
                                                        />
                                                    </div>
                                                    <div
                                                        class="placeholder-background placeholder-background--animation"
                                                        data-image-placeholder=""
                                                    ></div>
                                                </div></div
                                        ></a>
                                        <div class="productLable"></div>
                                        <div class="proButton clearfix">
                                            <button
                                                class="btn btnProduct btnAddToCart"
                                                :class="{
                                                    added: isAdded(item.id)
                                                }"
                                                type="button"
                                                value="Submit"
                                                title="Add to Cart"
                                                @click.prevent="
                                                    addToCart(
                                                        item.id,
                                                        item.name
                                                    )
                                                "
                                            >
                                                <span
                                                    class="icons icon-handbag"
                                                ></span>
                                                <span class="text"
                                                    >Add to Cart</span
                                                >
                                            </button>
                                            <div class="productQuickView">
                                                <a
                                                    class="btn btnProduct btnProductQuickview"
                                                    href="#"
                                                    :class="{
                                                        added: _isAdded(item.id)
                                                    }"
                                                    @click.prevent="
                                                        addToWishlist(
                                                            item.id,
                                                            item.name
                                                        )
                                                    "
                                                    data-handle="beoplay-a1"
                                                    title="Add to wishlist"
                                                >
                                                    <span
                                                        class="icons icon-heart"
                                                    ></span>
                                                    <span class="text"
                                                        >Add to wishlist</span
                                                    >
                                                </a>
                                            </div>
                                            <div class="productQuickView">
                                                <a
                                                    class="btn btnProduct btnProductQuickview"
                                                    href="#velaQuickView"
                                                    data-handle="beoplay-a1"
                                                    title="Quick view"
                                                >
                                                    <span
                                                        class="icons icon-magnifier"
                                                    ></span>
                                                    <span class="text"
                                                        >Quick view</span
                                                    >
                                                </a>
                                            </div>
                                            <div
                                                v-if="
                                                    item.category_name ==
                                                        'Free Goods' ||
                                                        item.price == 0
                                                "
                                                class="productQuickView"
                                            >
                                                <a
                                                    class="btn btnProduct btnProductQuickview"
                                                    :href="
                                                        `${baseUrl}/storage/${item.book_pdf}`
                                                    "
                                                    :download="item.name"
                                                    title="Download Now"
                                                >
                                                    <span
                                                        class="icons icon-cloud-download"
                                                    ></span>
                                                    <span class="text"
                                                        >Download Now</span
                                                    >
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="proContent">
                                        <h5 class="proName">
                                            <router-link
                                                :to="{
                                                    name: 'Product',
                                                    params: { id: item.id }
                                                }"
                                                >{{ item.name }}</router-link
                                            >
                                        </h5>
                                        <div class="groupPrice clearfix">
                                            <div class="proPrice">
                                                <div class="priceProduct ">
                                                    <span class="money"
                                                        >RWF
                                                        {{ item.price }}</span
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
import { mapState } from "vuex";
export default {
    name: "SearchResultsContainer",
    data: function() {
        return {
            added: false,
            wishlist_added: false,
            remove: false,
            wishlist_remove: false,
            baseUrl: "",
            searchValue: this.$route.params.searchValue,

            searchResults: {}
        };
    },
    created() {
        this.ShopSearch();
    },
    computed: {
        ...mapState("products", ["cart", "wishlist", "BestartistProducts"])
    },
    methods: {
        ShopSearch() {
            let data = {
                searchValue: this.searchValue
            };
            this.$store
                .dispatch("products/shop_search", data)
                .then(response => {
                    this.searchResults = response;
                    console.log("Search Results = ", response);
                });
        },
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
        },
        // _ShopSearch() {
        //     console.log("URL = " + this.baseUrl);
        //     return;
        //     window.location.href = `${this.baseUrl}/search-results/${this._searchValue}`;
        // },
        addToCart(id, name) {
            this.added = name;
            if (
                this.cart !== null &&
                this.cart.findIndex(r => r.id === id) !== -1
            ) {
                this.remove = true;
            } else {
                this.remove = false;
            }
            this.$store.dispatch("products/addToCart", id);
            setTimeout(() => (this.added = false), 1000);
        },

        addToWishlist(id, name) {
            this.wishlist_added = name;
            if (
                this.wishlist !== null &&
                this.wishlist.findIndex(r => r.id === id) !== -1
            ) {
                this.wishlist_remove = true;
            } else {
                this.wishlist_remove = false;
            }
            this.$store.dispatch("products/addToWishlist", id);
            setTimeout(() => (this.wishlist_added = false), 1000);
        },
        isAdded(id) {
            if (this.cart && this.cart.findIndex(r => r.id === id) !== -1) {
                return true;
            } else {
                return false;
            }
        },
        _isAdded(id) {
            if (
                this.wishlist &&
                this.wishlist.findIndex(r => r.id === id) !== -1
            ) {
                return true;
            } else {
                return false;
            }
        }
    },
    watch: {
        cart() {
            console.log("cart=>>>", this.cart);
        },
        wishlist() {
            console.log("wishlist=>>>", this.wishlist);
        }
    }
};
</script>
<style scoped>
.formSearchPageButton {
    color: #1a1a1a !important;
    background-color: transparent !important;
    font-size: 18px !important;
    -webkit-transition: all 0.35s ease !important;
    -o-transition: all 0.35s ease !important;
    transition: all 0.35s ease !important;
    height: 30px !important;
    width: 50px !important;
    border: 0 !important;
    position: absolute !important;
    right: 0 !important;
    top: 10px !important;
    line-height: 32px !important;
    border-left: 1px solid #a1a1a1 !important;
    z-index: 3 !important;
}
.btn {
    display: inline-block !important;
    margin-bottom: 0 !important;
    text-align: center !important;
    vertical-align: middle !important;
    touch-action: manipulation !important;
    cursor: pointer !important;
    background-image: none !important;
    border: 1px solid transparent !important;
    white-space: nowrap !important;
    padding: 9px 20px !important;
    font-size: 16px !important;
    line-height: 1.45 !important;
    border-radius: 4px !important;
    -webkit-user-select: none !important;
    -moz-user-select: none !important;
    -ms-user-select: none !important;
    user-select: none !important;
}
button {
    -webkit-writing-mode: horizontal-tb !important;
    text-rendering: auto !important;
    color: -internal-light-dark(black, white) !important;
    letter-spacing: normal !important;
    word-spacing: normal !important;
    text-transform: none !important;
    text-indent: 0px !important;
    text-shadow: none !important;
    text-align: center !important;
    cursor: default !important;
    font: 400 13.3333px Arial !important;
}

element.style {
}
.input-group-addon:last-child {
    border-left: 0;
}
.input-group .form-control:last-child,
.input-group-addon:last-child,
.input-group-btn:last-child > .btn,
.input-group-btn:last-child > .btn-group > .btn,
.input-group-btn:last-child > .dropdown-toggle,
.input-group-btn:first-child > .btn:not(:first-child),
.input-group-btn:first-child > .btn-group:not(:first-child) > .btn {
    border-bottom-left-radius: 0;
    border-top-left-radius: 0;
}
.input-group-addon {
    padding: 9px 20px !important;
    font-size: 16px !important;
    font-weight: normal !important;
    line-height: 1 !important;
    color: #444 !important;
    text-align: center !important;
    background-color: #fff !important;
    border: 1px solid #e1e1e1 !important;
    border-radius: 3px !important;
}
button,
[type="button"],
[type="reset"],
[type="submit"] {
    -webkit-appearance: button !important;
}
button {
    border-radius: 0 !important;
}
.icon-magnifier {
    font-family: "simple-line-icons" !important;
    speak: none !important;
    font-style: normal !important;
    font-weight: normal !important;
    font-variant: normal !important;
    text-transform: none !important;
    line-height: 1 !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
}
.input-group-addon:last-child {
    border-left: 0 !important;
}
.input-group .form-control[data-v-f4bbca24]:last-child,
.input-group-addon[data-v-f4bbca24]:last-child,
.input-group-btn:last-child > .btn[data-v-f4bbca24],
.input-group-btn:last-child > .btn-group > .btn[data-v-f4bbca24],
.input-group-btn:last-child > .dropdown-toggle[data-v-f4bbca24],
.input-group-btn:first-child > .btn[data-v-f4bbca24]:not(:first-child),
.input-group-btn:first-child
    > .btn-group:not(:first-child)
    > .btn[data-v-f4bbca24] {
    border-bottom-left-radius: 0 !important;
    border-top-left-radius: 0 !important;
}
.input-group-addon,
.input-group-btn {
    width: 1% !important;
    white-space: nowrap !important;
    vertical-align: middle !important;
}
.input-group-addon,
.input-group-btn,
.input-group .form-control {
    display: table-cell !important;
}
.input-group {
    position: relative !important;
    display: table !important;
    border-collapse: separate !important;
}
</style>
