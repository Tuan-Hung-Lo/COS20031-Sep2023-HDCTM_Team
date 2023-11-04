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
    UserID INT NOT NULL,
    UserRoleName VARCHAR(255) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE UserAuthentication (
    UserAuthenticationID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    UserEmail VARCHAR(255) UNIQUE NOT NULL,
    UserPassword VARCHAR(255) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    UserRoleID INT NOT NULL,
    UserAuthenticationID INT NOT NULL,
    FirstName VARCHAR(255) NOT NULL,
    LastName VARCHAR(255) NOT NULL,
    Address VARCHAR(255) NOT NULL,
    UserPhone VARCHAR(15) NOT NULL,
    Gender VARCHAR(10) NOT NULL,
    DateOfBirth DATE NOT NULL CHECK (
        DateOfBirth <= CURRENT_DATE() 
        AND DateOfBirth >= '1900-01-01'
    ),
    LivingLocation VARCHAR(255) NOT NULL,
    FOREIGN KEY (UserRoleID) REFERENCES UserRole(UserRoleID),
    FOREIGN KEY (UserAuthenticationID) REFERENCES UserAuthentication(UserAuthenticationID)
);

CREATE TABLE BankAccount (
    BankAccountID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    BankType VARCHAR(255) NOT NULL,
    BankNumber VARCHAR(255) NOT NULL,
    AccountName VARCHAR(255) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE RegisteredCourse (
    RegistrationID INT PRIMARY KEY AUTO_INCREMENT,
    BankAccountID INT NOT NULL,
    UserID INT NOT NULL,
    CourseID INT NOT NULL,
    FOREIGN KEY (BankAccountID) REFERENCES BankAccount(BankAccountID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (CourseID) REFERENCES Course(CourseID)
);

CREATE TABLE Course (
    CourseID INT PRIMARY KEY AUTO_INCREMENT,
    CourseCategoryID INT NOT NULL,
    Title VARCHAR(255) NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    Length INT NOT NULL,
    Outline TEXT NOT NULL,
    Provider VARCHAR(255) NOT NULL,
    Benefits TEXT NOT NULL,
    FOREIGN KEY (CourseCategoryID) REFERENCES CourseCategory(CourseCategoryID)
);

CREATE TABLE CourseCategory (
    CourseCategoryID INT PRIMARY KEY AUTO_INCREMENT,
    CourseCategoryName VARCHAR(255) NOT NULL
);

CREATE TABLE Recruiter (
    RecruiterID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    CompanyID INT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (CompanyID) REFERENCES Company(CompanyID)
);

CREATE TABLE Company (
    CompanyID INT PRIMARY KEY AUTO_INCREMENT,
    CompanyName VARCHAR(255) NOT NULL,
    Size INT NOT NULL,
    Introduction TEXT NOT NULL,
    CompanyPhone VARCHAR(15) NOT NULL,
    CompanyEmail VARCHAR(255) NOT NULL,
    Website VARCHAR(255) NOT NULL
);

CREATE TABLE Partner (
    PartnerID INT PRIMARY KEY AUTO_INCREMENT,
    CompanyID INT NOT NULL,
    Name VARCHAR(255) NOT NULL,
    Description TEXT NOT NULL,
    FOREIGN KEY (CompanyID) REFERENCES Company(CompanyID)
);

CREATE TABLE Job (
    JobID INT PRIMARY KEY AUTO_INCREMENT,
    CompanyID INT NOT NULL,
    RecruiterID INT NOT NULL,
    ExperienceLevelID INT NOT NULL,
    WorkingFormatID INT NOT NULL,
    JobSpecializationID INT NOT NULL,
    JobTitle VARCHAR(255) NOT NULL,
    JobDeadline DATE NOT NULL,
    Salary DECIMAL(10, 2) NOT NULL CHECK (Salary >= 0),
    JobDescription TEXT NOT NULL,
    WorkLocation VARCHAR(255) NOT NULL,
    ExperienceRequirement TEXT NOT NULL,
    JobBenefits TEXT NOT NULL,
    FOREIGN KEY (CompanyID) REFERENCES Company(CompanyID),
    FOREIGN KEY (RecruiterID) REFERENCES Recruiter(RecruiterID),
    FOREIGN KEY (ExperienceLevelID) REFERENCES ExperienceLevel(ExperienceLevelID),
    FOREIGN KEY (WorkingFormatID) REFERENCES WorkingFormat(WorkingFormatID),
    FOREIGN KEY (JobSpecializationID) REFERENCES JobSpecialization(JobSpecializationID)
);

CREATE TABLE ExperienceLevel (
    ExperienceLevelID INT PRIMARY KEY AUTO_INCREMENT,
    ExperienceLevelName VARCHAR(255) NOT NULL
        CHECK (ExperienceLevelName IN ('Internship', 'Entry', 'Junior', 'Senior'))
);

CREATE TABLE WorkingFormat (
    WorkingFormatID INT PRIMARY KEY AUTO_INCREMENT,
    WorkingFormatName VARCHAR(255) NOT NULL
        CHECK (WorkingFormatName IN ('Remote', 'Hybrid', 'Online', 'Offline'))
);

CREATE TABLE JobSpecialization (
    JobSpecializationID INT PRIMARY KEY AUTO_INCREMENT,
    JobSpecializationName VARCHAR(255) NOT NULL
		CHECK (JobSpecializationName IN ('Beauty & Spa', 'F&B', 'Tourism & Hospitality', 'Event'))
);

CREATE TABLE Application (
    ApplicationID INT PRIMARY KEY AUTO_INCREMENT,
    CandidateID INT NOT NULL,
    JobID INT NOT NULL,
    CV BLOB NOT NULL,
    StatementofPurpose TEXT NOT NULL,
    SupportExpectation TEXT NOT NULL,
    Questions TEXT NOT NULL,
    FOREIGN KEY (CandidateID) REFERENCES Candidate(CandidateID),
    FOREIGN KEY (JobID) REFERENCES Job(JobID)
);

CREATE TABLE InterviewSlot (
    InterviewSlotID INT PRIMARY KEY AUTO_INCREMENT,
    JobID INT NOT NULL,
    DateStart DATE NOT NULL,
    DateEnd DATE NOT NULL,
    TimeStart TIME NOT NULL,
    TimeEnd TIME NOT NULL,
    FOREIGN KEY (JobID) REFERENCES Job(JobID)
);

CREATE TABLE CandidateInterview (
    InterviewID INT PRIMARY KEY AUTO_INCREMENT,
    InterviewSlotID INT NOT NULL,
    ApplicationID INT NOT NULL,
    InterviewDate DATE NOT NULL,
    InterviewTime TIME NOT NULL,
    InterviewLocation VARCHAR(255) NOT NULL,
    LinkMeeting VARCHAR(255) NOT NULL,
    FOREIGN KEY (InterviewSlotID) REFERENCES InterviewSlot(InterviewSlotID),
    FOREIGN KEY (ApplicationID) REFERENCES Application(ApplicationID)
);

CREATE TABLE InterviewStatus (
    InterviewStatusID INT PRIMARY KEY AUTO_INCREMENT,
    InterviewStatusName VARCHAR(255) NOT NULL
);

CREATE TABLE Candidate (
    CandidateID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    ApplicationStatusID INT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (ApplicationStatusID) REFERENCES ApplicationStatus(ApplicationStatusID)
);

CREATE TABLE ApplicationStatus (
    ApplicationStatusID INT PRIMARY KEY AUTO_INCREMENT,
    ApplicationStatusName VARCHAR(255) NOT NULL
);

CREATE TABLE Skill (
    SkillID INT PRIMARY KEY AUTO_INCREMENT,
    CandidateID INT NOT NULL,
    SkillName VARCHAR(255) NOT NULL,
    FOREIGN KEY (CandidateID) REFERENCES Candidate(CandidateID)
);

CREATE TABLE Education (
    EducationID INT PRIMARY KEY AUTO_INCREMENT,
    CandidateID INT NOT NULL,
    Degree VARCHAR(255) NOT NULL,
    Institution VARCHAR(255) NOT NULL,
    GraduationYear INT NOT NULL CHECK (GraduationYear >= 1900),
    GPA DECIMAL(3, 2) NOT NULL CHECK (GPA >= 0 AND GPA <= 4),
    FOREIGN KEY (CandidateID) REFERENCES Candidate(CandidateID)
);

CREATE TABLE WorkingExperience (
    WExperienceID INT PRIMARY KEY AUTO_INCREMENT,
    CandidateID INT NOT NULL,
    WJobRole VARCHAR(255) NOT NULL,
    WCompanyName VARCHAR(255) NOT NULL,
    WTimeRange VARCHAR(255) NOT NULL,
    WDescription TEXT NOT NULL,
    FOREIGN KEY (CandidateID) REFERENCES Candidate(CandidateID)
);

CREATE TABLE ExtracurriculumActivity (
    ActivityID INT PRIMARY KEY AUTO_INCREMENT,
    CandidateID INT NOT NULL,
    OrganizationName VARCHAR(255) NOT NULL,
    EAJobRole VARCHAR(255) NOT NULL,
    EATimeRange VARCHAR(255) NOT NULL,
    EADescription TEXT NOT NULL,
    FOREIGN KEY (CandidateID) REFERENCES Candidate(CandidateID)
);
