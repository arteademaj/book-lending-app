# PHP API with MySQL CRUD Using Stored Procedures

A RESTful PHP API built with Laravel for book landing system
---

## 🚀 Technologies Used

- **PHP 7.4.19**
- **Laravel 8.83.29**
- **MySQL 8+**
- **Docker & Docker Compose**
- **Composer**
- **Postman** (for testing API endpoints)

---

## 🛠️ Setup Instructions

### 1. Clone the Repository

```
git clone https://github.com/arteademaj/book-lending-app.git
cd book-lending-app
```

### 2. Install Dependencies

```
composer install
```

### 3. Create `.env` File

```
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your DB credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_lending_app
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Create Database

Create a database named `book_lending_app` (or the one you specified in `.env`) in MySQL:

```
CREATE DATABASE book_lending_app;
```

### 5. Run Migrations

This project uses Laravel migrations to create both the database schema. Run the following command:

```
php artisan migrate
```

This will:
- Create the `books` table
- Create the `members` table
- Create the `loan` table
---

### 6. Clear and Cache Configuration (Optional)

After updating your `.env` or configuration files, run:

```bash
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:clear
```

## 🐳 Running with Docker

### 1. Start Containers

```
docker-compose up -d --build
```

### 2. Install Dependencies inside the Container

```
docker exec -it book-lending-app
composer install
php artisan key:generate
php artisan migrate
```

### 3. Access the App

Visit: [http://localhost:8000](http://localhost:8000)

---


## 📬 API Endpoints (Example Requests)


All requests use the base URL: `http://localhost:8000/api`

### ➕ ENDPOINTS

**GET** `/api/books` 
**GET** `/api/loans` 
**POST** `/api/loans/{id}/return`

----

## 🧪 Testing the API

You can test the API using:

- [Postman](https://www.postman.com/)
- CURL
- Frontend client

Example with CURL:

```
curl -X GET http://localhost:8000/api/books
```

---

## 📝 License

This project is licensed under the MIT License.