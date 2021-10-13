<template>
  <div class="product_page">
    <CartDrawer />
    <div id="pageContainer">
      <Header />
      <ProductContainer />
      <Footer />
    </div>
  </div>
</template>

<script>
import CartDrawer from "../../widgets/public_widgets/CartDrawer";
import Header from "../../widgets/public_widgets/Header.vue";
import ProductContainer from "../../widgets/public_widgets/ProductContainer.vue";
import Footer from "../../widgets/public_widgets/Footer.vue";
export default {
  name: "Product",
  components: { CartDrawer, Header, ProductContainer, Footer },
  mounted() {
    window.scrollTo(0, 0);
  },
};
</script>

<style lang="css" scoped></style>
