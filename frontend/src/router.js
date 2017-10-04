import Vue from "vue"
import Router from "vue-router"

import ContactPage from "@/components/ContactPage"
import CoursePage from "@/components/CoursePage"
import CoursesTable from "@/components/CoursesTable"
import FAQ from "@/components/FAQ"
import GradesForm from "@/components/GradesForm"
import Home from "@/components/Home"
import NewsEntry from "@/components/NewsEntry"
import NewsReel from "@/components/NewsReel"
import NotFound from "@/components/NotFound"

Vue.use(Router)

const router = new Router({
	mode: "history",
	routes: [
		{ path: "/", meta: { section: "home" }, name: "home", component: Home },

		{ path: "/aktualnosci", meta: { section: "news" }, name: "news", component: NewsReel },
		{ path: "/aktualnosci/:id", meta: { section: "news" }, name: "news.entry", component: NewsEntry },

		{ path: "/kursy", meta: { section: "courses" }, name: "courses", component: CoursesTable },
		{ path: "/kursy/:id", meta: { section: "courses" }, name: "course.page", component: CoursePage },

		{ path: "/oceny", meta: { section: "grades" }, name: "grades", component: GradesForm },

		{ path: "/faq", meta: { section: "faq" }, name: "faq", component: FAQ },
		{ path: "/kontakt", meta: { section: "contact" }, name: "contact", component: ContactPage },

		{ path: "*", meta: { section: "error" }, name: "not-found", component: NotFound },
	]
})

export default router
