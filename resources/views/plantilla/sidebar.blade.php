<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="img/avatars/6.jpg" >
    <div>
      <p class="app-sidebar__user-name">John Doe</p>
      <p class="app-sidebar__user-designation">Frontend Developer</p>
    </div>
  </div>
  <ul class="app-menu">
    <li @click="menu=0">
      <a class="app-menu__item active" href="#">
        <i class="app-menu__icon fa fa-dashboard"></i>
        <span class="app-menu__label">Escritorio</span></a>
      </li>
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-laptop"></i>
        <span class="app-menu__label">Almacén</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li  @click="menu=1" ><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Categorías</a></li>
        <li  @click="menu=2"><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Productos</a></li>
      </ul>
    </li>

    {{-- <li>
      <a class="app-menu__item" href="charts.html">
        <i class="app-menu__icon fa fa-pie-chart"></i>
        <span class="app-menu__label">Charts</span></a>
      </li> --}}
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-edit"></i>
        <span class="app-menu__label">Compras</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li  @click="menu=3"><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Ingresos</a></li>
        <li  @click="menu=4"><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Proveedores</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-th-list"></i>
        <span class="app-menu__label">Ventas</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li  @click="menu=5"><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Ventas</a></li>
        <li  @click="menu=6"><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Clientes</a></li>
      </ul>
    </li>

    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-file-text"></i>
        <span class="app-menu__label">Acceso</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li  @click="menu=7"><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Usuarios</a></li>
        <li  @click="menu=8"><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Roles</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-pie-chart"></i>
        <span class="app-menu__label">Reportes</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li  @click="menu=9"><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Reporte de Ingresos</a></li>
        <li  @click="menu=10"><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Reporte Ventas</a></li>
      </ul>
  </li>
  <li @click="menu=11">
        <a class="app-menu__item" href="#">
          <i class="app-menu__icon fa fa-pie-chart"></i>
          <span class="app-menu__label">Como usar el Sistema</span></a>
    </li>
    <li @click="menu=12">
            <a class="app-menu__item" href="#">
              <i class="app-menu__icon fa fa-pie-chart"></i>
              <span class="app-menu__label">---</span></a>
            </li>
  </ul>
</aside>