function registrar(){
    
}

function validar(){
    
}

function desplegarsalas(){
    var cantidad = $("#cantidad").val();
    if(cantidad>0 && cantidad<=14){
        $("#sala option").remove();
        $("#sala").append("<option value='0' disabled>Seleccione:</option>");
        $("#sala").append("<option value='1'>Laboratorio Computación - 14 Estudiantes Max</option>");
        $("#sala").append("<option value='2'>Sala Computación</option>");
    }else if(cantidad>14){
        $("#sala option").remove();
        $("#sala").append("<option value='0' disabled>Seleccione:</option>");
        $("#sala").append("<option value='1'>Sala Computación </option>");
    }else if(cantidad<=0){
        $("#sala option").remove();
        $("#sala").append("<option value='0' disabled>Seleccione:</option>");
        
    }
}