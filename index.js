function showUserCreateBox() {
  Swal.fire({
    title: 'Add new',
    html:
		'<form id="myForm" onSubmit={return false;} >' +
		  '<input id="name" class="swal2-input" placeholder="Names">' +
		  '<input id="address" class="swal2-input" placeholder="Address">' +
		  '<input id="phoneNumber" class="swal2-input" placeholder="Phone Number">' +
		'</form>' ,
    focusConfirm: false,
    preConfirm: () => {
      userCreate();
    }
  })
}

function userCreate() {
  const name = document.getElementById("name").value;
  const address = document.getElementById("address").value;
  const phoneNumber = document.getElementById("phoneNumber").value;
 // console.log('name', name);
 const data = {"name":name, "address": address, "phoneNumber":phoneNumber};
 
 /*
 $.post('/phonebook/add.php', serializedData, function(response) {
    // Log the response to the console
    console.log("Response: "+response);
});*/
	var request;


    // Prevent default posting of form - put here to work in case of errors
    event.preventDefault();

    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    
    // Let's disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    //$inputs.prop("disabled", true);

    // Fire off the request to /form.php
    request = $.ajax({
        url: "/phonebook/add.php",
        type: "post",
        data: data,
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        // console.log("Hooray, it ssss!"+ response+textStatus);
        location.reload();
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        //$inputs.prop("disabled", false);
    });

  
  /*const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "http://localhost/phonebook/add.php");
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhttp.send(JSON.stringify({"data":{ 
    "name": name, "address": address, "phoneNumber": phoneNumber
  }}));
  xhttp.onreadystatechange = function() {
	    console.log(this);
	  console.log(this.status);
    /*if (this.readyState == 4 && this.status == 200) {
      const objects = JSON.parse(this.responseText);
      Swal.fire(objects['message']);
      loadTable();
    }*/
  
  
//document.getElementById("myForm").submit();
}


function showUserEditBox(id) {
  console.log(id);
  const data = {"id" : id};

  var request;


    // Prevent default posting of form - put here to work in case of errors
    event.preventDefault();

    // Abort any pending request
    if (request) {
        request.abort();
    }
  

  request = $.ajax({
    url: "/phonebook/getPhonebook.php",
    type: "post",
    data: data,
});

request.done(function (response, textStatus, jqXHR) {
  const data = JSON.parse(response);
  console.log('response', data);
  console.log(data['name']);
  document.getElementById("name").value = data['name'];
  document.getElementById("address").value = data['address'];
  document.getElementById("phoneNumber").value = data['phoneNumber'];
});



  Swal.fire({
    title: 'Edit User',
    html:
      '<form id="myForm" onSubmit={return false;} >' +
        '<input id="id" type="hidden" value=' + id + '>' +
        '<input id="name" class="swal2-input" placeholder="Names">' +
        '<input id="address" class="swal2-input" placeholder="Address">' +
        '<input id="phoneNumber" class="swal2-input" placeholder="Phone Number">' +
      '</form>' ,
    focusConfirm: false,
    preConfirm: () => {
      userEdit();
    }
  })

}

function userEdit() {
  const id = document.getElementById("id").value;
  const name = document.getElementById("name").value;
  const address = document.getElementById("address").value;
  const phoneNumber = document.getElementById("phoneNumber").value;

  var request;


    // Prevent default posting of form - put here to work in case of errors
    event.preventDefault();

    // Abort any pending request
    if (request) {
        request.abort();
    }
      

  const data = { 'id': id, 'name': name, 'address':address, 'phoneNumber': phoneNumber };
  console.log(data);
  request = $.ajax({
    url: "/phonebook/update.php",
    type: "post",
    data: data,
});

request.done(function (response, textStatus, jqXHR) {
  console.log('response', response);
 location.reload();
}); 
 
}


function userDelete(id) {

  console.log(id);
  const data = {"id" : id};

  var request;


    // Prevent default posting of form - put here to work in case of errors
    event.preventDefault();

    // Abort any pending request
    if (request) {
        request.abort();
    }
  

  request = $.ajax({
    url: "/phonebook/delete.php",
    type: "post",
    data: data,
});

request.done(function (response, textStatus, jqXHR) {
  console.log('response', response);
  // const data = JSON.parse(response);
  location.reload();
  Swal.fire("data deleted");
});


 

}