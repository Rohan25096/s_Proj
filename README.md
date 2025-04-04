#  Employee Records Management System  
A web-based **Employee Records Management System** that allows users to efficiently **manage employee details**, **view PDF documents**, **automatically calculate retirements**, and **analyze employee data** through an interactive dashboard.

---

##  Features  

### 1️ **Employee Management**  
- Add new employee records with:  
  - Employee Name, Code, Date of Joining, Contact No, Aadhar No, PAN No.  
- Upload associated **PDF documents**.  
- Automatically **calculate the retirement date** (60 years from Date of Birth).  

### 2️ **PDF Fetching**  
- Retrieve and view **PDF files** associated with employees using their **unique Employee Code**.  

### 3️ **Dashboard**  
- **Visualize employee data** using **Charts.js**:  
  - Total Employees  
  - Active Employees  
  - Retired Employees  
- Get **insights into employee statistics** via **dynamic and interactive graphs**.  

### 4️ **Secure Login System**  
- **Hashed passwords** using **bcrypt** for security.  
- **Prevents unauthorized access** to admin functionalities.  

### 5️ **Responsive Design**  
- Works seamlessly across **desktops, tablets, and mobile devices**.  

---

##  Dashboard Preview  
- Displays **metrics** like **Active Employees vs Retired Employees**.  

---

##  Technology Stack  

| Component  | Technology Used |
|------------|----------------|
| **Frontend**  | HTML, CSS, **Charts.js** (for data visualization) |
| **Backend**   | PHP |
| **Database**  | MySQL (for storing employee details and PDF files) |

---

##  Future Enhancements  

1. **Search & Filter Options**  
   - Search Employees by **name, department, or birth date**.  
   - Filter by **Active or Retired** status.  

2. **Email Notifications**  
   - Notify HR when an employee is **nearing retirement**.  

3. **Export Data**  
   - Export employee data as **EXCEL/CSV**.  

---

##  Security Measures  

1. **Passwords are securely hashed** using `bcrypt`.  
2. **SQL queries use prepared statements** to prevent SQL injection.  

---

Contributing:
    We welcome contributions. Feel free to contribute!!
      - Submit feature requests.
      - Report Bugs.
      - Fork the project and send pull requests.
      Report Bugs:
          Found something not working as expected? Open an issue and help us squash the bugs!
              No bug is too small to report—your feedback helps us improve.
      Suggest Features:
          Have a brilliant idea to enhance the system? Submit a feature request, and let’s bring your idea to life!
              We’re always looking for innovative ways to improve functionality.
      Code Contributions:
          Roll up your sleeves and dive into the code! Whether it’s fixing an issue, optimizing the performance, or adding             new features, every contribution is valued.
            Don’t worry if you’re new—clean, well-documented code is all we ask for.
            
  Why Contribute?
       Learn & Grow:
          Gain hands-on experience with PHP, MySQL, and Charts.js while collaborating with a global community.
       Build Your Portfolio:
          Your contributions are a great way to showcase your skills to future employers.
       Make a Difference:
          Help us create a system that simplifies employee management for organizations worldwide.


  Installation Guide:
      Follow these steps to set up and run the project locally:
          1. Clone the Repository:
          2. Set Up the Database: 
                -Import the office.sql file into your My SQL database.
                -Update the credentials in index.php and dashboard.php.
          3. Execution:
                -Now place the files(index.php, dashboard.php, login.php, styles.css, lstyles.css, dstyles.css) in any                        directory.
                -Open that directory using any code editor (VS Code) and execute that directory.
            














    
