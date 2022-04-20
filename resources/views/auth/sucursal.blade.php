@extends('layouts.app')

@section('title','Sucursal')

@section('content')
<div class="bloc mx-auto my-12 p-8 bg-white w-1/3 border border-gray-200 rounded-lg shadow-lg">
    <h1 class="text-3xl text-center font-bold">Inicio de Session</h1>
    
    <form action="" class="mt-4" method="POST">
        @csrf
        <select name="sucur" id="" class="form-control">Seleccionar Sucursal
            @foreach ($sucursales as $item)
                <option value="{{ $item->id }}">{{ $item->nomsuc }}  - {{ $item->nomrole }}  </option>
            @endforeach
            
        </select>
        
        <button type="submit" class="rounded-md bg-indigo-500 w-full text-lg text-white font-semibold p-2 my-3 hover:bg-indigo-600">Seleccionar</button>
    </form> 
</div>
    
    

    
@endsection