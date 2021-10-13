<template>
    <carousel
        :per-page="1"
        :mouse-drag="true"
        :autoplay="false"
        :autoplayDirection="autoplayDirection"
        :autoplayTimeout="3500"
        :autoplayHoverPause="true"
        :easing="easing"
        :loop="false"
        :paginationEnabled="true"
        navigation-next-label="<i class='icons icon-arrow-right'></i>"
        navigation-prev-label="<i class='icons icon-arrow-left'></i>"
    >
        <slide v-if="slides.length === 0">
            <div style="background:#EBEBED;" class="velassSlide">
                <div class="velassImage">
                    <div class="p-relative">
                        <div
                            class="product-card__image"
                            style="padding-top: 34.89583333333333%;"
                        ></div>
                        <div
                            class="placeholder-background placeholder-background--animation"
                            data-image-placeholder
                        ></div>
                    </div>
                </div>
                <div
                    class="velassCaption"
                    style="background-color: rgba(0, 0, 0, 0);"
                >
                    <div class="container captionWrap">
                        <div
                            class="velassCaptionContent text-center align-middle"
                        >
                            <div class="velassCaptionInner text-center">
                                <div class="d-flex justify-content-center">
                                    <div
                                        style="width: 5rem; height: 5rem;"
                                        class="spinner-border"
                                        role="status"
                                    >
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </slide>
        <slide v-for="slide in slides" :key="slide.id">
            <div style="background:#EBEBED;" class="velassSlide">
                <div
                    class="velassImage"
                    :data-src="`${baseUrl}/storage/${slide.slide_image}`"
                >
                    <div class="p-relative">
                        <div
                            class="product-card__image"
                            style="padding-top: 34.89583333333333%;"
                        >
                            <img
                                class="product-card__img lazyload"
                                :data-src="
                                    `${baseUrl}/storage/${slide.slide_image}`
                                "
                                data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]"
                                data-aspectratio="2.8656716417910446"
                                data-ratio="2.8656716417910446"
                                data-sizes="auto"
                                alt=""
                            />
                        </div>
                        <div
                            class="placeholder-background placeholder-background--animation"
                            data-image-placeholder
                        ></div>
                    </div>
                </div>
                <div
                    class="velassCaption"
                    style="background-color: rgba(0, 0, 0, 0);"
                >
                    <div class="container captionWrap">
                        <div
                            class="velassCaptionContent text-left align-middle"
                        >
                            <div class="velassCaptionInner text-left">
                                <!-- <h2 class="velassHeading bottomtop-2" style="color: #444444;">
                <b
                  >Free shipping on all orders,
                  <span class="text-primary">above 600 Rwf</span></b
                >
              </h2> -->

                                <div
                                    class="slide-caption"
                                    v-html="slide.slide_caption"
                                ></div>
                                <a
                                    class="btn btnVelaSlider bottomtop-5"
                                    href="/shop"
                                    style="border-color: #1a1a1a; background-color: #1a1a1a; color: #fff; padding: 14px 30px;"
                                >
                                    Start Shopping
                                    <i class="icons icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </slide>
    </carousel>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
    name: "HomeTopSliderContainer",
    data() {
        return {
            baseUrl: "",
            review_content: "",
            easing: "ease",
            autoplayDirection: "forward",
            navigateTo: "someLocalProperty"
        };
    },
    computed: {
        ...mapState({
            slides: state => state.products.slides
        })
    },
    created() {
        this.generateBaseUrl();
        this.loadSlides();
    },
    methods: {
        ...mapActions("products", ["get_slides"]),

        loadSlides() {
            this.get_slides();
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

<style scoped>
.product-card__image .product-card__img {
    background: #ebebed !important;
}
.text-primary {
    color: #fbad02 !important;
}
.velassCaptionContent::after {
    display: none !important;
}

.VueCarousel-navigation-button {
    text-indent: 1000em;
}

.VueCarousel-navigation-button::before {
    content: "";
    position: absolute;
    top: 8px;
    height: 23px;
    width: 16px;
}

.VueCarousel-navigation-next::before {
    background: red;
    right: 6px;
}

.VueCarousel-navigation-prev::before {
    background: red;
    left: 6px;
}

@media only screen and (min-width: 320px) and (max-width: 700px) {
    .velassCaption .captionWrap {
        margin-top: -130px !important;
    }

    .slide-caption >>> * {
        font-size: 25px !important;
    }
}

.slide-caption >>> * {
    font-size: 45px;
}
</style>
