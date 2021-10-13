<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <ViewProductsContainer />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import ViewProductsContainer from "../../widgets/admin_widgets/ViewProductsContainer";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
   name: "ViewProduct",
   components: {
      Header,
      Sidebar,
      ViewProductsContainer,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

<style>
</style>
