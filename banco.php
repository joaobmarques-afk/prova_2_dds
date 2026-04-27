CREATE DATABASE tabela;

use tabela;

CREATE table joao (
ID integer auto_increment primary key,
nome varchar(255) not null,
titulo integer
);

insert into joao (nome, ID, titulo) values ("Mengao", "15111895", "100");
select * from joao
