import Vue from "vue";
import VueRouter from "vue-router";

//PUBLIC ROUTES
import Home from "./components/pages/public_pages/Home";
import Cart from "./components/pages/public_pages/Cart";
import Wishlist from "./components/pages/public_pages/Wishlist";
import Checkout from "./components/pages/public_pages/Checkout";
import ContactUs from "./components/pages/public_pages/ContactUs";
import Shop from "./components/pages/public_pages/Shop";
import FreeProducts from "./components/pages/public_pages/FreeProducts";
import Product from "./components/pages/public_pages/Product";
import Account from "./components/pages/public_pages/Account";
import Blog from "./components/pages/public_pages/Blog";
import SingleBlog from "./components/pages/public_pages/SingleBlog";
import BlogSearchResults from "./components/pages/public_pages/BlogSearchResults";
import DownloadBook from "./components/pages/public_pages/DownloadBook";
import ResetPassword from "./components/pages/public_pages/ResetPassword";
import GoogleAuthorizationPage from "./components/pages/public_pages/GoogleAuthorizationPage";
import OtherPage from "./components/pages/public_pages/OtherPage";
import SearchResults from "./components/pages/public_pages/SearchResults";
// PUBLIC ROUTES--END

// artist ROUTERS
import artistDashboard from "./components/pages/artist_pages/Dashboard";
import artistAddProducts from "./components/pages/artist_pages/AddProducts";
import artistAddProductCategories from "./components/pages/artist_pages/AddProductCategories";
import artistAddProductTags from "./components/pages/artist_pages/AddProductTags";
// import artistEditProduct from "./components/pages/artist_pages/EditProduct";
import artistViewOrders from "./components/pages/artist_pages/ViewOrders";
import artistViewProductOrders from "./components/pages/artist_pages/ViewProductOrders";
import artistViewProducts from "./components/pages/artist_pages/ViewProducts";
import artistViewProductsTags from "./components/pages/artist_pages/ViewProductTags";
import artistViewProductCategories from "./components/pages/artist_pages/ViewProductCategories";
import artistProfile from "./components/pages/artist_pages/Profile";
import ArtistViewEarnings from "./components/pages/artist_pages/ViewEarnings";
import ArtistSearchResult from "./components/pages/artist_pages/SearchResults";
// artist ROUTERS--END

//BUYER ROUTES
import BuyerDashboard from "./components/pages/buyer_pages/Dashboard";
import BuyerProfile from "./components/pages/buyer_pages/Profile";
//BUYER ROUTES --END

// ADMIN ROUTERS
import AdminDashboard from "./components/pages/admin_pages/Dashboard";
import AdminAddartist from "./components/pages/admin_pages/Addartist";
import AdminViewartists from "./components/pages/admin_pages/Viewartists";
import AdminViewClients from "./components/pages/admin_pages/ViewClients";
import AdminViewUsers from "./components/pages/admin_pages/ViewUsers";
import AdminProfile from "./components/pages/admin_pages/Profile";
import AdminAddProducts from "./components/pages/admin_pages/AddProducts";
import AdminAddProductCategories from "./components/pages/admin_pages/AddProductCategories";
import AdminAddCompanyCategory from "./components/pages/admin_pages/AddCompanyCategory";
import AdminAddProductTags from "./components/pages/admin_pages/AddProductTags";
// import AdminEditProduct from "./components/pages/admin_pages/EditProduct";
import AdminViewProducts from "./components/pages/admin_pages/ViewProducts";
import AdminViewOrders from "./components/pages/admin_pages/ViewOrders";
import AdminViewProductsTags from "./components/pages/admin_pages/ViewProductTags";
import AdminViewProductCategories from "./components/pages/admin_pages/ViewProductCategories";
import AdminViewCompanyCategories from "./components/pages/admin_pages/ViewCompanyCategories";
import AdminViewReviews from "./components/pages/admin_pages/ViewReviews";
import AdminViewEarnings from "./components/pages/admin_pages/ViewEarnings";
import AdminAddPost from "./components/pages/admin_pages/AddPost";
import AdminViewPosts from "./components/pages/admin_pages/ViewPosts";
import AdminAddAdvert from "./components/pages/admin_pages/AddAdvert";
import AdminAddSlide from "./components/pages/admin_pages/AddSlide";
import AdminViewAdverts from "./components/pages/admin_pages/ViewAdverts";
import AdminViewSlides from "./components/pages/admin_pages/ViewSlides";
import AdminEditSlide from "./components/pages/admin_pages/EditSlide";
import AdminAddPage from "./components/pages/admin_pages/AddPage";
import AdminViewPages from "./components/pages/admin_pages/ViewPages";
import AdminSearchResult from "./components/pages/admin_pages/SearchResults";
import adminViewClientsGiveAways from "./components/pages/admin_pages/ClientGiveAways";

