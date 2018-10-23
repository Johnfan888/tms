CREATE PROCEDURE tms_bd_creatticket(NoOfRunsID varchar(20), NoOfRunsdate char(10), userBY varchar(50) CHARACTER SET utf8, OUT intRetVal int)
BEGIN
declare ttml_NoOfRunsID varchar(20);	
declare ttml_LineID varchar(30);
declare ttml_NoOfRunsdate char(10);	
declare ttml_NoOfRunstime char(5);	
declare ttml_BeginstationID varchar(20);	
declare ttml_Beginstation varchar(50) CHARACTER SET utf8;	
declare ttml_EndstationID varchar(20);	
declare ttml_Endstation varchar(50) CHARACTER SET utf8;	
declare ttml_CheckTicketWindow int;	
declare ttml_Loads int;
declare ttml_SeatStatus varchar(100);	
declare ttml_TotalSeats int;	
declare ttml_LeaveSeats int;
declare ttml_LeaveHalfSeats int;
declare ttml_Seats int;	
declare ttml_AddSeats int;	
declare ttml_FullSeats int;	
declare ttml_HalfSeats int;	
declare ttml_ReserveSeats int;	
declare ttml_StopRun tinyint;	
declare ttml_Allticket tinyint;
declare ttml_AllowSell tinyint;	
declare ttml_Orderno tinyint;	
declare ttml_StationID varchar(20);	
declare ttml_Station varchar(50) CHARACTER SET utf8;	
declare ttml_Created datetime;	
declare ttml_Createdby varchar(30) CHARACTER SET utf8;	
declare ttml_Updated datetime;	
declare ttml_Updatedby varchar(30) CHARACTER SET utf8;	
declare ttml_BusModelID varchar(20);	
declare ttml_BusModel varchar(50) CHARACTER SET utf8;	
declare ttml_BusID varchar(20);	
declare ttml_BusCard varchar(20) CHARACTER SET utf8;	
declare ttml_FreeSeats int;	
declare ttml_LeaveFreeSeats int;
declare ttml_StationDeal tinyint;  	
--
declare ttml_Orderno1 int;
--
declare ttml_RunRegion varchar(50) CHARACTER SET utf8;	
declare ttml_DealCategory varchar(20) CHARACTER SET utf8;	
declare ttml_DealStyle varchar(20) CHARACTER SET utf8;

declare LoopDate char(10);
declare StartDay int;
declare RunDay int;
declare StopDay int;
declare IsStopCreat tinyint;  
declare rotatecount int;
declare DayCount int;
declare buscount int;
declare longcount int;
declare recount int;

Declare SString varchar(100);
Declare L int;
Declare Lsub varchar(10);


Declare FreeSeatsRate decimal(12,2);
Declare LeaveFreeSeatsRate decimal(12,2);

declare ppd_NoOfRunsID varchar(30);
declare ppd_LineID varchar(20);
declare ppd_NoOfRunsdate char(10);
declare ppd_BeginStationTime char(5);	
declare ppd_StopStationTime char(5);	
declare ppd_Distance decimal(12,2); 	
declare ppd_BeginStationID varchar(20);
declare ppd_BeginStation varchar(50) CHARACTER SET utf8;
declare ppd_FromStationID varchar(20);	
declare ppd_FromStation varchar(50) CHARACTER SET utf8;
declare ppd_ReachStationID varchar(20);	
declare ppd_ReachStation varchar(50) CHARACTER SET utf8;
declare ppd_EndStationID varchar(20);	
declare ppd_EndStation varchar(50) CHARACTER SET utf8;	
declare ppd_FullPrice decimal(12,2);	
declare ppd_HalfPrice decimal(12,2);	
declare ppd_StandardPrice decimal(12,2);
declare ppd_ServiceFee decimal(12,2);	
declare ppd_otherFee1 decimal(12,2);	
declare ppd_otherFee2 decimal(12,2);	
declare ppd_otherFee3 decimal(12,2);	
declare ppd_otherFee4 decimal(12,2);	
declare ppd_otherFee5 decimal(12,2);	
declare ppd_otherFee6 decimal(12,2);	
declare ppd_StationID varchar(20);
declare ppd_Station varchar(50) CHARACTER SET utf8;	
declare ppd_Created datetime;	
declare ppd_CreatedBY varchar(30) CHARACTER SET utf8;
declare ppd_Updated datetime;	
declare ppd_UpdatedBY varchar(30) CHARACTER SET utf8;
declare ppd_IsPass tinyint;
declare ppd_BalancePrice decimal(12,2);
declare ppd_CheckInSite	tinyint;	
declare ppd_IsFromSite tinyint;	
declare ppd_StintSell tinyint;	
declare ppd_StintTime char(5);	


declare nnds_ID tinyint;
declare nnds_SiteName varchar(50) CHARACTER SET utf8;
declare nnds_SiteID varchar(20);
declare nnds_IsDock tinyint;
declare nnds_GetOnSite tinyint;
declare nnds_CheckInSite tinyint;
declare nnds_DepartureTime char(5);
declare nnds_CheckTicketWindow tinyint;
declare nnds_IsServiceFee tinyint;
declare nnds_ServiceFee decimal(12,2);
declare nnds_otherFee1 decimal(12,2);
declare nnds_otherFee2 decimal(12,2);
declare nnds_otherFee3 decimal(12,2);
declare nnds_otherFee4 decimal(12,2);
declare nnds_otherFee5 decimal(12,2);
declare nnds_otherFee6 decimal(12,2);
declare nnds_StintSell int;
declare nnds_StintTime char(5);

declare tmp_nds_ID tinyint;
declare tmp_nds_SiteName varchar(50) CHARACTER SET utf8;
declare tmp_nds_SiteID varchar(20);
declare tmp_nds_IsDock  tinyint;
declare tmp_nds_GetOnSite  tinyint;
declare tmp_nds_CheckInSite  tinyint;
declare tmp_nds_DepartureTime char(5);
declare tmp_nds_CheckTicketWindow tinyint;
declare tmp_nds_IsServiceFee tinyint;
declare tmp_nds_ServiceFee decimal(12,2);
declare tmp_nds_otherFee1 decimal(12,2);
declare tmp_nds_otherFee2 decimal(12,2);
declare tmp_nds_otherFee3 decimal(12,2);
declare tmp_nds_otherFee4 decimal(12,2);
declare tmp_nds_otherFee5 decimal(12,2);
declare tmp_nds_otherFee6 decimal(12,2);
declare tmp_nds_StintSell int;
declare tmp_nds_StintTime char(5);

Declare FromStationKilometer decimal(12,2);
Declare ToStationKilometer decimal(12,2);

declare ttpf_PriceProject varchar(20);
declare ttpf_BeginDate char(10);
declare ttpf_EndDate char(10);
declare ttpf_MoneyRenKil decimal(12,2);
declare TotalMoneyRenKil decimal(12,2);
Declare ttp_MoneyRenKil decimal(12,2);

declare nnrap_ISLineAdjust  tinyint;
declare nnrap_LineAdjust varchar(50);
declare nnrap_ISNoRunsAdjust tinyint;
declare nnrap_NoRunsAdjust varchar(30);
declare nnrap_DepartureSiteID varchar(20);
declare nnrap_DepartureSite varchar(50) CHARACTER SET utf8;
declare nnrap_GetToSiteID varchar(20);
declare nnrap_GetToSite varchar(50) CHARACTER SET utf8;
declare nnrap_ModelID varchar(20);
declare nnrap_ModelName varchar(50) CHARACTER SET utf8;
declare nnrap_BeginDate char(10);
declare nnrap_EndDate char(10);
declare nnrap_BeginTime char(5);
declare nnrap_EndTime char(5);
declare nnrap_ReferPrice decimal(12,2);
declare nnrap_PriceUpPercent decimal(12,2);
declare nnrap_RunPrice decimal(12,2);
declare nnrap_HalfPrice decimal(12,2);
declare nnrap_LinkAdjustPrice  Tinyint;
declare nnrap_BalancePrice decimal(12,2);

declare ssfa_ISLineAdjust  tinyint;
declare ssfa_LineAdjust varchar(50);
declare ssfa_ISNoRunsAdjust tinyint;
declare ssfa_NoRunsAdjust varchar(30);
declare ssfa_DepartureSiteID varchar(20);
declare ssfa_DepartureSite varchar(50) CHARACTER SET utf8; 
declare ssfa_GetToSiteID varchar(20);
declare ssfa_GetToSite varchar(50) CHARACTER SET utf8;
declare ssfa_ModelID varchar(20);
declare ssfa_ModelName varchar(50) CHARACTER SET utf8;
declare ssfa_BeginDate char(10);
declare ssfa_EndDate char(10);
declare ssfa_BeginTime char(5);
declare ssfa_EndTime char(5);
declare ssfa_RunPrice decimal(12,2);
declare ssfa_LinkAdjustPrice  Tinyint;

declare finished INTEGER DEFAULT 0;

declare  NUM1 INT;
declare  NUM2 INT;

Declare nnrap1 INT;
Declare nnrap2 INT;
Declare nnrap3 INT;
Declare ssfa1 INT;
Declare ssfa2 INT;
Declare ssfa3 INT;

Declare unit  varchar(50) CHARACTER SET utf8;

Declare li_tmp CURSOR FOR SELECT li_StationID, li_Station FROM tms_bd_LineInfo WHERE li_LineID IN(SELECT nri_LineID FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID=NoOfRunsID);

Declare jy_tmp CURSOR FOR SELECT nri_BeginSiteID,nri_BeginSite,nri_EndSiteID,nri_EndSite,nri_DepartureTime,nri_CheckTicketWindow,nri_Allticket,nri_AllowSell,nri_LoopDate,nri_StartDay,nri_RunDay,nri_StopDay,nri_IsStopOrCreat,nri_LineID,nri_StationDeal,nri_RunRegion,nri_DealCategory,nri_DealStyle FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID=NoOfRunsID;	

Declare qy_tmp CURSOR FOR SELECT nrl_ModelID, nrl_ModelName,nrl_BusID,nrl_BusCard,nrl_Seating,nrl_AddSeating,nrl_AllowHalfSeats,nrl_Loads FROM tms_bd_NoRunsLoop WHERE nrl_NoOfRunsID=NoOfRunsID AND nrl_LoopID=ttml_Orderno;

Declare sr_tmp CURSOR FOR SELECT sr_ReserveSeatNO,sr_ReserveSeatS FROM tms_bd_ScheduleReserve WHERE sr_NoOfRunsID = NoOfRunsID AND sr_ModelID=ttml_BusModelID;

Declare un_tmp CURSOR FOR SELECT bi_BusUnit FROM tms_bd_BusInfo WHERE bi_BusID=ttml_BusID;


Declare nds_tmp CURSOR FOR SELECT nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,nds_CheckInSite,nds_DepartureTime,nds_CheckTicketWindow,nds_IsServiceFee,nds_ServiceFee,nds_otherFee1,nds_otherFee2,nds_otherFee3,nds_otherFee4,nds_otherFee5,nds_otherFee6,nds_StintSell,nds_StintTime FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID=NoOfRunsID;

Declare tm_tmp CURSOR FOR SELECT nds_ID,nds_SiteName,nds_SiteID,nds_DepartureTime FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID = NoOfRunsID AND nds_ID >tmp_nds_ID AND nds_IsDock = 1;

Declare jy1_tmp CURSOR FOR SELECT si_Kilometer FROM tms_bd_SectionInfo WHERE si_SiteNameID=ppd_FromStationID AND si_LineID=ttml_LineID;

Declare jy2_tmp CURSOR FOR SELECT si_Kilometer FROM tms_bd_SectionInfo WHERE si_SiteNameID=ppd_ReachStationID AND si_LineID=ttml_LineID;

Declare jy3_tmp CURSOR FOR SELECT tpf_MoneyRenKil FROM tms_bd_TicketPriceFactor WHERE NoOfRunsdate>=tpf_BeginDate AND NoOfRunsdate<=tpf_EndDate AND tpf_ModelID=ttml_BusModelID;

Declare nnrap1_tmp CURSOR FOR SELECT nrap_RunPrice,nrap_HalfPrice,nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate AND nrap_NoRunsAdjust=NoOfRunsID AND nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=0 AND nrap_ModelID=ttml_BusModelID AND nrap_Unit=unit;
-- AND ttml_NoOfRunstime>=nrap_BeginTime and ttml_NoOfRunstime<=nrap_EndTime;
  
 

