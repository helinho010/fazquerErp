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
                    <i class="fa fa-align-justify"></i> Empleados
                    <button type="button" class="btn btn-secondary" @click="abrirModal('registrar')">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar" v-model="buscar"  @keyup.enter="listarEmpleados(1)">
                                <button type="submit" class="btn btn-primary" @click="listarEmpleados(1)"><i class="fa fa-search" ></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm table-responsive">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>sexo</th>
                                <th>CI</th>
                                <th>Telefonos</th>
                                <th>Fecha Nacimiento</th>
                                <th>Estado Civil</th>
                                <th>Domicilio</th>
                                <th>Nº Cuenta</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="empleado in arrayEmpleados" :key="empleado.id">
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('actualizar',empleado)">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button v-if="empleado.activo==1" type="button" class="btn btn-danger btn-sm" @click="eliminarempleado(empleado.id)" >
                                        <i class="icon-trash"></i>
                                    </button>
                                    <button v-else type="button" class="btn btn-info btn-sm" @click="activarempleado(empleado.id)" >
                                        <i class="icon-check"></i>
                                    </button>
                                </td>
                                    <td v-text="empleado.nomempleado"></td>
                                    <td v-text="empleado.nomcargo"></td>
                                    <td v-text="empleado.sexo"></td>
                                    <td v-text="empleado.ci"></td>
                                    <td v-text="empleado.telefonos"></td>
                                    <td v-text="empleado.fechanacimiento"></td>
                                    <td v-text="empleado.estadocivil"></td>
                                    <td v-text="empleado.direccion"></td>
                                    <td v-text="empleado.nrcuenta"></td>
                                <td>
                                    <div v-if="empleado.activo==1">
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
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <strong>Apellido Paterno:</strong>
                                <input type="text" id="apaterno" name="apaterno" class="form-control" placeholder="Apellido Paterno" v-model="apaterno" v-on:focus="selectAll" >
                            </div>
                            <div class="form-group col-sm-4">
                                <strong>Apellido materno:</strong>
                                <input type="text" id="amaterno" name="amaterno" class="form-control" placeholder="Apellido Materno" v-model="amaterno" v-on:focus="selectAll" >
                            </div>
                            <div class="form-group col-sm-4">
                                <strong>Nombres:<span  v-if="nombre==''" class="error">(*)</span></strong>
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombres" v-model="nombre" v-on:focus="selectAll" >
                                <span  v-if="nombre==''" class="error">Debe Ingresar el Nombre del empleado</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <strong>CI:<span  v-if="ci==''" class="error">(*)</span></strong>
                                <input type="text" id="ci" name="ci" class="form-control" placeholder="CI" v-model="ci" v-on:focus="selectAll" >
                                <span  v-if="ci==''" class="error">Debe Ingresar el CI del empleado</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <strong>Telefonos:<span  v-if="telefono==''" class="error">(*)</span></strong>
                                <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Telefonos" v-model="telefono" v-on:focus="selectAll" >
                                <span  v-if="telefono==''" class="error">Debe Ingresar Los Telefonos del empleado</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <strong>Fecha Nacimiento: <span  v-if="fechanacimiento==''" class="error">(*)</span></strong>
                                <input type="date" id="fechanacimiento" name="fechanacimiento" class="form-control" v-model="fechanacimiento">
                                <span  v-if="fechanacimiento==''" class="error">Debe Ingresar la fecha de nacimiento del empleado</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <strong>Formacion:</strong>
                                <select v-model="formacion" class="form-control">
                                    <option value="0" disabled>Seleccionar...</option>
                                    <option v-for="forma in arrayFormacion" :key="forma.id" :value="forma.id" v-text="forma.nombre"></option>
                                </select>
                                <span class="error" v-if="formacion==0">Debe ingresar la Formacion</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <strong>Profesion:</strong>
                                <select v-model="profesion" class="form-control">
                                    <option value="0" disabled>Seleccionar...</option>
                                    <option v-for="prof in arrayProfesion" :key="prof.id" :value="prof.id" v-text="prof.nombre"></option>
                                </select>
                                <span class="error" v-if="profesion==0">Debe ingresar la Profesion</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <strong>Cargo:</strong>
                                <select v-model="cargo" class="form-control">
                                    <option value="0" disabled>Seleccionar...</option>
                                    <option v-for="carg in arrayCargo" :key="carg.id" :value="carg.id" v-text="carg.nombre"></option>
                                </select>
                                <span class="error" v-if="cargo==0">Debe ingresar el Cargo</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <strong>Domicilio:<span  v-if="domicilio==''" class="error">(*)</span></strong>
                                <input type="text" id="domicilio" name="domicilio" class="form-control" placeholder="Domicilio" v-model="domicilio" v-on:focus="selectAll" >
                                <span  v-if="ci==''" class="error">Debe Ingresar el Domicilio del empleado</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <strong>Ciudad:<span  v-if="ciudad==0" class="error">(*)</span></strong>
                                <select v-model="ciudad" class="form-control">
                                    <option value="0" disabled>Seleccionar...</option>
                                    <option v-for="ciud in arrayCiudad" :key="ciud" :value="ciud" v-text="ciud"></option>
                                </select>
                                <span class="error" v-if="ciudad==0">Debe ingresar la Ciudad</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <strong>Fecha Ingreso: <span  v-if="fechaingreso==''" class="error">(*)</span></strong>
                                <input type="date" id="fechaingreso" name="fechaingreso" class="form-control" v-model="fechaingreso">
                                <span  v-if="fechaingreso==''" class="error">Debe Ingresar la fecha de ingreso del empleado</span>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <strong>Sexo: <span  v-if="sexo==0" class="error">(*)</span></strong>
                                <select v-model="sexo" class="form-control">
                                    <option value="0" disabled>Seleccionar...</option>
                                    <option v-for="sex in arraySexo" :key="sex.id" :value="sex.id" v-text="sex.texto"></option>
                                </select>
                                <span class="error" v-if="sexo==0">Debe Seleccionar el Sexo</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <strong>Estado Civil: <span  v-if="estadocivil==0" class="error">(*)</span></strong>
                                <select v-model="estadocivil" class="form-control">
                                    <option value="0" disabled>Seleccionar...</option>
                                    <option v-for="estado in arrayEstadoCivil" :key="estado" :value="estado" v-text="estado"></option>
                                </select>
                                <span class="error" v-if="estadocivil==0">Debe Seleccionar el Estado Civil</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <strong>Nro de Cuenta: </strong>
                                <input type="text" id="nrcuenta" name="nrcuenta" class="form-control" placeholder="Numero de Cuenta" v-model="nrcuenta" v-on:focus="selectAll" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <strong>Fecha Retiro: </strong>
                                <input type="date" id="fecharetiro" name="fecharetiro" class="form-control" v-model="fecharetiro">
                            </div>
                            <div class="form-group col-sm-8">
                                <strong>Observaciones: </strong>
                                <input type="text" id="observaciones" name="observaciones" class="form-control" placeholder="Observaciones" v-model="observaciones" v-on:focus="selectAll" >
                            </div>
                        </div>
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  @click="cerrarModal('registrar')">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarempleado()" :disabled="!sicompleto">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarempleado()">Actualizar</button>
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
                descripcion:'',
                arrayEmpleados:[],
                tituloModal:'',
                tipoAccion:1,
                idempleado:'',
                buscar:'',
                

                apaterno:'',
                amaterno:'',
                ci:'',
                telefono:'',
                formacion:0,
                profesion:0,
                cargo:0,
                arrayFormacion:[],
                arrayProfesion:[],
                arrayCargo:[],
                fechanacimiento:'',
                domicilio:'',
                arrayCiudad:['El Alto',
                        'La Paz',
                        'Viacha'],
                ciudad:0,
                fechaingreso:'',
                sexo:0,
                arraySexo:[{'id':'M','texto':'Masculino'},
                            {'id':'F','texto':'Femenino'}],
                estadocivil:0,
                arrayEstadoCivil:['Soltero(a)','Casado(a)','Divorciado(a)','Viudo(a)'],
                nrcuenta:'',
                fecharetiro:'',
                observaciones:''


            }

        },
        computed:{
            sicompleto(){
                let me=this;
                if (me.nombre!='' )
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
            listarEmpleados(page){
                let me=this;
                var url='/empleado?page='+page+'&buscar='+me.buscar;
                axios.get(url).then(function(response){
                    var respuesta=response.data;
                    me.pagination=respuesta.pagination;
                    me.arrayEmpleados=respuesta.empleados.data;
                    
                    
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            cambiarPagina(page){
                let me =this;
                me.pagination.current_page = page;
                me.listarEmpleados(page);
            },
            registrarempleado(){
                let me = this;
                axios.post('/empleado/registrar',{
                    'nombre':me.nombre,
                    'apaterno':me.apaterno,
                    'amaterno':me.amaterno,
                    'ci':me.ci,
                    'telefonos':me.telefono,
                    'idformacion':me.formacion,
                    'idprofesion':me.profesion,
                    'idcargo':me.cargo,
                    'fechanacimiento':me.fechanacimiento,
                    'domicilio':me.domicilio,
                    'ciudad':me.ciudad,
                    'fechaingreso':me.fechaingreso,
                    'sexo':me.sexo,
                    'estadocivil':me.estadocivil,
                    'nrcuenta':me.nrcuenta,
                    'fecharetiro':me.fecharetiro,
                    'obs':me.observaciones,
                }).then(function(response){
                    me.cerrarModal('registrar');
                    me.listarEmpleados();
                }).catch(function(error){
                    console.log(error);
                });

            },
            eliminarempleado(idempleado){
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
                     axios.put('/empleado/desactivar',{
                        'id': idempleado
                    }).then(function (response) {
                        
                        swalWithBootstrapButtons.fire(
                            'Desactivado!',
                            'El registro a sido desactivado Correctamente',
                            'success'
                        )
                        me.listarEmpleados();
                        
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
            activarempleado(idempleado){
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
                     axios.put('/empleado/activar',{
                        'id': idempleado
                    }).then(function (response) {
                        
                        swalWithBootstrapButtons.fire(
                            'Activado!',
                            'El registro a sido Activado Correctamente',
                            'success'
                        )
                        me.listarEmpleados();
                        
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
            actualizarempleado(){
               // const Swal = require('sweetalert2')
                let me =this;
                axios.put('/empleado/actualizar',{
                    'id':me.idempleado,
                    'nombre':me.nombre,
                    'apaterno':me.apaterno,
                    'amaterno':me.amaterno,
                    'ci':me.ci,
                    'telefonos':me.telefono,
                    'idformacion':me.formacion,
                    'idprofesion':me.profesion,
                    'idcargo':me.cargo,
                    'fechanacimiento':me.fechanacimiento,
                    'domicilio':me.domicilio,
                    'ciudad':me.ciudad,
                    'fechaingreso':me.fechaingreso,
                    'sexo':me.sexo,
                    'estadocivil':me.estadocivil,
                    'nrcuenta':me.nrcuenta,
                    'fecharetiro':me.fecharetiro,
                    'obs':me.observaciones,
                    
                }).then(function (response) {
                    if(response.data.length){
                    }
                    // console.log(response)
                    else{
                            Swal.fire('Actualizado Correctamente')

                        me.listarEmpleados();
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
                        me.tituloModal='Registar empleado'
                        me.tipoAccion=1;
                        me.nombre='';
                        me.apaterno='';
                        me.amaterno='';
                        me.ci='';
                        me.telefono='';
                        me.formacion=0;
                        me.profesion=0;
                        me.cargo=0;
                        me.fechanacimiento='';
                        me.domicilio='';
                        me.ciudad='';
                        me.fechaingreso='';
                        me.sexo=0;
                        me.estadocivil=0;
                        me.nrcuenta='';
                        me.fecharetiro='';
                        me.observaciones='';
                        me.classModal.openModal('registrar');
                        break;
                    }
                    
                    case 'actualizar':
                    {
                        me.idempleado=data.id;
                        me.tipoAccion=2;
                        me.tituloModal='Actualizar empleado'
                        me.nombre=data.nombre;
                        me.apaterno=data.apaterno;
                        me.amaterno=data.amaterno;
                        me.ci=data.ci;
                        me.telefono=data.telefonos;
                        me.formacion=data.idformacion;
                        me.profesion=data.idprofesion;
                        me.cargo=data.idcargo;
                        me.fechanacimiento=data.fechanacimiento;
                        me.domicilio=data.domicilio;
                        me.ciudad=data.ciudad;
                        me.fechaingreso=data.fechaingreso;
                        me.sexo=data.sexo;
                        me.estadocivil=data.estadocivil;
                        me.nrcuenta=data.nrcuenta;
                        me.fecharetiro=data.fecharetiro;
                        me.observaciones=data.obs;
                        me.classModal.openModal('registrar');
                        break;
                    }

                }
                
            },
            cerrarModal(accion){
                let me = this;
                me.classModal.closeModal(accion);
                me.tipoAccion=1;
                me.nombre='';
                me.apaterno='';
                me.amaterno='';
                me.ci='';
                me.telefono='';
                me.formacion=0;
                me.profesion=0;
                me.cargo=0;
                me.fechanacimiento='';
                me.domicilio='';
                me.ciudad='';
                me.fechaingreso='';
                me.sexo=0;
                me.estadocivil=0;
                me.nrcuenta='';
                me.fecharetiro='';
                me.observaciones='';
                me.tipoAccion=1;
                
                
            },
            selectAll: function (event) {
                setTimeout(function () {
                    event.target.select()
                }, 0)
            },  
            selectProfesions(){
                let me=this;
                var url='/profesion/selectprofesion';
                axios.get(url).then(function(response){
                    var respuesta=response.data;
                    me.arrayProfesion=respuesta;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            selectFormacions(){
                let me=this;
                var url='/formacion/selectformacion';
                axios.get(url).then(function(response){
                    var respuesta=response.data;
                    me.arrayFormacion=respuesta;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            selectCargos(){
                let me=this;
                var url='/cargo/selectcargo';
                axios.get(url).then(function(response){
                    var respuesta=response.data;
                    me.arrayCargo=respuesta;
                })
                .catch(function(error){
                    console.log(error);
                });
            },



        },
        mounted() {
            this.selectProfesions();
            this.selectFormacions();
            this.selectCargos();
            this.listarEmpleados(1);
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
