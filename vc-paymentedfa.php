<?php
      
 	$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
        require($rootDir.'/core-f/config-f/s1.php');
 
        function php_v( ) 
        {
            $version = explode(
                '.',
                phpversion()
            );
            return $version[0].''.$version[1];
        }
        
        
        function parse_tags( $string = '')
        {
            return explode(',' , $string)[0];
        }
        
        function to_slug( $string = '')
        {
            return preg_replace( "/\s+/" , "-" , $string);
        }
        
        function is_empty( $string = '')
        {
            if(!is_string($string)) {
                return false;
            }
            
            if(( preg_replace( "/\s+/" , "" , $string))) {
                return true;
            }
        }
        
        
        
        
        function vc_object( $object=false , $key='null' ) {
        
            if( is_object( $object ) ) {
                if( property_exists( $object , $key) ) {
                    return $object->{ $key };
                }
            }else if( is_array( $object )) {
                if( isset( $object[$key]) ) {
                    return $object[$key];
                }
            }
        }
         
        
        function vc_session( $variable=false ) {
            if( !isset($_SESSION) ) {
                session_start();
            }
        
            if ( isset( $_SESSION[$variable] ) ) {
                return ($_SESSION[$variable]);
            }
        }
        
        function vc_variable( $parms=array() ,  $variable = false) {
            if ( isset( $parms[$variable] ) ) {
                return ($parms[$variable]);
            }
        }
        
        
        function vc_server( $variable = false) {
            if ( isset( $_SERVER[$variable] ) ) {
                return ($_SERVER[$variable]);
            }
        }
        
        function vc_cookie( $variable = false) {
            if ( isset( $_COOKIE[$variable] ) ) {
                return ($_COOKIE[$variable]);
            }
        }
        
        function vc_global( $variable = false) {
            if ( isset( $_GLOBAL[$variable] ) ) {
                return ($_GLOBAL[$variable]);
            }
        }
        
        function vc_post( $variable = false) {
            if ( isset( $_POST[$variable] ) ) {
                return ($_POST[$variable]);
            }
        }
        
        function vc_get( $variable = false) {
            if ( isset( $_GET[$variable] ) ) {
                return ($_GET[$variable]);
            }
        }
        
        function is_cookies( $variable = array()) {
            if(!is_array( $variable ) ) {
                return vc_cookie( $variable );
            }else {
                for ($inx=0; $inx < count($variable) ; $inx++) { 
                    if( !vc_cookie( $variable[$inx] ) ) {
                        return false;
                        break;
                    }
                }
                return true;
            }
        }
        
        
        
        function extractTo( $options = array())
        {
            $ZipArchive = new ZipArchive;
            if ($ZipArchive->open($options['file_path']) === true) {
                $ZipArchive->extractTo($options['extract_dir']);
                $ZipArchive->close();
                return true;
            }
        }
        
        function get_cookie_option( $string = '')
        {
             $cookie_option = array (
                'domain' => vc_server('HTTP_HOST'),
                'secure' => !true,
                'httponly' => 1,
                'samesite' => 'Lax'
             );
        
             if( isset( $cookie_option[$string] ) ) {
                 return $cookie_option[$string];
             }
        }
        
         
        
        
        
        
        class VCConfig {
        
            public $db;
            
            public function system_log_attemps( $csrf_attack ) {
                $this->has_csrf_session();
                if( empty( $_SESSION[$csrf_attack] )) {
                    $_SESSION[$csrf_attack] = 1;
                } else {
                    $_SESSION[$csrf_attack] += 1;
                }
                return $_SESSION[$csrf_attack];
            }
        
            public function csrf_destroy( $csrf_token=false ) {
                $this->has_csrf_session();
                if( !empty( $_SESSION['csrf_token'] )) {
                    $_SESSION['csrf_token'] = false;
                }
            }
        
            public function verify_csrf_token( $csrf_token='null' ) {
                $this->has_csrf_session();
                return ( (string) $_SESSION['csrf_token'] ==  (string) $csrf_token );
            }
        
            public function has_csrf_session() {
                if(!isset($_SESSION) ) {
                    session_start();
                }
            }
        
            public function generate_csrf() {
                $this->has_csrf_session();
                if (empty($_SESSION['csrf_token'])) {
                    if (function_exists('mcrypt_create_iv')) {
                        $_SESSION['csrf_token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
                    } else {
                        $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
                    }
                }
                return  $_SESSION['csrf_token'];
            }
        
        
            public function generate_token() {
                $this->has_csrf_session();
                $_SESSION['payment_token'] = generate_random(64);   
                return  $_SESSION['payment_token'];
            }
        
        
        
        
            public function generate_hash($len=32)
            {
                if (function_exists('mcrypt_create_iv')) {
                    return bin2hex(mcrypt_create_iv($len, MCRYPT_DEV_URANDOM));
                } else {
                    return bin2hex(openssl_random_pseudo_bytes($len));
                }
            }
        
            public function generate_random($len=32)
            {
                return (
                    base64_encode(
                        md5(
                            sha1(
                                md5(
                                    sha1(
                                        $this->generate_hash($len)
                                    )
                                )
                            )
                        )
                    )
                );
            }
        
            public function pwd_hash($pwd=false)
            {
                return (
                    md5(
                        sha1(
                            md5(
                                sha1(
                                    $pwd
                                )
                            )
                        )
                    )
                );
            }
            public function connectSQL()
            {
                global $AppConfig;
        
                $host = $AppConfig['db']['host'];
                $dbUser = $AppConfig['db']['user'];
                $dbPassword = $AppConfig['db']['password'];
                $database = $AppConfig['db']['database'];
        
                $this->db = new mysqli(
                    $host,
                    $dbUser,
                    $dbPassword,
                    $database
                );
        
                return $this->db;
            }
        
            public function disconnectSQL( )
            {
                $this->db->close();
            }
        
            public function getDomain( )
            {
                $surl = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                $surl = preg_replace( "/^(www\\.)/", "", $surl );
                $arr = explode( "/", $surl );
                $count = sizeof( $arr ) - 1;
                if ( 0 < $count )
                {
                    $surl = "";
                    $i = 0;
                    while ( $i < $count )
                    {
                        $surl .= $arr[$i]."/";
                        ++$i;
                    }
                }
                return strtolower( rtrim($surl , '/') ).'/';
            }
        
            public function getUrl( )
            {
                return vc_server('REQUEST_SCHEME').'://' .  $this->getdomain( ) ;
            }
            
            public function getKey( )
            {
                return md5( $this->getdomain( ) );
            }
            
            public function fixObject (&$object)
            {
              if (!is_object ($object) && gettype ($object) == 'object')
                return ($object = unserialize (serialize ($object)));
              return $object;
            }
            
            public function getInstance( )
            {
                 
                $key = $this->getkey( );
                $list = vc_cookie($key);
                if(!$list) return;
                $list = base64_decode($list);
                $list = unserialize($list);
                $data = json_decode(json_encode($list));
                if(!is_object($data)) return;
                $username = $data->uname;
                $jsn = json_decode('{}');
                $userData = $this->getPlayerData($username);
                
                foreach ($userData as $key => $value) {
                    $jsn->{$key} = $value;
                }
                
                
                if(!vc_object($jsn , 'playerId')) return;
                
                
                return $jsn;
            }
            
            public function is_logged( )
            {
                if($this::getInstance()) {
                    return true;
                }
            }
            
            public function createToken( )
            {
                $str = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0987654321');
            }
            
        }
        
        class Paylink extends VCConfig {
        
            private $VendorId;
            private $SecretKey = '1cb9dc12-96eb-4e5d-b5ba-329434ce28aa';
            private $PersistToken = false;
            private $Environment = 'test';
        
            public function getOrder($index=false)
            {
                global $AppConfig;
                $packages = $AppConfig['plus']['packages'];
                if(is_numeric($index) && $index > 0)  {
                    $_GET['id'] = $index;
                }
                
                $index =  isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) && 0 < intval( $_GET['id'] ) && intval( $_GET['id'] ) <= sizeof( $AppConfig['plus']['packages'] ) ? intval( $_GET['id'] ) - 1 : 0 - 1;
        
                if(array_key_exists($index , $packages)) {     
                    return $packages[$index];
                } else {
                    return false;
                }
            }
            
            public function getPlayerData( $userID=0)
            {
                $db = $this->connectSQL();
                
                $sQl = $db->query("SELECT * FROM p_players WHERE id='{$userID}' OR name='{$userID}' LIMIT 1 ");
                $result = [];
                while ($row = $sQl->fetch_assoc()) {
                    $row['prevPlayerId'] =0;
                    $row['playerId'] = $row['id'];
                    $row['isAgent'] = 0;
                    $row['isSpy'] = '';
                    $row['gameStatus'] = 0;
                    $row['actions'] = '';
                    $result = $row;
                }
        
                return $result;
            }
            
            
            
            public function generateToken()
            {
                $this->csrf_destroy();
                return $this->generate_csrf();
            }
            
            public function getToken()
            {
                return $this->generate_csrf();
            }
            
            public function clearToken()
            {
                $this->csrf_destroy();
            }
            
        
        }

        

