CREATE DATABASE MERCADONA_DB;
--CONSTASENIA DEFAULT 'CHANGEIT'
--USUARIOS
USE MERCADONA_DB;
DROP TABLE IF EXISTS USUARIOS;
CREATE TABLE USUARIOS(
	    USR_CORREO      VARCHAR(50) NOT NULL PRIMARY KEY COMMENT 'PK CORREO USUARIO',
	    USR_APODO       VARCHAR(20) UNIQUE NOT NULL COMMENT 'APODO DE USUARIO',
	    USR_PWD         VARCHAR(255) NOT NULL DEFAULT '$2y$10$WdOka56tbAv8wPePy7RziefhoVT1vIxwBoi1k2aOfGsIm9O/ekSbW' COMMENT 'CONSTRASENIA',
	    USR_ROL         CHAR(1) DEFAULT 'C' COMMENT 'ROL DE USUARIO PK DE ROLES DE USUARIO',
	    USR_IMG         MEDIUMBLOB NOT NULL COMMENT 'IMAGEN DEL USUARIO',
	    USR_NMBRE       VARCHAR(150) NOT NULL COMMENT 'NOMBRE DE USUARIO',
	    USR_GNRO        BIT DEFAULT 1 COMMENT 'GENERO DEL USUARIO',
	    USR_ALTA        TIMESTAMP COMMENT 'FECHA EN QUE DIO DE ALTA',
	    USR_ED          TIMESTAMP COMMENT 'FECHA DE ULTIMA EDICION',
	    USR_PRIV        BIT DEFAULT 1 COMMENT 'PRIVACIDAD DE CUENTA',
	    USR_ST          BIT DEFAULT 1 COMMENT 'ESTADO DE LA CUENTA'
);

USE MERCADONA_DB;
ALTER TABLE USUARIOS ADD COLUMN FIRST_LOG TINYINT(1) DEFAULT 1 COMMENT 'FIRST USER LOGIN';

--LISTAS
USE MERCADONA_DB;
DROP TABLE IF EXISTS D_LISTAS;
CREATE TABLE D_LISTAS(
	    ID_LISTA        INT AUTO_INCREMENT COMMENT 'PK DE LISTAS DE DESEOS',
	    DL_NOMBRE       VARCHAR(50) NOT NULL COMMENT 'NOMBRE DE LA LISTA',
	    DL_DESC         VARCHAR(255) NOT NULL COMMENT 'DESCRIPCION DE LA LISTA',
	    DL_IMGN         MEDIUMBLOB COMMENT 'IMAGEN DE PORTADA PARA LA LISTA DE DESOS',
	    DL_USR          VARCHAR(50) NOT NULL COMMENT 'PK DE LA TABLA USUARIOS',
	    DL_ALTA         TIMESTAMP NOT NULL COMMENT 'FECEHA EN QUE SE CREO LA LISTA',
	    DL_ED           TIMESTAMP COMMENT 'ULTIMA MODIFICACION A LA LISTA',
	    DL_PRIV         BIT DEFAULT 1  COMMENT 'PRIVACIDAD DE LA LISTA',
	    CONSTRAINT pk_dlista PRIMARY KEY(ID_LISTA),
	    CONSTRAINT fk_usr_list FOREIGN KEY(DL_USR) REFERENCES USUARIOS(USR_CORREO)
);

ALTER TABLE D_LISTAS ADD COLUMN D_ST BIT DEFAULT 1 COMMENT 'ESTADO DE LA TABLA 1 ACTIVO 0 INACTIVO';

--AGERGAR LA LLAVE DEL OBJETO
USE MERCADONA_DB;
DROP TABLE IF EXISTS D_LISTAS_DETALLE;
CREATE TABLE D_LISTAS_DETALLE(
	    ID_LISTA    INT NOT NULL COMMENT 'PK DE LA TABLA PADRE D_LISTAS',
	    ID_OBJETO   BIGINT NOT NULL COMMENT 'PK DE LA TABLA OBJETOS',
	    OBJ_NBRE    VARCHAR(150) NOT NULL COMMENT 'NOMBRE DEL OBJETO',
	    OBJ_DESC    VARCHAR(255) NOT NULL COMMENT 'DESCRIPCION DEL OBJETO',
	    OBJ_PRECIO  FLOAT(2) DEFAULT 0 COMMENT 'PRECIO DEL OBJETO',
	    ALTA        TIMESTAMP NOT NULL COMMENT 'FECHA EN QUE SE AGREGO A LA LISTA',
	    ED          TIMESTAMP COMMENT 'ULTIMA EDICION DE LA LISTA'
);

