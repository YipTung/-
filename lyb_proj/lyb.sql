-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-03-13 16:10:00
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lyb`
--
CREATE DATABASE IF NOT EXISTS `lyb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lyb`;

-- --------------------------------------------------------

--
-- 表的结构 `lyb_info`
--

CREATE TABLE IF NOT EXISTS `lyb_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `disp_f` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(20) NOT NULL,
  `publish_time` datetime NOT NULL,
  `ly_type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `lyb_info`
--

INSERT INTO `lyb_info` (`id`, `disp_f`, `title`, `content`, `author`, `publish_time`, `ly_type`) VALUES
(1, 1, 'IT维护十五年，为什么他要扔掉工作进深山采蜜？', '　　新疆干果名满天下，新疆蜂蜜却少人知，14年历史的蜜友蜂蜜来啦！\r\n　　蜂蜜这个东西好，大家都知道。然而现在很多人被假蜜吓住了，宁可不吃蜜，来逃避吃到假蜂蜜。可是牛奶多少年前就有人说有假啊。难道牛奶也不喝了吗？\r\n　　说到底，我们不能因噎废食。还是要往好的地方看。\r\n　　今天我就开个帖，说说我们新疆的天山里的蜂蜜。', 'wlpjll', '2017-10-31 22:57:11', '故事'),
(2, 0, '情感X谈：你会公共场合怒怼前任吗？', '　　这几天，周杰伦演唱会上“小仙女”怒怼前任“算什么男人”?吵得沸沸扬扬……\r\n　　基本分成两派，一是小仙女好耿直啊，好稀饭啊啊啊！！\r\n　　二是，感情的事情为什么要到这种场合上说呢，而且如果是和平分手，为什么要对前任这么苛刻……\r\n　　讲真，小编看第一遍视频的时候，也觉得，这个小仙女好酷哦，竟然敢这样怒怼前任。妹纸也许是受了很严重的情伤……后面事情好像有了反转，这个就暂表不提了……\r\n　　小编想问问各位天涯er，如果是你，你会在公共场合怒怼前任吗？\r\n　　小编先说，作为腹黑的天蝎座,在小编心里，前任就是你若不好，我才是晴天啊(←_←话说你不是母胎单身的小编吗?前任在哪）心里再怎么os，你这么瞎找了一个比我还差的，能不能看清楚之类的话是不会当面说出来的，最多背后吐槽下。但是在公共场合，应该还是会为了面子，不会轻易开撕的，毕竟自己都这么美了，人家还看不上，外人看来会觉得是自己的脾气不好，所以才分手的┑(￣Д ￣)┍）', 'xx', '2017-10-31 13:17:14', '情感'),
(3, 0, '房产税来了，就在不远处', '　　把我们的口号唱起来：2018，1.5%,无免征\r\n　　2018，1.5%,无免征\r\n　　100元抄底漂亮女房奴\r\n　　玩他女人，吃他泡面，只要100元\r\n\r\n　　2018年悄悄的马上就要到来了，我们要怀着无比期待的心情迎接房产税的来临。\r\n　　相信北纯钢，就是相信未来。\r\n　　口号再次响起来：2018，1.5%,无免征，\r\n　　100元抄底漂亮女房奴\r\n　　玩他女人，吃他泡面，只要100元', '北京纯刚需', '2017-10-31 19:44:32', '经济'),
(4, 0, '来上一杯“莫吉托”，读出哈瓦那的烈焰和月光', '古巴哈瓦那不走上一遍，能行吗？那里“一半是海水，一半是火焰”！政治偶像有卡斯特罗、切·格瓦拉，文化大腕有海明威，在这座中南美洲的大城留下种种轶闻和传奇……', '给月光加点盐', '2017-10-01 10:08:50', '旅游'),
(5, 0, '骑着三轮走天涯---138天环游中国', '　　前言 :\r\n\r\n　　此次环游中国，用时138天，行程2万5千公里，穿越16个省，圆了我十年的梦想。\r\n\r\n　　我是一个纯粹的摩旅爱好者，从94年开始玩摩托并酷爱用摩托旅行，我的座右铭就是“Live To Ride, Ride To Live”，因为摩托车比起汽车旅行，更自由更震撼，你不仅能看到、听到，也能闻到。', 'jackey_cheung', '2017-01-13 23:32:00', '旅游'),
(6, 1, '双11节前综合征：搏出位刷存在，皆为流量狂', '双11节前综合征：搏出位刷存在，皆为流量狂！', '贾也', '2017-11-06 23:02:11', '杂谈'),
(7, 0, '网购“玩法”诈骗多,且莫因贪失了大', '　　“双十一”等电商大促期间往往是网络诈骗活跃期,各类诈骗如钓鱼木马、中奖诈骗、退款诈骗、货到付款诈骗、秒杀诈骗等层出不穷。消费者要注意保护个人信息,并避免贪小失大。（2017-11-05 新华网）\r\n\r\n　　今年已是“双十一”的第9年，“双十一”营造了国内一年一度的“消费狂欢”,其影响力也逐渐扩大到全球。但在国内市场,其中不禁“玩法”多，而且违法违规行为也多有发生,不仅损害了消费者的权益,而且破坏了网购的生态环境,需要“剁手族”们擦亮眼睛。中国电子商务投诉与维权公共服务平台于近日公布的统计显示,“双十一”后一个月内是消费投诉高峰期,数量也呈现逐年上升趋势,其中2015年同比上年增长18.60%,2016年同比上年增长26.27%。', '阳信人来了', '2017-11-07 07:53:00', '新闻'),
(8, 0, 'KLASSE14全新OKTO系列腕表——颠覆传统腕表定义！', '腕表百年，传统腕表则多为圆形和方形，KLASSE14勇于突破，发布全新OKTO系列腕表，以独具创意的腕表形状，颠覆腕表常规美学，突破设计壁垒。', 'KLASSE14', '2017-07-25 11:53:00', '时尚');

-- --------------------------------------------------------

--
-- 表的结构 `lyb_sx`
--

CREATE TABLE IF NOT EXISTS `lyb_sx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sendto` varchar(20) NOT NULL,
  `sendfrom` varchar(20) NOT NULL,
  `content` varchar(400) NOT NULL,
  `sendtime` datetime NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lyb_sx`
