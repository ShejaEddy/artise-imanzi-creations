<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <ViewProductOrdersContainer />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/artist_widgets/Header";
import Sidebar from "../../widgets/artist_widgets/Sidebar";
import ViewProductOrdersContainer from "../../widgets/artist_widgets/ViewProductOrdersContainer";
import Footer from "../../widgets/artist_widgets/Footer";
export default {
   name: "ViewOrders",
   components: {
      Header,
      Sidebar,
      ViewProductOrdersContainer,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

<style>
</style>
