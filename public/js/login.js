$(document).ready(function(){
        $("#formlogin").validate({
            rules: {
                email:{
                    required : true,
                    email: true
                },
                senha:{
                    required: true
                }
            },
            messages:{
                email: {
                    required: "Por favor digite seu email",
                    email:"digite um endereço de e-mail válido"
                },
                senha:{
                    required: "Por favor digite sua senha"
                }
            }
        });
});