--

INSERT INTO `lyb_sx` (`id`, `sendto`, `sendfrom`, `content`, `sendtime`, `view`) VALUES
(1, 'admin', 'hahaha', 'hahaha to admin 1', '2018-01-08 00:00:00', 0),
(2, 'hahaha', 'admin', 'admin to hahaha1', '2018-01-10 12:19:38', 0);

-- --------------------------------------------------------

--
-- 表的结构 `lyb_vote_item`
--

CREATE TABLE IF NOT EXISTS `lyb_vote_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vote_id` int(11) NOT NULL,
  `item_name` varchar(60) NOT NULL,
  `vote_num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `lyb_vote_item`
--

INSERT INTO `lyb_vote_item` (`id`, `vote_id`, `item_name`, `vote_num`) VALUES
(1, 1, '数据库', 16),
(2, 1, 'Vue2', 12),
(3, 1, '虚拟现实', 9),
(4, 2, '二人间', 8),
(5, 2, '四人间', 15),
(6, 2, '六人间', 6),
(7, 2, '八人间', 0);

-- --------------------------------------------------------

--
-- 表的结构 `lyb_vote_main`
--

CREATE TABLE IF NOT EXISTS `lyb_vote_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `originater` varchar(20) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lyb_vote_main`
--

INSERT INTO `lyb_vote_main` (`id`, `title`, `state`, `originater`, `start_time`, `end_time`) VALUES
(1, '最喜欢哪门课？', 1, 'admin', '2018-01-08 17:25:36', '2018-02-28 23:59:59'),
(2, '希望宿舍是几人间？', 1, 'hahaha', '2018-01-10 14:11:49', '2018-01-31 23:59:59');

-- --------------------------------------------------------

--
-- 表的结构 `reply_info`
--

CREATE TABLE IF NOT EXISTS `reply_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ly_id` int(11) NOT NULL,
  `replyer` varchar(20) NOT NULL,
  `reply_time` datetime NOT NULL,
  `reply_cont` varchar(200) NOT NULL,
  `disp_r` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `reply_info`
--

INSERT INTO `reply_info` (`id`, `ly_id`, `replyer`, `reply_time`, `reply_cont`, `disp_r`) VALUES
(1, 1, 'hahaha', '2017-12-01 08:20:27', '回复测试,这是二楼!!!', 1),
(2, 1, 'hahaha', '2017-12-02 15:21:11', '回复测试,这是三楼!!!', 0),
(3, 1, 'hahaha', '2017-12-02 19:40:23', '还是回复测试,这是四楼!!!', 0),
(17, 1, 'hahaha', '2017-12-06 09:26:56', '回复测试持续中', 0),
(18, 1, 'hahaha', '2017-12-06 09:27:36', '回复测试持续中!!! 这是十九楼!!!', 0);

-- --------------------------------------------------------

--
-- 表的结构 `user_dj`
--

CREATE TABLE IF NOT EXISTS `user_dj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dj_name` varchar(5) NOT NULL,
  `dj_score` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `user_dj`
--

INSERT INTO `user_dj` (`id`, `dj_name`, `dj_score`) VALUES
(1, '倔强青铜', 0),
(2, '秩序白银', 250),
(3, '荣耀黄金', 500),
(4, '尊贵铂金', 1000),
(5, '永恒钻石', 2500),
(6, '至尊星耀', 5000),
(8, '最强王者', 10000),
(9, '荣耀王者', 20000);

-- --------------------------------------------------------

--
-- 表的结构 `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `intro` text NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `power` int(11) NOT NULL DEFAULT '2',
  `user_dj` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- 转存表中的数据 `user_info`
