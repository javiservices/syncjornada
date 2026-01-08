# Cumplimiento Normativo - Real Decreto-ley 8/2019

## Características Implementadas para el Registro de Jornada Laboral

SyncJornada cumple con todos los requisitos del **Real Decreto-ley 8/2019** sobre registro obligatorio de jornada laboral en España, aplicable desde 2019 y con requisitos ampliados para 2026.

---

## ✅ Características de Cumplimiento

### 1. **Registro Automático de Entrada y Salida**
- ✅ Los empleados registran su hora de entrada (check-in) y salida (check-out) diariamente
- ✅ El sistema registra automáticamente la fecha y hora exacta de cada fichaje
- ✅ Campos: `date`, `check_in`, `check_out` en tabla `time_entries`

### 2. **Auditoría Completa de Modificaciones**
- ✅ **Trazabilidad inmutable**: Toda modificación queda registrada en tabla `time_entry_audits`
- ✅ Se registra: acción (created/updated/deleted), valores anteriores y nuevos (JSON), usuario que modificó, IP, user agent
- ✅ Implementado mediante `TimeEntryObserver` (patrón Observer de Laravel)
- ✅ Las auditorías son automáticas e imposibles de eludir

**Tabla `time_entry_audits`:**
```sql
- time_entry_id (FK)
- user_id (usuario que hizo la modificación)
- action (created|updated|deleted)
- old_values (JSON con valores anteriores)
- new_values (JSON con valores nuevos)
- ip_address
- user_agent
- timestamps
```

### 3. **Captura Automática de Geolocalización**
- ✅ Ubicación GPS capturada automáticamente en entrada y salida mediante JavaScript (navigator.geolocation)
- ✅ Campos: `check_in_latitude`, `check_in_longitude`, `check_out_latitude`, `check_out_longitude`
- ✅ Precisión decimal (10,8) para latitud y (11,8) para longitud
- ✅ Permite verificar que el fichaje se realizó desde ubicación autorizada
- ✅ **Importante**: El navegador solicita permiso al usuario para acceder a la ubicación (requisito de privacidad)

### 4. **Captura de IP y User Agent**
- ✅ Se registra la dirección IP desde la que se realiza el fichaje
- ✅ Se registra el navegador y dispositivo usado (user agent)
- ✅ Campos: `ip_address` (VARCHAR 255), `user_agent` (TEXT)
- ✅ Permite detectar fichajes anómalos o desde ubicaciones no autorizadas

### 5. **Confirmación del Empleado**
- ✅ Campo `employee_confirmed` (boolean, default true)
- ✅ Indica que el empleado confirmó personalmente el registro
- ✅ Diferencia entre registros automáticos y confirmados por el empleado

### 6. **Bloqueo de Registros Antiguos (Retención 4 años)**
- ✅ Campo `is_locked` (boolean, default false)
- ✅ Los registros bloqueados NO pueden modificarse ni eliminarse
- ✅ Cumple con requisito legal de **conservación mínima de 4 años**
- ✅ **Comando artisan**: `php artisan timeentries:lock-old --years=4`
- ✅ Bloquea automáticamente todos los registros con más de 4 años de antigüedad
- ✅ **Recomendación**: Programar este comando en cron o Laravel Scheduler para ejecución mensual

**Programación en Scheduler (app/Console/Kernel.php):**
```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('timeentries:lock-old')->monthly();
}
```

### 7. **Exportación Oficial para Inspección de Trabajo**
- ✅ Controlador dedicado: `TimeEntryExportController`
- ✅ Formato CSV oficial con separador punto y coma (;)
- ✅ Codificación UTF-8 con BOM para compatibilidad con Excel
- ✅ **Columnas incluidas**:
  - Fecha (dd/mm/yyyy)
  - Empleado (nombre completo)
  - Empresa
  - Hora Entrada (HH:mm:ss)
  - Latitud Entrada
  - Longitud Entrada
  - Hora Salida (HH:mm:ss)
  - Latitud Salida
  - Longitud Salida
  - Horas Totales (formato "Xh Ymin")
  - Remoto (Sí/No)
  - IP
  - Confirmado (Sí/No)
  - Notas
  - Modificaciones (Sí/No con contador)

