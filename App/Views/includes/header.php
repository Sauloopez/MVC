<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title; ?>
    </title>
    <style>
        .navbar {
            background-color: #333;
            color: #fff;
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            /* Sombra sutil */
        }

        .error{
            color: red;
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
        }

        .navbar-logo {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar-menu ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            gap: 20px;
            /* Espaciado entre los elementos del menú */
        }

        .navbar-menu a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
            /* Transición suave al cambiar el color */
        }

        .navbar-menu a:hover {
            color: #ddd;
        }

        /* Menú desplegable oculto por defecto */
        .navbar-menu ul {
            display: none;
            flex-direction: column;
            gap: 10px;
        }

        /* Icono de menú (puedes usar un ícono real aquí) */
        .navbar-menu::before {
            content: '☰';
            /* Simula un ícono de menú, pero es mejor usar un ícono real o una imagen */
            display: block;
        }

        /* Estilos para pantallas más grandes (por ejemplo, más de 768px) */
        @media (min-width: 768px) {
            .navbar-menu::before {
                display: none;
                /* Oculta el ícono de menú en pantallas grandes */
            }

            .navbar-menu ul {
                display: flex;
                flex-direction: row;
            }
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
            min-height: 100vh;
        }

        .login-container {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h1 {
            margin: 0 0 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #007BFF;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Estilos base para el footer */
        .footer-bacano {
            background-color: #333;
            color: #fff;
            padding: auto;
            font-family: Arial, sans-serif;
            margin-top: auto;
            width: 100%;

        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            padding: 0 15px;
            font-size: 15px;
        }

        .footer-section {
            flex: 1;
            min-width: 200px;
            margin: 15px;
        }

        .footer-logo {
            font-size: 24px;
            font-weight: bold;
        }

        .footer-links {
            list-style-type: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #fff;
            text-decoration: none;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo">
                <?php echo $title ?>
            </div>
            <nav class="navbar-menu">
                <ul>
                    <li><a href="<?php echo URL ?>">Inicio</a></li>
                    <?php
                    if(isset($_SESSION['jwt']))
                    echo '<li><a href="'.URL .'home/logout">Cerrar Sesión</a></li>';
                    else
                    echo '<li><a href="'.URL .'home/login">Iniciar Sesión</a></li>'
                    ?>
                </ul>
            </nav>
        </div>
    </header>