import Vue from "vue"
import VueCookie from "vue-cookie"
import VueAnalytics from "vue-analytics"
import axios from "axios"

require("semantic-ui-css/semantic.css")

import App from "./components/App"
import Global from "./mixins/Global"
import router from "./router.js"

Vue.use(VueCookie)
Vue.mixin(Global)

if(process.env.NODE_ENV !== "development") {
	Vue.use(VueAnalytics, {
		id: "UA-107302621-1",
		checkDuplicatedScript: true,
		router
	})
}

axios.defaults.baseURL = "/api/"
Vue.prototype.$http = axios

new Vue({
	el: "#app",
	router,
	template: "<App></App>",
	components: {
		App
	}
})
