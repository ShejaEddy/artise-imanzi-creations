<template>
   <div class="sb-nav-fixed">
      <Header />
      <div id="layoutSidenav">
         <Sidebar />
         <div id="layoutSidenav_content">
            <ProfileContainer />
            <Footer />
         </div>
      </div>
   </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import ProfileContainer from "../../widgets/admin_widgets/ProfileContainer";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
   name: "Profile",
   components: {
      Header,
      Sidebar,
      ProfileContainer,
      Footer,
   },
};
</script>

<style>
</style>