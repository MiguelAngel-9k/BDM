USE MERCADONA_DB;
DROP VIEW IF EXISTS VW_PORTADA_OBJETO;
CREATE VIEW VW_PORTADA_OBJETO AS
    SELECT
        O.OBJ_NMBRE AS 'TITULO',
        O.OBJ_DESC AS 'DESCRIPCION',
        IF(O.OBJ_COT = b'1', 'Cotizar', O.OBJ_PRECIO) AS 'PRECIO',
        O.ID_OBJ AS 'OBJETO',
        M.MEDIA_REC AS 'PORTADA',
        O.OBJ_VEND AS 'VENDEDOR',
        O.OBJ_ST AS ESTADO
    FROM OBJETOS AS O
    JOIN MULTIMEDIA AS M
    ON M.ID_OBJ = O.ID_OBJ
    WHERE O.OBJ_ST = b'0';


USE MERCADONA_DB;
DROP VIEW IF EXISTS VW_OBJETO_CATEGORIA;
CREATE VIEW VW_OBJETO_CATEGORIA AS
    SELECT 
        M.MEDIA_REC AS 'PORTADA',
        O.ID_OBJ AS ID_OBJETO, 
        O.OBJ_NMBRE AS OBJETO, 
        C.CAT_ID AS ID_CAT, 
        C.CAT_NMBRE AS CATEGORIA,
        O.OBJ_VEND AS VENDEDOR,
        O.OBJ_ALTA AS ALTA,
        O.OBJ_CANT AS CANTIDAD,
        O.OBJ_PRECIO AS PRECIO, 
        O.OBJ_DESC AS 'DESCRIPCION',
        IF(O.OBJ_ST = b'1', 'No aprovado', 'Aprovado' ) AS ESTADO
    FROM CATEGORIA_OBJETO AS CO 
    JOIN OBJETOS AS O 
    ON O.ID_OBJ = CO.ID_OBJ 
    JOIN CATEGORIAS AS C ON C.CAT_ID = CO.ID_CAT
    JOIN MULTIMEDIA AS M ON O.ID_OBJ = M.ID_OBJ;

USE MERCADONA_DB;
DROP VIEW IF EXISTS VW_OBJECT;
CREATE VIEW VW_OBJECT AS
    SELECT 
        M.MEDIA_REC AS RECURSO,
        O.OBJ_NMBRE AS OBJETO,
        O.ID_OBJ AS ID_OBJ,
        IF(O.OBJ_CANT > 0, 'In Stock', 'No Stock') AS 'STOCK',
        U.USR_APODO AS VENDEDOR,
        O.OBJ_PRECIO AS PRECIO,
        O.OBJ_DESC AS DESCRIPCION
    FROM OBJETOS AS O
    JOIN MULTIMEDIA AS M
    ON O.ID_OBJ = M.ID_OBJ
    JOIN USUARIOS AS U ON U.USR_CORREO = O.OBJ_VEND;
