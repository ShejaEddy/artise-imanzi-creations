<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <AddSlideForm />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import AddSlideForm from "../../widgets/admin_widgets/AddSlideForm";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
   name: "AddSlide",
   components: {
      Header,
      Sidebar,
      AddSlideForm,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

<style>
</style>
