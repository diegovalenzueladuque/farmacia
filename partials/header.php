
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(61,87,189);
background: linear-gradient(90deg, rgba(61,87,189,1) 14%, rgba(9,9,121,1) 79%, rgba(0,166,255,1) 100%); border-radius: 10px">
  <a class="navbar-brand" href="<?php echo BASE_URL . 'index.php' ?>">Farmacia</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo BASE_URL . 'index.php' ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <?php if(!isset($_SESSION['autenticado'])): ?>
        <a class="nav-link" href="<?php echo BASE_URL . 'usuarios/login.php' ?>">Iniciar sesión</a>
        <?php else: ?>
          <a class="nav-link" href="<?php echo BASE_URL . 'usuarios/cerrar.php' ?>">Cerrar sesión</a>
        <?php endif; ?>
      </li>
      <?php if(isset($_SESSION['autenticado']) && $_SESSION['rol']== 'Administrador'): ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Administración
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo BASE_URL . 'usuarios/' ?>">Usuarios</a>
          <a class="dropdown-item" href="<?php echo BASE_URL . 'roles/' ?>">Roles</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo BASE_URL . 'clientes/' ?>">Clientes</a>
          <a class="dropdown-item" href="<?php echo BASE_URL . 'marcas/' ?>">Marcas</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo BASE_URL . 'categorias/' ?>">Categorías</a>
          <a class="dropdown-item" href="<?php echo BASE_URL . 'productos/' ?>">Productos</a>
        </div>
      </li>
    <?php endif; ?>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
      <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </div>
</nav>