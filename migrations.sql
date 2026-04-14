-- -------------------------------------------------------------
-- TablePlus 6.8.6(662)
--
-- https://tableplus.com/
--
-- Database: database.sqlite
-- Generation Time: 2026-04-14 11:54:39.0810
-- -------------------------------------------------------------


DROP TABLE IF EXISTS "migrations";
CREATE TABLE "migrations" ("id" integer primary key autoincrement not null, "migration" varchar not null, "batch" integer not null);

DROP TABLE IF EXISTS "sqlite_sequence";
CREATE TABLE sqlite_sequence(name,seq);

DROP TABLE IF EXISTS "users";
CREATE TABLE "users" ("id" integer primary key autoincrement not null, "username" varchar not null, "email" varchar not null, "email_verified_at" datetime, "password" varchar not null, "remember_token" varchar, "created_at" datetime, "updated_at" datetime, "first_name" varchar, "last_name" varchar, "is_admin" tinyint(1) not null default '0', "role" integer not null default '0');

DROP TABLE IF EXISTS "password_reset_tokens";
CREATE TABLE "password_reset_tokens" ("email" varchar not null, "token" varchar not null, "created_at" datetime, primary key ("email"));

DROP TABLE IF EXISTS "sessions";
CREATE TABLE "sessions" ("id" varchar not null, "user_id" integer, "ip_address" varchar, "user_agent" text, "payload" text not null, "last_activity" integer not null, primary key ("id"));

DROP TABLE IF EXISTS "cache";
CREATE TABLE "cache" ("key" varchar not null, "value" text not null, "expiration" integer not null, primary key ("key"));

DROP TABLE IF EXISTS "cache_locks";
CREATE TABLE "cache_locks" ("key" varchar not null, "owner" varchar not null, "expiration" integer not null, primary key ("key"));

DROP TABLE IF EXISTS "jobs";
CREATE TABLE "jobs" ("id" integer primary key autoincrement not null, "queue" varchar not null, "payload" text not null, "attempts" integer not null, "reserved_at" integer, "available_at" integer not null, "created_at" integer not null);

DROP TABLE IF EXISTS "job_batches";
CREATE TABLE "job_batches" ("id" varchar not null, "name" varchar not null, "total_jobs" integer not null, "pending_jobs" integer not null, "failed_jobs" integer not null, "failed_job_ids" text not null, "options" text, "cancelled_at" integer, "created_at" integer not null, "finished_at" integer, primary key ("id"));

DROP TABLE IF EXISTS "failed_jobs";
CREATE TABLE "failed_jobs" ("id" integer primary key autoincrement not null, "uuid" varchar not null, "connection" text not null, "queue" text not null, "payload" text not null, "exception" text not null, "failed_at" datetime not null default CURRENT_TIMESTAMP);

DROP TABLE IF EXISTS "vehicle";
CREATE TABLE "vehicle" ("id" integer primary key autoincrement not null, "user_id" integer, "brand" varchar, "model" varchar, "year" integer, "vin" varchar, "license_plate" varchar, "mileage" integer, foreign key("user_id") references "users"("id"));

DROP TABLE IF EXISTS "faults";
CREATE TABLE "faults" ("id" integer primary key autoincrement not null, "vehicle_id" integer, "description" varchar, "category" varchar, "photo" varchar, "qr_code" varchar, "estimated_time" varchar, foreign key("vehicle_id") references vehicle("id") on delete no action on update no action);

DROP TABLE IF EXISTS "appointments";
CREATE TABLE "appointments" ("id" integer primary key autoincrement not null, "user_id" integer, "vehicle_id" integer, "appointment_date" date, "status_appointments_id" integer, foreign key("user_id") references "users"("id"), foreign key("vehicle_id") references "vehicle"("id"), foreign key("status_appointments_id") references "status"("id"));

DROP TABLE IF EXISTS "status";
CREATE TABLE "status" ("id" integer primary key autoincrement not null, "status" varchar);

DROP TABLE IF EXISTS "repairs";
CREATE TABLE "repairs" ("id" integer primary key autoincrement not null, "vehicle_id" integer, "status_repairs_id" integer, "photos_comments" text, foreign key("vehicle_id") references "vehicle"("id"), foreign key("status_repairs_id") references "status"("id"));

