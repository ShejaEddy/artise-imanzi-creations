<template>
    <div class="product_page">
        <CartDrawer />
        <div id="pageContainer">
            <Header />
            <GoogleAuthorization />
            <Footer />
        </div>
    </div>
</template>

<script>
import CartDrawer from "../../widgets/public_widgets/CartDrawer";
import Header from "../../widgets/public_widgets/Header.vue";
import GoogleAuthorization from "../../widgets/public_widgets/GoogleAuthorization.vue";
import Footer from "../../widgets/public_widgets/Footer.vue";
export default {
    name: "GoogleAuthorizationPage",
    components: { CartDrawer, Header, GoogleAuthorization, Footer },
    mounted() {
        window.scrollTo(0, 0);
    }
};
</script>

<style lang="css" scoped></style>
