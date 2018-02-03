/* Create Tables 
 * Created by Junhao Liao on 2 Feb, 2018
 * Last Modified by Junhao Liao on 2 Feb, 2018
 */

/* Users Table */
CREATE TABLE Users (
    UserID INT NOT NULL AUTO_INCREMENT,
    UserName VARCHAR(12) NOT NULL,
    Password VARCHAR(20) NOT NULL,
    Email VARCHAR(50),
    F_Name VARCHAR(20),
    L_Name VARCHAR(20),
    Phone VARCHAR(50),
    IsCustomer BOOLEAN,
    IsSeller BOOLEAN,
    PRIMARY KEY (UserID)
);

/* Customers Table */
CREATE TABLE Customers (
	UserID INT NOT NULL,
	State VARCHAR(50),
	City VARCHAR(50),
	Street VARCHAR(50),
	PostalCode VARCHAR(50),
	PRIMARY KEY (UserID),
	CONSTRAINT FK_Customers_Users FOREIGN KEY (UserID)
	REFERENCES Users(UserID)
);

/* Sellers Table */
CREATE TABLE Sellers (
	UserID INT NOT NULL,
	PRIMARY KEY (UserID),
	CONSTRAINT FK_Sellers_Users FOREIGN KEY (UserID)
	REFERENCES Users(UserID)
);

/* Movies Table */
CREATE TABLE Movies (
	MovieID INT NOT NULL AUTO_INCREMENT,
	MovieName VARCHAR(50) NOT NULL,
	Year YEAR(4),
	Duration TIME,
	Studio VARCHAR(50),
	Description TEXT,
	IsRent BOOLEAN,
	IsSell BOOLEAN,
	IsDownload BOOLEAN,
	PRIMARY KEY (MovieID)
);

/* Orders Table */
CREATE TABLE Orders (
	OrderID INT NOT NULL AUTO_INCREMENT,
	UserID INT NOT NULL,
	OrderDate DATETIME,
	TotalPrice DOUBLE,
	Payment VARCHAR(20),
	PRIMARY KEY (OrderID),
	CONSTRAINT FK_Orders_Customers FOREIGN KEY (UserID)
	REFERENCES Customers(UserID)
);

/* OrderMovie Table */
CREATE TABLE OrderMovie (
	OrderID INT NOT NULL,
	MovieID INT NOT NULL,
	PRIMARY KEY (OrderID, MovieID),
	CONSTRAINT FK_OrderMovie_Orders FOREIGN KEY (OrderID)
	REFERENCES Orders(OrderID),
	CONSTRAINT FK_OrderMovie_Movies FOREIGN KEY (MovieID)
	REFERENCES Movies(MovieID)
);

/* Carts Table */
CREATE TABLE Carts (
	CartID INT NOT NULL AUTO_INCREMENT,
	UserID INT NOT NULL,
	MovieID INT NOT NULL,
	PRIMARY KEY (CartID),
	CONSTRAINT FK_Carts_Customers FOREIGN KEY (UserID)
	REFERENCES Customers (UserID),
	CONSTRAINT FK_Carts_Movies FOREIGN KEY (MovieID)
	REFERENCES Movies (MovieID)
);

/* Genres Table */
CREATE TABLE Genres (
	GenreID INT NOT NULL AUTO_INCREMENT,
	GenreName VARCHAR(20),
	PRIMARY KEY (GenreID)
);

/* MovieGenre Table */
CREATE TABLE MovieGenre (
	MovieID INT NOT NULL,
	GenreID INT NOT NULL,
	PRIMARY KEY (MovieID, GenreID),
	CONSTRAINT FK_MovieGenre_Movies FOREIGN KEY (MovieID)
	REFERENCES Movies (MovieID),
	CONSTRAINT FK_MovieGenre_Genres FOREIGN KEY (GenreID)
	REFERENCES Genres (GenreID)
);

/* Casts Table */
CREATE TABLE Casts (
	CastID INT NOT NULL AUTO_INCREMENT,
	Cast_F_Name VARCHAR(20),
	Cast_L_Name VARCHAR(20),
	IsDirector BOOLEAN,
	IsWriter BOOLEAN,
	PRIMARY KEY (CastID)
);

/* MovieCast Table */
CREATE TABLE MovieCast (
	MovieID INT NOT NULL,
	CastID INT NOT NULL,
	PRIMARY KEY (MovieID, CastID),
	CONSTRAINT FK_MovieCast_Movies FOREIGN KEY (MovieID)
	REFERENCES Movies (MovieID),
	CONSTRAINT FK_MovieCast_Casts FOREIGN KEY (CastID)
	REFERENCES Casts (CastID)
);

/* Subtitles Table */
CREATE TABLE Subtitles (
	SubID INT NOT NULL AUTO_INCREMENT,
	SubName VARCHAR(20) NOT NULL,
	Description TEXT,
	PRIMARY KEY (SubID)
);

/* MovieSubtitle Table */
CREATE TABLE MovieSubtitle (
	MovieID INT NOT NULL,
	SubID INT NOT NULL,
	PRIMARY KEY (MovieID, SubID),
	CONSTRAINT FK_MovieSubtitle_Movies FOREIGN KEY (MovieID)
	REFERENCES Movies (MovieID),
	CONSTRAINT FK_MovieSubtitle_Subtitles FOREIGN KEY (SubID)
	REFERENCES Subtitles (SubID)
);

/* ForRent Table */
CREATE TABLE ForRent (
	MovieID INT NOT NULL,
	Qty_On_Hand INT NOT NULL,
	PRIMARY KEY (MovieID),
	CONSTRAINT FK_ForRent_Movies FOREIGN KEY (MovieID)
	REFERENCES Movies (MovieID)
);

/* ForSell Table */
CREATE TABLE ForSell (
	MovieID INT NOT NULL,
	Qty_On_Hand INT NOT NULL,
	PRIMARY KEY (MovieID),
	CONSTRAINT FK_ForSell_Movies FOREIGN KEY (MovieID)
	REFERENCES Movies (MovieID)
);

/* ForDownload Table */
CREATE TABLE ForDownload (
	MovieID INT NOT NULL,
	FileSize VARCHAR(20),
	PRIMARY KEY (MovieID),
	CONSTRAINT FK_ForDownload_Movies FOREIGN KEY (MovieID)
	REFERENCES Movies (MovieID)
);

/* Advertisements Table */
CREATE TABLE Advertisements (
	AdsID INT NOT NULL AUTO_INCREMENT,
	MovieID INT NOT NULL,
	AdsText VARCHAR(50),
	Picture VARCHAR(100),
	PRIMARY KEY (AdsID),
	CONSTRAINT FK_Advertisements_Movies FOREIGN KEY (MovieID)
	REFERENCES Movies (MovieID)
);