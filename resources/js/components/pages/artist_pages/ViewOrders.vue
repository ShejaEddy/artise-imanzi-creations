<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <ViewOrdersContainer />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/artist_widgets/Header";
import Sidebar from "../../widgets/artist_widgets/Sidebar";
import ViewOrdersContainer from "../../widgets/artist_widgets/ViewOrdersContainer";
import Footer from "../../widgets/artist_widgets/Footer";
export default {
   name: "ViewOrders",
   components: {
      Header,
      Sidebar,
      ViewOrdersContainer,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

<style>
</style>
