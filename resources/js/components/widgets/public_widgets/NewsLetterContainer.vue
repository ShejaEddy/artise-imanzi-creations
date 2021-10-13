<template>
    <div
        id="shopify-section-1585674376666"
        class="shopify-section velaFramework"
    >
        <div
            class="velaNewsletter hasBg"
            v-bind:style="{ 'background-image': 'url(' + image + ')' }"
        >
            <div class="container">
                <div class="velaNewsletterInner text-center clearfix">
                    <div class="wrap">
                        <div class="headingGroup pb20">
                            <h3 class="velaHomeTitle text-center">
                                Subcribe To Our Newsletters
                            </h3>
                            <span class="subTitle"
                                >Sign up for the weekly updates on new artwork
                                arrivals for you.</span
                            >
                        </div>
                        <div class="velaContent">
                            <form
                                method="post"
                                action="https://velademo-Artise.myshopify.com/contact#contact_form"
                                id="contact_form"
                                accept-charset="UTF-8"
                                class="contact-form"
                            >
                                <input
                                    type="hidden"
                                    name="form_type"
                                    value="customer"
                                /><input type="hidden" name="utf8" value="✓" />

                                <div class="form-group input-group">
                                    <input
                                        class="form-control"
                                        type="email"
                                        name="contact[email]"
                                        placeholder="Your email address..."
                                    />
                                    <span class="input-group-btn">
                                        <button
                                            class="btnNewsletter btnVelaOne"
                                            type="submit"
                                        >
                                            <span>Subscribe</span>
                                        </button>
                                    </span>
                                    <input
                                        type="hidden"
                                        name="action"
                                        value="0"
                                    />
                                </div>
                            </form>
                            <div class="newsletterDescription">
                                We respect your privacy, so we never share your
                                info.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "NewsLetterContainer",
    data() {
        return {
            image: "",
            baseUrl: ""
        };
    },
    mounted() {
        this.generateBaseUrl();
    },
    methods: {
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
            this.image = this.baseUrl + "/assets/images/bgs/newsletter_bg.jpg";
        }
    }
};
</script>
