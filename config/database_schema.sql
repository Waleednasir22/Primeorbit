-- PrimeOrbit Database Schema

CREATE DATABASE IF NOT EXISTS primeorbit;
USE primeorbit;

-- Admin Users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Projects
CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(255),
    description TEXT,
    image_url VARCHAR(500),
    color VARCHAR(50),
    challenges TEXT,
    solution TEXT,
    technologies JSON,
    website_url VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Services
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    icon_name VARCHAR(100),
    color VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Reviews
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author VARCHAR(100) NOT NULL,
    role VARCHAR(100),
    company VARCHAR(100),
    feedback_text TEXT,
    rating TINYINT DEFAULT 5,
    status ENUM('pending','approved','rejected') DEFAULT 'pending',
    author_image VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Articles/Blog
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    excerpt TEXT,
    category VARCHAR(100),
    publish_date VARCHAR(50),
    image_url VARCHAR(500),
    read_time VARCHAR(50),
    author_name VARCHAR(100),
    author_role VARCHAR(100),
    author_image VARCHAR(500),
    content LONGTEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Team Members
CREATE TABLE IF NOT EXISTS team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    role VARCHAR(100),
    image_url VARCHAR(500),
    bio TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- FAQs
CREATE TABLE IF NOT EXISTS faqs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Job Postings
CREATE TABLE IF NOT EXISTS job_postings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    department VARCHAR(100),
    location VARCHAR(100),
    type VARCHAR(100),
    description TEXT,
    requirements JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Case Studies
CREATE TABLE IF NOT EXISTS case_studies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client VARCHAR(100) NOT NULL,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100),
    problem TEXT,
    solution TEXT,
    result TEXT,
    image_url VARCHAR(500),
    metrics JSON,
    color VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Lab Experiments
CREATE TABLE IF NOT EXISTS lab_experiments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    type VARCHAR(100),
    description TEXT,
    image_url VARCHAR(500),
    technology VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Process Steps
CREATE TABLE IF NOT EXISTS process_steps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    icon_name VARCHAR(100),
    color_class VARCHAR(100),
    text_class VARCHAR(100),
    step_order INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tech Stack
CREATE TABLE IF NOT EXISTS tech_stack (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    row_num INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Company Stats
CREATE TABLE IF NOT EXISTS company_stats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(100) NOT NULL,
    value INT NOT NULL,
    suffix VARCHAR(20),
    icon_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Site Settings
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    site_name VARCHAR(255) DEFAULT 'PrimeOrbit',
    site_tagline VARCHAR(255),
    about_title VARCHAR(255),
    about_description TEXT,
    about_mission TEXT,
    stats_clients VARCHAR(50),
    stats_projects VARCHAR(50),
    stats_awards VARCHAR(50),
    contact_email VARCHAR(255),
    contact_phone VARCHAR(50),
    address TEXT,
    social_links JSON,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert Default Admin (Password: admin123)
-- In a real app, I'll provide a way to change this.
INSERT IGNORE INTO users (username, password) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Insert Initial Site Settings
INSERT IGNORE INTO settings (id, site_name, site_tagline, about_title, about_description, about_mission, stats_clients, stats_projects, stats_awards, social_links) VALUES 
(1, 'PrimeOrbit', 'Corporate Technology Company', 'Bridging enterprise ambition with reliable digital execution.', 'PrimeOrbit delivers scalable software, automation, and digital transformation programs.', 'Our mission is to help organizations modernize operations, launch resilient products, and scale with confidence.', '50+', '120+', '15+', '{"linkedin": "#", "twitter": "#", "instagram": "#", "github": "#"}');

-- Consultation Bookings
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    service VARCHAR(255) NOT NULL,
    preferred_date DATE NOT NULL,
    details TEXT,
    status ENUM('new','contacted','confirmed','closed') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



