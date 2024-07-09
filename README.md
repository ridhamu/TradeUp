# TradeUp API

## Introduction
This is the API documentation for the TradeUp platform. The API allows users to register, create and manage products, comments, and bookmarks. The API uses Laravel and Laravel Sanctum for authentication.

## Requirements
- PHP 8.x
- Laravel 8.x
- Composer
- PostgreSQL 16.3

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/ridhamu/TradeUp.git
   ```

2. Navigate to the project directory:
   ```bash
   cd tradeup
   ```

3. Install dependencies:
   ```bash
   composer install
   ```

4. Copy the example environment file and update the environment variables:
   ```bash
   cp .env.example .env
   ```
   Update the `.env` file with your database credentials and other necessary settings.

5. Generate an application key:
   ```bash
   php artisan key:generate
   ```

6. Run the database migrations and seed the database:
   ```bash
   php artisan migrate --seed
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```

## API Endpoints

### Authentication
- **Register**
    - **URL**: `/api/users`
    - **Method**: POST
    - **Request Body**:
      ```json
      {
        "name": "John Doe",
        "email": "john.doe@example.com",
        "password": "yourpassword",
        "contact": "08123456789"
      }
      ```
    - **Response**:
      ```json
      {
        "data": {
          "id": 1,
          "email": "john.doe@example.com",
          "name": "John Doe"
        }
      }
      ```

- **Login**
    - **URL**: `/api/login`
    - **Method**: POST
    - **Request Body**:
      ```json
      {
        "email": "john.doe@example.com",
        "password": "yourpassword"
      }
      ```
    - **Response**:
      ```json
      {
        "token": "your_access_token"
      }
      ```

### Products
- **List Products**
    - **URL**: `/api/products`
    - **Method**: GET
    - **Response**:
      ```json
      {
        "data": [
          {
            "id": 1,
            "name": "Product 1",
            "description": "Description of product 1",
            "price": 100,
            "category": "Category 1",
            "image_url": "http://example.com/image1.jpg"
          },
          ...
        ]
      }
      ```

- **Get Product By ID**
    - **URL**: `/api/products/{id}`
    - **Method**: GET
    - **Response**:
      ```json
      {
        "data": {
          "id": 1,
          "name": "Product 1",
          "description": "Description of product 1",
          "price": 100,
          "category": "Category 1",
          "image_url": "http://example.com/image1.jpg"
        }
      }
      ```

- **Create Product**
    - **URL**: `/api/products`
    - **Method**: POST
    - **Request Body**:
      ```json
      {
        "name": "Product 1",
        "description": "Description of product 1",
        "price": 100,
        "category": "Category 1",
        "image_url": "http://example.com/image1.jpg"
      }
      ```
    - **Response**:
      ```json
      {
        "data": {
          "id": 1,
          "name": "Product 1",
          "description": "Description of product 1",
          "price": 100,
          "category": "Category 1",
          "image_url": "http://example.com/image1.jpg"
        }
      }
      ```

- **Update Product**
    - **URL**: `/api/products/{id}`
    - **Method**: PUT
    - **Request Body**:
      ```json
      {
        "name": "Updated Product",
        "description": "Updated description",
        "price": 150,
        "category": "Updated Category",
        "image_url": "http://example.com/updated_image.jpg"
      }
      ```
    - **Response**:
      ```json
      {
        "data": {
          "id": 1,
          "name": "Updated Product",
          "description": "Updated description",
          "price": 150,
          "category": "Updated Category",
          "image_url": "http://example.com/updated_image.jpg"
        }
      }
      ```

- **Delete Product**
    - **URL**: `/api/products/{id}`
    - **Method**: DELETE
    - **Response**:
      ```json
      {
        "data": true,
        "message": "Product deleted successfully"
      }
      ```

### Comments
- **Create Comment**
    - **URL**: `/api/products/{productID}/comments`
    - **Method**: POST
    - **Request Body**:
      ```json
      {
        "text": "This is a comment."
      }
      ```
    - **Response**:
      ```json
      {
        "data": {
          "id": 1,
          "user_id": 1,
          "product_id": 1,
          "text": "This is a comment.",
          "created_at": "2024-07-08T06:41:57.000000Z",
          "updated_at": "2024-07-08T06:41:57.000000Z"
        }
      }
      ```

- **List Comments**
    - **URL**: `/api/products/{productID}/comments`
    - **Method**: GET
    - **Response**:
      ```json
      {
        "data": [
          {
            "id": 1,
            "user_id": 1,
            "product_id": 1,
            "text": "This is a comment.",
            "created_at": "2024-07-08T06:41:57.000000Z",
            "updated_at": "2024-07-08T06:41:57.000000Z"
          },
          ...
        ]
      }
      ```

### Bookmarks
- **Create Bookmark**
    - **URL**: `/api/products/{id}/bookmarks`
    - **Method**: POST
    - **Response**:
      ```json
      {
        "data": {
          "id": 1,
          "user_id": 1,
          "product_id": 1,
          "created_at": "2024-07-08T06:41:57.000000Z",
          "updated_at": "2024-07-08T06:41:57.000000Z"
        }
      }
      ```

- **List Bookmarks**
    - **URL**: `/api/users/current/bookmarks`
    - **Method**: GET
    - **Response**:
      ```json
      {
        "data": [
          {
            "id": 1,
            "user_id": 1,
            "product_id": 1,
            "created_at": "2024-07-08T06:41:57.000000Z",
            "updated_at": "2024-07-08T06:41:57.000000Z"
          },
          ...
        ]
      }
      ```

- **Delete Bookmark**
    - **URL**: `/api/users/current/bookmarks/{bookmarkID}`
    - **Method**: DELETE
    - **Response**:
      ```json
      {
        "data": true,
        "message": "Bookmark deleted successfully"
      }
      ```

### Search
- **Search Products**
    - **URL**: `/api/products/search`
    - **Method**: GET
    - **Query Parameters**:
        - `name` (optional)
        - `category` (optional)
    - **Response**:
      ```json
      {
        "data": [
          {
            "id": 1,
            "name": "Product 1",
            "description": "Description of product 1",
            "price": 100,
            "category": "Category 1",
            "image_url": "http://example.com/image1.jpg"
          },
          ...
        ]
      }
      ```

## Testing
To test the API, you can use tools like [Postman](https://www.postman.com/) or [cURL](https://curl.se/).

### Example cURL commands:

- **Register a new user**:
  ```bash
  curl -X POST http://localhost:8000/api/users -H "Content-Type: application/json" -d '{"name":"John Doe","email":"john.doe@example.com","password":"yourpassword","contact":"08123456789"}'
  ```

- **Login**:
  ```bash
  curl -X POST http://localhost:8000/api/login -H "Content-Type: application/json" -d '{"email":"john.doe@example.com","password":"yourpassword"}'
  ```

- **List products**:
  ```bash
  curl -X GET http://localhost:8000/api/products
  ```

- **Create a product**:
  ```bash


curl -X POST http://localhost:8000/api/products -H "Content-Type: application/json" -H "Authorization: Bearer your_access_token" -d '{"name":"Product 1","description":"Description of product 1","price":100,"category":"Category 1","image_url":"http://example.com/image1.jpg"}'
  ```

- **Create a comment**:
  ```bash
  curl -X POST http://localhost:8000/api/products/1/comments -H "Content-Type: application/json" -H "Authorization: Bearer your_access_token" -d '{"text":"This is a comment."}'
  ```

- **Create a bookmark**:
  ```bash
  curl -X POST http://localhost:8000/api/products/1/bookmarks -H "Content-Type: application/json" -H "Authorization: Bearer your_access_token"
  ```

- **List bookmarks**:
  ```bash
  curl -X GET http://localhost:8000/api/users/current/bookmarks -H "Authorization: Bearer your_access_token"
  ```

- **Delete a bookmark**:
  ```bash
  curl -X DELETE http://localhost:8000/api/users/current/bookmarks/1 -H "Authorization: Bearer your_access_token"
  ```

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
```

Feel free to adjust the URLs, endpoints, and examples to match your actual project setup. This `README.md` should provide a comprehensive guide for anyone looking to understand and test your API.
