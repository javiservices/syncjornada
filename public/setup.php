<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SyncJornada - Configuración</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 12px;
            padding: 40px;
            max-width: 600px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 { color: #333; margin-bottom: 20px; }
        .status { padding: 15px; border-radius: 8px; margin: 15px 0; }
        .success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .warning { background: #fff3cd; border: 1px solid #ffeaa7; color: #856404; }
        .info { background: #d1ecf1; border: 1px solid #bee5eb; color: #0c5460; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; font-size: 0.9em; }
        ul { margin: 15px 0; padding-left: 20px; }
        li { margin: 8px 0; }
        .btn {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 SyncJornada - Estado de Despliegue</h1>
        
        <?php
        $dbStatus = 'Conectando...';
        $dbError = null;
        $canConnect = false;

        try {
            $dbConnection = getenv('DB_CONNECTION') ?: 'pgsql';
            $dsn = $dbConnection === 'pgsql' 
                ? "pgsql:host=" . getenv('DB_HOST') . ";port=" . getenv('DB_PORT') . ";dbname=" . getenv('DB_DATABASE')
                : "mysql:host=" . getenv('DB_HOST') . ";port=" . getenv('DB_PORT') . ";dbname=" . getenv('DB_DATABASE');
            
            $pdo = new PDO(
                $dsn,
                getenv('DB_USERNAME'),
                getenv('DB_PASSWORD'),
                [PDO::ATTR_TIMEOUT => 5]
            );
            $canConnect = true;
            $dbStatus = 'Conectado ✅';
        } catch (Exception $e) {
            $dbError = $e->getMessage();
            $dbStatus = 'No conectado ❌';
        }
        ?>

        <div class="status <?php echo $canConnect ? 'success' : 'error'; ?>">
            <strong>Estado de Base de Datos:</strong> <?php echo $dbStatus; ?>
        </div>

        <?php if (!$canConnect): ?>
            <div class="status warning">
                <strong>⚠️ La base de datos aún no está lista</strong>
                <p style="margin-top: 10px;">Posibles causas:</p>
                <ul>
                    <li>La base de datos se está creando (tarda 10-15 min)</li>
                    <li>Las credenciales no están configuradas</li>
                    <li>La base de datos no está en estado "Available"</li>
                </ul>
            </div>

            <div class="status info">
                <strong>Error técnico:</strong><br>
                <code><?php echo htmlspecialchars($dbError); ?></code>
            </div>

            <div class="status info">
                <strong>📋 Pasos a seguir:</strong>
                <ol style="margin-top: 10px; padding-left: 20px;">
                    <li>Ve a Render Dashboard → Databases</li>
                    <li>Verifica que "syncjornada-db" esté en estado <strong>"Available"</strong></li>
                    <li>Si está creándose, espera a que termine</li>
                    <li>Recarga esta página cada minuto</li>
                </ol>
            </div>
        <?php else: ?>
            <div class="status success">
                <strong>✅ ¡Base de datos conectada!</strong>
                <p style="margin-top: 10px;">El sistema está listo. Las migraciones deberían ejecutarse automáticamente.</p>
            </div>

            <a href="/" class="btn">Ir a la Aplicación →</a>
        <?php endif; ?>

        <div class="status info" style="margin-top: 20px;">
            <strong>Información del Sistema:</strong>
            <ul>
                <li>PHP Version: <?php echo PHP_VERSION; ?></li>
                <li>DB Connection: <?php echo getenv('DB_CONNECTION') ?: 'No configurado'; ?></li>
                <li>DB Host: <?php echo getenv('DB_HOST') ?: 'No configurado'; ?></li>
                <li>DB Port: <?php echo getenv('DB_PORT') ?: 'No configurado'; ?></li>
                <li>DB Name: <?php echo getenv('DB_DATABASE') ?: 'No configurado'; ?></li>
                <li>PDO PostgreSQL: <?php echo extension_loaded('pdo_pgsql') ? '✅ Instalado' : '❌ No disponible'; ?></li>
            </ul>
        </div>
    </div>
</body>
</html>
