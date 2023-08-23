create database Usuarios;
use Usuarios;


CREATE TABLE Salas (
 id INT AUTO_INCREMENT PRIMARY KEY,
  num_chave VARCHAR(5) ,
  nome_chave VARCHAR(40) NOT NULL,
  descricao_chave VARCHAR(50) NOT NULL,
  situacao VARCHAR (12) DEFAULT 'Disponível',
  bloco VARCHAR (7) DEFAULT 'Bloco A'
);


CREATE TABLE Sevidores (
  matricula VARCHAR(7) PRIMARY KEY,
  nome_prof VARCHAR(50) NOT NULL,
  tipo_acesso VARCHAR(10) DEFAULT 'Professor'
);





CREATE TABLE Disciplinas (
  cod_dici VARCHAR(15) PRIMARY KEY,
  nome_dici VARCHAR(255) NOT NULL,
  ano_dici VARCHAR(5) NOT NULL
);



CREATE TABLE Turmas (
  cod_tma VARCHAR(50) PRIMARY KEY,
  nome_tma VARCHAR(10),
  ano_tma VARCHAR(10) NOT NULL,
  curso VARCHAR(255) NOT NULL
);

CREATE TABLE ResevaSala (
  num_reserva INT AUTO_INCREMENT PRIMARY KEY,
  prof VARCHAR(7) NOT NULL,
  sala INT NOT NULL,
  turma VARCHAR(20) NOT NULL,
  diciplina VARCHAR(15) NOT NULL,
  DataDaReseva DATE NOT NULL,
 Datafim DATE NOT NULL,
 Horario1 VARCHAR (14) DEFAULT '07:00 - 07:45',
 Horario2 VARCHAR (14) DEFAULT ' 07:45 - 08:30',
 Horario3 VARCHAR (14) DEFAULT '08:50 - 09:35',
 Horario4 VARCHAR (14) DEFAULT '09:35 - 10:20',
 Horario5 VARCHAR (14) DEFAULT '10:30 - 11:15',
 Horario6 VARCHAR (14) DEFAULT '11:15 - 12:00',
 Horario7 VARCHAR (14) DEFAULT '13:00 - 13:45',
Horario8 VARCHAR (14) DEFAULT ' 13:45 - 14:30',
Horario9 VARCHAR (14) DEFAULT '14:50 - 15:35',
Horario10 VARCHAR (14) DEFAULT '15:35 - 16:20',
Horario11 VARCHAR (17) DEFAULT '16:30 - 17:15',
Horario12 VARCHAR (17) DEFAULT '17:15 - 18:00',
  FOREIGN KEY (prof) REFERENCES Sevidores(matricula),
  FOREIGN KEY (sala) REFERENCES Salas(id),
  FOREIGN KEY (turma) REFERENCES Turmas(cod_tma),
  FOREIGN KEY (diciplina) REFERENCES Disciplinas(cod_dici)
);

G