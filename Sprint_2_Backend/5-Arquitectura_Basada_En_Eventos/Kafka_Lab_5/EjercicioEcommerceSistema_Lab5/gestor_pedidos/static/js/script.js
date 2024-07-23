function enviarPedido() {
    const pedido = [
        {"id":1,"cantidad": document.getElementById('producto1').value,},
        {"id":2,"cantidad": document.getElementById('producto2').value},
        {"id":3,"cantidad": document.getElementById('producto3').value},
        {"id":4,"cantidad": document.getElementById('producto4').value},
        {"id":5,"cantidad": document.getElementById('producto5').value}        
    ];

    fetch('/pedido', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(pedido)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        alert('Pedido enviado con éxito');
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('Error al enviar el pedido');
    });
}
