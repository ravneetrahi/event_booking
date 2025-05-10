# Event Booking Application

A Laravel-based RESTful API for managing events, attendees, and bookings.

## 🏗️ Architecture Overview

### Conceptual Breakdown

#### 1. **Frontend (e.g., Web or Mobile Application)**
   - Makes HTTP requests to the API for interacting with the backend.

#### 2. **API Layer (Controllers)**
   - **BookingController**: Handles booking requests like creating a booking, retrieving bookings for events or attendees, and deleting bookings.
   - **Validation**: Ensures the data sent by the client is correct (e.g., checks if the event is full or if the attendee has already booked the event).

#### 3. **Application Layer (Models and Business Logic)**
   - **Event Model**: Represents events and handles the relationship to bookings (capacity, event details).
   - **Attendee Model**: Represents attendees and manages their bookings.
   - **Booking Model**: Represents the booking relationship between an attendee and an event. It ensures that a booking isn’t created if it violates business rules (e.g., if the attendee is already booked or if the event is at capacity).

#### 4. **Database Layer (Database Tables)**
   - **events**: Contains data related to the event (name, description, start time, end time, capacity).
   - **attendees**: Contains data related to the attendee (name, email, etc.).
   - **bookings**: Stores the booking relationship between attendees and events (event_id, attendee_id).

### Architecture Diagram

```plaintext
   +-----------------------+           +------------------------+
   |                       |           |                        |
   |    Frontend (Client)  +---------->+    API Layer (Laravel) |
   |                       |           |                        |
   +-----------------------+           +------------------------+
                                                |
                                                |
                                                v
                            +-----------------------------------+
                            |                                   |
                            |     BookingController (API)       |
                            |                                   |
                            +-----------------------------------+
                                                |
                                                v
                +-----------------------+    +--------------------+
                |                       |    |                    |
                |   Event Model (Eloquent) +--->+ Event Database    |
                |                       |    | (events table)     |
                +-----------------------+    +--------------------+
                          |
                          v
               +---------------------+         +-----------------------+
               |                     |         |                       |
               |  Attendee Model     +-------->+ Attendee Database     |
               |  (Eloquent)         |         | (attendees table)     |
               +---------------------+         +-----------------------+
                          |
                          v
               +---------------------+
               |                     |
               |   Booking Model     |
               |   (Eloquent)        |
               +---------------------+
                          |
                          v
               +---------------------+
               |                     |
               |   Bookings Database |
               |   (bookings table)  |
               +---------------------+


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





