USE ACMPeyton2;

CREATE TABLE Vehicle (
    VehicleID INT PRIMARY KEY,
    VIN VARCHAR(20) UNIQUE,
    Make VARCHAR(20),
    Model VARCHAR(20),
    Year INT,
    Mileage INT
);

CREATE TABLE Buyer (
    BuyerID INT PRIMARY KEY,
    BuyerName VARCHAR(50),
    Phone VARCHAR(15)
);

CREATE TABLE Seller (
    SellerID INT PRIMARY KEY,
    SellerName VARCHAR(50),
    Phone VARCHAR(15)
);

CREATE TABLE Purchase (
    PurchaseID INT PRIMARY KEY,
    VehicleID INT,
    SellerID INT,
    PurchaseDate DATE,
    PurchasePrice DECIMAL(10,2),
    FOREIGN KEY (VehicleID) REFERENCES Vehicle(VehicleID),
    FOREIGN KEY (SellerID) REFERENCES Seller(SellerID)
);

CREATE TABLE Sale (
    SaleID INT PRIMARY KEY,
    VehicleID INT,
    BuyerID INT,
    SaleDate DATE,
    SalePrice DECIMAL(10,2),
    FOREIGN KEY (VehicleID) REFERENCES Vehicle(VehicleID),
    FOREIGN KEY (BuyerID) REFERENCES Buyer(BuyerID)
);

CREATE TABLE Expense (
    ExpenseID INT PRIMARY KEY,
    VehicleID INT,
    ExpenseType VARCHAR(50),
    Amount DECIMAL(10,2),
    ExpenseDate DATE,
    FOREIGN KEY (VehicleID) REFERENCES Vehicle(VehicleID)
);

INSERT INTO Vehicle VALUES
(1,'VIN001','Audi','S3',2015,90000),
(2,'VIN002','BMW','750i',2008,92000),
(3,'VIN003','Honda','Civic',2018,40000),
(4,'VIN004','Toyota','Camry',2017,60000),
(5,'VIN005','Ford','Mustang',2016,50000),
(6,'VIN006','Chevy','Malibu',2019,30000),
(7,'VIN007','Nissan','Altima',2015,70000),
(8,'VIN008','Hyundai','Elantra',2020,20000),
(9,'VIN009','Kia','Optima',2016,55000),
(10,'VIN010','Mazda','Mazda3',2018,45000);

INSERT INTO Buyer VALUES
(1,'John Smith','111-111-1111'),
(2,'Jane Doe','222-222-2222'),
(3,'Mike Brown','333-333-3333'),
(4,'Sarah Lee','444-444-4444'),
(5,'Chris Green','555-555-5555'),
(6,'Anna White','666-666-6666'),
(7,'David Black','777-777-7777'),
(8,'Emma Stone','888-888-8888'),
(9,'Ryan King','999-999-9999'),
(10,'Olivia Hall','101-101-1010');

INSERT INTO Seller VALUES
(1,'Dealer One','111-000-0000'),
(2,'Dealer Two','222-000-0000'),
(3,'Dealer Three','333-000-0000'),
(4,'Dealer Four','444-000-0000'),
(5,'Dealer Five','555-000-0000'),
(6,'Dealer Six','666-000-0000'),
(7,'Dealer Seven','777-000-0000'),
(8,'Dealer Eight','888-000-0000'),
(9,'Dealer Nine','999-000-0000'),
(10,'Dealer Ten','101-000-0000');

INSERT INTO Purchase VALUES
(1,1,1,'2024-01-01',15000),
(2,2,2,'2024-01-02',12000),
(3,3,3,'2024-01-03',10000),
(4,4,4,'2024-01-04',11000),
(5,5,5,'2024-01-05',13000),
(6,6,6,'2024-01-06',9000),
(7,7,7,'2024-01-07',8000),
(8,8,8,'2024-01-08',14000),
(9,9,9,'2024-01-09',9500),
(10,10,10,'2024-01-10',10500);

INSERT INTO Sale VALUES
(1,1,1,'2024-02-01',18000),
(2,2,2,'2024-02-02',15000),
(3,3,3,'2024-02-03',13000),
(4,4,4,'2024-02-04',14000),
(5,5,5,'2024-02-05',17000),
(6,6,6,'2024-02-06',12000),
(7,7,7,'2024-02-07',11000),
(8,8,8,'2024-02-08',19000),
(9,9,9,'2024-02-09',12500),
(10,10,10,'2024-02-10',13500);

INSERT INTO Expense VALUES
(1,1,'Repair',500,'2024-01-15'),
(2,2,'Cleaning',200,'2024-01-16'),
(3,3,'Repair',300,'2024-01-17'),
(4,4,'Inspection',150,'2024-01-18'),
(5,5,'Repair',400,'2024-01-19'),
(6,6,'Cleaning',100,'2024-01-20'),
(7,7,'Repair',250,'2024-01-21'),
(8,8,'Inspection',180,'2024-01-22'),
(9,9,'Repair',350,'2024-01-23'),
(10,10,'Cleaning',120,'2024-01-24');