<template>
   <div class="contact-us-page">
      <CartDrawer />
      <div id="pageContainer">
         <Header />
         <ContactUsForm />
         <Footer />
      </div>
   </div>
</template>
<script>
import CartDrawer from "../../widgets/public_widgets/CartDrawer";
import Header from "../../widgets/public_widgets/Header";
import ContactUsForm from "../../widgets/public_widgets/ContactUsForm";
import Footer from "../../widgets/public_widgets/Footer";
export default {
   name: "ContactUs",
   components: {
      CartDrawer,
      Header,
      ContactUsForm,
      Footer,
   },
   mounted () {
  window.scrollTo(0, 0);
  },
};
</script>
