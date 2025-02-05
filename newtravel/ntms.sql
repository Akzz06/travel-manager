CREATE TABLE booking (
    bookingId INT AUTO_INCREMENT PRIMARY KEY,
    packageId INT NOT NULL,
    username VARCHAR(50) NOT NULL,
    fromDate DATE NOT NULL,
    toDate DATE NOT NULL,
    FOREIGN KEY (packageId) REFERENCES packages(PackageId)
);
