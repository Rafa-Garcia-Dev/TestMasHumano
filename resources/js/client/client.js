// Ejecutamos esta auto funcion para cargar los tipos de documento al iniciar la vista
(function() {
  documentTypes();
})();

// Funcion para tarer los tipos de documentos
function documentTypes ()
{
var selectElement = document.getElementById('idDocType');
  fetch('/documentsTypes')
  .then(response => response.json())
  .then(data => {
    var valores = data;
     valores.forEach(function(valor) {
      var option = document.createElement('option');
      option.value = valor.id;
      option.text = valor.description;
      selectElement.add(option);
    });
  })
  .catch(error => {
    console.error(error);
  });
}
// Funcion buscar si un cliente existe
window.searchClient = function()
{
  var idDocType = document.getElementById('idDocType').value;
  var docnumber = (document.getElementById('docnumber').value).trim();

  if (docnumber === "") {
    Swal.fire('¡Hola!', 'Ingrese un número de documento válido', 'error');
    return; 
  }

  fetch('/client', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({
      idDocType: idDocType,
      docnumber: docnumber
    })
  })
    .then(response => response.json())
    .then(data => {
      if (data.length > 0) {
        var cliente = data[0];
        Swal.fire('¡Genial!', 'Cliente encontrado, sigamos con la reserva', 'success');
         showClientFined(cliente);
      } else {
        Swal.fire('¡Hola!', 'Cliente no fue encontrado, vamos a crearlo', 'warning');
        showForm();
      }
    })
    .catch(error => {
      console.error(error);
    });
}
// Funcion Mostrar formulario con cleinte encontrado
function showClientFined(cliente)
{
  document.getElementById('clientId').value = cliente.id;

  document.getElementById('searchBtn').style.display = 'none';

  document.getElementById('divname').style.display = 'block';
  document.getElementById('divlastName').style.display = 'block';
  document.getElementById('divemail').style.display = 'block';
  document.getElementById('divbirthdate').style.display = 'block';

  document.getElementById('idDocType').disabled = true;
  document.getElementById('docnumber').disabled = true;
  document.getElementById('name').disabled = false;
  document.getElementById('lastName').disabled = false;
  document.getElementById('email').disabled = false;
  document.getElementById('birthdate').disabled = false;

  document.getElementById('name').value = cliente.name;
  document.getElementById('lastName').value = cliente.lastName;
  document.getElementById('email').value = cliente.email;
  document.getElementById('birthdate').value = cliente.birthdate;

  document.getElementById('updateBtn').style.display = 'block';
  document.getElementById('continueBtn').style.display = 'block';
  document.getElementById('changeBtn').style.display = 'block';

}
// Funcion para refrescar la pagina
window.refreshPage = function()
{
  location.reload();
}
// Funcion para actualizar datos
window.updateData = function()
{

  var id = document.getElementById('clientId').value;
  var idDocType = document.getElementById('idDocType').value;
  var docnumber = document.getElementById('docnumber').value;
  var name = document.getElementById('name').value;
  var lastName = document.getElementById('lastName').value;
  var email = document.getElementById('email').value;
  var birthdate = document.getElementById('birthdate').value;

  var data = {
    id: id,
    idDocType: idDocType,
    docnumber: docnumber,
    name: name,
    lastName: lastName,
    email: email,
    birthdate: birthdate
  };

  fetch('http://hoteltest.test/client/' + id, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify(data)
  })
  .then(response => {
    if (response.ok) {
      return response.json(); 
    } else {
      console.error('Error al actualizar los datos');
      throw new Error('Error al actualizar los datos');
    }
  })
  .then(updatedData => {
   
    document.getElementById('idDocType').value = updatedData.data.idDocType;
    document.getElementById('docnumber').value = updatedData.data.docnumber;
    document.getElementById('name').value = updatedData.data.name;
    document.getElementById('lastName').value = updatedData.data.lastName;
    document.getElementById('email').value = updatedData.data.email;
    document.getElementById('birthdate').value = updatedData.data.birthdate;
    Swal.fire('¡Genial!', 'Cliente Actualizado', 'success');
  })
  .catch(error => {
    console.error('Error de conexión', error);
  });
}
// funcion para abrir el formulario y permitir crear un cliente nuevo
function showForm(){
 document.getElementById('divname').style.display = 'block';
 document.getElementById('divlastName').style.display = 'block';
 document.getElementById('divemail').style.display = 'block';
 document.getElementById('divbirthdate').style.display = 'block';
 document.getElementById('searchBtn').style.display = 'none';
 document.getElementById('createBtn').style.display = 'block';
 document.getElementById('changeBtn').style.display = 'block';
 

 document.getElementById('name').disabled = false;
 document.getElementById('lastName').disabled = false;
 document.getElementById('email').disabled = false;
 document.getElementById('birthdate').disabled = false;
 document.getElementById('searchBtn').disabled = false;

 document.getElementById('docnumber').addEventListener('change', checkDocumentNumber);
 document.getElementById('email').addEventListener('change', checkEmail);
}
// funcion para verificar si el numero de documento existe
function checkDocumentNumber() {
  var idDocType = document.getElementById('idDocType').value;
  var docnumber = document.getElementById('docnumber').value;
  
  var data = {
    idDocType: idDocType,
    docnumber: docnumber
  };

  fetch('http://hoteltest.test/check-document', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify(data)
  })
    .then(response => {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error('Error al verificar el número de documento');
      }
    })
    .then(responseData => {
      console.log(responseData);
      if (responseData.exists) {
        Swal.fire('¡Hola!', 'Este tipo y número de documento ya existen para un cliente, intenta buscarlo de nuevo', 'error');
        document.getElementById('docnumber').value = "";
      } else {
        Swal.fire('¡Vamos bien!', 'Este tipo y número de documento estan disponibles para crear un cliente nuevo', 'success');
      }
    })
    .catch(error => {
      console.error('Error de conexión', error);
    });
}
// funcion para verificar si el email existe
function checkEmail(){
  var email = document.getElementById('email').value;
  var isValidEmail = validateEmail(email);

  var data = {
    email: email
  };
  if (isValidEmail) {
  fetch('http://hoteltest.test/check-email', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify(data)
  })
    .then(response => {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error('Error al verificar el número de documento');
      }
    })
    .then(responseData => {
      console.log(responseData);
      if (responseData.exists) {
        Swal.fire('¡Hola!', 'Este correo ya existe para un cliente, por favor ingresa uno diferente ', 'error');
        document.getElementById('email').value = "";
      } else {
        Swal.fire('¡Vamos bien!', 'Este correo esta libre para usarlo', 'success');
      }
    })
    .catch(error => {
      console.error('Error de conexión', error);
    });
  } else {
    document.getElementById('email').value = "";
    Swal.fire('¡Hola!', 'Por favor ingresa un formato de correo valido', 'error');
  }
}
// Funcion para crear un cliente 
window.createClient = function()
{
  
  var idDocType = document.getElementById('idDocType').value;
  var docnumber = document.getElementById('docnumber').value;
  var name = document.getElementById('name').value;
  var lastName = document.getElementById('lastName').value;
  var email = document.getElementById('email').value;
  var birthdate = document.getElementById('birthdate').value;

  if (!idDocType || !docnumber || !name || !lastName || !email || !birthdate) {
    Swal.fire('¡Hola!', 'Recuerda quetodos los campos deben estar llenos', 'warning');
    return;
  }

  var data = {
    idDocType: idDocType,
    docnumber: docnumber,
    name: name,
    lastName: lastName,
    email: email,
    birthdate: birthdate
  };

 
  fetch('http://hoteltest.test/create-client', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify(data)
  })
  .then(response => {
   
    if (response.ok) {
      Swal.fire('¡Excelente!', 'Cliente creado con éxito', 'success');
      setTimeout(refreshPage, 3000);
    } else {
      Swal.fire('Hubo un error!', 'Vuelve a intentarlo', 'error');
      refreshPage();
      throw new Error('Error al crear el cliente');
      
    }
  })
  .then(createdData => {
    console.log('Datos del cliente creado:', createdData);
  })
  .catch(error => {
    console.error('Error de conexión', error);
  });
}
// Funcion para validar el correo por Expresión regular
function validateEmail(email) {
  var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regex.test(email);
}
// Funcion continuar con paso 2 para reservar
window.next = function()
{
  var idDocType = document.getElementById('idDocType').value;
  var docnumber = document.getElementById('docnumber').value;
  var name = document.getElementById('name').value;
  var lastName = document.getElementById('lastName').value;
  var email = document.getElementById('email').value;
  var birthdate = document.getElementById('birthdate').value;

  if (idDocType === '' || docnumber === '' || name === '' || lastName === '' || email === '' || birthdate === '') {
    Swal.fire('¡Hola!', 'Recuerda quetodos los campos deben estar llenos', 'warning');
    return false;
  }

  document.getElementById('cardRoom').style.display = 'block';
  document.getElementById('cardReserve').style.display = 'block';
  document.getElementById('cardReserves').style.display = 'block';
  
}