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
        O.OBJ_ST AS ESTADO,
        O.OBJ_COT AS COTIZAR
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
        IF(O.OBJ_COT = b'1', 'Cotizar', O.OBJ_PRECIO) AS 'PRECIO',
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
        IF(O.OBJ_COT = b'1', 'Cotizar', O.OBJ_PRECIO) AS 'PRECIO',
        O.OBJ_DESC AS DESCRIPCION
    FROM OBJETOS AS O
    JOIN MULTIMEDIA AS M
    ON O.ID_OBJ = M.ID_OBJ
    JOIN USUARIOS AS U ON U.USR_CORREO = O.OBJ_VEND;

USE MERCADONA_DB;
DROP VIEW IF EXISTS VW_LISTAS;
CREATE VIEW VW_LISTAS AS
    SELECT 
        L.DL_IMGN AS PORTADA,
        L.ID_LISTA AS LISTA, 
        IF(L.DL_PRIV = b'1', 'Public List', 'Private List') AS PRIVACIDAD, 
        L.DL_NOMBRE AS NOMBRE, 
        L.DL_DESC AS DESCRIPCION, 
        U.USR_APODO AS AUTOR 
        FROM D_LISTAS AS L 
        JOIN USUARIOS AS U ON U.USR_CORREO = L.DL_USR;

USE MERCADONA_DB;
DROP VIEW IF EXISTS VW_LISTA_OBJETOS;
CREATE VIEW VW_LISTA_OBJETOS AS
    SELECT
        O.PORTADA AS PORTADA,
        O.TITULO AS TITULO,
        IF(O.COTIZAR = b'1', 'Cotizar', O.PRECIO) AS 'PRECIO',
        O.OBJETO AS OBJETO,
        L.ID_LISTA AS LISTA
    FROM VW_PORTADA_OBJETO AS O 
    JOIN D_LISTAS_DETALLE AS L 
    ON L.ID_OBJETO = O.OBJETO;


#el precio por la cantidad para el total por producto, luego generar el gran total 
USE MERCADONA_DB;
DROP VIEW IF EXISTS VW_CARRITO_DETALLE;
CREATE VIEW VW_CARRITO_DETALLE AS
    SELECT 
        C.CARR_USR AS USUARIO,
        CD.ID_OBJETO AS OBJETO,
        C.ID_CARRITO AS CARRITO, 
        O.OBJETO AS NOMBRE, 
        O.CATEGORIA AS CATEGORIA, 
        O.PRECIO AS PRECIO, 
        CD.ALTA AS FECHA, 
        CD.CARR_CANT AS CANTIDAD 
    FROM CARRITO_COMPRAS_DETALLE AS CD 
    JOIN CARRITO_COMPRAS AS C ON C.ID_CARRITO = CD.ID_CARRITO 
    JOIN VW_OBJETO_CATEGORIA AS O ON O.ID_OBJETO = CD.ID_OBJETO 
    GROUP BY CD.ID_CARRITO, CD.ID_OBJETO
    UNION
    SELECT 
        C.CARR_USR AS USUARIO,
        CD.ID_OBJETO AS OBJETO,
        C.ID_CARRITO AS CARRITO, 
        O.OBJETO AS NOMBRE, 
        O.CATEGORIA AS CATEGORIA, 
        IF(O.PRECIO = 'Cotizar', CT.PORCENTAJE,(O.PRECIO * CD.CARR_CANT)) AS PRECIO, 
        CD.ALTA AS FECHA, 
        IF(O.PRECIO = 'Cotizar', CT.CANTIDAD, CD.CARR_CANT) AS CANTIDAD 
    FROM CARRITO_COMPRAS_DETALLE AS CD 
    JOIN CARRITO_COMPRAS AS C ON C.ID_CARRITO = CD.ID_CARRITO 
    JOIN VW_OBJETO_CATEGORIA AS O ON O.ID_OBJETO = CD.ID_OBJETO 
    JOIN COTIZACIONES AS CT ON CD.ID_OBJETO = CT.OBJ AND C.CARR_USR = CT.USUARIO
    GROUP BY CD.ID_CARRITO, CD.ID_OBJETO;


USE MERCADONA_DB;
DROP VIEW IF EXISTS REPORTE_VENTA_DETALLE;
CREATE VIEW REPORTE_VENTA_DETALLE AS
    SELECT
        V.VEN_FECH AS FECHA_VENTA,
        O.CATEGORIA AS CATEGORIA,
        O.OBJETO AS PRODUCTO,
        VD.VEN_CALIF AS CALIFICACION,
        VD.PRECIO AS PRECIO,
        O.CANTIDAD AS EXISTENCIA,
        VD.ID_VEND AS VENDEDOR,
        V.ID_VENTA AS VENTA,
        O.ID_OBJETO AS OBJETO
    FROM VENTAS AS V
    JOIN VENTAS_DETALLE AS VD ON VD.ID_VENTA = V.ID_VENTA
    JOIN VW_OBJETO_CATEGORIA AS O ON VD.ID_OBJ = O.ID_OBJETO
    GROUP BY V.ID_VENTA, O.ID_OBJETO;