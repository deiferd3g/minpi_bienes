# 🏆 Tablero Scrum - Proyecto: SBN (Sistema de Bienes Nacionales)

## 📋 Product Backlog

| # | Historia / Tarea | Tipo | Prioridad | Story Pts | Sprint |
|---|---|---|---|:---:|---|
| 1 | Instalar Laravel 13 + Livewire + Flux UI + Boost | Técnica | Crítica | 3 | Sprint 1 ✅ |
| 2 | Base de datos: migraciones y modelos de datos | Técnica | Crítica | 5 | Sprint 1 ✅ |
| 3 | Seeder con datos realistas (minist, institutos, bienes) | Técnica | Alta | 5 | Sprint 1 ✅ |
| 4 | Módulo: Órganos/Entidades (CRUD + jerarquía) | User Story | Crítica | 8 | Sprint 2 🏃 |
| 5 | Módulo: Bienes Nacionales (CRUD + clasificación) | User Story | Crítica | 13 | Sprint 2 🏃 |
| 6 | Módulo: Custodios (CRUD + asignación) | User Story | Alta | 8 | Sprint 2 🏃 |
| 7 | Módulo: Ubicaciones (listado) | User Story | Alta | 3 | Sprint 2 🏃 |
| 8 | Vista detalle de Bien (información completa) | User Story | Alta | 5 | Sprint 2 🏃 |
| 9 | Módulo: Movimientos/Transferencias | User Story | Alta | 8 | Sprint 3 ⏳ |
| 10 | Módulo: Inventarios (toma física + conciliación) | User Story | Alta | 13 | Sprint 3 ⏳ |
| 11 | Módulo: Actas (documentos oficiales) | User Story | Media | 8 | Sprint 3 ⏳ |
| 12 | Reportes y Dashboard con KPIs | User Story | Alta | 8 | Sprint 3 ⏳ |
| 13 | Módulo: Mantenimientos | User Story | Media | 8 | Sprint 4 |
| 14 | Módulo: Depreciaciones (cálculo automático) | User Story | Media | 8 | Sprint 4 |
| 15 | Livewire Components (búsqueda en vivo) | Técnica | Alta | 5 | Sprint 4 |
| 16 | PDF generation de actas (barryvdh/laravel-dompdf) | Técnica | Media | 5 | Sprint 4 |
| 17 | Autenticación + roles (admin, gestor, consultor) | User Story | Crítica | 5 | Backlog |
| 18 | Exportación a Excel/CSV | User Story | Baja | 3 | Backlog |
| 19 | API REST para interoperabilidad | User Story | Media | 13 | Backlog |
| 20 | Tests automatizados (Pest) | Técnica | Alta | 8 | Backlog |

---

### 🏃 Sprint 2 - En Progreso (Actual)

**Objetivo:** Módulos core del SBN con CRUDs funcionales.

| Estado | Tarea | Pts | Responsable |
|--------|-------|:--:|:-----------:|
| 🔄 In Progress | Módulo Órganos/Entidades | 8 | @dev |
| 🔄 In Progress | Módulo Bienes Nacionales | 13 | @dev |
| 🔄 In Progress | Módulo Custodios | 8 | @dev |
| ✅ Done | Vistas Blade con Flux UI | 5 | @dev |
| ✅ Done | Dashboard con KPIs | 5 | @dev |
| ✅ Done | Migraciones y Modelos | 5 | @dev |
| ✅ Done | Seeders con datos demo | 5 | @dev |
| | **Total Sprint** | **49** | |
| | **Completado** | **20** | (40%) |

---

### ✅ Sprint 1 - Completado

| Tarea | Pts | Estado |
|-------|:---:|:------:|
| Instalación Laravel 13 + Livewire + Flux UI | 3 | ✅ |
| Laravel Boost | 1 | ✅ |
| Configuración PostgreSQL | 1 | ✅ |
| Migraciones (13 tablas) | 5 | ✅ |
| Modelos Eloquent (13 modelos) | 5 | ✅ |
| Seeders con datos reales de Venezuela | 5 | ✅ |
| NPM build + Asset compilation | 2 | ✅ |
| Pest Testing framework | 2 | ✅ |
| **TOTAL** | **24** | **✅ 24/24** |

---

### 📊 Métricas del Proyecto

| Métrica | Valor |
|---------|:-----:|
| **Velocidad estimada** | 24 pts/sprint |
| **Duración del sprint** | 2 semanas |
| **Total backlog** | ~140 story points |
| **Progreso** | ~17% |
| **Sprints proyectados** | 6 sprints (~12 semanas) |

---

### 🏗️ Arquitectura del Sistema

```
SBN - Sistema de Bienes Nacionales
├── 🏛️ Órganos (jerarquía: ministerio → instituto → dirección)
├── 📍 Ubicaciones (sedes, oficinas, almacenes)
├── 📦 Categorías de Bienes (árbol jerárquico)
├── 🏭 Fabricantes / Marcas
├── 🖥️ Bienes (código patrimonial único)
├── 👤 Custodios (funcionarios responsables)
├── 📋 Asignaciones (bien → custodio)
├── 🔄 Movimientos (transferencias, reubicaciones)
├── 📉 Depreciaciones (línea recta, suma dígitos)
├── 📊 Inventarios (toma física + conciliación)
├── 📄 Actas (documentos legales)
└── 🔧 Mantenimientos (preventivo/correctivo)
```

### 👥 Roles del Sistema (futuro)

| Rol | Descripción |
|-----|-------------|
| 👑 Administrador | Control total del sistema |
| 🏛️ Gestor de Bienes | CRUD de bienes, asignaciones, movimientos |
| 📋 Auditor | Inventarios, conciliaciones, reportes |
| 👁️ Consultor | Solo lectura |
