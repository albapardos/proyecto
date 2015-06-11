function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function MostrarClassMates(datos){
	divResultadoUsuarios = document.getElementById('resultadoClassMates');
	ajaxU=objetoAjax();
	ajaxU.open("GET", datos);
	ajaxU.onreadystatechange=function() {
		if (ajaxU.readyState==4) {
			divResultadoUsuarios.innerHTML = ajaxU.responseText
		}
	}
	ajaxU.send(null)
}

function MostrarPreguntas(datos){
	divResultadoPreguntas = document.getElementById('resultadoPreguntas');
	ajaxP=objetoAjax();
	ajaxP.open("GET", datos);
	ajaxP.onreadystatechange=function() {
		if (ajaxP.readyState==4) {
			divResultadoPreguntas.innerHTML = ajaxP.responseText
		}
	}
	ajaxP.send(null)
}

function MostrarRetos(datos){
	divMostrarRetos = document.getElementById('mostrarRetos');
	ajaxR=objetoAjax();
	ajaxR.open("GET", datos);
	ajaxR.onreadystatechange=function() {
		if (ajaxR.readyState==4) {
			divMostrarRetos.innerHTML = ajaxR.responseText
		}
	}
	ajaxR.send(null)
}

