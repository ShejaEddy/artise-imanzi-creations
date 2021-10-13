<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <addProductTagForm />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/artist_widgets/Header";
import Sidebar from "../../widgets/artist_widgets/Sidebar";
import addProductTagForm from "../../widgets/artist_widgets/AddProductTagForm";
import Footer from "../../widgets/artist_widgets/Footer";
export default {
   name: "addProductTag",
   components: {
      Header,
      Sidebar,
      addProductTagForm,
      Footer,
   },
   mounted () {
  window.scrollTo(0, 0);
  },
};
</script>

<style>
</style>
