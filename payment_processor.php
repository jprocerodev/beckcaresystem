<?php
include('includes/dbconnection.php');
require_once('./vendor/autoload.php');
require_once('./PHPMailer/src/Exception.php');
require_once('./PHPMailer/src/PHPMailer.php');
require_once('./PHPMailer/src/SMTP.php');

use GuzzleHttp\Client;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_GET['action'])){

if($_GET['action'] == 'process_payment'){

    $amount = $_POST['amount']; 
    
    $client = new Client();

    try {
        $response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
            'body' => json_encode([
                'data' => [
                    'attributes' => [
                        'amount' => intval($amount) * 100,
                        'description' => 'Beckcare Aesthetic Lounge'
                    ]
                ]
            ]),
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Basic c2tfdGVzdF95S0Z6VFpXTkxCZlRWeGtvd1Z1QUVtQUw6', 
                'content-type' => 'application/json',
            ],
        ]);

        $body = json_decode($response->getBody(), true);
        echo json_encode([
            'checkout_url' => $body['data']['attributes']['checkout_url'],
            'reference_number' => $body['data']['attributes']['reference_number']
        ]);

    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }

}

if($_GET['action'] == 'check_payment'){

    $reference = $_GET['reference'];
    
    $client = new Client();

    try {
        $response = $client->request('GET', "https://api.paymongo.com/v1/links/$reference", [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Basic c2tfdGVzdF95S0Z6VFpXTkxCZlRWeGtvd1Z1QUVtQUw6', 
                'content-type' => 'application/json',
            ],
        ]);

        $body = json_decode($response->getBody(), true);
        echo json_encode([
            'status' => $body['data']['attributes']['status']
        ]);

    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}

if($_GET['action'] == 'update_payment'){
    $email = $_POST['email'];
    $bookingId = $_POST['bookingId'];

    $query = mysqli_query($con, "UPDATE tblappointment SET PaymentStatus = 'Paid' WHERE ID = '".$bookingId."' ");

    if($query){

        $message = "Hi there,<br><br>
                    This is to inform you that your payment is successful.<br><br>
                    Thanks,<br>
                    Beckcare Aesthetic Lounge";
        
        $mail = new PHPMailer;

        $mail->isSMTP(); 
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'beckcarelounge@gmail.com';
        $mail->Password = 'cwli guxc aubu fuvf';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->isHTML(true); 
        $mail->setFrom('beckcarelounge@gmail.com', 'Beckcare Aesthetic Lounge');
        $mail->addAddress($email);
        $mail->Subject = 'Payment Success';
        $mail->Body = $message;

        $mail->send();

        echo 'payment-success';
    }else{
        echo 'payment-failed';
    }
}

}
?>