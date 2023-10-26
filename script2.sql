-- Changing databases
USE assign2db; 

-- Part 1 SQL Updates
SELECT * FROM hospital;

UPDATE hospital SET headdoc="GD56", headdocstartdate="2010-12-19" WHERE hoscode="BBC";
UPDATE hospital SET headdoc="SE66", headdocstartdate="2004-05-30" WHERE hoscode="ABC";
UPDATE hospital SET headdoc="YT67", headdocstartdate="2001-06-01" WHERE hoscode="DDE";

SELECT * FROM hospital;

-- Part 2 SQL Inserts
INSERT INTO doctor (licensenum, firstname, lastname, licensedate, birthdate, hosworksat, speciality) 
VALUES ('BB99', 'Daniel', 'Oh', '2006-08-26', '1978-12-31', 'ABC', 'Neurologist');

INSERT INTO patient (ohipnum, firstname, lastname, birthdate) VALUES ('604445246', 'Jennifer', 'Connelly', '1970-12-12');

INSERT INTO looksafter (licensenum, ohipnum) VALUES ('BB99', '604445246');

INSERT INTO hospital (hoscode, hosname, city, prov, numofbed, headdoc, headdocstartdate) 
VALUES ('HBR', 'Humber River', 'Toronto', 'ON', '2500', 'BB99', '2022-10-25');

SELECT * FROM doctor;
SELECT * FROM patient;
SELECT * FROM looksafter;
SELECT * FROM hospital;

-- Part 3 SQL Queries
-- Query 1 
SELECT lastname FROM patient;

-- Query 2
SELECT DISTINCT lastname FROM patient;

-- Query 3 
SELECT * FROM doctor ORDER BY lastname ASC;

-- Query 4
SELECT hosname, hoscode FROM hospital WHERE numofbed>1500; 

-- Query 5 
SELECT firstname, lastname FROM doctor, hospital WHERE hoscode=hosworksat AND hosname="St. Joseph";

-- Query 6
SELECT firstname, lastname FROM patient WHERE lastname LIKE 'G%';

-- Query 7
SELECT patient.firstname, patient.lastname FROM patient, doctor, looksafter WHERE doctor.lastname='Webster' AND doctor.licensenum=looksafter.licensenum AND looksafter.ohipnum=patient.ohipnum;

-- Query 8
SELECT hosname, city, doctor.lastname FROM hospital, doctor WHERE licensenum=headdoc;

-- Query 9
SELECT SUM(numofbed) FROM hospital;

-- Query 10
SELECT patient.firstname, patient.lastname, doctor.firstname, doctor.lastname FROM doctor, hospital, patient, looksafter WHERE headdoc=doctor.licensenum AND headdoc=looksafter.licensenum AND looksafter.ohipnum=patient.ohipnum;

-- Query 11
SELECT doctor.lastname, doctor.firstname, hospital.prov FROM doctor, hospital WHERE hosname="Victoria" AND speciality="Surgeon" AND hoscode=hosworksat;

-- Query 12
SELECT DISTINCT firstname FROM doctor, looksafter WHERE doctor.licensenum NOT IN (SELECT licensenum FROM looksafter);

-- Query 13
SELECT doctor.lastname, doctor.firstname, COUNT(looksafter.licensenum) AS 'Number of Patients', hosname FROM looksafter, doctor, hospital WHERE looksafter.licensenum=doctor.licensenum AND hosworksat=hoscode GROUP BY looksafter.licensenum HAVING COUNT(looksafter.licensenum)>1;

-- Query 14 
SELECT doctor.firstname AS 'Doctor First Name', doctor.lastname AS 'Doctor Last Name', hosname AS 'Head of Hospital Name', hosworksat AS 'Works at Hospital Name' FROM doctor, hospital WHERE doctor.licensenum=hospital.headdoc AND hospital.hoscode NOT IN (SELECT hosworksat FROM doctor);

-- Query 15
-- My Query - Display both the first and last names of all patients seeing a neurologist and show which hospital they go to (hoscode). 
SELECT patient.firstname, patient.lastname, hoscode FROM patient, hospital, looksafter, doctor WHERE speciality="Neurologist" AND doctor.licensenum=looksafter.licensenum AND patient.ohipnum=looksafter.ohipnum AND hosworksat=hoscode;

-- Part 4 SQL Views/Deletes
CREATE VIEW myview AS SELECT doctor.firstname AS dfirst, doctor.lastname AS dlast, doctor.birthdate AS dbirth, patient.firstname AS pfirst, patient.lastname AS plast, patient.birthdate AS pbirth FROM doctor, patient, looksafter WHERE doctor.licensenum=looksafter.licensenum AND looksafter.ohipnum=patient.ohipnum;

SELECT * FROM myview;

SELECT dlast, dbirth, plast, pbirth FROM myview WHERE dbirth>pbirth;

SELECT * FROM patient;
SELECT * FROM looksafter;

DELETE FROM patient WHERE firstname="Jennifer" AND lastname="Connelly";

SELECT * FROM patient;
SELECT * FROM looksafter;

SELECT * FROM doctor;
DELETE FROM doctor WHERE firstname="Bernie";
SELECT * FROM doctor;

DELETE FROM doctor WHERE firstname="Daniel" AND lastname="Oh";
-- My new doctor cannot be deleted from the doctor table because he is referenced in the hospital table.
