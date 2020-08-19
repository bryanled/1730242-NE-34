

$(document).ready(function () {
        $('#dtVerticalScrollExample').DataTable({
            "columnDefs":[{
                "targets": -1,
                "data":null,
                "defaultContent": "<div class='text-center'><div class='btn-group'><button  style='heigh:5px' class='btn btn-primary btnPaciente'>Seleccionar Paciente</button></div></div>"  
               }],

        "scrollY": "200px",
        "scrollCollapse": true,
        });

        $('#dtVerticalScrollExampleII').DataTable({
            "columnDefs":[{
                "targets": -1,
                "data":null,
                "defaultContent": "<div class='text-center'><div class='btn-group'><button style='heigh:5px' class='btn btn-primary btnUsuario'>Seleccionar Usuario</button></div></div>"  
               }],

        "scrollY": "200px",
        "scrollCollapse": true,
        });


        $('.dataTables_length').addClass('bs-select');
        
        
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Paciente");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnPaciente", function(){
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    nombre = $(this).closest("tr").find('td:eq(1)').text();
    
    
    document.getElementById("id_paciente").value=id;
    document.getElementById("paciente_asignado").value=nombre;
    
    
});

$(document).on("click", ".btnUsuario", function(){
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    nombre = $(this).closest("tr").find('td:eq(1)').text();
    
    document.getElementById("id_externo").value=id;
    document.getElementById("usuario_asignado").value=nombre;
    
    
});

    
    
});