  <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
              <div class="pull-left image">
              <img src="vistas/img/usuarios/luisito/441.jpg" class="user-image" alt="User Image">
              </div>
              <div class="pull-left info">
                  <p><?php  echo $_SESSION["nombre"]; ?></p>
                  <a href="inicio"><i class="fa fa-circle text-success"></i> enlinea</a>
              </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
              <div class="input-group">
                  <input type="text" name="q" class="form-control" placeholder="Buscar...">
                  <span class="input-group-btn">
                      <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                              class="fa fa-search"></i>
                      </button>
                  </span>
              </div>
          </form>

          <ul class="sidebar-menu" data-widget="tree">
              <li class="header">Menu de Opciones</li>
              <li>
                  <a href="inicio">
                      <i class="fa fa-th"></i> <span>inicio</span>
                      <span class="pull-right-container">
                      </span>
                  </a>
              </li>
              <li>
                  <a href="usuarios">
                      <i class="fa fa-th"></i> <span>Usuarios</span>
                      <span class="pull-right-container">
                      </span>
                  </a>
              </li>

              <li class="treeview">
                  <a href="productos">
                      <i class="fa fa-th"></i> <span>Clientes</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li><a href="clientes"><i class="fa fa-circle-o"></i> Administrar Clientes</a></li>
                      <li><a href="pagoshistorial"><i class="fa fa-circle-o"></i> Historial Clientes</a></li>
                  </ul>
              </li>
              
              <li class="treeview">
                  <a href="productos">
                      <i class="fa fa-th"></i> <span>Productos</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li><a href="productos"><i class="fa fa-circle-o"></i> Administrar Productos</a></li>
                      <li><a href="productohistorial"><i class="fa fa-circle-o"></i> Historial Productos</a></li>
                  </ul>
              </li>
              <li>
                  <a href="almacenes">
                      <i class="fa fa-th"></i> <span>Almacenes</span>
                      <span class="pull-right-container">
                      </span>
                  </a>
              </li>

              <li class="treeview">
                  <a href="ventas">
                      <i class="fa fa-dashboard"></i> <span>Ventas</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li><a href="ventas"><i class="fa fa-circle-o"></i> Administrar Ventas</a></li>
                      <li><a href="crear-venta"><i class="fa fa-circle-o"></i> Crear Ventas</a></li>
                  </ul>
              </li>
          </ul>
      </section>
  </aside>