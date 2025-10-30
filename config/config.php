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
('Ghesya Rhegyta', 'ghesyarhegyta@mail.com', '089637355972', 'Presiden'),
('Gadis Wulandari', 'naagadis@mail.com', '085822161864', 'Baddie imut'),
('Kim Jennie', 'jennie@mail.com', '089512345678', 'Kontak bisnis'),
('Meong', 'meong@mail.com', '082112345678', 'Customer loyal'),
('Brigita Natania', 'brigita@mail.com', '085245567254', 'Rekan proyek');

USE crudsederhana;
SELECT * FROM contacts;

