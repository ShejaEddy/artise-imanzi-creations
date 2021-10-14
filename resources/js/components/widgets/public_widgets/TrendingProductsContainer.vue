<template>
    <div
        id="shopify-section-1585935530141"
        class="shopify-section velaFramework"
    >
        <div
            class="productListHome velaProducts mb30"
            style="background-color: rgba(0, 0, 0, 0); padding: 0 0 20px"
        >
            <div class="container">
                <div class="headingGroup pb20">
                    <h3 class="velaHomeTitle text-center">Trending Products</h3>
                    <span class="subTitle">Trending products in this week</span>
                </div>
                <div class="velaContent">
                    <transition name="slide-fade">
                        <div
                            class="alert p-3"
                            :class="{
                                'alert-success': !remove,
                                'alert-danger': remove
                            }"
                            role="alert"
                            v-if="added"
                        >
                            <i class="fa fa-trash" v-if="remove"></i
                            ><i class="fa fa-check" v-else></i> Product
                            <a href="#" class="alert-link"> {{ this.added }} </a
                            >is
                            <span v-if="remove">removed to cart</span>
                            <span v-else>added to cart</span>
                        </div>
                    </transition>
                    <transition name="slide-fade">
                        <div
                            class="alert p-3"
                            :class="{
                                'alert-success': !wishlist_remove,
                                'alert-danger': wishlist_remove
                            }"
                            role="alert"
                            v-if="wishlist_added"
                        >
                            <i class="fa fa-trash" v-if="wishlist_remove"></i
                            ><i class="fa fa-check" v-else></i> Product
                            <a href="#" class="alert-link">
                                {{ this.wishlist_added }} </a
                            >is
                            <span v-if="wishlist_remove"
                                >removed to wishlist</span
                            >
                            <span v-else>added to wishlist</span>
                        </div>
                    </transition>
                    <div class="rowFlex rowFlexMargin">
                        <div
                            class="col-sp-12 col-xs-6 col-sm-6 col-md-4 col-lg-3"
                            v-for="product in BestartistProducts.slice(0, 4)"
                            :key="product.id"
                        >
                            <div class="velaProBlock grid" data-price="39,00">
                                <div class="velaProBlockInner">
                                    <div
                                        class="proHImage d-flex flexJustifyCenter"
                                    >
                                        <router-link
                                            class="proFeaturedImage"
                                            :to="{
                                                name: 'Product',
                                                params: { id: product.id }
                                            }"
                                        >
                                            <div class="wrap">
                                                <div class="p-relative">
                                                    <div
                                                        class="product-card__image"
                                                        style="padding-top: 124.25%"
                                                    >
                                                        <img
                                                            class="product-card__img lazyload"
                                                            :data-src="
                                                                `${baseUrl}/uploads/images/${product.forwardImage}`
                                                            "
                                                            data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]"
                                                            data-aspectratio="0.8048289738430584"
                                                            data-ratio="0.8048289738430584"
                                                            data-sizes="auto"
                                                            :alt="product.name"
                                                        />
                                                    </div>
                                                    <div
                                                        class="placeholder-background placeholder-background--animation"
                                                        data-image-placeholder
                                                    ></div>
                                                </div>
                                            </div>
                                            <div
                                                v-if="product.backwardImage"
                                                class="hidden-sm hidden-xs proSwatch proImageSecond"
                                            >
                                                <div class="p-relative">
                                                    <div
                                                        class="product-card__image"
                                                        style="padding-top: 124.25%"
                                                    >
                                                        <img
                                                            class="product-card__img lazyload"
                                                            :data-src="
                                                                `${baseUrl}/uploads/images/${product.backwardImage}`
                                                            "
                                                            data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]"
                                                            data-aspectratio="0.8048289738430584"
                                                            data-ratio="0.8048289738430584"
                                                            data-sizes="auto"
                                                            :alt="product.name"
                                                        />
                                                    </div>
                                                    <div
                                                        class="placeholder-background placeholder-background--animation"
                                                        data-image-placeholder
                                                    ></div>
                                                </div>
                                            </div>
                                        </router-link>
                                        <div
                                            class="productLable"
                                            v-if="product.sale"
                                        >
                                            <span class="labelSale">Sale</span>
                                        </div>

                                        <div class="proButton clearfix">
                                            <button
                                                class="btn btnProduct btnAddToCart"
                                                :class="{
                                                    added: isAdded(product.id)
                                                }"
                                                type="button"
                                                value="Submit"
                                                title="Add to Cart"
                                                @click.prevent="
                                                    addToCart(
                                                        product.id,
                                                        product.name
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
                                                        added: _isAdded(
                                                            product.id
                                                        )
                                                    }"
                                                    @click.prevent="
                                                        addToWishlist(
                                                            product.id,
                                                            product.name
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
                                                    product.category_name ==
                                                        'Free Goods' ||
                                                        product.price == 0
                                                "
                                                class="productQuickView"
                                            >
                                                <a
                                                    class="btn btnProduct btnProductQuickview"
                                                    :href="
                                                        `${baseUrl}/uploads/images/${product.book_pdf}`
                                                    "
                                                    :download="product.name"
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
                                                    params: { id: product.id }
                                                }"
                                                >{{ product.name }}</router-link
                                            >
                                        </h5>
                                        <div class="groupPrice clearfix">
                                            <div
                                                class="proPrice"
                                                v-if="product.discount > 0"
                                            >
                                                <div
                                                    class="priceProduct priceCompare"
                                                >
                                                    <span class="money"
                                                        >RWF
                                                        {{
                                                            product.price
                                                        }}</span
                                                    >
                                                </div>
                                                <div
                                                    class="priceProduct priceSale"
                                                >
                                                    <span class="money"
                                                        >RWF
                                                        {{
                                                            product.discounted_price
                                                        }}</span
                                                    >
                                                </div>
                                            </div>
                                            <div class="proPrice" v-else>
                                                <div class="priceProduct">
                                                    <span class="money"
                                                        >RWF
                                                        {{
                                                            product.price
                                                        }}</span
                                                    >
                                                </div>
                                            </div>
                                            <div class="velaSwatchCus">
                                                <div class="star_rating">
                                                    <span>&star;</span>
                                                    <span>&star;</span>
                                                    <span>&star;</span>
                                                    <span>&star;</span>
                                                    <span>&star;</span>
                                                    <br />
                                                    <div
                                                        :style="{
                                                            width:
                                                                product.ratings_percentage +
                                                                '%'
                                                        }"
                                                        class="star_rating_current"
                                                    >
                                                        <span>&starf;</span>
                                                        <span>&starf;</span>
                                                        <span>&starf;</span>
                                                        <span>&starf;</span>
                                                        <span>&starf;</span>
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
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    name: "TrendingProductContainer",
    data() {
        return {
            added: false,
            wishlist_added: false,
            remove: false,
            wishlist_remove: false,
            baseUrl: ""
        };
    },
    mounted() {
        this.generateBaseUrl();
    },
    computed: {
        ...mapState("products", ["cart", "wishlist", "BestartistProducts"])
    },
    methods: {
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
        },
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
<style scoped="">
.added {
    background-color: #fbad02;
    border-color: #fbad02;
    color: #ffffff;
}
.slide-fade-enter-active {
    transition: all 0.4s ease;
}
.slide-fade-leave-active {
    transition: all 1.5s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter, .slide-fade-leave-to
               /* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateX(10px);
    opacity: 0;
}
.star_rating {
    display: inline-block;
    color: #fbad02;
    font-size: 1.2em;
    position: relative;
}
.star_rating .star_rating_current {
    position: absolute;
    top: 0;
    /* width: 50%; */
    overflow: hidden;
    white-space: nowrap;
}
</style>
