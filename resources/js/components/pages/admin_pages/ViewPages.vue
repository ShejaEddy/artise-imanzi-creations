<template>
  <div class="sb-nav-fixed">
    <Header />
    <div id="layoutSidenav">
      <Sidebar />
      <div id="layoutSidenav_content">
        <ViewPageContainer />
        <Footer />
      </div>
    </div>
  </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import ViewPageContainer from "../../widgets/admin_widgets/ViewPageContainer";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
  name: "ViewSlides",
  components: {
    Header,
    Sidebar,
    ViewPageContainer,
    Footer,
  },
  mounted() {
    window.scrollTo(0, 0);
  },
};
</script>

<style></style>
