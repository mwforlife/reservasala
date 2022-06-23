window.onload = function(){
    $("#date").datepicker({
        dateFormat: 'dd-mm-yy',
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