CREATE OR REPLACE PROCEDURE SYSTEM.user_login(u_id1 IN VARCHAR,pw1 IN VARCHAR,isvalid OUT CHAR)
AS
    number_of_row NUMERIC ;
BEGIN
    SELECT COUNT(*) INTO number_of_row FROM PERSON WHERE u_id = u_id1 AND pw = pw1;

    IF number_of_row = 1 THEN
        isvalid := '1';
    ELSE
        isvalid := '0';
        
    END IF;
END;