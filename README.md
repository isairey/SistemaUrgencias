
# 🚑 Sistema de Urgencias Médicas

Sistema web desarrollado en **Laravel** para la gestión de servicios de urgencias médicas, permitiendo el control de pacientes, atención clínica y administración hospitalaria en tiempo real.

---

## 🚀 Descripción

El **Sistema de Urgencias Médicas** es una plataforma diseñada para optimizar la atención en áreas de emergencia, facilitando el registro, seguimiento y tratamiento de pacientes de manera eficiente.

Está orientado a clínicas, hospitales y centros de salud que requieren una solución digital para mejorar sus procesos.

---

## 🎯 Objetivos

- Mejorar la atención de pacientes en urgencias  
- Reducir tiempos de espera  
- Centralizar la información clínica  
- Facilitar la toma de decisiones médicas  

---

## ✨ Características

### 🧑‍⚕️ Gestión de Pacientes
- Registro de pacientes
- Historial clínico
- Clasificación por nivel de urgencia (triage)

### 🏥 Atención Médica
- Asignación de médicos
- Registro de diagnósticos
- Control de tratamientos

### 📊 Administración
- Gestión de usuarios (admin, médicos, enfermería)
- Reportes y estadísticas
- Control de ingresos y egresos

### ⏱️ Seguimiento en Tiempo Real
- Estado del paciente (en espera, en atención, alta)
- Monitoreo de flujo de urgencias

---

## 🧱 Tecnologías utilizadas

- **Framework:** Laravel  
- **Backend:** PHP  
- **Frontend:** Blade, HTML, CSS, JavaScript  
- **Base de datos:** MySQL  
- **Servidor:** Apache / Nginx  

---

## 🏗️ Estructura del Proyecto

```bash id="treeurgencias"
📦 sistema-urgencias
 ┣ 📂 app
 ┃ ┣ 📂 Http
 ┃ ┃ ┣ 📂 Controllers
 ┃ ┃ ┗ 📂 Middleware
 ┃ ┣ 📂 Models
 ┣ 📂 resources
 ┃ ┣ 📂 views
 ┃ ┗ 📂 js
 ┣ 📂 routes
 ┃ ┗ 📜 web.php
 ┣ 📂 database
 ┃ ┣ 📂 migrations
 ┃ ┗ 📂 seeders
 ┣ 📜 .env
 ┣ 📜 artisan
 ┗ 📜 README.md
```

---

## 🧪 Instalación

# Clonar repositorio
```
git clone https://github.com/isairey/SistemaUrgencias.git
```

# Entrar al proyecto
```
cd SistemaUrgencias
```

# Instalar dependencias
```
composer install
```

# Configurar entorno
```
cp .env.example .env
```

# Generar clave de aplicación
```
php artisan key:generate
```

# Configurar base de datos en .env

# Ejecutar migraciones
```
php artisan migrate
```

# Iniciar servidor
```
php artisan serve
```

---

## ⚙️ Configuración

- Edita el archivo .env con tus credenciales de base de datos
- Configura el sistema de correo (opcional)
- Ajusta variables de entorno según tu servidor

---

## 🔐 Seguridad 

- Autenticación de usuarios integrada (Laravel Auth)
- Protección contra CSRF y XSS
- Encriptación de contraseñas
- Control de roles y permisos

---

## 📈 Estado del Proyecto

🟢 Funcional / En desarrollo continuo

---

## 👨‍💻 Autor

**Isai Reyes**

---


## 📄 Licencia

Este proyecto está bajo la licencia MIT.

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
