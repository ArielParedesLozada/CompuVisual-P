<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Cargar Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Cargar EasyUI CSS -->
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/demo/demo.css">

    <!-- Cargar jQuery y EasyUI JS -->
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>

    <!-- Cargar tu archivo CSS personalizado -->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<header class="bg-light shadow-sm">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">
                <img src="Img/logo.png" alt="Logo" height="80">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php?action=inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=nosotros">Misión-Visión</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=servicios">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=contactos">Contactos</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>


    <main class="container my-4">
        <section>
            <?php
            require_once('./Controllers/controller.php');
            $mvc = new MVCController();
            $mvc->enlacesPaginas();
            ?>
        </section>
    </main>

    <footer class="bg-dark text-white py-3">
        <div class="container text-center">
            <p id="fecha"></p>
        </div>
    </footer>

    <!-- Cargar Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.getElementById('fecha').textContent = new Date().toLocaleDateString();
    </script>
</body>
</html>
