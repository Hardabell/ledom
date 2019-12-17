<?php

//register.php

include('config2.php');

$form_data = json_decode(file_get_contents("php://input"));

$message = '';
$validation_error = '';

if(empty($form_data->nama))
{
 $error[] = 'nama is Required';
}
else
{
 $data[':nama'] = $form_data->nama;
}


if(empty($form_data->email))
{
 $error[] = 'email is Required';
}
else
{
 if(!filter_var($form_data->email, FILTER_VALIDATE_EMAIL))
 {
  $error[] = 'Invalid email Format';
 }
 else
 {
  $data[':email'] = $form_data->email;
 }
}



if(empty($form_data->password))
{
 $error[] = 'Password is Required';
}
else
{
 $data[':password'] = password_hash($form_data->password, PASSWORD_DEFAULT);
}

if(empty($error))
{
 $query = "
 INSERT INTO account (nama_admin, emai_admin, password) VALUES (:nama, :email, :password)
 ";
 $statement = $connect->prepare($query);
 if($statement->execute($data))
 {
  $message = 'Registration Completed';
 }
}
else
{
 $validation_error = implode(", ", $error);
}

$output = array(
 'error'  => $validation_error,
 'message' => $message
);

echo json_encode($output);