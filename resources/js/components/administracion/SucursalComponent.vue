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
                    <i class="fa fa-align-justify"></i> Sucursales
                    <button type="button" class="btn btn-secondary" @click="abrirModal('registrar')">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar" v-model="buscar"  @keyup.enter="listarSucursales(1)">
                                <button type="submit" class="btn btn-primary" @click="buscarSucursal"><i class="fa fa-search" ></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm table-responsive">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Codigo</th>
                                <th>Tipo</th>
                                <th>Nit</th>
                                <th>Razon Social</th>
                                <th>Nombre Comercial</th>
                                <!-- <th>Rubro</th> -->
                                <th>Direccion</th>
                                <th>Departamento</th>
                                <th>Ciudad</th>
                                <th>Telefonos</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="sucursal in arraySucursales" :key="sucursal.id">
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('actualizar',sucursal)">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button v-if="sucursal.activo==1" type="button" class="btn btn-danger btn-sm" @click="eliminarSucursal(sucursal.id)" >
                                        <i class="icon-trash"></i>
                                    </button>
                                    <button v-else type="button" class="btn btn-info btn-sm" @click="activarSucursal(sucursal.id)" >
                                        <i class="icon-check"></i>
                                    </button>
                                </td>
                                <td v-text="sucursal.cod"></td>
                                <td v-text="sucursal.tipo == 'Casa_Matriz'? (sucursal.tipo + (sucursal.codalamcen==null?'':' -> '+sucursal.codalamcen)):(sucursal.tipo + ' - ' +sucursal.correlativo)+(sucursal.codalamcen==null?'':' -> '+sucursal.codalamcen)"></td>
                                <td v-text="sucursal.nit"></td>
                                <td v-text="sucursal.razon_social"></td>
                                <td v-text="sucursal.nombre_comercial"></td>
                                <!-- <td v-text="sucursal.nomrubro"></td> -->
                                <td v-text="sucursal.direccion"></td>
                                <td>
                                    <div v-for="dpta in arrayDepartamentos">
                                        <div v-if="dpta.id == sucursal.departamento">
                                            {{ dpta.nombre }}
                                        </div>
                                    </div>
                                </td>
                                <td v-text="sucursal.ciudad"></td>
                                    <!-- <div v-for="ciudad in arrayciudad">
                                        <div v-if="ciudad.id == sucursal.ciudad">
                                            {{ ciudad.nombre }}
                                        </div>
                                    </div>
                                </td> -->
                                <td v-text="sucursal.telefonos"></td>
                                <td>
                                    <div v-if="sucursal.activo==1">
                                        <span class="badge badge-success">Activo</span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-warning">Desactivado</span>
                                    </div>
                                    
                                </td>
                            </tr>
                           
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active':'']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page< pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
                            </li>
                        </ul>
                    </nav>
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
                                <label class="col-md-2 form-control-label" for="text-input">Tipo <span  v-if="tipo==0" class="error">(*)</span></label>
                                <div class="col-md-4">
                                    <select name="" id="" v-model="tipo" class="form-control">
                                        <option value="0" disabled>Seleccionar...</option>
                                        <option v-if="matriz!=1 || tipo=='Casa_Matriz'" value="Casa_Matriz">Casa Matriz</option>
                                        <option value="Sucursal">Sucursal</option>
                                    </select>
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Rubro <span  v-if="idrubro==0" class="error">(*)</span></label>
                                <div class="col-md-4">
                                    <select name="" id="" v-model="idrubro" class="form-control">
                                        <option value="0" disabled>Seleccionar...</option>
                                        <option v-for="rubros in arrayRubros" :key="rubros.id" :value="rubros.id" v-text="rubros.nombre" ></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Razon Social <span  v-if="razonsocial==''" class="error">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="tex" id="" name="" class="form-control"  v-model="razonsocial" v-on:focus="selectAll"  >
                                    <span  v-if="razonsocial==''" class="error">Debe Ingresar La Razon Social</span>
                                </div>
                            </div>
                            <!-- Esto es para Nombre comercial -->
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre Comercial <span  v-if="nombrecomercial==''" class="error">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="tex" id="nombrecomercial" name="nombrecomercial" class="form-control"  v-model="nombrecomercial" v-on:focus="selectAll"  >
                                    <span  v-if="nombrecomercial==''" class="error">Debe Ingresar el Nombre Comercial</span>
                                </div>
                            </div>
                            <!-- Fin nombre comercial -->
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Telefonos <span  v-if="telefono ==''" class="error">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese Los numeros de Telefono" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 45 || event.charCode == 32 || event.charCode == 43 )" v-model="telefono" v-on:focus="selectAll">
                                    <span  v-if="telefono==''" class="error">Debe Ingresar La Razon Social</span>                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nit <span  v-if="nit ==''" class="error">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="text" id="nit" name="nit" class="form-control" placeholder="Ingrese el numero de NIT" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" v-model="nit" v-on:focus="selectAll">
                                    <span  v-if="nit==''" class="error">Debe Ingresar el NIT</span>                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Direccion <span  v-if="direccion ==''" class="error">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese la Direccion" v-model="direccion" v-on:focus="selectAll">
                                    <span  v-if="direccion==''" class="error">Debe Ingresar la Direccion</span>                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Departamento <span  v-if="departamento==0" class="error">(*)</span></label>
                                <div class="col-md-9">
                                    <select name="" id="" v-model="departamento" class="form-control">
                                        <option value="0" disabled>Seleccionar...</option>
                                        <option v-for="depto in arrayDepartamentos" :key="depto.id" :value="depto.id" v-text="depto.nombre"></option>
                                    </select>
                                    <span  v-if="departamento==0" class="error">Debe seleccionar un Departamento</span>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Ciudad <span  v-if="ciudad==0" class="error">(*)</span></label>
                                <div class="col-md-9">
                                    <select v-model="ciudad" class="form-control rounded">
                                        <option value="0" disabled>Seleccionar...</option>
                                        <option v-for="ciudad in arrayciudad" :key="ciudad.id" :value="ciudad.id" v-text="ciudad.abrev+'-'+ciudad.nombre"></option>
                                    </select>
                                    <span  v-if="ciudad==0" class="error">Debe seleccionar una Ciudad</span>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Ciudad <span  v-if="ciudad==''" class="error">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="tex" id="ciudad" name="ciudad" class="form-control" placeholder="Ingrese la ciudad" v-model="ciudad" v-on:focus="selectAll">
                                    <span  v-if="ciudad==''" class="error">Debe Ingresar la Ciudad</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  @click="cerrarModal('registrar')">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarSucursal()" :disabled="!sicompleto">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarSucursal()">Actualizar</button>
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
import Swal from 'sweetalert2';
import { error401 } from '../../errores';
//Vue.use(VeeValidate);
    export default {
        data(){
            return{
                pagination:{
                    'total' :0,
                    'current_page':0,
                    'per_page':0,
                    'last_page':0,
                    'from':0,
                    'to':0
                },
                offset:3,
                nombre:'',
                tipo:0,
                nit:'',
                direccion:'',
                arraySucursales:[],
                arraySucursalesCopia:[],
                tituloModal:'',
                tipoAccion:1,
                idsucursal:'',
                buscar:'',
                razonsocial:'',
                nombrecomercial:'',
                telefono:'',
                departamento:0,
                ciudad:'',
                arrayDepartamentos:[],
                arrayciudad:[
                                {'id':1,'valor':'La Paz'},
                                {'id':2,'valor':'La Paz - El Alto'},
                                {'id':3,'valor':'Santa Cruz'},
                                {'id':4,'valor':'Cochabamba'},
                                {'id':5,'valor':'Oruro'},
                                {'id':6,'valor':'Potosi'},
                                {'id':7,'valor':'Sucre'},
                                {'id':8,'valor':'Tarija'},
                                {'id':9,'valor':'Pando'},
                                {'id':10,'valor':'Beni'},
                            ],
                matriz:0,
                arrayRubros:[],
                idrubro:0,
                controlEnvio:1,                
            }

        },
        computed:{
            
            sicompleto(){
                let me=this;
                if (me.tipo!=0 && me.razonsocial!='' && me.telefono!='' && me.nit!='' && me.direccion!='' && me.ciudad!='' && me.controlEnvio == 1)
                    return true;
                else
                    return false;
            },
            isActived:function(){
                return this.pagination.current_page;
            },
            pagesNumber:function(){
                if(!this.pagination.to){
                    return[];
                }
                var from = this.pagination.current_page - this.offset;
                if(from<1){
                    from=1;
                }
                var to = from +(this.offset * 2);
                if(to>= this.pagination.last_page){
                    to=this.pagination.last_page;
                }
                var pagesArray =[];
                while(from<=to){
                    pagesArray.push(from);
                    from++
                }
                return pagesArray;
            },


        },
        methods :{

            // buscarSucursal(){
            //     let me = this;
            //     me.arraySucursalesCopia = me.arraySucursales;
            //     let arrayBuscar = [];
            //     console.log("$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$");
            //     console.log(me.arraySucursales);

            //     if (me.buscar != '') {
            //         arrayBuscar = me.buscar.split(' ');
            //         arrayBuscar.forEach(element => {
                        
            //         });
            //     }else{
            //         me.arraySucursales = me.arraySucursalesCopia;
            //     }
            //     // me.arraySucursales.forEach(sucursal => {
            //     //     if (sucursal.) {
                        
            //     //     }
            //     // });
            // },

            listarSucursales(page){
                let me=this;
                var url='/sucursal?page='+page+'&buscar='+me.buscar;
                axios.get(url)
                .then(function(response){
                    var respuesta=response.data;
                    me.pagination=respuesta.pagination;
                    me.arraySucursales=respuesta.sucursales.data;
                    let resp=me.arraySucursales.find(element=>element.tipo=='Casa_Matriz');
                    if(resp!= undefined)
                    {
                        if(resp.tipo=='Casa_Matriz')
                            me.matriz=1;
                        else
                            me.matriz=0;
                    }
                    else
                        me.matriz=0; 
                })
                .catch(function(error){
                    error401(error);
                });
            },
            cambiarPagina(page){
                let me =this;
                me.pagination.current_page = page;
                me.listarSucursales(page);
            },
            registrarSucursal(){
                let me = this;
                me.controlEnvio = 0;
                axios.post('/sucursal/registrar',{
                    'idrubro':me.idrubro,
                    'tipo':me.tipo,
                    'razon_social':me.razonsocial,
                    'nombre_comercial':me.nombrecomercial,
                    'telefonos':me.telefono,
                    'nit':me.nit,
                    'direccion':me.direccion,
                    'departamento':me.departamento,
                    'ciudad':me.ciudad,
                }).then(function(response){
                    me.cerrarModal('registrar');
                    me.listarSucursales();
                    me.controlEnvio=1;
                }).catch(function(error){
                    error401(error);
                    console.log(error);
                    me.controlEnvio=1;
                });

            },
            eliminarSucursal(idsucursal){
                let me=this;
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
                     axios.put('/sucursal/desactivar',{
                        'id': idsucursal
                    }).then(function (response) {
                        
                        swalWithBootstrapButtons.fire(
                            'Desactivado!',
                            'El registro a sido desactivado Correctamente',
                            'success'
                        )
                        me.listarSucursales();
                        
                    }).catch(function (error) {
                        error401(error);
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
            activarSucursal(idsucursal){
                let me=this;
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
                     axios.put('/sucursal/activar',{
                        'id': idsucursal
                    }).then(function (response) {
                        me.listarSucursales();
                        
                        swalWithBootstrapButtons.fire(
                            'Activado!',
                            'El registro a sido Activado Correctamente',
                            'success'
                        )
                        
                        
                    }).catch(function (error) {
                        error401(error);
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
            actualizarSucursal(){
                let me =this;
                axios.put('/sucursal/actualizar',{
                    'idrubro':me.idrubro,
                    'id':me.idsucursal,
                    'nombre':me.nombre,
                    'razon_social':me.razonsocial,
                    'nombre_comercial':me.nombrecomercial,
                    'telefonos':me.telefono,
                    'nit':me.nit,
                    'direccion':me.direccion,
                    'tipo':me.tipo,
                    'departamento':me.departamento,
                    'ciudad':me.ciudad,

                }).then(function (response) {
                    me.listarSucursales();
                    if(response.data.length){
                    }
                    // console.log(response)
                    else{
                        Swal.fire('Actualizado Correctamente')   
                    } 
                    
                }).catch(function (error) {
                    error401(error);
                });
                me.cerrarModal('registrar');


            },
            abrirModal(accion,data= []){
                let me=this;
                switch(accion){
                    case 'registrar':
                    {
                        me.tituloModal='Registar Sucursal'
                        me.tipoAccion=1;
                        me.tipo=0;
                        me.razonsocial='';
                        me.nombrecomercial='',
                        me.telefono='';
                        me.nit='';
                        me.direccion='';
                        me.departamento=0;
                        me.ciudad='';
                        me.idrubro=0;
                        me.classModal.openModal('registrar');
                        break;
                    }
                    
                    case 'actualizar':
                    {
                        me.idsucursal=data.id;
                        me.tipoAccion=2;
                        me.tituloModal='Actualizar Sucursal'
                        me.tipoAccion=2;
                        me.tipo=data.tipo;
                        me.razonsocial=data.razon_social;
                        me.nombrecomercial=data.nombre_comercial;
                        me.telefono=data.telefonos;
                        me.nit=data.nit;
                        me.direccion=data.direccion;
                        me.departamento=data.departamento;
                        me.ciudad=data.ciudad;
                        me.idrubro=data.idrubro;
                        me.classModal.openModal('registrar');
                        break;
                    }

                }
                
            },
            cerrarModal(accion){
                let me = this;
                me.classModal.closeModal(accion);
                me.tipoAccion=1;
                me.tipo=0;
                me.razonsocial='';
                me.telefono='';
                me.nit='';
                me.direccion='';
                me.ciudad='';
                me.tipoAccion=1;
                me.idrubro=0;
                
                
            },

            selectAll: function (event) {
                setTimeout(function () {
                    event.target.select()
                }, 0)
            },  

            selectRubros(){
                let me=this;
                var url='/rubro/selectrubro';
                axios.get(url).then(function(response){
                    var respuesta=response.data;
                    me.arrayRubros=respuesta.rubros;
                })
                .catch(function(error){
                    error401(error);
                    console.log(error);
                });
            },

            selectCiudades(){
                let me=this;
                var url='/ciudad/selectciudad';
                axios.get(url).then(function(response){
                    var respuesta=response.data;
                    me.arrayciudad=respuesta;
                })
                .catch(function(error){
                    error401(error);
                    console.log(error);
                });
            },

            selectDepartamentos(){
                let me=this;
                var url='/depto/selectdepto';
                axios.get(url).then(function(response){
                    var respuesta=response.data;
                    me.arrayDepartamentos=respuesta;
                })
                .catch(function(error){
                    error401(error);
                    console.log(error);
                });
                
            }


        },
        mounted() {
            this.selectRubros();
            this.listarSucursales(1);
            this.selectDepartamentos();
            this.selectCiudades();
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
