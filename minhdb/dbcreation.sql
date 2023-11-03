-- Drop tables if they exist

DROP TABLE IF EXISTS ExtracurriculumActivity;
DROP TABLE IF EXISTS WorkingExperience;
DROP TABLE IF EXISTS Education;
DROP TABLE IF EXISTS Skill;
DROP TABLE IF EXISTS ApplicationStatus;
DROP TABLE IF EXISTS Candidate;
DROP TABLE IF EXISTS InterviewStatus;
DROP TABLE IF EXISTS CandidateInterview;
DROP TABLE IF EXISTS InterviewSlot;
DROP TABLE IF EXISTS Application;
DROP TABLE IF EXISTS JobSpecialization;
DROP TABLE IF EXISTS WorkingFormat;
DROP TABLE IF EXISTS ExperienceLevel;
DROP TABLE IF EXISTS Job;
DROP TABLE IF EXISTS Company;
DROP TABLE IF EXISTS Recruiter;
DROP TABLE IF EXISTS Course;
DROP TABLE IF EXISTS CourseCategory;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS UserAuthentication;
DROP TABLE IF EXISTS UserRole;
DROP TABLE IF EXISTS BankAccount;
DROP TABLE IF EXISTS RegisteredCourse;
DROP TABLE IF EXISTS Partner;

-- Create tables

