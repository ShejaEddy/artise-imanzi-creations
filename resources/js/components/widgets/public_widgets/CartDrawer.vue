<template>
    <transition name="slide-fade">
        <div>
            <div id="cartDrawer" class="drawer" tabindex="-1">
                <div class="drawerClose" @click.prevent="closeDrawer">
                    <span class="jsDrawerClose"></span>
                </div>
                <div class="drawerCartTitle">
                    <span>Shopping cart</span>
                </div>
                <div
                    id="cartContainer"
                    v-if="!cart || cart === null || cart.length === 0"
                >
                    <div class="drawerCartEmpty">
                        Your cart is currently empty.
                    </div>
                </div>
                <div id="cartContainer" v-else>
                    <form class="cart ajaxcart" @submit.prevent="hello">
                        <div class="ajaxCartInner">
                            <div
                                class="ajaxCartProduct"
                                v-for="ct in cart"
                                :key="ct.id"
                            >
                                <div
                                    class="drawerProduct ajaxCartRow"
                                    data-line="1"
                                >
                                    <div class="drawerProductImage">
                                        <router-link
                                            :to="{
                                                name: 'Product',
                                                params: { id: ct.id }
                                            }"
                                            ><img
                                                class="img-responsive"
                                                :src="
                                                    `${baseUrl}/storage/${ct.thumbnail}`
                                                "
                                                alt=""
                                        /></router-link>
                                    </div>
                                    <div class="drawerProductContent">
                                        <div class="drawerProductTitle">
                                            <router-link
                                                :to="{
                                                    name: 'Product',
                                                    params: { id: ct.id }
                                                }"
                                                >{{ ct.name }}</router-link
                                            >
                                        </div>
                                        <div class="drawerProductPrice">
                                            <div
                                                class="priceProduct"
                                                v-if="ct.discount > 0"
                                            >
                                                <span
                                                    class="money"
                                                    data-currency-usd="$39,00"
                                                    data-currency="USD"
                                                    >{{
                                                        parseFloat(
                                                            ct.discounted_price
                                                        ) *
                                                            parseFloat(
                                                                ct.quantity
                                                            )
                                                    }}
                                                    Rwf</span
                                                >
                                            </div>
                                            <div class="priceProduct" v-else>
                                                <span
                                                    class="money"
                                                    data-currency-usd="$39,00"
                                                    data-currency="USD"
                                                    >{{
                                                        parseFloat(ct.price) *
                                                            parseFloat(
                                                                ct.quantity
                                                            )
                                                    }}
                                                    Rwf</span
                                                >
                                            </div>
                                        </div>
                                        <div class="drawerProductQty">
                                            <div class="velaQty">
                                                <button
                                                    type="button"
                                                    class="qtyAdjust velaQtyButton"
                                                    @click.prevent="
                                                        decrement_quantity(
                                                            ct.id
                                                        )
                                                    "
                                                >
                                                    <span class="txtFallback"
                                                        >−</span
                                                    >
                                                </button>
                                                <input
                                                    type="text"
                                                    class="qty velaQtyText"
                                                    :value="ct.quantity"
                                                />
                                                <button
                                                    type="button"
                                                    class="qtyAdjust velaQtyButton"
                                                    @click.prevent="
                                                        increment_quantity(
                                                            ct.id
                                                        )
                                                    "
                                                >
                                                    <span class="txtFallback"
                                                        >+</span
                                                    >
                                                </button>
                                            </div>
                                        </div>
                                        <div class="drawerProductDelete">
                                            <div class="cartRemoveBox">
                                                <a
                                                    href="#"
                                                    class="cartRemove btnClose"
                                                    onclick="return false;"
                                                    data-line="1"
                                                    @click.prevent="
                                                        addToCart(
                                                            ct.id,
                                                            ct.name
                                                        )
                                                    "
                                                >
                                                    <span>Remove</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="drawerCartFooter">
                                <div class="drawerAjaxFooter">
                                    <div class="drawerSubtotal">
                                        <span class="cartSubtotalHeading"
                                            >Subtotal</span
                                        >
                                        <span class="cartSubtotal"
                                            ><span
                                                class="money"
                                                data-currency-usd="$39,00"
                                                data-currency="USD"
                                                >{{ this.cartTotal }} Rwf</span
                                            ></span
                                        >
                                    </div>
                                    <p class="drawerShipping">
                                        Shipping, taxes, and discounts will be
                                        calculated at checkout.
                                    </p>
                                    <div class="drawerButton">
                                        <div class="drawerButtonBox">
                                            <router-link
                                                class="btn btnVelaCart btnViewCart"
                                                to="/cart"
                                            >
                                                View Cart
                                            </router-link>
                                        </div>
                                        <div class="drawerButtonBox">
                                            <button
                                                class="btn btnVelaCart btnCheckout"
                                                @click="CheckOutLogin()"
                                            >
                                                Check out
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import $ from "jquery";
import { mapState } from "vuex";
export default {
    name: "cartDrawer",
    data() {
        return {
            cartTotal: 0,
            userId: null,
            baseUrl: ""
        };
    },
    created() {
        this.get_cart_total();
    },
    mounted() {
        this.generateBaseUrl();
    },
    computed: {
        ...mapState("products", ["cart"])
    },
    methods: {
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
        },
        closeDrawer() {
            $("body").attr("class", "");
            $("#cartDrawer").attr("class", "drawer");
            $("#pageContainer").removeAttr("class");
        },
        CheckOutLogin() {
            this.closeDrawer();
            this.userId = localStorage.getItem("userId");
            if (this.userId == null || this.userId < 0 || this.userId == "") {
                localStorage.setItem("LoginReason", "CheckoutReason");
                this.$router.push({ name: "Account" });
            } else {
                this.$router.push({ name: "Checkout" });
            }
        },
        addToCart(id, name) {
            let r = confirm(
                "Are you sure you want to remove this product from cart?"
            );
            if (r) {
                this.$store.dispatch("products/addToCart", id);
            }
            this.get_cart_total();
        },
        get_cart_total() {
            this.cartTotal = 0;
            this.cart.forEach((v, i) => {
                if (v.discount > 0) {
                    this.cartTotal +=
                        parseFloat(v.discounted_price) * parseFloat(v.quantity);
                } else {
                    this.cartTotal +=
                        parseFloat(v.price) * parseFloat(v.quantity);
                }
                console.log(this.cartTotal);
            });
        },
        increment_quantity(id) {
            this.$store.dispatch("products/quantity_increment", id);
        },
        decrement_quantity(id) {
            this.$store.dispatch("products/quantity_decrement", id);
        }
    },
    watch: {
        cart() {
            this.get_cart_total();
        }
    }
};
</script>

<style scoped>
.drawer {
    -webkit-transition: all 0.4s cubic-bezier(0.46, 0.01, 0.32, 1) !important;
    transition: all 0.4s cubic-bezier(0.46, 0.01, 0.32, 1) !important;
}
.qty {
    text-align: center;
    font-weight: 600;
    border: 0;
    width: 40px;
    height: 30px;
}
.slide-fade-enter-active {
    transition: all 0.3s ease;
}
.slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter, .slide-fade-leave-to
         /* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateX(10px);
    opacity: 0;
}
</style>
