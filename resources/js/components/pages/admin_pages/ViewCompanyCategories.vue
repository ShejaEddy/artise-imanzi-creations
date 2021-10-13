<template>
    <div class="sb-nav-fixed">
        <Header />
        <div id="layoutSidenav">
            <Sidebar />
            <div id="layoutSidenav_content">
                <ViewCompanyCategories />
                <Footer />
            </div>
        </div>
    </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import ViewCompanyCategories from "../../widgets/admin_widgets/ViewCompanyCategories";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
    name: "ViewCompanyCategoriesPage",
    components: {
        Header,
        Sidebar,
        ViewCompanyCategories,
        Footer
    },
    mounted() {
        window.scrollTo(0, 0);
    }
};
</script>

<style></style>
