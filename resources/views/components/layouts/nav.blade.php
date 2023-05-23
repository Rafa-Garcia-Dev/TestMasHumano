<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="padding-left: 20px; padding-right: 20px;">
    <a class="navbar-brand" href="{{route('inicio')}}">Hotel +Humano</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item ">
          <a class="nav-link" href="{{route('inicio')}}">Inicio</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('reservar')}}">Reservar</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('consultar-agenda')}}">Agenda</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('crud-tipos-documentos')}}">Tipos de Documentos</a>
        </li>
       
      </ul>
    </div>
  </nav>