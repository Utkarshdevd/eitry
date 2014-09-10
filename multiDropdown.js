/*
	*	Original script by: Shafiul Azam
	*	Version 4.0
	*	Modified by: Luigi Balzano

	*	Description:
	*	Inserts Countries and/or States as Dropdown List
	*	How to Use:

		In Head section:
		----------------
		<script type= "text/javascript" src = "countries.js"></script>
		
		In Body Section:
		----------------
		Select Country (with states):   <select id="country" name ="country"></select>
			
		Select State: <select name ="state" id ="state"></select>

        Select Country (without states):   <select id="country2" name ="country2"></select>
			
		<script language="javascript">
			populateCountries("country", "state");
			populateCountries("country2");
		</script>

	*
	*	License: Free to copy, distribute, modify, whatever you want to.
	*	Aurthor's Website: http://bdhacker.wordpress.com
	*
*/

// Countries
var country_arr = new Array("RELIEF & REHABILITATION", "ADMINISTRATION", "Personnel", "MAGISTRACY", "ELECTION", "REVENUE", "Confidential/PA to DC's Section", "DEVELOPMENT", "LAND RECORD", "Excise", "LAND REFORMS", "LAND REGISTRATION", "SUPPLIES", "TREASURY", "LAND SETTLEMENT", "BAKIJAI", "LAND ACQUISITION", "NAZARAT");

// States
var s_a = new Array();
s_a[0]="";
s_a[1]="Ex- gratia|Rehabilitation Ground|FDR (CRF) /SDRF|Public Relations|G. R. Issues|NFCH|Relief for natural calamities";
s_a[2]="Passport|RTI inquiries|Issue of Arms License/ Fire License|Freedom fighters|Next of Kin|Issue of NOC for MS/ HDS retail outlet|Issue of NOC for construction of LPG storage|NOC for sand Mahal|Permission for blasting of stone|Excavation of Govt. land|Counter Signature of ST certificate|Illegal mining|Brick Industry etc|SC certificate|Verification of caste certificate|PRC Section|Permissions";
s_a[3]="Establishment matter (Appointment, Transfer, Posting of Gr III & IV)|Pension related|Salary, leave, training, allotment of work etc.|Appointment on compassionate ground|Stamp Vendors License|Preparation of Gradation list of Gr. III & IV|Initiation of DP & other departmental action|Preparation of 100 point Roster register|Salary budget preparation|Preparation of provisional pension, gratuity, GIS, Leave enhancement, GPF|TA Bills of Officers and Staff|Medical Reimbursement bills|Reply of Audit Objection|Bill Preparation|Licenses|RTI inquiries|ARTPS matters";
s_a[4]="Cr.P.C Cases|Law & Order|Detailment of EM|Dead body disposal|Prohibitory orders|N.H.R.C/A.H.R.C cases|Magistrerial inquiries|Misc. permission|VIP tour Programme|NHRC/AHRC works|Memorandum|Women Cell|Prohibitory Order u/s 144 CrPC|Pollution control|Providing of security|Magisterial Inquiry|Jail related";
s_a[5]="Electoral Roll preparation|EPIC|General/Bye election for Parliamentary/ Assembly constituencies|National Voter's Day celebration|Conduction of Election to Local Bodies|";
s_a[6]="Land Revenue collection|Settlement of fisheries|Gaon Burha appointment|Land sale permission|Issue of Partition patta";
s_a[7]="Dealing with matters related to Public complaints/petitions marked by the Deputy Commissioner|ACR of officers|Police verification report|DAK Management|Attending Public Queries/Telephone";
s_a[8]="MPLADS/ MLALADS|Untied Fund/ Border Area Development & Cultural Affairs, Satra Development|Matter Related to Govt. Schemes|Matter relating to SIFT|Holding Meetings|Files relating to Health, NRHM, Education, SSA, RMSA, Rabha – Hasong, RGSY|Co-ordination with development Deptt|Establishment Matters of SDPO Staff|Submission of Expenditure Statement|Matter relating to Palashbari & Rangia Municipal Board|Matter relating to ZP, MGNREGA, NRLM, NERC, NIRD,SGSY|Matter relating to DRDA, IAY House & New Creation of Blocks|Matter relating to Bazar/ Hat, High Court Case, News Items & No Confidence Motion|Other Miscellaneous Matter";
s_a[9]="Demarcation of land|Misc. case|Rajah Adalat|High Court Cases|Revenue appeal cases|Supply of records|Field mutation|Annual Administrative Report.|Re-classification of land|Correction of Land Records|Maintenance of Land Records|Survey of Land";
s_a[10]="Excise revenue collection & Duties enforcement|Issue of excise license|Establishment matter of excise stuff. |Enforcement activities like conduct of excise raid to curb illicit sale/ distribution of liquor/ any NDPS.|Maintenance of service book etc.|Preparation of pay roll for District Excise staff";
s_a[11]="Allotment/ Settlement of Ceiling Surplus land|Issue of ceiling free certificate|Tenancy cases|Relating to Religious Act|M.N.P. scheme|Payment of annuity Mandir / Sattra";
s_a[12]="Registration of deeds|Registration of marriage/ divorce|Registration of agreement|Issue of Certificates|Non Encumbrance application|Power of Attorney (General/Special)|Will related";
s_a[13]="Implementation of PDS System|Issue of trade license to wholesale and retail dealers etc.";
s_a[14]="Management of payments and receipt|Recruitment, Establishment matter";
s_a[15]="Allotment / Settlement of Govt. land|Convertion of A.P land to periodic land|Encroachment/eviction matter|Sale permission for Tribal Belt (Chapter X)|Issue of Sale Permission";
s_a[16]="Revenue collection|Preparation of Bakijai Report|Issues of Bakijai clearance certificate";
s_a[17]="Land Acquisition matters|Acquisition of land for NHAI (NH-31)";
s_a[18]="Maintenance of Govt. building|Maintenance of Govt. vehicle|Arrangement & Celebration of Functions|All case matters excluding Development, Supply, Excise, Sub registration and Election Branch.|Providing Stationary Articles to all branches|Vehicle & POL arrangement";

function populateStates( countryElementId, stateElementId ){
	
	var selectedCountryIndex = document.getElementById( countryElementId ).selectedIndex;

	var stateElement = document.getElementById( stateElementId );
	
	stateElement.length=0;	// Fixed by Julian Woods
	stateElement.options[0] = new Option('Select Activity','');
	stateElement.selectedIndex = 0;
	
	var state_arr = s_a[selectedCountryIndex].split("|");
	
	for (var i=0; i<state_arr.length; i++) {
		stateElement.options[stateElement.length] = new Option(state_arr[i],state_arr[i]);
	}
}

function populateCountries(countryElementId, stateElementId){
	// given the id of the <select> tag as function argument, it inserts <option> tags
	var countryElement = document.getElementById(countryElementId);
	countryElement.length=0;
	countryElement.options[0] = new Option('Select Branch','-1');
	countryElement.selectedIndex = 0;
	for (var i=0; i<country_arr.length; i++) {
		countryElement.options[countryElement.length] = new Option(country_arr[i],country_arr[i]);
	}

	// Assigned all countries. Now assign event listener for the states.

	if( stateElementId ){
		countryElement.onchange = function(){
			populateStates( countryElementId, stateElementId );
		};
	}
}