<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <ViewAdvertsContainer />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import ViewAdvertsContainer from "../../widgets/admin_widgets/ViewAdvertsContainer";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
   name: "ViewAdverts",
   components: {
      Header,
      Sidebar,
      ViewAdvertsContainer,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

<style>
</style>
