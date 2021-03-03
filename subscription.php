<?php
require_once 'razorpay-php/Razorpay.php';

use Razorpay\Api\Api;

$keyid = 'rzp_test_CS0vIhEmCMQJ1s';
$secretkey = 'WfSibnFlHJI4ZQjmzXkvPNQD';
$api = new Api($keyid, $secretkey);

$plan = $api->plan->create(array (
  'period' => 'monthly',
  'interval' => 2,
  'item' => 
  array (
    'name' => 'Test plan - Weekly',
    'amount' => 69900,
    'currency' => 'INR',
    'description' => 'Description for the test plan',
  ),
  'notes' => 
  array (
    'notes_key_1' => 'Tea, Earl Grey, Hot',
    'notes_key_2' => 'Tea, Earl Grey… decaf.',
  ),
)
);

$subscription = $api->subscription->create(array (
    'plan_id' => $plan->id,
    'total_count' => 6,
    'quantity' => 1,
    'customer_notify' => 1,
    'addons' => 
    array (
      0 => 
      array (
        'item' => 
        array (
          'name' => 'Delivery charges',
          'amount' => 100000,
          'currency' => 'INR',
        ),
      ),
    ),
    'notes' => 
    array (
      'notes_key_1' => 'Tea, Earl Grey, Hot',
      'notes_key_2' => 'Tea, Earl Grey… decaf.',
    ),
  )
);
?>

<button id = "rzp-button1">Subscribe Now</button>
<script src = "https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var options = {
    "key": "rzp_live_MTd8rSsLszztwK",
    "subscription_id": "<?php echo $subscription->id; ?>",
    "subscription_id": "sub_FYUb6WoRGdKI6f",
    "name": "Acme Corp.",
    "description": "Monthly Test Plan",
    "image": "/your_logo.png",
    "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",
    "prefill": {
      "name": "Gaurav Kumar",
      "email": "gaurav.kumar@example.com",
      "contact": "+919876543210"
    },
    "notes": {
      "note_key_1": "Tea. Earl Grey. Hot",
      "note_key_2": "Make it so."
    },
    "theme": {
      "color": "#F37254"
    }
  };
var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e) {
  rzp1.open();
  e.preventDefault();
}
</script>


