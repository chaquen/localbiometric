agregarEventoLoad(iniciar_reportes);
function iniciar_reportes(){
	consultar_eventos();

	agregarEvento("btnReporteEdad","click",function(){
		registrarDato(globales._URL_ONLINE+"reportes_edad",{},function(rs){
						console.log(rs);
						if(rs.respuesta){
							
						}else{
							
						}					

		},"");
	});

	agregarEvento("btnReporteGeneral","click",function(){
		if(document.getElementById("selEventos").value!="0"){
			registrarDato(globales._URL_ONLINE+"reportes_lista_general",{id_evento:document.getElementById("selEventos").value},function(rs){
						console.log(rs);
						if(rs.respuesta){
							dibujar_tabla(rs.datos);
						}				

			},"");
		}else{
			mostrarMensaje("Por favor selecciona un evento");
		}
		
	});

	agregarEvento("btnReporteGenero","click",function(){
		consultarDatos(globales._URL_ONLINE+"reportes_por_genero/"+document.getElementById("selEventos").value,{},function(rs){
						console.log(rs.datos);
						if(rs.respuesta){
								var arr=[];
								var cabza=["Participantes"];
								var body=["Genero"];
								//cabza.push("participantes");

								for(v in rs.datos){
									cabza.push( rs.datos[v].genero);	
									body.push(rs.datos[v].num_genero);	
								}
								var todo=[cabza,body];
								console.log(todo);
							 	google.charts.load('current', {'packages':['bar']});
						      	google.charts.setOnLoadCallback(drawChart);

							      function drawChart() {
							        var data = google.visualization.arrayToDataTable(
							          todo
							         );

							        var options = {
							          chart: {
							            title: 'Nombre del Evento',
							            subtitle: 'Lugar y fecha del evento'
							          },
							          bars: 'horizontal' // Required for Material Bar Charts.
							        };

							        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

							        chart.draw(data, google.charts.Bar.convertOptions(options));
							      }
						}				

		},"");
	});

	agregarEvento("btnExportarReporteGeneral","click",function(){
		if(document.getElementById("selEventos").value!="0"){
			
			//registrarDato(globales._URL_ONLINE+"exportar_reporte_lista",{datos},function(rs){
			registrarDato(globales._URL_ONLINE+"exportar_reporte_lista",{id_evento:document.getElementById("selEventos").value},function(rs){	
				console.log(rs);
			});
		}else{
			mostrarMensaje("Por favor selecciona un evento");	
		}
		
	});


}

function consultar_eventos(){
	consultarDatos(globales._URL_ONLINE+"eventos",{},function(rs){
											
		crear_select("selEventos",rs.datos,"id","name");
	},"");
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