Declare nnrap2_tmp CURSOR FOR SELECT nrap_RunPrice,nrap_HalfPrice,nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND  NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate AND nrap_NoRunsAdjust=NoOfRunsID AND nrap_ISNoRunsAdjust=1 AND nrap_ISLineAdjust=0 AND nrap_ModelID=ttml_BusModelID;
 -- AND ttml_NoOfRunstime>=nrap_BeginTime and -- ttml_NoOfRunstime<=nrap_EndTime;
 

Declare nnrap3_tmp CURSOR FOR SELECT nrap_RunPrice,nrap_HalfPrice,nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND  NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate  AND nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=1 AND nrap_ModelID=ttml_BusModelID AND nrap_LineAdjust=ttml_LineID;
-- AND ttml_NoOfRunstime>=nrap_BeginTime and ttml_NoOfRunstime<=nrap_EndTime; 


 		
Declare ssfa1_tmp CURSOR FOR SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate AND sfa_NoRunsAdjust=NoOfRunsID AND sfa_ISNoRunsAdjust=0 AND sfa_ISLineAdjust=0 AND sfa_ModelID=ttml_BusModelID AND sfa_Unit=unit;
-- AND ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime;

Declare ssfa2_tmp CURSOR FOR SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate AND sfa_NoRunsAdjust=NoOfRunsID AND sfa_ISNoRunsAdjust=1 AND sfa_ISLineAdjust=0 AND sfa_ModelID=ttml_BusModelID;
-- AND ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime;

Declare ssfa3_tmp CURSOR FOR SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate  AND sfa_ISNoRunsAdjust=0 AND sfa_ISLineAdjust=1 AND sfa_ModelID=ttml_BusModelID AND nrap_LineAdjust=ttml_LineID;
-- AND ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime;


Declare CONTINUE HANDLER FOR NOT FOUND SET finished=1;

Start Transaction;
	SET intRetVal=0;
	SET ttml_NoOfRunsID=NoOfRunsID; 
	SET ttml_NoOfRunsdate=NoOfRunsdate;
--	SET ttml_busID='123';
-- ------	
	OPEN li_tmp;
	FETCH li_tmp INTO ttml_StationID, ttml_Station;
	CLOSE li_tmp;
-- --------
	SELECT COUNT(*) INTO longcount FROM tms_bd_ScheduleLong WHERE sl_NoOfRunsID=NoOfRunsID AND sl_BeginDate<=NoOfRunsdate AND sl_EndDate>=NoOfRunsdate;
	IF longcount>0 THEN
		SET ttml_StopRun=0;	
	ELSE
		SET ttml_StopRun=1;
	END IF;
-- -------
	OPEN jy_tmp;
	FETCH jy_tmp INTO ttml_BeginstationID, ttml_Beginstation, ttml_EndstationID, ttml_Endstation, ttml_NoOfRunstime, ttml_CheckTicketWindow, ttml_Allticket,ttml_AllowSell,LoopDate, StartDay, RunDay, StopDay, IsStopCreat, ttml_LineID, ttml_StationDeal, ttml_RunRegion, ttml_DealCategory,ttml_DealStyle;
	CLOSE  jy_tmp;
-- ---------
	SELECT COUNT(*) INTO rotatecount  FROM tms_bd_NoRunsLoop WHERE nrl_NoOfRunsID=NoOfRunsID;
	SET Startday=IFNULL(Startday,0)	;
	SET Runday=IFNULL(Runday,0);
	SET Stopday=IFNULL(Stopday,0);
	SET DayCount=DATEDIFF(NoOfRunsdate, LoopDate);
	SET DayCount=DayCount-StartDay;
	IF rotatecount>0 THEN
		IF Runday=0 and Stopday=0 THEN
			SET ttml_Orderno=(DayCount MOD rotatecount)+1;
		ELSE
			IF  DayCount MOD (RunDay+StopDay)<Runday THEN
				SET ttml_StopRun=1;
				SET ttml_Orderno=(((DayCount DIV (RunDay+StopDay))*RunDay+ DayCount MOD (RunDay+StopDay)) MOD rotatecount)+1;
			ELSE
				SET ttml_StopRun=0;
			END IF;
		END IF;
	END IF;
--  -----
	SELECT COUNT(*) INTO buscount FROM tms_bd_NoRunsLoop WHERE nrl_NoOfRunsID=NoOfRunsID AND nrl_LoopID=ttml_Orderno;	

	IF buscount=1 THEN
		OPEN qy_tmp;
		FETCH qy_tmp INTO ttml_BusModelID,ttml_BusModel,ttml_BusID,ttml_BusCard,ttml_Seats,ttml_AddSeats,ttml_LeaveHalfSeats,ttml_Loads;
		CLOSE qy_tmp;
	END IF;
	

	OPEN un_tmp;
	FETCH un_tmp INTO unit;
	CLOSE un_tmp;
	
-- ------
	SET ttml_TotalSeats=IFNULL(ttml_Seats,0)+IFNULL(ttml_AddSeats,0);
	SET ttml_LeaveHalfSeats=IFNULL(ttml_LeaveHalfSeats,0);
	SET ttml_LeaveSeats=ttml_TotalSeats;
	SET ttml_SeatStatus=REPEAT('0',ttml_TotalSeats);
	SET ttml_FullSeats=0;
	SET ttml_HalfSeats=0;
	SET ttml_ReserveSeats=0;
-- -------------
	SELECT COUNT(*)	INTO recount FROM tms_bd_ScheduleReserve WHERE sr_NoOfRunsID = NoOfRunsID AND sr_ModelID=ttml_BusModelID;
	IF recount!=0 THEN

		OPEN sr_tmp;
		FETCH sr_tmp INTO SString,ttml_ReserveSeats;
		CLOSE sr_tmp;
		WHILE SString!='' or SString!=NULL DO
			SET L=INSTR(SString,',');
			SET Lsub=LEFT(SString,L-1);
			SET SString=SUBSTRING(SString,L+1);
			SET ttml_SeatStatus=INSERT(ttml_SeatStatus,Lsub,1,'2');
		END WHILE;
		SET ttml_LeaveSeats=ttml_LeaveSeats-ttml_ReserveSeats;
	END IF;
-- -----
	SET ttml_Created=NOW();
	SET ttml_Createdby=userBy;
	SET ttml_Updated=NOW();
	SET ttml_updatedby=userby;
--	SET ttml_busID=IFNULL(ttml_busID,0);	
-- ---  
	IF ttml_Allticket=1 THEN 
		SET ttml_busID='######';
		SET ttml_BusModelID=NULL;
		SET ttml_BusModel=NULL;
		SET ttml_TotalSeats=NULL;
		SET ttml_LeaveSeats=NULL;
		SET ttml_Loads=NULL;	
		SET ttml_SeatStatus=NULL;
		SET ttml_FullSeats=NULL;
		SET ttml_HalfSeats=NULL;
		SET ttml_LeaveHalfSeats=NULL;
		SET ttml_ReserveSeats=NULL;  
	END IF;

-- if开始
	IF ttml_StopRun!=0  THEN
		INSERT INTO tms_bd_TicketMode (tml_NoOfRunsID,tml_LineID,tml_NoOfRunsdate,tml_NoOfRunstime,tml_BeginstationID,tml_Beginstation,tml_EndstationID,tml_Endstation,tml_CheckTicketWindow,tml_Loads,tml_SeatStatus,tml_TotalSeats,tml_LeaveSeats,tml_HalfSeats,tml_LeaveHalfSeats,tml_ReserveSeats,tml_StopRun,tml_Allticket,tml_AllowSell,tml_Orderno,tml_StationID,tml_Station,tml_Created,tml_Createdby,tml_Updated,tml_Updatedby,tml_BusModelID,tml_BusModel,tml_BusID,tml_BusCard,tml_FreeSeats,tml_LeaveFreeSeats,tml_StationDeal,tml_RunRegion,tml_DealCategory,tml_DealStyle) VALUES(ttml_NoOfRunsID,ttml_LineID,ttml_NoOfRunsdate,ttml_NoOfRunstime,ttml_BeginstationID,ttml_Beginstation,ttml_EndstationID,ttml_Endstation,ttml_CheckTicketWindow,ttml_Loads,ttml_SeatStatus,ttml_TotalSeats,ttml_LeaveSeats,ttml_HalfSeats,ttml_LeaveHalfSeats,ttml_ReserveSeats,ttml_StopRun,ttml_Allticket,ttml_AllowSell,ttml_Orderno,ttml_StationID,ttml_Station,ttml_Created,ttml_Createdby,ttml_Updated,ttml_Updatedby,ttml_BusModelID,ttml_BusModel,ttml_BusID,ttml_BusCard,ttml_FreeSeats,ttml_LeaveFreeSeats,ttml_StationDeal,ttml_RunRegion,ttml_DealCategory,ttml_DealStyle);
	
-- IF1 开始
	IF ttml_AllowSell=1 THEN

-- --------------
	OPEN nds_tmp;
	WHILE finished=0 DO

		FETCH nds_tmp INTO tmp_nds_ID,tmp_nds_SiteName,tmp_nds_SiteID,tmp_nds_IsDock,tmp_nds_GetOnSite,tmp_nds_CheckInSite,tmp_nds_DepartureTime,tmp_nds_CheckTicketWindow,tmp_nds_IsServiceFee,tmp_nds_ServiceFee,tmp_nds_otherFee1,tmp_nds_otherFee2,tmp_nds_otherFee3,tmp_nds_otherFee4,tmp_nds_otherFee5,tmp_nds_otherFee6,tmp_nds_StintSell,tmp_nds_StintTime;
		
		IF NOT finished THEN
			SET  ppd_CheckInSite=tmp_nds_CheckInSite;
			IF tmp_nds_GetOnSite=1 || tmp_nds_IsDock=1 THEN

				SET ppd_NoOfRunsID=NoOfRunsID; 
            			SET ppd_LineID=ttml_LineID;  
            			SET ppd_NoOfRunsdate=NoOfRunsdate;  
            			SET ppd_BeginStationTime=ttml_NoOfRunstime;   
            			SET ppd_BeginStationID=ttml_BeginstationID;   
            			SET ppd_BeginStation=ttml_Beginstation;   
            			SET ppd_FromStationID=tmp_nds_SiteID;   
            			SET ppd_FromStation=tmp_nds_SiteName;   
            			SET ppd_EndStationID=ttml_EndstationID;   
            			SET ppd_EndStation=ttml_Endstation;  
            			SET ppd_ServiceFee=tmp_nds_ServiceFee;  
            			SET ppd_otherFee1=tmp_nds_otherFee1;   
            			SET ppd_otherFee2=tmp_nds_otherFee2;   
            			SET ppd_otherFee3=tmp_nds_otherFee3;   
           			SET ppd_otherFee4=tmp_nds_otherFee4;   
            			SET ppd_otherFee5=tmp_nds_otherFee5;   
            			SET ppd_otherFee6=tmp_nds_otherFee6;   
            			SET ppd_StintSell=tmp_nds_StintSell;   
            			SET ppd_StintTime=tmp_nds_StintTime;   
            			SET ppd_IsPass=1; 
				IF ppd_FromStationID=ppd_BeginStationID THEN
					SET ppd_IsFromSite=1;
				ELSE
					SET ppd_IsFromSite=0;
				END IF;
				
				SELECT COUNT(*) INTO NUM1 FROM tms_bd_SectionInfo WHERE si_SiteNameID=ppd_FromStationID AND si_LineID=ttml_LineID; 

				IF NUM1=1 THEN
					OPEN jy1_tmp;
					FETCH jy1_tmp INTO FromStationKilometer;
					CLOSE jy1_tmp;	
			
				END IF;
