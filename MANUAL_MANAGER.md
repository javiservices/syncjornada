# 📋 Manual de Usuario - Manager

## Bienvenido a SyncJornada

Este manual está diseñado para **Managers** y explica todas las funcionalidades disponibles para gestionar tu empresa y equipo.

---

## 🏠 Dashboard / Panel Principal

Al iniciar sesión, accederás al dashboard donde podrás:

### Tu Jornada Personal
- **Fichar entrada/salida**: Registra tu propia jornada laboral
- **Ver tus estadísticas**:
  - Horas trabajadas hoy
  - Horas acumuladas esta semana
  - Horas del mes y días trabajados

### Estado del Equipo (Solo Managers/Admins)
Visualiza en tiempo real:
- **Activos hoy**: Empleados que han fichado hoy
- **Sin cerrar**: Fichajes que no tienen hora de salida
- **Gráfico circular**: Proporción de activos vs inactivos

### Gráficos y Estadísticas
- **Últimos 7 días**: Gráfica de líneas con tus horas trabajadas por día
- **Resumen semanal**: Detalle de los últimos fichajes con fechas y horas

---

## 🕐 Sistema de Fichaje

### Cómo Fichar Entrada
1. Ve al dashboard
2. Haz clic en el botón **"Fichar Entrada"** (azul)
3. El sistema registrará automáticamente:
   - Fecha y hora exacta
   - Tu dirección IP
   - Ubicación GPS (si está habilitada)
4. Verás un mensaje de confirmación

### Cómo Fichar Salida
1. En el dashboard, haz clic en **"Fichar Salida"** (verde)
2. El sistema calculará automáticamente las horas trabajadas
3. Se generará el registro completo del día

### ⏸️ Sistema de Pausas

Durante tu jornada, puedes tomar descansos:

1. **Iniciar Pausa**:
   - Haz clic en "Iniciar Pausa"
   - Selecciona el motivo:
     - Descanso
     - Comida
     - Café
     - Reunión
     - Asunto personal
     - Otro

2. **Reanudar Trabajo**:
   - Haz clic en "Reanudar Trabajo"
   - El sistema registrará el tiempo de descanso
   - Se descontará del tiempo total trabajado

3. **Ver pausas activas**: El dashboard mostrará si tienes una pausa en curso

---

## 👥 Gestión de Usuarios

Como manager, puedes administrar a los empleados de tu empresa.

### Ver Lista de Usuarios
1. Ve a **Menú → Usuarios**
2. Verás la tabla con:
   - Nombre
   - Email
   - DNI/NIE
   - Empresa
   - Rol
   - Acciones (editar/eliminar)

### Filtros Disponibles
- **Por Rol**: Employee, Manager
- Botón "Limpiar" para resetear filtros

### Crear Nuevo Usuario
1. Haz clic en **"Crear Usuario"** (azul, arriba)
2. Completa el formulario:
   - **Nombre completo**
   - **Email** (único en el sistema)
   - **DNI/NIE** (opcional)
   - **Contraseña** (mínimo 8 caracteres)
   - **Confirmar contraseña**
   - **Empresa**: Automáticamente tu empresa
   - **Rol**: Solo puedes crear "Employee"
3. Haz clic en **"Crear"**

### Editar Usuario
1. Haz clic en el icono ✏️ (azul) en la fila del usuario
2. Modifica los campos necesarios:
   - Nombre
   - Email
   - DNI/NIE
   - Rol (solo Employee)
3. Haz clic en **"Actualizar"**

⚠️ **Nota**: No puedes cambiar la contraseña desde aquí. El usuario debe hacerlo desde su perfil.

### Eliminar Usuario
1. Haz clic en el icono 🗑️ (rojo)
2. Confirma la acción en el diálogo
3. El usuario será eliminado permanentemente

⚠️ **Restricción**: No puedes eliminar tu propia cuenta desde aquí.

