# News Portal - Laravolt Application

[![Quality Gate Status](https://sonar.malescast.tech/api/project_badges/measure?project=ramaID_news-portal&metric=alert_status&token=sqb_f1b347854a21db967c05011fe3702d11dcfda71a)](https://sonar.malescast.tech/dashboard?id=ramaID_news-portal)
[![Coverage](https://sonar.malescast.tech/api/project_badges/measure?project=ramaID_news-portal&metric=coverage&token=sqb_f1b347854a21db967c05011fe3702d11dcfda71a)](https://sonar.malescast.tech/dashboard?id=ramaID_news-portal)
[![Duplicated Lines (%)](https://sonar.malescast.tech/api/project_badges/measure?project=ramaID_news-portal&metric=duplicated_lines_density&token=sqb_f1b347854a21db967c05011fe3702d11dcfda71a)](https://sonar.malescast.tech/dashboard?id=ramaID_news-portal)
[![Lines of Code](https://sonar.malescast.tech/api/project_badges/measure?project=ramaID_news-portal&metric=ncloc&token=sqb_f1b347854a21db967c05011fe3702d11dcfda71a)](https://sonar.malescast.tech/dashboard?id=ramaID_news-portal)

## Server Requirements

1. PHP 8.4
1. Composer 2
1. SQLite, PostgreSQL or MariaDB

## Local Setup

1. Clone repository
1. Jalankan `composer install`
1. Salin `.env.example` ke `.env`
1. Sesuaikan konfigurasi database dan lain-lain
1. Jalankan `php artisan key:generate`
1. Jalankan `php artisan migrate:fresh --seed`
1. Jalankan `php artisan laravolt:link`
1. Jalankan `php artisan storage:link`
1. (Optional) Jalankan `php artisan vendor:publish --tag=laravolt-assets`
1. Pastikan folder-folder berikut _writeable_:
   1. bootstrap/cache
   1. storage
1. Jalankan `php artisan serve` atau `composer dev`

## Development Setup

```mermaid
flowchart TD
  USER[Users]

  subgraph cxi2
    PROXY[Nginx Proxy Manager]
    PGSQL17[PostgreSQL 17]
  end

  subgraph dev
    MINIO[Minio]
    SONARQUBE[SonarQube]
    LARAVEL[Laravel App]
    REDIS[Redis]
    MAILPIT[Mailpit]
    MAILPITA[Mailpit Admin]
  end

  PROXY -- "Reverse Proxy" --> MINIO
  PROXY -- "Reverse Proxy" --> LARAVEL
  PROXY -- "Reverse Proxy" --> SONARQUBE
  PROXY -- "Reverse Proxy" --> MAILPITA

  USER -- "Access Application" --> PROXY
  LARAVEL -- "Cache/Queue" --> REDIS
  LARAVEL -- "Object Storage" --> MINIO
  LARAVEL -- "Email Testing" --> MAILPIT

  MAILPIT -- "Admin Panel" --> MAILPITA

  %% SONARQUBE -- "DB Connection" --> PGSQL17
  %% METABASE -- "DB Connection" --> PGSQL17
  %% LARAVEL -- "DB Connection" --> PGSQL17
```
