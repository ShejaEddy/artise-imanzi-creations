<template>
  <div class="account-page">
    <CartDrawer />
    <Header />
    <AuthForms />
    <Footer />
  </div>
</template>
<script>
import CartDrawer from "../../widgets/public_widgets/CartDrawer";
import Header from "../../widgets/public_widgets/Header";
import AuthForms from "../../widgets/public_widgets/AuthForms";
import Footer from "../../widgets/public_widgets/Footer";
export default {
  name: "Login",
  components: {
    CartDrawer,
    Header,
    AuthForms,
    Footer,

  },
  mounted () {
  window.scrollTo(0, 0);
  },
};
</script>
