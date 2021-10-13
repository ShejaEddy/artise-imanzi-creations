<template>
  <!--Sidebar-->
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <div class="sb-sidenav-menu-heading">Core</div>
          <router-link class="nav-link" to="/buyer/orders">
            <div class="sb-nav-link-icon">
              <i class="fa fa-shopping-basket"></i>
            </div>
            My Orders
          </router-link>

          <div class="sb-sidenav-menu-heading">Account</div>
          <router-link class="nav-link" to="/buyer/profile">
            <div class="sb-nav-link-icon">
              <i class="fas fa-user"></i>
            </div>
            Profile
          </router-link>
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
