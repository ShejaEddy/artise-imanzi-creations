<template>
    <div id="shopify-section-vela-header" class="shopify-section">
        <div id="velaTopbar">
            <div class="container">
                <div class="velaTopbarInner row flexAlignCenter">
                    <div
                        class="velaTopbarLeft hidden-xs hidden-sm hidden-md d-flex col-md-4"
                    >
                        <i class="icons icon-call-in"></i> +250 788 334 964<span
                            class="ml10 mr10"
                            >|</span
                        >
                        <i class="icons icon-envelope"></i>info@artise.africa
                    </div>
                    <div
                        class="velaTopbarCenter text-center col-xs-12 col-md-12 col-lg-4"
                    >
                        Start shopping artworks from 600 Rwf<router-link
                            style="
                        background-color: #000 !important;
                        color: #fff !important;
                     "
                            to="/shop"
                            class="bg-primary"
                            >shop Now!</router-link
                        >
                    </div>
                    <div
                        class="velaTopbarRight d-flex flexAlignEnd hidden-xs hidden-sm hidden-md d-flex col-md-4"
                    >
                        <div class="hidden-xs">
                            <div class="d-flex velaSocialTop">
                                <a
                                    target="_blank"
                                    href="https://web.facebook.com/Childofa1000hills"
                                    class="js-btn-tooltip"
                                    data-toggle="tooltip"
                                    data-placement="bottom"
                                    data-custom-class="tooltip-primary"
                                    title="Facebook"
                                >
                                    <img
                                        src="assets/images/fb-black.png"
                                        width="27"
                                        alt=""
                                    />
                                </a>
                                <a
                                    target="_blank"
                                    href="https://twitter.com/ImanziCreations"
                                    class="js-btn-tooltip"
                                    data-toggle="tooltip"
                                    data-placement="bottom"
                                    data-custom-class="tooltip-primary"
                                    title="Twitter"
                                >
                                    <img
                                        src="assets/images/twitter-black.png"
                                        width="27"
                                        alt=""
                                    />
                                </a>
                                <a
                                    target="_blank"
                                    href="https://www.instagram.com/imanzi_creations/?hl=en"
                                    class="js-btn-tooltip"
                                    data-toggle="tooltip"
                                    data-placement="bottom"
                                    data-custom-class="tooltip-primary"
                                    title="Instagram"
                                >
                                    <img
                                        src="assets/images/instagram-black.png"
                                        width="27"
                                        alt=""
                                    />
                                </a>
                                <a
                                    target="_blank"
                                    href="https://www.pinterest.com/imanzirw/_saved/"
                                    class="js-btn-tooltip"
                                    data-toggle="tooltip"
                                    data-placement="bottom"
                                    data-custom-class="tooltip-primary"
                                    title="Pinterest"
                                >
                                    <img
                                        src="assets/images/pinterest-black.png"
                                        width="27"
                                        alt=""
                                    />
                                </a>
                                <a
                                    target="_blank"
                                    href="https://www.youtube.com/channel/UCBg365FGAVbdK1nRyEHIQxw"
                                    class="js-btn-tooltip"
                                    data-toggle="tooltip"
                                    data-placement="bottom"
                                    data-custom-class="tooltip-primary"
                                    title="Youtube"
                                >
                                    <img
                                        src="assets/images/youtube-black.png"
                                        width="27"
                                        alt=""
                                    />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <header id="velaHeader" class="velaHeader">
            <section class="headerWrap">
                <div class="velaHeaderMain headerMenu">
                    <div class="container">
                        <div
                            class="headerContent rowFlex rowFlexMargin flexAlignCenter"
                        >
                            <div
                                class="velaHeaderMobile hidden-lg hidden-xl hidden-md col-xs-3 col-sm-3"
                            >
                                <div
                                    class="menuBtnMobile d-flex flexAlignCenter"
                                >
                                    <div
                                        id="btnMenuMobile"
                                        class="btnMenuMobile"
                                        @click.prevent="toggleMenuMobile"
                                    >
                                        <span class="iconMenu"></span>
                                        <span class="iconMenu"></span>
                                        <span class="iconMenu"></span>
                                        <span class="iconMenu"></span>
                                    </div>
                                    <a
                                        class="velaSearchIcon"
                                        href="#velaSearchTop"
                                        data-toggle="collapse"
                                        title="Search"
                                        @click.prevent="showSearchForm()"
                                    >
                                        <i class="icons icon-magnifier"></i>
                                    </a>
                                </div>
                            </div>
                            <div
                                class="velaHeaderLeft d-flex flexAlignCenter col-xs-6 col-sm-6 col-md-2 col-lg-3"
                            >
                                <h1
                                    class="velaLogo"
                                    itemscope
                                    itemtype="http://schema.org/Organization"
                                >
                                    <a
                                        href="/"
                                        itemprop="url"
                                        class="velaLogoLink"
                                    >
                                        <span class="text-hide"
                                            >Imanzi Creations</span
                                        >
                                        <img
                                            class="img-responsive"
                                            :src="
                                                `${baseUrl}/assets/images/logo/artise-logo.png`
                                            "
                                            alt="imanzi creations"
                                            width="200"
                                            itemprop="logo"
                                        />
                                    </a>
                                </h1>
                            </div>
                            <div
                                class="velaHeaderCenter velaMainmenu hidden-xs hidden-sm d-flex flexJustifyCenter col-xs-6 col-sm-8 col-lg-6 p-static"
                            >
                                <section id="velaMegamenu" class="velaMegamenu">
                                    <nav class="menuContainer">
                                        <ul class="nav hidden-xs hidden-sm">
                                            <li
                                                :class="{
                                                    active: isActive('home')
                                                }"
                                            >
                                                <router-link
                                                    to="/"
                                                    title="Home"
                                                >
                                                    <span>Home</span>
                                                </router-link>
                                            </li>

                                            <li
                                                :class="{
                                                    active: isActive('shop')
                                                }"
                                            >
                                                <router-link
                                                    to="/shop"
                                                    title=""
                                                >
                                                    <span
                                                        >Shop</span
                                                    ></router-link
                                                >
                                            </li>
                                            <!-- <li :class="{ active: isActive('free-product') }">
                                    <router-link to="/free-products" title="">
                                       <span>Free Products</span></router-link
                                    >
                                 </li> -->
                                            <li
                                                :class="{
                                                    active: isActive('wishlist')
                                                }"
                                            >
                                                <router-link
                                                    to="/wishlist"
                                                    title=""
                                                >
                                                    <span
                                                        >Wishlist</span
                                                    ></router-link
                                                >
                                            </li>
                                            <li
                                                :class="{
                                                    active: isActive('blog')
                                                }"
                                            >
                                                <router-link
                                                    to="/blog"
                                                    title=""
                                                >
                                                    <span
                                                        >Blog</span
                                                    ></router-link
                                                >
                                            </li>
                                            <li
                                                :class="{
                                                    active: isActive(
                                                        'contact-us'
                                                    )
                                                }"
                                            >
                                                <router-link
                                                    to="/contact-us"
                                                    title=""
                                                >
                                                    <span
                                                        >Contact Us</span
                                                    ></router-link
                                                >
                                            </li>
                                        </ul>
                                    </nav>
                                </section>
                            </div>
                            <div
                                class="velaHeaderRight col-xs-3 col-sm-3 col-md-2 col-lg-3"
                            >
                                <div
                                    id="velaTopLinks"
                                    class="velaTopLinks d-flex flexAlignCenter"
                                >
                                    <router-link
                                        v-if="user.length == 0"
                                        to="/account"
                                    >
                                        <i
                                            style="color: #fff;"
                                            class="icons icon-user"
                                        ></i>
                                    </router-link>

                                    <template v-if="user.length != 0">
                                        <div class="dropdown">
                                            <router-link
                                                to="#"
                                                :class="{ dropbtn: mobileView }"
                                            >
                                                <i
                                                    style="color: #fff;"
                                                    class="icons icon-user"
                                                ></i>
                                            </router-link>
                                            <button
                                                v-if="!mobileView"
                                                class="dropbtn"
                                            >
                                                <span>
                                                    {{ user.names }}
                                                </span>
                                                <i
                                                    class="fa fa-caret-down ml-2"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                            <div class="dropdown-content">
                                                <template
                                                    v-if="
                                                        userInfo.role ==
                                                            'client'
                                                    "
                                                >
                                                    <a href="/buyer/orders"
                                                        ><i
                                                            class="fa fa-tachometer-alt mr-3 text-primary"
                                                            aria-hidden="true"
                                                        ></i>
                                                        Dashboard</a
                                                    >
                                                    <a href="/buyer/orders"
                                                        ><i
                                                            class="fa fa-shopping-cart mr-3 text-primary"
                                                            aria-hidden="true"
                                                        ></i
                                                        >My orders</a
                                                    >
                                                </template>
                                                <template
                                                    v-else-if="
                                                        userInfo.role ==
                                                            'artist'
                                                    "
                                                >
                                                    <a href="/artist/dashboard"
                                                        ><i
                                                            class="fa fa-tachometer-alt mr-3 text-primary"
                                                            aria-hidden="true"
                                                        ></i>
                                                        Dashboard</a
                                                    >
                                                    <a
                                                        href="/artist/view-orders"
                                                        ><i
                                                            class="fa fa-shopping-cart mr-3 text-primary"
                                                            aria-hidden="true"
                                                        ></i
                                                        >My orders</a
                                                    >
                                                </template>
                                                <template v-else>
                                                    <a href="/admin/dashboard"
                                                        ><i
                                                            class="fa fa-tachometer-alt mr-3 text-primary"
                                                            aria-hidden="true"
                                                        ></i>
                                                        Dashboard</a
                                                    >
                                                    <a href="/admin/view-orders"
                                                        ><i
                                                            class="fa fa-shopping-cart mr-3 text-primary"
                                                            aria-hidden="true"
                                                        ></i
                                                        >My orders</a
                                                    >
                                                </template>
                                                <a
                                                    href="#"
                                                    @click="UserLogout()"
                                                    ><i
                                                        class="fa fa-power-off mr-3 text-primary"
                                                        aria-hidden="true"
                                                    ></i
                                                    >Logout</a
                                                >
                                            </div>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <ul
                                            class="list-unstyled list-inline hidden-xs hidden-sm hidden-md"
                                        >
                                            <li>
                                                <router-link
                                                    to="/account"
                                                    id="customer_login_link"
                                                    >Account</router-link
                                                >
                                            </li>
                                        </ul>
                                    </template>
                                </div>

                                <a
                                    class="velaSearchIcon hidden-xs hidden-sm"
                                    href="#velaSearchTop"
                                    data-toggle="collapse"
                                    title="Search"
                                    @click.prevent="showSearchForm()"
                                >
                                    <i class="icons icon-magnifier"></i>
                                </a>
                                <div class="velaCartTop">
                                    <a
                                        href="#"
                                        class="jsDrawerOpenRight d-flex"
                                        @click.prevent="showCart"
                                    >
                                        <i class="icons icon-handbag"></i>
                                        <span class="text"
                                            ><span id="CartCount">{{
                                                this.cart.length
                                            }}</span></span
                                        >
                                    </a>
                                </div>
                            </div>
                            <div id="velaSearchTop" class="collapse">
                                <div class="text-center">
                                    <form
                                        id="velaSearchbox"
                                        class="formSearch"
                                        @submit.prevent="ShopSearch()"
                                        method="get"
                                    >
                                        <input
                                            type="hidden"
                                            name="type"
                                            value="product"
                                        />
                                        <input
                                            class="velaSearch form-control"
                                            type="search"
                                            name="q"
                                            v-model="searchValue"
                                            placeholder="Enter keywords to search..."
                                            autocomplete="off"
                                        />
                                        <button
                                            id="velaSearchButton"
                                            class="btnVelaSearch"
                                            type="submit"
                                        >
                                            <i class="icons icon-magnifier"></i>
                                            <span class="btnSearchText"
                                                >Search</span
                                            >
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </header>
        <div
            id="velaMenuMobile"
            class="menuMobileContainer hidden-md hidden-lg"
        >
            <div class="menuMobileWrapper">
                <div class="memoHeader">
                    <span>Menu Mobile</span>
                    <div class="btnMenuClose" @click.prevent="removeMenu">
                        &nbsp;
                    </div>
                </div>
                <ul class="nav memoNav">
                    <li
                        class="hasMemoDropdown"
                        :class="{ active: isActive('home') }"
                    >
                        <router-link to="/" title="">Home</router-link>
                    </li>
                    <li
                        class="hasMemoDropdown"
                        :class="{ active: isActive('shop') }"
                    >
                        <router-link to="/shop" title="">Shop</router-link>
                    </li>
                    <li
                        class="hasMemoDropdown"
                        :class="{ active: isActive('wishlist') }"
                    >
                        <router-link to="/wishlist" title=""
                            >Wishlist</router-link
                        >
                    </li>
                    <li
                        class="hasMemoDropdown"
                        :class="{ active: isActive('blog') }"
                    >
                        <router-link to="/blog" title="">Blog</router-link>
                    </li>
                    <li :class="{ active: isActive('contact-us') }">
                        <router-link to="/contact-us" title=""
                            >Contact Us</router-link
                        >
                    </li>
                </ul>
            </div>
        </div>
        <div class="menuMobileOverlay hidden-md hidden-lg"></div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import $ from "jquery";
