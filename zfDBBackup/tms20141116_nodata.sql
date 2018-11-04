-- MySQL dump 10.10
--
-- Host: localhost    Database: tms
-- ------------------------------------------------------
-- Server version	5.0.26-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tms_acct_BalanceInHand`
--

DROP TABLE IF EXISTS `tms_acct_BalanceInHand`;
CREATE TABLE `tms_acct_BalanceInHand` (
  `bh_BalanceNO` varchar(50) NOT NULL default '',
  `bh_BusID` varchar(20) default NULL,
  `bh_BusNumber` varchar(20) default NULL,
  `bh_BusUnit` varchar(50) default NULL,
  `bh_BusModelID` varchar(20) default NULL,
  `bh_BusModel` varchar(50) default NULL,
  `bh_NoOfRunsID` varchar(20) default NULL,
  `bh_LineID` varchar(30) default NULL,
  `bh_NoOfRunsdate` char(10) default NULL,
  `bh_BeginStationTime` char(5) default NULL,
  `bh_StopStationTime` char(5) default NULL,
  `bh_BeginStationID` varchar(20) default NULL,
  `bh_BeginStation` varchar(50) default NULL,
  `bh_FromStationID` varchar(20) default NULL,
  `bh_FromStation` varchar(50) default NULL,
  `bh_EndStationID` varchar(20) default NULL,
  `bh_EndStation` varchar(50) default NULL,
  `bh_ServiceFee` decimal(12,2) default NULL,
  `bh_otherFee1` decimal(12,2) default NULL,
  `bh_otherFee2` decimal(12,2) default NULL,
  `bh_otherFee3` decimal(12,2) default NULL,
  `bh_otherFee4` decimal(12,2) default NULL,
  `bh_otherFee5` decimal(12,2) default NULL,
  `bh_otherFee6` decimal(12,2) default NULL,
  `bh_CheckTotal` smallint(6) default NULL,
  `bh_TicketTotal` smallint(6) default NULL,
  `bh_PriceTotal` decimal(12,1) default NULL,
  `bh_SupTicketRen` int(11) default NULL,
  `bh_SupTicketMoney` decimal(12,1) default NULL,
  `bh_StationID` varchar(20) default NULL,
  `bh_Station` varchar(50) default NULL,
  `bh_UserID` varchar(20) default NULL,
  `bh_User` varchar(50) default NULL,
  `bh_Date` char(10) default NULL,
  `bh_Time` char(5) default NULL,
  `bh_State` varchar(50) default NULL,
  `bh_Type` varchar(50) default NULL,
  `bh_AccountID` varchar(50) default NULL,
  `bh_IsAccount` tinyint(4) NOT NULL,
  `bh_ConsignMoney` decimal(12,2) default NULL,
  `bh_BalanceMoney` decimal(12,2) default NULL,
  PRIMARY KEY  (`bh_BalanceNO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_acct_BalanceInHandTemp`
--

DROP TABLE IF EXISTS `tms_acct_BalanceInHandTemp`;
CREATE TABLE `tms_acct_BalanceInHandTemp` (
  `bht_BalanceNO` varchar(50) NOT NULL,
  `bht_BusID` varchar(20) default NULL,
  `bht_BusNumber` varchar(20) default NULL,
  `bht_BusUnit` varchar(50) default NULL,
  `bht_BusModelID` varchar(20) default NULL,
  `bht_BusModel` varchar(50) default NULL,
  `bht_NoOfRunsID` varchar(20) default NULL,
  `bht_LineID` varchar(30) default NULL,
  `bht_NoOfRunsdate` char(10) default NULL,
  `bht_BeginStationTime` char(5) default NULL,
  `bht_StopStationTime` char(5) default NULL,
  `bht_BeginStationID` varchar(20) default NULL,
  `bht_BeginStation` varchar(50) default NULL,
  `bht_FromStationID` varchar(20) default NULL,
  `bht_FromStation` varchar(50) default NULL,
  `bht_EndStationID` varchar(20) default NULL,
  `bht_EndStation` varchar(50) default NULL,
  `bht_ServiceFee` decimal(12,2) default NULL,
  `bht_otherFee1` decimal(12,2) default NULL,
  `bht_otherFee2` decimal(12,2) default NULL,
  `bht_otherFee3` decimal(12,2) default NULL,
  `bht_otherFee4` decimal(12,2) default NULL,
  `bht_otherFee5` decimal(12,2) default NULL,
  `bht_otherFee6` decimal(12,2) default NULL,
  `bht_CheckTotal` smallint(6) default NULL,
  `bht_TicketTotal` smallint(6) default NULL,
  `bht_PriceTotal` decimal(12,1) default NULL,
  `bht_SupTicketRen` int(11) default NULL,
  `bht_StationID` varchar(20) default NULL,
  `bht_Station` varchar(50) default NULL,
  `bht_UserID` varchar(20) default NULL,
  `bht_User` varchar(50) default NULL,
  `bht_Date` char(10) default NULL,
  `bht_Time` char(5) default NULL,
  `bht_State` varchar(50) default NULL,
  `bht_Type` varchar(50) default NULL,
  `bht_AccountID` varchar(50) default NULL,
  `bht_UserIDTemp` varchar(50) default NULL,
  `bht_UserTemp` varchar(50) default NULL,
  `bht_AddDateTime` datetime default NULL,
  `bht_ConsignMoney` decimal(12,2) default NULL,
  `bht_ReportDateTime` datetime default NULL,
  `bht_BalanceMoney` decimal(12,2) default NULL,
  PRIMARY KEY  (`bht_BalanceNO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_acct_BalanceList`
--

DROP TABLE IF EXISTS `tms_acct_BalanceList`;
CREATE TABLE `tms_acct_BalanceList` (
  `bl_BalanceNO` varchar(50) NOT NULL default '',
  `bl_ReachStationID` varchar(20) default NULL,
  `bl_ReachStation` varchar(50) default NULL,
  `bl_Distance` decimal(12,2) default NULL,
  `bl_SellPriceType` varchar(50) NOT NULL,
  `bl_SellPrice` decimal(12,1) NOT NULL,
  `bl_PriceTotal` decimal(12,1) default NULL,
  `bl_CheckTotal` smallint(6) default NULL,
  `bl_TicketTotal` smallint(6) default NULL,
  `bl_ServiceFee` decimal(12,2) default NULL,
  `bl_otherFee1` decimal(12,2) default NULL,
  `bl_otherFee2` decimal(12,2) default NULL,
  `bl_otherFee3` decimal(12,2) default NULL,
  `bl_otherFee4` decimal(12,2) default NULL,
  `bl_otherFee5` decimal(12,2) default NULL,
  `bl_otherFee6` decimal(12,2) default NULL,
  PRIMARY KEY  (`bl_BalanceNO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_acct_BalanceListTemp`
--

DROP TABLE IF EXISTS `tms_acct_BalanceListTemp`;
CREATE TABLE `tms_acct_BalanceListTemp` (
  `blt_ID` int(11) NOT NULL auto_increment,
  `blt_NoOfRunsID` varchar(20) default NULL,
  `blt_BusID` varchar(20) default NULL,
  `blt_BusNumber` varchar(20) default NULL,
  `blt_FromStationID` varchar(20) default NULL,
  `blt_FromStation` varchar(50) default NULL,
  `blt_ReachStationID` varchar(20) default NULL,
  `blt_ReachStation` varchar(50) default NULL,
  `blt_Distance` decimal(12,2) default NULL,
  `blt_SellPriceType` varchar(50) default NULL,
  `blt_SellPrice` decimal(12,1) default NULL,
  `blt_PriceTotal` decimal(12,1) default NULL,
  `blt_CheckTotal` smallint(6) default NULL,
  `blt_ServiceFee` decimal(12,2) default NULL,
  `blt_otherFee1` decimal(12,2) default NULL,
  `blt_otherFee2` decimal(12,2) default NULL,
  `blt_otherFee3` decimal(12,2) default NULL,
  `blt_otherFee4` decimal(12,2) default NULL,
  `blt_otherFee5` decimal(12,2) default NULL,
  `blt_otherFee6` decimal(12,2) default NULL,
  `blt_UserID` varchar(20) default NULL,
  `blt_User` varchar(30) default NULL,
  PRIMARY KEY  (`blt_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_acct_BusAccount`
--

DROP TABLE IF EXISTS `tms_acct_BusAccount`;
CREATE TABLE `tms_acct_BusAccount` (
  `ba_AccountID` varchar(50) NOT NULL,
  `ba_BusID` varchar(20) default NULL,
  `ba_BusNumber` varchar(20) default NULL,
  `ba_BusType` varchar(50) default NULL,
  `ba_BusUnit` varchar(50) default NULL,
  `ba_InStationID` varchar(20) default NULL,
  `ba_InStation` varchar(50) default NULL,
  `ba_BalanceCount` int(11) default NULL,
  `ba_CheckTotal` int(11) default NULL,
  `ba_Income` decimal(12,1) default NULL,
  `ba_Paid` decimal(12,1) default NULL,
  `ba_ServiceFee` decimal(12,2) default NULL,
  `ba_OtherFee1` decimal(12,2) default NULL,
  `ba_OtherFee2` decimal(12,2) default NULL,
  `ba_OtherFee3` decimal(12,2) default NULL,
  `ba_OtherFee4` decimal(12,2) default NULL,
  `ba_OtherFee5` decimal(12,2) default NULL,
  `ba_OtherFee6` decimal(12,2) default NULL,
  `ba_Money1` decimal(12,1) default NULL,
  `ba_Money2` decimal(12,1) default NULL,
  `ba_Money3` decimal(12,1) default NULL,
  `ba_Money4` decimal(12,1) default NULL,
  `ba_Money5` decimal(12,1) default NULL,
  `ba_Money6` decimal(12,1) default NULL,
  `ba_Money7` decimal(12,1) default NULL,
  `ba_Money8` decimal(12,1) default NULL,
  `ba_Money9` decimal(12,1) default NULL,
  `ba_Money10` decimal(12,1) default NULL,
  `ba_Money11` decimal(12,1) default NULL,
  `ba_Money12` decimal(12,1) default NULL,
  `ba_Money13` decimal(12,1) default NULL,
  `ba_Money14` decimal(12,1) default NULL,
  `ba_Money15` decimal(12,1) default NULL,
  `ba_Rate1` decimal(12,2) default NULL,
  `ba_Rate2` decimal(12,2) default NULL,
  `ba_Rate3` decimal(12,2) default NULL,
  `ba_Rate4` decimal(12,2) default NULL,
  `ba_Rate5` decimal(12,2) default NULL,
  `ba_Rate6` decimal(12,2) default NULL,
  `ba_Rate7` decimal(12,2) default NULL,
  `ba_Rate8` decimal(12,2) default NULL,
  `ba_Rate9` decimal(12,2) default NULL,
  `ba_Rate10` decimal(12,2) default NULL,
  `ba_Rate11` decimal(12,2) default NULL,
  `ba_Rate12` decimal(12,2) default NULL,
  `ba_Rate13` decimal(12,2) default NULL,
  `ba_Rate14` decimal(12,2) default NULL,
  `ba_Rate15` decimal(12,2) default NULL,
  `ba_DateTime` datetime default NULL,
  `ba_UserID` varchar(20) default NULL,
  `ba_User` varchar(30) default NULL,
  `ba_Remark` varchar(200) default NULL,
  `ba_FeeTypeName15` varchar(20) default NULL,
  `ba_FeeTypeName14` varchar(20) default NULL,
  `ba_FeeTypeName13` varchar(20) default NULL,
  `ba_FeeTypeName12` varchar(20) default NULL,
  `ba_FeeTypeName11` varchar(20) default NULL,
  `ba_FeeTypeName10` varchar(20) default NULL,
  `ba_FeeTypeName9` varchar(20) default NULL,
  `ba_FeeTypeName8` varchar(20) default NULL,
  `ba_FeeTypeName7` varchar(20) default NULL,
  `ba_FeeTypeName6` varchar(20) default NULL,
  `ba_FeeTypeName5` varchar(20) default NULL,
  `ba_FeeTypeName4` varchar(20) default NULL,
  `ba_FeeTypeName3` varchar(20) default NULL,
  `ba_FeeTypeName2` varchar(20) default NULL,
  `ba_FeeTypeName1` varchar(20) default NULL,
  PRIMARY KEY  (`ba_AccountID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_acct_BusAccountTemp`
--

DROP TABLE IF EXISTS `tms_acct_BusAccountTemp`;
CREATE TABLE `tms_acct_BusAccountTemp` (
  `bat_AccountID` varchar(50) NOT NULL,
  `bat_BusID` varchar(20) default NULL,
  `bat_BusNumber` varchar(20) default NULL,
  `bat_BusType` varchar(50) default NULL,
  `bat_BusUnit` varchar(50) default NULL,
  `bat_BalanceCount` int(11) default NULL,
  `bat_CheckTotal` int(11) default NULL,
  `bat_Income` decimal(12,1) default NULL,
  `bat_Paid` decimal(12,1) default NULL,
  `bat_ServiceFee` decimal(12,2) default NULL,
  `bat_OtherFee1` decimal(12,2) default NULL,
  `bat_OtherFee2` decimal(12,2) default NULL,
  `bat_OtherFee3` decimal(12,2) default NULL,
  `bat_OtherFee4` decimal(12,2) default NULL,
  `bat_OtherFee5` decimal(12,2) default NULL,
  `bat_OtherFee6` decimal(12,2) default NULL,
  `bat_Money1` decimal(12,1) default NULL,
  `bat_Money2` decimal(12,1) default NULL,
  `bat_Money3` decimal(12,1) default NULL,
  `bat_Money4` decimal(12,1) default NULL,
  `bat_Money5` decimal(12,1) default NULL,
  `bat_Money6` decimal(12,1) default NULL,
  `bat_Money7` decimal(12,1) default NULL,
  `bat_Money8` decimal(12,1) default NULL,
  `bat_Money9` decimal(12,1) default NULL,
  `bat_Money10` decimal(12,1) default NULL,
  `bat_Money11` decimal(12,1) default NULL,
  `bat_Money12` decimal(12,1) default NULL,
  `bat_Money13` decimal(12,1) default NULL,
  `bat_Money14` decimal(12,1) default NULL,
  `bat_Money15` decimal(12,1) default NULL,
  `bat_Rate1` decimal(12,2) default NULL,
  `bat_Rate2` decimal(12,2) default NULL,
  `bat_Rate3` decimal(12,2) default NULL,
  `bat_Rate4` decimal(12,2) default NULL,
  `bat_Rate5` decimal(12,2) default NULL,
  `bat_Rate6` decimal(12,2) default NULL,
  `bat_Rate7` decimal(12,2) default NULL,
  `bat_Rate8` decimal(12,2) default NULL,
  `bat_Rate9` decimal(12,2) default NULL,
  `bat_Rate10` decimal(12,2) default NULL,
  `bat_Rate11` decimal(12,2) default NULL,
  `bat_Rate12` decimal(12,2) default NULL,
  `bat_Rate13` decimal(12,2) default NULL,
  `bat_Rate14` decimal(12,2) default NULL,
  `bat_Rate15` decimal(12,2) default NULL,
  `bat_UserID` varchar(20) default NULL,
  `bat_User` varchar(30) default NULL,
  `bat_Remark` varchar(200) default NULL,
  PRIMARY KEY  (`bat_AccountID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_acct_BusRate`
--

DROP TABLE IF EXISTS `tms_acct_BusRate`;
CREATE TABLE `tms_acct_BusRate` (
  `br_BusID` varchar(20) NOT NULL,
  `br_BusNumber` varchar(20) default NULL,
  `br_BusType` varchar(50) default NULL,
  `br_BusUnit` varchar(50) default NULL,
  `br_InStationID` varchar(20) NOT NULL,
  `br_InStation` varchar(50) default NULL,
  `br_LineName` varchar(50) default NULL,
  `br_Rate1` decimal(12,2) default NULL,
  `br_Rate2` decimal(12,2) default NULL,
  `br_Rate3` decimal(12,2) default NULL,
  `br_Rate4` decimal(12,2) default NULL,
  `br_Rate5` decimal(12,2) default NULL,
  `br_Rate6` decimal(12,2) default NULL,
  `br_Rate7` decimal(12,2) default NULL,
  `br_Rate8` decimal(12,2) default NULL,
  `br_Rate9` decimal(12,2) default NULL,
  `br_Rate10` decimal(12,2) default NULL,
  `br_Rate11` decimal(12,2) default NULL,
  `br_Rate12` decimal(12,2) default NULL,
  `br_Rate13` decimal(12,2) default NULL,
  `br_Rate14` decimal(12,2) default NULL,
  `br_Rate15` decimal(12,2) default NULL,
  `br_BeginDate` char(10) default NULL,
  `br_EndDate` char(10) default NULL,
  `br_AdderID` varchar(20) default NULL,
  `br_Adder` varchar(30) default NULL,
  `br_AddTime` datetime default NULL,
  `br_ModerID` varchar(20) default NULL,
  `br_Moder` varchar(30) default NULL,
  `br_ModTime` datetime default NULL,
  PRIMARY KEY  (`br_BusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_acct_SellPay`
--

DROP TABLE IF EXISTS `tms_acct_SellPay`;
CREATE TABLE `tms_acct_SellPay` (
  `sp_SellUserID` varchar(20) NOT NULL,
  `sp_SellUser` varchar(30) default NULL,
  `sp_Station` varchar(50) default NULL,
  `sp_SellDate` char(10) NOT NULL,
  `sp_RemainMoney` decimal(12,1) default NULL,
  `sp_BeginTicket` varchar(20) default NULL,
  `sp_EndTicket` varchar(20) default NULL,
  `sp_SellMoney` decimal(12,1) default NULL,
  `sp_SellCount` int(11) default NULL,
  `sp_ErrMoney` decimal(12,1) default NULL,
  `sp_ErrCount` int(11) default NULL,
  `sp_ReturnMoney` decimal(12,1) default NULL,
  `sp_ReturnCount` int(11) default NULL,
  `sp_ReturnRate` decimal(12,2) default NULL,
  `sp_SafetyMoney` decimal(12,1) default NULL,
  `sp_SafetyCount` int(11) default NULL,
  `sp_UpCount` int(11) default NULL,
  `sp_UpMoney` decimal(12,1) default NULL,
  `sp_PayMoney` decimal(12,1) default NULL,
  `sp_UserID` varchar(20) default NULL,
  `sp_User` varchar(30) default NULL,
  `sp_Pc` varchar(50) default NULL,
  `sp_Date` date default NULL,
  `sp_Remark` varchar(200) default NULL,
  PRIMARY KEY  (`sp_SellUserID`,`sp_SellDate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_acct_StationBalance`
--

DROP TABLE IF EXISTS `tms_acct_StationBalance`;
CREATE TABLE `tms_acct_StationBalance` (
  `sb_ID` int(11) NOT NULL auto_increment,
  `sb_FStationID` varchar(20) default NULL,
  `sb_FStation` varchar(50) default NULL,
  `sb_FTicketNum` int(11) default NULL,
  `sb_FTicketMoney` decimal(12,2) default NULL,
  `sb_FLuggageNum` int(11) default NULL,
  `sb_FLuggageMoney` decimal(12,2) default NULL,
  `sb_SStationID` varchar(20) default NULL,
  `sb_SStation` varchar(50) default NULL,
  `sb_STicketNum` int(11) default NULL,
  `sb_STicketMoney` decimal(12,2) default NULL,
  `sb_SLuggageNum` int(11) default NULL,
  `sb_SLuggageMoney` decimal(12,2) default NULL,
  `sb_BeginDate` char(10) default NULL,
  `sb_EndDate` char(10) default NULL,
  `sb_Money` decimal(12,2) default NULL,
  `sb_BalanceID` varchar(20) default NULL,
  `sb_Balancer` varchar(30) default NULL,
  `sb_BalanceDate` char(10) default NULL,
  `sb_BalanceTime` char(5) default NULL,
  PRIMARY KEY  (`sb_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_acct_TemPay`
--

DROP TABLE IF EXISTS `tms_acct_TemPay`;
CREATE TABLE `tms_acct_TemPay` (
  `tp_SellData` char(10) NOT NULL,
  `tp_SellUserID` varchar(20) NOT NULL,
  `tp_SellUser` varchar(30) default NULL,
  `tp_Station` varchar(50) default NULL,
  `tp_RemainMoney` decimal(12,1) default NULL,
  `tp_BeginTicket` varchar(20) default NULL,
  `tp_EndTicket` varchar(20) default NULL,
  `tp_SellMoney` decimal(12,1) default NULL,
  `tp_SellCount` int(11) default NULL,
  `tp_ErrMoney` decimal(12,1) default NULL,
  `tp_ErrCount` int(11) default NULL,
  `tp_ReturnMoney` decimal(12,1) default NULL,
  `tp_ReturnCount` decimal(12,1) default NULL,
  `tp_ReturnRate` decimal(12,2) default NULL,
  `tp_SafetyMoney` decimal(12,1) default NULL,
  `tp_SafetyCount` int(11) default NULL,
  `tp_UpCount` int(11) default NULL,
  `tp_UpMoney` decimal(12,1) default NULL,
  `tp_OnLine` varchar(50) default NULL,
  `tp_UserID` varchar(20) NOT NULL,
  `tp_User` varchar(30) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_AdOrg`
