use psxng3;

/*
Stored Function
Question 1 - Login and Change Password
 - Change Password
 - Check Password 
 -CheckAdmin 
 
Question 2 - Login 
 - CheckName 
 - CheckDL
 

Question 3
-sp_VehicleLicenceSearch - Type vehicle name and comes up with details
 
 
 - CreateIncidentReport
 - EditIncidentReport
 
 Stored Procedures
 -
 Question 4
 
 
 
 Question 5
 
 
 
 Question 6
 - AddPoliceUser 
 -sp_AddFines
 
*/
DROP FUNCTION IF EXISTS CheckPassword;
DELIMITER $$
CREATE FUNCTION CheckPassword (username VARCHAR(10), userpassword VARCHAR(15))
    RETURNS INT
    NOT DETERMINISTIC
    READS SQL DATA
BEGIN
     
    IF NOT EXISTS (SELECT PoliceUser_username FROM PoliceUser WHERE PoliceUser_username = username AND PoliceUser_password  = userpassword) THEN
    RETURN -1;
    END IF;
    
    SELECT PoliceUser_admin into @UserType FROM PoliceUser WHERE PoliceUser_username = username AND PoliceUser_password  = userpassword; 
    
    IF  @UserType  = 1 THEN 
		RETURN 1;
    ELSE 
		RETURN 0;
	END IF;
    
END;
$$
DELIMITER ;
SELECT CheckPassword('Daniels','copper99') checkpassword;
SELECT * FROM PoliceUser;

DROP FUNCTION IF EXISTS CheckName;
Delimiter $$
CREATE FUNCTION CheckName(firstname VARCHAR(12),lastname VARCHAR(12))
RETURNS BOOL
NOT DETERMINISTIC
READS SQL DATA
BEGIN
RETURN EXISTS(SELECT * FROM People WHERE People_Firstname LIKE firstname OR People_Lastname LIKE lastname);
END;
$$
DELIMITER ;

SELECT CheckName("john","mith");
SELECT * FROM PoliceUser;

DROP FUNCTION IF EXISTS CheckDL;
Delimiter $$
CREATE FUNCTION CheckDL(license VARCHAR(16))
RETURNS BOOL
NOT DETERMINISTIC
READS SQL DATA
BEGIN
RETURN EXISTS(SELECT * FROM People WHERE People_licence LIKE license);
END;
$$
DELIMITER ;
SELECT CheckDL('SMITH92LDOFJJ829');

DROP FUNCTION IF EXISTS CheckAdmin;
DELIMITER $$
CREATE FUNCTION CheckAdmin (username VARCHAR(10), userpassword VARCHAR(15))
    RETURNS BOOL
    NOT DETERMINISTIC
    READS SQL DATA
BEGIN
    RETURN EXISTS (SELECT PoliceUser_admin FROM PoliceUser WHERE PoliceUser_username = username AND PoliceUser_password  = userpassword);
END;
$$
DELIMITER ;
SELECT CheckAdmin('Daniels','copper99');

DROP PROCEDURE IF EXISTS sp_CheckNameCheckDLSearch;
DELIMITER $$
CREATE PROCEDURE sp_CheckNameCheckDLSearch(IN firstname VARCHAR(50),IN lastname VARCHAR(50), IN licence VARCHAR(16))
BEGIN
IF (firstname <> '' AND lastname = '') THEN 
		SELECT * FROM People WHERE (People_Firstname LIKE firstname)  ; # Confirm New password, error message for passwords do not match 
ELSEIF (firstname = '' AND lastname <> '') THEN 
		SELECT * FROM People WHERE (People_Lastname LIKE lastname)  ;
ELSEIF firstname <> '' AND lastname <> '' THEN
	    SELECT * FROM People WHERE (People_Firstname LIKE firstname)  AND (People_Lastname LIKE lastname);
ELSEIF licence <> '' THEN  
     SELECT * FROM People WHERE People_licence = licence ;
END IF;



END $$
DELIMITER;


# need to do an XNOR
CALL sp_CheckNameCheckDLSearch('','','ALLEN88K23KLR9B3')

DROP PROCEDURE IF EXISTS sp_CheckDLSearch;
DELIMITER $$
CREATE PROCEDURE sp_CheckDLSearch(IN license VARCHAR(16))
BEGIN
SELECT * FROM People WHERE People_licence LIKE license; 



END $$
DELIMITER;

CALL sp_CheckDLSearch('MEDORH914ANBB223');





