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
