DROP DATABASE bdcarritocompras;

--
-- Base de datos: 'bdcarritocompras'
--

CREATE DATABASE bdcarritocompras;
USE bdcarritocompras;

CREATE TABLE usuario (
  idusuario bigint(20) NOT NULL,
  usnombre varchar(50) NOT NULL,
  uspass varchar(50) NOT NULL,
  usmail varchar(50) NOT NULL,
  usdeshabilitado timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `idusuario` (`idusuario`);

ALTER TABLE `usuario`
  MODIFY `idusuario` bigint(20) NOT NULL AUTO_INCREMENT;

INSERT INTO usuario (idusuario, usnombre, uspass, usmail, usdeshabilitado) VALUES
('1', 'Perez', '81dc9bdb52d04dc20036dbd8313ed055', 'perez@gmail.com', '0000-00-00 00:00:00'),
('2', 'Gomez', '81b073de9370ea873f548e31b8adc081', 'gomez@gmail.com', '0000-00-00 00:00:00'),
('3', 'Diaz', 'def7924e3199be5e18060bb3e1d547a7', 'diaz@gmail.com', '0000-00-00 00:00:00'),
('4', 'Sanchez', '6562c5c1f33db6e05a082a88cddab5ea', 'sanchez@gmail.com', '0000-00-00 00:00:00'), 
('5', 'Admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin@mail.com', '0000-00-00 00:00:00'),
('6', 'Deposito', '81dc9bdb52d04dc20036dbd8313ed055', 'deposito@mail.com', '0000-00-00 00:00:00'),
('7', 'Cliente', '81dc9bdb52d04dc20036dbd8313ed055', 'cliente@mail.com', '0000-00-00 00:00:00'),
('8', 'Nico', '81dc9bdb52d04dc20036dbd8313ed055', 'nicolas@gmail.com', '0000-00-00 00:00:00'),
('9', 'Torres', '81dc9bdb52d04dc20036dbd8313ed055', 'torres@gmail.com', '0000-00-00 00:00:00');

CREATE TABLE rol (
  idrol bigint(20) NOT NULL,
  rodescripcion varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`),
  ADD UNIQUE KEY `idrol` (`idrol`);

ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT;

INSERT INTO rol (idrol, rodescripcion) VALUES
(1, 'Admin'),
(2, 'Deposito'),
(3, 'Cliente');

CREATE TABLE producto (
  idproducto bigint(20) NOT NULL,
  pronombre varchar(250) NOT NULL,
  prodetalle varchar(512) NOT NULL,
  procantstock int(11) NOT NULL,
  imagenproducto varchar(512)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD UNIQUE KEY `idproducto` (`idproducto`);

ALTER TABLE `producto`
  MODIFY `idproducto` bigint(20) NOT NULL AUTO_INCREMENT;

INSERT INTO producto (idproducto, pronombre, prodetalle, procantstock, imagenproducto) VALUES
(01,'Calvin Klein Euphoria Men','129.999', 20,"../assets/img/productos/img1.jpeg"),
(02,'Prada L Homme','319.999', 20,"../assets/img/productos/img2.jpeg"),
(03,'Jean Paul Gaultier Le Male','199.999', 50,"../assets/img/productos/img3.jpeg"),
(04,'Victor & Rolf Spicebomb','122.999', 50,"../assets/img/productos/img4.jpeg"),
(05,'Dior Sauvage Eau de Toilette','249.999', 10,"../assets/img/productos/img5.jpeg"),
(06,'Chanel Bleu de Chanel','103.999', 85,"../assets/img/productos/img6.jpeg"),
(07,'Creed Aventus','629.999', 130,"../assets/img/productos/img7.jpeg"),
(08,'Tom Ford Noir Extreme','229.999', 80,"../assets/img/productos/img8.jpeg"),
(09,'Giorgio Armani Acqua di Giò Profumo','219.999', 60,"../assets/img/productos/img9.jpeg"),
(10,'Yves Saint Laurent La Nuit de L Homme','789.999', 45,"../assets/img/productos/img10.jpeg"),
(11,'Paco Rabanne 1 Million','179.999', 150,"../assets/img/productos/img11.jpeg"),
(12,'Bvlgari Man in Black','487.999', 110,"../assets/img/productos/img12.jpeg"),
(13,'Givenchy Gentleman','329.999', 95,"../assets/img/productos/img13.jpeg"),
(14,'Hermès Terre d Hermès','119.999', 30,"../assets/img/productos/img14.jpeg"),
(15,'Hugo Boss Bottled','899.999', 5,"../assets/img/productos/img15.jpeg");

CREATE TABLE compraestadotipo (
  idcompraestadotipo int(11) NOT NULL,
  cetdescripcion varchar(50) NOT NULL,
  cetdetalle varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `compraestadotipo`
  ADD PRIMARY KEY (`idcompraestadotipo`);

INSERT INTO compraestadotipo (idcompraestadotipo, cetdescripcion, cetdetalle) VALUES
(1, 'iniciada', 'Compra iniciada por el cliente.'),
(2, 'aceptada', 'Aceptada por el deposito.'),
(3, 'enviada', 'Enviada por el deposito.'),
(4, 'cancelada', 'Cancelada por el cliente o deposito.');

CREATE TABLE menu (
  idmenu BIGINT(20) NOT NULL,
  menombre VARCHAR(100) NOT NULL,
  medescripcion VARCHAR(124) NOT NULL,
  idpadre BIGINT(20) DEFAULT NULL,
  medeshabilitado TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`),
  ADD UNIQUE KEY `idmenu` (`idmenu`),
  ADD KEY `fkmenu_1` (`idpadre`);

ALTER TABLE `menu`
  MODIFY `idmenu` bigint(20) NOT NULL;

ALTER TABLE `menu`
  ADD CONSTRAINT `fkmenu_1` FOREIGN KEY (`idpadre`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE;

INSERT INTO menu (idmenu, menombre, medescripcion, idpadre, medeshabilitado) VALUES

(0, 'Invisible', '../Nada/', NULL, '0000-00-00 00:00:00'), 
(1, 'Home', '../inicio/', NULL, '0000-00-00 00:00:00'), 
(2, 'Administrador', '../admin/', NULL, '0000-00-00 00:00:00'), 
(3, 'Deposito', '../deposito/', NULL, '0000-00-00 00:00:00'), 
(4, 'Cliente', '../cliente/', NULL, '0000-00-00 00:00:00'), 

(11, 'Inicio', 'home.php', 1, '0000-00-00 00:00:00'), 
(12, 'Crear Cuenta', 'crearCuenta.php', 1, '0000-00-00 00:00:00'), 
(13, 'Login', 'login.php', 1, '0000-00-00 00:00:00'), 

(21, 'Gestionar Usuarios', 'gestionarUsuarios.php', 2, '0000-00-00 00:00:00'), 
(22, 'Asignar Roles', 'asignarRoles.php', 0, '0000-00-00 00:00:00'), 
(23, 'Quitar Roles', 'quitarRol.php', 0, '0000-00-00 00:00:00'), 
(24, 'Actualizar Usuario', 'formActualizarUsuario.php', 0, '0000-00-00 00:00:00'), 
(25, 'Crear Rol', 'crearRol.php', 0, '0000-00-00 00:00:00'), 

(31, 'Crear Productos', 'crearProductos.php', 3, '0000-00-00 00:00:00'), 
(32, 'Gestionar Productos', 'gestionarProductos.php', 3, '0000-00-00 00:00:00'), 
(33, 'Gestionar Compras', 'gestionarCompras.php' , 3, '0000-00-00 00:00:00'), 
(34, 'Modificar Productos', 'modificarProductos.php' , 0, '0000-00-00 00:00:00'), 

(41, 'Productos', 'productos.php', 4, '0000-00-00 00:00:00'), 
(42, 'Mis Compras', 'misCompras.php', 4, '0000-00-00 00:00:00'), 
(43, 'Carrito', 'carrito.php', 4, '0000-00-00 00:00:00'), 
(44, 'Agregar Productos', 'agregarProductoAlCarrito.php', 0, '0000-00-00 00:00:00'); 

CREATE TABLE compra (
  idcompra bigint(20) NOT NULL,
  cofecha timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  idusuario bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD UNIQUE KEY `idcompra` (`idcompra`),
  ADD KEY `fkcompra_1` (`idusuario`);

ALTER TABLE `compra`
  MODIFY `idcompra` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `compra`
  ADD CONSTRAINT `fkcompra_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;

INSERT INTO compra (idcompra, cofecha, idusuario) VALUES
(1, '2024-02-10 10:30:00', 1),
(2, '2024-02-10 10:35:00', 1),
(3, '2024-02-10 10:40:00', 1),
(4, '2024-02-10 10:45:00', 1),
(5, '0000-00-00 00:00:00', 7); 

CREATE TABLE compraestado (
  idcompraestado bigint(20) UNSIGNED NOT NULL,
  idcompra bigint(11) NOT NULL,
  idcompraestadotipo int(11) NOT NULL,
  cefechaini timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  cefechafin timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `compraestado`
  ADD PRIMARY KEY (`idcompraestado`),
  ADD UNIQUE KEY `idcompraestado` (`idcompraestado`),
  ADD KEY `fkcompraestado_1` (`idcompra`),
  ADD KEY `fkcompraestado_2` (`idcompraestadotipo`);

ALTER TABLE `compraestado`
  MODIFY `idcompraestado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `compraestado`
  ADD CONSTRAINT `fkcompraestado_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraestado_2` FOREIGN KEY (`idcompraestadotipo`) REFERENCES `compraestadotipo` (`idcompraestadotipo`) ON UPDATE CASCADE;

INSERT INTO compraestado (idcompraestado, idcompra, idcompraestadotipo, cefechaini, cefechafin) VALUES
(1, 1, 1, '2024-02-10 10:30:01', '0000-00-00 00:00:00'),
(2, 2, 2, '2024-02-10 10:35:01', '0000-00-00 00:00:00'),
(3, 3, 3, '2024-02-10 10:40:02', '0000-00-00 00:00:00'),
(4, 4, 4, '2024-02-10 10:45:01', '0000-00-00 00:00:00');

CREATE TABLE compraitem (
  idcompraitem bigint(20) UNSIGNED NOT NULL,
  idproducto bigint(20) NOT NULL,
  idcompra bigint(20) NOT NULL,
  cicantidad int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `compraitem`
  ADD PRIMARY KEY (`idcompraitem`),
  ADD UNIQUE KEY `idcompraitem` (`idcompraitem`),
  ADD KEY `fkcompraitem_1` (`idcompra`),
  ADD KEY `fkcompraitem_2` (`idproducto`);

ALTER TABLE `compraitem`
  MODIFY `idcompraitem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `compraitem`
  ADD CONSTRAINT `fkcompraitem_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraitem_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON UPDATE CASCADE;

INSERT INTO compraitem (idcompraitem, idproducto, idcompra, cicantidad) VALUES
(1, 01, 1, 1),
(2, 02, 2, 1),
(3, 03, 3, 1),
(4, 04, 4, 1);

CREATE TABLE menurol (
  idmenu bigint(20) NOT NULL,
  idrol bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `menurol`
  ADD PRIMARY KEY (`idmenu`,`idrol`),
  ADD KEY `fkmenurol_2` (`idrol`);

ALTER TABLE `menurol`
  ADD CONSTRAINT `fkmenurol_1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkmenurol_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE;

INSERT INTO menurol (idmenu, idrol) VALUES

(11, 1), 
(21, 1), 
(22, 1),
(23, 1), 
(24, 1),
(25, 1),

(11, 2), 
(31, 2), 
(32, 2), 
(33, 2), 
(34, 2), 

(11, 3),
(41, 3),
(42, 3), 
(43, 3), 
(44, 3); 

CREATE TABLE usuariorol (
  idusuario bigint(20) NOT NULL,
  idrol bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `usuariorol`
  ADD PRIMARY KEY (`idusuario`,`idrol`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idrol` (`idrol`);

ALTER TABLE `usuariorol`
  ADD CONSTRAINT `fkmovimiento_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariorol_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;

INSERT INTO usuariorol (idusuario, idrol) VALUES
(1,1), 
(2,2), 
(3,3),
(4,3), 
(5,1), 
(6,2), 
(7,3), 
(8,3);