/*
mon ami - Your Monitoring Friend
Sussex Network Laboratories - http://www.sussexlabs.net
MySQL DB Init Script for Installation

*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `tblMonitoringAlarms`
-- ----------------------------
DROP TABLE IF EXISTS `tblMonitoringAlarms`;
CREATE TABLE `tblMonitoringAlarms` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `HostID` int(11) NOT NULL,
  `OwnerID` int(11) NOT NULL,
  `CheckTypeID` int(11) NOT NULL,
  `AlarmStateID` int(11) NOT NULL,
  `StartDateTime` int(11) NOT NULL,
  `EndDateTime` int(11) NOT NULL,
  `AckDateTime` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblMonitoringAlarms
-- ----------------------------
INSERT INTO `tblMonitoringAlarms` VALUES ('2', '1', '1', '2', '1', '1434294902', '0', '0');
INSERT INTO `tblMonitoringAlarms` VALUES ('3', '1', '1', '3', '2', '1434294801', '0', '1434294850');
INSERT INTO `tblMonitoringAlarms` VALUES ('4', '1', '1', '1', '3', '1434294213', '1434294789', '1434294750');

-- ----------------------------
-- Table structure for `tblMonitoringAlarmStates`
-- ----------------------------
DROP TABLE IF EXISTS `tblMonitoringAlarmStates`;
CREATE TABLE `tblMonitoringAlarmStates` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `StateName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblMonitoringAlarmStates
-- ----------------------------
INSERT INTO `tblMonitoringAlarmStates` VALUES ('1', 'New');
INSERT INTO `tblMonitoringAlarmStates` VALUES ('2', 'Acknowledged');
INSERT INTO `tblMonitoringAlarmStates` VALUES ('3', 'Cleared');

-- ----------------------------
-- Table structure for `tblMonitoringAlarmTokens`
-- ----------------------------
DROP TABLE IF EXISTS `tblMonitoringAlarmTokens`;
CREATE TABLE `tblMonitoringAlarmTokens` (
  `ID` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `AlarmID` int(11) DEFAULT NULL,
  `OwnerID` int(11) DEFAULT NULL,
  `Token` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `tblMonitoringChecks`
-- ----------------------------
DROP TABLE IF EXISTS `tblMonitoringChecks`;
CREATE TABLE `tblMonitoringChecks` (
  `ID` int(11) NOT NULL,
  `HostID` int(11) NOT NULL,
  `CheckTypeID` int(11) DEFAULT NULL,
  `CheckNote` varchar(100) NOT NULL,
  `PauseCheck` int(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `tblMonitoringCheckTypes`
-- ----------------------------
DROP TABLE IF EXISTS `tblMonitoringCheckTypes`;
CREATE TABLE `tblMonitoringCheckTypes` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `CheckType` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblMonitoringCheckTypes
-- ----------------------------
INSERT INTO `tblMonitoringCheckTypes` VALUES ('1', 'ICMP Ping');
INSERT INTO `tblMonitoringCheckTypes` VALUES ('2', 'HTTP (TCP Port 80)');
INSERT INTO `tblMonitoringCheckTypes` VALUES ('3', 'SMTP (TCP Port 25)');
INSERT INTO `tblMonitoringCheckTypes` VALUES ('4', 'FTP-Ctrl (TCP Port 21)');
INSERT INTO `tblMonitoringCheckTypes` VALUES ('5', 'SSH (TCP Port 22)');
INSERT INTO `tblMonitoringCheckTypes` VALUES ('6', 'Telnet (TCP Port 23)');
INSERT INTO `tblMonitoringCheckTypes` VALUES ('7', 'POP3 (TCP Port 110)');
INSERT INTO `tblMonitoringCheckTypes` VALUES ('8', 'HTTPS (TCP Port 443)');
INSERT INTO `tblMonitoringCheckTypes` VALUES ('9', 'MySQL (TCP Port 3306)');
INSERT INTO `tblMonitoringCheckTypes` VALUES ('10', 'IMAP (TCP Port 143)');
INSERT INTO `tblMonitoringCheckTypes` VALUES ('11', 'MSSQL (TCP Port 1433)');

-- ----------------------------
-- Table structure for `tblMonitoringHosts`
-- ----------------------------
DROP TABLE IF EXISTS `tblMonitoringHosts`;
CREATE TABLE `tblMonitoringHosts` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `OwnerID` int(10) NOT NULL,
  `HostName` varchar(100) NOT NULL,
  `Notes` varchar(100) DEFAULT NULL,
  `MuteAlarms` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblMonitoringHosts
-- ----------------------------
INSERT INTO `tblMonitoringHosts` VALUES ('1', '1', 'abc.somecompany.net', 'NGINX Server', '0');
INSERT INTO `tblMonitoringHosts` VALUES ('2', '1', 'xyz.somecompany.net', 'Database Server', '0');

-- ----------------------------
-- Table structure for `tblMonitoringOwners`
-- ----------------------------
DROP TABLE IF EXISTS `tblMonitoringOwners`;
CREATE TABLE `tblMonitoringOwners` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `OwnerName` varchar(50) DEFAULT NULL,
  `OwnerNotificationEmail` varchar(50) DEFAULT NULL,
  `OwnerMasterUserID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblMonitoringOwners
-- ----------------------------
INSERT INTO `tblMonitoringOwners` VALUES ('1', 'Jeff Someone', 'jeff@someonehere.org', '1');
INSERT INTO `tblMonitoringOwners` VALUES ('2', 'James Someone', 'james@someonehere.org', '1');

-- ----------------------------
-- Table structure for `tblMonitoringUsers`
-- ----------------------------
DROP TABLE IF EXISTS `tblMonitoringUsers`;
CREATE TABLE `tblMonitoringUsers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserFirstName` varchar(50) NOT NULL,
  `UserLastName` varchar(50) NOT NULL,
  `UserUsername` varchar(10) NOT NULL,
  `UserPasswordHash` varchar(32) NOT NULL,
  `UserEmailAddress` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblMonitoringUsers
-- ----------------------------
INSERT INTO `tblMonitoringUsers` VALUES ('1', 'Jeff', 'Someone', 'jeffs', '1ddec8d0e5fbbe9ec656b51e0759b87a', 'jeff@someonehere.org');
INSERT INTO `tblMonitoringUsers` VALUES ('3', 'James', 'Someone', 'jamess', '95df25cda2880d83bc97482d509e1b42', 'james@someonehere.org');
INSERT INTO `tblMonitoringUsers` VALUES ('5', 'Tester', 'Testy', 'test123', '91472dd4f7fc8ab85db86fc8b2df776f', 'test@test.com');

-- ----------------------------
-- Table structure for `tblNotificationLog`
-- ----------------------------
DROP TABLE IF EXISTS `tblNotificationLog`;
CREATE TABLE `tblNotificationLog` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `AlarmID` int(11) DEFAULT NULL,
  `NotifyTime` int(11) DEFAULT NULL,
  `NotifyTo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

