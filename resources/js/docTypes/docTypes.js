// Una vez se carga el dom se llama la funcion para llenar la tabla
document.addEventListener("DOMContentLoaded", function() {
    loadDocTypes();
    loadStates();
});
var actualizarDocumentoModal = new bootstrap.Modal(document.getElementById('actualizarDocumentoModal'));
// llenado de tabla con tipos de documentos
function loadDocTypes(){
    var documentosTable = document.getElementById("docTable");
    fetch('documentsTypes')
    .then(response => response.json())
    .then(data => {
        var tableBody = documentosTable.getElementsByTagName("tbody")[0];
        tableBody.innerHTML = "";

        data.forEach(function(documento) {
            var newRow = tableBody.insertRow();

            var valueCell = newRow.insertCell();
            valueCell.textContent = documento.value;

            var descriptionCell = newRow.insertCell();
            descriptionCell.textContent = documento.description;

            var idStateCell = newRow.insertCell();
            idStateCell.textContent = documento.estado.name;

            var observationCell = newRow.insertCell();
            observationCell.textContent = documento.observation;

            var accionesCell = newRow.insertCell();
           
            var eliminarBtn = document.createElement("button");
            eliminarBtn.classList.add("btn", "btn-danger");
            eliminarBtn.textContent = "Eliminar";
            eliminarBtn.addEventListener("click", function() {
                eliminarDocumento(documento.id); 
            });

            var actualizarBtn = document.createElement("button");
            actualizarBtn.classList.add("btn", "btn-primary");
            actualizarBtn.textContent = "Actualizar";
            actualizarBtn.addEventListener("click", function() {
                updateDocType(documento.id, documento.value, documento.description,documento.estado.id,documento.observation);
              });

              var separador = document.createElement("span");
              separador.textContent = " ";
              
              accionesCell.appendChild(eliminarBtn);
              accionesCell.appendChild(separador);
              accionesCell.appendChild(actualizarBtn);
        });
    })
    .catch(error => {
        console.error(error);
    });
}
// Enviar datos para crear un nuevo tipo de documento
    window.createDocType = function(){
    var value = document.getElementById('value').value;
    var description = document.getElementById('description').value;
    var idState = document.getElementById('idState').value;
    var observation = document.getElementById('observation').value;
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var formData = {
        value: value,
        description: description,
        idState: idState,
        observation,observation

    };
    
    fetch('http://hoteltest.test/documentsTypes', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken // Incluye el token CSRF en el encabezado, necesario en laravel
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadDocTypes();
        }
    })
    .catch(error => {
    console.error(error);
    });
}
// Función para eliminar un tipo de documento
function eliminarDocumento(id) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('http://hoteltest.test/documentsTypes/' + id, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadDocTypes(); // Recargar la tabla después de eliminar el documento
        }
    })
    .catch(error => {
        console.error(error);
    });
}
// Función para abrir el modal y accionar la peticion de actualizacion
function updateDocType(id, value, description, state, observation) {

  actualizarDocumentoModal.show();

  document.getElementById('documentoId').value = id;
  document.getElementById('documentoValue').value = value;
  document.getElementById('documentoDescription').value = description;
  document.getElementById('idState2').value = state;
  document.getElementById('documentoObservation').value = observation;
  var guardarCambiosBtn = document.getElementById('saveChangesBtn');
    guardarCambiosBtn.addEventListener("click", function() {
        saveChangesDocType();
    });
  }
// Función para guardar los cambios del tipo de documento
  function saveChangesDocType() {

    var id = document.getElementById('documentoId').value;
    var value = document.getElementById('documentoValue').value;
    var description = document.getElementById('documentoDescription').value;
    var state = document.getElementById('idState2').value;
    var observation = document.getElementById('documentoObservation').value;
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var formData = {
      value: value,
      description: description,
      idState:state,
      observation:observation

    };
    
    fetch('http://hoteltest.test/documentsTypes/' + id, {
      method: 'PUT', 
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        loadDocTypes(); 
        actualizarDocumentoModal.hide(); 
      }
    })
    .catch(error => {
      console.error(error);
    });
  }
// Función para cargar los estados disponibles
  function loadStates (){
    var selectElement = document.getElementById('idState');
    var selectElement2 = document.getElementById('idState2');
    
      fetch('/states')
      .then(response => response.json())
      .then(data => {
        var valores = data;
        var valores1 = data;
         valores.forEach(function(valor) {
          var option = document.createElement('option');
          option.value = valor.id;
          option.text = valor.name;
          selectElement.add(option);
        
        });
        valores1.forEach(function(valor) {
          var option = document.createElement('option');
          option.value = valor.id;
          option.text = valor.name;
          selectElement2.add(option);
        
        });
      })
      .catch(error => {
        console.error(error);
      });
    }