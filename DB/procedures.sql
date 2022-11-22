-- REGISTRARSE E INICIAR SESION.


USE MERCADONA_DB;
DROP PROCEDURE IF EXISTS SP_SESSION;
DELIMITER //
CREATE PROCEDURE SP_SESSION(
    IN  _USUARIO VARCHAR(50),
    IN  _PWD VARCHAR(255),
    IN  _APODO VARCHAR(20),
    IN  _NMBRE VARCHAR(150),
    IN  _OP CHAR(3)
)
BEGIN

DECLARE EXIT HANDLER FOR 1062
    BEGIN
        SELECT 'EL CORREO O NOMBRE DE USUARIO YA EXISTEN' AS 'RESULTADO';
    END;

    CASE
        WHEN _OP = 'INI' THEN
            SELECT 
                USR_CORREO AS CORREO,
                USR_PWD AS PWD,
                USR_APODO AS APODO, 
                USR_IMG AS IMGN, 
                USR_ROL AS ROL, 
                USR_NMBRE AS NOMBRE, 
                USR_GNRO AS GENERO, 
                USR_PRIV AS PRIV,
                FIRST_LOG AS LG
            FROM USUARIOS
            WHERE USR_CORREO = UPPER(_USUARIO);
        
        WHEN _OP = 'REG' THEN
            INSERT INTO USUARIOS(
                USR_CORREO,
                USR_PWD,
                USR_APODO,
                USR_IMG,
                USR_NMBRE,
                USR_ALTA
            )VALUES(
               UPPER( _USUARIO),
                _PWD,
                UPPER(_APODO),
                '',
                UPPER(_NMBRE),
                SYSDATE()
            );

            SELECT "USUARIO INSERTADO" AS 'RESULTADO';

        WHEN _OP = 'PWD' THEN
            UPDATE USUARIOS
                SET USR_PWD = _PWD
            WHERE USR_CORREO = _USUARIO;

            SELECT 'PWD ACTUALIZADO' AS 'RESULTADO';

    END CASE;

END //
DELIMITER ;

--EDICION DE USUARIOS (PENDIENTE SI SUPER USUARIO DA DE BAJA, ALTAS Y REACTIVAR CUENTAS).
USE MERCADONA_DB;
DROP PROCEDURE IF EXISTS SP_USUARIO;
DELIMITER //
CREATE PROCEDURE SP_USUARIO(
    IN _CORREO  VARCHAR(50),
    IN _APODO   VARCHAR(20),
    IN _ROL     CHAR(1),
    IN _IMGN    MEDIUMBLOB,
    IN _NMBRE   VARCHAR(150),
    IN _GNRO    VARCHAR(10),
    IN _PRIV    CHAR(3),
    IN _OP      CHAR(3)
)
BEGIN

    DECLARE EXIT HANDLER FOR 1062
    BEGIN
        SELECT 'EL CORREO O NOMBRE DE USUARIO YA EXISTEN' AS 'RESULTADO';
    END;

    CASE
        WHEN _OP = 'EDT' THEN

            SET @GENDER = (SELECT IF(_GNRO = 'male', b'1', b'0'));

            UPDATE USUARIOS AS USRS
                SET 
                    USR_APODO = _APODO,
                    USR_NMBRE = _NMBRE,
                    USR_GNRO = @GENDER,
                    USR_ED = SYSDATE()
                WHERE USR_CORREO = _CORREO;
            
            SELECT 'USUARIO ACTUALIZADO' AS 'RESULTADO';
        WHEN _OP = 'ELM' THEN
            UPDATE USUARIOS
                SET
                    USR_ST = 0
                WHERE USR_CORREO = _CORREO;

            SELECT 'USUARIO ELIMINADO' AS 'RESULTADO';

        WHEN _OP = 'GET' THEN
            SELECT
                USR_CORREO AS CORREO,
                USR_APODO AS APODO,
                USR_ROL AS ROL,
                USR_IMG AS IMG,
                USR_NMBRE AS NOMBRE,
                USR_GNRO AS GENERO,
                USR_PRIV AS PRIV,
                FIRST_LOG AS LG
            FROM USUARIOS
            WHERE USR_ST = 1 AND USR_CORREO = _CORREO;

        WHEN _OP = 'PRI' THEN

            SET @PRIVACY = (SELECT IF(_PRIV = 'ON', b'1', b'0'));

            UPDATE USUARIOS
                SET USR_PRIV = @PRIVACY
            WHERE USR_CORREO = _CORREO;

            SELECT 'PRIVACIDAD ACTUALIZADA' AS 'RESULTADO';

        WHEN _OP = 'IMG' THEN

            UPDATE USUARIOS 
                SET USR_IMG = _IMGN
            WHERE USR_CORREO = _CORREO;

        WHEN _OP = 'SID' THEN

            UPDATE USUARIOS
                SET USR_ROL = _ROL,
                    FIRST_LOG = 0
            WHERE USR_CORREO = _CORREO;

    END CASE;