DROP FUNCTION IF EXISTS ChangePassword;
Delimiter $$
CREATE FUNCTION ChangePassword(username VARCHAR(10),Oldpassword VARCHAR(15),Newpassword VARCHAR(15),NewpasswordCheck VARCHAR(15))
RETURNS INT
NOT DETERMINISTIC
READS SQL DATA
BEGIN
	IF Newpassword <> NewpasswordCheck THEN 
		Return 1; # Confirm New password, error message for passwords do not match 
	END IF;
	IF EXISTS(SELECT * FROM PoliceUser WHERE PoliceUser_username = username AND PoliceUser_password = Oldpassword) THEN
		UPDATE PoliceUser SET PoliceUser_password = Newpassword WHERE PoliceUser_username = username;
        Return 0; # Password changed
	else
		RETURN 2; # Password does not match old password so do an error message
	END IF;
END;
$$
DELIMITER ;
SELECT ChangePassword('psxng3','psxng3','psxng3','psxng3');

SET SQL_SAFE_UPDATES = 0;


DROP PROCEDURE IF EXISTS sp_VehicleLicenceSearch;
DELIMITER $$
CREATE PROCEDURE sp_VehicleLicenceSearch(IN vehicleLicence VARCHAR(7))
BEGIN
SELECT People_Firstname AS 'First Name', People_Lastname AS 'Last Name', People_licence AS 'Driving Licence', Vehicle_type AS 'Vehicle Type', Vehicle_colour AS 'Vehicle Colour'
FROM Vehicle LEFT JOIN Incident ON Vehicle.Vehicle_ID = Incident.Vehicle_ID LEFT JOIN People ON People.People_ID = Incident.People_ID/*LEFT JOIN Incident USING(Vehicle_ID) = (Incident_ID)*/

WHERE Vehicle_licence = vehicleLicence; 



END $$
DELIMITER;


CALL sp_VehicleLicenceSearch('NY64KWD');

SELECT * FROM Incident;
SELECT * FROM People;
SELECT * FROM Vehicle;
SELECT * FROM PoliceUser;
SELECT * FROM Ownership;
SELECT * FROM Offence;
select * from Fines
SELECT Incident.Incident_ID, People.People_Firstname, People.People_Lastname, Incident.Incident_Date, Incident.Incident_Report, Offence.Offence_ID, Offence_description FROM Incident LEFT JOIN People ON Incident.People_ID = People.People_ID LEFT JOIN Offence ON Offence.Offence_ID = Incident.Offence_ID


/* People_ID INT(11) NOT NULL,
    People_Firstname VARCHAR(50) NOT NULL,
    People_Lastname VARCHAR(50) NOT NULL,
    People_address VARCHAR(50) DEFAULT NULL,
    People_licence VARCHAR(16) DEFAULT NULL */


DROP FUNCTION IF EXISTS AddNewPerson;
Delimiter $$
CREATE FUNCTION AddNewPerson(fname VARCHAR(50),lname VARCHAR(50),address VARCHAR(50),licence VARCHAR(16))
RETURNS Bool
NOT DETERMINISTIC
READS SQL DATA

BEGIN

	declare newid int;

	declare exit handler for sqlexception
	begin
	  return 0;
	end;
    
  

	INSERT INTO People (People_Firstname,People_Lastname,People_address, People_licence) VALUES
    (fname ,lname , address , licence);
    
     SELECT  LAST_INSERT_ID() into newid;
     
    
    return newid;
	
END;
$$
# button for adding new owner and button for attatching existing owner 
# ID or driving licence for existing owner 
# Either Select all using the same procedure for the check name function and select that - take person ID or Drving licence from that row

SELECT AddNewPerson('Che','Castro','4 Radford Road, Nottingham','GILB007G167213GH');

DROP FUNCTION IF EXISTS EnterVehicleDetails;
Delimiter $$
CREATE FUNCTION EnterVehicleDetails(username VARCHAR(10),Oldpassword VARCHAR(15),Newpassword VARCHAR(15),NewpasswordCheck VARCHAR(15))
RETURNS INT
NOT DETERMINISTIC
READS SQL DATA
BEGIN
	IF Newpassword <> NewpasswordCheck THEN 
		Return 1; # Confirm New password, error message for passwords do not match 
	END IF;
	IF EXISTS(SELECT * FROM PoliceUser WHERE PoliceUser_username = username AND PoliceUser_password = Oldpassword) THEN
		UPDATE PoliceUser SET PoliceUser_password = Newpassword WHERE PoliceUser_username = username;
        Return 0; # Password changed
	else
		RETURN 2; # Password does not match old password so do an error message
	END IF;
END;
$$
DELIMITER ;

# Still needs doing





DROP PROCEDURE IF EXISTS sp_SearchIncident;
DELIMITER $$
CREATE PROCEDURE sp_SearchIncident(IN IncidentID INT(11),IN OffenceID INT(11))
BEGIN
SELECT Incident_ID, Vehicle_ID,People_ID, Offence_ID FROM Incident WHERE Incident_ID = IncidentID or Offence_ID = OffenceID;




END $$
DELIMITER;

