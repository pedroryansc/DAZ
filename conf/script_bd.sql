CREATE SCHEMA daz;

CREATE TABLE professor(
    idprofessor INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(45),
    sobrenome varchar(45),
    areaAtuacao varchar(45),
    formacao varchar(45),
    email varchar(45),
    senha varchar(45));