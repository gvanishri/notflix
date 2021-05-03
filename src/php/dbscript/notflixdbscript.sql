use notflix;

CREATE TABLE `auditlog` (
  `LogID` int NOT NULL AUTO_INCREMENT,
  `AuditLogID` varchar(12) NOT NULL,
  `DBInfo` varchar(100) DEFAULT NULL,
  `KeyColInfo` varchar(100) DEFAULT NULL,
  `LogMessage` varchar(2000) DEFAULT NULL,
  `LogDate` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`LogID`,`AuditLogID`),
  UNIQUE KEY `LogID_UNIQUE` (`LogID`),
  UNIQUE KEY `AuditLogID_UNIQUE` (`AuditLogID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `audittran` (
  `TranID` varchar(45) NOT NULL,
  `UserAcctID` varchar(12) NOT NULL,
  `UserName` varchar(32) NOT NULL,
  `TrackID` varchar(12) NOT NULL,
  `UserAction` varchar(20) NOT NULL,
  `InteractionPoint` varchar(50) NOT NULL,
  `InteractionType` varchar(20) NOT NULL,
  PRIMARY KEY (`TranID`),
  UNIQUE KEY `TranLogDataTime_UNIQUE` (`TranID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `favourites` (
  `FavID` int NOT NULL AUTO_INCREMENT,
  `UserAcctID` varchar(12) NOT NULL,
  `TrackID` varchar(12) NOT NULL,
  `UpdateDate` varchar(20) NOT NULL,
  PRIMARY KEY (`FavID`),
  UNIQUE KEY `favID_UNIQUE` (`FavID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='	';

CREATE TABLE `tracksrclog` (
  `SrcID` int NOT NULL AUTO_INCREMENT,
  `TrackSrcID` varchar(12) NOT NULL,
  `TrackID` varchar(12) NOT NULL,
  `TrackFromSrcPath` varchar(500) NOT NULL,
  `TrackDestSrcPath` varchar(500) NOT NULL,
  `Reason` varchar(100) DEFAULT NULL,
  `UpdateDate` varchar(20) NOT NULL,
  PRIMARY KEY (`SrcID`,`TrackSrcID`),
  UNIQUE KEY `TrackSrcID_UNIQUE` (`TrackSrcID`),
  UNIQUE KEY `ID_UNIQUE` (`SrcID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `useracct` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `UserAcctID` varchar(12) NOT NULL,
  `UserName` varchar(45) NOT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `UserPwd` varchar(45) NOT NULL,
  `UserEmail` varchar(40) NOT NULL,
  `UserPhone` varchar(20) DEFAULT NULL,
  `RegisterDate` varchar(20) NOT NULL,
  `ExpiryDate` varchar(20) NOT NULL,
  `UserAdmin` varchar(8) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`UserID`,`UserAcctID`),
  UNIQUE KEY `UserAcctID_UNIQUE` (`UserAcctID`),
  UNIQUE KEY `UserID_UNIQUE` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `videotrack` (
  `VideoID` int NOT NULL AUTO_INCREMENT,
  `TrackID` varchar(12) NOT NULL,
  `TrackTitle` varchar(60) NOT NULL,
  `TrackDesc` varchar(200) DEFAULT NULL,
  `TrackSrc` varchar(500) NOT NULL,
  `TrackUploadDate` varchar(20) NOT NULL,
  PRIMARY KEY (`VideoID`,`TrackID`),
  UNIQUE KEY `TrackID_UNIQUE` (`TrackID`),
  UNIQUE KEY `ID_UNIQUE` (`VideoID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `trantrack` (
  `UserAcctID` varchar(20) NOT NULL,
  `TranID` varchar(50) NOT NULL,
  `TranTrackID` varchar(20) NOT NULL,
  `TranCurrTime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
