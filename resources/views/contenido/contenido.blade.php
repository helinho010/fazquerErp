@extends('principal')
@section('contenido')
<template v-if="menu==0">
    <principal-component></principal-component>
</template>


{{--  <template v-if="menu==104">
    <sucursal-component></sucursal-component>
</template>

</template>
<template v-if="menu==101">
   <modulo-component></modulo-component>
</template>

</template>
<template v-if="menu==102">
   <rolpermiso-component></rolpermiso-component>
</template>

</template>
<template v-if="menu==103">
   <usuario-component></usuario-component>
</template>

<template v-if="menu==105">
    <rubros-component></rubros-component>
</template>
<template v-if="menu==205">
    <rrhempleados-component></rrhempleados-component>
</template>

<template v-if="menu==201">
    <rrhnivel-component></rrhnivel-component>
</template>

<template v-if="menu==202">
    <rrhprofesion-component></rrhprofesion-component>
</template>

<template v-if="menu==204">
    <rrhcargos-component></rrhcargos-component>
</template>

<template v-if="menu==203">
    <rrhuorg-component></rrhuorg-component>
</template> --}}


@endsection

@section('bodyheader') 
@php   
    use App\Http\Controllers\AdmUserController;
    $user = AdmUserController::getUser();  
    $idsucursal=session('idsucursal');
    
    $nomsucursal=session('nomsucursal');
    $nomrole=session('nomrole');
    //dd($nomsucursal);
    //dd($user->name);
    //dd($sucursalselected);
    echo '
             <Body_header user="'. $user->name.'" nomsucursal="'.$nomsucursal.'" nomrole="'.$nomrole.'"></Body_header> 
          ';
                                                                                                                                                  
    @endphp
        
    @endsection