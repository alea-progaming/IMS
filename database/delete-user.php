<?php
  include('connection.php');
  $data = $_POST;
  $user_id = (int) $data['user_id'];
  $first_name = $data['f_name'];
  $last_name = $data['l_name'];
  
  // Delete user
  try {
    $delete_user = "DELETE FROM users WHERE id={$user_id}";
    // var_dump($insert_user);
    // die;
    $conn->exec($delete_user);

      echo json_encode([
        'success' => true,
        'message' => $first_name . ' ' . $last_name . ' is successfully deleted.'
      ]);
    } catch (PDOException $e) {
      echo json_decode([
      'success' => false,
      'message' => 'There is an error while processing your request.'
      ]);
    }
?>