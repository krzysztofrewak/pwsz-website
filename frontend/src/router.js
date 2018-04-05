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
import AccountPage from "@/components/Dashboard/AccountPage"
import ManagementGradesForm from "@/components/Dashboard/GradesForm"

Vue.use(Router)

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
	{ path: "/zarzadzaj/konto", meta: { section: "dashboard", requiresAuth: true }, name: "dashboard.account", component: AccountPage },
	{ path: "/zarzadzaj/oceny", meta: { section: "dashboard", requiresAuth: true }, name: "dashboard.grades", component: ManagementGradesForm },

	{ path: "/brak-dostepu", meta: { section: "error" }, name: "not-allowed", component: NotAllowed },
	{ path: "*", meta: { section: "error" }, name: "not-found", component: NotFound },
]

let managementModules = [
	{ repository: "news", url: "aktualnosci" },
	{ repository: "faqs", url: "faq" },
	{ repository: "fields", url: "kierunki" },
	{ repository: "forms", url: "formy" },
	{ repository: "semestercourses", url: "semestry/kursy" },
	{ repository: "semesters", url: "semestry" },
	{ repository: "courses", url: "kursy" },
	{ repository: "students", url: "studenci" },
	{ repository: "coursegroups", url: "grupy" },
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
			path: "/zarzadzaj/" + module.url + "/dodaj",
			meta: { section: "dashboard", repository: module.repository, createForm: true, requiresAuth: true },
			name: "dashboard." + module.repository +".add",
			component: ManagementForm,
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

router.beforeEach((to, from, next) => {
	let isAuthenticated = EventBus.isAuthenticated

	if(EventBus.isAuthenticated !== null) {
		checkRoute(isAuthenticated, to, next)
	}

	Vue.http.post("auth").then(response => checkRoute(true, to, next)).catch(response => checkRoute(false, to, next))
})

function checkRoute(isAuthenticated, to, next) {
	if(to.meta.requiresAuth && !isAuthenticated) {
		next({ name: "not-allowed" })
	}

	if(to.meta.requiresGuest && isAuthenticated) {
		next({ name: "not-allowed" })
	}

	next()
}



export default router
