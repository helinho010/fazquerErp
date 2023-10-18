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
                <!-- <div class="card-header">
                    <i class="fa fa-align-justify"></i> Almacen
                    <button type="button" class="btn btn-secondary" @click="abrirModal('registrar')">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div> -->
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-2" style="text-align:center">
                            <label for="">Tiendas y/o Almacenes Disponibles:</label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <select class="form-control" @change="listarProductosTiendaAlmacen(1)"
                                    v-model="tiendaalmacenselected">
                                    <option value="0" disabled>Seleccionar...</option>
                                    <option v-for="almacen in arrayAlmacenes" :key="almacen.id" :value="almacen.id"
                                        v-text="(almacen.codsuc === null ? '' : almacen.codsuc + ' -> ') + almacen.codigo + ' ' + almacen.nombre_almacen">
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar"
                                    v-model="buscar" @keyup.enter="listarAlmacenes(1)">
                                <button type="submit" class="btn btn-primary" @click="listarAlmacenes(1)"><i
                                        class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm table-responsive">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Codigo Producto</th>
                                <th>Linea</th>
                                <th>Entrada</th>
                                <th>Cant. Entrada</th>
                                <th>Stock</th>
                                <th>Precio Lista</th>
                                <th>Precio U.Compra</th>
                                <th>Precio Venta</th>
                                <th>Utilidad Bruta (en %)</th>
                                <th>Fecha de Utilidad</th>
                                <th>Tipo</th>
                                <th>Nombre Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="producto in arrayProductosAlterado" :key="producto.id">
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm"
                                        @click="abrirModal('editarPrecioUtilidadProducto', producto)">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <!-- <button v-if="almacen.activo == 1" type="button" class="btn btn-danger btn-sm"
                                        @click="eliminarAlmacen(almacen.id)">
                                        <i class="icon-trash"></i>
                                    </button>
                                    <button v-else type="button" class="btn btn-info btn-sm"
                                        @click="activarAlamcen(almacen.id)">
                                        <i class="icon-check"></i>
                                    </button> -->
                                </td>
                                <!-- <td v-text="(almacen.codsuc === null ? '': almacen.codsuc+' - ') + almacen.codigo"></td> -->
                                <td> {{ producto.codproducto }}</td>
                                <td>{{ producto.lineaProductoNombre }}</td>
                                <td>{{ producto.nomproducto }} - {{ producto.envaseEmbalajeProductoNombre }} X {{ producto.envaseregistrado.toLowerCase()=='primario'?producto.cantidadprimario:'' }} {{ producto.envaseregistrado.toLowerCase()=='secundario'?producto.cantidadsecundario:'' }} {{ producto.envaseregistrado.toLowerCase()=='terceario'?producto.cantidadterciario:'' }} {{ producto.formaUnidadMedidaProducto }}</td>
                                <td>{{ producto.cantidad }}</td>
                                <td>{{ producto.cantidad }}</td>
                                <td>
                                    <div v-if="producto.activo == 1">
                                        <span class="badge badge-success">
                                          {{ producto.envaseregistrado.toLowerCase()=='primario'?producto.preciolistaprimario:''}} {{ producto.envaseregistrado.toLowerCase()=='secundario'?producto.preciolistasecundario:''}} {{ producto.envaseregistrado.toLowerCase()=='terciario'?producto.preciolistaterciario:''}}
                                        </span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-warning">
                                            {{ producto.envaseregistrado.toLowerCase()=='primario'?producto.preciolistaprimario:''}} {{ producto.envaseregistrado.toLowerCase()=='secundario'?producto.preciolistasecundario:''}} {{ producto.envaseregistrado.toLowerCase()=='terciario'?producto.preciolistaterciario:''}}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div v-if="producto.activo == 1">
                                        <span class="badge badge-success">777Bs</span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-warning">8Bs</span>
                                    </div>
                                </td>
                                <td>
                                    <div v-if="producto.activo == 1">
                                        <span class="badge badge-success">
                                            {{ producto.envaseregistrado.toLowerCase()=='primario'?producto.precioventaprimario:''}} {{ producto.envaseregistrado.toLowerCase()=='secundario'?producto.precioventasecundario:''}} {{ producto.envaseregistrado.toLowerCase()=='terciario'?producto.precioventaterciario:''}} 
                                        </span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-warning">
                                            {{ producto.envaseregistrado.toLowerCase()=='primario'?producto.precioventaprimario:''}} {{ producto.envaseregistrado.toLowerCase()=='secundario'?producto.precioventasecundario:''}} {{ producto.envaseregistrado.toLowerCase()=='terciario'?producto.precioventaterciario:''}} 
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div v-if="producto.activo == 1">
                                        <span class="badge badge-success">70%</span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-warning">8%</span>
                                    </div>
                                </td>
                                <td>
                                    <div v-if="producto.activo == 1">
                                        <span class="badge badge-success">03 - 10 - 2023</span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-warning">03 - 10 - 2023</span>
                                    </div>
                                </td>
                                <td>{{  producto.tipo_entrada }}</td>
                                <td>Admin</td>
                            </tr>

                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#"
                                    @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page"
                                :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#"
                                    @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="calculadoraModal" tabindex="-1" aria-labelledby="calculadoraModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="calculadoraModalLabel">{{ tituloModal }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="" class="form-horizontal">
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label>Precio de Lista</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" v-model="p_lista"
                                                aria-describedby="basic-addon3" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="basic-url">Cantidad Envase o Embalaje</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" v-model="c_disp"
                                                aria-describedby="basic-addon3" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label>Costo de Compra</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" v-model="p_compra"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Precio de Venta</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" v-model="p_venta"
                                                aria-describedby="basic-addon3">
                                            <button class="btn btn-warning" type="button" @click="utilidad">
                                                <i class="fa fa-calculator" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label for="basic-url">Margen 30%</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" v-model="margen_30"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="basic-url">Margen 40%</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" v-model="margen_40"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Utilidad Neta (en %)</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" v-model="utilidad_neta"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="row" id="area-botones-guarcancelar">
                                <button type="button" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-danger">Cancelar</button>
                            </div> -->
                                <hr>
                                <div>
                                    <h5>Gestor de Precios</h5><br>
                                </div>


                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label for="basic-url">Precio de Compra</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="pcc" v-model="pcc"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="basic-url">Descuento %</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="dpc" v-model="dpc1"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="basic-url">Descuento %</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="dpc2" v-model="dpc2"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="basic-url">Descuento %</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="dpc3" v-model="dpc3"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="basic-url">Descuento Bs.</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="dbsc" v-model="dbsc"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="basic-url">Costo Compa C/Desc.</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="pcdc" v-model="pcdc"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="basic-url">Precio Unitario</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="puc" v-model="puc"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="basic-url">Liq. 30 %</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="l30pc" v-model="l30pc"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="basic-url">Liq. 40%</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="l40pc" v-model="l40pc"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label for="basic-url">P/U de Compra</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="pucc" v-model="pucc"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="basic-url">Utilidad Bruta</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="ubc" v-model="ubc"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="basic-url">Utilidad Bruta%</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="upc" v-model="upc"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="basic-url">Precio de Venta</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="pvc" v-model="pvc"
                                                aria-describedby="basic-addon3">
                                            <button class="btn btn-warning" type="button" @click="calculadora">
                                                <i class="fa fa-calculator" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" :disabled="!sicompleto" @click="actualizarRegistrarPrecioVenta">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>


