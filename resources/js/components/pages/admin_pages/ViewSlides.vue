<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <ViewSlidesContainer />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import ViewSlidesContainer from "../../widgets/admin_widgets/ViewSlidesContainer";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
   name: "ViewSlides",
   components: {
      Header,
      Sidebar,
      ViewSlidesContainer,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

<style>
</style>
