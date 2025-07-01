(function(){
    // MANIPULACIÓN DEL DOM
    const btnRegistrar = document.querySelector('#btnRegistrarUsuario');
    if(btnRegistrar){
        btnRegistrar.addEventListener('click', (e)=>{
            e.preventDefault();
            procesarDatos();
        });
    }

    async function procesarDatos(){
        const nombre = document.querySelector('#nombre');
        const email = document.querySelector('#email');
        const telefono = document.querySelector('#telefono');
        const direccion = document.querySelector('#direccion');
        const password = document.querySelector('#password');
        const password2 = document.querySelector('#password2');
        if(!nombre.value || !email.value || !telefono.value ||
            !direccion.value || !password.value || !password2.value
        ){
            Swal.fire('Error', 'Debe completar todos los datos', 'error');
            return;
        }

        if(password.value != password2.value){
            Swal.fire('Error', 'La confirmación de la contraseña es incorrecta', 'error');
            return;
        }

        const url = '/api/usuarios';
        let data = new FormData();
        data.append('nombre', nombre.value);
        data.append('email', email.value);
        data.append('telefono', telefono.value);
        data.append('direccion', direccion.value);
        data.append('password', password.value);
        data.append('accion', 'add');
        Swal.fire({
            html: 'Registrando los datos',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        try {
            const respuesta = await fetch(url, {
                method: 'POST',
                body: data
            });
            const resultado = await respuesta.json();
            // TODO: Procesar los resultados
        } catch (error) {
            Swal.fire('Error', 'No se ha podido completar el registro.', 'error');
        }
    }
})();