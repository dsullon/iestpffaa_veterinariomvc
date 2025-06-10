(function(){
    const btnRegistrarReserva = document.querySelector('#btnRegistrarReserva');
    if(btnRegistrarReserva){
        btnRegistrarReserva.addEventListener('click', (e) =>{
            e.preventDefault();
            alert('Prueba de envío de datos');
        })
    }
})();