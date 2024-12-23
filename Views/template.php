<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/demo/demo.css">
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header class="banner">
        <nav>
            <ul>
                <li><a href="index.php?action=inicio">Inicio</a></li>
                <li><a href="index.php?action=nosotros">Mision-Vision</a></li>
                <li><a href="index.php?action=servicios">Servicios</a></li>
                <li><a href="index.php?action=contactos">Contactos</a></li>
                <li> <img class="img-ban" src="https://servicios.uta.edu.ec/evaluacionintegral/Images/banderin.png"
                        alt="uta-img" width="50px" height="50px" />
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="div-inicial">
            <h1>Hola papus</h1>
            <!-- <img src="https://img.freepik.com/fotos-premium/descarga-imagen-fondo-hd_555090-60427.jpg"
                alt="img-not-found" /> -->
        </div>
        <section>
            <?php
            require_once('./Controllers/controller.php');
            $mvc = new MVCController();
            $mvc->enlacesPaginas();
            ?>
        </section>
    </main>
    <footer>
        <h1 id="fecha"></h1>
    </footer>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>