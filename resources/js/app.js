import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';


import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

import Multiselect from 'vue-multiselect';
import 'vue-multiselect/dist/vue-multiselect.css'


/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faAnglesLeft, faAnglesRight, faHouse, faAngleDown, faKey, faBars, faArrowLeft, faPen, faTrashCan, faCity, faScrewdriverWrench, faRightToBracket, faUserPlus, faChartSimple, faHandshakeAngle } from '@fortawesome/free-solid-svg-icons'

import { faCalendarDays } from '@fortawesome/free-regular-svg-icons';

/* add icons to the library */
library.add(faAnglesLeft, faAnglesRight, faHouse, faAngleDown, faKey, faBars, faArrowLeft, faPen, faTrashCan, faCity, faScrewdriverWrench, faRightToBracket, faUserPlus, faCalendarDays, faChartSimple, faHandshakeAngle)

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .component('font-awesome-icon', FontAwesomeIcon)
      .component('VueDatePicker', VueDatePicker)
      .component('vue-multiselect', Multiselect)
      .mount(el);
  },
  progress: {
    color: '#4B5563',
  },
});





