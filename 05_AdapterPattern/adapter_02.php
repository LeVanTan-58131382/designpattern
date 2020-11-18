<?php

// Giả sử Phần mềm của công ty chỉ chấp nhận những email có phần mở rộng là @lampart-vn.com
// Tuy nhiên bạn chỉ có thể cung cấp các email có phần mở rộng là @gmail.com

// Concrete Implementation of Email Class
class Email {
    public $email;
    public function __construct($email) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            echo "Email không hợp lệ";
        }
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }
     
}
 
// Simple Interface for each Adapter we create
interface EmailAdapterInterface {
    public function transform();
}
 
class EmailAdapter implements EmailAdapterInterface {
     
    private $email;
 
    public function __construct(Email $email) {
        $this->email = $email;
    }
     
    public function transform() {
        $email_transform = explode("@", $this->email->getEmail());
        $email_lampart = $email_transform[0]."@lampart-vn.com";
        return  $email_lampart;
    }
}

// Client Code
$email = new EmailAdapter(new Email("van_tan@gmail.com"));
echo $email->transform();
