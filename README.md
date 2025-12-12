# VulnAPI-CI4 🔓

> **⚠️ WARNING: This application contains INTENTIONAL security vulnerabilities for educational purposes. DO NOT deploy to production or expose to the internet!**

A deliberately vulnerable REST API built with CodeIgniter 4, designed for learning web application security, penetration testing, and OWASP API Top 10 exploitation.

## 🎯 Purpose

VulnAPI-CI4 is a hands-on learning tool for:
- Security researchers and penetration testers
- Developers learning secure coding practices
- Students studying application security
- CTF practice and training

## 🏗️ Tech Stack

- **Framework**: CodeIgniter 4 (latest)
- **Language**: PHP 8.1+
- **Database**: MySQL 8.0
- **Authentication**: JWT (firebase/php-jwt)
- **Container**: Docker + Docker Compose
- **Web Server**: Nginx + PHP-FPM

## 🚀 Quick Start

### Prerequisites
- Docker & Docker Compose
- Git

### Installation

```bash
# Clone the repository
git clone https://github.com/izamzam2020/vulnapi-ci4.git
cd vulnapi-ci4

# Copy environment file
cp env.example .env

~ Windows 
copy env.example .env

# Start containers
docker-compose up -d --build

# Install dependencies
docker-compose exec app composer install

# Run migrations and seed database
docker-compose exec app php spark migrate
docker-compose exec app php spark db:seed VulnApiSeeder

# Verify it's running
curl http://localhost:8080
```

### Access Points
| Service | URL |
|---------|-----|
| API | http://localhost:8080 |
| phpMyAdmin | http://localhost:8081 |
| MySQL | localhost:3307 |

## 👥 Default Users

| Email | Password | Role | Organization |
|-------|----------|------|--------------|
| userA@acme.com | password123 | user | Acme Corp (ID: 1) |
| userB@techstart.com | password123 | user | TechStart Inc (ID: 2) |
| admin@acme.com | password123 | admin | Acme Corp (ID: 1) |

## 📡 API Documentation

Visit **http://localhost:8080** for the interactive API documentation with all endpoints and examples.

## 🔓 Vulnerabilities

This API contains **10 intentional vulnerabilities** based on the OWASP API Top 10. Can you find them all?

See `docs/EXPLOIT_WRITEUP.md` for detailed exploitation guides (spoilers!).

## 🔧 Useful Commands

```bash
# View logs
docker-compose logs -f app

# Access PHP container
docker-compose exec app bash

# Run migrations
docker-compose exec app php spark migrate

# Rebuild containers
docker-compose down && docker-compose up -d --build
```

## 📄 License

MIT License - Use for educational purposes only.

## ⚠️ Disclaimer

This project is for **EDUCATIONAL PURPOSES ONLY**. The vulnerabilities are intentional and designed to teach security concepts. Never deploy this to production or expose to the internet. The authors are not responsible for any misuse.

---

**Happy Hacking! 🎉**
