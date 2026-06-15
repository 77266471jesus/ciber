<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Gerente']);
        $role3 = Role::create(['name' => 'Secretaria']);
        $role4 = Role::create(['name' => 'Vendedor']);
        $role5 = Role::create(['name' => 'Usuario']);

        $permission = Permission::create(['name' => 'admin.escritorio', 'description' => 'Escritorio', 'color' => '#800080' ])->syncRoles([$role1, $role2, $role3, $role4]);
        
        $permission = Permission::create(['name' => 'admin.roles', 'description' => 'Vista Roles', 'color' => '#FF0000'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.roles.create', 'description' => 'Crear Roles', 'color' => '#FF0000'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.roles.update', 'description' => 'Editar Rol', 'color' => '#FF0000'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.roles.delete', 'description' => 'Eliminar Rol', 'color' => '#FF0000'])->syncRoles([$role1]);
        
        $permission = Permission::create(['name' => 'admin.usuarios', 'description' => 'Vista Usuarios', 'color' => '#000080'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.usuarios.create', 'description' => 'Crear Usuario', 'color' => '#000080'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.usuarios.update', 'description' => 'Editar Usuario', 'color' => '#000080'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.usuarios.delete', 'description' => 'Eliminar Usuario', 'color' => '#000080'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.usuarios.password', 'description' => 'Cambiar Contraseña', 'color' => '#000080'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.usuarios.excel', 'description' => 'Exportar Excel Usuarios', 'color' => '#000080'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.categorias', 'description' => 'Vista Categorias', 'color' => '#808000'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.categorias.create', 'description' => 'Crear Categoria', 'color' => '#808000'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.categorias.update', 'description' => 'Editar Categoria', 'color' => '#808000'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.categorias.delete', 'description' => 'Eliminar Categoria', 'color' => '#808000'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.categorias.estado', 'description' => 'Cambiar Estado Categoria', 'color' => '#808000'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.categorias.excel', 'description' => 'Exportar Excel Categorias', 'color' => '#808000'])->syncRoles([$role1, $role2, $role3]);

        $permission = Permission::create(['name' => 'admin.subcategorias', 'description' => 'Vista Subcategoria', 'color' => '#00FF00'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.subcategorias.create', 'description' => 'Crear Subcategoria', 'color' => '#00FF00'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.subcategorias.update', 'description' => 'Editar Subcategoria', 'color' => '#00FF00'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.subcategorias.delete', 'description' => 'Eliminar Subcategoria', 'color' => '#00FF00'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.subcategorias.estado', 'description' => 'Cambiar Estado Subcategoria', 'color' => '#00FF00'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.subcategorias.excel', 'description' => 'Exportar Excel Subcategorias', 'color' => '#00FF00'])->syncRoles([$role1, $role2, $role3]);

        $permission = Permission::create(['name' => 'admin.productos', 'description' => 'Ver Productos', 'color' => '#008000'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.productos.create', 'description' => 'Crear Producto', 'color' => '#008000'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.productos.update', 'description' => 'Editar Producto', 'color' => '#008000'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.productos.delete', 'description' => 'Eliminar Producto', 'color' => '#008000'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.productos.estado', 'description' => 'Cambiar Estado de Producto', 'color' => '#008000'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.productos.excel', 'description' => 'Exportar Excel Productos', 'color' => '#008000'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.productos.precio', 'description' => 'Mostrar Precio Producto', 'color' => '#008000'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);
        
        $permission = Permission::create(['name' => 'admin.proveedors', 'description' => 'Ver Proveedores', 'color' => '#00FFFF'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.proveedors.create', 'description' => 'Crear Proveedor', 'color' => '#00FFFF'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.proveedors.update', 'description' => 'Editar Proveedor', 'color' => '#00FFFF'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.proveedors.excel', 'description' => 'Exportar Excel Proveedores', 'color' => '#00FFFF'])->syncRoles([$role1, $role2, $role3]);

        $permission = Permission::create(['name' => 'admin.ingresos', 'description' => 'Ver Ingresos de Compras', 'color' => '#00FF00'])->syncRoles([$role1, $role2, $role3, $role4]);
        $permission = Permission::create(['name' => 'admin.create-ingreso', 'description' => 'Crear Ingresos de Compra', 'color' => '#008080'])->syncRoles([$role1, $role2, $role3, $role4]);
        $permission = Permission::create(['name' => 'admin.ingresos.estado', 'description' => 'Cambiar Estado de Compra', 'color' => '#008080'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.ingresos.excel', 'description' => 'Exportar Excel Compra', 'color' => '#008080'])->syncRoles([$role1, $role2, $role3]);
        
        $permission = Permission::create(['name' => 'admin.clientes', 'description' => 'Ver Clientes', 'color' => '#FF5733'])->syncRoles([$role1, $role2, $role3, $role4]);
        $permission = Permission::create(['name' => 'admin.clientes.create', 'description' => 'Crear Cliente', 'color' => '#FF5733'])->syncRoles([$role1, $role2, $role3, $role4]);
        $permission = Permission::create(['name' => 'admin.clientes.update', 'description' => 'Editar Cliente', 'color' => '#FF5733'])->syncRoles([$role1, $role2, $role3, $role4]);
        $permission = Permission::create(['name' => 'admin.clientes.usuario', 'description' => 'Crear Cliente Usuario', 'color' => '#FF5733'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.clientes.excel', 'description' => 'Exportar Excel Clientes', 'color' => '#FF5733'])->syncRoles([$role1, $role2, $role3]);

        $permission = Permission::create(['name' => 'admin.ventas', 'description' => 'Ver Ventas', 'color' => '#0000FF'])->syncRoles([$role1, $role2, $role3, $role4]);
        $permission = Permission::create(['name' => 'admin.create.venta', 'description' => 'Crear Venta', 'color' => '#0000FF'])->syncRoles([$role1, $role2, $role3, $role4]);
        $permission = Permission::create(['name' => 'admin.ventas.estado', 'description' => 'Cambiar Estado de Venta', 'color' => '#0000FF'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.ventas.excel', 'description' => 'Exportar Excel de Ventas', 'color' => '#0000FF'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.factura', 'description' => 'Imprimir Factura', 'color' => '#0000FF'])->syncRoles([$role1, $role2, $role3, $role4]);
        $permission = Permission::create(['name' => 'admin.boleta', 'description' => 'Imprimir Boleta', 'color' => '#0000FF'])->syncRoles([$role1, $role2, $role3, $role4]);

        $permission = Permission::create(['name' => 'admin.cotizacion', 'description' => 'Ver Cotizaciones', 'color' => '#800080'])->syncRoles([$role1, $role2, $role3, $role4]);
        $permission = Permission::create(['name' => 'admin.create.cotizacion', 'description' => 'Crear Cotizacion', 'color' => '#800080'])->syncRoles([$role1, $role2, $role3, $role4]);
        $permission = Permission::create(['name' => 'admin.cotizacion.excel', 'description' => 'Exportar Excel Cotizacion', 'color' => '#800080'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.proforma', 'description' => 'Imprimir Proforma', 'color' => '#800080'])->syncRoles([$role1, $role2, $role3, $role4]);
        $permission = Permission::create(['name' => 'pagina.cotizacion', 'description' => 'Pagina Cotizacion', 'color' => '#800080'])->syncRoles([$role5]);

        $permission = Permission::create(['name' => 'admin.estadistica.producto', 'description' => 'Estadistica de Productos', 'color' => '#FF00FF'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.estadistica.usuario', 'description' => 'Estadistica de Usuarios ', 'color' => '#FF00FF'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.estadistica.cliente', 'description' => 'Estadistica de Clientes ', 'color' => '#FF00FF'])->syncRoles([$role1, $role2, $role3]);        
        $permission = Permission::create(['name' => 'admin.estadistica.proveedor', 'description' => 'Estadistica de Proveedor ', 'color' => '#FF00FF'])->syncRoles([$role1, $role2, $role3]);        

        $permission = Permission::create(['name' => 'admin.historial.ventas', 'description' => 'Ver Historial de Ventas', 'color' => '#FFFF00'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.historial.ventas.excel', 'description' => 'Exportar Excel de Ventas', 'color' => '#FFFF00'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.historial.compras', 'description' => 'Ver Historial de Compras', 'color' => '#FFFF00'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.historial.compras.excel', 'description' => 'Exportar Excel Historial de Compras', 'color' => '#FFFF00'])->syncRoles([$role1, $role2, $role3]);

        $permission = Permission::create(['name' => 'admin.kardex', 'description' => 'Ver Registros de Kardex', 'color' => '#000080'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.kardex.excel', 'description' => 'Exportar Excel Registros de Kardex', 'color' => '#000080'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.kardex.pdf', 'description' => 'Imprimir Registros de Kardex', 'color' => '#000080'])->syncRoles([$role1, $role2, $role3]);

        $permission = Permission::create(['name' => 'admin.registro.usuarios', 'description' => 'Ver Registro de Usuarios', 'color' => '#FF0000'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'admin.registro.usuarios.excel', 'description' => 'Exportar Registro de Usuarios', 'color' => '#FF0000'])->syncRoles([$role1, $role2, $role3]);

        $permission = Permission::create(['name' => 'admin.backup', 'description' => 'Crear copia de base de datos', 'color' => '#008080'])->syncRoles([$role1]);
    }
}
