#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Role
#------------------------------------------------------------

CREATE TABLE Role(
        idRole          int (11) Auto_increment  NOT NULL ,
        roleName        Varchar (25) ,
        roleDescription Text ,
        PRIMARY KEY (idRole ) ,
        UNIQUE (roleName )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Machine
#------------------------------------------------------------

CREATE TABLE Machine(
        idMachine       int (11) Auto_increment  NOT NULL ,
        codeMachine     Varchar (255) ,
        shortLabel      Varchar (255) ,
        longLabel       Varchar (255) ,
        machineUsePrice Integer ,
        serialNumber    Varchar (255) ,
        manufacturer    Varchar (255) ,
        comment         Text ,
        docLink1        Varchar (255) ,
        docLink2        Varchar (255) ,
        datePrice       Datetime ,
        dateEntry       Datetime ,
        idFamily        Int ,
        idPicture       Int ,
        idCostUnit      Int ,
        idLab           Int ,
        PRIMARY KEY (idMachine ) ,
        INDEX (datePrice ) ,
        UNIQUE (codeMachine )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Family
#------------------------------------------------------------

CREATE TABLE Family(
        idFamily    int (11) Auto_increment  NOT NULL ,
        familyCode  Varchar (255) ,
        familyLabel Varchar (255) ,
        PRIMARY KEY (idFamily ) ,
        UNIQUE (familyCode )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: SubFamily
#------------------------------------------------------------

CREATE TABLE SubFamily(
        idSubFamily    int (11) Auto_increment  NOT NULL ,
        codeSubFamily  Varchar (255) ,
        labelSubFamily Varchar (255) ,
        idFamily       Int ,
        PRIMARY KEY (idSubFamily ) ,
        UNIQUE (codeSubFamily )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        idUser                int (11) Auto_increment  NOT NULL ,
        firstName             Varchar (255) ,
        name                  Varchar (255) ,
        telephone             Char (25) ,
        adressL1              Varchar (255) ,
        adressL2              Varchar (255) ,
        adressL3              Varchar (255) ,
        zipCode               Varchar (5) ,
        town                  Varchar (255) ,
        country               Varchar (255) ,
        email                 Varchar (255) ,
        emailBis              Varchar (255) ,
        birthDate             Date ,
        nbFunnies             Integer ,
        inscriptionActiveList Bool ,
        inscriptionNews       Bool ,
        login                 Varchar (255) ,
        password              Varchar (255) ,
        salt                  Varchar (255) ,
        idPicture             Int ,
        PRIMARY KEY (idUser )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Empowerment
#------------------------------------------------------------

CREATE TABLE Empowerment(
        idEmpowerment   int (11) Auto_increment  NOT NULL ,
        codeEmpowerment Varchar (15) ,
        empowermentBody Varchar (50) ,
        idMachine       Int ,
        PRIMARY KEY (idEmpowerment ) ,
        UNIQUE (codeEmpowerment )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: MachineUseForm
#------------------------------------------------------------

CREATE TABLE MachineUseForm(
        idUseForm         int (11) Auto_increment  NOT NULL ,
        dateUseForm       Datetime ,
        comment           Varchar (255) ,
        entryDate         Datetime ,
        TransactionStatut Varchar (255) ,
        idMachine         Int ,
        idUser            Int ,
        idUser_1          Int ,
        PRIMARY KEY (idUseForm )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Message
#------------------------------------------------------------

CREATE TABLE Message(
        idMessage      int (11) Auto_increment  NOT NULL ,
        textMessage    Text ,
        sentDateTime   Datetime ,
        idConversation Int ,
        idUser         Int ,
        PRIMARY KEY (idMessage )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Materials
#------------------------------------------------------------

CREATE TABLE Materials(
        idMat     int (11) Auto_increment  NOT NULL ,
        labelMat  Varchar (255) ,
        codeMat   Varchar (10) ,
        priceMat  Integer ,
        datePrice Datetime ,
        docLink   Varchar (255) ,
        comment   Text ,
        dateEntry Datetime ,
        idPicture Int ,
        PRIMARY KEY (idMat ) ,
        UNIQUE (codeMat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Picture
#------------------------------------------------------------

CREATE TABLE Picture(
        idPicture          int (11) Auto_increment  NOT NULL ,
        picture            Varchar (255) ,
        pictureDescription Text ,
        categoryPicture    Varchar (25) ,
        idMat              Int ,
        idUser             Int ,
        idLab              Int ,
        idProject          Int ,
        PRIMARY KEY (idPicture )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Corporation
#------------------------------------------------------------

CREATE TABLE Corporation(
        idCorporation int (11) Auto_increment  NOT NULL ,
        corporateName Varchar (25) ,
        logo          Varchar (25) ,
        telephone     Char (25) ,
        adressL1      Varchar (255) ,
        adressL2      Varchar (255) ,
        adressL3      Varchar (255) ,
        zipCode       Varchar (25) ,
        town          Varchar (25) NOT NULL ,
        country       Varchar (25) ,
        email         Varchar (25) ,
        nbFunnies     Int ,
        PRIMARY KEY (idCorporation )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: MembershipFrame
#------------------------------------------------------------

CREATE TABLE MembershipFrame(
        idMembershipFrame int (11) Auto_increment  NOT NULL ,
        bonusMembership   Integer ,
        entryDate         Date ,
        frameName         Varchar (255) ,
        framePrice        Int ,
        frameComment      Varchar (255) ,
        PRIMARY KEY (idMembershipFrame )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: VariousSkills
#------------------------------------------------------------

CREATE TABLE VariousSkills(
        idSkill          int (11) Auto_increment  NOT NULL ,
        skillName        Varchar (255) ,
        skillDescription Text ,
        idSkillType      Int ,
        PRIMARY KEY (idSkill )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Software
#------------------------------------------------------------

CREATE TABLE Software(
        idSoftware          int (11) Auto_increment  NOT NULL ,
        softwareName        Varchar (255) ,
        softwareDescription Text ,
        PRIMARY KEY (idSoftware )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: SoftwareCategory
#------------------------------------------------------------

CREATE TABLE SoftwareCategory(
        idSoftCat     int (11) Auto_increment  NOT NULL ,
        categoryCode  Varchar (255) ,
        categoryLabel Varchar (255) ,
        PRIMARY KEY (idSoftCat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: SoftwareSubcategory
#------------------------------------------------------------

CREATE TABLE SoftwareSubcategory(
        idSoftSubcat int (11) Auto_increment  NOT NULL ,
        SubcatCode   Varchar (255) ,
        SubcatLabel  Varchar (255) ,
        idSoftCat    Int ,
        PRIMARY KEY (idSoftSubcat ) ,
        INDEX (SubcatCode )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Events
#------------------------------------------------------------

CREATE TABLE Events(
        idEvent        int (11) Auto_increment  NOT NULL ,
        shortSumEvent  Varchar (255) ,
        longSumEvent   Varchar (255) ,
        startdateEvent Datetime ,
        endDatEvent    Datetime ,
        statutEvent    Varchar (25) ,
        nbPlaces       Int ,
        pricePlace     Int ,
        idLab          Int ,
        PRIMARY KEY (idEvent )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Project
#------------------------------------------------------------

CREATE TABLE Project(
        idProject   int (11) Auto_increment  NOT NULL ,
        title       Varchar (255) ,
        wiki        Varchar (255) ,
        dateProject Datetime ,
        PRIMARY KEY (idProject )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ProjectCategory
#------------------------------------------------------------

CREATE TABLE ProjectCategory(
        idProCat           int (11) Auto_increment  NOT NULL ,
        title              Varchar (255) ,
        shortCategoryLabel Varchar (64) ,
        longCategoryLabel  Text ,
        idPicture          Int ,
        PRIMARY KEY (idProCat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CostUnit
#------------------------------------------------------------

CREATE TABLE CostUnit(
        idCostUnit  int (11) Auto_increment  NOT NULL ,
        timePackage Int ,
        coeffTime   Int ,
        PRIMARY KEY (idCostUnit )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PaymentMethod
#------------------------------------------------------------

CREATE TABLE PaymentMethod(
        idPaymentMethod int (11) Auto_increment  NOT NULL ,
        paymentType     Varchar (25) ,
        webPayment      Bool ,
        commentary      Varchar (255) ,
        idUser          Int ,
        PRIMARY KEY (idPaymentMethod )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: SkillType
#------------------------------------------------------------

CREATE TABLE SkillType(
        idSkillType   int (11) Auto_increment  NOT NULL ,
        skillTypeName Varchar (25) ,
        PRIMARY KEY (idSkillType )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Rights
#------------------------------------------------------------

CREATE TABLE Rights(
        idRights          int (11) Auto_increment  NOT NULL ,
        rightsTitle       Varchar (25) ,
        rightsDescription Text ,
        rigthsPath        Varchar (25) ,
        PRIMARY KEY (idRights )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Lab
#------------------------------------------------------------

CREATE TABLE Lab(
        idLab          int (11) Auto_increment  NOT NULL ,
        labName        Varchar (25) ,
        labDescription Text ,
        PRIMARY KEY (idLab )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Maintenance
#------------------------------------------------------------

CREATE TABLE Maintenance(
        idMaintenance   int (11) Auto_increment  NOT NULL ,
        nameMaintenance Varchar (25) ,
        PRIMARY KEY (idMaintenance )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Historical
#------------------------------------------------------------

CREATE TABLE Historical(
        idHistorical  int (11) Auto_increment  NOT NULL ,
        nameRepairer  Varchar (25) ,
        messageRepair Text ,
        idMaintenance Int ,
        PRIMARY KEY (idHistorical )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Conversation
#------------------------------------------------------------

CREATE TABLE Conversation(
        idConversation int (11) Auto_increment  NOT NULL ,
        name           Varchar (25) ,
        startDateTime  Datetime ,
        PRIMARY KEY (idConversation )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: userRole
#------------------------------------------------------------

CREATE TABLE userRole(
        idRole Int NOT NULL ,
        idUser Int NOT NULL ,
        PRIMARY KEY (idRole ,idUser )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: capacitationUser
#------------------------------------------------------------

CREATE TABLE capacitationUser(
        idUser        Int NOT NULL ,
        idEmpowerment Int NOT NULL ,
        PRIMARY KEY (idUser ,idEmpowerment )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: need
#------------------------------------------------------------

CREATE TABLE need(
        quantity  Integer ,
        idUseForm Int NOT NULL ,
        idMat     Int NOT NULL ,
        PRIMARY KEY (idUseForm ,idMat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: boundto
#------------------------------------------------------------

CREATE TABLE boundto(
        idUser        Int NOT NULL ,
        idCorporation Int NOT NULL ,
        PRIMARY KEY (idUser ,idCorporation )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: has
#------------------------------------------------------------

CREATE TABLE has(
        skillLevel Double ,
        comment    Text ,
        idUser     Int NOT NULL ,
        idSkill    Int NOT NULL ,
        PRIMARY KEY (idUser ,idSkill )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: SoftwareInCategory
#------------------------------------------------------------

CREATE TABLE SoftwareInCategory(
        idSoftware Int NOT NULL ,
        idSoftCat  Int NOT NULL ,
        PRIMARY KEY (idSoftware ,idSoftCat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: know
#------------------------------------------------------------

CREATE TABLE know(
        knowledgeLevel Double ,
        comment        Varchar (255) ,
        idUser         Int NOT NULL ,
        idSoftware     Int NOT NULL ,
        PRIMARY KEY (idUser ,idSoftware )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: register
#------------------------------------------------------------

CREATE TABLE register(
        idUser  Int NOT NULL ,
        idEvent Int NOT NULL ,
        PRIMARY KEY (idUser ,idEvent )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: isIncludeIn
#------------------------------------------------------------

CREATE TABLE isIncludeIn(
        idProject Int NOT NULL ,
        idProCat  Int NOT NULL ,
        PRIMARY KEY (idProject ,idProCat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: lead
#------------------------------------------------------------

CREATE TABLE lead(
        idUser    Int NOT NULL ,
        idProject Int NOT NULL ,
        PRIMARY KEY (idUser ,idProject )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: participate
#------------------------------------------------------------

CREATE TABLE participate(
        idUser    Int NOT NULL ,
        idProject Int NOT NULL ,
        PRIMARY KEY (idUser ,idProject )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: employ
#------------------------------------------------------------

CREATE TABLE employ(
        idProject Int NOT NULL ,
        idMachine Int NOT NULL ,
        PRIMARY KEY (idProject ,idMachine )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: contribution
#------------------------------------------------------------

CREATE TABLE contribution(
        description      Text ,
        contributionTime Time ,
        idUser           Int NOT NULL ,
        idUser_1         Int NOT NULL ,
        PRIMARY KEY (idUser ,idUser_1 )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: softwareInSubCategory
#------------------------------------------------------------

CREATE TABLE softwareInSubCategory(
        idSoftware   Int NOT NULL ,
        idSoftSubcat Int NOT NULL ,
        PRIMARY KEY (idSoftware ,idSoftSubcat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: machineInSubFamily
#------------------------------------------------------------

CREATE TABLE machineInSubFamily(
        idMachine   Int NOT NULL ,
        idSubFamily Int NOT NULL ,
        PRIMARY KEY (idMachine ,idSubFamily )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: according
#------------------------------------------------------------

CREATE TABLE according(
        idRole   Int NOT NULL ,
        idRights Int NOT NULL ,
        PRIMARY KEY (idRole ,idRights )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: labTeam
#------------------------------------------------------------

CREATE TABLE labTeam(
        idUser Int NOT NULL ,
        idLab  Int NOT NULL ,
        PRIMARY KEY (idUser ,idLab )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: labSupplies
#------------------------------------------------------------

CREATE TABLE labSupplies(
        quantityInStock Int ,
        idLab           Int NOT NULL ,
        idMat           Int NOT NULL ,
        PRIMARY KEY (idLab ,idMat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: repair
#------------------------------------------------------------

CREATE TABLE repair(
        idMaintenance Int NOT NULL ,
        idMachine     Int NOT NULL ,
        PRIMARY KEY (idMaintenance ,idMachine )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: consume
#------------------------------------------------------------

CREATE TABLE consume(
        idMachine Int NOT NULL ,
        idMat     Int NOT NULL ,
        PRIMARY KEY (idMachine ,idMat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reserve
#------------------------------------------------------------

CREATE TABLE reserve(
        startReservation    Date ,
        durationReservation Time ,
        idUser              Int NOT NULL ,
        idMachine           Int NOT NULL ,
        PRIMARY KEY (idUser ,idMachine )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: funniesPurchaseTransaction
#------------------------------------------------------------

CREATE TABLE funniesPurchaseTransaction(
        purchaseAmount  Int ,
        comments        Text ,
        purchaseDate    Datetime ,
        purchaseStatus  Varchar (255) ,
        idUser          Int NOT NULL ,
        idPaymentMethod Int NOT NULL ,
        PRIMARY KEY (idUser ,idPaymentMethod )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: membershipTransaction
#------------------------------------------------------------

CREATE TABLE membershipTransaction(
        registerDate      Date ,
        idMembershipFrame Int NOT NULL ,
        idPaymentMethod   Int NOT NULL ,
        idUser            Int NOT NULL ,
        PRIMARY KEY (idMembershipFrame ,idPaymentMethod ,idUser )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: funniesTransfer
#------------------------------------------------------------

CREATE TABLE funniesTransfer(
        dateTransfer    Date ,
        transferAmount  Int ,
        transferComment Varchar (255) ,
        idUser          Int NOT NULL ,
        idUser_1        Int NOT NULL ,
        PRIMARY KEY (idUser ,idUser_1 )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: userInConversation
#------------------------------------------------------------

CREATE TABLE userInConversation(
        idConversation Int NOT NULL ,
        idUser         Int NOT NULL ,
        PRIMARY KEY (idConversation ,idUser )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: read
#------------------------------------------------------------

CREATE TABLE read(
        seen      Bool ,
        idMessage Int NOT NULL ,
        idUser    Int NOT NULL ,
        PRIMARY KEY (idMessage ,idUser )
)ENGINE=InnoDB;

ALTER TABLE Machine ADD CONSTRAINT FK_Machine_idFamily FOREIGN KEY (idFamily) REFERENCES Family(idFamily);
ALTER TABLE Machine ADD CONSTRAINT FK_Machine_idPicture FOREIGN KEY (idPicture) REFERENCES Picture(idPicture);
ALTER TABLE Machine ADD CONSTRAINT FK_Machine_idCostUnit FOREIGN KEY (idCostUnit) REFERENCES CostUnit(idCostUnit);
ALTER TABLE Machine ADD CONSTRAINT FK_Machine_idLab FOREIGN KEY (idLab) REFERENCES Lab(idLab);
ALTER TABLE SubFamily ADD CONSTRAINT FK_SubFamily_idFamily FOREIGN KEY (idFamily) REFERENCES Family(idFamily);
ALTER TABLE User ADD CONSTRAINT FK_User_idPicture FOREIGN KEY (idPicture) REFERENCES Picture(idPicture);
ALTER TABLE Empowerment ADD CONSTRAINT FK_Empowerment_idMachine FOREIGN KEY (idMachine) REFERENCES Machine(idMachine);
ALTER TABLE MachineUseForm ADD CONSTRAINT FK_MachineUseForm_idMachine FOREIGN KEY (idMachine) REFERENCES Machine(idMachine);
ALTER TABLE MachineUseForm ADD CONSTRAINT FK_MachineUseForm_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE MachineUseForm ADD CONSTRAINT FK_MachineUseForm_idUser_1 FOREIGN KEY (idUser_1) REFERENCES User(idUser);
ALTER TABLE Message ADD CONSTRAINT FK_Message_idConversation FOREIGN KEY (idConversation) REFERENCES Conversation(idConversation);
ALTER TABLE Message ADD CONSTRAINT FK_Message_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE Materials ADD CONSTRAINT FK_Materials_idPicture FOREIGN KEY (idPicture) REFERENCES Picture(idPicture);
ALTER TABLE Picture ADD CONSTRAINT FK_Picture_idMat FOREIGN KEY (idMat) REFERENCES Materials(idMat);
ALTER TABLE Picture ADD CONSTRAINT FK_Picture_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE Picture ADD CONSTRAINT FK_Picture_idLab FOREIGN KEY (idLab) REFERENCES Lab(idLab);
ALTER TABLE Picture ADD CONSTRAINT FK_Picture_idProject FOREIGN KEY (idProject) REFERENCES Project(idProject);
ALTER TABLE VariousSkills ADD CONSTRAINT FK_VariousSkills_idSkillType FOREIGN KEY (idSkillType) REFERENCES SkillType(idSkillType);
ALTER TABLE SoftwareSubcategory ADD CONSTRAINT FK_SoftwareSubcategory_idSoftCat FOREIGN KEY (idSoftCat) REFERENCES SoftwareCategory(idSoftCat);
ALTER TABLE Events ADD CONSTRAINT FK_Events_idLab FOREIGN KEY (idLab) REFERENCES Lab(idLab);
ALTER TABLE ProjectCategory ADD CONSTRAINT FK_ProjectCategory_idPicture FOREIGN KEY (idPicture) REFERENCES Picture(idPicture);
ALTER TABLE PaymentMethod ADD CONSTRAINT FK_PaymentMethod_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE Historical ADD CONSTRAINT FK_Historical_idMaintenance FOREIGN KEY (idMaintenance) REFERENCES Maintenance(idMaintenance);
ALTER TABLE userRole ADD CONSTRAINT FK_userRole_idRole FOREIGN KEY (idRole) REFERENCES Role(idRole);
ALTER TABLE userRole ADD CONSTRAINT FK_userRole_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE capacitationUser ADD CONSTRAINT FK_capacitationUser_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE capacitationUser ADD CONSTRAINT FK_capacitationUser_idEmpowerment FOREIGN KEY (idEmpowerment) REFERENCES Empowerment(idEmpowerment);
ALTER TABLE need ADD CONSTRAINT FK_need_idUseForm FOREIGN KEY (idUseForm) REFERENCES MachineUseForm(idUseForm);
ALTER TABLE need ADD CONSTRAINT FK_need_idMat FOREIGN KEY (idMat) REFERENCES Materials(idMat);
ALTER TABLE boundto ADD CONSTRAINT FK_boundto_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE boundto ADD CONSTRAINT FK_boundto_idCorporation FOREIGN KEY (idCorporation) REFERENCES Corporation(idCorporation);
ALTER TABLE has ADD CONSTRAINT FK_has_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE has ADD CONSTRAINT FK_has_idSkill FOREIGN KEY (idSkill) REFERENCES VariousSkills(idSkill);
ALTER TABLE SoftwareInCategory ADD CONSTRAINT FK_SoftwareInCategory_idSoftware FOREIGN KEY (idSoftware) REFERENCES Software(idSoftware);
ALTER TABLE SoftwareInCategory ADD CONSTRAINT FK_SoftwareInCategory_idSoftCat FOREIGN KEY (idSoftCat) REFERENCES SoftwareCategory(idSoftCat);
ALTER TABLE know ADD CONSTRAINT FK_know_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE know ADD CONSTRAINT FK_know_idSoftware FOREIGN KEY (idSoftware) REFERENCES Software(idSoftware);
ALTER TABLE register ADD CONSTRAINT FK_register_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE register ADD CONSTRAINT FK_register_idEvent FOREIGN KEY (idEvent) REFERENCES Events(idEvent);
ALTER TABLE isIncludeIn ADD CONSTRAINT FK_isIncludeIn_idProject FOREIGN KEY (idProject) REFERENCES Project(idProject);
ALTER TABLE isIncludeIn ADD CONSTRAINT FK_isIncludeIn_idProCat FOREIGN KEY (idProCat) REFERENCES ProjectCategory(idProCat);
ALTER TABLE lead ADD CONSTRAINT FK_lead_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE lead ADD CONSTRAINT FK_lead_idProject FOREIGN KEY (idProject) REFERENCES Project(idProject);
ALTER TABLE participate ADD CONSTRAINT FK_participate_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE participate ADD CONSTRAINT FK_participate_idProject FOREIGN KEY (idProject) REFERENCES Project(idProject);
ALTER TABLE employ ADD CONSTRAINT FK_employ_idProject FOREIGN KEY (idProject) REFERENCES Project(idProject);
ALTER TABLE employ ADD CONSTRAINT FK_employ_idMachine FOREIGN KEY (idMachine) REFERENCES Machine(idMachine);
ALTER TABLE contribution ADD CONSTRAINT FK_contribution_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE contribution ADD CONSTRAINT FK_contribution_idUser_1 FOREIGN KEY (idUser_1) REFERENCES User(idUser);
ALTER TABLE softwareInSubCategory ADD CONSTRAINT FK_softwareInSubCategory_idSoftware FOREIGN KEY (idSoftware) REFERENCES Software(idSoftware);
ALTER TABLE softwareInSubCategory ADD CONSTRAINT FK_softwareInSubCategory_idSoftSubcat FOREIGN KEY (idSoftSubcat) REFERENCES SoftwareSubcategory(idSoftSubcat);
ALTER TABLE machineInSubFamily ADD CONSTRAINT FK_machineInSubFamily_idMachine FOREIGN KEY (idMachine) REFERENCES Machine(idMachine);
ALTER TABLE machineInSubFamily ADD CONSTRAINT FK_machineInSubFamily_idSubFamily FOREIGN KEY (idSubFamily) REFERENCES SubFamily(idSubFamily);
ALTER TABLE according ADD CONSTRAINT FK_according_idRole FOREIGN KEY (idRole) REFERENCES Role(idRole);
ALTER TABLE according ADD CONSTRAINT FK_according_idRights FOREIGN KEY (idRights) REFERENCES Rights(idRights);
ALTER TABLE labTeam ADD CONSTRAINT FK_labTeam_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE labTeam ADD CONSTRAINT FK_labTeam_idLab FOREIGN KEY (idLab) REFERENCES Lab(idLab);
ALTER TABLE labSupplies ADD CONSTRAINT FK_labSupplies_idLab FOREIGN KEY (idLab) REFERENCES Lab(idLab);
ALTER TABLE labSupplies ADD CONSTRAINT FK_labSupplies_idMat FOREIGN KEY (idMat) REFERENCES Materials(idMat);
ALTER TABLE repair ADD CONSTRAINT FK_repair_idMaintenance FOREIGN KEY (idMaintenance) REFERENCES Maintenance(idMaintenance);
ALTER TABLE repair ADD CONSTRAINT FK_repair_idMachine FOREIGN KEY (idMachine) REFERENCES Machine(idMachine);
ALTER TABLE consume ADD CONSTRAINT FK_consume_idMachine FOREIGN KEY (idMachine) REFERENCES Machine(idMachine);
ALTER TABLE consume ADD CONSTRAINT FK_consume_idMat FOREIGN KEY (idMat) REFERENCES Materials(idMat);
ALTER TABLE reserve ADD CONSTRAINT FK_reserve_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE reserve ADD CONSTRAINT FK_reserve_idMachine FOREIGN KEY (idMachine) REFERENCES Machine(idMachine);
ALTER TABLE funniesPurchaseTransaction ADD CONSTRAINT FK_funniesPurchaseTransaction_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE funniesPurchaseTransaction ADD CONSTRAINT FK_funniesPurchaseTransaction_idPaymentMethod FOREIGN KEY (idPaymentMethod) REFERENCES PaymentMethod(idPaymentMethod);
ALTER TABLE membershipTransaction ADD CONSTRAINT FK_membershipTransaction_idMembershipFrame FOREIGN KEY (idMembershipFrame) REFERENCES MembershipFrame(idMembershipFrame);
ALTER TABLE membershipTransaction ADD CONSTRAINT FK_membershipTransaction_idPaymentMethod FOREIGN KEY (idPaymentMethod) REFERENCES PaymentMethod(idPaymentMethod);
ALTER TABLE membershipTransaction ADD CONSTRAINT FK_membershipTransaction_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE funniesTransfer ADD CONSTRAINT FK_funniesTransfer_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE funniesTransfer ADD CONSTRAINT FK_funniesTransfer_idUser_1 FOREIGN KEY (idUser_1) REFERENCES User(idUser);
ALTER TABLE userInConversation ADD CONSTRAINT FK_userInConversation_idConversation FOREIGN KEY (idConversation) REFERENCES Conversation(idConversation);
ALTER TABLE userInConversation ADD CONSTRAINT FK_userInConversation_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
ALTER TABLE read ADD CONSTRAINT FK_read_idMessage FOREIGN KEY (idMessage) REFERENCES Message(idMessage);
ALTER TABLE read ADD CONSTRAINT FK_read_idUser FOREIGN KEY (idUser) REFERENCES User(idUser);
