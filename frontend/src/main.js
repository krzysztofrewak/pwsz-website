import Vue from "vue"
import VueCookie from "vue-cookie"
import VueResource from "vue-resource"

require("semantic-ui-css/semantic.css")
require("semantic-ui-css/semantic.js")

import App from "./components/App"
import Global from "./mixins/Global"
import router from "./router.js"

Vue.use(VueResource)
Vue.use(VueCookie)

Vue.mixin(Global)

new Vue({
	el: "#app",
	router,
	template: "<App/>",
	components: {
		App
	}
})
