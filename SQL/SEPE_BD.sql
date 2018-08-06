create database sepe;
use sepe;

create table usuario( 
	id int auto_increment not null,
	nome varchar(200) not null,
	username varchar(200) not null,
	email varchar(200) not null,
	cpf varchar(15) not null, 
	password varchar(200) not null,
	role int not null, 
	endereco text not null,
	instituicao text not null,
	primary key(id)
);
create table noticia (
	id int auto_increment not null,
	titulo text not null,
	corpo text not null,
	data_noticia text not null,
	autor text not null,
	primary key(id)
);
create table site (
	id int auto_increment not null,
	titulo text not null,
	imagem text not null,
	descricao text not null,
	
	primary key(id)
);
create table evento(
	id int auto_increment not null,
	local_evento text not null,
	descricao text not null,
	data_fim text not null,
	data_inicio text not null,
	primary key(id)
);
create table acontecimento(
	id int auto_increment not null,
	id_usuario int not null, 
	id_evento int not null,
	descricao text not null,
	tipo text not null,
	ministrante text not null, 
	local_acontecimento text not null,
	data_inicio text not null, 
	data_fim text not null,
	status text not null,
	area_conhecimento text not null,
	qtd int ,
	primary key(id),
	foreign key(id_usuario) references usuario(id), 
	foreign key(id_evento) references evento(id)
);



create table inscricao_evento( 
	id int auto_increment not null,
	id_evento int not null,
	id_participante int not null,
	status text not null,
	primary key(id),
	foreign key(id_evento) references evento(id),
	foreign key(id_participante) references usuario(id)
);

create table inscricao_acontecimento( 
	id int auto_increment not null,
	id_acontecimento int not null,
	id_participante int not null,
	status text not null,
	primary key(id),
	foreign key(id_acontecimento) references acontecimento(id),
	foreign key(id_participante) references usuario(id)
);


create table frequencia_acontecimento(
	id int auto_increment not null,
	id_acontecimento int not null,
	id_participante int not null,
	status text not null,
	primary key(id),
	foreign key(id_acontecimento) references acontecimento(id),
	foreign key(id_participante)  references usuario(id)

);
create table artigo(
	id int auto_increment not null,
	id_evento int not null,
	id_participante int not null,
	resumo text not null,
	data_apresentacao text,
	horario_apresentacao text,
	caminho text,
	documento_digital text,
	area_conhecimento text not null,
	nota double,
	status text,
	observacao_avaliacao text,
	avaliador int not null,
	primary key(id),
	foreign key(id_participante) references usuario(id),
	foreign key(id_evento) references evento(id),
	foreign key (avaliador) references usuario(id)
);
create table propostas(
	id int auto_increment not null,
	id_participante int not null,
	status text,
	descricao text not null,
	area_conhecimento text not null,
	tipo text not null,
	primary key(id),
	foreign key(id_participante) references usuario(id)
);

create table logsistema(
	id int auto_increment not null,
	id_usuario int not null,
	acao text,
	data_acao datetime, 
	primary key(id)
);
