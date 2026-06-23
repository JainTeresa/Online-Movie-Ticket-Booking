
 CREATE TABLE Users (
  User_ID INT AUTO_INCREMENT,
  Name VARCHAR(255) NOT NULL,
  Email VARCHAR(255) UNIQUE NOT NULL,
  Password VARCHAR(255) NOT NULL,
  Phone VARCHAR(20),
  Location VARCHAR(255),
  Booking_Count INT DEFAULT 0,
  PRIMARY KEY (User_ID)
);


INSERT INTO Users (Name, Email, Password, Phone, Location, Booking_Count) VALUES
('Beverly Marsh', 'beverlymarsh@gmail.com', '$2y$10$UCptKsZp/Hwifbi.Fn.9m.SMNMzaC/RpJ/YTLB9BDjE4mngSk8LcG', '1234567890', 'Los Angeles', 2),
('Tao Xu', 'taoxu@gmail.com', '$2y$10$tknIkpZW7ojp9M.1BGIRnuWCH.8iAAKeMH.ZlLBNW9TeIuU62UPie', '0987654321', 'Los Angeles', 3),
('Darcy Olsson', 'darcyolsson@gmail.com', '$2y$10$uH0Ioj1ugZCDPx0dZY8Speni2lZEtG.Z.yIUCgljQT1rgudu10jJ.', '0987654321', 'Los Angeles', 0),
('Tori Spring', 'torispring@gmail.com', '$2y$10$xZLc4VYMXQpuPzCBoEzlCeulXN5JRSOzrCnjRCqj/Ane8FUCrVZ4m', '0987654321', 'Los Angeles', 1),
('Charlie Spring', 'charliespring@gmail.com', '$2y$10$TiV7tuyb8sOxirfCcWTTjuBBcvp.lBOyrF3kI5g1CsO9rWpvLp2a6', '1122334455', 'Los Angeles', 0);


CREATE TABLE Movies (
  Movie_ID INT AUTO_INCREMENT,
  Title VARCHAR(255) NOT NULL,
  About TEXT,
  Release_Date DATE,
  Duration INT,
  Genre VARCHAR(100),
  Rating DECIMAL(3,2),
  Starring TEXT,
  Crew TEXT,
  Poster_url VARCHAR(255),
  Trailer_url VARCHAR(255),
  PRIMARY KEY (Movie_ID)
);

