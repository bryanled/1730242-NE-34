$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-success btnNotificacion'>Ver Notificación +</button><button class='btn btn-primary btnEditar'>Editar +</button></div></div>"  
       }],
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
  
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR  
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    titulo = fila.find('td:eq(1)').text();
    fecha = fila.find('td:eq(2)').text();
    
    document.getElementById("id_notificacion").value=id;
    
    $("#titulo").val(titulo);
    $("#fecha").val(fecha);    
    
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Notificación");            
    $("#modalCRUD").modal("show");  
    
});  
      



$(document).on("click", ".btnNotificacion", function(){
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
                    
    window.location.href = "panel_notificacion.php? id="+id;  
    
    
});

    
    
});