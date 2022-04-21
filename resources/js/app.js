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
    
    //administracion
    .component('rubros-component',require('./components/administracion/RubrosComponent.vue').default)
    .component('sucursal-component',require('./components/administracion/SucursalComponent.vue').default)
    .component('modulo-component',require('./components/administracion/ModuloVentanaAccionComponent.vue').default)
    .component('rolpermiso-component',require('./components/administracion/RolPermisoComponent.vue').default)
    .component('usuario-component',require('./components/administracion/UsuariosComponent.vue').default)


    //rrhh
    .component('rrhempleados-component',require('./components/recursos_humanos/EmpleadosComponent.vue').default)
    .component('rrhnivel-component',require('./components/recursos_humanos/NivelComponent.vue').default)
    .component('rrhprofesion-component',require('./components/recursos_humanos/ProfesionComponent.vue').default)
    .component('rrhcargos-component',require('./components/recursos_humanos/CargoComponent.vue').default)
    .component('rrhuorg-component',require('./components/recursos_humanos/UnidadOrgComponent.vue').default)


    //Servicios
    .component('area-component',require('./components/servicios/AreaComponent.vue').default)
    .component('prestaciones-component',require('./components/servicios/PrestacionComponent.vue').default)


    
    .mount('#app');
 