INSERT INTO Movies (Title, About, Release_Date, Duration, Genre, Rating, Starring, Crew, Poster_url, Trailer_url) VALUES
('Deadpool & Wolverine', 'A listless Wade Wilson toils away in civilian life with his days as the morally flexible mercenary, Deadpool, behind him. But when his homeworld faces an existential threat, Wade must reluctantly suit-up again with an even more reluctant Wolverine.', '2024-07-25', 128, 'Action/ Comedy', 7.7, 'Ryan Reynolds, Hugh Jackman, Emma Corrin,Morena Baccarin, Rob Delaney', 'Shawn Levy, Ryan Reynolds, Rhett Reese, Paul Wernick', 'images/Deadpool&Wolverine.jpg', 'https://youtu.be/73_1biulkYk?si=97EXJIxICBjoSNo0'), 
('The Marvels', 'Carol Danvers AKA Captain Marvel has reclaimed her identity from the tyrannical Kree and taken revenge on the Supreme Intelligence. But unintended consequences see Carol shouldering the burden of a destabilized universe. When her duties send her to an anomalous wormhole linked to a Kree revolutionary, her powers become entangled with that of Jersey City super-fan Kamala Khan, aka Ms. Marvel, and Carols estranged niece, now S.A.B.E.R. astronaut Captain Monica Rambeau.', '2023-11-10', 105, 'Action/ Adventure/ Fantasy', 5.5, 'Brie Larson, Teyonah Parris, Iman Vellani', 'Nia DaCosta, Megan McDonnell, Elissa Karasik', 'images/TheMarvels.jpg', 'https://youtu.be/wS_qbDztgVY?si=V6LAHUrnVatkQJyi'),
('Guardians of the Galaxy Vol. 3', 'In Marvel Studios "Guardians of the Galaxy Vol. 3" our beloved band of misfits are looking a bit different these days. Peter Quill, still reeling from the loss of Gamora, must rally his team around him to defend the universe along with protecting one of their own. A mission that, if not completed successfully, could quite possibly lead to the end of the Guardians as we know them.', '2023-05-05', 150, 'Science-Fiction/ Adventure/ Action/ Fantasy/ Comedy', 7.9, 'Chris Pratt, Chukwudi Iwuji, Bradley Cooper', 'James Gunn, Jim Starlin, Stan Lee', 'images/GuardiansoftheGalaxyVol3.jpg', 'https://youtu.be/u3V5KDHRQvk?si=iWo53mpPLrYOEC-a'), 
('Ant-Man and the Wasp: Quantumania', 'When Scott Lang and Hope van Dyne, along with Hopes parents, Hank Pym and Janet van Dyne, and Scotts daughter, Cassie, are accidentally sent to the Quantum Realm, they soon find themselves exploring the Realm, interacting with strange new creatures.', '2023-02-17', 124, 'Action/ Adventure/ Fantasy/ Comedy', 6.0, 'Paul Rudd, Evangeline Lilly, Michael Douglas', 'Peyton Reed, Jeff Loveness, Stan Lee, Larry Lieber', 'images/AntManandtheWaspQuantumania.jpg', 'https://youtu.be/5WfTEZJnv_8?si=EKgMQuASIh_KQ-aB'), 
('Black Panther: Wakanda Forever', 'Queen Ramonda, Shuri, MBaku, Okoye and the Dora Milaje fight to protect the kingdom of Wakanda from intervening world powers in the wake of King TChallas death. As the Wakandans strive to embrace their next chapter, the heroes must band together with the help of War Dog Nakia and Everett Ross and forge a new path for their nation.', '2022-11-11', 161, 'Action/ Adventure/ Fantasy', 6.7, 'Letitia Wright, Lupita Nyongo, Danai Gurira', 'Ryan Coogler, Joe Robert Cole, Stan Lee', 'images/BlackPantherWakandaForever.jpg', 'https://youtu.be/_Z3QKkl1WyM?si=XZXKLraiJzahZZSv'),
('Thor: Love and Thunder', 'Thors retirement is interrupted by a galactic killer known as Gorr the God Butcher, who seeks the extinction of the gods. To combat the threat, Thor enlists the help of King Valkyrie, Korg and ex-girlfriend Jane Foster, who - to Thors surprise - inexplicably wields his magical hammer, Mjolnir, as the Mighty Thor. Together, they embark upon a harrowing cosmic adventure to uncover the mystery of the God Butchers vengeance and stop him before its too late.', '2022-07-08', 118, 'Action/ Adventure/ Fantasy/ Comedy', 6.2, 'Chris Hemsworth, Natalie Portman, Christian Bale', 'Taika Waititi, Jennifer Kaytin Robinson, Stan Lee', 'images/ThorLoveandThunder.jpg', 'https://youtu.be/Go8nTmfrQd8?si=IfqLPnDiM5uORaDA'),
('Doctor Strange in the Multiverse of Madness', 'Following the events of Spider-Man No Way Home, Doctor Strange unwittingly casts a forbidden spell that accidentally opens up the multiverse. With help from Wong and Scarlet Witch, Strange confronts various versions of himself as well as teaming up with the young America Chavez while traveling through various realities and working to restore reality as he knows it. Along the way, Strange and his allies realize they must take on a powerful new adversary who seeks to take over the multiverse.', '2021-05-06', 126, 'Action/ Adventure/ Fantasy/ Horror', 6.9, 'Benedict Cumberbatch, Elizabeth Olsen, Chiwetel Ejiofor', 'Sam Raimi, Michael Waldron, Stan Lee, Steve Ditko', 'images/DoctorStrangeintheMultiverseofMadness.jpg', 'https://youtu.be/aWzlQ2N6qqg?si=59oSk4r0icXy4WLe'),
('Spider-Man: No Way Home', 'Peter Parkers secret identity is revealed to the entire world. Desperate for help, Peter turns to Doctor Strange to make the world forget that he is Spider-Man. The spell goes horribly wrong and shatters the multiverse, bringing in monstrous villains that could destroy the world.', '2021-12-17', 148, 'Action/ Adventure/ Fantasy/ Comedy', 8.2, 'Tom Holland, Zendaya, Benedict Cumberbatch', 'Jon Watts, Chris McKenna, Erik Sommers, Stan Lee', 'images/SpiderManNoWayHome.jpg', 'https://youtu.be/JfVOs4VSpmA?si=oW0VBKLaPLkHbVRe');


