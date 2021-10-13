<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <AddProductsForm />
            <Footer />
         </div>
      </div>
   </div>
</template>
<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import AddProductsForm from "../../widgets/admin_widgets/AddProductsForm";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
   name: "AddProducts",
   components: {
      Header,
      Sidebar,
      AddProductsForm,
      Footer,
   },
   mounted() {
      window.scrollTo(0, 0);
   },
};
</script>

