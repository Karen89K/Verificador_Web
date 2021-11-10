<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUPER DEL SUR</title>
    
    <script type="text/javascript">
        setTimeout(function() {
            window.location.href = "index.html";
        }, 5000);
    </script>

    <script type="text/javascript">

      if (window.addEventListener) {
      var codigo = "";
      window.addEventListener("keydown", function (e) {
          codigo += String.fromCharCode(e.keyCode);
          if (e.keyCode == 13) {
              window.location = "mostrar_producto.php?codigo=" + codigo;
              codigo = "";
          }
      }, true);
}
</script>
</head>

<body>
  <h1 style='text-align: center'>
    <?php
        include ("./inc/settings.php");
      
        try {
            $conn = new PDO("mysql:host=".$host.";dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM productos WHERE producto_codigo = ".$_GET["codigo"]);
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
           
            $renglones=$stmt->rowCount();
        
            if ($renglones==1) {
              echo "<img src='".$result["producto_imagen"]."' width='180px' height='180px'><br><br><br>";
              echo "Producto: ".$result["producto_nombre"]."<br>";
              echo "En Stock: ".$result["producto_cantidad"]."<br>";
              echo "Precio: $".$result["producto_precio"]."<br>";
             
            }
            else{
              echo "PRODUCTO NO ENCONTRADO.<br>";
              echo "<img src='img/error.png' alt='30%' width='30%' height=''><br>";
              echo "FAVOR DE PASAR A SERVICIO A CLIENTES.";
            }
            
            
          } catch(PDOException $e) {
             echo "Error: " . $e->getMessage();
          }
    ?>
  </h1>
</body>
</html>