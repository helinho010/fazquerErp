<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Modulos - Ventanas - Acciones
                    
                    <button type="button" class="btn btn-secondary" @click="abrirModal('registrar')">
                        <i class="icon-plus"></i>&nbsp;Nuevo Modulo
                    </button>
                
                </div>
                <div class="card-body">
                    <!-- <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar" v-model="buscar"  @keyup.enter="listarModulos(1)">
                                <button type="submit" class="btn btn-primary" @click="listarModulos(1)"><i class="fa fa-search" ></i> Buscar</button>
                            </div>
                        </div>
                    </div> -->
                    <div v-for="modulo in arrayModulos" :key="modulo.id">
                        <table class="table table-bordered table-striped table-sm table-responsive">
                        
                        <tbody>
                            <tr >
                                <td style="width:200px">
                                    <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('actualizar',modulo)">
                                        <i class="icon-pencil"></i>
                                    </button>&nbsp;
                                    <button v-if="modulo.activo==1" type="button" class="btn btn-danger btn-sm" @click="eliminarModulo(modulo.id)" >
                                        <i class="icon-trash"></i>
                                    </button>&nbsp;
                                    <button v-else type="button" class="btn btn-info btn-sm" @click="activarModulo(modulo.id)" >
                                        <i class="icon-check"></i>
                                    </button>&nbsp;
                                    <button v-if="!modulo.mostrarventana" type="button" class="btn btn-success btn-sm" @click="expandirModulo(modulo.id)">
                                        +
                                    </button> &nbsp;
                                    <button v-else type="button" class="btn btn-info btn-sm" @click="reducirModulo(modulo.id)">
                                        -
                                    </button> &nbsp;
                                </td>
                                <td v-text="modulo.nombre" colspan="3" ></td>
                                <td style="width:50px">
                                    <div v-if="modulo.activo==1">
                                        <span class="badge badge-success">Activo</span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-warning">Desactivado</span>
                                    </div>
                                </td>
                            </tr>
                            
                                <tr v-show="modulo.mostrarventana" v-for="ventana in modulo.ventana" :key="ventana.id" >
                                    <td style="width:200px"></td>
                                    <td style="width:200px">
                                        <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('actualizar',ventana)">
                                            <i class="icon-pencil"></i>
                                        </button>&nbsp;
                                        <button v-if="ventana.activo==1" type="button" class="btn btn-danger btn-sm" @click="eliminarModulo(ventana.id)" >
                                            <i class="icon-trash"></i>
                                        </button>&nbsp;
                                        <button v-else type="button" class="btn btn-info btn-sm" @click="activarModulo(ventana.id)" >
                                            <i class="icon-check"></i>
                                        </button>&nbsp;
                                         <button v-if="!modulo.mostrarventana" type="button" class="btn btn-success btn-sm" @click="expandirVentana(ventana.id)">
                                            +
                                        </button> &nbsp;
                                        <button v-else type="button" class="btn btn-info btn-sm" @click="reducirVentana(ventana.id)">
                                            -
                                        </button> &nbsp;
                                    </td>
                                    <td v-text="ventana.nombre"></td>
                                    <td style="width:50px">
                                        <div v-if="ventana.activo==1">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-warning">Desactivado</span>
                                        </div>
                                    </td>

                                </tr>
                            

                            
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="registrar" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ tituloModal }}</h4>
                        <button type="button" class="close"  aria-label="Close" @click="cerrarModal('registrar')">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action=""  class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Modulo <span  v-if="!simodulo" class="error">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="text" id="modulo" name="modulo" class="form-control" placeholder="Nombre del Modulo" v-model="modulo" v-on:focus="selectAll" >
                                    <span  v-if="!simodulo" class="error">Debe Ingresar el Nombre del Modulo</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  @click="cerrarModal('registrar')">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarModulo()" :disabled="!sicompleto">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarModulo()">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
        
        
    </main>
</template>

