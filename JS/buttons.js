function cancel(){
    window.history.back();
}

function showHide(popupId){
    var popup = document.getElementById(popupId);
    var fondo = document.getElementById('fondoOscuro');
    if (popup.style.display === 'none' || popup.style.display === '') {
        popup.style.display = 'block';
        fondo.style.display = 'block';
    } else {
        popup.style.display = 'none';
        fondo.style.display = 'none';
    }
}