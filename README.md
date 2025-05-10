# Event Booking Application

A Laravel-based RESTful API for managing events, attendees, and bookings.

## 🚀 Features

- Event creation and management
- Attendee registration
- Booking system
- RESTful API architecture

## 📁 Postman Collection

You can find the Postman collection for testing the API in the [`Postman_Collection`](./Postman_Collection) folder.

To import it into Postman:

1. Open Postman.
2. Click **Import**.
3. Select the `.json` file from the `Postman_Collection` directory.

## 🛠️ Installation

Follow these steps to set up the project locally:

```bash
# Clone the repository
git clone https://github.com/ravneetrahi/event_booking.git

# Navigate into the project directory
cd event_booking

# Install PHP dependencies
composer install

# Copy the environment configuration
cp .env.example .env

# Generate the application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Start the development server
php artisan serve



