<template>
    <div class="sb-nav-fixed">
        <Header />
        <div id="layoutSidenav">
            <Sidebar />
            <div id="layoutSidenav_content">
                <SearchResultContainer />
                <Footer />
            </div>
        </div>
    </div>
</template>
<script>
import Header from "../../widgets/admin_widgets/Header";
import Sidebar from "../../widgets/admin_widgets/Sidebar";
import SearchResultContainer from "../../widgets/admin_widgets/SearchResultContainer";
import Footer from "../../widgets/admin_widgets/Footer";
export default {
    name: "SearchResults",
    components: {
        Header,
        Sidebar,
        SearchResultContainer,
        Footer
    },
    mounted() {
        window.scrollTo(0, 0);
    }
};
</script>
