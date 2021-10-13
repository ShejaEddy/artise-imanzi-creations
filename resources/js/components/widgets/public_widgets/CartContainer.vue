<template>
    <section id="pageContent">
        <div class="container">
            <div
                id="shopify-section-vela-template-cart"
                class="shopify-section"
            >
                <div
                    class="cartContainer"
                    v-if="!cart || cart === null || cart.length === 0"
                >
                    <h1 class="cartTitle hidden">Shopping cart</h1>
                    <div class="cartContent">
                        <div class="cartEmptyContent">
                            <p class="cartEmpty">
                                Your cart is currently empty.
                            </p>
                            <p>
                                Before proceed to checkout you must add some
                                products to your shopping cart.<br />
                                You will find a lot of interesting products on
                                our Website.
                            </p>
                            <p>
                                <router-link
                                    class="btn btnVelaOne"
                                    to="/collections"
                                    title="Go to Shopping"
                                    >Go to Shopping</router-link
                                >
                            </p>
                        </div>
                    </div>
                </div>
                <div class="cartContainer" v-else>
                    <h1 class="cartTitle">Shopping cart</h1>
                    <div class="cartContent">
                        <form
                            action="/cart"
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
                                    v-for="ct in cart"
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
                                                        `${baseUrl}/storage/${ct.thumbnail}`
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

                                            <p>Demo Vender</p>

                                            <div data-label="Price">
                                                <span class="priceProduct">
                                                    <span
                                                        v-if="ct.discount > 0"
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
                                            <div
                                                class="flexRow cartGroup flexAlignCenter"
                                                data-label="Quantity"
                                            >
                                                <div class="velaQty">
                                                    <button
                                                        type="button"
                                                        class="velaQtyAdjust velaQtyButton velaQtyMinus"
                                                        data-id=""
                                                        data-qty="0"
                                                        @click.prevent="
                                                            decrement_quantity(
                                                                ct.id
                                                            )
                                                        "
                                                    >
                                                        <span
                                                            class="txtFallback"
                                                            >−</span
                                                        >
                                                    </button>
                                                    <input
                                                        type="text"
                                                        class="velaQtyNum velaQtyText"
                                                        v-model="ct.quantity"
                                                        value="1"
                                                        min="1"
                                                        data-id=""
                                                        aria-label="quantity"
                                                        pattern="[0-9]*"
                                                        name="updates[]"
                                                        id="updates_33475052175404"
                                                    />
                                                    <button
                                                        type="button"
                                                        class="velaQtyAdjust velaQtyButton velaQtyPlus"
                                                        data-id=""
                                                        data-qty="11"
                                                        @click.prevent="
                                                            increment_quantity(
                                                                ct.id
                                                            )
                                                        "
                                                    >
                                                        <span
                                                            class="txtFallback"
                                                            >+</span
                                                        >
                                                    </button>
                                                </div>
                                                <a
                                                    href=""
                                                    class="cartRemove"
                                                    title="Remove"
                                                    @click.prevent="
                                                        addToCart(
                                                            ct.id,
                                                            ct.name
                                                        )
                                                    "
                                                >
                                                    Remove
                                                </a>
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
                                                    v-if="ct.discount > 0"
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
                            <div class="functionCart flexRow">
                                <div class="col-xs-12 col-md-7">
                                    <div class="functionCartNote">
                                        <div class="velaCartNoteButton">
                                            <a
                                                class="btnCartNote collapsed"
                                                href="#velaCartNote"
                                                data-toggle="collapse"
                                            >
                                                <i class="fa fa-times"></i>
                                                add order note
                                            </a>
                                        </div>
                                        <div
                                            id="velaCartNote"
                                            class="velaCartNoteGroup collapse"
                                        >
                                            <label for="CartSpecialInstructions"
                                                >Special instructions for
                                                artist</label
                                            >
                                            <textarea
                                                name="note"
                                                class="form-control"
                                                id="CartSpecialInstructions"
                                                rows="4"
                                            ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right col-xs-12 col-md-5">
                                    <div class="cartBoxSubtotal">
                                        <span class="cartSubtotalTitle"
                                            >Subtotal:
                                        </span>
                                        <span class="cartSubtotal"
                                            ><span
                                                class="money"
                                                data-currency-usd="RWF 59,00"
                                                data-currency-gbp="&amp;pound;46.25"
                                                data-currency="GBP"
                                                >RWF {{ this.cartTotal }}</span
                                            ></span
                                        >
                                    </div>
                                    <p class="cartShipping">
                                        Shipping, taxes, and discounts will be
                                        calculated at checkout.
                                    </p>
                                    <div class="functionCartButton">
                                        <span
                                            class="btn btnCheckout"
                                            @click="CheckOutLogin()"
                                            >Check Out</span
                                        >
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
    name: "CartContainer",
    data() {
        return {
            cartTotal: 0,
            baseUrl: ""
        };
    },
    created() {
        this.get_cart_total();
        $("body").attr("class", "");
        $("#cartDrawer").attr("class", "drawer");
        $("#pageContainer").removeAttr("class");
    },
    mounted() {
        this.generateBaseUrl();
    },
    computed: {
        ...mapState("products", ["cart", "BestartistProducts"]),
        ...mapActions("products", ["quantity_decrement", "quantity_increment"])
    },
    methods: {
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
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
        CheckOutLogin() {
            this.userId = localStorage.getItem("userId");
            if (this.userId == null || this.userId < 0 || this.userId == "") {
                localStorage.setItem("LoginReason", "CheckoutReason");
                this.$router.push({ name: "Account" });
            } else {
                this.$router.push({ name: "Checkout" });
            }
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