export default {
    name: "Header",
    data() {
        return {
            baseUrl: "",
            showFilter: false,
            mobileView: false,
            searchValue: ""
            // userInfo: JSON.parse(localStorage.getItem("userInfo")),
        };
    },
    computed: {
        ...mapState({
            user: state => state.users.userInfo,
            userInfo: state => state.users.userInfo,
            cart: state => state.products.cart
        })
    },
    created() {
        this.handleView();
    },

    mounted() {
        this.display_tooltips();
        this.generateBaseUrl();
    },
    methods: {
        showSearchForm() {
            $("#velaSearchTop").toggleClass("collapse");
            $("#velaSearchTop").toggleClass("collapsing");
            $("#velaSearchTop").toggleClass("in");
        },
        ShopSearch() {
            this.showSearchForm();
            window.location.href = `${this.baseUrl}/search-results/${this.searchValue}`;
        },
        handleView() {
            this.mobileView = window.innerWidth <= 990;
        },
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
        },
        display_tooltips() {
            $(".js-btn-tooltip").tooltip();
            $(".js-btn-tooltip--custom").tooltip({
                customClass: "tooltip-custom"
            });
            $(".js-btn-tooltip--custom-alt").tooltip({
                customClass: "tooltip-custom-alt"
            });

            $(".js-btn-popover").popover();
            $(".js-btn-popover--custom").popover({
                customClass: "popover-custom"
            });
            $(".js-btn-popover--custom-alt").popover({
                customClass: "popover-custom-alt"
            });
        },
        toggleMenuMobile() {
            $("body").attr("class", "menuMobileActive");
        },
        removeMenu() {
            $("body").attr("class", "");
        },
        showCart() {
            let pathname = window.location.pathname;
            if (pathname !== "/cart") {
                $("body").attr("class", "jsDrawerOpen jsDrawerOpenRight");
                $("#cartDrawer").attr("class", "drawer drawerRight");
                $("#pageContainer").attr("class", "isMoved");
            }
        },
        isActive(url) {
            let pathname = window.location.pathname;
            let splitPath = pathname.split("/")[1];
            if (splitPath == url) {
                return true;
            } else if (pathname == "/" && url == "home") {
                return true;
            } else {
                return false;
            }
        },
        UserLogout() {
            this.$store.dispatch("users/UserLogout").then(Response => {
                console.log(Response);
            });
        }
    }
};
</script>
<style scoped>
.velaTopLinks li a {
    display: block;
    line-height: 14px;
    color: #fff;
}
.velaTopLinks li a:hover {
    display: block;
    line-height: 14px;
    color: #fbad02;
}
.velaTopLinks {
    padding-right: 5px !important;
}
.nav {
    display: block !important;
}
.text-primary {
    color: #fbad02 !important;
}
.account-btn {
    color: #fff;
    padding: 5px 12px !important;
    font-size: 14px !important;
    background-color: #b3b3b3;
    border-color: #b3b3b3;
}
/* Style The Dropdown Button */
.dropbtn {
    background-color: #ffffff00;
    color: #fff;
    padding: 10px 5px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
    background-color: #f1f1f1;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

.tooltip-custom .tooltip-inner {
    background-color: #f2653c;
    color: #ffffff;
}
.tooltip-custom.bs-tooltip-top .arrow:before {
    border-top-color: #f2653c;
}
.tooltip-custom.bs-tooltip-right .arrow:before {
    border-right-color: #f2653c;
}
.tooltip-custom.bs-tooltip-left .arrow:before {
    border-left-color: #f2653c;
}
.tooltip-custom.bs-tooltip-bottom .arrow:before {
    border-bottom-color: #f2653c;
}

.tooltip-custom-alt .tooltip-inner {
    background-color: #5b2da3;
    color: #ffffff;
}
.tooltip-custom-alt.bs-tooltip-top .arrow:before {
    border-top-color: #5b2da3;
}
.tooltip-custom-alt.bs-tooltip-right .arrow:before {
    border-right-color: #5b2da3;
}
.tooltip-custom-alt.bs-tooltip-left .arrow:before {
    border-left-color: #5b2da3;
}
.tooltip-custom-alt.bs-tooltip-bottom .arrow:before {
    border-bottom-color: #5b2da3;
}

.popover-custom .popover-header {
    background: #f2653c;
    color: #ffffff;
}
.popover-custom.bs-popover-bottom .popover-header::before,
.popover-custom.bs-popover-auto[x-placement^="bottom"] .popover-header::before {
    display: none;
}
.popover-custom.bs-popover-bottom > .arrow::after,
.popover-custom.bs-popover-auto[x-placement^="bottom"] > .arrow::after {
    border-bottom-color: #f2653c;
}

.popover-custom-alt .popover-header {
    background: #5b2da3;
    color: #ffffff;
}
.popover-custom-alt.bs-popover-bottom .popover-header::before,
.popover-custom-alt.bs-popover-auto[x-placement^="bottom"]
    .popover-header::before {
    display: none;
}
.popover-custom-alt.bs-popover-bottom > .arrow::after,
.popover-custom-alt.bs-popover-auto[x-placement^="bottom"] > .arrow::after {
    border-bottom-color: #5b2da3;
}

body {
    padding-top: 4.5rem;
}

#topnav .nav-link > i {
    font-size: 26px;
}
@media (max-width: 560px) {
    #topnav .navbar-brand {
        font-size: 14px;
    }
}

.bs-example {
    position: relative;
    margin: 15px;
    padding: 15px 15px 25px;
    border: 1px solid #ddd;
    border-radius: 4px 4px 0 0;
}

.bs-example .btn {
    margin: 1.25rem 0.75rem;
}

.bs-example__title {
    margin-bottom: 1rem;
}
/* Smartphone & kindle (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 700px) {
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgb(0 0 0 / 20%);
        z-index: 1;
        margin-top: 10px;
        right: 10px;
    }
    .velaLogo img {
        max-width: 85%;
    }
}
/* iPads (portrait and landscape) ----------- */
@media only screen and (min-width: 768px) and (max-width: 1024px) {
}
</style>
