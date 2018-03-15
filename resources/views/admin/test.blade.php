<?php
$prefix = env('DB_TABLE_PREFIX', '');
$query = 'SELECT * from '.$prefix.'payment_info';
$list = DB::select($query);

$main = 0;
$workshop = 0;

function getWorkshopFee($id)
{
  return DB::select('select * from mindkraft18_workshop_details where id=\''.$id.'\'')[0]->fee_external;
}

foreach ($list as $item) {
  $user = DB::select('select * from mindkraft18_enduser where id=\''.$item->id.'\'')[0];
  if ($user->college != 'Karunya Institute of Technology and Sciences, Coimbatore') {
    if (in_array('main', explode(':', $item->payed_for))) {
      $main += 300;
    }
    foreach (array_unique(explode(':', $user->payed_for)) as $item) {
      if ($item != 'main') {
        $workshop += getWorkshopFee($item);
      }
    }
  }
}

echo 'Main - '.$main;
echo "Workshop - ".$workshop;

?>
