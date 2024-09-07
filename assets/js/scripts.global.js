let routes = {
    MAIN: "../app/views/main.php",
    VALIDATE: "../app/controllers/main.validate.php",
    CLOSE: "../app/controllers/main.close.php"
}

function ObjAjax() {
    var xmlhttp = false;
    try { xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) {
        try { xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); } catch (E) { xmlhttp = false; }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') { xmlhttp = new XMLHttpRequest(); }
    return xmlhttp;
}

function registerUser() {
    var usur = document.form_sign.usur.value;
    var pass = document.form_sign.pass.value;
    var email = document.form_sign.email.value;

    const ajax = new ObjAjax();
    ajax.open("POST", routes.MAIN, true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {

                if('EXISTS' === ajax.responseText.trim()){
                    $.alert("El usuario ya existe");
                } else {
                    $.confirm({
                        title: 'Proceso exitoso',
                        content: 'Usuario creado exitosamente',
                        buttons: {
                                 Ok: {
                                             text: 'Cerrar',
                                             action: function () {
                                                window.location.href = "../public/index.php";
                                                                 }
                                             }
                              }
                    });    
                }
                                            
            } else {
                $.alert("Proceso sin exito");
            }
        }
    };

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("ctrl=user&acti=insert&usur=" + usur + "&pass=" + pass + "&email=" + email + "&register=true");

}

function loginUser() {
    var usur = document.form_login.usur.value;
    var pass = document.form_login.pass.value;

    if(usur == '' || pass == ''){
        $.alert("Formulario vacio");
    } else {
        const ajax = new ObjAjax();
        ajax.open("POST", routes.VALIDATE, true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4) {
                if (ajax.status == 200) {
                    var responseText = ajax.responseText.trim();
                    console.log(ajax);
                    if('SUCCESS' === responseText){
                        window.location.href = routes.MAIN;
                    } else {
                        $.confirm({
                            title: 'No se pudo iniciar sesion',
                            content: responseText,
                            buttons: {
                                     Ok: {
                                                 text: 'Cerrar',
                                                 action: function () {
                                                    window.location.href = routes.CLOSE;
                                                                     }
                                                 }
                                  }
                        });    
                    }
                                                
                } else {
                    $.alert("Proceso sin exito");
                }
            }
        };
    
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("usur=" + usur + "&pass=" + pass );
    }
    

}