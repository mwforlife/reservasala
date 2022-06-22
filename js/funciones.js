window.onload = function(){
    $("#date").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: '-100:+0',
        monthrange: '-10:+0',
        maxDate: '15d',
        minDate: '-100y',
        showOn: 'button',
        beforeShowDay: $.datepicker.noWeekends,
        buttonText: 'Seleccionar Fecha',
        onSelect: function(dateText, inst){
            $("#date").val(dateText);
        },
        onClose: function(dateText, inst){
            $("#date").val(dateText);
        },
        onChangeMonthYear: function(year, month, inst){
            $("#date").val(month+"-"+year);
        },
        onBeforeShow: function(dateText, inst){
            $("#date").val(dateText);
        },
        onAfterShow: function(dateText, inst){
            $("#date").val(dateText);
        },
        onChangeDate: function(dateText, inst){
            $("#date").val(dateText);
        },
        onShow: function(dateText, inst){
            $("#date").val(dateText);
        },
        onHide: function(dateText, inst){
            $("#date").val(dateText);
        }
        
    });
}