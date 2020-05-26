<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #083597; border-radius: 10px">
  <a class="navbar-brand" href="index.php">Farmacia</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <?php if(!isset($_SESSION['autenticado'])): ?>
        <a class="nav-link" href="login.php">Iniciar sesión</a>
        <?php else: ?>
          <a class="nav-link" href="cerrar.php">Cerrar sesión</a>
        <?php endif; ?>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Administración
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="usuarios.php">Usuarios</a>
          <a class="dropdown-item" href="roles.php">Roles</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="clientes.php">Clientes</a>
          <a class="dropdown-item" href="marcas.php">Marcas</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="categorias.php">Categorías</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </div>
</nav>