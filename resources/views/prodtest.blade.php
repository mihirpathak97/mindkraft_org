<?php
function checkUserStatus($id)
{
  if (count(DB::select('select * from mindkraft18_approved_enduser where id=\''.$id.'\'')) > 0 ) {
    return true;
  }
  return false;
}

function generatereceipt($user, $for)
{

  $last = DB::select('select * from mindkraft18_receipt_details');
  $last = $last[count($last) - 1];
  $receipt = str_pad($last->number + 1, 6, "0", STR_PAD_LEFT);

  if (!checkUserStatus($user->id)) {
    $final = 'main:';
  }
  else {
    $final = '';
  }

  $i = 0;

  foreach ($for as $item => $fee) {
    $final .= $item . '-' . $fee . ':';
  }

  $query = 'insert into mindkraft18_receipt_details values (?, ?, ?)';

  $result = DB::insert($query, [$receipt, $user->id, $final]);

  if ($result) {
    $reply = '{ "success": true, "receipt": "'.$receipt.'", for: '.json_encode($for).', "user": "'.$user->id.'" }';
  }
  else {
    $reply = '{ "success": false };
  }

  return $reply;

}

$prefix = env('DB_VIEW_PREFIX', '');
$id = 'MosNBjiWTQbC0nPO';

$user = DB::select('select * from '.$prefix.'enduser where id=\''.$id.'\'')[0];


$for = ['main' => '300'];
$workshop_array = explode(':', '3fP67neJyyZ5p725:hYkBR3vLxRagWzgf');

function isInternal($user)
{
  if ($user->college == 'Karunya Institute of Technology and Sciences, Coimbatore') {
    return true;
  }
  return false;
}

foreach ($workshop_array as $workshop) {
  if (strlen($workshop) > 1) {
    if (isInternal($user)) {
      $fee = DB::select('select * from mindkraft18_workshop_details where id=\''.$workshop.'\'')[0]->fee_internal;
    }
    else {
      $fee = DB::select('select * from mindkraft18_workshop_details where id=\''.$workshop.'\'')[0]->fee_external;
    }
    $for[$workshop] = $fee;
  }
}

// Add user to approved list and payment list
try {
  if (!checkUserStatus($user->id)) {
    DB::statement('insert into mindkraft18_approved_enduser values(\''.$user->id.'\')');
    DB::statement('insert into mindkraft18_payment_info values(\''.$user->id.'\', \''.'main:'.implode(':', $workshop_array).'\')');
  }
  else {
    $new = DB::select('select * from mindkraft18_payment_info where id=\''.$user->id.'\'')[0]->payed_for . implode(':', $workshop_array);
    DB::statement('update mindkraft18_payment_info set payed_for=\''.$new.'\') where id=\''.$user->id.'\'');
  }
} catch (\Exception $e) {
  echo '{ "success": false, "reason": "SQL Error!" }';
}

 echo generatereceipt($user, $for);
?>