--   -----------------------------				
				OPEN tm_tmp;
				WHILE finished=0 DO
					FETCH tm_tmp INTO nnds_ID,nnds_SiteName,nnds_SiteID,nnds_DepartureTime;

					IF NOT finished THEN
						SET ppd_ReachStationID=nnds_SiteID;   
            					SET ppd_ReachStation=nnds_SiteName; 
						SET ppd_StopStationTime=nnds_DepartureTime;

						SELECT COUNT(*) INTO NUM2 FROM tms_bd_SectionInfo WHERE si_SiteNameID=ppd_ReachStationID AND si_LineID=ttml_LineID; 
						IF NUM2=1 THEN
							OPEN jy2_tmp;
							FETCH jy2_tmp INTO ToStationKilometer;
							CLOSE jy2_tmp;
						END IF;

						SET ppd_Distance=ToStationKilometer-FromStationKilometer;
						SET TotalMoneyRenKil=0; 
						
						OPEN jy3_tmp;
						WHILE finished=0 DO
							FETCH jy3_tmp INTO ttp_MoneyRenKil;
							IF NOT finished THEN
								SET TotalMoneyRenKil=TotalMoneyRenKil+ttp_MoneyRenKil;
							END IF;
						END WHILE;
						CLOSE jy3_tmp;
						SET finished=0;
						
						SET ppd_StandardPrice=TotalMoneyRenKil*ppd_Distance;
						SET ppd_FullPrice=ppd_StandardPrice; 
						SET ppd_HalfPrice=round(ppd_FullPrice*0.5);
						
						
						
  						SELECT COUNT(*) INTO nnrap1 FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND  NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate AND nrap_NoRunsAdjust=NoOfRunsID AND nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=0 AND nrap_ModelID=ttml_BusModelID AND nrap_Unit=unit; 
-- 得加上协议单位-- AND ttml_NoOfRunstime>=nrap_BeginTime AND ttml_NoOfRunstime<=nrap_EndTime; 

						SELECT COUNT(*) INTO nnrap2 FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND  NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate AND nrap_NoRunsAdjust=NoOfRunsID AND nrap_ISNoRunsAdjust=1 AND nrap_ISLineAdjust=0 AND nrap_ModelID=ttml_BusModelID;
 -- AND ttml_NoOfRunstime>=nrap_BeginTime AND ttml_NoOfRunstime<=nrap_EndTime; 

						SELECT COUNT(*) INTO nnrap3 FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate AND nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=1 AND nrap_ModelID=ttml_BusModelID AND nrap_LineAdjust=ttml_LineID;
-- AND ttml_NoOfRunstime>=nrap_BeginTime AND ttml_NoOfRunstime<=nrap_EndTime; 

 
						IF nnrap1=1 THEN
							OPEN nnrap1_tmp;
							FETCH nnrap1_tmp INTO nnrap_RunPrice, nnrap_HalfPrice, nnrap_BalancePrice;
							SET ppd_FullPrice=nnrap_RunPrice; 
							SET ppd_HalfPrice=nnrap_HalfPrice;
							SET ppd_BalancePrice=nnrap_BalancePrice;
							CLOSE nnrap1_tmp;
						ELSE
							IF nnrap2=1 THEN
								OPEN nnrap2_tmp;
								FETCH nnrap2_tmp INTO nnrap_RunPrice, nnrap_HalfPrice,nnrap_BalancePrice;
								SET ppd_FullPrice=nnrap_RunPrice; 
								SET ppd_HalfPrice=nnrap_HalfPrice;
								SET ppd_BalancePrice=nnrap_BalancePrice;
								CLOSE nnrap2_tmp;
							ELSE
								IF nnrap3=1 THEN
									OPEN nnrap3_tmp;
									FETCH nnrap3_tmp INTO nnrap_RunPrice, nnrap_HalfPrice,nnrap_BalancePrice;
									SET ppd_FullPrice=nnrap_RunPrice; 
									SET ppd_HalfPrice=nnrap_HalfPrice;
									SET ppd_BalancePrice=nnrap_BalancePrice;
									CLOSE nnrap3_tmp;
								END IF;
							END IF;
						END IF; 


						SELECT COUNT(*) INTO ssfa1 FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate AND sfa_NoRunsAdjust=NoOfRunsID AND sfa_ISNoRunsAdjust=0 AND sfa_ISLineAdjust=0 AND sfa_ModelID=ttml_BusModelID AND sfa_Unit=unit;
-- ttml_BusModelID ;
-- ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime AND

						SELECT COUNT(*) INTO ssfa2 FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate AND sfa_NoRunsAdjust=NoOfRunsID AND sfa_ISNoRunsAdjust=1 AND sfa_ISLineAdjust=0 AND sfa_ModelID=ttml_BusModelID;
-- ttml_BusModelID ;
-- ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime AND

						SELECT COUNT(*) INTO ssfa3 FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate AND sfa_ISNoRunsAdjust=0 AND sfa_ISLineAdjust=1 AND sfa_ModelID=ttml_BusModelID AND sfa_LineAdjust=ttml_LineID; 
-- ttml_LineID;
-- ttml_BusModelID ;
-- ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime AND
			
						IF ssfa1=1 THEN
							OPEN ssfa1_tmp;
							FETCH ssfa1_tmp INTO ssfa_RunPrice;
							SET ppd_ServiceFee=ssfa_RunPrice; 
							CLOSE ssfa1_tmp;
						ELSE
							IF ssfa2=1 THEN
								OPEN ssfa2_tmp;
								FETCH ssfa2_tmp INTO ssfa_RunPrice;
								SET ppd_ServiceFee=ssfa_RunPrice; 
								CLOSE ssfa2_tmp;
							ELSE
								IF ssfa3=1 THEN
									OPEN ssfa3_tmp;
									FETCH ssfa3_tmp INTO ssfa_RunPrice;
									SET ppd_ServiceFee=ssfa_RunPrice; 
									CLOSE ssfa3_tmp;
								END IF;	
							END IF;
						END IF;


						SET ppd_StationID=ttml_StationID; 
            					SET ppd_Station=ttml_Station;   
            					SET ppd_Created=NOW();  
            					SET ppd_CreatedBY=userBY;   
            					SET ppd_Updated=NOW();   
            					SET ppd_UpdatedBY=userBY; 


						INSERT INTO tms_bd_PriceDetail (pd_NoOfRunsID,pd_LineID,pd_NoOfRunsdate,pd_BeginStationTime,pd_StopStationTime,pd_Distance,pd_BeginStationID,pd_BeginStation,pd_FromStationID,pd_FromStation,pd_ReachStationID,pd_ReachStation,pd_EndStationID,pd_EndStation,pd_FullPrice,pd_HalfPrice,pd_StandardPrice,pd_BalancePrice,pd_ServiceFee,pd_otherFee1,pd_otherFee2,pd_otherFee3,pd_otherFee4,pd_otherFee5,pd_otherFee6,pd_StationID,pd_Station,pd_Created,pd_CreatedBY,pd_Updated,pd_UpdatedBY,pd_IsPass,pd_CheckInSite,pd_IsFromSite,pd_StintSell,pd_StintTime) VALUES (ppd_NoOfRunsID,ppd_LineID,ppd_NoOfRunsdate,ppd_BeginStationTime,ppd_StopStationTime,ppd_Distance,ppd_BeginStationID,ppd_BeginStation,ppd_FromStationID,ppd_FromStation,ppd_ReachStationID,ppd_ReachStation,ppd_EndStationID,ppd_EndStation,IFNULL(ppd_FullPrice,0),IFNULL(ppd_HalfPrice,0),IFNULL(ppd_StandardPrice,0),IFNULL(ppd_BalancePrice,0),IFNULL(ppd_ServiceFee,0),IFNULL(ppd_otherFee1,0),IFNULL(ppd_otherFee2,0),IFNULL(ppd_otherFee3,0),IFNULL(ppd_otherFee4,0),IFNULL(ppd_otherFee5,0),IFNULL(ppd_otherFee6,0),ppd_StationID,ppd_Station,ppd_Created,ppd_CreatedBY,ppd_Updated,ppd_UpdatedBY,ppd_IsPass,ppd_CheckInSite,ppd_IsFromSite,ppd_StintSell,ppd_StintTime);  

					END IF;
				END WHILE;
				CLOSE tm_tmp;
				SET finished=0;


			END IF;		

		END IF;


	END WHILE;
	CLOSE nds_tmp; 
  END IF;
-- IF1 结束  
	
	SET intRetVal=1;
	
	END IF; -- if结束
commit;
END

//
CREATE PROCEDURE tms_bd_creatallticket(NoOfRunsID varchar(30), NoOfRunsdate char(10), BusID varchar(20), userBY varchar(50) CHARACTER SET utf8, OUT intRetVal int)
BEGIN
declare ttml_NoOfRunsID varchar(20);	
declare ttml_LineID varchar(30);
declare ttml_NoOfRunsdate char(10);	
declare ttml_NoOfRunstime char(5);	
declare ttml_BeginstationID varchar(20);	
declare ttml_Beginstation varchar(50) CHARACTER SET utf8;	
declare ttml_EndstationID varchar(20);	
declare ttml_Endstation varchar(50) CHARACTER SET utf8;	
declare ttml_CheckTicketWindow int;	
declare ttml_Loads int;
declare ttml_SeatStatus varchar(100);	
declare ttml_TotalSeats int;	
declare ttml_LeaveSeats int;
declare ttml_LeaveHalfSeats int;
declare ttml_Seats int;	
declare ttml_AddSeats int;	
declare ttml_FullSeats int;	
declare ttml_HalfSeats int;	
declare ttml_ReserveSeats int;	
declare ttml_StopRun tinyint;	
declare ttml_Allticket tinyint; 	
declare ttml_Orderno tinyint;	
declare ttml_StationID varchar(20);	
declare ttml_Station varchar(50) CHARACTER SET utf8;	
declare ttml_Created datetime;	
declare ttml_Createdby varchar(30) CHARACTER SET utf8;	
declare ttml_Updated datetime;	
declare ttml_Updatedby varchar(30) CHARACTER SET utf8;	
declare ttml_BusModelID varchar(20);	
declare ttml_BusModel varchar(50) CHARACTER SET utf8;	
declare ttml_BusID varchar(20);	
declare ttml_BusCard varchar(20) CHARACTER SET utf8;	
declare ttml_FreeSeats int;	
declare ttml_LeaveFreeSeats int;
declare ttml_StationDeal tinyint;  	
--
declare ttml_Orderno1 int;
--
declare ttml_RunRegion varchar(50) CHARACTER SET utf8;	
declare ttml_DealCategory varchar(20) CHARACTER SET utf8;	
declare ttml_DealStyle varchar(20) CHARACTER SET utf8;

declare LoopDate char(10);
declare StartDay int;
declare RunDay int;
declare StopDay int;
declare IsStopCreat tinyint;  
declare rotatecount int;
declare PriceCount int;
declare NoOfRunscount int;
declare longcount int;

Declare SString varchar(100);
Declare L int;
Declare Lsub varchar(10);


Declare FreeSeatsRate decimal(12,2);
Declare LeaveFreeSeatsRate decimal(12,2);

declare ppd_NoOfRunsID varchar(30);
declare ppd_LineID varchar(20);
declare ppd_NoOfRunsdate char(10);
declare ppd_BeginStationTime char(5);	
declare ppd_StopStationTime char(5);	
declare ppd_Distance decimal(12,2); 	
declare ppd_BeginStationID varchar(20);
declare ppd_BeginStation varchar(50) CHARACTER SET utf8;
declare ppd_FromStationID varchar(20);	
declare ppd_FromStation varchar(50) CHARACTER SET utf8;
declare ppd_ReachStationID varchar(20);	
declare ppd_ReachStation varchar(50) CHARACTER SET utf8;
declare ppd_EndStationID varchar(20);	
declare ppd_EndStation varchar(50) CHARACTER SET utf8;	
declare ppd_FullPrice decimal(12,2);	
declare ppd_HalfPrice decimal(12,2);	
declare ppd_StandardPrice decimal(12,2);
declare ppd_BalancePrice decimal(12,2);
declare ppd_ServiceFee decimal(12,2);	
declare ppd_otherFee1 decimal(12,2);	
declare ppd_otherFee2 decimal(12,2);	
declare ppd_otherFee3 decimal(12,2);	
declare ppd_otherFee4 decimal(12,2);	
declare ppd_otherFee5 decimal(12,2);	
declare ppd_otherFee6 decimal(12,2);	
declare ppd_StationID varchar(20);
declare ppd_Station varchar(50) CHARACTER SET utf8;	
declare ppd_Created datetime;	
declare ppd_CreatedBY varchar(30) CHARACTER SET utf8;
declare ppd_Updated datetime;	
declare ppd_UpdatedBY varchar(30) CHARACTER SET utf8;
declare ppd_IsPass tinyint; 
declare ppd_CheckInSite	tinyint;	
declare ppd_IsFromSite tinyint;	
declare ppd_StintSell tinyint;	
declare ppd_StintTime char(5);	


