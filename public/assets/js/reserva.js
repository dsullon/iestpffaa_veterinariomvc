(function(){
    const btnRegistrarReserva = document.querySelector('#btnRegistrarReserva');
    if(btnRegistrarReserva){
        btnRegistrarReserva.addEventListener('click', (e) =>{
            e.preventDefault();
            crearReserva();
        })
    }

    async function crearReserva(){
        const nombre = document.querySelector("#nombre");
        const email = document.querySelector('#email');
        const fecha = document.querySelector('#fecha');
        const hora = document.querySelector('#hora');
        const servicio = document.querySelector('#servicio')

        if(!nombre.value || !email.value || !fecha.value || !hora.value || !servicio.value){
            Swal.fire({
                title: 'Error',
                text: "Debe completar los datos",
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        const datos = new FormData;
        datos.append('nombre', nombre.value);
        datos.append('email', email.value);
        datos.append('fecha', fecha.value);
        datos.append('hora', hora.value);
        datos.append('servicio', servicio.value);

        Swal.fire({
            title: 'Registrando reserva',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        const url = '/api/reservas';
        try {
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();
            if(resultado.estado){
                Swal.fire('Exito', 'Datos procesado', 'success'); 
            } else {
                Swal.fire('Error', 'No se puedo completar la operación', 'error'); 
            }
        } catch (error) {
           Swal.fire('Error', 'Error al intentar registrar la reserva', 'error'); 
        }
        
    }
})();