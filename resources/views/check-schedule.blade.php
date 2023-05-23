<x-layouts.app title="Consultar Agenda" meta-description="Consultar Agenda meta description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <h1>Desactivar reservas</h1>
        <!-- Tabla con reservas -->
        <div class="form-group mb-3">
            <label for="startDate">Fecha de inicio:</label>
            <input type="date" class="form-control" id="startDate" />
        </div>
        <div class="form-group mb-3">
            <label for="endDate">Fecha de fin:</label>
            <input type="date" class="form-control" id="endDate" />
        </div>
        <button class="btn btn-primary" onclick="filterData()" id="filterButton">Filtrar</button>
        <div class="card mt-4"style="display: block;"id="cardReserves">
            <div>
         
            </div>
            <div class="card-body">
                <table id="reservesTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id Reserva</th>
                            <th>Nombre Cliente</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Numero Dias</th>
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
    </div>
    @vite(['resources/js/reserve/modifyReserve.js'])
    </x-layout>
