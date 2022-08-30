let paso = 1;
const PasoInicial = 1;
const PasoFinal = 3;


document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp() {
    mostrarSeccion(); // Muestra y oculta las secciones
    tabs(); //Cambia la seccion cuando se presionen los tabs
    botonesPaginador();//Agrega o quita botones del paginador
    paginaSiguiente();
    paginaAnterior();
    

    consultarAPI();//Consulta la api en el backend de PHP;
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
    boton.addEventListener('click', function(e) {
        paso = parseInt( e.target.dataset.paso );
       
        mostrarSeccion();
       botonesPaginador();
     });
    });
    
}

  function botonesPaginador() {
    
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');
    
    if(paso === 1){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if (paso === 3) {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }   
    
    mostrarSeccion();

} 

function paginaAnterior(){
    
    const paginaAnterior = document.querySelector('#anterior');
      paginaAnterior.addEventListener('click', function() {
        
        if(paso <= PasoInicial) return;
        
        paso--;

        botonesPaginador();
      });
}

function paginaSiguiente(){
    
    const paginaSiguiente = document.querySelector('#siguiente');
      paginaSiguiente.addEventListener('click', function() {
        
        if(paso >= PasoFinal) return;

        paso++;
        
        botonesPaginador();
      });
}

async function consultarAPI(){

    try {
        const url = 'http://localhost:3000/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        console.log(servicios);

    } catch (error) {
        console.log(error);
    }

}
