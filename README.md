# SyncJornada

Aplicación de registro de fichajes para trabajadores en España, cumpliendo con la normativa laboral actualizada para 2026.

## Características

- Registro de entrada y salida de jornada laboral
- Soporte para trabajo a distancia
- Multi-tenant para empresas
- Roles: Admin, Manager, Employee
- Interfaz responsive y accesible
- Filtros avanzados en todas las listas
- Check-in/out múltiple al día (pausas incluidas)
- Dockerizado para fácil despliegue

## Requisitos

- Docker y Docker Compose
- PHP 8.4
- MySQL

## Instalación

1. Clona el repositorio
2. Copia `.env.example` a `.env` y configura la base de datos
3. Ejecuta `docker-compose up -d`
4. Ejecuta `docker-compose exec app php artisan migrate --seed`
5. Accede a `http://localhost:8080`

## Uso

- Regístrate o inicia sesión
- En el dashboard, marca check in/out (puedes hacerlo múltiples veces al día para pausas)
- Ve tus registros en "Mis Registros"
- Los managers pueden ver reportes en "Reportes" y gestionar usuarios de su empresa
- Los admins pueden gestionar empresas y usuarios globales

### Funcionalidades por Rol

- **Employee**: Check-in/out múltiple, ver registros propios con filtros por fecha y remoto
- **Manager**: Todo lo de Employee + gestionar usuarios de empresa + ver reportes con filtros por usuario, fecha y remoto
- **Admin**: Todo lo de Manager + gestionar empresas globales con filtros por nombre y email

### Usuarios de Prueba

- **Admin**: admin@syncjornada.com / password (Puede gestionar empresas y usuarios globales)
- **Manager**: manager@syncjornada.com / password (Puede gestionar usuarios de su empresa y ver reportes)
- **Employee**: employee@syncjornada.com / password (Solo check-in/out y ver sus registros)

## Normativa

Cumple con la Ley 4/2019 y actualizaciones para 2026, incluyendo registro obligatorio de jornada y trabajo a distancia.

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