ALTER TABLE D_LISTAS_DETALLE ADD COLUMN D_ST BIT DEFAULT b'1' COMMENT 'ESTADO DEL OBJETO EN LA LISTA 1 ACTIVO 0 INACTIVO';

--TABLA DE CATEGORIAS
USE MERCADONA_DB;
DROP TABLE IF EXISTS CATEGORIAS;
CREATE TABLE CATEGORIAS(
	    CAT_ID      INT AUTO_INCREMENT COMMENT 'PK DE CATEGORIAS',
	    CAT_NMBRE   VARCHAR(50) NOT NULL COMMENT 'NOMBRE DE LA CATEGORIA',
	    CAT_DESC    VARCHAR(255) NOT NULL COMMENT 'DESCRIPCION DE LA CATEGORIA',
	    CAT_USR     VARCHAR(50) NOT NULL COMMENT 'PK DE TABLA USUARIOS',
	    CAT_ALTA    TIMESTAMP NOT NULL COMMENT 'FECHA EN QUE SE CREO LA CATEGORIA',
	    CAT_ED      TIMESTAMP COMMENT 'ULTIMA MODIFICACION ECHA A UNA CATEGORIA',
	    CAT_ST      BIT DEFAULT 0 COMMENT 'ESTADO DE LA TABLA',
	    CONSTRAINT pk_categoria PRIMARY KEY(CAT_ID),
	    CONSTRAINT fk_categoria_usr FOREIGN KEY(CAT_USR) REFERENCES USUARIOS(USR_CORREO)
);

--TABLA DE OBJETOS
USE MERCADONA_DB;
DROP TABLE IF EXISTS OBJETOS;
CREATE TABLE OBJETOS(
	    ID_OBJ     BIGINT AUTO_INCREMENT COMMENT 'PK OBJETOS',
	    OBJ_NMBRE  VARCHAR(100) NOT NULL COMMENT 'NOMBRE DEL OBJETO',
	    OBJ_DESC   VARCHAR(255) NOT NULL COMMENT 'DESCRIIPCION DEL OBJETO',
	    OBJ_COT    BIT DEFAULT 0 COMMENT 'SI ES PARA COTIZAR O VENDER',
	    OBJ_PRECIO FLOAT(2) DEFAULT 0 COMMENT 'PRECIO DEL OBJETO',
	    OBJ_CANT   INT DEFAULT 0 COMMENT 'CANTIDAD EN INVENTARIO',
	    OBJ_VEND   VARCHAR(50) NOT NULL COMMENT 'VENDEDOR PK TABLA USUARIO',
	    OBJ_ALTA   TIMESTAMP NOT NULL COMMENT 'FECHA EN QUE SE DIO DE ALTA',
	    OBJ_ST     BIT DEFAULT 1 COMMENT 'SI EL OBJETO SIGUE ACTIVO',
	    OBJ_VI     INT DEFAULT 0 COMMENT 'CANTIDAD DE VISITIAS QUE TIENE ESE OBJETO',
	    CONSTRAINT pk_objeto PRIMARY KEY(ID_OBJ),
	    CONSTRAINT fk_objeto_usuario FOREIGN KEY(OBJ_VEND) REFERENCES USUARIOS(USR_CORREO)
);

--AGREGAR LA LLAVE DEL OBJETO A LA LISTA DE DESEOS
ALTER TABLE MERCADONA_DB.D_LISTAS_DETALLE ADD CONSTRAINT fk_objeto_lista FOREIGN KEY(ID_OBJETO) REFERENCES OBJETOS(ID_OBJ);
ALTER TABLE MERCADONA_DB.D_LISTAS_DETALLE ADD CONSTRAINT fk_list_detalle FOREIGN KEY(ID_LISTA) REFERENCES D_LISTAS(ID_LISTA);
ALTER TABLE MERCADONA_DB.D_LISTAS_DETALLE ADD CONSTRAINT PRIMARY KEY(ID_LISTA, ID_OBJETO);