class Client {
    private $vendorId;
    private $vendorSecret;
    private $persistToken;
    private $environment;
    private $accessToken;
    private $Url;

    private $liveEndpoint = 'https://restapi.paylink.sa/api/';
    private $testEndpoint = 'https://restpilot.paylink.sa/api/';

    public function __construct(array $options = [])
    {
        $this->vendorId = $options['vendorId'];
        $this->vendorSecret = $options['vendorSecret'];
        $this->persistToken = $options['persistToken'];
        $this->environment = $options['environment'];

        if( $this->environment == 'testing') {
            $this->Url = $this->testEndpoint;
        } else {
            $this->Url = $this->liveEndpoint;
        }
    }

    public function httpRequest( $options = array (
        'method' => 'POST',
        'body'   => array (
            'apiId' => 'APP_ID_1123453311',
            'persistToken' => 'false',
            'secretKey' => '0662abb5-13c7-38ab-cd12-236e58f43766'
        ),
        'headers' => array (
            'Content-Type: application/json',
            'Accept: application/json'
        ),
        'Request-Type'   => 'raw',
    ))
    {

        $curl = curl_init();

        if( !vc_variable( $options , 'headers')) {
            $options['headers'] = array (
                'Content-Type: application/json',
                'Accept: application/json'
            );
        }
        
        if( !vc_variable( $options , 'method')) {
            $options['method'] = 'GET';
        }

         

        $http_options = array(
            CURLOPT_URL => ($this->Url . vc_variable( $options , 'path') ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_HEADER => 0,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => vc_variable($options , 'method'),
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => vc_variable( $options , 'headers'),
        );

        if(vc_variable($options , 'method') == 'POST') 
        {
            $http_options[CURLOPT_POST] = 1;
            $http_options[CURLOPT_POSTFIELDS] = json_encode( vc_variable($options , 'body'));
        }

        curl_setopt($curl , CURLOPT_SSL_VERIFYPEER , false);
        curl_setopt($curl , CURLOPT_SSL_VERIFYHOST , false);
        curl_setopt_array($curl, $http_options);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
             return;
        } 

         
        $res =  json_decode($response);

        return is_object($res) ? $res : $response;
    }
    
