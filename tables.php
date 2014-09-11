<?php
	$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die("Connection Failed");
	}
	mysql_query("Create database medical_inventory");
	mysql_query("use medical_inventory");
	mysql_query("Create table login(username varchar(20) NOT NULL,password varchar(30) NOT NULL,PRIMARY KEY(username,password))");
	mysql_query("Create table managed(MID int NOT NULL,Fname varchar(10),Mname varchar(10),Lname varchar(10),DOB date,SSID int NOT NULL,Sname varchar(10),Streetname varchar(20),No_of_Employee int,PRIMARY KEY(MID,SSID))");
	mysql_query("Create table store(SID int NOT NULL,Name varchar(10),No_of_Employee int,Streetname varchar(10),PRIMARY KEY(SID))");
	mysql_query("Create table storelocation(SID int NOT NULL,StoreLocation varchar(20),PRIMARY KEY(SID,StoreLocation))");
	mysql_query("Create table medicines(Batchno int NOT NULL,Name varchar(10) NOT NULL,Price int(5),ExpiryDate date,PRIMARY KEY(Batchno,Name))");
	mysql_query("Create table medicinecategory(Batchno int NOT NULL,Name varchar(10) NOT NULL,Category varchar(10) NOT NULL,PRIMARY KEY(Batchno,Name,Category))");
	mysql_query("Create  table customer(CID int NOT NULL,Fname varchar(10),Mname varchar(10),Lname varchar(10),Age int,Sex char(2),Qty int,Date date,Medname varchar(10),MedBatchno int,PRIMARY KEY(CID))");
	mysql_query("Create table vendors(ID varchar(10) NOT NULL,Name varchar(10),Area varchar(10),Sex char(2),Medname varchar(10),MedBatchno int,Date date,Primary key(ID))");
	mysql_query("CREATE TABLE company(ID VARCHAR(10) NOT NULL, Name VARCHAR(20), Location VARCHAR(20),MedicineName VARCHAR(10),Batchno int,Date date,PRIMARY KEY(ID));");
?>