declare nnds_ID tinyint;
declare nnds_SiteName varchar(50) CHARACTER SET utf8;
declare nnds_SiteID varchar(20);
declare nnds_IsDock tinyint;
declare nnds_GetOnSite tinyint;
declare nnds_CheckInSite tinyint;
declare nnds_DepartureTime char(5);
declare nnds_CheckTicketWindow tinyint;
declare nnds_IsServiceFee tinyint;
declare nnds_ServiceFee decimal(12,2);
declare nnds_otherFee1 decimal(12,2);
declare nnds_otherFee2 decimal(12,2);
declare nnds_otherFee3 decimal(12,2);
declare nnds_otherFee4 decimal(12,2);
declare nnds_otherFee5 decimal(12,2);
declare nnds_otherFee6 decimal(12,2);
declare nnds_StintSell int;
declare nnds_StintTime char(5);

declare tmp_nds_ID tinyint;
declare tmp_nds_SiteName varchar(50) CHARACTER SET utf8;
declare tmp_nds_SiteID varchar(20);
declare tmp_nds_IsDock  tinyint;
declare tmp_nds_GetOnSite  tinyint;
declare tmp_nds_CheckInSite  tinyint;
declare tmp_nds_DepartureTime char(5);
declare tmp_nds_CheckTicketWindow tinyint;
declare tmp_nds_IsServiceFee tinyint;
declare tmp_nds_ServiceFee decimal(12,2);
declare tmp_nds_otherFee1 decimal(12,2);
declare tmp_nds_otherFee2 decimal(12,2);
declare tmp_nds_otherFee3 decimal(12,2);
declare tmp_nds_otherFee4 decimal(12,2);
declare tmp_nds_otherFee5 decimal(12,2);
declare tmp_nds_otherFee6 decimal(12,2);
declare tmp_nds_StintSell int;
declare tmp_nds_StintTime char(5);

Declare FromStationKilometer decimal(12,2);
Declare ToStationKilometer decimal(12,2);

declare ttpf_PriceProject varchar(20);
declare ttpf_BeginDate char(10);
declare ttpf_EndDate char(10);
declare ttpf_MoneyRenKil decimal(12,2);
declare TotalMoneyRenKil decimal(12,2);
Declare ttp_MoneyRenKil decimal(12,2);

declare nnrap_ISLineAdjust  tinyint;
declare nnrap_LineAdjust varchar(50);
declare nnrap_ISNoRunsAdjust tinyint;
declare nnrap_NoRunsAdjust varchar(30);
declare nnrap_DepartureSiteID varchar(20);
declare nnrap_DepartureSite varchar(50) CHARACTER SET utf8;
declare nnrap_GetToSiteID varchar(20);
declare nnrap_GetToSite varchar(50) CHARACTER SET utf8;
declare nnrap_ModelID varchar(20);
declare nnrap_ModelName varchar(50) CHARACTER SET utf8;
declare nnrap_BeginDate char(10);
declare nnrap_EndDate char(10);
declare nnrap_BeginTime char(5);
declare nnrap_EndTime char(5);
declare nnrap_ReferPrice decimal(12,2);
declare nnrap_PriceUpPercent decimal(12,2);
declare nnrap_RunPrice decimal(12,2);
declare nnrap_HalfPrice decimal(12,2);
declare nnrap_BalancePrice decimal(12,2);
declare nnrap_LinkAdjustPrice  Tinyint;

declare ssfa_ISLineAdjust  tinyint;
declare ssfa_LineAdjust varchar(50);
declare ssfa_ISNoRunsAdjust tinyint;
declare ssfa_NoRunsAdjust varchar(30);
declare ssfa_DepartureSiteID varchar(20);
declare ssfa_DepartureSite varchar(50) CHARACTER SET utf8; 
declare ssfa_GetToSiteID varchar(20);
declare ssfa_GetToSite varchar(50) CHARACTER SET utf8;
declare ssfa_ModelID varchar(20);
declare ssfa_ModelName varchar(50) CHARACTER SET utf8;
declare ssfa_BeginDate char(10);
declare ssfa_EndDate char(10);
declare ssfa_BeginTime char(5);
declare ssfa_EndTime char(5);
declare ssfa_RunPrice decimal(12,2);
declare ssfa_LinkAdjustPrice  Tinyint;

declare finished INTEGER DEFAULT 0;

declare  NUM1 INT;
declare  NUM2 INT;

Declare nnrap1 INT;
Declare nnrap2 INT;
Declare nnrap3 INT;
Declare ssfa1 INT;
Declare ssfa2 INT;
Declare ssfa3 INT;
Declare PricesCount INT;

Declare unit varchar(50) CHARACTER SET utf8;
Declare tttml_TotalSeats int;
Declare tttml_LeaveSeats int;


Declare li_tmp CURSOR FOR SELECT li_StationID, li_Station FROM tms_bd_LineInfo WHERE li_LineID IN(SELECT nri_LineID FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID=NoOfRunsID);

Declare jy_tmp CURSOR FOR SELECT nri_BeginSiteID,nri_BeginSite,nri_EndSiteID,nri_EndSite,nri_DepartureTime,nri_CheckTicketWindow,nri_Allticket,nri_LoopDate,nri_StartDay,nri_RunDay,nri_StopDay,nri_IsStopOrCreat,nri_LineID,nri_NoOfRunsID,nri_StationDeal,nri_RunRegion,nri_DealCategory,nri_DealStyle FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID=NoOfRunsID;	

Declare by_tmp CURSOR FOR SELECT bi_BusUnit, bi_BusTypeID, bi_BusType,bi_BusID,bi_BusNumber,bi_SeatS,bi_AddSeatS,bi_AllowHalfSeats FROM tms_bd_BusInfo WHERE bi_BusID=BusID;

-- Declare bm_tmp CURSOR FOR SELECT bm_AllowHalfSeats FROM tms_bd_BusModel WHERE bm_ModelID=ttml_BusModelID;

-- ---


Declare nds_tmp CURSOR FOR SELECT nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,nds_CheckInSite,nds_DepartureTime,nds_CheckTicketWindow,nds_IsServiceFee,nds_ServiceFee,nds_otherFee1,nds_otherFee2,nds_otherFee3,nds_otherFee4,nds_otherFee5,nds_otherFee6,nds_StintSell,nds_StintTime FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID=ttml_NoOfRunsID;

Declare tm_tmp CURSOR FOR SELECT nds_ID,nds_SiteName,nds_SiteID,nds_DepartureTime FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID=ttml_NoOfRunsID AND nds_ID >tmp_nds_ID AND nds_IsDock=1;

Declare jy1_tmp CURSOR FOR SELECT si_Kilometer FROM tms_bd_SectionInfo WHERE si_SiteNameID=ppd_FromStationID AND si_LineID=ttml_LineID;

Declare jy2_tmp CURSOR FOR SELECT si_Kilometer FROM tms_bd_SectionInfo WHERE si_SiteNameID=ppd_ReachStationID AND si_LineID=ttml_LineID;

Declare jy3_tmp CURSOR FOR SELECT tpf_MoneyRenKil FROM tms_bd_TicketPriceFactor WHERE NoOfRunsdate>=tpf_BeginDate AND NoOfRunsdate<=tpf_EndDate AND tpf_ModelID=ttml_BusModelID;

Declare tmd_tmp CURSOR FOR SELECT tml_TotalSeats, tml_LeaveSeats FROM tms_bd_TicketMode WHERE tml_NoOfRunsID=NoOfRunsID AND tml_NoOfRunsdate=NoOfRunsdate;

Declare nnrap1_tmp CURSOR FOR SELECT nrap_RunPrice,nrap_HalfPrice,nnrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice	WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND  NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate AND nrap_NoRunsAdjust=ttml_NoOfRunsID AND nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=0 AND nrap_ModelID=ttml_BusModelID AND nrap_Unit=unit;
-- AND ttml_NoOfRunstime>=nrap_BeginTime and ttml_NoOfRunstime<=nrap_EndTime;
  
 

Declare nnrap2_tmp CURSOR FOR SELECT nrap_RunPrice,nrap_HalfPrice,nnrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND  NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate AND nrap_NoRunsAdjust=ttml_NoOfRunsID AND nrap_ISNoRunsAdjust=1 AND nrap_ISLineAdjust=0 AND nrap_ModelID=ttml_BusModelID;
 -- AND ttml_NoOfRunstime>=nrap_BeginTime and -- ttml_NoOfRunstime<=nrap_EndTime;
 

Declare nnrap3_tmp CURSOR FOR SELECT nrap_RunPrice,nrap_HalfPrice,nnrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND  NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate  AND nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=1 AND nrap_ModelID=ttml_BusModelID AND nrap_LineAdjust=ttml_LineID;
-- AND ttml_NoOfRunstime>=nrap_BeginTime and ttml_NoOfRunstime<=nrap_EndTime; 


 		
Declare ssfa1_tmp CURSOR FOR SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate AND sfa_NoRunsAdjust=ttml_NoOfRunsID AND sfa_ISNoRunsAdjust=0 AND sfa_ISLineAdjust=0 AND sfa_ModelID=ttml_BusModelID AND sfa_Unit=unit;
-- AND ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime;

Declare ssfa2_tmp CURSOR FOR SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate AND sfa_NoRunsAdjust=ttml_NoOfRunsID AND sfa_ISNoRunsAdjust=1 AND sfa_ISLineAdjust=0 AND sfa_ModelID=ttml_BusModelID;
-- AND ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime;

Declare ssfa3_tmp CURSOR FOR SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate  AND sfa_ISNoRunsAdjust=0 AND sfa_ISLineAdjust=1 AND sfa_ModelID=ttml_BusModelID AND nrap_LineAdjust=ttml_LineID;
-- AND ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime ;


Declare CONTINUE HANDLER FOR NOT FOUND SET finished=1;

Start Transaction;
	SET intRetVal=0;
	SET ttml_NoOfRunsID=NoOfRunsID; 
	SET ttml_NoOfRunsdate=NoOfRunsdate;
	SET ttml_busID=busID;
-- ------	
	OPEN li_tmp;
	FETCH li_tmp INTO ttml_StationID, ttml_Station;
	CLOSE li_tmp;
-- --------
	
	OPEN jy_tmp;
	FETCH jy_tmp INTO ttml_BeginstationID, ttml_Beginstation, ttml_EndstationID, ttml_Endstation, ttml_NoOfRunstime, ttml_CheckTicketWindow, ttml_Allticket, LoopDate, StartDay, RunDay, StopDay, IsStopCreat,ttml_LineID, ttml_NoOfRunsID, ttml_StationDeal, ttml_RunRegion, ttml_DealCategory,ttml_DealStyle;
	CLOSE  jy_tmp;
-- -------
	SELECT COUNT(*) INTO longcount FROM tms_bd_ScheduleLong WHERE sl_NoOfRunsID=ttml_NoOfRunsID AND sl_BeginDate<=NoOfRunsdate AND sl_EndDate>=NoOfRunsdate;
	IF longcount>0 THEN
		SET ttml_StopRun=0;	
	ELSE
		SET ttml_StopRun=1;
	END IF;

	
-- -----
	
-- ------
	OPEN by_tmp;
	FETCH by_tmp INTO unit, ttml_BusModelID,ttml_BusModel,ttml_BusID,ttml_BusCard,ttml_Seats,ttml_AddSeats,ttml_LeaveHalfSeats;
	CLOSE by_tmp;

--	OPEN bm_tmp;
--	FETCH bm_tmp INTO ttml_LeaveHalfSeats;
--	CLOSE bm_tmp;

	OPEN tmd_tmp;
	FETCH tmd_tmp INTO tttml_TotalSeats, tttml_LeaveSeats;
	CLOSE tmd_tmp;

-- ------
	SET ttml_TotalSeats=IFNULL(ttml_Seats,0)+IFNULL(ttml_AddSeats,0);
	SET ttml_LeaveHalfSeats=IFNULL(ttml_LeaveHalfSeats,0);
	SET tttml_TotalSeats=IFNULL(tttml_TotalSeats,0);
	SET tttml_LeaveSeats=IFNULL(tttml_LeaveSeats,0);
	SET tttml_TotalSeats=tttml_TotalSeats+ttml_TotalSeats;
	SET tttml_LeaveSeats= tttml_LeaveSeats+ttml_TotalSeats;
