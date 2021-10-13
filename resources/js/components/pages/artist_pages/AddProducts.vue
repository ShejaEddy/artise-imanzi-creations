<template>
  <div class="sb-nav-fixed">
    <Header />
    <div id="layoutSidenav">
      <Sidebar/>
      <div id="layoutSidenav_content">
        <AddProductsForm/>
        <Footer />
      </div>
    </div>
  </div>
</template>
<script>
import Header from "../../widgets/artist_widgets/Header";
import Sidebar from "../../widgets/artist_widgets/Sidebar";
import AddProductsForm from "../../widgets/artist_widgets/AddProductsForm";
import Footer from "../../widgets/artist_widgets/Footer";
export default {
  name: "AddProducts",
  components: {
    Header,
    Sidebar,
    AddProductsForm,
    Footer,
  },
  mounted () {
  window.scrollTo(0, 0);
  },
};
</script>

