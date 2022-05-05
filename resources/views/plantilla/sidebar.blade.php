<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                Menu Opciones
            </li>

            <?php use App\Http\Controllers\AdmSessionController;
            $vent=AdmSessionController::listarPermisos();
            //dd($vent);
            
            ?>
            @foreach ($vent['modulos'] as $item)
                <li class="nav-item nav-dropdown menudown ">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> 
                        <font color="turquoise" style="text-transform:capitalize">{{ $item->nombre }}</font>
                    </a>
                    <ul class="nav-dropdown-items">
                        @foreach($item->ventanas as $ventana)
                            <li @click="menu={{ $ventana->codventana }}" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>{{ $ventana->nombre }} </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>