CREATE TABLE UserRole (
    UserRoleID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    UserRoleName VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE UserAuthentication (
    UserAuthenticationID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    UserEmail VARCHAR(255),
    UserPassword VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    UserRoleID INT,
    UserAuthenticationID INT,
    FirstName VARCHAR(255),
    LastName VARCHAR(255),
    Address VARCHAR(255),
    UserPhone VARCHAR(15),
    Gender VARCHAR(10),
    Age INT,
    LivingLocation VARCHAR(255),
    FOREIGN KEY (UserRoleID) REFERENCES UserRole(UserRoleID),
    FOREIGN KEY (UserAuthenticationID) REFERENCES UserAuthentication(UserAuthenticationID)
);

CREATE TABLE BankAccount (
    BankAccountID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    BankType VARCHAR(255),
    BankNumber VARCHAR(255),
    AccountName VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE RegisteredCourse (
    RegistrationID INT PRIMARY KEY AUTO_INCREMENT,
    BankAccountID INT,
    UserID INT,
    CourseID INT,
    FOREIGN KEY (BankAccountID) REFERENCES BankAccount(BankAccountID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (CourseID) REFERENCES Course(CourseID)
);

CREATE TABLE Course (
    CourseID INT PRIMARY KEY AUTO_INCREMENT,
    CourseCategoryID INT,
    Title VARCHAR(255),
    Price DECIMAL(10, 2),
    Length INT,
    Outline TEXT,
    Provider VARCHAR(255),
    Benefits TEXT,
    FOREIGN KEY (CourseCategoryID) REFERENCES CourseCategory(CourseCategoryID)
);

CREATE TABLE CourseCategory (
    CourseCategoryID INT PRIMARY KEY AUTO_INCREMENT,
    CourseCategoryName VARCHAR(255)
);

CREATE TABLE Recruiter (
    RecruiterID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    CompanyID INT,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (CompanyID) REFERENCES Company(CompanyID)
);

CREATE TABLE Company (
    CompanyID INT PRIMARY KEY AUTO_INCREMENT,
    CompanyName VARCHAR(255),
    Size INT,
    Introduction TEXT,
    CompanyPhone VARCHAR(15),
    CompanyEmail VARCHAR(255),
    Website VARCHAR(255)
);

CREATE TABLE Partner (
    PartnerID INT PRIMARY KEY AUTO_INCREMENT,
    CompanyID INT,
    Name VARCHAR(255),
    Description TEXT,
    FOREIGN KEY (CompanyID) REFERENCES Company(CompanyID)
);

CREATE TABLE Job (
    JobID INT PRIMARY KEY AUTO_INCREMENT,
    CompanyID INT,
    RecruiterID INT,
    ExperienceLevelID INT,
    WorkingFormatID INT,
    JobSpecializationID INT,
    JobTitle VARCHAR(255),
    JobDeadline DATE,
    Salary DECIMAL(10, 2),
    JobDescription TEXT,
    WorkLocation VARCHAR(255),
    ExperienceRequirement TEXT,
    JobBenefits TEXT,
    FOREIGN KEY (CompanyID) REFERENCES Company(CompanyID),
    FOREIGN KEY (RecruiterID) REFERENCES Recruiter(RecruiterID),
    FOREIGN KEY (ExperienceLevelID) REFERENCES ExperienceLevel(ExperienceLevelID),
    FOREIGN KEY (WorkingFormatID) REFERENCES WorkingFormat(WorkingFormatID),
    FOREIGN KEY (JobSpecializationID) REFERENCES JobSpecialization(JobSpecializationID)
);

CREATE TABLE ExperienceLevel (
    ExperienceLevelID INT PRIMARY KEY AUTO_INCREMENT,
    ExperienceLevelName VARCHAR(255)
);

CREATE TABLE WorkingFormat (
    WorkingFormatID INT PRIMARY KEY AUTO_INCREMENT,
    WorkingFormatName VARCHAR(255)
);

CREATE TABLE JobSpecialization (
    JobSpecializationID INT PRIMARY KEY AUTO_INCREMENT,
    JobSpecializationName VARCHAR(255)
);

CREATE TABLE Application (
    ApplicationID INT PRIMARY KEY AUTO_INCREMENT,
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
    InterviewSlotID INT PRIMARY KEY AUTO_INCREMENT,
    JobID INT,
    DateStart DATE,
    DateEnd DATE,
    TimeStart TIME,
    TimeEnd TIME,
    FOREIGN KEY (JobID) REFERENCES Job(JobID)
);

CREATE TABLE CandidateInterview (
    InterviewID INT PRIMARY KEY AUTO_INCREMENT,
    InterviewSlotID INT,
    ApplicationID INT,
    InterviewDate DATE,
    InterviewTime TIME,
    InterviewLocation VARCHAR(255),
    LinkMeeting VARCHAR(255),
    FOREIGN KEY (InterviewSlotID) REFERENCES InterviewSlot(InterviewSlotID),
    FOREIGN KEY (ApplicationID) REFERENCES Application(ApplicationID)
);

CREATE TABLE InterviewStatus (
    InterviewStatusID INT PRIMARY KEY AUTO_INCREMENT,
    InterviewStatusName VARCHAR(255)
);

CREATE TABLE Candidate (
    CandidateID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    ApplicationStatusID INT,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (ApplicationStatusID) REFERENCES ApplicationStatus(ApplicationStatusID)
);

CREATE TABLE ApplicationStatus (
    ApplicationStatusID INT PRIMARY KEY AUTO_INCREMENT,
    ApplicationStatusName VARCHAR(255)
);

CREATE TABLE Skill (
    SkillID INT PRIMARY KEY AUTO_INCREMENT,
    CandidateID INT,
    SkillName VARCHAR(255),
    FOREIGN KEY (CandidateID) REFERENCES Candidate(CandidateID)
);

CREATE TABLE Education (
    EducationID INT PRIMARY KEY AUTO_INCREMENT,
    CandidateID INT,
    Degree VARCHAR(255),
    Institution VARCHAR(255),
    GraduationYear INT,
    GPA DECIMAL(3, 2),
    FOREIGN KEY (CandidateID) REFERENCES Candidate(CandidateID)
);

CREATE TABLE WorkingExperience (
    WExperienceID INT PRIMARY KEY AUTO_INCREMENT,
    CandidateID INT,
    WJobRole VARCHAR(255),
    WCompanyName VARCHAR(255),
    WTimeRange VARCHAR(255),
    WDescription TEXT,
    FOREIGN KEY (CandidateID) REFERENCES Candidate(CandidateID)
);

CREATE TABLE ExtracurriculumActivity (
    ActivityID INT PRIMARY KEY AUTO_INCREMENT,
    CandidateID INT,
    OrganizationName VARCHAR(255),
    EAJobRole VARCHAR(255),
    EATimeRange VARCHAR(255),
    EADescription TEXT,
    FOREIGN KEY (CandidateID) REFERENCES Candidate(CandidateID)
);
