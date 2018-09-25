import Vue from "vue"
import Router from "vue-router"

import Home from "@/components/Content/Home"
import ContactPage from "@/components/Content/Contact"
import CoursePage from "@/components/Content/Courses/Page"
import CoursesTable from "@/components/Content/Courses/Table"
import NewsEntry from "@/components/Content/News/Entry"
import NewsReel from "@/components/Content/News/Reel"
import FAQ from "@/components/Content/FAQ"
import Schedule from "@/components/Content/Schedule"
import GradesForm from "@/components/Content/Grades/GradesForm"

import LoginForm from "@/components/System/LoginForm"
import NotAllowed from "@/components/System/NotAllowed"
import NotFound from "@/components/System/NotFound"
import NotRetrieved from "@/components/System/NotRetrieved"

import Dashboard from "@/components/Dashboard/Dashboard"
import ManagementForm from "@/components/Dashboard/ManagementForm"
import ManagementList from "@/components/Dashboard/ManagementList"
import AccountPage from "@/components/Dashboard/AccountPage"
import Logger from "@/components/Dashboard/Logger"
import Log from "@/components/Dashboard/Log"
import ManagementGradesForm from "@/components/Dashboard/GradesForm"

Vue.use(Router)

let routes = [
	{ path: "/", meta: { section: "home" }, name: "home", component: Home },

	{ path: "/aktualnosci", meta: { section: "news" }, name: "news", component: NewsReel },
	{ path: "/aktualnosci/:id", meta: { section: "news" }, name: "news.entry", component: NewsEntry },

	{ path: "/kursy", meta: { section: "courses" }, name: "courses", component: CoursesTable },
	{ path: "/kursy/:id", meta: { section: "courses" }, name: "course.page", component: CoursePage },

	{ path: "/oceny", meta: { section: "grades" }, name: "grades", component: GradesForm },
	{ path: "/oceny/:semester", meta: { section: "grades" }, name: "grades.semester", component: GradesForm },
	{ path: "/oceny/:semester/:course", meta: { section: "grades" }, name: "grades.course", component: GradesForm },
	{ path: "/oceny/:semester/:course/:group", meta: { section: "grades" }, name: "grades.group", component: GradesForm },
	{ path: "/oceny/:semester/:course/:group/:student", meta: { section: "grades" }, name: "grades.student", component: GradesForm },

	{ path: "/faq", meta: { section: "faq" }, name: "faq", component: FAQ },
	{ path: "/plan-zajec", meta: { section: "schedule" }, name: "schedule", component: Schedule },

	{ path: "/kontakt", meta: { section: "contact" }, name: "contact", component: ContactPage },

	{ path: "/logowanie", meta: { section: "dashboard", requiresGuest: true }, name: "login", component: LoginForm, },
	{ path: "/zarzadzaj", meta: { section: "dashboard", requiresAuth: true }, name: "dashboard", component: Dashboard, },
	{ path: "/zarzadzaj/konto", meta: { section: "dashboard", requiresAuth: true }, name: "dashboard.account", component: AccountPage },
	{ path: "/zarzadzaj/oceny", meta: { section: "dashboard", requiresAuth: true }, name: "dashboard.grades", component: ManagementGradesForm },
	{ path: "/zarzadzaj/logi", meta: { section: "dashboard", requiresAuth: true }, name: "dashboard.logger", component: Logger },
	{ path: "/zarzadzaj/logi/:day", meta: { section: "dashboard", requiresAuth: true }, name: "dashboard.logger.log", component: Log },

	{ path: "/brak-dostepu", meta: { section: "error" }, name: "not-allowed", component: NotAllowed },
	{ path: "/brak-zasobu", meta: { section: "error" }, name: "not-retrieved", component: NotRetrieved },
	{ path: "*", meta: { section: "error" }, name: "not-found", component: NotFound },
]

let managementModules = [
	{ repository: "news", url: "aktualnosci" },
	{ repository: "faqs", url: "faq" },
	{ repository: "modes", url: "tryby" },
	{ repository: "fields", url: "kierunki" },
	{ repository: "forms", url: "formy" },
	{ repository: "semesterCourses", url: "semestry/kursy" },
	{ repository: "semesters", url: "semestry" },
	{ repository: "courses", url: "kursy" },
	{ repository: "students", url: "studenci" },
	{ repository: "courseGroups", url: "grupy" },
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

export default router
