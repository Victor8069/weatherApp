let city;

function ObjAjax() {
    var xmlhttp = false;
    try { xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) {
        try { xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); } catch (E) { xmlhttp = false; }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') { xmlhttp = new XMLHttpRequest(); }
    return xmlhttp;
}

alert("Para brindarte la informacion de tu ciudad, debes autorizar el acceso a tu ubicación");
if (navigator.geolocation) {        
    navigator.geolocation.getCurrentPosition(
    function(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        var url = `https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`;
        const ajax = new ObjAjax();        
        ajax.open("GET", url, true);
        ajax.onload  = function() {        
            if (ajax.status === 200) {            
                var response = JSON.parse(ajax.responseText);                          
                city = response.address.city || response.address.town || response.address.county;     
                window.location.href = `../views/main.php?ctrl=user&city=${city}`;           
            } 
        };
        ajax.send();          
    },
    function(error) {
        console.error("Error al obtener la ubicación:", error.message);
    }
    );     
} else {
    console.error("La geolocalización no está disponible en este navegador.");
}  
confirm("Presiona en 'Permitir' si deseas autorizar el acceso a tu ubicación");    