CREATE TABLE Upcoming_Movies (
  Upcoming_Movie_ID INT AUTO_INCREMENT,
  Title VARCHAR(255),
  Release_Date DATE,
  Poster_URL VARCHAR(255),
  Genre VARCHAR(100),
  Crew TEXT,
  Movie_ID INT NULL,
  PRIMARY KEY (Upcoming_Movie_ID)
  );


INSERT INTO Upcoming_Movies (Title, Release_Date, Poster_URL, Genre, Crew, Movie_ID) VALUES
('Saw XI', '2025-09-26', 'images/SawXI.jpg', 'Horror/ Thriller', 'Kevin Greutert', NULL),
('M3GAN 2.0', '2025-01-17', 'images/M3GAN2.jpg', 'Horror/ Science-fiction', 'Gerard Johnstone, Akela Cooper', NULL),
('Now You See Me 3', '2025-11-14', 'images/NowYouSeeMe3.jpg', 'Crime/ Thriller', 'Ruben Fleischer, Seth Grahame Smith, Gavin James, Michael Lesslie', NULL),
('Wolf Man', '2025-01-17', 'images/WolfMan.jpg', 'Horror/ Drama', 'Leigh Whannell, Rebecca Angelo, Lauren Schuker Blum, Corbett Tuck', NULL);


CREATE TABLE Theaters (
  Theater_ID INT AUTO_INCREMENT,
  Name VARCHAR(255) NOT NULL,
  Location VARCHAR(255) NOT NULL,
  Capacity INT,
  Price INT NOT NULL,
  Email VARCHAR(255) UNIQUE NOT NULL,
  Password VARCHAR(255) NOT NULL,
  PRIMARY KEY (Theater_ID)
);

INSERT INTO Theaters (Name, Location, Capacity, Price, Email, Password) VALUES
('AMC Empire 25', 'Los Angeles', 100, 120, 'june1@gmail.com', '$2y$10$DBNYohr7r6.5BLaleZybZuiENvobfounkRSy6RIX16d13wTRoJjz.'),
('Regal LA Live', 'Los Angeles', 180, 140, 'june2@gmail.com', '$2y$10$//4E.vVEOxubBxPIcm8ECOT02L9dd7RxxSpxZu9McbKc8EZTWK.va'),
('Cinemark Theatres', 'Los Angeles', 150, 100, 'june3@gmail.com', '$2y$10$qE55wQ.hgpH0HYNi1jQyT.IAYOJYiwIaR1daKccR7ukyVM6XaCvNi'),
('Alamo Drafthouse', 'Los Angeles', 120, 90, 'june4@gmail.com', '$2y$10$WgklaSxxrai3Iz6xZY7c7eijHB82phXoSSTRZ7HKQB3UOsdQ61gqO');