---

## 🏢 Gestión de Tu Empresa

### Ver Información de la Empresa
1. Ve a **Menú → Empresas**
2. Verás tu empresa listada

### Editar Empresa
1. Haz clic en el icono ✏️ (azul)
2. Puedes modificar:
   - **Nombre de la empresa**
   - **CIF** (opcional)
   - **Email de contacto**
   - **Teléfono** (opcional)
   - **Dirección** (opcional)
   - **Zona horaria**: Importante para el cálculo correcto de horas
     - Europe/Madrid (GMT+1)
     - Europe/London (GMT+0)
     - America/New_York (GMT-5)
     - America/Los_Angeles (GMT-8)
     - America/Mexico_City (GMT-6)
     - America/Argentina/Buenos_Aires (GMT-3)
     - UTC (GMT+0)
3. Haz clic en **"Actualizar"**

⚠️ **Restricción**: Los managers NO pueden eliminar empresas (solo administradores).

---

## 📊 Reportes de Jornada

### Acceder a Reportes
1. Ve a **Menú → Reportes**
2. Verás la tabla completa de fichajes de tu empresa

### Información Mostrada
- **Usuario**: Nombre del empleado
- **Fecha**: Día del fichaje
- **Entrada**: Hora de inicio
- **Salida**: Hora de fin
- **Modalidad**: Presencial / Remoto
- **Horas trabajadas**: Calculado automáticamente
- **Ubicación**: Coordenadas GPS (si disponible)

### Filtros Avanzados
1. **Rango de fechas**:
   - Fecha desde
   - Fecha hasta
2. **Usuario específico**: Selecciona de la lista
3. **Modalidad**: Presencial / Remoto / Todas
4. Haz clic en **"Filtrar"**

### Exportar Reportes

#### 📄 Exportar a CSV
1. Aplica los filtros deseados
2. Haz clic en **"Exportar CSV"** (verde)
3. Se descargará un archivo Excel con:
   - Todos los campos de fichaje
   - Compatible con Excel, Google Sheets, etc.

#### 📑 Exportar a PDF
1. Aplica los filtros deseados
2. Haz clic en **"Exportar PDF"** (rojo)
3. Se generará un documento oficial con:
   - Encabezado legal (RD-ley 8/2019)
   - Información de la empresa (CIF, nombre)
   - Periodo del reporte
   - Tabla completa de fichajes
   - Resumen estadístico:
     - Total horas trabajadas
     - Promedio diario
     - Días trabajados
     - Fichajes presenciales vs remotos
   - Pie de página con declaración de veracidad

⚠️ **Importante**: Este PDF cumple con la normativa española de registro de jornada.

---

## 🔔 Sistema de Notificaciones

SyncJornada envía correos automáticos para ayudarte a gestionar tu equipo:

### Recordatorio Diario (8:00 AM)
- Se envía a todos los empleados cada mañana
- Recuerda fichar entrada al comenzar la jornada

### Alerta de Salida Olvidada (7:00 PM)
- Se envía si un empleado tiene check-in pero no check-out
- Incluye:
  - Fecha del fichaje incompleto
  - Hora de entrada registrada
  - Enlace directo al dashboard para completar

---

## 🔍 Historial de Auditoría

### Acceder al Historial
1. Ve a **Menú → Auditoría** (si está visible)
2. Verás todos los cambios realizados en fichajes

### Información del Historial
- **Fecha/hora** del cambio
- **Usuario afectado**: Empleado cuyo fichaje fue modificado
- **Fecha del fichaje**: Día del registro modificado
- **Acción**: Creación / Modificación / Eliminación
- **Modificado por**: Quién hizo el cambio

### Filtros de Auditoría
1. **Usuario**: Ver cambios de un empleado específico
2. **Rango de fechas**: Desde - Hasta
3. **Tipo de acción**: Creación / Modificación / Eliminación
4. Haz clic en **"Aplicar Filtros"**

