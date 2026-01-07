# Guía de Deployment en Render

## Pasos para desplegar SyncJornada en Render

### 1. Preparar el Repositorio Git

```bash
# Inicializar git si no está inicializado
git init

# Agregar todos los archivos
git add .

# Hacer commit
git commit -m "Preparar para deployment en Render"

# Crear repositorio en GitHub y conectarlo
git remote add origin https://github.com/TU_USUARIO/TU_REPO.git
git branch -M main
git push -u origin main
```

### 2. Crear Cuenta en Render

1. Ve a [render.com](https://render.com)
2. Regístrate con tu cuenta de GitHub
3. Autoriza el acceso a tus repositorios

### 3. Crear Blueprint desde render.yaml

1. En el Dashboard de Render, haz clic en "New +"
2. Selecciona "Blueprint"
3. Conecta tu repositorio de GitHub
4. Render detectará automáticamente el archivo `render.yaml`
5. Haz clic en "Apply"

### 4. Configurar Variables de Entorno

Render creará automáticamente la mayoría de variables desde `render.yaml`, pero necesitas:

1. Ir al servicio web creado
2. En "Environment", agregar/verificar:
   - `APP_URL`: Tu URL de Render (ejemplo: https://syncjornada.onrender.com)
   - `APP_KEY`: Se genera automáticamente, o ejecuta: `php artisan key:generate --show`

### 5. Esperar el Deployment

- El primer deployment toma 5-10 minutos
- Render compilará la imagen Docker
- Ejecutará las migraciones automáticamente
- El servicio estará disponible en la URL proporcionada

### 6. Crear Usuario Admin Inicial

Una vez desplegado, ejecuta desde el Shell de Render:

```bash
php artisan tinker
```

Luego crea el usuario admin:

```php
use App\Models\Company;
use App\Models\User;

$company = Company::create([
    'name' => 'Admin Company',
    'email' => 'admin@syncjornada.com',
    'timezone' => 'Europe/Madrid'
]);

User::create([
    'name' => 'Administrador',
    'email' => 'admin@syncjornada.com',
    'password' => bcrypt('tu_password_segura'),
    'role' => 'admin',
    'company_id' => $company->id
]);
```

### 7. Acceder a la Aplicación

Tu aplicación estará disponible en:
- URL: `https://tu-servicio.onrender.com`
- Usuario: admin@syncjornada.com
- Contraseña: la que configuraste

## Notas Importantes

### Plan Gratuito de Render
- La aplicación "duerme" después de 15 minutos de inactividad
- Primer acceso después de dormir toma ~30 segundos
- 750 horas gratis al mes (suficiente para 1 servicio)
- Base de datos MySQL gratuita por 90 días

### Upgrade a Plan Pagado
Para producción seria, considera:
- **Starter Plan** ($7/mes): Sin sleep, más recursos
- **Base de datos persistente** ($7/mes): Después de trial de 90 días

### Actualizaciones
Cada `git push` a tu rama principal desplegará automáticamente.

### Ver Logs
En el Dashboard de Render > Tu servicio > Logs

### Acceder al Shell
En el Dashboard > Tu servicio > Shell > "Launch Shell"

## Troubleshooting

### La aplicación no inicia
1. Revisa los logs en Render
2. Verifica las variables de entorno
3. Asegúrate de que `APP_KEY` esté configurada

### Error de base de datos
1. Verifica que la base de datos esté creada
2. Revisa las credenciales en Environment
3. Espera a que la BD esté lista (puede tardar 1-2 minutos)

### Errores de permisos
Los permisos se configuran automáticamente en el Dockerfile.

## Soporte

Para más información: [Render Docs](https://render.com/docs)
