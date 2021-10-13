<template>
  <div class="cart-page">
    <CartDrawer />
    <div id="pageContainer">
      <Header />
      <main role="main" class="mainContent">
        <WishlistContainer />
      </main>
      <Footer />
    </div>
  </div>
</template>
<script>
import CartDrawer from "../../widgets/public_widgets/CartDrawer";
import Header from "../../widgets/public_widgets/Header";
import WishlistContainer from "../../widgets/public_widgets/WishlistContainer";
import Footer from "../../widgets/public_widgets/Footer";
export default {
  name: "Wishlist",
  components: {
    CartDrawer,
    Header,
    WishlistContainer,
    Footer,
  },
  mounted() {
    window.scrollTo(0, 0);
  },
};
</script>