### Ver Detalles de un Cambio
1. Haz clic en **"Ver Cambios"** en cualquier fila
2. Se desplegará:
   - **Valores anteriores** (fondo rojo)
   - **Valores nuevos** (fondo verde)
   - **Información técnica**: IP, navegador usado

---

## 👤 Gestión de Perfil Personal

### Editar Tu Perfil
1. Ve a **Menú → Perfil**
2. En la sección "Información del Perfil" puedes modificar:
   - **Nombre**
   - **Email**
   - **DNI/NIE**
3. Haz clic en **"Guardar"**

### Cambiar Contraseña
1. En la sección "Actualizar Contraseña":
   - Ingresa tu **contraseña actual**
   - Nueva contraseña (mínimo 8 caracteres)
   - Confirma la nueva contraseña
2. Haz clic en **"Guardar"**

### Eliminar Tu Cuenta
⚠️ **Acción irreversible**
1. En la sección "Eliminar Cuenta"
2. Ingresa tu contraseña para confirmar
3. Haz clic en "Eliminar Cuenta"

---

## 📱 Uso en Móvil

SyncJornada es completamente responsive:

### Funcionalidades móviles
- Dashboard adaptado con tarjetas
- Fichaje con un solo toque
- Listas optimizadas en formato card
- Menú hamburguesa para navegación
- Gráficos adaptados al tamaño de pantalla

### Geolocalización
- Al fichar desde móvil, se puede capturar la ubicación GPS
- Útil para verificar fichajes remotos vs presenciales

---

## 🛡️ Seguridad y Privacidad

### Datos Registrados en Cada Fichaje
- Fecha y hora exacta
- Dirección IP
- User Agent (navegador y dispositivo)
- Coordenadas GPS (opcional)
- Firma digital

### Auditoría de Cambios
- Todos los cambios en fichajes quedan registrados
- Imposible modificar sin dejar rastro
- Cumplimiento legal garantizado

---

## ❓ Preguntas Frecuentes (FAQ)

### ¿Puedo editar un fichaje de un empleado?
Sí, como manager puedes editar fichajes, pero quedará registrado en la auditoría.

### ¿Cuántos usuarios puedo crear?
No hay límite de usuarios en tu empresa.

### ¿Puedo ver los fichajes de otras empresas?
No, solo puedes ver los datos de tu propia empresa.

### ¿Qué pasa si un empleado olvida fichar?
Puedes crear el fichaje manualmente o el empleado puede hacerlo desde su cuenta (quedará registrado el retraso).

### ¿Se pueden eliminar fichajes?
Sí, pero quedará registrado en la auditoría quién lo eliminó y cuándo.

### ¿Cómo se calculan las horas trabajadas?
Automáticamente restando: (Hora de salida - Hora de entrada - Tiempo de pausas)

### ¿El PDF es válido legalmente?
Sí, cumple con el RD-ley 8/2019 sobre registro de jornada en España.

---

## 🆘 Soporte Técnico

Si necesitas ayuda adicional:

📧 **Email**: soporte@syncjornada.online  
🌐 **Web**: https://syncjornada.online  
📱 **WhatsApp**: [Tu número]

---

## 📌 Atajos Rápidos

| Acción | Ubicación |
|--------|-----------|
| Fichar entrada/salida | Dashboard → Botón azul/verde |
| Ver empleados | Menú → Usuarios |
| Crear empleado | Usuarios → Crear Usuario |
| Ver reportes | Menú → Reportes |
| Exportar PDF | Reportes → Exportar PDF |
| Editar empresa | Empresas → Icono lápiz |
| Ver auditoría | Menú → Auditoría |
| Cambiar contraseña | Perfil → Actualizar Contraseña |

---

**Versión del Manual**: 1.0  
**Última Actualización**: 8 de enero de 2026  
**Aplicación**: SyncJornada v2.0
