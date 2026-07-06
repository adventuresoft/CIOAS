<?php
$hr = file_get_contents('c:\xampp\htdocs\office\CIOAS\app\Models\HotelRestaurant\HotelRestaurant.php');
$startStr = 'public function Division()';
$endStr = 'public function category()';
$startPos = strpos($hr, $startStr);
$endPos = strpos($hr, $endStr);
$methods = substr($hr, $startPos, $endPos - $startPos);

$licensePath = 'c:\xampp\htdocs\office\CIOAS\app\Models\License\License.php';
$license = file_get_contents($licensePath);
$license = str_replace('public function ownerships()', $methods . "\n    public function ownerships()", $license);

// Also need to add imports to License.php
$imports = "use App\Models\Division;\nuse App\Models\District;\nuse App\Models\Thana;\nuse App\Models\Union;\nuse App\Models\PostOffice;\nuse App\Models\CityCorporation;\nuse App\Models\Pourashava;\nuse App\Models\Ward;\nuse App\Models\BasicSettings\Village;\n";

$license = str_replace('use Illuminate\Database\Eloquent\Factories\HasFactory;', $imports . "use Illuminate\Database\Eloquent\Factories\HasFactory;", $license);

file_put_contents($licensePath, $license);
