import Vue from "vue"
import Router from "vue-router"

import EventBus from "./eventbus.js";

import ContactPage from "@/components/Content/ContactPage"
import CoursePage from "@/components/Content/CoursePage"
import CoursesTable from "@/components/Content/CoursesTable"
import FAQ from "@/components/Content/FAQ"
import GradesForm from "@/components/Content/GradesForm"
import Home from "@/components/Content/Home"
import NewsEntry from "@/components/Content/NewsEntry"
import NewsReel from "@/components/Content/NewsReel"

import LoginForm from "@/components/System/LoginForm"
import NotAllowed from "@/components/System/NotAllowed"
import NotFound from "@/components/System/NotFound"

import Dashboard from "@/components/Dashboard/Dashboard"
import ManagementForm from "@/components/Dashboard/ManagementForm"
import ManagementList from "@/components/Dashboard/ManagementList"

Vue.use(Router)

let managementModules = [
	{ repository: "fields", url: "kierunki" },
	{ repository: "forms", url: "formy" },
	{ repository: "semesters", url: "semestry" },
	{ repository: "courses", url: "kursy" },
]

let routes = [
	{ path: "/", meta: { section: "home" }, name: "home", component: Home },

	{ path: "/aktualnosci", meta: { section: "news" }, name: "news", component: NewsReel },
	{ path: "/aktualnosci/:id", meta: { section: "news" }, name: "news.entry", component: NewsEntry },

	{ path: "/kursy", meta: { section: "courses" }, name: "courses", component: CoursesTable },
	{ path: "/kursy/:id", meta: { section: "courses" }, name: "course.page", component: CoursePage },

	{ path: "/oceny", meta: { section: "grades" }, name: "grades", component: GradesForm },

	{ path: "/faq", meta: { section: "faq" }, name: "faq", component: FAQ },
	{ path: "/kontakt", meta: { section: "contact" }, name: "contact", component: ContactPage },

	{ path: "/logowanie", meta: { section: "dashboard", requiresGuest: true }, name: "login", component: LoginForm, },

	{ path: "/zarzadzaj", meta: { section: "dashboard", requiresAuth: true }, name: "dashboard", component: Dashboard, },

	{ path: "/brak-dostepu", meta: { section: "error" }, name: "not-allowed", component: NotAllowed },
	{ path: "*", meta: { section: "error" }, name: "not-found", component: NotFound },
]

for(let module of managementModules) {
	routes = routes.concat([
		{ 
			path: "/zarzadzaj/" + module.url,
			meta: { section: "dashboard", repository: module.repository, requiresAuth: true },
			name: "dashboard." + module.repository +".list",
			component: ManagementList,
		},
		{ 
			path: "/zarzadzaj/" + module.url + "/:id",
			meta: { section: "dashboard", repository: module.repository, requiresAuth: true },
			name: "dashboard." + module.repository +".form",
			component: ManagementForm,
		},
	])
}

const router = new Router({
	mode: "history",
	routes: routes
})

export default router
