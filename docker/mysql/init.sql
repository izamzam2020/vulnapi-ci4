-- VulnAPI MySQL Initialization Script
-- This runs when the container is first created

-- Grant privileges
GRANT ALL PRIVILEGES ON vulnapi.* TO 'vulnapi'@'%';
GRANT ALL PRIVILEGES ON vulnapi.* TO 'root'@'%';
FLUSH PRIVILEGES;

-- Use the database
USE vulnapi;

-- The actual tables will be created by CodeIgniter migrations

