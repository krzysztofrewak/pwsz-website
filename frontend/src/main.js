import Vue from "vue"
import VueCookie from "vue-cookie"
import VueResource from "vue-resource"
import VueAnalytics from "vue-analytics"

require("semantic-ui-css/semantic.css")
require("semantic-ui-css/semantic.js")

import App from "./components/App"
import Global from "./mixins/Global"
import router from "./router.js"

Vue.use(VueResource)
Vue.use(VueCookie)
Vue.use(VueAnalytics, {
	id: "UA-107302621-1",
	checkDuplicatedScript: true,
	router
})

Vue.mixin(Global)

Vue.http.options.root = "/api/"

new Vue({
	el: "#app",
	router,
	template: "<App/>",
	components: {
		App
	}
})
