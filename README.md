A weboldal működéséhez szükséges egy XAMPP futtatása, azon belül pedig egy MySQL tábla legenerálása.
Az ehhez szükséges kód: 
CREATE TABLE koltsegek (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kategoria VARCHAR(255) NOT NULL,
    osszeg DECIMAL(10, 2) NOT NULL,
    datum DATE NOT NULL,
    megjegyzes TEXT
);

Majd pedig fellehet előre is tölteni a táblát adatokkal a következő kóddal: 
INSERT INTO koltsegek (datum, kategoria, osszeg, megjegyzes) VALUES
('2025-05-04', 'Élelmiszer', 1500.00, 'Friss zöldségek'),
('2025-05-05', 'Utazás', 1200.00, 'Vasúti jegy'),
('2025-05-06', 'Szórakozás', 1000.00, 'Kávézó'),
('2025-05-07', 'Élelmiszer', 2500.00, 'Pékáru vásárlás'),
('2025-05-08', 'Utazás', 3000.00, 'Autópálya matrica'),
('2025-05-09', 'Szórakozás', 2000.00, 'Mozi jegy'),
('2025-05-10', 'Élelmiszer', 4500.00, 'Nagybevásárlás'),
('2025-05-11', 'Utazás', 800.00, 'Benzin'),
('2025-05-12', 'Szórakozás', 1200.00, 'Színház jegy'),
('2025-05-13', 'Élelmiszer', 2200.00, 'Alapanyagok'),
('2025-05-14', 'Utazás', 1800.00, 'Buszjegy'),
('2025-05-15', 'Szórakozás', 2500.00, 'Koncert belépő'),
('2025-05-16', 'Élelmiszer', 3200.00, 'Húsvét előtti vásárlás'),
('2025-05-17', 'Utazás', 1500.00, 'Parkolás'),
('2025-05-18', 'Szórakozás', 1100.00, 'Biliárdozás'),
('2025-05-19', 'Élelmiszer', 500.00, 'Kávé és sütemény'),
('2025-05-20', 'Utazás', 2700.00, 'Vonatjegy Budapest - Szeged'),
('2025-05-21', 'Szórakozás', 3500.00, 'Szabadidő park belépő'),
('2025-05-22', 'Élelmiszer', 4000.00, 'Zöldség-gyümölcs vásárlás'),
('2025-05-23', 'Utazás', 1400.00, 'Taxi'),
('2025-05-24', 'Szórakozás', 1900.00, 'Mozi film nézés');

Ezt követően autómatikus csatlakozik ehhez az adatbázishoz a weboldal és használja.
