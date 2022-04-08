<template>
    <main class="main">
       <div class="rounded-2 mx-2 my-2 px-2 py-2" style="text-align:center; text-color:white; background-color:lightseagreen">
           <h3>Bienvenido 
               <small class="text-muted">Puerto del Rosario</small>
           </h3>
       </div>
       <!-- <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">  
                            <button @click="menu=10" class="btn px-3 py-3 my-3 m-t3" style="color">hola mundoadfawef <br>klajfie</button>                        
                                <div class="row">
                                    <div class="col-md-4 col-xl-4">
                                    
                                    <div class="card bg-c-blue order-card">
                                            <div class="button-block">
                                            <h5>Usuarios</h5>                                               
                                                @php
                                                 use App\Models\User;
                                                $cant_usuarios = User::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{$cant_usuarios}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a></p>
                                            </div>                                            
                                        </div>                                    
                                    </div>
                                    
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                            <h5>Roles</h5>                                               
                                                @php
                                                use Spatie\Permission\Models\Role;
                                                 $cant_roles = Role::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-user-lock f-left"></i><span>{{$cant_roles}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/roles" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>                                                                
                                    
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h5>Blogs</h5>                                               
                                                @php
                                                 use App\Models\Blog;
                                                $cant_blogs = Blog::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-blog f-left"></i><span>{{$cant_blogs}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/blogs" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
            
        
    </main>
</template>