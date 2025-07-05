(function(){
    const btnLogin = document.querySelector('#btnLogin');

    if(btnLogin){
        btnLogin.addEventListener('click', (e)=> {
            e.preventDefault();
            login();
        })
    }

    async function login(){
        const email = document.querySelector('#usuario');
        const pass = document.querySelector('#password');

        if(!email.value || !pass.value){
            Swal.fire('Error', 'Debe ingresar todos los datos', 'error');
            return;
        }

        url = '/api/auth/login'
        const datos = new FormData();
        datos.append('email', email.value);
        datos.append('password', pass.value);
        try {
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();
            if(resultado.estado){
                window.location = '/carrito';
            } else {
                Swal.fire('Error', resultado.mensaje, 'error'); 
            }
        } catch (error) {
           Swal.fire('Error', 'Error al intentar registrar la reserva', 'error'); 
        }
    }
})();