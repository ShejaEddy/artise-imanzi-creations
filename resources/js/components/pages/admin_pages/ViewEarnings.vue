<template>
  <div class="sb-nav-fixed">
    <Header />
    <div id="layoutSidenav">
      <Sidebar />
      <div id="layoutSidenav_content">
        <ViewEarningsContainer />
        <Footer />
      </div>
    </div>
  </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import ViewEarningsContainer from "../../widgets/admin_widgets/ViewEarningsContainer";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
  name: "ViewEarnings",
  components: {
    Header,
    Sidebar,
    ViewEarningsContainer,
    Footer,
  },
  mounted() {
    window.scrollTo(0, 0);
  },
};
</script>

<style></style>
