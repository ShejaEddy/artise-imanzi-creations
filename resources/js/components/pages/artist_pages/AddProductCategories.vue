<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <AddProductCategoryForm />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/artist_widgets/Header";
import Sidebar from "../../widgets/artist_widgets/Sidebar";
import AddProductCategoryForm from "../../widgets/artist_widgets/AddProductCategoryForm";
import Footer from "../../widgets/artist_widgets/Footer";
export default {
   name: "AddProductCategory",
   components: {
      Header,
      Sidebar,
      AddProductCategoryForm,
      Footer,
   },
   mounted () {
  window.scrollTo(0, 0);
  },
};
</script>

<style>
</style>
