<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
            <form action="" class="form-horizontal">
                <div class="form-group row">
                    <div class="col-md-2">
                        <label>Precio de Lista</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" v-model="p_lista" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="basic-url">Cantidad Dispenser</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" v-model="c_disp" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label>Precio de Compra</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" v-model="p_compra" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label>Precio de Venta</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" v-model="p_venta" aria-describedby="basic-addon3">
                            <button class="btn btn-primary" type="button" @click="utilidad">
                                <i class="fa fa-calculator" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="basic-url">Margen 30%</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" v-model="margen_30" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="basic-url">Margen 40%</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" v-model="margen_40" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label>Utilidad Neta (en %)</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" v-model="utilidad_neta" aria-describedby="basic-addon3">
                        </div>
                    </div>
                </div>

                <div class="row" id="area-botones-guarcancelar">
                    <button type="button" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger">Cancelar</button>
                </div>

                <div>
                    <h5>Gestor de Precios</h5><br>
                </div>


                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="basic-url">Precio de Compra</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="pcc" v-model="pcc" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label for="basic-url">Descuento %</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="dpc" v-model="dpc1" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label for="basic-url">Descuento %</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="dpc2" v-model="dpc2" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label for="basic-url">Descuento %</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="dpc3" v-model="dpc3" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label for="basic-url">Descuento Bs.</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="dbsc" v-model="dbsc" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label for="basic-url">Precio C/Desc.</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="pcdc" v-model="pcdc" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label for="basic-url">Precio Unitario</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="puc" v-model="puc" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label for="basic-url">Liq. 30 %</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control"  id="l30pc" v-model="l30pc" aria-describedby="basic-addon3">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="basic-url">Liq. 40%</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="l40pc" v-model="l40pc" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="basic-url">P/U de Compra</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="pucc" v-model="pucc" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="basic-url">Utilidad Bruta</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="ubc" v-model="ubc" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="basic-url">Utilidad Bruta%</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="upc" v-model="upc" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="basic-url">Precio de Venta</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="pvc" v-model="pvc" aria-describedby="basic-addon3">
                            <button class="btn btn-primary" type="button" @click="calculadora">
                                <i class="fa fa-calculator" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</template>


