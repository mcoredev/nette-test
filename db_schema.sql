create table projects
(
    id          int auto_increment
        primary key,
    name        varchar(255)                          not null,
    description text                                  null,
    created_at  timestamp default current_timestamp() not null,
    updated_at  timestamp default current_timestamp() not null
);

create table tasks
(
    id          int auto_increment
        primary key,
    project_id  int                                   not null,
    name        varchar(255)                          not null,
    description text                                  null,
    status      varchar(50)                           null,
    created_at  timestamp default current_timestamp() not null,
    updated_at  timestamp default current_timestamp() not null,
    constraint tasks_ibfk_1
        foreign key (project_id) references projects (id)
            on delete cascade
);


create table users
(
    id         int auto_increment
        primary key,
    email      varchar(100)                          not null,
    first_name varchar(255)                          not null,
    last_name  varchar(255)                          not null,
    password   varchar(255)                          not null,
    last_login timestamp default current_timestamp() not null,
    created_at timestamp default current_timestamp() not null,
    role       varchar(255)                          null
);

