<script>
function cancelar(pedido)
{
    var msg_error = 'Ocorreu um erro...';
    var msg_timeout = 'O servidor não está respondendo';
    var message = '';
    //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.post( "http://bravestore.epizy.com/pedido/cancelar", { _token: '<?php echo csrf_token() ?>', id: pedido}, function( data, status, error ) {
        if (status==='success')
        {
            document.location.reload(true);
            console.log(data);
        }
        else if (status==="timeout")
        {
            message = msg_timeout;
            alert('message');
        }
        console.log( data );
        console.log( status );
    }, "json");
}
</script>