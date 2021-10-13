<template>
    <div class="home-page">
        <CartDrawer />
        <div id="pageContainer">
            <Header />
            <main class="mainContent" role="main">
                <!-- <HomeTopSliderContainer /> -->
                <!-- <ArtiseProducts /> -->
                <HomeProducts />
                <!-- <TrendingProductsContainer /> -->

                <!-- <BestartistProductContainer /> -->
                <!-- <ArtiseProducts2 /> -->
                <!-- <ArtiseProducts3 /> -->
                <!-- <NewsLetterContainer /> -->
                <HomeAdvertContainer />
                <TermsAndConditionContainer />
                <HomeBlogContainer />
                <ModelRoot />
            </main>
            <Footer />
        </div>
    </div>
</template>
<script>
import Header from "../../widgets/public_widgets/Header";
import CartDrawer from "../../widgets/public_widgets/CartDrawer";
import HomeTopSliderContainer from "../../widgets/public_widgets/HomeTopSliderContainer";
// import ArtiseProducts from "../../widgets/public_widgets/ArtiseProducts";
// import ArtiseProducts2 from "../../widgets/public_widgets/ArtiseProducts2";
import HomeProducts from "../../widgets/public_widgets/HomeProducts.vue";
import TrendingProductsContainer from "../../widgets/public_widgets/TrendingProductsContainer";
import HomeAdvertContainer from "../../widgets/public_widgets/HomeAdvertContainer";
import NewsLetterContainer from "../../widgets/public_widgets/NewsLetterContainer";
import BestartistProductContainer from "../../widgets/public_widgets/BestartistProductContainer";
import TermsAndConditionContainer from "../../widgets/public_widgets/TermsAndConditionContainer";
import HomeBlogContainer from "../../widgets/public_widgets/HomeBlogContainer";
import Footer from "../../widgets/public_widgets/Footer";
import ModelRoot from "../../modelComponents/ModelRoot.vue";
import GiveAwayModel from "../../modelComponents/GiveAwayModel.vue";
import ModelService from "../../modelComponents/model.service";
export default {
    name: "Home",
    data() {
        return {
            giveAway: null
        };
    },
    components: {
        CartDrawer,
        Header,
        HomeTopSliderContainer,
        HomeProducts,
        TrendingProductsContainer,
        HomeAdvertContainer,
        NewsLetterContainer,
        BestartistProductContainer,
        TermsAndConditionContainer,
        HomeBlogContainer,
        Footer,
        ModelRoot
    },
    mounted() {
        window.scrollTo(0, 0);
        // this.addModal();
        this.getGiveAway();
    },
    methods: {
        addModal() {
            ModelService.open(GiveAwayModel);
        },
        async getGiveAway() {
            console.log("CALLED NOW");
            this.giveAway = await this.$store.dispatch(
                "products/get_give_away"
            );
            console.log("HERERERERE", this.giveAway);
            if (this.giveAway) {
                this.addModal();
                console.log("HERERERERERERERERE");
            }
        }
    }
};
</script>
