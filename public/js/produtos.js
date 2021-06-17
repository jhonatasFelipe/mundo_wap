$(document).ready(function(){
    $('#inputfile').change(function(){
        $("#formfile").validate({
                rules: {
                 inputfile:{
                     required : true,
                     extension : "xlsx|xls"
                 }
                },
                messages:{
                inputfile: {
                    required: "este campo é obrigatório",
                    extension: "Selecione um arquivo no formato xls ou xlsx"
                    }
                }
        });
        if($("#formfile").valid()){
           $("#formfile").submit();
        }


    });
});