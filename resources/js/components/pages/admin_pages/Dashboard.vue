<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <DashboardMainContainer />
            <Footer />
         </div>
      </div>
   </div>
</template>
<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import DashboardMainContainer from "../../widgets/admin_widgets/DashboardMainContainer";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
   name: "Home",
   components: {
      Header,
      Sidebar,
      DashboardMainContainer,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

