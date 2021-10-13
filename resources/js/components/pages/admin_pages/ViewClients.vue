<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <ViewClientsContainer />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import ViewClientsContainer from "../../widgets/admin_widgets/ViewClientsContainer";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
   name: "ViewOrders",
   components: {
      Header,
      Sidebar,
      ViewClientsContainer,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

<style>
</style>
