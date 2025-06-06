import axios from 'axios'
import jQuery from 'jquery'
import 'slick-carousel'

window.axios = axios

window.$ = jQuery
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
