<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <ViewUsersContainer />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import ViewUsersContainer from "../../widgets/admin_widgets/ViewUsersContainer";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
   name: "ViewOrders",
   components: {
      Header,
      Sidebar,
      ViewUsersContainer,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

<style>
</style>
