
$(document).ready(function() {
    $("#guardarCantidad").on("click", function() {
        var categoriasData = [];


        $(".tablas tbody tr").each(function() {
            var idCategoria = $(this).find("td:eq(1)").text(); 
            var cantidadProducto = $(this).find("input[type=number]").val();
            var idProducto = $("#productosede").val();  // Obtener el id del producto seleccionado
            var nombreProducto = $("#productosede option:selected").text();  // Obtener el nombre del producto seleccionado

            categoriasData.push({
                idCategoria: idCategoria,
                cantidadProducto: cantidadProducto,
                idProducto: idProducto,
                nombreProducto: nombreProducto
            });
        });
        console.log("Enviar Datos:", categoriasData);


        $.ajax({
            url: "ajax/inventario.ajax.php", 
            method: "POST",
            data: { categoriasData: categoriasData },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.error(error);
            }
        });
  
    });
});


