CREATE DATABASE  IF NOT EXISTS `taskforce` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `taskforce`;
-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: taskforce
-- ------------------------------------------------------
-- Server version	5.7.29-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `icon_url` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (9,'Переводы',''),(10,'Уборка',''),(11,'Переезды',''),(12,'Компьютерная помощь',''),(13,'Ремонт квартирный',''),(14,'Ремонт техники',''),(15,'Красота',''),(16,'Фото','');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `last_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `task_id_idx` (`task_id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `task_id_ch` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id_ch` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (1,1,41,'Привет','2020-12-27 23:47:58'),(2,2,42,'Добрый день','2020-12-27 23:47:58'),(3,3,43,'Добрый вечер','2020-12-27 23:47:58'),(4,4,43,'Привет','2020-12-27 23:47:58'),(5,4,43,'Слишком дешево','2020-12-27 23:47:58'),(6,5,44,'Доброе утро','2020-12-27 23:47:58'),(7,5,44,'Готов сделать работу но позже','2020-12-27 23:47:58'),(8,5,44,'Вы согласны?','2020-12-27 23:47:58');
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2217 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (1109,'Абаза'),(1110,'Абакан'),(1111,'Абдулино'),(1112,'Абинск'),(1113,'Агидель'),(1114,'Агрыз'),(1115,'Адыгейск'),(1116,'Азнакаево'),(1117,'Азов'),(1118,'Ак-Довурак'),(1119,'Аксай'),(1120,'Алагир'),(1121,'Алапаевск'),(1122,'Алатырь'),(1123,'Алдан'),(1124,'Алейск'),(1125,'Александров'),(1126,'Александровск'),(1127,'Александровск-Сахалинский'),(1128,'Алексеевка'),(1129,'Алексин'),(1130,'Алзамай'),(1131,'Алушта'),(1132,'Альметьевск'),(1133,'Амурск'),(1134,'Анадырь'),(1135,'Анапа'),(1136,'Ангарск'),(1137,'Андреаполь'),(1138,'Анжеро-Судженск'),(1139,'Анива'),(1140,'Апатиты'),(1141,'Апрелевка'),(1142,'Апшеронск'),(1143,'Арамиль'),(1144,'Аргун'),(1145,'Ардатов'),(1146,'Ардон'),(1147,'Арзамас'),(1148,'Аркадак'),(1149,'Армавир'),(1150,'Армянск'),(1151,'Арсеньев'),(1152,'Арск'),(1153,'Артем'),(1154,'Артемовск'),(1155,'Артемовский'),(1156,'Архангельск'),(1157,'Асбест'),(1158,'Асино'),(1159,'Астрахань'),(1160,'Аткарск'),(1161,'Ахтубинск'),(1162,'Ачинск'),(1163,'Аша'),(1164,'Бабаево'),(1165,'Бабушкин'),(1166,'Бавлы'),(1167,'Багратионовск'),(1168,'Байкальск'),(1169,'Баймак'),(1170,'Бакал'),(1171,'Баксан'),(1172,'Балабаново'),(1173,'Балаково'),(1174,'Балахна'),(1175,'Балашиха'),(1176,'Балашов'),(1177,'Балей'),(1178,'Балтийск'),(1179,'Барабинск'),(1180,'Барнаул'),(1181,'Барыш'),(1182,'Батайск'),(1183,'Бахчисарай'),(1184,'Бежецк'),(1185,'Белая Калитва'),(1186,'Белая Холуница'),(1187,'Белгород'),(1188,'Белебей'),(1189,'Белев'),(1190,'Белинский'),(1191,'Белово'),(1192,'Белогорск'),(1193,'Белогорск'),(1194,'Белозерск'),(1195,'Белокуриха'),(1196,'Беломорск'),(1197,'Белорецк'),(1198,'Белореченск'),(1199,'Белоусово'),(1200,'Белоярский'),(1201,'Белый'),(1202,'Бердск'),(1203,'Березники'),(1204,'Березовский'),(1205,'Березовский'),(1206,'Беслан'),(1207,'Бийск'),(1208,'Бикин'),(1209,'Билибино'),(1210,'Биробиджан'),(1211,'Бирск'),(1212,'Бирюсинск'),(1213,'Бирюч'),(1214,'Благовещенск'),(1215,'Благовещенск'),(1216,'Благодарный'),(1217,'Бобров'),(1218,'Богданович'),(1219,'Богородицк'),(1220,'Богородск'),(1221,'Боготол'),(1222,'Богучар'),(1223,'Бодайбо'),(1224,'Бокситогорск'),(1225,'Болгар'),(1226,'Бологое'),(1227,'Болотное'),(1228,'Болохово'),(1229,'Болхов'),(1230,'Большой Камень'),(1231,'Бор'),(1232,'Борзя'),(1233,'Борисоглебск'),(1234,'Боровичи'),(1235,'Боровск'),(1236,'Бородино'),(1237,'Братск'),(1238,'Бронницы'),(1239,'Брянск'),(1240,'Бугульма'),(1241,'Бугуруслан'),(1242,'Буденновск'),(1243,'Бузулук'),(1244,'Буинск'),(1245,'Буй'),(1246,'Буйнакск'),(1247,'Бутурлиновка'),(1248,'Валдай'),(1249,'Валуйки'),(1250,'Велиж'),(1251,'Великие Луки'),(1252,'Великий Новгород'),(1253,'Великий Устюг'),(1254,'Вельск'),(1255,'Венев'),(1256,'Верещагино'),(1257,'Верея'),(1258,'Верхнеуральск'),(1259,'Верхний Тагил'),(1260,'Верхний Уфалей'),(1261,'Верхняя Пышма'),(1262,'Верхняя Салда'),(1263,'Верхняя Тура'),(1264,'Верхотурье'),(1265,'Верхоянск'),(1266,'Весьегонск'),(1267,'Ветлуга'),(1268,'Видное'),(1269,'Вилюйск'),(1270,'Вилючинск'),(1271,'Вихоревка'),(1272,'Вичуга'),(1273,'Владивосток'),(1274,'Владикавказ'),(1275,'Владимир'),(1276,'Волгоград'),(1277,'Волгодонск'),(1278,'Волгореченск'),(1279,'Волжск'),(1280,'Волжский'),(1281,'Вологда'),(1282,'Володарск'),(1283,'Волоколамск'),(1284,'Волосово'),(1285,'Волхов'),(1286,'Волчанск'),(1287,'Вольск'),(1288,'Воркута'),(1289,'Воронеж'),(1290,'Ворсма'),(1291,'Воскресенск'),(1292,'Воткинск'),(1293,'Всеволожск'),(1294,'Вуктыл'),(1295,'Выборг'),(1296,'Выкса'),(1297,'Высоковск'),(1298,'Высоцк'),(1299,'Вытегра'),(1300,'Вышний Волочек'),(1301,'Вяземский'),(1302,'Вязники'),(1303,'Вязьма'),(1304,'Вятские Поляны'),(1305,'Гаврилов Посад'),(1306,'Гаврилов-Ям'),(1307,'Гагарин'),(1308,'Гаджиево'),(1309,'Гай'),(1310,'Галич'),(1311,'Гатчина'),(1312,'Гвардейск'),(1313,'Гдов'),(1314,'Геленджик'),(1315,'Георгиевск'),(1316,'Глазов'),(1317,'Голицыно'),(1318,'Горбатов'),(1319,'Горно-Алтайск'),(1320,'Горнозаводск'),(1321,'Горняк'),(1322,'Городец'),(1323,'Городище'),(1324,'Городовиковск'),(1325,'Гороховец'),(1326,'Горячий Ключ'),(1327,'Грайворон'),(1328,'Гремячинск'),(1329,'Грозный'),(1330,'Грязи'),(1331,'Грязовец'),(1332,'Губаха'),(1333,'Губкин'),(1334,'Губкинский'),(1335,'Гудермес'),(1336,'Гуково'),(1337,'Гулькевичи'),(1338,'Гурьевск'),(1339,'Гурьевск'),(1340,'Гусев'),(1341,'Гусиноозерск'),(1342,'Гусь-Хрустальный'),(1343,'Давлеканово'),(1344,'Дагестанские Огни'),(1345,'Далматово'),(1346,'Дальнегорск'),(1347,'Дальнереченск'),(1348,'Данилов'),(1349,'Данков'),(1350,'Дегтярск'),(1351,'Дедовск'),(1352,'Демидов'),(1353,'Дербент'),(1354,'Десногорск'),(1355,'Джанкой'),(1356,'Дзержинск'),(1357,'Дзержинский'),(1358,'Дивногорск'),(1359,'Дигора'),(1360,'Димитровград'),(1361,'Дмитриев'),(1362,'Дмитров'),(1363,'Дмитровск'),(1364,'Дно'),(1365,'Добрянка'),(1366,'Долгопрудный'),(1367,'Долинск'),(1368,'Домодедово'),(1369,'Донецк'),(1370,'Донской'),(1371,'Дорогобуж'),(1372,'Дрезна'),(1373,'Дубна'),(1374,'Дубовка'),(1375,'Дудинка'),(1376,'Духовщина'),(1377,'Дюртюли'),(1378,'Дятьково'),(1379,'Евпатория'),(1380,'Егорьевск'),(1381,'Ейск'),(1382,'Екатеринбург'),(1383,'Елабуга'),(1384,'Елец'),(1385,'Елизово'),(1386,'Ельня'),(1387,'Еманжелинск'),(1388,'Емва'),(1389,'Енисейск'),(1390,'Ермолино'),(1391,'Ершов'),(1392,'Ессентуки'),(1393,'Ефремов'),(1394,'Железноводск'),(1395,'Железногорск'),(1396,'Железногорск'),(1397,'Железногорск-Илимский'),(1398,'Жердевка'),(1399,'Жигулевск'),(1400,'Жиздра'),(1401,'Жирновск'),(1402,'Жуков'),(1403,'Жуковка'),(1404,'Жуковский'),(1405,'Завитинск'),(1406,'Заводоуковск'),(1407,'Заволжск'),(1408,'Заволжье'),(1409,'Задонск'),(1410,'Заинск'),(1411,'Закаменск'),(1412,'Заозерный'),(1413,'Заозерск'),(1414,'Западная Двина'),(1415,'Заполярный'),(1416,'Зарайск'),(1417,'Заречный'),(1418,'Заречный'),(1419,'Заринск'),(1420,'Звенигово'),(1421,'Звенигород'),(1422,'Зверево'),(1423,'Зеленогорск'),(1424,'Зеленоградск'),(1425,'Зеленодольск'),(1426,'Зеленокумск'),(1427,'Зерноград'),(1428,'Зея'),(1429,'Зима'),(1430,'Златоуст'),(1431,'Злынка'),(1432,'Змеиногорск'),(1433,'Знаменск'),(1434,'Зубцов'),(1435,'Зуевка'),(1436,'Ивангород'),(1437,'Иваново'),(1438,'Ивантеевка'),(1439,'Ивдель'),(1440,'Игарка'),(1441,'Ижевск'),(1442,'Избербаш'),(1443,'Изобильный'),(1444,'Иланский'),(1445,'Инза'),(1446,'Инкерман'),(1447,'Иннополис'),(1448,'Инсар'),(1449,'Инта'),(1450,'Ипатово'),(1451,'Ирбит'),(1452,'Иркутск'),(1453,'Исилькуль'),(1454,'Искитим'),(1455,'Истра'),(1456,'Ишим'),(1457,'Ишимбай'),(1458,'Йошкар-Ола'),(1459,'Кадников'),(1460,'Казань'),(1461,'Калач'),(1463,'Калач-на-Дону'),(1462,'Калачинск'),(1464,'Калининград'),(1465,'Калининск'),(1466,'Калтан'),(1467,'Калуга'),(1468,'Калязин'),(1469,'Камбарка'),(1470,'Каменка'),(1471,'Каменногорск'),(1472,'Каменск-Уральский'),(1473,'Каменск-Шахтинский'),(1474,'Камень-на-Оби'),(1475,'Камешково'),(1476,'Камызяк'),(1477,'Камышин'),(1478,'Камышлов'),(1479,'Канаш'),(1480,'Кандалакша'),(1481,'Канск'),(1482,'Карабаново'),(1483,'Карабаш'),(1484,'Карабулак'),(1485,'Карасук'),(1486,'Карачаевск'),(1487,'Карачев'),(1488,'Каргат'),(1489,'Каргополь'),(1490,'Карпинск'),(1491,'Карталы'),(1492,'Касимов'),(1493,'Касли'),(1494,'Каспийск'),(1495,'Катав-Ивановск'),(1496,'Катайск'),(1497,'Качканар'),(1498,'Кашин'),(1499,'Кашира'),(1500,'Кедровый'),(1501,'Кемерово'),(1502,'Кемь'),(1503,'Керчь'),(1504,'Кизел'),(1505,'Кизилюрт'),(1506,'Кизляр'),(1507,'Кимовск'),(1508,'Кимры'),(1509,'Кингисепп'),(1510,'Кинель'),(1511,'Кинешма'),(1512,'Киреевск'),(1513,'Киренск'),(1514,'Киржач'),(1515,'Кириллов'),(1516,'Кириши'),(1517,'Киров'),(1518,'Киров'),(1519,'Кировград'),(1520,'Кирово-Чепецк'),(1521,'Кировск'),(1522,'Кировск'),(1523,'Кирс'),(1524,'Кирсанов'),(1525,'Киселевск'),(1526,'Кисловодск'),(1527,'Клин'),(1528,'Клинцы'),(1529,'Княгинино'),(1530,'Ковдор'),(1531,'Ковров'),(1532,'Ковылкино'),(1533,'Когалым'),(1534,'Кодинск'),(1535,'Козельск'),(1536,'Козловка'),(1537,'Козьмодемьянск'),(1538,'Кола'),(1539,'Кологрив'),(1540,'Коломна'),(1541,'Колпашево'),(1542,'Кольчугино'),(1543,'Коммунар'),(1544,'Комсомольск'),(1545,'Комсомольск-на-Амуре'),(1546,'Конаково'),(1547,'Кондопога'),(1548,'Кондрово'),(1549,'Константиновск'),(1550,'Копейск'),(1551,'Кораблино'),(1552,'Кореновск'),(1553,'Коркино'),(1554,'Королев'),(1555,'Короча'),(1556,'Корсаков'),(1557,'Коряжма'),(1558,'Костерево'),(1559,'Костомукша'),(1560,'Кострома'),(1561,'Котельники'),(1562,'Котельниково'),(1563,'Котельнич'),(1564,'Котлас'),(1565,'Котово'),(1566,'Котовск'),(1567,'Кохма'),(1568,'Красавино'),(1569,'Красноармейск'),(1570,'Красноармейск'),(1571,'Красновишерск'),(1572,'Красногорск'),(1573,'Краснодар'),(1574,'Краснозаводск'),(1575,'Краснознаменск'),(1576,'Краснознаменск'),(1577,'Краснокаменск'),(1578,'Краснокамск'),(1579,'Красноперекопск'),(1580,'Краснослободск'),(1581,'Краснослободск'),(1582,'Краснотурьинск'),(1583,'Красноуральск'),(1584,'Красноуфимск'),(1585,'Красноярск'),(1586,'Красный Кут'),(1587,'Красный Сулин'),(1588,'Красный Холм'),(1589,'Кременки'),(1590,'Кропоткин'),(1591,'Крымск'),(1592,'Кстово'),(1593,'Кубинка'),(1594,'Кувандык'),(1595,'Кувшиново'),(1596,'Кудымкар'),(1597,'Кузнецк'),(1598,'Куйбышев'),(1599,'Кулебаки'),(1600,'Кумертау'),(1601,'Кунгур'),(1602,'Купино'),(1603,'Курган'),(1604,'Курганинск'),(1605,'Курильск'),(1606,'Курлово'),(1607,'Куровское'),(1608,'Курск'),(1609,'Куртамыш'),(1610,'Курчатов'),(1611,'Куса'),(1612,'Кушва'),(1613,'Кызыл'),(1614,'Кыштым'),(1615,'Кяхта'),(1616,'Лабинск'),(1617,'Лабытнанги'),(1618,'Лагань'),(1619,'Ладушкин'),(1620,'Лаишево'),(1621,'Лакинск'),(1622,'Лангепас'),(1623,'Лахденпохья'),(1624,'Лебедянь'),(1625,'Лениногорск'),(1626,'Ленинск'),(1627,'Ленинск-Кузнецкий'),(1628,'Ленск'),(1629,'Лермонтов'),(1630,'Лесной'),(1631,'Лесозаводск'),(1632,'Лесосибирск'),(1633,'Ливны'),(1634,'Ликино-Дулево'),(1635,'Липецк'),(1636,'Липки'),(1637,'Лиски'),(1638,'Лихославль'),(1639,'Лобня'),(1640,'Лодейное Поле'),(1641,'Лосино-Петровский'),(1642,'Луга'),(1643,'Луза'),(1644,'Лукоянов'),(1645,'Луховицы'),(1646,'Лысково'),(1647,'Лысьва'),(1648,'Лыткарино'),(1649,'Льгов'),(1650,'Любань'),(1651,'Люберцы'),(1652,'Любим'),(1653,'Людиново'),(1654,'Лянтор'),(1655,'Магадан'),(1656,'Магас'),(1657,'Магнитогорск'),(1658,'Майкоп'),(1659,'Майский'),(1660,'Макаров'),(1661,'Макарьев'),(1662,'Макушино'),(1663,'Малая Вишера'),(1664,'Малгобек'),(1665,'Малмыж'),(1666,'Малоархангельск'),(1667,'Малоярославец'),(1668,'Мамадыш'),(1669,'Мамоново'),(1670,'Мантурово'),(1671,'Мариинск'),(1672,'Мариинский Посад'),(1673,'Маркс'),(1674,'Махачкала'),(1675,'Мглин'),(1676,'Мегион'),(1677,'Медвежьегорск'),(1678,'Медногорск'),(1679,'Медынь'),(1680,'Межгорье'),(1681,'Междуреченск'),(1682,'Мезень'),(1683,'Меленки'),(1684,'Мелеуз'),(1685,'Менделеевск'),(1686,'Мензелинск'),(1687,'Мещовск'),(1688,'Миасс'),(1689,'Микунь'),(1690,'Миллерово'),(1691,'Минеральные Воды'),(1692,'Минусинск'),(1693,'Миньяр'),(1694,'Мирный'),(1695,'Мирный'),(1696,'Михайлов'),(1697,'Михайловка'),(1698,'Михайловск'),(1699,'Михайловск'),(1700,'Мичуринск'),(1701,'Могоча'),(1702,'Можайск'),(1703,'Можга'),(1704,'Моздок'),(1705,'Мончегорск'),(1706,'Морозовск'),(1707,'Моршанск'),(1708,'Мосальск'),(1709,'Муравленко'),(1710,'Мураши'),(1711,'Мурманск'),(1712,'Муром'),(1713,'Мценск'),(1714,'Мыски'),(1715,'Мытищи'),(1716,'Мышкин'),(1717,'Набережные Челны'),(1718,'Навашино'),(1719,'Наволоки'),(1720,'Надым'),(1721,'Назарово'),(1722,'Назрань'),(1723,'Называевск'),(1724,'Нальчик'),(1725,'Нариманов'),(1726,'Наро-Фоминск'),(1727,'Нарткала'),(1728,'Нарьян-Мар'),(1729,'Находка'),(1730,'Невель'),(1731,'Невельск'),(1732,'Невинномысск'),(1733,'Невьянск'),(1734,'Нелидово'),(1735,'Неман'),(1736,'Нерехта'),(1737,'Нерчинск'),(1738,'Нерюнгри'),(1739,'Нестеров'),(1740,'Нефтегорск'),(1741,'Нефтекамск'),(1742,'Нефтекумск'),(1743,'Нефтеюганск'),(1744,'Нея'),(1745,'Нижневартовск'),(1746,'Нижнекамск'),(1747,'Нижнеудинск'),(1748,'Нижние Серги'),(1749,'Нижний Ломов'),(1750,'Нижний Новгород'),(1751,'Нижний Тагил'),(1752,'Нижняя Салда'),(1753,'Нижняя Тура'),(1754,'Николаевск'),(1755,'Николаевск-на-Амуре'),(1756,'Никольск'),(1757,'Никольск'),(1758,'Никольское'),(1759,'Новая Ладога'),(1760,'Новая Ляля'),(1761,'Новоалександровск'),(1762,'Новоалтайск'),(1763,'Новоаннинский'),(1764,'Нововоронеж'),(1765,'Новодвинск'),(1766,'Новозыбков'),(1767,'Новокубанск'),(1768,'Новокузнецк'),(1769,'Новокуйбышевск'),(1770,'Новомичуринск'),(1771,'Новомосковск'),(1772,'Новопавловск'),(1773,'Новоржев'),(1774,'Новороссийск'),(1775,'Новосибирск'),(1776,'Новосиль'),(1777,'Новосокольники'),(1778,'Новотроицк'),(1779,'Новоузенск'),(1780,'Новоульяновск'),(1781,'Новоуральск'),(1782,'Новохоперск'),(1783,'Новочебоксарск'),(1784,'Новочеркасск'),(1785,'Новошахтинск'),(1786,'Новый Оскол'),(1787,'Новый Уренгой'),(1788,'Ногинск'),(1789,'Нолинск'),(1790,'Норильск'),(1791,'Ноябрьск'),(1792,'Нурлат'),(1793,'Нытва'),(1794,'Нюрба'),(1795,'Нягань'),(1796,'Нязепетровск'),(1797,'Няндома'),(1798,'Облучье'),(1799,'Обнинск'),(1800,'Обоянь'),(1801,'Обь'),(1802,'Одинцово'),(1803,'Озерск'),(1804,'Озерск'),(1805,'Озеры'),(1806,'Октябрьск'),(1807,'Октябрьский'),(1808,'Окуловка'),(1809,'Олекминск'),(1810,'Оленегорск'),(1811,'Олонец'),(1812,'Омск'),(1813,'Омутнинск'),(1814,'Онега'),(1815,'Опочка'),(1816,'Орёл'),(1817,'Оренбург'),(1818,'Орехово-Зуево'),(1819,'Орлов'),(1820,'Орск'),(1821,'Оса'),(1822,'Осинники'),(1823,'Осташков'),(1824,'Остров'),(1825,'Островной'),(1826,'Острогожск'),(1827,'Отрадное'),(1828,'Отрадный'),(1829,'Оха'),(1830,'Оханск'),(1831,'Очер'),(1832,'Павлово'),(1833,'Павловск'),(1834,'Павловский Посад'),(1835,'Палласовка'),(1836,'Партизанск'),(1837,'Певек'),(1838,'Пенза'),(1839,'Первомайск'),(1840,'Первоуральск'),(1841,'Перевоз'),(1842,'Пересвет'),(1843,'Переславль-Залесский'),(1844,'Пермь'),(1845,'Пестово'),(1846,'Петров Вал'),(1847,'Петровск'),(1848,'Петровск-Забайкальский'),(1849,'Петрозаводск'),(1850,'Петропавловск-Камчатский'),(1851,'Петухово'),(1852,'Петушки'),(1853,'Печора'),(1854,'Печоры'),(1855,'Пикалево'),(1856,'Пионерский'),(1857,'Питкяранта'),(1858,'Плавск'),(1859,'Пласт'),(1860,'Плес'),(1861,'Поворино'),(1862,'Подольск'),(1863,'Подпорожье'),(1864,'Покачи'),(1865,'Покров'),(1866,'Покровск'),(1867,'Полевской'),(1868,'Полесск'),(1869,'Полысаево'),(1870,'Полярные Зори'),(1871,'Полярный'),(1872,'Поронайск'),(1873,'Порхов'),(1874,'Похвистнево'),(1875,'Почеп'),(1876,'Починок'),(1877,'Пошехонье'),(1878,'Правдинск'),(1879,'Приволжск'),(1880,'Приморск'),(1881,'Приморск'),(1882,'Приморско-Ахтарск'),(1883,'Приозерск'),(1884,'Прокопьевск'),(1885,'Пролетарск'),(1886,'Протвино'),(1887,'Прохладный'),(1888,'Псков'),(1889,'Пугачев'),(1890,'Пудож'),(1891,'Пустошка'),(1892,'Пучеж'),(1893,'Пушкино'),(1894,'Пущино'),(1895,'Пыталово'),(1896,'Пыть-Ях'),(1897,'Пятигорск'),(1898,'Радужный'),(1899,'Радужный'),(1900,'Райчихинск'),(1901,'Раменское'),(1902,'Рассказово'),(1903,'Ревда'),(1904,'Реж'),(1905,'Реутов'),(1906,'Ржев'),(1907,'Родники'),(1908,'Рославль'),(1909,'Россошь'),(1910,'Ростов'),(1911,'Ростов-на-Дону'),(1912,'Рошаль'),(1913,'Ртищево'),(1914,'Рубцовск'),(1915,'Рудня'),(1916,'Руза'),(1917,'Рузаевка'),(1918,'Рыбинск'),(1919,'Рыбное'),(1920,'Рыльск'),(1921,'Ряжск'),(1922,'Рязань'),(1923,'Саки'),(1924,'Салават'),(1925,'Салаир'),(1926,'Салехард'),(1927,'Сальск'),(1928,'Самара'),(1929,'Саранск'),(1930,'Сарапул'),(1931,'Саратов'),(1932,'Саров'),(1933,'Сасово'),(1934,'Сатка'),(1935,'Сафоново'),(1936,'Саяногорск'),(1937,'Саянск'),(1938,'Светлогорск'),(1939,'Светлоград'),(1940,'Светлый'),(1941,'Светогорск'),(1942,'Свирск'),(1943,'Свободный'),(1944,'Себеж'),(1947,'Северо-Курильск'),(1945,'Северобайкальск'),(1946,'Северодвинск'),(1948,'Североморск'),(1949,'Североуральск'),(1950,'Северск'),(1951,'Севск'),(1952,'Сегежа'),(1953,'Сельцо'),(1954,'Семенов'),(1955,'Семикаракорск'),(1956,'Семилуки'),(1957,'Сенгилей'),(1958,'Серафимович'),(1959,'Сергач'),(1960,'Сергиев Посад'),(1961,'Сердобск'),(1962,'Серов'),(1963,'Серпухов'),(1964,'Сертолово'),(1965,'Сибай'),(1966,'Сим'),(1967,'Симферополь'),(1968,'Сковородино'),(1969,'Скопин'),(1970,'Славгород'),(1971,'Славск'),(1972,'Славянск-на-Кубани'),(1973,'Сланцы'),(1974,'Слободской'),(1975,'Слюдянка'),(1976,'Смоленск'),(1977,'Снежинск'),(1978,'Снежногорск'),(1979,'Собинка'),(1980,'Советск'),(1981,'Советск'),(1982,'Советск'),(1983,'Советская Гавань'),(1984,'Советский'),(1985,'Сокол'),(1986,'Солигалич'),(1987,'Соликамск'),(1988,'Солнечногорск'),(1990,'Соль-Илецк'),(1989,'Сольвычегодск'),(1991,'Сольцы'),(1992,'Сорочинск'),(1993,'Сорск'),(1994,'Сортавала'),(1995,'Сосенский'),(1996,'Сосновка'),(1997,'Сосновоборск'),(1998,'Сосновый Бор'),(1999,'Сосногорск'),(2000,'Сочи'),(2001,'Спас-Деменск'),(2002,'Спас-Клепики'),(2003,'Спасск'),(2004,'Спасск-Дальний'),(2005,'Спасск-Рязанский'),(2006,'Среднеколымск'),(2007,'Среднеуральск'),(2008,'Сретенск'),(2009,'Ставрополь'),(2010,'Старая Купавна'),(2011,'Старая Русса'),(2012,'Старица'),(2013,'Стародуб'),(2014,'Старый Крым'),(2015,'Старый Оскол'),(2016,'Стерлитамак'),(2017,'Стрежевой'),(2018,'Строитель'),(2019,'Струнино'),(2020,'Ступино'),(2021,'Суворов'),(2022,'Судак'),(2023,'Суджа'),(2024,'Судогда'),(2025,'Суздаль'),(2026,'Суоярви'),(2027,'Сураж'),(2028,'Сургут'),(2029,'Суровикино'),(2030,'Сурск'),(2031,'Сусуман'),(2032,'Сухиничи'),(2033,'Сухой Лог'),(2034,'Сызрань'),(2035,'Сыктывкар'),(2036,'Сысерть'),(2037,'Сычевка'),(2038,'Сясьстрой'),(2039,'Тавда'),(2040,'Таганрог'),(2041,'Тайга'),(2042,'Тайшет'),(2043,'Талдом'),(2044,'Талица'),(2045,'Тамбов'),(2046,'Тара'),(2047,'Тарко-Сале'),(2048,'Таруса'),(2049,'Татарск'),(2050,'Таштагол'),(2051,'Тверь'),(2052,'Теберда'),(2053,'Тейково'),(2054,'Темников'),(2055,'Темрюк'),(2056,'Терек'),(2057,'Тетюши'),(2058,'Тимашевск'),(2059,'Тихвин'),(2060,'Тихорецк'),(2061,'Тобольск'),(2062,'Тогучин'),(2063,'Тольятти'),(2064,'Томари'),(2065,'Томмот'),(2066,'Томск'),(2067,'Топки'),(2068,'Торжок'),(2069,'Торопец'),(2070,'Тосно'),(2071,'Тотьма'),(2072,'Трехгорный'),(2073,'Троицк'),(2074,'Трубчевск'),(2075,'Туапсе'),(2076,'Туймазы'),(2077,'Тула'),(2078,'Тулун'),(2079,'Туран'),(2080,'Туринск'),(2081,'Тутаев'),(2082,'Тында'),(2083,'Тырныауз'),(2084,'Тюкалинск'),(2085,'Тюмень'),(2086,'Уварово'),(2087,'Углегорск'),(2088,'Углич'),(2089,'Удачный'),(2090,'Удомля'),(2091,'Ужур'),(2092,'Узловая'),(2093,'Улан-Удэ'),(2094,'Ульяновск'),(2095,'Унеча'),(2096,'Урай'),(2097,'Урень'),(2098,'Уржум'),(2099,'Урюпинск'),(2100,'Усинск'),(2101,'Усмань'),(2102,'Усолье'),(2103,'Усолье-Сибирское'),(2104,'Уссурийск'),(2105,'Усть-Джегута'),(2106,'Усть-Илимск'),(2107,'Усть-Катав'),(2108,'Усть-Кут'),(2109,'Усть-Лабинск'),(2110,'Устюжна'),(2111,'Уфа'),(2112,'Ухта'),(2113,'Учалы'),(2114,'Уяр'),(2115,'Фатеж'),(2116,'Феодосия'),(2117,'Фокино'),(2118,'Фокино'),(2119,'Фролово'),(2120,'Фрязино'),(2121,'Фурманов'),(2122,'Хабаровск'),(2123,'Хадыженск'),(2124,'Ханты-Мансийск'),(2125,'Харабали'),(2126,'Харовск'),(2127,'Хасавюрт'),(2128,'Хвалынск'),(2129,'Хилок'),(2130,'Химки'),(2131,'Холм'),(2132,'Холмск'),(2133,'Хотьково'),(2134,'Цивильск'),(2135,'Цимлянск'),(2136,'Циолковский'),(2137,'Чадан'),(2138,'Чайковский'),(2139,'Чапаевск'),(2140,'Чаплыгин'),(2141,'Чебаркуль'),(2142,'Чебоксары'),(2143,'Чегем'),(2144,'Чекалин'),(2145,'Челябинск'),(2146,'Чердынь'),(2147,'Черемхово'),(2148,'Черепаново'),(2149,'Череповец'),(2150,'Черкесск'),(2151,'Чермоз'),(2152,'Черноголовка'),(2153,'Черногорск'),(2154,'Чернушка'),(2155,'Черняховск'),(2156,'Чехов'),(2157,'Чистополь'),(2158,'Чита'),(2159,'Чкаловск'),(2160,'Чудово'),(2161,'Чулым'),(2162,'Чусовой'),(2163,'Чухлома'),(2164,'Шагонар'),(2165,'Шадринск'),(2166,'Шали'),(2167,'Шарыпово'),(2168,'Шарья'),(2169,'Шатура'),(2170,'Шахты'),(2171,'Шахунья'),(2172,'Шацк'),(2173,'Шебекино'),(2174,'Шелехов'),(2175,'Шенкурск'),(2176,'Шилка'),(2177,'Шимановск'),(2178,'Шиханы'),(2179,'Шлиссельбург'),(2180,'Шумерля'),(2181,'Шумиха'),(2182,'Шуя'),(2183,'Щекино'),(2184,'Щелкино'),(2185,'Щелково'),(2186,'Щигры'),(2187,'Щучье'),(2188,'Электрогорск'),(2189,'Электросталь'),(2190,'Электроугли'),(2191,'Элиста'),(2192,'Энгельс'),(2193,'Эртиль'),(2194,'Югорск'),(2195,'Южа'),(2196,'Южно-Сахалинск'),(2197,'Южно-Сухокумск'),(2198,'Южноуральск'),(2199,'Юрга'),(2201,'Юрьев-Польский'),(2200,'Юрьевец'),(2202,'Юрюзань'),(2203,'Юхнов'),(2204,'Ядрин'),(2205,'Якутск'),(2206,'Ялта'),(2207,'Ялта'),(2208,'Ялуторовск'),(2209,'Янаул'),(2210,'Яранск'),(2211,'Яровое'),(2212,'Ярославль'),(2213,'Ярцево'),(2214,'Ясногорск'),(2215,'Ясный'),(2216,'Яхрома');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `html_form` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'successfully','&lt;h2&gt;#text#&lt;/h2&gt;'),(2,'warning','&lt;h2 style=\'color: red;\'&gt;#text#&lt;/h2&gt;');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favourites`
--

