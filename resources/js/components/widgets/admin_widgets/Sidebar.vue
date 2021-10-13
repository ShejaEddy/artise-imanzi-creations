<template>
    <!--Sidebar-->
    <div id="layoutSidenav_nav">
        <nav
            class="sb-sidenav accordion sb-sidenav-light"
            id="sidenavAccordion"
        >
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <router-link class="nav-link" to="/admin/dashboard">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        Dashboard
                    </router-link>
                    <div class="sb-sidenav-menu-heading">Activities</div>
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseartist"
                        aria-expanded="false"
                        aria-controls="collapsePages"
                    >
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        Artists
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div
                        class="collapse"
                        id="collapseartist"
                        aria-labelledby="headingOne"
                        data-parent="#sidenavAccordion"
                    >
                        <nav class="sb-sidenav-menu-nested nav">
                            <router-link class="nav-link" to="/admin/add-artist"
                                >Add Artist</router-link
                            >
                            <router-link
                                class="nav-link"
                                to="/admin/view-artists"
                                >View Artists</router-link
                            >
                        </nav>
                    </div>

                    <router-link
                        class="nav-link collapsed"
                        to="/admin/view-clients"
                    >
                        <div class="sb-nav-link-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        Clients
                    </router-link>

                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseProducts"
                        aria-expanded="false"
                        aria-controls="collapseLayouts"
                    >
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-columns"></i>
                        </div>
                        Products
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div
                        class="collapse"
                        id="collapseProducts"
                        aria-labelledby="headingOne"
                        data-parent="#sidenavAccordion"
                    >
                        <nav class="sb-sidenav-menu-nested nav">
                            <router-link
                                class="nav-link"
                                to="/admin/add-product"
                                >Add Products</router-link
                            >
                            <router-link
                                class="nav-link"
                                to="/admin/view-products"
                                >View Products</router-link
                            >
                        </nav>
                    </div>
                    <router-link
                        class="nav-link collapsed"
                        to="/admin/view-orders"
                    >
                        <div class="sb-nav-link-icon">
                            <i class="fa fa-shopping-basket"></i>
                        </div>
                        Orders
                    </router-link>
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseCategories"
                        aria-expanded="false"
                        aria-controls="collapsePages"
                    >
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-list-alt"></i>
                        </div>
                        Categories
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div
                        class="collapse"
                        id="collapseCategories"
                        aria-labelledby="headingTwo"
                        data-parent="#sidenavAccordion"
                    >
                        <nav
                            class="sb-sidenav-menu-nested nav accordion"
                            id="sidenavAccordionPages"
                        >
                            <router-link
                                class="nav-link"
                                to="/admin/add-product-category"
                                >Add Categories</router-link
                            >
                            <router-link
                                class="nav-link"
                                to="/admin/view-product-categories"
                                >View Categories</router-link
                            >
                        </nav>
                    </div>
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseOtherCategories"
                        aria-expanded="false"
                        aria-controls="collapsePages"
                    >
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-list-alt"></i>
                        </div>
                        Other Categories
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div
                        class="collapse"
                        id="collapseOtherCategories"
                        aria-labelledby="headingTwo"
                        data-parent="#sidenavAccordion"
                    >
                        <nav
                            class="sb-sidenav-menu-nested nav accordion"
                            id="sidenavAccordionPages"
                        >
                            <router-link
                                class="nav-link"
                                to="/admin/add-company-category"
                                >Add Categories</router-link
                            >
                            <router-link
                                class="nav-link"
                                to="/admin/view-company-categories"
                                >View Categories</router-link
                            >
                        </nav>
                    </div>
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseTags"
                        aria-expanded="false"
                        aria-controls="collapsePages"
                    >
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        Tags
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div
                        class="collapse"
                        id="collapseTags"
                        aria-labelledby="headingTwo"
                        data-parent="#sidenavAccordion"
                    >
                        <nav
                            class="sb-sidenav-menu-nested nav accordion"
                            id="sidenavAccordionPages"
                        >
                            <router-link
                                class="nav-link"
                                to="/admin/add-product-tag"
                                >Add Tags</router-link
                            >
                            <router-link
                                class="nav-link"
                                to="/admin/view-product-tags"
                                >View Tags</router-link
                            >
                        </nav>
                    </div>
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseBlog"
                        aria-expanded="false"
                        aria-controls="collapsePages"
                    >
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        Blog
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div
                        class="collapse"
                        id="collapseBlog"
                        aria-labelledby="headingTwo"
                        data-parent="#sidenavAccordion"
                    >
                        <nav
                            class="sb-sidenav-menu-nested nav accordion"
                            id="sidenavAccordionPages"
                        >
                            <router-link class="nav-link" to="/admin/add-post"
                                >Add post</router-link
                            >
                            <router-link class="nav-link" to="/admin/view-posts"
                                >View Posts</router-link
                            >
                        </nav>
                    </div>
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseSlider"
                        aria-expanded="false"
                        aria-controls="collapsePages"
                    >
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        Web Slider
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div
                        class="collapse"
                        id="collapseSlider"
                        aria-labelledby="headingTwo"
                        data-parent="#sidenavAccordion"
                    >
                        <nav
                            class="sb-sidenav-menu-nested nav accordion"
                            id="sidenavAccordionPages"
                        >
                            <router-link class="nav-link" to="/admin/add-slide"
                                >Add Slide</router-link
                            >
                            <router-link
                                class="nav-link"
                                to="/admin/view-slides"
                                >View Slides</router-link
                            >
                        </nav>
                    </div>

                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseAds"
                        aria-expanded="false"
                        aria-controls="collapsePages"
                    >
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        Web Ads
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div
                        class="collapse"
                        id="collapseAds"
                        aria-labelledby="headingTwo"
                        data-parent="#sidenavAccordion"
                    >
                        <nav
                            class="sb-sidenav-menu-nested nav accordion"
                            id="sidenavAccordionPages"
                        >
                            <router-link class="nav-link" to="/admin/add-advert"
                                >Add Advert</router-link
                            >
                            <router-link
                                class="nav-link"
                                to="/admin/view-adverts"
                                >View Adverts</router-link
                            >
                        </nav>
                    </div>

                    <router-link class="nav-link" to="/admin/view-pages">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-columns"></i>
                        </div>
                        Other Pages
                    </router-link>

                    <router-link class="nav-link" to="/admin/view-earnings">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        Earnings
                    </router-link>
                    <router-link class="nav-link" to="/admin/view-reviews">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        Reviews
                    </router-link>

                    <div class="sb-sidenav-menu-heading">Account</div>
                    <a
                        class="nav-link"
                        href="javascript:void(0)"
                        @click="UserLogout()"
                    >
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        Logout
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <div class="small text-primary">
                    <strong
                        >{{ user.names }} (<i>{{ user.role }}</i
                        >)</strong
                    >
                </div>
            </div>
        </nav>
    </div>
    <!--Sidebar-END-->
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
    name: "Sidebar",
    data() {
        return {};
    },
    computed: {
        ...mapState({
            user: state => state.users.userInfo
        })
    },
    methods: {
        UserLogout() {
            this.$store.dispatch("users/UserLogout").then(Response => {
                console.log(Response);
            });
        }
    }
};
</script>
