function registrarUsuario(){
    var rut = $("#ruttxt").val();
    var nombre = $("#nomtxt").val();
    var apellido = $("#apetxt").val();
    var mail = $("#ematxt").val();
    var pas = $("#pastxt").val();

    var Data = $("#registerForm").serialize();

    if(validarcampos(rut) && validarcampos(nombre) && validarcampos(apellido) && validarcampos(mail) && validarcampos(pas)){
        $.ajax({
            url: "php/registrarUsuario.php",
            type: "POST",
            data: Data,
            success: function(data){
                if(data == "1"){
                    alert("Usuario registrado correctamente");
                    $("#registerForm").reset();
                }else{
                    alert("Error al registrar usuario");
                }
            }
        });
    }else{
        alert("Debe llenar todos los campos");
    }
}

function resetearContrasena(){
    var email = $("#email__reset").val();
    if(validarcampos(email)){
        $.ajax({
            url: "php/resetearContrasena.php",
            type: "POST",
            data: "email="+email,
            success: function(data){
                if(data == "1"){
                    alert("Contraseña reseteada correctamente");
                    location.reload();
                }else{
                    alert("Error al resetear contraseña");
                }
            }
        });
    }
}

function iniciarSesion(){   
    var email = $("#email").val();
    var pass = $("#pass").val();
    if(validarcampos(email) && validarcampos(pass)){
        $.ajax({
            url: "php/iniciarSesion.php",
            type: "POST",
            data: "email="+email+"&pass="+pass,
            success: function(data){
                if(data == "1"){
                    windows.location.href = "../reserva.php";
                }else{
                    alert("Error al iniciar sesión");
                }
            }
        });
    }
}

$(document).ready(function(){
    $("#registerForm").on('submit',function(e){
        e.preventDefault();
            registrarUsuario();
    });

    $("#resetForm").on('submit',function(e){
        e.preventDefault();
            resetearContrasena();
    });

    $("#loginForm").on('submit',function(e){
        e.preventDefault();
            iniciarSesion();
    });

});

function validarcampos(valor){
    if(valor.trim().length ==0){
        return false;
    }else{
        return true;
    }

}

function desplegarsalas(){
    var cantidad = $("#cantidad").val();
    if(cantidad>0 && cantidad<=14){
        $("#sala option").remove();
        $("#sala").append("<option value='0' >Seleccione:</option>");
        $("#sala").append("<option value='1'>Laboratorio Computación - 14 Estudiantes Max</option>");
        $("#sala").append("<option value='2'>Sala Computación</option>");
    }else if(cantidad>14){
        $("#sala option").remove();
        $("#sala").append("<option value='0' >Seleccione:</option>");
        $("#sala").append("<option value='1'>Sala Computación </option>");
    }else if(cantidad<=0){
        $("#sala option").remove();
        $("#sala").append("<option value='0' >Seleccione:</option>");
        
    }
}

function desplegarbloques(){
    
    var date = $("#date").val();
    var lab = $("#sala").val();

    if (validarcampos(date) && lab>0) {

    $.ajax({
        url: "php/DesplegarBloques.php",
        type: "POST",
        data: "date="+date+"&lab="+lab,
        success: function(data){
            $("#blocks input").remove();
            $("#blocks label").remove();
            $("#blocks").append(data);
        }
    });
    }else{
        alert("Debe seleccionar una fecha y una sala");
    }
}