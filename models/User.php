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

        $query = "INSERT INTO {$this->table} 
        SET 
         Xname = :Xname,
         Xemail= :Xemail, 
         Xpassword= :Xpassword, 
         Xmobile= :Xmobile,
         Xverification_code= :Xverification_code";


        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Sanitize data
        $this->Xname = htmlspecialchars(strip_tags(trim($this->Xname)));
        $this->Xemail = htmlspecialchars(strip_tags(trim($this->Xemail)));
        $this->Xpassword = htmlspecialchars(strip_tags(trim($this->Xpassword)));
        $this->Xmobile = htmlspecialchars(strip_tags(trim($this->Xmobile)));

        // Bind Data
        $stmt->bindParam(":Xname", $this->Xname);
        $stmt->bindParam(":Xemail", $this->Xemail);
        $stmt->bindParam(":Xpassword", md5($this->Xpassword));
        $stmt->bindParam(":Xmobile", $this->Xmobile);
        $stmt->bindParam(":Xverification_code", random_int(100000, 999999));

        
        if ($stmt->execute()) {
           return json_encode(['status'=>1,'msg'=>'You have successfully created your account.']);
        }

    } catch (PDOException $e) {
        return json_encode(['status'=>0,'error'=>$e->getMessage()]);
    }
        
    }
    


}