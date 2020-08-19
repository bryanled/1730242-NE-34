$(document).ready(function(){

      
$("#btnNotificacion").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Notificación");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    

$("#btnAlta").click(function(){
    $("#formAlta").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Alta Paciente");            
    $("#modalAlta").modal("show");        
    id=null;
    opcion = 1; //alta
});

function habilitar(e) {
	// los deshabilitamos todos
	var inputs=document.querySelectorAll("input[type=text]");
	for(var i=0;i<inputs.length;i++)
	{
		inputs[i].disabled=true;
    }
    for(var i=0;i<inputs.length;i++)
	{
		inputs[i].value="";
	}
 
	// habilitamos el seleccionado
	document.getElementsByName(e.id)[0].disabled=false;
}
            
    
});