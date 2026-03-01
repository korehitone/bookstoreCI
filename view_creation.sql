CREATE VIEW view_cart_item AS SELECT ci.id, ci.cart_id, ci.book_id, b.title, b.author, b.img_url, ci.quantity, SUM(ci.quantity*b.price) as total_price, ci.created_at, ci.updated_at FROM cart_item ci JOIN book b ON ci.book_id = b.id GROUP BY ci.id

CREATE VIEW view_cart AS SELECT c.id, c.customer_id, COUNT(*) as total_item, SUM(vci.total_price) as total, c.created_at, c.updated_at FROM cart c JOIN view_cart_item vci ON c.id = vci.cart_id GROUP BY c.id


-- store procedure buat admin log
DELIMITER $$
CREATE PROCEDURE InsertAdminLog(
    IN p_admin_id INT,
    IN p_admin_username VARCHAR(50),
    IN p_admin_email VARCHAR(64),
    IN p_action VARCHAR(50),
    IN p_table_name VARCHAR(50),
    IN p_record_id INT,
    IN p_details TEXT
)
BEGIN
    INSERT INTO admin_log (admin_id, username, email, action, table_name, record_id, details, created_at)
    VALUES (p_admin_id,  p_admin_username,  p_admin_email, p_action, p_table_name, p_record_id, p_details, NOW());
END$$
DELIMITER ;

-- category trigger

DELIMITER $$
CREATE TRIGGER category_after_insert
AFTER INSERT ON category
FOR EACH ROW
BEGIN
    CALL InsertAdminLog(
        @admin_id,
        @admin_username,
        @admin_email,
        'INSERT',
        'category',
        NEW.id,
        CONCAT('Added category: ', NEW.name)
    );
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER category_after_update
AFTER UPDATE ON category
FOR EACH ROW
BEGIN
    IF OLD.name != NEW.name THEN
        CALL InsertAdminLog(
            @admin_id,
            @admin_username,
            @admin_email,
            'UPDATE',
            'category',
            NEW.id,
            CONCAT('Category renamed from "', OLD.name, '" to "', NEW.name, '"')
        );
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER category_before_delete
BEFORE DELETE ON category
FOR EACH ROW
BEGIN
    CALL InsertAdminLog(
        @admin_id,
        @admin_username,
        @admin_email,
        'DELETE',
        'category',
        OLD.id,
        CONCAT('Deleted category: ', OLD.name)
    );
END$$
DELIMITER ;


-- book trigger

DELIMITER $$
CREATE TRIGGER book_after_insert
AFTER INSERT ON book
FOR EACH ROW
BEGIN
    CALL InsertAdminLog(
        @admin_id,
        @admin_username,
        @admin_email,
        'INSERT',
        'book',
        NEW.id,
        CONCAT('Added book: ', NEW.title, ' by ', NEW.author)
    );
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER book_after_update
AFTER UPDATE ON book
FOR EACH ROW
BEGIN
    DECLARE changes TEXT DEFAULT '';
    
    IF OLD.title != NEW.title THEN
        SET changes = CONCAT(changes, 'Title: "', OLD.title, '" → "', NEW.title, '" | ');
    END IF;
    
    IF OLD.author != NEW.author THEN
        SET changes = CONCAT(changes, 'Author: "', OLD.author, '" → "', NEW.author, '" | ');
    END IF;
    
    IF OLD.price != NEW.price THEN
        SET changes = CONCAT(changes, 'Price: ', OLD.price, ' → ', NEW.price, ' | ');
    END IF;
    
    IF OLD.category_id != NEW.category_id THEN
        SET changes = CONCAT(changes, 'Category ID: ', OLD.category_id, ' → ', NEW.category_id, ' | ');
    END IF;
    
    IF changes != '' THEN
        CALL InsertAdminLog(
            @admin_id,
            @admin_username,
            @admin_email,
            'UPDATE',
            'book',
            NEW.id,
            CONCAT('Updated book "', NEW.title, '": ', changes)
        );
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER book_before_delete
BEFORE DELETE ON book
FOR EACH ROW
BEGIN
    CALL InsertAdminLog(
        @admin_id,
        @admin_username,
        @admin_email,
        'DELETE',
        'book',
        OLD.id,
        CONCAT('Deleted book: ', OLD.title, ' by ', OLD.author)
    );
END$$
DELIMITER ;