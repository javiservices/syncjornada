# Sistema de Gestión de Vacaciones - SyncJornada

## 📋 Descripción General

El sistema permite a los empleados solicitar vacaciones mediante un calendario, y a los gerentes aprobar o rechazar dichas solicitudes. Incluye notificaciones por email en cada paso del proceso.

## 🔑 Características Principales

### Para Empleados (employee)
- ✅ Solicitar vacaciones seleccionando fechas de inicio y fin
- ✅ Ver días laborables calculados automáticamente (excluye sábados y domingos)
- ✅ Editar solicitudes pendientes
- ✅ Eliminar solicitudes pendientes
- ✅ Recibir email cuando su solicitud es aprobada o rechazada
- ✅ Ver historial de todas sus solicitudes

### Para Gerentes (manager) y Administradores (admin)
- ✅ Ver todas las solicitudes de vacaciones de su empresa
- ✅ Aprobar o rechazar solicitudes
- ✅ Agregar notas al aprobar/rechazar
- ✅ Recibir email cuando un empleado solicita vacaciones
- ✅ Filtrar solicitudes por estado

## 📍 Acceso al Sistema

### Menú de navegación
El enlace "Vacaciones" está disponible en el menú principal para todos los usuarios autenticados.

**Desktop**: Aparece entre "Jornadas" y "Empresas/Mi Empresa"
**Mobile**: Aparece en el menú hamburguesa

## 🎯 Flujo de Trabajo

### 1. Solicitar Vacaciones (Empleado)

1. Ir a **Vacaciones** → **Solicitar Vacaciones**
2. Seleccionar **Fecha de inicio** y **Fecha de fin**
3. El sistema calcula automáticamente los días laborables
4. Opcionalmente agregar un **Motivo**
5. Hacer clic en **Enviar Solicitud**

**✉️ Email enviado a:** Todos los gerentes y administradores de la empresa

### 2. Revisar Solicitud (Gerente/Admin)

1. Recibir email de notificación con detalles
2. Ir a **Vacaciones** → hacer clic en **Ver** en la solicitud
3. Revisar información del empleado y fechas
4. Hacer clic en **Aprobar** o **Rechazar**
5. Opcionalmente agregar notas
6. Confirmar acción

**✉️ Email enviado a:** El empleado que solicitó las vacaciones

### 3. Ver Resultado (Empleado)

1. Recibir email con el resultado (Aprobada o Rechazada)
2. Ver detalles en **Vacaciones**
3. Las solicitudes aprobadas/rechazadas **NO** se pueden editar

## 📊 Estados de Solicitudes

| Estado | Color | Descripción | ¿Editable? |
|--------|-------|-------------|------------|
| **Pendiente** | 🟡 Amarillo | Esperando revisión de gerente | ✅ Sí |
| **Aprobada** | 🟢 Verde | Aprobada por gerente | ❌ No |
| **Rechazada** | 🔴 Rojo | Rechazada por gerente | ❌ No |

## 🔒 Permisos y Restricciones

### Empleados (employee)
- ✅ Pueden crear solicitudes
- ✅ Pueden editar sus propias solicitudes **si están pendientes**
- ✅ Pueden eliminar sus propias solicitudes **si están pendientes**
- ✅ Solo ven sus propias solicitudes
- ❌ No pueden aprobar/rechazar solicitudes

### Gerentes (manager)
- ✅ Todo lo que puede hacer un empleado
- ✅ Pueden ver todas las solicitudes de su empresa
- ✅ Pueden aprobar/rechazar solicitudes de su empresa
- ❌ No pueden editar/eliminar solicitudes de otros

### Administradores (admin)
- ✅ Todo lo que puede hacer un gerente
- ✅ Pueden ver todas las solicitudes del sistema

## 📧 Notificaciones por Email

### Email 1: Nueva Solicitud (para Gerentes)
**Asunto:** Nueva Solicitud de Vacaciones
**Destinatarios:** Gerentes y administradores de la empresa
**Contenido:**
- Nombre y email del empleado
- Fechas de inicio y fin
- Total de días laborables
- Motivo (si se proporcionó)
- Botón para ver solicitud

