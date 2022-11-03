CREATE SCHEMA daz;

CREATE TABLE professor(
    idprofessor INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(45),
    sobrenome varchar(45),
    areaAtuacao varchar(45),
    formacao varchar(45),
    email varchar(45),
    senha varchar(45),
    fotoPerfil varchar(45));

CREATE TABLE turma(
    idturma INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(45),
    instituicao varchar(250),
    mediaGeral decimal(6,1),
    professor_idprofessor INT NOT NULL,
    FOREIGN KEY (professor_idprofessor) references professor (idprofessor));

CREATE TABLE conjuntoQuestoes(
    idconjuntoQuestoes INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(45),
    tags varchar(250),
    imagem varchar(45),
    professor_idprofessor INT NOT NULL,
    FOREIGN KEY (professor_idprofessor) references professor (idprofessor));

CREATE TABLE conjuntoQuestoes_has_turma(
    conjuntoQuestoes_idconjuntoQuestoes INT NOT NULL,
    turma_idturma INT NOT NULL,
    PRIMARY KEY (conjuntoQuestoes_idconjuntoQuestoes, turma_idturma),
    FOREIGN KEY (conjuntoQuestoes_idconjuntoQuestoes) references conjuntoQuestoes (idconjuntoQuestoes),
    FOREIGN KEY (turma_idturma) references turma (idturma));

CREATE TABLE aluno(
    idaluno INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(45),
    sobrenome varchar(45),
    genero varchar(45),
    etapa varchar(45),
    numQuestResp INT,
    numAcertos INT,
    media decimal(6,1),
    ultimaQuestao INT,
    fotoPerfil varchar(45),
    professor_idprofessor INT NOT NULL,
    turma_idturma INT NOT NULL,
    FOREIGN KEY (professor_idprofessor) references professor (idprofessor),
    FOREIGN KEY (turma_idturma) references turma (idturma));

CREATE TABLE questao(
    idquestao INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    titulo varchar(45),
    tipo INT,
    enunciado varchar(250),
    maximoCaracteres INT,
    midia varchar(45),
    tags varchar(250),
    professor_idprofessor INT NOT NULL,
    conjuntoQuestoes_idconjuntoQuestoes INT NOT NULL,
    FOREIGN KEY (professor_idprofessor) references professor (idprofessor),
    FOREIGN KEY (conjuntoQuestoes_idconjuntoQuestoes) references conjuntoQuestoes (idconjuntoQuestoes));

CREATE TABLE alternativas(
    alternativa1 varchar(250),
    explicacao1 varchar(250),
    alternativa2 varchar(250),
    explicacao2 varchar(250),
    alternativa3 varchar(250),
    explicacao3 varchar(250),
    alternativa4 varchar(250),
    explicacao4 varchar(250),
    alternativaCorreta INT,
    questao_idquestao INT NOT NULL,
    FOREIGN KEY(questao_idquestao) references questao (idquestao));

CREATE TABLE questao_has_aluno(
    questao_idquestao INT NOT NULL,
    aluno_idaluno INT NOT NULL,
    resposta varchar(250),
    resultado varchar(45),
    tentativas INT,
    PRIMARY KEY (questao_idquestao, aluno_idaluno),
    FOREIGN KEY (questao_idquestao) references questao (idquestao),
    FOREIGN KEY (aluno_idaluno) references aluno (idaluno));