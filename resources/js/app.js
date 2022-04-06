require('./bootstrap');
import { createApp } from 'vue';

createApp ({})
    .component('example',require('./components/Example.vue').default)
    .component('another-example',require('./components/AnotherExample.vue').default)
    .mount('#app');