--OBJETOS Y CATEGORIAS
USE MERCADONA_DB;
DROP TABLE IF EXISTS CATEGORIA_OBJETO;
CREATE TABLE CATEGORIA_OBJETO(
	    ID_CAT      INT NOT NULL COMMENT 'PK DE CATEGORIAS',
	    ID_OBJ      BIGINT NOT NULL COMMENT 'PK DE OBJETOS',
	    ALTA        TIMESTAMP NOT NULL COMMENT 'FECHA EN QUE SE AGREGO A LA CATEGORIA',
	    ED          TIMESTAMP COMMENT 'ULTIMA EDICION DE LA CATEGORIA Y OBJETO',
	    ST          BIT DEFAULT 1 COMMENT 'SI EL OBJETO SIGUE ACTIVO',
	    CONSTRAINT pk_categoria_objeto PRIMARY KEY(ID_CAT, ID_OBJ),
	    CONSTRAINT fk_cat_obj FOREIGN KEY(ID_CAT) REFERENCES CATEGORIAS(CAT_ID),
	    CONSTRAINT fk_obj_cat FOREIGN KEY(ID_OBJ)  REFERENCES OBJETOS(ID_OBJ)
);

--USAR CHECK PARA VALIDAR QUE LA CANTIDAD NO SEA MAYOR A LA DEL INVETARIO
--TABLA PARA CARRITO DE COMPRAS
USE MERCADONA_DB;
DROP TABLE IF EXISTS CARRITO_COMPRAS;
CREATE TABLE CARRITO_COMPRAS(
	    ID_CARRITO      BIGINT AUTO_INCREMENT NOT NULL COMMENT 'PK PARA CARRITO DE COMPRAS',
	    CARR_USR        VARCHAR(50) NOT NULL COMMENT 'PK DE USUARIO, A QUIEN PERTENECE EL CARRITO',
	    CONSTRAINT pk_carrito_compras PRIMARY KEY(ID_CARRITO)
);

ALTER TABLE CARRITO_COMPRAS ADD COLUMN CARR_ALTA DATE NOT NULL COMMENT 'FECHA EN QUE SE AGREGO ELEMENTO AL CARRITO';


--CARRITO A DETALLE
USE MERCADONA_DB;
DROP TABLE IF EXISTS CARRITO_COMPRAS_DETALLE;
CREATE TABLE CARRITO_COMPRAS_DETALLE(
	    ID_CARRITO  BIGINT NOT NULL COMMENT 'PK DE LA TABLA CARRITO COMPRAS',
	    ID_OBJETO   BIGINT NOT NULL COMMENT 'PK DE LA TABLA OBJETOS',
		CARR_CANT       INT DEFAULT 1 COMMENT 'CANTIDAD DEL PRODUCTO',   
	    ALTA        TIMESTAMP NOT NULL COMMENT 'FECHA EN LA QUE SE AGREGO EL CARRITO',
	    ST          CHAR(1) DEFAULT('A') COMMENT 'ESTADO DE LA COMPRA',
	    COMPRA      TIMESTAMP COMMENT 'FECHA DE LA COMPRA',
	    CONSTRAINT pk_carrito PRIMARY KEY(ID_CARRITO, ID_OBJETO),
	    CONSTRAINT fk_carrito_lista FOREIGN KEY(ID_CARRITO) REFERENCES CARRITO_COMPRAS(ID_CARRITO),
	    CONSTRAINT fk_objeto_carrito FOREIGN KEY(ID_OBJETO) REFERENCES OBJETOS(ID_OBJ)
);

ALTER TABLE CARRITO_COMPRAS_DETALLE ADD COLUMN PRECIO FLOAT NOT NULL COMMENT 'PRECIO DEL PRODUCTO';

--VENTAS
USE MERCADONA_DB;
DROP TABLE IF EXISTS VENTAS;
CREATE TABLE VENTAS(
	    ID_VENTA       BIGINT AUTO_INCREMENT NOT NULL COMMENT 'PK TABLA VENTAS',
	    VEN_COMP        VARCHAR(50) NOT NULL COMMENT 'PK TABLA USUARIOS',
	    VEN_FECH       TIMESTAMP NOT NULL COMMENT 'FECHA DE COMPRA',
	    CONSTRAINT pk_venta PRIMARY KEY(ID_VENTA),
	    CONSTRAINT pk_venta_usuario FOREIGN KEY(VEN_COMP) REFERENCES USUARIOS(USR_CORREO)
);

