create table _user (
    _id integer primary key autoincrement not null,
    _uuid varchar(255) not null,
    _username varchar(255) not null,
    _password varchar(255) not null,
    _email varchar(255),
    _createDate datetime not null default current_timestamp,
    _updateDate datetime,
    _deleteDate datetime
);
--[SEP]--
create unique index ux_user_uuid
on _user (_uuid);
--[SEP]--
create unique index ux_user_username
on _user (_username);
--[SEP]--
create unique index ux_user_email
on _user (_email);
--[SEP]--
create trigger tg_update_user
after update on _user for each row
begin
    update _user set _updateDate = current_timestamp
    where _uuid = old._uuid;
end;
