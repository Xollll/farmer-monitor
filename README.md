# Farmer Monitoring System

The **Farmer Monitoring System** is a real-time monitoring platform designed to help farmers optimize crop health and water quality. It provides insightful visualizations, automated alerts, and robust data management to support sustainable agriculture.


## Features

- **Real-Time Monitoring**: Track water quality (pH, temperature) and soil moisture in real time.
- **Visualized Data**: Interactive charts for sensor data, including line charts for trends and doughnut/gauge charts for thresholds.
- **Mobile-Responsive Design**: Optimized for all devices.
- **Extensible**: Easily integrate additional sensors or features.

## Technology Stack

- **Backend**: Laravel 11 (PHP Framework)
- **Frontend**: CSS, Bootstrap
- **Real-Time Updates**: AJAX
- **Database**: MySQL
- **Hardware**: NodeMCU, pH sensors, soil moisture sensors

## Getting Started

### Prerequisites

- [Laragon](https://laragon.org/) (or similar local development environment)
- PHP 8.3 or higher
- Composer
- Node.js and NPM
- MySQL

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/username/farmer-monitoring-system.git
   cd farmer-monitoring-system

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Set up the .env file:
   ```bash
   cp.env.example.env
   ```
   Update the `.env` file with your database credentials.

4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Migrate the database:
   ```bash
   php artisan migrate
   ```
6. Start the development server:
   ```bash
   php artisan serve
   ```

7. Compile assets:
   ```bash
   npm run dev
   ```
   
### Notes:
- Noted that there a lot of custom css use in here.

The Farmer Monitoring System is open-source software licensed under the MIT license.

