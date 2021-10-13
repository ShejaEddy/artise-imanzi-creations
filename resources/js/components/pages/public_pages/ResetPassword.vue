<template>
  <div class="account-page">
    <CartDrawer />
    <Header />
    <ResetPasswordForm />
    <Footer />
  </div>
</template>
<script>
import CartDrawer from "../../widgets/public_widgets/CartDrawer";
import Header from "../../widgets/public_widgets/Header";
import ResetPasswordForm from "../../widgets/public_widgets/ResetPasswordForm";
import Footer from "../../widgets/public_widgets/Footer";
export default {
  name: "Login",
  components: {
    CartDrawer,
    Header,
    ResetPasswordForm,
    Footer,
  },
  mounted() {
    window.scrollTo(0, 0);
  },
};
</script>
