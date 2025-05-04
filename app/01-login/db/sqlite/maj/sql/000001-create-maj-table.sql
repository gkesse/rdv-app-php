create table _maj (
    _id integer primary key autoincrement not null,
    _code varchar(255) not null,
    _script varchar(255) not null,
    _createDate datetime not null default current_timestamp
);
--[SEP]--
create unique index ux_maj_code
on _maj (_code);
