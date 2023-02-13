CREATE TABLE city (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    city_name varchar(100) NOT NULL
);

CREATE TABLE user (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name  VARCHAR(100) NOT NULL,
    patronymic VARCHAR(100) DEFAULT NULL,
    birth_date VARCHAR(100) DEFAULT NULL, -- @TODO SqlLite не поддерживает тип DATE
    city_id    INTEGER NOT NULL,
    CONSTRAINT user_city_fk FOREIGN KEY (city_id) REFERENCES city (id)
);

CREATE TABLE department (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    department_name varchar(100) NOT NULL
);

CREATE TABLE department_user (
    department_id varchar(100) NOT NULL,
    user_id varchar(100) NOT NULL,
    PRIMARY KEY (department_id, user_id),
    FOREIGN KEY(department_id) REFERENCES department (id),
    FOREIGN KEY(user_id) REFERENCES user (id)
);

INSERT INTO user (first_name, last_name, patronymic, birth_date, city_id) VALUES ('Иванов', 'Иван', 'Иванович', '1990-01-01', 1);
INSERT INTO user (first_name, last_name, birth_date, city_id)             VALUES ('Сидоров', 'Сидор', '1991-01-01', 1);
INSERT INTO user (first_name, last_name, patronymic, birth_date, city_id) VALUES ('Петров', 'Петр', 'Иванович1', '1992-01-01', 1);
INSERT INTO user (first_name, last_name, patronymic, birth_date, city_id) VALUES ('Дмитриев', 'Дмитрий', 'Дмитриевич', '1993-01-01', 2);
INSERT INTO user (first_name, last_name, birth_date, city_id)             VALUES ('Андреев', 'Андрей', '1994-01-01', 2);
INSERT INTO user (first_name, last_name, patronymic, birth_date, city_id) VALUES ('Алексеев', 'Алексей', 'Алексеевич', '1995-01-01', 1);

INSERT INTO city (city_name) VALUES ('Москва');
INSERT INTO city (city_name) VALUES ('Екатеринбург');
INSERT INTO city (city_name) VALUES ('Клин');

INSERT INTO department (department_name) VALUES ('Разработка');
INSERT INTO department (department_name) VALUES ('Бухгалтерия');
INSERT INTO department (department_name) VALUES ('Тестирование');

INSERT INTO department_user (department_id, user_id) VALUES (1, 1);
INSERT INTO department_user (department_id, user_id) VALUES (2, 1);
INSERT INTO department_user (department_id, user_id) VALUES (3, 2);
INSERT INTO department_user (department_id, user_id) VALUES (4, 3);