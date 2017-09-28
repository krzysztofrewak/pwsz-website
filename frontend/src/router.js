import Vue from "vue"
import Router from "vue-router"

import CoursesTable from "@/components/CoursesTable"
import GradesTable from "@/components/GradesTable"
import NewsReel from "@/components/NewsReel"
import NotFound from "@/components/NotFound"

Vue.use(Router)

const router = new Router({
	mode: "history",
	routes: [
		{ path: "/", name: "home", redirect: { name: "courses" } },

		{ path: "/aktualnosci", meta: { section: "news" }, name: "news", component: NewsReel },
		{ path: "/kursy", meta: { section: "courses" }, name: "courses", component: CoursesTable },
		{ path: "/grades", meta: { section: "grades" }, name: "grades", component: GradesTable },

		{ path: "*", meta: { section: "error" }, name: "not-found", component: NotFound },
	]
})

export default router
