(function(){
    const btnPagar = document.getElementById('btnPagarPedido');
    let importe = document.querySelector('#total').value;
    let email = document.querySelector('#email').value;

    btnPagar.addEventListener('click', function (e) {
        e.preventDefault();
        const amount = importe * 100;
        Culqi.publicKey = 'pk_test_BMvvfst6Fp66cVN5';
        const client = {
            email: email,
        }
        Culqi.settings({
            title: 'VETERINARIA-ASP',
            currency: 'PEN',  // Este parámetro es requerido para realizar pagos yape
            amount: amount,  // Este parámetro es requerido para realizar pagos yape
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

        window.culqi = function(){
            if (Culqi.token) {
                const token = Culqi.token;
                console.log(token);
                
                const url = '/api/carrito';
                const data = new FormData();
                data.append('token', token.id);
                data.append('email', token.email);
                data.append('importe', importe)
                data.append('accion', 'pagar')
                fetch(url, {
                    method: 'POST',
                    body: data
                })
                    .then(respuesta => respuesta.json())
                    .then(resultado => {
                        if(resultado.estado){
                            const data = resultado.data;
                            Culqi.close();
                            Swal.fire({
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                title: 'Exito', 
                                html: `Se ha confimado su pedido. <br/>El código de confirmación es: <b>${data.codigo}</b>`, 
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    //window.location = `/confirmacion?codigo=${data.codigo}`;
                                    window.location = '/productos';
                                }
                            });
                        } else {
                            Swal.fire('Error', 'No se ha podido registrar al usuario', 'error');
                            Culqi.close();
                        }
                })
            } else if (Culqi.order) {
                const order = Culqi.order;
                console.log('Se ha creado el objeto Order: ', order);
            } else {
                console.log('Error : ',Culqi.error);
            }
        }
    })
})();