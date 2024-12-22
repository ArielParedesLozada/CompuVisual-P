<?php
require '../vendor/autoload.php';

use Dotenv\Dotenv;
use PHPJasper\PHPJasper;

$input = __DIR__ . '/reporteEstudiantes.jrxml';

$jasper = new PHPJasper;
$dotenvPath = __DIR__ . '/..';
if (!file_exists($dotenvPath . '/.env')) {
    echo "Archivo no encontrado";
    throw new Exception("El archivo .env no existe en $dotenvPath");
}
$dotenv = Dotenv::createImmutable($dotenvPath);
$dotenv->load();
$jasper->compile($input)->execute();

$input = __DIR__ . '/reporteEstudiantes.jasper';
$output = __DIR__ . '/output';
$options = [
    'format' => ['pdf'],
    'locale' => 'en',
    'db_connection' => [
        'driver' => 'mysql', //mysql, ....
        'username' => $_ENV['DATABASE_USER'],
        'password' => $_ENV['DATABASE_PASSWORD']=='' ?  "\"\"" : $_ENV['DATABASE_PASSWORD'],
        'host' => $_ENV['DATABASE_HOST'],
        'database' => $_ENV['DATABASE_NAME'],
        'port' => $_ENV['DATABASE_PORT']
    ]
];

$jasper = new PHPJasper;

try {
    $jasper->process(
        $input,
        $output,
        $options
    )->execute();
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="reporteEstudiantes.pdf"');
    header('Content-Length: ' . filesize($output));
    readfile($output . '/reporteEstudiantes.pdf');
} catch (\Throwable $th) {
    echo "Todo mal: " . $th->getMessage();
}
