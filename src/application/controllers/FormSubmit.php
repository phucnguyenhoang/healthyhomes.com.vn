<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormSubmit extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    
  }

  public function requestDemo()
  {
    $this->output->set_content_type('application/json', 'utf-8');

    // Initialize response structure
    $response = [
      'status' => 'error',
      'message' => '',
      'data' => [],
    ];

    try {
      // Check request method
      if ($this->input->method() != 'post') {
        throw new Exception('Invalid request method.', 405);
      }

      // Get post data
      $name = $this->input->post('txtName');
      $address = $this->input->post('txtAddress');
      $email = $this->input->post('txtEmail');
      $phone = $this->input->post('txtPhone');
      $recaptchaResponse = $this->input->post('g-recaptcha-response');

      // Verify reCAPTCHA
      if (empty($recaptchaResponse) || !verifyRecaptcha($recaptchaResponse)) {
        throw new Exception('reCAPTCHA verification failed. Please try again.', 400);
      }

      // Validate required fields
      if (empty($name) || empty($address) || empty($email) || empty($phone)) {
        throw new Exception('All fields are required.', 400);
      }

      // Verify email format
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format.', 400);
      }

      // Prepare email data
      $emailData = [
        'name' => $name,
        'address' => $address,
        'email' => $email,
        'phone' => $phone,
      ];
      $emailBody = $this->load->view('email/request-demo', $emailData, true);
      $gasSendEmailData = [
        'token' => SECRET_TOKEN,
        'to' => CUSTOMER_SERVICE_EMAIL,
        'subject' => 'New Demo Request from Healthy Homes Viet Nam',
        'body' => $emailBody,
        'from_name' => 'Healthy Homes Viet Nam',
      ];
      // Send email via GAS
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, GAS_SEND_EMAIL_URL);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($gasSendEmailData));
      curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $curlResponse = curl_exec($ch);
      curl_close($ch);

      // Prepare success response
      $response['status'] = 'success';
      $response['message'] = 'Form submitted successfully.';
      $response['data'] = [];

      $this->output->set_status_header(200);
      return $this->output->set_output(json_encode($response));
    } catch (Exception $e) {
      // Prepare error response
      $response['status'] = 'error';
      $response['message'] = $e->getMessage();
      $this->output->set_status_header($e->getCode());
      return $this->output->set_output(json_encode($response));
    }
  }

  public function contactUs()
  {
    $this->output->set_content_type('application/json', 'utf-8');

    // Initialize response structure
    $response = [
      'status' => 'error',
      'message' => '',
      'data' => [],
    ];

    try {
      // Check request method
      if ($this->input->method() != 'post') {
        throw new Exception('Invalid request method.', 405);
      }

      // Get post data
      $name = $this->input->post('txtName');
      $address = $this->input->post('txtAddress');
      $email = $this->input->post('txtEmail');
      $phone = $this->input->post('txtPhone');
      $userFocus = $this->input->post('userFocus'); // array
      $message = $this->input->post('txtMessage');
      $recaptchaResponse = $this->input->post('g-recaptcha-response');

      // Verify reCAPTCHA
      if (empty($recaptchaResponse) || !verifyRecaptcha($recaptchaResponse)) {
        throw new Exception('reCAPTCHA verification failed. Please try again.', 400);
      }

      // Validate required fields
      if (empty($name) || empty($email) || empty($phone)) {
        throw new Exception('Please fill in all required fields.', 400);
      }

      // Verify email format
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format.', 400);
      }

      // Validate user focus
      $validFocusOptions = array_keys(USER_FOCUS);
      if (!empty($userFocus)) {
        foreach ($userFocus as $focus) {
          if (!in_array($focus, $validFocusOptions)) {
            throw new Exception('Invalid user focus selected.', 400);
          }
        }
      }

      // Prepare email data
      $emailData = [
        'name' => $name,
        'address' => $address,
        'email' => $email,
        'phone' => $phone,
        'userFocus' => !empty($userFocus) ? array_map(fn($key) => USER_FOCUS[$key], $userFocus) : [],
        'message' => $message,
      ];
      $emailBody = $this->load->view('email/contact-us', $emailData, true);
      $gasSendEmailData = [
        'token' => SECRET_TOKEN,
        'to' => CUSTOMER_SERVICE_EMAIL,
        'subject' => 'New Contact Us Request from Healthy Homes Viet Nam',
        'body' => $emailBody,
        'from_name' => 'Healthy Homes Viet Nam',
      ];
      // Send email via GAS
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, GAS_SEND_EMAIL_URL);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($gasSendEmailData));
      curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $curlResponse = curl_exec($ch);
      curl_close($ch);

      // Prepare success response
      $response['status'] = 'success';
      $response['message'] = 'Form submitted successfully.';
      $response['data'] = [];

      $this->output->set_status_header(200);
      return $this->output->set_output(json_encode($response));
    } catch (Exception $e) {
      // Prepare error response
      $response['status'] = 'error';
      $response['message'] = $e->getMessage();
      $this->output->set_status_header($e->getCode());
      return $this->output->set_output(json_encode($response));
    }
  }
}
