<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://www.paypal.com/sdk/js?client-id=AanSINWZhV2c1Ww6rvY7GhQUz-QM5MalKNoN6nkdk938UPdwjPUmunqIPBg48YNIxxnWjF-mgDApdxi5"></script>
</head>
<body>
    <div id="paypal-button-container"></div>

    <script>
        paypal.Buttons({
            style:{
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units: [{
                        amount:{
                            value: 100
                        }
                    }]
                });
            },

            onApprove: function(data, actions){
                actions.order.capture().then(function(detalles){
                    window.location.href="completado.html"
                });
            },

            onCancel: function(data){
                alert("pago cancelado")
                console.log(data);
            }
        }).render('#paypal-button-container');
    </script>
    
</body>
</html>