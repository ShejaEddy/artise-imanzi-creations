<template>
  <div class="cart-page">
    <Header />
    <main role="main" class="mainContent">
      <CartContainer />
    </main>
    <Footer />
  </div>
</template>
<script>
import Header from "../../widgets/public_widgets/Header";
import CartContainer from "../../widgets/public_widgets/CartContainer";
import Footer from "../../widgets/public_widgets/Footer";
export default {
  name: "Cart",
  components: {
    Header,
    CartContainer,
    Footer,
  },
  mounted () {
  window.scrollTo(0, 0);
  },
};
</script>
