import Vue from "vue";
import Vuex from "vuex";
import modules from "./modules"; //This will import all modules at once.

import axios from "axios";

Vue.use(Vuex);
axios.defaults.baseURL = "http://127.0.0.1:8000";
//axios.defaults.baseURL = "https://www.artise.africa";

export default new Vuex.Store({
    modules
});