INSERT INTO "migrations" ("id", "migration", "batch") VALUES
('1', '0001_01_01_000000_create_users_table', '1'),
('2', '0001_01_01_000001_create_cache_table', '1'),
('3', '0001_01_01_000002_create_jobs_table', '1'),
('4', '2026_02_26_072415_add_is_admin_to_users_table', '1'),
('5', '2026_03_02_075431_create_vehicle_table', '1'),
('6', '2026_03_04_103510_create_faults_table', '1'),
('7', '2026_03_04_111730_fix_photo_column_in_faults_table', '1'),
('8', '2026_03_05_085531_create_appointments_table', '1'),
('9', '2026_03_05_085738_create_status_table', '1'),
('10', '2026_03_09_092948_create_repairs_table', '1'),
('11', '2026_03_19_073540_add_role_to_users_table', '1');

INSERT INTO "sqlite_sequence" ("name", "seq") VALUES
('migrations', '11'),
('faults', '1'),
('users', '4'),
('status', '3'),
('vehicle', '1'),
('appointments', '1'),
('repairs', '1');

INSERT INTO "users" ("id", "username", "email", "email_verified_at", "password", "remember_token", "created_at", "updated_at", "first_name", "last_name", "is_admin", "role") VALUES
('1', 'User', 'user@gmail.com', '2026-03-31 08:57:58', '$2y$12$Am.VxHV9LaNPNHyiR3TqoepNlUUH0M8JCQciHSkS/RnoudTEd7XjC', 'ss0WhrwxIFYvcONVJ9J9VsFCFw932Eyhyc39HKEbJKBeVZiSn5O97DIf4V8W', '2026-03-31 08:57:59', '2026-03-31 08:57:59', 'User', 'User', '0', '0'),
('2', 'Admin', 'admin@gmail.com', '2026-03-31 08:57:59', '$2y$12$G/LcteOG9sgxeqHx50WakOQe.0llS0jJ3UEoW/pBXQsQ/taq5maPS', 'GgvQ6MZ7sECLqKR46M9RccV81di2JatJpA6kac3WDjQl6xvXUkUh7yJoBF2L', '2026-03-31 08:57:59', '2026-03-31 08:57:59', 'Admin', 'Admin', '0', '2'),
('3', 'Mechanic', 'mechanic@gmail.com', '2026-03-31 08:57:59', '$2y$12$Sg34Y5G8ABBPrkbCYlPXz.y2C3e3AnT7fJRnts773GvIwP13CPLki', 'R8JsxuuGYUUFi4C2Lfk6ZAaaG61pTa9jWSVrbyD6XVMVdeSVoP33N9YT6NoD', '2026-03-31 08:57:59', '2026-03-31 08:57:59', 'Mechanic', 'Mechanic', '0', '1');

INSERT INTO "sessions" ("id", "user_id", "ip_address", "user_agent", "payload", "last_activity") VALUES
('JOFaW2SWXHsfGNXjZYgCeGaCk9AqCBYignsMdth9', '2', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Safari/605.1.15', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRWVVQk1pbnJEdk5DWkdmT085cmVjVHdFa2p0clh6ZmlBUnloeFJNMSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', '1776061562');

INSERT INTO "vehicle" ("id", "user_id", "brand", "model", "year", "vin", "license_plate", "mileage") VALUES
('1', '1', 'Toyota', 'Corolla', '2024', NULL, 'ABC-123', '86000');

INSERT INTO "faults" ("id", "vehicle_id", "description", "category", "photo", "qr_code", "estimated_time") VALUES
('1', '1', 'Kopás', 'Karosszéria', 'uploads/faults/1774947575_audirs7.webp', 'FAULT-69CB8CF76D70B', NULL);

INSERT INTO "appointments" ("id", "user_id", "vehicle_id", "appointment_date", "status_appointments_id") VALUES
('1', '1', '1', '2026-04-27', '1');

INSERT INTO "status" ("id", "status") VALUES
('1', 'Függőben'),
('2', 'Folyamatban'),
('3', 'Kész');

INSERT INTO "repairs" ("id", "vehicle_id", "status_repairs_id", "photos_comments") VALUES
('1', '1', '2', '{"comment":"Folyamatban van.. megy a maszek"}');

