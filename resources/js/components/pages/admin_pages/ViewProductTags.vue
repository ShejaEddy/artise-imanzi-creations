<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <ViewProductTagsContainer />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import ViewProductTagsContainer from "../../widgets/admin_widgets/ViewProductTagsContainer";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
   name: "ViewProductAgs",
   components: {
      Header,
      Sidebar,
      ViewProductTagsContainer,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

<style>
</style>
