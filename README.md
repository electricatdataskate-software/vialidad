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

### 📄 3.1 Denuncias de Tráfico
Es la entidad principal del sistema que registra cada incidente vial.
- **Funciones y Lógica:**
  - `HasMediaFiles`: Trait encargado de gestionar las colecciones de archivos `evidence_images` (fotos) y `evidence_videos` (videos).
  - `HasTrafficReportRelations`: Administra las relaciones con el denunciante, el revisor, el tipo de infracción y la ubicación.
- **Campos Clave:** Descripción del hecho, fecha/hora del suceso (`occurred_at`), estado y clasificación de gravedad.

### 🗂️ 3.2 Tipos de Infracción
Define el catálogo de faltas (ej: Exceso de velocidad, Semáforo en rojo).
- **Funciones:** Permite activar o desactivar categorías mediante el campo `is_active` y se vincula con múltiples reportes.

### 📍 3.3 Ubicaciones
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

### 🛠️ 5.1 Recurso de Denuncias
Este módulo es el más complejo y contiene lógica avanzada:
- **Filtrado de Datos** Implementa seguridad a nivel de base de datos. Si el usuario logueado es un "Usuario" común, la consulta se filtra automáticamente para que **solo vea sus propios registros**. Los Administradores y Supervisores ven todo.
- **Vista de Detalles**
  - Utiliza **Pestañas (Tabs)** para mostrar información general, fotos y videos de forma organizada.
  - Implementa un **Mapa dinámico** para visualizar el sitio exacto del incidente.
- **Acción de Aprobación** 
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

## 📊 8. Dashboard y Estadísticas (Widgets)
El panel principal ("Escritorio") incluye herramientas de visualización de datos en tiempo real para la toma de decisiones:

### 🗺️ 8.1 Mapa Global de Reportes
Visualiza geográficamente todos los incidentes reportados en el sistema.
- **Tecnología:** Integración personalizada con **Leaflet.js** y **OpenStreetMap**.
- **Funcionalidades:**
  - Carga asíncrona de marcadores con popups informativos.
  - Ajuste automático de zoom para encuadrar todos los puntos activos.
  - Filtro interno para asegurar que solo se muestren reportes con coordenadas válidas.
- **Configuración:**

### 📈 8.2 Gráfico de Localidades
Muestra estadística comparativa de la incidencia vial por zona geográfica.
- **Tipo:** Gráfico de barras interactivo (Bar Chart).
- **Lógica:** Agrupa y cuenta los reportes por ciudad/barrio, mostrando el **Top 10** de las zonas con mayor conflictividad.
- **Estética:** Utiliza una paleta de colores personalizada de alta fidelidad visual (Indigo, Violet, Pink, Rose) para mejorar la legibilidad y el impacto visual.

---
*Última actualización: 5 de Abril de 2026*
