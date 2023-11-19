<?php

class Pila {
  private $pila = [];
  private $tope;

  public function __construct() {
    $this->tope = -1;
  }

  public function push($elemento) {
    array_push($this->pila, $elemento);
    $this->tope++;
  }

  public function pop() {
    if ($this->isEmpty()) {
      return null;
    }

    $elemento = $this->pila[$this->tope];
    unset($this->pila[$this->tope]);
    $this->tope--;

    return $elemento;
  }

  public function peek() {
    return $this->pila[$this->tope];
  }

  public function isEmpty() {
    return $this->tope == -1;
  }
}

function esPalindromo($palabra) {
    $pila = new Pila();
    $palabra = strtolower(preg_replace('/[^a-zA-Z]/', '', $palabra)); // Convertir a minúsculas y eliminar caracteres no alfabéticos
  
    for ($i = 0; $i < strlen($palabra); $i++) {
      $pila->push($palabra[$i]);
    }
  
    $palabraInversa = "";
  
    while (!$pila->isEmpty()) {
      $palabraInversa .= $pila->pop();
    }
  
    return $palabra == $palabraInversa;
  }
  
// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener la palabra ingresada por el usuario
  $palabra = trim($_POST["palabra"]);

  // Verificar si es un palíndromo
  if (esPalindromo($palabra)) {
    $mensaje = "'$palabra' es un palíndromo";
  } else {
    $mensaje = "'$palabra' NO es un palíndromo";
  }
} else {
  $mensaje = ""; // Inicializar el mensaje para que no muestre un mensaje incorrecto si no se ha enviado el formulario
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verificador de Palíndromos</title>
</head>
<body>
  <h1>Verificador de Palíndromos</h1>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="palabra">Ingrese una palabra:</label>
    <input type="text" name="palabra" id="palabra" required>
    <button type="submit">Verificar</button>
  </form>

  <?php if (!empty($mensaje)): ?>
    <p><?php echo $mensaje; ?></p>
  <?php endif; ?>
</body>
</html>
