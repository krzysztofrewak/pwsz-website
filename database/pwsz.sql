-- --------------------------------------------------------
-- Host:                         localhost
-- Wersja serwera:               5.7.19 - MySQL Community Server (GPL)
-- Serwer OS:                    Win64
-- HeidiSQL Wersja:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Zrzucanie danych dla tabeli pwsz.courses: ~2 rows (około)
DELETE FROM `courses`;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` (`id`, `index`, `name`, `field_id`, `semester_no`, `form_id`, `rules`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'PPO', 'Projektowanie i programowanie obiektowe I', 1, 3, 3, 'Zasady zaliczenia zostaną opublikowane wkrótce.', 1, '2017-10-01 15:35:46', '2017-10-01 15:44:16'),
	(2, 'PZ', 'Projekt zespołowy', 2, 7, 4, 'Zasady zaliczenia zostaną opublikowane wkrótce.', 1, '2017-10-01 15:36:24', '2017-10-01 15:44:19');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli pwsz.course_groups: ~5 rows (około)
DELETE FROM `course_groups`;
/*!40000 ALTER TABLE `course_groups` DISABLE KEYS */;
INSERT INTO `course_groups` (`id`, `name`, `semester_course_id`, `created_at`, `updated_at`) VALUES
	(1, 's2INF1(1) - pn 18:45', 1, '2017-10-01 15:40:15', '2017-10-01 15:41:15'),
	(2, 's2INF1(2) - pn 15:15', 1, '2017-10-01 15:40:54', '2017-10-01 15:40:54'),
	(3, 's2INF2(1) - pn 17:00', 1, '2017-10-01 15:41:09', '2017-10-01 15:41:09'),
	(4, 's2INF2(2) - wt/p 15:15', 1, '2017-10-01 15:41:38', '2017-10-01 15:42:09'),
	(5, 's4SSK1 - wt 17:00', 2, '2017-10-01 15:42:05', '2017-10-01 15:42:05');
/*!40000 ALTER TABLE `course_groups` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli pwsz.faqs: ~0 rows (około)
DELETE FROM `faqs`;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli pwsz.fields: ~3 rows (około)
DELETE FROM `fields`;
/*!40000 ALTER TABLE `fields` DISABLE KEYS */;
INSERT INTO `fields` (`id`, `index`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'INF', 'kierunek Informatyka', '2017-10-01 15:19:38', '2017-10-01 15:19:38'),
	(2, 'INF/SSK', 'specjalność Systemy i sieci komputerowe', '2017-10-01 15:19:38', '2017-10-01 15:19:38'),
	(3, 'INF/PAM', 'specjalność Programowanie aplikacji mobilnych i internetowych', '2017-10-01 15:19:38', '2017-10-01 15:19:38');
/*!40000 ALTER TABLE `fields` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli pwsz.files: ~1 rows (około)
DELETE FROM `files`;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` (`id`, `url`, `icon`, `topic_id`, `created_at`, `updated_at`) VALUES
	(1, 'http://pwsz.rewak.pl/api/files/ppo/lab01.pdf', 'red pdf', 1, '2017-10-01 15:43:54', '2017-10-01 15:43:54');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli pwsz.forms: ~5 rows (około)
