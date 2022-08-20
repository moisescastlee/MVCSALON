let paso = 1;

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp() {
    mostrarSeccion();
    tabs(); //Primera function creada "Cambia la seccion cuando se presionen los tabs"
}

function mostrarSeccion() {
    //Ocultar secciones
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }
    
    //Seleccionar la seccion con el paso
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    //quita la clase de actul al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior) {
        tabAnterior.classList.remove('actual');
    }
    //Cambiar de color los tabs
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
    
}

function tabs() {
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach( boton => {
    boton.addEventListener('click', function(e){
        paso = parseInt( e.target.dataset.paso );
       mostrarSeccion();
     });
    })
    
}