-- -----
	SET ttml_Created=NOW();
	SET ttml_Createdby=userBy;
	SET ttml_Updated=NOW();
	SET ttml_updatedby=userby;
--	SET ttml_busID=IFNULL(ttml_busID,0);	
-- ---  
  
-- if开始
	IF ttml_StopRun!=0 and ttml_busID!=0 and ttml_Allticket!=0 THEN
			UPDATE tms_bd_TicketMode SET tml_NoOfRunsID=ttml_NoOfRunsID,tml_LineID=ttml_LineID,tml_NoOfRunsdate=ttml_NoOfRunsdate,tml_NoOfRunstime=ttml_NoOfRunstime,tml_BeginstationID=ttml_BeginstationID,tml_Beginstation=ttml_Beginstation,tml_EndstationID=ttml_EndstationID,tml_Endstation=ttml_Endstation,tml_CheckTicketWindow=ttml_CheckTicketWindow,tml_Loads=ttml_Loads,tml_SeatStatus=ttml_SeatStatus,tml_TotalSeats=tttml_TotalSeats,tml_LeaveSeats=tttml_LeaveSeats,tml_HalfSeats=ttml_HalfSeats,tml_LeaveHalfSeats=ttml_LeaveHalfSeats,tml_ReserveSeats=ttml_ReserveSeats,tml_StopRun=ttml_StopRun,tml_Allticket=ttml_Allticket,tml_Orderno=ttml_Orderno,tml_StationID=ttml_StationID,tml_Station=ttml_Station,tml_Created=ttml_Created,tml_Createdby=ttml_Createdby,tml_Updated=ttml_Updated,tml_Updatedby=ttml_Updatedby,tml_BusModelID=ttml_BusModelID,tml_BusModel=ttml_BusModel,tml_BusID='######',tml_BusCard=NULL,tml_FreeSeats=ttml_FreeSeats,tml_LeaveFreeSeats=ttml_LeaveFreeSeats,tml_StationDeal=ttml_StationDeal,tml_RunRegion=ttml_RunRegion,tml_DealCategory=ttml_DealCategory,tml_DealStyle=ttml_DealStyle WHERE tml_NoOfRunsID=ttml_NoOfRunsID AND tml_NoOfRunsdate=ttml_NoOfRunsdate;


-- --------------
	OPEN nds_tmp;
	WHILE finished=0 DO

		FETCH nds_tmp INTO tmp_nds_ID,tmp_nds_SiteName,tmp_nds_SiteID,tmp_nds_IsDock,tmp_nds_GetOnSite,tmp_nds_CheckInSite,tmp_nds_DepartureTime,tmp_nds_CheckTicketWindow,tmp_nds_IsServiceFee,tmp_nds_ServiceFee,tmp_nds_otherFee1,tmp_nds_otherFee2,tmp_nds_otherFee3,tmp_nds_otherFee4,tmp_nds_otherFee5,tmp_nds_otherFee6,tmp_nds_StintSell,tmp_nds_StintTime;
		
		IF NOT finished THEN
			SET  ppd_CheckInSite=tmp_nds_CheckInSite;
			IF tmp_nds_GetOnSite=1 || tmp_nds_IsDock=1 THEN

				SET ppd_NoOfRunsID=ttml_NoOfRunsID; 
            			SET ppd_LineID=ttml_LineID;  
            			SET ppd_NoOfRunsdate=NoOfRunsdate;  
            			SET ppd_BeginStationTime=ttml_NoOfRunstime;   
            			SET ppd_BeginStationID=ttml_BeginstationID;   
            			SET ppd_BeginStation=ttml_Beginstation;   
            			SET ppd_FromStationID=tmp_nds_SiteID;   
            			SET ppd_FromStation=tmp_nds_SiteName;   
            			SET ppd_EndStationID=ttml_EndstationID;   
            			SET ppd_EndStation=ttml_Endstation;  
            			SET ppd_ServiceFee=tmp_nds_ServiceFee;  
            			SET ppd_otherFee1=tmp_nds_otherFee1;   
            			SET ppd_otherFee2=tmp_nds_otherFee2;   
            			SET ppd_otherFee3=tmp_nds_otherFee3;   
           			SET ppd_otherFee4=tmp_nds_otherFee4;   
            			SET ppd_otherFee5=tmp_nds_otherFee5;   
            			SET ppd_otherFee6=tmp_nds_otherFee6;   
            			SET ppd_StintSell=tmp_nds_StintSell;   
            			SET ppd_StintTime=tmp_nds_StintTime;   
            			SET ppd_IsPass=1; 
				IF ppd_FromStationID=ppd_BeginStationID THEN
					SET ppd_IsFromSite=1;
				ELSE
					SET ppd_IsFromSite=0;
				END IF;
				
				SELECT COUNT(*) INTO NUM1 FROM tms_bd_SectionInfo WHERE si_SiteNameID=ppd_FromStationID AND si_LineID=ttml_LineID; 

				IF NUM1=1 THEN
					OPEN jy1_tmp;
					FETCH jy1_tmp INTO FromStationKilometer;
					CLOSE jy1_tmp;	
			
				END IF;
--   -----------------------------				
				OPEN tm_tmp;
				WHILE finished=0 DO
					FETCH tm_tmp INTO nnds_ID,nnds_SiteName,nnds_SiteID,nnds_DepartureTime;

					IF NOT finished THEN
						SET ppd_ReachStationID=nnds_SiteID;   
            					SET ppd_ReachStation=nnds_SiteName; 
						SET ppd_StopStationTime=nnds_DepartureTime;

						SELECT COUNT(*) INTO NUM2 FROM tms_bd_SectionInfo WHERE si_SiteNameID=ppd_ReachStationID AND si_LineID=ttml_LineID; 
						IF NUM2=1 THEN
							OPEN jy2_tmp;
							FETCH jy2_tmp INTO ToStationKilometer;
							CLOSE jy2_tmp;
						END IF;

						SET ppd_Distance=ToStationKilometer-FromStationKilometer;
						SET TotalMoneyRenKil=0; 
						
						OPEN jy3_tmp;
						WHILE finished=0 DO
							FETCH jy3_tmp INTO ttp_MoneyRenKil;
							IF NOT finished THEN
								SET TotalMoneyRenKil=TotalMoneyRenKil+ttp_MoneyRenKil;
							END IF;
						END WHILE;
						CLOSE jy3_tmp;
						SET finished=0;
						
						SET ppd_StandardPrice=TotalMoneyRenKil*ppd_Distance;
						SET ppd_FullPrice=ppd_StandardPrice; 
						SET ppd_HalfPrice=round(ppd_FullPrice*0.5);
						
						
						
  						SELECT COUNT(*) INTO nnrap1 FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND  NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate AND nrap_NoRunsAdjust=ttml_NoOfRunsID AND nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=0 AND nrap_ModelID=ttml_BusModelID AND nrap_Unit=unit; 
-- AND ttml_NoOfRunstime>=nrap_BeginTime AND ttml_NoOfRunstime<=nrap_EndTime; 

						SELECT COUNT(*) INTO nnrap2 FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND  NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate AND nrap_NoRunsAdjust=ttml_NoOfRunsID AND nrap_ISNoRunsAdjust=1 AND nrap_ISLineAdjust=0 AND nrap_ModelID=ttml_BusModelID;
 -- AND ttml_NoOfRunstime>=nrap_BeginTime AND ttml_NoOfRunstime<=nrap_EndTime; 

						SELECT COUNT(*) INTO nnrap3 FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate AND nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=1 AND nrap_ModelID=ttml_BusModelID AND nrap_LineAdjust=ttml_LineID;
-- AND ttml_NoOfRunstime>=nrap_BeginTime AND ttml_NoOfRunstime<=nrap_EndTime; 

 
						IF nnrap1=1 THEN
							OPEN nnrap1_tmp;
							FETCH nnrap1_tmp INTO nnrap_RunPrice, nnrap_HalfPrice,nnrap_BalancePrice;
							SET ppd_FullPrice=nnrap_RunPrice; 
							SET ppd_HalfPrice=nnrap_HalfPrice;
							SET ppd_BalancePrice=nnrap_BalancePrice;
							CLOSE nnrap1_tmp;
						ELSE
							IF nnrap2=1 THEN
								OPEN nnrap2_tmp;
								FETCH nnrap2_tmp INTO nnrap_RunPrice, nnrap_HalfPrice,nnrap_BalancePrice;
								SET ppd_FullPrice=nnrap_RunPrice; 
								SET ppd_HalfPrice=nnrap_HalfPrice;
								SET ppd_BalancePrice=nnrap_BalancePrice;
								CLOSE nnrap2_tmp;
							ELSE
								IF nnrap3=1 THEN
									OPEN nnrap3_tmp;
									FETCH nnrap3_tmp INTO nnrap_RunPrice, nnrap_HalfPrice,nnrap_BalancePrice;
									SET ppd_FullPrice=nnrap_RunPrice; 
									SET ppd_HalfPrice=nnrap_HalfPrice;
									SET ppd_BalancePrice=nnrap_BalancePrice;
									CLOSE nnrap3_tmp;
								END IF;
							END IF;
						END IF; 


						SELECT COUNT(*) INTO ssfa1 FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate AND sfa_NoRunsAdjust=ttml_NoOfRunsID AND sfa_ISNoRunsAdjust=0 AND sfa_ISLineAdjust=0 AND sfa_ModelID=ttml_BusModelID AND sfa_Unit=unit;
-- ttml_BusModelID ;
-- ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime AND

						SELECT COUNT(*) INTO ssfa2 FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate AND sfa_NoRunsAdjust=ttml_NoOfRunsID AND sfa_ISNoRunsAdjust=1 AND sfa_ISLineAdjust=0 AND sfa_ModelID=ttml_BusModelID;
-- ttml_BusModelID ;
-- ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime AND

						SELECT COUNT(*) INTO ssfa3 FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate AND sfa_ISNoRunsAdjust=0 AND sfa_ISLineAdjust=1 AND sfa_ModelID=ttml_BusModelID AND sfa_LineAdjust=ttml_LineID; 