--

INSERT INTO `user_info` (`id`, `user_name`, `password`, `telephone`, `email`, `intro`, `score`, `power`, `user_dj`) VALUES
(1, '蔡宏德', '2016061002301', '', '', '', 0, 2, 1),
(2, '曾安琪', '2016061002302', '', '', '', 0, 2, 1),
(3, '陈佳樱', '2016061002303', '', '', '', 0, 2, 1),
(4, '陈凯', '2016061002304', '', '', '', 0, 2, 1),
(5, '陈思彤', '2016061002305', '', '', '', 0, 2, 1),
(6, '陈晓炯', '2016061002306', '', '', '', 0, 2, 1),
(7, '邓家慧', '2016061002307', '', '', '', 0, 2, 1),
(8, '郭斯敏', '2016061002308', '', '', '', 0, 2, 1),
(9, '何满儿', '2016061002309', '', '', '', 0, 2, 1),
(10, '黄剑华', '2016061002310', '', '', '', 0, 2, 1),
(11, '黄文锦', '2016061002311', '', '', '', 0, 2, 1),
(12, '黄信凯', '2016061002312', '', '', '', 0, 2, 1),
(13, '柯华凤', '2016061002313', '', '', '', 0, 2, 1),
(14, '李春宁', '2016061002314', '', '', '', 0, 2, 1),
(15, '李发发', '2016061002315', '', '', '', 0, 2, 1),
(16, '李洁纯', '2016061002316', '', '', '', 0, 2, 1),
(17, '梁敏怡', '2016061002317', '', '', '', 0, 2, 1),
(18, '梁晓文', '2016061002318', '', '', '', 0, 2, 1),
(19, '梁晓云', '2016061002319', '', '', '', 0, 2, 1),
(20, '梁烨彤', '2016061002320', '', '', '', 20000, 0, 9),
(21, '梁泽金', '2016061002321', '', '', '', 0, 2, 1),
(22, '林佩怡', '2016061002322', '', '', '', 0, 2, 1),
(23, '刘丽珊', '2016061002323', '', '', '', 0, 2, 1),
(24, '罗雨贺', '2016061002324', '', '', '', 0, 2, 1),
(25, '邱浩贤', '2016061002325', '', '', '', 0, 2, 1),
(26, '邱雨微', '2016061002326', '', '', '', 0, 2, 1),
(27, '欧柏贤', '2016061002327', '', '', '', 0, 2, 1),
(28, '苏伟', '2016061002328', '', '', '', 0, 2, 1),
(29, '唐泽彬', '2016061002329', '', '', '', 0, 2, 1),
(30, '陶佩佩', '2016061002330', '', '', '', 0, 2, 1),
(31, '王和旭', '2016061002331', '', '', '', 0, 2, 1),
(32, '王静纯', '2016061002332', '', '', '', 0, 2, 1),
(33, '王晓滨', '2016061002333', '', '', '', 0, 2, 1),
(34, '韦圣枫', '2016061002334', '', '', '', 0, 2, 1),
(35, '吴君', '2016061002335', '', '', '', 0, 2, 1),
(36, '谢善创', '2016061002336', '', '', '', 0, 2, 1),
(37, '许京族', '2016061002337', '', '', '', 0, 2, 1),
(38, '杨杭杰', '2016061002338', '', '', '', 0, 2, 1),
(39, '杨剑锋', '2016061002339', '', '', '', 0, 2, 1),
(40, '姚俊莹', '2016061002340', '', '', '', 0, 2, 1),
(41, '叶燕霞', '2016061002341', '', '', '', 0, 2, 1),
(42, '俞志霖', '2016061002342', '', '', '', 0, 2, 1),
(43, '詹高峰', '2016061002343', '', '', '', 0, 2, 1),
(44, '郑慧琦', '2016061002344', '', '', '', 0, 2, 1),
(45, '郑燕芳', '2016061002345', '', '', '', 0, 2, 1),
(46, '郑宇睿', '2016061002346', '', '', '', 0, 2, 1),
(47, '林炜勋', '2016061002347', '', '', '', 0, 2, 1),
(48, 'hahaha', '123456', '694067', '', '', 0, 1, 1),
(50, 'admin', '123456', '694067', '', '', 0, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
