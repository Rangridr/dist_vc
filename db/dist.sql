DROP DATABASE IF EXISTS dist;
CREATE DATABASE dist;
use dist;

CREATE TABLE usuarios(
  id INT AUTO_INCREMENT NOT NULL COMMENT 'identificador unico del usuario',
  nom VARCHAR(50) NOT NULL COMMENT 'nombre del usuario',
  ape VARCHAR(50) NOT NULL COMMENT 'apellido del usuario',
  usu VARCHAR(20) NOT NULL COMMENT 'nombre de autenticacion del usuario',
  UNIQUE (usu) COMMENT 'identificar como valor unico',
  pass VARCHAR(36) NOT NULL COMMENT 'contraseña de autenticacion del usuario',
  lvl INT NOT NULL COMMENT 'nivel de usuario',
  mail VARCHAR(150) NOT NULL COMMENT 'correo electronico del usuario',
  PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

INSERT INTO usuarios VALUES(null, 'Leidy', 'Carrero', 'admin', MD5('admin'), 1, 'leidy@dist.com');
INSERT INTO usuarios VALUES(null, 'Leidy', 'Carrero', 'admin2', MD5('admin2'), 2, 'leidy@dist.com');

CREATE TABLE negocios(
  nom VARCHAR(80) NOT NULL COMMENT 'nombre del establecimiento',
  rif VARCHAR(45) NOT NULL  COMMENT 'RIF unico del establecimiento',
  UNIQUE(rif),
  dire VARCHAR(100) NOT NULL COMMENT 'direccion del negocio',
  PRIMARY KEY (rif)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

CREATE TABLE productos(
  id INT AUTO_INCREMENT NOT NULL COMMENT 'numero identificador unico del producto',
  nom VARCHAR(100) NOT NULL COMMENT 'nombre del producto',
  cant INT NOT NULL COMMENT 'cantidad en inventario del producto',
  precio FLOAT NOT NULL COMMENT 'precio del producto',
  fecha DATE NOT NULL COMMENT 'dia en que se registro el producto',
  PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

CREATE TABLE ventas (
  id INT AUTO_INCREMENT NOT NULL COMMENT 'identificador',
  id_prod INT NOT NULL COMMENT 'identificador del producto vendido',
  cant INT NOT NULL COMMENT 'cantidad vendida',
  valor FLOAT NOT NULL COMMENT 'precio del producto',
  t_pago VARCHAR(25) NOT NULL COMMENT 'tipo de pago realizado agregar +iva ',
  c_pago FLOAT NOT NULL COMMENT 'cantidad total del pago',
  cliente VARCHAR(45) NOT NULL COMMENT 'cliente o negocio que realiza la compra',
  fecha DATE NOT NULL COMMENT 'dia en que se realizo la venta',
  FOREIGN KEY (id_prod) REFERENCES productos (id) ON UPDATE CASCADE ON DELETE NO ACTION,
  FOREIGN KEY (cliente) REFERENCES negocios (rif) ON UPDATE CASCADE ON DELETE NO ACTION,
  PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

