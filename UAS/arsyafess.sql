-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jun 2024 pada 11.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsyafess`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `upsert_vote` (IN `p_userid` CHAR(12), IN `p_answerid` CHAR(12), IN `p_vote` INT)   BEGIN
    DECLARE vote_exists INT;

    -- Cek apakah kombinasi userid dan answerid sudah ada di tabel vote
    SELECT COUNT(*) INTO vote_exists
    FROM vote
    WHERE user_id = p_userid AND answer_id = p_answerid;

    IF vote_exists > 0 THEN
        -- Jika kombinasi ada, lakukan update pada kolom vote
        IF p_vote=0 THEN
        	DELETE FROM vote WHERE user_id=p_userid AND answer_id=p_answerid;
        ELSE
            UPDATE vote
            SET vote = p_vote
            WHERE user_id = p_userid AND answer_id = p_answerid;
         END IF;
    ELSE
        -- Jika kombinasi tidak ada, lakukan insert data baru
        INSERT INTO vote (user_id, answer_id, vote)
        VALUES (p_userid, p_answerid, p_vote);
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `answers`
--

CREATE TABLE `answers` (
  `answer_id` char(12) NOT NULL,
  `quest_id` char(12) NOT NULL,
  `user_id` char(12) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `answers`
--

INSERT INTO `answers` (`answer_id`, `quest_id`, `user_id`, `text`, `date`) VALUES
('6666eb95c147', '6666eb769c09', '6666eb68bcbe', 'biasanya ada di website software ilegal', '2024-06-16 12:07:24'),
('6666eb97daaa', '6666eb7c7801', '6666eb68bcbe', 'gabisa, kamu harus pake vps kalo mau deploy nextJS', '2024-06-16 12:07:57'),
('6666eb98b891', '6666eb91bdcc', '6666eb68bcbe', 'nonton yt sih biasanya', '2024-06-16 12:08:11'),
('666793397496', '6666eb91bdcc', '6666eb624977', 'Susah sih', '2024-06-24 10:51:35');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `answer_data`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `answer_data` (
`answer_id` char(12)
,`quest_id` char(12)
,`user_id` char(12)
,`text` text
,`date` datetime
,`likes` bigint(21)
,`dislikes` bigint(21)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `following`
--

CREATE TABLE `following` (
  `follow_id` int(11) NOT NULL,
  `target_id` char(12) NOT NULL,
  `source_id` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `following`
--

INSERT INTO `following` (`follow_id`, `target_id`, `source_id`) VALUES
(46, '6666eb68bcbe', '6666eb624977');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questions`
--

