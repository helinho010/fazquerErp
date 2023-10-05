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
                        <label for="basic-url">Precio de Lista</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="basic-url">Cantidad Dispenser</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="basic-url">Precio de Compra</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="basic-url">Precio de Venta</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                            <button class="btn btn-primary" type="button" id="button-addon1">
                                <i class="fa fa-calculator" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="basic-url">Margen 30%</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="basic-url">Margen 40%</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="basic-url">Utilidad Neta (en %)</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
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
                    <div class="col-md-1">
                        <label for="basic-url">Precio de Compra</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label for="basic-url">Descuento %</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label for="basic-url">Descuento %</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label for="basic-url">Descuento %</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label for="basic-url">Descuento Bs.</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label for="basic-url">Precio C/Desc.</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label for="basic-url">Precio Unitario</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label for="basic-url">Liq. 30 %</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="basic-url">Liq. 40%</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="basic-url">P/U de Compra</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="basic-url">Utilidad Bruta</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="basic-url">Utilidad Bruta%</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="basic-url">Precio de Venta</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                            <button class="btn btn-primary" type="button" id="button-addon1">
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

</script>

<style scoped>
    label{
        font-weight: bold;
        font-size: 13px;
    }
    h5{
        text-decoration-line: underline overline;
    }
    #area-botones-guarcancelar
    {
        margin: 50px;
    }

    #area-botones-guarcancelar > button
    {
        margin-left: 15px;
    }
    
</style>