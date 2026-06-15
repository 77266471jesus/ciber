<ul class="nav-links">
    @can('admin.escritorio')
        <li class="{{ Request::routeIs('admin.escritorio') ? 'active1' : '' }}">
            <a href="{{ route('admin.escritorio') }}">
                <i class='bx bxs-dashboard link_i'></i>
                <span class="link_name">Escritorio</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('admin.escritorio') }}">Escritorio</a></li>
            </ul>
        </li>
    @endcan
    @canany(['admin.roles', 'admin.usuarios'])
        <li>
            <div
                class="iocn-link {{ Request::routeIs('admin.roles.index') ? 'active2' : '' }}
            {{ Request::routeIs('admin.usuarios') ? 'active2' : '' }}
            {{ Request::routeIs('admin.usuarios.clientes') ? 'active2' : '' }}">
                <a>
                    <i class='bx bxs-user-account link_i'></i>
                    <span class="link_name">Acceso</span>
                </a>
                <i class='bx bxs-chevron-down arrow area_click'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Acceso</a></li>
                @can('admin.usuarios')
                    <li>
                        <a href="{{ route('admin.usuarios') }}"
                            class="{{ Request::routeIs('admin.usuarios') ? 'active3' : '' }}">
                            <i class='bx bx-user-circle sub_circle'></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                @endcan
                @can('admin.usuarios')
                    <li>
                        <a href="{{ route('admin.usuarios.clientes') }}"
                            class="{{ Request::routeIs('admin.usuarios.clientes') ? 'active3' : '' }}">
                            <i class='bx bx-user-circle sub_circle'></i>
                            <span>Clientes</span>
                        </a>
                    </li>
                @endcan
                @can('admin.roles')
                    <li>
                        <a href="{{ route('admin.roles.index') }}"
                            class="{{ Request::routeIs('admin.roles.index') ? 'active3' : '' }}">
                            <i class='bx bx-user sub_circle'></i>
                            <span>Roles</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan
    @canany(['admin.categorias', 'admin.subcategorias', 'admin.productos'])
        <li>
            <div
                class="iocn-link {{ Request::routeIs('admin.categorias') ? 'active2' : '' }}
            {{ Request::routeIs('admin.subcategorias') ? 'active2' : '' }} {{ Request::routeIs('admin.productos') ? 'active2' : '' }}">
                <a>
                    <i class='bx bx-card link_i'></i>
                    <span class="link_name">Almacen</span>
                </a>
                <i class='bx bxs-chevron-down arrow area_click'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Almacen</a></li>
                @can('admin.categorias')
                    <li>
                        <a href="{{ route('admin.categorias') }}"
                            class="{{ Request::routeIs('admin.categorias') ? 'active3' : '' }}">
                            <i class='bx bx-radio-circle sub_circle'></i>
                            <span>Categoria</span>
                        </a>
                    </li>
                @endcan
                @can('admin.subcategorias')
                    <li>
                        <a href="{{ route('admin.subcategorias') }}"
                            class="{{ Request::routeIs('sadmin.ubcategorias') ? 'active3' : '' }}">
                            <i class='bx bx-radio-circle sub_circle'></i>
                            <span>Subcategoria</span>
                        </a>
                    </li>
                @endcan
                @can('admin.productos')
                    <li>
                        <a href="{{ route('admin.productos') }}"
                            class="{{ Request::routeIs('admin.productos') ? 'active3' : '' }}">
                            <i class='bx bx-radio-circle sub_circle'></i>
                            <span>Productos</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcanany
    @canany(['admin.proveedors', 'admin.ingresos'])
        <li>
            <div
                class="iocn-link {{ Request::routeIs('admin.proveedors') ? 'active2' : '' }}
            {{ Request::routeIs('admin.ingresos') ? 'active2' : '' }}">
                <a>
                    <i class='bx bx-package link_i'></i>
                    <span class="link_name">Compras</span>
                </a>
                <i class='bx bxs-chevron-down arrow area_click'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Compras</a></li>
                @can('admin.proveedors')
                    <li>
                        <a href="{{ route('admin.proveedors') }}"
                            class="{{ Request::routeIs('admin.proveedors') ? 'active3' : '' }}">
                            <i class='bx bx-user-pin sub_circle'></i>
                            <span>Proveedor</span>
                        </a>
                    </li>
                @endcan
                @can('admin.ingresos')
                    <li>
                        <a href="{{ route('admin.ingresos') }}"
                            class="{{ Request::routeIs('admin.ingresos') ? 'active3' : '' }}">
                            <i class='bx bx-cylinder sub_circle'></i>
                            <span>Compras</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcanany
    @canany(['admin.clientes', 'admin.ventas'])
        <li>
            <div
                class="iocn-link {{ Request::routeIs('admin.clientes') ? 'active2' : '' }}
            {{ Request::routeIs('admin.ventas') ? 'active2' : '' }}">
                <a>
                    <i class='bx bx-cart-alt link_i'></i>
                    <span class="link_name">Ventas</span>
                </a>
                <i class='bx bxs-chevron-down arrow area_click'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Ventas</a></li>
                @can('admin.clientes')
                    <li>
                        <a href="{{ route('admin.clientes') }}"
                            class="{{ Request::routeIs('admin.clientes') ? 'active3' : '' }}">
                            <i class='bx bxs-user-circle sub_circle'></i>
                            <span>Clientes</span>
                        </a>
                    </li>
                @endcan
                @can('admin.ventas')
                    <li>
                        <a href="{{ route('admin.ventas') }}"
                            class="{{ Request::routeIs('admin.ventas') ? 'active3' : '' }}">
                            <i class='bx bx-package sub_circle'></i>
                            <span>Ventas</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcanany
    @can('admin.cotizacion')
        <li class="{{ Request::routeIs('admin.cotizacion') ? 'active1' : '' }}">
            <a href="{{ route('admin.cotizacion') }}">
                <i class='bx bx-receipt link_i'></i>
                <span class="link_name">Cotización</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('admin.cotizacion') }}">Cotización</a></li>
            </ul>
        </li>
    @endcan
    @canany(['admin.estadistica.producto', 'admin.estadistica.usuario', 'admin.estadistica.cliente',
        'admin.estadistica.proveedor'])
        <li>
            <div
                class="iocn-link {{ Request::routeIs('admin.estadistica.productos') ? 'active2' : '' }}
            {{ Request::routeIs('admin.estadistica.productos.historial') ? 'active2' : '' }}
            {{ Request::routeIs('admin.estadistica.usuarios') ? 'active2' : '' }}
            {{ Request::routeIs('admin.estadistica.cliente') ? 'active2' : '' }}
            {{ Request::routeIs('admin.estadistica.proveedor') ? 'active2' : '' }}
            {{ Request::routeIs('admin.estadistica.productos.suma') ? 'active2' : '' }}">
                <a>
                    <i class='bx bx-line-chart link_i'></i>
                    <span class="link_name">Estadisticas</span>
                </a>
                <i class='bx bxs-chevron-down arrow area_click'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Estadisticas</a></li>
                @can('admin.estadistica.producto')
                    <li>
                        <a href="{{ route('admin.estadistica.productos.suma') }}"
                            class="{{ Request::routeIs('admin.estadistica.productos.suma') ? 'active3' : '' }}">
                            <i class='bx bx-radio-circle sub_circle'></i>
                            <span>Productos Precio</span>
                        </a>
                    </li>
                @endcan
                @can('admin.estadistica.producto')
                    <li>
                        <a href="{{ route('admin.estadistica.productos.cantidad') }}"
                            class="{{ Request::routeIs('admin.estadistica.productos.cantidad') ? 'active3' : '' }}">
                            <i class='bx bx-radio-circle sub_circle'></i>
                            <span>Productos Cantidad</span>
                        </a>
                    </li>
                @endcan
                @can('admin.estadistica.producto')
                    <li>
                        <a href="{{ route('admin.estadistica.productos.historial') }}"
                            class="{{ Request::routeIs('admin.estadistica.productos.historial') ? 'active3' : '' }}">
                            <i class='bx bx-radio-circle sub_circle'></i>
                            <span>Producto Historial</span>
                        </a>
                    </li>
                @endcan
                @can('admin.estadistica.usuario')
                    <li>
                        <a href="{{ route('admin.estadistica.usuarios') }}"
                            class="{{ Request::routeIs('admin.estadistica.usuarios') ? 'active3' : '' }}">
                            <i class='bx bx-radio-circle sub_circle'></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                @endcan
                @can('admin.estadistica.cliente')
                    <li>
                        <a href="{{ route('admin.estadistica.cliente') }}"
                            class="{{ Request::routeIs('admin.estadistica.cliente') ? 'active3' : '' }}">
                            <i class='bx bx-radio-circle sub_circle'></i>
                            <span>Clientes</span>
                        </a>
                    </li>
                @endcan
                @can('admin.estadistica.proveedor')
                    <li>
                        <a href="{{ route('admin.estadistica.proveedor') }}"
                            class="{{ Request::routeIs('admin.estadistica.proveedor') ? 'active3' : '' }}">
                            <i class='bx bx-radio-circle sub_circle'></i>
                            <span>Proveedor</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcanany
    @canany(['admin.historial.compras', 'admin.historial.ventas'])
        <li>
            <div
                class="iocn-link {{ Request::routeIs('admin.historial.compras') ? 'active2' : '' }}
            {{ Request::routeIs('admin.historial.ventas') ? 'active2' : '' }}">
                <a>
                    <i class='bx bx-history link_i'></i>
                    <span class="link_name">Historial</span>
                </a>
                <i class='bx bxs-chevron-down arrow area_click'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Historial</a></li>
                @can('admin.historial.compras')
                    <li>
                        <a href="{{ route('admin.historial.compras') }}"
                            class="{{ Request::routeIs('admin.historial.compras') ? 'active3' : '' }}">
                            <i class='bx bx-radio-circle sub_circle'></i>
                            <span>Compras</span>
                        </a>
                    </li>
                @endcan
                @can('admin.historial.ventas')
                    <li>
                        <a href="{{ route('admin.historial.ventas') }}"
                            class="{{ Request::routeIs('admin.historial.ventas') ? 'active3' : '' }}">
                            <i class='bx bx-radio-circle sub_circle'></i>
                            <span>Ventas</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcanany
    @can('admin.kardex')
        <li class="{{ Request::routeIs('admin.kardex') ? 'active1' : '' }}">
            <a href="{{ route('admin.kardex') }}">
                <i class='bx bxs-collection link_i'></i>
                <span class="link_name">Kardex</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('admin.kardex') }}">Kardex</a></li>
            </ul>
        </li>
    @endcan
    @can('admin.registro.usuarios')
        <li class="{{ Request::routeIs('admin.registros') ? 'active1' : '' }}">
            <a href="{{ route('admin.registros') }}">
                <i class='bx bxs-user-check link_i'></i>
                <span class="link_name">Registros</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('admin.registros') }}
                        ">Registros</a></li>
            </ul>
        </li>
    @endcan
    @can('admin.backup')
        <li class="{{ Request::routeIs('admin.backup') ? 'active1' : '' }}">
            <a href="{{ route('admin.backup') }}">
                <i class='bx bxs-data link_i'></i>
                <span class="link_name">Respaldos</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('admin.backup') }}
                        ">Respaldos</a></li>
            </ul>
        </li>
    @endcan
    <li>
        <a href="{{ route('index') }}" class="profile-details">
            <div class="profile-content">
                <!--<img src="image/profile.jpg" alt="profileImg">-->
            </div>
            <div class="name-job">
                <div class="profile_name">Cibertel S.R.L.</div>
                <div class="job">Sistema de Ventas</div>
            </div>
            <i class='bx bx-log-out link_i'></i>
        </a>
    </li>

</ul>
