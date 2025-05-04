select 'drop table ' || name || ';' from sqlite_master
where type = 'table' and sqlite_master.name not like 'sqlite_%';