END //
DELIMITER ;

--AGEGAR OBJETOS
USE MERCADONA_DB;
DROP PROCEDURE IF EXISTS SP_OBJETOS;
DELIMITER //
CREATE PROCEDURE SP_OBJETOS(
    IN OBJ      BIGINT,
    IN _NMBRE   VARCHAR(100),
    IN _DESC    VARCHAR(255),
    IN _COT     TINYINT(1),
    IN _PRECIO  FLOAT,
    IN _CANT    INT,
    IN _VEND    VARCHAR(50),
    IN _CAT     INT,
    IN _OP      CHAR(3)
)
BEGIN

    CASE
        WHEN _OP = 'INI' THEN #INSERTAR

            SET @COTIZACION = (SELECT IF(_COT = 1, b'1', b'0'));

            DROP TABLE IF EXISTS HOLDER;
            CREATE TEMPORARY TABLE HOLDER(
                CATEGORIA INT NOT NULL PRIMARY KEY
            );

            INSERT INTO HOLDER VALUES(_CAT);

            INSERT INTO OBJETOS(
                OBJ_NMBRE,
                OBJ_DESC,
                OBJ_COT,
                OBJ_PRECIO,
                OBJ_CANT,
                OBJ_VEND,
                OBJ_ALTA
            )VALUES(
                _NMBRE,
                _DESC,
                @COTIZACION,
                _PRECIO,
                _CANT,
                _VEND,
                SYSDATE()
            );

            SELECT 
                ID_OBJ AS 'RESULTADO' 
            FROM OBJETOS ORDER BY ID_OBJ DESC LIMIT 1;

        WHEN _OP = 'GTO' THEN #OBTNER POR DUENIO
            SELECT * FROM VW_PORTADA_OBJETO
                WHERE VENDEDOR = _VEND;

        WHEN _OP = 'GET' THEN #APROBAR (OBSOLETO)
            SELECT * FROM VW_OBJECT WHERE ID_OBJ = OBJ;


    END CASE;

END //
DELIMITER ;

USE MERCADONA_DB;
DROP PROCEDURE IF EXISTS SP_SOLICITUDES;
DELIMITER //
CREATE PROCEDURE SP_SOLICITUDES(
    IN _OBJ BIGINT,
    IN _ADMIN VARCHAR(60),
    IN _OP CHAR(3)
)
BEGIN

    CASE
        WHEN _OP = 'ALL' THEN #OBTIENE TODAS LAS PETICIONES PENDIENTES
            SELECT * FROM VW_OBJETO_CATEGORIA WHERE ESTADO = 'No aprovado';

        WHEN _OP = 'APR' THEN #APROVAR OBJETO
            UPDATE OBJETOS SET OBJ_ST = b'0' WHERE ID_OBJ = _OBJ;
            SELECT * FROM VW_OBJETO_CATEGORIA;

    END CASE;

END //
DELIMITER ;

USE MERCADONA_DB;
DROP PROCEDURE IF EXISTS SP_MULTIMEDIA;
DELIMITER //
CREATE PROCEDURE SP_MULTIMEDIA(
    IN _MULTIMEDIA_ID BIGINT,
    IN _OBJ BIGINT,
    IN _RECURSO MEDIUMBLOB,
    IN _EXTENSION VARCHAR(10),
    IN _PESO VARCHAR(50),
    IN _TIPO VARCHAR(10),
    IN _OP CHAR(3)
)
BEGIN

    CASE

        WHEN _OP = 'INS' THEN #INSERTAR IMAGENES PRODUCTO
            INSERT INTO MULTIMEDIA(
                ID_OBJ,
                MEDIA_REC,
                MEDIA_EXT,
                MEDIA_PESO,
                MEDIA_TIPO
            ) VALUES(
                _OBJ,
                _RECURSO,
                _EXTENSION,
                _PESO,
                _TIPO
            );

            SELECT 'RECURSO INSERTADO' AS 'RESULTADO';

    END CASE;

