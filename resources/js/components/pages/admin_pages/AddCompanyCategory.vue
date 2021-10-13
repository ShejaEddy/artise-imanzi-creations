<template>
    <div class="sb-nav-fixed">
        <Header />
        <div id="layoutSidenav">
            <Sidebar />
            <div id="layoutSidenav_content">
                <AddCompanyCategory />
                <Footer />
            </div>
        </div>
    </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import AddCompanyCategory from "../../widgets/admin_widgets/AddCompanyCategory.vue";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
    name: "AddCompanyCategoryPage",
    components: {
        Header,
        Sidebar,
        AddCompanyCategory,
        Footer
    },
    mounted() {
        window.scrollTo(0, 0);
    }
};
</script>

<style></style>
