import ContentLoader from "../components/Layout/ContentLoader.vue"

const GlobalComponents = {
	install(Vue) {
		Vue.component("content-loader", ContentLoader)
	}
}

export default GlobalComponents
