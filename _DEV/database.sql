CREATE TABLE irpg_users (
    username varchar(50),
    pass varchar(50),
    is_admin int,
    level int,
    class varchar(100),
    next_ttl int,
    nick varchar(50),
    userhost varchar(250),
    online int,
    idled int,
    x_pos int,
    y_pos int,
    alignment varchar(100),
    created datetime,
    last_login datetime,
    updated datetime
);

CREATE TABLE irpg_penalties (
    msg int,
    nickpart int,
    kick int,
    quit int,
    quest int,
    logout int,
    updated datetime
);

CREATE TABLE irpg_items (
    amulet int,
    charm int,
    helmet int,
    boots int,
    gloves int,
    ring int,
    leggings int,
    shield int,
    tunic int,
    weapon int,
    updated datetime
);

CREATE TABLE irpg_modifiers (
    note longtext,
    updated datetime
);
