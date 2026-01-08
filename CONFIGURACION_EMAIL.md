# Configuración de Email para SyncJornada

## Actualizar archivo .env en producción

Añade estas líneas al archivo `.env` en tu servidor de producción:

### Opción 1: Gmail/Google Workspace
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu-email@gmail.com
MAIL_PASSWORD=tu-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu-email@gmail.com
MAIL_FROM_NAME="SyncJornada"
```

**Nota**: Para Gmail necesitas crear una "App Password" en tu cuenta Google:
1. Ve a https://myaccount.google.com/security
2. Activa "2-Step Verification" si no lo tienes
3. Ve a "App passwords"
4. Genera una contraseña para "Mail"
5. Usa esa contraseña en MAIL_PASSWORD

---

### Opción 2: SendGrid
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=TU_SENDGRID_API_KEY
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@syncjornada.online
MAIL_FROM_NAME="SyncJornada"
```

---

### Opción 3: Mailgun
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=mg.tudominio.com
MAILGUN_SECRET=TU_MAILGUN_SECRET
MAILGUN_ENDPOINT=api.mailgun.net
MAIL_FROM_ADDRESS=noreply@tudominio.com
MAIL_FROM_NAME="SyncJornada"
```

---

### Opción 4: SMTP Personalizado (Hosting)
```env
MAIL_MAILER=smtp
MAIL_HOST=mail.tudominio.com
MAIL_PORT=587
MAIL_USERNAME=noreply@tudominio.com
MAIL_PASSWORD=tu-contraseña
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@tudominio.com
MAIL_FROM_NAME="SyncJornada"
```

---

## Pasos para Aplicar la Configuración

### 1. Editar .env en producción
```bash
ssh root@157.180.77.232
cd /root/syncjornada
nano .env
```

### 2. Añadir las variables de correo
Copia y pega las líneas según el servicio que elijas

### 3. Limpiar caché de configuración
```bash
docker-compose exec -T app php artisan config:clear
docker-compose exec -T app php artisan config:cache
```

### 4. Probar envío de email
```bash
# Prueba manual del comando de check-in
docker-compose exec -T app php artisan reminders:daily-checkin

# Prueba manual del comando de check-out
docker-compose exec -T app php artisan reminders:missing-checkout
```

---

## Verificar que el Cron está Activo

El scheduler de Laravel debe estar ejecutándose:

```bash
# Ver si el cron está configurado
crontab -l

# Debería mostrar algo como:
* * * * * cd /root/syncjornada && docker-compose exec -T app php artisan schedule:run >> /dev/null 2>&1
```

Si no existe, añádelo:
```bash
crontab -e
# Añade la línea:
* * * * * cd /root/syncjornada && docker-compose exec -T app php artisan schedule:run >> /dev/null 2>&1
```

---

## Logs de Correos

Para ver si los correos se están enviando:

```bash
# Ver logs de Laravel
docker-compose exec -T app tail -f storage/logs/laravel.log

# Ver logs específicos de email
docker-compose exec -T app grep -i "mail" storage/logs/laravel.log
```

---

## Solución de Problemas

### Email no llega
1. Verifica spam/basura
2. Revisa logs: `docker-compose exec -T app tail -100 storage/logs/laravel.log`
3. Verifica configuración: `docker-compose exec -T app php artisan config:show mail`

### Error de autenticación
- Gmail: Verifica que uses App Password, no la contraseña normal
- SMTP: Verifica usuario y contraseña
- Puerto: Prueba 587 (TLS) o 465 (SSL)

### Email se envía pero no se recibe
- Verifica el MAIL_FROM_ADDRESS sea un email válido
- Algunos servidores requieren que el FROM coincida con el dominio
- Configura SPF y DKIM en tu dominio

---

## Configuración por Empresa

Una vez que el email funcione, cada empresa puede configurar:

1. **Horas personalizadas** de recordatorios
2. **Activar/desactivar** notificaciones
3. **Zona horaria** específica

Desde: **Empresas → Editar → Configuración de Notificaciones**

---

## Testing

Después de configurar, prueba con un usuario real:

1. Crea un fichaje de prueba sin cerrar
2. Espera a la hora configurada de check-out
3. Verifica que llegue el email
4. Revisa que el email tenga el formato correcto

---

¿Qué servicio de email prefieres usar?
