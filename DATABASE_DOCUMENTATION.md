# Database Dokumentasiyası

## Cədvəllər

### users
- id (UUID, PK)
- name (VARCHAR)
- email (VARCHAR, UNIQUE)
- password_hash (VARCHAR)
- role (ENUM: SUPER_ADMIN, ADMIN, MENEGER, SATIS_EMKDAS)
- company_id (UUID, FK → companies.id, SET NULL)
- created_at, updated_at (TIMESTAMP)

### companies
- id (UUID, PK)
- company_name (VARCHAR)
- logo, phone, email, address, description (VARCHAR/TEXT, nullable)
- status (ENUM: ACTIVE, INACTIVE)
- created_at, updated_at (TIMESTAMP)

### clients
- id (UUID, PK)
- company_id (UUID, FK → companies.id, CASCADE)
- client_name (VARCHAR)
- client_company_name, phone, whatsapp, email, address, industry (VARCHAR, nullable)
- notes (TEXT, nullable)
- created_at, updated_at, deleted_at (TIMESTAMP)

### services
- id (UUID, PK)
- company_id (UUID, FK → companies.id, CASCADE)
- name (VARCHAR)
- description (TEXT, nullable)
- price (DOUBLE)
- created_at, updated_at (TIMESTAMP)

### leads
- id (UUID, PK)
- company_id (UUID, FK → companies.id, CASCADE)
- client_id (UUID, FK → clients.id, CASCADE)
- source (VARCHAR)
- status (ENUM: 7 lead statusu)
- service_id (UUID, FK → services.id, SET NULL)
- budget (DOUBLE, nullable)
- assigned_user (UUID, FK → users.id, SET NULL)
- created_at, updated_at (TIMESTAMP)

### deals
- id (UUID, PK)
- client_id (UUID, FK → clients.id, CASCADE)
- service_id (UUID, FK → services.id, SET NULL)
- amount (DOUBLE)
- status (ENUM: ACIQ, QAZANILDI, ITIRILDI)
- close_date (TIMESTAMP, nullable)
- created_at, updated_at (TIMESTAMP)

### payments
- id (UUID, PK)
- client_id (UUID, FK → clients.id, CASCADE)
- amount (DOUBLE)
- status (ENUM: ODENILDI, GOZLEMEDE, ODENILMEMIS)
- payment_date (TIMESTAMP, nullable)
- created_at, updated_at (TIMESTAMP)

### follow_ups
- id (UUID, PK)
- client_id (UUID, FK → clients.id, CASCADE)
- user_id (UUID, FK → users.id, SET NULL)
- title (VARCHAR)
- reminder_date (TIMESTAMP)
- status (ENUM: GOZLEYEN, TAMAMLANMIS, KECMIS)
- created_at, updated_at (TIMESTAMP)

### activities
- id (UUID, PK)
- client_id (UUID, FK → clients.id, CASCADE)
- user_id (UUID, FK → users.id, CASCADE)
- type (ENUM: ZENG, WHATSAPP, GORUS, EMAIL)
- description (TEXT, nullable)
- date (TIMESTAMP)
- created_at (TIMESTAMP)

### activity_logs (audit)
- id (UUID, PK)
- user_id (UUID, FK → users.id, SET NULL)
- action, module, description (VARCHAR/TEXT)
- ip_address, user_agent (VARCHAR)
- created_at (TIMESTAMP)

## Əlaqələr
- Company → Users (1:N), Clients (1:N), Services (1:N), Leads (1:N)
- Client → Leads (1:N), Deals (1:N), Payments (1:N), FollowUps (1:N), Activities (1:N)
- Lead → Company (N:1), Client (N:1), Service (N:1), User (N:1)
- Deal → Client (N:1), Service (N:1)
- Payment → Client (N:1)
- FollowUp → Client (N:1), User (N:1)
- Activity → Client (N:1), User (N:1)
