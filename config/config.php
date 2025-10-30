create database crudsederhana;
use crudsederhana;

create table if not exists contacts (
  id int unsigned auto_increment primary key,
  name varchar(150) not null,
  email varchar(200) not null,
  phone varchar(40) default null,
  notes text default null,
  created_at timestamp default current_timestamp,
  updated_at timestamp null default null
) engine=InnoDB default charset=utf8mb4;

INSERT INTO contacts (name, email, phone, notes)
VALUES
('Ghesya Rhegyta', 'ghesya@mail.com', '081234567890', 'Teman kampus'),
('Gadis Wulandari', 'naagadis@mail.com', '085822161864', 'Baddie imut'),
('Rafi Ahmad', 'rafi@mail.com', '089512345678', 'Kontak bisnis'),
('Siti Nurhaliza', 'siti@mail.com', '082112345678', 'Customer loyal'),
('Bayu Saputra', 'bayu@mail.com', '081355555555', 'Rekan proyek');

USE crudsederhana;
SELECT * FROM contacts;