DROP TABLE IF EXISTS `favourites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favourites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `favourite_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_fav_idx` (`user_id`),
  KEY `favourite_id_fav_idx` (`favourite_id`),
  CONSTRAINT `favourite_id_fav` FOREIGN KEY (`favourite_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id_fav` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favourites`
--

LOCK TABLES `favourites` WRITE;
/*!40000 ALTER TABLE `favourites` DISABLE KEYS */;
INSERT INTO `favourites` VALUES (1,41,42),(2,41,43),(3,41,44),(4,45,43),(5,45,44),(6,45,46),(7,45,47);
/*!40000 ALTER TABLE `favourites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files_task`
--

DROP TABLE IF EXISTS `files_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `files_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `url_file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files_task`
--

LOCK TABLES `files_task` WRITE;
/*!40000 ALTER TABLE `files_task` DISABLE KEYS */;
/*!40000 ALTER TABLE `files_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `text` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`recipient_id`),
  KEY `event_id_idx` (`event_id`),
  CONSTRAINT `event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id_not` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (1,1,41,'Новый отклик к заданию'),(2,2,42,'Отказ от задания исполнителем'),(3,1,43,'Новое сообщение в чате'),(4,1,44,'Старт задания'),(5,1,45,'Новое сообщение в чате'),(6,1,43,'Завершение задания');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo_work`
--

DROP TABLE IF EXISTS `photo_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `photo_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `url_photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_p` (`user_id`),
  CONSTRAINT `user_id_p` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo_work`
--

LOCK TABLES `photo_work` WRITE;
/*!40000 ALTER TABLE `photo_work` DISABLE KEYS */;
/*!40000 ALTER TABLE `photo_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `response`
--

DROP TABLE IF EXISTS `response`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `response` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `description` longtext,
  `last_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `task_id_res_idx` (`task_id`),
  KEY `user_id_res_idx` (`user_id`),
  CONSTRAINT `task_id_res` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id_res` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `response`
--

LOCK TABLES `response` WRITE;
/*!40000 ALTER TABLE `response` DISABLE KEYS */;
INSERT INTO `response` VALUES (1,1,43,3,'Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.\n\nQuisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.','2020-12-27 23:34:50'),(2,2,41,2,'Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.\n\nSed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.\n\nPellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.','2020-12-27 23:34:50'),(3,3,42,2,'Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.\n\nPhasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.','2020-12-27 23:34:50'),(4,4,43,2,'Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.\n\nDonec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.','2020-12-27 23:34:50'),(5,5,44,1,'Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.','2020-12-27 23:34:50'),(6,6,45,3,'In congue. Etiam justo. Etiam pretium iaculis justo.','2020-12-27 23:34:50'),(7,7,47,5,'In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.\n\nSed ante. Vivamus tortor. Duis mattis egestas metus.','2020-12-27 23:34:50'),(8,8,48,2,'Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.\n\nInteger tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.','2020-12-27 23:34:50'),(9,8,50,2,'Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.\n\nQuisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.','2020-12-27 23:34:50'),(10,9,55,4,'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.','2020-12-27 23:34:50');
/*!40000 ALTER TABLE `response` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `selected_notification`
--

DROP TABLE IF EXISTS `selected_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `selected_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value_name_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `value_name_id_idx` (`value_name_id`),
  KEY `user_id_sn_idx` (`user_id`),
  CONSTRAINT `user_id_sn` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `value_name_id` FOREIGN KEY (`value_name_id`) REFERENCES `value_notification` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `selected_notification`
--

LOCK TABLES `selected_notification` WRITE;
/*!40000 ALTER TABLE `selected_notification` DISABLE KEYS */;
INSERT INTO `selected_notification` VALUES (1,11,42),(2,12,42),(3,13,42),(4,14,42),(5,13,43),(6,14,43),(7,15,44),(8,13,44),(9,12,43),(10,15,45),(11,15,46),(12,13,47);
/*!40000 ALTER TABLE `selected_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `date_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` int(11) DEFAULT NULL,
  `status` enum('new','in_work','done','failed','cancel') NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date_create_idx` (`date_create`),
  KEY `title_idx` (`title`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,50,'Уборка','Помыть полы во всей квартире','2020-12-27 22:35:42',NULL,'new',NULL,NULL),(2,51,'enable impactful technologies','Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.','2020-12-27 23:16:14',6587,'new','1 Eagan Crossing','2019-11-15'),(3,52,'exploit revolutionary portals','Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.','2020-12-27 23:16:14',2904,'new','24043 Paget Alley','2019-12-07'),(4,53,'matrix next-generation e-commerce','Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.','2020-12-27 23:16:14',1170,'new','2867 Dryden Pass','2019-11-23'),(5,54,'benchmark plug-and-play infomediaries','Fusce consequat. Nulla nisl. Nunc nisl.','2020-12-27 23:16:14',838,'cancel','80 Cambridge Street','2019-11-10'),(6,55,'integrate cross-platform e-business','Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.','2020-12-27 23:16:14',7484,'cancel','1 Stone Corner Junction','2019-12-15'),(7,56,'enable dot-com niches','Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.','2020-12-27 23:16:14',5725,'in_work','12 Stephen Terrace','2019-11-24'),(8,57,'transform web-enabled relationships','Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.','2020-12-27 23:16:14',4414,'in_work','6213 Lake View Drive','2019-11-19'),(9,58,'strategize frictionless solutions','Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.','2020-12-27 23:16:14',3454,'done','994 Corry Park','2019-11-14'),(10,59,'innovate seamless metrics','Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.','2020-12-27 23:16:14',3101,'done','2 Bluestem Park','2019-12-12'),(11,60,'integrate wireless infomediaries','Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.','2020-12-27 23:16:14',6562,'failed','1 Dexter Hill','2019-12-19');
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_category`
--

DROP TABLE IF EXISTS `task_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `task_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id_tc` (`task_id`),
  KEY `category_id_tc_idx` (`category_id`),
  CONSTRAINT `category_id_tc` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `task_id_tc` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_category`
--

LOCK TABLES `task_category` WRITE;
/*!40000 ALTER TABLE `task_category` DISABLE KEYS */;
INSERT INTO `task_category` VALUES (1,9,1),(2,10,2),(3,11,3),(4,12,4),(5,13,5),(6,13,6),(7,13,7),(8,14,8),(9,14,9);
/*!40000 ALTER TABLE `task_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_category`
--

DROP TABLE IF EXISTS `user_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `category_id_uc_idx` (`category_id`),
  CONSTRAINT `category_id_uc` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id_uc` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_category`
--

LOCK TABLES `user_category` WRITE;
/*!40000 ALTER TABLE `user_category` DISABLE KEYS */;
INSERT INTO `user_category` VALUES (1,41,9),(2,41,10),(3,41,11),(4,42,10),(5,43,13),(6,43,14),(7,45,11),(8,46,15),(9,47,16);
/*!40000 ALTER TABLE `user_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `city_id` int(10) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  `description` longtext,
  `role` enum('employer','implementer') NOT NULL,
  `birthday` varchar(10) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `skype` varchar(45) DEFAULT NULL,
  `telegram` varchar(45) DEFAULT NULL,
  `last_visit` datetime NOT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `name` (`name`),
  KEY `city_id_idx` (`city_id`),
  CONSTRAINT `city_id_us` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (41,'Karrie Buttress','kbuttress0@1und1.de',1109,'JcfoKBYAB4k','','employer','','9175580744','','@sdf','2019-08-10 00:00:00','','2019-12-10'),(42,'Bob Aymer','baymer1@hp.com',1122,'ZEE54kg','','employer','','9175587064','','@007f','2018-12-21 00:00:00','','2019-08-15'),(43,'Zilvia Boulding','zboulding2@macromedia.com',1124,'VJyMV1Zat','','employer','','0575587744','','@001','2019-07-25 00:00:00','','2019-08-24'),(44,'Emalee Mollon','emollon3@bloglovin.com',1125,'XUIeJ693h','','employer','','9103587744','','@super','2018-11-13 00:00:00','','2019-08-22'),(45,'Maria Mulberry','mmulberry4@cmu.edu',1126,'oWspnl','','employer','','9170287744','','','2019-07-20 00:00:00','','2019-08-18'),(46,'Levey By','lby5@mozilla.com',1127,'GdtcUU','','employer','','9175500744','','','2019-02-12 00:00:00','','2019-08-15'),(47,'Baron Eates','beates6@last.fm',1127,'UQw6VeA','','employer','','9177777744','','','2019-05-03 00:00:00','','2019-08-18'),(48,'Trip Vink','tvink7@fotki.com',1128,'49znXd7haFGz','','employer','','9172587744','sidor','','2019-01-13 00:00:00','','2017-08-10'),(49,'Boonie Terbeck','bterbeck8@about.me',1186,'unCjJTF7sjs','','implementer','','9175587744','pavel77','','2019-09-15 00:00:00','','2019-08-19'),(50,'Alonzo Traviss','atraviss9@auda.org.au',1199,'dLuVMAg','','implementer','','9175599744','ole55','','2018-12-19 00:00:00','','2019-08-12'),(51,'Natassia Wittering','nwitteringa@google.com.br',1189,'tQlUG4n','','implementer','','9175667744','grant200','','2019-03-24 00:00:00','','2019-06-10'),(52,'Felice Brooke','fbrookeb@nba.com',1179,'s9y9Mcfgy1g','','implementer','','9175583344','','','2019-09-27 00:00:00','','2019-07-10'),(53,'Carlen Viccary','cviccaryc@amazon.co.uk',1169,'9qd747vh','','implementer','','9171187744','','','2018-12-06 00:00:00','','2016-08-10'),(54,'Hendrik Gethings','hgethingsd@sogou.com',1169,'zzN5c4','','implementer','','9175545744','','','2018-11-18 00:00:00','','2012-08-10'),(55,'Dunc Girodias','dgirodiase@stanford.edu',1159,'j9QW6GQI','','implementer','','9175586644','','','2018-10-14 00:00:00','','2015-08-10'),(56,'Bibbie Tanman','btanmanf@smh.com.au',1139,'1aukKNEIneq','','implementer','','9175587744','','','2019-05-03 00:00:00','','2011-08-10'),(57,'Barnabas Bartoletti','bbartolettig@simplemachines.org',1129,'3chTNtqhoo','','implementer','','9110587744','','','2018-12-25 00:00:00','','2013-08-10'),(58,'Nixie Cullip','nculliph@fc2.com',1114,'2UdKIR2f','','implementer','','9175587744','1109','','2019-04-07 00:00:00','','2019-08-10'),(59,'Matilde Pimblott','mpimblotti@xing.com',1113,'nGZ8disdg','','implementer','','9175587124','','','2019-07-18 00:00:00','','2019-01-10'),(60,'Al Skurray','askurrayj@un.org',1112,'bL9tAf','','implementer','','91755877412','','','2018-11-25 00:00:00','','2019-08-01');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `value_notification`
--

DROP TABLE IF EXISTS `value_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `value_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `value_notification`
--

LOCK TABLES `value_notification` WRITE;
/*!40000 ALTER TABLE `value_notification` DISABLE KEYS */;
INSERT INTO `value_notification` VALUES (11,'Новый отклик к заданию'),(12,'Новое сообщение в чате'),(13,'Отказ от задания исполнителем'),(14,'Старт задания'),(15,'Завершение задания');
/*!40000 ALTER TABLE `value_notification` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-29  1:19:38
