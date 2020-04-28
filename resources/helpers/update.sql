-- update 14.3.2020
alter table `scores` add `movements` int not null default '1', add `total` decimal(8, 2) not null default '1'
-- DONE

-- update 15.3.2020
ALTER TABLE maths CHANGE question question TEXT NOT NULL COLLATE utf8mb4_unicode_ci;
-- DONE

-- update 20.3.2020
alter table `maths` add `creator_user_id` bigint unsigned null default '1', add `updater_user_id` bigint unsigned null default '1';
alter table `maths` add constraint `maths_creator_user_id_foreign` foreign key (`creator_user_id`) references `users` (`id`);
alter table `maths` add constraint `maths_updater_user_id_foreign` foreign key (`updater_user_id`) references `users` (`id`);
-- DONE

-- update 21.3.2020
create table `badges` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `condition` varchar(255) not null, `description` text null, `image` varchar(255) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
create table `users_badges` (`id` bigint unsigned not null auto_increment primary key, `user_id` bigint unsigned not null, `badge_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `users_badges` add constraint `users_badges_user_id_foreign` foreign key (`user_id`) references `users` (`id`);
alter table `users_badges` add constraint `users_badges_badge_id_foreign` foreign key (`badge_id`) references `badges` (`id`);


-- update 30.3.2020
alter table `maths` add `answer_alt1` varchar(255) null, add `answer_alt2` varchar(255) null, add `answer_alt3` varchar(255) null, add `answer_alt4` varchar(255) null


-- update 1.4.2020
create table `tournaments` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `start_date` date not null, `start_time` varchar(10) not null, `end_time` varchar(10) not null, `level` int not null, `active` tinyint(1) not null, `category_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `tournaments` add constraint `tournaments_category_id_foreign` foreign key (`category_id`) references `categories` (`id`);

create table `tournament_plans` (`id` bigint unsigned not null auto_increment primary key, `tournament_id` bigint unsigned not null, `plan_id` bigint unsigned not null, `order` smallint default null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `tournament_plans` add constraint `tournament_plans_tournament_id_foreign` foreign key (`tournament_id`) references `tournaments` (`id`);
alter table `tournament_plans` add constraint `tournament_plans_plan_id_foreign` foreign key (`plan_id`) references `plans` (`id`);
create table `tournament_scores` (`id` bigint unsigned not null auto_increment primary key, `tournament_id` bigint unsigned not null, `user_id` bigint unsigned not null, `started` smallint not null default '0', `score` int not null default '0', `movements` int not null default '0', `game` smallint not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `tournament_scores` add constraint `tournament_scores_tournament_id_foreign` foreign key (`tournament_id`) references `tournaments` (`id`);
alter table `tournament_scores` add constraint `tournament_scores_user_id_foreign` foreign key (`user_id`) references `users` (`id`);


-- update 2.4.2020
create table `challenges` (`id` bigint unsigned not null auto_increment primary key, `from_user_id` bigint unsigned not null, `to_user_id` bigint unsigned not null, `plan_id` bigint unsigned not null, `read` tinyint(1) null default '0', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `challenges` add constraint `challenges_from_user_id_foreign` foreign key (`from_user_id`) references `users` (`id`);
alter table `challenges` add constraint `challenges_to_user_id_foreign` foreign key (`to_user_id`) references `users` (`id`);
alter table `challenges` add constraint `challenges_plan_id_foreign` foreign key (`plan_id`) references `plans` (`id`);


-- update 5.4.2020
alter table `users` add `newsletter` tinyint(1) null default '0', add `message` tinyint(1) null default '0';

-- update 10.4.2020
create table `classrooms` (`id` bigint unsigned not null auto_increment primary key, `title` varchar(255) not null, `description` text null, `code` varchar(30) not null, `user_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `classrooms` add constraint `classrooms_user_id_foreign` foreign key (`user_id`) references `users` (`id`);
alter table `plans` add `user_id` bigint unsigned null;
alter table `plans` add constraint `plans_user_id_foreign` foreign key (`user_id`) references `users` (`id`);

-- update 20.4.2020`
alter table `maths` add `personal` tinyint(1) null default '0';

-- update 21.4.2020
create table `quizzes` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `description` text null, `size` int not null, `level` varchar(255) not null, `exercise` int not null, `code` text null, `pin` varchar(10) not null, `user_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `quizzes` add constraint `quizzes_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade;
create table `quiz_math` (`math_id` bigint unsigned not null, `quiz_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `quiz_math` add constraint `quiz_math_math_id_foreign` foreign key (`math_id`) references `maths` (`id`) on delete cascade;
alter table `quiz_math` add constraint `quiz_math_quiz_id_foreign` foreign key (`quiz_id`) references `quizzes` (`id`) on delete cascade;

create table `quiz_scores` (`id` bigint unsigned not null auto_increment primary key, `username` varchar(255) not null, `quiz_id` bigint unsigned not null, `score` int not null, `movements` int not null, `questions` int not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `quiz_scores` add constraint `quiz_scores_quiz_id_foreign` foreign key (`quiz_id`) references `quizzes` (`id`);

alter table `quizzes` add `end_date` datetime null;
alter table `quizzes` add `public` tinyint(1) not null default '0';


-- update 26.4.2020
alter table `maths` add `image_path` varchar(1024) null;
