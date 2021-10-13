<template>
   <div class="product_page">
      <CartDrawer />
      <div id="pageContainer">
         <Header />
         <SingleBlogContainer />
         <Footer />
      </div>
   </div>
</template>

<script>
import CartDrawer from "../../widgets/public_widgets/CartDrawer";
import Header from "../../widgets/public_widgets/Header.vue";
import SingleBlogContainer from "../../widgets/public_widgets/SingleBlogContainer.vue";
import Footer from "../../widgets/public_widgets/Footer.vue";
export default {
   name: "SingleBlog",
   components: { CartDrawer, Header, SingleBlogContainer, Footer },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

<style lang="css" scoped></style>
