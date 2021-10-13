<template>
    <!--Header-->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="#"
            ><img
                :src="`${baseUrl}/assets/images/logo/artise-logo.png`"
                class="dashboard_logo"
                alt="imanzi creations"
        /></a>
        <button
            class="btn btn-link btn-sm order-1 order-lg-0"
            id="sidebarToggle"
            @click="viewSiderbar"
            href="#"
        >
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Search-->
        <form
            class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"
            @submit.prevent="DashboardSearch()"
        >
            <div v-if="showSearch" class="input-group">
                <select
                    class="form-control col-md-4"
                    v-model="searchOpt"
                    @change="checkSearchOpt()"
                >
                    <option value="" selected>All</option>
                    <option value="products">Products</option>
                    <option value="categories">Categories</option>
                    <option value="artists">Artists</option>
                    <option value="buyers">Buyers</option>
                </select>
                <input
                    class="form-control"
                    type="text"
                    :placeholder="searchPlaceholder"
                    aria-label="Search"
                    aria-describedby="basic-addon2"
                    v-model="searchValue"
                    required
                />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <!-- Navbar-->
        <ul style="display: none" class="navbar-nav ml-auto ml-md-0">
            <li id="userDropdownLi" class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    id="userDropdown"
                    href="#"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    ><i class="fas fa-user fa-fw"></i
                ></a>
                <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="userDropdown"
                >
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </li>
        </ul>

        <div class="dropdown">
            <button @click="showUserDropdown()" class="dropbtn dropdown-toggle">
                <i style="color: #FBAD02" class="fas fa-user fa-fw mr-1"></i
                >{{ userInfo.names }}
            </button>
            <div id="myDropdown" class="dropdown-content">
                <a href="/"
                    ><i
                        style="color: #FBAD02"
                        class="fa fa-globe fa-fw mr-1"
                    ></i
                    >Visit Web</a
                >
                <a href="/artist/profile"
                    ><i style="color: #FBAD02" class="fa fa-user fa-fw mr-1"></i
                    >My Profile</a
                >
                <a href="#" @click="UserLogout()"
                    ><i
                        style="color: #FBAD02"
                        class="fa fa-sign-out-alt fa-fw mr-1"
                    ></i
                    >Logout</a
                >
            </div>
        </div>
    </nav>
    <!--Header-END-->
</template>

<script>
import { mapState } from "vuex";
export default {
    name: "Header",
    data() {
        return {
            showSearch: false,
            baseUrl: "",
            showFilter: false,
            searchOpt: "",
            searchValue: "",
            searchPlaceholder: "Search For..."
            // userInfo: JSON.parse(localStorage.getItem("userInfo")),
        };
    },
    computed: {
        ...mapState({
            userInfo: state => state.users.userInfo
        })
    },
    mounted() {
        this.generateBaseUrl();
    },
    methods: {
        checkSearchOpt() {
            if (this.searchOpt == "categories") {
                this.searchPlaceholder = "Search categories...";
            } else if (this.searchOpt == "products") {
                this.searchPlaceholder = "Search products...";
            } else if (this.searchOpt == "artists") {
                this.searchPlaceholder = "Search artists...";
            } else if (this.searchOpt == "buyers") {
                this.searchPlaceholder = "Search buyers...";
            }
        },
        DashboardSearch() {
            if (this.searchOpt == "") {
                this.searchOpt = "all";
            }
            window.location.href = `${this.baseUrl}/artist/search-results/${this.searchOpt}/${this.searchValue}`;
        },
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
        },
        UserLogout() {
            this.$store.dispatch("users/UserLogout").then(Response => {
                console.log(Response);
            });
        },
        viewSiderbar() {
            $("body").toggleClass("sb-sidenav-toggled");
        },
        removeSiderbar() {
            $("body").removeClass("sb-sidenav-toggled");
        },
        showUserDropdown() {
            document.getElementById("myDropdown").classList.toggle("show");
        },

        // Close the dropdown if the user clicks outside of it
        closeDropdowns() {
            if (!event.target.matches(".dropbtn")) {
                var dropdowns = document.getElementsByClassName(
                    "dropdown-content"
                );
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains("show")) {
                        openDropdown.classList.remove("show");
                    }
                }
            }
        }
    },

    mounted() {
        this.removeSiderbar();
        document.addEventListener("click", this.closeDropdowns);
        this.generateBaseUrl();
    },
    beforeDestroy() {
        document.removeEventListener("click", this.closeDropdowns);
    }
};
</script>

<style scoped>
/* Smartphone & kindle (portrait and landscape) ----------- */
.dashboard_logo {
    width: 155px !important;
}
@media only screen and (min-width: 320px) and (max-width: 700px) {
    .dashboard_logo {
        width: 100px !important;
    }
}
/* iPads (portrait and landscape) ----------- */
@media only screen and (min-width: 768px) and (max-width: 1024px) {
}
.dropbtn {
    background-color: #00000000;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropbtn:hover,
.dropbtn:focus {
    background-color: #00000000;
    border: none;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    right: 0;
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {
    background-color: #ddd;
}

.show {
    display: block;
}
</style>