<script>
import Swal from 'sweetalert2';
import { error401 } from '../../errores';

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
            p_lista:0.0,
            c_disp:0.0,
            p_compra:0.0,
            margen_30:0.0,
            margen_40:0.0,
            p_venta:0.0,
            utilidad_neta:0.0,
            pcc:0,
            dpc1:0,
            dpc2:0,
            dpc3:0,
            dbsc:0,
            pcdc:0,
            puc:0,
            l30pc:0,
            l40pc:0,
            pucc:0,
            ubc:0,
            upc:0,
            pvc:0,
        }

    },

    computed: {

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

        listarProductos() {
            let me = this;
            let contador = 1;
            me.opciones = '<option value="0" disabled>Seleccionar...</option>';
            me.opciones2 = [];
            //var url= '/producto/selectproducto2?idalmacen='+me.almacenselected;
            var url = '/producto/getProductosTiendaAlamcenEnvase?idalmacen=' + me.almacenselected + '&envase=' + 'primario';
            axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.productosenvaseprimario = respuesta;
                me.productosenvaseprimario.forEach((element, index) => {
                    if (element.almacenprimario == 1) {
                        me.opciones = me.opciones + '<option data-idproduc="' + element.idproduc + '" data-envase="primario" key="' + element.idproduc + '" value="' + contador + '">' + element.cod + '</option>';
                        me.opciones2.push(
                            {
                                value: contador,
                                codprimario: element.cod,
                                idproduc: element.idproduc,
                                codigointernacional: element.codigointernacional,
                                envase: 'primario',
                            });
                        contador++;
                    }
                });
            })
                .catch(function (error) {
                    error401(error);
                    console.log(error);
                });
            var url = '/producto/getProductosTiendaAlamcenEnvase?idalmacen=' + me.almacenselected + '&envase=' + 'secundario';
            axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.productosenvasesecundario = respuesta;
                me.productosenvasesecundario.forEach((element, index) => {
                    if (element.almacensecundario == 1) {
                        me.opciones = me.opciones + '<option data-idproduc="' + element.idproduc + '" data-envase="secundario" key="' + element.idproduc + '" value="' + contador + '">' + element.cod + '</option>';
                        me.opciones2.push(
                            {
                                value: contador,
                                codsecundario: element.cod,
                                idproduc: element.idproduc,
                                codigointernacional: element.codigointernacional,
                                envase: 'secundario',
                            });
                        contador++;
                    }
                });
            })
                .catch(function (error) {
                    error401(error);
                    console.log(error);
                });
            var url = '/producto/getProductosTiendaAlamcenEnvase?idalmacen=' + me.almacenselected + '&envase=' + 'terciario';
            axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.productosenvaseterciario = respuesta;
                me.productosenvaseterciario.forEach((element, index) => {
                    if (element.almacenterciario == 1) {
                        me.opciones = me.opciones + '<option data-idproduc="' + element.idproduc + '" data-envase="terciario" key="' + element.idproduc + '" value="' + contador + '">' + element.cod + '</option>';
                        me.opciones2.push(
                            {
                                value: contador,
                                codterciario: element.cod,
                                idproduc: element.idproduc,
                                codigointernacional: element.codigointernacional,
                                envase: 'terciario',
                            });
                        contador++;
                    }
                });
            })
                .catch(function (error) {
                    error401(error);
                    console.log(error);
                });
        },

        

        cambiarPagina(page) {
            let me = this;
            me.pagination.current_page = page;
            me.listarProductosAlmacen(page);
        },

        
        abrirModal(accion, data = []) {
            let me = this;
            //me.listarEstantes(me.sucursalselected);
            let respuesta = me.arrayAlmacen.find(element => element.id == me.almacenselected);
            switch (accion) {
                case 'registrar':
                    {
                        if (me.sucursalselected != 0) {
                            me.tituloModal = 'Registar Producto para: ' + respuesta.codsuc + ' -> ' + respuesta.codigo + ' ' + respuesta.nombre_almacen;
                            me.tipoAccion = 1;
                            me.idproductoselected = 0;
                            me.tipo_entrada = 'Compra';
                            me.cantidad = 0;
                            me.lote = '';
                            me.fecha_vencimiento = '';
                            me.registrosanitario = '';
                            me.productoperecedero = 0;
                            me.classModal.openModal('registrar');
                        }
                        else {
                            Swal.fire('Debe Seleccionar un Sucursal')
                        }
                        break;
                    }

                case 'actualizar':
                    {
                        me.tituloModal = 'Actualizar Almacen Para: ' + respuesta.sucursal
                        me.tipoAccion = 2;
                        me.idproducto = data.id;
                        me.idproductoselected = data.idprodproducto;
                        me.cantidad = data.cantidad;
                        me.tipo_entrada = data.tipo_entrada;
                        me.fecha_vencimiento = data.fecha_vencimiento;
                        me.lote = data.lote;
                        me.registrosanitario = data.registro_sanitario;
                        //me.codigointernacional = data.codigo_internacional;
                        me.codigo = JSON.stringify
                            ({
                                idproducto: me.idproductoselected,
                                cantidad: me.cantidad,
                                fechaVencimiento: me.fecha_vencimiento,
                                //codigointernacional:me.codigointernacional,
                                registroSanitario: me.registrosanitario
                            });
                        me.classModal.openModal('registrar');
                        break;
                    }

                case 'bucarProductoIngresoAlmacen':
                    {
                        me.inputTextBuscarProductoIngresoAlmacen = '';
                        me.opciones3 = [];
                        me.classModal.openModal('staticBackdrop');
                    }

            }

        },

        cerrarModal(accion) {
            let me = this;
            if (accion == "registrar") {
                me.classModal.closeModal(accion);
                me.idproducto = [];
                me.clearSelected = 0;
                me.idproductoselected = 0;
                setTimeout(me.tiempo, 200);
                me.cantidad = 0;
                me.tipo_entrada = '';
                me.lote = '';
                me.fecha_vencimiento = '';//me.fechaactual;
                me.codigo = '';
                me.registrosanitario = '';
                me.ubicacionSelected = 0;
                me.estanteselected = 0;
                me.codestante = '';
                me.productoperecedero = 0;
            } else {
                me.classModal.closeModal(accion);
                //me.idproductoselected = me.idproductoselected; 
                me.classModal.openModal('registrar');
            }

        },

        selectAll: function (event) {
            setTimeout(function () {
                event.target.select()
            }, 0)
        },

        utilidad(){

            let me = this;
            // var p_compra = parseFloat(me.p_compra);
            me.margen_30 = ((parseFloat(me.p_compra)*100)/70).toFixed(2);

            // $("#margen_30p_utilidad").val(margen_30);
            me.margen_40 = ((parseFloat(me.p_compra)*100)/60).toFixed(2);
            // $("#margen_40p_utilidad").val(margen_40);

            // var p_venta = parseFloat($("#precio_venta_utilidad").val());
            me.utilidad_neta = ((parseFloat(me.p_venta)-parseFloat(me.p_compra))/me.p_venta)*100;
            me.utilidad_neta = Math.round(me.utilidad_neta);
            // $("#neto_utilidad").val(utilidad_neta);
        },

        calculadora(){
            let me = this;
            me.pcc = parseFloat(me.p_lista);
            me.dpc1 = parseFloat(me.dpc1);
            me.dbsc = parseFloat(me.dbsc);
            var cd = parseInt(me.c_disp);
            me.pcdc = (me.pcc - me.dbsc - (me.pcc*me.dpc1/100)).toFixed(2);
            // $("#pcdc").val(pcdc);
            me.puc = me.pcdc/cd;
            // $("#puc").val(puc);
            me.l30pc = ((me.puc*100)/70).toFixed(2);
            me.l40pc = ((me.puc*100)/60).toFixed(2);
            // $("#l30pc").val(li30);
            // $("#l40pc").val(li40);
            me.pucc = parseFloat(me.pucc);
            me.pvc = parseFloat(me.pvc).toFixed(2);
            me.ubc = (me.pvc - me.pucc).toFixed(2);
            // $("#ubc").val(ubc);
            me.upc = ((me.ubc*100)/me.pvc).toFixed(2);
            // $("#upc").val(upc);
        }
    },

    mounted() {
        // this.obtenerfecha(1);
        // this.listarProductosAlmacen(1);
        // this.listarAlmacenes();
        // this.selectSucursals();
        // this.classModal = new _pl.Modals();
        // this.classModal.addModal('registrar');
        // this.classModal.addModal('staticBackdrop');
        // this.listarProductos();
        //console.log('Component mounted.')
    },

}    
</script>

<style scoped>
label {
    font-weight: bold;
    font-size: 12px;
}

h5 {
    text-decoration-line: underline overline;
}

#area-botones-guarcancelar {
    margin: 50px;
}

#area-botones-guarcancelar>button {
    margin-left: 15px;
}
</style>