-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- 主机: 10.4.12.173
-- 生成日期: 2014 年 12 月 13 日 16:49
-- 服务器版本: 5.1.73-0ubuntu0.10.04.1
-- PHP 版本: 5.3.2-1ubuntu4.22

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `d2efd9b54415f41ae86c7c7abf542a047`
--

-- --------------------------------------------------------

--
-- 表的结构 `tms_acct_balanceinhand`
--

CREATE TABLE IF NOT EXISTS `tms_acct_balanceinhand` (
  `bh_BalanceNO` varchar(50) NOT NULL DEFAULT '',
  `bh_BusID` varchar(20) DEFAULT NULL,
  `bh_BusNumber` varchar(20) DEFAULT NULL,
  `bh_BusUnit` varchar(50) DEFAULT NULL,
  `bh_BusModelID` varchar(20) DEFAULT NULL,
  `bh_BusModel` varchar(50) DEFAULT NULL,
  `bh_NoOfRunsID` varchar(20) DEFAULT NULL,
  `bh_LineID` varchar(30) DEFAULT NULL,
  `bh_NoOfRunsdate` char(10) DEFAULT NULL,
  `bh_BeginStationTime` char(5) DEFAULT NULL,
  `bh_StopStationTime` char(5) DEFAULT NULL,
  `bh_BeginStationID` varchar(20) DEFAULT NULL,
  `bh_BeginStation` varchar(50) DEFAULT NULL,
  `bh_FromStationID` varchar(20) DEFAULT NULL,
  `bh_FromStation` varchar(50) DEFAULT NULL,
  `bh_EndStationID` varchar(20) DEFAULT NULL,
  `bh_EndStation` varchar(50) DEFAULT NULL,
  `bh_ServiceFee` decimal(12,2) DEFAULT NULL,
  `bh_otherFee1` decimal(12,2) DEFAULT NULL,
  `bh_otherFee2` decimal(12,2) DEFAULT NULL,
  `bh_otherFee3` decimal(12,2) DEFAULT NULL,
  `bh_otherFee4` decimal(12,2) DEFAULT NULL,
  `bh_otherFee5` decimal(12,2) DEFAULT NULL,
  `bh_otherFee6` decimal(12,2) DEFAULT NULL,
  `bh_CheckTotal` smallint(6) DEFAULT NULL,
  `bh_TicketTotal` smallint(6) DEFAULT NULL,
  `bh_PriceTotal` decimal(12,1) DEFAULT NULL,
  `bh_SupTicketRen` int(11) DEFAULT NULL,
  `bh_SupTicketMoney` decimal(12,1) DEFAULT NULL,
  `bh_StationID` varchar(20) DEFAULT NULL,
  `bh_Station` varchar(50) DEFAULT NULL,
  `bh_UserID` varchar(20) DEFAULT NULL,
  `bh_User` varchar(50) DEFAULT NULL,
  `bh_Date` char(10) DEFAULT NULL,
  `bh_Time` char(5) DEFAULT NULL,
  `bh_State` varchar(50) DEFAULT NULL,
  `bh_Type` varchar(50) DEFAULT NULL,
  `bh_AccountID` varchar(50) DEFAULT NULL,
  `bh_IsAccount` tinyint(4) NOT NULL,
  `bh_ConsignMoney` decimal(12,2) DEFAULT NULL,
  `bh_BalanceMoney` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`bh_BalanceNO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_acct_balanceinhand`
--

INSERT INTO `tms_acct_balanceinhand` (`bh_BalanceNO`, `bh_BusID`, `bh_BusNumber`, `bh_BusUnit`, `bh_BusModelID`, `bh_BusModel`, `bh_NoOfRunsID`, `bh_LineID`, `bh_NoOfRunsdate`, `bh_BeginStationTime`, `bh_StopStationTime`, `bh_BeginStationID`, `bh_BeginStation`, `bh_FromStationID`, `bh_FromStation`, `bh_EndStationID`, `bh_EndStation`, `bh_ServiceFee`, `bh_otherFee1`, `bh_otherFee2`, `bh_otherFee3`, `bh_otherFee4`, `bh_otherFee5`, `bh_otherFee6`, `bh_CheckTotal`, `bh_TicketTotal`, `bh_PriceTotal`, `bh_SupTicketRen`, `bh_SupTicketMoney`, `bh_StationID`, `bh_Station`, `bh_UserID`, `bh_User`, `bh_Date`, `bh_Time`, `bh_State`, `bh_Type`, `bh_AccountID`, `bh_IsAccount`, `bh_ConsignMoney`, `bh_BalanceMoney`) VALUES
('10001', '1011002', '陕B12345', '西安001车队', '03', '小型中级', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', NULL, '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 6, 6, '330.0', 6, NULL, '7100000000', '西安', 'xaadmin', 'xaadmin', '2014-12-12', '16:37', '正常', NULL, '10110021418459606', 1, '0.00', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tms_acct_balanceinhandtemp`
--

CREATE TABLE IF NOT EXISTS `tms_acct_balanceinhandtemp` (
  `bht_BalanceNO` varchar(50) NOT NULL,
  `bht_BusID` varchar(20) DEFAULT NULL,
  `bht_BusNumber` varchar(20) DEFAULT NULL,
  `bht_BusUnit` varchar(50) DEFAULT NULL,
  `bht_BusModelID` varchar(20) DEFAULT NULL,
  `bht_BusModel` varchar(50) DEFAULT NULL,
  `bht_NoOfRunsID` varchar(20) DEFAULT NULL,
  `bht_LineID` varchar(30) DEFAULT NULL,
  `bht_NoOfRunsdate` char(10) DEFAULT NULL,
  `bht_BeginStationTime` char(5) DEFAULT NULL,
  `bht_StopStationTime` char(5) DEFAULT NULL,
  `bht_BeginStationID` varchar(20) DEFAULT NULL,
  `bht_BeginStation` varchar(50) DEFAULT NULL,
  `bht_FromStationID` varchar(20) DEFAULT NULL,
  `bht_FromStation` varchar(50) DEFAULT NULL,
  `bht_EndStationID` varchar(20) DEFAULT NULL,
  `bht_EndStation` varchar(50) DEFAULT NULL,
  `bht_ServiceFee` decimal(12,2) DEFAULT NULL,
  `bht_otherFee1` decimal(12,2) DEFAULT NULL,
  `bht_otherFee2` decimal(12,2) DEFAULT NULL,
  `bht_otherFee3` decimal(12,2) DEFAULT NULL,
  `bht_otherFee4` decimal(12,2) DEFAULT NULL,
  `bht_otherFee5` decimal(12,2) DEFAULT NULL,
  `bht_otherFee6` decimal(12,2) DEFAULT NULL,
  `bht_CheckTotal` smallint(6) DEFAULT NULL,
  `bht_TicketTotal` smallint(6) DEFAULT NULL,
  `bht_PriceTotal` decimal(12,1) DEFAULT NULL,
  `bht_SupTicketRen` int(11) DEFAULT NULL,
  `bht_StationID` varchar(20) DEFAULT NULL,
  `bht_Station` varchar(50) DEFAULT NULL,
  `bht_UserID` varchar(20) DEFAULT NULL,
  `bht_User` varchar(50) DEFAULT NULL,
  `bht_Date` char(10) DEFAULT NULL,
  `bht_Time` char(5) DEFAULT NULL,
  `bht_State` varchar(50) DEFAULT NULL,
  `bht_Type` varchar(50) DEFAULT NULL,
  `bht_AccountID` varchar(50) DEFAULT NULL,
  `bht_UserIDTemp` varchar(50) DEFAULT NULL,
  `bht_UserTemp` varchar(50) DEFAULT NULL,
  `bht_AddDateTime` datetime DEFAULT NULL,
  `bht_ConsignMoney` decimal(12,2) DEFAULT NULL,
  `bht_ReportDateTime` datetime DEFAULT NULL,
  `bht_BalanceMoney` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`bht_BalanceNO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_acct_balanceinhandtemp`
--

INSERT INTO `tms_acct_balanceinhandtemp` (`bht_BalanceNO`, `bht_BusID`, `bht_BusNumber`, `bht_BusUnit`, `bht_BusModelID`, `bht_BusModel`, `bht_NoOfRunsID`, `bht_LineID`, `bht_NoOfRunsdate`, `bht_BeginStationTime`, `bht_StopStationTime`, `bht_BeginStationID`, `bht_BeginStation`, `bht_FromStationID`, `bht_FromStation`, `bht_EndStationID`, `bht_EndStation`, `bht_ServiceFee`, `bht_otherFee1`, `bht_otherFee2`, `bht_otherFee3`, `bht_otherFee4`, `bht_otherFee5`, `bht_otherFee6`, `bht_CheckTotal`, `bht_TicketTotal`, `bht_PriceTotal`, `bht_SupTicketRen`, `bht_StationID`, `bht_Station`, `bht_UserID`, `bht_User`, `bht_Date`, `bht_Time`, `bht_State`, `bht_Type`, `bht_AccountID`, `bht_UserIDTemp`, `bht_UserTemp`, `bht_AddDateTime`, `bht_ConsignMoney`, `bht_ReportDateTime`, `bht_BalanceMoney`) VALUES
('10000', '1011002', '陕B12345', '西安001车队', '03', '小型中级', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', NULL, '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 6, 6, '330.0', 6, '7100000000', '西安', 'xaadmin', 'xaadmin', '2014-12-12', '16:36', '注销已重打', NULL, NULL, NULL, NULL, NULL, '0.00', '2014-12-12 16:36:12', '300.00'),
('10002', '1011002', '陕B12345', '西安001车队', '03', '小型中级', 'XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-13', '11:00', NULL, '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, 0, '0.0', 0, '7100000000', '西安', 'xaadmin', 'xaadmin', '2014-12-13', '16:34', '正常', NULL, NULL, NULL, NULL, NULL, '1.00', '2014-12-13 16:33:12', '0.00');

-- --------------------------------------------------------

--
-- 表的结构 `tms_acct_balancelist`
--

CREATE TABLE IF NOT EXISTS `tms_acct_balancelist` (
  `bl_BalanceNO` varchar(50) NOT NULL DEFAULT '',
  `bl_ReachStationID` varchar(20) DEFAULT NULL,
  `bl_ReachStation` varchar(50) DEFAULT NULL,
  `bl_Distance` decimal(12,2) DEFAULT NULL,
  `bl_SellPriceType` varchar(50) NOT NULL,
  `bl_SellPrice` decimal(12,1) NOT NULL,
  `bl_PriceTotal` decimal(12,1) DEFAULT NULL,
  `bl_CheckTotal` smallint(6) DEFAULT NULL,
  `bl_TicketTotal` smallint(6) DEFAULT NULL,
  `bl_ServiceFee` decimal(12,2) DEFAULT NULL,
  `bl_otherFee1` decimal(12,2) DEFAULT NULL,
  `bl_otherFee2` decimal(12,2) DEFAULT NULL,
  `bl_otherFee3` decimal(12,2) DEFAULT NULL,
  `bl_otherFee4` decimal(12,2) DEFAULT NULL,
  `bl_otherFee5` decimal(12,2) DEFAULT NULL,
  `bl_otherFee6` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`bl_BalanceNO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_acct_balancelisttemp`
--

CREATE TABLE IF NOT EXISTS `tms_acct_balancelisttemp` (
  `blt_ID` int(11) NOT NULL AUTO_INCREMENT,
  `blt_NoOfRunsID` varchar(20) DEFAULT NULL,
  `blt_BusID` varchar(20) DEFAULT NULL,
  `blt_BusNumber` varchar(20) DEFAULT NULL,
  `blt_FromStationID` varchar(20) DEFAULT NULL,
  `blt_FromStation` varchar(50) DEFAULT NULL,
  `blt_ReachStationID` varchar(20) DEFAULT NULL,
  `blt_ReachStation` varchar(50) DEFAULT NULL,
  `blt_Distance` decimal(12,2) DEFAULT NULL,
  `blt_SellPriceType` varchar(50) DEFAULT NULL,
  `blt_SellPrice` decimal(12,1) DEFAULT NULL,
  `blt_PriceTotal` decimal(12,1) DEFAULT NULL,
  `blt_CheckTotal` smallint(6) DEFAULT NULL,
  `blt_ServiceFee` decimal(12,2) DEFAULT NULL,
  `blt_otherFee1` decimal(12,2) DEFAULT NULL,
  `blt_otherFee2` decimal(12,2) DEFAULT NULL,
  `blt_otherFee3` decimal(12,2) DEFAULT NULL,
  `blt_otherFee4` decimal(12,2) DEFAULT NULL,
  `blt_otherFee5` decimal(12,2) DEFAULT NULL,
  `blt_otherFee6` decimal(12,2) DEFAULT NULL,
  `blt_UserID` varchar(20) DEFAULT NULL,
  `blt_User` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`blt_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tms_acct_busaccount`
--

CREATE TABLE IF NOT EXISTS `tms_acct_busaccount` (
  `ba_AccountID` varchar(50) NOT NULL,
  `ba_BusID` varchar(20) DEFAULT NULL,
  `ba_BusNumber` varchar(20) DEFAULT NULL,
  `ba_BusType` varchar(50) DEFAULT NULL,
  `ba_BusUnit` varchar(50) DEFAULT NULL,
  `ba_InStationID` varchar(20) DEFAULT NULL,
  `ba_InStation` varchar(50) DEFAULT NULL,
  `ba_BalanceCount` int(11) DEFAULT NULL,
  `ba_CheckTotal` int(11) DEFAULT NULL,
  `ba_Income` decimal(12,1) DEFAULT NULL,
  `ba_Paid` decimal(12,1) DEFAULT NULL,
  `ba_ServiceFee` decimal(12,2) DEFAULT NULL,
  `ba_OtherFee1` decimal(12,2) DEFAULT NULL,
  `ba_OtherFee2` decimal(12,2) DEFAULT NULL,
  `ba_OtherFee3` decimal(12,2) DEFAULT NULL,
  `ba_OtherFee4` decimal(12,2) DEFAULT NULL,
  `ba_OtherFee5` decimal(12,2) DEFAULT NULL,
  `ba_OtherFee6` decimal(12,2) DEFAULT NULL,
  `ba_Money1` decimal(12,1) DEFAULT NULL,
  `ba_Money2` decimal(12,1) DEFAULT NULL,
  `ba_Money3` decimal(12,1) DEFAULT NULL,
  `ba_Money4` decimal(12,1) DEFAULT NULL,
  `ba_Money5` decimal(12,1) DEFAULT NULL,
  `ba_Money6` decimal(12,1) DEFAULT NULL,
  `ba_Money7` decimal(12,1) DEFAULT NULL,
  `ba_Money8` decimal(12,1) DEFAULT NULL,
  `ba_Money9` decimal(12,1) DEFAULT NULL,
  `ba_Money10` decimal(12,1) DEFAULT NULL,
  `ba_Money11` decimal(12,1) DEFAULT NULL,
  `ba_Money12` decimal(12,1) DEFAULT NULL,
  `ba_Money13` decimal(12,1) DEFAULT NULL,
  `ba_Money14` decimal(12,1) DEFAULT NULL,
  `ba_Money15` decimal(12,1) DEFAULT NULL,
  `ba_Rate1` decimal(12,2) DEFAULT NULL,
  `ba_Rate2` decimal(12,2) DEFAULT NULL,
  `ba_Rate3` decimal(12,2) DEFAULT NULL,
  `ba_Rate4` decimal(12,2) DEFAULT NULL,
  `ba_Rate5` decimal(12,2) DEFAULT NULL,
  `ba_Rate6` decimal(12,2) DEFAULT NULL,
  `ba_Rate7` decimal(12,2) DEFAULT NULL,
  `ba_Rate8` decimal(12,2) DEFAULT NULL,
  `ba_Rate9` decimal(12,2) DEFAULT NULL,
  `ba_Rate10` decimal(12,2) DEFAULT NULL,
  `ba_Rate11` decimal(12,2) DEFAULT NULL,
  `ba_Rate12` decimal(12,2) DEFAULT NULL,
  `ba_Rate13` decimal(12,2) DEFAULT NULL,
  `ba_Rate14` decimal(12,2) DEFAULT NULL,
  `ba_Rate15` decimal(12,2) DEFAULT NULL,
  `ba_DateTime` datetime DEFAULT NULL,
  `ba_UserID` varchar(20) DEFAULT NULL,
  `ba_User` varchar(30) DEFAULT NULL,
  `ba_Remark` varchar(200) DEFAULT NULL,
  `ba_FeeTypeName15` varchar(20) DEFAULT NULL,
  `ba_FeeTypeName14` varchar(20) DEFAULT NULL,
  `ba_FeeTypeName13` varchar(20) DEFAULT NULL,
  `ba_FeeTypeName12` varchar(20) DEFAULT NULL,
  `ba_FeeTypeName11` varchar(20) DEFAULT NULL,
  `ba_FeeTypeName10` varchar(20) DEFAULT NULL,
  `ba_FeeTypeName9` varchar(20) DEFAULT NULL,
  `ba_FeeTypeName8` varchar(20) DEFAULT NULL,
  `ba_FeeTypeName7` varchar(20) DEFAULT NULL,
  `ba_FeeTypeName6` varchar(20) DEFAULT NULL,
  `ba_FeeTypeName5` varchar(20) DEFAULT NULL,
  `ba_FeeTypeName4` varchar(20) DEFAULT NULL,
  `ba_FeeTypeName3` varchar(20) DEFAULT NULL,
  `ba_FeeTypeName2` varchar(20) DEFAULT NULL,
  `ba_FeeTypeName1` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ba_AccountID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_acct_busaccount`
--

INSERT INTO `tms_acct_busaccount` (`ba_AccountID`, `ba_BusID`, `ba_BusNumber`, `ba_BusType`, `ba_BusUnit`, `ba_InStationID`, `ba_InStation`, `ba_BalanceCount`, `ba_CheckTotal`, `ba_Income`, `ba_Paid`, `ba_ServiceFee`, `ba_OtherFee1`, `ba_OtherFee2`, `ba_OtherFee3`, `ba_OtherFee4`, `ba_OtherFee5`, `ba_OtherFee6`, `ba_Money1`, `ba_Money2`, `ba_Money3`, `ba_Money4`, `ba_Money5`, `ba_Money6`, `ba_Money7`, `ba_Money8`, `ba_Money9`, `ba_Money10`, `ba_Money11`, `ba_Money12`, `ba_Money13`, `ba_Money14`, `ba_Money15`, `ba_Rate1`, `ba_Rate2`, `ba_Rate3`, `ba_Rate4`, `ba_Rate5`, `ba_Rate6`, `ba_Rate7`, `ba_Rate8`, `ba_Rate9`, `ba_Rate10`, `ba_Rate11`, `ba_Rate12`, `ba_Rate13`, `ba_Rate14`, `ba_Rate15`, `ba_DateTime`, `ba_UserID`, `ba_User`, `ba_Remark`, `ba_FeeTypeName15`, `ba_FeeTypeName14`, `ba_FeeTypeName13`, `ba_FeeTypeName12`, `ba_FeeTypeName11`, `ba_FeeTypeName10`, `ba_FeeTypeName9`, `ba_FeeTypeName8`, `ba_FeeTypeName7`, `ba_FeeTypeName6`, `ba_FeeTypeName5`, `ba_FeeTypeName4`, `ba_FeeTypeName3`, `ba_FeeTypeName2`, `ba_FeeTypeName1`) VALUES
('10110021418459606', '1011002', '陕B12345', '小型中级', '西安001车队', '7100000000', '西安', 1, 6, '330.0', '204.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10.00', '30.00', '20.00', '36.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2014-12-13 16:33:26', 'xaadmin', 'xaadmin', '', '', '', '', '', '', '', '', '', '', '', '', '微机费', '服务费', '人工费', '卫生费');

-- --------------------------------------------------------

--
-- 表的结构 `tms_acct_busaccounttemp`
--

CREATE TABLE IF NOT EXISTS `tms_acct_busaccounttemp` (
  `bat_AccountID` varchar(50) NOT NULL,
  `bat_BusID` varchar(20) DEFAULT NULL,
  `bat_BusNumber` varchar(20) DEFAULT NULL,
  `bat_BusType` varchar(50) DEFAULT NULL,
  `bat_BusUnit` varchar(50) DEFAULT NULL,
  `bat_BalanceCount` int(11) DEFAULT NULL,
  `bat_CheckTotal` int(11) DEFAULT NULL,
  `bat_Income` decimal(12,1) DEFAULT NULL,
  `bat_Paid` decimal(12,1) DEFAULT NULL,
  `bat_ServiceFee` decimal(12,2) DEFAULT NULL,
  `bat_OtherFee1` decimal(12,2) DEFAULT NULL,
  `bat_OtherFee2` decimal(12,2) DEFAULT NULL,
  `bat_OtherFee3` decimal(12,2) DEFAULT NULL,
  `bat_OtherFee4` decimal(12,2) DEFAULT NULL,
  `bat_OtherFee5` decimal(12,2) DEFAULT NULL,
  `bat_OtherFee6` decimal(12,2) DEFAULT NULL,
  `bat_Money1` decimal(12,1) DEFAULT NULL,
  `bat_Money2` decimal(12,1) DEFAULT NULL,
  `bat_Money3` decimal(12,1) DEFAULT NULL,
  `bat_Money4` decimal(12,1) DEFAULT NULL,
  `bat_Money5` decimal(12,1) DEFAULT NULL,
  `bat_Money6` decimal(12,1) DEFAULT NULL,
  `bat_Money7` decimal(12,1) DEFAULT NULL,
  `bat_Money8` decimal(12,1) DEFAULT NULL,
  `bat_Money9` decimal(12,1) DEFAULT NULL,
  `bat_Money10` decimal(12,1) DEFAULT NULL,
  `bat_Money11` decimal(12,1) DEFAULT NULL,
  `bat_Money12` decimal(12,1) DEFAULT NULL,
  `bat_Money13` decimal(12,1) DEFAULT NULL,
  `bat_Money14` decimal(12,1) DEFAULT NULL,
  `bat_Money15` decimal(12,1) DEFAULT NULL,
  `bat_Rate1` decimal(12,2) DEFAULT NULL,
  `bat_Rate2` decimal(12,2) DEFAULT NULL,
  `bat_Rate3` decimal(12,2) DEFAULT NULL,
  `bat_Rate4` decimal(12,2) DEFAULT NULL,
  `bat_Rate5` decimal(12,2) DEFAULT NULL,
  `bat_Rate6` decimal(12,2) DEFAULT NULL,
  `bat_Rate7` decimal(12,2) DEFAULT NULL,
  `bat_Rate8` decimal(12,2) DEFAULT NULL,
  `bat_Rate9` decimal(12,2) DEFAULT NULL,
  `bat_Rate10` decimal(12,2) DEFAULT NULL,
  `bat_Rate11` decimal(12,2) DEFAULT NULL,
  `bat_Rate12` decimal(12,2) DEFAULT NULL,
  `bat_Rate13` decimal(12,2) DEFAULT NULL,
  `bat_Rate14` decimal(12,2) DEFAULT NULL,
  `bat_Rate15` decimal(12,2) DEFAULT NULL,
  `bat_UserID` varchar(20) DEFAULT NULL,
  `bat_User` varchar(30) DEFAULT NULL,
  `bat_Remark` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`bat_AccountID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_acct_busrate`
--

CREATE TABLE IF NOT EXISTS `tms_acct_busrate` (
  `br_BusID` varchar(20) NOT NULL,
  `br_BusNumber` varchar(20) DEFAULT NULL,
  `br_BusType` varchar(50) DEFAULT NULL,
  `br_BusUnit` varchar(50) DEFAULT NULL,
  `br_InStationID` varchar(20) NOT NULL,
  `br_InStation` varchar(50) DEFAULT NULL,
  `br_LineName` varchar(50) DEFAULT NULL,
  `br_Rate1` decimal(12,2) DEFAULT NULL,
  `br_Rate2` decimal(12,2) DEFAULT NULL,
  `br_Rate3` decimal(12,2) DEFAULT NULL,
  `br_Rate4` decimal(12,2) DEFAULT NULL,
  `br_Rate5` decimal(12,2) DEFAULT NULL,
  `br_Rate6` decimal(12,2) DEFAULT NULL,
  `br_Rate7` decimal(12,2) DEFAULT NULL,
  `br_Rate8` decimal(12,2) DEFAULT NULL,
  `br_Rate9` decimal(12,2) DEFAULT NULL,
  `br_Rate10` decimal(12,2) DEFAULT NULL,
  `br_Rate11` decimal(12,2) DEFAULT NULL,
  `br_Rate12` decimal(12,2) DEFAULT NULL,
  `br_Rate13` decimal(12,2) DEFAULT NULL,
  `br_Rate14` decimal(12,2) DEFAULT NULL,
  `br_Rate15` decimal(12,2) DEFAULT NULL,
  `br_BeginDate` char(10) DEFAULT NULL,
  `br_EndDate` char(10) DEFAULT NULL,
  `br_AdderID` varchar(20) DEFAULT NULL,
  `br_Adder` varchar(30) DEFAULT NULL,
  `br_AddTime` datetime DEFAULT NULL,
  `br_ModerID` varchar(20) DEFAULT NULL,
  `br_Moder` varchar(30) DEFAULT NULL,
  `br_ModTime` datetime DEFAULT NULL,
  PRIMARY KEY (`br_BusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_acct_busrate`
--

INSERT INTO `tms_acct_busrate` (`br_BusID`, `br_BusNumber`, `br_BusType`, `br_BusUnit`, `br_InStationID`, `br_InStation`, `br_LineName`, `br_Rate1`, `br_Rate2`, `br_Rate3`, `br_Rate4`, `br_Rate5`, `br_Rate6`, `br_Rate7`, `br_Rate8`, `br_Rate9`, `br_Rate10`, `br_Rate11`, `br_Rate12`, `br_Rate13`, `br_Rate14`, `br_Rate15`, `br_BeginDate`, `br_EndDate`, `br_AdderID`, `br_Adder`, `br_AddTime`, `br_ModerID`, `br_Moder`, `br_ModTime`) VALUES
('1011001', '陕A12345', '中型中级', '西安001车队', '7100000000', '西安', '西安--成都', '10.00', '10.00', '20.00', '12.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '', 'admin', '超级管理员', '2014-12-09 14:19:24', NULL, NULL, NULL),
('1011002', '陕B12345', '小型中级', '西安001车队', '7100000000', '西安', '西安--户县', '10.00', '10.00', '20.00', '12.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '', 'admin', '超级管理员', '2014-12-09 14:19:33', NULL, NULL, NULL),
('2011001', '川A12345', '中型高级', '成都001车队', '5101000000', '成都', '', '10.00', '10.00', '20.00', '12.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '', 'admin', '超级管理员', '2014-12-09 14:19:38', NULL, NULL, NULL),
('2011002', '川B12355', '中型中级', '成都001车队', '5101000000', '成都', '', '10.00', '10.00', '20.00', '12.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '', 'admin', '超级管理员', '2014-12-09 14:19:41', NULL, NULL, NULL),
('3011001', '湘A12345', '中型中级', '长沙001车队', '4301000000', '长沙', '', '10.00', '10.00', '20.00', '12.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '', 'admin', '超级管理员', '2014-12-09 14:19:44', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tms_acct_sellpay`
--

CREATE TABLE IF NOT EXISTS `tms_acct_sellpay` (
  `sp_SellUserID` varchar(20) NOT NULL,
  `sp_SellUser` varchar(30) DEFAULT NULL,
  `sp_Station` varchar(50) DEFAULT NULL,
  `sp_SellDate` char(10) NOT NULL,
  `sp_RemainMoney` decimal(12,1) DEFAULT NULL,
  `sp_BeginTicket` varchar(20) DEFAULT NULL,
  `sp_EndTicket` varchar(20) DEFAULT NULL,
  `sp_SellMoney` decimal(12,1) DEFAULT NULL,
  `sp_SellCount` int(11) DEFAULT NULL,
  `sp_ErrMoney` decimal(12,1) DEFAULT NULL,
  `sp_ErrCount` int(11) DEFAULT NULL,
  `sp_ReturnMoney` decimal(12,1) DEFAULT NULL,
  `sp_ReturnCount` int(11) DEFAULT NULL,
  `sp_ReturnRate` decimal(12,2) DEFAULT NULL,
  `sp_SafetyMoney` decimal(12,1) DEFAULT NULL,
  `sp_SafetyCount` int(11) DEFAULT NULL,
  `sp_UpCount` int(11) DEFAULT NULL,
  `sp_UpMoney` decimal(12,1) DEFAULT NULL,
  `sp_PayMoney` decimal(12,1) DEFAULT NULL,
  `sp_UserID` varchar(20) DEFAULT NULL,
  `sp_User` varchar(30) DEFAULT NULL,
  `sp_Pc` varchar(50) DEFAULT NULL,
  `sp_Date` date DEFAULT NULL,
  `sp_Remark` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`sp_SellUserID`,`sp_SellDate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_acct_sellpay`
--

INSERT INTO `tms_acct_sellpay` (`sp_SellUserID`, `sp_SellUser`, `sp_Station`, `sp_SellDate`, `sp_RemainMoney`, `sp_BeginTicket`, `sp_EndTicket`, `sp_SellMoney`, `sp_SellCount`, `sp_ErrMoney`, `sp_ErrCount`, `sp_ReturnMoney`, `sp_ReturnCount`, `sp_ReturnRate`, `sp_SafetyMoney`, `sp_SafetyCount`, `sp_UpCount`, `sp_UpMoney`, `sp_PayMoney`, `sp_UserID`, `sp_User`, `sp_Pc`, `sp_Date`, `sp_Remark`) VALUES
('xaadmin', 'xaadmin', '西安', '2014-12-13', '0.0', '5235780016', '5235780026', '2630.0', 11, '500.0', 1, '499.5', 2, '55.50', '8.0', 4, 3, '1638.5', '1638.5', 'xaadmin', 'xaadmin', 'Dell', '2014-12-13', '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_acct_stationbalance`
--

CREATE TABLE IF NOT EXISTS `tms_acct_stationbalance` (
  `sb_ID` int(11) NOT NULL AUTO_INCREMENT,
  `sb_FStationID` varchar(20) DEFAULT NULL,
  `sb_FStation` varchar(50) DEFAULT NULL,
  `sb_FTicketNum` int(11) DEFAULT NULL,
  `sb_FTicketMoney` decimal(12,2) DEFAULT NULL,
  `sb_FLuggageNum` int(11) DEFAULT NULL,
  `sb_FLuggageMoney` decimal(12,2) DEFAULT NULL,
  `sb_SStationID` varchar(20) DEFAULT NULL,
  `sb_SStation` varchar(50) DEFAULT NULL,
  `sb_STicketNum` int(11) DEFAULT NULL,
  `sb_STicketMoney` decimal(12,2) DEFAULT NULL,
  `sb_SLuggageNum` int(11) DEFAULT NULL,
  `sb_SLuggageMoney` decimal(12,2) DEFAULT NULL,
  `sb_BeginDate` char(10) DEFAULT NULL,
  `sb_EndDate` char(10) DEFAULT NULL,
  `sb_Money` decimal(12,2) DEFAULT NULL,
  `sb_BalanceID` varchar(20) DEFAULT NULL,
  `sb_Balancer` varchar(30) DEFAULT NULL,
  `sb_BalanceDate` char(10) DEFAULT NULL,
  `sb_BalanceTime` char(5) DEFAULT NULL,
  PRIMARY KEY (`sb_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tms_acct_tempay`
--

CREATE TABLE IF NOT EXISTS `tms_acct_tempay` (
  `tp_SellData` char(10) NOT NULL,
  `tp_SellUserID` varchar(20) NOT NULL,
  `tp_SellUser` varchar(30) DEFAULT NULL,
  `tp_Station` varchar(50) DEFAULT NULL,
  `tp_RemainMoney` decimal(12,1) DEFAULT NULL,
  `tp_BeginTicket` varchar(20) DEFAULT NULL,
  `tp_EndTicket` varchar(20) DEFAULT NULL,
  `tp_SellMoney` decimal(12,1) DEFAULT NULL,
  `tp_SellCount` int(11) DEFAULT NULL,
  `tp_ErrMoney` decimal(12,1) DEFAULT NULL,
  `tp_ErrCount` int(11) DEFAULT NULL,
  `tp_ReturnMoney` decimal(12,1) DEFAULT NULL,
  `tp_ReturnCount` decimal(12,1) DEFAULT NULL,
  `tp_ReturnRate` decimal(12,2) DEFAULT NULL,
  `tp_SafetyMoney` decimal(12,1) DEFAULT NULL,
  `tp_SafetyCount` int(11) DEFAULT NULL,
  `tp_UpCount` int(11) DEFAULT NULL,
  `tp_UpMoney` decimal(12,1) DEFAULT NULL,
  `tp_OnLine` varchar(50) DEFAULT NULL,
  `tp_UserID` varchar(20) NOT NULL,
  `tp_User` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_addprice`
--

CREATE TABLE IF NOT EXISTS `tms_bd_addprice` (
  `ap_NoOfRunsID` varchar(20) NOT NULL,
  `ap_FromStationID` varchar(20) NOT NULL,
  `ap_FromStation` varchar(50) DEFAULT NULL,
  `ap_ReachStationID` varchar(20) NOT NULL,
  `ap_ReachStation` varchar(50) DEFAULT NULL,
  `ap_Distance` decimal(12,2) DEFAULT NULL,
  `ap_FullPrice` decimal(12,1) DEFAULT NULL,
  `ap_HalfPrice` decimal(12,1) DEFAULT NULL,
  `ap_StandardPrice` decimal(12,1) DEFAULT NULL,
  `ap_UserID` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_adorg`
--

CREATE TABLE IF NOT EXISTS `tms_bd_adorg` (
  `ao_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ao_OrgCode` varchar(20) DEFAULT NULL,
  `ao_OrgName` varchar(100) DEFAULT NULL,
  `ao_HelpCode` varchar(10) DEFAULT NULL,
  `ao_AdderID` varchar(20) DEFAULT NULL,
  `ao_Adder` varchar(30) DEFAULT NULL,
  `ao_AddTime` datetime DEFAULT NULL,
  `ao_ModerID` varchar(20) DEFAULT NULL,
  `ao_Moder` varchar(30) DEFAULT NULL,
  `ao_ModTime` datetime DEFAULT NULL,
  `ao_Remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ao_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `tms_bd_adorg`
--

INSERT INTO `tms_bd_adorg` (`ao_ID`, `ao_OrgCode`, `ao_OrgName`, `ao_HelpCode`, `ao_AdderID`, `ao_Adder`, `ao_AddTime`, `ao_ModerID`, `ao_Moder`, `ao_ModTime`, `ao_Remark`) VALUES
(8, '7100000000', '陕西汽车集团', 'SXQ', 'admin', '超级管理员', '2014-12-09 10:05:12', NULL, NULL, NULL, ''),
(9, '3200000000', '江苏汽车集团', 'JSQ', 'admin', '超级管理员', '2014-12-09 10:05:42', NULL, NULL, NULL, ''),
(10, '5101000000', '四川汽车集团', 'SCQ', 'admin', '超级管理员', '2014-12-09 10:06:58', NULL, NULL, NULL, ''),
(11, '4300000000', '湖南汽车集团', 'HNQ', 'admin', '超级管理员', '2014-12-09 10:07:41', NULL, NULL, NULL, ''),
(12, '7100000001', '西安代售点1', 'DS1', 'admin', '超级管理员', '2014-12-09 10:13:01', NULL, NULL, NULL, ''),
(13, '7100000002', '西安代售点2', 'DS2', 'admin', '超级管理员', '2014-12-09 10:13:20', NULL, NULL, NULL, ''),
(14, '330700', '浙江汽车集团', 'ZJQ', 'admin', '超级管理员', '2014-12-09 10:18:24', NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_agiotype`
--

CREATE TABLE IF NOT EXISTS `tms_bd_agiotype` (
  `at_AgioName` varchar(50) NOT NULL,
  `at_Agio` decimal(12,2) DEFAULT NULL,
  `at_Remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`at_AgioName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_busart`
--

CREATE TABLE IF NOT EXISTS `tms_bd_busart` (
  `ba_BusID` varchar(50) NOT NULL,
  `ba_BusNumber` varchar(50) DEFAULT NULL,
  `ba_EJWFDate` char(10) DEFAULT NULL,
  `ba_ChangeInfo` varchar(50) DEFAULT NULL,
  `ba_OkRankDate` char(10) DEFAULT NULL,
  `ba_Remark` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ba_BusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_buscard`
--

CREATE TABLE IF NOT EXISTS `tms_bd_buscard` (
  `bc_CardID` varchar(20) NOT NULL,
  `bc_BusID` varchar(20) DEFAULT NULL,
  `bc_BusNumber` varchar(20) DEFAULT NULL,
  `bc_RegDate` char(10) DEFAULT NULL,
  `bc_state` varchar(50) DEFAULT NULL,
  `bc_StationID` varchar(20) DEFAULT NULL,
  `bc_Station` varchar(50) DEFAULT NULL,
  `bc_Remark` varchar(200) DEFAULT NULL,
  `bc_addpeople` varchar(20) DEFAULT NULL,
  `bc_moddate` varchar(20) DEFAULT NULL,
  `bc_modpeople` varchar(20) DEFAULT NULL,
  `bc_modderID` varchar(20) DEFAULT NULL,
  `bc_adderID` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`bc_CardID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_buscard`
--

INSERT INTO `tms_bd_buscard` (`bc_CardID`, `bc_BusID`, `bc_BusNumber`, `bc_RegDate`, `bc_state`, `bc_StationID`, `bc_Station`, `bc_Remark`, `bc_addpeople`, `bc_moddate`, `bc_modpeople`, `bc_modderID`, `bc_adderID`) VALUES
('123456', '1011001', '陕A12345', '2014-12-09', '注册', '7100000000', '西安', '', '超级管理员', '', '', '', 'admin'),
('1234567', '1011002', '陕B12345', '2014-12-09', '注册', '7100000000', '西安', '', '超级管理员', '', '', '', 'admin'),
('23456', '2011001', '川A12345', '2014-12-09', '注册', '5101000000', '成都', '', '超级管理员', '', '', '', 'admin'),
('234567', '2011002', '川B12355', '2014-12-09', '注册', '5101000000', '成都', '', '超级管理员', '', '', '', 'admin'),
('34567', '3011001', '湘A12345', '2014-12-09', '注册', '4301000000', '长沙', '', '超级管理员', '', '', '', 'admin');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_businfo`
--

CREATE TABLE IF NOT EXISTS `tms_bd_businfo` (
  `bi_BusID` varchar(20) NOT NULL,
  `bi_BusNumber` varchar(20) DEFAULT NULL,
  `bi_BusUnit` varchar(50) DEFAULT NULL,
  `bi_SeatS` tinyint(4) DEFAULT NULL,
  `bi_AddSeatS` tinyint(4) DEFAULT NULL,
  `bi_AllowHalfSeats` tinyint(4) DEFAULT NULL,
  `bi_DriverID` varchar(20) DEFAULT NULL,
  `bi_Driver` varchar(30) DEFAULT NULL,
  `bi_Driver1ID` varchar(20) DEFAULT NULL,
  `bi_Driver1` varchar(30) DEFAULT NULL,
  `bi_Driver2ID` varchar(20) DEFAULT NULL,
  `bi_Driver2` varchar(30) DEFAULT NULL,
  `bi_RegDate` char(10) DEFAULT NULL,
  `bi_Tonnage` tinyint(4) DEFAULT NULL,
  `bi_OwnerName` varchar(30) DEFAULT NULL,
  `bi_OwnerAdd` varchar(50) DEFAULT NULL,
  `bi_OwnerTel` varchar(20) DEFAULT NULL,
  `bi_OwnerIdCard` varchar(50) DEFAULT NULL,
  `bi_BusTypeID` varchar(20) DEFAULT NULL,
  `bi_BusType` varchar(50) DEFAULT NULL,
  `bi_EngineType` varchar(50) DEFAULT NULL,
  `bi_EngineNumber` varchar(50) DEFAULT NULL,
  `bi_BusIdentify` char(25) DEFAULT NULL,
  `bi_BusChangeType` varchar(50) DEFAULT NULL,
  `bi_Remark` varchar(200) DEFAULT NULL,
  `bi_IsSafetyCheck` varchar(50) DEFAULT NULL,
  `bi_InsuranceNo` varchar(50) DEFAULT NULL,
  `bi_InsuranceCompany` varchar(50) DEFAULT NULL,
  `bi_InsuranceDate` char(10) DEFAULT NULL,
  `bi_TransportationBeginDate` char(10) DEFAULT NULL,
  `bi_TransportationEndDate` char(10) DEFAULT NULL,
  `bi_TradeBeginDate` char(10) DEFAULT NULL,
  `bi_TradeEndDate` char(10) DEFAULT NULL,
  `bi_RenBeginDate` char(10) DEFAULT NULL,
  `bi_RenEndDate` char(10) DEFAULT NULL,
  `bi_ManagementLine` varchar(50) DEFAULT NULL,
  `bi_LineLicense` varchar(50) DEFAULT NULL,
  `bi_LineLicenseAttached` varchar(50) DEFAULT NULL,
  `bi_AttachedEndDate` char(10) DEFAULT NULL,
  `bi_Business` varchar(50) DEFAULT NULL,
  `bi_SpringCheckEndDate` char(10) DEFAULT NULL,
  `bi_ExaminationEndDate` char(10) DEFAULT NULL,
  `bi_TwoEndDate` char(10) DEFAULT NULL,
  `bi_RankEndDate` char(10) DEFAULT NULL,
  `bi_TravelEndDate` char(10) DEFAULT NULL,
  `bi_MonthEndDate` char(10) DEFAULT NULL,
  `bi_CNGEndDate` char(10) DEFAULT NULL,
  `bi_Sign` varchar(50) DEFAULT NULL,
  `bi_InStationID` varchar(20) DEFAULT NULL,
  `bi_InStation` varchar(20) DEFAULT NULL,
  `bi_AdderID` varchar(20) DEFAULT NULL,
  `bi_Adder` varchar(30) DEFAULT NULL,
  `bi_AddTime` datetime DEFAULT NULL,
  `bi_ModerID` varchar(20) DEFAULT NULL,
  `bi_Moder` varchar(30) DEFAULT NULL,
  `bi_ModTime` datetime DEFAULT NULL,
  `bi_VehicleDrivingEndDate` char(10) DEFAULT NULL,
  `bi_VehicleDriving` varchar(50) DEFAULT NULL,
  `bi_RoadTransportEndDate` char(10) DEFAULT NULL,
  `bi_RoadTransport` varchar(50) DEFAULT NULL,
  `bi_ScanPath` varchar(100) DEFAULT NULL,
  `bi_fileName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`bi_BusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_businfo`
--

INSERT INTO `tms_bd_businfo` (`bi_BusID`, `bi_BusNumber`, `bi_BusUnit`, `bi_SeatS`, `bi_AddSeatS`, `bi_AllowHalfSeats`, `bi_DriverID`, `bi_Driver`, `bi_Driver1ID`, `bi_Driver1`, `bi_Driver2ID`, `bi_Driver2`, `bi_RegDate`, `bi_Tonnage`, `bi_OwnerName`, `bi_OwnerAdd`, `bi_OwnerTel`, `bi_OwnerIdCard`, `bi_BusTypeID`, `bi_BusType`, `bi_EngineType`, `bi_EngineNumber`, `bi_BusIdentify`, `bi_BusChangeType`, `bi_Remark`, `bi_IsSafetyCheck`, `bi_InsuranceNo`, `bi_InsuranceCompany`, `bi_InsuranceDate`, `bi_TransportationBeginDate`, `bi_TransportationEndDate`, `bi_TradeBeginDate`, `bi_TradeEndDate`, `bi_RenBeginDate`, `bi_RenEndDate`, `bi_ManagementLine`, `bi_LineLicense`, `bi_LineLicenseAttached`, `bi_AttachedEndDate`, `bi_Business`, `bi_SpringCheckEndDate`, `bi_ExaminationEndDate`, `bi_TwoEndDate`, `bi_RankEndDate`, `bi_TravelEndDate`, `bi_MonthEndDate`, `bi_CNGEndDate`, `bi_Sign`, `bi_InStationID`, `bi_InStation`, `bi_AdderID`, `bi_Adder`, `bi_AddTime`, `bi_ModerID`, `bi_Moder`, `bi_ModTime`, `bi_VehicleDrivingEndDate`, `bi_VehicleDriving`, `bi_RoadTransportEndDate`, `bi_RoadTransport`, `bi_ScanPath`, `bi_fileName`) VALUES
('1011001', '陕A12345', '西安001车队', 15, 20, 2, 'xa001', '张三', 'xa001', '张三', '', '', '2014-12-09', 4, '', '', '', '', '05', '中型中级', '', '', '', '', '', '检验合格', '', '', '', '', '', '', '', '', '', '西安--成都', '12345', 'xa123', '', '123', '', '', '', '', '', '', '', '', '7100000000', '西安', 'admin', '超级管理员', '2014-12-09 11:24:53', NULL, NULL, NULL, '2015-09-09', '123', '2015-09-09', '123', '', ''),
('1011002', '陕B12345', '西安001车队', 20, 12, 1, 'xa002', '李四', 'xa002', '李四', '', '', '2014-12-09', 1, '', '', '', '', '03', '小型中级', '', '', '', '', '', '检验不合格', '', '', '', '', '', '', '', '', '', '西安--户县', '111', '111', '2015-06-06', '11', '', '', '', '', '', '', '', '', '7100000000', '西安', 'admin', '超级管理员', '2014-12-09 11:26:14', NULL, NULL, NULL, '2016-01-01', '11', '2015-05-05', '11', '', ''),
('1011003', '陕A98064', '西安001车队', 30, 2, 2, 'xa001', '张三', 'xa003', '王五', '', '', '2014-12-09', 2, '', '', '', '', '07', '大型普通', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '西安--衡阳', '123', '123', '', '123', '2016-05-05', '', '', '', '', '', '', '', '7100000000', '西安', 'admin', '超级管理员', '2014-12-09 11:27:52', NULL, NULL, NULL, '2016-01-01', '123', '2015-05-05', '123', '', ''),
('1011004', '陕A96779', '西安002车队', 30, 20, 10, 'xa001', '张三', '', '', '', '', '2014-12-09', 1, '', '', '', '', '05', '中型中级', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '西安--成都', '1', '1', '', '1', '', '', '', '', '', '', '', '', '7100000000', '西安', 'admin', '超级管理员', '2014-12-09 11:28:58', NULL, NULL, NULL, '', '1', '', '1', '', ''),
('2011001', '川A12345', '成都001车队', 30, 20, 10, '', '', '', '', '', '', '2014-12-09', 2, '', '', '', '', '06', '中型高级', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '5101000000', '成都', 'admin', '超级管理员', '2014-12-09 11:32:29', NULL, NULL, NULL, '', '', '', '', '', ''),
('2011002', '川B12355', '成都001车队', 0, 0, 0, '', '', '', '', '', '', '2014-12-09', 0, '', '', '', '', '05', '中型中级', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '5101000000', '成都', 'admin', '超级管理员', '2014-12-09 11:32:49', NULL, NULL, NULL, '', '', '', '', '', ''),
('3011001', '湘A12345', '长沙001车队', 20, 1, 1, '', '', '', '', '', '', '2014-12-09', 1, '', '', '', '', '05', '中型中级', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '4301000000', '长沙', 'admin', '超级管理员', '2014-12-09 11:33:35', NULL, NULL, NULL, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_busmodel`
--

CREATE TABLE IF NOT EXISTS `tms_bd_busmodel` (
  `bm_ModelID` varchar(20) NOT NULL,
  `bm_ModelName` varchar(50) DEFAULT NULL,
  `bm_Rank` varchar(20) DEFAULT NULL,
  `bm_Category` varchar(10) DEFAULT NULL,
  `bm_Seating` int(11) DEFAULT NULL,
  `bm_AddSeating` int(11) DEFAULT NULL,
  `bm_AllowHalfSeats` int(11) DEFAULT NULL,
  `bm_Weight` int(11) DEFAULT NULL,
  `bm_AdderID` varchar(20) DEFAULT NULL,
  `bm_Adder` varchar(30) DEFAULT NULL,
  `bm_AddTime` datetime DEFAULT NULL,
  `bm_ModerID` varchar(20) DEFAULT NULL,
  `bm_Moder` varchar(30) DEFAULT NULL,
  `bm_ModTime` datetime DEFAULT NULL,
  `bm_Closing` decimal(12,2) DEFAULT NULL,
  `bm_Remark` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`bm_ModelID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_busmodel`
--

INSERT INTO `tms_bd_busmodel` (`bm_ModelID`, `bm_ModelName`, `bm_Rank`, `bm_Category`, `bm_Seating`, `bm_AddSeating`, `bm_AllowHalfSeats`, `bm_Weight`, `bm_AdderID`, `bm_Adder`, `bm_AddTime`, `bm_ModerID`, `bm_Moder`, `bm_ModTime`, `bm_Closing`, `bm_Remark`) VALUES
('01', '小型普通', '中级', '客车', 15, 0, 0, 5, NULL, NULL, NULL, 'admin', '超级管理员', '2014-04-11 15:29:27', '0.00', ''),
('02', '小型高一', '高级', '客车', 14, 0, 0, 5, NULL, NULL, NULL, 'admin', '超级管理员', '2014-06-23 15:04:14', '0.00', ''),
('03', '小型中级', '中级', '客车', 15, 0, 0, 5, NULL, NULL, NULL, 'admin', '超级管理员', '2014-06-23 15:04:20', '0.00', ''),
('04', '中型普通', '中级', '客车', 16, 0, 0, 0, NULL, NULL, NULL, 'admin', '超级管理员', '2014-06-23 15:04:33', '0.00', ''),
('05', '中型中级', '中级', '客车', 15, 0, 0, 0, NULL, NULL, NULL, 'admin', '超级管理员', '2014-06-16 17:02:32', '0.00', ''),
('06', '中型高级', '高级', '客车', 35, 0, 0, 10, 'admin', '超级管理员', '2014-04-15 22:03:50', NULL, NULL, NULL, '0.00', ''),
('07', '大型普通', '中级', '客车', 15, 0, 0, 0, NULL, NULL, NULL, 'admin', '超级管理员', '2014-06-23 15:04:47', '0.00', ''),
('08', '大型中级', '中级', '客车', 45, 0, 0, 0, NULL, NULL, NULL, 'admin', '超级管理员', '2014-06-23 15:06:01', '0.00', ''),
('09', '大型高一', '高级', '客车', 30, 2, 2, 5, 'admin', '超级管理员', '2014-12-09 11:13:26', NULL, NULL, NULL, '0.00', ''),
('10', '大型高二', '高级', '客车', 59, 0, 0, 0, NULL, NULL, NULL, 'admin', '超级管理员', '2014-06-23 15:06:19', '0.00', ''),
('102', '空调', '高级', '客车', 34, 0, 5, 10, 'admin', '超级管理员', '2014-08-05 11:17:49', 'admin', '超级管理员', '2014-12-09 11:12:34', '0.00', '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_busunit`
--

CREATE TABLE IF NOT EXISTS `tms_bd_busunit` (
  `bu_ID` int(11) NOT NULL AUTO_INCREMENT,
  `bu_UnitName` varchar(200) NOT NULL,
  `bu_UnitProperty` varchar(50) DEFAULT NULL,
  `bu_UnitContacts` varchar(30) DEFAULT NULL,
  `bu_UnitPhone` varchar(20) DEFAULT NULL,
  `bu_UnitAdress` varchar(200) DEFAULT NULL,
  `bu_Remark` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`bu_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `tms_bd_busunit`
--

INSERT INTO `tms_bd_busunit` (`bu_ID`, `bu_UnitName`, `bu_UnitProperty`, `bu_UnitContacts`, `bu_UnitPhone`, `bu_UnitAdress`, `bu_Remark`) VALUES
(1, '西安001车队', '', '', '', '', ''),
(2, '西安002车队', '', '', '', '', ''),
(3, '西安个体', '', '', '', '', ''),
(4, '长沙001车队', '', '', '', '', ''),
(5, '上海001车队', '', '', '', '', ''),
(6, '成都001车队', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_busunitshell`
--

CREATE TABLE IF NOT EXISTS `tms_bd_busunitshell` (
  `bus_ID` int(11) NOT NULL AUTO_INCREMENT,
  `bus_ShellID` varchar(50) DEFAULT NULL,
  `bus_Shell` varchar(50) DEFAULT NULL,
  `bus_BusUnit` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`bus_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_charteredbus`
--

CREATE TABLE IF NOT EXISTS `tms_bd_charteredbus` (
  `cb_ChartereID` varchar(20) NOT NULL,
  `cb_TicketID` varchar(20) DEFAULT NULL,
  `cb_Customer` varchar(50) NOT NULL,
  `cb_BusID` varchar(20) DEFAULT NULL,
  `cb_BusNumber` varchar(20) DEFAULT NULL,
  `cb_DriverID` varchar(30) DEFAULT NULL,
  `cb_DriverName` varchar(30) DEFAULT NULL,
  `cb_CharteredBusDate` char(10) DEFAULT NULL,
  `cb_CharteredBusDays` int(11) DEFAULT NULL,
  `cb_FromReach` varchar(50) DEFAULT NULL,
  `cb_Kilometers` decimal(12,1) DEFAULT NULL,
  `cb_Seats` int(11) DEFAULT NULL,
  `cb_Peoples` int(11) DEFAULT NULL,
  `cb_CarriageFee` decimal(12,1) DEFAULT NULL,
  `cb_StagnateFee` decimal(12,1) DEFAULT NULL,
  `cb_BillingDate` char(10) DEFAULT NULL,
  `cb_BillingStation` varchar(50) DEFAULT NULL,
  `cb_BillingerID` varchar(30) DEFAULT NULL,
  `cb_BillingerName` varchar(30) DEFAULT NULL,
  `cb_State` tinyint(4) DEFAULT NULL,
  `cb_Remark` varchar(50) DEFAULT NULL,
  `cb_IsBalance` tinyint(4) DEFAULT NULL,
  `cb_BalanceDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`cb_ChartereID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_charteredbus`
--

INSERT INTO `tms_bd_charteredbus` (`cb_ChartereID`, `cb_TicketID`, `cb_Customer`, `cb_BusID`, `cb_BusNumber`, `cb_DriverID`, `cb_DriverName`, `cb_CharteredBusDate`, `cb_CharteredBusDays`, `cb_FromReach`, `cb_Kilometers`, `cb_Seats`, `cb_Peoples`, `cb_CarriageFee`, `cb_StagnateFee`, `cb_BillingDate`, `cb_BillingStation`, `cb_BillingerID`, `cb_BillingerName`, `cb_State`, `cb_Remark`, `cb_IsBalance`, `cb_BalanceDateTime`) VALUES
('E1418459810', '10000', '张三', '', '陕A12345', 'xa001', '张三', '2014-12-13', 1, '12-23', '12.0', 15, 1, '1.0', '1.0', '2014-12-13', '西安', 'xaadmin', 'xaadmin', 1, '', 1, '2014-12-13 16:37:40');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_charteredpaymoney`
--

CREATE TABLE IF NOT EXISTS `tms_bd_charteredpaymoney` (
  `cpm_ID` int(11) NOT NULL AUTO_INCREMENT,
  `cpm_BillingerID` varchar(30) NOT NULL,
  `cpm_BillingerName` varchar(30) DEFAULT NULL,
  `cpm_BillingDate` char(10) DEFAULT NULL,
  `cpm_beginTicketID` varchar(20) DEFAULT NULL,
  `cpm_endTicketID` varchar(20) DEFAULT NULL,
  `cpm_Number` int(11) DEFAULT NULL,
  `cpm_PayMoney` decimal(12,1) DEFAULT NULL,
  `cpm_BillingStation` varchar(50) DEFAULT NULL,
  `cpm_UserID` varchar(30) DEFAULT NULL,
  `cpm_User` varchar(30) DEFAULT NULL,
  `cpm_SubDateTime` datetime DEFAULT NULL,
  `cpm_PC` varchar(50) DEFAULT NULL,
  `cpm_Remark` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`cpm_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tms_bd_charteredpaymoney`
--

INSERT INTO `tms_bd_charteredpaymoney` (`cpm_ID`, `cpm_BillingerID`, `cpm_BillingerName`, `cpm_BillingDate`, `cpm_beginTicketID`, `cpm_endTicketID`, `cpm_Number`, `cpm_PayMoney`, `cpm_BillingStation`, `cpm_UserID`, `cpm_User`, `cpm_SubDateTime`, `cpm_PC`, `cpm_Remark`) VALUES
(1, 'xaadmin', 'xaadmin', '2014-12-13', '10000', '10000', 1, '2.0', '西安', 'xaadmin', 'xaadmin', '2014-12-13 16:37:40', 'Dell', '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_delticket`
--

CREATE TABLE IF NOT EXISTS `tms_bd_delticket` (
  `dt_ID` int(11) NOT NULL AUTO_INCREMENT,
  `dt_InceptUserID` varchar(20) DEFAULT NULL,
  `dt_InceptUser` varchar(30) DEFAULT NULL,
  `dt_UserSation` varchar(50) DEFAULT NULL,
  `dt_ProvideDate` char(10) DEFAULT NULL,
  `dt_BeginTicket` varchar(20) DEFAULT NULL,
  `dt_EndTicket` varchar(20) DEFAULT NULL,
  `dt_DelTicketNum` int(11) DEFAULT NULL,
  `dt_Type` varchar(20) DEFAULT NULL,
  `dt_DeleteTime` datetime DEFAULT NULL,
  `dt_DeletorID` varchar(20) DEFAULT NULL,
  `dt_DeletorName` varchar(30) DEFAULT NULL,
  `dt_DeletorSation` varchar(50) DEFAULT NULL,
  `dt_DeletorSationID` varchar(50) DEFAULT NULL,
  `dt_DelReason` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`dt_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tms_bd_delticket`
--

INSERT INTO `tms_bd_delticket` (`dt_ID`, `dt_InceptUserID`, `dt_InceptUser`, `dt_UserSation`, `dt_ProvideDate`, `dt_BeginTicket`, `dt_EndTicket`, `dt_DelTicketNum`, `dt_Type`, `dt_DeleteTime`, `dt_DeletorID`, `dt_DeletorName`, `dt_DeletorSation`, `dt_DeletorSationID`, `dt_DelReason`) VALUES
(1, 'xaadmin', 'xaadmin', '西安', '2014-12-09', '10001', '10010', 10, '托运单', '2014-12-13 04:12:48', 'xaadmin', 'xaadmin', '西安', '7100000000', 'test');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_driverinfo`
--

CREATE TABLE IF NOT EXISTS `tms_bd_driverinfo` (
  `di_DriverID` varchar(50) NOT NULL,
  `di_Name` varchar(50) DEFAULT NULL,
  `di_Sex` varchar(50) DEFAULT NULL,
  `di_Tel` varchar(50) DEFAULT NULL,
  `di_IdCard` varchar(50) DEFAULT NULL,
  `di_CYZGZNumber` varchar(50) DEFAULT NULL,
  `di_Photo` varchar(200) DEFAULT NULL,
  `di_BusNumber` varchar(50) DEFAULT NULL,
  `di_DriverCard` varchar(50) DEFAULT NULL,
  `di_AllowBusType` varchar(50) DEFAULT NULL,
  `di_DriverCheckDate` char(10) DEFAULT NULL,
  `di_CYZGZCheckDate` char(10) DEFAULT NULL,
  `di_Remark` varchar(200) DEFAULT NULL,
  `di_WorkEndDate` char(10) DEFAULT NULL,
  `di_FileID` varchar(50) DEFAULT NULL,
  `di_Finger` varchar(8000) DEFAULT NULL,
  `di_Address` varchar(200) DEFAULT NULL,
  `di_AdderID` varchar(20) DEFAULT NULL,
  `di_Adder` varchar(30) DEFAULT NULL,
  `di_AddTime` datetime DEFAULT NULL,
  `di_ModerID` varchar(20) DEFAULT NULL,
  `di_Moder` varchar(30) DEFAULT NULL,
  `di_ModTime` datetime DEFAULT NULL,
  `di_fileName` varchar(50) DEFAULT NULL,
  `di_ScanPath` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`di_DriverID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_driverinfo`
--

INSERT INTO `tms_bd_driverinfo` (`di_DriverID`, `di_Name`, `di_Sex`, `di_Tel`, `di_IdCard`, `di_CYZGZNumber`, `di_Photo`, `di_BusNumber`, `di_DriverCard`, `di_AllowBusType`, `di_DriverCheckDate`, `di_CYZGZCheckDate`, `di_Remark`, `di_WorkEndDate`, `di_FileID`, `di_Finger`, `di_Address`, `di_AdderID`, `di_Adder`, `di_AddTime`, `di_ModerID`, `di_Moder`, `di_ModTime`, `di_fileName`, `di_ScanPath`) VALUES
('101001', '张三', '男', '123456789', '123451234512345', '12345', '', '西安001车队', 'xa001', '', '2014-12-30', '2015-01-01', '', '', '', NULL, '陕西省西安市雁塔区', 'admin', '超级管理员', '2014-12-09 11:17:00', 'admin', '超级管理员', '2014-12-09 11:20:46', '', ''),
('101002', '李四', '女', '12345678', '123456789009876', '', '', '西安001车队', 'xa002', '', '2016-01-09', '', '', '', '', NULL, '', 'admin', '超级管理员', '2014-12-09 11:18:07', 'xaadmin', 'xaadmin', '2014-12-12 16:34:36', '', ''),
('101003', '王五', '男', '12345', '123456776543211', '', '', '西安001车队', 'xa003', '', '', '', '', '', '', NULL, '', 'admin', '超级管理员', '2014-12-09 11:18:54', 'admin', '超级管理员', '2014-12-09 11:20:06', '', ''),
('101004', '赵六', '男', '12345', '123455432112344', '', '', '西安001车队', 'xa004', '', '', '', '', '', '', NULL, '', 'admin', '超级管理员', '2014-12-09 11:19:32', 'admin', '超级管理员', '2014-12-09 11:20:00', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_feetype`
--

CREATE TABLE IF NOT EXISTS `tms_bd_feetype` (
  `ft_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ft_FeeTypeName` varchar(20) DEFAULT NULL,
  `ft_FeeTypeComputer` varchar(30) DEFAULT NULL,
  `ft_FeePercent` decimal(12,2) DEFAULT NULL,
  `ft_HelpCode` varchar(10) DEFAULT NULL,
  `ft_AdderID` varchar(20) DEFAULT NULL,
  `ft_Adder` varchar(30) DEFAULT NULL,
  `ft_AddTime` datetime DEFAULT NULL,
  `ft_ModerID` varchar(20) DEFAULT NULL,
  `ft_Moder` varchar(30) DEFAULT NULL,
  `ft_ModTime` datetime DEFAULT NULL,
  `ft_Remark` varchar(50) DEFAULT NULL,
  `ft_FeeFix` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`ft_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `tms_bd_feetype`
--

INSERT INTO `tms_bd_feetype` (`ft_ID`, `ft_FeeTypeName`, `ft_FeeTypeComputer`, `ft_FeePercent`, `ft_HelpCode`, `ft_AdderID`, `ft_Adder`, `ft_AddTime`, `ft_ModerID`, `ft_Moder`, `ft_ModTime`, `ft_Remark`, `ft_FeeFix`) VALUES
(1, '卫生费', '固定金额收费', '0.00', '', 'admin', '超级管理员', '2014-12-09 14:18:23', NULL, NULL, NULL, '', '10.00'),
(2, '人工费', '按百分比收费', '10.00', '', 'admin', '超级管理员', '2014-12-09 14:18:34', NULL, NULL, NULL, '', '0.00'),
(3, '服务费', '固定金额收费', '0.00', '', 'admin', '超级管理员', '2014-12-09 14:18:45', NULL, NULL, NULL, '', '20.00'),
(4, '微机费', '按百分比收费', '12.00', '', 'admin', '超级管理员', '2014-12-09 14:19:06', NULL, NULL, NULL, '', '0.00');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_grouploopbus`
--

CREATE TABLE IF NOT EXISTS `tms_bd_grouploopbus` (
  `glb_LoopID` int(11) NOT NULL,
  `glb_ModelID` varchar(50) DEFAULT NULL,
  `glb_ModelName` varchar(50) DEFAULT NULL,
  `glb_BusID` varchar(50) NOT NULL DEFAULT '',
  `glb_BusCard` varchar(50) DEFAULT NULL,
  `glb_Seating` int(11) DEFAULT NULL,
  `glb_AddSeating` int(11) DEFAULT NULL,
  `glb_Loads` int(11) DEFAULT NULL,
  `glb_StationID` varchar(50) DEFAULT NULL,
  `glb_Station` varchar(50) DEFAULT NULL,
  `glb_Remark` varchar(50) DEFAULT NULL,
  `glb_UserID` varchar(50) NOT NULL,
  PRIMARY KEY (`glb_LoopID`,`glb_BusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_grouploopnoruns`
--

CREATE TABLE IF NOT EXISTS `tms_bd_grouploopnoruns` (
  `gln_LoopID` int(11) NOT NULL,
  `gln_NoOfRunsID` varchar(50) NOT NULL DEFAULT '',
  `gln_LineName` varchar(50) DEFAULT NULL,
  `gln_DepartureTime` char(5) DEFAULT NULL,
  `gln_UserID` varchar(50) NOT NULL,
  PRIMARY KEY (`gln_LoopID`,`gln_NoOfRunsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_insureinfo`
--

CREATE TABLE IF NOT EXISTS `tms_bd_insureinfo` (
  `ii_Number` varchar(20) NOT NULL,
  `ii_InstallDate` char(10) DEFAULT NULL,
  `ii_BusID` varchar(20) DEFAULT NULL,
  `ii_InsureInc` varchar(50) DEFAULT NULL,
  `ii_JqxBeginDate` char(10) DEFAULT NULL,
  `ii_JqxEndDate` char(10) DEFAULT NULL,
  `ii_SyxBeginDate` char(10) DEFAULT NULL,
  `ii_SyxEndDate` char(10) DEFAULT NULL,
  `ii_BdNumber` varchar(50) DEFAULT NULL,
  `ii_EngineNumber` varchar(50) DEFAULT NULL,
  `ii_BatholithNumber` varchar(50) DEFAULT NULL,
  `ii_Remark` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ii_Number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_insuretype`
--

CREATE TABLE IF NOT EXISTS `tms_bd_insuretype` (
  `it_InsureProductName` varchar(20) NOT NULL,
  `it_EffectiveDate` char(10) DEFAULT NULL,
  `it_Price` decimal(12,1) NOT NULL,
  `it_RiskCode` varchar(10) DEFAULT NULL,
  `it_MakeCode` varchar(20) DEFAULT NULL,
  `it_RationType` varchar(10) DEFAULT NULL,
  `it_AgentCode` varchar(20) DEFAULT NULL,
  `it_VisaCode` varchar(20) DEFAULT NULL,
  `it_Perfix` varchar(10) DEFAULT NULL,
  `it_AInsuranceValue` decimal(12,1) DEFAULT NULL,
  `it_BInsuranceValue` decimal(12,1) DEFAULT NULL,
  `it_ComCode` varchar(10) DEFAULT NULL,
  `it_HandlerCode` varchar(20) DEFAULT NULL,
  `it_Handler1Code` varchar(20) DEFAULT NULL,
  `it_OperatorCode` varchar(20) DEFAULT NULL,
  `it_ApporverCode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_insuretype`
--

INSERT INTO `tms_bd_insuretype` (`it_InsureProductName`, `it_EffectiveDate`, `it_Price`, `it_RiskCode`, `it_MakeCode`, `it_RationType`, `it_AgentCode`, `it_VisaCode`, `it_Perfix`, `it_AInsuranceValue`, `it_BInsuranceValue`, `it_ComCode`, `it_HandlerCode`, `it_Handler1Code`, `it_OperatorCode`, `it_ApporverCode`) VALUES
('B保险费二元', '2014-04-16', '2.0', 'EDA', '43100302', '4310A', '43003F300025', 'AEEDAA2013ZJP', '4300', '12000.0', '2000.0', 'bbb', 'bbb', 'bbb', 'bbb', 'bbb'),
('A保险费一元', '2014-04-16', '1.0', 'EDA', '43100302', '4310B', '43003F300025', 'AEEDAA2013ZJP', '4300', '6000.0', '1000.0', 'bbb', 'bbb', 'bbb', 'bbb', 'bbb'),
('C保险费三元', '2014-04-16', '3.0', 'EDA', '43100302', '4310C', '43003F300025', 'AEEDAA2013ZJP', '4300', '18000.0', '3000.0', 'bbb', 'bbb', 'bbb', 'bbb', 'bbb'),
('E保险费五元', '2014-04-16', '5.0', 'EDA', '43100302', '4310E', '43003F300025', 'AEEDAA2013ZJP', '4300', '30000.0', '5000.0', 'bbb', 'bbb', 'bbb', 'bbb', 'bbb'),
('D保险费四元', '2014-04-16', '4.0', 'EDA', '43100302', '4310D', '43003F300025', 'AEEDAA2013ZJP', '4300', '24000.0', '4000.0', 'bbb', 'bbb', 'bbb', 'bbb', 'bbb');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_lineinfo`
--

CREATE TABLE IF NOT EXISTS `tms_bd_lineinfo` (
  `li_LineID` varchar(30) NOT NULL,
  `li_RunLineID` varchar(20) DEFAULT NULL,
  `li_LineName` varchar(50) NOT NULL,
  `li_LineKind` varchar(8) DEFAULT NULL,
  `li_LineDegree` varchar(8) DEFAULT NULL,
  `li_LineType` varchar(8) DEFAULT NULL,
  `li_Direction` varchar(8) DEFAULT NULL,
  `li_Kilometer` decimal(12,2) DEFAULT NULL,
  `li_Hours` decimal(12,2) DEFAULT NULL,
  `li_BeginLocation` varchar(50) NOT NULL,
  `li_BeginSite` varchar(50) NOT NULL,
  `li_BeginSiteID` varchar(20) NOT NULL,
  `li_EndLocation` varchar(50) DEFAULT NULL,
  `li_EndSite` varchar(50) NOT NULL,
  `li_EndSiteID` varchar(20) NOT NULL,
  `li_Linestate` varchar(8) DEFAULT NULL,
  `li_StationID` varchar(20) DEFAULT NULL,
  `li_Station` varchar(50) DEFAULT NULL,
  `li_InRegion` varchar(50) DEFAULT NULL,
  `li_AdderID` varchar(20) DEFAULT NULL,
  `li_Adder` varchar(30) DEFAULT NULL,
  `li_AddTime` datetime DEFAULT NULL,
  `li_ModerID` varchar(20) DEFAULT NULL,
  `li_Moder` varchar(30) DEFAULT NULL,
  `li_ModTime` datetime DEFAULT NULL,
  `li_Remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`li_LineID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_lineinfo`
--

INSERT INTO `tms_bd_lineinfo` (`li_LineID`, `li_RunLineID`, `li_LineName`, `li_LineKind`, `li_LineDegree`, `li_LineType`, `li_Direction`, `li_Kilometer`, `li_Hours`, `li_BeginLocation`, `li_BeginSite`, `li_BeginSiteID`, `li_EndLocation`, `li_EndSite`, `li_EndSiteID`, `li_Linestate`, `li_StationID`, `li_Station`, `li_InRegion`, `li_AdderID`, `li_Adder`, `li_AddTime`, `li_ModerID`, `li_Moder`, `li_ModTime`, `li_Remark`) VALUES
('CDPCSP510100000043010000000000', NULL, '成都--长沙', '高速', '一类', '省际', '南', '500.00', NULL, '', '成都', '5101000000', NULL, '长沙', '4301000000', '正常', '5101000000', '成都', '成都市', 'admin', '超级管理员', '2014-12-09 10:51:25', NULL, NULL, NULL, ''),
('CDPSHP510100000031000000000000', NULL, '成都--上海', '高速', '一类', '省际', '东', '800.00', NULL, '', '成都', '5101000000', NULL, '上海', '3100000000', '正常', '5101000000', '成都', '成都市', 'admin', '超级管理员', '2014-12-09 10:51:50', NULL, NULL, NULL, ''),
('CDPXAP510100000071000000000000', NULL, '成都--西安', '高速', '一类', '省际', '北', '600.00', NULL, '', '成都', '5101000000', NULL, '西安', '7100000000', '正常', '5101000000', '成都', '成都市', 'admin', '超级管理员', '2014-12-09 10:52:20', NULL, NULL, NULL, ''),
('CSPJHU430100000033070000000000', NULL, '长沙--金华', '高速', '一类', '省际', '南', '500.00', NULL, '', '长沙', '4301000000', NULL, '金华', '3307000000', '正常', '4301000000', '长沙', '长沙市', 'admin', '超级管理员', '2014-12-09 10:53:34', NULL, NULL, NULL, ''),
('CSPSHP430100000031000000000000', NULL, '长沙--上海', '高速', '一类', '省际', '东', '500.00', NULL, '', '长沙', '4301000000', NULL, '上海', '3100000000', '正常', '4301000000', '长沙', '长沙市', 'admin', '超级管理员', '2014-12-09 10:53:05', NULL, NULL, NULL, ''),
('CSPXAP430100000071000000000000', NULL, '长沙--西安', '高速', '一类', '省际', '北', '500.00', NULL, '', '长沙', '4301000000', NULL, '西安', '7100000000', '正常', '4301000000', '长沙', '长沙市', 'admin', '超级管理员', '2014-12-09 10:52:47', NULL, NULL, NULL, ''),
('XAPCAS710000000071010000000000', NULL, '西安--长安', '普通', '三类', '县际', '西', '60.00', NULL, '', '西安', '7100000000', NULL, '长安', '7101000000', '正常', '7100000000', '西安', '西安市', 'admin', '超级管理员', '2014-12-09 10:48:22', NULL, NULL, NULL, ''),
('XAPCDP710000000051010000000000', NULL, '西安--成都', '普通', '四类', '省际', '西', '700.00', NULL, '', '西安', '7100000000', NULL, '成都', '5101000000', '正常', '7100000000', '西安', '西安市', 'admin', '超级管理员', '2014-12-09 10:49:47', NULL, NULL, NULL, ''),
('XAPCSP710000000043010000000000', NULL, '西安--长沙', '高速', '一类', '省际', '南', '700.00', NULL, '', '西安', '7100000000', NULL, '长沙', '4301000000', '正常', '7100000000', '西安', '西安市', 'admin', '超级管理员', '2014-12-09 10:46:43', NULL, NULL, NULL, ''),
('XAPHXX710000000071030000000000', NULL, '西安--户县', '快巴', '二类', '县际', '南', '40.00', NULL, '', '西安', '7100000000', NULL, '户县', '7103000000', '正常', '7100000000', '西安', '西安市', 'admin', '超级管理员', '2014-12-09 10:50:28', NULL, NULL, NULL, ''),
('XAPHYP710000000043040000000000', NULL, '西安--衡阳', '高速', '一类', '省际', '南', '500.00', NULL, '', '西安', '7100000000', NULL, '衡阳', '4304000000', '正常', '7100000000', '西安', '西安市', 'admin', '超级管理员', '2014-12-09 10:49:18', NULL, NULL, NULL, ''),
('XAPLTX710000000071050000000000', NULL, '西安--蓝田', '普通', '三类', '县际', '东', '50.00', NULL, '', '西安', '7100000000', NULL, '蓝田', '7105000000', '正常', '7100000000', '西安', '西安市', 'admin', '超级管理员', '2014-12-09 10:47:27', NULL, NULL, NULL, ''),
('XAPLTX710000000071060000000000', NULL, '西安--临潼', '普通', '三类', '县际', '西', '60.00', NULL, '', '西安', '7100000000', NULL, '临潼', '7106000000', '正常', '7100000000', '西安', '西安市', 'admin', '超级管理员', '2014-12-09 10:47:51', NULL, NULL, NULL, ''),
('XAPSHP710000000031000000000000', NULL, '西安--上海', '高速', '一类', '省际', '东', '500.00', NULL, '', '西安', '7100000000', NULL, '上海', '3100000000', '正常', '7100000000', '西安', '西安市', 'admin', '超级管理员', '2014-12-09 10:48:49', NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_norunsadjustprice`
--

CREATE TABLE IF NOT EXISTS `tms_bd_norunsadjustprice` (
  `nrap_ID` int(11) NOT NULL AUTO_INCREMENT,
  `nrap_ISLineAdjust` tinyint(4) DEFAULT NULL,
  `nrap_LineAdjust` varchar(50) NOT NULL,
  `nrap_ISNoRunsAdjust` tinyint(4) DEFAULT NULL,
  `nrap_NoRunsAdjust` varchar(30) DEFAULT NULL,
  `nrap_ISUnitAdjust` tinyint(4) DEFAULT NULL,
  `nrap_Unit` varchar(50) DEFAULT NULL,
  `nrap_DepartureSiteID` varchar(20) DEFAULT NULL,
  `nrap_DepartureSite` varchar(50) DEFAULT NULL,
  `nrap_GetToSiteID` varchar(20) DEFAULT NULL,
  `nrap_GetToSite` varchar(50) DEFAULT NULL,
  `nrap_ModelID` varchar(20) DEFAULT NULL,
  `nrap_ModelName` varchar(50) DEFAULT NULL,
  `nrap_BeginDate` char(10) DEFAULT NULL,
  `nrap_EndDate` char(10) DEFAULT NULL,
  `nrap_BeginTime` char(5) DEFAULT NULL,
  `nrap_EndTime` char(5) DEFAULT NULL,
  `nrap_ReferPrice` decimal(12,1) DEFAULT NULL,
  `nrap_PriceUpPercent` decimal(12,2) DEFAULT NULL,
  `nrap_RunPrice` decimal(12,1) DEFAULT NULL,
  `nrap_HalfPrice` decimal(12,1) DEFAULT NULL,
  `nrap_BalancePrice` decimal(12,1) DEFAULT NULL,
  `nrap_LinkAdjustPrice` tinyint(4) DEFAULT NULL,
  `nrap_Remark` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`nrap_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- 转存表中的数据 `tms_bd_norunsadjustprice`
--

INSERT INTO `tms_bd_norunsadjustprice` (`nrap_ID`, `nrap_ISLineAdjust`, `nrap_LineAdjust`, `nrap_ISNoRunsAdjust`, `nrap_NoRunsAdjust`, `nrap_ISUnitAdjust`, `nrap_Unit`, `nrap_DepartureSiteID`, `nrap_DepartureSite`, `nrap_GetToSiteID`, `nrap_GetToSite`, `nrap_ModelID`, `nrap_ModelName`, `nrap_BeginDate`, `nrap_EndDate`, `nrap_BeginTime`, `nrap_EndTime`, `nrap_ReferPrice`, `nrap_PriceUpPercent`, `nrap_RunPrice`, `nrap_HalfPrice`, `nrap_BalancePrice`, `nrap_LinkAdjustPrice`, `nrap_Remark`) VALUES
(1, 0, 'XAPCAS710000000071010000000000', 0, NULL, 1, '西安001车队', '7100000000', '西安', '7101000000', '长安', '03', '小型中级', '2014-11-30', '2016-01-09', NULL, NULL, '50.0', NULL, '55.0', '28.0', '50.0', NULL, ''),
(2, 0, 'XAPCSP710000000043010000000000', 0, NULL, 1, '西安001车队', '7100000000', '西安', '4310230000', '永兴', '07', '大型普通', '2014-01-01', '2016-01-01', NULL, NULL, '100.0', NULL, '100.0', '50.0', '90.0', NULL, ''),
(3, 0, 'XAPCSP710000000043010000000000', 0, NULL, 1, '西安001车队', '7100000000', '西安', '4304000000', '衡阳', '05', '中型中级', '2014-01-01', '2016-01-01', NULL, NULL, '150.0', NULL, '150.0', '75.0', '0.0', NULL, ''),
(4, 0, 'XAPCSP710000000043010000000000', 0, NULL, 1, '西安001车队', '7100000000', '西安', '4301000000', '长沙', '07', '大型普通', '2014-01-01', '2015-09-09', NULL, NULL, '200.0', NULL, '200.0', '100.0', '0.0', NULL, ''),
(5, 0, 'XAPHYP710000000043040000000000', 0, NULL, 1, '西安001车队', '7100000000', '西安', '4301000000', '长沙', '05', '中型中级', '2014-01-01', '2016-01-01', NULL, NULL, '300.0', NULL, '300.0', '150.0', '0.0', NULL, ''),
(6, 0, 'XAPHYP710000000043040000000000', 0, NULL, 1, '西安001车队', '7100000000', '西安', '4304000000', '衡阳', '05', '中型中级', '2014-01-01', '2016-01-01', NULL, NULL, '400.0', NULL, '400.0', '200.0', '0.0', NULL, ''),
(7, 0, 'XAPSHP710000000031000000000000', 0, NULL, 1, '西安001车队', '7100000000', '西安', '3100000000', '上海', '05', '中型中级', '2014-01-01', '2016-01-01', NULL, NULL, '500.0', NULL, '500.0', '250.0', '0.0', NULL, ''),
(8, 0, 'XAPHYP710000000043040000000000', 0, NULL, 1, '西安001车队', '4301000000', '长沙', '4304000000', '衡阳', '05', '中型中级', '2014-11-30', '2016-01-09', NULL, NULL, '200.0', NULL, '200.0', '100.0', '0.0', NULL, ''),
(9, 0, 'XAPCAS710000000071010000000000', 0, 'XAPCAS0000', 1, '西安001车队', '7100000000', '西安', '7101000000', '长安', '03', '小型中级', '2014-11-30', '2016-01-09', NULL, NULL, '50.0', NULL, '55.0', '28.0', '50.0', NULL, ''),
(10, 0, 'XAPCSP710000000043010000000000', 0, 'XAPCSP0000', 1, '西安001车队', '7100000000', '西安', '4304000000', '衡阳', '05', '中型中级', '2014-01-01', '2016-01-01', NULL, NULL, '150.0', NULL, '150.0', '75.0', '0.0', NULL, ''),
(11, 0, 'XAPCSP710000000043010000000000', 0, 'XAPCSP0000', 1, '西安001车队', '7100000000', '西安', '4310230000', '永兴', '07', '大型普通', '2014-01-01', '2016-01-01', NULL, NULL, '100.0', NULL, '100.0', '50.0', '90.0', NULL, ''),
(12, 0, 'XAPCSP710000000043010000000000', 0, 'XAPCSP0000', 1, '西安001车队', '7100000000', '西安', '4301000000', '长沙', '07', '大型普通', '2014-01-01', '2015-09-09', NULL, NULL, '200.0', NULL, '200.0', '100.0', '0.0', NULL, ''),
(14, 0, 'XAPHYP710000000043040000000000', 0, 'XAPHYP0000', 1, '西安001车队', '7100000000', '西安', '4301000000', '长沙', '05', '中型中级', '2014-01-01', '2016-01-01', NULL, NULL, '300.0', NULL, '300.0', '150.0', '0.0', NULL, ''),
(15, 0, 'XAPHYP710000000043040000000000', 0, 'XAPHYP0000', 1, '西安001车队', '7100000000', '西安', '4304000000', '衡阳', '05', '中型中级', '2014-01-01', '2016-01-01', NULL, NULL, '400.0', NULL, '400.0', '200.0', '0.0', NULL, ''),
(16, 0, 'XAPHYP710000000043040000000000', 0, 'XAPHYP0000', 1, '西安001车队', '4301000000', '长沙', '4304000000', '衡阳', '05', '中型中级', '2014-11-30', '2016-01-09', NULL, NULL, '200.0', NULL, '200.0', '100.0', '0.0', NULL, ''),
(17, 0, 'XAPSHP710000000031000000000000', 0, 'XAPSHP0000', 1, '西安001车队', '7100000000', '西安', '3100000000', '上海', '05', '中型中级', '2014-01-01', '2016-01-01', NULL, NULL, '500.0', NULL, '500.0', '250.0', '0.0', NULL, ''),
(18, 0, 'CDPXAP510100000071000000000000', 0, NULL, 1, '成都001车队', '5101000000', '成都', '7100000000', '西安', '06', '中型高级', '2014-11-30', '2016-01-09', NULL, NULL, '400.0', NULL, '400.0', '200.0', '0.0', NULL, ''),
(19, 0, 'CSPXAP430100000071000000000000', 0, NULL, 1, '长沙001车队', '4301000000', '长沙', '7100000000', '西安', '05', '中型中级', '2014-11-30', '2016-01-09', NULL, NULL, '300.0', NULL, '300.0', '150.0', '0.0', NULL, ''),
(20, 0, 'CSPXAP430100000071000000000000', 0, NULL, 1, '长沙001车队', '4301000000', '长沙', '5101000000', '成都', '05', '中型中级', '2014-11-30', '2016-01-09', NULL, NULL, '100.0', NULL, '100.0', '50.0', '0.0', NULL, ''),
(21, 0, 'CSPXAP430100000071000000000000', 0, NULL, 1, '长沙001车队', '5101000000', '成都', '7100000000', '西安', '05', '中型中级', '2014-11-30', '2016-01-09', NULL, NULL, '100.0', NULL, '100.0', '50.0', '0.0', NULL, ''),
(22, 0, 'XAPCDP710000000051010000000000', 0, NULL, 1, '西安001车队', '7100000000', '西安', '5101000000', '成都', '07', '大型普通', '2014-11-30', '2016-01-09', NULL, NULL, '300.0', NULL, '300.0', '150.0', '0.0', NULL, ''),
(23, 0, 'CDPXAP510100000071000000000000', 0, 'CDPXAP0000', 1, '成都001车队', '5101000000', '成都', '7100000000', '西安', '06', '中型高级', '2014-11-30', '2016-01-09', NULL, NULL, '400.0', NULL, '400.0', '200.0', '0.0', NULL, ''),
(24, 0, 'CSPXAP430100000071000000000000', 0, 'CSPXAP0000', 1, '长沙001车队', '4301000000', '长沙', '7100000000', '西安', '05', '中型中级', '2014-11-30', '2016-01-09', NULL, NULL, '300.0', NULL, '300.0', '150.0', '0.0', NULL, ''),
(25, 0, 'CSPXAP430100000071000000000000', 0, 'CSPXAP0000', 1, '长沙001车队', '4301000000', '长沙', '5101000000', '成都', '05', '中型中级', '2014-11-30', '2016-01-09', NULL, NULL, '100.0', NULL, '100.0', '50.0', '0.0', NULL, ''),
(26, 0, 'CSPXAP430100000071000000000000', 0, 'CSPXAP0000', 1, '长沙001车队', '5101000000', '成都', '7100000000', '西安', '05', '中型中级', '2014-11-30', '2016-01-09', NULL, NULL, '100.0', NULL, '100.0', '50.0', '0.0', NULL, ''),
(27, 0, 'XAPCDP710000000051010000000000', 0, 'XAPCDP0000', 1, '西安001车队', '7100000000', '西安', '5101000000', '成都', '07', '大型普通', '2014-11-30', '2016-01-09', NULL, NULL, '300.0', NULL, '300.0', '150.0', '0.0', NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_norunsadjustpricetemp`
--

CREATE TABLE IF NOT EXISTS `tms_bd_norunsadjustpricetemp` (
  `nrt_ID` int(11) NOT NULL AUTO_INCREMENT,
  `nrt_DepartureSiteID` varchar(50) DEFAULT NULL,
  `nrt_DepartureSite` varchar(50) DEFAULT NULL,
  `nrt_GetToSiteID` varchar(50) DEFAULT NULL,
  `nrt_GetToSite` varchar(50) DEFAULT NULL,
  `nrt_ModelID` varchar(50) DEFAULT NULL,
  `nrt_ModelName` varchar(50) DEFAULT NULL,
  `nrt_RunPrice` decimal(12,1) DEFAULT NULL,
  `nrt_HalfPrice` decimal(12,1) DEFAULT NULL,
  `nrt_UserID` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nrt_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_norunsdocksite`
--

CREATE TABLE IF NOT EXISTS `tms_bd_norunsdocksite` (
  `nds_NoOfRunsID` varchar(20) NOT NULL,
  `nds_ID` tinyint(4) NOT NULL,
  `nds_SiteName` varchar(50) DEFAULT NULL,
  `nds_SiteID` varchar(20) DEFAULT NULL,
  `nds_IsDock` tinyint(4) DEFAULT NULL,
  `nds_GetOnSite` tinyint(4) DEFAULT NULL,
  `nds_CheckInSite` tinyint(4) DEFAULT NULL,
  `nds_DepartureTime` char(5) DEFAULT NULL,
  `nds_CheckTicketWindow` varchar(2) DEFAULT NULL,
  `nds_IsServiceFee` tinyint(4) NOT NULL,
  `nds_ServiceFee` decimal(12,2) DEFAULT NULL,
  `nds_otherFee1` decimal(12,2) DEFAULT NULL,
  `nds_otherFee2` decimal(12,2) DEFAULT NULL,
  `nds_otherFee3` decimal(12,2) DEFAULT NULL,
  `nds_otherFee4` decimal(12,2) DEFAULT NULL,
  `nds_otherFee5` decimal(12,2) DEFAULT NULL,
  `nds_otherFee6` decimal(12,2) DEFAULT NULL,
  `nds_Remark` varchar(200) DEFAULT NULL,
  `nds_StintSell` int(11) DEFAULT NULL,
  `nds_StintTime` char(5) DEFAULT NULL,
  `nds_RunHours` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`nds_NoOfRunsID`,`nds_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_norunsdocksite`
--

INSERT INTO `tms_bd_norunsdocksite` (`nds_NoOfRunsID`, `nds_ID`, `nds_SiteName`, `nds_SiteID`, `nds_IsDock`, `nds_GetOnSite`, `nds_CheckInSite`, `nds_DepartureTime`, `nds_CheckTicketWindow`, `nds_IsServiceFee`, `nds_ServiceFee`, `nds_otherFee1`, `nds_otherFee2`, `nds_otherFee3`, `nds_otherFee4`, `nds_otherFee5`, `nds_otherFee6`, `nds_Remark`, `nds_StintSell`, `nds_StintTime`, `nds_RunHours`) VALUES
('CDPXAP0000', 1, '成都', '5101000000', 0, 1, 1, '09:00', '2', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站', NULL, NULL, '0:0'),
('CDPXAP0000', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, NULL),
('CDPXAP0000', 3, '西安', '7100000000', 1, 0, 0, '05:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站', NULL, NULL, '20:0'),
('CSPXAP0000', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '8', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站', NULL, NULL, '0:0'),
('CSPXAP0000', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, 1, '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '', NULL, NULL, NULL),
('CSPXAP0000', 3, '西安', '7100000000', 1, 0, 0, '05:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站', NULL, NULL, '23:0'),
('XAPCAS0000', 1, '西安', '7100000000', 0, 1, 1, '', '1', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站', NULL, NULL, '0:0'),
('XAPCAS0000', 2, '长安', '7101000000', 1, 0, 0, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站', NULL, NULL, '2:0'),
('XAPCDP0000', 1, '西安', '7100000000', 0, 1, 1, '10:00', '6', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站', NULL, NULL, '0:0'),
('XAPCDP0000', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, NULL),
('XAPCDP0000', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, NULL),
('XAPCDP0000', 4, '成都', '5101000000', 1, 0, 0, '06:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站', NULL, NULL, '20:0'),
('XAPCSP0000', 1, '西安', '7100000000', 0, 1, 1, '', '8', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站', NULL, NULL, '0:0'),
('XAPCSP0000', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, NULL),
('XAPCSP0000', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, NULL),
('XAPCSP0000', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, NULL),
('XAPCSP0000', 5, '长沙', '4301000000', 1, 0, 0, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站', NULL, NULL, ''),
('XAPHXX0000', 1, '西安', '7100000000', 0, 1, 1, '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站', NULL, NULL, '0:0'),
('XAPHXX0000', 2, '户县', '7103000000', 1, 0, 0, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站', NULL, NULL, ''),
('XAPHYP0000', 1, '西安', '7100000000', 0, 1, 1, '11:00', '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站', NULL, NULL, '0:0'),
('XAPHYP0000', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, NULL),
('XAPHYP0000', 3, '衡阳', '4304000000', 1, 0, 0, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站', NULL, NULL, ''),
('XAPSHP0000', 1, '西安', '7100000000', 0, 1, 1, '08:00', '3', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站', NULL, NULL, '0:0'),
('XAPSHP0000', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', NULL, NULL, NULL),
('XAPSHP0000', 3, '上海', '3100000000', 1, 0, 0, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站', NULL, NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_norunsdocksitetemp`
--

CREATE TABLE IF NOT EXISTS `tms_bd_norunsdocksitetemp` (
  `ndst_NoOfRunsID` varchar(20) NOT NULL,
  `ndst_NoOfRunsdate` char(10) NOT NULL,
  `ndst_ID` tinyint(4) NOT NULL,
  `ndst_SiteName` varchar(50) DEFAULT NULL,
  `ndst_SiteID` varchar(20) DEFAULT NULL,
  `ndst_IsDock` tinyint(4) DEFAULT NULL,
  `ndst_GetOnSite` tinyint(4) DEFAULT NULL,
  `ndst_CheckInSite` tinyint(4) DEFAULT NULL,
  `ndst_DepartureTime` char(5) DEFAULT NULL,
  `ndst_RunHours` varchar(8) DEFAULT NULL,
  `ndst_StintSell` int(11) DEFAULT NULL,
  `ndst_StintTime` char(5) DEFAULT NULL,
  PRIMARY KEY (`ndst_NoOfRunsID`,`ndst_NoOfRunsdate`,`ndst_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_norunsdocksitetemp`
--

INSERT INTO `tms_bd_norunsdocksitetemp` (`ndst_NoOfRunsID`, `ndst_NoOfRunsdate`, `ndst_ID`, `ndst_SiteName`, `ndst_SiteID`, `ndst_IsDock`, `ndst_GetOnSite`, `ndst_CheckInSite`, `ndst_DepartureTime`, `ndst_RunHours`, `ndst_StintSell`, `ndst_StintTime`) VALUES
('CDPXAP0000', '2014-11-30', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-11-30', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-11-30', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-01', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-01', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-01', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-02', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-02', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-02', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-03', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-03', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-03', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-04', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-04', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-04', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-05', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-05', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-05', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-06', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-06', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-06', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-07', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-07', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-07', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-08', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-08', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-08', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-09', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-09', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-09', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-10', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-10', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-10', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-11', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-11', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-11', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-12', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-12', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-12', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-13', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-13', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-13', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-14', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-14', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-14', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-15', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-15', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-15', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-16', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-16', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-16', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-17', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-17', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-17', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-18', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-18', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-18', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-19', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-19', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-19', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-20', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-20', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-20', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-21', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-21', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-21', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-22', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-22', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-22', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-23', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-23', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-23', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-24', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-24', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-24', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-25', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-25', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-25', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-26', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-26', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-26', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-27', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-27', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-27', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-28', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-28', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-28', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-29', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-29', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-29', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-30', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-30', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-30', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2014-12-31', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2014-12-31', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2014-12-31', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2015-01-01', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2015-01-01', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2015-01-01', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2015-01-02', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2015-01-02', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2015-01-02', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2015-01-03', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2015-01-03', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2015-01-03', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2015-01-04', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2015-01-04', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2015-01-04', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2015-01-05', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2015-01-05', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2015-01-05', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2015-01-06', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2015-01-06', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2015-01-06', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2015-01-07', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2015-01-07', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2015-01-07', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2015-01-08', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2015-01-08', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2015-01-08', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2015-01-09', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2015-01-09', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2015-01-09', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CDPXAP0000', '2015-01-10', 1, '成都', '5101000000', 0, 1, 1, '09:00', '0:0', NULL, NULL),
('CDPXAP0000', '2015-01-10', 2, '蓝田', '7105000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('CDPXAP0000', '2015-01-10', 3, '西安', '7100000000', 1, 0, 0, '05:00', '20:0', NULL, NULL),
('CSPXAP0000', '2014-11-30', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-11-30', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-11-30', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-01', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-01', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-01', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-02', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-02', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-02', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-03', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-03', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-03', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-04', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-04', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-04', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-05', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-05', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-05', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-06', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-06', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-06', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-07', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-07', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-07', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-08', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-08', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-08', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-09', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-09', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-09', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-10', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-10', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-10', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-11', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-11', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-11', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-12', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-12', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-12', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-13', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-13', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-13', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-14', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-14', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-14', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-15', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-15', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-15', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-16', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-16', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-16', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-17', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-17', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-17', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-18', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-18', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-18', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-19', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-19', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-19', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-20', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-20', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-20', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-21', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-21', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-21', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-22', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-22', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-22', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-23', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-23', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-23', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-24', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-24', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-24', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-25', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-25', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-25', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-26', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-26', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-26', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-27', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-27', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-27', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-28', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-28', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-28', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-29', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-29', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-29', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-30', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-30', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-30', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2014-12-31', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2014-12-31', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2014-12-31', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2015-01-01', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2015-01-01', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2015-01-01', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2015-01-02', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2015-01-02', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2015-01-02', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2015-01-03', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2015-01-03', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2015-01-03', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2015-01-04', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2015-01-04', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2015-01-04', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2015-01-05', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2015-01-05', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2015-01-05', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2015-01-06', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2015-01-06', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2015-01-06', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2015-01-07', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2015-01-07', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2015-01-07', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2015-01-08', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2015-01-08', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2015-01-08', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2015-01-09', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2015-01-09', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2015-01-09', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('CSPXAP0000', '2015-01-10', 1, '长沙', '4301000000', 0, 1, 1, '06:00', '0:0', NULL, NULL),
('CSPXAP0000', '2015-01-10', 2, '成都', '5101000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('CSPXAP0000', '2015-01-10', 3, '西安', '7100000000', 1, 0, 0, '05:00', '23:0', NULL, NULL),
('XAPCAS0000', '2014-11-30', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-11-30', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-01', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-01', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-02', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-02', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-03', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-03', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-04', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-04', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-05', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-05', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-06', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-06', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-07', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-07', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-08', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-08', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-09', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-09', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-10', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-10', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-11', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-11', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-12', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-12', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-13', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-13', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-14', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-14', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-15', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-15', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-16', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-16', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-17', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-17', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-18', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-18', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-19', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-19', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-20', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-20', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-21', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-21', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-22', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-22', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-23', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-23', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-24', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-24', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-25', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-25', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-26', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-26', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-27', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-27', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-28', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-28', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-29', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-29', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-30', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-30', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2014-12-31', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2014-12-31', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2015-01-01', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2015-01-01', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2015-01-02', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2015-01-02', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2015-01-03', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2015-01-03', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2015-01-04', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2015-01-04', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2015-01-05', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2015-01-05', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2015-01-06', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2015-01-06', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2015-01-07', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2015-01-07', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2015-01-08', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2015-01-08', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2015-01-09', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2015-01-09', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCAS0000', '2015-01-10', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCAS0000', '2015-01-10', 2, '长安', '7101000000', 1, 0, 0, '', '2:0', NULL, NULL),
('XAPCDP0000', '2014-11-30', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-11-30', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-11-30', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-11-30', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-01', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-01', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-01', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-01', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-02', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-02', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-02', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-02', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-03', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-03', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-03', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-03', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-04', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-04', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-04', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-04', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-05', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-05', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-05', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-05', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-06', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-06', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-06', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-06', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-07', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-07', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-07', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-07', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-08', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-08', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-08', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-08', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-09', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-09', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-09', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-09', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-10', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-10', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-10', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-10', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-11', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-11', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-11', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-11', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-12', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-12', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-12', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-12', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-13', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-13', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-13', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-13', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-14', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-14', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-14', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-14', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-15', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-15', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-15', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-15', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-16', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-16', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-16', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-16', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-17', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-17', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-17', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-17', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-18', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-18', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-18', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-18', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-19', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-19', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-19', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-19', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-20', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-20', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-20', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-20', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-21', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-21', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-21', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-21', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-22', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-22', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-22', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-22', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-23', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-23', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-23', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-23', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-24', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-24', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-24', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-24', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-25', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-25', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-25', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-25', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-26', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-26', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-26', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-26', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-27', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-27', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-27', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-27', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-28', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-28', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-28', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-28', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-29', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-29', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-29', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-29', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-30', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-30', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-30', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-30', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2014-12-31', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2014-12-31', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-31', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2014-12-31', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2015-01-01', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2015-01-01', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-01', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-01', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2015-01-02', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2015-01-02', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-02', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-02', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2015-01-03', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2015-01-03', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-03', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-03', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2015-01-04', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2015-01-04', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-04', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-04', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2015-01-05', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2015-01-05', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-05', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-05', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2015-01-06', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2015-01-06', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-06', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-06', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2015-01-07', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2015-01-07', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-07', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-07', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2015-01-08', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2015-01-08', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-08', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-08', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2015-01-09', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2015-01-09', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-09', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-09', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCDP0000', '2015-01-10', 1, '西安', '7100000000', 0, 1, 1, '10:00', '0:0', NULL, NULL),
('XAPCDP0000', '2015-01-10', 2, '广元', '5108000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-10', 3, '彭州', '5101820000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCDP0000', '2015-01-10', 4, '成都', '5101000000', 1, 0, 0, '06:00', '20:0', NULL, NULL),
('XAPCSP0000', '2014-11-30', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-11-30', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-11-30', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-11-30', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-11-30', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-01', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-01', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-01', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-01', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-01', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-02', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-02', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-02', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-02', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-02', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-03', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-03', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-03', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-03', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-03', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-04', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-04', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-04', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-04', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-04', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-05', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-05', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-05', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-05', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-05', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-06', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-06', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-06', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-06', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-06', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-07', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-07', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-07', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-07', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-07', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-08', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-08', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-08', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-08', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-08', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-09', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-09', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-09', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-09', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL);
INSERT INTO `tms_bd_norunsdocksitetemp` (`ndst_NoOfRunsID`, `ndst_NoOfRunsdate`, `ndst_ID`, `ndst_SiteName`, `ndst_SiteID`, `ndst_IsDock`, `ndst_GetOnSite`, `ndst_CheckInSite`, `ndst_DepartureTime`, `ndst_RunHours`, `ndst_StintSell`, `ndst_StintTime`) VALUES
('XAPCSP0000', '2014-12-09', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-10', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-10', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-10', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-10', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-10', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-11', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-11', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-11', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-11', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-11', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-12', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-12', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-12', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-12', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-12', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-13', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-13', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-13', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-13', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-13', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-14', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-14', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-14', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-14', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-14', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-15', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-15', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-15', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-15', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-15', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-16', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-16', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-16', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-16', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-16', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-17', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-17', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-17', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-17', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-17', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-18', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-18', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-18', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-18', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-18', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-19', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-19', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-19', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-19', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-19', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-20', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-20', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-20', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-20', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-20', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-21', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-21', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-21', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-21', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-21', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-22', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-22', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-22', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-22', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-22', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-23', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-23', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-23', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-23', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-23', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-24', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-24', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-24', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-24', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-24', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-25', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-25', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-25', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-25', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-25', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-26', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-26', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-26', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-26', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-26', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-27', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-27', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-27', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-27', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-27', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-28', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-28', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-28', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-28', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-28', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-29', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-29', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-29', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-29', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-29', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-30', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-30', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-30', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-30', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-30', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2014-12-31', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2014-12-31', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-31', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-31', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2014-12-31', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2015-01-01', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2015-01-01', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-01', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-01', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-01', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2015-01-02', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2015-01-02', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-02', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-02', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-02', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2015-01-03', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2015-01-03', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-03', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-03', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-03', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2015-01-04', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2015-01-04', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-04', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-04', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-04', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2015-01-05', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2015-01-05', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-05', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-05', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-05', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2015-01-06', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2015-01-06', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-06', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-06', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-06', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2015-01-07', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2015-01-07', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-07', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-07', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-07', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2015-01-08', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2015-01-08', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-08', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-08', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-08', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2015-01-09', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2015-01-09', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-09', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-09', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-09', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPCSP0000', '2015-01-10', 1, '西安', '7100000000', 0, 1, 1, '', '0:0', NULL, NULL),
('XAPCSP0000', '2015-01-10', 2, '户县', '7103000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-10', 3, '永兴', '4310230000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-10', 4, '衡阳', '4304000000', 1, 0, 0, NULL, NULL, NULL, NULL),
('XAPCSP0000', '2015-01-10', 5, '长沙', '4301000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-11-30', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-11-30', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-11-30', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-01', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-01', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-01', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-02', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-02', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-02', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-03', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-03', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-03', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-04', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-04', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-04', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-05', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-05', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-05', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-06', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-06', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-06', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-07', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-07', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-07', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-08', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-08', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-08', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-09', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-09', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-09', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-10', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-10', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-10', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-11', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-11', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-11', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-12', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-12', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-12', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-13', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-13', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-13', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-14', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-14', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-14', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-15', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-15', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-15', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-16', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-16', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-16', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-17', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-17', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-17', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-18', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-18', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-18', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-19', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-19', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-19', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-20', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-20', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-20', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-21', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-21', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-21', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-22', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-22', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-22', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-23', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-23', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-23', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-24', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-24', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-24', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-25', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-25', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-25', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-26', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-26', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-26', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-27', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-27', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-27', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-28', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-28', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-28', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-29', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-29', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-29', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-30', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-30', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-30', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2014-12-31', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2014-12-31', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2014-12-31', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2015-01-01', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2015-01-01', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2015-01-01', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2015-01-02', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2015-01-02', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2015-01-02', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2015-01-03', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2015-01-03', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2015-01-03', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2015-01-04', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2015-01-04', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2015-01-04', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2015-01-05', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2015-01-05', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2015-01-05', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2015-01-06', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2015-01-06', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2015-01-06', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2015-01-07', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2015-01-07', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2015-01-07', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2015-01-08', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2015-01-08', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2015-01-08', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2015-01-09', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2015-01-09', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2015-01-09', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPHYP0000', '2015-01-10', 1, '西安', '7100000000', 0, 1, 1, '11:00', '0:0', NULL, NULL),
('XAPHYP0000', '2015-01-10', 2, '长沙', '4301000000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPHYP0000', '2015-01-10', 3, '衡阳', '4304000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-11-30', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-11-30', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-11-30', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-01', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-01', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-01', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-02', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-02', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-02', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-03', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-03', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-03', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-04', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-04', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-04', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-05', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-05', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-05', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-06', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-06', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-06', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-07', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-07', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-07', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-08', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-08', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-08', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-09', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-09', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-09', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-10', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-10', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-10', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-11', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-11', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-11', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-12', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-12', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-12', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-13', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-13', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-13', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-14', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-14', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-14', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-15', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-15', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-15', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-16', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-16', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-16', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-17', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-17', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-17', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-18', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-18', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-18', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-19', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-19', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-19', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-20', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-20', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-20', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-21', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-21', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-21', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-22', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-22', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-22', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-23', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-23', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-23', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-24', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-24', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-24', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-25', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-25', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-25', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-26', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-26', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-26', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-27', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-27', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-27', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-28', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-28', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-28', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-29', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-29', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-29', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-30', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-30', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-30', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2014-12-31', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2014-12-31', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2014-12-31', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2015-01-01', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2015-01-01', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2015-01-01', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2015-01-02', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2015-01-02', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2015-01-02', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2015-01-03', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2015-01-03', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2015-01-03', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2015-01-04', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2015-01-04', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2015-01-04', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2015-01-05', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2015-01-05', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2015-01-05', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2015-01-06', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2015-01-06', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2015-01-06', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2015-01-07', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2015-01-07', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2015-01-07', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2015-01-08', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2015-01-08', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2015-01-08', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2015-01-09', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2015-01-09', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2015-01-09', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL),
('XAPSHP0000', '2015-01-10', 1, '西安', '7100000000', 0, 1, 1, '08:00', '0:0', NULL, NULL),
('XAPSHP0000', '2015-01-10', 2, '江汉', '4201030000', 1, 1, 1, NULL, NULL, NULL, NULL),
('XAPSHP0000', '2015-01-10', 3, '上海', '3100000000', 1, 0, 0, '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_norunsinfo`
--

CREATE TABLE IF NOT EXISTS `tms_bd_norunsinfo` (
  `nri_NoOfRunsID` varchar(20) NOT NULL,
  `nri_LineID` varchar(30) NOT NULL,
  `nri_LineName` varchar(50) NOT NULL,
  `nri_BeginSiteID` varchar(20) DEFAULT NULL,
  `nri_BeginSite` varchar(50) DEFAULT NULL,
  `nri_EndSiteID` varchar(20) DEFAULT NULL,
  `nri_EndSite` varchar(50) DEFAULT NULL,
  `nri_DepartureTime` char(5) DEFAULT NULL,
  `nri_DealCategory` varchar(20) DEFAULT NULL,
  `nri_DealStyle` varchar(20) DEFAULT NULL,
  `nri_RunHours` varchar(8) DEFAULT NULL,
  `nri_SeverFeeRate` decimal(12,2) DEFAULT NULL,
  `nri_TempAddFee` decimal(12,1) DEFAULT NULL,
  `nri_BalanceModel` varchar(50) DEFAULT NULL,
  `nri_CheckTicketWindow` varchar(2) DEFAULT NULL,
  `nri_SellWindow` varchar(2) DEFAULT NULL,
  `nri_RunRegion` varchar(50) DEFAULT NULL,
  `nri_LoopDate` char(10) DEFAULT NULL,
  `nri_StartDay` int(11) DEFAULT NULL,
  `nri_RunDay` int(11) DEFAULT NULL,
  `nri_StopDay` int(11) DEFAULT NULL,
  `nri_IsStopOrCreat` tinyint(4) DEFAULT NULL,
  `nri_Allticket` tinyint(4) DEFAULT NULL,
  `nri_StationDeal` tinyint(4) DEFAULT NULL,
  `nri_WeekLoop` varchar(30) DEFAULT NULL,
  `nri_MonthLoop` varchar(100) DEFAULT NULL,
  `nri_IsNightAddition` tinyint(4) DEFAULT NULL,
  `nri_IsSucceedLine` tinyint(4) DEFAULT NULL,
  `nri_IsThroughAddition` tinyint(4) DEFAULT NULL,
  `nri_IsExclusive` tinyint(4) DEFAULT NULL,
  `nri_IsReturn` tinyint(4) DEFAULT NULL,
  `nri_AllowSell` tinyint(4) DEFAULT NULL,
  `nri_AddNoRuns` tinyint(4) DEFAULT NULL,
  `nri_PrintTime` varchar(50) DEFAULT NULL,
  `nri_PrintSeat` varchar(50) DEFAULT NULL,
  `nri_AdderID` varchar(20) DEFAULT NULL,
  `nri_Adder` varchar(30) DEFAULT NULL,
  `nri_AddTime` datetime DEFAULT NULL,
  `nri_ModerID` varchar(20) DEFAULT NULL,
  `nri_Moder` varchar(30) DEFAULT NULL,
  `nri_ModTime` datetime DEFAULT NULL,
  `nri_Remark` varchar(50) DEFAULT NULL,
  `nri_OperateCode` varchar(50) DEFAULT NULL,
  `nri_Type` varchar(10) DEFAULT NULL,
  `nri_State` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`nri_NoOfRunsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_norunsinfo`
--

INSERT INTO `tms_bd_norunsinfo` (`nri_NoOfRunsID`, `nri_LineID`, `nri_LineName`, `nri_BeginSiteID`, `nri_BeginSite`, `nri_EndSiteID`, `nri_EndSite`, `nri_DepartureTime`, `nri_DealCategory`, `nri_DealStyle`, `nri_RunHours`, `nri_SeverFeeRate`, `nri_TempAddFee`, `nri_BalanceModel`, `nri_CheckTicketWindow`, `nri_SellWindow`, `nri_RunRegion`, `nri_LoopDate`, `nri_StartDay`, `nri_RunDay`, `nri_StopDay`, `nri_IsStopOrCreat`, `nri_Allticket`, `nri_StationDeal`, `nri_WeekLoop`, `nri_MonthLoop`, `nri_IsNightAddition`, `nri_IsSucceedLine`, `nri_IsThroughAddition`, `nri_IsExclusive`, `nri_IsReturn`, `nri_AllowSell`, `nri_AddNoRuns`, `nri_PrintTime`, `nri_PrintSeat`, `nri_AdderID`, `nri_Adder`, `nri_AddTime`, `nri_ModerID`, `nri_Moder`, `nri_ModTime`, `nri_Remark`, `nri_OperateCode`, `nri_Type`, `nri_State`) VALUES
('CDPXAP0000', 'CDPXAP510100000071000000000000', '成都--西安', '5101000000', '成都', '7100000000', '西安', '09:00', '', '', '20:0', '0.00', '0.0', '', '2', NULL, '跨省', '', NULL, NULL, NULL, 1, 0, 0, NULL, NULL, 0, 1, 0, 0, 0, 1, 0, NULL, NULL, 'admin', '超级管理员', '2014-12-09 11:41:21', NULL, NULL, NULL, '', '', '四定', NULL),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '长沙--西安', '4301000000', '长沙', '7100000000', '西安', '06:00', '', '', '23:0', '0.00', '0.0', '', '8', NULL, '跨省', '', NULL, NULL, NULL, 1, 0, 0, NULL, NULL, 0, 1, 0, 0, 0, 1, 0, NULL, NULL, 'admin', '超级管理员', '2014-12-09 11:41:47', NULL, NULL, NULL, '', '', '四定', NULL),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '西安--长安', '7100000000', '西安', '7101000000', '长安', '', '', '', '2:0', '0.00', '0.0', '', '1', NULL, '市内', '', NULL, NULL, NULL, 1, 0, 0, NULL, NULL, 0, 1, 0, 0, 0, 1, 0, NULL, NULL, 'admin', '超级管理员', '2014-12-09 11:42:54', NULL, NULL, NULL, '', '', '专线', NULL),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '西安--成都', '7100000000', '西安', '5101000000', '成都', '10:00', '', '', '20:0', '0.00', '0.0', '', '6', NULL, '跨省', '', NULL, NULL, NULL, 1, 0, 0, NULL, NULL, 0, 1, 0, 0, 0, 1, 0, NULL, NULL, 'admin', '超级管理员', '2014-12-09 13:13:56', NULL, NULL, NULL, '', '', '', NULL),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '西安--长沙', '7100000000', '西安', '4301000000', '长沙', '', '', '', '', '0.00', '0.0', '', '8', NULL, '跨省', '', NULL, NULL, NULL, 1, 0, 0, NULL, NULL, 0, 1, 0, 0, 0, 1, 0, NULL, NULL, 'admin', '超级管理员', '2014-12-09 11:43:29', NULL, NULL, NULL, '', '', '四定', NULL),
('XAPHXX0000', 'XAPHXX710000000071030000000000', '西安--户县', '7100000000', '西安', '7103000000', '户县', '', '', '', '', '0.00', '0.0', '', '', NULL, '', '2014-11-30', 0, 300, 0, 1, 0, 0, '', '', 0, 1, 0, 0, 0, 0, 0, NULL, NULL, 'admin', '超级管理员', '2014-12-09 13:13:11', NULL, NULL, NULL, '', '', '', NULL),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '西安--衡阳', '7100000000', '西安', '4304000000', '衡阳', '11:00', '', '', '', '0.00', '0.0', '', '5', NULL, '跨省', '', NULL, NULL, NULL, 1, 1, 0, NULL, NULL, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, 'admin', '超级管理员', '2014-12-09 11:43:12', 'admin', '超级管理员', '2014-12-09 13:15:22', '', '', '', NULL),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '西安--上海', '7100000000', '西安', '3100000000', '上海', '08:00', '', '', '', '0.00', '0.0', '', '3', NULL, '跨省', '', NULL, NULL, NULL, 1, 0, 0, NULL, NULL, 0, 1, 0, 0, 0, 1, 0, NULL, NULL, 'admin', '超级管理员', '2014-12-09 11:44:12', NULL, NULL, NULL, '', '', '', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_norunsloop`
--

CREATE TABLE IF NOT EXISTS `tms_bd_norunsloop` (
  `nrl_NoOfRunsID` varchar(20) NOT NULL,
  `nrl_LoopID` tinyint(4) NOT NULL,
  `nrl_ModelID` varchar(20) DEFAULT NULL,
  `nrl_ModelName` varchar(50) DEFAULT NULL,
  `nrl_BusID` varchar(20) DEFAULT NULL,
  `nrl_BusCard` varchar(20) DEFAULT NULL,
  `nrl_Seating` int(11) DEFAULT NULL,
  `nrl_AddSeating` tinyint(4) DEFAULT NULL,
  `nrl_AllowHalfSeats` tinyint(4) DEFAULT NULL,
  `nrl_Loads` int(11) DEFAULT NULL,
  `nrl_StationID` varchar(20) DEFAULT NULL,
  `nrl_Station` varchar(50) DEFAULT NULL,
  `nrl_Remark` varchar(200) DEFAULT NULL,
  `nrl_Unit` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nrl_LoopID`,`nrl_NoOfRunsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_norunsloop`
--

INSERT INTO `tms_bd_norunsloop` (`nrl_NoOfRunsID`, `nrl_LoopID`, `nrl_ModelID`, `nrl_ModelName`, `nrl_BusID`, `nrl_BusCard`, `nrl_Seating`, `nrl_AddSeating`, `nrl_AllowHalfSeats`, `nrl_Loads`, `nrl_StationID`, `nrl_Station`, `nrl_Remark`, `nrl_Unit`) VALUES
('CDPXAP0000', 1, '06', '中型高级', NULL, NULL, 35, 0, 0, 10, NULL, NULL, '', '成都001车队'),
('CSPXAP0000', 1, '05', '中型中级', NULL, NULL, 15, 0, 0, 0, NULL, NULL, '', '长沙001车队'),
('XAPCAS0000', 1, '03', '小型中级', NULL, NULL, 15, 0, 0, 5, NULL, NULL, '', '西安001车队'),
('XAPCDP0000', 1, '07', '大型普通', NULL, NULL, 15, 0, 0, 0, NULL, NULL, '', '西安001车队'),
('XAPCSP0000', 1, '05', '中型中级', NULL, NULL, 15, 0, 0, 0, NULL, NULL, '', '西安001车队'),
('XAPHYP0000', 1, '05', '中型中级', NULL, NULL, 15, 0, 0, 0, NULL, NULL, '', '西安001车队'),
('XAPSHP0000', 1, '05', '中型中级', NULL, NULL, 15, 0, 0, 0, NULL, NULL, '', '西安001车队'),
('XAPCSP0000', 2, '07', '大型普通', NULL, NULL, 15, 0, 0, 0, NULL, NULL, '', '西安001车队');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_pricedetail`
--

CREATE TABLE IF NOT EXISTS `tms_bd_pricedetail` (
  `pd_NoOfRunsID` varchar(20) NOT NULL,
  `pd_LineID` varchar(30) DEFAULT NULL,
  `pd_NoOfRunsdate` char(10) NOT NULL,
  `pd_BeginStationTime` char(5) DEFAULT NULL,
  `pd_StopStationTime` char(5) DEFAULT NULL,
  `pd_Distance` decimal(12,2) DEFAULT NULL,
  `pd_BeginStationID` varchar(20) DEFAULT NULL,
  `pd_BeginStation` varchar(50) DEFAULT NULL,
  `pd_FromStationID` varchar(20) NOT NULL,
  `pd_FromStation` varchar(50) DEFAULT NULL,
  `pd_ReachStationID` varchar(20) NOT NULL,
  `pd_ReachStation` varchar(50) DEFAULT NULL,
  `pd_EndStationID` varchar(20) DEFAULT NULL,
  `pd_EndStation` varchar(50) DEFAULT NULL,
  `pd_FullPrice` decimal(12,1) DEFAULT NULL,
  `pd_HalfPrice` decimal(12,1) DEFAULT NULL,
  `pd_StandardPrice` decimal(12,1) DEFAULT NULL,
  `pd_BalancePrice` decimal(12,1) DEFAULT NULL,
  `pd_ServiceFee` decimal(12,2) DEFAULT NULL,
  `pd_otherFee1` decimal(12,2) DEFAULT NULL,
  `pd_otherFee2` decimal(12,2) DEFAULT NULL,
  `pd_otherFee3` decimal(12,2) DEFAULT NULL,
  `pd_otherFee4` decimal(12,2) DEFAULT NULL,
  `pd_otherFee5` decimal(12,2) DEFAULT NULL,
  `pd_otherFee6` decimal(12,2) DEFAULT NULL,
  `pd_StationID` varchar(20) DEFAULT NULL,
  `pd_Station` varchar(50) DEFAULT NULL,
  `pd_Created` datetime DEFAULT NULL,
  `pd_CreatedBY` varchar(30) DEFAULT NULL,
  `pd_Updated` datetime DEFAULT NULL,
  `pd_UpdatedBY` varchar(30) DEFAULT NULL,
  `pd_IsPass` tinyint(4) DEFAULT NULL,
  `pd_CheckInSite` tinyint(4) DEFAULT NULL,
  `pd_IsFromSite` tinyint(4) DEFAULT NULL,
  `pd_StintSell` tinyint(4) DEFAULT NULL,
  `pd_StintTime` char(5) DEFAULT NULL,
  `pd_RunHours` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`pd_NoOfRunsID`,`pd_NoOfRunsdate`,`pd_FromStationID`,`pd_ReachStationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_pricedetail`
--

INSERT INTO `tms_bd_pricedetail` (`pd_NoOfRunsID`, `pd_LineID`, `pd_NoOfRunsdate`, `pd_BeginStationTime`, `pd_StopStationTime`, `pd_Distance`, `pd_BeginStationID`, `pd_BeginStation`, `pd_FromStationID`, `pd_FromStation`, `pd_ReachStationID`, `pd_ReachStation`, `pd_EndStationID`, `pd_EndStation`, `pd_FullPrice`, `pd_HalfPrice`, `pd_StandardPrice`, `pd_BalancePrice`, `pd_ServiceFee`, `pd_otherFee1`, `pd_otherFee2`, `pd_otherFee3`, `pd_otherFee4`, `pd_otherFee5`, `pd_otherFee6`, `pd_StationID`, `pd_Station`, `pd_Created`, `pd_CreatedBY`, `pd_Updated`, `pd_UpdatedBY`, `pd_IsPass`, `pd_CheckInSite`, `pd_IsFromSite`, `pd_StintSell`, `pd_StintTime`, `pd_RunHours`) VALUES
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-11-30', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-01', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-02', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-03', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-04', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-05', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-06', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-07', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-08', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-09', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-10', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-11', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-12', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-13', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-14', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-15', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-16', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-17', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-18', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-19', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-20', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-21', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-22', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-23', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-24', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-25', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-26', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-27', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-28', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-29', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-30', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-31', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-01', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-02', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-03', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-04', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-05', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-06', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-07', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-08', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-09', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-10', '09:00', '05:00', '600.00', '5101000000', '成都', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5101000000', '成都', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-11-30', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-11-30', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-11-30', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-01', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-01', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-01', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-02', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-02', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-02', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-03', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-03', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-03', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-04', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-04', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-04', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-05', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-05', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-05', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-06', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-06', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-06', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-07', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-07', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-07', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-08', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-08', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-08', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-09', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-09', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-09', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-10', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-10', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-10', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-11', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-11', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-11', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-12', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-12', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-12', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-13', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-13', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-13', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-14', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-14', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-14', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-15', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-15', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-15', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-16', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-16', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-16', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-17', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-17', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-17', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-18', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-18', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-18', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-19', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-19', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-19', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-20', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-20', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-20', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-21', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-21', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-21', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-22', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-22', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-22', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-23', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-23', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-23', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-24', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-24', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-24', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-25', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-25', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-25', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-26', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-26', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '23:0');
INSERT INTO `tms_bd_pricedetail` (`pd_NoOfRunsID`, `pd_LineID`, `pd_NoOfRunsdate`, `pd_BeginStationTime`, `pd_StopStationTime`, `pd_Distance`, `pd_BeginStationID`, `pd_BeginStation`, `pd_FromStationID`, `pd_FromStation`, `pd_ReachStationID`, `pd_ReachStation`, `pd_EndStationID`, `pd_EndStation`, `pd_FullPrice`, `pd_HalfPrice`, `pd_StandardPrice`, `pd_BalancePrice`, `pd_ServiceFee`, `pd_otherFee1`, `pd_otherFee2`, `pd_otherFee3`, `pd_otherFee4`, `pd_otherFee5`, `pd_otherFee6`, `pd_StationID`, `pd_Station`, `pd_Created`, `pd_CreatedBY`, `pd_Updated`, `pd_UpdatedBY`, `pd_IsPass`, `pd_CheckInSite`, `pd_IsFromSite`, `pd_StintSell`, `pd_StintTime`, `pd_RunHours`) VALUES
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-26', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-27', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-27', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-27', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-28', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-28', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-28', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-29', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-29', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-29', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-30', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-30', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-30', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-31', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-31', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-31', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-01', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-01', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-01', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-02', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-02', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-02', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-03', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-03', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-03', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-04', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-04', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-04', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-05', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-05', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-05', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-06', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-06', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-06', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-07', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-07', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-07', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-08', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-08', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-08', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-09', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-09', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-09', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 0, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-10', '06:00', '', '400.00', '4301000000', '长沙', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-10', '06:00', '05:00', '500.00', '4301000000', '长沙', '4301000000', '长沙', '7100000000', '西安', '7100000000', '西安', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-10', '', '05:00', '100.00', '4301000000', '长沙', '5101000000', '成都', '7100000000', '西安', '7100000000', '西安', '100.0', '50.0', '100.0', '0.0', '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-11-30', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-01', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-02', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-03', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-04', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-05', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-06', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-07', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-08', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-09', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-10', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-11', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 3, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-13', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-14', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-15', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-16', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-17', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-18', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-19', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-20', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-21', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-22', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-23', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-24', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-25', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-26', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-27', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-28', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-29', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-30', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-31', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-01', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-02', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-03', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-04', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-05', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-06', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-07', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-08', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-09', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-10', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '28.0', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '2:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-11-30', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-01', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-02', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-03', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-04', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-05', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-06', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-07', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-08', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-09', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-10', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-11', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-12', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-13', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-14', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-15', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-16', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-17', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-18', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-19', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-20', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-21', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-22', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-23', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-24', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-25', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-26', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-27', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-28', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-29', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-30', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-31', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-01', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-02', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-03', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', '20:0');
INSERT INTO `tms_bd_pricedetail` (`pd_NoOfRunsID`, `pd_LineID`, `pd_NoOfRunsdate`, `pd_BeginStationTime`, `pd_StopStationTime`, `pd_Distance`, `pd_BeginStationID`, `pd_BeginStation`, `pd_FromStationID`, `pd_FromStation`, `pd_ReachStationID`, `pd_ReachStation`, `pd_EndStationID`, `pd_EndStation`, `pd_FullPrice`, `pd_HalfPrice`, `pd_StandardPrice`, `pd_BalancePrice`, `pd_ServiceFee`, `pd_otherFee1`, `pd_otherFee2`, `pd_otherFee3`, `pd_otherFee4`, `pd_otherFee5`, `pd_otherFee6`, `pd_StationID`, `pd_Station`, `pd_Created`, `pd_CreatedBY`, `pd_Updated`, `pd_UpdatedBY`, `pd_IsPass`, `pd_CheckInSite`, `pd_IsFromSite`, `pd_StintSell`, `pd_StintTime`, `pd_RunHours`) VALUES
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-04', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-05', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-06', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-07', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-08', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-09', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-10', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '20:0'),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-11-30', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-11-30', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-01', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-02', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-02', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-03', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-04', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-04', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-05', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-06', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-06', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-07', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-08', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-08', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-09', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-10', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-10', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-11', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-12', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-12', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-13', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-14', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-14', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-15', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-16', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-16', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-17', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-18', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-18', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-19', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-20', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-20', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-21', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-22', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-22', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-23', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-24', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-24', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-25', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-26', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-26', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-27', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-28', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-28', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-29', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-30', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-30', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-31', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-01', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-01', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-02', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-03', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-03', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-04', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-05', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-05', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-06', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-07', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-07', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-08', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-09', '', '', '700.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4301000000', '长沙', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-09', '', '', '350.00', '7100000000', '西安', '7100000000', '西安', '4310230000', '永兴', '4301000000', '长沙', '100.0', '50.0', '100.0', '90.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-10', '', '', '400.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4301000000', '长沙', '150.0', '75.0', '150.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-11-30', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-11-30', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-11-30', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-01', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-01', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-01', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-02', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-02', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-02', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-03', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-03', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-03', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-04', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-04', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-04', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-05', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-05', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-05', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-06', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-06', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-06', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-07', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-07', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-07', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-08', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-08', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-08', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-09', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-09', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-09', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-10', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-10', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-10', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-11', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-11', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-11', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-12', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-12', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-12', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-13', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-13', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-13', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-14', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-14', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-14', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-15', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-15', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-15', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-16', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-16', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-16', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-17', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-17', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-17', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', '');
INSERT INTO `tms_bd_pricedetail` (`pd_NoOfRunsID`, `pd_LineID`, `pd_NoOfRunsdate`, `pd_BeginStationTime`, `pd_StopStationTime`, `pd_Distance`, `pd_BeginStationID`, `pd_BeginStation`, `pd_FromStationID`, `pd_FromStation`, `pd_ReachStationID`, `pd_ReachStation`, `pd_EndStationID`, `pd_EndStation`, `pd_FullPrice`, `pd_HalfPrice`, `pd_StandardPrice`, `pd_BalancePrice`, `pd_ServiceFee`, `pd_otherFee1`, `pd_otherFee2`, `pd_otherFee3`, `pd_otherFee4`, `pd_otherFee5`, `pd_otherFee6`, `pd_StationID`, `pd_Station`, `pd_Created`, `pd_CreatedBY`, `pd_Updated`, `pd_UpdatedBY`, `pd_IsPass`, `pd_CheckInSite`, `pd_IsFromSite`, `pd_StintSell`, `pd_StintTime`, `pd_RunHours`) VALUES
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-18', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-18', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-18', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-19', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-19', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-19', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-20', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-20', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-20', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-21', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-21', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-21', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-22', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-22', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-22', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-23', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-23', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-23', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-24', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-24', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-24', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-25', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-25', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-25', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-26', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-26', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-26', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-27', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-27', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-27', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-28', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-28', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-28', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-29', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-29', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-29', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-30', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-30', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-30', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-31', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-31', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-31', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-01', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-01', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-01', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-02', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-02', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-02', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-03', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-03', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-03', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-04', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-04', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-04', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-05', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-05', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-05', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-06', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-06', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-06', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-07', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-07', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-07', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-08', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-08', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-08', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-09', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-09', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-09', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-10', '', '', '300.00', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '4304000000', '衡阳', '200.0', '100.0', '200.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 0, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-10', '11:00', '', '200.00', '7100000000', '西安', '7100000000', '西安', '4301000000', '长沙', '4304000000', '衡阳', '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-10', '11:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '4304000000', '衡阳', '4304000000', '衡阳', '400.0', '200.0', '400.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-11-30', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-01', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-02', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-03', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-04', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-05', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-06', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-07', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-08', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-09', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-10', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-11', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-12', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-13', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-14', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-15', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-16', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-17', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-18', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-19', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-20', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-21', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-22', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-23', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-24', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-25', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-26', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-27', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-28', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-29', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-30', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-31', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-01', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-02', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-03', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-04', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-05', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-06', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-07', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-08', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-09', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-10', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', 1, 1, 1, 0, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_regionset`
--

CREATE TABLE IF NOT EXISTS `tms_bd_regionset` (
  `rs_RegionCode` varchar(10) NOT NULL,
  `rs_RegionName` varchar(20) DEFAULT NULL,
  `rs_RegionFullName` varchar(50) DEFAULT NULL,
  `rs_HelpCode` varchar(10) DEFAULT NULL,
  `rs_IdCode` varchar(10) DEFAULT NULL,
  `rs_AdderID` varchar(20) DEFAULT NULL,
  `rs_Adder` varchar(30) DEFAULT NULL,
  `rs_AddTime` datetime DEFAULT NULL,
  `rs_ModerID` varchar(20) DEFAULT NULL,
  `rs_Moder` varchar(30) DEFAULT NULL,
  `rs_ModTime` datetime DEFAULT NULL,
  `rs_Remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rs_RegionCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_regionset`
--

INSERT INTO `tms_bd_regionset` (`rs_RegionCode`, `rs_RegionName`, `rs_RegionFullName`, `rs_HelpCode`, `rs_IdCode`, `rs_AdderID`, `rs_Adder`, `rs_AddTime`, `rs_ModerID`, `rs_Moder`, `rs_ModTime`, `rs_Remark`) VALUES
('310000', '上海市', '上海市', 'SHZ', NULL, NULL, NULL, NULL, 'hxh', '惠小红', '2014-07-22 08:16:39', ''),
('320000', '江苏省', '江苏省', 'JST', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('330700', '金华市', '浙江省金华市', 'JHU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('330800', '衢州市', '浙江省衢州市', 'QZS', NULL, NULL, NULL, NULL, 'hxh', '惠小红', '2014-07-22 08:15:13', ''),
('331100', '丽水地区', '浙江省丽水地区', 'LSG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350000', '福建省', '福建省', 'FJR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350121', '闽侯县', '福建省', 'MHP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350122', '连江县', '福建省连江县', 'LJW', NULL, NULL, NULL, NULL, 'admin', '超级管理员', '2014-06-16 16:49:19', ''),
('350123', '罗源县', '福建省罗源县', 'LYH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350124', '闽清县', '福建省闽清县', 'MQP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350126', '长乐县', '福建省长乐县', 'CLW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350127', '福清县', '福建省福清县', 'FQP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350128', '平潭县', '福建省平潭县', 'PTS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350181', '福清市', '福建省福清市', 'FQQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350182', '长乐市', '福建省长乐市', 'CLX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350204', '开元区', '福建省厦门市开元区', 'KYR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350206', '湖里区', '福建省厦门市湖里区', 'HLM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350211', '集美区', '福建省厦门市集美区', 'JQA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350300', '莆田市', '福建省莆田市', 'PTT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350302', '城厢区', '福建省莆田市城厢区', 'CXX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350303', '涵江区', '福建省莆田市涵江区', 'HJX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350321', '莆田县', '福建省莆田市莆田县', 'PTU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350400', '三明市', '福建省三明市', 'SMS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350402', '梅列区', '福建省三明市梅列区', 'MLU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350403', '三元区', '福建省三明市三元区', 'SYL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350421', '明溪县', '福建省三明市明溪县', 'MXR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350423', '清流县', '福建省三明市清流县', 'QLQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350424', '宁化县', '福建省三明市宁化县', 'NHW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350425', '大田县', '福建省三明市大田县', 'DTC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350427', '沙县', '福建省三明市沙县', 'SXE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350428', '将乐县', '福建省三明市将乐县', 'JLU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350430', '建宁县', '福建省三明市建宁县', 'JLV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350500', '泉州市', '福建省泉州市', 'QZU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350502', '鲤城区', '福建省泉州市鲤城区', 'LCZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350503', '丰泽区', '福建省泉州市丰泽区', 'FZV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350504', '洛江区', '福建省泉州市洛江区', 'LJX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350505', '泉港区', '福建省泉州市泉港区', 'QGP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350521', '惠安县', '福建省泉州市惠安县', 'HAV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350522', '晋江县', '福建省泉州市晋江县', 'JJV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350523', '南安县', '福建省泉州市南安县', 'NAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350524', '安溪县', '福建省泉州市安溪县', 'AXR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350526', '德化县', '福建省泉州市德化县', 'DHW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350527', '金门县', '福建省泉州市金门县', 'JMQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350582', '晋江市', '福建省泉州市晋江市', 'JJW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350583', '南安市', '福建省泉州市南安市', 'NAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350603', '龙文区', '福建省漳州市龙文区', 'LWR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350621', '龙海县', '福建省漳州市龙海县', 'LHY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350625', '长泰县', '福建省漳州市长泰县', 'CTR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350626', '东山县', '福建省漳州市东山县', 'DSY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350627', '南靖县', '福建省漳州市南靖县', 'NJX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350628', '平和县', '福建省漳州市平和县', 'PHR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350629', '华安县', '福建省漳州市华安县', 'HAW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350681', '龙海市', '福建省漳州市龙海市', 'LHZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350700', '南平市', '福建省南平市', 'NPT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350722', '浦城县', '福建省南平市浦城县', 'PCP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350723', '光泽县', '福建省南平市光泽县', 'GZV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350783', '建瓯市', '福建省南平市建瓯市', 'JOP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350784', '建阳市', '福建省南平市建阳市', 'JYY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350800', '龙岩市', '福建省龙岩市', 'LYI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350821', '长汀县', '福建省龙岩市长汀县', 'CTS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350823', '上杭县', '福建省龙岩市上杭县', 'SHF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350825', '连城县', '福建省龙岩市连城县', 'LCB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350900', '宁德市', '福建省宁德地区宁德市', 'NDR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350902', '蕉城区', '蕉城区', 'JCP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350922', '古田县', '福建省宁德地区古田县', 'GTS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350923', '屏南县', '福建省宁德地区屏南县', 'PNP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350981', '福安市', '福建省宁德地区福安市', 'FAP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('350982', '福鼎市', '福建省宁德地区福鼎市', 'FDQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('352100', '建阳地区', '福建省建阳地区', 'JYZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('352122', '建阳县', '福建省建阳地区建阳县', 'JYB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('352123', '建瓯县', '福建省建阳地区建瓯县', 'JOQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('352126', '崇安县', '福建省建阳地区崇安县', 'CAU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360000', '江西省', '江西省', 'JXL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360100', '南昌市', '江西省南昌市', 'NCT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360102', '东湖区', '江西省南昌市东湖区', 'DHX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360104', '青云谱区', '江西省南昌市青云谱区', 'QYX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360111', '青山湖区', '江西省南昌市青山湖区', 'QLA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360121', '南昌县', '江西省南昌市南昌县', 'NCU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360124', '进贤县', '江西省南昌市进贤县', 'JXM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360200', '景德镇市', '江西省景德镇市', 'JDZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360202', '昌江区', '江西省景德镇市昌江区', 'CJP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360211', '鹅湖区', '江西省景德镇市鹅湖区', 'EHP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360212', '蛟潭区', '江西省景德镇市蛟潭区', 'JTT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360222', '浮梁县', '江西省景德镇市浮梁县', 'FLQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360281', '乐平市', '江西省景德镇市乐平市', 'LPS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360300', '萍乡市', '江西省萍乡市', 'PXU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360312', '庐溪区', '江西省萍乡市庐溪区', 'LXF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360321', '莲花县', '江西省萍乡市莲花县', 'LHB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360323', '芦溪县', '江西省萍乡市芦溪县', 'LXG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360400', '九江市', '江西省九江市', 'JJX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360402', '庐山区', '江西省九江市庐山区', 'LSK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360411', '郊区', '江西省九江市郊区', 'JQA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360421', '九江县', '江西省九江市九江县', 'JJY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360426', '德安县', '江西省九江市德安县', 'DAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360428', '都昌县', '江西省九江市都昌县', 'DCW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360429', '湖口县', '江西省九江市湖口县', 'HKQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360430', '彭泽县', '江西省九江市彭泽县', 'PZP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360481', '瑞昌市', '江西省九江市瑞昌市', 'RCT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360521', '分宜县', '江西省新余市分宜县', 'FYE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360681', '贵溪市', '江西省鹰潭市贵溪市', 'GXS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360700', '赣州市', '江西省赣州市', 'GZX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360721', '赣县', '江西省赣州市赣县', 'GXT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360723', '大余县', '江西省赣州市大余县', 'DYV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360725', '崇义县', '江西省赣州市崇义县', 'CYX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360727', '龙南县', '江西省赣州市龙南县', 'LNS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360728', '定南县', '江西省赣州市定南县', 'DNR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360729', '全南县', '江西省赣州市全南县', 'QNP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360730', '宁都县', '江西省赣州市宁都县', 'NDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360733', '会昌县', '江西省赣州市会昌县', 'HCU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360781', '瑞金市', '江西省赣州市瑞金市', 'RJP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360782', '南康市', '江西省赣州市南康市', 'NKQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360800', '吉安市', '江西省吉安地区吉安市', 'JAU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360802', '吉州区', '吉州区', 'JZP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360803', '青原区', '青原区', 'QYP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360821', '吉安县', '江西省吉安地区吉安县', 'JAV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360822', '吉水县', '江西省吉安地区吉水县', 'JSB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360829', '安福县', '江西省吉安地区安福县', 'AFQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360881', '井冈山市', '江西省吉安地区井冈山市', 'JGR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360921', '奉新县', '江西省宜春地区奉新县', 'FXZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360923', '上高县', '江西省宜春地区上高县', 'SGR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360925', '靖安县', '江西省宜春地区靖安县', 'JAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360981', '丰城市', '江西省宜春地区丰城市', 'FCU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('360983', '高安市', '江西省宜春地区高安市', 'GAR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('361000', '抚州市', '江西省抚州地区抚州市', 'FZX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('361002', '临川区', '临川区', 'LCP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('361021', '南城县', '江西省抚州地区南城县', 'NCV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('361022', '黎川县', '江西省抚州地区黎川县', 'LCF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('361023', '南丰县', '江西省抚州地区南丰县', 'NFQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('361024', '崇仁县', '江西省抚州地区崇仁县', 'CRP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('361025', '乐安县', '江西省抚州地区乐安县', 'LAW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('361027', '金溪县', '江西省抚州地区金溪县', 'JXN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('361029', '东乡县', '江西省抚州地区东乡县', 'DXY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('361030', '广昌县', '江西省抚州地区广昌县', 'GCX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('361122', '广丰县', '江西省上饶地区广丰县', 'GFP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('361124', '铅山县', '江西省上饶地区铅山县', 'QSW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('361125', '横峰县', '江西省上饶地区横峰县', 'HFQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('361181', '德兴市', '江西省上饶地区德兴市', 'DXW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('362432', '宁冈县', '江西省吉安地区宁冈县', 'NGV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('410000', '河南省', '河南省', 'HNX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420000', '湖北省', '湖北省', 'HBY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420102', '江岸区', '湖北省武汉市江岸区', 'JAW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420103', '江汉区', '湖北省武汉市江汉区', 'JHY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420104', '乔口区', '湖北省武汉市乔口区', 'QKP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420105', '汉阳区', '湖北省武汉市汉阳区', 'HYZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420107', '青山区', '湖北省武汉市青山区', 'QSY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420111', '洪山区', '湖北省武汉市洪山区', 'HSG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420112', '东西湖区', '湖北省武汉市东西湖区', 'DXB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420113', '汉南区', '湖北省武汉市汉南区', 'HNY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420114', '蔡甸区', '湖北省武汉市蔡甸区', 'CDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420115', '江夏区', '湖北省武汉市江夏区', 'JXA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420116', '黄陂区', '湖北省武汉市黄陂区', 'HPS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420121', '汉阳县', '湖北省武汉市汉阳县', 'HYB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420123', '黄陂县', '湖北省武汉市黄陂县', 'HPT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420200', '黄石市', '湖北省黄石市', 'HSH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420202', '黄石港区', '湖北省黄石市黄石港区', 'HSI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420221', '大冶县', '湖北省黄石市大冶县', 'DYZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420281', '大冶市', '湖北省黄石市大冶市', 'DYB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420302', '茅箭区', '湖北省十堰市茅箭区', 'MJQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420325', '房县', '湖北省十堰市房县', 'FXE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420381', '丹江口市', '湖北省十堰市丹江口市', 'DJR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420504', '点军区', '湖北省宜昌市点军区', 'DJS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420505', '虎亭区', '湖北省宜昌市虎亭区', 'HTR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420528', '长阳土家族自治县', '湖北省宜昌市长阳土家族自治县', 'CYE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420582', '当阳市', '湖北省宜昌市当阳市', 'DYC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420606', '樊城区', '湖北省襄樊市樊城区', 'FCB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420624', '南漳县', '湖北省襄樊市南漳县', 'NZS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420625', '谷城县', '湖北省襄樊市谷城县', 'GCB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420626', '保康县', '湖北省襄樊市保康县', 'BCT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420682', '老河口市', '湖北省襄樊市老河口市', 'LHG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420700', '鄂州市', '湖北省鄂州市', 'EZP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420702', '梁子湖区', '湖北省鄂州市梁子湖区', 'LZW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420703', '华容区', '湖北省鄂州市华容区', 'HRT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420704', '鄂城区', '湖北省鄂州市鄂城区', 'ECP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420800', '荆门市', '湖北省荆门市', 'JMT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420802', '东宝区', '湖北省荆门市东宝区', 'DBQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420804', '掇刀区', '湖北省荆门市掇刀区', 'CDP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('420821', '京山县', '湖北省荆门市京山县', 'JSD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420822', '沙洋区', '湖北省荆门市沙洋区', 'SYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420922', '大悟县', '湖北省孝感市大悟县', 'DWS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420982', '安陆市', '湖北省孝感市安陆市', 'ALT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('420984', '汉川市', '湖北省孝感市汉川市', 'HCZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421000', '荆州市', '湖北省荆州市', 'JZZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421002', '沙市区', '湖北省荆州市沙市区', 'SSY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421003', '荆州区', '湖北省荆州市荆州区', 'JZB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421022', '公安县', '湖北省荆州市公安县', 'GAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421023', '监利县', '湖北省荆州市监利县', 'JLX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421024', '江陵县', '湖北省荆州市江陵县', 'JLY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421083', '洪湖市', '湖北省荆州市洪湖市', 'HHV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421100', '黄冈市', '湖北省黄冈市', 'HGV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421102', '黄州区', '湖北省黄冈市黄州区', 'HZB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421122', '红安县', '湖北省黄冈市红安县', 'HAX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421123', '罗田县', '湖北省黄冈市罗田县', 'LTT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421126', '蕲春县', '湖北省黄冈市蕲春县', 'QCP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421127', '黄梅县', '湖北省黄冈市黄梅县', 'HMW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421181', '麻城市', '湖北省黄冈市麻城市', 'MCW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421221', '嘉鱼县', '湖北省咸宁地区嘉鱼县', 'JYI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421223', '崇阳县', '湖北省咸宁地区崇阳县', 'CYF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421281', '赤壁市', '湖北省咸宁地区赤壁市', 'PQT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('421381', '广水市', '湖北省孝感市广水市', 'GSU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('422129', '广济县', '湖北省黄冈地区广济县', 'GJS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('422800', '恩施土家族苗族自治州', '湖北省恩施土家族苗族自治州', 'EXP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('422801', '恩施市', '湖北省恩施土家族苗族自治州恩施市', 'ESP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('422802', '利川市', '湖北省恩施土家族苗族自治州利川市', 'LCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('422822', '建始县', '湖北省恩施土家族苗族自治州建始县', 'JSF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('422823', '巴东县', '湖北省恩施土家族苗族自治州巴东县', 'BDV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('422827', '来凤县', '湖北省恩施土家族苗族自治州来凤县', 'LFV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('422828', '鹤峰县', '湖北省恩施土家族苗族自治州鹤峰县', 'HFR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('422900', '湖北省直辖', '湖北省省直辖行政单位神', 'SZL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('429005', '潜江市', '湖北省省直辖县级行政单位潜江市', 'QJU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430000', '湖南省', '湖南省', 'HNZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430100', '长沙市', '湖南省长沙市', 'CSV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430102', '芙蓉区', '湖南省长沙市芙蓉区', 'DQR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430105', '开福区', '湖南省长沙市开福区', 'BQR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430121', '长沙县', '湖南省长沙市长沙县', 'CSW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430124', '宁乡县', '湖南省长沙市宁乡县', 'NXR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430181', '浏阳市', '湖南省长沙市浏阳市', 'LYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430202', '荷塘区', '湖南省株洲市荷塘区', 'DQS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430203', '芦淞区', '湖南省株洲市芦淞区', 'BQS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430224', '茶陵县', '湖南省株洲市茶陵县', 'CLZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430281', '醴陵市', '湖南省株洲市醴陵市', 'LLV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430305', '板塘区', '湖南省湘潭市板塘区', 'BTU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430311', '郊区', '湖南省湘潭市郊区', 'JQA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430400', '衡阳市', '湖南省衡阳市', 'HYC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430402', '江东区', '湖南省衡阳市江东区', 'JDB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430403', '城南区', '湖南省衡阳市城南区', 'CNR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430411', '郊区', '湖南省衡阳市郊区', 'JQA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430412', '南岳区', '湖南省衡阳市南岳区', 'NYU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430421', '衡阳县', '湖南省衡阳市衡阳县', 'HYD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430422', '衡南县', '湖南省衡阳市衡南县', 'HNB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430423', '衡山县', '湖南省衡阳市衡山县', 'HSJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430424', '衡东县', '湖南省衡阳市衡东县', 'HDB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430426', '祁东县', '湖南省衡阳市祁东县', 'QDV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430427', '来阳县', '湖南省衡阳市来阳县', 'LYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430481', '耒阳市', '湖南省衡阳市耒阳市', 'LYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430482', '常宁市', '湖南省衡阳市常宁市', 'CNT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430503', '大祥区', '湖南省邵阳市大祥区', 'XQT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430504', '桥头区', '湖南省邵阳市桥头区', 'QTR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430511', '北塔区', '湖南省邵阳市北塔区', 'JQA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430524', '隆回县', '湖南省邵阳市隆回县', 'LHH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430525', '洞口县', '湖南省邵阳市洞口县', 'DKR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430529', '城步苗族自治县', '湖南省邵阳市城步苗族自治县', 'CBS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430611', '君山区', '湖南省岳阳市君山区', 'JQA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430623', '华容县', '湖南省岳阳市华容县', 'HRU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430625', '汨罗县', '湖南省岳阳市汨罗县', 'MLV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430626', '平江县', '湖南省岳阳市平江县', 'PJU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430681', '汨罗市', '湖南省岳阳市汨罗市', 'PLV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430682', '临湘市', '湖南省岳阳市临湘市', 'LXA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430700', '常德市', '湖南省常德市', 'CDU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430703', '鼎城区', '湖南省常德市鼎城区', 'DCB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430721', '安乡县', '湖南省常德市安乡县', 'AXS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430722', '汉寿县', '湖南省常德市汉寿县', 'HSK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430723', '澧县', '湖南省常德市澧县', 'LXA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430724', '临澧县', '湖南省常德市临澧县', 'LLW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430781', '津市市', '湖南省常德市津市市', 'JSG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430821', '慈利县', '湖南省张家界市慈利县', 'CLB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430822', '桑植县', '湖南省张家界市桑植县', 'SZO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430903', '赫山区', '湖南省益阳市赫山区', 'HSL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430921', '南县', '湖南省益阳市南县', 'NXS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('430923', '安化县', '湖南省益阳市安化县', 'AHS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431000', '郴州市', '湖南省郴州市', 'CZB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431002', '北湖区', '湖南省郴州市北湖区', 'BHR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431021', '桂阳县', '湖南省郴州市桂阳县', 'GYD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431023', '永兴县', '湖南省郴州市永兴县', 'YX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '郴州市永兴县'),
('431024', '嘉禾县', '湖南省郴州市嘉禾县', 'JHZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431025', '临武县', '湖南省郴州市临武县', 'LWU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431026', '汝城县', '湖南省郴州市汝城县', 'RCW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431027', '桂东县', '湖南省郴州市桂东县', 'GDQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431028', '安仁县', '湖南省郴州市安仁县', 'ARQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431103', '冷水滩区', '湖南省永州市冷水滩区', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431121', '祁阳县', '湖南省永州市祁阳县', 'QYC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431122', '东安县', '湖南省永州市东安县', 'ADQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431124', '道县', '湖南省永州市道县', 'DXC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431125', '江永县', '湖南省永州市江永县', 'JYJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431126', '宁远县', '湖南省永州市宁远县', 'MYT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431127', '蓝山县', '湖南省永州市蓝山县', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431129', '江华瑶族自治县', '湖南省永州市江华瑶族自治县', 'JHB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431200', '怀化市', '湖南省怀化市', 'HHX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431202', '鹤城区', '湖南省怀化市鹤城区', 'HCC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431223', '辰溪县', '湖南省怀化市辰溪县', 'CXZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431225', '会同县', '湖南省怀化市会同县', 'HTS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431226', '麻阳苗族自治县', '湖南省怀化市麻阳苗族自治县', 'MYU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431229', '靖州苗族侗族自治县', '湖南省怀化市靖州苗族侗族自治县', 'JZD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431281', '洪江市', '湖南省怀化市洪江市', 'HJZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431301', '娄底市', '湖南省娄底地区娄底市', 'LDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431302', '娄星区', '湖南省娄底地区娄星区', 'LXP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('431381', '冷水江市', '湖南省娄底地区冷水江市', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('431382', '涟源市', '湖南省娄底地区涟源市', 'LYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('432900', '零陵市', '湖南省零陵市', 'LLY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('433021', '黔阳县', '湖南省怀化地区黔阳县', 'QYE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('433101', '吉首市', '湖南省湘西土家族苗族自治州吉首市', 'JSI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('433102', '大庸市', '湖南省湘西土家族苗族自治州大庸市', 'DYE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('433122', '泸溪县', '湖南省湘西土家族苗族自治州泸溪县', 'LXA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('433123', '凤凰县', '湖南省湘西土家族苗族自治州凤凰县', 'FHR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('433124', '花垣县', '湖南省湘西土家族苗族自治州花垣县', 'HYE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('433125', '保靖县', '湖南省湘西土家族苗族自治州保靖县', 'BJT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('433126', '古丈县', '湖南省湘西土家族苗族自治州古丈县', 'GZC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('433130', '龙山县', '湖南省湘西土家族苗族自治州龙山县', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440000', '广东省', '广东省', 'GDS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440100', '广州市', '广东省广州市', 'GZD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440102', '东山区', '广东省广州市东山区', 'DSZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440103', '荔湾区', '广东省广州市荔湾区', 'LWW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440105', '海珠区', '广东省广州市海珠区', 'HZC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440107', '芳村区', '广东省广州市芳村区', 'THE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440111', '白云区', '广东省广州市白云区', 'JQA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440112', '黄埔区', '广东省广州市黄埔区', 'HPU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440113', '番禺区', '广东省广州市番禺区', 'PYF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440114', '花都区', '广东省广州市花都区', 'HDC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440121', '花县', '广东省广州市花县', 'HXB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440127', '清远县', '广东省广州市清远县', 'QYF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440184', '从化市', '广东省广州市从化市', 'CHY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440202', '北江区', '广东省韶关市北江区', 'BJU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440221', '曲江县', '广东省韶关市曲江县', 'QJV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440224', '仁化县', '广东省韶关市仁化县', 'RHS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440226', '连县', '广东省韶关市连县', 'LXA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440230', '连山壮族瑶族县', '广东省韶关市连山壮族瑶族县', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440232', '乳源瑶族自治县', '广东省韶关市乳源瑶族自治县', 'RYR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440281', '乐昌市', '广东省韶关市乐昌市', 'LCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440282', '南雄市', '广东省韶关市南雄市', 'NXV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440303', '罗湖区', '广东省深圳市罗湖区', 'LHI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440304', '福田区', '广东省深圳市福田区', 'FTR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440305', '南山区', '广东省深圳市南山区', 'NSS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440306', '宝安区', '广东省深圳市宝安区', 'BAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440307', '龙岗区', '广东省深圳市龙岗区', 'LGR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440403', '斗门区', '广东省珠海市斗门区', 'DMS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440404', '金湾区', '广州省珠海市金湾区', 'JWP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440500', '汕头市', '广东省汕头市', 'STT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440503', '安平区', '广东省汕头市安平区', 'APR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440504', '公园区', '广东省汕头市公园区', 'GYF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440505', '金砂区', '广东省汕头市金砂区', 'JSJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440506', '达濠区', '广东省汕头市达濠区', 'DHY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440507', '龙湖区', '广东省汕头市龙湖区', 'LHJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440508', '金园区', '广东省汕头市金园区', 'JYL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440510', '河浦区', '广东省汕头市河浦区', 'HPV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440511', '郊区', '广东省汕头市郊区', 'JQA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440523', '南澳县', '广东省汕头市南澳县', 'NAU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440525', '揭阳县', '广东省汕头市揭阳县', 'JYM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440582', '潮阳市', '广东省汕头市潮阳市', 'CYI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440583', '澄海市', '广东省汕头市澄海市', 'CHB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440600', '佛山市', '广东省佛山市', 'FSW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440602', '汾江区', '广东省佛山市汾江区', 'FJS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440604', '禅城区', '广东省佛山市禅城区', 'CCS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440605', '南海区', '广东省佛山市南海区', 'NHZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440607', '三水区', '广东省佛山市三水区', 'SSF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440608', '高明区', '广东省佛山市高明区', 'GMS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440700', '江门市', '广东省江门市', 'JMU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440702', '城区', '广东省江门市城区', 'JMV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440703', '蓬江区', '广东省江门市蓬江区', 'JMW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440704', '江海区', '广东省江门市江海区', 'JMX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440711', '郊区', '广东省江门市郊区', 'JQA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440783', '开平市', '广东省江门市开平市', 'KPT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440784', '鹤山市', '广东省江门市鹤山市', 'HSO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440785', '恩平市', '广东省江门市恩平市', 'EPQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440802', '赤坎区', '广东省湛江市赤坎区', 'CKQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440804', '坡头区', '广东省湛江市坡头区', 'PTV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440811', '麻章区', '广东省湛江市麻章区', 'JQA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440824', '海康县', '广东省湛江市海康县', 'HKS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440881', '廉江市', '广东省湛江市廉江市', 'LJB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440882', '雷州市', '广东省湛江市雷州市', 'LZX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440900', '茂名市', '广东省茂名市', 'MMP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440902', '茂南区', '广东省茂名市茂南区', 'MNP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440903', '茂港区', '广州省茂名市茂港区', 'MGP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440923', '电白县', '广东省茂名市电白县', 'DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440981', '高州市', '广东省茂名市高州市', 'GZF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('440982', '化州市', '广东省茂名市化州市', 'HZE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441202', '端州区', '广东省肇庆市端州区', 'DZX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441203', '鼎湖区', '广东省肇庆市鼎湖区', 'DHZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441223', '广宁县', '广东省肇庆市广宁县', 'GNT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441224', '怀集县', '广东省肇庆市怀集县', 'HJC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441225', '封开县', '广东省肇庆市封开县', 'FKR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441226', '德庆县', '广东省肇庆市德庆县', 'DQU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441283', '高要市', '广东省肇庆市高要市', 'GYG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441300', '惠州市', '广东省惠州市', 'HZF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441302', '惠城区', '广东省惠州市惠城区', 'HZG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441322', '博罗县', '广东省惠州市博罗县', 'BLT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441323', '惠东县', '广东省惠州市惠东县', 'HDC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441324', '龙门县', '广东省惠州市龙门县', 'LMQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441381', '惠阳市', '广东省惠州市惠阳市', 'HYF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441400', '梅州市', '广东省梅州市', 'MZR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441402', '梅江区', '广东省梅州市梅江区', 'MZS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441422', '大埔县', '广东省梅州市大埔县', 'DPQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441423', '丰顺县', '广东省梅州市丰顺县', 'FSX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441426', '平远县', '广东省梅州市平远县', 'PYB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441427', '蕉岭县', '广东省梅州市蕉岭县', 'JLC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441500', '汕尾市', '广东省汕尾市', 'SWU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441502', '城区', '广东省汕尾市城区', 'CQY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441521', '海丰县', '广东省汕尾市海丰县', 'HFS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441523', '陆河县', '广东省汕尾市陆河县', 'LHK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441581', '陆丰市', '广东省汕尾市陆丰市', 'LFW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441600', '河源市', '广东省河源市', 'HYG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441622', '龙川县', '广东省河源市龙川县', 'LCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441623', '连平县', '广东省河源市连平县', 'LPT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441624', '和平县', '广东省河源市和平县', 'HPW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441625', '东源县', '广东省河源市东源县', 'DYF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441702', '江城区', '广东省阳江市江城区', 'JCW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441800', '清远市', '广东省清远市', 'QYG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441802', '清城区', '广东省清远市清城区', 'QCR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441821', '佛冈县', '广东省清远市佛冈县', 'FGR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441825', '连山壮族瑶族自治县', '广东省清远市连山壮族瑶族自治县', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441826', '连南瑶族自治县', '广东省清远市连南瑶族自治县', 'LNW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441827', '清新县', '广东省清远市清新县', 'QXE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441882', '连州市', '广东省清远市连州市', 'LZY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('441900', '东莞市', '广东省东莞市', 'DGS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('442500', '惠阳地区', '广东省惠阳地区', 'HYI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('445100', '潮州市', '广东省潮州市', 'CZE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('445121', '潮安县', '广东省潮州市潮安县', 'CAV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('445122', '饶平县', '广东省潮州市饶平县', 'RPQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('445200', '揭阳市', '广东省揭阳市', 'JYN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('445202', '榕城区', '广东省揭阳市榕城区', 'RCY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('445221', '揭东县', '广东省揭阳市揭东县', 'JDD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('445222', '揭西县', '广东省揭阳市揭西县', 'JXA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('445224', '惠来县', '广东省揭阳市惠来县', 'HLO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('445281', '普宁市', '广东省揭阳市普宁市', 'PNR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('445381', '罗定市', '广东省云浮市罗定市', 'LDV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450000', '广西壮族自治区', '广西壮族自治区', 'GXY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450100', '南宁市', '广西壮族自治区南宁市', 'NNV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450104', '城北区', '广西壮族自治区南宁市城北区', 'CBU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450105', '江南区', '广西壮族自治区南宁市江南区', 'JNX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450111', '郊区', '广西壮族自治区南宁市郊区', 'JQA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450123', '隆安县', '广西壮族自治区南宁市隆安县', 'LAY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450124', '马山县', '广西壮族自治区南宁市马山县', 'MSX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450127', '横县', '广西壮族自治区南宁市横县', 'HXC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450200', '柳州市', '广西壮族自治区柳州市', 'LZC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450202', '城中区', '广西壮族自治区柳州市城中区', 'CZH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450204', '柳南区', '广西壮族自治区柳州市柳南区', 'LNX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450205', '柳北区', '广西壮族自治区柳州市柳北区', 'LBX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450211', '郊区', '广西壮族自治区柳州市郊区', 'JQA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450221', '柳江县', '广西壮族自治区柳州市柳江县', 'LJC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450222', '柳城县', '广西壮族自治区柳州市柳城县', 'LCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450223', '鹿寨县', '广西壮族自治区柳州市鹿寨县', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450224', '融安县', '广西壮族自治区柳州市融安县', 'RAR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450225', '融水苗族自治县', '广西壮族自治区柳州市融水苗族自治县', 'RSR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450226', '三江侗族自治县', '广西壮族自治区柳州市三江侗族自治县', 'SJY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450300', '桂林市', '广西壮族自治区桂林市', 'GLY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450303', '叠彩区', '广西壮族自治区桂林市叠彩区', 'DCC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450305', '七星区', '广西壮族自治区桂林市七星区', 'QXF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450322', '临桂县', '广西壮族自治区桂林市临桂县', 'LGS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450323', '灵川县', '广西壮族自治区桂林市灵川县', 'LCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450324', '全州县', '广西壮族自治区桂林市全州县', 'QZX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450327', '灌阳县', '广西壮族自治区桂林市灌阳县', 'GYI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450328', '龙胜各族自治县', '广西壮族自治区桂林市龙胜各族自治县', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450330', '平乐县', '广西壮族自治区桂林市平乐县', 'PLW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450331', '荔浦县', '广西壮族自治区桂林市荔浦县', 'LPV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450332', '恭城瑶族自治县', '广西壮族自治区桂林市恭城瑶族自治县', 'GCC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450404', '蝶山区', '广西壮族自治区梧州市蝶山区', 'DSB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450421', '苍梧县', '广西壮族自治区梧州市苍梧县', 'CWR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450423', '蒙山县', '广西壮族自治区梧州市蒙山县', 'MSW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450481', '岑溪市', '广西壮族自治区梧州市岑溪市', 'CXD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450500', '北海市', '广西壮族自治区北海市', 'BHS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450502', '海城区', '广西壮族自治区北海市海城区', 'HCD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450511', '郊区', '广西壮族自治区北海市郊区', 'JQA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tms_bd_regionset` (`rs_RegionCode`, `rs_RegionName`, `rs_RegionFullName`, `rs_HelpCode`, `rs_IdCode`, `rs_AdderID`, `rs_Adder`, `rs_AddTime`, `rs_ModerID`, `rs_Moder`, `rs_ModTime`, `rs_Remark`) VALUES
('450521', '合浦县', '广西壮族自治区北海市合浦县', 'HPY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450600', '防城港市', '广西壮族自治区防城港市', 'FCD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450602', '港口区', '广西壮族自治区防城港市港口区', 'FCE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450603', '防城区', '广西壮族自治区防城港市防城区', 'FCF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450681', '东兴市', '广西壮族自治区防城港市东兴市', 'DXE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450700', '钦州市', '广西壮族自治区钦州市', 'QZC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450702', '钦南区', '广西壮族自治区钦州市钦南区', 'QNR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450703', '钦北区', '广西壮族自治区钦州市钦北区', 'QBP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450721', '灵山县', '广西壮族自治区钦州市灵山县', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450722', '浦北县', '广西壮族自治区钦州市浦北县', 'PBP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450800', '贵港市', '广西壮族自治区贵港市', 'GGQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450802', '港北区', '广西壮族自治区贵港市港北区', 'GBQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450803', '港南区', '广西壮族自治区贵港市港南区', 'GNV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450821', '平南县', '广西壮族自治区贵港市平南县', 'PNS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450881', '桂平市', '广西壮族自治区贵港市桂平市', 'GPT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450922', '陆川县', '广西壮族自治区玉林市陆川县', 'LCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('450981', '北流市', '广西壮族自治区玉林市北流市', 'BLV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451000', '百色市', '广西壮族自治区百色地区百色市', 'BSV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451023', '平果县', '广西壮族自治区百色地区平果县', 'PGR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451024', '德保县', '广西壮族自治区百色地区德保县', 'DBS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451025', '靖西县', '广西壮族自治区百色地区靖西县', 'JXA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451026', '那坡县', '广西壮族自治区百色地区那坡县', 'NPV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451027', '凌云县', '广西壮族自治区百色地区凌云县', 'LYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451028', '乐业县', '广西壮族自治区百色地区乐业县', 'LYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451031', '隆林各族自', '广西壮族自治区百色地区隆林各族自治县', 'LLP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('451100', '贺州市', '广西壮族自治区贺州地区贺州市', 'HZI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451102', '八步区', '广西壮族自治区贺州地区八步区', 'BBP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('451123', '富川瑶族自', '广西壮族自治区贺州地区富川瑶族自治县', 'FCP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('451200', '河池市', '广西壮族自治区河池地区河池市', 'HCF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451202', '金城江区', '广西壮族自治区河池地区金城江区', 'JCP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('451221', '南丹县', '广西壮族自治区河池地区南丹县', 'NDV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451223', '凤山县', '广西壮族自治区河池地区凤山县', 'FSB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451224', '东兰县', '广西壮族自治区河池地区东兰县', 'DLY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451225', '罗城仫佬族', '广西壮族自治区河池地区罗城仫佬族自治县', 'LCP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('451226', '环江毛南族', '广西壮族自治区河池地区环江毛南族自治县', 'HJP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('451228', '都安瑶族自', '广西壮族自治区河池地区都安瑶族自治县', 'DAP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('451229', '大化瑶族自', '广西壮族自治区河池地区大化瑶族自治县', 'DHP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('451300', '来宾市', '广西壮族自治区来宾市', 'LBY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451324', '金秀瑶族自治县', '广西壮族自治区来宾市金秀瑶族自治县', 'JXA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451381', '合山市', '广西壮族自治区来宾市合山市', 'HSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451400', '崇左市', '广西壮族自治区崇左市', 'NNP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451402', '江洲区', '广西壮族自治区崇左市江洲区', 'JZE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451421', '扶绥县', '广西壮族自治区崇左市扶绥县', 'FSZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451422', '宁明县', '广西壮族自治区崇左市宁明县', 'NMR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451423', '龙州县', '广西壮族自治区崇左市龙州县', 'LZB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451424', '大新县', '广西壮族自治区崇左市大新县', 'DXF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('451481', '凭祥市', '广西壮族自治区崇左市凭祥市', 'PXV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('452322', '灵州县', '广西壮族自治区桂林地区灵州县', 'LZZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('452332', '恭城县', '广西壮族自治区桂林地区恭城县', 'GCD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('452400', '贺州地区', '广西壮族自治区贺州地区', 'WZU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('452426', '贺县', '广西壮族自治区贺州地区贺县', 'HXD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('452428', '富川瑶族自治县', '广西壮族自治区贺州地区富川瑶族自治县', 'FCG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('452522', '贵县', '广西壮族自治区玉林地区贵县', 'GXZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('452525', '容县', '广西壮族自治区玉林地区容县', 'RXS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('452631', '隆林各族自治县', '广西壮族自治区百色地区隆林各族自治县', 'LLZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('452723', '罗城仫佬族自治县', '广西壮族自治区河池地区罗城仫佬族自治县', 'LCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('452724', '环江毛南族自治县', '广西壮族自治区河池地区环江毛南族自治县', 'HJE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('452822', '防城各族自治县', '广西壮族自治区钦州地区防城各族自治县', 'FCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('460000', '海南省', '海南省', 'HNC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('460004', '琼山市', '海南省琼山市', 'QSZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('460100', '海口市', '海南省海口市', 'HKT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('460106', '龙华区', '海南省海口市龙华区', 'HKU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('460107', '琼山区', '海南省海口市琼山区', 'HKX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('460108', '美兰区', '海南省海口市美兰区', 'HKV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('460200', '三亚市', '海南省三亚市', 'SYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('469002', '琼海市', '海南省琼海市', 'QHY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('469003', '儋州市', '海南省海南省儋州市', 'SZA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('469007', '东方市', '海南省东方市', 'DFX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('469021', '琼山县', '海南省琼山县', 'QSB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('469023', '琼海县', '海南省琼海县', 'QHZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('469025', '定安县', '海南省海南省定安县', 'DAW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('469027', '澄迈县', '海南省海南省澄迈县', 'CMQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('469028', '临高县', '海南省海南省临高县', 'LGT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('469031', '昌江黎族自治县', '海南省海南省昌江黎族自治县', 'CJQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('469033', '乐东黎族自治县', '海南省海南省乐东黎族自治县', 'LDW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('469034', '陵水黎族自治县', '海南省海南省陵水黎族自治县', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('469036', '琼中黎族苗族自治县', '海南省海南省琼中黎族苗族自治县', 'QZY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('469038', '南沙群岛', '海南省海南省南沙群岛', 'NST', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500102', '涪陵区', '重庆市涪陵区', 'FLR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500104', '大渡口区', '重庆市大渡口区', 'DDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500105', '江北区', '重庆市江北区', 'JBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500106', '沙坪坝区', '重庆市沙坪坝区', 'SPW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500107', '九龙坡区', '重庆市九龙坡区', 'JLE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500108', '南岸区', '重庆市南岸区', 'NAV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500114', '黔江区', '重庆市黔江区', 'QJP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500115', '长寿区', '重庆市长寿区', 'CSP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500222', '綦江县', '重庆市綦江县', 'QJW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500225', '大足县', '重庆市大足县', 'DZY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500226', '荣昌县', '重庆市荣昌县', 'RCZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500228', '梁平县', '重庆市梁平县', 'LPY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500229', '城口县', '重庆市城口县', 'CKR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500230', '丰都县', '重庆市丰都县', 'FDS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500231', '垫江县', '重庆市垫江县', 'DJU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500234', '开县', '重庆市开县', 'KXA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500236', '奉节县', '重庆市奉节县', 'FJT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500243', '彭水苗族土家族自治县', '重庆市彭水苗族土家族自治县', 'PSX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500381', '江津市', '重庆市江津市', 'JJZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500382', '合川市', '重庆市合川市', 'HCG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('500384', '南川市', '重庆市南川市', 'NCW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510100', '成都市', '四川省成都市', 'CDY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510104', '锦江区', '四川省成都市锦江区', 'JJB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510105', '青羊区', '四川省成都市青羊区', 'QYH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510106', '金牛区', '四川省成都市金牛区', 'JNY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510108', '成华区', '四川省成都市成华区', 'CHC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510112', '龙泉驿区', '四川省成都市龙泉驿区', 'LQD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510113', '青白江区', '四川省成都市青白江区', 'QBQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510121', '金堂县', '四川省成都市金堂县', 'JTU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510124', '郫县', '四川省成都市郫县', 'PXW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510126', '彭县', '四川省成都市彭县', 'PXX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510127', '灌县', '四川省成都市灌县', 'GXB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510128', '崇庆县', '四川省成都市崇庆县', 'CQC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510129', '大邑县', '四川省成都市大邑县', 'DYG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510131', '蒲江县', '四川省成都市蒲江县', 'PJV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510181', '都江堰市', '四川省成都市都江堰市', 'DJV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510182', '彭州市', '四川省成都市彭州市', 'PZQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510183', '邛崃市', '四川省成都市邛崃市', 'QLS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510184', '崇州市', '四川省成都市崇州市', 'CZI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510216', '南桐矿区', '四川省重庆市南桐矿区', 'NTR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510303', '贡井区', '四川省自贡市贡井区', 'GJT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510304', '大安区', '四川省自贡市大安区', 'DAX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510321', '荣县', '四川省自贡市荣县', 'RXT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510322', '富顺县', '四川省自贡市富顺县', 'FSC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510400', '攀枝花市', '四川省攀枝花市', 'DKS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510402', '东区', '四川省攀枝花市东区', 'DQW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510411', '仁和区', '四川省攀枝花市仁和区', 'RHT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510421', '米易县', '四川省攀枝花市米易县', 'MYW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510500', '泸州市', '四川省泸州市', 'LZD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510502', '江阳区', '四川省泸州市江阳区', 'SZA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510503', '纳溪区', '四川省泸州市纳溪区', 'NXW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510504', '龙马潭区', '四川省泸州市龙马潭区', 'LMR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510521', '泸县', '四川省泸州市泸县', 'LXA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510522', '合江县', '四川省泸州市合江县', 'HJF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510525', '古蔺县', '四川省泸州市古蔺县', 'GLB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510600', '德阳市', '四川省德阳市', 'DYH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510603', '旌阳区', '四川省德阳市旌阳区', 'JYO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510622', '绵竹县', '四川省德阳市绵竹县', 'MZT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510624', '广汉县', '四川省德阳市广汉县', 'GHR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510626', '罗江县', '四川省德阳市罗江县', 'LJD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510681', '广汉市', '四川省德阳市广汉市', 'GHS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510683', '绵竹市', '四川省德阳市绵竹市', 'MZU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510700', '绵阳市', '四川省绵阳市', 'MYX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510703', '涪城区', '四川省绵阳市涪城区', 'FCI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510722', '三台县', '四川省绵阳市三台县', 'STU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510724', '安县', '四川省绵阳市安县', 'AXU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510727', '平武县', '四川省绵阳市平武县', 'PWP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510781', '江油市', '四川省绵阳市江油市', 'JYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510800', '广元市', '四川省广元市', 'GYK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510812', '朝天区', '四川省广元市朝天区', 'CTU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510822', '青川县', '四川省广元市青川县', 'QCS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510823', '剑阁县', '四川省广元市剑阁县', 'JGS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510824', '苍溪县', '四川省广元市苍溪县', 'CXF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510921', '蓬溪县', '四川省遂宁市蓬溪县', 'PXY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('510923', '大英县', '四川省遂宁市大英县', 'DYI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511000', '内江市', '四川省内江市', 'NJB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511011', '东兴区', '四川省内江市东兴区', 'DXG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511027', '简阳县', '四川省内江市简阳县', 'JYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511028', '隆昌县', '四川省内江市隆昌县', 'LCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511100', '乐山市', '四川省乐山市', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511111', '沙湾区', '四川省乐山市沙湾区', 'SWV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511113', '金口河区', '四川省乐山市金口河区', 'JKQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511123', '犍为县', '四川省乐山市犍为县', 'QWQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511124', '井研县', '四川省乐山市井研县', 'JYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511126', '夹江县', '四川省乐山市夹江县', 'JJD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511129', '沐川县', '四川省乐山市沐川县', 'MCY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511132', '峨边彝族自治县', '四川省乐山市峨边彝族自治县', 'EBP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511133', '马边彝族自治县', '四川省乐山市马边彝族自治县', 'MBP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511181', '峨眉山市', '四川省乐山市峨眉山市', 'EMQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511300', '南充市', '四川省南充市', 'NCX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511303', '高坪区', '四川省南充市高坪区', 'GPV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511304', '嘉陵区', '四川省南充市嘉陵区', 'JLG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511321', '南部县', '四川省南充市南部县', 'NBQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511323', '蓬安县', '四川省南充市蓬安县', 'PAQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511381', '阆中市', '四川省南充市阆中市', 'LZF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511400', '眉山市', '四川省眉山市', 'MSP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('511402', '东坡区', '眉山市东坡区', 'DPP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511421', '仁寿县', '四川省乐山市仁寿县', 'RSS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511422', '彭山县', '四川省乐山市彭山县', 'PSY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511423', '洪雅县', '四川省乐山市洪雅县', 'HYL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511424', '丹棱县', '四川省乐山市丹棱县', 'DLZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511425', '青神县', '四川省乐山市青神县', 'QSC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511502', '翠屏区', '四川省宜宾市翠屏区', 'CPR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511522', '南溪县', '四川省宜宾市南溪县', 'NXY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511523', '江安县', '四川省宜宾市江安县', 'JAX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511524', '长宁县', '四川省宜宾市长宁县', 'CNV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511525', '高县', '四川省宜宾市高县', 'GXC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511526', '珙县', '四川省宜宾市珙县', 'GXD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511527', '筠连县', '四川省宜宾市筠连县', 'JLH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511529', '屏山县', '四川省宜宾市屏山县', 'PSZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511600', '广安市', '四川省广安市', 'GAV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511602', '广安区', '四川省广安市广安区', 'GAW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511623', '邻水县', '四川省广安市邻水县', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511681', '华莹市', '四川省广安市华蓥市', 'HYM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511700', '达州市', '四川省达州市', 'DZP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('511721', '达县', '四川省达州市达县', 'DXJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511723', '开江县', '四川省达川地区开江县', 'KJP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511724', '大竹县', '四川省达川地区大竹县', 'DZB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511725', '渠县', '四川省达川地区渠县', 'QXG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511821', '名山县', '四川省雅安地区名山县', 'MSB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511823', '汉源县', '四川省雅安地区汉源县', 'HYN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511826', '芦山县', '四川省雅安地区芦山县', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511827', '宝兴县', '四川省雅安地区宝兴县', 'BXB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511922', '南江县', '四川省巴中地区南江县', 'NJE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('511923', '平昌县', '四川省巴中地区平昌县', 'PCS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('512022', '乐至县', '四川资阳市乐至县', 'LZE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('512081', '简阳市', '四川省资阳地区简阳市', 'JYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513000', '达川地区', '四川省达川地区', 'DXH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513001', '达川市', '四川省达川地区达川市', 'DXI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513222', '理县', '四川省阿坝藏族羌族自治州理县', 'LXA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513223', '茂县', '四川省阿坝藏族羌族自治州茂县', 'MWQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513225', '九寨沟县', '四川省阿坝藏族羌族自治州九寨沟县', 'NPW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513226', '金川县', '四川省阿坝藏族羌族自治州金川县', 'JCX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513228', '黑水县', '四川省阿坝藏族羌族自治州黑水县', 'HSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513229', '马尔康县', '四川省阿坝藏族羌族自治州马尔康县', 'MEP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513230', '壤塘县', '四川省阿坝藏族羌族自治州壤塘县', 'SCK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513232', '若尔盖县', '四川省阿坝藏族羌族自治州若尔盖县', 'REP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513233', '红原县', '四川省阿坝藏族羌族自治州红原县', 'HYO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513300', '甘孜藏族自治州', '四川省甘孜藏族自治州', 'GZG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513321', '康定县', '四川省甘孜藏族自治州康定县', 'KDR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513322', '泸定县', '四川省甘孜藏族自治州泸定县', 'LDX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513323', '丹巴县', '四川省甘孜藏族自治州丹巴县', 'DBT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513324', '九龙县', '四川省甘孜藏族自治州九龙县', 'JLJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513326', '道孚县', '四川省甘孜藏族自治州道孚县', 'DFZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513327', '炉霍县', '四川省甘孜藏族自治州炉霍县', 'LHL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513328', '甘孜县', '四川省甘孜藏族自治州甘孜县', 'GZH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513330', '德格县', '四川省甘孜藏族自治州德格县', 'DGW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513333', '色达县', '四川省甘孜藏族自治州色达县', 'SDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513334', '理塘县', '四川省甘孜藏族自治州理塘县', 'LTV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513337', '稻城县', '四川省甘孜藏族自治州稻城县', 'DCF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513338', '得荣县', '四川省甘孜藏族自治州得荣县', 'DRP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513400', '凉山彝族自治州', '四川省凉山彝族自治州', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513422', '木里藏族自治县', '四川省凉山彝族自治州木里藏族自治县', 'MLW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513424', '德昌县', '四川省凉山彝族自治州德昌县', 'DCG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513425', '会理县', '四川省凉山彝族自治州会理县', 'HLA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513426', '会东县', '四川省凉山彝族自治州会东县', 'HDE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513427', '宁南县', '四川省凉山彝族自治州宁南县', 'NNQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513428', '普格县', '四川省凉山彝族自治州普格县', 'PGS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513429', '布拖县', '四川省凉山彝族自治州布拖县', 'BTX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513430', '金阳县', '四川省凉山彝族自治州金阳县', 'JYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513433', '冕宁县', '四川省凉山彝族自治州冕宁县', 'MNQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513435', '甘洛县', '四川省凉山彝族自治州甘洛县', 'GLC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513436', '美姑县', '四川省凉山彝族自治州美姑县', 'MGR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('513437', '雷波县', '四川省凉山彝族自治州雷波县', 'LBB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520000', '贵州省', '贵州省', 'GZI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520100', '贵阳市', '贵州省贵阳市', 'GYL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520102', '南明区', '贵州省贵阳市南明区', 'NMS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520111', '花溪区', '贵州省贵阳市花溪区', 'HXE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520121', '开阳县', '贵州省贵阳市开阳县', 'KYT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520181', '清镇市', '贵州省贵阳市清镇市', 'QZD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520200', '六盘水市', '贵州省六盘水市', 'LPB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520203', '六枝特区', '贵州省六盘水市六枝特区', 'PXZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520222', '盘县', '贵州省六盘水市盘县', 'PXL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520302', '红花岗区', '贵州省遵义市红花岗区', 'HHB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520325', '道真仡佬族苗族自治县', '贵州省遵义市道真仡佬族苗族自治县', 'DZC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520327', '凤冈县', '贵州省遵义市凤冈县', 'FGS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520328', '湄潭县', '贵州省遵义市湄潭县', 'MTQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520381', '赤水市', '贵州省遵义市赤水市', 'CSZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520382', '仁怀市', '贵州省遵义市仁怀市', 'RHU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520400', '安顺市', '贵州省安顺地区安顺市', 'ASR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520421', '平坝县', '贵州省安顺地区平坝县', 'PBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520422', '普定县', '贵州省安顺地区普定县', 'PDU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('520424', '关岭布依族苗族自治县', '贵州省安顺地区关岭布依族苗族自治县', 'GLD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522222', '江口县', '贵州省铜仁地区江口县', 'JKR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522227', '德江县', '贵州省铜仁地区德江县', 'DJX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522300', '黔西南布依族苗族自治', '贵州省黔西南布依族苗族自治', 'QXH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522323', '普安县', '贵州省黔西南布依族苗族自治普安县', 'PAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522324', '晴隆县', '贵州省黔西南布依族苗族自治晴隆县', 'QLU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522327', '册亨县', '贵州省黔西南布依族苗族自治册亨县', 'CHD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522328', '安龙县', '贵州省黔西南布依族苗族自治安龙县', 'ALV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522400', '毕节地区', '贵州省毕节地区', 'BJV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522401', '毕节市', '贵州省毕节地区毕节市', 'BJW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522422', '大方县', '贵州省毕节地区大方县', 'DFB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522423', '黔西县', '贵州省毕节地区黔西县', 'QXI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522424', '金沙县', '贵州省毕节地区金沙县', 'JSK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522426', '纳雍县', '贵州省毕节地区纳雍县', 'NYW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522428', '赫章县', '贵州省毕节地区赫章县', 'HZJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522600', '黔东南苗族侗族自治州', '贵州省黔东南苗族侗族自治州', 'QDW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522601', '凯里市', '贵州省黔东南苗族侗族自治州凯里市', 'KLT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522622', '黄平县', '贵州省黔东南苗族侗族自治州黄平县', 'HPB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522624', '三穗县', '贵州省黔东南苗族侗族自治州三穗县', 'SHA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522626', '岑巩县', '贵州省黔东南苗族侗族自治州岑巩县', 'CGS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522628', '锦屏县', '贵州省黔东南苗族侗族自治州锦屏县', 'JPR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522629', '剑河县', '贵州省黔东南苗族侗族自治州剑河县', 'JHE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522631', '黎平县', '贵州省黔东南苗族侗族自治州黎平县', 'LPC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522632', '榕江县', '贵州省黔东南苗族侗族自治州榕江县', 'RJR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522633', '从江县', '贵州省黔东南苗族侗族自治州从江县', 'CJR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522634', '雷山县', '贵州省黔东南苗族侗族自治州雷山县', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522635', '麻江县', '贵州省黔东南苗族侗族自治州麻江县', 'MJR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522636', '丹寨县', '贵州省黔东南苗族侗族自治州丹寨县', 'DZE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522700', '黔南布依族苗族自治州', '贵州省黔南布依族苗族自治州', 'QNS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522701', '都匀市', '贵州省黔南布依族苗族自治州都匀市', 'DYJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522702', '福泉市', '贵州省黔南布依族苗族自治州福泉市', 'FQS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522722', '荔波县', '贵州省黔南布依族苗族自治州荔波县', 'LBC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522723', '贵定县', '贵州省黔南布依族苗族自治州贵定县', 'GDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522726', '独山县', '贵州省黔南布依族苗族自治州独山县', 'DSC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522727', '平塘县', '贵州省黔南布依族苗族自治州平塘县', 'PTW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522728', '罗甸县', '贵州省黔南布依族苗族自治州罗甸县', 'LDY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522729', '长顺县', '贵州省黔南布依族苗族自治州长顺县', 'CSC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522730', '龙里县', '贵州省黔南布依族苗族自治州龙里县', 'LLB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522731', '惠水县', '贵州省黔南布依族苗族自治州惠水县', 'HSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('522732', '三都水族自治县', '贵州省黔南布依族苗族自治州三都水族自治县', 'SDU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530100', '昆明市', '云南省昆明市', 'KMP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530103', '盘龙区', '云南省昆明市盘龙区', 'PLX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530111', '官渡区', '云南省昆明市官渡区', 'GDU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530113', '东川区', '云南省昆明市东川区', 'DCP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('530121', '呈贡县', '云南省昆明市呈贡县', 'CGT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530122', '晋宁县', '云南省昆明市晋宁县', 'JNB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530124', '富民县', '云南省昆明市富民县', 'FMP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530128', '禄劝彝族苗族自治县', '云南省昆明市禄劝彝族苗族自治县', 'LQE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530181', '安宁市', '云南省昆明市安宁市', 'ANQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530200', '东川市', '云南省东川市', 'DCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530300', '曲靖市', '云南省曲靖市', 'QJB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530302', '麒麟区', '云南省曲靖市麒麟区', 'JLK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530321', '马龙县', '云南省曲靖市马龙县', 'MLX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530322', '陆良县', '云南省曲靖市陆良县', 'LLC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530324', '罗平县', '云南省曲靖市罗平县', 'LPD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530325', '富源县', '云南省曲靖市富源县', 'FYH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530326', '会泽县', '云南省曲靖市会泽县', 'HZK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530402', '红塔区', '云南省玉溪市红塔区', 'HTU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530421', '江川县', '云南省玉溪市江川县', 'JCY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530422', '澄江县', '云南省玉溪市澄江县', 'CJS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530424', '华宁县', '云南省玉溪市华宁县', 'HND', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530426', '峨山彝族自治县', '云南省玉溪市峨山彝族自治县', 'ESQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530502', '隆阳区', '云南省保山市隆阳区', 'LYP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530523', '龙陵县', '云南省保山地区龙陵县', 'LLE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530524', '昌宁县', '云南省保山地区昌宁县', 'CLD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530621', '鲁甸县', '云南省昭通地区鲁甸县', 'LDZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530622', '巧家县', '云南省昭通地区巧家县', 'QJC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530624', '大关县', '云南省昭通地区大关县', 'DGX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530701', '丽江市', '云南省丽江市', 'LJE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530702', '古城区', '云南省丽江市古城区', 'GCE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530723', '华坪县', '云南省丽江市华坪县', 'HPC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('530724', '宁蒗彝族自治县', '云南省丽江市宁蒗彝族自治县', 'NLU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532200', '曲靖地区', '云南省曲靖地区', 'QJD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532300', '楚雄彝族自治州', '云南省楚雄彝族自治州', 'CXG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532301', '楚雄市', '云南省楚雄彝族自治州楚雄市', 'CXH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532323', '牟定县', '云南省楚雄彝族自治州牟定县', 'MDQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532324', '南华县', '云南省楚雄彝族自治州南华县', 'NHB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532326', '大姚县', '云南省楚雄彝族自治州大姚县', 'DYK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532331', '禄丰县', '云南省楚雄彝族自治州禄丰县', 'LFY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532500', '红河哈尼族彝族自治州', '云南省红河哈尼族彝族自治州', 'HHC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532501', '个旧市', '云南省红河哈尼族彝族自治州个旧市', 'GJU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532502', '开远市', '云南省红河哈尼族彝族自治州开远市', 'KYV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532522', '蒙自县', '云南省红河哈尼族彝族自治州蒙自县', 'MZV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532523', '屏边苗族自治县', '云南省红河哈尼族彝族自治州屏边苗族自治县', 'PBS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532524', '建水县', '云南省红河哈尼族彝族自治州建水县', 'JSL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532526', '弥勒县', '云南省红河哈尼族彝族自治州弥勒县', 'MLZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532527', '泸西县', '云南省红河哈尼族彝族自治州泸西县', 'LXA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532529', '红河县', '云南省红河哈尼族彝族自治州红河县', 'HHD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532530', '金平苗族瑶族傣族自治', '云南省红河哈尼族彝族自治州金平苗族瑶族傣族自治', 'JPS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532531', '绿春县', '云南省红河哈尼族彝族自治州绿春县', 'LCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532532', '河口瑶族自治县', '云南省红河哈尼族彝族自治州河口瑶族自治县', 'HKY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532624', '麻栗坡县', '云南省文山壮族苗族自治州麻栗坡县', 'MLB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532625', '马关县', '云南省文山壮族苗族自治州马关县', 'MGS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532626', '丘北县', '云南省文山壮族苗族自治州丘北县', 'QBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532627', '广南县', '云南省文山壮族苗族自治州广南县', 'GNW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532628', '富宁县', '云南省文山壮族苗族自治州富宁县', 'FNX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532722', '普洱哈尼族彝族自治县', '云南省思茅地区普洱哈尼族彝族自治县', 'PEP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532723', '墨江哈尼族自治县', '云南省思茅地区墨江哈尼族自治县', 'MJS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532724', '景东彝族自治县', '云南省思茅地区景东彝族自治县', 'JDE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532725', '景谷傣族彝族自治县', '云南省思茅地区景谷傣族彝族自治县', 'JGT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532727', '江城哈尼族彝族自治县', '云南省思茅地区江城哈尼族彝族自治县', 'JCB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532728', '孟连傣族拉祜族佤族自', '云南省思茅地区孟连傣族拉祜族佤族自', 'MLC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532729', '澜沧拉祜族自治县', '云南省思茅地区澜沧拉祜族自治县', 'LCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532801', '景洪市', '云南省西双版纳傣族自治州景洪市', 'JHF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532822', '勐海县', '云南省西双版纳傣族自治州勐海县', 'MHV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532823', '勐腊县', '云南省西双版纳傣族自治州勐腊县', 'MLD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532900', '大理白族自治州', '云南省大理白族自治州', 'DLC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532901', '大理市', '云南省大理白族自治州大理市', 'DLD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532925', '弥渡县', '云南省大理白族自治州弥渡县', 'MDR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532926', '南涧彝族自治县', '云南省大理白族自治州南涧彝族自治县', 'NJG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532930', '洱源县', '云南省大理白族自治州洱源县', 'EYP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532931', '剑川县', '云南省大理白族自治州剑川县', 'JCC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('532932', '鹤庆县', '云南省大理白族自治州鹤庆县', 'HQU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533100', '德宏傣族景颇族自治州', '云南省德宏傣族景颇族自治州', 'DHC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533102', '瑞丽市', '云南省德宏傣族景颇族自治州瑞丽市', 'RLP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533103', '潞西市', '云南省德宏傣族景颇族自治州潞西市', 'LXA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533122', '梁河县', '云南省德宏傣族景颇族自治州梁河县', 'LHM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533124', '陇川县', '云南省德宏傣族景颇族自治州陇川县', 'LCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533300', '怒江傈僳族自治州', '云南省怒江傈僳族自治州', 'NJH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533321', '泸水县', '云南省怒江傈僳族自治州泸水县', 'LSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533323', '福贡县', '云南省怒江傈僳族自治州福贡县', 'FGU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533324', '贡山独龙族怒族自治县', '云南省怒江傈僳族自治州贡山独龙族怒族自治县', 'GSV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533325', '兰坪白族普米族自治县', '云南省怒江傈僳族自治州兰坪白族普米族自治县', 'LPF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533400', '迪庆藏族自治州', '云南省迪庆藏族自治州', 'DQX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533422', '德钦县', '云南省迪庆藏族自治州德钦县', 'DQY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533500', '临沧地区', '云南省临沧地区', 'LCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533521', '临沧县', '云南省临沧地区临沧县', 'LCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533522', '凤庆县', '云南省临沧地区凤庆县', 'FQU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533527', '耿马傣族佤族自治县', '云南省临沧地区耿马傣族佤族自治县', 'GMT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('533528', '沧源佤族自治县', '云南省临沧地区沧源佤族自治县', 'CYJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('710000', '西安市', '陕西省西安市', 'XAS', NULL, 'admin', '超级管理员', '2014-12-09 10:00:52', NULL, NULL, NULL, ''),
('710100', '长安区', '陕西省西安市长安区', 'CAQ', NULL, 'admin', '超级管理员', '2014-12-09 10:01:50', NULL, NULL, NULL, ''),
('710200', '高陵县', '陕西省西安市高陵县', 'GLX', NULL, 'admin', '超级管理员', '2014-12-09 10:03:18', NULL, NULL, NULL, ''),
('710300', '户县', '陕西省西安市户县', 'HXX', NULL, 'admin', '超级管理员', '2014-12-09 10:03:01', NULL, NULL, NULL, ''),
('710400', '周至县', '陕西省西安市周至县', 'ZZX', NULL, 'admin', '超级管理员', '2014-12-09 10:02:40', NULL, NULL, NULL, ''),
('710500', '蓝田县', '陕西省西安市蓝田县', 'LTX', NULL, 'admin', '超级管理员', '2014-12-09 10:02:18', NULL, NULL, NULL, ''),
('710600', '临潼区', '陕西省西安市临潼区', 'LTQ', NULL, 'admin', '超级管理员', '2014-12-09 10:01:17', NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_reserve`
--

CREATE TABLE IF NOT EXISTS `tms_bd_reserve` (
  `re_NoOfRunsID` varchar(20) NOT NULL,
  `re_LineID` varchar(30) DEFAULT NULL,
  `re_NoOfRunsdate` char(10) NOT NULL,
  `re_ReserveSeatNO` varchar(50) NOT NULL,
  `re_ReserveSeatS` tinyint(4) DEFAULT NULL,
  `re_OnStationID` varchar(20) NOT NULL DEFAULT '',
  `re_OnStation` varchar(50) DEFAULT NULL,
  `re_ReserveUserID` varchar(20) DEFAULT NULL,
  `re_ReserveUser` varchar(20) DEFAULT NULL,
  `re_DateTime` datetime DEFAULT NULL,
  `re_Remark` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`re_NoOfRunsID`,`re_OnStationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_schedulelong`
--

CREATE TABLE IF NOT EXISTS `tms_bd_schedulelong` (
  `sl_ID` int(11) NOT NULL AUTO_INCREMENT,
  `sl_NoOfRunsID` varchar(20) NOT NULL,
  `sl_BeginDate` char(10) NOT NULL,
  `sl_EndDate` char(10) NOT NULL,
  `sl_StopCause` varchar(30) DEFAULT NULL,
  `sl_Remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sl_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_schedulereserve`
--

CREATE TABLE IF NOT EXISTS `tms_bd_schedulereserve` (
  `sr_NoOfRunsID` varchar(10) NOT NULL,
  `sr_SellerID` varchar(10) DEFAULT NULL,
  `sr_Seller` varchar(30) DEFAULT NULL,
  `sr_ModelID` varchar(10) NOT NULL DEFAULT '',
  `sr_ModelName` varchar(30) DEFAULT NULL,
  `sr_ReserveSeatNO` varchar(255) DEFAULT NULL,
  `sr_ReserveSeatS` tinyint(4) DEFAULT NULL,
  `sr_Remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sr_NoOfRunsID`,`sr_ModelID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_sectioninfo`
--

CREATE TABLE IF NOT EXISTS `tms_bd_sectioninfo` (
  `si_LineID` varchar(30) NOT NULL,
  `si_LineName` varchar(50) DEFAULT NULL,
  `si_SectionID` tinyint(4) NOT NULL,
  `si_SiteNameID` varchar(20) NOT NULL,
  `si_SiteName` varchar(50) DEFAULT NULL,
  `si_Kilometer` decimal(12,2) DEFAULT NULL,
  `si_IsDock` tinyint(4) DEFAULT NULL,
  `si_IsGetOnSite` tinyint(4) DEFAULT NULL,
  `si_IsCheckInSite` tinyint(4) DEFAULT NULL,
  `si_IsTollInSite` tinyint(4) DEFAULT NULL,
  `si_IsServiceFee` tinyint(4) DEFAULT NULL,
  `si_ServiceFee` decimal(12,2) DEFAULT NULL,
  `si_otherFee1` decimal(12,2) DEFAULT NULL,
  `si_otherFee2` decimal(12,2) DEFAULT NULL,
  `si_otherFee3` decimal(12,2) DEFAULT NULL,
  `si_otherFee4` decimal(12,2) DEFAULT NULL,
  `si_otherFee5` decimal(12,2) DEFAULT NULL,
  `si_otherFee6` decimal(12,2) DEFAULT NULL,
  `si_Remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`si_LineID`,`si_SectionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_sectioninfo`
--

INSERT INTO `tms_bd_sectioninfo` (`si_LineID`, `si_LineName`, `si_SectionID`, `si_SiteNameID`, `si_SiteName`, `si_Kilometer`, `si_IsDock`, `si_IsGetOnSite`, `si_IsCheckInSite`, `si_IsTollInSite`, `si_IsServiceFee`, `si_ServiceFee`, `si_otherFee1`, `si_otherFee2`, `si_otherFee3`, `si_otherFee4`, `si_otherFee5`, `si_otherFee6`, `si_Remark`) VALUES
('CDPCSP510100000043010000000000', '成都--长沙', 1, '5101000000', '成都', '0.00', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站'),
('CDPCSP510100000043010000000000', '成都--长沙', 2, '4301000000', '长沙', '500.00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站'),
('CDPSHP510100000031000000000000', '成都--上海', 1, '5101000000', '成都', '0.00', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站'),
('CDPSHP510100000031000000000000', '成都--上海', 2, '3100000000', '上海', '800.00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站'),
('CDPXAP510100000071000000000000', '成都--西安', 1, '5101000000', '成都', '0.00', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站'),
('CDPXAP510100000071000000000000', '成都--西安', 2, '7105000000', '蓝田', '500.00', 1, 0, 0, 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', ''),
('CDPXAP510100000071000000000000', '成都--西安', 3, '7100000000', '西安', '600.00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站'),
('CSPJHU430100000033070000000000', '长沙--金华', 1, '4301000000', '长沙', '0.00', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站'),
('CSPJHU430100000033070000000000', '长沙--金华', 2, '3100000000', '上海', '400.00', 1, 0, 0, 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', ''),
('CSPJHU430100000033070000000000', '长沙--金华', 3, '3307000000', '金华', '500.00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站'),
('CSPSHP430100000031000000000000', '长沙--上海', 1, '4301000000', '长沙', '0.00', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站'),
('CSPSHP430100000031000000000000', '长沙--上海', 2, '3100000000', '上海', '500.00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站'),
('CSPXAP430100000071000000000000', '长沙--西安', 1, '4301000000', '长沙', '0.00', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站'),
('CSPXAP430100000071000000000000', '长沙--西安', 2, '5101000000', '成都', '400.00', 1, 1, 1, 0, 1, '10.00', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', ''),
('CSPXAP430100000071000000000000', '长沙--西安', 3, '7100000000', '西安', '500.00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站'),
('XAPCAS710000000071010000000000', '西安--长安', 1, '7100000000', '西安', '0.00', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站'),
('XAPCAS710000000071010000000000', '西安--长安', 2, '7101000000', '长安', '60.00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站'),
('XAPCDP710000000051010000000000', '西安--成都', 1, '7100000000', '西安', '0.00', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站'),
('XAPCDP710000000051010000000000', '西安--成都', 2, '5108000000', '广元', '400.00', 1, 0, 0, 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', ''),
('XAPCDP710000000051010000000000', '西安--成都', 3, '5101820000', '彭州', '450.00', 1, 0, 0, 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', ''),
('XAPCDP710000000051010000000000', '西安--成都', 4, '5101000000', '成都', '700.00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站'),
('XAPCSP710000000043010000000000', '西安--长沙', 1, '7100000000', '西安', '0.00', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站'),
('XAPCSP710000000043010000000000', '西安--长沙', 2, '7103000000', '户县', '50.00', 1, 0, 0, 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', ''),
('XAPCSP710000000043010000000000', '西安--长沙', 3, '4310230000', '永兴', '350.00', 1, 0, 0, 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', ''),
('XAPCSP710000000043010000000000', '西安--长沙', 4, '4304000000', '衡阳', '400.00', 1, 0, 0, 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', ''),
('XAPCSP710000000043010000000000', '西安--长沙', 5, '4301000000', '长沙', '700.00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站'),
('XAPHXX710000000071030000000000', '西安--户县', 1, '7100000000', '西安', '0.00', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站'),
('XAPHXX710000000071030000000000', '西安--户县', 2, '7103000000', '户县', '40.00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站'),
('XAPHYP710000000043040000000000', '西安--衡阳', 1, '7100000000', '西安', '0.00', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站'),
('XAPHYP710000000043040000000000', '西安--衡阳', 2, '4301000000', '长沙', '200.00', 1, 1, 1, 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', ''),
('XAPHYP710000000043040000000000', '西安--衡阳', 3, '4304000000', '衡阳', '500.00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站'),
('XAPLTX710000000071050000000000', '西安--蓝田', 1, '7100000000', '西安', '0.00', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站'),
('XAPLTX710000000071050000000000', '西安--蓝田', 2, '7105000000', '蓝田', '50.00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站'),
('XAPLTX710000000071060000000000', '西安--临潼', 1, '7100000000', '西安', '0.00', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站'),
('XAPLTX710000000071060000000000', '西安--临潼', 2, '7106000000', '临潼', '60.00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站'),
('XAPSHP710000000031000000000000', '西安--上海', 1, '7100000000', '西安', '0.00', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '起点站'),
('XAPSHP710000000031000000000000', '西安--上海', 2, '4201030000', '江汉', '250.00', 1, 1, 1, 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', ''),
('XAPSHP710000000031000000000000', '西安--上海', 3, '3100000000', '上海', '500.00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '终点站');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_servicefeeadjust`
--

CREATE TABLE IF NOT EXISTS `tms_bd_servicefeeadjust` (
  `sfa_ID` int(11) NOT NULL AUTO_INCREMENT,
  `sfa_ISLineAdjust` tinyint(4) DEFAULT NULL,
  `sfa_LineAdjust` varchar(50) DEFAULT NULL,
  `sfa_ISNoRunsAdjust` tinyint(4) DEFAULT NULL,
  `sfa_NoRunsAdjust` varchar(20) DEFAULT NULL,
  `sfa_ISUnitAdjust` tinyint(4) DEFAULT NULL,
  `sfa_Unit` varchar(50) DEFAULT NULL,
  `sfa_DepartureSiteID` varchar(20) DEFAULT NULL,
  `sfa_DepartureSite` varchar(20) DEFAULT NULL,
  `sfa_GetToSiteID` varchar(20) DEFAULT NULL,
  `sfa_GetToSite` varchar(20) DEFAULT NULL,
  `sfa_ModelID` varchar(20) DEFAULT NULL,
  `sfa_ModelName` varchar(20) DEFAULT NULL,
  `sfa_BeginDate` char(10) DEFAULT NULL,
  `sfa_EndDate` char(10) DEFAULT NULL,
  `sfa_BeginTime` char(5) DEFAULT NULL,
  `sfa_EndTime` char(5) DEFAULT NULL,
  `sfa_RunPrice` decimal(12,1) DEFAULT NULL,
  `sfa_LinkAdjustPrice` tinyint(4) DEFAULT NULL,
  `sfa_Remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`sfa_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `tms_bd_servicefeeadjust`
--

INSERT INTO `tms_bd_servicefeeadjust` (`sfa_ID`, `sfa_ISLineAdjust`, `sfa_LineAdjust`, `sfa_ISNoRunsAdjust`, `sfa_NoRunsAdjust`, `sfa_ISUnitAdjust`, `sfa_Unit`, `sfa_DepartureSiteID`, `sfa_DepartureSite`, `sfa_GetToSiteID`, `sfa_GetToSite`, `sfa_ModelID`, `sfa_ModelName`, `sfa_BeginDate`, `sfa_EndDate`, `sfa_BeginTime`, `sfa_EndTime`, `sfa_RunPrice`, `sfa_LinkAdjustPrice`, `sfa_Remark`) VALUES
(1, 0, 'XAPHYP710000000043040000000000', 0, NULL, 1, '西安001车队', '7100000000', '西安', '4304000000', '衡阳', '05', '中型中级', '2014-01-01', '2016-01-01', NULL, NULL, '10.0', NULL, ''),
(2, 0, 'XAPCSP710000000043010000000000', 0, NULL, 1, '西安001车队', '7100000000', '西安', '4301000000', '长沙', '05', '中型中级', '2014-11-30', '2016-01-09', NULL, NULL, '5.0', NULL, ''),
(3, 0, 'XAPCSP710000000043010000000000', 0, 'XAPCSP0000', 1, '西安001车队', '7100000000', '西安', '4301000000', '长沙', '05', '中型中级', '2014-11-30', '2016-01-09', NULL, NULL, '5.0', NULL, ''),
(4, 0, 'XAPHYP710000000043040000000000', 0, 'XAPHYP0000', 1, '西安001车队', '7100000000', '西安', '4304000000', '衡阳', '05', '中型中级', '2014-01-01', '2016-01-01', NULL, NULL, '10.0', NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_servicefeeset`
--

CREATE TABLE IF NOT EXISTS `tms_bd_servicefeeset` (
  `sf_ID` int(11) NOT NULL AUTO_INCREMENT,
  `sf_StationID` varchar(20) DEFAULT NULL,
  `sf_Station` varchar(50) DEFAULT NULL,
  `sf_BeginKilometer` decimal(12,2) DEFAULT NULL,
  `sf_EndKilometer` decimal(12,2) DEFAULT NULL,
  `sf_ServiceFee` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`sf_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_siteset`
--

CREATE TABLE IF NOT EXISTS `tms_bd_siteset` (
  `sset_SiteID` varchar(20) NOT NULL,
  `sset_SiteName` varchar(50) NOT NULL,
  `sset_SiteType` varchar(10) NOT NULL,
  `sset_SiteRank` varchar(10) DEFAULT NULL,
  `sset_OperateCode` varchar(20) NOT NULL,
  `sset_HelpCode` varchar(10) DEFAULT NULL,
  `sset_IdCode` varchar(10) DEFAULT NULL,
  `sset_Region` varchar(50) DEFAULT NULL,
  `sset_IsStation` tinyint(4) DEFAULT NULL,
  `sset_IsTollSite` tinyint(4) DEFAULT NULL,
  `sset_StationAdOrg` varchar(50) DEFAULT NULL,
  `sset_AdderID` varchar(20) DEFAULT NULL,
  `sset_Adder` varchar(30) DEFAULT NULL,
  `sset_AddTime` datetime DEFAULT NULL,
  `sset_ModerID` varchar(20) DEFAULT NULL,
  `sset_Moder` varchar(30) DEFAULT NULL,
  `sset_ModTime` datetime DEFAULT NULL,
  `sset_Remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sset_SiteID`),
  UNIQUE KEY `sset_SiteName` (`sset_SiteName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_siteset`
--

INSERT INTO `tms_bd_siteset` (`sset_SiteID`, `sset_SiteName`, `sset_SiteType`, `sset_SiteRank`, `sset_OperateCode`, `sset_HelpCode`, `sset_IdCode`, `sset_Region`, `sset_IsStation`, `sset_IsTollSite`, `sset_StationAdOrg`, `sset_AdderID`, `sset_Adder`, `sset_AddTime`, `sset_ModerID`, `sset_Moder`, `sset_ModTime`, `sset_Remark`) VALUES
('3100000000', '上海', '普通站点', '', '', 'SHP', NULL, '上海市', 0, 0, '', 'admin', '超级管理员', '2014-12-09 10:21:28', NULL, NULL, NULL, ''),
('3307000000', '金华', '车站', '1', '', 'JHU', NULL, '金华市', 1, 0, '浙江汽车集团', 'admin', '超级管理员', '2014-12-09 10:19:21', NULL, NULL, NULL, ''),
('4201030000', '江汉', '车站', '', '', 'JHS', NULL, '江汉区', 1, 0, '', 'admin', '超级管理员', '2014-12-09 10:29:04', 'xaadmin', 'xaadmin', '2014-12-13 16:08:51', ''),
('4301000000', '长沙', '车站', '1', '', 'CSP', NULL, '长沙市', 1, 0, '湖南汽车集团', 'admin', '超级管理员', '2014-12-09 10:20:29', NULL, NULL, NULL, ''),
('4304000000', '衡阳', '普通站点', '', '', 'HYP', NULL, '衡阳市', 0, 0, '', 'admin', '超级管理员', '2014-12-09 10:21:52', NULL, NULL, NULL, ''),
('4310230000', '永兴', '普通站点', '', '', 'YXX', NULL, '永兴县', 0, 0, '湖南汽车集团', 'admin', '超级管理员', '2014-12-09 10:27:59', NULL, NULL, NULL, ''),
('5001020000', '广汉', '普通站点', '', '', 'GHS', NULL, '涪陵区', 0, 0, '', 'admin', '超级管理员', '2014-12-09 10:23:33', NULL, NULL, NULL, ''),
('5101000000', '成都', '车站', '1', '', 'CDP', NULL, '成都市', 1, 0, '四川汽车集团', 'admin', '超级管理员', '2014-12-09 10:16:47', NULL, NULL, NULL, ''),
('5101820000', '彭州', '普通站点', '', '', 'PZS', NULL, '彭州市', 0, 0, '四川汽车集团', 'admin', '超级管理员', '2014-12-09 10:25:55', NULL, NULL, NULL, ''),
('5108000000', '广元', '普通站点', '', '', 'GYS', NULL, '广元市', 0, 0, '四川汽车集团', 'admin', '超级管理员', '2014-12-09 10:26:27', NULL, NULL, NULL, ''),
('5114000000', '眉山', '普通站点', '', '', 'MSS', NULL, '眉山市', 0, 0, '四川汽车集团', 'admin', '超级管理员', '2014-12-09 10:27:05', NULL, NULL, NULL, ''),
('5301000000', '大理', '普通站点', '', '', 'DLP', NULL, '昆明市', 0, 0, '', 'admin', '超级管理员', '2014-12-09 10:24:52', NULL, NULL, NULL, ''),
('7100000000', '西安', '车站', '1', '', 'XAP', NULL, '西安市', 1, 0, '陕西汽车集团', 'admin', '超级管理员', '2014-12-09 10:15:00', NULL, NULL, NULL, ''),
('7101000000', '长安', '普通站点', '', '', 'CAS', NULL, '长安区', 0, 0, '陕西汽车集团', 'admin', '超级管理员', '2014-12-09 10:30:57', NULL, NULL, NULL, ''),
('7102000000', '高陵', '普通站点', '', '', 'GLX', NULL, '高陵县', 0, 0, '', 'admin', '超级管理员', '2014-12-09 10:32:08', NULL, NULL, NULL, ''),
('7103000000', '户县', '普通站点', '', '', 'HXX', NULL, '户县', 0, 0, '', 'admin', '超级管理员', '2014-12-09 10:31:44', NULL, NULL, NULL, ''),
('7105000000', '蓝田', '普通站点', '', '', 'LTX', NULL, '蓝田县', 0, 0, '', 'admin', '超级管理员', '2014-12-09 10:31:21', NULL, NULL, NULL, ''),
('7106000000', '临潼', '普通站点', '', '', 'LTX', NULL, '临潼区', 0, 0, '陕西汽车集团', 'admin', '超级管理员', '2014-12-09 10:30:29', NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_ticketadd`
--

CREATE TABLE IF NOT EXISTS `tms_bd_ticketadd` (
  `ta_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ta_Data` char(10) DEFAULT NULL,
  `ta_Time` char(5) DEFAULT NULL,
  `ta_BeginTicket` varchar(20) DEFAULT NULL,
  `ta_EndTicket` varchar(20) DEFAULT NULL,
  `ta_CurrentTicket` varchar(20) DEFAULT NULL,
  `ta_AddNum` int(11) DEFAULT NULL,
  `ta_LostNum` int(11) DEFAULT NULL,
  `ta_Type` varchar(50) DEFAULT NULL,
  `ta_UserID` varchar(20) DEFAULT NULL,
  `ta_User` varchar(30) DEFAULT NULL,
  `ta_UserSation` varchar(50) DEFAULT NULL,
  `ta_Remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ta_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `tms_bd_ticketadd`
--

INSERT INTO `tms_bd_ticketadd` (`ta_ID`, `ta_Data`, `ta_Time`, `ta_BeginTicket`, `ta_EndTicket`, `ta_CurrentTicket`, `ta_AddNum`, `ta_LostNum`, `ta_Type`, `ta_UserID`, `ta_User`, `ta_UserSation`, `ta_Remark`) VALUES
(1, '2014-12-09', '13:34', '8000600001', '8000800000', '8000600001', 200000, 200000, '客票', 'admin', '超级管理员', '全部车站', ''),
(2, '2014-12-09', '13:37', '5235780001', '5235800000', '5235782001', 20000, 18000, '客票', 'xaadmin', 'xaadmin', '西安', ''),
(3, '2014-12-09', '13:38', '10000', '20000', '12000', 10001, 8001, '保险票', 'xaadmin', 'xaadmin', '西安', ''),
(4, '2014-12-09', '13:38', '10000', '20000', '11000', 10001, 9001, '结算单', 'xaadmin', 'xaadmin', '西安', ''),
(5, '2014-12-09', '13:38', '10000', '20000', '11000', 10001, 9001, '包车单', 'xaadmin', 'xaadmin', '西安', ''),
(6, '2014-12-09', '13:39', '10000', '20000', '12000', 10001, 8001, '托运单', 'xaadmin', 'xaadmin', '西安', ''),
(7, '2014-12-09', '13:39', '10000', '20000', '11000', 10001, 9001, '安检单', 'xaadmin', 'xaadmin', '西安', '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_ticketmode`
--

CREATE TABLE IF NOT EXISTS `tms_bd_ticketmode` (
  `tml_NoOfRunsID` varchar(50) NOT NULL,
  `tml_LineID` varchar(50) DEFAULT NULL,
  `tml_NoOfRunsdate` char(10) NOT NULL,
  `tml_NoOfRunstime` char(5) DEFAULT NULL,
  `tml_BeginstationID` varchar(50) DEFAULT NULL,
  `tml_Beginstation` varchar(50) DEFAULT NULL,
  `tml_EndstationID` varchar(50) DEFAULT NULL,
  `tml_Endstation` varchar(50) DEFAULT NULL,
  `tml_CheckTicketWindow` int(11) DEFAULT NULL,
  `tml_SellWindow` int(11) DEFAULT NULL,
  `tml_Loads` int(11) DEFAULT NULL,
  `tml_SeatStatus` varchar(8000) DEFAULT NULL,
  `tml_TotalSeats` int(11) DEFAULT NULL,
  `tml_LeaveSeats` int(11) DEFAULT NULL,
  `tml_HalfSeats` int(11) DEFAULT NULL,
  `tml_LeaveHalfSeats` int(11) DEFAULT NULL,
  `tml_ReserveSeats` int(11) DEFAULT NULL,
  `tml_StopRun` tinyint(4) DEFAULT NULL,
  `tml_Allticket` tinyint(4) DEFAULT NULL,
  `tml_AllowSell` tinyint(4) DEFAULT NULL,
  `tml_Orderno` int(11) DEFAULT NULL,
  `tml_StationID` varchar(50) DEFAULT NULL,
  `tml_Station` varchar(50) DEFAULT NULL,
  `tml_Created` datetime DEFAULT NULL,
  `tml_Createdby` varchar(50) DEFAULT NULL,
  `tml_Updated` datetime DEFAULT NULL,
  `tml_Updatedby` varchar(50) DEFAULT NULL,
  `tml_BusModelID` varchar(20) DEFAULT NULL,
  `tml_BusModel` varchar(50) DEFAULT NULL,
  `tml_BusID` varchar(20) NOT NULL,
  `tml_BusCard` varchar(20) DEFAULT NULL,
  `tml_FreeSeats` int(11) DEFAULT NULL,
  `tml_LeaveFreeSeats` int(11) DEFAULT NULL,
  `tml_StationDeal` tinyint(4) DEFAULT NULL,
  `tml_RunRegion` varchar(50) DEFAULT NULL,
  `tml_DealCategory` varchar(20) DEFAULT NULL,
  `tml_DealStyle` varchar(20) DEFAULT NULL,
  `tml_BusUnit` varchar(100) DEFAULT NULL,
  `tml_RunHours` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`tml_NoOfRunsID`,`tml_NoOfRunsdate`,`tml_BusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_bd_ticketmode`
--

INSERT INTO `tms_bd_ticketmode` (`tml_NoOfRunsID`, `tml_LineID`, `tml_NoOfRunsdate`, `tml_NoOfRunstime`, `tml_BeginstationID`, `tml_Beginstation`, `tml_EndstationID`, `tml_Endstation`, `tml_CheckTicketWindow`, `tml_SellWindow`, `tml_Loads`, `tml_SeatStatus`, `tml_TotalSeats`, `tml_LeaveSeats`, `tml_HalfSeats`, `tml_LeaveHalfSeats`, `tml_ReserveSeats`, `tml_StopRun`, `tml_Allticket`, `tml_AllowSell`, `tml_Orderno`, `tml_StationID`, `tml_Station`, `tml_Created`, `tml_Createdby`, `tml_Updated`, `tml_Updatedby`, `tml_BusModelID`, `tml_BusModel`, `tml_BusID`, `tml_BusCard`, `tml_FreeSeats`, `tml_LeaveFreeSeats`, `tml_StationDeal`, `tml_RunRegion`, `tml_DealCategory`, `tml_DealStyle`, `tml_BusUnit`, `tml_RunHours`) VALUES
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-11-30', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-01', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-02', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-03', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-04', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-05', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-06', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-07', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-08', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-09', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-10', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-11', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-12', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-13', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-14', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-15', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-16', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-17', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-18', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-19', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-20', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-21', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-22', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-23', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-24', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-25', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-26', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-27', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-28', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-29', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-30', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2014-12-31', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-01', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-02', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-03', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-04', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-05', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-06', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-07', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-08', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-09', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CDPXAP0000', 'CDPXAP510100000071000000000000', '2015-01-10', '09:00', '5101000000', '成都', '7100000000', '西安', 2, NULL, 10, '00000000000000000000000000000000000', 35, 35, 0, 0, 0, 0, 0, 1, 1, '5101000000', '成都', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '06', '中型高级', '######', '######', NULL, NULL, 0, '跨省', '', '', '成都001车队', '20:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-11-30', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-01', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-02', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-03', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-04', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-05', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-06', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-07', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-08', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-09', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-10', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-11', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-12', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-13', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-14', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-15', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-16', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-17', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-18', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-19', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-20', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-21', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-22', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-23', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-24', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-25', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-26', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-27', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-28', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-29', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-30', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2014-12-31', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-01', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-02', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-03', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-04', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-05', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-06', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-07', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-08', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-09', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('CSPXAP0000', 'CSPXAP430100000071000000000000', '2015-01-10', '06:00', '4301000000', '长沙', '7100000000', '西安', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '4301000000', '长沙', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '长沙001车队', '23:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-11-30', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-01', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-02', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-03', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-04', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-05', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-06', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-07', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-08', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-09', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 14:41:12', 'xaadmin', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-10', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-11', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-12 16:35:12', 'xaadmin', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '444444000000000', 15, 9, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-12 16:36:12', 'xaadmin', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-13', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '333300000000000', 15, 11, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-13 16:32:12', 'xaadmin', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-14', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-15', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-16', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-17', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-18', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-19', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-20', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-21', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-22', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-23', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-24', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-25', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-26', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-27', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-28', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-29', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-30', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-31', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-01', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-02', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-03', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-04', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-05', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-06', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-07', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-08', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-09', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0');
INSERT INTO `tms_bd_ticketmode` (`tml_NoOfRunsID`, `tml_LineID`, `tml_NoOfRunsdate`, `tml_NoOfRunstime`, `tml_BeginstationID`, `tml_Beginstation`, `tml_EndstationID`, `tml_Endstation`, `tml_CheckTicketWindow`, `tml_SellWindow`, `tml_Loads`, `tml_SeatStatus`, `tml_TotalSeats`, `tml_LeaveSeats`, `tml_HalfSeats`, `tml_LeaveHalfSeats`, `tml_ReserveSeats`, `tml_StopRun`, `tml_Allticket`, `tml_AllowSell`, `tml_Orderno`, `tml_StationID`, `tml_Station`, `tml_Created`, `tml_Createdby`, `tml_Updated`, `tml_Updatedby`, `tml_BusModelID`, `tml_BusModel`, `tml_BusID`, `tml_BusCard`, `tml_FreeSeats`, `tml_LeaveFreeSeats`, `tml_StationDeal`, `tml_RunRegion`, `tml_DealCategory`, `tml_DealStyle`, `tml_BusUnit`, `tml_RunHours`) VALUES
('XAPCAS0000', 'XAPCAS710000000071010000000000', '2015-01-10', '', '7100000000', '西安', '7101000000', '长安', 1, NULL, 5, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '03', '小型中级', '######', '######', NULL, NULL, 0, '市内', '', '', '西安001车队', '2:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-11-30', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-01', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-02', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-03', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-04', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-05', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-06', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-07', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-08', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-09', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-10', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-11', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '300000000000000', 15, 14, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-12', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-13', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '300000000000000', 15, 14, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-14', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-15', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-16', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-17', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-18', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-19', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-20', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-21', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-22', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-23', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-24', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-25', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-26', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-27', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-28', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-29', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-30', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-31', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-01', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-02', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-03', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-04', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-05', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-06', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-07', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-08', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-09', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCDP0000', 'XAPCDP710000000051010000000000', '2015-01-10', '10:00', '7100000000', '西安', '5101000000', '成都', 6, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '20:0'),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-11-30', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-01', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-02', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-03', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-04', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-05', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-06', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-07', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-08', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-09', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-10', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-11', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-12', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-13', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-14', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-15', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-16', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-17', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-18', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-19', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-20', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-21', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-22', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-23', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-24', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-25', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-26', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-27', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-28', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-29', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-30', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2014-12-31', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-01', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-02', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-03', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-04', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-05', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-06', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-07', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-08', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-09', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 2, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '07', '大型普通', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPCSP0000', 'XAPCSP710000000043010000000000', '2015-01-10', '', '7100000000', '西安', '4301000000', '长沙', 8, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-11-30', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-01', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-02', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-03', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-04', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-05', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-06', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-07', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-08', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-09', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-10', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-11', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-12', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-12 16:37:12', 'xaadmin', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-13', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-13 16:33:12', 'xaadmin', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-14', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-15', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-16', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-17', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-18', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-19', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-20', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-21', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-22', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-23', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-24', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-25', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-26', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-27', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-28', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-29', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-30', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-31', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-01', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-02', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-03', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-04', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-05', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-06', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-07', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-08', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-09', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPHYP0000', 'XAPHYP710000000043040000000000', '2015-01-10', '11:00', '7100000000', '西安', '4304000000', '衡阳', 5, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 1, 0, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-11-30', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '');
INSERT INTO `tms_bd_ticketmode` (`tml_NoOfRunsID`, `tml_LineID`, `tml_NoOfRunsdate`, `tml_NoOfRunstime`, `tml_BeginstationID`, `tml_Beginstation`, `tml_EndstationID`, `tml_Endstation`, `tml_CheckTicketWindow`, `tml_SellWindow`, `tml_Loads`, `tml_SeatStatus`, `tml_TotalSeats`, `tml_LeaveSeats`, `tml_HalfSeats`, `tml_LeaveHalfSeats`, `tml_ReserveSeats`, `tml_StopRun`, `tml_Allticket`, `tml_AllowSell`, `tml_Orderno`, `tml_StationID`, `tml_Station`, `tml_Created`, `tml_Createdby`, `tml_Updated`, `tml_Updatedby`, `tml_BusModelID`, `tml_BusModel`, `tml_BusID`, `tml_BusCard`, `tml_FreeSeats`, `tml_LeaveFreeSeats`, `tml_StationDeal`, `tml_RunRegion`, `tml_DealCategory`, `tml_DealStyle`, `tml_BusUnit`, `tml_RunHours`) VALUES
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-01', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-02', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-03', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-04', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:28:59', '超级管理员', '2014-12-09 13:28:59', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-05', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-06', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-07', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-08', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-09', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-10', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-11', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '333000000000000', 15, 12, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-12', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '333000000000000', 15, 12, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-13', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 16, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-14', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-15', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:00', '超级管理员', '2014-12-09 13:29:00', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-16', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-17', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-18', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-19', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-20', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-21', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-22', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-23', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-24', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:01', '超级管理员', '2014-12-09 13:29:01', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-25', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-26', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-27', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-28', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-29', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-30', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-31', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-01', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-02', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-03', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:02', '超级管理员', '2014-12-09 13:29:02', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-04', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-05', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-06', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-07', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-08', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-09', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', ''),
('XAPSHP0000', 'XAPSHP710000000031000000000000', '2015-01-10', '08:00', '7100000000', '西安', '3100000000', '上海', 3, NULL, 0, '000000000000000', 15, 15, 0, 0, 0, 0, 0, 1, 1, '7100000000', '西安', '2014-12-09 13:29:03', '超级管理员', '2014-12-09 13:29:03', '超级管理员', '05', '中型中级', '######', '######', NULL, NULL, 0, '跨省', '', '', '西安001车队', '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_ticketpricefactor`
--

CREATE TABLE IF NOT EXISTS `tms_bd_ticketpricefactor` (
  `tpf_ModelID` varchar(20) NOT NULL,
  `tpf_ModelName` varchar(20) DEFAULT NULL,
  `tpf_PriceProject` varchar(20) NOT NULL,
  `tpf_BeginDate` char(10) DEFAULT NULL,
  `tpf_EndDate` char(10) DEFAULT NULL,
  `tpf_MoneyRenKil` decimal(12,1) DEFAULT NULL,
  `tpf_Remark` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_ticketprovide`
--

CREATE TABLE IF NOT EXISTS `tms_bd_ticketprovide` (
  `tp_ID` int(11) NOT NULL AUTO_INCREMENT,
  `tp_InceptUserID` varchar(20) DEFAULT NULL,
  `tp_InceptUser` varchar(30) DEFAULT NULL,
  `tp_UserSation` varchar(50) DEFAULT NULL,
  `tp_ProvideData` char(10) DEFAULT NULL,
  `tp_ProvideTime` char(5) DEFAULT NULL,
  `tp_BeginTicket` varchar(20) DEFAULT NULL,
  `tp_CurrentTicket` varchar(20) DEFAULT NULL,
  `tp_EndTicket` varchar(20) DEFAULT NULL,
  `tp_InceptTicketNum` int(11) DEFAULT NULL,
  `tp_UseState` varchar(20) DEFAULT NULL,
  `tp_Type` varchar(20) DEFAULT NULL,
  `tp_ProvideUserID` varchar(20) DEFAULT NULL,
  `tp_ProvideUser` varchar(30) DEFAULT NULL,
  `tp_Remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`tp_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `tms_bd_ticketprovide`
--

INSERT INTO `tms_bd_ticketprovide` (`tp_ID`, `tp_InceptUserID`, `tp_InceptUser`, `tp_UserSation`, `tp_ProvideData`, `tp_ProvideTime`, `tp_BeginTicket`, `tp_CurrentTicket`, `tp_EndTicket`, `tp_InceptTicketNum`, `tp_UseState`, `tp_Type`, `tp_ProvideUserID`, `tp_ProvideUser`, `tp_Remark`) VALUES
(1, 'xaadmin', 'xaadmin', '西安', '2014-12-09', '13:44', '5235780001', '5235780027', '5235781000', 974, '当前', '客票', 'xaadmin', 'xaadmin', ''),
(2, 'xaadmin', 'xaadmin', '西安', '2014-12-09', '13:45', '10000', '10005', '10999', 975, '当前', '保险票', 'xaadmin', 'xaadmin', ''),
(3, 'xaadmin', 'xaadmin', '西安', '2014-12-09', '14:02', '10000', '10003', '10999', 997, '当前', '结算单', 'xaadmin', 'xaadmin', ''),
(4, 'xaadmin', 'xaadmin', '西安', '2014-12-09', '14:02', '10000', '10001', '10999', 999, '当前', '包车单', 'xaadmin', 'xaadmin', ''),
(5, 'xaadmin', 'xaadmin', '西安', '2014-12-09', '14:02', '10000', '10012', '10999', 988, '当前', '托运单', 'xaadmin', 'xaadmin', ''),
(6, 'xaadmin', 'xaadmin', '西安', '2014-12-09', '14:02', '11000', '11000', '11999', 1000, '当前', '托运单', 'xaadmin', 'xaadmin', ''),
(7, 'xaadmin', 'xaadmin', '西安', '2014-12-09', '14:03', '10000', '10000', '10999', 1000, '当前', '安检单', 'xaadmin', 'xaadmin', ''),
(8, 'fzl', 'fzl', '西安', '2014-12-11', '11:43', '5235781001', '5235781001', '5235782000', 1000, '当前', '客票', 'xaadmin', 'xaadmin', '\r\n'),
(9, 'fzl', 'fzl', '西安', '2014-12-11', '11:43', '11000', '11000', '11999', 1000, '当前', '保险票', 'xaadmin', 'xaadmin', '\r\n');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_tickettype`
--

CREATE TABLE IF NOT EXISTS `tms_bd_tickettype` (
  `tt_ID` int(11) NOT NULL AUTO_INCREMENT,
  `tt_TypeName` varchar(30) NOT NULL,
  `tt_AdderID` varchar(20) DEFAULT NULL,
  `tt_Adder` varchar(30) DEFAULT NULL,
  `tt_AddTime` datetime DEFAULT NULL,
  `tt_ModerID` varchar(20) DEFAULT NULL,
  `tt_Moder` varchar(30) DEFAULT NULL,
  `tt_ModTime` datetime DEFAULT NULL,
  `tt_Remark` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`tt_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `tms_bd_tickettype`
--

INSERT INTO `tms_bd_tickettype` (`tt_ID`, `tt_TypeName`, `tt_AdderID`, `tt_Adder`, `tt_AddTime`, `tt_ModerID`, `tt_Moder`, `tt_ModTime`, `tt_Remark`) VALUES
(2, '电脑清单', 'admin', '超级管理员', '2014-03-16 12:17:23', NULL, NULL, NULL, ''),
(5, '客票', 'zzadmin', '刘瑶', '2014-07-16 10:40:29', NULL, NULL, NULL, ''),
(6, '保险票', 'zzadmin', '刘瑶', '2014-07-16 10:40:36', NULL, NULL, NULL, ''),
(7, '结算单', 'zzadmin', '刘瑶', '2014-07-16 10:40:44', NULL, NULL, NULL, ''),
(8, '包车单', 'zzadmin', '刘瑶', '2014-07-16 10:40:52', NULL, NULL, NULL, ''),
(9, '托运单', 'zzadmin', '刘瑶', '2014-07-16 10:40:59', NULL, NULL, NULL, ''),
(10, '安检单', 'zzadmin', '刘瑶', '2014-07-16 10:41:07', NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_bd_webuserregister`
--

CREATE TABLE IF NOT EXISTS `tms_bd_webuserregister` (
  `wur_ID` int(11) NOT NULL AUTO_INCREMENT,
  `wur_UserRegisterName` varchar(30) NOT NULL,
  `wur_Password` varchar(50) NOT NULL,
  `wur_UserName` varchar(30) NOT NULL,
  `wur_CertificateType` varchar(50) DEFAULT NULL,
  `wur_CertificateNumber` varchar(30) DEFAULT NULL,
  `wur_Emaile` varchar(50) DEFAULT NULL,
  `wur_Phone` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`wur_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `tms_bd_webuserregister`
--

INSERT INTO `tms_bd_webuserregister` (`wur_ID`, `wur_UserRegisterName`, `wur_Password`, `wur_UserName`, `wur_CertificateType`, `wur_CertificateNumber`, `wur_Emaile`, `wur_Phone`) VALUES
(1, 'webuser1', 'e10adc3949ba59abbe56e057f20f883e', '用户1', '身份证', '123456789012345678', '', ''),
(2, 'user1', 'e10adc3949ba59abbe56e057f20f883e', '用户1', '身份证', '123456123456781234', '', ''),
(3, 'test', '96e79218965eb72c92a549dd5a330112', 'test', '身份证', '111111111111100000', '111@11.com', '111'),
(4, 'cyang', 'e10adc3949ba59abbe56e057f20f883e', '蔡洋', '身份证', '342221199305096511', '', ''),
(5, 'zzadmin', '202cb962ac59075b964b07152d234b70', '刘瑶', '身份证', '142723199203090041', '', ''),
(6, '', '202cb962ac59075b964b07152d234b70', '123', '身份证', '14272319920309004x', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_chk_checktemp`
--

CREATE TABLE IF NOT EXISTS `tms_chk_checktemp` (
  `ct_NoOfRunsID` varchar(20) NOT NULL,
  `ct_NoOfRunsdate` char(10) NOT NULL,
  `ct_NoOfRunsTime` char(5) DEFAULT NULL,
  `ct_BusID` varchar(20) NOT NULL DEFAULT '',
  `ct_BusNumber` varchar(20) DEFAULT NULL,
  `ct_EndStation` varchar(50) DEFAULT NULL,
  `ct_Allticket` varchar(50) DEFAULT NULL,
  `ct_TotalSeats` varchar(50) DEFAULT NULL,
  `ct_CheckTicketWindow` varchar(20) DEFAULT NULL,
  `ct_LineID` varchar(30) DEFAULT NULL,
  `ct_UserID` varchar(20) NOT NULL,
  `ct_User` varchar(30) DEFAULT NULL,
  `ct_Flag` char(2) DEFAULT NULL,
  `ct_SoldTicketNum` smallint(6) DEFAULT '0',
  `ct_CheckedTicketNum` smallint(6) DEFAULT '0',
  `ct_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ct_ReportDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`ct_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `tms_chk_checktemp`
--

INSERT INTO `tms_chk_checktemp` (`ct_NoOfRunsID`, `ct_NoOfRunsdate`, `ct_NoOfRunsTime`, `ct_BusID`, `ct_BusNumber`, `ct_EndStation`, `ct_Allticket`, `ct_TotalSeats`, `ct_CheckTicketWindow`, `ct_LineID`, `ct_UserID`, `ct_User`, `ct_Flag`, `ct_SoldTicketNum`, `ct_CheckedTicketNum`, `ct_ID`, `ct_ReportDateTime`) VALUES
('XAPCAS0000', '2014-12-09', '', '1011002', '陕B12345', '长安', '0', '20', '1', 'XAPCAS710000000071010000000000', 'xaadmin', 'xaadmin', '0', 0, 0, 1, '2014-12-09 14:41:12'),
('XAPCAS0000', '2014-12-11', '', '1011002', '陕B12345', '长安', '0', '20', '1', 'XAPCAS710000000071010000000000', 'xaadmin', 'xaadmin', '0', 0, 0, 3, '2014-12-12 16:35:12'),
('XAPCAS0000', '2014-12-12', '', '1011002', '陕B12345', '长安', '0', '20', '1', 'XAPCAS710000000071010000000000', 'xaadmin', 'xaadmin', '3', 6, 6, 4, '2014-12-12 16:36:12'),
('XAPHYP0000', '2014-12-12', '11:00', '1011002', '陕B12345', '衡阳', '1', '20', '5', 'XAPHYP710000000043040000000000', 'xaadmin', 'xaadmin', '0', 0, 0, 5, '2014-12-12 16:37:12'),
('XAPCAS0000', '2014-12-13', '', '3011001', '湘A12345', '长安', '0', '20', '1', 'XAPCAS710000000071010000000000', 'xaadmin', 'xaadmin', '0', 4, 0, 6, '2014-12-13 16:32:12'),
('XAPHYP0000', '2014-12-13', '11:00', '1011002', '陕B12345', '衡阳', '1', '20', '5', 'XAPHYP710000000043040000000000', 'xaadmin', 'xaadmin', '3', 0, 0, 7, '2014-12-13 16:33:12');

-- --------------------------------------------------------

--
-- 表的结构 `tms_chk_checkticket`
--

CREATE TABLE IF NOT EXISTS `tms_chk_checkticket` (
  `ct_TicketID` varchar(20) NOT NULL,
  `ct_NoOfRunsID` varchar(20) DEFAULT NULL,
  `ct_LineID` varchar(30) DEFAULT NULL,
  `ct_NoOfRunsdate` char(10) DEFAULT NULL,
  `ct_BeginStationTime` char(5) DEFAULT NULL,
  `ct_StopStationTime` char(5) DEFAULT NULL,
  `ct_Distance` decimal(12,2) DEFAULT NULL,
  `ct_BeginStationID` varchar(20) DEFAULT NULL,
  `ct_BeginStation` varchar(50) DEFAULT NULL,
  `ct_FromStationID` varchar(20) DEFAULT NULL,
  `ct_FromStation` varchar(50) DEFAULT NULL,
  `ct_ReachStationID` varchar(20) DEFAULT NULL,
  `ct_ReachStation` varchar(50) DEFAULT NULL,
  `ct_EndStationID` varchar(20) DEFAULT NULL,
  `ct_EndStation` varchar(50) DEFAULT NULL,
  `ct_SellPrice` decimal(12,1) DEFAULT NULL,
  `ct_SellPriceType` varchar(50) DEFAULT NULL,
  `ct_ColleSellPriceType` varchar(2000) DEFAULT NULL,
  `ct_TotalMan` smallint(6) DEFAULT NULL,
  `ct_FullPrice` decimal(12,1) DEFAULT NULL,
  `ct_HalfPrice` decimal(12,1) DEFAULT NULL,
  `ct_StandardPrice` decimal(12,1) DEFAULT NULL,
  `ct_BalancePrice` decimal(12,1) DEFAULT NULL,
  `ct_ServiceFee` decimal(12,2) DEFAULT NULL,
  `ct_otherFee1` decimal(12,2) DEFAULT NULL,
  `ct_otherFee2` decimal(12,2) DEFAULT NULL,
  `ct_otherFee3` decimal(12,2) DEFAULT NULL,
  `ct_otherFee4` decimal(12,2) DEFAULT NULL,
  `ct_otherFee5` decimal(12,2) DEFAULT NULL,
  `ct_otherFee6` decimal(12,2) DEFAULT NULL,
  `ct_StationID` varchar(20) DEFAULT NULL,
  `ct_Station` varchar(50) DEFAULT NULL,
  `ct_SellDate` char(10) DEFAULT NULL,
  `ct_SellTime` char(8) DEFAULT NULL,
  `ct_BusModelID` varchar(20) DEFAULT NULL,
  `ct_BusModel` varchar(50) DEFAULT NULL,
  `ct_BusID` varchar(20) DEFAULT NULL,
  `ct_BusNumber` varchar(20) DEFAULT NULL,
  `ct_SeatID` varchar(200) DEFAULT NULL,
  `ct_SellID` varchar(20) DEFAULT NULL,
  `ct_SellName` varchar(30) DEFAULT NULL,
  `ct_FreeSeats` smallint(6) DEFAULT NULL,
  `ct_SafetyTicketID` varchar(20) DEFAULT NULL,
  `ct_SafetyTicketNumber` smallint(6) DEFAULT NULL,
  `ct_SafetyTicketMoney` decimal(12,2) DEFAULT NULL,
  `ct_SafetyTicketPassengerID` varchar(20) DEFAULT NULL,
  `ct_CheckTicketWindow` varchar(20) DEFAULT NULL,
  `ct_CheckerID` varchar(20) DEFAULT NULL,
  `ct_Checker` varchar(30) DEFAULT NULL,
  `ct_CheckDate` char(10) DEFAULT NULL,
  `ct_CheckTime` char(5) DEFAULT NULL,
  `ct_BalanceNO` varchar(50) DEFAULT NULL,
  `ct_IsBalance` tinyint(4) DEFAULT NULL,
  `ct_BalanceDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`ct_TicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_chk_checkticket`
--

INSERT INTO `tms_chk_checkticket` (`ct_TicketID`, `ct_NoOfRunsID`, `ct_LineID`, `ct_NoOfRunsdate`, `ct_BeginStationTime`, `ct_StopStationTime`, `ct_Distance`, `ct_BeginStationID`, `ct_BeginStation`, `ct_FromStationID`, `ct_FromStation`, `ct_ReachStationID`, `ct_ReachStation`, `ct_EndStationID`, `ct_EndStation`, `ct_SellPrice`, `ct_SellPriceType`, `ct_ColleSellPriceType`, `ct_TotalMan`, `ct_FullPrice`, `ct_HalfPrice`, `ct_StandardPrice`, `ct_BalancePrice`, `ct_ServiceFee`, `ct_otherFee1`, `ct_otherFee2`, `ct_otherFee3`, `ct_otherFee4`, `ct_otherFee5`, `ct_otherFee6`, `ct_StationID`, `ct_Station`, `ct_SellDate`, `ct_SellTime`, `ct_BusModelID`, `ct_BusModel`, `ct_BusID`, `ct_BusNumber`, `ct_SeatID`, `ct_SellID`, `ct_SellName`, `ct_FreeSeats`, `ct_SafetyTicketID`, `ct_SafetyTicketNumber`, `ct_SafetyTicketMoney`, `ct_SafetyTicketPassengerID`, `ct_CheckTicketWindow`, `ct_CheckerID`, `ct_Checker`, `ct_CheckDate`, `ct_CheckTime`, `ct_BalanceNO`, `ct_IsBalance`, `ct_BalanceDateTime`) VALUES
('5235780008', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-12', '16:33', '03', '小型中级', '1011002', '陕B12345', '1', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, '1', 'xaadmin', 'xaadmin', '2014-12-12', '16:36', '10001', 0, NULL),
('5235780009', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-12', '16:33', '03', '小型中级', '1011002', '陕B12345', '2', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, '1', 'xaadmin', 'xaadmin', '2014-12-12', '16:36', '10001', 0, NULL),
('5235780010', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-12', '16:33', '03', '小型中级', '1011002', '陕B12345', '3', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, '1', 'xaadmin', 'xaadmin', '2014-12-12', '16:36', '10001', 0, NULL),
('5235780011', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-12', '16:33', '03', '小型中级', '1011002', '陕B12345', '4', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, '1', 'xaadmin', 'xaadmin', '2014-12-12', '16:36', '10001', 0, NULL),
('5235780012', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-12', '16:33', '03', '小型中级', '1011002', '陕B12345', '5', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, '1', 'xaadmin', 'xaadmin', '2014-12-12', '16:36', '10001', 0, NULL),
('5235780013', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-12', '16:35', '03', '小型中级', '1011002', '陕B12345', '6', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, '1', 'xaadmin', 'xaadmin', '2014-12-12', '16:36', '10001', 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tms_chk_checktickettemp`
--

CREATE TABLE IF NOT EXISTS `tms_chk_checktickettemp` (
  `ctt_TicketID` varchar(20) NOT NULL,
  `ctt_NoOfRunsID` varchar(20) DEFAULT NULL,
  `ctt_LineID` varchar(30) DEFAULT NULL,
  `ctt_NoOfRunsdate` char(10) DEFAULT NULL,
  `ctt_BeginStationTime` char(5) DEFAULT NULL,
  `ctt_StopStationTime` char(5) DEFAULT NULL,
  `ctt_Distance` decimal(12,2) DEFAULT NULL,
  `ctt_BeginStationID` varchar(20) DEFAULT NULL,
  `ctt_BeginStation` varchar(50) DEFAULT NULL,
  `ctt_FromStationID` varchar(20) DEFAULT NULL,
  `ctt_FromStation` varchar(50) DEFAULT NULL,
  `ctt_ReachStationID` varchar(20) DEFAULT NULL,
  `ctt_ReachStation` varchar(50) DEFAULT NULL,
  `ctt_EndStationID` varchar(20) DEFAULT NULL,
  `ctt_EndStation` varchar(50) DEFAULT NULL,
  `ctt_SellPrice` decimal(12,1) DEFAULT NULL,
  `ctt_SellPriceType` varchar(50) DEFAULT NULL,
  `ctt_ColleSellPriceType` varchar(2000) DEFAULT NULL,
  `ctt_TotalMan` smallint(6) DEFAULT NULL,
  `ctt_FullPrice` decimal(12,1) DEFAULT NULL,
  `ctt_HalfPrice` decimal(12,1) DEFAULT NULL,
  `ctt_StandardPrice` decimal(12,1) DEFAULT NULL,
  `ctt_BalancePrice` decimal(12,1) DEFAULT NULL,
  `ctt_ServiceFee` decimal(12,2) DEFAULT NULL,
  `ctt_otherFee1` decimal(12,2) DEFAULT NULL,
  `ctt_otherFee2` decimal(12,2) DEFAULT NULL,
  `ctt_otherFee3` decimal(12,2) DEFAULT NULL,
  `ctt_otherFee4` decimal(12,2) DEFAULT NULL,
  `ctt_otherFee5` decimal(12,2) DEFAULT NULL,
  `ctt_otherFee6` decimal(12,2) DEFAULT NULL,
  `ctt_StationID` varchar(20) DEFAULT NULL,
  `ctt_Station` varchar(50) DEFAULT NULL,
  `ctt_SellDate` char(10) DEFAULT NULL,
  `ctt_SellTime` char(8) DEFAULT NULL,
  `ctt_BusModelID` varchar(20) DEFAULT NULL,
  `ctt_BusModel` varchar(50) DEFAULT NULL,
  `ctt_BusID` varchar(20) DEFAULT NULL,
  `ctt_BusNumber` varchar(50) DEFAULT NULL,
  `ctt_SeatID` varchar(200) DEFAULT NULL,
  `ctt_SellID` varchar(20) DEFAULT NULL,
  `ctt_SellName` varchar(30) DEFAULT NULL,
  `ctt_FreeSeats` smallint(6) DEFAULT NULL,
  `ctt_SafetyTicketID` varchar(20) DEFAULT NULL,
  `ctt_SafetyTicketNumber` smallint(6) DEFAULT NULL,
  `ctt_SafetyTicketMoney` decimal(12,2) DEFAULT NULL,
  `ctt_SafetyTicketPassengerID` varchar(20) DEFAULT NULL,
  `ctt_CheckTicketWindow` varchar(20) DEFAULT NULL,
  `ctt_CheckerID` varchar(20) DEFAULT NULL,
  `ctt_Checker` varchar(30) DEFAULT NULL,
  `ctt_CheckDate` char(10) DEFAULT NULL,
  `ctt_CheckTime` char(5) DEFAULT NULL,
  `ctt_TicketState` smallint(6) DEFAULT NULL,
  `ctt_AllCheck` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ctt_TicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_led_ledsyninfo`
--

CREATE TABLE IF NOT EXISTS `tms_led_ledsyninfo` (
  `lsi_ID` int(11) NOT NULL AUTO_INCREMENT,
  `lsi_LineName` varchar(50) DEFAULT NULL,
  `lsi_NoOfRunsID` varchar(20) DEFAULT NULL,
  `lsi_DepartureTime` char(5) DEFAULT NULL,
  `lsi_CheckTicketWindow` varchar(20) DEFAULT NULL,
  `lsi_BusModel` varchar(50) DEFAULT NULL,
  `lsi_StandardPrice` decimal(12,1) DEFAULT NULL,
  `lsi_FullPrice` decimal(12,1) DEFAULT NULL,
  `lsi_TotalSeats` int(11) DEFAULT NULL,
  `lsi_LeaveSeats` int(11) DEFAULT NULL,
  `lsi_BusUnit` varchar(100) DEFAULT NULL,
  `lsi_SiteName` varchar(200) DEFAULT NULL,
  `lsi_Status` varchar(40) DEFAULT NULL,
  `lsi_NoOfRunsdate` char(10) DEFAULT NULL,
  `lsi_BusCard` varchar(50) DEFAULT NULL,
  `lsi_Beginstation` varchar(50) DEFAULT NULL,
  `lsi_Endstation` varchar(50) DEFAULT NULL,
  `lsi_Remark` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`lsi_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `tms_led_ledsyninfo`
--

INSERT INTO `tms_led_ledsyninfo` (`lsi_ID`, `lsi_LineName`, `lsi_NoOfRunsID`, `lsi_DepartureTime`, `lsi_CheckTicketWindow`, `lsi_BusModel`, `lsi_StandardPrice`, `lsi_FullPrice`, `lsi_TotalSeats`, `lsi_LeaveSeats`, `lsi_BusUnit`, `lsi_SiteName`, `lsi_Status`, `lsi_NoOfRunsdate`, `lsi_BusCard`, `lsi_Beginstation`, `lsi_Endstation`, `lsi_Remark`) VALUES
(1, '西安--长安', 'XAPCAS0000', '', '1', '小型中级', '50.0', '55.0', 15, 15, '西安001车队', '', '在售', '2014-12-09', '陕B12345', '西安', '长安', NULL),
(2, '西安--长沙', 'XAPCSP0000', '', '8', '中型中级', '200.0', '200.0', 15, 15, '西安001车队', '', '在售', '2014-12-09', '', '西安', '长沙', NULL),
(3, '西安--上海', 'XAPSHP0000', '', '3', '中型中级', '500.0', '500.0', 15, 15, '西安001车队', '', '在售', '2014-12-09', '', '西安', '上海', NULL),
(4, '西安--成都', 'XAPCDP0000', '', '6', '大型普通', '300.0', '300.0', 15, 15, '西安001车队', '', '在售', '2014-12-09', '', '西安', '成都', NULL),
(5, '西安--衡阳', 'XAPHYP0000', '', '5', '中型中级', '400.0', '400.0', 15, 15, '西安001车队', '', '暂停', '2014-12-09', '', '西安', '衡阳', NULL),
(6, '西安--长沙', 'XAPCSP0000', '', '8', '中型中级', '200.0', '200.0', 15, 15, '西安001车队', '', '在售', '2014-12-11', '', '西安', '长沙', NULL),
(7, '西安--长安', 'XAPCAS0000', '', '1', '小型中级', '50.0', '55.0', 15, 15, '西安001车队', '', '在售', '2014-12-11', '陕B12345', '西安', '长安', NULL),
(8, '西安--上海', 'XAPSHP0000', '', '3', '中型中级', '500.0', '500.0', 15, 12, '西安001车队', '', '在售', '2014-12-11', '', '西安', '上海', NULL),
(9, '西安--成都', 'XAPCDP0000', '', '6', '大型普通', '300.0', '300.0', 15, 14, '西安001车队', '', '在售', '2014-12-11', '', '西安', '成都', NULL),
(10, '西安--衡阳', 'XAPHYP0000', '', '5', '中型中级', '400.0', '400.0', 15, 15, '西安001车队', '', '暂停', '2014-12-11', '', '西安', '衡阳', NULL),
(11, '西安--长安', 'XAPCAS0000', '', '1', '小型中级', '50.0', '55.0', 15, 9, '西安001车队', '', '发班', '2014-12-12', '陕B12345', '西安', '长安', NULL),
(12, '西安--长沙', 'XAPCSP0000', '', '8', '大型普通', '200.0', '200.0', 15, 15, '西安001车队', '', '在售', '2014-12-12', '', '西安', '长沙', NULL),
(13, '西安--上海', 'XAPSHP0000', '', '3', '中型中级', '500.0', '500.0', 15, 12, '西安001车队', '', '在售', '2014-12-12', '', '西安', '上海', NULL),
(14, '西安--成都', 'XAPCDP0000', '', '6', '大型普通', '300.0', '300.0', 15, 15, '西安001车队', '', '在售', '2014-12-12', '', '西安', '成都', NULL),
(15, '西安--衡阳', 'XAPHYP0000', '', '5', '中型中级', '400.0', '400.0', 15, 15, '西安001车队', '', '在售', '2014-12-12', '陕B12345', '西安', '衡阳', NULL),
(16, '西安--长安', 'XAPCAS0000', '', '1', '小型中级', '50.0', '55.0', 15, 11, '长沙001车队', '', '在售', '2014-12-13', '湘A12345', '西安', '长安', NULL),
(17, '西安--长沙', 'XAPCSP0000', '', '8', '中型中级', '200.0', '200.0', 15, 15, '西安001车队', '', '在售', '2014-12-13', '', '西安', '长沙', NULL),
(18, '西安--上海', 'XAPSHP0000', '', '3', '中型中级', '500.0', '500.0', 15, 16, '西安001车队', '', '在售', '2014-12-13', '', '西安', '上海', NULL),
(19, '西安--成都', 'XAPCDP0000', '', '6', '大型普通', '300.0', '300.0', 15, 14, '西安001车队', '', '在售', '2014-12-13', '', '西安', '成都', NULL),
(20, '西安--衡阳', 'XAPHYP0000', '', '5', '中型中级', '400.0', '400.0', 15, 15, '西安001车队', '', '在售', '2014-12-13', '陕B12345', '西安', '衡阳', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tms_lug_cloakroom`
--

CREATE TABLE IF NOT EXISTS `tms_lug_cloakroom` (
  `cr_ID` int(11) NOT NULL AUTO_INCREMENT,
  `cr_CustodyID` varchar(20) DEFAULT NULL,
  `cr_PasserName` varchar(50) DEFAULT NULL,
  `cr_PasserTel` varchar(20) DEFAULT NULL,
  `cr_BaggageType` varchar(50) DEFAULT NULL,
  `cr_BaggageNo` varchar(20) DEFAULT NULL,
  `cr_KeepMoney` decimal(12,1) DEFAULT NULL,
  `cr_KeepUserID` varchar(20) DEFAULT NULL,
  `cr_KeepUser` varchar(30) DEFAULT NULL,
  `cr_DepositTime` datetime DEFAULT NULL,
  `cr_ExtractionTime` datetime DEFAULT NULL,
  `cr_ExtractionUserID` varchar(20) DEFAULT NULL,
  `cr_ExtractionUser` varchar(50) DEFAULT NULL,
  `cr_Type` varchar(50) DEFAULT NULL,
  `cr_Remark` varchar(300) DEFAULT NULL,
  `cr_StationID` varchar(20) DEFAULT NULL,
  `cr_Station` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cr_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tms_lug_luggagecons`
--

CREATE TABLE IF NOT EXISTS `tms_lug_luggagecons` (
  `lc_ID` int(11) NOT NULL AUTO_INCREMENT,
  `lc_TicketNumber` varchar(20) DEFAULT NULL,
  `lc_Destination` varchar(50) DEFAULT NULL,
  `lc_NoOfRunsID` varchar(20) DEFAULT NULL,
  `lc_BusID` varchar(20) DEFAULT NULL,
  `lc_BusNumber` varchar(20) DEFAULT NULL,
  `lc_DeliveryDate` char(10) DEFAULT NULL,
  `lc_DeliveryUserID` varchar(20) DEFAULT NULL,
  `lc_DeliveryUser` varchar(30) DEFAULT NULL,
  `lc_AcceptDateTime` datetime DEFAULT NULL,
  `lc_ConsignName` varchar(30) DEFAULT NULL,
  `lc_ConsignTel` varchar(20) DEFAULT NULL,
  `lc_ConsignPaperID` varchar(20) DEFAULT NULL,
  `lc_ConsignAdd` varchar(50) DEFAULT NULL,
  `lc_UnloadName` varchar(30) DEFAULT NULL,
  `lc_UnloadTel` varchar(20) DEFAULT NULL,
  `lc_UnloadPaperID` varchar(20) DEFAULT NULL,
  `lc_UnloadAdd` varchar(50) DEFAULT NULL,
  `lc_CargoName` varchar(50) DEFAULT NULL,
  `lc_Numbers` smallint(6) DEFAULT NULL,
  `lc_Weight` decimal(12,2) DEFAULT NULL,
  `lc_CargoDescription` varchar(50) DEFAULT NULL,
  `lc_ConsignMoney` decimal(12,1) DEFAULT NULL,
  `lc_PackingMoney` decimal(12,1) DEFAULT NULL,
  `lc_LabelMoney` decimal(12,1) DEFAULT NULL,
  `lc_HandlingMoney` decimal(12,1) DEFAULT NULL,
  `lc_Remark` varchar(300) DEFAULT NULL,
  `lc_StationID` varchar(20) DEFAULT NULL,
  `lc_Station` varchar(50) DEFAULT NULL,
  `lc_Status` varchar(20) DEFAULT NULL,
  `lc_ExtractionTime` datetime DEFAULT NULL,
  `lc_ExtractionUserID` varchar(20) DEFAULT NULL,
  `lc_ExtractionUser` varchar(30) DEFAULT NULL,
  `lc_Isvalueinsure` tinyint(4) DEFAULT NULL,
  `lc_InsureMoney` decimal(12,1) DEFAULT NULL,
  `lc_InsureFee` decimal(12,1) DEFAULT NULL,
  `lc_PayStyle` varchar(50) DEFAULT NULL,
  `lc_Allmoney` decimal(12,1) DEFAULT NULL,
  `lc_IsBalance` tinyint(4) DEFAULT NULL,
  `lc_BalanceDateTime` datetime DEFAULT NULL,
  `lc_DestinationID` varchar(20) DEFAULT NULL,
  `lc_StationBalance` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`lc_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `tms_lug_luggagecons`
--

INSERT INTO `tms_lug_luggagecons` (`lc_ID`, `lc_TicketNumber`, `lc_Destination`, `lc_NoOfRunsID`, `lc_BusID`, `lc_BusNumber`, `lc_DeliveryDate`, `lc_DeliveryUserID`, `lc_DeliveryUser`, `lc_AcceptDateTime`, `lc_ConsignName`, `lc_ConsignTel`, `lc_ConsignPaperID`, `lc_ConsignAdd`, `lc_UnloadName`, `lc_UnloadTel`, `lc_UnloadPaperID`, `lc_UnloadAdd`, `lc_CargoName`, `lc_Numbers`, `lc_Weight`, `lc_CargoDescription`, `lc_ConsignMoney`, `lc_PackingMoney`, `lc_LabelMoney`, `lc_HandlingMoney`, `lc_Remark`, `lc_StationID`, `lc_Station`, `lc_Status`, `lc_ExtractionTime`, `lc_ExtractionUserID`, `lc_ExtractionUser`, `lc_Isvalueinsure`, `lc_InsureMoney`, `lc_InsureFee`, `lc_PayStyle`, `lc_Allmoney`, `lc_IsBalance`, `lc_BalanceDateTime`, `lc_DestinationID`, `lc_StationBalance`) VALUES
(1, '10000', '长沙', 'XAPHYP0000', '1011002', '陕B12345', '2014-12-12', 'xaadmin', 'xaadmin', '2014-12-12 16:38:41', '1', '1', '', '1', ' 1', '1', '', '1', '1', 1, '1.00', '', '1.0', '1.0', '1.0', '0.0', '', '7100000000', '西安', '已收货', NULL, NULL, NULL, 0, '0.0', '0.0', '发货人付款', '3.0', 0, '0000-00-00 00:00:00', '4301000000', 0),
(2, '10011', '长沙', 'XAPHYP0000', '1011002', '陕B12345', '2014-12-13', 'xaadmin', 'xaadmin', '2014-12-13 16:34:31', '1', '1', '', '', ' 1', '1', '', '1', '1', 1, '1.00', '', '1.0', '1.0', '1.0', '1.0', '', '7100000000', '西安', '已提取', '2014-12-13 16:39:08', 'csadmin', 'csadmin', 0, '0.0', '0.0', '收货人付款', '4.0', 0, '0000-00-00 00:00:00', '4301000000', 0);

-- --------------------------------------------------------

--
-- 表的结构 `tms_lug_luggagepaymoney`
--

CREATE TABLE IF NOT EXISTS `tms_lug_luggagepaymoney` (
  `lpm_ID` int(11) NOT NULL AUTO_INCREMENT,
  `lpm_DeliveryUserID` varchar(20) DEFAULT NULL,
  `lpm_DeliveryUser` varchar(30) DEFAULT NULL,
  `lpm_DeliveryDate` char(10) DEFAULT NULL,
  `lpm_DeliveryMoney` decimal(12,1) DEFAULT NULL,
  `lpm_DeliveryNumber` int(11) DEFAULT NULL,
  `lpm_ExtractionMoney` decimal(12,1) DEFAULT NULL,
  `lpm_ExtractionNumber` int(11) DEFAULT NULL,
  `lpm_LuggageConsMoney` decimal(12,1) DEFAULT NULL,
  `lpm_UserID` varchar(20) DEFAULT NULL,
  `lpm_User` varchar(30) DEFAULT NULL,
  `lpm_SubDateTime` datetime DEFAULT NULL,
  `lpm_Remark` varchar(200) DEFAULT NULL,
  `lpm_lugconsigntation` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`lpm_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tms_sch_andnoofruns`
--

CREATE TABLE IF NOT EXISTS `tms_sch_andnoofruns` (
  `anr_NoOfRunsID` varchar(20) NOT NULL,
  `anr_NoOfRunsdate` char(10) NOT NULL DEFAULT '',
  `anr_AndNoOfRunsID` varchar(20) DEFAULT NULL,
  `anr_AndNoOfRunsdate` char(10) DEFAULT NULL,
  `anr_AndTime` datetime DEFAULT NULL,
  `anr_AnderID` varchar(20) DEFAULT NULL,
  `anr_Ander` varchar(30) DEFAULT NULL,
  `anr_Seats` int(11) DEFAULT NULL,
  `anr_HalfSeats` int(11) DEFAULT NULL,
  `anr_AndSeatID` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`anr_NoOfRunsID`,`anr_NoOfRunsdate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_sch_noticeinfo`
--

CREATE TABLE IF NOT EXISTS `tms_sch_noticeinfo` (
  `ni_state` varchar(2) NOT NULL DEFAULT '1',
  `ni_info` varchar(100) NOT NULL,
  `ni_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_sch_noticeinfo`
--

INSERT INTO `tms_sch_noticeinfo` (`ni_state`, `ni_info`, `ni_id`) VALUES
('1', '各位旅客请注意', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tms_sch_previoustime`
--

CREATE TABLE IF NOT EXISTS `tms_sch_previoustime` (
  `pt_Stop` varchar(3) NOT NULL DEFAULT '5',
  `pt_Current` varchar(3) NOT NULL DEFAULT '20',
  `pt_Hasten` varchar(3) NOT NULL DEFAULT '25',
  `pt_StopRepeat` varchar(3) NOT NULL DEFAULT '2',
  `pt_HastenRepeat` varchar(3) NOT NULL DEFAULT '2',
  `pt_CurrentRepeat` varchar(3) NOT NULL DEFAULT '2',
  `pt_WaitRepeat` varchar(3) NOT NULL DEFAULT '1',
  `pt_Normal` varchar(3) NOT NULL DEFAULT '1',
  `pt_Code` varchar(3) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_sch_report`
--

CREATE TABLE IF NOT EXISTS `tms_sch_report` (
  `rt_ID` int(11) NOT NULL AUTO_INCREMENT,
  `rt_NoOfRunsID` varchar(20) DEFAULT NULL,
  `rt_LineID` varchar(30) DEFAULT NULL,
  `rt_NoOfRunsdate` char(10) DEFAULT NULL,
  `rt_AttemperStationID` varchar(20) DEFAULT NULL,
  `rt_AttemperStation` varchar(50) DEFAULT NULL,
  `rt_ReportDateTime` datetime DEFAULT NULL,
  `rt_BusID` varchar(20) DEFAULT NULL,
  `rt_BusCard` varchar(20) DEFAULT NULL,
  `rt_BusModelID` varchar(20) DEFAULT NULL,
  `rt_BusModel` varchar(50) DEFAULT NULL,
  `rt_BeginStationID` varchar(20) DEFAULT NULL,
  `rt_BeginStation` varchar(50) DEFAULT NULL,
  `rt_FromStationID` varchar(20) DEFAULT NULL,
  `rt_FromStation` varchar(50) DEFAULT NULL,
  `rt_EndStationID` varchar(20) DEFAULT NULL,
  `rt_EndStation` varchar(50) DEFAULT NULL,
  `rt_DriverID` varchar(20) DEFAULT NULL,
  `rt_Driver` varchar(30) DEFAULT NULL,
  `rt_Driver1ID` varchar(20) DEFAULT NULL,
  `rt_Driver1` varchar(30) DEFAULT NULL,
  `rt_Driver2ID` varchar(20) DEFAULT NULL,
  `rt_Driver2` varchar(30) DEFAULT NULL,
  `rt_ReportCircs` varchar(50) DEFAULT NULL,
  `rt_ReportUser` varchar(30) DEFAULT NULL,
  `rt_Allticket` tinyint(4) DEFAULT NULL,
  `rt_Register` varchar(50) DEFAULT NULL,
  `rt_SupTicketRen` int(11) DEFAULT NULL,
  `rt_Remark` varchar(1000) DEFAULT NULL,
  `rt_SeatNum` smallint(6) DEFAULT NULL,
  `rt_CheckTicketWindow` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`rt_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `tms_sch_report`
--

INSERT INTO `tms_sch_report` (`rt_ID`, `rt_NoOfRunsID`, `rt_LineID`, `rt_NoOfRunsdate`, `rt_AttemperStationID`, `rt_AttemperStation`, `rt_ReportDateTime`, `rt_BusID`, `rt_BusCard`, `rt_BusModelID`, `rt_BusModel`, `rt_BeginStationID`, `rt_BeginStation`, `rt_FromStationID`, `rt_FromStation`, `rt_EndStationID`, `rt_EndStation`, `rt_DriverID`, `rt_Driver`, `rt_Driver1ID`, `rt_Driver1`, `rt_Driver2ID`, `rt_Driver2`, `rt_ReportCircs`, `rt_ReportUser`, `rt_Allticket`, `rt_Register`, `rt_SupTicketRen`, `rt_Remark`, `rt_SeatNum`, `rt_CheckTicketWindow`) VALUES
(1, 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-09', '7100000000', '西安', '2014-12-09 14:41:12', '1011002', '陕B12345', '03', '小型中级', '7100000000', '西安', NULL, NULL, '7101000000', '长安', '', '', '', '', '', '', NULL, 'xaadmin', 0, '未发车', NULL, '没安检；', 20, '1'),
(3, 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-11', '7100000000', '西安', '2014-12-12 16:35:12', '1011002', '陕B12345', '03', '小型中级', '7100000000', '西安', NULL, NULL, '7101000000', '长安', '', '', '', '', '', '', NULL, 'xaadmin', 0, '未发车', NULL, '没安检；', 20, '1'),
(4, 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '7100000000', '西安', '2014-12-12 16:36:12', '1011002', '陕B12345', '03', '小型中级', '7100000000', '西安', NULL, NULL, '7101000000', '长安', '', '', '', '', '', '', NULL, 'xaadmin', 0, '已发车', NULL, '没安检；', 20, '1'),
(5, 'XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-12', '7100000000', '西安', '2014-12-12 16:37:12', '1011002', '陕B12345', '03', '小型中级', '7100000000', '西安', NULL, NULL, '4304000000', '衡阳', '', '', '', '', '', '', NULL, 'xaadmin', 1, '未发车', NULL, '没安检；', 20, '5'),
(6, 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-13', '7100000000', '西安', '2014-12-13 16:32:12', '3011001', '湘A12345', '05', '中型中级', '7100000000', '西安', NULL, NULL, '7101000000', '长安', '', '', '', '', '', '', NULL, 'xaadmin', 0, '未发车', NULL, '没安检；无道路运输证；无线路牌；无车辆行驶证；无驾驶员；', 20, '1'),
(7, 'XAPHYP0000', 'XAPHYP710000000043040000000000', '2014-12-13', '7100000000', '西安', '2014-12-13 16:33:12', '1011002', '陕B12345', '03', '小型中级', '7100000000', '西安', NULL, NULL, '4304000000', '衡阳', '', '', '', '', '', '', NULL, 'xaadmin', 1, '已发车', NULL, '没安检；', 20, '5');

-- --------------------------------------------------------

--
-- 表的结构 `tms_sch_reportinfo`
--

CREATE TABLE IF NOT EXISTS `tms_sch_reportinfo` (
  `ri_state` varchar(2) NOT NULL DEFAULT '1',
  `ri_info` varchar(100) NOT NULL,
  `ri_FromStationID` varchar(20) DEFAULT NULL,
  `ri_FromStation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_sch_speechnoofrunsattemp`
--

CREATE TABLE IF NOT EXISTS `tms_sch_speechnoofrunsattemp` (
  `sa_StopStationTime` varchar(50) DEFAULT NULL,
  `sa_EndStation` varchar(50) DEFAULT NULL,
  `sa_NoOfRunsID` varchar(20) DEFAULT NULL,
  `sa_Check` varchar(20) DEFAULT NULL,
  `sa_BusNumber` varchar(20) DEFAULT NULL,
  `sa_PreviousTime` varchar(5) DEFAULT NULL,
  `sa_CheckState` varchar(20) NOT NULL,
  `sa_Beginstation` varchar(20) DEFAULT NULL,
  `sa_NoOfRunsdate` date DEFAULT NULL,
  `sa_FromStationID` varchar(20) DEFAULT NULL,
  `sa_FromStation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_sch_speechnoofrunsid`
--

CREATE TABLE IF NOT EXISTS `tms_sch_speechnoofrunsid` (
  `sn_StopStationTime` varchar(50) DEFAULT NULL,
  `sn_EndStation` varchar(50) DEFAULT NULL,
  `sn_NoOfRunsID` varchar(20) DEFAULT NULL,
  `sn_Check` varchar(20) DEFAULT NULL,
  `sn_BusNumber` varchar(20) DEFAULT NULL,
  `sn_PreviousTime` varchar(5) DEFAULT NULL,
  `sn_CheckState` varchar(20) NOT NULL,
  `sn_Beginstation` varchar(20) DEFAULT NULL,
  `sn_NoOfRunsdate` date DEFAULT NULL,
  `sn_FromStationID` varchar(20) DEFAULT NULL,
  `sn_FromStation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_sell_alterticket`
--

CREATE TABLE IF NOT EXISTS `tms_sell_alterticket` (
  `at_TicketID` varchar(20) NOT NULL,
  `at_NoOfRunsID` varchar(20) DEFAULT NULL,
  `at_LineID` varchar(30) DEFAULT NULL,
  `at_NoOfRunsdate` char(10) DEFAULT NULL,
  `at_BeginStationTime` char(5) DEFAULT NULL,
  `at_StopStationTime` char(5) DEFAULT NULL,
  `at_Distance` decimal(12,1) DEFAULT NULL,
  `at_BeginStationID` varchar(20) DEFAULT NULL,
  `at_BeginStation` varchar(50) DEFAULT NULL,
  `at_FromStationID` varchar(20) DEFAULT NULL,
  `at_FromStation` varchar(50) DEFAULT NULL,
  `at_ReachStationID` varchar(20) DEFAULT NULL,
  `at_ReachStation` varchar(50) DEFAULT NULL,
  `at_EndStationID` varchar(20) DEFAULT NULL,
  `at_EndStation` varchar(50) DEFAULT NULL,
  `at_SellPrice` decimal(12,1) DEFAULT NULL,
  `at_SellPriceType` varchar(50) DEFAULT NULL,
  `at_ColleSellPriceType` varchar(2000) DEFAULT NULL,
  `at_TotalMan` smallint(6) DEFAULT NULL,
  `at_FullPrice` decimal(12,1) DEFAULT NULL,
  `at_HalfPrice` decimal(12,1) DEFAULT NULL,
  `at_StandardPrice` decimal(12,1) DEFAULT NULL,
  `at_BalancePrice` decimal(12,1) DEFAULT NULL,
  `at_ServiceFee` decimal(12,2) DEFAULT NULL,
  `at_otherFee1` decimal(12,2) DEFAULT NULL,
  `at_otherFee2` decimal(12,2) DEFAULT NULL,
  `at_otherFee3` decimal(12,2) DEFAULT NULL,
  `at_otherFee4` decimal(12,2) DEFAULT NULL,
  `at_otherFee5` decimal(12,2) DEFAULT NULL,
  `at_otherFee6` decimal(12,2) DEFAULT NULL,
  `at_AlterStationID` varchar(20) DEFAULT NULL,
  `at_AlterStation` varchar(50) DEFAULT NULL,
  `at_SellDate` char(10) DEFAULT NULL,
  `at_SellTime` char(8) DEFAULT NULL,
  `at_BusModelID` varchar(20) DEFAULT NULL,
  `at_BusModel` varchar(50) DEFAULT NULL,
  `at_SeatID` varchar(200) DEFAULT NULL,
  `at_SellID` varchar(20) DEFAULT NULL,
  `at_SellName` varchar(30) DEFAULT NULL,
  `at_FreeSeats` smallint(6) DEFAULT NULL,
  `at_SafetyTicketNumber` smallint(6) DEFAULT NULL,
  `at_SafetyTicketMoney` decimal(12,1) DEFAULT NULL,
  `at_AlterDateTime` datetime DEFAULT NULL,
  `at_AlterSellID` varchar(20) DEFAULT NULL,
  `at_AlterSellName` varchar(30) DEFAULT NULL,
  `at_Remark` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`at_TicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_sell_errinsureticket`
--

CREATE TABLE IF NOT EXISTS `tms_sell_errinsureticket` (
  `eitt_SyncCode` varchar(30) NOT NULL,
  `eitt_InsureTicketNo` varchar(20) NOT NULL,
  `eitt_TicketNo` varchar(20) NOT NULL,
  `eitt_CreatedType` tinyint(4) DEFAULT NULL,
  `eitt_IdCard` varchar(30) DEFAULT NULL,
  `eitt_Name` varchar(20) DEFAULT NULL,
  `eitt_Beneficiary` varchar(20) DEFAULT NULL,
  `eitt_Price` decimal(12,1) DEFAULT NULL,
  `eitt_AinsuranceValue` decimal(12,1) DEFAULT NULL,
  `eitt_BinsuranceValue` decimal(12,1) DEFAULT NULL,
  `eitt_CinsuranceValue` decimal(12,1) DEFAULT NULL,
  `eitt_DinsuranceValue` decimal(12,1) DEFAULT NULL,
  `eitt_Cause` varchar(200) DEFAULT NULL,
  `eitt_ErrTime` char(5) DEFAULT NULL,
  `eitt_ErrDate` char(10) DEFAULT NULL,
  `eitt_ErrUserID` varchar(20) DEFAULT NULL,
  `eitt_ErrUser` varchar(30) DEFAULT NULL,
  `eitt_StationName` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`eitt_InsureTicketNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_sell_errticket`
--

CREATE TABLE IF NOT EXISTS `tms_sell_errticket` (
  `et_TicketID` varchar(20) NOT NULL,
  `et_NoOfRunsID` varchar(20) DEFAULT NULL,
  `et_NoOfRunsdate` char(10) DEFAULT NULL,
  `et_BeginStationTime` char(5) DEFAULT NULL,
  `et_StopStationTime` char(5) DEFAULT NULL,
  `et_SellPrice` decimal(12,1) DEFAULT NULL,
  `et_SellPriceType` varchar(50) DEFAULT NULL,
  `et_SellDate` char(10) DEFAULT NULL,
  `et_SellTime` char(8) DEFAULT NULL,
  `et_SeatID` varchar(200) DEFAULT NULL,
  `et_FreeSeats` smallint(6) DEFAULT NULL,
  `et_SafetyPrice` smallint(6) DEFAULT NULL,
  `et_Cause` varchar(200) DEFAULT NULL,
  `et_ErrTime` char(5) DEFAULT NULL,
  `et_ErrDate` char(10) DEFAULT NULL,
  `et_ErrUserID` varchar(20) DEFAULT NULL,
  `et_ErrUser` varchar(30) DEFAULT NULL,
  `et_BeginStationID` varchar(20) DEFAULT NULL,
  `et_BeginStation` varchar(50) DEFAULT NULL,
  `et_FromStationID` varchar(20) DEFAULT NULL,
  `et_FromStation` varchar(50) DEFAULT NULL,
  `et_ReachStationID` varchar(20) DEFAULT NULL,
  `et_ReachStation` varchar(50) DEFAULT NULL,
  `et_EndStationID` varchar(20) DEFAULT NULL,
  `et_EndStation` varchar(50) DEFAULT NULL,
  `et_StationID` varchar(20) DEFAULT NULL,
  `et_Station` varchar(50) DEFAULT NULL,
  `et_IsBalance` tinyint(4) DEFAULT NULL,
  `et_BalanceDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`et_TicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_sell_errticket`
--

INSERT INTO `tms_sell_errticket` (`et_TicketID`, `et_NoOfRunsID`, `et_NoOfRunsdate`, `et_BeginStationTime`, `et_StopStationTime`, `et_SellPrice`, `et_SellPriceType`, `et_SellDate`, `et_SellTime`, `et_SeatID`, `et_FreeSeats`, `et_SafetyPrice`, `et_Cause`, `et_ErrTime`, `et_ErrDate`, `et_ErrUserID`, `et_ErrUser`, `et_BeginStationID`, `et_BeginStation`, `et_FromStationID`, `et_FromStation`, `et_ReachStationID`, `et_ReachStation`, `et_EndStationID`, `et_EndStation`, `et_StationID`, `et_Station`, `et_IsBalance`, `et_BalanceDateTime`) VALUES
('5235780016', 'XAPSHP0000', '2014-12-13', '08:00', '', '500.0', '全票', '2014-12-13', '16:10', '1', NULL, NULL, 'test', '16:13', '2014-12-13', 'xaadmin', 'xaadmin', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '7100000000', '西安', 1, '2014-12-13 16:32:24');

-- --------------------------------------------------------

--
-- 表的结构 `tms_sell_hissellticket`
--

CREATE TABLE IF NOT EXISTS `tms_sell_hissellticket` (
  `sth_TicketID` varchar(20) NOT NULL,
  `sth_NoOfRunsID` varchar(20) DEFAULT NULL,
  `sth_NoOfRunsdate` char(10) DEFAULT NULL,
  `sth_BeginStationTime` char(5) DEFAULT NULL,
  `sth_StopStationTime` char(5) DEFAULT NULL,
  `sth_Distance` smallint(6) DEFAULT NULL,
  `sth_BeginStationID` varchar(20) DEFAULT NULL,
  `sth_BeginStation` varchar(50) DEFAULT NULL,
  `sth_FromStationID` varchar(20) DEFAULT NULL,
  `sth_FromStation` varchar(50) DEFAULT NULL,
  `sth_ReachStationID` varchar(20) DEFAULT NULL,
  `sth_ReachStation` varchar(50) DEFAULT NULL,
  `sth_EndStationID` varchar(20) DEFAULT NULL,
  `sth_EndStation` varchar(50) DEFAULT NULL,
  `sth_SellPrice` decimal(12,1) DEFAULT NULL,
  `sth_SellPriceType` varchar(20) DEFAULT NULL,
  `sth_ColleSellPriceType` varchar(2000) DEFAULT NULL,
  `sth_FullPrice` decimal(12,1) DEFAULT NULL,
  `sth_HalfPrice` decimal(12,1) DEFAULT NULL,
  `sth_StandardPrice` decimal(12,1) DEFAULT NULL,
  `sth_BalancePrice` decimal(12,1) DEFAULT NULL,
  `sth_ServiceFee` decimal(12,2) DEFAULT NULL,
  `sth_otherFee1` decimal(12,2) DEFAULT NULL,
  `sth_otherFee2` decimal(12,2) DEFAULT NULL,
  `sth_StationID` varchar(20) DEFAULT NULL,
  `sth_Station` varchar(50) DEFAULT NULL,
  `sth_SellDate` char(10) DEFAULT NULL,
  `sth_SellTime` char(5) DEFAULT NULL,
  `sth_BusModelID` varchar(20) DEFAULT NULL,
  `sth_BusModel` varchar(20) DEFAULT NULL,
  `sth_SeatID` varchar(200) DEFAULT NULL,
  `sth_SellID` varchar(20) DEFAULT NULL,
  `sth_SellName` varchar(30) DEFAULT NULL,
  `sth_FreeSeats` smallint(6) DEFAULT NULL,
  `sth_SafetyPrice` smallint(6) DEFAULT NULL,
  `sth_SafetyMoney` decimal(12,1) DEFAULT NULL,
  `sth_TicketState` smallint(6) DEFAULT NULL,
  `sth_IsBalance` tinyint(4) DEFAULT NULL,
  `sth_BalanceDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`sth_TicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_sell_insureticket`
--

CREATE TABLE IF NOT EXISTS `tms_sell_insureticket` (
  `itt_SyncCode` varchar(30) NOT NULL,
  `itt_InsureTicketNo` varchar(20) NOT NULL,
  `itt_TicketNo` varchar(20) NOT NULL,
  `itt_CreatedType` tinyint(4) DEFAULT NULL,
  `itt_Status` tinyint(4) DEFAULT NULL,
  `itt_IdCard` varchar(30) DEFAULT NULL,
  `itt_Name` varchar(20) DEFAULT NULL,
  `itt_Beneficiary` varchar(20) DEFAULT NULL,
  `itt_TbInsureProductID` varchar(10) DEFAULT NULL,
  `itt_InsureProductName` varchar(20) DEFAULT NULL,
  `itt_Price` decimal(12,1) DEFAULT NULL,
  `itt_AinsuranceValue` decimal(12,1) DEFAULT NULL,
  `itt_BinsuranceValue` decimal(12,1) DEFAULT NULL,
  `itt_CinsuranceValue` decimal(12,1) DEFAULT NULL,
  `itt_DinsuranceValue` decimal(12,1) DEFAULT NULL,
  `itt_IsUpMoney` tinyint(4) DEFAULT NULL,
  `itt_UpMoneyID` varchar(20) DEFAULT NULL,
  `itt_Saler` varchar(20) DEFAULT NULL,
  `itt_PtrReserveID` varchar(20) DEFAULT NULL,
  `itt_SaleComputer` varchar(20) DEFAULT NULL,
  `itt_SaleTime` datetime DEFAULT NULL,
  `itt_RiskCode` char(3) DEFAULT NULL,
  `itt_PationType` varchar(20) DEFAULT NULL,
  `itt_AgentCode` varchar(20) DEFAULT NULL,
  `itt_VisaCode` varchar(20) DEFAULT NULL,
  `itt_PolicyNo` varchar(30) DEFAULT NULL,
  `itt_UploadStatus` tinyint(4) DEFAULT NULL,
  `itt_UploadDate` datetime DEFAULT NULL,
  `itt_ReturnUploadStatus` tinyint(4) DEFAULT NULL,
  `itt_ReturnUploadDate` datetime DEFAULT NULL,
  `itt_IDCardType` varchar(5) DEFAULT NULL,
  `itt_MakeCode` varchar(20) DEFAULT NULL,
  `itt_ComCode` varchar(20) DEFAULT NULL,
  `itt_HandlerCode` varchar(20) DEFAULT NULL,
  `itt_Handler1Code` varchar(20) DEFAULT NULL,
  `itt_OperatorCode` varchar(20) DEFAULT NULL,
  `itt_ApporverCode` varchar(20) DEFAULT NULL,
  `itt_TotalSum` varchar(20) DEFAULT NULL,
  `itt_ReserveName` varchar(50) DEFAULT NULL,
  `itt_ADOrgCode` varchar(10) DEFAULT NULL,
  `itt_ADOrgName` varchar(50) DEFAULT NULL,
  `itt_ADOrgValue` varchar(20) DEFAULT NULL,
  `itt_SeatNo` varchar(10) DEFAULT NULL,
  `itt_RideDate` datetime DEFAULT NULL,
  `itt_ScheduleID` varchar(20) DEFAULT NULL,
  `itt_ScheduleValue` varchar(20) DEFAULT NULL,
  `itt_FormName` varchar(50) DEFAULT NULL,
  `itt_FormValue` varchar(20) DEFAULT NULL,
  `itt_ReachName` varchar(50) DEFAULT NULL,
  `itt_ReachValue` varchar(20) DEFAULT NULL,
  `itt_IsActive` tinyint(4) DEFAULT NULL,
  `itt_AdClientID` varchar(20) DEFAULT NULL,
  `itt_AdOrgID` varchar(20) DEFAULT NULL,
  `itt_Created` datetime DEFAULT NULL,
  `itt_CreatedBY` varchar(20) DEFAULT NULL,
  `itt_UpdateBY` varchar(20) DEFAULT NULL,
  `itt_Update` datetime DEFAULT NULL,
  `itt_SalerName` varchar(20) DEFAULT NULL,
  `itt_IdAdderss` varchar(200) DEFAULT NULL,
  `itt_SaverResult` varchar(20) DEFAULT NULL,
  `itt_SendCount` int(11) DEFAULT NULL,
  `itt_NextSendTime` datetime DEFAULT NULL,
  `itt_ReturnSendCount` int(11) DEFAULT NULL,
  `itt_ReturnNextSendTime` datetime DEFAULT NULL,
  `itt_ReturnSaveResult` varchar(20) DEFAULT NULL,
  `itt_RowID` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`itt_InsureTicketNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_sell_insureticket`
--

INSERT INTO `tms_sell_insureticket` (`itt_SyncCode`, `itt_InsureTicketNo`, `itt_TicketNo`, `itt_CreatedType`, `itt_Status`, `itt_IdCard`, `itt_Name`, `itt_Beneficiary`, `itt_TbInsureProductID`, `itt_InsureProductName`, `itt_Price`, `itt_AinsuranceValue`, `itt_BinsuranceValue`, `itt_CinsuranceValue`, `itt_DinsuranceValue`, `itt_IsUpMoney`, `itt_UpMoneyID`, `itt_Saler`, `itt_PtrReserveID`, `itt_SaleComputer`, `itt_SaleTime`, `itt_RiskCode`, `itt_PationType`, `itt_AgentCode`, `itt_VisaCode`, `itt_PolicyNo`, `itt_UploadStatus`, `itt_UploadDate`, `itt_ReturnUploadStatus`, `itt_ReturnUploadDate`, `itt_IDCardType`, `itt_MakeCode`, `itt_ComCode`, `itt_HandlerCode`, `itt_Handler1Code`, `itt_OperatorCode`, `itt_ApporverCode`, `itt_TotalSum`, `itt_ReserveName`, `itt_ADOrgCode`, `itt_ADOrgName`, `itt_ADOrgValue`, `itt_SeatNo`, `itt_RideDate`, `itt_ScheduleID`, `itt_ScheduleValue`, `itt_FormName`, `itt_FormValue`, `itt_ReachName`, `itt_ReachValue`, `itt_IsActive`, `itt_AdClientID`, `itt_AdOrgID`, `itt_Created`, `itt_CreatedBY`, `itt_UpdateBY`, `itt_Update`, `itt_SalerName`, `itt_IdAdderss`, `itt_SaverResult`, `itt_SendCount`, `itt_NextSendTime`, `itt_ReturnSendCount`, `itt_ReturnNextSendTime`, `itt_ReturnSaveResult`, `itt_RowID`) VALUES
('bbb430010000', '10000', '5235780016', 0, 0, '123451234512345', 'unknown', NULL, NULL, 'B保险费二元', '2.0', '12000.0', '2000.0', '0.0', '0.0', 0, '0', 'xaadmin', NULL, NULL, '2014-12-13 16:10:17', 'EDA', '4310A', '43003F300025', 'AEEDAA2013ZJP', NULL, 1, NULL, 0, NULL, NULL, '43100302', 'bbb', 'bbb', 'bbb', 'bbb', 'bbb', '12000.0', '西安', NULL, '西安', '7100000000', '1', '2014-12-13 16:10:17', NULL, NULL, '西安', '7100000000', '上海', '3100000000', 0, '0', '0', '2014-12-13 16:10:17', 'xaadmin', 'xaadmin', '2014-12-13 16:10:17', 'xaadmin', 'unknown', NULL, 0, NULL, 0, NULL, NULL, NULL),
('bbb430010001', '10001', '5235780017', 0, 0, '123451234512345', '', NULL, NULL, 'B保险费二元', '2.0', '12000.0', '2000.0', '0.0', '0.0', 0, '0', 'xaadmin', NULL, NULL, '2014-12-13 16:10:17', 'EDA', '4310A', '43003F300025', 'AEEDAA2013ZJP', NULL, 1, NULL, 0, NULL, NULL, '43100302', 'bbb', 'bbb', 'bbb', 'bbb', 'bbb', '12000.0', '西安', NULL, '西安', '7100000000', '2', '2014-12-13 16:10:17', NULL, NULL, '西安', '7100000000', '上海', '3100000000', 0, '0', '0', '2014-12-13 16:10:17', 'xaadmin', 'xaadmin', '2014-12-13 16:10:17', 'xaadmin', '', NULL, 0, NULL, 0, NULL, NULL, NULL),
('bbb430010002', '10002', '5235780018', 0, 0, '123451234512234', 'unknown', NULL, NULL, 'B保险费二元', '2.0', '12000.0', '2000.0', '0.0', '0.0', 0, '0', 'xaadmin', NULL, NULL, '2014-12-13 16:11:19', 'EDA', '4310A', '43003F300025', 'AEEDAA2013ZJP', NULL, 1, NULL, 0, NULL, NULL, '43100302', 'bbb', 'bbb', 'bbb', 'bbb', 'bbb', '12000.0', '西安', NULL, '西安', '7100000000', '1', '2014-12-13 16:11:19', NULL, NULL, '西安', '7100000000', '上海', '3100000000', 0, '0', '0', '2014-12-13 16:11:19', 'xaadmin', 'xaadmin', '2014-12-13 16:11:19', 'xaadmin', 'unknown', NULL, 0, NULL, 0, NULL, NULL, NULL),
('bbb430010003', '10003', '5235780019', 0, 0, '123451234512345', 'unknown', NULL, NULL, 'B保险费二元', '2.0', '12000.0', '2000.0', '0.0', '0.0', 0, '0', 'xaadmin', NULL, NULL, '2014-12-13 16:11:19', 'EDA', '4310A', '43003F300025', 'AEEDAA2013ZJP', NULL, 1, NULL, 0, NULL, NULL, '43100302', 'bbb', 'bbb', 'bbb', 'bbb', 'bbb', '12000.0', '西安', NULL, '西安', '7100000000', '2', '2014-12-13 16:11:19', NULL, NULL, '西安', '7100000000', '上海', '3100000000', 0, '0', '0', '2014-12-13 16:11:19', 'xaadmin', 'xaadmin', '2014-12-13 16:11:19', 'xaadmin', 'unknown', NULL, 0, NULL, 0, NULL, NULL, NULL),
('bbb430010004', '10004', '5235780017', 1, 0, '123451234512345', 'unknown', NULL, NULL, 'B保险费二元', '2.0', '12000.0', '2000.0', '0.0', '0.0', 0, '0', 'xaadmin', NULL, NULL, '2014-12-13 16:14:30', 'EDA', '4310A', '43003F300025', 'AEEDAA2013ZJP', NULL, 1, NULL, 0, NULL, NULL, '43100302', 'bbb', 'bbb', 'bbb', 'bbb', 'bbb', '12000.0', '西安', NULL, '西安', '7100000000', '3', '2014-12-13 16:14:30', NULL, NULL, '西安', '7100000000', '上海', '3100000000', 0, '0', '0', '2014-12-13 16:14:30', 'xaadmin', 'xaadmin', '2014-12-13 16:14:30', 'xaadmin', 'unknown', NULL, 0, NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tms_sell_lockseat`
--

CREATE TABLE IF NOT EXISTS `tms_sell_lockseat` (
  `ls_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ls_LockID` varchar(20) NOT NULL,
  `ls_NoOfRunsID` varchar(20) DEFAULT NULL,
  `ls_NoOfRunsdate` char(10) DEFAULT NULL,
  `ls_FromStationID` varchar(20) DEFAULT NULL,
  `ls_FromStation` varchar(50) DEFAULT NULL,
  `ls_ReachStationID` varchar(20) DEFAULT NULL,
  `ls_ReachStation` varchar(50) DEFAULT NULL,
  `ls_TicketID` varchar(20) DEFAULT NULL,
  `ls_SeatID` int(11) DEFAULT NULL,
  `ls_Type` int(11) DEFAULT NULL,
  `ls_Price` decimal(12,1) DEFAULT NULL,
  `ls_sellID` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ls_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tms_sell_resetticket`
--

CREATE TABLE IF NOT EXISTS `tms_sell_resetticket` (
  `rt_ID` int(11) NOT NULL AUTO_INCREMENT,
  `rt_ResetUserID` varchar(20) DEFAULT NULL,
  `rt_ResetUser` varchar(30) DEFAULT NULL,
  `rt_UserSation` varchar(50) DEFAULT NULL,
  `rt_ResetDate` date DEFAULT NULL,
  `rt_BeginTicket` varchar(20) DEFAULT NULL,
  `rt_CurrentTicket` varchar(20) DEFAULT NULL,
  `rt_EndTicket` varchar(20) DEFAULT NULL,
  `rt_InceptTicketNum` int(11) DEFAULT NULL,
  `rt_Type` varchar(20) DEFAULT NULL,
  `rt_Remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rt_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tms_sell_resetticket`
--

INSERT INTO `tms_sell_resetticket` (`rt_ID`, `rt_ResetUserID`, `rt_ResetUser`, `rt_UserSation`, `rt_ResetDate`, `rt_BeginTicket`, `rt_CurrentTicket`, `rt_EndTicket`, `rt_InceptTicketNum`, `rt_Type`, `rt_Remark`) VALUES
(1, 'xaadmin', 'xaadmin', '西安', '2014-12-13', '5235780014', '5235780014', '5235780015', 2, '客票', 'test');

-- --------------------------------------------------------

--
-- 表的结构 `tms_sell_returnticket`
--

CREATE TABLE IF NOT EXISTS `tms_sell_returnticket` (
  `rtk_TicketID` varchar(20) NOT NULL,
  `rtk_ReturnTicketID` varchar(20) NOT NULL DEFAULT '',
  `rtk_ReturnType` varchar(50) DEFAULT NULL,
  `rtk_ReturnPrice` decimal(12,1) DEFAULT NULL,
  `rtk_SignTime` char(5) DEFAULT NULL,
  `rtk_SignDate` char(10) DEFAULT NULL,
  `rtk_SignUserID` varchar(20) DEFAULT NULL,
  `rtk_SignUser` varchar(30) DEFAULT NULL,
  `rtk_ReturnTime` char(6) DEFAULT NULL,
  `rtk_ReturnDate` char(10) DEFAULT NULL,
  `rtk_ReturnUserID` varchar(20) DEFAULT NULL,
  `rtk_ReturnUser` varchar(30) DEFAULT NULL,
  `rtk_ReturnRate` decimal(12,2) DEFAULT NULL,
  `rtk_SXPrice` decimal(12,1) DEFAULT NULL,
  `rtk_NoOfRunsID` varchar(20) DEFAULT NULL,
  `rtk_NoOfRunsdate` char(10) DEFAULT NULL,
  `rtk_BeginStationTime` char(5) DEFAULT NULL,
  `rtk_StopStationTime` char(5) DEFAULT NULL,
  `rtk_SellPrice` decimal(12,1) DEFAULT NULL,
  `rtk_SellPriceType` varchar(50) DEFAULT NULL,
  `rtk_SellDate` char(10) DEFAULT NULL,
  `rtk_SellTime` char(8) DEFAULT NULL,
  `rtk_SeatID` varchar(200) DEFAULT NULL,
  `rtk_FreeSeats` smallint(6) DEFAULT NULL,
  `rtk_SafetyTicketNumber` smallint(6) DEFAULT NULL,
  `rtk_BeginStationID` varchar(20) DEFAULT NULL,
  `rtk_BeginStation` varchar(50) DEFAULT NULL,
  `rtk_FromStationID` varchar(20) DEFAULT NULL,
  `rtk_FromStation` varchar(50) DEFAULT NULL,
  `rtk_ReachStationID` varchar(20) DEFAULT NULL,
  `rtk_ReachStation` varchar(50) DEFAULT NULL,
  `rtk_EndStationID` varchar(20) DEFAULT NULL,
  `rtk_EndStation` varchar(50) DEFAULT NULL,
  `rtk_StationID` varchar(20) DEFAULT NULL,
  `rtk_Station` varchar(50) DEFAULT NULL,
  `rtk_IsBalance` tinyint(4) DEFAULT NULL,
  `rtk_BalanceDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`rtk_ReturnTicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_sell_returnticket`
--

INSERT INTO `tms_sell_returnticket` (`rtk_TicketID`, `rtk_ReturnTicketID`, `rtk_ReturnType`, `rtk_ReturnPrice`, `rtk_SignTime`, `rtk_SignDate`, `rtk_SignUserID`, `rtk_SignUser`, `rtk_ReturnTime`, `rtk_ReturnDate`, `rtk_ReturnUserID`, `rtk_ReturnUser`, `rtk_ReturnRate`, `rtk_SXPrice`, `rtk_NoOfRunsID`, `rtk_NoOfRunsdate`, `rtk_BeginStationTime`, `rtk_StopStationTime`, `rtk_SellPrice`, `rtk_SellPriceType`, `rtk_SellDate`, `rtk_SellTime`, `rtk_SeatID`, `rtk_FreeSeats`, `rtk_SafetyTicketNumber`, `rtk_BeginStationID`, `rtk_BeginStation`, `rtk_FromStationID`, `rtk_FromStation`, `rtk_ReachStationID`, `rtk_ReachStation`, `rtk_EndStationID`, `rtk_EndStation`, `rtk_StationID`, `rtk_Station`, `rtk_IsBalance`, `rtk_BalanceDateTime`) VALUES
('5235780019', '5235780019', '开车前2小时', '450.0', '16:14', '2014-12-13', 'xaadmin', 'xaadmin', '16:15', '2014-12-13', 'xaadmin', 'xaadmin', '0.10', '50.0', 'XAPSHP0000', '2014-12-13', '08:00', '', '500.0', '全票', '2014-12-13', '16:11', '2', NULL, 10003, '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '7100000000', '西安', 1, '2014-12-13 16:32:24'),
('5235780020', '5235780020', '开车前2小时', '49.5', '16:20', '2014-12-13', 'xaadmin', 'xaadmin', '16:20', '2014-12-13', 'xaadmin', 'xaadmin', '0.10', '5.5', 'XAPCAS0000', '2014-12-13', '', '', '55.0', '全票', '2014-12-13', '16:19', '1', NULL, 0, '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '7100000000', '西安', 1, '2014-12-13 16:32:24');

-- --------------------------------------------------------

--
-- 表的结构 `tms_sell_returntype`
--

CREATE TABLE IF NOT EXISTS `tms_sell_returntype` (
  `rte_ReturnType` varchar(50) NOT NULL,
  `rte_ReturnRate` decimal(12,2) DEFAULT NULL,
  `rte_ReturnTimeBegin` char(10) DEFAULT NULL,
  `rte_ReturnTimeEnd` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_sell_returntype`
--

INSERT INTO `tms_sell_returntype` (`rte_ReturnType`, `rte_ReturnRate`, `rte_ReturnTimeBegin`, `rte_ReturnTimeEnd`) VALUES
('开车前2小时', '0.10', '2014-04-22', '2015-07-22'),
('开车前2小时以内', '0.20', '2014-04-22', '2015-07-22'),
('不扣', '0.00', '2014-04-22', '2015-07-22');

-- --------------------------------------------------------

--
-- 表的结构 `tms_sell_sellticket`
--

CREATE TABLE IF NOT EXISTS `tms_sell_sellticket` (
  `st_TicketID` varchar(20) NOT NULL,
  `st_NoOfRunsID` varchar(20) DEFAULT NULL,
  `st_LineID` varchar(30) DEFAULT NULL,
  `st_NoOfRunsdate` char(10) DEFAULT NULL,
  `st_BeginStationTime` char(5) DEFAULT NULL,
  `st_StopStationTime` char(5) DEFAULT NULL,
  `st_Distance` decimal(12,2) DEFAULT NULL,
  `st_BeginStationID` varchar(20) DEFAULT NULL,
  `st_BeginStation` varchar(50) DEFAULT NULL,
  `st_FromStationID` varchar(20) DEFAULT NULL,
  `st_FromStation` varchar(50) DEFAULT NULL,
  `st_ReachStationID` varchar(20) DEFAULT NULL,
  `st_ReachStation` varchar(50) DEFAULT NULL,
  `st_EndStationID` varchar(20) DEFAULT NULL,
  `st_EndStation` varchar(50) DEFAULT NULL,
  `st_SellPrice` decimal(12,1) DEFAULT NULL,
  `st_SellPriceType` varchar(50) DEFAULT NULL,
  `st_ColleSellPriceType` varchar(2000) DEFAULT NULL,
  `st_TotalMan` smallint(6) DEFAULT NULL,
  `st_FullPrice` decimal(12,1) DEFAULT NULL,
  `st_HalfPrice` decimal(12,1) DEFAULT NULL,
  `st_StandardPrice` decimal(12,1) DEFAULT NULL,
  `st_BalancePrice` decimal(12,1) DEFAULT NULL,
  `st_ServiceFee` decimal(12,2) DEFAULT NULL,
  `st_otherFee1` decimal(12,2) DEFAULT NULL,
  `st_otherFee2` decimal(12,2) DEFAULT NULL,
  `st_otherFee3` decimal(12,2) DEFAULT NULL,
  `st_otherFee4` decimal(12,2) DEFAULT NULL,
  `st_otherFee5` decimal(12,2) DEFAULT NULL,
  `st_otherFee6` decimal(12,2) DEFAULT NULL,
  `st_StationID` varchar(20) DEFAULT NULL,
  `st_Station` varchar(50) DEFAULT NULL,
  `st_SellDate` char(10) DEFAULT NULL,
  `st_SellTime` char(5) DEFAULT NULL,
  `st_BusModelID` varchar(50) DEFAULT NULL,
  `st_BusModel` varchar(50) DEFAULT NULL,
  `st_SeatID` varchar(200) DEFAULT NULL,
  `st_SellID` varchar(20) DEFAULT NULL,
  `st_SellName` varchar(30) DEFAULT NULL,
  `st_FreeSeats` smallint(6) DEFAULT NULL,
  `st_SafetyTicketID` varchar(20) DEFAULT NULL,
  `st_SafetyTicketNumber` smallint(6) DEFAULT NULL,
  `st_SafetyTicketMoney` decimal(12,2) DEFAULT NULL,
  `st_SafetyTicketPassengerID` varchar(20) DEFAULT NULL,
  `st_TicketState` smallint(6) DEFAULT NULL,
  `st_IsBalance` tinyint(4) DEFAULT NULL,
  `st_BalanceDateTime` datetime DEFAULT NULL,
  `st_AlterTicket` int(11) DEFAULT NULL,
  `st_StationBalance` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`st_TicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_sell_sellticket`
--

INSERT INTO `tms_sell_sellticket` (`st_TicketID`, `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, `st_BeginStationTime`, `st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, `st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, `st_SellPriceType`, `st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, `st_BalancePrice`, `st_ServiceFee`, `st_otherFee1`, `st_otherFee2`, `st_otherFee3`, `st_otherFee4`, `st_otherFee5`, `st_otherFee6`, `st_StationID`, `st_Station`, `st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, `st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, `st_TicketState`, `st_IsBalance`, `st_BalanceDateTime`, `st_AlterTicket`, `st_StationBalance`) VALUES
('5235780001', 'XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-11', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '全票', NULL, 1, '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-11', '11:34', '05', '中型中级', '1', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 0, NULL, 0, 0),
('5235780002', 'XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-11', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '全票', NULL, 1, '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-11', '11:51', '05', '中型中级', '2', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 0, NULL, 0, 0),
('5235780003', 'XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-11', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '全票', NULL, 1, '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-11', '12:50', '05', '中型中级', '3', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 0, NULL, 0, 0),
('5235780004', 'XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-11', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '全票', NULL, 1, '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-11', '12:52', '07', '大型普通', '1', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 0, NULL, 0, 0),
('5235780005', 'XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-12', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '全票', NULL, 1, '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-12', '10:15', '05', '中型中级', '1', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 0, NULL, 0, 0),
('5235780006', 'XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-12', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '全票', NULL, 1, '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-12', '10:15', '05', '中型中级', '2', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 0, NULL, 0, 0),
('5235780007', 'XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-12', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '全票', NULL, 1, '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-12', '10:16', '05', '中型中级', '3', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 0, NULL, 0, 0),
('5235780008', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-12', '16:33', '03', '小型中级', '1', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 0, NULL, 0, 0),
('5235780009', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-12', '16:33', '03', '小型中级', '2', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 0, NULL, 0, 0),
('5235780010', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-12', '16:33', '03', '小型中级', '3', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 0, NULL, 0, 0),
('5235780011', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-12', '16:33', '03', '小型中级', '4', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 0, NULL, 0, 0),
('5235780012', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-12', '16:33', '03', '小型中级', '5', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 0, NULL, 0, 0),
('5235780013', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-12', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-12', '16:35', '03', '小型中级', '6', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 0, NULL, 0, 0),
('5235780016', 'XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-13', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '全票', NULL, 1, '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-13', '16:10', '05', '中型中级', '1', 'xaadmin', 'xaadmin', 0, '10000', 1, '2.00', '123451234512345', 0, 1, '2014-12-13 16:32:24', 0, 0),
('5235780017', 'XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-13', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '全票', NULL, 1, '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-13', '16:10', '05', '中型中级', '2', 'xaadmin', 'xaadmin', 0, '10004', 1, '2.00', '123451234512345', 0, 1, '2014-12-13 16:32:24', 0, 0),
('5235780018', 'XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-13', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '全票', NULL, 1, '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-13', '16:11', '05', '中型中级', '1', 'xaadmin', 'xaadmin', 0, '10002', 1, '2.00', '123451234512234', 0, 1, '2014-12-13 16:32:24', 0, 0),
('5235780019', 'XAPSHP0000', 'XAPSHP710000000031000000000000', '2014-12-13', '08:00', '', '500.00', '7100000000', '西安', '7100000000', '西安', '3100000000', '上海', '3100000000', '上海', '500.0', '全票', NULL, 1, '500.0', '250.0', '500.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-13', '16:11', '05', '中型中级', '2', 'xaadmin', 'xaadmin', 0, '10003', 1, '2.00', '123451234512345', 0, 1, '2014-12-13 16:32:24', 0, 0),
('5235780020', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-13', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-13', '16:19', '03', '小型中级', '1', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 1, '2014-12-13 16:32:24', 0, 0),
('5235780021', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-13', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-13', '16:21', '03', '小型中级', '1', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 1, '2014-12-13 16:32:24', 0, 0),
('5235780022', 'XAPCDP0000', 'XAPCDP710000000051010000000000', '2014-12-13', '10:00', '06:00', '700.00', '7100000000', '西安', '7100000000', '西安', '5101000000', '成都', '5101000000', '成都', '300.0', '全票', NULL, 1, '300.0', '150.0', '300.0', '0.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-13', '16:24', '07', '大型普通', '1', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 1, '2014-12-13 16:32:24', 0, 0),
('5235780023', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-13', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-13', '16:26', '03', '小型中级', '2', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 1, '2014-12-13 16:32:24', 0, 0),
('5235780024', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-13', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-13', '16:27', '03', '小型中级', '3', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 1, '2014-12-13 16:32:24', 0, 0),
('5235780025', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-13', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-13', '16:29', '03', '小型中级', '4', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 1, '2014-12-13 16:32:24', 0, 0),
('5235780026', 'XAPCAS0000', 'XAPCAS710000000071010000000000', '2014-12-13', '', '', '60.00', '7100000000', '西安', '7100000000', '西安', '7101000000', '长安', '7101000000', '长安', '55.0', '全票', NULL, 1, '55.0', '27.5', '50.0', '50.0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7100000000', '西安', '2014-12-13', '16:29', '03', '小型中级', '4', 'xaadmin', 'xaadmin', 0, NULL, 0, '0.00', NULL, 0, 1, '2014-12-13 16:32:24', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tms_sell_selltickettemp`
--

CREATE TABLE IF NOT EXISTS `tms_sell_selltickettemp` (
  `stt_TicketID` varchar(20) NOT NULL,
  `stt_SeatID` varchar(50) DEFAULT NULL,
  `stt_NoOfRunsID` varchar(20) DEFAULT NULL,
  `stt_LineID` varchar(30) DEFAULT NULL,
  `stt_NoOfRunsdate` char(10) DEFAULT NULL,
  `stt_BeginStationTime` char(5) DEFAULT NULL,
  `stt_StopStationTime` char(5) DEFAULT NULL,
  `stt_Distance` decimal(12,2) DEFAULT NULL,
  `stt_BeginStationID` varchar(20) DEFAULT NULL,
  `stt_BeginStation` varchar(50) DEFAULT NULL,
  `stt_FromStationID` varchar(20) DEFAULT NULL,
  `stt_FromStation` varchar(50) DEFAULT NULL,
  `stt_ReachStationID` varchar(20) DEFAULT NULL,
  `stt_ReachStation` varchar(50) DEFAULT NULL,
  `stt_EndStationID` varchar(20) DEFAULT NULL,
  `stt_EndStation` varchar(50) DEFAULT NULL,
  `stt_SellPrice` decimal(12,1) DEFAULT NULL,
  `stt_SellPriceType` varchar(50) DEFAULT NULL,
  `stt_FullPrice` decimal(12,1) DEFAULT NULL,
  `stt_HalfPrice` decimal(12,1) DEFAULT NULL,
  `stt_StandardPrice` decimal(12,1) DEFAULT NULL,
  `stt_BalancePrice` decimal(12,1) DEFAULT NULL,
  `stt_ServiceFee` decimal(12,2) DEFAULT NULL,
  `stt_otherFee1` decimal(12,2) DEFAULT NULL,
  `stt_otherFee2` decimal(12,2) DEFAULT NULL,
  `stt_otherFee3` decimal(12,2) DEFAULT NULL,
  `stt_otherFee4` decimal(12,2) DEFAULT NULL,
  `stt_otherFee5` decimal(12,2) DEFAULT NULL,
  `stt_otherFee6` decimal(12,2) DEFAULT NULL,
  `stt_SellerStationID` varchar(20) DEFAULT NULL,
  `stt_SellerStation` varchar(50) DEFAULT NULL,
  `stt_BusModelID` varchar(20) DEFAULT NULL,
  `stt_BusModel` varchar(50) DEFAULT NULL,
  `stt_BusID` varchar(20) DEFAULT NULL,
  `stt_BusCard` varchar(20) DEFAULT NULL,
  `stt_SellID` varchar(20) DEFAULT NULL,
  `stt_SellName` varchar(30) DEFAULT NULL,
  `stt_SafetyTicketID` varchar(20) DEFAULT NULL,
  `stt_SafetyTicketNumber` smallint(6) DEFAULT NULL,
  `stt_SafetyTicketMoney` decimal(12,2) DEFAULT NULL,
  `stt_SafetyTicketPassengerID` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`stt_TicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_sf_checkitem`
--

CREATE TABLE IF NOT EXISTS `tms_sf_checkitem` (
  `ci_CheckItem` varchar(30) NOT NULL,
  `ci_CheckContent` varchar(100) NOT NULL,
  `ci_AdderID` varchar(20) DEFAULT NULL,
  `ci_Adder` varchar(30) DEFAULT NULL,
  `ci_Addertime` datetime DEFAULT NULL,
  `ci_ModerID` varchar(20) DEFAULT NULL,
  `ci_Moder` varchar(30) DEFAULT NULL,
  `ci_Modertime` datetime DEFAULT NULL,
  `ci_Remark` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_sf_checkitem`
--

INSERT INTO `tms_sf_checkitem` (`ci_CheckItem`, `ci_CheckContent`, `ci_AdderID`, `ci_Adder`, `ci_Addertime`, `ci_ModerID`, `ci_Moder`, `ci_Modertime`, `ci_Remark`) VALUES
('转向', '转向节及臂有裂纹和损伤', '', '', '2014-03-15 17:38:44', '', '', '2014-03-15 20:47:40', ''),
('转向', '转向横直接杆及球销有裂纹和损伤', '', '', '2014-03-15 17:40:18', '', '', '2014-03-15 20:51:18', ''),
('转向', '转向盘转动不灵活', '', '', '2014-03-15 20:54:19', NULL, NULL, NULL, ''),
('制动', '制动有漏油现象', '', '', '2014-03-15 20:57:03', NULL, NULL, NULL, ''),
('制动', '制动有漏气现象', '', '', '2014-03-15 20:57:23', NULL, NULL, NULL, ''),
('制动', '制动相关连接锁销不齐全', '', '', '2014-03-15 20:58:10', NULL, NULL, NULL, ''),
('制动', '驻车制动工作不正常', '', '', '2014-03-15 20:58:55', NULL, NULL, NULL, ''),
('制动', '气压表工作不正常', '', '', '2014-03-15 21:00:10', NULL, NULL, NULL, ''),
('传动', '离合器结合不平稳', '', '', '2014-03-15 21:01:22', NULL, NULL, NULL, ''),
('传动', '中间轴承和万向节有裂纹和松旷现象', '', '', '2014-03-15 21:02:02', NULL, NULL, NULL, ''),
('传动', '驱动桥壳有裂痕', '', '', '2014-03-15 21:02:56', NULL, NULL, NULL, ''),
('灯光电器', '前照灯无效', '', '', '2014-03-15 21:05:22', '', '', '2014-03-15 21:06:55', ''),
('灯光电器', '雾灯无效', '', '', '2014-03-15 21:06:07', '', '', '2014-03-15 21:07:13', ''),
('灯光电器', '转向信号灯无效', '', '', '2014-03-15 21:06:39', NULL, NULL, NULL, ''),
('灯光电器', '示廊灯无效', '', '', '2014-03-15 21:07:50', NULL, NULL, NULL, ''),
('灯光电器', '制动灯无效', '', '', '2014-03-15 21:08:08', NULL, NULL, NULL, ''),
('灯光电器', '前位灯无效', '', '', '2014-03-15 21:08:24', NULL, NULL, NULL, ''),
('灯光电器', '后位灯无效', '', '', '2014-03-15 21:09:04', NULL, NULL, NULL, ''),
('灯光电器', '危险报警闪光灯无效', '', '', '2014-03-15 21:09:23', NULL, NULL, NULL, ''),
('灯光电器', '雨挂器异常', '', '', '2014-03-15 21:09:50', NULL, NULL, NULL, ''),
('灯光电器', '喇叭工作异常', '', '', '2014-03-15 21:10:14', NULL, NULL, NULL, ''),
('灯光电器', '前挡玻璃异常', '', '', '2014-03-15 21:11:10', NULL, NULL, NULL, ''),
('轮胎', '轮胎有严重磨损', '', '', '2014-03-15 21:11:40', NULL, NULL, NULL, ''),
('轮胎', '轮胎有破裂和割伤', '', '', '2014-03-15 21:12:08', NULL, NULL, NULL, ''),
('轮胎', '气压不符合要求', '', '', '2014-03-15 21:12:50', NULL, NULL, NULL, ''),
('悬挂', '悬挂有松动', '', '', '2014-03-15 21:13:28', NULL, NULL, NULL, ''),
('悬挂', '悬挂移位', '', '', '2014-03-15 21:13:47', NULL, NULL, NULL, ''),
('悬挂', '悬挂断裂', '', '', '2014-03-15 21:14:12', NULL, NULL, NULL, ''),
('车身', '安全窗和安全门处没有醒目的红色标准和操作方法', '', '', '2014-03-15 21:15:07', NULL, NULL, NULL, ''),
('车身', '安全窗附近没备有便于取用的击碎玻璃的专用工具', '', '', '2014-03-15 21:16:26', NULL, NULL, NULL, ''),
('安全设施', '没有配备危险警告标志牌', '', '', '2014-03-15 21:17:30', NULL, NULL, NULL, ''),
('安全设施', '没有配备三角木', '', '', '2014-03-15 21:18:33', NULL, NULL, NULL, ''),
('安全设施', '没有配备防滑链', '', '', '2014-03-15 21:19:02', NULL, NULL, NULL, ''),
('GPS', 'GPS没按规定安装', '', '', '2014-03-15 21:19:38', NULL, NULL, NULL, ''),
('GPS', 'GPS工作异常', '', '', '2014-03-15 21:20:20', NULL, NULL, NULL, ''),
('其他设施', '润滑异常', '', '', '2014-03-15 21:21:10', NULL, NULL, NULL, ''),
('其他设施', '发动机漏油', '', '', '2014-03-15 21:21:44', NULL, NULL, NULL, ''),
('其他设施', '减速器漏油', '', '', '2014-03-15 21:22:01', NULL, NULL, NULL, ''),
('其他设施', '变速器漏油', '', '', '2014-03-15 21:22:23', NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_sf_outcheck`
--

CREATE TABLE IF NOT EXISTS `tms_sf_outcheck` (
  `oc_ID` int(11) NOT NULL AUTO_INCREMENT,
  `oc_BusID` varchar(20) DEFAULT NULL,
  `oc_BusCard` varchar(20) DEFAULT NULL,
  `oc_OutCheck_StationID` varchar(20) DEFAULT NULL,
  `oc_OutCheck_Station` varchar(50) DEFAULT NULL,
  `oc_OutCheck_User` varchar(50) DEFAULT NULL,
  `oc_PcUserID` varchar(20) DEFAULT NULL,
  `oc_PcUser` varchar(30) DEFAULT NULL,
  `oc_Result` varchar(50) DEFAULT NULL,
  `oc_CheckDate` datetime DEFAULT NULL,
  `oc_Item1` varchar(50) DEFAULT NULL,
  `oc_Item2` varchar(50) DEFAULT NULL,
  `oc_Item3` varchar(50) DEFAULT NULL,
  `oc_Item4` varchar(50) DEFAULT NULL,
  `oc_Item5` varchar(50) DEFAULT NULL,
  `oc_Item6` varchar(50) DEFAULT NULL,
  `oc_Item7` varchar(50) DEFAULT NULL,
  `oc_Item8` varchar(50) DEFAULT NULL,
  `oc_Item9` varchar(50) DEFAULT NULL,
  `oc_Item10` varchar(50) DEFAULT NULL,
  `oc_NoOfRunsID` varchar(50) DEFAULT NULL,
  `oc_RenNo` varchar(20) DEFAULT NULL,
  `oc_FreeSeats` varchar(20) DEFAULT NULL,
  `oc_Remark` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`oc_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tms_sf_safetycheck`
--

CREATE TABLE IF NOT EXISTS `tms_sf_safetycheck` (
  `sc_BusID` varchar(30) NOT NULL,
  `sc_BusCard` varchar(30) NOT NULL,
  `sc_BusType` varchar(30) DEFAULT NULL,
  `sc_StationID` varchar(30) NOT NULL,
  `sc_StationName` varchar(50) NOT NULL,
  `sc_InspectorName` varchar(20) DEFAULT NULL,
  `sc_UserID` varchar(30) NOT NULL,
  `sc_UserName` varchar(20) NOT NULL,
  `sc_Result` varchar(20) NOT NULL,
  `sc_CheckDate` date NOT NULL,
  `sc_CheckExpiredDate` date DEFAULT NULL,
  `sc_Item1` varchar(300) DEFAULT NULL,
  `sc_Item2` varchar(300) DEFAULT NULL,
  `sc_Item3` varchar(300) DEFAULT NULL,
  `sc_Item4` varchar(300) DEFAULT NULL,
  `sc_Item5` varchar(300) DEFAULT NULL,
  `sc_Item6` varchar(300) DEFAULT NULL,
  `sc_Item7` varchar(300) DEFAULT NULL,
  `sc_Item8` varchar(300) DEFAULT NULL,
  `sc_Item9` varchar(300) DEFAULT NULL,
  `sc_Item10` varchar(300) DEFAULT NULL,
  `sc_IsNoOfRunsID` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`sc_BusID`,`sc_CheckDate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_sf_safetycheck`
--

INSERT INTO `tms_sf_safetycheck` (`sc_BusID`, `sc_BusCard`, `sc_BusType`, `sc_StationID`, `sc_StationName`, `sc_InspectorName`, `sc_UserID`, `sc_UserName`, `sc_Result`, `sc_CheckDate`, `sc_CheckExpiredDate`, `sc_Item1`, `sc_Item2`, `sc_Item3`, `sc_Item4`, `sc_Item5`, `sc_Item6`, `sc_Item7`, `sc_Item8`, `sc_Item9`, `sc_Item10`, `sc_IsNoOfRunsID`) VALUES
('1011001', '陕A12345', '中型中级', '7100000000', '西安', '', 'xaadmin', 'xaadmin', '检验合格', '2014-12-13', '0000-00-00', '', '', '', '', '', '', '', '', '', '', 1),
('1011002', '陕B12345', '小型中级', '7100000000', '西安', '', 'xaadmin', 'xaadmin', '检验不合格', '2014-12-13', '0000-00-00', 'GPS没按规定安装；GPS工作异常；', '', '', '', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tms_sys_online`
--

CREATE TABLE IF NOT EXISTS `tms_sys_online` (
  `ol_UserID` varchar(20) NOT NULL,
  `ol_User` varchar(50) DEFAULT NULL,
  `ol_IF` varchar(50) DEFAULT NULL,
  `ol_Station` varchar(50) DEFAULT NULL,
  `ol_UserType` varchar(50) DEFAULT NULL,
  `ol_PcName` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ol_UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_sys_onlineuser`
--

CREATE TABLE IF NOT EXISTS `tms_sys_onlineuser` (
  `ui_UserID` varchar(20) NOT NULL,
  `ui_UserName` varchar(30) NOT NULL,
  `ui_UserGroupID` varchar(20) NOT NULL,
  `ui_UserGroup` varchar(20) NOT NULL,
  `ui_UserSationID` varchar(20) NOT NULL,
  `ui_UserSation` varchar(50) NOT NULL,
  `ui_UserState` varchar(20) DEFAULT NULL,
  `ui_LoginTime` varchar(50) DEFAULT NULL,
  `ui_LogoutTime` varchar(50) DEFAULT NULL,
  `ui_UserIP` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ui_UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_sys_onlineuser`
--

INSERT INTO `tms_sys_onlineuser` (`ui_UserID`, `ui_UserName`, `ui_UserGroupID`, `ui_UserGroup`, `ui_UserSationID`, `ui_UserSation`, `ui_UserState`, `ui_LoginTime`, `ui_LogoutTime`, `ui_UserIP`) VALUES
('admin', '超级管理员', '0', '管理员组', 'all', '全部车站', '下线', NULL, '2014-12-11   11:40:59', '10.4.8.6'),
('csadmin', 'csadmin', '0', '管理员组|', '4301000000', '长沙', '在线', '2014-12-09   14:08:19', NULL, '10.4.8.6'),
('fzl', 'fzl', '0', '管理员组|', '7100000000', '西安', '下线', NULL, '2014-12-11   13:59:38', '10.4.8.6'),
('xaadmin', 'xaadmin', '0', '管理员组|', '7100000000', '西安', '下线', NULL, '2014-12-13   16:38:38', '10.4.8.6');

-- --------------------------------------------------------

--
-- 表的结构 `tms_sys_usinfor`
--

CREATE TABLE IF NOT EXISTS `tms_sys_usinfor` (
  `ui_UserID` varchar(20) NOT NULL,
  `ui_UserPassword` varchar(50) NOT NULL,
  `ui_UserName` varchar(30) NOT NULL,
  `ui_UserGroupID` varchar(50) NOT NULL,
  `ui_UserGroup` varchar(200) NOT NULL,
  `ui_UserSationID` varchar(20) NOT NULL,
  `ui_UserSation` varchar(50) NOT NULL,
  `ui_Remark` varchar(200) DEFAULT NULL,
  `ui_opUserID` varchar(50) NOT NULL,
  PRIMARY KEY (`ui_UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tms_sys_usinfor`
--

INSERT INTO `tms_sys_usinfor` (`ui_UserID`, `ui_UserPassword`, `ui_UserName`, `ui_UserGroupID`, `ui_UserGroup`, `ui_UserSationID`, `ui_UserSation`, `ui_Remark`, `ui_opUserID`) VALUES
('admin', '7a43a5872b47f2394032377911b050f9 ', '超级管理员', '0', '管理员组', 'all', '全部车站', NULL, '系统'),
('csadmin', '96e79218965eb72c92a549dd5a330112', 'csadmin', '0', '管理员组|', '4301000000', '长沙', '', 'admin'),
('fzl', '96e79218965eb72c92a549dd5a330112', 'fzl', '0', '管理员组|', '7100000000', '西安', '', 'admin'),
('guest', '202cb962ac59075b964b07152d234b70', 'guest', '0', '管理员组|', '7100000000', '西安', '', 'xaadmin'),
('lyadmin', '96e79218965eb72c92a549dd5a330112', 'lyadmin', '0', '管理员组|', '7100000000', '西安', '', 'admin'),
('xaadmin', '96e79218965eb72c92a549dd5a330112', 'xaadmin', '0', '管理员组|', '7100000000', '西安', '', 'admin');

-- --------------------------------------------------------

--
-- 表的结构 `tms_sys_ustype`
--

CREATE TABLE IF NOT EXISTS `tms_sys_ustype` (
  `ut_UserType` varchar(20) NOT NULL,
  `ut_UserPerm` varchar(300) DEFAULT NULL,
  `ut_InStation` varchar(50) DEFAULT NULL,
  `ut_Remark` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_sys_wordbook`
--

CREATE TABLE IF NOT EXISTS `tms_sys_wordbook` (
  `wb_ID` int(11) NOT NULL AUTO_INCREMENT,
  `wb_Type` varchar(200) DEFAULT NULL,
  `wb_Intro` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`wb_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tms_sys_wordlog`
--

CREATE TABLE IF NOT EXISTS `tms_sys_wordlog` (
  `wl_DateTime` varchar(20) DEFAULT NULL,
  `wl_UserID` varchar(20) DEFAULT NULL,
  `wl_User` varchar(20) DEFAULT NULL,
  `wl_Windows` varchar(50) DEFAULT NULL,
  `wl_PcName` varchar(50) DEFAULT NULL,
  `wl_WordViscera` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tms_ticket_delresult`
--

CREATE TABLE IF NOT EXISTS `tms_ticket_delresult` (
  `dr_ID` int(11) NOT NULL AUTO_INCREMENT,
  `dr_Desp` varchar(30) DEFAULT NULL,
  `dr_mncode` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`dr_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tms_ticket_errdelresult`
--

CREATE TABLE IF NOT EXISTS `tms_ticket_errdelresult` (
  `er_ID` int(11) NOT NULL AUTO_INCREMENT,
  `er_Desp` varchar(30) DEFAULT NULL,
  `er_mncode` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`er_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `tms_ticket_errdelresult`
--

INSERT INTO `tms_ticket_errdelresult` (`er_ID`, `er_Desp`, `er_mncode`) VALUES
(1, '打印机故障', ''),
(2, '纸张破损', '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_ticket_resetresult`
--

CREATE TABLE IF NOT EXISTS `tms_ticket_resetresult` (
  `rr_ID` int(11) NOT NULL AUTO_INCREMENT,
  `rr_Desp` varchar(30) DEFAULT NULL,
  `rr_mncode` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`rr_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tms_ticket_resetresult`
--

INSERT INTO `tms_ticket_resetresult` (`rr_ID`, `rr_Desp`, `rr_mncode`) VALUES
(1, '票号出错', '');

-- --------------------------------------------------------

--
-- 表的结构 `tms_websell_websellticket`
--

CREATE TABLE IF NOT EXISTS `tms_websell_websellticket` (
  `wst_WebSellID` varchar(30) NOT NULL,
  `wst_UserName` varchar(30) NOT NULL,
  `wst_CertificateType` varchar(50) DEFAULT NULL,
  `wst_CertificateNumber` varchar(30) DEFAULT NULL,
  `wst_NoOfRunsID` varchar(20) DEFAULT NULL,
  `wst_LineID` varchar(30) DEFAULT NULL,
  `wst_NoOfRunsdate` char(10) DEFAULT NULL,
  `wst_BeginStationTime` char(5) DEFAULT NULL,
  `wst_StopStationTime` char(5) DEFAULT NULL,
  `wst_Distance` decimal(12,2) DEFAULT NULL,
  `wst_BeginStationID` varchar(20) DEFAULT NULL,
  `wst_BeginStation` varchar(50) DEFAULT NULL,
  `wst_FromStationID` varchar(20) DEFAULT NULL,
  `wst_FromStation` varchar(50) DEFAULT NULL,
  `wst_ReachStationID` varchar(20) DEFAULT NULL,
  `wst_ReachStation` varchar(50) DEFAULT NULL,
  `wst_EndStationID` varchar(20) DEFAULT NULL,
  `wst_EndStation` varchar(50) DEFAULT NULL,
  `wst_SellPrice` decimal(12,1) DEFAULT NULL,
  `wst_FullNumber` smallint(6) DEFAULT NULL,
  `wst_HalfNumber` smallint(6) DEFAULT NULL,
  `wst_TotalMan` smallint(6) DEFAULT NULL,
  `wst_SellPriceType` varchar(50) DEFAULT NULL,
  `wst_ColleSellPriceType` varchar(2000) DEFAULT NULL,
  `wst_FullPrice` decimal(12,1) DEFAULT NULL,
  `wst_HalfPrice` decimal(12,1) DEFAULT NULL,
  `wst_StandardPrice` decimal(12,1) DEFAULT NULL,
  `wst_BalancePrice` decimal(12,1) DEFAULT NULL,
  `wst_ServiceFee` decimal(12,2) DEFAULT NULL,
  `wst_otherFee1` decimal(12,2) DEFAULT NULL,
  `wst_otherFee2` decimal(12,2) DEFAULT NULL,
  `wst_otherFee3` decimal(12,2) DEFAULT NULL,
  `wst_otherFee4` decimal(12,2) DEFAULT NULL,
  `wst_otherFee5` decimal(12,2) DEFAULT NULL,
  `wst_otherFee6` decimal(12,2) DEFAULT NULL,
  `wst_SellDate` char(10) DEFAULT NULL,
  `wst_SellTime` char(8) DEFAULT NULL,
  `wst_BusModelID` varchar(50) DEFAULT NULL,
  `wst_BusModel` varchar(50) DEFAULT NULL,
  `wst_SeatID` varchar(200) DEFAULT NULL,
  `wst_TicketState` smallint(6) DEFAULT NULL,
  `wst_PayTradeNo` varchar(64) DEFAULT NULL,
  `wst_ReserveID` varchar(20) DEFAULT NULL,
  `wst_ReserveName` varchar(30) DEFAULT NULL,
  `wst_StationID` varchar(20) DEFAULT NULL,
  `wst_Station` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`wst_WebSellID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
