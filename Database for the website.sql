CREATE TABLE `User` (
  `userID` int,
  `name` text,
  `surname` text,
  `contact` varchar(16),
  `email` varchar(50),
  `password_hash` varchar(255),
  PRIMARY KEY (`userID`)
);

CREATE TABLE `Customer` (
  `CustomerID` int,
  `Name` text,
  `Surname` text,
  `Contact` varchar(50),
  `Email` varchar(50),
  `userID` int,
  PRIMARY KEY (`CustomerID`),
  FOREIGN KEY (`userID`) REFERENCES `User`(`userID`)
);

CREATE TABLE `Payment` (
  `paymentID` BIGINT(11),
  `CustomerID` int,
  `userID` int,
  `AmountPaid` double,
  `Date` date,
  `BookingID` BIGINT(11),
  `ScheduleID` BIGINT(11),
  PRIMARY KEY (`paymentID`),
  FOREIGN KEY (`CustomerID`) REFERENCES `Customer`(`CustomerID`),
  FOREIGN KEY (`userID`) REFERENCES `User`(`userID`)
);

CREATE TABLE `Booking` (
  `BookingID` BIGINT(11),
  `CustomerID` int,
  `userID` int,
  `ScheduleID` BIGINT(11),
  PRIMARY KEY (`BookingID`),
  FOREIGN KEY (`CustomerID`) REFERENCES `Customer`(`CustomerID`),
  FOREIGN KEY (`userID`) REFERENCES `User`(`userID`)
);

CREATE TABLE `Bus` (
  `BusNumber` int,
  `PlateNumber` varchar(10),
  `CustomerID` int,
  `userID` int,
  `type` text,
  `capacity` int,
  `paymentID` BIGINT(11),
  `ScheduleID` BIGINT(11),
  PRIMARY KEY (`BusNumber`),
  FOREIGN KEY (`paymentID`) REFERENCES `Payment`(`paymentID`),
  FOREIGN KEY (`userID`) REFERENCES `User`(`userID`),
  FOREIGN KEY (`CustomerID`) REFERENCES `Customer`(`CustomerID`)
);

CREATE TABLE `Schedule` (
  `ScheduleID` BIGINT(11),
  `userID` int,
  `CustomerID` int,
  `StartingPoint` varchar(50),
  `Destination` varchar(50),
  `DepartureTime` time,
  `EstimatedArrivalTime` time,
  `ScheduleDate` date,
  PRIMARY KEY (`ScheduleID`),
  FOREIGN KEY (`userID`) REFERENCES `User`(`userID`),
  FOREIGN KEY (`CustomerID`) REFERENCES `Customer`(`CustomerID`)
);
