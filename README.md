# Startpoint — Internship Program Management Platform

A centralized platform for managing the full lifecycle of internship programs. Startpoint streamlines postings, applications, supervision, evaluations, document handling, and analytics—built for operational efficiency and accountability.

## Key Features
- Central Dashboard: Post openings, manage applications, assign supervisors, track intern progress, and archive records.
- Application Portal: Applicants browse roles, submit applications, and track status with real-time notifications.
- Evaluation Modules: Supervisors/HR shortlist, review, and decide on applicants with a full decision trail.
- Document Handling: Structured upload, review, and archiving of CVs, letters, and reports.
- Analytics & Reporting: Monitor progress, compliance, and outcomes across the internship lifecycle.

## Architecture Overview
- Web App: Admin dashboard + applicant portal
- Core Domains: Openings, Applications, Assignments, Evaluations, Documents, Reports
- Roles & Permissions: Admin, HR, Supervisor, Applicant
- Auditability: Decisions and state changes logged for accountability

## Tech Stack
- Frontend: React/Next.js + Tailwind CSS
- Backend: Node.js/Supabase/Firebase (choose one)
- Database: PostgreSQL
- Auth: JWT/Auth provider
- Storage: S3 or Supabase Storage
- CI/CD: GitHub Actions

## Getting Started
### Prerequisites
- Node.js ≥ 18
- npm or pnpm
- PostgreSQL (local or cloud)

### Installation
```bash
git clone https://github.com/Nonniegathoni/Startpoint.git
cd Startpoint
npm install
# or: pnpm install
Author: Nonnie Gathoni✍🏾
