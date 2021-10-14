<template>
    <div
        id="shopify-section-1585935437629"
        class="shopify-section velaFramework"
    >
        <div
            class="velaMultiBanner mb30"
            style="background-color: rgba(0, 0, 0, 0); padding: 0 0 20px;"
        >
            <div class="container">
                <div class="velaCollectionInner ">
                    <div class="velaContent">
                        <div
                            v-for="advert in adverts"
                            :key="advert.id"
                            class="rowFlex rowFlexMargin"
                        >
                            <div class="col-xs-12 col-sm-6 mbItemGutter">
                                <div class="bannerItem effectTwo">
                                    <router-link to="/shop">
                                        <div class="p-relative">
                                            <div
                                                class="product-card__image"
                                                style="padding-top:63.76811594202898%;"
                                            >
                                                <img
                                                    class="product-card__img lazyautosizes lazyloaded"
                                                    data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]"
                                                    data-aspectratio="1.5681818181818181"
                                                    data-ratio="1.5681818181818181"
                                                    data-sizes="auto"
                                                    alt=""
                                                    :src="
                                                        `${baseUrl}/uploads/images/${advert.left_advert}`
                                                    "
                                                    sizes="674.3181818181819px"
                                                />
                                            </div>
                                            <div
                                                class="placeholder-background placeholder-background--animation"
                                                data-image-placeholder=""
                                            ></div>
                                        </div>
                                    </router-link>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 mbItemGutter">
                                <div class="bannerItem effectTwo">
                                    <router-link to="/shop">
                                        <div class="p-relative">
                                            <div
                                                class="product-card__image"
                                                style="padding-top:63.76811594202898%;"
                                            >
                                                <img
                                                    class="product-card__img lazyautosizes lazyloaded"
                                                    data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]"
                                                    data-aspectratio="1.5681818181818181"
                                                    data-ratio="1.5681818181818181"
                                                    data-sizes="auto"
                                                    alt=""
                                                    :src="
                                                        `${baseUrl}/uploads/images/${advert.right_advert}`
                                                    "
                                                    sizes="674.3181818181819px"
                                                />
                                            </div>
                                            <div
                                                class="placeholder-background placeholder-background--animation"
                                                data-image-placeholder=""
                                            ></div>
                                        </div>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="container-full">
                        <div class="velaMultiBannerInner gutter20">
                            <div class="velaContent">
                                <div class="rowFlex rowFlexMargin">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="mb30 velaBanner effectFour">
                                            <a href="collections/frontpage.html" title="velademo-Artise">
                                                <div class="p-relative">
                                                    <div class="product-card__image"
                                                        style="padding-top: 29.16666666666667%;">
                                                        <img class="product-card__img lazyload"
                                                            data-src="assets/images/sales.jpg"
                                                            data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]"
                                                            data-aspectratio="3.4285714285714284"
                                                            data-ratio="3.4285714285714284" data-sizes="auto" alt="" />
                                                    </div>
                                                    <div class="placeholder-background placeholder-background--animation"
                                                        data-image-placeholder></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
    name: "HomeAdvertContainer",
    data() {
        return {
            baseUrl: ""
        };
    },
    computed: {
        ...mapState({
            adverts: state => state.products.adverts
        })
    },
    mounted() {
        this.generateBaseUrl();
        this.loadAdverts();
    },
    methods: {
        ...mapActions("products", ["get_adverts"]),

        loadAdverts() {
            this.get_adverts();
        },
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
        },
        scrollTop() {
            this.intervalId = setInterval(() => {
                if (window.pageYOffset == 0) {
                    clearInterval(this.intervalId);
                }
                window.scroll(0, window.pageYOffset - 50);
            }, 20);
        }
    }
};
</script>
