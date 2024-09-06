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
    ajax.open("POST", "../app/views/main.php", true);
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