<script>
import Swal from 'sweetalert2'
//Vue.use(VeeValidate);
    export default {
        data(){
            return{
                modulo:'',
                
                arrayModulos:[],
                tituloModal:'',
                tipoAccion:1,
                idmodulo:'',
                buscar:'',
            }

        },
        computed:{
            simodulo(){
                let me=this;
                if(me.modulo!='')
                    return true;
                else
                    return false;
            },
            
            sicompleto(){
                let me=this;
                if (me.modulo!='' )
                    return true;
                else
                    return false;
            },
            isActived:function(){
                return this.pagination.current_page;
            },

        },
        methods :{
            expandirModulo(id){
                let me=this;
                me.arrayModulos.forEach(element => {
                    if(element.id==id)
                    {
                        element.mostrarventana=true;                        
                    }
                    else
                        element.mostrarventana=false;
                    
                });
                //let resp=me.arrayModulos.find(element=>element.id==id);
                //console.log(resp);
                

            },

            reducirModulo(id){
                let me=this;
                me.arrayModulos.forEach(element => {
                    if(element.id==id)
                    {
                        element.mostrarventana=false;                        
                    }
                    
                });
                //let resp=me.arrayModulos.find(element=>element.id==id);
                //console.log(resp);
                

            },
            expandirVentana(id){
                let me=this;
                me.arrayModulos.forEach(element => {
                    element.acciones.forEach(elemento=>{

                    });
                    
                    
                    if(element.id==id)
                    {
                        element.mostrarventana=true;                        
                    }
                    else
                        element.mostrarventana=false;
                    
                });
                //let resp=me.arrayModulos.find(element=>element.id==id);
                //console.log(resp);
                

            },

            reducirVentana(id){
                let me=this;
                me.arrayModulos.forEach(element => {
                    if(element.id==id)
                    {
                        element.mostrarventana=false;                        
                    }
                    
                });
                //let resp=me.arrayModulos.find(element=>element.id==id);
                //console.log(resp);
                

            },
            listarModulos(page){
                let me=this;
                var url='/modulo?page='+page+'&buscar='+me.buscar;
                axios.get(url).then(function(response){
                    var respuesta=response.data;
                    console.log(respuesta);
                    me.arrayModulos=respuesta.modulos;
                    
                    
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            registrarModulo(){
                let me = this;
                axios.post('/modulo/registrar',{
                    'nombre':me.modulo,
                }).then(function(response){
                    me.cerrarModal('registrar');
                    me.listarModulos();
                }).catch(function(error){
                    console.log(error);
                });

            },
            eliminarModulo(idmodulo){
                let me=this;
                //console.log("prueba");
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Esta Seguro de Desactivar?',
                text: "Es una eliminacion logica",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Desactivar',
                cancelButtonText: 'No, Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                     axios.put('/modulo/desactivar',{
                        'id': idmodulo
                    }).then(function (response) {
                        
                        swalWithBootstrapButtons.fire(
                            'Desactivado!',
                            'El registro a sido desactivado Correctamente',
                            'success'
                        )
                        me.listarModulos();
                        
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    /* swalWithBootstrapButtons.fire(
                    'Cancelado!',
                    'El Registro no fue desactivado',
                    'error'
                    ) */
                }
                })
            },
            activarModulo(idmodulo){
                let me=this;
                //console.log("prueba");
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Esta Seguro de Activar?',
                text: "Es una Activacion logica",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Activar',
                cancelButtonText: 'No, Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                     axios.put('/modulo/activar',{
                        'id': idmodulo
                    }).then(function (response) {
                        
                        swalWithBootstrapButtons.fire(
                            'Activado!',
                            'El registro a sido Activado Correctamente',
                            'success'
                        )
                        me.listarModulos();
                        
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    /* swalWithBootstrapButtons.fire(
                    'Cancelado!',
                    'El Registro no fue Activado',
                    'error'
                    ) */
                }
                })
            },
            actualizarModulo(){
               // const Swal = require('sweetalert2')
                let me =this;
                axios.put('/modulo/actualizar',{
                    'id':me.idmodulo,
                    'nombre':me.modulo,
                    
                }).then(function (response) {
                    if(response.data.length){
                    }
                    // console.log(response)
                    else{
                            Swal.fire('Actualizado Correctamente')

                        me.listarModulos();
                    } 
                }).catch(function (error) {
                   
                });
                me.cerrarModal('registrar');


            },
            abrirModal(accion,data= []){
                let me=this;
                switch(accion){
                    case 'registrar':
                    {
                        me.tituloModal='Registar Modulo'
                        me.tipoAccion=1;
                        me.modulo='';
                        me.classModal.openModal('registrar');
                        break;
                    }
                    
                    case 'actualizar':
                    {
                        me.idmodulo=data.id;
                        me.tipoAccion=2;
                        me.tituloModal='Actualizar Modulo'
                        me.modulo=data.nombre;
                        me.classModal.openModal('registrar');
                        break;
                    }

                }
                
            },
            cerrarModal(accion){
                let me = this;
                me.classModal.closeModal(accion);
                me.modulo='';
                me.descripcion='';
                me.tipoAccion=1;
                me.areamedica=true;
                
            },
            selectAll: function (event) {
                setTimeout(function () {
                    event.target.select()
                }, 0)
            },  


        },
        mounted() {
            this.listarModulos(1);
            this.classModal = new _pl.Modals();
            this.classModal.addModal('registrar');
            //console.log('Component mounted.')
        }
    }
</script>
<style scoped>
.error{
    color: red;
    font-size: 10px;
    
}
</style>
