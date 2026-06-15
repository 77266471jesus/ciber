<?php

namespace App\Http\Livewire\Pagina;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Subcategoria;
use Livewire\Component;
use Livewire\WithPagination;

class VistaProductos extends Component
{
    use WithPagination;

    public $listen_subcategorias = 'desactivado';
    public $listen_productos;
    public $subcategorias_consulta, $categoria_id;
    public $productos_consulta, $subcategoria_id;
    public $search;

    public function mount()
    {
        $this->categoria_id = new Subcategoria();
        $this->subcategoria_id = new Producto();

        $this->productos_consulta = Producto::select('nombre', 'marca', 'image', 'precio_venta')
            ->where('condicion', 'activado')
            ->orderBy('nombre', 'asc')
            ->get();
    }
    public function subcategorias(Categoria $categoria)
    {
        $this->categoria_id = $categoria;
        $this->subcategorias_consulta = Subcategoria::select('id', 'nombre')
            ->where('categoria_id', $this->categoria_id->id)
            ->where('condicion', 'activado')
            ->orderBy('nombre', 'asc')
            ->get();
        $this->listen_subcategorias = 'activado';
    }
    public function productos(Subcategoria $subcategoria)
    {
        $this->subcategoria_id = $subcategoria;
        $this->listen_productos = true;
    }
    public function categorias()
    {
        $this->listen_subcategorias = 'desactivado';
    }

    public function render()
    {
        $subcategorias = $this->subcategorias_consulta;

        $productos = $this->productos_consulta;

        $categorias = Categoria::select('id', 'nombre')
            ->where('condicion', 'activado')
            ->orderBy('nombre', 'asc')
            ->get();

        if ($this->listen_productos) {
            $productos = Producto::select('nombre', 'marca', 'image', 'precio_venta', 'slug')
                ->where('condicion', 'activado')
                ->where('subcategoria_id', $this->subcategoria_id->id)
                ->where(function ($query) {
                    $query->where('nombre', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('marca', 'LIKE', '%' . $this->search . '%');
                })
                ->orderBy('nombre', 'asc')
                ->paginate(10);
        } else {
            $productos = Producto::select('nombre', 'marca', 'image', 'precio_venta', 'slug')
                ->where('condicion', 'activado')                
                ->where(function ($query) {
                    $query->where('nombre', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('marca', 'LIKE', '%' . $this->search . '%');
                })
                ->orderBy('nombre', 'asc')
                ->paginate(10);
        }

        return view('livewire.pagina.vista-productos', compact('categorias', 'subcategorias', 'productos'))
            ->extends('layouts.pagina');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