-- ttml_LineID;
-- ttml_BusModelID ;
-- ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime AND
			
						IF ssfa1=1 THEN
							OPEN ssfa1_tmp;
							FETCH ssfa1_tmp INTO ssfa_RunPrice;
							SET ppd_ServiceFee=ssfa_RunPrice; 
							CLOSE ssfa1_tmp;
						ELSE
							IF ssfa2=1 THEN
								OPEN ssfa2_tmp;
								FETCH ssfa2_tmp INTO ssfa_RunPrice;
								SET ppd_ServiceFee=ssfa_RunPrice; 
								CLOSE ssfa2_tmp;
							ELSE
								IF ssfa3=1 THEN
									OPEN ssfa3_tmp;
									FETCH ssfa3_tmp INTO ssfa_RunPrice;
									SET ppd_ServiceFee=ssfa_RunPrice; 
									CLOSE ssfa3_tmp;
								END IF;	
							END IF;
						END IF;


						SET ppd_StationID=ttml_StationID; 
            					SET ppd_Station=ttml_Station;   
            					SET ppd_Created=NOW();  
            					SET ppd_CreatedBY=userBY;   
            					SET ppd_Updated=NOW();   
            					SET ppd_UpdatedBY=userBY; 
						
						SELECT COUNT(*) INTO PricesCount FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID=ppd_NoOfRunsID AND pd_NoOfRunsdate=ppd_NoOfRunsdate AND pd_FromStationID=ppd_FromStationID AND pd_ReachStationID=ppd_ReachStationID;
						IF PricesCount>0 THEN
							UPDATE tms_bd_PriceDetail SET pd_NoOfRunsID=ppd_NoOfRunsID,pd_LineID=ppd_LineID,pd_NoOfRunsdate=ppd_NoOfRunsdate, pd_BeginStationTime=ppd_BeginStationTime,pd_StopStationTime=ppd_StopStationTime,pd_Distance=ppd_Distance,pd_BeginStationID=ppd_BeginStationID,pd_BeginStation=ppd_BeginStation,pd_FromStationID=ppd_FromStationID,pd_FromStation=ppd_FromStation,pd_ReachStationID=ppd_ReachStationID,pd_ReachStation=ppd_ReachStation,pd_EndStationID=ppd_EndStationID, pd_EndStation=ppd_EndStation,pd_FullPrice=ppd_FullPrice,pd_HalfPrice=ppd_HalfPrice,pd_StandardPrice=ppd_StandardPrice,pd_BalancePrice=ppd_BalancePrice,pd_ServiceFee=ppd_ServiceFee,pd_otherFee1=ppd_otherFee1,pd_otherFee2=ppd_otherFee2,pd_otherFee3=ppd_otherFee3,pd_otherFee4=ppd_otherFee4,pd_otherFee5=ppd_otherFee5,pd_otherFee6=ppd_otherFee6,pd_StationID=ppd_StationID,pd_Station=ppd_Station,pd_Created=ppd_Created,pd_CreatedBY=ppd_CreatedBY,pd_Updated=ppd_Updated,pd_UpdatedBY=ppd_UpdatedBY,pd_IsPass=ppd_IsPass,pd_CheckInSite=ppd_CheckInSite,pd_IsFromSite=ppd_IsFromSite,pd_StintSell=ppd_StintSell,pd_StintTime=ppd_StintTime WHERE pd_NoOfRunsID=ppd_NoOfRunsID AND pd_NoOfRunsdate=ppd_NoOfRunsdate AND pd_FromStationID=ppd_FromStationID AND pd_ReachStationID=ppd_ReachStationID;
						ELSE
							INSERT INTO tms_bd_PriceDetail (pd_NoOfRunsID,pd_LineID,pd_NoOfRunsdate,pd_BeginStationTime,pd_StopStationTime,pd_Distance,pd_BeginStationID,pd_BeginStation,pd_FromStationID,pd_FromStation,pd_ReachStationID,pd_ReachStation,pd_EndStationID,pd_EndStation,pd_FullPrice,pd_HalfPrice,pd_StandardPrice,pd_BalancePrice,pd_ServiceFee,pd_otherFee1,pd_otherFee2,pd_otherFee3,pd_otherFee4,pd_otherFee5,pd_otherFee6,pd_StationID,pd_Station,pd_Created,pd_CreatedBY,pd_Updated,pd_UpdatedBY,pd_IsPass,pd_CheckInSite,pd_IsFromSite,pd_StintSell,pd_StintTime) VALUES (ppd_NoOfRunsID,ppd_LineID,ppd_NoOfRunsdate,ppd_BeginStationTime,ppd_StopStationTime,ppd_Distance,ppd_BeginStationID,ppd_BeginStation,ppd_FromStationID,ppd_FromStation,ppd_ReachStationID,ppd_ReachStation,ppd_EndStationID,ppd_EndStation,ppd_FullPrice,ppd_HalfPrice,ppd_StandardPrice,ppd_BalancePrice,ppd_ServiceFee,ppd_otherFee1,ppd_otherFee2,ppd_otherFee3,ppd_otherFee4,ppd_otherFee5,ppd_otherFee6,ppd_StationID,ppd_Station,ppd_Created,ppd_CreatedBY,ppd_Updated,ppd_UpdatedBY,ppd_IsPass,ppd_CheckInSite,ppd_IsFromSite,ppd_StintSell,ppd_StintTime);  
						END IF;


					END IF;
				END WHILE;
				CLOSE tm_tmp;
				SET finished=0;


			END IF;		

		END IF;


	END WHILE;
	CLOSE nds_tmp; 
	
	SET intRetVal=1;

--	ESLE
--		SET intRetVal=0;	
	END IF; -- if结束
commit;
END

//
CREATE PROCEDURE tms_bd_updatenotallticket(NoOfRunsID varchar(30), NoOfRunsdate char(10), BusID varchar(20), userBY varchar(50) CHARACTER SET utf8, OUT intRetVal int)
BEGIN
declare ttml_NoOfRunsID varchar(20);	
declare ttml_LineID varchar(30);
declare ttml_NoOfRunsdate char(10);	
declare ttml_NoOfRunstime char(5);	
declare ttml_BeginstationID varchar(20);	
declare ttml_Beginstation varchar(50) CHARACTER SET utf8;	
declare ttml_EndstationID varchar(20);	
declare ttml_Endstation varchar(50) CHARACTER SET utf8;	
declare ttml_CheckTicketWindow int;	
declare ttml_Loads int;
declare ttml_SeatStatus varchar(100);	
declare ttml_TotalSeats int;	
declare ttml_LeaveSeats int;
declare ttml_LeaveHalfSeats int;
declare ttml_Seats int;	
declare ttml_AddSeats int;	
declare ttml_FullSeats int;	
declare ttml_HalfSeats int;	
declare ttml_ReserveSeats int;	
declare ttml_StopRun tinyint;	
declare ttml_Allticket tinyint;
declare ttml_AllowSell tinyint; 	
declare ttml_Orderno tinyint;	
declare ttml_StationID varchar(20);	
declare ttml_Station varchar(50) CHARACTER SET utf8;	
declare ttml_Created datetime;	
declare ttml_Createdby varchar(30) CHARACTER SET utf8;	
declare ttml_Updated datetime;	
declare ttml_Updatedby varchar(30) CHARACTER SET utf8;	
declare ttml_BusModelID varchar(20);	
declare ttml_BusModel varchar(50) CHARACTER SET utf8;	
declare ttml_BusID varchar(20);	
declare ttml_BusCard varchar(20) CHARACTER SET utf8;	
declare ttml_FreeSeats int;	
declare ttml_LeaveFreeSeats int;
declare ttml_StationDeal tinyint;  	
--
declare ttml_Orderno1 int;
--
declare ttml_RunRegion varchar(50) CHARACTER SET utf8;	
declare ttml_DealCategory varchar(20) CHARACTER SET utf8;	
declare ttml_DealStyle varchar(20) CHARACTER SET utf8;

declare LoopDate char(10);
declare StartDay int;
declare RunDay int;
declare StopDay int;
declare IsStopCreat tinyint;  
declare rotatecount int;
declare PriceCount int;
declare NoOfRunscount int;
declare longcount int;

Declare SString varchar(100);
Declare L int;
Declare Lsub varchar(10);


Declare FreeSeatsRate decimal(12,2);
Declare LeaveFreeSeatsRate decimal(12,2);

declare ppd_NoOfRunsID varchar(30);
declare ppd_LineID varchar(20);
declare ppd_NoOfRunsdate char(10);
declare ppd_BeginStationTime char(5);	
declare ppd_StopStationTime char(5);	
declare ppd_Distance decimal(12,2); 	
declare ppd_BeginStationID varchar(20);
declare ppd_BeginStation varchar(50) CHARACTER SET utf8;
declare ppd_FromStationID varchar(20);	
declare ppd_FromStation varchar(50) CHARACTER SET utf8;
declare ppd_ReachStationID varchar(20);	
declare ppd_ReachStation varchar(50) CHARACTER SET utf8;
declare ppd_EndStationID varchar(20);	
declare ppd_EndStation varchar(50) CHARACTER SET utf8;	
declare ppd_FullPrice decimal(12,2);	
declare ppd_HalfPrice decimal(12,2);	
declare ppd_StandardPrice decimal(12,2);
declare ppd_BalancePrice decimal(12,2);
declare ppd_ServiceFee decimal(12,2);	
declare ppd_otherFee1 decimal(12,2);	
declare ppd_otherFee2 decimal(12,2);	
declare ppd_otherFee3 decimal(12,2);	
declare ppd_otherFee4 decimal(12,2);	
declare ppd_otherFee5 decimal(12,2);	
declare ppd_otherFee6 decimal(12,2);	
declare ppd_StationID varchar(20);
declare ppd_Station varchar(50) CHARACTER SET utf8;	
declare ppd_Created datetime;	
declare ppd_CreatedBY varchar(30) CHARACTER SET utf8;
declare ppd_Updated datetime;	
declare ppd_UpdatedBY varchar(30) CHARACTER SET utf8;
declare ppd_IsPass tinyint; 
declare ppd_CheckInSite	tinyint;	
declare ppd_IsFromSite tinyint;	
declare ppd_StintSell tinyint;	
declare ppd_StintTime char(5);	


declare nnds_ID tinyint;
declare nnds_SiteName varchar(50) CHARACTER SET utf8;
declare nnds_SiteID varchar(20);
declare nnds_IsDock tinyint;
declare nnds_GetOnSite tinyint;
declare nnds_CheckInSite tinyint;
declare nnds_DepartureTime char(5);
declare nnds_CheckTicketWindow tinyint;
declare nnds_IsServiceFee tinyint;
declare nnds_ServiceFee decimal(12,2);
declare nnds_otherFee1 decimal(12,2);
declare nnds_otherFee2 decimal(12,2);
declare nnds_otherFee3 decimal(12,2);
declare nnds_otherFee4 decimal(12,2);
declare nnds_otherFee5 decimal(12,2);
declare nnds_otherFee6 decimal(12,2);
declare nnds_StintSell int;
declare nnds_StintTime char(5);

declare tmp_nds_ID tinyint;
declare tmp_nds_SiteName varchar(50) CHARACTER SET utf8;
declare tmp_nds_SiteID varchar(20);
declare tmp_nds_IsDock  tinyint;
declare tmp_nds_GetOnSite  tinyint;
declare tmp_nds_CheckInSite  tinyint;
declare tmp_nds_DepartureTime char(5);
declare tmp_nds_CheckTicketWindow tinyint;
declare tmp_nds_IsServiceFee tinyint;
declare tmp_nds_ServiceFee decimal(12,2);
declare tmp_nds_otherFee1 decimal(12,2);
declare tmp_nds_otherFee2 decimal(12,2);
declare tmp_nds_otherFee3 decimal(12,2);
declare tmp_nds_otherFee4 decimal(12,2);
declare tmp_nds_otherFee5 decimal(12,2);
declare tmp_nds_otherFee6 decimal(12,2);
declare tmp_nds_StintSell int;
declare tmp_nds_StintTime char(5);

Declare FromStationKilometer decimal(12,2);
Declare ToStationKilometer decimal(12,2);

declare ttpf_PriceProject varchar(20);
declare ttpf_BeginDate char(10);
declare ttpf_EndDate char(10);
declare ttpf_MoneyRenKil decimal(12,2);
declare TotalMoneyRenKil decimal(12,2);
Declare ttp_MoneyRenKil decimal(12,2);

declare nnrap_ISLineAdjust  tinyint;
declare nnrap_LineAdjust varchar(50);
declare nnrap_ISNoRunsAdjust tinyint;
declare nnrap_NoRunsAdjust varchar(30);
declare nnrap_DepartureSiteID varchar(20);
declare nnrap_DepartureSite varchar(50) CHARACTER SET utf8;
declare nnrap_GetToSiteID varchar(20);
declare nnrap_GetToSite varchar(50) CHARACTER SET utf8;
declare nnrap_ModelID varchar(20);
declare nnrap_ModelName varchar(50) CHARACTER SET utf8;
declare nnrap_BeginDate char(10);
declare nnrap_EndDate char(10);
declare nnrap_BeginTime char(5);
declare nnrap_EndTime char(5);
declare nnrap_ReferPrice decimal(12,2);
declare nnrap_PriceUpPercent decimal(12,2);
declare nnrap_RunPrice decimal(12,2);
declare nnrap_HalfPrice decimal(12,2);
declare nnrap_BalancePrice decimal(12,2);
declare nnrap_LinkAdjustPrice  Tinyint;

declare ssfa_ISLineAdjust  tinyint;
declare ssfa_LineAdjust varchar(50);
declare ssfa_ISNoRunsAdjust tinyint;
declare ssfa_NoRunsAdjust varchar(30);
declare ssfa_DepartureSiteID varchar(20);
declare ssfa_DepartureSite varchar(50) CHARACTER SET utf8; 
declare ssfa_GetToSiteID varchar(20);
declare ssfa_GetToSite varchar(50) CHARACTER SET utf8;
declare ssfa_ModelID varchar(20);
declare ssfa_ModelName varchar(50) CHARACTER SET utf8;
declare ssfa_BeginDate char(10);
declare ssfa_EndDate char(10);
declare ssfa_BeginTime char(5);
declare ssfa_EndTime char(5);
declare ssfa_RunPrice decimal(12,2);
declare ssfa_LinkAdjustPrice  Tinyint;

