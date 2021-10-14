<template>
    <div
        class="artise_product_section pl-5 pt-3"
        :class="`position-${position}`"
        v-bind:style="{
            'background-image': 'url(' + background + ')',
            'background-repeat': 'no-repeat',
            'background-size': 'cover'
        }"
    >
        <div class="col-md-3" v-if="position === 'Left'"></div>
        <div class="col-md-8 pl-5">
            <div class="prod-container padding">
                <div class="row">
                    <div class="col-md-12">
                        <div class="prod-title w-100">
                            <img
                                class="lazyload"
                                :src="`${baseUrl}/uploads/images/${title}`"
                            />
                        </div>
                    </div>
                    <div class="d-flex justify-content-center w-100">
                        <div
                            class="card d-flex flex-column justify-content-end px-4 mb-3"
                            :key="product.id"
                            v-for="product in products"
                        >
                            <div
                                class="prod-image px-3"
                                @click="addModal(product)"
                            >
                                <img
                                    class="product-card__img lazyload"
                                    :data-src="
                                        `${baseUrl}/uploads/images/${product.thumbnail}`
                                    "
                                />
                            </div>
                            <div class="prod-name text-uppercase">
                                <h6 class="mb-0">{{ product.name }}</h6>
                            </div>
                            <button
                                class="prod-link small "
                                @click="addModal(product)"
                                :href="product.link"
                            >
                                <u> Look inside</u>
                            </button>
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
    name: "ArtiseProducts",
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
        title: String,
        position: String
    },
    mounted() {
        this.generateBaseUrl();
    },
    methods: {
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
            this.image = this.baseUrl + "/assets/images/bgs/ndoli.png";
            this.imageUrl = this.baseUrl + "/assets/images/ndabaga.png";
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
    min-height: 500px;
    margin: 0px auto !important;
    background: #efefef;
}
.position-Right {
    background-position: right;
}
.position-Left {
    background-position: left;
}
.prod-container {
    margin: 0px auto !important;
    text-align: center;
}
.padding {
    padding-left: 1rem;
}
.card {
    padding: 1.75rem;
    width: 22.75rem;
    height: 265px;
    margin: 15px 30px;
    border-radius: 20px;
}
.prod-title img {
    width: 45%;
    max-height: 135px;
    margin: 10px auto;
    object-fit: contain;
}
.product-card__img {
    height: 160px;
    width: 100%;
    object-fit: cover;
    box-shadow: 0 3px 6px grey;
}
.prod-name h6 {
    width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    padding: 0 10px;
}
.prod-link {
    color: rgb(252, 173, 0);
    text-align: center;
    border: none;
    background: none;
}
/* iPads (portrait) ----------- */
@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait) {
    .artise_product_section {
        min-height: 290px;
    }
}

@media only screen and (max-width: 992px) {
    .artise_product_section {
        background-image: none !important;
    }
}
</style>