// ADMIN ROUTERS--END

Vue.use(VueRouter);

let routes = [
    {
        path: "/auth/:provider/callback",
        component: {
            template: '<div class="auth-component"></div>'
        }
    },
    //PUBLIC ROUTES
    {
        name: "Home",
        path: "/",
        component: Home
    },
    {
        name: "Account",
        path: "/account",
        component: Account
    },
    {
        name: "ContactUs",
        path: "/contact-us",
        component: ContactUs
    },
    {
        name: "Cart",
        path: "/cart",
        component: Cart
    },
    {
        name: "Wishlist",
        path: "/wishlist",
        component: Wishlist
    },
    {
        name: "Checkout",
        path: "/checkout",
        component: Checkout
    },
    {
        name: "Shop",
        path: "/shop",
        component: Shop
    },
    {
        name: "ResetPassword",
        path: "/reset-password/:email",
        component: ResetPassword
    },
    {
        name: "DownloadBook",
        path: "/download-book",
        component: DownloadBook
    },
    {
        name: "GoogleAuthorizationPage",
        path: "/authorize/google/callback",
        component: GoogleAuthorizationPage
    },
    {
        name: "Blog",
        path: "/blog",
        component: Blog
    },
    {
        name: "SingleBlog",
        path: "/single-post/:id",
        component: SingleBlog
    },
    {
        name: "BlogSearchResults",
        path: "/blog-search-results/:searchFor",
        component: BlogSearchResults
    },
    {
        name: "SearchResults",
        path: "/search-results/:searchValue",
        component: SearchResults
    },
    {
        name: "AdminSearchResult",
        path: "/admin/search-results/:searchType/:searchValue",
        component: AdminSearchResult
    },
    {
        name: "ArtistSearchResult",
        path: "/artist-search-results/:searchType/:searchValue",
        component: ArtistSearchResult
    },
    {
        name: "FreeProducts",
        path: "/free-products",
        component: FreeProducts
    },
    {
        name: "Product",
        path: "/product/:id",
        component: Product
    },
    {
        name: "Term&Conditions",
        path: "/:id/terms-and-conditions",
        component: OtherPage
    },
    {
        name: "ReturnPolicy",
        path: "/:id/return-policy",
        component: OtherPage
    },
    {
        name: "PrivacyPolicy",
        path: "/:id/privacy-policy",
        component: OtherPage
    },
    {
        name: "CopyrightPolicy",
        path: "/:id/copyright-policy",
        component: OtherPage
    },

    //PUBLIC ROUTES--END

    //artist ROUTES
    {
        name: "artistDashboard",
        path: "/artist/dashboard",
        component: artistDashboard
    },
    {
        name: "artistAddProducts",
        path: "/artist/add-product",
        component: artistAddProducts
    },
    {
        name: "artistAddProductCategories",
        path: "/artist/add-product-category",
        component: artistAddProductCategories
    },
    {
        name: "artistAddProductTags",
        path: "/artist/add-product-tag",
        component: artistAddProductTags
    },
    {
        name: "artistViewProducts",
        path: "/artist/view-products",
        component: artistViewProducts
    },
    // {
    //     name: "artistEditProduct",
    //     path: "/artist/edit-product/:id",
    //     component: artistEditProduct
    // },
    {
        name: "artistViewOrders",
        path: "/artist/view-orders",
        component: artistViewOrders
    },
    {
        name: "artistViewProductOrders",
        path: "/artist/view-product-orders",
        component: artistViewProductOrders
    },
    {
        name: "artistViewProductsTags",
        path: "/artist/view-product-tags",
        component: artistViewProductsTags
    },
    {
        name: "artistViewProductCategories",
        path: "/artist/view-product-categories",
        component: artistViewProductCategories
    },
    {
        name: "artistProfile",
        path: "/artist/profile",
        component: artistProfile
    },
    //artist ROUTES--END

    // ADMIN ROUTERS
    {
        name: "AdminDashboard",
        path: "/admin/dashboard",
        component: AdminDashboard
    },
    {
        name: "AdminAddartist",
        path: "/admin/add-artist",
        component: AdminAddartist
    },
    {
        name: "AdminViewartists",
        path: "/admin/view-artists",
        component: AdminViewartists
    },
    {
        name: "AdminViewEarnings",
        path: "/admin/view-earnings",
        component: AdminViewEarnings
    },
    {
        name: "ArtistViewEarnings",
        path: "/artist/view-earnings",
        component: ArtistViewEarnings
    },
    {
        name: "AdminViewClients",
        path: "/admin/view-clients",
        component: AdminViewClients
    },
    {
        name: "AdminViewClientsGiveAways",
        path: "/admin/view-give-ways",
        component: adminViewClientsGiveAways
    },
    {
        name: "AdminViewUsers",
        path: "/admin/view-users",
        component: AdminViewUsers
    },
    {
        name: "AdminViewReviews",
        path: "/admin/view-reviews",
        component: AdminViewReviews
    },

    {
        name: "AdminAddProducts",
        path: "/admin/add-product",
        component: AdminAddProducts
    },
    {
        name: "AdminAddProductCategories",
        path: "/admin/add-product-category",
        component: AdminAddProductCategories
    },
    {
        name: "AdminAddProductTags",
        path: "/admin/add-product-tag",
        component: AdminAddProductTags
    },
    {
        name: "AdminViewProducts",
        path: "/admin/view-products",
        component: AdminViewProducts
    },
    {
        name: "AdminViewOrders",
        path: "/admin/view-orders",
        component: AdminViewOrders
    },
    {
        name: "AdminViewProductsTags",
        path: "/admin/view-product-tags",
        component: AdminViewProductsTags
    },
    {
        name: "AdminViewProductCategories",
        path: "/admin/view-product-categories",
        component: AdminViewProductCategories
    },
    {
        name: "AdminProfile",
        path: "/admin/profile",
        component: AdminProfile
    },
    {
        name: "AdminAddPost",
        path: "/admin/add-post",
        component: AdminAddPost
    },
    {
        name: "AdminViewPosts",
        path: "/admin/view-posts",
        component: AdminViewPosts
    },
    {
        name: "AdminAddSlide",
        path: "/admin/add-slide",
        component: AdminAddSlide
    },
    {
        name: "AdminAddAdvert",
        path: "/admin/add-advert",
        component: AdminAddAdvert
    },
    {
        name: "AdminViewSlides",
        path: "/admin/view-slides",
        component: AdminViewSlides
    },
    {
        name: "AdminEditSlide",
        path: "/admin/edit-slide/:id",
        component: AdminEditSlide
    },
    {
        name: "AdminViewAdverts",
        path: "/admin/view-adverts",
        component: AdminViewAdverts
    },
    // ADMIN ROUTERS--END

    // CLIENT ROUTES
    {
        name: "BuyerDashboard",
        path: "/buyer/dashboard",
        component: BuyerDashboard
    },
    {
        name: "BuyerProfile",
        path: "/buyer/profile",
        component: BuyerProfile
    },
    {
        name: "AdminAddPage",
        path: "/admin/add-page",
        component: AdminAddPage
    },
    {
        name: "AdminViewPages",
        path: "/admin/view-pages",
        component: AdminViewPages
    },
    {
        name: "AdminAddCompanyCategory",
        path: "/admin/add-company-category",
        component: AdminAddCompanyCategory
    },
    {
        name: "AdminViewCompanyCategories",
        path: "/admin/view-company-categories",
        component: AdminViewCompanyCategories
    }

    // CLIENT ROUTES --END
];

// let base_url = window.location.origin;
// axios(`${base_url}/api/get-pages`).then((response) => {
//   response.data.forEach(function(route) {
//     routes.push({
//       name: `${route.page_name}`,
//       path: `/:id/${route.page_url}`,
//       component: OtherPage,
//     });
//   });
// });

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes
});
export default router;
