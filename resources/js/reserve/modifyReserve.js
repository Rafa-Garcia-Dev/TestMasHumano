// Una vez se carga el dom se llama la funcion para llenar la tabla
document.addEventListener("DOMContentLoaded", function() {
    loadReserves();
});
// Declaramos la constante global
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

// Funcion para cargar las reservas activas
function loadReserves() 
{
    var reservesTable = document.getElementById("reservesTable");
    fetch('returnActivesReserves')
      .then(response => response.json())
      .then(data => {
        var tableBody = reservesTable.getElementsByTagName("tbody")[0];
        tableBody.innerHTML = "";
  
        data.forEach(function(reserve) {
          var newRow = tableBody.insertRow();
  
          var idReserve = newRow.insertCell();
          idReserve.textContent = reserve.id;
    
          var clientName = newRow.insertCell();
          clientName.textContent = reserve.client.name;
    
          var startDateCell = newRow.insertCell();
          startDateCell.textContent = reserve.startDate;
    
          var endDateCell = newRow.insertCell();
          endDateCell.textContent = reserve.endDate;
    
          var daysNumber = newRow.insertCell();
          daysNumber.textContent = reserve.daysNumber;
    
          var reserveStatusCell = newRow.insertCell();
          reserveStatusCell.textContent = reserve.estado.name;
    
          var employeeNameCell = newRow.insertCell();
          employeeNameCell.textContent = reserve.employee.name;
    
          var actionsCell = newRow.insertCell();
          var changeDatesButton = document.createElement("button");
          changeDatesButton.textContent = "Desactivar";
          changeDatesButton.classList.add("btn", "btn-danger");
          changeDatesButton.addEventListener("click", function() {
            desactiveReserve(reserve.id);
          });
          actionsCell.appendChild(changeDatesButton);
        });
      })
      .catch(error => {
        console.error(error);
      });
}
  // Funcion para desactivar una reserva
function desactiveReserve(reserveId) {
    
    fetch(`/desactiveReserve/${reserveId}`, {
      method: 'PUT', 
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
   
    })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        Swal.fire('¡Hola', 'La reserva fue desactivada', 'success');
        loadReserves();
      } else {
        Swal.fire('¡hola, la reserva no pudo ser desactivada',result.message,'error');
      }
    })
    .catch(error => {
      console.error(error);
    });
}
  // Funcion para filtrar la tabla 
window.filterData = function() 
   {
    var startDate = document.getElementById("startDate").value;
    var endDate = document.getElementById("endDate").value;
  
    var data = {
      startDate: startDate,
      endDate: endDate
    };
  
    fetch('/filterReserves', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify(data)
    })
      .then(response => response.json())
      .then(data => {
        var tableBody = document.getElementById("reservesTable");
        tableBody.innerHTML = "";
        data.forEach(function(reserve) {
          var newRow = tableBody.insertRow();
  
          var idReserve = newRow.insertCell();
          idReserve.textContent = reserve.id;
    
          var clientName = newRow.insertCell();
          clientName.textContent = reserve.client.name;
    
          var startDateCell = newRow.insertCell();
          startDateCell.textContent = reserve.startDate;
    
          var endDateCell = newRow.insertCell();
          endDateCell.textContent = reserve.endDate;
    
          var daysNumber = newRow.insertCell();
          daysNumber.textContent = reserve.daysNumber;
    
          var reserveStatusCell = newRow.insertCell();
          reserveStatusCell.textContent = reserve.estado.name;
    
          var employeeNameCell = newRow.insertCell();
          employeeNameCell.textContent = reserve.employee.name;
    
          var actionsCell = newRow.insertCell();
          var changeDatesButton = document.createElement("button");
          changeDatesButton.textContent = "Desactivar";
          changeDatesButton.classList.add("btn", "btn-danger");
          changeDatesButton.addEventListener("click", function() {
            desactiveReserve(reserve.id);
          });
          actionsCell.appendChild(changeDatesButton);
        });
      })
      .catch(error => {
        console.error(error);
      });
}