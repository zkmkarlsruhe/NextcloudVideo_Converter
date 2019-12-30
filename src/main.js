import Vue from 'vue'

import Settings from './views/Settings.vue'

Vue.prototype.t = window.t
Vue.prototype.n = window.n
Vue.prototype.OC = window.OC
Vue.prototype.OCA = window.OCA

export default new Vue({
	el: '#vue-content',
	render: h => h(Settings)
})