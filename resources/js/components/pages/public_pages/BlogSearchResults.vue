<template>
  <div class="contact-us-page">
    <CartDrawer />
    <div id="pageContainer">
      <Header />
      <BlogSearchResultsContainer />
      <Footer />
    </div>
  </div>
</template>
<script>
import CartDrawer from "../../widgets/public_widgets/CartDrawer";
import Header from "../../widgets/public_widgets/Header";
import BlogSearchResultsContainer from "../../widgets/public_widgets/BlogSearchResultsContainer";
import Footer from "../../widgets/public_widgets/Footer";
export default {
  name: "ContactUs",
  components: {
    CartDrawer,
    Header,
    BlogSearchResultsContainer,
    Footer,
  },
  mounted() {
    window.scrollTo(0, 0);
  },
};
</script>
