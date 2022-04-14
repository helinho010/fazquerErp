@extends('principal')
@section('contenido')
<template v-if="menu==0">
    <principal-component></principal-component>
</template>
 <template v-if="menu==104">
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
</template>

{{--
<template v-if="menu==1">
    <area-component></area-component>

</template>
    
<template v-if="menu==2">
    <prestaciones-component></prestaciones-component>
</template>

<template v-if="menu==3">
    <descuentos-component></descuentos-component>
</template>
<template v-if="menu==31">
    <descproductos-component></descproductos-component>
</template>

<template v-if="menu==4">
    <ventas-component></ventas-component>
</template>

<template v-if="menu==5">
    <histventas-component></histventas-component>
</template>

<template v-if="menu==60">
    <linea-component></linea-component>
</template>

<template v-if="menu==61">
    <producto-component></producto-component>
</template>

<template v-if="menu==62">
    <dispenser-component></dispenser-component>
</template>

<template v-if="menu==63">
    <formafarm-component></formafarm-component>
</template>
<template v-if="menu==64">
    <categoria-component></categoria-component>
</template>

<template v-if="menu==70">
    <codificacion-component></codificacion-component>
</template>

<template v-if="menu==71">
    <almacen-component></almacen-component>
</template>

<template v-if="menu==9">
    <h1>Contenido menu 9</h1>
</template>

<template v-if="menu==11">
    <h1>Contenido menu 11</h1>
</template>

<template v-if="menu==12">
    <h1>Contenido menu 12</h1>
</template> --}}

@endsection

@section('bodyheader') 
@php   
    use App\Http\Controllers\AdmUserController;
    $user = AdmUserController::getUser();  
    //dd($user->name);
    echo '
             <Body_header user="'. $user->name.'"></Body_header> 
          ';
                                                                                                                                                  
    @endphp
        
    @endsection