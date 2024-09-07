let routes = {
    MAIN: "../app/views/main.php",
    VALIDATE: "../app/controllers/main.validate.php",
    CLOSE: "../app/controllers/main.close.php",
    WEATHER: "https://api.openweathermap.org/data/2.5/weather"
}

let keys = {
    OPENWEATHERMAP: "eed28ef45b864598619cb1d8021b9c4b"
}

let city;

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
                $.alert(`Proceso sin exito (status ${ajax.status})`);
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
                    $.alert(`Proceso sin exito (status ${ajax.status})`);
                }
            }
        };
    
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("usur=" + usur + "&pass=" + pass );
    }
    
}

function searchCity() {    
    var city = document.form_weather.input_city.value;
    var uid = document.form_weather.input_uid.value;
    var params = "?q=" + city + "&appid=" + keys.OPENWEATHERMAP;
    var url = routes.WEATHER + params;
    const ajax = new ObjAjax();
    ajax.open("GET", url, true);
    ajax.onload  = function() {        
        if (ajax.status === 200) {            
            var response = JSON.parse(ajax.responseText);          
            var tempC = response.main.temp - 273.15;  
            document.form_weather.input_city.value = '';
            insertWeather(response.name, response.weather[0].description, tempC.toFixed(2), uid);
                                        
        } else {
            $.alert(`Proceso sin exito (status ${ajax.status})`);
        }
    };
    ajax.send();
}

function insertWeather(city, desc, temp, usrid){
    var result = document.getElementById('tview');

    const ajax = new ObjAjax();
    ajax.open("POST", "../../app/views/main.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {                
                result.innerHTML = ajax.responseText;
            } else {
                $.alert(`Proceso sin exito (status ${ajax.status})`);
            }
        }
    };

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("ctrl=weather&acti=insert&city=" + city + "&desc=" + desc + "&temp=" + temp + "&usrid=" + usrid);
}
