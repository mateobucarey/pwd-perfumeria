-- BD RÁPIDA

DROP DATABASE bdcarritocompras;

--
-- Base de datos: 'bdcarritocompras'
--
CREATE DATABASE bdcarritocompras;
USE bdcarritocompras;

-- ----------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla 'usuario'
--
CREATE TABLE usuario (
  idusuario bigint(20) NOT NULL,
  usnombre varchar(50) NOT NULL,
  uspass varchar(50) NOT NULL,
  usmail varchar(50) NOT NULL,
  usdeshabilitado timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indices de la tabla 'usuario'
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `idusuario` (`idusuario`);

--
-- AUTO_INCREMENT de la tabla 'usuario'
--
ALTER TABLE `usuario`
  MODIFY `idusuario` bigint(20) NOT NULL AUTO_INCREMENT;



-- ----------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla 'rol'
--
CREATE TABLE rol (
  idrol bigint(20) NOT NULL,
  rodescripcion varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indices de la tabla 'rol'
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`),
  ADD UNIQUE KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de la tabla 'rol'
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT;


-- ----------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla 'producto'
--
CREATE TABLE producto (
  idproducto bigint(20) NOT NULL,
  pronombre varchar(250) NOT NULL,
  prodetalle varchar(512) NOT NULL,
  procantstock int(11) NOT NULL,
  imagenproducto varchar(512)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indices de la tabla 'producto'
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD UNIQUE KEY `idproducto` (`idproducto`);

--
-- AUTO_INCREMENT de la tabla 'producto'
--
ALTER TABLE `producto`
  MODIFY `idproducto` bigint(20) NOT NULL AUTO_INCREMENT;



-- ----------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla 'compraestadotipo'
--
CREATE TABLE compraestadotipo (
  idcompraestadotipo int(11) NOT NULL,
  cetdescripcion varchar(50) NOT NULL,
  cetdetalle varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indices de la tabla 'compraestadotipo'
--
ALTER TABLE `compraestadotipo`
  ADD PRIMARY KEY (`idcompraestadotipo`);


-- ----------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla 'menu'
--
CREATE TABLE menu (
  idmenu bigint(20) NOT NULL,
  menombre varchar(100) NOT NULL COMMENT 'Nombre del item del menu',
  medescripcion varchar(124) NOT NULL COMMENT 'Descripcion mas detallada del item del menu',
  idpadre bigint(20) DEFAULT NULL COMMENT 'Referencia al id del menu que es subitem',
  medeshabilitado timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que el menu fue deshabilitado por ultima vez'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indices de la tabla 'menu'
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`),
  ADD UNIQUE KEY `idmenu` (`idmenu`),
  ADD KEY `fkmenu_1` (`idpadre`);

--
-- AUTO_INCREMENT de la tabla 'menu'
--
ALTER TABLE `menu`
  MODIFY `idmenu` bigint(20) NOT NULL;

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fkmenu_1` FOREIGN KEY (`idpadre`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE;

--
-- Volcado de datos para la tabla 'menu'
--


-- ----------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla 'compra'
--
CREATE TABLE compra (
  idcompra bigint(20) NOT NULL,
  cofecha timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  idusuario bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indices de la tabla 'compra'
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD UNIQUE KEY `idcompra` (`idcompra`),
  ADD KEY `fkcompra_1` (`idusuario`);

--
-- AUTO_INCREMENT de la tabla 'compra'
--
ALTER TABLE `compra`
  MODIFY `idcompra` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Filtros para la tabla 'compra'
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fkcompra_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;

-- Volcado de datos de la tabla compra //cambiar los id compra y usuario



-- ----------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla 'compraestado'
--
CREATE TABLE compraestado (
  idcompraestado bigint(20) UNSIGNED NOT NULL,
  idcompra bigint(11) NOT NULL,
  idcompraestadotipo int(11) NOT NULL,
  cefechaini timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  cefechafin timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indices de la tabla 'compraestado'
--
ALTER TABLE `compraestado`
  ADD PRIMARY KEY (`idcompraestado`),
  ADD UNIQUE KEY `idcompraestado` (`idcompraestado`),
  ADD KEY `fkcompraestado_1` (`idcompra`),
  ADD KEY `fkcompraestado_2` (`idcompraestadotipo`);

--
-- AUTO_INCREMENT de la tabla 'compraestado'
--
ALTER TABLE `compraestado`
  MODIFY `idcompraestado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Filtros para la tabla 'compraestado'
--
ALTER TABLE `compraestado`
  ADD CONSTRAINT `fkcompraestado_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraestado_2` FOREIGN KEY (`idcompraestadotipo`) REFERENCES `compraestadotipo` (`idcompraestadotipo`) ON UPDATE CASCADE;



-- ----------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla 'compraitem'
--
CREATE TABLE compraitem (
  idcompraitem bigint(20) UNSIGNED NOT NULL,
  idproducto bigint(20) NOT NULL,
  idcompra bigint(20) NOT NULL,
  cicantidad int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indices de la tabla 'compraitem'
--
ALTER TABLE `compraitem`
  ADD PRIMARY KEY (`idcompraitem`),
  ADD UNIQUE KEY `idcompraitem` (`idcompraitem`),
  ADD KEY `fkcompraitem_1` (`idcompra`),
  ADD KEY `fkcompraitem_2` (`idproducto`);

--
-- AUTO_INCREMENT de la tabla 'compraitem'
--
ALTER TABLE `compraitem`
  MODIFY `idcompraitem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Filtros para la tabla 'compraitem'
--
ALTER TABLE `compraitem`
  ADD CONSTRAINT `fkcompraitem_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraitem_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON UPDATE CASCADE;



-- ----------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla 'menurol'
--
CREATE TABLE menurol (
  idmenu bigint(20) NOT NULL,
  idrol bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indices de la tabla 'menurol'
--
ALTER TABLE `menurol`
  ADD PRIMARY KEY (`idmenu`,`idrol`),
  ADD KEY `fkmenurol_2` (`idrol`);

--
-- Filtros para la tabla `menurol`
--
ALTER TABLE `menurol`
  ADD CONSTRAINT `fkmenurol_1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkmenurol_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE;



-- ----------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuariorol`
--
CREATE TABLE usuariorol (
  idusuario bigint(20) NOT NULL,
  idrol bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indices de la tabla 'usuariorol'
--
ALTER TABLE `usuariorol`
  ADD PRIMARY KEY (`idusuario`,`idrol`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idrol` (`idrol`);

--
-- Filtros para la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD CONSTRAINT `fkmovimiento_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariorol_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;

--Volcados para las tablas
INSERT INTO usuario (idusuario, usnombre, uspass, usmail, usdeshabilitado) VALUES
('1', 'Admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin@mail.com', '0000-00-00 00:00:00'),-- 1234
('2', 'Deposito', '81dc9bdb52d04dc20036dbd8313ed055', 'deposito@mail.com', '0000-00-00 00:00:00'),-- 1234
('3', 'Cliente', '81dc9bdb52d04dc20036dbd8313ed055', 'cliente@mail.com', '0000-00-00 00:00:00'); -- 1234

INSERT INTO rol (`idrol`, `rodescripcion`) VALUES
(1, 'Admin'),
(2, 'Deposito'),
(3, 'Cliente');

INSERT INTO usuariorol (`idusuario`, `idrol`) VALUES
(1, 1),
(2, 2),
(3, 3);

INSERT INTO producto (`idproducto`, `pronombre`, `prodetalle`, `procantstock`, `tipo`, `imagenproducto`) VALUES
(1, 'Chanel No. 5 (50ml)', '130000', 10, 'perfume femenino', "../img/productos/perfume1.png"),
(2, 'Dior Sauvage (100ml)', '150000', 10, 'perfume masculino', "../img/productos/perfume2.png"),
(3, 'Yves Saint Laurent Black Opium (90ml)', '140000', 10, 'perfume femenino', "../img/productos/perfume3.png"),
(4, 'Versace Eros (100ml)', '120000', 10, 'perfume masculino', "../img/productos/perfume4.png"),
(5, 'Armani Acqua Di Gio (100ml)', '170000', 10, 'perfume masculino', "../img/productos/perfume5.png"),
(6, 'Paco Rabanne 1 Million (100ml)', '150000', 10, 'perfume masculino', "../img/productos/perfume6.png"),
(7, 'Dolce & Gabbana Light Blue (100ml)', '110000', 10, 'perfume masculino', "../img/productos/perfume7.png"),
(8, 'Gucci Bloom (100ml)', '100000', 10, 'perfume femenino', "../img/productos/perfume8.png"),
(9, 'Tom Ford Noir (100ml)', '190000', 10, 'perfume masculino', "../img/productos/perfume9.png"),
(10, 'Lancôme La Vie Est Belle (75ml)', '120000', 10, 'perfume femenino', "../img/productos/perfume10.png"),
(11, 'Calvin Klein Euphoria (100ml)', '150000', 10, 'perfume masculino', "../img/productos/perfume11.png"),
(12, 'Jean Paul Gaultier Le Male (100ml)', '180000', 10, 'perfume masculino', "../img/productos/perfume12.png");

INSERT INTO compraestadotipo (idcompraestadotipo, cetdescripcion, cetdetalle) VALUES
(1, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1'),
(3, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado = 2'),
(4, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado = 1');

INSERT INTO `compra` (`idcompra`, `cofecha`, `idusuario`) VALUES
(1, '2024-11-19 16:00:00', 1),
(2, '2024-11-01 17:00:00', 2),
(3, '2024-10-16 18:00:00', 3);