### Email 2: Solicitud Aprobada (para Empleado)
**Asunto:** Solicitud de Vacaciones Aprobada
**Destinatario:** El empleado que solicitó
**Contenido:**
- Fechas aprobadas
- Total de días
- Nombre del gerente que aprobó
- Fecha de aprobación
- Notas del gerente (si hay)

### Email 3: Solicitud Rechazada (para Empleado)
**Asunto:** Solicitud de Vacaciones Rechazada
**Destinatario:** El empleado que solicitó
**Contenido:**
- Fechas solicitadas
- Total de días
- Nombre del gerente que rechazó
- Fecha de rechazo
- Motivo del rechazo (si hay)

## 💻 Tecnología

### Base de Datos
Tabla: `vacation_requests`

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | ID único |
| user_id | bigint | ID del empleado |
| start_date | date | Fecha de inicio |
| end_date | date | Fecha de fin |
| days | integer | Días laborables |
| reason | text | Motivo (opcional) |
| status | enum | pending/approved/rejected |
| reviewed_by | bigint | ID del gerente que revisó |
| reviewed_at | timestamp | Fecha de revisión |
| manager_notes | text | Notas del gerente |

### Rutas

**Públicas (autenticadas):**
- `GET /vacation-requests` - Lista de solicitudes
- `GET /vacation-requests/create` - Formulario de solicitud
- `POST /vacation-requests` - Crear solicitud
- `GET /vacation-requests/{id}` - Ver detalles
- `GET /vacation-requests/{id}/edit` - Editar (solo pendientes)
- `PUT /vacation-requests/{id}` - Actualizar (solo pendientes)
- `DELETE /vacation-requests/{id}` - Eliminar (solo pendientes)

**Gerentes/Admins:**
- `POST /vacation-requests/{id}/approve` - Aprobar solicitud
- `POST /vacation-requests/{id}/reject` - Rechazar solicitud

### Modelos
- **VacationRequest**: Modelo principal
- **VacationRequestCreated**: Email para gerentes
- **VacationRequestReviewed**: Email para empleados

## 📱 Responsive Design

El sistema está completamente optimizado para:
- 📱 Móviles (320px+)
- 📱 Tablets (768px+)
- 💻 Desktop (1024px+)

## 🔍 Filtros Disponibles

En la vista de lista, los usuarios pueden filtrar por:
- 📋 **Todos** - Todas las solicitudes
- ⏳ **Pendientes** - Solo pendientes
- ✅ **Aprobadas** - Solo aprobadas
- ❌ **Rechazadas** - Solo rechazadas

## 🎨 Interfaz de Usuario

### Vista de Lista
- Tabla con todas las solicitudes
- Badges de color según estado
- Acciones rápidas (Ver, Editar, Eliminar)
- Paginación automática (20 por página)

### Formulario de Solicitud
- Selector de fechas con validación
- Cálculo automático de días laborables en tiempo real
- Validación de fechas (no permitir fechas pasadas)
- Textarea para motivo (máx. 500 caracteres)
- Información de ayuda

### Vista de Detalles
- Información completa de la solicitud
- Estado visual con badges
- Modales para aprobar/rechazar
- Notas del gerente visibles

## ⚠️ Validaciones

### Frontend
- Fecha de inicio no puede ser anterior a hoy
- Fecha de fin no puede ser anterior a fecha de inicio
- Se actualiza automáticamente el mínimo de fecha de fin

### Backend
- Validación de fechas
- Validación de permisos
- Validación de estado (solo pendientes editables)
- Validación de empresa (gerentes solo su empresa)

## 🚀 Próximas Mejoras (Opcional)

- [ ] Calendario visual para ver vacaciones de todo el equipo
- [ ] Límite de días de vacaciones por año
- [ ] Detección de conflictos (dos personas de vacaciones el mismo día)
- [ ] Exportar solicitudes a PDF/Excel
- [ ] Historial de cambios en solicitudes
- [ ] Dashboard con estadísticas de vacaciones

## 📞 Soporte

Para reportar problemas o sugerencias:
- Email: syncjornada@gmail.com
- GitHub: https://github.com/javiservices/syncjornada

---

**Versión:** 1.0.0  
**Fecha:** 09 Enero 2025  
**Sistema:** SyncJornada - Gestión de Jornadas Laborales
