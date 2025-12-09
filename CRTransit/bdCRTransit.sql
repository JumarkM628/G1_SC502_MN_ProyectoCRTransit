CREATE DATABASE crtransit;
USE crtransit;

CREATE TABLE alertas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ruta VARCHAR(100) NOT NULL,
    mensaje VARCHAR(255) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
SELECT * FROM alertas;

CREATE TABLE usuario(
	idUsuario INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(25) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE ruta (
	idRuta INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(25) NOT NULL,
    origen VARCHAR(25) NOT NULL,
    destino VARCHAR(25) NOT NULL,
    duracion int NOT NULL);

CREATE  TABLE historial(
	idViaje INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario int,
    idRuta int,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    duracion int,
    FOREIGN KEY (idUsuario) REFERENCES usuario (idUsuario),
    FOREIGN KEY (idRuta) REFERENCES ruta (idRuta));
    
CREATE TABLE autobuses(
	idBus INT AUTO_INCREMENT PRIMARY KEY,
    idRuta int,
    placa VARCHAR(25) NOT NULL,
    FOREIGN KEY (idRuta) REFERENCES ruta (idRuta)
    );

