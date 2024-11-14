<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Travel API

A Dockerized Laravel RESTful API for managing a travel agency’s tours and travels, allowing admins to create resources, editors to update travel details, and public users to view and filter available tours.

## Postman Documentation [here](https://documenter.getpostman.com/view/38857071/2sAY55ZxVV) 
## Database Schema
![drawSQL-image-export-2024-11-14](https://github.com/user-attachments/assets/33a13d2e-e847-4719-b717-fb98d5b337a8)

## Features

- **Admin Endpoints**:
  - Create new users with `admin` or `editor` roles (via artisan command).
  - Create travels and tours.
  
- **Editor Endpoints**:
  - Update travel details.
  
- **Public Endpoints**:
  - View paginated lists of travels.
  - Filter and sort tours by travel slug, price range, and date range.

## Tech Stack

- **Authentication**: Laravel Sanctum
- **Database**: MySQL with UUIDs as primary keys
- **Testing**: PHP Unit Testing
- **Command Line Tool**: Artisan command for user creation
- **Containerization**: Docker for deployment
<p align="center"><a href="https://www.docker.com" target="_blank"><img src="https://github.com/user-attachments/assets/b6fcf59c-9532-477b-a030-8e54d939d456" width="300" alt="Docker Logo"></a></p>

## Setup Instructions

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/mohamedmagdy841/travel-api.git
   cd travel-api
   ```

2. **Environment Configuration**:
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Set up your MySQL database credentials in the `.env` file.

3. **Docker Setup**:
   - Build and run the Docker containers:
     ```bash
     docker-compose up -d
     ```
   - This will set up containers for the application, MySQL, and any other required services.

4. **Run Migrations**:
   ```bash
   docker-compose exec app php artisan migrate
   ```

5. **Generate Application Key**:
   ```bash
   docker-compose exec app php artisan key:generate
   ```

6. **Access the Application**:
   - The application should now be accessible at `http://localhost:8000` (or the port specified in your Docker setup).

## Authentication

The API uses **Laravel Sanctum** for authentication. Admin and editor roles are assigned for access control.

## Usage

- **Create Users**: Run the following artisan command to create a new user:
  ```bash
  docker-compose exec app php artisan user:create {email} {password} --role=admin|editor
  ```

- **Endpoints**:
  - **Admin**:
    - `/api/admin/travels` - Create new travels
    - `/api/admin/tours` - Create new tours
  - **Editor**:
    - `/api/editor/travels/{id}` - Update existing travel
  - **Public**:
    - `/api/travels` - View all public travels (paginated)
    - `/api/tours/{travel_slug}` - View and filter tours by travel slug

## Testing

To run tests, use:
```bash
docker-compose exec app php artisan test
```