USE MERCADONA_DB;
DROP TABLE IF EXISTS VENTAS_DETALLE;
CREATE TABLE VENTAS_DETALLE(
	    ID_VENTA    BIGINT NOT NULL COMMENT 'PK TABLA VENTAS',
	    ID_OBJ      BIGINT NOT NULL COMMENT 'PK TABLA OBJETOS',
	    VEN_CANT    INT DEFAULT 1 COMMENT 'CANTIDAD DE OBJETOS VENDIDA',
	    VEN_CMTRIO  VARCHAR(255) NOT NULL COMMENT 'COMENTARIO DE LA VENTA',
	    VEN_CALIF   TINYINT DEFAULT 0 COMMENT 'CALIFICACION DE LA VENTA',
	    ID_VEND     VARCHAR(50) NOT NULL COMMENT 'PK TABLA USUARIOS PERO VENDEDOR',
	    CONSTRAINT pk_venta_detalle PRIMARY KEY(ID_VENTA, ID_OBJ, ID_VEND),
	    CONSTRAINT fk_venta_detalle FOREIGN KEY(ID_VENTA) REFERENCES VENTAS(ID_VENTA),
	    CONSTRAINT fk_venta_detalle_objeto FOREIGN KEY(ID_OBJ) REFERENCES OBJETOS(ID_OBJ),
	    CONSTRAINT fk_venta_detalle_vendedor FOREIGN KEY(ID_VEND) REFERENCES USUARIOS(USR_CORREO)
);

--TABLA MULTIMEDIA PARA VIDEOS E IMAGNES DE LOS OBJETOS
USE MERCADONA_DB;
DROP TABLE IF EXISTS MULTIMEDIA;
CREATE TABLE MULTIMEDIA(
	ID_MEDIA    BIGINT AUTO_INCREMENT NOT NULL COMMENT 'PK DE MULTIMEDIA',
	ID_OBJ      BIGINT NOT NULL COMMENT 'PK DE OBJETOS',
	MEDIA_REC   MEDIUMBLOB NOT NULL COMMENT 'RECURSO MULTIMEDIA',
	MEDIA_EXT   VARCHAR(10) NOT NULL COMMENT 'EXTENCION DEL RECURSO MULTIMEDIA',
	MEDIA_PESO  VARCHAR(50) NOT NULL COMMENT 'TAMANIO DEL RECURSO',
	MEDIA_TIPO  VARCHAR(10) NOT NULL COMMENT 'IMAGEN/VIDEO',
	CONSTRAINT  pk_multimedia PRIMARY KEY(ID_MEDIA),
	CONSTRAINT  fk_multimedia_obj FOREIGN KEY(ID_OBJ) REFERENCES OBJETOS(ID_OBJ)
);

#el precio base se calcula por un porcentaje de manera aleatoria
#y se almacena
USE MERCADONA_DB;
DROP TABLE IF EXISTS COTIZACIONES;
CREATE TABLE COTIZACIONES(
	USUARIO VARCHAR(60) NOT NULL COMMENT 'USUARIO QUE SOLICITO LA COTIZACION',
	OBJ BIGINT NOT NULL COMMENT 'IDENTIFICADOR DEL OBJETO COTIZADO',
	CANTIDAD TINYINT DEFAULT 1 COMMENT 'CATIDAD DE OBJETOS COTIZADOS',
	PORCENTAJE FLOAT DEFAULT 0.0 COMMENT 'PORCENTAJE VARIANTE DEL PRECIO',
	CONSTRAINT PRIMARY KEY(USUARIO, OBJ),
	CONSTRAINT fk_cotizacion_usuario FOREIGN KEY(USUARIOS) REFERENCES USUARIOS(USR_CORREO),
	CONSTRAINT fk_cotizacion_objeto FOREIGN KEY(OBJ) REFERENCES OBJETOS(ID_OBJ)
);