declare finished INTEGER DEFAULT 0;

declare  NUM1 INT;
declare  NUM2 INT;

Declare nnrap1 INT;
Declare nnrap2 INT;
Declare nnrap3 INT;
Declare ssfa1 INT;
Declare ssfa2 INT;
Declare ssfa3 INT;
Declare PricesCount INT;


declare recount int;

Declare unit varchar(50) CHARACTER SET utf8;

Declare li_tmp CURSOR FOR SELECT li_StationID, li_Station FROM tms_bd_LineInfo WHERE li_LineID IN(SELECT nri_LineID FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID=NoOfRunsID);

Declare jy_tmp CURSOR FOR SELECT nri_BeginSiteID,nri_BeginSite,nri_EndSiteID,nri_EndSite,nri_DepartureTime,nri_CheckTicketWindow,nri_Allticket,nri_LoopDate,nri_StartDay,nri_RunDay,nri_StopDay,nri_IsStopOrCreat,nri_LineID,nri_NoOfRunsID,nri_StationDeal,nri_RunRegion,nri_DealCategory,nri_DealStyle FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID=NoOfRunsID;	

Declare by_tmp CURSOR FOR SELECT bi_BusUnit, bi_BusTypeID, bi_BusType,bi_BusID,bi_BusNumber,bi_SeatS, bi_AddSeatS, bi_AllowHalfSeats FROM tms_bd_BusInfo WHERE bi_BusID=BusID;

-- Declare bm_tmp CURSOR FOR SELECT bm_AllowHalfSeats FROM tms_bd_BusModel WHERE bm_ModelID=ttml_BusModelID;

-- ---
Declare sr_tmp CURSOR FOR SELECT sr_ReserveSeatNO,sr_ReserveSeatS FROM tms_bd_ScheduleReserve WHERE sr_NoOfRunsID = NoOfRunsID AND sr_ModelID=ttml_BusModelID;


Declare nds_tmp CURSOR FOR SELECT nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,nds_CheckInSite,nds_DepartureTime,nds_CheckTicketWindow,nds_IsServiceFee,nds_ServiceFee,nds_otherFee1,nds_otherFee2,nds_otherFee3,nds_otherFee4,nds_otherFee5,nds_otherFee6,nds_StintSell,nds_StintTime FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID=ttml_NoOfRunsID;

Declare tm_tmp CURSOR FOR SELECT nds_ID,nds_SiteName,nds_SiteID,nds_DepartureTime FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID=ttml_NoOfRunsID AND nds_ID >tmp_nds_ID AND nds_IsDock=1;

Declare jy1_tmp CURSOR FOR SELECT si_Kilometer FROM tms_bd_SectionInfo WHERE si_SiteNameID=ppd_FromStationID AND si_LineID=ttml_LineID;

Declare jy2_tmp CURSOR FOR SELECT si_Kilometer FROM tms_bd_SectionInfo WHERE si_SiteNameID=ppd_ReachStationID AND si_LineID=ttml_LineID;

Declare jy3_tmp CURSOR FOR SELECT tpf_MoneyRenKil FROM tms_bd_TicketPriceFactor WHERE NoOfRunsdate>=tpf_BeginDate AND NoOfRunsdate<=tpf_EndDate AND tpf_ModelID=ttml_BusModelID;

Declare nnrap1_tmp CURSOR FOR SELECT nrap_RunPrice,nrap_HalfPrice,nnrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice	WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND  NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate AND nrap_NoRunsAdjust=ttml_NoOfRunsID AND nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=0 AND nrap_ModelID=ttml_BusModelID;
-- AND ttml_NoOfRunstime>=nrap_BeginTime and ttml_NoOfRunstime<=nrap_EndTime;
  
 

Declare nnrap2_tmp CURSOR FOR SELECT nrap_RunPrice,nrap_HalfPrice,nnrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice	WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND  NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate AND nrap_NoRunsAdjust=ttml_NoOfRunsID AND nrap_ISNoRunsAdjust=1 AND nrap_ISLineAdjust=0 AND nrap_ModelID=ttml_BusModelID;
 -- AND ttml_NoOfRunstime>=nrap_BeginTime and -- ttml_NoOfRunstime<=nrap_EndTime;
 

Declare nnrap3_tmp CURSOR FOR SELECT nrap_RunPrice,nrap_HalfPrice,nnrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice	WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND  NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate  AND nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=1 AND nrap_ModelID=ttml_BusModelID AND nrap_LineAdjust=ttml_LineID;
-- AND ttml_NoOfRunstime>=nrap_BeginTime and ttml_NoOfRunstime<=nrap_EndTime; 


 		
Declare ssfa1_tmp CURSOR FOR SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate AND sfa_NoRunsAdjust=ttml_NoOfRunsID AND sfa_ISNoRunsAdjust=0 AND sfa_ISLineAdjust=0 AND sfa_ModelID=ttml_BusModelID;
-- AND ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime;

Declare ssfa2_tmp CURSOR FOR SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate AND sfa_NoRunsAdjust=ttml_NoOfRunsID AND sfa_ISNoRunsAdjust=1 AND sfa_ISLineAdjust=0 AND sfa_ModelID=ttml_BusModelID;
-- AND ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime;

Declare ssfa3_tmp CURSOR FOR SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate  AND sfa_ISNoRunsAdjust=0 AND sfa_ISLineAdjust=1 AND sfa_ModelID=ttml_BusModelID AND nrap_LineAdjust=ttml_LineID;
-- AND ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime ;


Declare CONTINUE HANDLER FOR NOT FOUND SET finished=1;

Start Transaction;
	SET intRetVal=0;
	SET ttml_NoOfRunsID=NoOfRunsID; 
	SET ttml_NoOfRunsdate=NoOfRunsdate;
	SET ttml_busID=busID;
-- ------	
	OPEN li_tmp;
	FETCH li_tmp INTO ttml_StationID, ttml_Station;
	CLOSE li_tmp;
-- --------
	
	OPEN jy_tmp;
	FETCH jy_tmp INTO ttml_BeginstationID, ttml_Beginstation, ttml_EndstationID, ttml_Endstation, ttml_NoOfRunstime, ttml_CheckTicketWindow, ttml_Allticket, LoopDate, StartDay, RunDay, StopDay, IsStopCreat,ttml_LineID,ttml_NoOfRunsID, ttml_StationDeal, ttml_RunRegion, ttml_DealCategory,ttml_DealStyle;
	CLOSE  jy_tmp;
-- -------
	SELECT COUNT(*) INTO longcount FROM tms_bd_ScheduleLong WHERE sl_NoOfRunsID=ttml_NoOfRunsID AND sl_BeginDate<=NoOfRunsdate AND sl_EndDate>=NoOfRunsdate;
	IF longcount>0 THEN
		SET ttml_StopRun=0;	
	ELSE
		SET ttml_StopRun=1;
	END IF;

	
-- -----
	
-- ------
	OPEN by_tmp;
	FETCH by_tmp INTO unit, ttml_BusModelID,ttml_BusModel,ttml_BusID,ttml_BusCard,ttml_Seats, ttml_AddSeats,ttml_LeaveHalfSeats;
	CLOSE by_tmp;

--	OPEN bm_tmp;
--	FETCH bm_tmp INTO ttml_LeaveHalfSeats;
--	CLOSE bm_tmp;

-- ------
	
	SET ttml_TotalSeats=IFNULL(ttml_Seats,0)+IFNULL(ttml_AddSeats,0);
	SET ttml_LeaveSeats=ttml_TotalSeats;
	SET ttml_LeaveHalfSeats=IFNULL(ttml_LeaveHalfSeats,0);
	SET ttml_SeatStatus=REPEAT('0',ttml_TotalSeats);
	SET ttml_FullSeats=0;
	SET ttml_HalfSeats=0;
	SET ttml_ReserveSeats=0;
-- -------------
	SELECT COUNT(*)	INTO recount FROM tms_bd_ScheduleReserve WHERE sr_NoOfRunsID = NoOfRunsID AND sr_ModelID=ttml_BusModelID;
	IF recount!=0 THEN
		OPEN sr_tmp;
		FETCH sr_tmp INTO SString,ttml_ReserveSeats;
		CLOSE sr_tmp;
		WHILE SString!='' or SString!=NULL DO
			SET L=INSTR(SString,',');
			SET Lsub=LEFT(SString,L-1);
			SET SString=SUBSTRING(SString,L+1);
			SET ttml_SeatStatus=INSERT(ttml_SeatStatus,Lsub,1,'2');
		END WHILE;
		SET ttml_LeaveSeats=ttml_LeaveSeats-ttml_ReserveSeats;
	END IF;
-- -----
	SET ttml_Created=NOW();
	SET ttml_Createdby=userBy;
	SET ttml_Updated=NOW();
	SET ttml_updatedby=userby;
	SET ttml_busID=IFNULL(ttml_busID,0);
	SET ttml_AllowSell='1';	
-- ---  
-- if开始
	IF ttml_StopRun!=0 and ttml_busID!=0 THEN
		UPDATE tms_bd_TicketMode SET tml_NoOfRunsID=ttml_NoOfRunsID,tml_LineID=ttml_LineID,tml_NoOfRunsdate=ttml_NoOfRunsdate,tml_NoOfRunstime=ttml_NoOfRunstime,tml_BeginstationID=ttml_BeginstationID,tml_EndstationID=ttml_EndstationID,tml_CheckTicketWindow=ttml_CheckTicketWindow,tml_Loads=ttml_Loads,tml_SeatStatus=ttml_SeatStatus,tml_TotalSeats=ttml_TotalSeats,tml_LeaveSeats=ttml_LeaveSeats,tml_HalfSeats=ttml_HalfSeats,tml_LeaveHalfSeats=ttml_LeaveHalfSeats,tml_ReserveSeats=ttml_ReserveSeats,tml_StopRun=ttml_StopRun,tml_Allticket=ttml_Allticket,tml_Orderno=ttml_Orderno,tml_StationID=ttml_StationID,tml_Station=ttml_Station,tml_Created=ttml_Created,tml_Createdby=ttml_Createdby,tml_Updated=ttml_Updated,tml_Updatedby=ttml_Updatedby,tml_BusModelID=ttml_BusModelID,tml_BusModel=ttml_BusModel,tml_BusID=ttml_BusID,tml_BusCard=ttml_BusCard,tml_FreeSeats=ttml_FreeSeats,tml_LeaveFreeSeats=ttml_LeaveFreeSeats,tml_StationDeal=ttml_StationDeal,tml_RunRegion=ttml_RunRegion,tml_DealCategory=ttml_DealCategory,tml_DealStyle=ttml_DealStyle WHERE tml_NoOfRunsID=ttml_NoOfRunsID AND tml_NoOfRunsdate=ttml_NoOfRunsdate ;


-- --------------
	OPEN nds_tmp;
	WHILE finished=0 DO

		FETCH nds_tmp INTO tmp_nds_ID,tmp_nds_SiteName,tmp_nds_SiteID,tmp_nds_IsDock,tmp_nds_GetOnSite,tmp_nds_CheckInSite,tmp_nds_DepartureTime,tmp_nds_CheckTicketWindow,tmp_nds_IsServiceFee,tmp_nds_ServiceFee,tmp_nds_otherFee1,tmp_nds_otherFee2,tmp_nds_otherFee3,tmp_nds_otherFee4,tmp_nds_otherFee5,tmp_nds_otherFee6,tmp_nds_StintSell,tmp_nds_StintTime;
		
		IF NOT finished THEN
			SET  ppd_CheckInSite=tmp_nds_CheckInSite;
			IF tmp_nds_GetOnSite=1 || tmp_nds_IsDock=1 THEN

				SET ppd_NoOfRunsID=ttml_NoOfRunsID; 
            			SET ppd_LineID=ttml_LineID;  
            			SET ppd_NoOfRunsdate=NoOfRunsdate;  
            			SET ppd_BeginStationTime=ttml_NoOfRunstime;   
            			SET ppd_BeginStationID=ttml_BeginstationID;   
            			SET ppd_BeginStation=ttml_Beginstation;   
            			SET ppd_FromStationID=tmp_nds_SiteID;   
            			SET ppd_FromStation=tmp_nds_SiteName;   
            			SET ppd_EndStationID=ttml_EndstationID;   
            			SET ppd_EndStation=ttml_Endstation;  
            			SET ppd_ServiceFee=tmp_nds_ServiceFee;  
            			SET ppd_otherFee1=tmp_nds_otherFee1;   
            			SET ppd_otherFee2=tmp_nds_otherFee2;   
            			SET ppd_otherFee3=tmp_nds_otherFee3;   
           			SET ppd_otherFee4=tmp_nds_otherFee4;   
            			SET ppd_otherFee5=tmp_nds_otherFee5;   
            			SET ppd_otherFee6=tmp_nds_otherFee6;   
            			SET ppd_StintSell=tmp_nds_StintSell;   
            			SET ppd_StintTime=tmp_nds_StintTime;   
            			SET ppd_IsPass=1; 
				IF ppd_FromStationID=ppd_BeginStationID THEN
					SET ppd_IsFromSite=1;
				ELSE
					SET ppd_IsFromSite=0;
				END IF;
				
				SELECT COUNT(*) INTO NUM1 FROM tms_bd_SectionInfo WHERE si_SiteNameID=ppd_FromStationID AND si_LineID=ttml_LineID; 

				IF NUM1=1 THEN
					OPEN jy1_tmp;
					FETCH jy1_tmp INTO FromStationKilometer;
					CLOSE jy1_tmp;	
			
				END IF;
