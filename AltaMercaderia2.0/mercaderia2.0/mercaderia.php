<?php include('conexion.php'); ?>

<?php include('includes/header2.php'); ?>
    
<?php
require('altalogin.php');
//uso de la funcion verificar_usuario()
if (verificar_usuario()){
    //si el usuario es verificado puede acceder al contenido permitido a el
    include('formMercaderia.php');
}else{
    //si el usuario no es verificado volvera al formulario de ingreso
    echo "<script language='javascript'>";
	echo "alert('Debe loguearse primero')";
	echo "</script>";
	echo "<script type='text/javascript'>";
	echo "window.location = 'index.php'";
    echo "</script>";
    exit();
}
?>

<!--Ajax Search -->

<script type="text/javascript">
    $(document).ready(function (){
        $("#busquedaMercaderia").keyup(function(){
            var txt = $("#busquedaMercaderia").val();
            $('#resultado').html('');
            if(txt == '') {
            
            }else {
                $.ajax({
                    url:"getMercaderia.php",
                    method:"post",
                    data:{search:txt},
                    dataType:"text",
                    success:function(data){
                        $('#resultado').html(data);
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                            //On error, we alert user
                            alert(thrownError);
                    }
                });
            }
        });
    });
</script>

<?php include('includes/footer2.php'); ?>