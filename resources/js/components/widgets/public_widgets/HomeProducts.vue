<template>
    <div>
        <div :key="category.id" v-for="category in categories">
            <div v-if="category.bg_image_direction === 'Right'">
                <ArtiseProducts
                    :title="category.name"
                    :products="category.products"
                    :background="`${baseUrl}/storage/${category.bg_image}`"
                />
            </div>
            <div v-else-if="category.bg_image_direction === 'Left'">
                <ArtiseProducts2
                    :title="category.name"
                    :products="category.products"
                    :background="`${baseUrl}/storage/${category.bg_image}`"
                />
            </div>
        </div>
    </div>
</template>

<script>
import ArtiseProducts from "./ArtiseProducts.vue";
import ArtiseProducts2 from "./ArtiseProducts2.vue";
export default {
    name: "HomeProducts",
    data() {
        return {
            categories: [],
            // company_products: [],
            baseUrl: ""
        };
    },
    components: {
        ArtiseProducts,
        ArtiseProducts2
    },
    mounted() {
        this.get_categories();
        this.generateBaseUrl();
    },

    methods: {
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
            this.image = this.baseUrl + "/assets/images/bgs/ngunda.png";
            this.imageUrl = this.baseUrl + "/assets/images/ngunda-novel.png";
        },

        async get_categories() {
            let company_categories = await axios.get(
                "/api/get-company-categories"
            );
            let company_products = await axios.get("/api/get-company-products");
            let all_categories = [];
            company_categories.data.map(category => {
                category.products = company_products.data
                    .filter(product => product.categoryId == category.id)
                    .slice(0, 3);
                all_categories.push(category);
            });
            this.categories = all_categories;
            console.log("===c categories==>", all_categories);
        }
    }
};
</script>
