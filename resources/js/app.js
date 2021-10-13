require("./bootstrap");

import Vue from "vue";
import router from "./routes";
import axios from "axios";
import store from "./store";
import App from "./App.vue";
import jQuery from "jquery";
import { DropDownButtonPlugin } from "@syncfusion/ej2-vue-splitbuttons";
import VueTimeago from "vue-timeago";
import VueCarousel from "vue-carousel";
import VueGtag from "vue-gtag";
import VueSocialauth from "vue-social-auth";
import VueClickAway from "vue3-click-away";

// Vue.use(VueSocialauth, {
//     providers: {
//         google: {
//             clientId:
//                 "675987751270-60a7c06091uctcbb842tfkb7l9f9kh4m.apps.googleusercontent.com",
//             redirectUri: "/auth/google/callback"
//         },
//         facebook: {
//             clientId: "302906331177771",
//             redirectUri: "/auth/facebook/callback"
//         }
//     }
// });
Vue.use(VueGtag, {
    config: { id: "G-E6016JD3T5" }
});
Vue.use(VueCarousel);
Vue.use(VueTimeago, {
    name: "Timeago", // Component name, `Timeago` by default
    locale: "en", // Default locale
    // We use `date-fns` under the hood
    // So you can use all locales from it
    locales: {
        "zh-CN": require("date-fns/locale/zh_cn"),
        ja: require("date-fns/locale/ja")
    }
});
Vue.use("axios", axios);
Vue.use(DropDownButtonPlugin);
Vue.use(require("vue-moment"));
Vue.use(VueClickAway);
global.$ = jQuery;

const app = new Vue(
    Vue.util.extend(
        {
            router,
            store
        },
        App
    )
).$mount("#app");
