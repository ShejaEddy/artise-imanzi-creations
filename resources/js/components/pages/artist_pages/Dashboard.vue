<template>
  <div class="sb-nav-fixed">
    <Header />
    <div id="layoutSidenav">
      <Sidebar/>
      <div id="layoutSidenav_content">
        <DashboardMainContainer/>
        <Footer />
      </div>
    </div>
  </div>
</template>
<script>
import Header from "../../widgets/artist_widgets/Header";
import Sidebar from "../../widgets/artist_widgets/Sidebar";
import DashboardMainContainer from "../../widgets/artist_widgets/DashboardMainContainer";
import Footer from "../../widgets/artist_widgets/Footer";
export default {
  name: "Home",
  components: {
    Header,
    Sidebar,
    DashboardMainContainer,
    Footer,
  },
  mounted () {
  window.scrollTo(0, 0);
  },
};
</script>

