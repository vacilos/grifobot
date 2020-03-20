-- update 14.3.2020
alter table `scores` add `movements` int not null default '1', add `total` decimal(8, 2) not null default '1'

-- update 15.3.2020
ALTER TABLE maths CHANGE question question TEXT NOT NULL COLLATE utf8mb4_unicode_ci;


alter table `maths` add `creator_user_id` bigint unsigned null default '1', add `updater_user_id` bigint unsigned null default '1';
alter table `maths` add constraint `maths_creator_user_id_foreign` foreign key (`creator_user_id`) references `users` (`id`);
alter table `maths` add constraint `maths_updater_user_id_foreign` foreign key (`updater_user_id`) references `users` (`id`);


