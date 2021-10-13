<template>
    <div class="contact-us-page">
        <CartDrawer />
        <div id="pageContainer">
            <Header />
            <SearchResultsContainer />
            <Footer />
        </div>
    </div>
</template>
<script>
import CartDrawer from "../../widgets/public_widgets/CartDrawer";
import Header from "../../widgets/public_widgets/Header";
import SearchResultsContainer from "../../widgets/public_widgets/SearchResultsContainer";
import Footer from "../../widgets/public_widgets/Footer";
export default {
    name: "ContactUs",
    components: {
        CartDrawer,
        Header,
        SearchResultsContainer,
        Footer
    },
    mounted() {
        window.scrollTo(0, 0);
    }
};
</script>
