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
    public $Xverification_code;
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
    public function create()
    {
        try {

        $query = "SELECT *
        FROM {$this->table} 
        WHERE Xemail = :Xemail";

        // Prepare Statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(Xemail, $this->Xemail);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        if($number_of_rows > 0){
            return json_encode(['status'=>0,'msg'=>'Email is exists,try with another email.']);
        }

        $query = "INSERT INTO {$this->table} 
        SET 
         Xname = :Xname,
         Xemail= :Xemail, 
         Xpassword= :Xpassword, 
         Xmobile= :Xmobile,
         Xgender= :Xgender,
         Xdob= :Xdob,
         Xverification_code= :Xverification_code";


        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Sanitize data
        $this->Xname = htmlspecialchars(strip_tags(trim($this->Xname)));
        $this->Xemail = htmlspecialchars(strip_tags(trim($this->Xemail)));
        $this->Xpassword = htmlspecialchars(strip_tags(trim($this->Xpassword)));
        $this->Xmobile = htmlspecialchars(strip_tags(trim($this->Xmobile)));
        $this->Xgender = htmlspecialchars(strip_tags(trim($this->Xgender)));
        $this->Xdob = htmlspecialchars(strip_tags(trim($this->Xdob)));

        // Bind Data
        $stmt->bindParam(":Xname", $this->Xname);
        $stmt->bindParam(":Xemail", $this->Xemail);
        $stmt->bindParam(":Xpassword", $this->Xpassword);
        $stmt->bindParam(":Xmobile", $this->Xmobile);
        $stmt->bindParam(":Xgender", $this->Xgender);
        $stmt->bindParam(":Xdob", $this->Xdob);
        $stmt->bindParam(":Xverification_code", random_int(100000, 999999));

        
        if ($stmt->execute()) {

           $this->send_verification_code();
           return json_encode(['status'=>1,'msg'=>'You have successfully created your account.']);
        }

    } catch (PDOException $e) {
        return json_encode(['status'=>0,'error'=>$e->getMessage()]);
    }
        
    }

    public function send_verification_code(){
        // For verification code
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
        return json_encode(['status'=>1,'msg'=>'User details','users'=>$data]);


    } catch (PDOException $e) {
        return json_encode(['status'=>0,'error'=>$e->getMessage()]);
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
            return json_encode(['status'=>0,'msg'=>'Something went wrong.']);
        }

        return json_encode(['status'=>1,'msg'=>'You have successfully logged in.']);



    } catch (PDOException $e) {
        return json_encode(['status'=>0,'error'=>$e->getMessage()]);
    }
        
    }

    public function signupEmailVerification()
    {
        try {

        $query = "SELECT *
        FROM {$this->table} 
        WHERE Xverification_code = :Xverification_code";

        // Prepare Statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(Xverification_code, $this->Xverification_code);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        if($number_of_rows > 0){
            
            $query = "UPDATE {$this->table} 
            SET 
             Xemail_verified_at = :Xemail_verified_at,
             WHERE Xverification_code = :Xverification_code";
    
            // Prepare Statement
            $stmt1 = $this->conn->prepare($query);
            $this->Xemail_verified_at = 1;

            // Bind Data
            $stmt1->bindParam(":Xemail_verified_at", $this->Xemail_verified_at);
            $stmt1->bindParam(":Xverification_code", $this->Xverification_code);
            
            $stmt1->execute();
            return json_encode(['status'=>1,'msg'=>'Your email successfully verified.']);


        }


    } catch (PDOException $e) {
        return json_encode(['status'=>0,'error'=>$e->getMessage()]);
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
        $stmt->bindParam(Xverification_code, $this->Xverification_code);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        if($number_of_rows > 0){
            
            $this->forgetPwdLink();
            return json_encode(['status'=>1,'msg'=>'Your password sent to you mail.']);


        }


    } catch (PDOException $e) {
        return json_encode(['status'=>0,'error'=>$e->getMessage()]);
    }
        
    }


    public function forgetPwdLink(){
        // link send to mail
    }

}