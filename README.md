# Something Fitness

A PHP/MySQL web app for calorie and fitness tracking with AI coaching features.

## Features

- 🍽️ **Calorie Logging** — Track daily food intake
- 🎯 **Goal Tracking** — Set and monitor fitness goals
- 📖 **Recipe Recommendations** — Get meal suggestions based on your goals
- 💬 **AI Coach Chat** — Get fitness advice via AI chatbot
- 👤 **User Authentication** — Personal accounts with secure login

## Tech Stack

- **Backend**: Procedural PHP
- **Database**: MySQL
- **Frontend**: Vanilla JS/CSS
- **AI**: OpenAI integration for chat

## Status

⚠️ **Note**: This project was built for a university course (CSE 442, UB Fall 2023).
The database server (oceanus.cse.buffalo.edu) is a university-hosted server that may no longer be accessible.
The app requires a MySQL database to function.

## Quick Start

1. Set up a MySQL database
2. Copy `.env.example` to `.env` and configure your database credentials
3. Run the PHP app with a local server (e.g., PHP's built-in server)

```bash
php -S localhost:8000
```

## Security

Database credentials are managed via environment variables. See `.env.example` for required variables.
