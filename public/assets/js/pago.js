(function(){
    const btnPagar = document.getElementById('btnPagarPedido');

    btnPagar.addEventListener('click', function (e) {
        e.preventDefault();
        let importe = document.querySelector('#total').value;
        let email = document.querySelector('#email').value;
        importe = importe * 100;
        Culqi.publicKey = 'pk_test_BMvvfst6Fp66cVN5';
        const client = {
            email: email,
        }
        Culqi.settings({
            title: 'VETERINARIA-ASP',
            currency: 'PEN',  // Este parámetro es requerido para realizar pagos yape
            amount: importe,  // Este parámetro es requerido para realizar pagos yape
            order: 'ord_live_0CjjdWhFpEAZlxlz', // Este parámetro es requerido para realizar pagos con pagoEfectivo, billeteras y Cuotéalo
        });

        Culqi.options({
            lang: "auto",
            installments: false, // Habilitar o deshabilitar el campo de cuotas
            paymentMethods: {
                tarjeta: true,
                yape: true,
                bancaMovil: true,
                agente: true,
                billetera: true,
                cuotealo: true,
            },
            style: {
                logo: "http://veterinaria.gradmi.pe/assets/img/logo.svg",
            }
        });
        // Abre el formulario con la configuración en Culqi.settings y CulqiOptions
        Culqi.open();
        
    })
    function culqi() {
        if (Culqi.token) {
            const token = Culqi.token;
            window.location = '/confirmacion';
            
            fetch()
                .then(respuesta => respuesta.json())
                .then(data => {

            })
        } else if (Culqi.order) {
            const order = Culqi.order;
            console.log('Se ha creado el objeto Order: ', order);
        } else {
            console.log('Error : ',Culqi.error);
        }
    }
})();