create database mesadinha;
use mesadinha;

create table usuario(
id_usuario int auto_increment not null primary key,
nome varchar(80) not null,
endereco varchar(150) not null,
telefone char(15) not null,
email varchar(100) not null,
senha varchar(150) not null
)engine=innodb;

create table cad_categorias(
id_categorias int auto_increment not null primary key,
nome varchar(45),
usuario_id int not null,
foreign key(usuario_id) references usuario(id_usuario)
)engine=innodb;

create table cad_contas(
id_contas int auto_increment not null primary key,
nome varchar(20) not null,
tipo varchar(45) not null,
categoria_id int not null,
usuario_id int not null,
foreign key(usuario_id) references usuario(id_usuario),
foreign key(categoria_id) references cad_categorias(id_categorias)
)engine=innodb;

create table movimentacao(
id_movimentacao int auto_increment not null primary key,
valor double unsigned not null,
data_atual datetime default CURRENT_TIMESTAMP not null,
contas_id int not null,
usuario_id int not null,
foreign key(usuario_id) references usuario(id_usuario),
foreign key(contas_id) references cad_contas(id_contas)
)engine=innodb;