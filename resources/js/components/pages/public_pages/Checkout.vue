<template>
   <div class="checkout-page">
      <!-- <Header /> -->
      <CheckoutContainer />
      <!-- <Footer /> -->
   </div>
</template>
<script>
import Header from "../../widgets/public_widgets/Header";
import CheckoutContainer from "../../widgets/public_widgets/CheckoutContainer";
import Footer from "../../widgets/public_widgets/Footer";
export default {
   name: "Checkout",
   components: {
      Header,
      CheckoutContainer,
      Footer,
   },
   mounted () {
  window.scrollTo(0, 0);
  },
};
</script>
