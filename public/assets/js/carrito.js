(function(){
    const btnAgregarCarrito = document.querySelectorAll('.btnAgregarCarrito');
    const btnQuitarCarrito = document.querySelectorAll('.btnQuitarCarrito');  

    if(btnAgregarCarrito){
        btnAgregarCarrito.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                let idProducto = btn.dataset.producto;
                agregarProducto(idProducto, 1);
            });
        });
    }

    if(btnQuitarCarrito){
        btnQuitarCarrito.forEach(btn => {
            btn.addEventListener('click', (e) =>{
                e.preventDefault();
                let idProducto = btn.dataset.producto;
                quitarProducto(idProducto);
            });
        });
    }

    async function agregarProducto(idProducto, cantidad){
        const datos = new FormData();
        datos.append('idProducto', idProducto);
        datos.append('cantidad', cantidad);
        datos.append('accion', 'agregar');
        Swal.fire({
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            }
        });
        try {
            const url = '/api/carrito';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();
            if(resultado.estado){
                window.location.reload();
            } else{
                Swal.fire('Error', resultado.mensaje, 'error')
            }
        } catch (error) {
            Swal.fire('Error', 'Error al intentar procesar los datos', 'error');
        }
    }

    async function quitarProducto(idProducto){
        const datos = new FormData();
        datos.append('idProducto', idProducto);
        datos.append('accion', 'quitar');
        Swal.fire({
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            }
        });
        try {
            const url = '/api/carrito';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();
            if(resultado.estado){
                window.location.reload();
            } else{
                Swal.fire('Error', resultado.mensaje, 'error')
            }
        } catch (error) {
            Swal.fire('Error', 'Error al intentar procesar los datos', 'error');
        }
    }
})();