CREATE SCHEMA daz;

CREATE TABLE professor(
    idprofessor INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(45),
    sobrenome varchar(45),
    areaAtuacao varchar(45),
    formacao varchar(45),
    email varchar(45),
    senha varchar(45),
    fotoPerfil blob);

CREATE TABLE turma(
    idturma INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(45),
    instituicao varchar(250),
    mediaGeral decimal(6,1),
    professor_idprofessor INT
    FOREIGN KEY (professor_idprofessor) references professor (idprofessor));

CREATE TABLE conjuntoQuestoes(
    idconjuntoQuestoes INT,
    nome varchar(45),
    tags varchar(250),
    professor_idprofessor INT,
    FOREIGN KEY (professor_idprofessor) references professor (idprofessor));

CREATE TABLE conjuntoQuestoes_has_turma(
    conjuntoQuestoes_idconjuntoQuestoes INT NOT NULL,
    turma_idturma INT,
    FOREIGN KEY (conjuntoQuestoes_idconjuntoQuestoes) references conjuntoQuestoes (idconjuntoQuestoes),
    FOREIGN KEY (turma_idturma) references turma (idturma);
);

CREATE TABLE aluno(
    idaluno INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(45),
    sobrenome varchar(45),
    escolaridade varchar(45),
    numQuestResp INT,
    numAcertos INT,
    media decimal(6,1),
    professor_idprofessor INT,
    turma_idturma INT,
    FOREIGN KEY (professor_idprofessor) references professor (idprofessor),
    FOREIGN KEY (turma_idturma) references turma (idturma));

CREATE TABLE questao(
    idquestao INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    tipo varchar(45),
    enunciado varchar(250),
    midia blob,
    tags varchar(250),
    professor_idprofessor INT,
    conjuntoQuestoes_idconjuntoQuestoes INT,
    FOREIGN KEY (professor_idprofessor) references professor (idprofessor),
    FOREIGN KEY (conjuntoQuestoes_idconjuntoQuestoes) references conjuntoQuestoes (idconjuntoQuestoes));

CREATE TABLE questao_has_aluno(
    questao_idquestao INT NOT NULL,
    aluno_idaluno INT NOT NULL,
    FOREIGN KEY (questao_idquestao) references questao (idquestao),
    FOREIGN KEY (aluno_idaluno) references aluno (idaluno));