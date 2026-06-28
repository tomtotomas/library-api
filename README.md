# Library API

API RESTful construida con Laravel y Sanctum para gestionar un catálogo de libros con categorización por géneros, autenticación de usuarios y control de acceso basado en roles.

---

## Tecnologías

- PHP / Laravel
- Laravel Sanctum (autenticación por token)
- MySQL

---

## Instalación

```bash
git clone <repo-url>
cd <carpeta-del-proyecto>
composer install
cp .env.example .env
php artisan key:generate
```

Configurar las credenciales de la base de datos en `.env` y luego ejecutar:

```bash
php artisan migrate
php artisan serve
```

---

## Autenticación

La API utiliza autenticación por token con Sanctum. Después de iniciar sesión, incluir el token en el header `Authorization` de cada petición protegida:

```
Authorization: Bearer <token>
```

Existen dos roles: `user` (por defecto) y `admin`.

---

## Endpoints

### Auth

| Método | Endpoint | Auth | Descripción |
|--------|----------|------|-------------|
| POST | `/api/register` | Público | Registrar un nuevo usuario |
| POST | `/api/login` | Público | Iniciar sesión y obtener token |
| POST | `/api/logout` | Requerida | Invalidar el token actual |
| GET | `/api/me` | Requerida | Obtener info del usuario autenticado |

### Géneros

| Método | Endpoint | Auth | Descripción |
|--------|----------|------|-------------|
| GET | `/api/genres` | Público | Listar todos los géneros |
| GET | `/api/genres/{id}` | Público | Obtener un género por ID |
| POST | `/api/genres` | Admin | Crear un género |
| PUT/PATCH | `/api/genres/{id}` | Admin | Actualizar un género (PATCH admite actualización parcial) |
| DELETE | `/api/genres/{id}` | Admin | Eliminar un género |

### Libros

| Método | Endpoint | Auth | Descripción |
|--------|----------|------|-------------|
| GET | `/api/books` | Público | Listar todos los libros (filtrar con `?genre_id=`) |
| GET | `/api/books/{id}` | Público | Obtener un libro por ID |
| POST | `/api/books` | Admin | Crear un libro |
| PUT/PATCH | `/api/books/{id}` | Admin | Actualizar un libro (PATCH admite actualización parcial) |
| DELETE | `/api/books/{id}` | Admin | Eliminar un libro |

### Usuarios

| Método | Endpoint | Auth | Descripción |
|--------|----------|------|-------------|
| GET | `/api/users` | Admin | Listar todos los usuarios |

---

## Ejemplos de peticiones

### Registro

```json
POST /api/register
{
  "username": "johndoe",
  "email": "john@example.com",
  "password": "secret123"
}
```

### Login

```json
POST /api/login
{
  "email": "john@example.com",
  "password": "secret123"
}
```

### Crear un libro (Admin)

```json
POST /api/books
Authorization: Bearer <token>
{
  "name": "El Hobbit",
  "description": "Una novela de fantasia de J.R.R. Tolkien.",
  "image": "https://example.com/hobbit.jpg",
  "genres": [1, 3]
}
```

### Filtrar libros por género

```
GET /api/books?genre_id=2
```

---

## Modelos de datos

### User

| Campo | Tipo |
|-------|------|
| id | integer |
| username | string |
| email | string |
| role | string (user / admin) |

### Genre

| Campo | Tipo |
|-------|------|
| id | integer |
| name | string |
| description | string (nullable) |

### Book

| Campo | Tipo |
|-------|------|
| id | integer |
| name | string |
| description | string (nullable) |
| image | string (nullable) |
| genres | Genre[] (many-to-many) |

---

# Library API

A RESTful API built with Laravel and Sanctum for managing a book catalog with genre categorization, user authentication, and role-based access control.

---

## Tech Stack

- PHP / Laravel
- Laravel Sanctum (token-based authentication)
- MySQL

---

## Setup

```bash
git clone <repo-url>
cd <project-folder>
composer install
cp .env.example .env
php artisan key:generate
```

Configure your database credentials in `.env`, then run:

```bash
php artisan migrate
php artisan serve
```

---

## Authentication

This API uses Sanctum token authentication. After logging in, include the token in the `Authorization` header of every protected request:

```
Authorization: Bearer <your_token>
```

There are two roles: `user` (default) and `admin`.

---

## Endpoints

### Auth

| Method | Endpoint | Auth | Description |
|--------|----------|------|-------------|
| POST | `/api/register` | Public | Register a new user |
| POST | `/api/login` | Public | Login and receive a token |
| POST | `/api/logout` | Required | Invalidate current token |
| GET | `/api/me` | Required | Get authenticated user info |

### Genres

| Method | Endpoint | Auth | Description |
|--------|----------|------|-------------|
| GET | `/api/genres` | Public | List all genres |
| GET | `/api/genres/{id}` | Public | Get a genre by ID |
| POST | `/api/genres` | Admin | Create a genre |
| PUT/PATCH | `/api/genres/{id}` | Admin | Update a genre (PATCH supports partial update) |
| DELETE | `/api/genres/{id}` | Admin | Delete a genre |

### Books

| Method | Endpoint | Auth | Description |
|--------|----------|------|-------------|
| GET | `/api/books` | Public | List all books (filter by `?genre_id=`) |
| GET | `/api/books/{id}` | Public | Get a book by ID |
| POST | `/api/books` | Admin | Create a book |
| PUT/PATCH | `/api/books/{id}` | Admin | Update a book (PATCH supports partial update) |
| DELETE | `/api/books/{id}` | Admin | Delete a book |

### Users

| Method | Endpoint | Auth | Description |
|--------|----------|------|-------------|
| GET | `/api/users` | Admin | List all users |

---

## Request Examples

### Register

```json
POST /api/register
{
  "username": "johndoe",
  "email": "john@example.com",
  "password": "secret123"
}
```

### Login

```json
POST /api/login
{
  "email": "john@example.com",
  "password": "secret123"
}
```

### Create a Book (Admin)

```json
POST /api/books
Authorization: Bearer <token>
{
  "name": "The Hobbit",
  "description": "A fantasy novel by J.R.R. Tolkien.",
  "image": "https://example.com/hobbit.jpg",
  "genres": [1, 3]
}
```

### Filter Books by Genre

```
GET /api/books?genre_id=2
```

---

## Data Models

### User

| Field | Type |
|-------|------|
| id | integer |
| username | string |
| email | string |
| role | string (user / admin) |

### Genre

| Field | Type |
|-------|------|
| id | integer |
| name | string |
| description | string (nullable) |

### Book

| Field | Type |
|-------|------|
| id | integer |
| name | string |
| description | string (nullable) |
| image | string (nullable) |
| genres | Genre[] (many-to-many) |

---


