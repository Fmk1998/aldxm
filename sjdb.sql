-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 12 月 08 日 14:02
-- 服务器版本: 5.5.40
-- PHP 版本: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `sjdb`
--

-- --------------------------------------------------------

--
-- 表的结构 `admindb`
--

CREATE TABLE IF NOT EXISTS `admindb` (
  `Id` varchar(20) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `admindb`
--

INSERT INTO `admindb` (`Id`, `Name`, `Password`) VALUES
('02108063', 'admin', '123456');

-- --------------------------------------------------------

--
-- 表的结构 `filedb`
--

CREATE TABLE IF NOT EXISTS `filedb` (
  `studentid` varchar(20) NOT NULL,
  `task` int(20) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `state` int(20) NOT NULL,
  `brief` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

-- --------------------------------------------------------

--
-- 表的结构 `informationdb`
--

CREATE TABLE IF NOT EXISTS `informationdb` (
  `studentid` varchar(20) NOT NULL,
  `teacherid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

-- --------------------------------------------------------

--
-- 表的结构 `ptable`
--

CREATE TABLE IF NOT EXISTS `ptable` (
  `sid` varchar(50) NOT NULL DEFAULT '',
  `pid1` varchar(20) NOT NULL,
  `pid2` varchar(20) NOT NULL,
  `pfid` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

-- --------------------------------------------------------

--
-- 表的结构 `studentdb`
--

CREATE TABLE IF NOT EXISTS `studentdb` (
  `Id` varchar(15) NOT NULL,
  `Name` varchar(15) NOT NULL,
  `Password` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `studentdb`
--

INSERT INTO `studentdb` (`Id`, `Name`, `Password`) VALUES
('132208101102', '石宇', '123456'),
('132216101126', '周航', '123456'),
('142208100001', '章悦', '123456'),
('142208100002', '许文俊', '123456'),
('142208100003', '陈艺伦', '123456'),
('142208100004', '张传粟', '123456'),
('142208100005', '胡媛媛', '123456'),
('142208100006', '马丽萍', '123456'),
('142208100007', '汤佳树', '123456'),
('142208100008', '郑龙', '123456'),
('142208100009', '吴家杰', '123456'),
('142208100010', '卫俊俊', '123456'),
('142208100011', '胡佳睿', '123456'),
('142208100012', '钱辉煌', '123456'),
('142208100013', '熊康', '123456'),
('142208100014', '章逸豪', '123456'),
('142208100015', '丁文婕', '123456'),
('142208100016', '李明聪', '123456'),
('142208100017', '潘登峰', '123456'),
('142208100019', '彭尤旺', '123456'),
('142208100020', '熊骏', '123456'),
('142208100021', '朱磊', '123456'),
('142208100022', '李博华', '123456'),
('142208100023', '江婷', '123456'),
('142208100024', '王jun岚', '123456'),
('142208100025', '吴方凯', '123456'),
('142208100026', '曹敏', '123456'),
('142208100027', '邱恭锐', '123456'),
('142208100029', '陈文楷', '123456'),
('142208100030', '骆聪', '123456'),
('142208100031', '舒明', '123456'),
('142208100032', '李谦', '123456'),
('142208100033', '谭波', '123456'),
('142208100034', '饶巍博', '123456'),
('142208100035', '魏振', '123456'),
('142208100036', '周嵩', '123456'),
('142208100037', '祝斌', '123456'),
('142208100039', '黄远胜', '123456'),
('142208100041', '吴芬', '123456'),
('142208100043', '薛超', '123456'),
('142208100044', '李振鹏', '123456'),
('142208100045', '方英', '123456'),
('142208100046', '杨斌', '123456'),
('142208100047', '黄正戟', '123456'),
('142208100049', '杜冬楠', '123456'),
('142208100050', '王超群', '123456'),
('142208100052', '陈捷', '123456'),
('142208100053', '李婷', '123456'),
('142208100055', '杨玄凯', '123456'),
('142208100056', '计志远', '123456'),
('142208100057', '赵昕宇', '123456'),
('142208100058', '程誉晓', '123456'),
('142208100060', '蔡鑫', '123456'),
('142208100061', '刘洋', '123456'),
('142208100062', '许玲', '123456'),
('142208100063', '熊业超', '123456'),
('142208100064', '张浩', '123456'),
('142208100065', '刘正伟', '123456'),
('142208100066', '李安琪', '123456'),
('142208100067', '刘邦华', '123456'),
('142208100068', '郑周博', '123456'),
('142208100071', '方聪', '123456'),
('142208100072', '王熙康', '123456'),
('142208100073', '姚琪', '123456'),
('142208100074', '陶婉芳', '123456'),
('142208100075', '陈理祥', '123456'),
('142208100077', '陈浩', '123456'),
('142208100078', '高天雄', '123456'),
('142208100079', '徐欢', '123456'),
('142208100081', '陈泽', '123456'),
('142208100083', '宫磊', '123456'),
('142208100084', '王先苗', '123456'),
('142208100086', '李周行', '123456'),
('142208100087', '姚紫溪', '123456'),
('142208100088', '汪仕元', '123456'),
('142208100089', '严宽', '123456'),
('142208100090', '李凡伊', '123456'),
('142208100091', '陈顺哲', '123456'),
('142208100092', '李启刚', '123456'),
('142208100094', '江小祥', '123456'),
('142208100095', '王龙', '123456'),
('142208100096', '张志刚', '123456'),
('142208100097', '翁正康', '123456'),
('142208100098', '胡凌锐', '123456'),
('142208100099', '卢炳翰', '123456'),
('142208100100', '王铮', '123456'),
('142208100101', '薛铁龙', '123456'),
('142208100102', '奚家萌', '123456'),
('142208100103', '孙昌胤', '123456'),
('142208100104', '潘爽', '123456'),
('142208100105', '袁鹏', '123456'),
('142208100106', '孙泽文', '123456'),
('142208100107', '卫来', '123456'),
('142208100108', '吴胜强', '123456'),
('142208100109', '丁怡威', '123456'),
('142208100111', '黄英棋', '123456'),
('142208100112', '王志强', '123456'),
('142208100113', '施翠霞', '123456'),
('142208100114', '陈安勤', '123456'),
('142208100115', '江辉', '123456'),
('142208100116', '陈帅', '123456'),
('142208100117', '雷高杰', '123456'),
('142208100118', '李雨阳', '123456'),
('142208100119', '周茂根', '123456'),
('142208100120', '桂萌萌', '123456'),
('142208100122', '尹思淇', '123456'),
('142208100123', '何小冬', '123456'),
('142208100126', '宋志辉', '123456'),
('142208100127', '李俊男', '123456'),
('142208100129', '陈子乐', '123456'),
('142208100130', '唐诗', '123456'),
('142208100131', '张伟', '123456'),
('142208100132', '邓泽林', '123456'),
('142208100133', '蔡志伟', '123456'),
('142208100134', '郑兴', '123456'),
('142208100135', '杨帆', '123456'),
('142208100136', '桂永康', '123456'),
('142208100137', '陈玲', '123456'),
('142208100138', '夏宇', '123456'),
('142208100139', '鲁标', '123456'),
('142208100140', '彭钟清', '123456'),
('142208100141', '吴耀霆', '123456'),
('142208100142', '张昱雯', '123456'),
('142208100143', '张科', '123456'),
('142208100144', '童永欣', '123456'),
('142208100145', '周木华', '123456'),
('142208100146', '罗先强', '123456'),
('142208100147', '范路欣', '123456'),
('142208100148', '金俊杰', '123456'),
('142208100149', '陈聪', '123456'),
('142208100150', '张疆文', '123456'),
('142208100151', '陈超', '123456'),
('142208100152', '刘全辉', '123456'),
('142208100153', '肖佳华', '123456'),
('142208100154', '张琴', '123456'),
('142208100155', '王超', '123456'),
('142208100156', '孙恒', '123456'),
('142208100157', '费嘉伟', '123456'),
('142208100158', '库科', '123456'),
('142208100159', '蔡放', '123456'),
('142208100160', '胡羽西', '123456'),
('142208100161', '陆蓉', '123456'),
('142208100162', '李金松', '123456'),
('142208101101', '张有顺', '123456'),
('142208101102', '方若冰', '123456'),
('142208101103', '陆逊', '123456'),
('142208101104', '段灏灏', '123456'),
('142208101105', '姚若莹', '123456'),
('142208101107', '张乾', '123456'),
('142208101108', '陆哲宁', '123456'),
('142208101110', '李星宇', '123456'),
('142208101111', '鄢明昊', '123456'),
('142208101112', '汪旺', '123456'),
('142208101113', '胡梦蔷', '123456'),
('142208101116', '倪飞', '123456'),
('142208101117', '李明', '123456'),
('142208101119', '肖行', '123456'),
('142208101122', '陈迪', '123456'),
('142208101123', '夏雨', '123456'),
('142208101124', '曹毅', '123456'),
('142208101125', '刘展', '123456'),
('142208101127', '陈玉成', '123456'),
('142208101128', '余满霞', '123456'),
('142208101129', '魏雪', '123456'),
('142208101131', '朱险', '123456'),
('142208101132', '姚彩', '123456'),
('142208101136', '唐建涛', '123456'),
('142208101137', '蔡孝阳', '123456'),
('142208101138', '曾磊', '123456'),
('142208101139', '吴奇峰', '123456'),
('142208101140', '杨凯', '123456'),
('142208101141', '徐凡', '123456'),
('142209101136', '戢宇光', '123456'),
('142209101307', '朱s钛', '123456'),
('142209101337', '汪本骏', '123456'),
('142209104129', '刘耀', '123456'),
('142209107117', '丁成', '123456'),
('142209201234', '郭旭东', '123456'),
('142212101204', '樊盛华', '123456');

-- --------------------------------------------------------

--
-- 表的结构 `teacherdb`
--

CREATE TABLE IF NOT EXISTS `teacherdb` (
  `Id` varchar(20) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `maxpnum` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `teacherdb`
--

INSERT INTO `teacherdb` (`Id`, `Name`, `Password`, `maxpnum`) VALUES
('02108013', '沈整', '123456', 5),
('02108015', '朱伟', '123456', 5),
('02108027', '辜艺', '123456', 5),
('02108028', '程辉', '123456', 5),
('02108033', '许中元', '123456', 5),
('02108037', '沈祖斌', '123456', 5),
('02108040', '方育红', '123456', 5),
('02108041', '刘继清', '123456', 5),
('02108048', '马石安', '123456', 5),
('02108049', '徐爱芸', '123456', 5),
('02108050', '郭伟', '123456', 5),
('02108056', '刘敏', '123456', 5),
('02108058', '韩海', '123456', 5),
('02108060', '欧阳泉', '123456', 5),
('02108063', '邓宏涛', '123456', 5),
('02108064', '方建斌', '123456', 5),
('02108068', '任琼', '123456', 5),
('02108071', '叶锋', '123456', 5),
('02108072', '曾鹏', '123456', 5),
('02108073', '李轶', '123456', 5),
('02108075', '朱xun', '123456', 5),
('02108076', '李登实', '123456', 5),
('02108077', '许平', '123456', 5),
('02108079', '徐宏云', '123456', 5),
('04108085', '常君明', '123456', 5),
('05108089', '罗坤', '123456', 5),
('05108090', '周静', '123456', 5),
('06108091', '陶俊', '123456', 5),
('06108092', '李相育', '123456', 5),
('09108093', '朱国华', '123456', 5),
('12108108', '李支成', '123456', 5),
('12108109', '郑四海', '123456', 5),
('13108110', '饶帆', '123456', 5),
('13108113', '戚晶晶', '123456', 5),
('13108115', '肖锋', '123456', 5),
('13108118', '江华', '123456', 5),
('15108121', '陈亦欣', '123456', 5),
('15108124', '李少伟', '123456', 5),
('17108129', '胡曦', '123456', 5);

-- --------------------------------------------------------

--
-- 表的结构 `timedb`
--

CREATE TABLE IF NOT EXISTS `timedb` (
  `taskid` int(20) NOT NULL,
  `starttime` int(20) NOT NULL,
  `endtime` int(20) NOT NULL,
  PRIMARY KEY (`taskid`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `timedb`
--

INSERT INTO `timedb` (`taskid`, `starttime`, `endtime`) VALUES
(1, 1512662400, 1512921599);

-- --------------------------------------------------------

--
-- 表的结构 `ttable`
--

CREATE TABLE IF NOT EXISTS `ttable` (
  `pid` int(50) NOT NULL AUTO_INCREMENT,
  `tid` varchar(100) NOT NULL,
  `ptitle` varchar(100) NOT NULL,
  `ptype` varchar(20) NOT NULL,
  `pcha` varchar(20) NOT NULL,
  `psource` varchar(20) NOT NULL,
  `ppnum` int(20) NOT NULL,
  `pcontent` text NOT NULL,
  `plevel` text NOT NULL,
  `pcondition` text NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
