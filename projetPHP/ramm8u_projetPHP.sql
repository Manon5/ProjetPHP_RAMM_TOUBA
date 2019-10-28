-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Client :  devbdd.iutmetz.univ-lorraine.fr
-- Généré le :  Lun 28 Octobre 2019 à 16:48
-- Version du serveur :  10.3.17-MariaDB
-- Version de PHP :  7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ramm8u_projetPHP`
--

-- --------------------------------------------------------

--
-- Structure de la table `redacteur`
--

CREATE TABLE IF NOT EXISTS `redacteur` (
  `idredacteur` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `adressemail` varchar(100) NOT NULL,
  `motdepasse` varchar(100) NOT NULL,
  `pseudo` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `redacteur`
--

INSERT INTO `redacteur` (`idredacteur`, `nom`, `prenom`, `adressemail`, `motdepasse`, `pseudo`) VALUES
(1, 'Ramm', 'Arno', 'arno.ramm@gmail.com', 'abc123', 'ArnoR'),
(2, 'Touba', 'Manon', 'manon.touba@gmail.com', 'oui', 'Manon05'),
(9, 'Du Bourg-Palette', 'Sacha', 'sacha@pokemon.fr', 'pikachu', 'Sacha'),
(10, 'Flavien', 'Ledeux', 'flavien.ledoux@gmail.com', 'patrick2', 'Flavien'),
(13, 'TOUBA', 'Christelle', 'christelle.touba@test.fr', 'simba', 'Kiki');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `idreponse` int(11) NOT NULL,
  `idsujet` int(11) NOT NULL,
  `idredacteur` int(11) NOT NULL,
  `daterep` date NOT NULL,
  `textereponse` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`idreponse`, `idsujet`, `idredacteur`, `daterep`, `textereponse`) VALUES
(6, 5, 9, '2019-10-24', ' un super article très intéressant ! J''ai beaucoup aimé la partie 3.'),
(8, 5, 10, '2019-10-24', 'Novo denique perniciosoque exemplo idem Gallus ausus est inire flagitium grave, quod Romae cum ultimo dedecore temptasse aliquando dicitur Gallienus, et adhibitis paucis clam ferro succinctis vesperi per tabernas palabatur et conpita quaeritando Graeco sermone, cuius erat inpendio.'),
(9, 2, 10, '2019-10-24', ' J''habite à Metz depuis 15 ans, c''est une très belle ville ! '),
(10, 11, 2, '2019-10-24', 'Eo videtur quam potest est quidem dirimi potius earum videamur in ex congruamus ab sensus.'),
(14, 21, 13, '2019-10-27', 'C''est un beau pays'),
(15, 21, 10, '2019-10-27', ' Je suis d''accord !'),
(16, 23, 2, '2019-10-27', ' In condimentum sollicitudin diam sed interdum. Praesent quis massa nibh. Sed suscipit ligula justo, eu euismod urna porttitor in. '),
(17, 22, 2, '2019-10-27', ' Le clavier du piano moderne est composé le plus souvent de 88 touches. Les 52 touches blanches correspondent aux sept notes de la gamme diatonique de do majeur et les 36 touches noires, aux cinq notes restantes nécessaires pour constituer une gamme chromatique. ');

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE IF NOT EXISTS `sujet` (
  `idsujet` int(11) NOT NULL,
  `idredacteur` int(11) NOT NULL,
  `titresujet` varchar(200) CHARACTER SET latin1 NOT NULL,
  `textesujet` varchar(4000) CHARACTER SET latin1 NOT NULL,
  `datesujet` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `sujet`
--

INSERT INTO `sujet` (`idsujet`, `idredacteur`, `titresujet`, `textesujet`, `datesujet`) VALUES
(1, 1, 'J''adore les girafes', 'La Girafe (Giraffa camelopardalis) est une espèce de mammifères ongulés artiodactyles, du groupe des ruminants, vivant dans les savanes africaines et répandue du Tchad jusqu''en Afrique du Sud. Son nom commun vient de l''arabe zarafah, mais l''animal fut anciennement appelé camélopard, du latin camelopardus, contraction de camelus (chameau) en raison du long cou et de pardus (léopard) en raison des taches recouvrant son corps. Après des millions d''années d''évolution, la girafe a acquis une anatomie unique avec un cou particulièrement allongé qui lui permet notamment de brouter haut dans les arbres.\r\n\r\nNeuf populations, se différenciant par leurs robes et formes, ont été décrites par les naturalistes depuis le xixe siècle parfois comme espèces à part entière, mais généralement considérées comme simples sous-espèces jusqu''au xxie siècle. Cependant la taxonomie des girafes est actuellement débattue parmi les scientifiques.\r\n\r\nL’espèce est considérée comme vulnérable avec le diminution de 40 % du nombre d''individus entre 1985 et 20152.', '2019-10-18'),
(2, 1, 'La ville de Metz', 'Metz est une commune francaise situee dans le departement de la Moselle, en Lorraine. Prefecture de departement, elle fait partie, depuis le 1er janvier 2016, de la region administrative Grand Est, dont elle accueille les assemblees plenieres. Metz et ses alentours, qui faisaient partie des Trois-Evechzs de 1552 à 1790, se trouvaient enclavzs entre la Lorraine ducale et le duche de Bar jusquen 1766. Par ailleurs, la ville a ete de 1942 à 2015, le chef-lieu de la région de Lorraine. ', '2019-10-18'),
(5, 2, 'Lorem ipsum', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean suscipit posuere tellus, congue lobortis risus pellentesque ut. Proin justo libero, dictum sed nibh sed, maximus hendrerit lectus. Maecenas hendrerit, libero in egestas mattis, elit ligula porttitor lacus, sit amet volutpat est eros sed ipsum. Curabitur id facilisis neque. Proin nec condimentum lectus. Maecenas semper ipsum sed erat porttitor finibus. Aliquam accumsan vitae urna vel venenatis. Mauris venenatis dapibus leo ut dignissim. Cras eget risus placerat, tincidunt sem ac, convallis erat. Proin consequat mollis malesuada. Phasellus consequat ultrices suscipit. Fusce euismod imperdiet turpis non euismod. Suspendisse accumsan nisi interdum massa commodo, ut euismod magna consequat. Cras non risus vel elit lacinia pharetra. Nam vestibulum ornare felis at fringilla.\r\n\r\nNam et sapien rutrum, semper magna a, ullamcorper eros. Ut in pellentesque est. Nulla leo purus, consectetur vel rhoncus vitae, laoreet pharetra libero. Aenean ex eros, condimentum hendrerit efficitur a, vehicula sed tortor. Nulla odio nulla, efficitur mattis maximus sit amet, imperdiet a diam. In eget rutrum odio. Vestibulum posuere lobortis ante, nec blandit purus. Curabitur urna risus, posuere sed velit id, sodales placerat felis. Morbi semper egestas eros, quis ullamcorper risus consectetur eu. Praesent feugiat ex eget neque eleifend, a ultrices mauris porta. Morbi at placerat nulla. Duis vel ornare nisi. Donec vehicula elit lectus, sollicitudin suscipit odio imperdiet sit amet. Vestibulum cursus malesuada euismod. Ut a elit et nunc pharetra commodo nec a ligula.\r\n\r\nPhasellus commodo dolor eget libero vulputate fringilla. Praesent vehicula dictum finibus. Morbi vitae leo nisi. Aliquam ut tortor mollis, hendrerit erat nec, sollicitudin augue. Aenean pretium porta nulla non laoreet. Vestibulum aliquet eget arcu posuere aliquet. Nunc euismod neque eu libero sodales, eget fermentum tortor ultrices. Donec porta mi vitae nisi hendrerit elementum. Curabitur eu velit sapien. Aliquam erat volutpat. ', '2019-10-20'),
(11, 9, 'Les imprimantes', 'Une imprimante est une machine permettant d''obtenir un document sur papier à partir d''un modèle informatique du document. Par exemple, un texte écrit via un logiciel de traitement de texte sur ordinateur pourra être imprimé pour en obtenir une version papier (c''est un changement du support d''information). Les imprimantes ont été conçues dès l’apparition des premiers ordinateurs, pour permettre la consultation et la conservation sur support papier des résultats produits par les programmes informatiques. En effet, à l’époque des premiers calculateurs, les écrans n’existaient pas encore et les méthodes de stockage de l’information étaient très rudimentaires et très coûteuses.\r\n\r\nAvec le temps, les imprimantes ont énormément évolué dans leur méthode d’impression et de traction du papier, mais également dans leur qualité d’impression, leur encombrement et leur coût.\r\n\r\nL’informatisation massive des entreprises, les projets de « dématérialisation », et les économies escomptées par le « zéro papier » n’ont pas supprimé les imprimantes et l’usage du papier comme support d’information. \r\n\r\nLes imprimantes laser : \r\n\r\nSur ce système, l’encre se présente sous la forme d’une poudre extrêmement fine, le toner. Lors de l’impression, un laser dessine sur un tambour photo-sensible rotatif la page à imprimer, un dispositif électrique polarisant en fait une image magnétique. Sur ce tambour, l’encre en poudre polarisée inversement vient alors se répartir, n’adhérant qu’aux zones marquées par le laser. Une feuille vierge, passe entre le tambour et une grille elle-même chargée électriquement, est appliquée au tambour encré, récupérant l’encre. La fixation de l’encre sur la feuille se fait ensuite par chauffage et compression de la feuille encrée dans un four thermique.\r\n\r\nCette technique, bien que sophistiquée, permet une impression rapide (non plus ligne par ligne, mais page par page) très fine et très souple (impression de tous types de textes, de graphismes, de photos…) avec une qualité irréprochable pour le noir et blanc. Cependant, elle est peu adaptée aux niveaux de gris, et de ce fait, à l’impression en couleur. Les évolutions technologiques et des techniques du début du XXIe siècle ont permis d’adapter la couleur à ce système d’impression. ', '2019-10-24'),
(12, 10, 'World of Warcraft', 'World of Warcraft (abrégé WoW) est un jeu vidéo de type MMORPG (jeu de rôle en ligne massivement multijoueur) développé par la société Blizzard Entertainment. C''est le 4e jeu de l''univers médiéval-fantastique Warcraft, introduit par Warcraft: Orcs and Humans en 1994. World of Warcraft prend place en Azeroth, près de quatre ans après les événements de la fin du jeu précédent, Warcraft III: The Frozen Throne1 Blizzard Entertainment annonce World of Warcraft le 2 septembre 20012. Le jeu est sorti en Amérique du Nord le 23 novembre 2004, pour les 10 ans de la franchise Warcraft.\r\n\r\nLa première extension du jeu, The Burning Crusade, est sortie le 16 janvier 20073. La deuxième extension, Wrath of the Lich King, est sortie le 13 novembre 20084. La troisième, Cataclysm, est sortie le 7 décembre 2010. La quatrième extension, Mists of Pandaria, est sortie le 25 septembre 20125. La cinquième extension, Warlords of Draenor, est sortie le 13 novembre 20146. La sixième extension, Legion est sortie le 30 août 2016. La septième extension, Battle for Azeroth, est sortie le 14 août 2018.\r\n\r\nDepuis sa sortie, World of Warcraft est le plus populaire des MMORPG. Le jeu tient le Guinness World Record pour la plus grande popularité pour un MMORPG7,8,9,10. En avril 2008, World of Warcraft a été estimé comme rassemblant 62 % des joueurs de MMORPG11. Le 7 octobre 2010, Blizzard annonce que plus de 12 millions de joueurs ont un compte World of Warcraft actif12. C''est à partir de fin 2012 que World of Warcraft a commencé à perdre continuellement un nombre croissant de joueurs. Au dernier trimestre 2012, Blizzard annonce le nombre de 9,6 millions d’abonnés à travers le monde, puis 7,7 millions pour le 2e trimestre 2013.\r\n\r\nWorld of Warcraft a fêté son 10e anniversaire en novembre 2014. Le mois suivant, à la suite de la sortie de l''extension Warlords of Draenor, Blizzard annonce que World of Warcraft repasse le cap des 10 millions d''abonnés. ', '2019-10-24'),
(21, 2, 'Le Québec', 'Le Québec est une province du Canada. Sa capitale est Québec et sa métropole est Montréal. La langue officielle de cette province est le français.\r\n\r\nSitué dans la partie est du Canada, entre l''Ontario et les provinces de l''Atlantique, le Québec partage sa frontière sud avec les États-Unis et est traversé par le fleuve Saint-Laurent qui relie les Grands Lacs à l''océan Atlantique. Avec une superficie de 1 542 056 km2, le Québec est la plus grande province canadienne, et la deuxième plus vaste entité territoriale après le Nunavut.\r\n\r\nDeuxième province la plus peuplée du Canada, derrière l''Ontario, le Québec compte une population de plus de 8 400 000 habitants, composée d''une grande majorité de francophones avec des minorités anglophones, allophones et autochtones. Il s''agit de la seule province canadienne à avoir le français comme seule langue officielle, comprise par 94,6 % de la population. En 2016, la population totale de Québécois de langue maternelle française était de 79,1 %, tandis qu''elle était de 8,9 % pour l''anglais. ', '2019-10-27'),
(22, 13, 'Le piano', 'Le piano est un instrument de musique polyphonique, à clavier, de la famille des cordes frappées. Il se présente sous deux formes : le piano droit, les cordes sont verticales, et le piano à queue, les cordes sont horizontales.\r\n\r\nLe nom de l''instrument provient d''une abréviation de piano-forte, son ancêtre du XVIIIe siècle, décrit par Scipione Maffei comme un « gravecembalo col piano e forte », c''est-à-dire un clavicorde ayant la possibilité de nuancer en intensité le son directement par la frappe des touches. Jouer progressivement de la nuance piano (doucement) à la nuance forte (fort) n''est pas possible avec des instruments comme le clavecin, l''épinette ou l''orgue. ', '2019-10-27'),
(23, 10, 'Quis sagittis leo a', ' Proin a felis est. Pellentesque et convallis ligula, vel ornare risus. Sed elementum feugiat ex quis convallis. Nam leo nulla, tincidunt et est vel, euismod molestie ante. Nulla suscipit molestie nisl, vel pellentesque mi venenatis at. Curabitur sit amet aliquet massa. Sed pretium enim non leo ullamcorper, et posuere arcu efficitur. Curabitur in ornare turpis. Ut eleifend ante et feugiat rutrum. Nunc porttitor id nunc ut egestas. Curabitur leo purus, sollicitudin non volutpat at, tincidunt quis tortor. Ut nec odio viverra, convallis urna molestie, congue ex. Vestibulum tincidunt enim quis risus euismod, gravida pretium ipsum tincidunt.\r\n\r\nIn ut sapien pretium, aliquam mi et, commodo orci. Phasellus varius mattis massa et eleifend. Aliquam eget convallis elit. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam blandit risus nec ligula tincidunt tempus. Sed vel lacus quis velit tincidunt bibendum vel eget lacus. Proin fermentum ipsum quis commodo scelerisque. Mauris pulvinar imperdiet augue, vitae faucibus ligula laoreet et. Proin semper imperdiet scelerisque. Nulla lacus lectus, tempor a pulvinar a, gravida id velit. Nunc ornare dolor elit, eget suscipit mauris placerat vitae. Praesent pretium condimentum diam, quis sagittis leo vestibulum a.\r\n\r\nQuisque venenatis ut purus et efficitur. Maecenas sit amet nisi sit amet ligula tempus egestas quis a neque. ', '2019-10-27');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `redacteur`
--
ALTER TABLE `redacteur`
  ADD PRIMARY KEY (`idredacteur`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`idreponse`);

--
-- Index pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD PRIMARY KEY (`idsujet`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `redacteur`
--
ALTER TABLE `redacteur`
  MODIFY `idredacteur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `idreponse` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `sujet`
--
ALTER TABLE `sujet`
  MODIFY `idsujet` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
