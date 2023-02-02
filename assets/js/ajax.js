$(document).ready(function () {
  console.log("ajax cargado");
  $("#formulario").submit(function (e) {
    e.preventDefault();
    let name = $("input[name=name]").val();
    let subject = $("input[name=subject]").val();
    let email = $("input[name=email]").val();
    let message = $("textarea[name=message]").val();

    var formulario = {
      name: name,
      subject: subject,
      email: email,
      message: message
    };
    form = JSON.stringify(formulario);
    showLoading();
    $.ajax({
      type: "POST",
      url: "http://localhost/rrasesorias/contact.php",
      headers: {
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "application/json",
      },
      data: form,
      success: function (response) {
        console.log(response);
        showLoading();
        Swal.fire({
          icon: "success",
          title: "Mensaje Enviado Correctamente",
          showConfirmButton: false,
          timer: 1500,
        }).then(function () {
          //location.href = "http://localhost/rrasesorias/";
        });
      },
      //timeout: 2000,
      error: function () {
        Swal.fire({
          icon: "error",
          title: "Error al insertar fila",
          showConfirmButton: false,
          timer: 1500,
        });
      },
    });
    return false;
  });

  function showLoading() {
    Swal.fire({
      title: "Espere un momento",
      allowOutsideClick: false,
      showConfirmButton: false,
      onBeforeOpen: () => {
        Swal.showLoading();
      },
    });
  }
});





