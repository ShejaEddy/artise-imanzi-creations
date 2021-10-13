<template>
  <div class="sb-nav-fixed">
    <Header />
    <div id="layoutSidenav">
      <Sidebar />
      <div id="layoutSidenav_content">
        <EditSlideForm />
        <Footer />
      </div>
    </div>
  </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import EditSlideForm from "../../widgets/admin_widgets/EditSlideForm";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
  name: "EditSlide",
  components: {
    Header,
    Sidebar,
    EditSlideForm,
    Footer,
  },
  mounted() {
    window.scrollTo(0, 0);
  },
};
</script>

<style></style>
