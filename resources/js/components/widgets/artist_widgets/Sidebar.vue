<template>
  <!--Sidebar-->
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <div class="sb-sidenav-menu-heading">Core</div>
          <router-link class="nav-link" to="/artist/dashboard">
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
              <router-link class="nav-link" to="/artist/add-product"
                >Add Products</router-link
              >
              <router-link class="nav-link" to="/artist/view-products"
                >View Products</router-link
              >
            </nav>
          </div>
          <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseOrders"
            aria-expanded="false"
            aria-controls="collapsePages"
          >
            <div class="sb-nav-link-icon">
              <i class="fa fa-shopping-basket"></i>
            </div>
            Orders
            <div class="sb-sidenav-collapse-arrow">
              <i class="fas fa-angle-down"></i>
            </div>
          </a>
          <div
            class="collapse"
            id="collapseOrders"
            aria-labelledby="headingTwo"
            data-parent="#sidenavAccordion"
          >
            <nav
              class="sb-sidenav-menu-nested nav accordion"
              id="sidenavAccordionPages"
            >
              <router-link class="nav-link" to="/artist/view-orders"
                >View My Orders</router-link
              >
              <router-link class="nav-link" to="/artist/view-product-orders"
                >View Product Orders</router-link
              >
            </nav>
          </div>
          <!-- <a
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
                        to="/artist/add-product-category"
                        >Add Categories</router-link
                     >
                     <router-link
                        class="nav-link"
                        to="/artist/view-product-categories"
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
                     <router-link class="nav-link" to="/artist/add-product-tag"
                        >Add Tags</router-link
                     >
                     <router-link
                        class="nav-link"
                        to="/artist/view-product-tags"
                        >View Tags</router-link
                     >
                  </nav>
               </div> -->
          <router-link class="nav-link" to="/artist/view-earnings">
            <div class="sb-nav-link-icon">
              <i class="fas fa-credit-card"></i>
            </div>
            Earnings
          </router-link>

          <div class="sb-sidenav-menu-heading">Account</div>
          <a class="nav-link" href="javascript:void(0)" @click="UserLogout()">
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
      user: (state) => state.users.userInfo,
    }),
  },
  methods: {
    UserLogout() {
      this.$store.dispatch("users/UserLogout").then((Response) => {
        console.log(Response);
      });
    },
  },
};
</script>
