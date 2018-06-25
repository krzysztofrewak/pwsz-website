import Vue from "vue"
import VueCookie from "vue-cookie"
import VueAnalytics from "vue-analytics"
import axios from "axios"

require("semantic-ui-css/components/button.min.css")
require("semantic-ui-css/components/container.min.css")
require("semantic-ui-css/components/dimmer.min.css")
require("semantic-ui-css/components/divider.min.css")
require("semantic-ui-css/components/form.min.css")
require("semantic-ui-css/components/grid.min.css")
require("semantic-ui-css/components/header.min.css")
require("semantic-ui-css/components/icon.min.css")
require("semantic-ui-css/components/input.min.css")
require("semantic-ui-css/components/list.min.css")
require("semantic-ui-css/components/loader.min.css")
require("semantic-ui-css/components/menu.min.css")
require("semantic-ui-css/components/message.min.css")
require("semantic-ui-css/components/popup.min.css")
require("semantic-ui-css/components/reset.min.css")
require("semantic-ui-css/components/segment.min.css")
require("semantic-ui-css/components/site.min.css")
require("semantic-ui-css/components/statistic.min.css")
require("semantic-ui-css/components/table.min.css")
require("semantic-ui-css/components/feed.min.css")

import App from "./components/App"
import GlobalComponents from "./mixins/GlobalComponents"
import GlobalFunctions from "./mixins/GlobalFunctions"
import router from "./router.js"

Vue.use(VueCookie)
Vue.use(GlobalComponents)
Vue.mixin(GlobalFunctions)

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