<script>
import Swal from 'sweetalert2';
import { error401 } from '../../errores';
// import router from "@/router";

export default {
    data() {
        return {
            pagination: {
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
            },
            offset: 3,
            tituloModal:'',
            tipo: 0,
            tipoAccion: 1,
            idalmingresoproducto:0,
            buscar: '',
            matriz: 0,
            arrayRubros: [],
            idrubro: 0,
            arrayAlmacenes: [],
            arrayProductos: [],
            arrayProductosAlterado:[],
            arrayLineas:[],
            arrayEmvasesEmbalajes:[],
            arrayFormaUnidadMedidas:[],
            tiendaalmacenselected: 0,
            p_lista: 0,
            c_disp: 0,
            p_compra: 0,
            margen_30: 0,
            margen_40: 0,
            p_venta: 0,
            utilidad_neta: 0,
            pcc: 0,
            dpc1: 0,
            dpc2: 0,
            dpc3: 0,
            dbsc: 0,
            pcdc: 0,
            puc: 0,
            l30pc: 0,
            l40pc: 0,
            pucc: 0,
            ubc: 0,
            upc: 0,
            pvc: 0,
            idProdProducto:0,
            envaseregistradoAlmIngresoProducto:'',
        }

    },
    computed: {

        sicompleto(){
            let me = this;
            if(me.p_venta > 0 && me.margen_30>0 && me.margen_40>0 && me.utilidad_neta>=0)
            {
                return true;
            }
            else{
                return false;
            }
        },

        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++
            }
            return pagesArray;
        },


    },
    methods: {
        
        listarLineas(){
                let me = this;
                var url='/linea/selectlinea';
                axios.get(url).then(function(response){
                    me.arrayLineas=response.data.lineas;
                })
                .catch(function(error){
                    error401(error);
                    console.log(error);
                });
                
        },

        listarEmvasesEmbalajes(){
            let me = this;
            let url = '/dispenser/selectdispenser';
            axios.get(url)
            .then(function(response){
                me.arrayEmvasesEmbalajes=response.data.dispensers;
            })
            .catch(function(error){
                error401(error);
                console.log(error);
            });            
        },

        listarFormaUnidadDeMedida(){
            let me = this;
            let url = '/formafarm/selectformafarm';
            axios.get(url)
            .then(function(response){
                me.arrayFormaUnidadMedidas=response.data.formafarm;
            })
            .catch(function(error){
                error401(error);
                console.log(error);
            });
        },
        
        listarProductosTiendaAlmacen(page) {
            let me = this;
            me.arrayProductosAlterado = [];
            if (me.tiendaalmacenselected != 0) {
                let url = '/almacen/ingreso-producto?page=' + page + '&idalmacen=' + me.tiendaalmacenselected;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.pagination = respuesta.pagination;
                    me.arrayProductos = respuesta.productosAlmacen.data;
                    let nombreLineaDelProducto = '';
                    let nombreEnvaseEmbalajeDelProducto='';
                    let nombreFormaUnidadMedidaProducto='';
                    me.arrayProductos.forEach(element => {
                        nombreLineaDelProducto = me.arrayLineas.find((element2)=>element2.id==element.idlinea).nombre;
                        switch (element.envaseregistrado) {
                            case 'primario':
                                nombreEnvaseEmbalajeDelProducto = me.arrayEmvasesEmbalajes.find((element3)=>element3.id==element.iddispenserprimario).nombre; 
                                nombreFormaUnidadMedidaProducto = me.arrayFormaUnidadMedidas.find((element4)=>element4.id==element.idformafarmaceuticaprimario).nombre;
                                break;
                            case 'secundario':
                                nombreEnvaseEmbalajeDelProducto = me.arrayEmvasesEmbalajes.find((element3)=>element3.id==element.iddispensersecundario).nombre;
                                nombreFormaUnidadMedidaProducto = me.arrayFormaUnidadMedidas.find((element4)=>element4.id==element.idformafarmaceuticasecundario).nombre;    
                                break;
                            case 'terciario':
                                nombreEnvaseEmbalajeDelProducto = me.arrayEmvasesEmbalajes.find((element3)=>element3.id==element.iddispenserterciario).nombre;
                                nombreFormaUnidadMedidaProducto = me.arrayFormaUnidadMedidas.find((element4)=>element4.id==element.idformafarmaceuticaterciario).nombre;
                                break;
                            default:
                                break;
                        }
                        element.lineaProductoNombre = nombreLineaDelProducto;
                        element.envaseEmbalajeProductoNombre = nombreEnvaseEmbalajeDelProducto;
                        element.formaUnidadMedidaProducto = nombreFormaUnidadMedidaProducto;
                        me.arrayProductosAlterado.push(element);
                    });
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },

        caracteresPermitidosTelefono(ex) {
            let me = this;
            if (ex.keyCode == 32 || ex.keyCode == 43 || ex.keyCode == 8 || ex.keyCode == 45 || (ex.keyCode >= 48 && ex.keyCode <= 57)) {
                me.telefono = me.telefono + ex.key;
            }
        },

        selectDepartamentos() {
            let me = this;
            var url = '/depto/selectdepto';
            axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.arrayDepto = respuesta;
            })
                .catch(function (error) {
                    error401(error);
                    console.log(error);
                });
        },

        selectCiudades() {
            let me = this;
            var url = '/ciudad/selectciudad';
            axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.arrayCiudad = respuesta;
            })
                .catch(function (error) {
                    error401(error);
                    console.log(error);
                });
        },

        listarSucursales(page) {
            let me = this;
            var url = '/sucursal?page=' + page + '&buscar=' + me.buscar;
            axios.get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.pagination = respuesta.pagination;
                    //console.log(me.sucursals.data);
                    me.arraySucursales = respuesta.sucursales.data;
                    let resp = me.arraySucursales.find(element => element.tipo == 'Casa_Matriz');
                    if (resp != undefined) {
                        if (resp.tipo == 'Casa_Matriz')
                            me.matriz = 1;
                        else
                            me.matriz = 0;
                    }
                    else
                        me.matriz = 0;
                })
                .catch(function (error) {
                    error401(error);
                });
        },

        listarAlmacenes(page) {
            let me = this;
            var url = '/almacen?page=' + page + '&buscar=' + me.buscar;
            axios.get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    console.log("//////////////////");
                    console.log(respuesta);
                    me.pagination = respuesta.pagination;
                    me.arrayAlmacenes = respuesta.almacenes.data;
                })
                .catch(function (error) {
                    error401(error);
                });
        },


        cambiarPagina(page) {
            let me = this;
            me.pagination.current_page = page;
            me.listarAlmacenes(page);
        },

        actualizarRegistrarPrecioVenta() {
            let me = this;
            axios.post('/gestionprecioventa/actualizar-registrar', {
                'idalmingresoproducto': me.idalmingresoproducto,
                'precio_compra_gespreventa': me.p_compra,
                'precio_venta_prodproductos':me.p_venta,
                'margen_30p_gespreventa': me.margen_30,
                'margen_40p_gespreventa': me.margen_40,
                'utilidad_neto_gespreventa': me.utilidad_neta,
                'idProdProducto':me.idProdProducto,
                'envaseregistrado':me.envaseregistradoAlmIngresoProducto,

            }).then(function (response) {
                me.cerrarModal('calculadoraModal');
                Swal.fire(
                    'Almacen Registrado exitosamente',
                    'Haga click en Ok',
                    'success'
                );
                me.listarProductosTiendaAlmacen();
                
            }).catch(function (error) {
                error401(error);
                console.log(error);
            });
        },

        eliminarAlmacen(idalmacen) {
            let me = this;
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
                    axios.put('/almacen/desactivar', {
                        'id': idalmacen
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
        activarAlamcen(idalmacen) {
            let me = this;
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
                    axios.put('/almacen/activar', {
                        'id': idalmacen
                    }).then(function (response) {
                        me.listarAlmacenes();
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
        actualizarAlmacen() {
            let me = this;
            axios.put('/almacen/actualizar', {
                'id': me.idalmacen,
                'idsucursal': me.sucursalSeleccionado,
                'nombre_almacen': me.nombrealmacen,
                'telefono': me.telefono,
                'direccion': me.direccion,
                'departamento': me.departamento,
                'ciudad': me.ciudad,
            }).then(function (response) {
                me.listarAlmacenes();
                Swal.fire(
                    'Actualizado Correctamente!',
                    'El registro a sido actualizado Correctamente',
                    'success'
                )
            }).catch(function (error) {
                error401(error);
            });
            me.cerrarModal('registrar');
        },

        abrirModal(accion, data = []) {
            let me = this;
            switch (accion) {
                case 'registrar':
                    {
                        me.tituloModal = 'Registar Nuevo Almacen'
                        me.tipoAccion = 1;
                        me.tipo = 0;
                        me.nombrealmacen = '';
                        me.nombrealmacen = '',
                        me.telefono = '';
                        me.direccion = '';
                        me.sucursalSeleccionado = 0;
                        me.departamento = 0;
                        me.ciudad = '';
                        me.idrubro = 0;
                        me.classModal.openModal('registrar');
                        break;
                    }

                case 'actualizar':
                    {
                        me.sucursalSeleccionado = data.idsucursal === null ? 0 : data.idsucursal;
                        me.tipoAccion = 2;
                        me.tituloModal = 'Actualizar Datos del Almacen';
                        me.tipo = data.tipo;
                        me.nombrealmacen = data.nombre_almacen;
                        me.telefono = data.telefono;
                        me.direccion = data.direccion;
                        me.ciudad = data.ciudad;
                        me.departamento = data.departamento;
                        me.idalmacen = data.id;
                        me.classModal.openModal('registrar');
                        break;
                    }
                case 'editarPrecioUtilidadProducto':
                    {
                        let me = this;
                        console.log("33333333333333*****");
                        console.log(data);
                        me.idProdProducto=data.id_prod_producto;
                        me.envaseregistradoAlmIngresoProducto=data.envaseregistrado;
                        axios.get('/gestionprecioventa/verificarProductoConPrecio?id_alm__ingreso_producto='+data.id)   
                        .then(function (response) {
                            console.log("Tanto tiempo por hacer esot");   
                            console.log(response.data);   
                            console.log(response.data.length);    
                            
                            me.idalmingresoproducto = data.id;
                            if (response.data.length == 1) 
                            {
                                me.margen_30 = response.data[0].margen_30p_gespreventa;
                                me.margen_40 = response.data[0].margen_40p_gespreventa;
                                me.utilidad_neta = response.data[0].utilidad_neto_gespreventa;
                            }
                            else{
                                me.p_venta = 0;
                                me.utilidad_neta = 0;
                                me.margen_30 = 0;
                                me.margen_40 = 0;
                                me.dpc1 = 0;
                                me.dpc2 = 0;
                                me.dpc3 = 0;
                                me.dbsc = 0;
                                me.l30pc = 0;
                                me.l40pc = 0;
                                me.pucc = 0;
                                me.ubc = 0;
                                me.upc =  0;
                                me.pvc = 0;
                            }
                            
                        }).catch(function (error) {
                            error401(error);
                            console.log(error);
                        });
                        switch (data.envaseregistrado) 
                                {
                                    case 'primario':
                                        me.p_lista = data.preciolistaprimario;
                                        me.p_compra = data.preciolistaprimario/data.cantidadprimario;
                                        me.c_disp=data.cantidadprimario;
                                        me.pcc = data.preciolistaprimario;
                                        me.p_venta = data.precioventaprimario;   
                                        break;
                                    case 'secundario':
                                        me.p_lista = data.preciolistasecundario;
                                        me.p_compra = data.preciolistasecundario/data.cantidadsecundario;
                                        me.c_disp=data.cantidadsecundario;
                                        me.pcc = data.preciolistasecundario;
                                        me.p_venta = data.precioventasecundario;    
                                        break;

                                    case 'terciario':
                                        me.p_lista = data.preciolistaterciario;
                                        me.p_compra = data.preciolistaterciario/data.cantidadterciario;
                                        me.c_disp=data.cantidadterciario;
                                        me.pcc = data.preciolistaterciario;
                                        me.p_venta = data.precioventaterciario;
                                        break;
                                        
                                    default:
                                        break;
                                }
                                me.pcdc = me.pcc;
                                me.puc = me.pcdc/me.c_disp;

                        // me.tipoAccion = 3;
                        // me.idalmingresoproducto = data.id;
                        // me.tituloModal = 'Modificar Utilidad del Producto';
                        // me.p_venta = 0;
                        // me.utilidad_neta = 0;
                        // me.dpc1 = 0;
                        // me.dpc2 = 0;
                        // me.dpc3 = 0;
                        // me.dbsc = 0;
                        // me.l30pc = 0;
                        // me.l40pc = 0;
                        // me.pucc = 0;
                        // me.ubc = 0;
                        // me.upc =  0;
                        // me.pvc = 0; 
                          
                        me.classModal.openModal('calculadoraModal');
                        break;
                    }

            }

        },

        cerrarModal(accion) {
            let me = this;
            me.classModal.closeModal(accion);
            me.tipoAccion = 1;
            me.margen_30 = 0;
            me.margen_40 = 0;
            me.p_venta = 0;
            me.utilidad_neta = 0;
            me.dpc1 = 0;
            me.dpc2 = 0;
            me.dpc3 = 0;
            me.dbsc = 0;
            me.l30pc = 0;
            me.l40pc = 0;
            me.pucc = 0;
            me.ubc = 0;
            me.upc =  0;
            me.pvc = 0;
            
        },

        selectAll: function (event) {
            setTimeout(function () {
                event.target.select()
            }, 0)
        },

        selectRubros() {
            let me = this;
            var url = '/rubro/selectrubro';
            axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.arrayRubros = respuesta;
            })
                .catch(function (error) {
                    error401(error);
                    console.log(error);
                });
        },

        utilidad() {

            let me = this;
            // var p_compra = parseFloat(me.p_compra);
            me.margen_30 = ((parseFloat(me.p_compra) * 100) / 70).toFixed(2);

            // $("#margen_30p_utilidad").val(margen_30);
            me.margen_40 = ((parseFloat(me.p_compra) * 100) / 60).toFixed(2);
            // $("#margen_40p_utilidad").val(margen_40);

            // var p_venta = parseFloat($("#precio_venta_utilidad").val());
            me.utilidad_neta = ((parseFloat(me.p_venta) - parseFloat(me.p_compra)) / me.p_venta) * 100;
            me.utilidad_neta = Math.round(me.utilidad_neta);
            // $("#neto_utilidad").val(utilidad_neta);
        },

        calculadora() {
            let me = this;
            me.pcc = parseFloat(me.p_lista);
            me.dpc1 = parseFloat(me.dpc1);
            me.dpc2 = parseFloat(me.dpc2);
            me.dpc3 = parseFloat(me.dpc3);

            me.dbsc = parseFloat(me.dbsc);
            var cd = parseInt(me.c_disp);
            me.pcdc = (me.pcc - me.dbsc - (me.pcc * me.dpc1 / 100)).toFixed(2);
            me.pcdc = (me.pcdc - (me.pcdc * me.dpc2 / 100)).toFixed(2);
            me.pcdc = (me.pcdc - (me.pcdc * me.dpc3 / 100)).toFixed(2);

            // $("#pcdc").val(pcdc);
            me.puc = me.pcdc / cd;
            // $("#puc").val(puc);
            me.l30pc = ((me.puc * 100) / 70).toFixed(2);
            me.l40pc = ((me.puc * 100) / 60).toFixed(2);
            // $("#l30pc").val(li30);
            // $("#l40pc").val(li40);
            me.pucc = parseFloat(me.pucc);
            me.pvc = parseFloat(me.pvc).toFixed(2);
            me.ubc = (me.pvc - me.pucc).toFixed(2);
            // $("#ubc").val(ubc);
            me.upc = ((me.ubc * 100) / me.pvc);
            // $("#upc").val(upc);
        }

    },

    mounted() {
        this.selectRubros();
        this.listarLineas();
        this.listarEmvasesEmbalajes();
        this.listarFormaUnidadDeMedida();
        this.listarAlmacenes(1);
        this.listarSucursales(1);
        this.selectDepartamentos();
        this.selectCiudades();
        this.classModal = new _pl.Modals();
        this.classModal.addModal('calculadoraModal');
        //console.log('Component mounted.')
    }
}
</script>
<style scoped>h1 {
    color: red;
}

label {
    font-size: 11px;
}

.modal-xl {
    width: 900px;
}
table > thead > tr > th {
    text-align: center;
    display: table-cell;
    vertical-align: middle;    
}
</style>