    public function apiLogin()
    {
        $response = $this->httpRequest(
            array (
                'method' => 'POST',
                'path' => 'auth',
                'body' => array (
                    'apiId' => $this->vendorId,
                    'persistToken' => $this->persistToken,
                    'secretKey' => $this->vendorSecret
                )
            )
        );

        if( vc_object($response , 'id_token') ) {
            $this->accessToken =  vc_object($response , 'id_token');
        } 

        if(!is_object($response)) {
            exit($response);
        }
        
        return $this->accessToken;
    }

    public function createInvoice( $data = array())
    {

        if( $this->apiLogin() ) {

            $response = $this->httpRequest(
                array (
                    'method' => 'POST',
                    'body' => $data,
                    'path' => 'createInvoice',
                    'headers' => array (
                            "Authorization: Bearer {$this->accessToken}",
                            'Content-Type: application/json',
                            'Accept: application/json'
                        )
                    )
                );

                return $response;
        }
    }
    
    public function addInvoice( $data = array())
    {

        if( $this->apiLogin() ) {

            $response = $this->httpRequest(
                array (
                    'method' => 'POST',
                    'body' => $data,
                    'path' => 'addInvoice',
                    'headers' => array (
                            "Authorization: Bearer {$this->accessToken}",
                            'Content-Type: application/json',
                            'Accept: application/json'
                        )
                    )
                );

                return $response;
        }
    }
    
