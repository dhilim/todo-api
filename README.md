# Todo List API

A Laravel 12-based Todo List API that follows the structure and behavior described in [dummyjson.com/docs/todos](https://dummyjson.com/docs/todos).

## Features

- Full CRUD operations for todo items
- Each todo item is associated with a userId to reflect user context
- Basic validation rules for mandatory fields
- Standardized API responses using Laravel API Resources
- Pagination support with skip and limit parameters
- Filtering by userId

## API Endpoints

### Get All Todos
```
GET /api/todos
```

**Query Parameters:**
- `userId` (optional): Filter todos by user ID
- `limit` (optional): Number of todos to return (default: 10)
- `skip` (optional): Number of todos to skip (default: 0)

**Response:**
```json
{
  "todos": [
    {
      "id": 1,
      "todo": "Learn Laravel",
      "completed": false,
      "userId": 1
    }
  ],
  "total": 10,
  "skip": 0,
  "limit": 10
}
```

### Get Todos by User
```
GET /api/users/{userId}/todos
```

**Query Parameters:**
- `limit` (optional): Number of todos to return (default: 10)
- `skip` (optional): Number of todos to skip (default: 0)

**Response:**
```json
{
  "todos": [
    {
      "id": 1,
      "todo": "Learn Laravel",
      "completed": false,
      "userId": 1
    }
  ],
  "total": 4,
  "skip": 0,
  "limit": 10
}
```

### Get Single Todo
```
GET /api/todos/{id}
```

**Response:**
```json
{
  "id": 1,
  "todo": "Learn Laravel",
  "completed": false,
  "userId": 1
}
```

### Create Todo
```
POST /api/todos
```

**Request Body:**
```json
{
  "todo": "New todo item",
  "completed": false,
  "userId": 1
}
```

**Validation Rules:**
- `todo`: required, string, max 1000 characters
- `completed`: boolean (optional, defaults to false)
- `userId`: required, integer, min 1

### Update Todo
```
PUT /api/todos/{id}
```

**Request Body:**
```json
{
  "todo": "Updated todo item",
  "completed": true,
  "userId": 1
}
```

**Validation Rules:**
- `todo`: sometimes required, string, max 1000 characters
- `completed`: sometimes boolean
- `userId`: sometimes required, integer, min 1

### Delete Todo
```
DELETE /api/todos/{id}
```

**Response:**
```json
{
  "id": 1,
  "deleted": true
}
```

## Installation

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   ```
3. Copy `.env.example` to `.env` and configure your database
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Run migrations:
   ```bash
   php artisan migrate
   ```
6. Seed the database with sample data:
   ```bash
   php artisan db:seed
   ```
7. Start the development server:
   ```bash
   php artisan serve
   ```

## Testing the API

You can test the API using tools like Postman, curl, or any HTTP client.

## Database Structure

The `todos` table contains the following fields:
- `id`: Primary key (auto-increment)
- `todo`: Text content of the todo item
- `completed`: Boolean status (default: false)
- `userId`: Integer user ID
- `created_at`: Timestamp
- `updated_at`: Timestamp

## Notes

- Authentication is not required as this API is intended for testing purposes only
- The API follows RESTful conventions
- All responses are in JSON format
- Error responses include appropriate HTTP status codes and validation messages
