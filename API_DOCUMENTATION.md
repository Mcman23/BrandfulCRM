# API Dokumentasiyası

## Base URL
`/api`

## Authentication
JWT token via Sanctum. Header: `Authorization: Bearer {token}`

## Endpoints

### Auth
- `POST /api/auth/login` - Giriş
- `POST /api/auth/register` - Qeydiyyat
- `POST /api/auth/logout` - Çıxış (auth)
- `GET /api/auth/me` - Mövcud istifadəçi (auth)

### Companies
- `GET /api/companies` - Siyahı
- `GET /api/companies/{id}` - Detal
- `POST /api/companies` - Yarat
- `PUT /api/companies/{id}` - Yenilə
- `PATCH /api/companies/{id}/toggle-status` - Status dəyiş
- `DELETE /api/companies/{id}` - Sil

### Clients
- `GET /api/clients?company_id=&search=&industry=` - Siyahı (filter)
- `GET /api/clients/{id}` - Detal
- `POST /api/clients` - Yarat
- `PUT /api/clients/{id}` - Yenilə
- `DELETE /api/clients/{id}` - Sil

### Leads
- `GET /api/leads?company_id=&status=&assigned_user=` - Siyahı
- `GET /api/leads/{id}` - Detal
- `POST /api/leads` - Yarat
- `PUT /api/leads/{id}` - Yenilə
- `PATCH /api/leads/{id}/status` - Status dəyiş (Kanban)
- `DELETE /api/leads/{id}` - Sil

### Services
- `GET /api/services?company_id=` - Siyahı
- `GET /api/services/{id}` - Detal
- `POST /api/services` - Yarat
- `PUT /api/services/{id}` - Yenilə
- `DELETE /api/services/{id}` - Sil

### Deals
- `GET /api/deals?client_id=&status=` - Siyahı
- `GET /api/deals/stats?company_id=` - Statistika
- `GET /api/deals/{id}` - Detal
- `POST /api/deals` - Yarat
- `PUT /api/deals/{id}` - Yenilə
- `DELETE /api/deals/{id}` - Sil

### Payments
- `GET /api/payments?client_id=&status=` - Siyahı
- `GET /api/payments/stats?company_id=` - Statistika
- `GET /api/payments/{id}` - Detal
- `POST /api/payments` - Yarat
- `PUT /api/payments/{id}` - Yenilə
- `DELETE /api/payments/{id}` - Sil

### Follow-ups
- `GET /api/follow-ups?client_id=&status=&user_id=` - Siyahı
- `GET /api/follow-ups/{id}` - Detal
- `POST /api/follow-ups` - Yarat
- `PUT /api/follow-ups/{id}` - Yenilə
- `DELETE /api/follow-ups/{id}` - Sil

### Activities
- `GET /api/activities?client_id=&user_id=&type=` - Siyahı
- `GET /api/activities/{id}` - Detal
- `POST /api/activities` - Yarat
- `PUT /api/activities/{id}` - Yenilə
- `DELETE /api/activities/{id}` - Sil

### Users
- `GET /api/users` - Siyahı
- `GET /api/users/{id}` - Detal
- `POST /api/users` - Yarat
- `PUT /api/users/{id}` - Yenilə
- `DELETE /api/users/{id}` - Sil
