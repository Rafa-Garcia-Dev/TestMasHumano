<x-layouts.app title="Reservar" meta-description="Reservar meta description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <h1>Reservar</h1>
        <!-- Formulario datos cliente -->
        <div class="card mt-4">
            <div class="card-header">
                Datos Cliente
            </div>
            <div class="card-body">
                <form id="form-postulacion-cliente">
                    @csrf
                    <input type="hidden" id="clientId" name="clientId">
                    <div class="mb-3">
                        <label for="idDocType" class="form-label">Tipo de documento:</label>
                        <select id="idDocType" name="idDocType" class="form-select" required>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="docnumber" class="form-label">Numero de Documento:</label>
                        <input type="text" id="docnumber" name="docnumber" class="form-control"
                            placeholder="Numero de Documento" required>
                    </div>

                    <button type="button" id="searchBtn" class="btn btn-primary"onclick="searchClient()"
                        style=" background-color: green;">Buscar</button>

                    <div class="mb-3" style="display: none;" id="divname">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Nombre"
                            required disabled>
                    </div>

                    <div class="mb-3" style="display: none;" id="divlastName">
                        <label for="lastName" class="form-label">Apellidos:</label>
                        <input type="text" id="lastName" name="lastName" class="form-control"
                            placeholder="Apellidos" required disabled>
                    </div>

                    <div class="mb-3" style="display: none;"id="divemail">
                        <label for="email" class="form-label">Correo:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Correo"
                            required disabled>
                    </div>

                    <div class="mb-3" style="display: none;"id="divbirthdate">
                        <label for="birthdate" class="form-label">Fecha de Nacimiento:</label>
                        <input type="date" id="birthdate" name="birthdate" class="form-control" required disabled>
                    </div>

                    <div id="botonesContainer" style="display: flex; gap: 10px;">
                        <button id="updateBtn" type="button" class="btn btn-primary" onclick="updateData()"
                            style="background-color: blue; display: none;">Actualizar</button>
                        <button id="changeBtn" type="button" class="btn btn-primary" onclick="refreshPage()"
                            style="background-color: blue; display: none;">Buscar otro cliente</button>
                        <button id="continueBtn" type="button" class="btn btn-primary" onclick="next()"
                            style="background-color: green; display: none;">Continuar</button>
                        <button id="createBtn" type="button" class="btn btn-primary" onclick="createClient()"
                            style="background-color: green; display: none;">Crear Cliente</button>
                    </div>

                </form>
            </div>
        </div>
        <!-- Tabla con Habitaciones del Hotel -->
        <div class="card mt-4"style="display: none;"id="cardRoom">
            <div class="card-header">
                Tabla Informativa con tipos de habitaciones
            </div>
            <div class="card-body">
                <table id="roomTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Capacidad de Personas</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mt-4" style="display: none;" id="cardReserve" onload="loadEmployees()">
            <div class="card-header">
                Reservar
            </div>
            <div class="card-body">
                <form id="reservationForm">
                    <div class="mb-3">
                        <label for="employee" class="form-label">Empleado que hace la reserva:</label>
                        <select id="employee" name="employee" class="form-select" required>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Fecha de inicio:</label>
                        <input type="date" id="startDate" name="startDate" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">Fecha de fin:</label>
                        <input type="date" id="endDate" name="endDate" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="numberOfPeople" class="form-label">Cantidad de personas:</label>
                        <input type="number" id="capacity" name="capacity" class="form-control" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="makeReservation()">Hacer Reserva</button>
                </form>
            </div>
        </div>

        <!-- Tabla con reservas -->
        <div class="card mt-4"style="display: none;"id="cardReserves">
            <div class="card-header">
                Tabla Reservas
            </div>
            <div class="card-body">
                <table id="reservesTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Habitacion</th>
                            <th>Numero de dias</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Nombre Cliente</th>
                            <th>Estado de la reserva</th>
                            <th>Empleado reservo</th>
                            <th>Aciciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Para modificar reserva -->
        <div class="modal fade" id="modifyModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Fechas de Reserva</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="fechaInicio" class="form-label">Fecha de inicio:</label>
                                <input type="date" class="form-control" id="startDateM">
                            </div>
                            <div class="mb-3">
                                <label for="fechaFin" class="form-label">Fecha de fin:</label>
                                <input type="date" class="form-control" id="endDateM">
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
    </div>
  @vite(['resources/js/client/client.js'])
  @vite(['resources/js/reserve/reserve.js'])
</x-layout>