--

DROP TABLE IF EXISTS `tms_bd_AdOrg`;
CREATE TABLE `tms_bd_AdOrg` (
  `ao_ID` int(11) NOT NULL auto_increment,
  `ao_OrgCode` varchar(20) default NULL,
  `ao_OrgName` varchar(100) default NULL,
  `ao_HelpCode` varchar(10) default NULL,
  `ao_AdderID` varchar(20) default NULL,
  `ao_Adder` varchar(30) default NULL,
  `ao_AddTime` datetime default NULL,
  `ao_ModerID` varchar(20) default NULL,
  `ao_Moder` varchar(30) default NULL,
  `ao_ModTime` datetime default NULL,
  `ao_Remark` varchar(50) default NULL,
  PRIMARY KEY  (`ao_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_AddPrice`
--

DROP TABLE IF EXISTS `tms_bd_AddPrice`;
CREATE TABLE `tms_bd_AddPrice` (
  `ap_NoOfRunsID` varchar(20) NOT NULL,
  `ap_FromStationID` varchar(20) NOT NULL,
  `ap_FromStation` varchar(50) default NULL,
  `ap_ReachStationID` varchar(20) NOT NULL,
  `ap_ReachStation` varchar(50) default NULL,
  `ap_Distance` decimal(12,2) default NULL,
  `ap_FullPrice` decimal(12,1) default NULL,
  `ap_HalfPrice` decimal(12,1) default NULL,
  `ap_StandardPrice` decimal(12,1) default NULL,
  `ap_UserID` varchar(20) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_AgioType`
--

DROP TABLE IF EXISTS `tms_bd_AgioType`;
CREATE TABLE `tms_bd_AgioType` (
  `at_AgioName` varchar(50) NOT NULL,
  `at_Agio` decimal(12,2) default NULL,
  `at_Remark` varchar(100) default NULL,
  PRIMARY KEY  (`at_AgioName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_BusArt`
--

DROP TABLE IF EXISTS `tms_bd_BusArt`;
CREATE TABLE `tms_bd_BusArt` (
  `ba_BusID` varchar(50) NOT NULL,
  `ba_BusNumber` varchar(50) default NULL,
  `ba_EJWFDate` char(10) default NULL,
  `ba_ChangeInfo` varchar(50) default NULL,
  `ba_OkRankDate` char(10) default NULL,
  `ba_Remark` varchar(200) default NULL,
  PRIMARY KEY  (`ba_BusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_BusCard`
--

DROP TABLE IF EXISTS `tms_bd_BusCard`;
CREATE TABLE `tms_bd_BusCard` (
  `bc_CardID` varchar(20) NOT NULL,
  `bc_BusID` varchar(20) default NULL,
  `bc_BusNumber` varchar(20) default NULL,
  `bc_RegDate` char(10) default NULL,
  `bc_state` varchar(50) default NULL,
  `bc_StationID` varchar(20) default NULL,
  `bc_Station` varchar(50) default NULL,
  `bc_Remark` varchar(200) default NULL,
  `bc_addpeople` varchar(20) default NULL,
  `bc_moddate` varchar(20) default NULL,
  `bc_modpeople` varchar(20) default NULL,
  `bc_modderID` varchar(20) default NULL,
  `bc_adderID` varchar(20) default NULL,
  PRIMARY KEY  (`bc_CardID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_BusInfo`
--

DROP TABLE IF EXISTS `tms_bd_BusInfo`;
CREATE TABLE `tms_bd_BusInfo` (
  `bi_BusID` varchar(20) NOT NULL,
  `bi_BusNumber` varchar(20) default NULL,
  `bi_BusUnit` varchar(50) default NULL,
  `bi_SeatS` tinyint(4) default NULL,
  `bi_AddSeatS` tinyint(4) default NULL,
  `bi_AllowHalfSeats` tinyint(4) default NULL,
  `bi_DriverID` varchar(20) default NULL,
  `bi_Driver` varchar(30) default NULL,
  `bi_Driver1ID` varchar(20) default NULL,
  `bi_Driver1` varchar(30) default NULL,
  `bi_Driver2ID` varchar(20) default NULL,
  `bi_Driver2` varchar(30) default NULL,
  `bi_RegDate` char(10) default NULL,
  `bi_Tonnage` tinyint(4) default NULL,
  `bi_OwnerName` varchar(30) default NULL,
  `bi_OwnerAdd` varchar(50) default NULL,
  `bi_OwnerTel` varchar(20) default NULL,
  `bi_OwnerIdCard` varchar(50) default NULL,
  `bi_BusTypeID` varchar(20) default NULL,
  `bi_BusType` varchar(50) default NULL,
  `bi_EngineType` varchar(50) default NULL,
  `bi_EngineNumber` varchar(50) default NULL,
  `bi_BusIdentify` char(25) default NULL,
  `bi_BusChangeType` varchar(50) default NULL,
  `bi_Remark` varchar(200) default NULL,
  `bi_IsSafetyCheck` varchar(50) default NULL,
  `bi_InsuranceNo` varchar(50) default NULL,
  `bi_InsuranceCompany` varchar(50) default NULL,
  `bi_InsuranceDate` char(10) default NULL,
  `bi_TransportationBeginDate` char(10) default NULL,
  `bi_TransportationEndDate` char(10) default NULL,
  `bi_TradeBeginDate` char(10) default NULL,
  `bi_TradeEndDate` char(10) default NULL,
  `bi_RenBeginDate` char(10) default NULL,
  `bi_RenEndDate` char(10) default NULL,
  `bi_ManagementLine` varchar(50) default NULL,
  `bi_LineLicense` varchar(50) default NULL,
  `bi_LineLicenseAttached` varchar(50) default NULL,
  `bi_AttachedEndDate` char(10) default NULL,
  `bi_Business` varchar(50) default NULL,
  `bi_SpringCheckEndDate` char(10) default NULL,
  `bi_ExaminationEndDate` char(10) default NULL,
  `bi_TwoEndDate` char(10) default NULL,
  `bi_RankEndDate` char(10) default NULL,
  `bi_TravelEndDate` char(10) default NULL,
  `bi_MonthEndDate` char(10) default NULL,
  `bi_CNGEndDate` char(10) default NULL,
  `bi_Sign` varchar(50) default NULL,
  `bi_InStationID` varchar(20) default NULL,
  `bi_InStation` varchar(20) default NULL,
  `bi_AdderID` varchar(20) default NULL,
  `bi_Adder` varchar(30) default NULL,
  `bi_AddTime` datetime default NULL,
  `bi_ModerID` varchar(20) default NULL,
  `bi_Moder` varchar(30) default NULL,
  `bi_ModTime` datetime default NULL,
  `bi_VehicleDrivingEndDate` char(10) default NULL,
  `bi_VehicleDriving` varchar(50) default NULL,
  `bi_RoadTransportEndDate` char(10) default NULL,
  `bi_RoadTransport` varchar(50) default NULL,
  `bi_ScanPath` varchar(100) default NULL,
  `bi_fileName` varchar(100) default NULL,
  PRIMARY KEY  (`bi_BusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_BusModel`
--

DROP TABLE IF EXISTS `tms_bd_BusModel`;
CREATE TABLE `tms_bd_BusModel` (
  `bm_ModelID` varchar(20) NOT NULL,
  `bm_ModelName` varchar(50) default NULL,
  `bm_Rank` varchar(20) default NULL,
  `bm_Category` varchar(10) default NULL,
  `bm_Seating` int(11) default NULL,
  `bm_AddSeating` int(11) default NULL,
  `bm_AllowHalfSeats` int(11) default NULL,
  `bm_Weight` int(11) default NULL,
  `bm_AdderID` varchar(20) default NULL,
  `bm_Adder` varchar(30) default NULL,
  `bm_AddTime` datetime default NULL,
  `bm_ModerID` varchar(20) default NULL,
  `bm_Moder` varchar(30) default NULL,
  `bm_ModTime` datetime default NULL,
  `bm_Closing` decimal(12,2) default NULL,
  `bm_Remark` varchar(200) default NULL,
  PRIMARY KEY  (`bm_ModelID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_BusUnit`
--

DROP TABLE IF EXISTS `tms_bd_BusUnit`;
CREATE TABLE `tms_bd_BusUnit` (
  `bu_ID` int(11) NOT NULL auto_increment,
  `bu_UnitName` varchar(200) NOT NULL,
  `bu_UnitProperty` varchar(50) default NULL,
  `bu_UnitContacts` varchar(30) default NULL,
  `bu_UnitPhone` varchar(20) default NULL,
  `bu_UnitAdress` varchar(200) default NULL,
  `bu_Remark` varchar(500) default NULL,
  PRIMARY KEY  (`bu_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_BusUnitShell`
--

DROP TABLE IF EXISTS `tms_bd_BusUnitShell`;
CREATE TABLE `tms_bd_BusUnitShell` (
  `bus_ID` int(11) NOT NULL auto_increment,
  `bus_ShellID` varchar(50) default NULL,
  `bus_Shell` varchar(50) default NULL,
  `bus_BusUnit` varchar(500) default NULL,
  PRIMARY KEY  (`bus_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_CharteredBus`
--

DROP TABLE IF EXISTS `tms_bd_CharteredBus`;
CREATE TABLE `tms_bd_CharteredBus` (
  `cb_ChartereID` varchar(20) NOT NULL,
  `cb_TicketID` varchar(20) default NULL,
  `cb_Customer` varchar(50) NOT NULL,
  `cb_BusID` varchar(20) default NULL,
  `cb_BusNumber` varchar(20) default NULL,
  `cb_DriverID` varchar(30) default NULL,
  `cb_DriverName` varchar(30) default NULL,
  `cb_CharteredBusDate` char(10) default NULL,
  `cb_CharteredBusDays` int(11) default NULL,
  `cb_FromReach` varchar(50) default NULL,
  `cb_Kilometers` decimal(12,1) default NULL,
  `cb_Seats` int(11) default NULL,
  `cb_Peoples` int(11) default NULL,
  `cb_CarriageFee` decimal(12,1) default NULL,
  `cb_StagnateFee` decimal(12,1) default NULL,
  `cb_BillingDate` char(10) default NULL,
  `cb_BillingStation` varchar(50) default NULL,
  `cb_BillingerID` varchar(30) default NULL,
  `cb_BillingerName` varchar(30) default NULL,
  `cb_State` tinyint(4) default NULL,
  `cb_Remark` varchar(50) default NULL,
  `cb_IsBalance` tinyint(4) default NULL,
  `cb_BalanceDateTime` datetime default NULL,
  PRIMARY KEY  (`cb_ChartereID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_CharteredPayMoney`
--

DROP TABLE IF EXISTS `tms_bd_CharteredPayMoney`;
CREATE TABLE `tms_bd_CharteredPayMoney` (
  `cpm_ID` int(11) NOT NULL auto_increment,
  `cpm_BillingerID` varchar(30) NOT NULL,
  `cpm_BillingerName` varchar(30) default NULL,
  `cpm_BillingDate` char(10) default NULL,
  `cpm_beginTicketID` varchar(20) default NULL,
  `cpm_endTicketID` varchar(20) default NULL,
  `cpm_Number` int(11) default NULL,
  `cpm_PayMoney` decimal(12,1) default NULL,
  `cpm_BillingStation` varchar(50) default NULL,
  `cpm_UserID` varchar(30) default NULL,
  `cpm_User` varchar(30) default NULL,
  `cpm_SubDateTime` datetime default NULL,
  `cpm_PC` varchar(50) default NULL,
  `cpm_Remark` varchar(200) default NULL,
  PRIMARY KEY  (`cpm_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_DelTicket`
--

DROP TABLE IF EXISTS `tms_bd_DelTicket`;
CREATE TABLE `tms_bd_DelTicket` (
  `dt_ID` int(11) NOT NULL auto_increment,
  `dt_InceptUserID` varchar(20) default NULL,
  `dt_InceptUser` varchar(30) default NULL,
  `dt_UserSation` varchar(50) default NULL,
  `dt_ProvideDate` char(10) default NULL,
  `dt_BeginTicket` varchar(20) default NULL,
  `dt_EndTicket` varchar(20) default NULL,
  `dt_DelTicketNum` int(11) default NULL,
  `dt_Type` varchar(20) default NULL,
  `dt_DeleteTime` datetime default NULL,
  `dt_DeletorID` varchar(20) default NULL,
  `dt_DeletorName` varchar(30) default NULL,
  `dt_DeletorSation` varchar(50) default NULL,
  `dt_DeletorSationID` varchar(50) default NULL,
  `dt_DelReason` varchar(100) default NULL,
  PRIMARY KEY  (`dt_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_DriverInfo`
--

DROP TABLE IF EXISTS `tms_bd_DriverInfo`;
CREATE TABLE `tms_bd_DriverInfo` (
  `di_DriverID` varchar(50) NOT NULL,
  `di_Name` varchar(50) default NULL,
  `di_Sex` varchar(50) default NULL,
  `di_Tel` varchar(50) default NULL,
  `di_IdCard` varchar(50) default NULL,
  `di_CYZGZNumber` varchar(50) default NULL,
  `di_Photo` varchar(200) default NULL,
  `di_BusNumber` varchar(50) default NULL,
  `di_DriverCard` varchar(50) default NULL,
  `di_AllowBusType` varchar(50) default NULL,
  `di_DriverCheckDate` char(10) default NULL,
  `di_CYZGZCheckDate` char(10) default NULL,
  `di_Remark` varchar(200) default NULL,
  `di_WorkEndDate` char(10) default NULL,
  `di_FileID` varchar(50) default NULL,
  `di_Finger` varchar(8000) default NULL,
  `di_Address` varchar(200) default NULL,
  `di_AdderID` varchar(20) default NULL,
  `di_Adder` varchar(30) default NULL,
  `di_AddTime` datetime default NULL,
  `di_ModerID` varchar(20) default NULL,
  `di_Moder` varchar(30) default NULL,
  `di_ModTime` datetime default NULL,
  `di_fileName` varchar(50) default NULL,
  `di_ScanPath` varchar(100) default NULL,
  PRIMARY KEY  (`di_DriverID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_FeeType`
--

DROP TABLE IF EXISTS `tms_bd_FeeType`;
CREATE TABLE `tms_bd_FeeType` (
  `ft_ID` int(11) NOT NULL auto_increment,
  `ft_FeeTypeName` varchar(20) default NULL,
  `ft_FeeTypeComputer` varchar(30) default NULL,
  `ft_FeePercent` decimal(12,2) default NULL,
  `ft_HelpCode` varchar(10) default NULL,
  `ft_AdderID` varchar(20) default NULL,
  `ft_Adder` varchar(30) default NULL,
  `ft_AddTime` datetime default NULL,
  `ft_ModerID` varchar(20) default NULL,
  `ft_Moder` varchar(30) default NULL,
  `ft_ModTime` datetime default NULL,
  `ft_Remark` varchar(50) default NULL,
  `ft_FeeFix` decimal(12,2) default NULL,
  PRIMARY KEY  (`ft_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_GroupLoopBus`
--

DROP TABLE IF EXISTS `tms_bd_GroupLoopBus`;
CREATE TABLE `tms_bd_GroupLoopBus` (
  `glb_LoopID` int(11) NOT NULL,
  `glb_ModelID` varchar(50) default NULL,
  `glb_ModelName` varchar(50) default NULL,
  `glb_BusID` varchar(50) NOT NULL default '',
  `glb_BusCard` varchar(50) default NULL,
  `glb_Seating` int(11) default NULL,
  `glb_AddSeating` int(11) default NULL,
  `glb_Loads` int(11) default NULL,
  `glb_StationID` varchar(50) default NULL,
  `glb_Station` varchar(50) default NULL,
  `glb_Remark` varchar(50) default NULL,
  `glb_UserID` varchar(50) NOT NULL,
  PRIMARY KEY  (`glb_LoopID`,`glb_BusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_GroupLoopNoRuns`
--

DROP TABLE IF EXISTS `tms_bd_GroupLoopNoRuns`;
CREATE TABLE `tms_bd_GroupLoopNoRuns` (
  `gln_LoopID` int(11) NOT NULL,
  `gln_NoOfRunsID` varchar(50) NOT NULL default '',
  `gln_LineName` varchar(50) default NULL,
  `gln_DepartureTime` char(5) default NULL,
  `gln_UserID` varchar(50) NOT NULL,
  PRIMARY KEY  (`gln_LoopID`,`gln_NoOfRunsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_InsureInfo`
--

DROP TABLE IF EXISTS `tms_bd_InsureInfo`;
CREATE TABLE `tms_bd_InsureInfo` (
  `ii_Number` varchar(20) NOT NULL,
  `ii_InstallDate` char(10) default NULL,
  `ii_BusID` varchar(20) default NULL,
  `ii_InsureInc` varchar(50) default NULL,
  `ii_JqxBeginDate` char(10) default NULL,
  `ii_JqxEndDate` char(10) default NULL,
  `ii_SyxBeginDate` char(10) default NULL,
  `ii_SyxEndDate` char(10) default NULL,
  `ii_BdNumber` varchar(50) default NULL,
  `ii_EngineNumber` varchar(50) default NULL,
  `ii_BatholithNumber` varchar(50) default NULL,
  `ii_Remark` varchar(200) default NULL,
  PRIMARY KEY  (`ii_Number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_InsureType`
--

DROP TABLE IF EXISTS `tms_bd_InsureType`;
CREATE TABLE `tms_bd_InsureType` (
  `it_InsureProductName` varchar(20) NOT NULL,
  `it_EffectiveDate` char(10) default NULL,
  `it_Price` decimal(12,1) NOT NULL,
  `it_RiskCode` varchar(10) default NULL,
  `it_MakeCode` varchar(20) default NULL,
  `it_RationType` varchar(10) default NULL,
  `it_AgentCode` varchar(20) default NULL,
  `it_VisaCode` varchar(20) default NULL,
  `it_Perfix` varchar(10) default NULL,
  `it_AInsuranceValue` decimal(12,1) default NULL,
  `it_BInsuranceValue` decimal(12,1) default NULL,
  `it_ComCode` varchar(10) default NULL,
  `it_HandlerCode` varchar(20) default NULL,
  `it_Handler1Code` varchar(20) default NULL,
  `it_OperatorCode` varchar(20) default NULL,
  `it_ApporverCode` varchar(20) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_LineInfo`
--

DROP TABLE IF EXISTS `tms_bd_LineInfo`;
CREATE TABLE `tms_bd_LineInfo` (
  `li_LineID` varchar(30) NOT NULL,
  `li_RunLineID` varchar(20) default NULL,
  `li_LineName` varchar(50) NOT NULL,
  `li_LineKind` varchar(8) default NULL,
  `li_LineDegree` varchar(8) default NULL,
  `li_LineType` varchar(8) default NULL,
  `li_Direction` varchar(8) default NULL,
  `li_Kilometer` decimal(12,2) default NULL,
  `li_Hours` decimal(12,2) default NULL,
  `li_BeginLocation` varchar(50) NOT NULL,
  `li_BeginSite` varchar(50) NOT NULL,
  `li_BeginSiteID` varchar(20) NOT NULL,
  `li_EndLocation` varchar(50) default NULL,
  `li_EndSite` varchar(50) NOT NULL,
  `li_EndSiteID` varchar(20) NOT NULL,
  `li_Linestate` varchar(8) default NULL,
  `li_StationID` varchar(20) default NULL,
  `li_Station` varchar(50) default NULL,
  `li_InRegion` varchar(50) default NULL,
  `li_AdderID` varchar(20) default NULL,
  `li_Adder` varchar(30) default NULL,
  `li_AddTime` datetime default NULL,
  `li_ModerID` varchar(20) default NULL,
  `li_Moder` varchar(30) default NULL,
  `li_ModTime` datetime default NULL,
  `li_Remark` varchar(50) default NULL,
  PRIMARY KEY  (`li_LineID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_NoRunsAdjustPrice`
--

DROP TABLE IF EXISTS `tms_bd_NoRunsAdjustPrice`;
CREATE TABLE `tms_bd_NoRunsAdjustPrice` (
  `nrap_ID` int(11) NOT NULL auto_increment,
  `nrap_ISLineAdjust` tinyint(4) default NULL,
  `nrap_LineAdjust` varchar(50) NOT NULL,
  `nrap_ISNoRunsAdjust` tinyint(4) default NULL,
  `nrap_NoRunsAdjust` varchar(30) default NULL,
  `nrap_ISUnitAdjust` tinyint(4) default NULL,
  `nrap_Unit` varchar(50) default NULL,
  `nrap_DepartureSiteID` varchar(20) default NULL,
  `nrap_DepartureSite` varchar(50) default NULL,
  `nrap_GetToSiteID` varchar(20) default NULL,
  `nrap_GetToSite` varchar(50) default NULL,
  `nrap_ModelID` varchar(20) default NULL,
  `nrap_ModelName` varchar(50) default NULL,
  `nrap_BeginDate` char(10) default NULL,
  `nrap_EndDate` char(10) default NULL,
  `nrap_BeginTime` char(5) default NULL,
  `nrap_EndTime` char(5) default NULL,
  `nrap_ReferPrice` decimal(12,1) default NULL,
  `nrap_PriceUpPercent` decimal(12,2) default NULL,
  `nrap_RunPrice` decimal(12,1) default NULL,
  `nrap_HalfPrice` decimal(12,1) default NULL,
  `nrap_BalancePrice` decimal(12,1) default NULL,
  `nrap_LinkAdjustPrice` tinyint(4) default NULL,
  `nrap_Remark` varchar(200) default NULL,
  PRIMARY KEY  (`nrap_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_NoRunsAdjustPriceTemp`
--

DROP TABLE IF EXISTS `tms_bd_NoRunsAdjustPriceTemp`;
CREATE TABLE `tms_bd_NoRunsAdjustPriceTemp` (
  `nrt_ID` int(11) NOT NULL auto_increment,
  `nrt_DepartureSiteID` varchar(50) default NULL,
  `nrt_DepartureSite` varchar(50) default NULL,
  `nrt_GetToSiteID` varchar(50) default NULL,
  `nrt_GetToSite` varchar(50) default NULL,
  `nrt_ModelID` varchar(50) default NULL,
  `nrt_ModelName` varchar(50) default NULL,
  `nrt_RunPrice` decimal(12,1) default NULL,
  `nrt_HalfPrice` decimal(12,1) default NULL,
  `nrt_UserID` varchar(50) default NULL,
  PRIMARY KEY  (`nrt_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_NoRunsDockSite`
--

DROP TABLE IF EXISTS `tms_bd_NoRunsDockSite`;
CREATE TABLE `tms_bd_NoRunsDockSite` (
  `nds_NoOfRunsID` varchar(20) NOT NULL,
  `nds_ID` tinyint(4) NOT NULL,
  `nds_SiteName` varchar(50) default NULL,
  `nds_SiteID` varchar(20) default NULL,
  `nds_IsDock` tinyint(4) default NULL,
  `nds_GetOnSite` tinyint(4) default NULL,
  `nds_CheckInSite` tinyint(4) default NULL,
  `nds_DepartureTime` char(5) default NULL,
  `nds_CheckTicketWindow` varchar(2) default NULL,
  `nds_IsServiceFee` tinyint(4) NOT NULL,
  `nds_ServiceFee` decimal(12,2) default NULL,
  `nds_otherFee1` decimal(12,2) default NULL,
  `nds_otherFee2` decimal(12,2) default NULL,
  `nds_otherFee3` decimal(12,2) default NULL,
  `nds_otherFee4` decimal(12,2) default NULL,
  `nds_otherFee5` decimal(12,2) default NULL,
  `nds_otherFee6` decimal(12,2) default NULL,
  `nds_Remark` varchar(200) default NULL,
  `nds_StintSell` int(11) default NULL,
  `nds_StintTime` char(5) default NULL,
  `nds_RunHours` varchar(8) default NULL,
  PRIMARY KEY  (`nds_NoOfRunsID`,`nds_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_NoRunsDockSiteTemp`
--

DROP TABLE IF EXISTS `tms_bd_NoRunsDockSiteTemp`;
CREATE TABLE `tms_bd_NoRunsDockSiteTemp` (
  `ndst_NoOfRunsID` varchar(20) NOT NULL,
  `ndst_NoOfRunsdate` char(10) NOT NULL,
  `ndst_ID` tinyint(4) NOT NULL,
  `ndst_SiteName` varchar(50) default NULL,
  `ndst_SiteID` varchar(20) default NULL,
  `ndst_IsDock` tinyint(4) default NULL,
  `ndst_GetOnSite` tinyint(4) default NULL,
  `ndst_CheckInSite` tinyint(4) default NULL,
  `ndst_DepartureTime` char(5) default NULL,
  `ndst_RunHours` varchar(8) default NULL,
  `ndst_StintSell` int(11) default NULL,
  `ndst_StintTime` char(5) default NULL,
  PRIMARY KEY  (`ndst_NoOfRunsID`,`ndst_NoOfRunsdate`,`ndst_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_NoRunsInfo`
--

DROP TABLE IF EXISTS `tms_bd_NoRunsInfo`;
CREATE TABLE `tms_bd_NoRunsInfo` (
  `nri_NoOfRunsID` varchar(20) NOT NULL,
  `nri_LineID` varchar(30) NOT NULL,
  `nri_LineName` varchar(50) NOT NULL,
  `nri_BeginSiteID` varchar(20) default NULL,
  `nri_BeginSite` varchar(50) default NULL,
  `nri_EndSiteID` varchar(20) default NULL,
  `nri_EndSite` varchar(50) default NULL,
  `nri_DepartureTime` char(5) default NULL,
  `nri_DealCategory` varchar(20) default NULL,
  `nri_DealStyle` varchar(20) default NULL,
  `nri_RunHours` varchar(8) default NULL,
  `nri_SeverFeeRate` decimal(12,2) default NULL,
  `nri_TempAddFee` decimal(12,1) default NULL,
  `nri_BalanceModel` varchar(50) default NULL,
  `nri_CheckTicketWindow` varchar(2) default NULL,
  `nri_SellWindow` varchar(2) default NULL,
  `nri_RunRegion` varchar(50) default NULL,
  `nri_LoopDate` char(10) default NULL,
  `nri_StartDay` int(11) default NULL,
  `nri_RunDay` int(11) default NULL,
  `nri_StopDay` int(11) default NULL,
  `nri_IsStopOrCreat` tinyint(4) default NULL,
  `nri_Allticket` tinyint(4) default NULL,
  `nri_StationDeal` tinyint(4) default NULL,
  `nri_WeekLoop` varchar(30) default NULL,
  `nri_MonthLoop` varchar(100) default NULL,
  `nri_IsNightAddition` tinyint(4) default NULL,
  `nri_IsSucceedLine` tinyint(4) default NULL,
  `nri_IsThroughAddition` tinyint(4) default NULL,
  `nri_IsExclusive` tinyint(4) default NULL,
  `nri_IsReturn` tinyint(4) default NULL,
  `nri_AllowSell` tinyint(4) default NULL,
  `nri_AddNoRuns` tinyint(4) default NULL,
  `nri_PrintTime` varchar(50) default NULL,
  `nri_PrintSeat` varchar(50) default NULL,
  `nri_AdderID` varchar(20) default NULL,
  `nri_Adder` varchar(30) default NULL,
  `nri_AddTime` datetime default NULL,
  `nri_ModerID` varchar(20) default NULL,
  `nri_Moder` varchar(30) default NULL,
  `nri_ModTime` datetime default NULL,
  `nri_Remark` varchar(50) default NULL,
  `nri_OperateCode` varchar(50) default NULL,
  `nri_Type` varchar(10) default NULL,
  `nri_State` varchar(20) default NULL,
  PRIMARY KEY  (`nri_NoOfRunsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_NoRunsLoop`
--

DROP TABLE IF EXISTS `tms_bd_NoRunsLoop`;
CREATE TABLE `tms_bd_NoRunsLoop` (
  `nrl_NoOfRunsID` varchar(20) NOT NULL,
  `nrl_LoopID` tinyint(4) NOT NULL,
  `nrl_ModelID` varchar(20) default NULL,
  `nrl_ModelName` varchar(50) default NULL,
  `nrl_BusID` varchar(20) default NULL,
  `nrl_BusCard` varchar(20) default NULL,
  `nrl_Seating` int(11) default NULL,
  `nrl_AddSeating` tinyint(4) default NULL,
  `nrl_AllowHalfSeats` tinyint(4) default NULL,
  `nrl_Loads` int(11) default NULL,
  `nrl_StationID` varchar(20) default NULL,
  `nrl_Station` varchar(50) default NULL,
  `nrl_Remark` varchar(200) default NULL,
  `nrl_Unit` varchar(100) default NULL,
  PRIMARY KEY  (`nrl_LoopID`,`nrl_NoOfRunsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_PriceDetail`
--

DROP TABLE IF EXISTS `tms_bd_PriceDetail`;
CREATE TABLE `tms_bd_PriceDetail` (
  `pd_NoOfRunsID` varchar(20) NOT NULL,
  `pd_LineID` varchar(30) default NULL,
  `pd_NoOfRunsdate` char(10) NOT NULL,
  `pd_BeginStationTime` char(5) default NULL,
  `pd_StopStationTime` char(5) default NULL,
  `pd_Distance` decimal(12,2) default NULL,
  `pd_BeginStationID` varchar(20) default NULL,
  `pd_BeginStation` varchar(50) default NULL,
  `pd_FromStationID` varchar(20) NOT NULL,
  `pd_FromStation` varchar(50) default NULL,
  `pd_ReachStationID` varchar(20) NOT NULL,
  `pd_ReachStation` varchar(50) default NULL,
  `pd_EndStationID` varchar(20) default NULL,
  `pd_EndStation` varchar(50) default NULL,
  `pd_FullPrice` decimal(12,1) default NULL,
  `pd_HalfPrice` decimal(12,1) default NULL,
  `pd_StandardPrice` decimal(12,1) default NULL,
  `pd_BalancePrice` decimal(12,1) default NULL,
  `pd_ServiceFee` decimal(12,2) default NULL,
  `pd_otherFee1` decimal(12,2) default NULL,
  `pd_otherFee2` decimal(12,2) default NULL,
  `pd_otherFee3` decimal(12,2) default NULL,
  `pd_otherFee4` decimal(12,2) default NULL,
  `pd_otherFee5` decimal(12,2) default NULL,
  `pd_otherFee6` decimal(12,2) default NULL,
  `pd_StationID` varchar(20) default NULL,
  `pd_Station` varchar(50) default NULL,
  `pd_Created` datetime default NULL,
  `pd_CreatedBY` varchar(30) default NULL,
  `pd_Updated` datetime default NULL,
  `pd_UpdatedBY` varchar(30) default NULL,
  `pd_IsPass` tinyint(4) default NULL,
  `pd_CheckInSite` tinyint(4) default NULL,
  `pd_IsFromSite` tinyint(4) default NULL,
  `pd_StintSell` tinyint(4) default NULL,
  `pd_StintTime` char(5) default NULL,
  `pd_RunHours` varchar(8) default NULL,
  PRIMARY KEY  (`pd_NoOfRunsID`,`pd_NoOfRunsdate`,`pd_FromStationID`,`pd_ReachStationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_RegionSet`
--

DROP TABLE IF EXISTS `tms_bd_RegionSet`;
CREATE TABLE `tms_bd_RegionSet` (
  `rs_RegionCode` varchar(10) NOT NULL,
  `rs_RegionName` varchar(20) default NULL,
  `rs_RegionFullName` varchar(50) default NULL,
  `rs_HelpCode` varchar(10) default NULL,
  `rs_IdCode` varchar(10) default NULL,
  `rs_AdderID` varchar(20) default NULL,
  `rs_Adder` varchar(30) default NULL,
  `rs_AddTime` datetime default NULL,
  `rs_ModerID` varchar(20) default NULL,
  `rs_Moder` varchar(30) default NULL,
  `rs_ModTime` datetime default NULL,
  `rs_Remark` varchar(50) default NULL,
  PRIMARY KEY  (`rs_RegionCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_Reserve`
--

DROP TABLE IF EXISTS `tms_bd_Reserve`;
CREATE TABLE `tms_bd_Reserve` (
  `re_NoOfRunsID` varchar(20) NOT NULL,
  `re_LineID` varchar(30) default NULL,
  `re_NoOfRunsdate` char(10) NOT NULL,
  `re_ReserveSeatNO` varchar(50) NOT NULL,
  `re_ReserveSeatS` tinyint(4) default NULL,
  `re_OnStationID` varchar(20) NOT NULL default '',
  `re_OnStation` varchar(50) default NULL,
  `re_ReserveUserID` varchar(20) default NULL,
  `re_ReserveUser` varchar(20) default NULL,
  `re_DateTime` datetime default NULL,
  `re_Remark` varchar(200) default NULL,
  PRIMARY KEY  (`re_NoOfRunsID`,`re_OnStationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_ScheduleLong`
--

DROP TABLE IF EXISTS `tms_bd_ScheduleLong`;
CREATE TABLE `tms_bd_ScheduleLong` (
  `sl_ID` int(11) NOT NULL auto_increment,
  `sl_NoOfRunsID` varchar(20) NOT NULL,
  `sl_BeginDate` char(10) NOT NULL,
  `sl_EndDate` char(10) NOT NULL,
  `sl_StopCause` varchar(30) default NULL,
  `sl_Remark` varchar(50) default NULL,
  PRIMARY KEY  (`sl_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_ScheduleReserve`
--

DROP TABLE IF EXISTS `tms_bd_ScheduleReserve`;
CREATE TABLE `tms_bd_ScheduleReserve` (
  `sr_NoOfRunsID` varchar(10) NOT NULL,
  `sr_SellerID` varchar(10) default NULL,
  `sr_Seller` varchar(30) default NULL,
  `sr_ModelID` varchar(10) NOT NULL default '',
  `sr_ModelName` varchar(30) default NULL,
  `sr_ReserveSeatNO` varchar(255) default NULL,
  `sr_ReserveSeatS` tinyint(4) default NULL,
  `sr_Remark` varchar(50) default NULL,
  PRIMARY KEY  (`sr_NoOfRunsID`,`sr_ModelID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_SectionInfo`
--

DROP TABLE IF EXISTS `tms_bd_SectionInfo`;
CREATE TABLE `tms_bd_SectionInfo` (
  `si_LineID` varchar(30) NOT NULL,
  `si_LineName` varchar(50) default NULL,
  `si_SectionID` tinyint(4) NOT NULL,
  `si_SiteNameID` varchar(20) NOT NULL,
  `si_SiteName` varchar(50) default NULL,
  `si_Kilometer` decimal(12,2) default NULL,
  `si_IsDock` tinyint(4) default NULL,
  `si_IsGetOnSite` tinyint(4) default NULL,
  `si_IsCheckInSite` tinyint(4) default NULL,
  `si_IsTollInSite` tinyint(4) default NULL,
  `si_IsServiceFee` tinyint(4) default NULL,
  `si_ServiceFee` decimal(12,2) default NULL,
  `si_otherFee1` decimal(12,2) default NULL,
  `si_otherFee2` decimal(12,2) default NULL,
  `si_otherFee3` decimal(12,2) default NULL,
  `si_otherFee4` decimal(12,2) default NULL,
  `si_otherFee5` decimal(12,2) default NULL,
  `si_otherFee6` decimal(12,2) default NULL,
  `si_Remark` varchar(50) default NULL,
  PRIMARY KEY  (`si_LineID`,`si_SectionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_ServiceFeeAdjust`
--

DROP TABLE IF EXISTS `tms_bd_ServiceFeeAdjust`;
CREATE TABLE `tms_bd_ServiceFeeAdjust` (
  `sfa_ID` int(11) NOT NULL auto_increment,
  `sfa_ISLineAdjust` tinyint(4) default NULL,
  `sfa_LineAdjust` varchar(50) default NULL,
  `sfa_ISNoRunsAdjust` tinyint(4) default NULL,
  `sfa_NoRunsAdjust` varchar(20) default NULL,
  `sfa_ISUnitAdjust` tinyint(4) default NULL,
  `sfa_Unit` varchar(50) default NULL,
  `sfa_DepartureSiteID` varchar(20) default NULL,
  `sfa_DepartureSite` varchar(20) default NULL,
  `sfa_GetToSiteID` varchar(20) default NULL,
  `sfa_GetToSite` varchar(20) default NULL,
  `sfa_ModelID` varchar(20) default NULL,
  `sfa_ModelName` varchar(20) default NULL,
  `sfa_BeginDate` char(10) default NULL,
  `sfa_EndDate` char(10) default NULL,
  `sfa_BeginTime` char(5) default NULL,
  `sfa_EndTime` char(5) default NULL,
  `sfa_RunPrice` decimal(12,1) default NULL,
  `sfa_LinkAdjustPrice` tinyint(4) default NULL,
  `sfa_Remark` varchar(100) default NULL,
  PRIMARY KEY  (`sfa_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_ServiceFeeSet`
--

DROP TABLE IF EXISTS `tms_bd_ServiceFeeSet`;
CREATE TABLE `tms_bd_ServiceFeeSet` (
  `sf_ID` int(11) NOT NULL auto_increment,
  `sf_StationID` varchar(20) default NULL,
  `sf_Station` varchar(50) default NULL,
  `sf_BeginKilometer` decimal(12,2) default NULL,
  `sf_EndKilometer` decimal(12,2) default NULL,
  `sf_ServiceFee` decimal(12,2) default NULL,
  PRIMARY KEY  (`sf_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_SiteSet`
--

DROP TABLE IF EXISTS `tms_bd_SiteSet`;
CREATE TABLE `tms_bd_SiteSet` (
  `sset_SiteID` varchar(20) NOT NULL,
  `sset_SiteName` varchar(50) NOT NULL,
  `sset_SiteType` varchar(10) NOT NULL,
  `sset_SiteRank` varchar(10) default NULL,
  `sset_OperateCode` varchar(20) NOT NULL,
  `sset_HelpCode` varchar(10) default NULL,
  `sset_IdCode` varchar(10) default NULL,
  `sset_Region` varchar(50) default NULL,
  `sset_IsStation` tinyint(4) default NULL,
  `sset_IsTollSite` tinyint(4) default NULL,
  `sset_StationAdOrg` varchar(50) default NULL,
  `sset_AdderID` varchar(20) default NULL,
  `sset_Adder` varchar(30) default NULL,
  `sset_AddTime` datetime default NULL,
  `sset_ModerID` varchar(20) default NULL,
  `sset_Moder` varchar(30) default NULL,
  `sset_ModTime` datetime default NULL,
  `sset_Remark` varchar(50) default NULL,
  PRIMARY KEY  (`sset_SiteID`),
  UNIQUE KEY `sset_SiteName` (`sset_SiteName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_TicketAdd`
--

DROP TABLE IF EXISTS `tms_bd_TicketAdd`;
CREATE TABLE `tms_bd_TicketAdd` (
  `ta_ID` int(11) NOT NULL auto_increment,
  `ta_Data` char(10) default NULL,
  `ta_Time` char(5) default NULL,
  `ta_BeginTicket` varchar(20) default NULL,
  `ta_EndTicket` varchar(20) default NULL,
  `ta_CurrentTicket` varchar(20) default NULL,
  `ta_AddNum` int(11) default NULL,
  `ta_LostNum` int(11) default NULL,
  `ta_Type` varchar(50) default NULL,
  `ta_UserID` varchar(20) default NULL,
  `ta_User` varchar(30) default NULL,
  `ta_UserSation` varchar(50) default NULL,
  `ta_Remark` varchar(100) default NULL,
  PRIMARY KEY  (`ta_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_TicketMode`
--

DROP TABLE IF EXISTS `tms_bd_TicketMode`;
CREATE TABLE `tms_bd_TicketMode` (
  `tml_NoOfRunsID` varchar(50) NOT NULL,
  `tml_LineID` varchar(50) default NULL,
  `tml_NoOfRunsdate` char(10) NOT NULL,
  `tml_NoOfRunstime` char(5) default NULL,
  `tml_BeginstationID` varchar(50) default NULL,
  `tml_Beginstation` varchar(50) default NULL,
  `tml_EndstationID` varchar(50) default NULL,
  `tml_Endstation` varchar(50) default NULL,
  `tml_CheckTicketWindow` int(11) default NULL,
  `tml_SellWindow` int(11) default NULL,
  `tml_Loads` int(11) default NULL,
  `tml_SeatStatus` varchar(8000) default NULL,
  `tml_TotalSeats` int(11) default NULL,
  `tml_LeaveSeats` int(11) default NULL,
  `tml_HalfSeats` int(11) default NULL,
  `tml_LeaveHalfSeats` int(11) default NULL,
  `tml_ReserveSeats` int(11) default NULL,
  `tml_StopRun` tinyint(4) default NULL,
  `tml_Allticket` tinyint(4) default NULL,
  `tml_AllowSell` tinyint(4) default NULL,
  `tml_Orderno` int(11) default NULL,
  `tml_StationID` varchar(50) default NULL,
  `tml_Station` varchar(50) default NULL,
  `tml_Created` datetime default NULL,
  `tml_Createdby` varchar(50) default NULL,
  `tml_Updated` datetime default NULL,
  `tml_Updatedby` varchar(50) default NULL,
  `tml_BusModelID` varchar(20) default NULL,
  `tml_BusModel` varchar(50) default NULL,
  `tml_BusID` varchar(20) NOT NULL,
  `tml_BusCard` varchar(20) default NULL,
  `tml_FreeSeats` int(11) default NULL,
  `tml_LeaveFreeSeats` int(11) default NULL,
  `tml_StationDeal` tinyint(4) default NULL,
  `tml_RunRegion` varchar(50) default NULL,
  `tml_DealCategory` varchar(20) default NULL,
  `tml_DealStyle` varchar(20) default NULL,
  `tml_BusUnit` varchar(100) default NULL,
  `tml_RunHours` varchar(8) default NULL,
  PRIMARY KEY  (`tml_NoOfRunsID`,`tml_NoOfRunsdate`,`tml_BusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_TicketPriceFactor`
--

DROP TABLE IF EXISTS `tms_bd_TicketPriceFactor`;
CREATE TABLE `tms_bd_TicketPriceFactor` (
  `tpf_ModelID` varchar(20) NOT NULL,
  `tpf_ModelName` varchar(20) default NULL,
  `tpf_PriceProject` varchar(20) NOT NULL,
  `tpf_BeginDate` char(10) default NULL,
  `tpf_EndDate` char(10) default NULL,
  `tpf_MoneyRenKil` decimal(12,1) default NULL,
  `tpf_Remark` varchar(200) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_TicketProvide`
--

DROP TABLE IF EXISTS `tms_bd_TicketProvide`;
CREATE TABLE `tms_bd_TicketProvide` (
  `tp_ID` int(11) NOT NULL auto_increment,
  `tp_InceptUserID` varchar(20) default NULL,
  `tp_InceptUser` varchar(30) default NULL,
  `tp_UserSation` varchar(50) default NULL,
  `tp_ProvideData` char(10) default NULL,
  `tp_ProvideTime` char(5) default NULL,
  `tp_BeginTicket` varchar(20) default NULL,
  `tp_CurrentTicket` varchar(20) default NULL,
  `tp_EndTicket` varchar(20) default NULL,
  `tp_InceptTicketNum` int(11) default NULL,
  `tp_UseState` varchar(20) default NULL,
  `tp_Type` varchar(20) default NULL,
  `tp_ProvideUserID` varchar(20) default NULL,
  `tp_ProvideUser` varchar(30) default NULL,
  `tp_Remark` varchar(100) default NULL,
  PRIMARY KEY  (`tp_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_TicketType`
--

DROP TABLE IF EXISTS `tms_bd_TicketType`;
CREATE TABLE `tms_bd_TicketType` (
  `tt_ID` int(11) NOT NULL auto_increment,
  `tt_TypeName` varchar(30) NOT NULL,
  `tt_AdderID` varchar(20) default NULL,
  `tt_Adder` varchar(30) default NULL,
  `tt_AddTime` datetime default NULL,
  `tt_ModerID` varchar(20) default NULL,
  `tt_Moder` varchar(30) default NULL,
  `tt_ModTime` datetime default NULL,
  `tt_Remark` varchar(200) default NULL,
  PRIMARY KEY  (`tt_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_bd_WebUserRegister`
--

DROP TABLE IF EXISTS `tms_bd_WebUserRegister`;
CREATE TABLE `tms_bd_WebUserRegister` (
  `wur_ID` int(11) NOT NULL auto_increment,
  `wur_UserRegisterName` varchar(30) NOT NULL,
  `wur_Password` varchar(50) NOT NULL,
  `wur_UserName` varchar(30) NOT NULL,
  `wur_CertificateType` varchar(50) default NULL,
  `wur_CertificateNumber` varchar(30) default NULL,
  `wur_Emaile` varchar(50) default NULL,
  `wur_Phone` varchar(30) default NULL,
  PRIMARY KEY  (`wur_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_chk_CheckTemp`
--

DROP TABLE IF EXISTS `tms_chk_CheckTemp`;
CREATE TABLE `tms_chk_CheckTemp` (
  `ct_NoOfRunsID` varchar(20) NOT NULL,
  `ct_NoOfRunsdate` char(10) NOT NULL,
  `ct_NoOfRunsTime` char(5) default NULL,
  `ct_BusID` varchar(20) NOT NULL default '',
  `ct_BusNumber` varchar(20) default NULL,
  `ct_EndStation` varchar(50) default NULL,
  `ct_Allticket` varchar(50) default NULL,
  `ct_TotalSeats` varchar(50) default NULL,
  `ct_CheckTicketWindow` varchar(20) default NULL,
  `ct_LineID` varchar(30) default NULL,
  `ct_UserID` varchar(20) NOT NULL,
  `ct_User` varchar(30) default NULL,
  `ct_Flag` char(2) default NULL,
  `ct_SoldTicketNum` smallint(6) default '0',
  `ct_CheckedTicketNum` smallint(6) default '0',
  `ct_ID` int(11) NOT NULL auto_increment,
  `ct_ReportDateTime` datetime default NULL,
  PRIMARY KEY  (`ct_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_chk_CheckTicket`
--

DROP TABLE IF EXISTS `tms_chk_CheckTicket`;
CREATE TABLE `tms_chk_CheckTicket` (
  `ct_TicketID` varchar(20) NOT NULL,
  `ct_NoOfRunsID` varchar(20) default NULL,
  `ct_LineID` varchar(30) default NULL,
  `ct_NoOfRunsdate` char(10) default NULL,
  `ct_BeginStationTime` char(5) default NULL,
  `ct_StopStationTime` char(5) default NULL,
  `ct_Distance` decimal(12,2) default NULL,
  `ct_BeginStationID` varchar(20) default NULL,
  `ct_BeginStation` varchar(50) default NULL,
  `ct_FromStationID` varchar(20) default NULL,
  `ct_FromStation` varchar(50) default NULL,
  `ct_ReachStationID` varchar(20) default NULL,
  `ct_ReachStation` varchar(50) default NULL,
  `ct_EndStationID` varchar(20) default NULL,
  `ct_EndStation` varchar(50) default NULL,
  `ct_SellPrice` decimal(12,1) default NULL,
  `ct_SellPriceType` varchar(50) default NULL,
  `ct_ColleSellPriceType` varchar(2000) default NULL,
  `ct_TotalMan` smallint(6) default NULL,
  `ct_FullPrice` decimal(12,1) default NULL,
  `ct_HalfPrice` decimal(12,1) default NULL,
  `ct_StandardPrice` decimal(12,1) default NULL,
  `ct_BalancePrice` decimal(12,1) default NULL,
  `ct_ServiceFee` decimal(12,2) default NULL,
  `ct_otherFee1` decimal(12,2) default NULL,
  `ct_otherFee2` decimal(12,2) default NULL,
  `ct_otherFee3` decimal(12,2) default NULL,
  `ct_otherFee4` decimal(12,2) default NULL,
  `ct_otherFee5` decimal(12,2) default NULL,
  `ct_otherFee6` decimal(12,2) default NULL,
  `ct_StationID` varchar(20) default NULL,
  `ct_Station` varchar(50) default NULL,
  `ct_SellDate` char(10) default NULL,
  `ct_SellTime` char(8) default NULL,
  `ct_BusModelID` varchar(20) default NULL,
  `ct_BusModel` varchar(50) default NULL,
  `ct_BusID` varchar(20) default NULL,
  `ct_BusNumber` varchar(20) default NULL,
  `ct_SeatID` varchar(200) default NULL,
  `ct_SellID` varchar(20) default NULL,
  `ct_SellName` varchar(30) default NULL,
  `ct_FreeSeats` smallint(6) default NULL,
  `ct_SafetyTicketID` varchar(20) default NULL,
  `ct_SafetyTicketNumber` smallint(6) default NULL,
  `ct_SafetyTicketMoney` decimal(12,2) default NULL,
  `ct_SafetyTicketPassengerID` varchar(20) default NULL,
  `ct_CheckTicketWindow` varchar(20) default NULL,
  `ct_CheckerID` varchar(20) default NULL,
  `ct_Checker` varchar(30) default NULL,
  `ct_CheckDate` char(10) default NULL,
  `ct_CheckTime` char(5) default NULL,
  `ct_BalanceNO` varchar(50) default NULL,
  `ct_IsBalance` tinyint(4) default NULL,
  `ct_BalanceDateTime` datetime default NULL,
  PRIMARY KEY  (`ct_TicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_chk_CheckTicketTemp`
--

DROP TABLE IF EXISTS `tms_chk_CheckTicketTemp`;
CREATE TABLE `tms_chk_CheckTicketTemp` (
  `ctt_TicketID` varchar(20) NOT NULL,
  `ctt_NoOfRunsID` varchar(20) default NULL,
  `ctt_LineID` varchar(30) default NULL,
  `ctt_NoOfRunsdate` char(10) default NULL,
  `ctt_BeginStationTime` char(5) default NULL,
  `ctt_StopStationTime` char(5) default NULL,
  `ctt_Distance` decimal(12,2) default NULL,
  `ctt_BeginStationID` varchar(20) default NULL,
  `ctt_BeginStation` varchar(50) default NULL,
  `ctt_FromStationID` varchar(20) default NULL,
  `ctt_FromStation` varchar(50) default NULL,
  `ctt_ReachStationID` varchar(20) default NULL,
  `ctt_ReachStation` varchar(50) default NULL,
  `ctt_EndStationID` varchar(20) default NULL,
  `ctt_EndStation` varchar(50) default NULL,
  `ctt_SellPrice` decimal(12,1) default NULL,
  `ctt_SellPriceType` varchar(50) default NULL,
  `ctt_ColleSellPriceType` varchar(2000) default NULL,
  `ctt_TotalMan` smallint(6) default NULL,
  `ctt_FullPrice` decimal(12,1) default NULL,
  `ctt_HalfPrice` decimal(12,1) default NULL,
  `ctt_StandardPrice` decimal(12,1) default NULL,
  `ctt_BalancePrice` decimal(12,1) default NULL,
  `ctt_ServiceFee` decimal(12,2) default NULL,
  `ctt_otherFee1` decimal(12,2) default NULL,
  `ctt_otherFee2` decimal(12,2) default NULL,
  `ctt_otherFee3` decimal(12,2) default NULL,
  `ctt_otherFee4` decimal(12,2) default NULL,
  `ctt_otherFee5` decimal(12,2) default NULL,
  `ctt_otherFee6` decimal(12,2) default NULL,
  `ctt_StationID` varchar(20) default NULL,
  `ctt_Station` varchar(50) default NULL,
  `ctt_SellDate` char(10) default NULL,
  `ctt_SellTime` char(8) default NULL,
  `ctt_BusModelID` varchar(20) default NULL,
  `ctt_BusModel` varchar(50) default NULL,
  `ctt_BusID` varchar(20) default NULL,
  `ctt_BusNumber` varchar(50) default NULL,
  `ctt_SeatID` varchar(200) default NULL,
  `ctt_SellID` varchar(20) default NULL,
  `ctt_SellName` varchar(30) default NULL,
  `ctt_FreeSeats` smallint(6) default NULL,
  `ctt_SafetyTicketID` varchar(20) default NULL,
  `ctt_SafetyTicketNumber` smallint(6) default NULL,
  `ctt_SafetyTicketMoney` decimal(12,2) default NULL,
  `ctt_SafetyTicketPassengerID` varchar(20) default NULL,
  `ctt_CheckTicketWindow` varchar(20) default NULL,
  `ctt_CheckerID` varchar(20) default NULL,
  `ctt_Checker` varchar(30) default NULL,
  `ctt_CheckDate` char(10) default NULL,
  `ctt_CheckTime` char(5) default NULL,
  `ctt_TicketState` smallint(6) default NULL,
  `ctt_AllCheck` smallint(6) default NULL,
  PRIMARY KEY  (`ctt_TicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_led_LedSynInfo`
--

DROP TABLE IF EXISTS `tms_led_LedSynInfo`;
CREATE TABLE `tms_led_LedSynInfo` (
  `lsi_ID` int(11) NOT NULL auto_increment,
  `lsi_LineName` varchar(50) default NULL,
  `lsi_NoOfRunsID` varchar(20) default NULL,
  `lsi_DepartureTime` char(5) default NULL,
  `lsi_CheckTicketWindow` varchar(20) default NULL,
  `lsi_BusModel` varchar(50) default NULL,
  `lsi_StandardPrice` decimal(12,1) default NULL,
  `lsi_FullPrice` decimal(12,1) default NULL,
  `lsi_TotalSeats` int(11) default NULL,
  `lsi_LeaveSeats` int(11) default NULL,
  `lsi_BusUnit` varchar(100) default NULL,
  `lsi_SiteName` varchar(200) default NULL,
  `lsi_Status` varchar(40) default NULL,
  `lsi_NoOfRunsdate` char(10) default NULL,
  `lsi_BusCard` varchar(50) default NULL,
  `lsi_Beginstation` varchar(50) default NULL,
  `lsi_Endstation` varchar(50) default NULL,
  `lsi_Remark` varchar(500) default NULL,
  PRIMARY KEY  (`lsi_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_lug_CloakRoom`
--

DROP TABLE IF EXISTS `tms_lug_CloakRoom`;
CREATE TABLE `tms_lug_CloakRoom` (
  `cr_ID` int(11) NOT NULL auto_increment,
  `cr_CustodyID` varchar(20) default NULL,
  `cr_PasserName` varchar(50) default NULL,
  `cr_PasserTel` varchar(20) default NULL,
  `cr_BaggageType` varchar(50) default NULL,
  `cr_BaggageNo` varchar(20) default NULL,
  `cr_KeepMoney` decimal(12,1) default NULL,
  `cr_KeepUserID` varchar(20) default NULL,
  `cr_KeepUser` varchar(30) default NULL,
  `cr_DepositTime` datetime default NULL,
  `cr_ExtractionTime` datetime default NULL,
  `cr_ExtractionUserID` varchar(20) default NULL,
  `cr_ExtractionUser` varchar(50) default NULL,
  `cr_Type` varchar(50) default NULL,
  `cr_Remark` varchar(300) default NULL,
  `cr_StationID` varchar(20) default NULL,
  `cr_Station` varchar(50) default NULL,
  PRIMARY KEY  (`cr_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_lug_LuggageCons`
--

DROP TABLE IF EXISTS `tms_lug_LuggageCons`;
CREATE TABLE `tms_lug_LuggageCons` (
  `lc_ID` int(11) NOT NULL auto_increment,
  `lc_TicketNumber` varchar(20) default NULL,
  `lc_Destination` varchar(50) default NULL,
  `lc_NoOfRunsID` varchar(20) default NULL,
  `lc_BusID` varchar(20) default NULL,
  `lc_BusNumber` varchar(20) default NULL,
  `lc_DeliveryDate` char(10) default NULL,
  `lc_DeliveryUserID` varchar(20) default NULL,
  `lc_DeliveryUser` varchar(30) default NULL,
  `lc_AcceptDateTime` datetime default NULL,
  `lc_ConsignName` varchar(30) default NULL,
  `lc_ConsignTel` varchar(20) default NULL,
  `lc_ConsignPaperID` varchar(20) default NULL,
  `lc_ConsignAdd` varchar(50) default NULL,
  `lc_UnloadName` varchar(30) default NULL,
  `lc_UnloadTel` varchar(20) default NULL,
  `lc_UnloadPaperID` varchar(20) default NULL,
  `lc_UnloadAdd` varchar(50) default NULL,
  `lc_CargoName` varchar(50) default NULL,
  `lc_Numbers` smallint(6) default NULL,
  `lc_Weight` decimal(12,2) default NULL,
  `lc_CargoDescription` varchar(50) default NULL,
  `lc_ConsignMoney` decimal(12,1) default NULL,
  `lc_PackingMoney` decimal(12,1) default NULL,
  `lc_LabelMoney` decimal(12,1) default NULL,
  `lc_HandlingMoney` decimal(12,1) default NULL,
  `lc_Remark` varchar(300) default NULL,
  `lc_StationID` varchar(20) default NULL,
  `lc_Station` varchar(50) default NULL,
  `lc_Status` varchar(20) default NULL,
  `lc_ExtractionTime` datetime default NULL,
  `lc_ExtractionUserID` varchar(20) default NULL,
  `lc_ExtractionUser` varchar(30) default NULL,
  `lc_Isvalueinsure` tinyint(4) default NULL,
  `lc_InsureMoney` decimal(12,1) default NULL,
  `lc_InsureFee` decimal(12,1) default NULL,
  `lc_PayStyle` varchar(50) default NULL,
  `lc_Allmoney` decimal(12,1) default NULL,
  `lc_IsBalance` tinyint(4) default NULL,
  `lc_BalanceDateTime` datetime default NULL,
  `lc_DestinationID` varchar(20) default NULL,
  `lc_StationBalance` tinyint(4) default '0',
  PRIMARY KEY  (`lc_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_lug_LuggagePayMoney`
--

DROP TABLE IF EXISTS `tms_lug_LuggagePayMoney`;
CREATE TABLE `tms_lug_LuggagePayMoney` (
  `lpm_ID` int(11) NOT NULL auto_increment,
  `lpm_DeliveryUserID` varchar(20) default NULL,
  `lpm_DeliveryUser` varchar(30) default NULL,
  `lpm_DeliveryDate` char(10) default NULL,
  `lpm_DeliveryMoney` decimal(12,1) default NULL,
  `lpm_DeliveryNumber` int(11) default NULL,
  `lpm_ExtractionMoney` decimal(12,1) default NULL,
  `lpm_ExtractionNumber` int(11) default NULL,
  `lpm_LuggageConsMoney` decimal(12,1) default NULL,
  `lpm_UserID` varchar(20) default NULL,
  `lpm_User` varchar(30) default NULL,
  `lpm_SubDateTime` datetime default NULL,
  `lpm_Remark` varchar(200) default NULL,
  `lpm_lugconsigntation` varchar(50) default NULL,
  PRIMARY KEY  (`lpm_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sch_AndNoOfRuns`
--

DROP TABLE IF EXISTS `tms_sch_AndNoOfRuns`;
CREATE TABLE `tms_sch_AndNoOfRuns` (
  `anr_NoOfRunsID` varchar(20) NOT NULL,
  `anr_NoOfRunsdate` char(10) NOT NULL default '',
  `anr_AndNoOfRunsID` varchar(20) default NULL,
  `anr_AndNoOfRunsdate` char(10) default NULL,
  `anr_AndTime` datetime default NULL,
  `anr_AnderID` varchar(20) default NULL,
  `anr_Ander` varchar(30) default NULL,
  `anr_Seats` int(11) default NULL,
  `anr_HalfSeats` int(11) default NULL,
  `anr_AndSeatID` varchar(200) default NULL,
  PRIMARY KEY  (`anr_NoOfRunsID`,`anr_NoOfRunsdate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sch_NoticeInfo`
--

DROP TABLE IF EXISTS `tms_sch_NoticeInfo`;
CREATE TABLE `tms_sch_NoticeInfo` (
  `ni_state` varchar(2) NOT NULL default '1',
  `ni_info` varchar(100) NOT NULL,
  `ni_id` int(11) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sch_PreviousTime`
--

DROP TABLE IF EXISTS `tms_sch_PreviousTime`;
CREATE TABLE `tms_sch_PreviousTime` (
  `pt_Stop` varchar(3) NOT NULL default '5',
  `pt_Current` varchar(3) NOT NULL default '20',
  `pt_Hasten` varchar(3) NOT NULL default '25',
  `pt_StopRepeat` varchar(3) NOT NULL default '2',
  `pt_HastenRepeat` varchar(3) NOT NULL default '2',
  `pt_CurrentRepeat` varchar(3) NOT NULL default '2',
  `pt_WaitRepeat` varchar(3) NOT NULL default '1',
  `pt_Normal` varchar(3) NOT NULL default '1',
  `pt_Code` varchar(3) NOT NULL default '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sch_Report`
--

DROP TABLE IF EXISTS `tms_sch_Report`;
CREATE TABLE `tms_sch_Report` (
  `rt_ID` int(11) NOT NULL auto_increment,
  `rt_NoOfRunsID` varchar(20) default NULL,
  `rt_LineID` varchar(30) default NULL,
  `rt_NoOfRunsdate` char(10) default NULL,
  `rt_AttemperStationID` varchar(20) default NULL,
  `rt_AttemperStation` varchar(50) default NULL,
  `rt_ReportDateTime` datetime default NULL,
  `rt_BusID` varchar(20) default NULL,
  `rt_BusCard` varchar(20) default NULL,
  `rt_BusModelID` varchar(20) default NULL,
  `rt_BusModel` varchar(50) default NULL,
  `rt_BeginStationID` varchar(20) default NULL,
  `rt_BeginStation` varchar(50) default NULL,
  `rt_FromStationID` varchar(20) default NULL,
  `rt_FromStation` varchar(50) default NULL,
  `rt_EndStationID` varchar(20) default NULL,
  `rt_EndStation` varchar(50) default NULL,
  `rt_DriverID` varchar(20) default NULL,
  `rt_Driver` varchar(30) default NULL,
  `rt_Driver1ID` varchar(20) default NULL,
  `rt_Driver1` varchar(30) default NULL,
  `rt_Driver2ID` varchar(20) default NULL,
  `rt_Driver2` varchar(30) default NULL,
  `rt_ReportCircs` varchar(50) default NULL,
  `rt_ReportUser` varchar(30) default NULL,
  `rt_Allticket` tinyint(4) default NULL,
  `rt_Register` varchar(50) default NULL,
  `rt_SupTicketRen` int(11) default NULL,
  `rt_Remark` varchar(1000) default NULL,
  `rt_SeatNum` smallint(6) default NULL,
  `rt_CheckTicketWindow` varchar(20) default NULL,
  PRIMARY KEY  (`rt_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sch_ReportInfo`
--

DROP TABLE IF EXISTS `tms_sch_ReportInfo`;
CREATE TABLE `tms_sch_ReportInfo` (
  `ri_state` varchar(2) NOT NULL default '1',
  `ri_info` varchar(100) NOT NULL,
  `ri_FromStationID` varchar(20) default NULL,
  `ri_FromStation` varchar(50) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sch_SpeechNoOfRunsAttemp`
--

DROP TABLE IF EXISTS `tms_sch_SpeechNoOfRunsAttemp`;
CREATE TABLE `tms_sch_SpeechNoOfRunsAttemp` (
  `sa_StopStationTime` varchar(50) default NULL,
  `sa_EndStation` varchar(50) default NULL,
  `sa_NoOfRunsID` varchar(20) default NULL,
  `sa_Check` varchar(20) default NULL,
  `sa_BusNumber` varchar(20) default NULL,
  `sa_PreviousTime` varchar(5) default NULL,
  `sa_CheckState` varchar(20) NOT NULL,
  `sa_Beginstation` varchar(20) default NULL,
  `sa_NoOfRunsdate` date default NULL,
  `sa_FromStationID` varchar(20) default NULL,
  `sa_FromStation` varchar(50) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sch_SpeechNoOfRunsID`
--

DROP TABLE IF EXISTS `tms_sch_SpeechNoOfRunsID`;
CREATE TABLE `tms_sch_SpeechNoOfRunsID` (
  `sn_StopStationTime` varchar(50) default NULL,
  `sn_EndStation` varchar(50) default NULL,
  `sn_NoOfRunsID` varchar(20) default NULL,
  `sn_Check` varchar(20) default NULL,
  `sn_BusNumber` varchar(20) default NULL,
  `sn_PreviousTime` varchar(5) default NULL,
  `sn_CheckState` varchar(20) NOT NULL,
  `sn_Beginstation` varchar(20) default NULL,
  `sn_NoOfRunsdate` date default NULL,
  `sn_FromStationID` varchar(20) default NULL,
  `sn_FromStation` varchar(50) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sell_AlterTicket`
--

DROP TABLE IF EXISTS `tms_sell_AlterTicket`;
CREATE TABLE `tms_sell_AlterTicket` (
  `at_TicketID` varchar(20) NOT NULL,
  `at_NoOfRunsID` varchar(20) default NULL,
  `at_LineID` varchar(30) default NULL,
  `at_NoOfRunsdate` char(10) default NULL,
  `at_BeginStationTime` char(5) default NULL,
  `at_StopStationTime` char(5) default NULL,
  `at_Distance` decimal(12,1) default NULL,
  `at_BeginStationID` varchar(20) default NULL,
  `at_BeginStation` varchar(50) default NULL,
  `at_FromStationID` varchar(20) default NULL,
  `at_FromStation` varchar(50) default NULL,
  `at_ReachStationID` varchar(20) default NULL,
  `at_ReachStation` varchar(50) default NULL,
  `at_EndStationID` varchar(20) default NULL,
  `at_EndStation` varchar(50) default NULL,
  `at_SellPrice` decimal(12,1) default NULL,
  `at_SellPriceType` varchar(50) default NULL,
  `at_ColleSellPriceType` varchar(2000) default NULL,
  `at_TotalMan` smallint(6) default NULL,
  `at_FullPrice` decimal(12,1) default NULL,
  `at_HalfPrice` decimal(12,1) default NULL,
  `at_StandardPrice` decimal(12,1) default NULL,
  `at_BalancePrice` decimal(12,1) default NULL,
  `at_ServiceFee` decimal(12,2) default NULL,
  `at_otherFee1` decimal(12,2) default NULL,
  `at_otherFee2` decimal(12,2) default NULL,
  `at_otherFee3` decimal(12,2) default NULL,
  `at_otherFee4` decimal(12,2) default NULL,
  `at_otherFee5` decimal(12,2) default NULL,
  `at_otherFee6` decimal(12,2) default NULL,
  `at_AlterStationID` varchar(20) default NULL,
  `at_AlterStation` varchar(50) default NULL,
  `at_SellDate` char(10) default NULL,
  `at_SellTime` char(8) default NULL,
  `at_BusModelID` varchar(20) default NULL,
  `at_BusModel` varchar(50) default NULL,
  `at_SeatID` varchar(200) default NULL,
  `at_SellID` varchar(20) default NULL,
  `at_SellName` varchar(30) default NULL,
  `at_FreeSeats` smallint(6) default NULL,
  `at_SafetyTicketNumber` smallint(6) default NULL,
  `at_SafetyTicketMoney` decimal(12,1) default NULL,
  `at_AlterDateTime` datetime default NULL,
  `at_AlterSellID` varchar(20) default NULL,
  `at_AlterSellName` varchar(30) default NULL,
  `at_Remark` varchar(500) default NULL,
  PRIMARY KEY  (`at_TicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sell_ErrInsureTicket`
--

DROP TABLE IF EXISTS `tms_sell_ErrInsureTicket`;
CREATE TABLE `tms_sell_ErrInsureTicket` (
  `eitt_SyncCode` varchar(30) NOT NULL,
  `eitt_InsureTicketNo` varchar(20) NOT NULL,
  `eitt_TicketNo` varchar(20) NOT NULL,
  `eitt_CreatedType` tinyint(4) default NULL,
  `eitt_IdCard` varchar(30) default NULL,
  `eitt_Name` varchar(20) default NULL,
  `eitt_Beneficiary` varchar(20) default NULL,
  `eitt_Price` decimal(12,1) default NULL,
  `eitt_AinsuranceValue` decimal(12,1) default NULL,
  `eitt_BinsuranceValue` decimal(12,1) default NULL,
  `eitt_CinsuranceValue` decimal(12,1) default NULL,
  `eitt_DinsuranceValue` decimal(12,1) default NULL,
  `eitt_Cause` varchar(200) default NULL,
  `eitt_ErrTime` char(5) default NULL,
  `eitt_ErrDate` char(10) default NULL,
  `eitt_ErrUserID` varchar(20) default NULL,
  `eitt_ErrUser` varchar(30) default NULL,
  `eitt_StationName` varchar(30) default NULL,
  PRIMARY KEY  (`eitt_InsureTicketNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sell_ErrTicket`
--

DROP TABLE IF EXISTS `tms_sell_ErrTicket`;
CREATE TABLE `tms_sell_ErrTicket` (
  `et_TicketID` varchar(20) NOT NULL,
  `et_NoOfRunsID` varchar(20) default NULL,
  `et_NoOfRunsdate` char(10) default NULL,
  `et_BeginStationTime` char(5) default NULL,
  `et_StopStationTime` char(5) default NULL,
  `et_SellPrice` decimal(12,1) default NULL,
  `et_SellPriceType` varchar(50) default NULL,
  `et_SellDate` char(10) default NULL,
  `et_SellTime` char(8) default NULL,
  `et_SeatID` varchar(200) default NULL,
  `et_FreeSeats` smallint(6) default NULL,
  `et_SafetyPrice` smallint(6) default NULL,
  `et_Cause` varchar(200) default NULL,
  `et_ErrTime` char(5) default NULL,
  `et_ErrDate` char(10) default NULL,
  `et_ErrUserID` varchar(20) default NULL,
  `et_ErrUser` varchar(30) default NULL,
  `et_BeginStationID` varchar(20) default NULL,
  `et_BeginStation` varchar(50) default NULL,
  `et_FromStationID` varchar(20) default NULL,
  `et_FromStation` varchar(50) default NULL,
  `et_ReachStationID` varchar(20) default NULL,
  `et_ReachStation` varchar(50) default NULL,
  `et_EndStationID` varchar(20) default NULL,
  `et_EndStation` varchar(50) default NULL,
  `et_StationID` varchar(20) default NULL,
  `et_Station` varchar(50) default NULL,
  `et_IsBalance` tinyint(4) default NULL,
  `et_BalanceDateTime` datetime default NULL,
  PRIMARY KEY  (`et_TicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sell_HisSellTicket`
--

DROP TABLE IF EXISTS `tms_sell_HisSellTicket`;
CREATE TABLE `tms_sell_HisSellTicket` (
  `sth_TicketID` varchar(20) NOT NULL,
  `sth_NoOfRunsID` varchar(20) default NULL,
  `sth_NoOfRunsdate` char(10) default NULL,
  `sth_BeginStationTime` char(5) default NULL,
  `sth_StopStationTime` char(5) default NULL,
  `sth_Distance` smallint(6) default NULL,
  `sth_BeginStationID` varchar(20) default NULL,
  `sth_BeginStation` varchar(50) default NULL,
  `sth_FromStationID` varchar(20) default NULL,
  `sth_FromStation` varchar(50) default NULL,
  `sth_ReachStationID` varchar(20) default NULL,
  `sth_ReachStation` varchar(50) default NULL,
  `sth_EndStationID` varchar(20) default NULL,
  `sth_EndStation` varchar(50) default NULL,
  `sth_SellPrice` decimal(12,1) default NULL,
  `sth_SellPriceType` varchar(20) default NULL,
  `sth_ColleSellPriceType` varchar(2000) default NULL,
  `sth_FullPrice` decimal(12,1) default NULL,
  `sth_HalfPrice` decimal(12,1) default NULL,
  `sth_StandardPrice` decimal(12,1) default NULL,
  `sth_BalancePrice` decimal(12,1) default NULL,
  `sth_ServiceFee` decimal(12,2) default NULL,
  `sth_otherFee1` decimal(12,2) default NULL,
  `sth_otherFee2` decimal(12,2) default NULL,
  `sth_StationID` varchar(20) default NULL,
  `sth_Station` varchar(50) default NULL,
  `sth_SellDate` char(10) default NULL,
  `sth_SellTime` char(5) default NULL,
  `sth_BusModelID` varchar(20) default NULL,
  `sth_BusModel` varchar(20) default NULL,
  `sth_SeatID` varchar(200) default NULL,
  `sth_SellID` varchar(20) default NULL,
  `sth_SellName` varchar(30) default NULL,
  `sth_FreeSeats` smallint(6) default NULL,
  `sth_SafetyPrice` smallint(6) default NULL,
  `sth_SafetyMoney` decimal(12,1) default NULL,
  `sth_TicketState` smallint(6) default NULL,
  `sth_IsBalance` tinyint(4) default NULL,
  `sth_BalanceDateTime` datetime default NULL,
  PRIMARY KEY  (`sth_TicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sell_InsureTicket`
--

DROP TABLE IF EXISTS `tms_sell_InsureTicket`;
CREATE TABLE `tms_sell_InsureTicket` (
  `itt_SyncCode` varchar(30) NOT NULL,
  `itt_InsureTicketNo` varchar(20) NOT NULL,
  `itt_TicketNo` varchar(20) NOT NULL,
  `itt_CreatedType` tinyint(4) default NULL,
  `itt_Status` tinyint(4) default NULL,
  `itt_IdCard` varchar(30) default NULL,
  `itt_Name` varchar(20) default NULL,
  `itt_Beneficiary` varchar(20) default NULL,
  `itt_TbInsureProductID` varchar(10) default NULL,
  `itt_InsureProductName` varchar(20) default NULL,
  `itt_Price` decimal(12,1) default NULL,
  `itt_AinsuranceValue` decimal(12,1) default NULL,
  `itt_BinsuranceValue` decimal(12,1) default NULL,
  `itt_CinsuranceValue` decimal(12,1) default NULL,
  `itt_DinsuranceValue` decimal(12,1) default NULL,
  `itt_IsUpMoney` tinyint(4) default NULL,
  `itt_UpMoneyID` varchar(20) default NULL,
  `itt_Saler` varchar(20) default NULL,
  `itt_PtrReserveID` varchar(20) default NULL,
  `itt_SaleComputer` varchar(20) default NULL,
  `itt_SaleTime` datetime default NULL,
  `itt_RiskCode` char(3) default NULL,
  `itt_PationType` varchar(20) default NULL,
  `itt_AgentCode` varchar(20) default NULL,
  `itt_VisaCode` varchar(20) default NULL,
  `itt_PolicyNo` varchar(30) default NULL,
  `itt_UploadStatus` tinyint(4) default NULL,
  `itt_UploadDate` datetime default NULL,
  `itt_ReturnUploadStatus` tinyint(4) default NULL,
  `itt_ReturnUploadDate` datetime default NULL,
  `itt_IDCardType` varchar(5) default NULL,
  `itt_MakeCode` varchar(20) default NULL,
  `itt_ComCode` varchar(20) default NULL,
  `itt_HandlerCode` varchar(20) default NULL,
  `itt_Handler1Code` varchar(20) default NULL,
  `itt_OperatorCode` varchar(20) default NULL,
  `itt_ApporverCode` varchar(20) default NULL,
  `itt_TotalSum` varchar(20) default NULL,
  `itt_ReserveName` varchar(50) default NULL,
  `itt_ADOrgCode` varchar(10) default NULL,
  `itt_ADOrgName` varchar(50) default NULL,
  `itt_ADOrgValue` varchar(20) default NULL,
  `itt_SeatNo` varchar(10) default NULL,
  `itt_RideDate` datetime default NULL,
  `itt_ScheduleID` varchar(20) default NULL,
  `itt_ScheduleValue` varchar(20) default NULL,
  `itt_FormName` varchar(50) default NULL,
  `itt_FormValue` varchar(20) default NULL,
  `itt_ReachName` varchar(50) default NULL,
  `itt_ReachValue` varchar(20) default NULL,
  `itt_IsActive` tinyint(4) default NULL,
  `itt_AdClientID` varchar(20) default NULL,
  `itt_AdOrgID` varchar(20) default NULL,
  `itt_Created` datetime default NULL,
  `itt_CreatedBY` varchar(20) default NULL,
  `itt_UpdateBY` varchar(20) default NULL,
  `itt_Update` datetime default NULL,
  `itt_SalerName` varchar(20) default NULL,
  `itt_IdAdderss` varchar(200) default NULL,
  `itt_SaverResult` varchar(20) default NULL,
  `itt_SendCount` int(11) default NULL,
  `itt_NextSendTime` datetime default NULL,
  `itt_ReturnSendCount` int(11) default NULL,
  `itt_ReturnNextSendTime` datetime default NULL,
  `itt_ReturnSaveResult` varchar(20) default NULL,
  `itt_RowID` varchar(20) default NULL,
  PRIMARY KEY  (`itt_InsureTicketNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sell_LockSeat`
--

DROP TABLE IF EXISTS `tms_sell_LockSeat`;
CREATE TABLE `tms_sell_LockSeat` (
  `ls_ID` int(11) NOT NULL auto_increment,
  `ls_LockID` varchar(20) NOT NULL,
  `ls_NoOfRunsID` varchar(20) default NULL,
  `ls_NoOfRunsdate` char(10) default NULL,
  `ls_FromStationID` varchar(20) default NULL,
  `ls_FromStation` varchar(50) default NULL,
  `ls_ReachStationID` varchar(20) default NULL,
  `ls_ReachStation` varchar(50) default NULL,
  `ls_TicketID` varchar(20) default NULL,
  `ls_SeatID` int(11) default NULL,
  `ls_Type` int(11) default NULL,
  `ls_Price` decimal(12,1) default NULL,
  `ls_sellID` varchar(20) default NULL,
  PRIMARY KEY  (`ls_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sell_ResetTicket`
--

DROP TABLE IF EXISTS `tms_sell_ResetTicket`;
CREATE TABLE `tms_sell_ResetTicket` (
  `rt_ID` int(11) NOT NULL auto_increment,
  `rt_ResetUserID` varchar(20) default NULL,
  `rt_ResetUser` varchar(30) default NULL,
  `rt_UserSation` varchar(50) default NULL,
  `rt_ResetDate` date default NULL,
  `rt_BeginTicket` varchar(20) default NULL,
  `rt_CurrentTicket` varchar(20) default NULL,
  `rt_EndTicket` varchar(20) default NULL,
  `rt_InceptTicketNum` int(11) default NULL,
  `rt_Type` varchar(20) default NULL,
  `rt_Remark` varchar(100) default NULL,
  PRIMARY KEY  (`rt_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sell_ReturnTicket`
--

DROP TABLE IF EXISTS `tms_sell_ReturnTicket`;
CREATE TABLE `tms_sell_ReturnTicket` (
  `rtk_TicketID` varchar(20) NOT NULL,
  `rtk_ReturnTicketID` varchar(20) NOT NULL default '',
  `rtk_ReturnType` varchar(50) default NULL,
  `rtk_ReturnPrice` decimal(12,1) default NULL,
  `rtk_SignTime` char(5) default NULL,
  `rtk_SignDate` char(10) default NULL,
  `rtk_SignUserID` varchar(20) default NULL,
  `rtk_SignUser` varchar(30) default NULL,
  `rtk_ReturnTime` char(6) default NULL,
  `rtk_ReturnDate` char(10) default NULL,
  `rtk_ReturnUserID` varchar(20) default NULL,
  `rtk_ReturnUser` varchar(30) default NULL,
  `rtk_ReturnRate` decimal(12,2) default NULL,
  `rtk_SXPrice` decimal(12,1) default NULL,
  `rtk_NoOfRunsID` varchar(20) default NULL,
  `rtk_NoOfRunsdate` char(10) default NULL,
  `rtk_BeginStationTime` char(5) default NULL,
  `rtk_StopStationTime` char(5) default NULL,
  `rtk_SellPrice` decimal(12,1) default NULL,
  `rtk_SellPriceType` varchar(50) default NULL,
  `rtk_SellDate` char(10) default NULL,
  `rtk_SellTime` char(8) default NULL,
  `rtk_SeatID` varchar(200) default NULL,
  `rtk_FreeSeats` smallint(6) default NULL,
  `rtk_SafetyTicketNumber` smallint(6) default NULL,
  `rtk_BeginStationID` varchar(20) default NULL,
  `rtk_BeginStation` varchar(50) default NULL,
  `rtk_FromStationID` varchar(20) default NULL,
  `rtk_FromStation` varchar(50) default NULL,
  `rtk_ReachStationID` varchar(20) default NULL,
  `rtk_ReachStation` varchar(50) default NULL,
  `rtk_EndStationID` varchar(20) default NULL,
  `rtk_EndStation` varchar(50) default NULL,
  `rtk_StationID` varchar(20) default NULL,
  `rtk_Station` varchar(50) default NULL,
  `rtk_IsBalance` tinyint(4) default NULL,
  `rtk_BalanceDateTime` datetime default NULL,
  PRIMARY KEY  (`rtk_ReturnTicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sell_ReturnType`
--

DROP TABLE IF EXISTS `tms_sell_ReturnType`;
CREATE TABLE `tms_sell_ReturnType` (
  `rte_ReturnType` varchar(50) NOT NULL,
  `rte_ReturnRate` decimal(12,2) default NULL,
  `rte_ReturnTimeBegin` char(10) default NULL,
  `rte_ReturnTimeEnd` char(10) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sell_SellTicket`
--

DROP TABLE IF EXISTS `tms_sell_SellTicket`;
CREATE TABLE `tms_sell_SellTicket` (
  `st_TicketID` varchar(20) NOT NULL,
  `st_NoOfRunsID` varchar(20) default NULL,
  `st_LineID` varchar(30) default NULL,
  `st_NoOfRunsdate` char(10) default NULL,
  `st_BeginStationTime` char(5) default NULL,
  `st_StopStationTime` char(5) default NULL,
  `st_Distance` decimal(12,2) default NULL,
  `st_BeginStationID` varchar(20) default NULL,
  `st_BeginStation` varchar(50) default NULL,
  `st_FromStationID` varchar(20) default NULL,
  `st_FromStation` varchar(50) default NULL,
  `st_ReachStationID` varchar(20) default NULL,
  `st_ReachStation` varchar(50) default NULL,
  `st_EndStationID` varchar(20) default NULL,
  `st_EndStation` varchar(50) default NULL,
  `st_SellPrice` decimal(12,1) default NULL,
  `st_SellPriceType` varchar(50) default NULL,
  `st_ColleSellPriceType` varchar(2000) default NULL,
  `st_TotalMan` smallint(6) default NULL,
  `st_FullPrice` decimal(12,1) default NULL,
  `st_HalfPrice` decimal(12,1) default NULL,
  `st_StandardPrice` decimal(12,1) default NULL,
  `st_BalancePrice` decimal(12,1) default NULL,
  `st_ServiceFee` decimal(12,2) default NULL,
  `st_otherFee1` decimal(12,2) default NULL,
  `st_otherFee2` decimal(12,2) default NULL,
  `st_otherFee3` decimal(12,2) default NULL,
  `st_otherFee4` decimal(12,2) default NULL,
  `st_otherFee5` decimal(12,2) default NULL,
  `st_otherFee6` decimal(12,2) default NULL,
  `st_StationID` varchar(20) default NULL,
  `st_Station` varchar(50) default NULL,
  `st_SellDate` char(10) default NULL,
  `st_SellTime` char(5) default NULL,
  `st_BusModelID` varchar(50) default NULL,
  `st_BusModel` varchar(50) default NULL,
  `st_SeatID` varchar(200) default NULL,
  `st_SellID` varchar(20) default NULL,
  `st_SellName` varchar(30) default NULL,
  `st_FreeSeats` smallint(6) default NULL,
  `st_SafetyTicketID` varchar(20) default NULL,
  `st_SafetyTicketNumber` smallint(6) default NULL,
  `st_SafetyTicketMoney` decimal(12,2) default NULL,
  `st_SafetyTicketPassengerID` varchar(20) default NULL,
  `st_TicketState` smallint(6) default NULL,
  `st_IsBalance` tinyint(4) default NULL,
  `st_BalanceDateTime` datetime default NULL,
  `st_AlterTicket` int(11) default NULL,
  `st_StationBalance` tinyint(4) default NULL,
  PRIMARY KEY  (`st_TicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sell_SellTicketTemp`
--

DROP TABLE IF EXISTS `tms_sell_SellTicketTemp`;
CREATE TABLE `tms_sell_SellTicketTemp` (
  `stt_TicketID` varchar(20) NOT NULL,
  `stt_SeatID` varchar(50) default NULL,
  `stt_NoOfRunsID` varchar(20) default NULL,
  `stt_LineID` varchar(30) default NULL,
  `stt_NoOfRunsdate` char(10) default NULL,
  `stt_BeginStationTime` char(5) default NULL,
  `stt_StopStationTime` char(5) default NULL,
  `stt_Distance` decimal(12,2) default NULL,
  `stt_BeginStationID` varchar(20) default NULL,
  `stt_BeginStation` varchar(50) default NULL,
  `stt_FromStationID` varchar(20) default NULL,
  `stt_FromStation` varchar(50) default NULL,
  `stt_ReachStationID` varchar(20) default NULL,
  `stt_ReachStation` varchar(50) default NULL,
  `stt_EndStationID` varchar(20) default NULL,
  `stt_EndStation` varchar(50) default NULL,
  `stt_SellPrice` decimal(12,1) default NULL,
  `stt_SellPriceType` varchar(50) default NULL,
  `stt_FullPrice` decimal(12,1) default NULL,
  `stt_HalfPrice` decimal(12,1) default NULL,
  `stt_StandardPrice` decimal(12,1) default NULL,
  `stt_BalancePrice` decimal(12,1) default NULL,
  `stt_ServiceFee` decimal(12,2) default NULL,
  `stt_otherFee1` decimal(12,2) default NULL,
  `stt_otherFee2` decimal(12,2) default NULL,
  `stt_otherFee3` decimal(12,2) default NULL,
  `stt_otherFee4` decimal(12,2) default NULL,
  `stt_otherFee5` decimal(12,2) default NULL,
  `stt_otherFee6` decimal(12,2) default NULL,
  `stt_SellerStationID` varchar(20) default NULL,
  `stt_SellerStation` varchar(50) default NULL,
  `stt_BusModelID` varchar(20) default NULL,
  `stt_BusModel` varchar(50) default NULL,
  `stt_BusID` varchar(20) default NULL,
  `stt_BusCard` varchar(20) default NULL,
  `stt_SellID` varchar(20) default NULL,
  `stt_SellName` varchar(30) default NULL,
  `stt_SafetyTicketID` varchar(20) default NULL,
  `stt_SafetyTicketNumber` smallint(6) default NULL,
  `stt_SafetyTicketMoney` decimal(12,2) default NULL,
  `stt_SafetyTicketPassengerID` varchar(20) default NULL,
  PRIMARY KEY  (`stt_TicketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sf_CheckItem`
--

DROP TABLE IF EXISTS `tms_sf_CheckItem`;
CREATE TABLE `tms_sf_CheckItem` (
  `ci_CheckItem` varchar(30) NOT NULL,
  `ci_CheckContent` varchar(100) NOT NULL,
  `ci_AdderID` varchar(20) default NULL,
  `ci_Adder` varchar(30) default NULL,
  `ci_Addertime` datetime default NULL,
  `ci_ModerID` varchar(20) default NULL,
  `ci_Moder` varchar(30) default NULL,
  `ci_Modertime` datetime default NULL,
  `ci_Remark` varchar(50) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sf_OutCheck`
--

DROP TABLE IF EXISTS `tms_sf_OutCheck`;
CREATE TABLE `tms_sf_OutCheck` (
  `oc_ID` int(11) NOT NULL auto_increment,
  `oc_BusID` varchar(20) default NULL,
  `oc_BusCard` varchar(20) default NULL,
  `oc_OutCheck_StationID` varchar(20) default NULL,
  `oc_OutCheck_Station` varchar(50) default NULL,
  `oc_OutCheck_User` varchar(50) default NULL,
  `oc_PcUserID` varchar(20) default NULL,
  `oc_PcUser` varchar(30) default NULL,
  `oc_Result` varchar(50) default NULL,
  `oc_CheckDate` datetime default NULL,
  `oc_Item1` varchar(50) default NULL,
  `oc_Item2` varchar(50) default NULL,
  `oc_Item3` varchar(50) default NULL,
  `oc_Item4` varchar(50) default NULL,
  `oc_Item5` varchar(50) default NULL,
  `oc_Item6` varchar(50) default NULL,
  `oc_Item7` varchar(50) default NULL,
  `oc_Item8` varchar(50) default NULL,
  `oc_Item9` varchar(50) default NULL,
  `oc_Item10` varchar(50) default NULL,
  `oc_NoOfRunsID` varchar(50) default NULL,
  `oc_RenNo` varchar(20) default NULL,
  `oc_FreeSeats` varchar(20) default NULL,
  `oc_Remark` varchar(500) default NULL,
  PRIMARY KEY  (`oc_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sf_SafetyCheck`
--

DROP TABLE IF EXISTS `tms_sf_SafetyCheck`;
CREATE TABLE `tms_sf_SafetyCheck` (
  `sc_BusID` varchar(30) NOT NULL,
  `sc_BusCard` varchar(30) NOT NULL,
  `sc_BusType` varchar(30) default NULL,
  `sc_StationID` varchar(30) NOT NULL,
  `sc_StationName` varchar(50) NOT NULL,
  `sc_InspectorName` varchar(20) default NULL,
  `sc_UserID` varchar(30) NOT NULL,
  `sc_UserName` varchar(20) NOT NULL,
  `sc_Result` varchar(20) NOT NULL,
  `sc_CheckDate` date NOT NULL,
  `sc_CheckExpiredDate` date default NULL,
  `sc_Item1` varchar(300) default NULL,
  `sc_Item2` varchar(300) default NULL,
  `sc_Item3` varchar(300) default NULL,
  `sc_Item4` varchar(300) default NULL,
  `sc_Item5` varchar(300) default NULL,
  `sc_Item6` varchar(300) default NULL,
  `sc_Item7` varchar(300) default NULL,
  `sc_Item8` varchar(300) default NULL,
  `sc_Item9` varchar(300) default NULL,
  `sc_Item10` varchar(300) default NULL,
  `sc_IsNoOfRunsID` tinyint(1) default NULL,
  PRIMARY KEY  (`sc_BusID`,`sc_CheckDate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sys_OnLine`
--

DROP TABLE IF EXISTS `tms_sys_OnLine`;
CREATE TABLE `tms_sys_OnLine` (
  `ol_UserID` varchar(20) NOT NULL,
  `ol_User` varchar(50) default NULL,
  `ol_IF` varchar(50) default NULL,
  `ol_Station` varchar(50) default NULL,
  `ol_UserType` varchar(50) default NULL,
  `ol_PcName` varchar(20) default NULL,
  PRIMARY KEY  (`ol_UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sys_OnlineUser`
--

DROP TABLE IF EXISTS `tms_sys_OnlineUser`;
CREATE TABLE `tms_sys_OnlineUser` (
  `ui_UserID` varchar(20) NOT NULL,
  `ui_UserName` varchar(30) NOT NULL,
  `ui_UserGroupID` varchar(20) NOT NULL,
  `ui_UserGroup` varchar(20) NOT NULL,
  `ui_UserSationID` varchar(20) NOT NULL,
  `ui_UserSation` varchar(50) NOT NULL,
  `ui_UserState` varchar(20) default NULL,
  `ui_LoginTime` varchar(50) default NULL,
  `ui_LogoutTime` varchar(50) default NULL,
  `ui_UserIP` varchar(50) default NULL,
  PRIMARY KEY  (`ui_UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sys_UsInfor`
--

DROP TABLE IF EXISTS `tms_sys_UsInfor`;
CREATE TABLE `tms_sys_UsInfor` (
  `ui_UserID` varchar(20) NOT NULL,
  `ui_UserPassword` varchar(50) NOT NULL,
  `ui_UserName` varchar(30) NOT NULL,
  `ui_UserGroupID` varchar(50) NOT NULL,
  `ui_UserGroup` varchar(200) NOT NULL,
  `ui_UserSationID` varchar(20) NOT NULL,
  `ui_UserSation` varchar(50) NOT NULL,
  `ui_Remark` varchar(200) default NULL,
  `ui_opUserID` varchar(50) NOT NULL,
  PRIMARY KEY  (`ui_UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sys_UsType`
--

DROP TABLE IF EXISTS `tms_sys_UsType`;
CREATE TABLE `tms_sys_UsType` (
  `ut_UserType` varchar(20) NOT NULL,
  `ut_UserPerm` varchar(300) default NULL,
  `ut_InStation` varchar(50) default NULL,
  `ut_Remark` varchar(50) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sys_WordBook`
--

DROP TABLE IF EXISTS `tms_sys_WordBook`;
CREATE TABLE `tms_sys_WordBook` (
  `wb_ID` int(11) NOT NULL auto_increment,
  `wb_Type` varchar(200) default NULL,
  `wb_Intro` varchar(500) default NULL,
  PRIMARY KEY  (`wb_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_sys_WordLog`
--

DROP TABLE IF EXISTS `tms_sys_WordLog`;
CREATE TABLE `tms_sys_WordLog` (
  `wl_DateTime` varchar(20) default NULL,
  `wl_UserID` varchar(20) default NULL,
  `wl_User` varchar(20) default NULL,
  `wl_Windows` varchar(50) default NULL,
  `wl_PcName` varchar(50) default NULL,
  `wl_WordViscera` varchar(300) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_ticket_DelResult`
--

DROP TABLE IF EXISTS `tms_ticket_DelResult`;
CREATE TABLE `tms_ticket_DelResult` (
  `dr_ID` int(11) NOT NULL auto_increment,
  `dr_Desp` varchar(30) default NULL,
  `dr_mncode` varchar(10) default NULL,
  PRIMARY KEY  (`dr_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_ticket_ErrDelResult`
--

DROP TABLE IF EXISTS `tms_ticket_ErrDelResult`;
CREATE TABLE `tms_ticket_ErrDelResult` (
  `er_ID` int(11) NOT NULL auto_increment,
  `er_Desp` varchar(30) default NULL,
  `er_mncode` varchar(10) default NULL,
  PRIMARY KEY  (`er_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_ticket_ResetResult`
--

DROP TABLE IF EXISTS `tms_ticket_ResetResult`;
CREATE TABLE `tms_ticket_ResetResult` (
  `rr_ID` int(11) NOT NULL auto_increment,
  `rr_Desp` varchar(30) default NULL,
  `rr_mncode` varchar(10) default NULL,
  PRIMARY KEY  (`rr_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tms_websell_WebSellTicket`
--

DROP TABLE IF EXISTS `tms_websell_WebSellTicket`;
CREATE TABLE `tms_websell_WebSellTicket` (
  `wst_WebSellID` varchar(30) NOT NULL,
  `wst_UserName` varchar(30) NOT NULL,
  `wst_CertificateType` varchar(50) default NULL,
  `wst_CertificateNumber` varchar(30) default NULL,
  `wst_NoOfRunsID` varchar(20) default NULL,
  `wst_LineID` varchar(30) default NULL,
  `wst_NoOfRunsdate` char(10) default NULL,
  `wst_BeginStationTime` char(5) default NULL,
  `wst_StopStationTime` char(5) default NULL,
  `wst_Distance` decimal(12,2) default NULL,
  `wst_BeginStationID` varchar(20) default NULL,
  `wst_BeginStation` varchar(50) default NULL,
  `wst_FromStationID` varchar(20) default NULL,
  `wst_FromStation` varchar(50) default NULL,
  `wst_ReachStationID` varchar(20) default NULL,
  `wst_ReachStation` varchar(50) default NULL,
  `wst_EndStationID` varchar(20) default NULL,
  `wst_EndStation` varchar(50) default NULL,
  `wst_SellPrice` decimal(12,1) default NULL,
  `wst_FullNumber` smallint(6) default NULL,
  `wst_HalfNumber` smallint(6) default NULL,
  `wst_TotalMan` smallint(6) default NULL,
  `wst_SellPriceType` varchar(50) default NULL,
  `wst_ColleSellPriceType` varchar(2000) default NULL,
  `wst_FullPrice` decimal(12,1) default NULL,
  `wst_HalfPrice` decimal(12,1) default NULL,
  `wst_StandardPrice` decimal(12,1) default NULL,
  `wst_BalancePrice` decimal(12,1) default NULL,
  `wst_ServiceFee` decimal(12,2) default NULL,
  `wst_otherFee1` decimal(12,2) default NULL,
  `wst_otherFee2` decimal(12,2) default NULL,
  `wst_otherFee3` decimal(12,2) default NULL,
  `wst_otherFee4` decimal(12,2) default NULL,
  `wst_otherFee5` decimal(12,2) default NULL,
  `wst_otherFee6` decimal(12,2) default NULL,
  `wst_SellDate` char(10) default NULL,
  `wst_SellTime` char(8) default NULL,
  `wst_BusModelID` varchar(50) default NULL,
  `wst_BusModel` varchar(50) default NULL,
  `wst_SeatID` varchar(200) default NULL,
  `wst_TicketState` smallint(6) default NULL,
  `wst_PayTradeNo` varchar(64) default NULL,
  `wst_ReserveID` varchar(20) default NULL,
  `wst_ReserveName` varchar(30) default NULL,
  `wst_StationID` varchar(20) default NULL,
  `wst_Station` varchar(50) default NULL,
  PRIMARY KEY  (`wst_WebSellID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-16  5:56:43