DELETE FROM `forms`;
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` (`id`, `index`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'W', 'wykład', '2017-10-01 15:19:38', '2017-10-01 15:19:38'),
	(2, 'C', 'ćwiczenia', '2017-10-01 15:19:38', '2017-10-01 15:19:38'),
	(3, 'L', 'laboratorium', '2017-10-01 15:19:38', '2017-10-01 15:19:38'),
	(4, 'P', 'projekt', '2017-10-01 15:19:38', '2017-10-01 15:19:38'),
	(5, 'S', 'seminarium', '2017-10-01 15:19:38', '2017-10-01 15:19:38');
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli pwsz.group_students: ~0 rows (około)
DELETE FROM `group_students`;
/*!40000 ALTER TABLE `group_students` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_students` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli pwsz.migrations: ~13 rows (około)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
	(20170317103332, 'UsersTableMigration', '2017-10-01 13:19:36', '2017-10-01 13:19:36', 0),
	(20170929183245, 'FaqsTableMigration', '2017-10-01 13:19:36', '2017-10-01 13:19:37', 0),
	(20170930101147, 'NewsTableMigration', '2017-10-01 13:19:37', '2017-10-01 13:19:37', 0),
	(20170930101338, 'FieldsTableMigration', '2017-10-01 13:19:37', '2017-10-01 13:19:37', 0),
	(20170930101444, 'FormsTableMigration', '2017-10-01 13:19:37', '2017-10-01 13:19:37', 0),
	(20170930101914, 'CoursesTableMigration', '2017-10-01 13:19:37', '2017-10-01 13:19:37', 0),
	(20170930102133, 'TopicsTableMigration', '2017-10-01 13:19:37', '2017-10-01 13:19:37', 0),
	(20170930102314, 'FilesTableMigration', '2017-10-01 13:19:37', '2017-10-01 13:19:37', 0),
	(20170930102559, 'StudentsTableMigration', '2017-10-01 13:19:37', '2017-10-01 13:19:37', 0),
	(20170930102614, 'SemestersTableMigration', '2017-10-01 13:19:37', '2017-10-01 13:19:37', 0),
	(20170930102654, 'SemesterCoursesTableMigration', '2017-10-01 13:19:37', '2017-10-01 13:19:37', 0),
	(20170930102730, 'CourseGroupsTableMigration', '2017-10-01 13:19:37', '2017-10-01 13:19:37', 0),
	(20170930102801, 'GroupStudentsTableMigration', '2017-10-01 13:19:37', '2017-10-01 13:19:37', 0);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli pwsz.news: ~0 rows (około)
DELETE FROM `news`;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli pwsz.semesters: ~1 rows (około)
DELETE FROM `semesters`;
/*!40000 ALTER TABLE `semesters` DISABLE KEYS */;
INSERT INTO `semesters` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'zimowy 2017/18', '2017-10-01 15:19:38', '2017-10-01 15:19:38');
/*!40000 ALTER TABLE `semesters` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli pwsz.semester_courses: ~2 rows (około)
DELETE FROM `semester_courses`;
/*!40000 ALTER TABLE `semester_courses` DISABLE KEYS */;
INSERT INTO `semester_courses` (`id`, `semester_id`, `course_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2017-10-01 15:39:52', '2017-10-01 15:39:52'),
	(2, 1, 2, '2017-10-01 15:39:57', '2017-10-01 15:39:57');
/*!40000 ALTER TABLE `semester_courses` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli pwsz.students: ~0 rows (około)
DELETE FROM `students`;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli pwsz.topics: ~3 rows (około)
DELETE FROM `topics`;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` (`id`, `title`, `no`, `language`, `course_id`, `created_at`, `updated_at`) VALUES
	(1, 'Wprowadzenie do programowania obiektowego', '1', 'nie dotyczy', 1, '2017-10-01 15:43:02', '2017-10-01 15:45:32'),
	(2, 'Paradygmat obiektowy - modelowanie świata za pomoca obiektów', '2', 'C++', 1, '2017-10-01 15:45:30', '2017-10-01 15:45:43'),
	(3, 'Zajęcia wstępne', '1', 'nie dotyczy', 2, '2017-10-01 15:46:11', '2017-10-01 15:46:11');
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli pwsz.users: ~1 rows (około)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `email`, `password`, `created_at`, `updated_at`) VALUES
	(1, 'krewak', 'krzysztof@rewak.pl', '$2y$12$UG9kWjRoQXVRZWg2M1RLSuZEDIl7ITee1GdcRzkYbZ6hJFJvnLuX6', '2017-10-01 15:19:38', '2017-10-01 15:19:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
