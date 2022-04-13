require('./bootstrap');
window._pl = require('./func_10251');
import { createApp } from 'vue';

createApp ({
    data:()=>{
        return{
            menu:0
        }
        
    }
})
    .component('principal-component',require('./components/Principal.vue').default)
    .component('Body_header', require('./components/plugin_vue/Body_header.vue').default)
    .component('example',require('./components/Example.vue').default)
    .component('another-example',require('./components/AnotherExample.vue').default)

    .component('rubros-component',require('./components/administracion/RubrosComponent.vue').default)


    .component('sucursal-component',require('./components/administracion/SucursalComponent.vue').default)
    
    .mount('#app');
 