<template>
    <div
        class="artise_product_section"
        v-bind:style="{
            'background-image': 'url(' + background + ')',
            'background-repeat': 'no-repeat',
            'background-size': '100%'
        }"
    >
        <div class="col-md-3"></div>
        <div class="col-md-8">
            <div class="prod-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="prod-title">
                            <h1>{{ title }}</h1>
                        </div>
                    </div>
                    <div
                        class="col-md-4"
                        :key="product.id"
                        v-for="product in products"
                    >
                        <div class="card">
                            <div class="prod-container">
                                <div
                                    class="prod-image"
                                    @click="addModal(product)"
                                >
                                    <img
                                        class="product-card__img lazyload"
                                        :data-src="
                                            `${baseUrl}/storage/${product.thumbnail}`
                                        "
                                        data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]"
                                        data-aspectratio="0.8048289738430584"
                                        data-ratio="0.8048289738430584"
                                        data-sizes="auto"
                                        width="100%"
                                        alt=""
                                    />
                                </div>
                                <div class="prod-name">
                                    <h4>{{ product.name }}</h4>
                                </div>
                                <button
                                    class="prod-link"
                                    @click="addModal(product)"
                                    :href="product.link"
                                >
                                    Look inside
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ModelRoot from "../../modelComponents/ModelRoot.vue";
import TestModel from "../../modelComponents/CustomModel.vue";
import ModelService from "../../modelComponents/model.service";
export default {
    name: "ArtiseProducts2",
    data() {
        return {
            image: "",
            baseUrl: "",
            imageUrl: ""
        };
    },
    components: {
        ModelRoot
    },
    props: {
        products: Array,
        background: String,
        title: String
    },
    mounted() {
        this.generateBaseUrl();
    },
    methods: {
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
            this.imageUrl = this.baseUrl + "/assets/images/ndoli-novel.png";
        },
        addModal(product) {
            ModelService.open(TestModel, {
                id: product.id,
                name: product.name,
                description: product.longDesc,
                thumbnail: product.thumbnail,
                backwardImage: product.backwardImage,
                forwardImage: product.forwardImage
            });
        }
    }
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Titan+One&display=swap");
.artise_product_section {
    min-height: 490px;
    margin: 0px auto !important;
}
.prod-container {
    margin: 0px auto !important;
    text-align: center;
}
.card {
    padding: 0.75rem;
    /* margin: 0, 80rem; */
}
.prod-title {
    text-align: center;
    font-family: "Titan One", cursive;
}
.product-card__img {
    max-height: 250px;
}
.prod-link {
    color: rgb(252, 173, 0);
    text-align: center;
    border: none;
    background: none;
}
/* iPads (portrait) ----------- */
/* @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait) {
  .artise_product_section {
    height: 290px;
  }
} */
@media only screen and (max-width: 992px) {
    .artise_product_section {
        background-image: none !important;
    }
}
</style>
