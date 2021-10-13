<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <ViewReviewsContainer />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import ViewReviewsContainer from "../../widgets/admin_widgets/ViewReviewsContainer";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
   name: "ViewReviews",
   components: {
      Header,
      Sidebar,
      ViewReviewsContainer,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

<style>
</style>
