$(document).ready(function(){
	load(1);
});

function load(page){
	var q= $("#q").val();
	var dia_id= $("#dia_id").val();
	var turno_id= $("#turno_busq").val();
	var pais_id= $("#pais_id_busq").val();
	var planta_ud= $("#planta_busq").val();

	var project_busq= $("#project_busq").val();
	var departamento_busq= $("#departamento_busq").val();
	var linea_busq= $("#linea_busq").val();
	var modelo_busq= $("#modelo_busq").val();
	
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'./ajax/plantadata.php?action=ajax&page='+page+'&q='+q+'&dia_ajax='+dia_id+'&turno_id_ajax='+turno_id+'&pais_id_ajax='+pais_id+'&planta_ud='+planta_ud
		+'&project_busq='+project_busq+'&departamento_busq='+departamento_busq+'&linea_busq='+linea_busq+'&modelo_busq='+modelo_busq,
		beforeSend: function(objeto){
			$('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$('#loader').html('');
		}
	})
}

function eliminar (id)
{
	var q= $("#q").val();
	if (confirm("Realmente deseas eliminar este dato?")){	
		$.ajax({
			type: "GET",
			url: "./ajax/plantadata.php",
			data: "id="+id,"q":q,
			beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Cargando...");
			},
			success: function(datos){
				$("#resultados").html(datos);
				load(1);
			}
		});
	}
}