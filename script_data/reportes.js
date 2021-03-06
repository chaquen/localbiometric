agregarEventoLoad(iniciar_reportes);

function iniciar_reportes(){
	

	var d=recibirValorGet();

	console.log(d);
    if(d==false){
    	consultar_eventos();
    }else{
    	var id_ev=d[0].split("=")[1];
    	consultar_eventos(id_ev);
    }

	agregarEvento("btnReporteGeneral","click",function(){
		var datos = $("#formReportes").serializarFormulario();
		console.log(datos);
		if(document.getElementById("selEventos").value!="0"){

			registrarDato("reportes_lista_general",{id_evento:document.getElementById("selEventos").value},function(rs){
						console.log(rs);
						if(rs.respuesta){
							dibujar_tabla(rs.datos);
						}				

			},"");
			if(datos.documento!="" ){
				if(datos.tipo_doc!="0"){
					/*registrarDato("reportes_asistente",{documento:datos.documento},function(rs){
						console.log(rs);
						if(rs.respuesta){
							dibujar_tabla(rs.datos);
						}				

				},"");*/	
				}
			}

			
				registrarDato("reportes_general",{datos,id_evento:document.getElementById("selEventos").value},function(rs){
						console.log(rs);
						if(rs.respuesta){
							dibujar_tabla(rs.datos);
						}				

				},"");	
			
			

		}else{
			mostrarMensaje("Por favor selecciona un evento");
		}
		
	});

	


}

function consultar_eventos(id){
	if(id==undefined){
		consultarDatos("eventos",{},function(rs){
											
			crear_select("selEventos",rs.datos,"id","name");
		},"");	
	}else{
		consultarDatos("eventos/"+id,{},function(rs){
											
			crear_select("selEventos",rs.datos,"id","name");
		},"");
	}
	
}

function dibujar_tabla(datos){
		var tbl=document.getElementById("tblListaGeneral");
		tbl.innerHTML="";
		var tr=document.createElement("tr");
		
		var td=document.createElement("td");
		td.innerHTML="Primer Nombre";
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);

		var td=document.createElement("td");
		td.innerHTML="Segundo Nombre";
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);

		var td=document.createElement("td");
		td.innerHTML="Primer Apellido";
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);

		var td=document.createElement("td");
		td.innerHTML="Segundo Apellido";
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);

		var td=document.createElement("td");
		td.innerHTML="Genero";
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);

		var td=document.createElement("td");
		td.innerHTML="Ciudad de Nacimiento";
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);

		var td=document.createElement("td");
		td.innerHTML="Capacidades";
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);

		var td=document.createElement("td");
		td.innerHTML="Etnia";
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);

		tbl.appendChild(tr);		
	for(var f in datos){
		console.log(datos[f]);
		var tr=document.createElement("tr");
		
		var td=document.createElement("td");
		td.innerHTML=datos[f].pri_nombre;
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);

		var td=document.createElement("td");
		td.innerHTML=datos[f].seg_nombre;
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);

		var td=document.createElement("td");
		td.innerHTML=datos[f].pri_apellido;
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);

		var td=document.createElement("td");
		td.innerHTML=datos[f].seg_apellido;
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);
		
		var td=document.createElement("td");
		td.innerHTML=datos[f].genero;
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);


		var td=document.createElement("td");
		td.innerHTML=datos[f].ciud_nacimiento;
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);

		var td=document.createElement("td");
		td.innerHTML=datos[f].cap_dife;
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);

		var td=document.createElement("td");
		td.innerHTML=datos[f].etnia;
		td.className="mdl-data-table__cell--non-numeric";
		tr.appendChild(td);

		tbl.appendChild(tr);		

	}
}