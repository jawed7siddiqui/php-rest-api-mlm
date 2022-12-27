<?php
class User
{
    // DB Related
    private $conn;
    private $table = "x_users";

    // Users Properties
    public $id;
    public $Xname;
    public $Xemail;
    public $confirm_password;
    public $step;
    public $Xverification_code;
    public $verification_code;
    public $Xpassword;
    public $Xcountry_code;
    public $Xmobile;
    public $Xdeposit_address;
    public $Xwallet_balance;
    public $Xremember_me;
    public $Xavatar;
    public $Xcountry;
    public $Xgender;
    public $Xdob;
    public $Xreferral_code;
    public $Xstatus;
    public $Xisblocked;
    public $Xisdeleted;
    public $sql_row_created_ts;
    public $sql_row_updated_ts;

    // Construct with Database
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create a Users
    public function signup()
    {
        try {

         if($this->Xpassword !== $this->confirm_password){
            return json_encode(['results'=>false,'message'=>'Password do not match.','data'=>[]]);
        }

        $query = "SELECT *
        FROM {$this->table} 
        WHERE Xemail = :Xemail";

        // Prepare Statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(Xemail, $this->Xemail);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        if($number_of_rows > 0){
            return json_encode(['results'=>false,'message'=>'Email is exists,try with another email.','data'=>[]]);
        }

        $query = "INSERT INTO {$this->table} 
        SET 
         Xemail= :Xemail, 
         Xpassword= :Xpassword"; 

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Sanitize data
        $this->Xemail = htmlspecialchars(strip_tags(trim($this->Xemail)));
        $this->Xpassword = htmlspecialchars(strip_tags(trim($this->Xpassword)));


        // Bind Data
        $stmt->bindParam(":Xemail", $this->Xemail);
        $stmt->bindParam(":Xpassword", $this->Xpassword);
        
        if ($stmt->execute()) {

           $userId = $this->conn->lastInsertId();
           $this->send_verification_code($userId);

           return json_encode(['results'=>true,'message'=>'A verfication code sent to on your mail,Please verify','data'=>['user_id'=>$userId]]);
        }

    } catch (PDOException $e) {
        return json_encode(['true'=>true,'message'=>$e->getMessage()]);
    }
        
    }
    

    public function signup_verify()
    {
        try {

         if(empty($this->verification_code)){
            return json_encode(['results'=>false,'message'=>'Something went wrong','data'=>[]]);
        }

        $query = "SELECT *
        FROM x_verification_code 
        WHERE code = :code";

        // Prepare Statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(code, $this->verification_code);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        if($number_of_rows == 0){
            return json_encode(['results'=>false,'message'=>'Invalid verification code','data'=>[]]);
        }

        return json_encode(['results'=>true,'message'=>'Your email is verified.','data'=>['user_id'=>$this->user_id]]);


    } catch (PDOException $e) {
        return json_encode(['results'=>true,'message'=>$e->getMessage()]);
    }
        
    }


    public function signup_details()
    {
        try {
    
        $query = "UPDATE {$this->table} 
        SET 
         Xname = :Xname,
         Xcountry_code= :Xcountry_code,
         Xmobile= :Xmobile,
         Xcountry= :Xcountry,
         Xgender= :Xgender,
         Xdob= :Xdob,
         Xreferral_code= :Xreferral_code
         WHERE id = :id";

        // Prepare Statement
        $stmt = $this->conn->prepare($query);


        // Bind Data
        $stmt->bindParam(":id", $this->user_id);
        $stmt->bindParam(":Xname", $this->Xname);
        $stmt->bindParam(":Xcountry_code", $this->Xcountry_code);
        $stmt->bindParam(":Xmobile", $this->Xmobile);
        $stmt->bindParam(":Xcountry", $this->Xcountry);
        $stmt->bindParam(":Xgender", $this->Xgender);
        $stmt->bindParam(":Xdob", $this->Xdob);
        $stmt->bindParam(":Xreferral_code", $this->Xreferral_code);

        // Prepare Statement
        if(!$stmt->execute()){
            return json_encode(['results'=>false,'message'=>'Something went wrong','data'=>[]]);
        }

        return json_encode(['results'=>true,'message'=>'Your account created successfully','data'=>['user_id'=>$this->user_id]]);


    } catch (PDOException $e) {
        return json_encode(['results'=>false,'message'=>$e->getMessage()]);
    }
        
    }

    public function send_verification_code($userId){
        // For verification code

        $query = "INSERT INTO x_verification_code 
        SET 
         user_id= :user_id, 
         code= :code"; 

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Bind Data
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":code", random_int(100000, 999999));
        
        if ($stmt->execute()) {
           //send verification code on mail
        }
    }


    public function UserDetails()
    {
        try {

        $query = "SELECT *
        FROM {$this->table} 
        WHERE id = :id";

        // Prepare Statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(id, $this->id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC); 
        return json_encode(['results'=>true,'message'=>'User details','data'=>$data]);


    } catch (PDOException $e) {
        return json_encode(['results'=>false,'message'=>$e->getMessage()]);
    }
        
    }


    public function login()
    {
        try {

        $query = "SELECT *
        FROM {$this->table} 
        WHERE Xemail = :Xemail and Xpassword = :Xpassword";

        // Prepare Statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(Xemail, $this->Xemail);
        $stmt->bindParam(Xpassword, $this->Xpassword);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        if($number_of_rows == 0){
            return json_encode(['results'=>false,'message'=>'Something went wrong.','data'=>[]]);
        }

        return json_encode(['results'=>true,'message'=>'You have successfully logged in.','data'=>[]]);



    } catch (PDOException $e) {
        return json_encode(['results'=>false,'message'=>$e->getMessage()]);
    }
        
    }

    public function forgetPwd()
    {
        try {

        $query = "SELECT *
        FROM {$this->table} 
        WHERE Xemail = :Xemail";

        // Prepare Statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam("Xemail", $this->Xemail);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        if($number_of_rows == 0){
            return json_encode(['results'=>false,'message'=>'Something went wrong']);
        }

        return json_encode(['results'=>true,'message'=>'Your password code sent to you mail.']);

    } catch (PDOException $e) {
        return json_encode(['results'=>true,'message'=>$e->getMessage()]);
    }
        
    }


    public function forgetVerify(){
        // forgetVerify
    }

}