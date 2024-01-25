/*=============================================
EDITAR CLIENTE
=============================================*/

$(".tablas").on("click", ".btnEditarCliente", function () {

    var idCliente = $(this).attr("idCliente");

    

    var datos = new FormData();

    datos.append("idCliente", idCliente);

    $.ajax({
      url:"ajax/clientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
        success: function (respuesta) {


          

          
            $("#idCliente").val(respuesta["id"]);
            $("#editarCliente").val(respuesta["nombre"]);
            $("#editarDocumentoId").val(respuesta["documento"]);
            $("#editarEmail").val(respuesta["email"]);
            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarDireccion").val(respuesta["direccion"]);
            $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);


          


      }






    })
    




})

/*=============================================
ELIMINAR PAGO
=============================================*/

$(".tablas").on("click", ".btnEliminarPago", function () {

  var idCliente = $(this).attr("idPago");

      Swal.fire({
            title: '¿Está seguro de borrar el Pago?',
             icon: 'success',
            }).then((result) => {


                window.location = "index.php?ruta=pagoshistorial&idPago=" + idPago;


            })

})



