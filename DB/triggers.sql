USE MERCADONA_DB;
DROP TRIGGER IF EXISTS TR_INSERTAR_OBJ;
DELIMITER //
CREATE TRIGGER TR_INSERTAR_OBJ
AFTER INSERT
ON OBJETOS FOR EACH ROW
BEGIN

    SET @CATEGORIA = (SELECT CATEGORIA FROM HOLDER LIMIT 1);

    INSERT INTO CATEGORIA_OBJETO(
        ID_CAT,
        ID_OBJ,
        ALTA
    ) VALUES (@CATEGORIA, NEW.ID_OBJ, SYSDATE());

    #ALTER TABLE OBJETOS DROP COLUMN TMP_CATEGORIA;
END //
DELIMITER ;

USE MERCADONA_DB;
DROP TRIGGER IF EXISTS TR_ELIMINAR_LISTA;
DELIMITER //
CREATE TRIGGER TR_ELIMINAR_LISTA
BEFORE DELETE
ON D_LISTAS FOR EACH ROW
BEGIN

    DELETE FROM D_LISTAS_DETALLE 
        WHERE ID_LISTA = OLD.ID_LISTA;

END //
DELIMITER ;

USE MERCADONA_DB;
DROP TRIGGER IF EXISTS TR_NUEVO_USUARIO;
DELIMITER //
CREATE TRIGGER TR_NUEVO_USUARIO
AFTER INSERT 
ON USUARIOS FOR EACH ROW
BEGIN

    INSERT INTO CARRITO_COMPRAS(CARR_USR, CARR_ALTA)
        VALUES(NEW.USR_CORREO, SYSDATE());

END //
DELIMITER ;