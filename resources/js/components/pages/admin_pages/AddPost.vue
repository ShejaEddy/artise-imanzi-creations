<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <AddPostForm />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import AddPostForm from "../../widgets/admin_widgets/AddPostForm";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
   name: "AddPost",
   components: {
      Header,
      Sidebar,
      AddPostForm,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

<style>
</style>
