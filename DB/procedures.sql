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
    IN _OP      CHAR(3)
)
BEGIN

    CASE
        WHEN _OP = 'INI' THEN
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
                _COT,
                _PRECIO,
                _CANT,
                _VEND,
                SYSDATE()
            );

            SELECT 'OBJETO AGREGADO' AS 'RESULTADO';
        WHEN _OP = 'APB' THEN #APROBAR
            UPDATE OBJETOS
                SET OBJ_ST = 0
            WHERE ID_OBJ = _OBJ;

            SELECT 'OBJETO APROBADO' AS 'RESULTADO';

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
    END CASE;
END //
DELIMITER ; 

SELECT * FROM MERCADONA_DB.CATEGORIAS;