- ✅ **Filtros disponibles**:
  - Rango de fechas (obligatorio)
  - Empresa (solo admin)
  - Usuario/empleado
  
- ✅ **Restricciones por rol**:
  - **Empleados**: Solo sus propios registros
  - **Managers**: Solo empleados de su empresa
  - **Admins**: Todos los registros con filtros opcionales

- ✅ **Ruta**: `POST /time-entries/export`
- ✅ **UI**: Botón prominente en vista de reportes con banner azul "Exportación Oficial (Normativa RD-ley 8/2019)"

### 8. **Protección contra Modificaciones No Autorizadas**
- ✅ El Observer valida que el registro no esté bloqueado (`is_locked`) antes de permitir actualizaciones
- ✅ Mensaje de error: "Este registro está bloqueado y no puede modificarse por normativa legal (retención 4 años)"
- ✅ Validación en backend (TimeEntryController::update())
- ✅ Validación automática en Observer (antes de guardar cambios)

### 9. **Zona Horaria Personalizada**
- ✅ Cada empresa puede configurar su zona horaria (campo `timezone` en tabla `companies`)
- ✅ Los registros se crean en la zona horaria de la empresa del empleado
- ✅ Importante para empresas con sedes en diferentes ubicaciones

---

## 📋 Requisitos Legales Cubiertos

| Requisito Legal | Estado | Implementación |
|----------------|--------|----------------|
| Registro obligatorio diario de entrada/salida | ✅ | Tabla `time_entries` con campos `check_in` y `check_out` |
| Conservación mínima de 4 años | ✅ | Campo `is_locked` + comando `timeentries:lock-old` |
| Auditoría de modificaciones | ✅ | Tabla `time_entry_audits` + `TimeEntryObserver` |
| Disponibilidad para Inspección de Trabajo | ✅ | Exportación CSV oficial con todos los datos |
| Geolocalización de fichajes | ✅ | Campos `check_in_latitude/longitude` y `check_out_latitude/longitude` |
| Trazabilidad de dispositivo/IP | ✅ | Campos `ip_address` y `user_agent` |
| Confirmación del empleado | ✅ | Campo `employee_confirmed` |
| Inmutabilidad de registros antiguos | ✅ | Sistema de bloqueo con `is_locked` |

---

## 🚀 Comandos Artisan

### Bloquear registros antiguos
```bash
php artisan timeentries:lock-old          # Bloquea registros >4 años (default)
php artisan timeentries:lock-old --years=5  # Bloquea registros >5 años
```

### Ejecutar en producción
```bash
docker-compose exec app php artisan timeentries:lock-old
```

---

## 📊 Estructura de Datos

### Tabla `time_entries` (campos de cumplimiento)
```sql
check_in_latitude       DECIMAL(10,8) NULL
check_in_longitude      DECIMAL(11,8) NULL
check_out_latitude      DECIMAL(10,8) NULL
check_out_longitude     DECIMAL(11,8) NULL
ip_address              VARCHAR(255) NULL
user_agent              TEXT NULL
employee_confirmed      BOOLEAN DEFAULT TRUE
is_locked               BOOLEAN DEFAULT FALSE
location                VARCHAR(255) NULL  -- Campo adicional para descripción texto
```

### Tabla `time_entry_audits` (auditoría)
```sql
id                      BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
time_entry_id           BIGINT UNSIGNED (FK → time_entries.id)
user_id                 BIGINT UNSIGNED (FK → users.id)
action                  VARCHAR(50) -- created|updated|deleted
old_values              JSON
new_values              JSON
ip_address              VARCHAR(255)
user_agent              TEXT
created_at              TIMESTAMP
updated_at              TIMESTAMP
```

---

## 🔐 Seguridad y Privacidad