END //
DELIMITER ;

USE MERCADONA_DB;
DROP PROCEDURE IF EXISTS SP_CATEGORIAS;
DELIMITER //
CREATE PROCEDURE SP_CATEGORIAS(
    IN _CATEGORIA INT,
    IN _NOMBRE VARCHAR(50),
    IN _DESCRIPCION VARCHAR(255),
    IN _USUARIO VARCHAR(50),
    IN _OP CHAR(3)
)
BEGIN

    CASE
        WHEN _OP = 'INS' THEN
            INSERT INTO CATEGORIAS(
                CAT_NMBRE,
                CAT_DESC,
                CAT_USR,
                CAT_ALTA,
                CAT_ST
            )VALUES(
                _NOMBRE,
                _DESCRIPCION,
                _USUARIO,
                SYSDATE(),
                1
            );

        WHEN _OP = 'ALL' THEN
            SELECT
                CAT_ID AS ID,
                CAT_NMBRE AS 'NAME',
                CAT_DESC AS 'DESCRIPTION'
            FROM CATEGORIAS
            WHERE CAT_ST = 1;

        WHEN _OP = 'PCA' THEN #OBTENER OBJETOS POR CATEGORIA
            SELECT * FROM VW_OBJETO_CATEGORIA
                WHERE ID_CAT = _CATEGORIA AND ESTADO = 'Aprovado';

    END CASE;
END //
DELIMITER ; 

USE MERCADONA_DB;
DROP PROCEDURE IF EXISTS SP_WISHLIST;
DELIMITER //
CREATE PROCEDURE SP_WISHLIST(
    IN _LISTA INT,
    IN _NAME VARCHAR(50),
    IN _DESC VARCHAR(255),
    IN _COVER MEDIUMBLOB,
    IN _OWNER VARCHAR(60),
    IN _PRIV CHAR(3),
    IN _OBJ BIGINT,
    IN _OP CHAR(3)
)
BEGIN

    CASE
        WHEN _OP = 'ADD' THEN 
            INSERT INTO D_LISTAS(
                DL_NOMBRE,
                DL_DESC,
                DL_IMGN, 
                DL_USR,
                DL_ALTA
            )VALUES(
                _NAME,
                _DESC,
                _COVER,
                _OWNER,
                SYSDATE()
            );

        WHEN _OP = 'GET' THEN 
            SELECT
                DL_IMGN,
                ID_LISTA, 
                DL_NOMBRE, 
                DL_DESC, 
                DL_USR, 
                DATE_FORMAT(DL_ALTA, '%d/%m/%Y') AS DL_ALTA, 
                DL_PRIV 
            FROM D_LISTAS
            WHERE DL_USR = _OWNER;

            SELECT * FROM D_LISTAS;
        WHEN _OP = 'ADI' THEN
            INSERT INTO D_LISTAS_DETALLE(
                ID_LISTA, 
                ID_OBJETO,
                OBJ_NBRE, 
                OBJ_DESC,
                OBJ_PRECIO,
                ALTA
            )VALUES(
                _LISTA,
                _OBJ,
                (SELECT OBJ_NMBRE FROM OBJETOS WHERE ID_OBJ = _OBJ),
                (SELECT OBJ_DESC FROM OBJETOS WHERE ID_OBJ = _OBJ),
                (SELECT OBJ_PRECIO FROM OBJETOS WHERE ID_OBJ = _OBJ),
                SYSDATE()
            );

        WHEN _OP = 'GEL' THEN #GET LIST
            SELECT * FROM VW_LISTAS WHERE LISTA = _LISTA;

        WHEN _OP = 'LIS' THEN #LIST ITEMS
            SELECT * FROM VW_LISTA_OBJETOS WHERE LISTA = _LISTA;

    END CASE;

END //
DELIMITER ;

SELECT * FROM MERCADONA_DB.CATEGORIAS;