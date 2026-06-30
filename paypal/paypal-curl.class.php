<?php
        class paypalCurl {
        
            private $url ; // base url of PayPal
            private $id; // client id
            private $secret; // secret id
            private $accessToken = null; // changed by each request
        
            public function init($id,$secret,$base):void
            {
                $this->url = $base;
                $this->id = $id;
                $this->secret = $secret;
        
            }
        
            private function makeAccessToken():bool
            {
                $url = $this->url;
                $id = $this->id;
                $secret = $this->secret;
        
                $ch = curl_init();
        
                curl_setopt($ch, CURLOPT_URL, $url . '/v1/oauth2/token');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
                curl_setopt($ch, CURLOPT_USERPWD, $id . ':' . $secret);
        
                $headers = array();
                $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
                $result = curl_exec($ch);
                curl_close($ch);
        
                $result = json_decode($result);
                if (!empty($result->access_token)) {
                    $this->accessToken = $result->access_token;
                    return true;
                }
        
                return false;
        
            }
        
            public function makePaymentURL($orderId,$price,$currency,$return)
            {
        
                $url = $this->url;
                $response = new stdClass();
                $response->status = false;
        
                //first request for a new access token
                if ($this->makeAccessToken()) $accessToken = $this->accessToken;
                else {
                    $response->msg = "could not create access token!";
                    return $response;
                }
        
                //then request for a payment url
                $ch = curl_init();
        
                curl_setopt($ch, CURLOPT_URL, $url . '/v2/checkout/orders');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, '{
                  "intent": "CAPTURE",
                  "purchase_units": [
                        {
                            "items": [
                                {
                                    "name": "Convert Excel",
                                    "description":  "Pay For ' . $orderId.'",
                                    "quantity": "1",
                                    "unit_amount": {
                                        "currency_code": "'.$currency.'",
                                        "value": "'.$price.'"
                                    }
                                }
                            ],
                            "amount": {
                                "currency_code": "'.$currency.'",
                                "value": "'.$price.'",
                                "breakdown": {
                                    "item_total": {
                                        "currency_code": "'.$currency.'",
                                        "value": "'.$price.'"
                                    }
                                }
                            }
                        }
                    ],
                    "application_context":{
                        "shipping_preference":"NO_SHIPPING",
                        "return_url": "'.$return.'",
                        "cancel_url": "'.$return.'"
                    }
                }');
        
                $headers = array();
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'Authorization: Bearer '.$accessToken;
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
                $result = curl_exec($ch);
                if (curl_errno($ch)) {
        
                    $response->msg = curl_error($ch);
                    curl_close($ch);
                    return $response;
                }
        
                $result = json_decode($result);
                if (!empty($result->links[1]->href)) { // success
        
                    $PayURL = $result->links[1]->href;
                    $response -> url = $PayURL;
                    $response -> status = true;
                    return $response;
        
                }
                elseif(!empty($result->message)){ // failed
                    $response->msg = $result->message;
                }
                
                curl_close($ch);
                return $response;
            }
        
            public function verify($token) { // to verify payment
        
                if (empty($token)) return false;
        
                $response = new stdClass();
                $response-> state = false;
        
                //first create another access token
                if ($this->makeAccessToken()) $accessToken = $this->accessToken;
                else {
                    $response-> ref = "could not make access token!";
                    return $response;
                }
        
                $url = $this->url;
        
                $ch = curl_init();
        
                curl_setopt($ch, CURLOPT_URL, $url . '/v2/checkout/orders/'.$token.'/capture');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
        
                $headers = array();
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'Authorization: Bearer '.$accessToken;
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    $response-> ref = "could not connect to paypal gateway";
                    curl_close($ch);
                    return $response;
                }
        
                //retrieve data from json
                if (!empty($result)) {
        
                    $pay = json_decode($result);
        
                    if (!empty($pay->status) && $pay->status == 'COMPLETED') {
        
                        //success!
                        $response->state = true;
                        $response->ref = $pay->status;
        
                        //get details
                        $punits = $pay->purchase_units;
                        $captures = $punits[0]->payments->captures;
        
                        $response->id = $captures[0]->id; // transaction id
                        $response->amount = $captures[0]->amount->value; // returns float value
                        $response->currency = $captures[0]->amount->currency_code;
                        $response->email = $pay->payment_source->paypal->email_address; //payer email
        
                    } else {
        
                        //maybe captured already! [ORDER_ALREADY_CAPTURED]
                        $details = $pay->details;
                        $response->ref = $details[0]->issue;
        
                    }
        
                    //echo "<pre>";var_dump($pay);echo "</pre>";
        
                } else {
                    $response->ref = "result was empty!";
                }
        
                curl_close($ch);
                return $response;
        
            }
        
        }
?>