<template>
    <div class="App">
        <transition name="fade">
            <router-view />
        </transition>
    </div>
</template>
<script>
export default {
    name: "App",
    data() {
        return {};
    },
    created() {
        this.$store.dispatch("products/getCart");
        this.$store.dispatch("products/get_product_categories");
        this.$store.dispatch("products/get_product_tags");
        this.$store.dispatch("products/get_products");
        this.$store.dispatch("products/get_shop_products");
        this.$store.dispatch("users/getUserOrders");
        this.$store.dispatch("users/getMyOrders");
        this.$store.dispatch("users/getUserProductOrders");
        this.$store.dispatch("users/getOrderDetails");
    }
};
</script>
<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
}
</style>
