<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <AddAdvertForm />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import AddAdvertForm from "../../widgets/admin_widgets/AddAdvertForm";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
   name: "AddAdverts",
   components: {
      Header,
      Sidebar,
      AddAdvertForm,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

<style>
</style>
