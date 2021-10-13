<template>
   <div class="collections_page">
      <CartDrawer />
      <div id="pageContainer">
         <Header />
         <FreeProductsContainer />
         <Footer />
      </div>
   </div>
</template>

<script>
import CartDrawer from "../../widgets/public_widgets/CartDrawer";
import Header from "../../widgets/public_widgets/Header";
import FreeProductsContainer from "../../widgets/public_widgets/FreeProductsContainer";
import Footer from "../../widgets/public_widgets/Footer";
export default {
   name: "Collections",
   components: { CartDrawer, Header, FreeProductsContainer, Footer },
   mounted () {
  window.scrollTo(0, 0);
  },
};
</script>

<style lang="css" scoped></style>