    public function getInvoice( $transactionNo = false)
    {
        if( $this->apiLogin() ) {

            $response = $this->httpRequest(
                array (
                    'method' => 'GET',
                    'path' => "getInvoice/{$transactionNo}",
                    'headers' => array (
                            "Authorization: Bearer {$this->accessToken}",
                            'Content-Type: application/json',
                            'Accept: application/json'
                        )
                    )
                );

                return $response;
        }
    }

}

class VCPayment extends Paylink
{
    public $client;
    public $playerData;
    public function __construct()
    {
         

          // $this->checkPayment();
        

    }

    public function updatePlayerGold($playerID=0,$points=0)
    {
        $db = $this->connectSQL();
        
        $SQ = $db->query( sprintf ( "UPDATE p_players SET gold_num=gold_num+%s , new_mail_count=new_mail_count+1 WHERE id=%s",  $points, $playerID  ) );
        if($db->affected_rows) {
            $this->csrf_destroy();
            return true;
        }
    }
	
	public function __checkPayment()
    {
      
				 
		
        $response = $this->client->getInvoice( vc_get('transactionNo'));
        print_r($response);
        
    }
	
	
	function wh_log($log_msg)
{
    $log_filename = "log";
    if (!file_exists($log_filename)) 
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
    // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
} 
	
	
	
