<template>
   <div class="contact-us-page">
      <CartDrawer />
      <div id="pageContainer">
         <Header />
         <BlogContainer />
         <Footer />
      </div>
   </div>
</template>
<script>
import CartDrawer from "../../widgets/public_widgets/CartDrawer";
import Header from "../../widgets/public_widgets/Header";
import BlogContainer from "../../widgets/public_widgets/BlogContainer";
import Footer from "../../widgets/public_widgets/Footer";
export default {
   name: "ContactUs",
   components: {
      CartDrawer,
      Header,
      BlogContainer,
      Footer,
   },
   mounted () {
  window.scrollTo(0, 0);
  },
};
</script>
