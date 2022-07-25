window.onload = function(){
    $("#ruttxt").mask("00.000.000-A");
    closepreloader();
}

function validarcampos(valor){
    if(valor.length == 0){
        return false;
    }
    return true;
}

function login(Datos){
    var usuario = $("#login__email").val();
    var password = $("#login__password").val();
    if(validarcampos(usuario) && validarcampos(password)){
        $.ajax({
            url: 'php/login.php',
            type: 'POST',
            data:Datos,
            success: function(data){
                closepreloader();
                if(data == "1"){
                    window.location.href = "reserva.php";
                }else{
                    swal.fire("Oh OH","Usuario o contraseña incorrectos","error");
                }
            }
        });
    }else{
        swal.fire("Oh OH","Debe llenar todos los campos","error");
    }
}

function RegistrarUsuario(datos){
    var rut = $("#ruttxt").val();
    var nom = $("#nomtxt").val();
    var ape = $("#apetxt").val();
    var email = $("#ematxt").val();
    var pass = $("#pastxt").val();

    if(validarcampos(rut) && validarcampos(nom) && validarcampos(ape) && validarcampos(email) && validarcampos(pass)){
        $.ajax({
            url: 'php/registrarUsuario.php',
            type: 'POST',
            data:datos,
            success: function(data){
                closepreloader();
                if(data == "1"){
                    swal.fire("Felicidades","Usuario registrado correctamente","success");
                    $("#registerForm")[0].reset();
                }else if(data == "2"){
                    swal.fire("Oh OH","El RUT o El Correo ya ha sido registrado","error");
                }else{
                    swal.fire("Oh OH","Error al registrar usuario","error");
                }
            }
        });
    }else{
        swal.fire("Oh OH","Debe llenar todos los campos","error");
    }
}

function reset(form){
    $.ajax({
        url: 'php/resetearcontrasena.php',
        type: 'POST',
        data:form,
        success: function(data){
            closepreloader();
            if(data == "3"){
                $("#alert").remove();
                $("#alertdiv").append("<p id='alert' style='margin:0;' class='alert alert-success text-success'><i class='fa-solid fa-circle-check'></i> Le hemos enviado un correo para restablecer su contraseña. Verifica su bandeja de entrada.</p>");
                $("#alertdiv").css("display","block");
                $("#btncambiar").css("display","block");
                $("#email__reset").attr("disabled",true);
            }else if(data == "1"){
                swal.fire("Oh OH","Correo No valido","error");
            }else if(data == "2"){
                swal.fire("Oh OH","No se Encontró ningun usuario registrado con este correo","error");
            }else{
                swal.fire("Oh OH",data,"error");
            }
        }
    });
}

function registraReserva(Form){
    $.ajax({
        url: 'php/reservar.php',
        type: 'POST',
        data:Form,
        success: function(data){
            closepreloader();
            if(data == "1"){
                swal.fire("Felicidades","Reserva registrada correctamente","success");
                $("#reservaForm")[0].reset();
                window.location.href = "reserva.php";
            }else if(data == "0"){
                swal.fire("Oh OH","Error en el registro","error");
            }else if(date = "2"){
                swal.fire("Oh OH","Hay campos vacias","error");
            }else{
                swal.fire("Oh OH",data,"error");
            }
        }
    });
}

function cambiar(){
    $("#alert").remove();
    $("#alertdiv").css("display","none");
    $("#email__reset").attr("disabled",false);
}

$(document).ready(function(){
    $("#registerForm").on("submit",function(e){
        e.preventDefault();
        openpreloader();
        var datos = $("#registerForm").serialize();
        RegistrarUsuario(datos);
    });

    $("#LoginForm").on("submit",function(e){
        e.preventDefault();
        openpreloader();
        var datos = $("#LoginForm").serialize();
        login(datos);
    });

    $("#resetForm").on("submit",function(e){
        e.preventDefault();
        openpreloader();
        var datos = $("#resetForm").serialize();
        reset(datos);
    });

    $("#reservaForm").on("submit",function(e){
        e.preventDefault();
        openpreloader();
        var datos = $("#reservaForm").serialize();
        registraReserva(datos);
    });
    

	
});

function openpreloader(){
    $(".preloader").fadeIn(1000);
}

function closepreloader(){
    $(".preloader").fadeOut(1000);
}
