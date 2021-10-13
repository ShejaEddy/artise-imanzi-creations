<template>
   <div class="collections_page">
      <CartDrawer />
      <div id="pageContainer">
         <Header />
         <ShopContainer />
         <Footer />
      </div>
   </div>
</template>

<script>
import CartDrawer from "../../widgets/public_widgets/CartDrawer";
import Header from "../../widgets/public_widgets/Header";
import ShopContainer from "../../widgets/public_widgets/ShopContainer";
import Footer from "../../widgets/public_widgets/Footer";
export default {
   name: "Collections",
   components: { CartDrawer, Header, ShopContainer, Footer },
   mounted () {
  window.scrollTo(0, 0);
  },
};
</script>

<style lang="css" scoped></style>
