<?php namespace flutterwave;

/**
 * Flutterwave's Rave payment gateway PHP SDK
 * @author Olufemi Olanipekun <iolufemi@ymail.com>
 * @version 1.0
 **/

class Rave {
    protected $publicKey;
    protected $secretKey;
    protected $amount;
    protected $paymentMethod;
    protected $customDescription;
    protected $customLogo;
    protected $customTitle;
    protected $country;
    protected $currency;
    protected $customerEmail;
    protected $customerFirstname;
    protected $customerLastname;
    protected $customerPhone;
    protected $txref;
    protected $integrityHash;
    protected $payButtonText;
    protected $redirectUrl;
    protected $meta = array();
    protected $env = 'staging';
    protected $onInit;
    protected $onComplete;
    protected $transactionPrefix;
    
    /**
     * Construct
     * $publicKey String
     * $secretKey String
     * $prefix String
     * */
    function __construct($publicKey, $secretKey, $prefix, $env = 'staging'){
        $this->publicKey = $publicKey;
        $this->secretKey = $secretKey;
        $this->env = $env;
        $this->transactionPrefix = $prefix.'_';
        $this->txref = $this->getReferenceNumber();
        return $this->getCheckSum();
    }
    
    function getCheckSum(){
        $options = array( 
            "PBFPubKey" => $this->publicKey, 
            "amount" => $this->amount, 
            "customer_email" => $this->customerEmail, 
            "customer_firstname" => $this->customerFirstname, 
            "txref" => $this->txref, 
            "payment_method" => $this->paymentMethod, 
            "customer_lastname" => $this->customerLastname, 
            "country" => $this->country, 
            "currency" => $this->currency, 
            "custom_description" => $this->customDescription, 
            "custom_logo" => $this->customLogo, 
            "custom_title" => $this->customTitle, 
            "customer_phone" => $this->customerPhone,
            "pay_button_text" => $this->payButtonText,
            "redirect_url" => $this->redirectUrl
        );
        
        ksort($options);
        $hashedPayload = '';
        
        foreach($options as $key => $value){

            $hashedPayload .= $value;
        }

        $completeHash = $hashedPayload.$this->secretKey;
        $hash = hash('sha256', $completeHash);
        
        $this->integrityHash = $hash;
        return $this;
    }
    
    function getReferenceNumber(){
        return uniqid($this->transactionPrefix);
    }
    
    function requeryCron(){
        
    }
    
    function failureHandler(){
        
    }
    
    function successHandler(){
        
    }
    
}

$foo = new Rave('sfsfs','sfsfsf','femi');

var_dump($foo->getCheckSum());


// silencio es dorado
?>