CREATE TABLE patients (
  patient_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  phone VARCHAR(20),
  dob DATE,
  gender ENUM('Male', 'Female', 'Other'),
  address TEXT,
  password VARCHAR(255)
);

-- DOCTORS TABLE
CREATE TABLE doctors (
  doctor_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  phone VARCHAR(20),
  specialization VARCHAR(100),
  license_no VARCHAR(50),
  password VARCHAR(255)
);

-- APPOINTMENTS TABLE
CREATE TABLE appointments (
  appointment_id INT AUTO_INCREMENT PRIMARY KEY,
  patient_id INT,
  doctor_id INT,
  problem TEXT,
  schedule_time DATETIME,
  status VARCHAR(20) DEFAULT 'Not Visited',
  FOREIGN KEY (patient_id) REFERENCES patients(patient_id),
  FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id)
);

-- PRESCRIPTIONS TABLE
CREATE TABLE prescriptions (
  prescription_id INT AUTO_INCREMENT PRIMARY KEY,
  appointment_id INT,
  doctor_id INT,
  patient_id INT,
  diagnosis TEXT,
  medicines TEXT,
  notes TEXT,
  date_issued DATE,
  FOREIGN KEY (appointment_id) REFERENCES appointments(appointment_id),
  FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id),
  FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
);

CREATE TABLE medical_checkups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2),
    duration VARCHAR(50) -- e.g. "30 minutes", "1 hour"
);

INSERT INTO medical_checkups (name, description, price, duration) VALUES
('General Health Checkup', 'Includes blood test, BP, BMI, etc.', 499.00, '45 minutes'),
('Cardiac Checkup', 'Includes ECG, blood pressure, cholesterol levels.', 999.00, '1 hour'),
('Diabetes Screening', 'Fasting blood sugar, HbA1c tests.', 399.00, '30 minutes');


insert into doctors (name,email,phone,specialization,license_no,password) values('Sai Tharun','saitharun@gmail.com','9573279256','Cardilogy','1','Sai@123'),('karthik','karthik@01','9876543210','Neurology','2','Karthik@21');