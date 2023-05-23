// Una vez se carga el dom se llama la funcion para llenar la tabla
document.addEventListener("DOMContentLoaded", function() {
    loadRooms();
    loadEmployees();
    loadReserves();
});
var modifyModal = new bootstrap.Modal(document.getElementById('modifyModal'));
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

// Funcion para cargar las habitaciones en la tabla
function loadRooms() 
{
    var roomTable = document.getElementById("roomTable");
    fetch('returnRooms')
      .then(response => response.json())
      .then(data => {
        var tableBody = roomTable.getElementsByTagName("tbody")[0];
        tableBody.innerHTML = "";
  
        data.forEach(function(room) {
          var newRow = tableBody.insertRow();
  
          var nameCell = newRow.insertCell();
          nameCell.textContent = room.name;
  
          var estadoCell = newRow.insertCell();
          estadoCell.textContent = room.estado.name;
  
          var capacidadCell = newRow.insertCell();
          capacidadCell.textContent = room.capacity;
  
          var observationCell = newRow.insertCell();
          observationCell.textContent = room.observation;
        });
      })
      .catch(error => {
        console.error(error);
      });
}
// Funcion para cargar los empleados antes de enviar la reserva
function loadEmployees()
{
    var selectElement = document.getElementById('employee');
    fetch('/loadEmployees')
    .then(response => response.json())
    .then(data => {
      var valores = data;
       valores.forEach(function(valor) {
        var option = document.createElement('option');
        option.value = valor.id;
        option.text = valor.name;
        selectElement.add(option);
      });
    })
    .catch(error => {
      console.error(error);
    });
}
window.makeReservation = function()
{
    const employeeId = document.getElementById('employee').value;
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    const capacity = document.getElementById('capacity').value;
    const clientId = document.getElementById('clientId').value;
    const currentDate = new Date().toISOString().split('T')[0]; 
    
    if (!employeeId || !startDate || !endDate || !capacity) {
      Swal.fire('¡Hola!', 'Por favor, completa todos los campos', 'warning');
      return;
    }

    if (isNaN(capacity) || capacity <= 0) {
      Swal.fire('¡Hola!', 'La cantidad de personas debe ser un número positivo', 'warning');
      return;
    }

    if (startDate <= currentDate) {
        Swal.fire('¡Hola!', 'La fecha de inicio debe ser mayor a la fecha actual', 'warning');
        return;
    }

    const data = {
      employeeId,
      startDate,
      endDate,
      capacity,
      clientId
    };

    fetch('/reservations', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        Swal.fire('¡Genial', 'Tu reserva fue creada y la puedes ver en la tabla de reservas', 'success');
        loadReserves();
      } else {
        Swal.fire('¡Reserva pendiente', 'cliente en estado de espera','warning');
      }
    })
    .catch(error => {
      console.error('Error en la solicitud:', error);
    });
}
// Funcion para cargar los empleados antes de enviar la reserva
function loadReserves() 
{
    var reservesTable = document.getElementById("reservesTable");
    fetch('returnReserves')
      .then(response => response.json())
      .then(data => {
        var tableBody = reservesTable.getElementsByTagName("tbody")[0];
        tableBody.innerHTML = "";
  
        data.forEach(function(reserve) {
          var newRow = tableBody.insertRow();
  
          var roomCell = newRow.insertCell();
          roomCell.textContent = reserve.room.name;
    
          var daysCell = newRow.insertCell();
          daysCell.textContent = reserve.daysNumber;
    
          var startDateCell = newRow.insertCell();
          startDateCell.textContent = reserve.startDate;
    
          var endDateCell = newRow.insertCell();
          endDateCell.textContent = reserve.endDate;
    
          var clientNameCell = newRow.insertCell();
          clientNameCell.textContent = reserve.client.name;
    
          var reserveStatusCell = newRow.insertCell();
          reserveStatusCell.textContent = reserve.estado.name;
    
          var employeeNameCell = newRow.insertCell();
          employeeNameCell.textContent = reserve.employee.name;
    
          var actionsCell = newRow.insertCell();
          var changeDatesButton = document.createElement("button");
          changeDatesButton.textContent = "Modificar";
          changeDatesButton.classList.add("btn", "btn-primary");
          changeDatesButton.addEventListener("click", function() {
            changeReserveDates(reserve.id);
          });
          actionsCell.appendChild(changeDatesButton);
        });
      })
      .catch(error => {
        console.error(error);
      });
  }
// Funcion para cambiar los datos de la reserva
window.changeReserveDates = function(id) {
    
    var saveChangesBtn = document.getElementById("saveChangesBtn");
  
    if (saveChangesBtn.hasAttribute("data-event-listener")) {
      saveChangesBtn.removeEventListener("click", handleSaveChanges);
    }

    function handleSaveChanges() {
      var startDate = document.getElementById("startDateM").value;
      var endDate = document.getElementById("endDateM").value;
  
      if (startDate === "" || endDate === "") {
        Swal.fire("¡Hola!", "Las fechas son requeridas", "warning");
        return;
      }
  
      var currentDate = new Date();
      currentDate.setHours(0, 0, 0, 0);
  
      var startDateObj = new Date(startDate);
      var endDateObj = new Date(endDate);
  
      if (startDateObj < currentDate || endDateObj < currentDate) {
        Swal.fire(
          "¡Hola!",
          "Las fechas deben ser mayores a la fecha actual.",
          "warning"
        );
        return;
      }
  
      var reserva = {
        id: id,
        startDate: startDate,
        endDate: endDate
      };
      console.log(reserva);
  
      fetch("/changeDates", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify(reserva)
      })
        .then(response => response.json())
        .then(result => {
          if (result.success) {
            Swal.fire(
              "¡Genial!",
              "Tu reserva fue modificada con éxito",
              "success"
            );
            loadReserves();
            modifyModal.hide();
          } else {
            Swal.fire(
              "¡Lo sentimos, tu reserva no pudo ser modificada!",
              result.message,
              "warning"
            );
            modifyModal.hide();
          }
        })
        .catch(error => {
          console.error(error);
        });
    }
    saveChangesBtn.addEventListener("click", handleSaveChanges);r
    saveChangesBtn.setAttribute("data-event-listener", true);
  
    modifyModal.show();
  };
