$(document).ready(function () {
  //local
  let url = "http://localhost/rrasesorias"; 
  //server
  //let url = "www.rrasesorias.com";

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
      url: url+"/contact.php",
      headers: {
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "application/json",
      },
      data: form,
      
      success:function (response) {
        showLoading();
        if(response[0] == "ok"){
          Swal.fire({
            icon: "success",
            title: response[1],
            text: response[2],
            showConfirmButton: false,
            timer: 1500,
          }).then(function () {
            //location.href = url;
          });
        }else{  
          Swal.fire({
            icon: "error",
            title: response[1],
            text: response[2],
            showConfirmButton: false,
            timer: 1500,
          })
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





