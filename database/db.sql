CREATE DATABASE base;
USE base;

CREATE TABLE banco(
id              int(255) auto_increment not null,
valorInicial    float not null,
valorActual     float not null,
porcentaje      float not null,
CONSTRAINT pk_banco PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO banco VALUES(NULL,300000,300000,2.5);

CREATE TABLE estado(
id              int(255) auto_increment not null,
nombre          varchar(100) not null,
CONSTRAINT pk_estado PRIMARY KEY(id) 
)ENGINE=InnoDb;

INSERT INTO estado VALUES(null, 'Abierta');
INSERT INTO estado VALUES(null, 'Ganada');
INSERT INTO estado VALUES(null, 'Perdida');
INSERT INTO estado VALUES(null, 'Anulada');

CREATE TABLE stake(
id              int(255) auto_increment not null,
nombre          varchar(25) not null,
valor           float not null,
multiplicador   float not null,
CONSTRAINT pk_stake PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO stake VALUES(null, 'Stake 1', 5000, 1);
INSERT INTO stake VALUES(null, 'Stake 2', 10000, 2);
INSERT INTO stake VALUES(null, 'Stake 3', 15000, 3);

CREATE TABLE apuesta(
id              int(255) auto_increment not null,
descripcion     varchar(255) not null,
idEstado        int(255) not null,
idStake         int(255) not null,
cuota           float not null,
valorStake      float not null,
valorFinal      float,
fecha           date not null,
CONSTRAINT pk_apuesta PRIMARY KEY(id),
CONSTRAINT fk_apuesta_estado FOREIGN KEY(idEstado) REFERENCES estado(id),
CONSTRAINT fk_apuesta_stake FOREIGN KEY(idStake) REFERENCES stake(id)
)ENGINE=InnoDb;
