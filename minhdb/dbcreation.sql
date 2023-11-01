CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    UserRoleID INT,
    UserAuthenticationID INT,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Address VARCHAR(255),
    UserPhone VARCHAR(15),
    Gender VARCHAR(10),
    Age INT,
    LivingLocation VARCHAR(255),
    FOREIGN KEY (UserRoleID) REFERENCES UserRole(UserRoleID),
    FOREIGN KEY (UserAuthenticationID) REFERENCES UserAuthentication(UserAuthenticationID)
);

CREATE TABLE UserRole (
    UserRoleID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    UserRoleName VARCHAR(50) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE UserAuthentication (
    UserAuthenticationID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    UserEmail VARCHAR(255) NOT NULL,
    UserPassword VARCHAR(255) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE BankAccount (
    BankAccountID INT PRIMARY KEY,
    UserID INT,
    BankType VARCHAR(255),
    BankNumber VARCHAR(255),
    AccountName VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE CourseCategory (
    CourseCategoryID INT PRIMARY KEY,
    CourseCategoryName VARCHAR(255)
);

CREATE TABLE Course (
    CourseID INT PRIMARY KEY,
    CourseCategoryID INT,
    Title VARCHAR(255),
    Price DECIMAL(10, 2),
    Length INT,
    Outline TEXT,
    Provider VARCHAR(255),
    Benefits TEXT,
    FOREIGN KEY (CourseCategoryID) REFERENCES CourseCategory(CourseCategoryID)
);

CREATE TABLE RegisteredCourse (
    RegistrationID INT PRIMARY KEY,
    BankAccountID INT,
    UserID INT,
    CourseID INT,
    FOREIGN KEY (BankAccountID) REFERENCES BankAccount(BankAccountID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (CourseID) REFERENCES Course(CourseID)
);

CREATE TABLE Company (
    CompanyID INT PRIMARY KEY,
    CompanyName VARCHAR(255),
    Size INT,
    Introduction TEXT,
    CompanyPhone VARCHAR(15),
    CompanyEmail VARCHAR(255),
    Website VARCHAR(255)
);

CREATE TABLE Partner (
    PartnerID INT PRIMARY KEY,
    CompanyID INT,
    Name VARCHAR(255),
    Description TEXT,
    FOREIGN KEY (CompanyID) REFERENCES Company(CompanyID)
);

CREATE TABLE Recruiter (
    RecruiterID INT PRIMARY KEY,
    UserID INT,
    CompanyID INT,
    RecruiterActionID INT,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (CompanyID) REFERENCES Company(CompanyID),
    FOREIGN KEY (RecruiterActionID) REFERENCES RecruiterAction(RecruiterActionID)
);

CREATE TABLE RecruiterAction (
    RecruiterActionID INT PRIMARY KEY,
    RecruiterActionName VARCHAR(255)
);

CREATE TABLE Job (
    JobID INT PRIMARY KEY,
    CompanyID INT,
    RecruiterID INT,
    JobTitle VARCHAR(255),
    JobDeadline DATE,
    Salary DECIMAL(10, 2),
    JobDescription TEXT,
    WorkLocation VARCHAR(255),
    ExperienceRequirement TEXT,
    JobBenefits TEXT,
    FOREIGN KEY (CompanyID) REFERENCES Company(CompanyID),
    FOREIGN KEY (RecruiterID) REFERENCES Recruiter(RecruiterID)
);

CREATE TABLE Application (
    ApplicationID INT PRIMARY KEY,
    CandidateID INT,
    JobID INT,
    CV BLOB,
    StatementofPurpose TEXT,
    SupportExpectation TEXT,
    Questions TEXT,
    FOREIGN KEY (CandidateID) REFERENCES Candidate(CandidateID),
    FOREIGN KEY (JobID) REFERENCES Job(JobID)
);

CREATE TABLE InterviewSlot (
    InterviewSlotID INT PRIMARY KEY,
    JobID INT,
    DateStart DATE,
    DateEnd DATE,
    TimeStart TIME,
    TimeEnd TIME,
    FOREIGN KEY (JobID) REFERENCES Job(JobID)
);

CREATE TABLE CandidateInterview (
    InterviewID INT PRIMARY KEY,
    InterviewSlotID INT,
    ApplicationID INT,
    InterviewDate DATE,
    InterviewTime TIME,
    InterviewLocation VARCHAR(255),
    LinkMeeting VARCHAR(255),
    FOREIGN KEY (InterviewSlotID) REFERENCES InterviewSlot(InterviewSlotID),
    FOREIGN KEY (ApplicationID) REFERENCES Application(ApplicationID)
);

CREATE TABLE Candidate (
    CandidateID INT PRIMARY KEY,
    UserID INT,
    ApplicationStatusID INT,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (ApplicationStatusID) REFERENCES ApplicationStatus(ApplicationStatusID)
);

CREATE TABLE ApplicationStatus (
    ApplicationStatusID INT PRIMARY KEY,
    ApplicationStatusName VARCHAR(255)
);

CREATE TABLE Skill (
    SkillID INT PRIMARY KEY,
    CandidateID INT,
    SkillName VARCHAR(255),
    FOREIGN KEY (CandidateID) REFERENCES Candidate(CandidateID)
);

CREATE TABLE Education (
    EducationID INT PRIMARY KEY,
    CandidateID INT,
    Degree VARCHAR(255),
    Institution VARCHAR(255),
    GraduationYear INT,
    GPA DECIMAL(3, 2),
    FOREIGN KEY (CandidateID) REFERENCES Candidate(CandidateID)
);

CREATE TABLE WorkingExperience (
    WExperienceID INT PRIMARY KEY,
    CandidateID INT,
    WJobRole VARCHAR(255),
    WCompanyName VARCHAR(255),
    WTimeRange VARCHAR(255),
    WDescription TEXT,
    FOREIGN KEY (CandidateID) REFERENCES Candidate(CandidateID)
);

CREATE TABLE ExtracurriculumActivity (
    ActivityID INT PRIMARY KEY,
    CandidateID INT,
    OrganizationName VARCHAR(255),
    EAJobRole VARCHAR(255),
    EATimeRange VARCHAR(255),
    EADescription TEXT,
    FOREIGN KEY (CandidateID) REFERENCES Candidate(CandidateID)
);