SELECT * FROM Incident;
SELECT * FROM People;
SELECT * FROM Vehicle;

# need to do an XNOR
CALL sp_SearchIncident('','1');





   

DROP FUNCTION IF EXISTS CreateIncidentReport;
Delimiter $$
CREATE FUNCTION CreateIncidentReport(VehicleID VARCHAR(11),PeopleID VARCHAR(11),IncidentDate VARCHAR(10),IncidentReport VARCHAR(500),OffenceID VARCHAR(11))
RETURNS Bool
NOT DETERMINISTIC
READS SQL DATA

BEGIN

	declare newid int;

	declare exit handler for sqlexception
	begin
	  return 0;
	end;
    
  

	INSERT INTO Incident (Vehicle_ID,People_ID,Incident_Date, Incident_Report, Offence_ID) VALUES
    (VehicleID ,PeopleID ,IncidentDate ,IncidentReport ,OffenceID );
         return Incident_ID;
    
     
     
    
   
	
END;
$$
# Return auto generated ID

SELECT CreateIncidentReport('psxng3','checastro','password','password12');

DROP FUNCTION IF EXISTS EditIncidentReport;
Delimiter $$
CREATE FUNCTION EditIncidentReport(incidentID INT(11),vehicleID INT(11),peopleID INT(11),incidentd INT(11),incidentr INT(11),offenceID INT(11))
RETURNS Bool
NOT DETERMINISTIC
READS SQL DATA

BEGIN

	declare exit handler for sqlexception
	begin
	  return 0;
	end;

	INSERT INTO Incident (Incident_ID, Vehicle_ID, People_ID, Incident_Date, Incident_Report, Offence_ID) VALUES
    (incidentID , vehicleID ,peopleID ,incidentd ,incidentr ,offenceID );
    return 1;
	
END;
$$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_EditIncidentReport;
DELIMITER $$
CREATE PROCEDURE sp_VehicleLicenceSearch(IN vehicleLicence VARCHAR(7))
BEGIN
SELECT People_Firstname AS 'First Name', People_Lastname AS 'Last Name', People_licence AS 'Driving Licence', Vehicle_type AS 'Vehicle Type', Vehicle_colour AS 'Vehicle Colour'
FROM Vehicle LEFT JOIN Incident ON Vehicle.Vehicle_ID = Incident.Vehicle_ID LEFT JOIN People ON People.People_ID = Incident.People_ID/*LEFT JOIN Incident USING(Vehicle_ID) = (Incident_ID)*/

WHERE Vehicle_licence = vehicleLicence; 



END $$
DELIMITER;

# Select existing one
# Create Incident report
# Get incident details - Stored Procedure needed to get incident details
# Edit it - Use Get incident details  and populate table
# Function to update incident details

/* SELECT                 */

SELECT * FROM Incident;
SELECT * FROM People;
SELECT * FROM Vehicle;
SELECT People_Firstname AS 'First Name', People_Lastname AS 'Last Name', People_licence AS 'Driving Licence', Vehicle_type AS 'Vehicle Type', Vehicle_colour AS 'Vehicle Colour'
FROM Vehicle LEFT JOIN Incident ON Vehicle.Vehicle_ID = Incident.Vehicle_ID LEFT JOIN People ON People.People_ID = Incident.People_ID;




DROP FUNCTION IF EXISTS AddPoliceUser;
Delimiter $$
CREATE FUNCTION AddPoliceUser(username VARCHAR(10),fname VARCHAR(50),lname VARCHAR(50),address VARCHAR(50),newpassword VARCHAR(15),admin TINYINT(1))
RETURNS Bool
NOT DETERMINISTIC
READS SQL DATA

BEGIN

	declare exit handler for sqlexception
	begin
	  return 0;
	end;

	INSERT INTO PoliceUser (PoliceUser_username, PoliceUser_Firstname, PoliceUser_Lastname, PoliceUser_address, PoliceUser_password, PoliceUser_admin ) VALUES
    (username , fname ,lname , address ,newpassword ,admin );
    return 1;
	
END;
$$
#DELIMITER ;
SELECT AddPoliceUser('MrsGhost','Angela','Valdez','23  Midlands Cottage,Nottingham,United Kingdom','password','0');
SELECT * FROM Fines;

SELECT * FROM People LEFT JOIN Fines ON People_ID = Fine_ID;


DROP PROCEDURE IF EXISTS sp_AddFines;
Delimiter $$
CREATE PROCEDURE sp_AddFines(FineAmount INT(11),FinePoints INT(11), IncidentID INT(11))

