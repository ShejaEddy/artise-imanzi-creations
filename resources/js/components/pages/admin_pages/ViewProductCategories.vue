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
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import ViewProductCategoriesContainer from "../../widgets/admin_widgets/ViewProductCategoriesContainer";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
   name: "ViewProductCategories",
   components: {
      Header,
      Sidebar,
      ViewProductCategoriesContainer,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

<style>
</style>
