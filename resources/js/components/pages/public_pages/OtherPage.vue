<template>
  <div class="contact-us-page">
    <CartDrawer />
    <div id="pageContainer">
      <Header />
      <OtherPageContainer />
      <Footer />
    </div>
  </div>
</template>
<script>
import CartDrawer from "../../widgets/public_widgets/CartDrawer";
import Header from "../../widgets/public_widgets/Header";
import OtherPageContainer from "../../widgets/public_widgets/OtherPageContainer";
import Footer from "../../widgets/public_widgets/Footer";
export default {
  name: "ContactUs",
  components: {
    CartDrawer,
    Header,
    OtherPageContainer,
    Footer,
  },
  mounted() {
    window.scrollTo(0, 0);
  },
};
</script>
