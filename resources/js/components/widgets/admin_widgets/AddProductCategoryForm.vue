<template>
    <div class="container-fluid pb-5">
        <h1 class="mt-4">Add Product Category</h1>
        <ol class="admin-breadcrumb mb-4">
            <li class="admin-breadcrumb-item">
                <router-link to="/artist/dashboard">Dashboard</router-link>
            </li>
            <li class="admin-breadcrumb-item active">Add Category</li>
        </ol>
        <div class="card">
            <div class="card-header">
                <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                Add a Category
            </div>

            <div class="card-body">
                <transition name="slide-fade">
                    <div
                        class="alert"
                        :class="{
                            'alert-danger': !success,
                            'alert-success': success
                        }"
                        v-show="showMsg"
                    >
                        {{ message }}
                    </div>
                </transition>
                <div class="container">
                    <form
                        style="padding: 40px 60px"
                        @submit.prevent="addProductCategory"
                        enctype="multipart/form-data"
                    >
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="category">Name: </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="category"
                                    name="category"
                                    placeholder="Enter category name"
                                    v-model="category"
                                />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="category">Parent category: </label>
                                <select
                                    id="parent_category"
                                    name="parent_category"
                                    v-model="parent_category"
                                    class="form-control"
                                >
                                    <option value="0">None</option>
                                    <option
                                        :value="item.id"
                                        v-for="item in extractedCategories"
                                        :key="item.id"
                                    >
                                        <span
                                            v-if="
                                                item.parent_category == 'None'
                                            "
                                            >{{ item.name }}</span
                                        >
                                        <span v-else
                                            >{{ item.name }} -> (<b>Parent:</b>
                                            {{ item.parent_category }})</span
                                        >
                                    </option>
                                </select>
                            </div>
                        </div>

                        <button
                            type="submit"
                            class="btn btn-lg btn-primary col-md-12"
                            :disabled="loading"
                        >
                            Save
                            <div
                                v-if="loading"
                                class="spinner-border text-light ml-3"
                                role="status"
                            >
                                <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Multiselect from "vue-multiselect";
import { mapState, mapActions } from "vuex";
export default {
    name: "AddProductCategoryForm",
    components: { Multiselect },
    data() {
        return {
            category: "",
            parent_category: 0,
            message: "",
            success: "",
            showMsg: false,
            loading: false,
            categorySelected: "",
            parent_category_options: []
        };
    },
    computed: {
        ...mapState({
            categories: state => state.products.categories,
            extractedCategories: state => state.products.extractedCategories
        })
    },
    mounted() {
        this.loadExtractedCategories();
    },
    methods: {
        ...mapActions("products", ["get_extracted_categories"]),

        loadExtractedCategories() {
            this.get_extracted_categories();
        },

        addProductCategory() {
            this.loading = true;
            this.showMsg = false;
            let formData = new FormData();
            formData.append("name", this.category);
            formData.append("parent_category", this.parent_category);
            this.$store
                .dispatch("products/add_product_category", formData)
                .then(response => {
                    this.loading = false;
                    this.category = "";
                    this.success = true;
                    this.showMsg = true;
                    this.message = "Category Saved successfully!";
                    setTimeout(() => {
                        this.showMsg = false;
                    }, 3000);
                    console.log(response);
                })
                .catch(error => {
                    this.loading = false;
                    console.log(error);
                    console.log(error.response);
                    this.success = false;
                    this.message = `${error.response.data.message}`;
                    this.showMsg = true;
                });
        },
        addCategory(newCategory) {
            const category = {
                name: newCategory.name,
                code:
                    newCategory.substring(0, 2) +
                    Math.floor(Math.random() * 10000000)
            };
            this.categorySelected.push(category);
        },
        onFileChange(e) {
            const selected = e.target.files[0];
            const accepted = ["image/png", "image/jpeg"];

            if (selected && accepted.includes(selected.type)) {
                this.bg_image = selected;
            } else {
                const errorMsg = "Selected file is not an image type";
                this.message(errorMsg);
            }
        }
    }
};
</script>

<style scoped>
.slide-fade-enter-active {
    transition: all 0.8s ease;
}
.slide-fade-leave-active {
    transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter,
.slide-fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
}
.fade-enter-active {
    transition: all 0.5s ease;
}
.fade-leave-active {
    transition: all 0s cubic-bezier(1, 0, 0, 1);
}
.fade-enter,
.fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
}
</style>
