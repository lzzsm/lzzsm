<?php
session_start();
require 'logica-autenticacao.php';

session_destroy();

header("Location: index.php")
?>