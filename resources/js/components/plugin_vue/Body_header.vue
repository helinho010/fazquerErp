<template>
<!-- <main>
    <div><h1>hola</h1></div>
</main>
 -->

   <main class="ml-auto"> 
  <ul class="nav navbar-nav ml-auto"> 
        <li>
             <div class="text-center" style="width: 300px;">
                    <span>Sucursal: </span><strong> {{ nomsucursal }} - {{ nomrol }}</strong>
                </div>
        </li>
        <li id="valueSession" class=" d-md-down-none" style="font-size: 13px; padding-right: 10px;">
            <a class="nav-link" href="#">
                
                <div class="text-center" style="width: 156px;">
                    <span>Tu sesión expira en :</span> <strong id="timeout"></strong>
                </div>
            </a> 
        </li>
        <li id="clockSession" class="nav-item dropdown navItem d-md-down-none" style="font-size: 26px;">
            <a class="nav-link spring" href="#"> <i class="icon-clock"></i> </a>
        </li>

       <li class="nav-item dropdown navItem">
           
            <a class="avatar nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
             aria-expanded="false"
             style="width: auto;    height: 100%; padding: 0px 14px 0px 17px; display: inline-flex;  vertical-align: middle;">
               <span class="icon-bell" style="  margin: auto !important;"></span>
               <span class="badge badge-pill badge-danger">5</span>
           </a>
           <div class="dropdown-menu dropdown-menu-right">
               <div class="dropdown-header text-center">
                   <strong>Notificaciones</strong>
               </div>
               <a class="dropdown-item" href="#">
                   <i class="fa fa-envelope-o"></i> Ventas Pendientes
                   <span class="badge badge-success">3</span>
               </a>
               <a class="dropdown-item" href="#">
                   <i class="fa fa-tasks"></i> Devoluciones
                   <span class="badge badge-danger">2</span>
               </a>
           </div>
       </li>
       <li class="nav-item dropdown navItem">
           <a class="avatar nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
               aria-expanded="false"
               style="width: auto;    height: 100%; padding: 0px 14px 0px 17px; display: inline-flex;  vertical-align: middle;">
                 <span class="d-md-down-none"
                   style="align-content: center; width: inherit;display: grid;    padding: 0 10px 0 10px;">
                   <b>{{usuario}}</b> </span>
               <img class="img-avatar" src="img/avatars/persona.png" style="  margin: auto !important;"
                   alt="admin@bootstrapmaster.com">
             
           </a>
           <div class="dropdown-menu dropdown-menu-right">
               <div class="dropdown-header text-center">
                   <strong>Cuenta </strong> 
               </div>
               <a class="dropdown-item" id="logoutUser" href="#" @click="logout"><i class="fa fa-lock"></i> Cerrar sesión</a>
           </div>
       </li>
        
    </ul>
  </main>
</template>

<script> 
import Swal from 'sweetalert2';
    export default {
         props : ['user','nomsucursal','nomrol'],

         
        data (){
            return {
                usuario:this.user,
                nomsucursal:this.nomsucursal,
                nomrol:this.nomrol,
            }
        },  
        methods : {  

            logout(event){
                //console.log('entralogout');
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Desea Cerrar Sesion',
                
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Si, Cerrar',
                cancelButtonText: 'No, Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href='/logout';
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
            }
            
        }  ,
        mounted(){
            //console.log("cargado");
        }
       
    }
</script>
<style> 

</style>
