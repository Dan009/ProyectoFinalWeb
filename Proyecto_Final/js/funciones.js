//Variables 
var cedula = document.getElementById('txtCedula');
var primeraClave = document.getElementById('txtPrimeraClave');
var SegundaClave = document.getElementById('txtSegundaClave');

function setearMascara(){
	$("[name=txtCedula]").inputmask({"mask":"999-9999999-9"});
	$("[name=txtCedula]").inputmask("999-9999999-9",{showMaskOnHover: false});
	$("[name=txtTelefono]").inputmask({"mask":"(999)-999-9999"});
	$("[name=txtTelefono]").inputmask("(999)-999-9999",{showMaskOnHover: false});
	validar();

}

function validar(){
	$("[name=txtSegundaClave]").blur(function(){
		if(primeraClave.value != SegundaClave.value){
			alert("asdfaksdlfnañlsdfnk no son iguales D:<");
			$(".contraseña").addClass("error");


		}else{
			$(".contraseña").removeClass("error");

		}

	});
	
}