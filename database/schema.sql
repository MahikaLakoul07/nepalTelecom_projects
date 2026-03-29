-- Database Schema for Nepal Telecom Projects Portal

-- Users Table (Already exists, but included for reference/completeness)
CREATE TABLE IF NOT EXISTS users (
    userId INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    employeeId VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(150) NOT NULL,
    user_role VARCHAR(50), -- General, Admin, Super_Admin
    email VARCHAR(150) NOT NULL UNIQUE,
    phone_no VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Programming Languages Table
CREATE TABLE IF NOT EXISTS programming_language (
    languageId INT AUTO_INCREMENT PRIMARY KEY,
    language_name VARCHAR(100) NOT NULL,
    version VARCHAR(50)
);

-- Servers Table
CREATE TABLE IF NOT EXISTS servers (
    serverId INT AUTO_INCREMENT PRIMARY KEY,
    server_name VARCHAR(150) NOT NULL,
    ip_address VARCHAR(50) NOT NULL,
    location VARCHAR(150),
    operation_system VARCHAR(100)
);

-- Database Used Table
CREATE TABLE IF NOT EXISTS database_used (
    databaseId INT AUTO_INCREMENT PRIMARY KEY,
    database_name VARCHAR(150) NOT NULL,
    db_version VARCHAR(50),
    is_backup_taken BOOLEAN DEFAULT FALSE,
    backup_location VARCHAR(255),
    serverId INT,
    FOREIGN KEY (serverId) REFERENCES servers(serverId) ON DELETE SET NULL
);

-- Projects Table
CREATE TABLE IF NOT EXISTS projects (
    projectId INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(200) NOT NULL,
    description TEXT,
    start_date DATE,
    end_date DATE,
    developed_by VARCHAR(150), -- Could be a team name or lead dev
    databaseId INT,
    languageId INT,
    status VARCHAR(50) DEFAULT 'In Progress',
    FOREIGN KEY (databaseId) REFERENCES database_used(databaseId) ON DELETE SET NULL,
    FOREIGN KEY (languageId) REFERENCES programming_language(languageId) ON DELETE SET NULL
);

-- Project Users Mapping Table (M:N Relationship)
CREATE TABLE IF NOT EXISTS proj_users (
    proj_user_id INT AUTO_INCREMENT PRIMARY KEY,
    projectId INT,
    userId INT,
    role_type VARCHAR(100), -- Role in this specific project
    assigned_date DATE,
    end_date DATE,
    FOREIGN KEY (projectId) REFERENCES projects(projectId) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE
);

-- Project Servers Mapping Table (M:N Relationship)
CREATE TABLE IF NOT EXISTS proj_servers (
    proj_server_id INT AUTO_INCREMENT PRIMARY KEY,
    projectId INT,
    serverId INT,
    deploymentDate DATE,
    FOREIGN KEY (projectId) REFERENCES projects(projectId) ON DELETE CASCADE,
    FOREIGN KEY (serverId) REFERENCES servers(serverId) ON DELETE CASCADE
);