1. **Consentimiento de geolocalización**: El navegador siempre solicita permiso al usuario antes de capturar ubicación GPS
2. **Protección de datos personales**: Cumple con GDPR/LOPDGDD al registrar solo datos necesarios para cumplimiento laboral
3. **Acceso restringido**: 
   - Empleados solo ven sus propios registros
   - Managers solo ven empleados de su empresa
   - Admins tienen acceso completo pero con auditoría
4. **Auditoría de accesos**: Cada modificación queda registrada con usuario, IP y timestamp
5. **Inmutabilidad**: Registros bloqueados son inmodificables, garantizando integridad histórica

---

## 📱 Funcionalidades para Empleados

1. **Check-in/Check-out desde dashboard**
   - Captura automática de ubicación GPS (solicita permiso)
   - Opción de marcar como "Trabajo remoto"
   - Campo opcional de notas
   - Visualización de estado activo (si ya hizo check-in)

2. **Historial personal**
   - Vista de registros propios en `/time-entries`
   - Filtros por fecha
   - Edición solo de registros NO bloqueados

---

## 🏢 Funcionalidades para Managers

1. **Reportes de su empresa**
   - Vista de todos los empleados de su empresa en `/reports`
   - Filtros por fechas, empleado
   - Exportación CSV oficial de su empresa

2. **Gestión de empleados**
   - Crear/editar/eliminar empleados de su empresa
   - Ver registros de jornada de sus empleados

---

## 👨‍💼 Funcionalidades para Admins

1. **Control total**
   - Ver todas las empresas y usuarios
   - Gestión de empresas (crear/editar/eliminar)
   - Gestión de usuarios de todas las empresas

2. **Reportes globales**
   - Filtros por empresa, empleado, fechas
   - Exportación CSV de cualquier combinación

3. **Auditoría**
   - Acceso a tabla `time_entry_audits` vía base de datos
   - Puede investigar cualquier modificación sospechosa

---

## 🛠️ Despliegue en Producción

### Base de datos actualizada
```bash
# Ejecutado en producción (https://syncjornada.online)
✅ Migración 2026_01_08_111828_create_time_entry_audits_table
✅ Columnas añadidas manualmente: ip_address, user_agent, employee_confirmed, is_locked, location
✅ Observer registrado en AppServiceProvider::boot()
```

### Verificación de funcionamiento
1. Hacer check-in desde dashboard (debe capturar ubicación)
2. Verificar en base de datos que se guardó latitud/longitud
3. Hacer check-out (debe capturar ubicación de salida)
4. Intentar editar registro antiguo (debe fallar si está bloqueado)
5. Exportar CSV desde `/reports` (debe incluir todas las columnas)

### Programar bloqueo automático
Agregar en `app/Console/Kernel.php`:
```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('timeentries:lock-old')->monthly();
}
```

Y verificar que el cron del servidor ejecute el scheduler:
```bash
* * * * * cd /root/syncjornada && docker-compose exec -T app php artisan schedule:run >> /dev/null 2>&1
```

---

## 📞 Contacto y Soporte

Para dudas sobre cumplimiento normativo o funcionalidades:
- Revisar este documento
- Consultar código en: `/home/jsaenz/Proyectos/SyncJornada`
- Verificar logs de auditoría en tabla `time_entry_audits`

---

## 📅 Fecha de Implementación

**Versión 2.0 - Cumplimiento Total RD-ley 8/2019**  
Implementado: 8 de enero de 2026  
Commit: `2480d62` - "Add compliance features for Spanish labor law"

---

## ⚖️ Disclaimer Legal

Esta aplicación ha sido diseñada para cumplir con los requisitos del Real Decreto-ley 8/2019 sobre registro de jornada laboral en España. Sin embargo, cada empresa debe consultar con sus asesores legales para asegurar que el uso de la aplicación cumple con su situación particular y cualquier convenio colectivo aplicable.

El desarrollador no se hace responsable del mal uso de la aplicación o de interpretaciones erróneas de la normativa laboral. Se recomienda mantener copias de seguridad periódicas de la base de datos y conservarlas durante al menos 4 años.
