-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-09-29 20:42:01
-- 服务器版本： 5.7.22
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tvaf`
--

-- --------------------------------------------------------

--
-- 表的结构 `t_member`
--

CREATE TABLE `t_member` (
  `id` int(10) UNSIGNED NOT NULL,
  `region` varchar(8) DEFAULT NULL COMMENT '国家区位码',
  `mobile` varchar(16) DEFAULT NULL COMMENT '手机号码',
  `nickname` varchar(64) DEFAULT NULL COMMENT '会员昵称',
  `headimgurl` varchar(256) DEFAULT NULL COMMENT '会员头像',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别：男性（1），女性（2）',
  `age` tinyint(4) DEFAULT NULL COMMENT '年龄',
  `create_time` datetime NOT NULL,
  `update_time` datetime DEFAULT NULL,
  `delete_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员基础信息表';

--
-- 转存表中的数据 `t_member`
--

INSERT INTO `t_member` (`id`, `region`, `mobile`, `nickname`, `headimgurl`, `sex`, `age`, `create_time`, `update_time`, `delete_time`) VALUES
(3, '86', '15975594050', NULL, NULL, 1, NULL, '2018-09-29 20:27:37', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `t_member_authority`
--

CREATE TABLE `t_member_authority` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '关联的会员Id，0表示未关联',
  `platform` tinyint(4) NOT NULL COMMENT '第三方平台：微信公众号（1），微信App（2），微信小程序（3），支付宝（4）',
  `openid` varchar(64) NOT NULL COMMENT '第三方平台唯一识别码，例如微信的 openid',
  `unionid` varchar(64) DEFAULT NULL COMMENT '关联id，例如微信的unionid',
  `nickname` varchar(64) DEFAULT NULL COMMENT '昵称',
  `headimgurl` varchar(256) DEFAULT NULL COMMENT '头像',
  `sex` tinyint(4) DEFAULT NULL COMMENT '性别',
  `country` varchar(32) DEFAULT NULL COMMENT '国家',
  `province` varchar(32) DEFAULT NULL COMMENT '省份',
  `city` varchar(32) DEFAULT NULL COMMENT '城市',
  `create_time` datetime NOT NULL,
  `update_time` datetime DEFAULT NULL,
  `delete_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员第三方授权信息表';

--
-- 转存表中的数据 `t_member_authority`
--

INSERT INTO `t_member_authority` (`id`, `member_id`, `platform`, `openid`, `unionid`, `nickname`, `headimgurl`, `sex`, `country`, `province`, `city`, `create_time`, `update_time`, `delete_time`) VALUES
(1, 3, 3, 'o-R7q0H4IaSf0LVQkyXpqknyr4kc', NULL, '被梦想绊倒', 'https://wx.qlogo.cn/mmopen/vi_32/pJ1ODykgkkTkQRJsOfbxODI4CFfiaQ0kUCo53SRYvn3g0Ua60Jic5aULe3MicxF39tgClwXmuqE11CPWEf9QJ6YAg/132', 1, '', '', '', '2018-09-29 18:51:10', '2018-09-29 20:33:52', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_member`
--
ALTER TABLE `t_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_member_authority`
--
ALTER TABLE `t_member_authority`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `t_member`
--
ALTER TABLE `t_member`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `t_member_authority`
--
ALTER TABLE `t_member_authority`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