    public function checkPayment()
    {
        
		
			$order_id = vc_post('order_id');
			$trans_id =  vc_post('trans_id');
			$amount = vc_post('amount');
			
			
			
			$result = vc_post('result');
			$status = vc_post('status');
			  
			 $gold = explode('-' , $order_id);
            $gold = $gold[0];
			
			
			
			$db = $this->connectSQL();
			
			
			 if ( isset( $_POST['order_amount'] ) ) {
				   
								 
								  if ($status== 'success' ) {
									   
										 $order_id = vc_post('order_number');
										 $gold = explode('-' , $order_id);
										 $gold = $gold[0];
									  
									  /***************get Player Data*********************/
									   $sQl = $db->query("SELECT * FROM trans_orders WHERE order_number='{$order_id}'  LIMIT 1 ");
										$resultData = [];
											while ($row = $sQl->fetch_assoc()) {
												
												$row['player_id'] = $row['player_id'];
												$row['order_number'] = $row['order_number'];
												
												$resultData = $row;
											}
											
													$month = (int)date('m');
													$year  = (int)date('y');
												    $playerID=$resultData['player_id'];
									/***************Endget Player Data*********************/
									  
									  /*****************update order number set taken*****************/
									  $sql="UPDATE trans_orders SET paid=1 , gold=$gold , taken=1 , month=$month , year=$year WHERE order_number='".$order_id."'";
														$this->wh_log('sussecc'.$order_id);
														$this->wh_log('player_id'.$resultData['player_id']);
														$this->wh_log('sql_code-'.$sql);
														 
													   $SQ = $db->query($sql);
									  /*****************End update order number set taken*****************/
									  
									  
								/****check for the gift*************/	  
										$sQl = $db->query("SELECT COUNT(id) as count_paid,sum(gold) as count_gold FROM `trans_orders` WHERE month=$month and year=$year and player_id=$playerID  and taken=1 GROUP by player_id");
										$resultTransData = [];
											while ($rrow = $sQl->fetch_assoc()) {
												
												$rrow['count_paid'] = $rrow['count_paid'];
												$rrow['count_gold'] = $rrow['count_gold'];
												
												$resultTransData = $rrow;
											}
											 
											if($resultTransData['count_paid']>2){
												$giftGold =(int)  ($resultTransData['count_gold']/3);
												
												$gold =$gold+$giftGold;
												$sql="UPDATE trans_orders SET taken=0 WHERE month=$month AND year=$year AND player_id=$playerID";
												$SQ = $db->query($sql);
												
												/*******add gift msg*******/ 
												$sql='INSERT INTO `gift_msg`(`show_msg`, `player_id`) VALUES ("1","'.$playerID.'")';
												$SQ = $db->query($sql);
												/*******end gift msg*******/ 
											}
										/****End check for the gift*************/	  
								  
								  
										 $resultUpdate = $this->updatePlayerGold(
																$resultData['player_id'],
																$gold
															);
														
														
														
														
														
								}
													 
													 die();
			 }
		
		
		
		
		
		
		
		
			 
			
                
                $sQl = $db->query("SELECT * FROM trans_orders WHERE order_number='{$order_id}'  LIMIT 1 ");
            $resultData = [];
                while ($row = $sQl->fetch_assoc()) {
                    
                    $row['player_id'] = $row['player_id'];
                    $row['order_number'] = $row['order_number'];
                    
                    $resultData = $row;
                }
        
                 
			
			
			
			
			$merchPass="0421184b122583640ad05cec859a15f3";
			 
			 
         $dataToHash=$trans_id.$amount.$merchPass ;
		 $hash = sha1(md5(strtoupper($dataToHash)));;
  
	$edfa_merchant_id="c0621c41-6531-4bc7-a398-5d29e80c440a";
		 $curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://api.edfapay.com/payment/status',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => 
						array(
								"order_id"=> $order_id,
								"merchant_id"=> $edfa_merchant_id,
								"hash"=> $hash,
						) 
			));
			
			
			$response = curl_exec($curl);

			curl_close($curl);


		if ($result== 'SUCCESS' && $status== 'SETTLED') {
                
				
				
				
				  /***************get Player Data*********************/
									   $sQl = $db->query("SELECT * FROM trans_orders WHERE order_number='{$order_id}'  LIMIT 1 ");
										$resultData = [];
											while ($row = $sQl->fetch_assoc()) {
												
												$row['player_id'] = $row['player_id'];
												$row['order_number'] = $row['order_number'];
												
												$resultData = $row;
											}
											
													$month = (int)date('m');
													$year  = (int)date('y');
												    $playerID=$resultData['player_id'];
									/***************Endget Player Data*********************/
				
				 /*****************update order number set taken*****************/
									  $sql="UPDATE trans_orders SET paid=1 , gold=$gold , taken=1 , month=$month , year=$year WHERE order_number='".$order_id."'";
														$this->wh_log('sussecc'.$order_id);
														$this->wh_log('player_id'.$resultData['player_id']);
														$this->wh_log('sql_code-'.$sql);
														 
													   $SQ = $db->query($sql);
									  /*****************End update order number set taken*****************/
			   
			   
			   
							/****check for the gift*************/	  
										$sQl = $db->query("SELECT COUNT(id) as count_paid,sum(gold) as count_gold FROM `trans_orders` WHERE month=$month and year=$year and player_id=$playerID  and taken=1 GROUP by player_id");
										$resultTransData = [];
											while ($rrow = $sQl->fetch_assoc()) {
												
												$rrow['count_paid'] = $rrow['count_paid'];
												$rrow['count_gold'] = $rrow['count_gold'];
												
												$resultTransData = $rrow;
											}
											 
											if($resultTransData['count_paid']>2){
												$giftGold =(int)  ($resultTransData['count_gold']/3);
												
												$gold =$gold+$giftGold;
												$sql="UPDATE trans_orders SET taken=0 WHERE month=$month AND year=$year AND player_id=$playerID";
												$SQ = $db->query($sql);
												
												/*******add gift msg*******/ 
												$sql='INSERT INTO `gift_msg`(`show_msg`, `player_id`) VALUES ("1","'.$playerID.'")';
												$SQ = $db->query($sql);
												/*******end gift msg*******/ 
												
											}
								  /****End check for the gift*************/	  
					
					
					
					  $resultUpdate = $this->updatePlayerGold(
                        $resultData['player_id'],
                        $gold
                    );
				
            }
        
    }



    public function setUpPayment()
    {
        $orderData = $this->getOrder();

        if((int) vc_variable($orderData , 'goldplus') > 0 ) {
            $orderData['gold'] = vc_variable($orderData , 'goldplus');
        }
        
        if((int) vc_variable($orderData , 'costplus') > 0 ) {
            $orderData['cost'] = vc_variable($orderData , 'costplus');
        }
        
        if(strtolower(vc_variable($orderData , 'currency')) == 'usd' ) {
            $orderData['cost'] = vc_variable($orderData , 'costplus');
            $req_url = 'https://api.exchangerate-api.com/v4/latest/USD';
            $response_json = file_get_contents($req_url);

            // Continuing if we got a result
            if(false !== $response_json) {

                // Try/catch for json_decode operation
                try {

                // Decoding
                $response_object = json_decode($response_json);

                // YOUR APPLICATION CODE HERE, e.g.
                $base_price = $orderData['cost']; // Your price in USD
                $USD_price = round(($base_price * $response_object->rates->SAR), 4);
                $orderData['cost'] = $USD_price;
                }
                catch(Exception $e) {
                    // Handle JSON parse error...
                }
            }
        }
        
        if(!$orderData) {
            
            // no order data or invalid order ID 
            // redirect to previos page
            exit;
        }
        
        

        $accessToken = $this->generateToken();
        $data = array (
            'amount' => $orderData['cost'],
            'callBackUrl' => sprintf(
                $this->getUrl().'vc-payment.php?route=end&token=%s&id=%s',
                $accessToken,
                $_GET['id']
            ),
            'clientEmail' => $this->playerData['email'],
            'clientMobile' => '',
            'clientName' => $this->playerData['name'],
            'note' => $orderData['name'].' '.$orderData['gold'].' ذهب ',
            'orderNumber' => $orderData['gold'].'-'.$this->playerData['id'].'-'.$_GET['id'].'-'.str_shuffle('0987654321'),
            'products' => array (
                array (
                    'description' => $orderData['name'].' '.$orderData['gold'].' ذهب ',
                    'imageSrc' => $this->getUrl().'core-f/style-f/default/plus/'.$orderData['image'],
                    'price' => $orderData['cost'],
                    'qty' => 1,
                    'title' => $orderData['name'].' '.$orderData['gold'].' ذهب ',
                ),
            ),
        );
        
        $response = $this->client->addInvoice($data); 
        
        if(vc_object( $response , 'url')) {
            header("Location: {$response->url}");
        } else {
            print_r($response);
        }
        
    }
}

$vc = new VCPayment;

print $vc->checkPayment();