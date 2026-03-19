# Proyecto Vialidad - Documentación Técnica Completa 🇦🇷

## 📌 1. Introducción
El proyecto **Vialidad** es una plataforma centralizada para la gestión de incidentes, infracciones y denuncias de tráfico. Permite el reporte ciudadano u oficial de infracciones, la carga de evidencia técnica (fotos y videos) y el seguimiento administrativo hasta su resolución o desestimación.

---

## 🛠️ 2. Arquitectura y Tecnologías
- **Framework Principal:** Laravel 12.
- **Panel Administrativo:** Filament v5 (Gestión de recursos, tablas y formularios).
- **Lenguaje:** PHP 8.3.30+.
- **Gestión Multimedia:** Spatie Media Library (Colecciones optimizadas para evidencia).
- **Geolocalización:** Integración con mapas para la visualización de incidentes.
- **Testing:** Pest PHP (Pruebas unitarias y de funcionalidad).

---

## 📂 3. Análisis Detallado de Módulos y Modelos

### 📄 3.1 Denuncias de Tráfico ([TrafficReport](cci:2://file://wsl.localhost/Ubuntu/home/pablodonato/vialidad/app/Models/Reports/TrafficReport.php:13:0-38:1))
Es la entidad principal del sistema que registra cada incidente vial.
- **Funciones y Lógica:**
  - `HasMediaFiles`: Trait encargado de gestionar las colecciones de archivos `evidence_images` (fotos) y `evidence_videos` (videos).
  - `HasTrafficReportRelations`: Administra las relaciones con el denunciante ([reportedBy](cci:1://file://wsl.localhost/Ubuntu/home/pablodonato/vialidad/app/Models/Reports/Traits/HasTrafficReportRelations.php:11:4-14:5)), el revisor ([reviewedBy](cci:1://file://wsl.localhost/Ubuntu/home/pablodonato/vialidad/app/Models/Reports/Traits/HasTrafficReportRelations.php:16:4-19:5)), el tipo de infracción y la ubicación.
- **Campos Clave:** Descripción del hecho, fecha/hora del suceso (`occurred_at`), estado y clasificación de gravedad.

### 🗂️ 3.2 Tipos de Infracción ([ViolationType](cci:2://file://wsl.localhost/Ubuntu/home/pablodonato/vialidad/app/Models/Reports/ViolationType.php:9:0-22:1))
Define el catálogo de faltas (ej: Exceso de velocidad, Semáforo en rojo).
- **Funciones:** Permite activar o desactivar categorías mediante el campo `is_active` y se vincula con múltiples reportes.

### 📍 3.3 Ubicaciones ([Location](cci:2://file://wsl.localhost/Ubuntu/home/pablodonato/vialidad/app/Models/Reports/Location.php:7:0-31:1))
Almacena datos geoespaciales precisos.
- **Detalle:** Guarda latitud, longitud, dirección completa, provincia, ciudad, barrio y número de calle. Esta granularidad permite realizar análisis estadísticos por zonas.

---

## 🚦 4. Lógica de Negocio y Flujos (Enums)

### 🔄 4.1 Ciclo de Vida del Reporte (`TrafficReportStatus`)
Cada denuncia pasa por los siguientes estados:
1. **Pendiente (`Pending`):** Al ser creada.
2. **En Revisión (`UnderReview`):** Cuando la autoridad inicia la auditoría.
3. **Resuelto (`Resolved`):** Infracción confirmada y sanción/acción administrativa cargada.
4. **Rechazado (`Rejected`):** Denuncia desestimada por falta de pruebas o error.

### ⚠️ 4.2 Clasificación de Gravedad (`Classification`)
Determina el impacto de la falta: **Leve**, **Grave** o **Muy Grave**. Estos valores definen visualmente el "Badge" (etiqueta) en el panel.

### 👥 4.3 Roles y Permisos (`UserRole`)
- **Administrador:** Control total del sistema.
- **Supervisor:** Gestiona y resuelve las denuncias.
- **Usuario:** Solo puede crear denuncias y ver el historial de sus propios reportes.

---

## 🖥️ 5. Panel Administrativo y Funciones de Filament

### 🛠️ 5.1 Recurso de Denuncias ([TraffictReportResource](cci:2://file://wsl.localhost/Ubuntu/home/pablodonato/vialidad/app/Filament/Resources/TraffictReports/TraffictReportResource.php:34:0-180:1))
Este módulo es el más complejo y contiene lógica avanzada:
- **Filtrado de Datos ([getEloquentQuery](cci:1://file://wsl.localhost/Ubuntu/home/pablodonato/vialidad/app/Filament/Resources/TraffictReports/TraffictReportResource.php:143:4-155:5)):** Implementa seguridad a nivel de base de datos. Si el usuario logueado es un "Usuario" común, la consulta se filtra automáticamente para que **solo vea sus propios registros**. Los Administradores y Supervisores ven todo.
- **Vista de Detalles ([infolist](cci:1://file://wsl.localhost/Ubuntu/home/pablodonato/vialidad/app/Filament/Resources/TraffictReports/TraffictReportResource.php:47:4-141:5)):**
  - Utiliza **Pestañas (Tabs)** para mostrar información general, fotos y videos de forma organizada.
  - Implementa un **Mapa dinámico** para visualizar el sitio exacto del incidente.
- **Acción de Aprobación (`Action::accept`):** 
  - Función que lanza un modal donde el supervisor debe asignar la clasificación, cargar notas de revisión y detallar la acción administrativa. Al ejecutarse, actualiza automáticamente la fecha de revisión y el estado a `Resolved`.

---

## 🛡️ 6. Seguridad y Políticas de Acceso
El proyecto utiliza el sistema de **Policies** de Laravel vinculado directamente a los modelos:
- **Atributos de Clase:** Se usa la sintaxis `#[UsePolicy]` (novedad de Laravel) para vincular políticas como `TrafficReportPolicies` directamente en la definición del Modelo.
- **Restricciones:** Los usuarios no pueden editar reportes creados por otros, y solo los administradores pueden gestionar los tipos de infracción.

---

## 🚀 7. Guía de Instalación Rápida
1. Clonar: `git clone <url-repositorio>`
2. Dependencias: `composer install`
3. Entorno: `cp .env.example .env` + `php artisan key:generate`
4. Base de Datos: `php artisan migrate --seed`
5. Frontend: `npm install && npm run dev`
6. Servidor: `php artisan serve`

---
*Última actualización: 18 de Marzo de 2026*
