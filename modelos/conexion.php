<?php
  class Conexion
  {
    static public function conectar()
    {
      $link = new PDO("mysql:host=localhost;dbname=bd_responsivas",
                      "usuario_responsiva",
                      "responsivas-2020");
      $link->exec("set names utf8"); // Para caracteres en español
      return $link;
    }
  }
?>