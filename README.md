# 💰 Sistema de Caja de Ahorro

## 🌟 Descripción
Este es un sistema de **Caja de Ahorro** desarrollado en **Laravel y MySQL**, diseñado para gestionar socios, aportaciones, préstamos y abonos de manera eficiente.

## 🔧 Tecnologías Utilizadas
- **Backend:** Laravel 10 (PHP)
- **Frontend:** Blade + Tailwind CSS
- **Base de Datos:** MySQL
- **Autenticación:** Laravel Jetstream
- **Interfaz Gráfica:** Laravel Breeze y Blade Templates
- **Gestión de Dependencias:** Composer & NPM

## 🎓 Características Principales
- ✅ **Gestión de Socios**: Registrar, editar y visualizar información de los socios.
- ✅ **Ahorros y Aportaciones**: Control de los depósitos realizados por cada socio.
- ✅ **Préstamos**: Registro y seguimiento de préstamos con control de saldos.
- ✅ **Abonos a Préstamos**: Aplicación de pagos a préstamos y actualización de estados.
- ✅ **Panel de Administración**: Estadísticas sobre el estado de la caja de ahorro.

## 📁 Instalación y Configuración
### 1. Clonar el repositorio
```bash
    git clone https://github.com/tu-usuario/caja-ahorro.git
    cd caja-ahorro
```
### 2. Instalar dependencias
```bash
    composer install
    npm install && npm run build
```
### 3. Configurar variables de entorno
```bash
    cp .env.example .env
```
Luego, edita el archivo `.env` y configura la conexión a tu base de datos MySQL.

### 4. Generar clave de aplicación
```bash
    php artisan key:generate
```
### 5. Ejecutar migraciones y seeders
```bash
    php artisan migrate --seed
```
### 6. Iniciar el servidor
```bash
    php artisan serve
```
Accede a la aplicación en `http://127.0.0.1:8000`

## 👥 Roles y Permisos
- **Administrador:** Acceso total a la gestión de socios, préstamos y abonos.
- **Socios:** Solo pueden visualizar su información y realizar solicitudes.

## 👨‍💻 Contribuciones
Las contribuciones son bienvenidas. Si deseas colaborar, haz un **fork** del repositorio y envía un **pull request**.

## 📈 Capturas de Pantalla
_Aquí puedes agregar imágenes del sistema funcionando._

## 💼 Licencia
Este proyecto está bajo la licencia **MIT**.

---
_Hecho con ❤️ y Laravel._

