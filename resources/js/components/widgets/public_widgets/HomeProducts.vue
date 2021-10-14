<template>
    <div>
        <div :key="category.id" v-for="category in categories">
            <ArtiseProducts
                :title="category.title_image"
                :products="category.products"
                :background="`${baseUrl}/uploads/images/${category.bg_image}`"
                :position="category.bg_image_direction"
            />
            <br />
        </div>
    </div>
</template>

<script>
import ArtiseProducts from "./ArtiseProducts.vue";
export default {
    name: "HomeProducts",
    data() {
        return {
            categories: [],
            imageUrl: null,
            image: null,
            baseUrl: ""
        };
    },
    components: {
        ArtiseProducts
    },
    mounted() {
        this.get_categories();
        this.generateBaseUrl();
    },

    methods: {
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
            this.image = this.baseUrl + "/assets/images/bgs/ndoli.png";
            this.imageUrl = this.baseUrl + "/assets/images/ngunda-novel.png";
        },

        async get_categories() {
            let company_categories = await axios.get(
                "/api/get-company-categories"
            );

            this.categories = company_categories.data;
        }
    }
};
</script>
