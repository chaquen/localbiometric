function iniciar_menu_eventos(){
	/*agregarEvento("btnContactar","click",function(){
			var datos = $("#formContacto").serializarFormulario();
			datos.origen="info@jedidiassalud.com";
			console.log(datos);
			if(false!=datos){
				registrarDato("contactar_pg_construccion",datos,function(rs){
					mostrarMensaje(rs);
				},"formContacto");
			}else{
				mostrarMensaje("Por favor ingresa los campos requeridos");
			}
	});*/
	globales._usuario=obtener_local_storage("ssUsuario");
	if(globales._usuario==false){
		location.href="index.html";
	}

	
	console.log(globales);
	/*registrarDato("mis_eventos",{usuario:globales._usuario},function(rs){
		dibujar_lista_eventos(rs.datos);
		agregar_local_storage("lsEventos",rs.datos);
		menu();
		menu_2();

	},"");*/

	agregarEvento("btnEventos","click",function(){
			registrarDatoOff(globales._URL_BE+"controlador/controlador_eventos.php","mis_eventos",
						{usuario:globales._usuario},function(rs){
                        if(rs.respuesta==true){
                        	$('#menuAdmin').fadeOut('fast');
        					$('#wrapper').fadeIn('slow');
                           	dibujar_lista_eventos(eval(rs.valores_consultados));
							agregar_local_storage("lsEventos",eval(rs.valores_consultados));
							menu();
							menu_2();
                        }else{
                        	mostrarMensaje("Aun no tienes eventos sincronizados o activos en este equipo");
                        }
                        
                    
      		},"");
	});
	

}

function dibujar_lista_eventos(rs){
	var lista=document.getElementById("liEventos");
	lista.innerHTML="";
	var tam=Object.keys(rs).length;
        console.log(tam);
  	var reg=false;
	for(var e in rs){
		console.log(rs[e]);
		var liOne=document.createElement("li");
		liOne.className="item1";//aqui debe cambiar
		var a=document.createElement("a");
		a.href="#";
		a.innerHTML=rs[e].name;
		var span=document.createElement("span");
		span.innerHTML=e;
		a.appendChild(span);
		liOne.appendChild(a);
		
		if(rs[e].atachments!="none"){
			var innerList=document.createElement("ul");	
			var ilLi=document.createElement("li");
			var inA=document.createElement("a");
			inA.setAttribute("target","_blank");
			inA.innerHTML=rs[e].atachments;
			//inA.href="http://pdpmagdalenacentro.org/assets/private/atachments/events/"+rs[e].atachments;
			inA.href=globales._URL_BE+"files/events/"+rs[e].id+"/"+rs[e].atachments;

			var ilSpan=document.createElement("span");
			ilSpan.innerHTML="DESCARGAR";
			inA.appendChild(ilSpan);
			ilLi.appendChild(inA);
			innerList.appendChild(ilLi);
                        var ilLi=document.createElement("li");
			var inA=document.createElement("a");
                        //inA.setAttribute("target","_blank");
                        inA.href="participantes.html?id="+rs[e].id;
                        inA.innerHTML="Registrar participante";
			var ilSpan=document.createElement("span");
			ilSpan.innerHTML="IR A";
			inA.appendChild(ilSpan);
			ilLi.appendChild(inA);
			innerList.appendChild(ilLi);
			reg=true;
                        
                        
		}else{
            var innerList=document.createElement("ul");	
			var ilLi=document.createElement("li");
			var inA=document.createElement("a");
                        //inA.setAttribute("target","_blank");
                         inA.href="participantes.html?id="+rs[e].id;
                        inA.innerHTML="Registrar participante";
			var ilSpan=document.createElement("span");
			ilSpan.innerHTML="IR A";
			inA.appendChild(ilSpan);
			ilLi.appendChild(inA);
			innerList.appendChild(ilLi);
			reg=true;
		}
		
		

                console.log(e);
		/*if(e==tam-1){
			
			var ilLi=document.createElement("li");
			var inA=document.createElement("a");
			inA.innerHTML="Registrar Participantes";
			ilLi.appendChild(inA);
			innerList.appendChild(ilLi);
			reg=true;
		}*/

		if(reg){
			liOne.appendChild(innerList);	
			reg=false;
		}
		




		lista.appendChild(liOne);
	}
}
function menu() {

            var menu_ul = $('.menu > li > ul'),
                menu_a  = $('.menu > li > a');

            menu_ul.hide();

            menu_a.click(function(e) {
                e.preventDefault();
                if(!$(this).hasClass('active')) {
                    menu_a.removeClass('active');
                    menu_ul.filter(':visible').slideUp('normal');
                    $(this).addClass('active').next().stop(true,true).slideDown('normal');
                } else {
                    $(this).removeClass('active');
                    $(this).next().stop(true,true).slideUp('normal');
                }
            });

}

function menu_2(){
	
var changeClass = function (r,className1,className2) {
                    var regex = new RegExp("(?:^|\\s+)" + className1 + "(?:\\s+|$)");
                    if( regex.test(r.className) ) {
                            r.className = r.className.replace(regex,' '+className2+' ');
                }
                else{
                            r.className = r.className.replace(new RegExp("(?:^|\\s+)" + className2 + "(?:\\s+|$)"),' '+className1+' ');
                }
                return r.className;
            };	

            //  Creating our button in JS for smaller screens
var menuElements = document.getElementById('menu');
menuElements.insertAdjacentHTML('afterBegin','<button type="button" id="menutoggle" class="navtoogle" aria-hidden="true"><i aria-hidden="true" class="icon-menu"> </i> Menu</button>');

            //  Toggle the class on click to show / hide the menu
            document.getElementById('menutoggle').onclick = function() {
                    changeClass(this, 'navtoogle active', 'navtoogle');
            }

            // http://tympanus.net/codrops/2013/05/08/responsive-retina-ready-menu/comment-page-2/#comment-438918
            document.onclick = function(e) {
                    var mobileButton = document.getElementById('menutoggle'),
                            buttonStyle =  mobileButton.currentStyle ? mobileButton.currentStyle.display : getComputedStyle(mobileButton, null).display;

                    if(buttonStyle === 'block' && e.target !== mobileButton && new RegExp(' ' + 'active' + ' ').test(' ' + mobileButton.className + ' ')) {
                            changeClass(mobileButton, 'navtoogle active', 'navtoogle');
                    }
            }
}



agregarEventoLoad(iniciar_menu_eventos);
