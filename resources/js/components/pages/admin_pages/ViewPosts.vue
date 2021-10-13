<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <ViewPostsContainer />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import ViewPostsContainer from "../../widgets/admin_widgets/ViewPostsContainer";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
   name: "ViewPosts",
   components: {
      Header,
      Sidebar,
      ViewPostsContainer,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

<style>
</style>
