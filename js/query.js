window.onload = function(){
    $("#date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: '-100:+0',
        monthrange: '-10:+0',
        maxDate: '15d',
        minDate: '0d',
        showOn: 'button',
        beforeShowDay: $.datepicker.noWeekends,
        buttonText: 'Seleccionar Fecha',
        onSelect: function(dateText, inst){
            $("#date").val(dateText);
            desplegarbloques();
        },
        onClose: function(dateText, inst){
            $("#date").val(dateText);
            desplegarbloques();
        },
        onChangeMonthYear: function(year, month, inst){
            $("#date").val(month+"-"+year);
            desplegarbloques();
        },
        onBeforeShow: function(dateText, inst){
            $("#date").val(dateText);
            desplegarbloques();
        },
        onAfterShow: function(dateText, inst){
            $("#date").val(dateText);
            desplegarbloques();
        },
        onChangeDate: function(dateText, inst){
            $("#date").val(dateText);
            desplegarbloques();
        },
        onShow: function(dateText, inst){
            $("#date").val(dateText);
            desplegarbloques();
        },
        onHide: function(dateText, inst){
            $("#date").val(dateText);
            desplegarbloques();
        }
        
    });
}

$(document).ready(function() {
    $(".table").DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron resultados",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros",
            "infoFiltered": "(filtrado de _MAX_ registros)",
            "search": "Buscar:",
            "previous": "Anterior",
            "next": "Siguiente",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "columnDefs": [{
                "target":0,
                "orderable": false
            }],
            "columnDefs": [{
                "target":1,
                "orderable": false
            }],
            "columnDefs": [{
                "target":2,
                "orderable": false
            }],
            "columnDefs": [{
                "target":3,
                "orderable": false
            }]
        }
    });
});

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
                    windows.location.href = "reserva.php";
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
        $("#sala").append("<option value='2'>Sala Computación </option>");
    }else if(cantidad<=0){
        $("#sala option").remove();
        $("#sala").append("<option value='0' >Seleccione:</option>");
        
    }
}

function desplegarbloques(){
    
    var date = $("#date").val();
    var lab = $("#sala").val();

    if (validarcampos(date) && lab>0) {
        console.log(date + " " + lab);
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