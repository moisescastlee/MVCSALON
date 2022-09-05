let paso = 1;
const PasoInicial = 1;
const PasoFinal = 3;

const cita = {
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}


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
    nombreCliente(); //Añade el nombre del cliente al objeto de cita
    seleccionarFecha(); //A;ade la fecha del cliente al objeto de cita
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
        mostrarServicios(servicios);

    } catch (error) {
        console.log(error);
    }

}

function mostrarServicios(servicios){
        servicios.forEach(servicio => {
            const { id, nombre, precio } = servicio;

            const nombreServicio = document.createElement('P'); //<--- añadirle una variable y un Parrafo
            nombreServicio.classList.add('nombre-servicio'); //<---- añadirle una clase al parrafo
            nombreServicio.textContent = nombre; //<--- elegit el nombre del JSON de la base de datos.
            // console.log(nombreServicio); //<-- mostrar el resultado en la consola
            
            const precioServicio = document.createElement('P');
            precioServicio.classList.add('precio-servicio');
            precioServicio.textContent = `$ ${precio}`;
             
            ////////////////////////////////////////////////////////////////////////////////////////

            const servicioDiv = document.createElement('DIV');
            servicioDiv.classList.add('servicio');
            servicioDiv.dataset.idServicio = id;
            servicioDiv.onclick = function(){
                seleccionarServicio(servicio);
            }

            
            servicioDiv.appendChild(nombreServicio);
            servicioDiv.appendChild(precioServicio);
           // console.log(servicioDiv);
             
           document.querySelector ('#servicios').appendChild(servicioDiv);
        });
}

function seleccionarServicio(servicio) {
    const { id } = servicio;
    const { servicios } = cita;

    //Identificar el elemento al que se le da click
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
    
    //Comprobar si un servicio ya fue agregado
    if( servicios.some (agregado => agregado.id === servicio.id ) ) {
        //Eliminarlo
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        divServicio.classList.remove('seleccionado');
    } else {
        //Agregarlo
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add('seleccionado');
    }
            
     console.log(cita);
}

function nombreCliente(){
    cita.nombre = document.querySelector('#nombre').value;


}

function seleccionarFecha(){
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e) {
        
        const dia = new Date(e.target.value).getUTCDay();
        
        if( [6, 0].includes(dia) ){
            e.target,value = '';
            mostrarAlerta('Fines de Semana Cerrado', 'error');
        } else {
            cita.fecha = e.target.value;
        }
    });
}

function mostrarAlerta(mensaje, tipo){
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    ///////////////Elegir a donde va la alerta de ERROR o EXITO///////////
    const seccion = document.querySelector('#paso-2 p');
    seccion.appendChild(alerta);

    setTimeout(() => {
        alerta.remove();
    }, 3000);
}