CREATE TABLE `questions` (
  `quest_id` char(12) NOT NULL,
  `user_id` char(12) NOT NULL,
  `title` varchar(20) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `questions`
--

INSERT INTO `questions` (`quest_id`, `user_id`, `title`, `text`, `date`) VALUES
('6666eb6f81ed', '6666eb68bcbe', 'Oracle Database', 'Apakah ada oracle db versi online ?', '2024-06-16 11:57:12'),
('6666eb769c09', '6666eb624977', 'Windows 11', 'Saya menggunakan windows 11 sejak lama, namun ingin downgrade ke windows 8. adakah file iso nya ?', '2024-06-16 11:59:05'),
('6666eb7c7801', '6666eb608de5', 'Apache Server', 'Saya mau hosting project nextJs di cloud. bisakah pakai server apache ?', '2024-06-16 12:00:39'),
('6666eb909555', '6666eb624977', 'Waktu', 'Bagaimana cara Anda mengatur waktu antara kuliah dan kegiatan ekstrakurikuler?', '2024-06-16 12:06:01'),
('6666eb91bdcc', '6666eb624977', 'Waktu Kosong', 'Apa yang biasanya Anda lakukan saat ada waktu luang di kampus?', '2024-06-16 12:06:19'),
('6666eb9436a1', '6666eb68bcbe', 'Stress', 'Bagaimana cara Anda mengelola stres saat menghadapi ujian?', '2024-06-16 12:06:59');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `question_data`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `question_data` (
`title` varchar(20)
,`text` text
,`date` datetime
,`quest_id` char(12)
,`username` varchar(16)
,`ans_count` bigint(21)
,`avatar` char(9)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` char(12) NOT NULL,
  `username` varchar(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` char(60) NOT NULL,
  `avatar` char(9) NOT NULL,
  `bio` text NOT NULL,
  `gabung` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `name`, `email`, `password`, `avatar`, `bio`, `gabung`) VALUES
('6666eb608de5', 'g.amr_18', 'Ghulam Amhar Rosyada', 'kamaluddinarsyadfadllillah@mail.ugm.ac.id', '$2y$10$fzIwfKK.I3PoU9JRLwcOt.TuEN0MkFtOxW3r3Lex8q86Og1DtPpae', 'avatar 20', 'anak esempe\r\n', '2024-06-16'),
('6666eb624977', 'aslamu_13', 'Sholahuddin Aslamu Rasyidin', 'kamaluddin.arsyad05@gmail.com', '$2y$10$4GVixGEPGSrwKFXtd3LXXuz7Iw.VdYYqkIik.ls/5YI4t5NA57tfa', 'avatar 10', 'bocil kematian\r\n', '2024-06-16'),
('6666eb68bcbe', 'disyfa', 'Disyfa', 'kamaluddin.arsyad17@gmail.com', '$2y$10$9B/L/EcKrCog4rmLVbklBOTEFxiKEUTLJGIM8t/VNIxONusJ..Bsq', 'avatar 12', '', '2024-06-16'),
('6667bb3d2150', 'arsyayd', 'Kamal Arsyad Fadllillah', 'kamaluddin.arsyad45@gmail.com', '$2y$10$1HnJwRTdV2jCuYepeZpoZOlq8Bm3AjXhii1fGC.zyXlYmIYTjcKdS', 'avatar 19', 'anak mahasiswa', '2024-06-26'),
('6667e77b553f', 'gunafiko', 'Kamaluddin Arsyad Fadllillah', 'arsyadkamaluddin@gmail.com', '$2y$10$3G6IVc2Kc5rncAfZqspv..i0EyM12hB.QCaVZV2wEDmVDE3N2izFO', 'avatar 06', 'mahasiswa baru', '2024-06-28');

--
-- Trigger `users`
--
DELIMITER $$
CREATE TRIGGER `signup_user` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    SET NEW.avatar = 'avatar 00';
    SET NEW.bio = 'Tidak ada';
    SET NEW.gabung = CURRENT_DATE();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `vote`
--

CREATE TABLE `vote` (
  `user_id` char(12) NOT NULL,
  `answer_id` char(12) NOT NULL,
  `vote` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `vote`
--

INSERT INTO `vote` (`user_id`, `answer_id`, `vote`) VALUES
('6666eb624977', '6666eb98b891', 1),
('6666eb624977', '666793397496', 1),
('6667e77b553f', '6666eb98b891', -1),
('6667e77b553f', '666793397496', 1);

-- --------------------------------------------------------

--
-- Struktur untuk view `answer_data`
--
DROP TABLE IF EXISTS `answer_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `answer_data`  AS SELECT `a`.`answer_id` AS `answer_id`, `a`.`quest_id` AS `quest_id`, `a`.`user_id` AS `user_id`, `a`.`text` AS `text`, `a`.`date` AS `date`, coalesce(`likes`.`like_count`,0) AS `likes`, coalesce(`dislikes`.`dislike_count`,0) AS `dislikes` FROM ((`answers` `a` left join (select `vote`.`answer_id` AS `answer_id`,count(0) AS `like_count` from `vote` where `vote`.`vote` = 1 group by `vote`.`answer_id`) `likes` on(`a`.`answer_id` = `likes`.`answer_id`)) left join (select `vote`.`answer_id` AS `answer_id`,count(0) AS `dislike_count` from `vote` where `vote`.`vote` = -1 group by `vote`.`answer_id`) `dislikes` on(`a`.`answer_id` = `dislikes`.`answer_id`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `question_data`
--
DROP TABLE IF EXISTS `question_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `question_data`  AS SELECT `q`.`title` AS `title`, `q`.`text` AS `text`, `q`.`date` AS `date`, `q`.`quest_id` AS `quest_id`, `u`.`username` AS `username`, count(`a`.`answer_id`) AS `ans_count`, `u`.`avatar` AS `avatar` FROM ((`questions` `q` join `users` `u` on(`q`.`user_id` = `u`.`user_id`)) left join `answers` `a` on(`q`.`quest_id` = `a`.`quest_id`)) GROUP BY `q`.`title`, `q`.`text`, `q`.`date`, `q`.`quest_id`, `u`.`username`, `u`.`avatar` ORDER BY `q`.`date` DESC ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `quest_id` (`quest_id`),
  ADD KEY `answers_ibfk_2` (`user_id`);

--
-- Indeks untuk tabel `following`
--
ALTER TABLE `following`
  ADD PRIMARY KEY (`follow_id`),
  ADD UNIQUE KEY `target_id` (`target_id`,`source_id`),
  ADD KEY `following_ibfk_1` (`source_id`);

--
-- Indeks untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`quest_id`),
  ADD KEY `questions_ibfk_1` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`user_id`,`answer_id`),
  ADD KEY `vote_ibfk_2` (`answer_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `following`
--
ALTER TABLE `following`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`quest_id`) REFERENCES `questions` (`quest_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `following`
--
ALTER TABLE `following`
  ADD CONSTRAINT `following_ibfk_1` FOREIGN KEY (`source_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `following_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
