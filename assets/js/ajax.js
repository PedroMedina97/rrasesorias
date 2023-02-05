$(document).ready(function () {
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
      error: function (response) {
        showLoading();
        if(response.status == 200){
          Swal.fire({
            icon: "success",
            title: "Mensaje Enviado",
            showConfirmButton: false,
            timer: 1500,
          }).then(function () {
            location.href = "http://localhost/rrasesorias/";
          });
        }else{
          Swal.fire({
            icon: "warning",
            title: "Error de envio de datos",
            showConfirmButton: false,
            timer: 1500,
          });
        }
        
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





