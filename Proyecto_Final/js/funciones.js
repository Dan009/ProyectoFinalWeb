//Variables 
var cedula = document.getElementById('txtCedula');
var primeraClave = document.getElementById('txtPrimeraClave');
var segundaClave = document.getElementById('txtSegundaClave');

function setearMascara(){
	$("[name=txtCedula]").inputmask({"mask":"999-9999999-9"});
	$("[name=txtCedula]").inputmask("999-9999999-9",{showMaskOnHover: false});
	$("[name=txtTelefono]").inputmask({"mask":"(999)-999-9999"});
	$("[name=txtTelefono]").inputmask("(999)-999-9999",{showMaskOnHover: false});
	validar();

}

function validar(){
	$("[name=txtPrimeraClave]").blur(function(){
		if (primeraClave.value.length >0 && primeraClave.value.length < 6) {
			$("#error1").removeClass("magia");
			$("#error2").addClass("error2");
			$("[name=txtPrimeraClave]").parent().get(0).setAttribute("class","error");
			$(".alert").remove("#mensaje");

		}else{
			$(".contraseña").removeClass("error");
			$("[name=txtPrimeraClave]").parent().get(0).setAttribute("class","");

		}

	});

	$("[name=txtSegundaClave]").blur(function(){
		if(primeraClave.value != segundaClave.value){
			$(".contraseña").addClass("error");
			$("#error1").addClass("error1");
			$("#error2").removeClass("magia");

		}else{
			$(".contraseña").removeClass("error");

		}

	});

	$("[name=txtPrimeraClave] , [name=txtSegundaClave]").focus(function(){
		$("#error1").removeClass(".magia");
		$("#error2").removeClass(".magia");

	});
}