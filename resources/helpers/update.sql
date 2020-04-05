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


--update 30.3.2020
alter table `maths` add `answer_alt1` varchar(255) null, add `answer_alt2` varchar(255) null, add `answer_alt3` varchar(255) null, add `answer_alt4` varchar(255) null


--update 1.4.2020
create table `tournaments` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `start_date` date not null, `start_time` varchar(10) not null, `end_time` varchar(10) not null, `level` int not null, `active` tinyint(1) not null, `category_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `tournaments` add constraint `tournaments_category_id_foreign` foreign key (`category_id`) references `categories` (`id`);

create table `tournament_plans` (`id` bigint unsigned not null auto_increment primary key, `tournament_id` bigint unsigned not null, `plan_id` bigint unsigned not null, `order` smallint default null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `tournament_plans` add constraint `tournament_plans_tournament_id_foreign` foreign key (`tournament_id`) references `tournaments` (`id`);
alter table `tournament_plans` add constraint `tournament_plans_plan_id_foreign` foreign key (`plan_id`) references `plans` (`id`);
create table `tournament_scores` (`id` bigint unsigned not null auto_increment primary key, `tournament_id` bigint unsigned not null, `user_id` bigint unsigned not null, `started` smallint not null default '0', `score` int not null default '0', `movements` int not null default '0', `game` smallint not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `tournament_scores` add constraint `tournament_scores_tournament_id_foreign` foreign key (`tournament_id`) references `tournaments` (`id`);
alter table `tournament_scores` add constraint `tournament_scores_user_id_foreign` foreign key (`user_id`) references `users` (`id`);


--update 2.4.2020
create table `challenges` (`id` bigint unsigned not null auto_increment primary key, `from_user_id` bigint unsigned not null, `to_user_id` bigint unsigned not null, `plan_id` bigint unsigned not null, `read` tinyint(1) null default '0', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `challenges` add constraint `challenges_from_user_id_foreign` foreign key (`from_user_id`) references `users` (`id`);
alter table `challenges` add constraint `challenges_to_user_id_foreign` foreign key (`to_user_id`) references `users` (`id`);
alter table `challenges` add constraint `challenges_plan_id_foreign` foreign key (`plan_id`) references `plans` (`id`);


--update 5.4.2020
alter table `users` add `newsletter` tinyint(1) null default '0', add `message` tinyint(1) null default '0';
