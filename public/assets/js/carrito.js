(function(){
    const btnAgregarCarrito = document.querySelectorAll('.btnAgregarCarrito');
    if(btnAgregarCarrito){
        btnAgregarCarrito.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                let idProducto = btn.dataset.producto;
                let nombreProducto = btn.dataset.nombre_producto
                alert(`Agregar ${idProducto} - ${nombreProducto}`);
            })
        })
    }
})();