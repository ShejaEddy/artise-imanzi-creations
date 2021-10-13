<template>
    <div class="sb-nav-fixed">
        <Header />
        <div id="layoutSidenav">
            <Sidebar />
            <div id="layoutSidenav_content">
                <ViewClientGiveAways />
                <Footer />
            </div>
        </div>
    </div>
</template>

<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import ViewClientGiveAways from "../../widgets/admin_widgets/ViewClientGiveAways";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
    name: "ViewClientGiveAwaysPage",
    components: {
        Header,
        Sidebar,
        ViewClientGiveAways,
        Footer
    },
    mounted() {
        window.scrollTo(0, 0);
    }
};
</script>

<style></style>