CREATE TABLE Shows (
  Show_ID INT AUTO_INCREMENT,
  Movie_ID INT,
  Theater_ID INT,
  Date DATE,
  Time TIME,
  Available_Seats INT,
  PRIMARY KEY (Show_ID),
  FOREIGN KEY (Movie_ID) REFERENCES Movies(Movie_ID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (Theater_ID) REFERENCES Theaters(Theater_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO Shows (Movie_ID, Theater_ID, Date, Time, Available_Seats) VALUES
(1, 1, '2025-01-07', '14:00:00', 97),
(3, 1, '2025-01-10', '18:00:00', 100),   
(5, 1, '2025-01-06', '13:30:00', 99),  
(7, 1, '2025-01-08', '15:00:00', 95),  
(2, 2, '2025-01-08', '14:00:00', 175),  
(4, 2, '2025-01-11', '18:00:00', 180),  
(6, 2, '2025-01-06', '13:00:00', 180),  
(8, 2, '2025-01-07', '15:00:00', 180),  
(1, 3, '2025-01-09', '14:00:00', 150),  
(2, 3, '2025-01-11', '18:00:00', 150),  
(5, 3, '2025-01-10', '13:00:00', 150),  
(8, 3, '2025-01-09', '15:00:00', 149),  
(6, 4, '2025-01-09', '14:00:00', 120),  
(3, 4, '2025-01-07', '18:00:00', 120),  
(4, 4, '2025-01-07', '13:00:00', 118),  
(7, 4, '2025-01-10', '20:00:00', 120);  


CREATE TABLE Bookings (
  Booking_ID INT AUTO_INCREMENT,
  User_ID INT,
  Theater_ID INT,
  Show_ID INT,
  Movie_ID INT,
  Number_of_Tickets INT,
  Booking_Date DATE,
  Total_Amount INT,
  Discount_Amount INT DEFAULT 0,
  PRIMARY KEY (Booking_ID),
  FOREIGN KEY (User_ID) REFERENCES Users(User_ID),
  FOREIGN KEY (Show_ID) REFERENCES Shows(Show_ID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (Theater_ID) REFERENCES Theaters(Theater_ID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (Movie_ID) REFERENCES Movies(Movie_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO Bookings (User_ID, Theater_ID, Show_ID, Movie_ID, Number_of_Tickets, Booking_Date, Total_Amount, Discount_Amount) VALUES
(1, 1, 1, 1, 3, '2025-01-07', 360, 0),  
(1, 2, 6, 4, 5, '2025-01-11', 700, 0),  
(2, 1, 3, 5, 1, '2025-01-06', 120, 0),  
(2, 4, 15, 4, 2, '2025-01-07', 180, 0),  
(4, 1, 4, 7, 5, '2025-01-08', 600, 0), 
(2, 3, 12, 8, 1, '2025-01-09', 98, 5);  

CREATE TABLE Payments (
  Payment_ID INT AUTO_INCREMENT,
  Payment_Date DATE,
  Amount INT,
  PRIMARY KEY (Payment_ID)
 );

INSERT INTO Payments (Payment_Date, Amount) VALUES
('2024-11-30', 360),
('2024-12-02', 700),
('2024-12-02', 120),
('2024-12-03', 180),
('2024-12-03', 600),
('2024-12-06', 95);


CREATE TABLE Booking_Payments (
  Booking_ID INT,
  Payment_ID INT,
  PRIMARY KEY (Booking_ID, Payment_ID),
  FOREIGN KEY (Booking_ID) REFERENCES Bookings(Booking_ID),
  FOREIGN KEY (Payment_ID) REFERENCES Payments(Payment_ID)
);

INSERT INTO Booking_Payments (Booking_ID, Payment_ID) VALUES
(1, 1),  
(2, 2),  
(3, 3),  
(4, 4),  
(5, 5),  
(6, 6);  


CREATE TABLE Seats (
  Seat_ID INT AUTO_INCREMENT,
  Theater_ID INT,
  Seat_No VARCHAR(10),
  PRIMARY KEY (Seat_ID),
  FOREIGN KEY (Theater_ID) REFERENCES Theaters(Theater_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Insert seats for Theater 1 (100 seats: A1 to A20, B1 to B20, C1 to C20, D1 to D20, E1 to E20)
INSERT INTO Seats (Theater_ID, Seat_No) VALUES 
(1, 'A1'), (1, 'A2'), (1, 'A3'), (1, 'A4'), (1, 'A5'), (1, 'A6'), (1, 'A7'), (1, 'A8'), (1, 'A9'), (1, 'A10'),
(1, 'A11'), (1, 'A12'), (1, 'A13'), (1, 'A14'), (1, 'A15'), (1, 'A16'), (1, 'A17'), (1, 'A18'), (1, 'A19'), (1, 'A20'),
(1, 'B1'), (1, 'B2'), (1, 'B3'), (1, 'B4'), (1, 'B5'), (1, 'B6'), (1, 'B7'), (1, 'B8'), (1, 'B9'), (1, 'B10'),
(1, 'B11'), (1, 'B12'), (1, 'B13'), (1, 'B14'), (1, 'B15'), (1, 'B16'), (1, 'B17'), (1, 'B18'), (1, 'B19'), (1, 'B20'),
(1, 'C1'), (1, 'C2'), (1, 'C3'), (1, 'C4'), (1, 'C5'), (1, 'C6'), (1, 'C7'), (1, 'C8'), (1, 'C9'), (1, 'C10'),
(1, 'C11'), (1, 'C12'), (1, 'C13'), (1, 'C14'), (1, 'C15'), (1, 'C16'), (1, 'C17'), (1, 'C18'), (1, 'C19'), (1, 'C20'),
(1, 'D1'), (1, 'D2'), (1, 'D3'), (1, 'D4'), (1, 'D5'), (1, 'D6'), (1, 'D7'), (1, 'D8'), (1, 'D9'), (1, 'D10'),
(1, 'D11'), (1, 'D12'), (1, 'D13'), (1, 'D14'), (1, 'D15'), (1, 'D16'), (1, 'D17'), (1, 'D18'), (1, 'D19'), (1, 'D20'),
(1, 'E1'), (1, 'E2'), (1, 'E3'), (1, 'E4'), (1, 'E5'), (1, 'E6'), (1, 'E7'), (1, 'E8'), (1, 'E9'), (1, 'E10'),
(1, 'E11'), (1, 'E12'), (1, 'E13'), (1, 'E14'), (1, 'E15'), (1, 'E16'), (1, 'E17'), (1, 'E18'), (1, 'E19'), (1, 'E20');

-- Insert seats for Theater 2 (180 seats: A1 to A20, B1 to B20, ..., I1 to I20)
INSERT INTO Seats (Theater_ID, Seat_No) VALUES 
(2, 'A1'), (2, 'A2'), (2, 'A3'), (2, 'A4'), (2, 'A5'), (2, 'A6'), (2, 'A7'), (2, 'A8'), (2, 'A9'), (2, 'A10'),
(2, 'A11'), (2, 'A12'), (2, 'A13'), (2, 'A14'), (2, 'A15'), (2, 'A16'), (2, 'A17'), (2, 'A18'), (2, 'A19'), (2, 'A20'),
(2, 'B1'), (2, 'B2'), (2, 'B3'), (2, 'B4'), (2, 'B5'), (2, 'B6'), (2, 'B7'), (2, 'B8'), (2, 'B9'), (2, 'B10'),
(2, 'B11'), (2, 'B12'), (2, 'B13'), (2, 'B14'), (2, 'B15'), (2, 'B16'), (2, 'B17'), (2, 'B18'), (2, 'B19'), (2, 'B20'),
(2, 'C1'), (2, 'C2'), (2, 'C3'), (2, 'C4'), (2, 'C5'), (2, 'C6'), (2, 'C7'), (2, 'C8'), (2, 'C9'), (2, 'C10'),
(2, 'C11'), (2, 'C12'), (2, 'C13'), (2, 'C14'), (2, 'C15'), (2, 'C16'), (2, 'C17'), (2, 'C18'), (2, 'C19'), (2, 'C20'),
(2, 'D1'), (2, 'D2'), (2, 'D3'), (2, 'D4'), (2, 'D5'), (2, 'D6'), (2, 'D7'), (2, 'D8'), (2, 'D9'), (2, 'D10'),
(2, 'D11'), (2, 'D12'), (2, 'D13'), (2, 'D14'), (2, 'D15'), (2, 'D16'), (2, 'D17'), (2, 'D18'), (2, 'D19'), (2, 'D20'),
(2, 'E1'), (2, 'E2'), (2, 'E3'), (2, 'E4'), (2, 'E5'), (2, 'E6'), (2, 'E7'), (2, 'E8'), (2, 'E9'), (2, 'E10'),
(2, 'E11'), (2, 'E12'), (2, 'E13'), (2, 'E14'), (2, 'E15'), (2, 'E16'), (2, 'E17'), (2, 'E18'), (2, 'E19'), (2, 'E20'),
(2, 'F1'), (2, 'F2'), (2, 'F3'), (2, 'F4'), (2, 'F5'), (2, 'F6'), (2, 'F7'), (2, 'F8'), (2, 'F9'), (2, 'F10'),
(2, 'F11'), (2, 'F12'), (2, 'F13'), (2, 'F14'), (2, 'F15'), (2, 'F16'), (2, 'F17'), (2, 'F18'), (2, 'F19'), (2, 'F20'),
(2, 'G1'), (2, 'G2'), (2, 'G3'), (2, 'G4'), (2, 'G5'), (2, 'G6'), (2, 'G7'), (2, 'G8'), (2, 'G9'), (2, 'G10'),
(2, 'G11'), (2, 'G12'), (2, 'G13'), (2, 'G14'), (2, 'G15'), (2, 'G16'), (2, 'G17'), (2, 'G18'), (2, 'G19'), (2, 'G20'),
(2, 'H1'), (2, 'H2'), (2, 'H3'), (2, 'H4'), (2, 'H5'), (2, 'H6'), (2, 'H7'), (2, 'H8'), (2, 'H9'), (2, 'H10'),
(2, 'H11'), (2, 'H12'), (2, 'H13'), (2, 'H14'), (2, 'H15'), (2, 'H16'), (2, 'H17'), (2, 'H18'), (2, 'H19'), (2, 'H20'),
(2, 'I1'), (2, 'I2'), (2, 'I3'), (2, 'I4'), (2, 'I5'), (2, 'I6'), (2, 'I7'), (2, 'I8'), (2, 'I9'), (2, 'I10'),
(2, 'I11'), (2, 'I12'), (2, 'I13'), (2, 'I14'), (2, 'I15'), (2, 'I16'), (2, 'I17'), (2, 'I18'), (2, 'I19'), (2, 'I20');

-- Insert seats for Theater 3 (150 seats: A1 to A20, B1 to B20, ..., H1 to H20)
INSERT INTO Seats (Theater_ID, Seat_No) VALUES 
(3, 'A1'), (3, 'A2'), (3, 'A3'), (3, 'A4'), (3, 'A5'), (3, 'A6'), (3, 'A7'), (3, 'A8'), (3, 'A9'), (3, 'A10'),
(3, 'A11'), (3, 'A12'), (3, 'A13'), (3, 'A14'), (3, 'A15'), (3, 'A16'), (3, 'A17'), (3, 'A18'), (3, 'A19'), (3, 'A20'),
(3, 'B1'), (3, 'B2'), (3, 'B3'), (3, 'B4'), (3, 'B5'), (3, 'B6'), (3, 'B7'), (3, 'B8'), (3, 'B9'), (3, 'B10'),
(3, 'B11'), (3, 'B12'), (3, 'B13'), (3, 'B14'), (3, 'B15'), (3, 'B16'), (3, 'B17'), (3, 'B18'), (3, 'B19'), (3, 'B20'),
(3, 'C1'), (3, 'C2'), (3, 'C3'), (3, 'C4'), (3, 'C5'), (3, 'C6'), (3, 'C7'), (3, 'C8'), (3, 'C9'), (3, 'C10'),
(3, 'C11'), (3, 'C12'), (3, 'C13'), (3, 'C14'), (3, 'C15'), (3, 'C16'), (3, 'C17'), (3, 'C18'), (3, 'C19'), (3, 'C20'),
(3, 'D1'), (3, 'D2'), (3, 'D3'), (3, 'D4'), (3, 'D5'), (3, 'D6'), (3, 'D7'), (3, 'D8'), (3, 'D9'), (3, 'D10'),
(3, 'D11'), (3, 'D12'), (3, 'D13'), (3, 'D14'), (3, 'D15'), (3, 'D16'), (3, 'D17'), (3, 'D18'), (3, 'D19'), (3, 'D20'),
(3, 'E1'), (3, 'E2'), (3, 'E3'), (3, 'E4'), (3, 'E5'), (3, 'E6'), (3, 'E7'), (3, 'E8'), (3, 'E9'), (3, 'E10'),
(3, 'E11'), (3, 'E12'), (3, 'E13'), (3, 'E14'), (3, 'E15'), (3, 'E16'), (3, 'E17'), (3, 'E18'), (3, 'E19'), (3, 'E20'),
(3, 'F1'), (3, 'F2'), (3, 'F3'), (3, 'F4'), (3, 'F5'), (3, 'F6'), (3, 'F7'), (3, 'F8'), (3, 'F9'), (3, 'F10'),
(3, 'F11'), (3, 'F12'), (3, 'F13'), (3, 'F14'), (3, 'F15'), (3, 'F16'), (3, 'F17'), (3, 'F18'), (3, 'F19'), (3, 'F20'),
(3, 'G1'), (3, 'G2'), (3, 'G3'), (3, 'G4'), (3, 'G5'), (3, 'G6'), (3, 'G7'), (3, 'G8'), (3, 'G9'), (3, 'G10'),
(3, 'G11'), (3, 'G12'), (3, 'G13'), (3, 'G14'), (3, 'G15'), (3, 'G16'), (3, 'G17'), (3, 'G18'), (3, 'G19'), (3, 'G20'),
(3, 'H1'), (3, 'H2'), (3, 'H3'), (3, 'H4'), (3, 'H5'), (3, 'H6'), (3, 'H7'), (3, 'H8'), (3, 'H9'), (3, 'H10');

-- Insert seats for Theater 4 (120 seats: A1 to A20, B1 to B20, ..., F1 to F20)
INSERT INTO Seats (Theater_ID, Seat_No) VALUES 
(4, 'A1'), (4, 'A2'), (4, 'A3'), (4, 'A4'), (4, 'A5'), (4, 'A6'), (4, 'A7'), (4, 'A8'), (4, 'A9'), (4, 'A10'),
(4, 'A11'), (4, 'A12'), (4, 'A13'), (4, 'A14'), (4, 'A15'), (4, 'A16'), (4, 'A17'), (4, 'A18'), (4, 'A19'), (4, 'A20'),
(4, 'B1'), (4, 'B2'), (4, 'B3'), (4, 'B4'), (4, 'B5'), (4, 'B6'), (4, 'B7'), (4, 'B8'), (4, 'B9'), (4, 'B10'),
(4, 'B11'), (4, 'B12'), (4, 'B13'), (4, 'B14'), (4, 'B15'), (4, 'B16'), (4, 'B17'), (4, 'B18'), (4, 'B19'), (4, 'B20'),
(4, 'C1'), (4, 'C2'), (4, 'C3'), (4, 'C4'), (4, 'C5'), (4, 'C6'), (4, 'C7'), (4, 'C8'), (4, 'C9'), (4, 'C10'),
(4, 'C11'), (4, 'C12'), (4, 'C13'), (4, 'C14'), (4, 'C15'), (4, 'C16'), (4, 'C17'), (4, 'C18'), (4, 'C19'), (4, 'C20'),
(4, 'D1'), (4, 'D2'), (4, 'D3'), (4, 'D4'), (4, 'D5'), (4, 'D6'), (4, 'D7'), (4, 'D8'), (4, 'D9'), (4, 'D10'),
(4, 'D11'), (4, 'D12'), (4, 'D13'), (4, 'D14'), (4, 'D15'), (4, 'D16'), (4, 'D17'), (4, 'D18'), (4, 'D19'), (4, 'D20'),
(4, 'E1'), (4, 'E2'), (4, 'E3'), (4, 'E4'), (4, 'E5'), (4, 'E6'), (4, 'E7'), (4, 'E8'), (4, 'E9'), (4, 'E10'),
(4, 'E11'), (4, 'E12'), (4, 'E13'), (4, 'E14'), (4, 'E15'), (4, 'E16'), (4, 'E17'), (4, 'E18'), (4, 'E19'), (4, 'E20'),
(4, 'F1'), (4, 'F2'), (4, 'F3'), (4, 'F4'), (4, 'F5'), (4, 'F6'), (4, 'F7'), (4, 'F8'), (4, 'F9'), (4, 'F10'),
(4, 'F11'), (4, 'F12'), (4, 'F13'), (4, 'F14'), (4, 'F15'), (4, 'F16'), (4, 'F17'), (4, 'F18'), (4, 'F19'), (4, 'F20');


CREATE TABLE Booked_Seats (
  Theater_ID INT,
  Booking_ID INT,
  Show_ID INT,
  Seat_ID INT,
  PRIMARY KEY (Booking_ID, Show_ID, Seat_ID),
  FOREIGN KEY (Booking_ID) REFERENCES Bookings(Booking_ID),
  FOREIGN KEY (Show_ID) REFERENCES Shows(Show_ID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (Seat_ID) REFERENCES Seats(Seat_ID),
  FOREIGN KEY (Theater_ID) REFERENCES Theaters(Theater_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO Booked_Seats (Theater_ID, Booking_ID, Show_ID, Seat_ID) VALUES
(1, 1, 1, 51), 
(1, 1, 1, 52),
(1, 1, 1, 53),
  
(2, 2, 6, 165),  
(2, 2, 6, 166),  
(2, 2, 6, 167),  
(2, 2, 6, 168),  
(2, 2, 6, 169), 
 
(1, 3, 3, 76), 
 
(4, 4, 15, 456),  
(4, 4, 15, 457),  

(1, 5, 4, 23),  
(1, 5, 4, 24),  
(1, 5, 4, 25),  
(1, 5, 4, 26),  
(1, 5, 4, 27), 
  
(3, 6, 12, 300);