BEGIN

	declare exit handler for sqlexception
	begin
	  
	end;
    INSERT INTO Fines (Fine_Amount, Fine_Points,Incident_ID) VALUES
    (FineAmount,FinePoints,IncidentID);
     SELECT People_ID AS 'People ID', People_Firstname AS 'First name', People_Lastname AS 'Last name',People_licence AS 'Driving Licence',Fine_Amount AS 'Fine Amount',Fine_Points AS 'Fine Points' FROM People LEFT JOIN Fines ON Incident.People_ID = Fines.Fine_ID 
     WHERE People_Firstname LIKE fname OR People_Lastname LIKE lname AND People_licence = licence; 
    
	
END;
$$
DELIMITER ;
CALL sp_AddFines('Xene','','MEDORH914ANBB223','500','3');


DROP FUNCTION IF EXISTS AddFines;
Delimiter $$
CREATE FUNCTION AddFines(FineAmount INT(11),FinePoints INT(11), IncidentID INT(11))
RETURNS int(11)
NOT DETERMINISTIC
READS SQL DATA

BEGIN


  declare exit handler for sqlexception
  begin
    return 0;
  end;


	SELECT   Offence_ID into @offence_id FROM Incident WHERE Incident_ID = IncidentID;
    
	SELECT  Offence_maxFine, Offence_maxPoints into @maxFine, @maxPoints FROM Offence WHERE Offence_ID =  @offence_id;
    
    IF FineAmount > @maxFine THEN
		return -1;
	END IF;
    
    IF FinePoints > @maxPoints THEN
		return -2;
	END IF;
    
	INSERT INTO Fines (Fine_Amount, Fine_Points,Incident_ID) VALUES (FineAmount,FinePoints,IncidentID);
    return 1;
	
END;
$$



DROP PROCEDURE IF EXISTS sp_VehicleSearch;
DELIMITER $$
CREATE PROCEDURE sp_VehicleSearch(IN vehicleLicence VARCHAR(7))
BEGIN

SELECT * FROM Vehicle WHERE Vehicle_licence LIKE CONCAT (vehicleLicence, '%'); 



END; 
$$
DELIMITER;

call sp_VehicleSearch('FD65')


SELECT Offence_maxFine,Offence_maxPoints  FROM Offence WHERE Offence_ID =  11;

SELECT maxFine,  maxPoints FROM Offence WHERE Offence_ID whwew 
L
SELECT AddFines (5,60000,2)

--delete from Offence where Offence_ID = 11
select * from Fines
select * from Vehicle

SELECT * FROM Incident where Incident_ID = 2

select * from Offence where Offence_ID = 4

SELECT * FROM People LEFT JOIN Incident ON People.People_ID = Incident.People_ID LEFT JOIN Fines ON Fines.Incident_ID = Incident.Incident_ID WHERE Fines.Incident_ID > 0 GROUP BY Incident.Incident_ID;

SELECT People_ID, People_Firstname, People_Lastname,People_licence,Fine_Amount,Fine_Points  FROM People LEFT JOIN Fines ON People_ID = Fine_ID WHERE People_Firstname LIKE firstname OR People_Lastname LIKE lastname AND People_licence LIKE Licence;

SELECT * FROM Fines;
SELECT * FROM Fines;
SELECT * FROM Incident where Incident_ID = 2
SELECT * FROM Offence;

SELECT * FROM People LEFT JOIN Incident ON People.People_ID = Incident.People_ID LEFT JOIN Fines ON Fines.Fine_ID WHERE Incident.Incident_ID > 0 GROUP BY Incident.Incident_ID


# Search for Offences and incident ;
# Select the offence for incident I want to give a fine to;
# Take the incident ID and the type of fine I want to add then I'll add it to the Fines;
# parameters Incident ID, Fines ID from last 2 functions , and Amount and Points  Insert that into that table;


SELECT * FROM Vehicle;


DROP FUNCTION IF EXISTS AddNewVehicle;
Delimiter $$
CREATE FUNCTION AddNewVehicle(Vlicence VARCHAR(7),Vtype VARCHAR(20),Vcolour VARCHAR(20),PeopleID INT(11))
RETURNS Bool
NOT DETERMINISTIC
READS SQL DATA

BEGIN

	declare newid int;

	declare exit handler for sqlexception
	begin
	  return 0;
	end;
    
     
	INSERT INTO Vehicle (Vehicle_licence, Vehicle_type, Vehicle_colour ) VALUES
    (Vlicence ,Vtype ,Vcolour);
    
    SELECT  LAST_INSERT_ID() into newid;
    INSERT INTO Ownership(People_ID, Vehicle_ID) VALUES (PeopleID,newid);
    
    
    return newid;
	
END;
$$
#DELIMITER ;
SELECT AddNewVehicle('TRZ2084','Mercedes Benz','Grey',4);

SELECT * FROM Vehicle;

SELECT * FROM Ownership;

SELECT * FROM Offence;
SELECT * FROM Fines;
SELECT * FROM Incident;