--   -----------------------------				
				OPEN tm_tmp;
				WHILE finished=0 DO
					FETCH tm_tmp INTO nnds_ID,nnds_SiteName,nnds_SiteID,nnds_DepartureTime;

					IF NOT finished THEN
						SET ppd_ReachStationID=nnds_SiteID;   
            					SET ppd_ReachStation=nnds_SiteName; 
						SET ppd_StopStationTime=nnds_DepartureTime;

						SELECT COUNT(*) INTO NUM2 FROM tms_bd_SectionInfo WHERE si_SiteNameID=ppd_ReachStationID AND si_LineID=ttml_LineID; 
						IF NUM2=1 THEN
							OPEN jy2_tmp;
							FETCH jy2_tmp INTO ToStationKilometer;
							CLOSE jy2_tmp;
						END IF;

						SET ppd_Distance=ToStationKilometer-FromStationKilometer;
						SET TotalMoneyRenKil=0; 
						
						OPEN jy3_tmp;
						WHILE finished=0 DO
							FETCH jy3_tmp INTO ttp_MoneyRenKil;
							IF NOT finished THEN
								SET TotalMoneyRenKil=TotalMoneyRenKil+ttp_MoneyRenKil;
							END IF;
						END WHILE;
						CLOSE jy3_tmp;
						SET finished=0;
						
						SET ppd_StandardPrice=TotalMoneyRenKil*ppd_Distance;
						SET ppd_FullPrice=ppd_StandardPrice; 
						SET ppd_HalfPrice=round(ppd_FullPrice*0.5);
						
						
						
  						SELECT COUNT(*) INTO nnrap1 FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND  NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate AND nrap_NoRunsAdjust=ttml_NoOfRunsID AND nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=0 AND nrap_ModelID=ttml_BusModelID AND nrap_Unit=unit; 
-- AND ttml_NoOfRunstime>=nrap_BeginTime AND ttml_NoOfRunstime<=nrap_EndTime; 

						SELECT COUNT(*) INTO nnrap2 FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND  NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate AND nrap_NoRunsAdjust=ttml_NoOfRunsID AND nrap_ISNoRunsAdjust=1 AND nrap_ISLineAdjust=0 AND nrap_ModelID=ttml_BusModelID;
 -- AND ttml_NoOfRunstime>=nrap_BeginTime AND ttml_NoOfRunstime<=nrap_EndTime; 

						SELECT COUNT(*) INTO nnrap3 FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID=ppd_FromStationID AND nrap_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=nrap_BeginDate AND NoOfRunsdate<=nrap_EndDate AND nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=1 AND nrap_ModelID=ttml_BusModelID AND nrap_LineAdjust=ttml_LineID;
-- AND ttml_NoOfRunstime>=nrap_BeginTime AND ttml_NoOfRunstime<=nrap_EndTime; 

 
						IF nnrap1=1 THEN
							OPEN nnrap1_tmp;
							FETCH nnrap1_tmp INTO nnrap_RunPrice, nnrap_HalfPrice,nnrap_BalancePrice;
							SET ppd_FullPrice=nnrap_RunPrice; 
							SET ppd_HalfPrice=nnrap_HalfPrice;
							SET ppd_BalancePrice=nnrap_BalancePrice;
							CLOSE nnrap1_tmp;
						ELSE
							IF nnrap2=1 THEN
								OPEN nnrap2_tmp;
								FETCH nnrap2_tmp INTO nnrap_RunPrice, nnrap_HalfPrice,nnrap_BalancePrice;
								SET ppd_FullPrice=nnrap_RunPrice; 
								SET ppd_HalfPrice=nnrap_HalfPrice;
								SET ppd_BalancePrice=nnrap_BalancePrice;
								CLOSE nnrap2_tmp;
							ELSE
								IF nnrap3=1 THEN
									OPEN nnrap3_tmp;
									FETCH nnrap3_tmp INTO nnrap_RunPrice, nnrap_HalfPrice,nnrap_BalancePrice;
									SET ppd_FullPrice=nnrap_RunPrice; 
									SET ppd_HalfPrice=nnrap_HalfPrice;
									SET ppd_BalancePrice=nnrap_BalancePrice;
									CLOSE nnrap3_tmp;
								END IF;
							END IF;
						END IF; 


						SELECT COUNT(*) INTO ssfa1 FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate AND sfa_NoRunsAdjust=ttml_NoOfRunsID AND sfa_ISNoRunsAdjust=0 AND sfa_ISLineAdjust=0 AND sfa_ModelID=ttml_BusModelID AND sfa_Unit=unit;
-- ttml_BusModelID ;
-- ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime AND

						SELECT COUNT(*) INTO ssfa2 FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate AND sfa_NoRunsAdjust=ttml_NoOfRunsID AND sfa_ISNoRunsAdjust=1 AND sfa_ISLineAdjust=0 AND sfa_ModelID=ttml_BusModelID;
-- ttml_BusModelID ;
-- ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime AND

						SELECT COUNT(*) INTO ssfa3 FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID=ppd_FromStationID AND sfa_GetToSiteID=ppd_ReachStationID AND NoOfRunsdate>=sfa_BeginDate AND NoOfRunsdate<=sfa_EndDate AND sfa_ISNoRunsAdjust=0 AND sfa_ISLineAdjust=1 AND sfa_ModelID=ttml_BusModelID AND sfa_LineAdjust=ttml_LineID; 
-- ttml_LineID;
-- ttml_BusModelID ;
-- ttml_NoOfRunstime>=sfa_BeginTime AND ttml_NoOfRunstime<=sfa_EndTime AND
			
						IF ssfa1=1 THEN
							OPEN ssfa1_tmp;
							FETCH ssfa1_tmp INTO ssfa_RunPrice;
							SET ppd_ServiceFee=ssfa_RunPrice; 
							CLOSE ssfa1_tmp;
						ELSE
							IF ssfa2=1 THEN
								OPEN ssfa2_tmp;
								FETCH ssfa2_tmp INTO ssfa_RunPrice;
								SET ppd_ServiceFee=ssfa_RunPrice; 
								CLOSE ssfa2_tmp;
							ELSE
								IF ssfa3=1 THEN
									OPEN ssfa3_tmp;
									FETCH ssfa3_tmp INTO ssfa_RunPrice;
									SET ppd_ServiceFee=ssfa_RunPrice; 
									CLOSE ssfa3_tmp;
								END IF;	
							END IF;
						END IF;


						SET ppd_StationID=ttml_StationID; 
            					SET ppd_Station=ttml_Station;   
            					SET ppd_Created=NOW();  
            					SET ppd_CreatedBY=userBY;   
            					SET ppd_Updated=NOW();   
            					SET ppd_UpdatedBY=userBY; 
						
						SELECT COUNT(*) INTO PricesCount FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID=ppd_NoOfRunsID AND pd_NoOfRunsdate=ppd_NoOfRunsdate AND pd_FromStationID=ppd_FromStationID AND pd_ReachStationID=ppd_ReachStationID;
						IF PricesCount>0 THEN
							UPDATE tms_bd_PriceDetail SET pd_NoOfRunsID=ppd_NoOfRunsID,pd_LineID=ppd_LineID,pd_NoOfRunsdate=ppd_NoOfRunsdate, pd_BeginStationTime=ppd_BeginStationTime,pd_StopStationTime=ppd_StopStationTime,pd_Distance=ppd_Distance,pd_BeginStationID=ppd_BeginStationID,pd_BeginStation=ppd_BeginStation,pd_FromStationID=ppd_FromStationID,pd_FromStation=ppd_FromStation,pd_ReachStationID=ppd_ReachStationID,pd_ReachStation=ppd_ReachStation,pd_EndStationID=ppd_EndStationID, pd_EndStation=ppd_EndStation,pd_FullPrice=ppd_FullPrice,pd_HalfPrice=ppd_HalfPrice,pd_StandardPrice=ppd_StandardPrice,pd_BalancePrice=ppd_BalancePrice,pd_ServiceFee=ppd_ServiceFee,pd_otherFee1=ppd_otherFee1,pd_otherFee2=ppd_otherFee2,pd_otherFee3=ppd_otherFee3,pd_otherFee4=ppd_otherFee4,pd_otherFee5=ppd_otherFee5,pd_otherFee6=ppd_otherFee6,pd_StationID=ppd_StationID,pd_Station=ppd_Station,pd_Created=ppd_Created,pd_CreatedBY=ppd_CreatedBY,pd_Updated=ppd_Updated,pd_UpdatedBY=ppd_UpdatedBY,pd_IsPass=ppd_IsPass,pd_CheckInSite=ppd_CheckInSite,pd_IsFromSite=ppd_IsFromSite,pd_StintSell=ppd_StintSell,pd_StintTime=ppd_StintTime WHERE pd_NoOfRunsID=ppd_NoOfRunsID AND pd_NoOfRunsdate=ppd_NoOfRunsdate AND pd_FromStationID=ppd_FromStationID AND pd_ReachStationID=ppd_ReachStationID;
						ELSE
							INSERT INTO tms_bd_PriceDetail (pd_NoOfRunsID,pd_LineID,pd_NoOfRunsdate,pd_BeginStationTime,pd_StopStationTime,pd_Distance,pd_BeginStationID,pd_BeginStation,pd_FromStationID,pd_FromStation,pd_ReachStationID,pd_ReachStation,pd_EndStationID,pd_EndStation,pd_FullPrice,pd_HalfPrice,pd_StandardPrice,pd_BalancePrice,pd_ServiceFee,pd_otherFee1,pd_otherFee2,pd_otherFee3,pd_otherFee4,pd_otherFee5,pd_otherFee6,pd_StationID,pd_Station,pd_Created,pd_CreatedBY,pd_Updated,pd_UpdatedBY,pd_IsPass,pd_CheckInSite,pd_IsFromSite,pd_StintSell,pd_StintTime) VALUES (ppd_NoOfRunsID,ppd_LineID,ppd_NoOfRunsdate,ppd_BeginStationTime,ppd_StopStationTime,ppd_Distance,ppd_BeginStationID,ppd_BeginStation,ppd_FromStationID,ppd_FromStation,ppd_ReachStationID,ppd_ReachStation,ppd_EndStationID,ppd_EndStation,ppd_FullPrice,ppd_HalfPrice,ppd_StandardPrice,ppd_BalancePrice,ppd_ServiceFee,ppd_otherFee1,ppd_otherFee2,ppd_otherFee3,ppd_otherFee4,ppd_otherFee5,ppd_otherFee6,ppd_StationID,ppd_Station,ppd_Created,ppd_CreatedBY,ppd_Updated,ppd_UpdatedBY,ppd_IsPass,ppd_CheckInSite,ppd_IsFromSite,ppd_StintSell,ppd_StintTime);  
						END IF;


					END IF;
				END WHILE;
				CLOSE tm_tmp;
				SET finished=0;


			END IF;		

		END IF;


	END WHILE;
	CLOSE nds_tmp;  
	
	SET intRetVal=1;

--	ESLE
--		SET intRetVal=0;	
	END IF; -- if结束
commit;
END