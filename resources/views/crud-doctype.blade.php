<x-layouts.app
    title="Modificar Documentos"
    meta-description="Modificar tipos de documentos meta description"
>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
    <h1>Tipos de Documentos</h1>

<!-- Formulario de Creación -->
<div class="card mt-4">
  <div class="card-header">
      Crear Nuevo Tipo de Documento
  </div>
  <div class="card-body">
      <form id="createDocForm">
          @csrf
          <div class="form-group">
              <label for="value">Valor:</label>
              <input type="text" class="form-control" id="value" name="value" required>
          </div>
          <div class="form-group">
              <label for="description">Descripción:</label>
              <input type="text" class="form-control" id="description" name="description" required>
          </div>
          <div class="form-group">
              <label for="idState">Estado:</label>
              <select class="form-control" id="idState" name="idState" required>
                  <!-- Opciones del estado -->
              </select>
          </div>
          <div class="form-group">
              <label for="observation">Observación:</label>
              <textarea class="form-control" id="observation" name="observation" required></textarea>
          </div>
          <button type="button" id="createDocTypeBtn" class="btn btn-primary" onclick="createDocType()" style="margin-top: 10px; background-color: green;">Crear</button>
      </form>
  </div>
</div>


<!-- Tabla de Tipos de Documento -->
    <div class="card mt-4">
        <div class="card-header">
            Tipos de Documento
        </div>
        <div class="card-body">
            <table id="docTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Valor</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>    
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal para actulizar registro -->
<div class="modal fade" id="actualizarDocumentoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Tipo de Documento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" id="documentoId">
          <div class="mb-3">
            <label for="documentoValue" class="form-label">Valor:</label>
            <input type="text" class="form-control" id="documentoValue">
          </div>
          <div class="mb-3">
            <label for="documentoDescription" class="form-label">Descripción:</label>
            <input type="text" class="form-control" id="documentoDescription">
          </div>
          <div class="mb-3">
            <label for="idState" class="form-label">Estado:</label>
            <select class="form-select" id="idState2">
            </select>
          </div>
          <div class="mb-3">
            <label for="documentoObservation" class="form-label">Observación:</label>
            <input type="text" class="form-control" id="documentoObservation">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" id="saveChangesBtn" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>
@vite(['resources/js/docTypes/docTypes.js'])
</x-layout>