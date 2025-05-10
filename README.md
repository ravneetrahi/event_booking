# Event Booking API

## Setup

```bash
git clone https://github.com/ravneetrahi/event_booking.git
cd event_booking
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
