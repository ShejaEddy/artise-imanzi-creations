<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <ViewProductCategoriesContainer />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/artist_widgets/Header";
import Sidebar from "../../widgets/artist_widgets/Sidebar";
import ViewProductCategoriesContainer from "../../widgets/artist_widgets/ViewProductCategoriesContainer";
import Footer from "../../widgets/artist_widgets/Footer";
export default {
   name: "ViewProductCategories",
   components: {
      Header,
      Sidebar,
      ViewProductCategoriesContainer,
      Footer,
   },
   mounted () {
  window.scrollTo(0, 0);
  },
};
</script>

<style>
</style>
