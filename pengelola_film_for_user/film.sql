CREATE TABLE `films` (
    `id` INT(2) AUTO_INCREMENT PRIMARY KEY,
    `judul` VARCHAR(255) NOT NULL,
    `genre` VARCHAR(255) NOT NULL,
    `tahun_rilis` INT(4) NOT NULL,
    `status` ENUM('Sudah', 'Belum') NOT NULL
);
