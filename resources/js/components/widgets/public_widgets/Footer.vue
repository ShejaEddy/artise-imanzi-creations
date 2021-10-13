<template>
    <!-- FOOTER BLOCK-->
    <div id="shopify-section-vela-footer" class="shopify-section">
        <footer id="velaFooter">
            <div class="footerCenter">
                <div class="container">
                    <div class="footerCenterInner">
                        <div class="rowFlex rowFlexMargin">
                            <div class="col-xs-12 col-sm-8 col-md-6 mb30">
                                <div class="footerInfo">
                                    <div class="infoImage">
                                        <img class="img-responsive"
                                        style="border-radius:15px;"
                                        :src="`${baseUrl}/assets/images/logo/artise-logo.png`"
                                        width="350" alt= />

                                        <div class="footer-about-us">
                                            Founded in 2019, Imanzi Creations
                                            Ltd is a creative studio that
                                            publishes books and animated
                                            stories, with the aim of
                                            entertaining, and inspiring people
                                            in Rwanda and beyond. It is
                                            headquartered in Kigali, Rwanda.
                                        </div>
                                    </div>
                                    <div class="footerSocial">
                                        <div class="d-flex velaSocialFooter">
                                            <a
                                                target="_blank"
                                                href="https://web.facebook.com/Childofa1000hills"
                                                class="js-btn-tooltip"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                data-custom-class="tooltip-secondary"
                                                title="Facebook"
                                            >
                                                <img
                                                    src="assets/images/fb-gray.png"
                                                    width="32"
                                                    alt=""
                                                />
                                            </a>
                                            <a
                                                target="_blank"
                                                href="https://twitter.com/ImanziCreations"
                                                class="js-btn-tooltip"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                data-custom-class="tooltip-secondary"
                                                title="Twitter"
                                            >
                                                <img
                                                    src="assets/images/twitter-gray.png"
                                                    width="32"
                                                    alt=""
                                                />
                                            </a>
                                            <a
                                                target="_blank"
                                                href="https://www.instagram.com/imanzi_creations/?hl=en"
                                                class="js-btn-tooltip"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                data-custom-class="tooltip-secondary"
                                                title="Instagram"
                                            >
                                                <img
                                                    src="assets/images/instagram-gray.png"
                                                    width="32"
                                                    alt=""
                                                />
                                            </a>
                                            <a
                                                target="_blank"
                                                href="https://www.pinterest.com/imanzirw/_saved/"
                                                class="js-btn-tooltip"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                data-custom-class="tooltip-secondary"
                                                title="Pinterest"
                                            >
                                                <img
                                                    src="assets/images/pinterest-gray.png"
                                                    width="32"
                                                    alt=""
                                                />
                                            </a>
                                            <a
                                                target="_blank"
                                                href="https://www.youtube.com/channel/UCBg365FGAVbdK1nRyEHIQxw"
                                                class="js-btn-tooltip"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                data-custom-class="tooltip-secondary"
                                                title="Youtube"
                                            >
                                                <img
                                                    src="assets/images/youtube-gray.png"
                                                    width="32"
                                                    alt=""
                                                />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-8 col-md-3 mb30">
                                <div class="velaFooterMenu">
                                    <h4 class="velaFooterTitle">
                                        Useful Links
                                    </h4>

                                    <div class="velaContent">
                                        <ul
                                            class="velaFooterLinks list-unstyled"
                                        >
                                            <li
                                                v-for="page in pages"
                                                :key="page.id"
                                                class=""
                                            >
                                                <a
                                                    :href="
                                                        `/${page.id}/${page.page_url}`
                                                    "
                                                    title=""
                                                    >{{ page.page_name }}</a
                                                >
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-3 mb30">
                                <div class="footerAbout">
                                    <h5>Let’s Talk</h5>
                                    <div class="d-flex mb30">
                                        <div>
                                            <i
                                                class="icons icon-earphones-alt"
                                            ></i>
                                        </div>
                                        <div>
                                            +250 788 334 964 <br />
                                            <u>info@artise.africa</u>
                                        </div>
                                    </div>
                                    <h5>Find Us</h5>
                                    <div class="d-flex">
                                        <div>
                                            <i
                                                class="icons icon-location-pin"
                                            ></i>
                                        </div>
                                        <div>
                                            Kg 167 st Kacyiru,<br />
                                            Kigali, Rwanda
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footerCopyRight">
                <div class="container">
                    <div class="footerCopyRightInner clearfix">
                        <div class="velaCopyRight pull-left">
                            <a href="index.html"
                                ><b>© {{ date }} {{ site_name }}.</b></a
                            >
                            All Rights Reserved
                        </div>
                        <div class="velaPayment pull-right hidden-xs hidden-sm">
                            <div class="vela-content row">
                                <div class="col-md-2">
                                    <img
                                        :src="
                                            `${baseUrl}/assets/images/ssl-icon.png`
                                        "
                                        width="38"
                                        alt=""
                                    />
                                </div>
                                <div class="col-md-10">
                                    <img
                                        style="width: 27%;float: right;"
                                        class="img-responsive"
                                        alt=""
                                        :src="
                                            `${baseUrl}/assets/images/payments.jpg`
                                        "
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div
            id="shopify-section-vela-template-notification"
            class="shopify-section"
        ></div>
        <div id="goToTop" class="hidden-xs hidden-sm">
            <span class="fa fa-angle-up"></span>
        </div>

        <a
            href="https://wa.me/250788334964"
            id="myBtn"
            target="_blank"
            data-toggle="tooltip"
            data-placement="top"
            title="Whatsapp us!"
            ><img src="/assets/images/Whatsapp-Icon.png" width="45" height="45"
        /></a>
    </div>
    <!-- FOOTER BLOCK--END -->
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
    name: "Footer",
    data() {
        return {
            date: new Date().getFullYear(),
            site_name: "Imanzi Creations",
            baseUrl: ""
        };
    },
    computed: {
        ...mapState({
            pages: state => state.products.pages
        })
    },
    mounted() {
        this.display_tooltips();
        this.generateBaseUrl();
        this.loadPages();
    },
    methods: {
        ...mapActions("products", ["get_pages"]),

        loadPages() {
            this.get_pages();
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
        }
    }
};
</script>

<style scoped>
/*!
 * bootstrap-tooltip-custom-class
 * v1.1.0
 * Extends Bootstrap Tooltips and Popovers by adding custom classes.
 * https://github.com/andreivictor/bootstrap-tooltip-custom-class#readme
 */
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

#myBtn {
    display: block;
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 99;
    font-size: 18px;
    border: none;
    outline: none;
    background-color: transparent;
    color: white;
    cursor: pointer;
    padding: 0px;
    border-radius: 50px;
}
.footer-about-us {
    width: 80%;
}
</style>
