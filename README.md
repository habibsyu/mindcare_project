# MindCare - Mental Health Platform

A comprehensive Laravel 11 mental health platform with self-assessment tools, educational content, community features, and AI-powered counseling.

## Features

- **Role-based Authentication**: Admin, Staff, and User roles with different permissions
- **Self-Assessment Tools**: PHQ-9, GAD-7, and DASS-21 psychological assessments
- **Educational Content**: Articles, videos, and interactive quizzes
- **Blog System**: SEO-optimized blog with categories and social sharing
- **Community Integration**: Discord and Telegram community links
- **AI Counseling**: Chat interface with n8n integration and staff handover
- **Admin Panel**: Comprehensive dashboard for content and user management
- **Responsive Design**: Mobile-first design with dark mode support

## Installation

Since this project runs in WebContainer (browser-based environment), traditional Laravel setup is not available. This codebase demonstrates the complete structure and implementation of a Laravel mental health platform.

For local development with full Laravel functionality:

1. Clone this repository to your local machine
2. Install PHP 8.2+ and Composer
3. Run `composer install`
4. Copy `.env.example` to `.env` and configure your database
5. Generate application key: `php artisan key:generate`
6. Run migrations: `php artisan migrate --seed`
7. Install Node dependencies: `npm install`
8. Build assets: `npm run build`
9. Start the server: `php artisan serve`

## Default Users

- **Admin**: admin@mindcare.com / password
- **Staff**: staff@mindcare.com / password
- **User**: user@mindcare.com / password

## Architecture

The platform follows Laravel MVC architecture with:

- **Models**: Eloquent models with relationships and data encryption
- **Controllers**: RESTful controllers for each feature module
- **Views**: Blade templates with responsive TailwindCSS styling
- **Services**: External API integrations (YouTube, n8n)
- **Middleware**: Role-based access control and consent checking
- **Database**: MySQL with proper foreign key relationships

## Security Features

- Encrypted sensitive data (assessment results, counseling messages)
- Role-based access control with middleware
- CSRF protection on all forms
- Input validation and sanitization
- Secure file upload handling

## API Integrations

- **YouTube API**: For educational video content
- **n8n Webhook**: For AI chatbot functionality
- **Discord/Telegram**: Community platform integration

## License

This project is open-sourced software licensed under the MIT license.