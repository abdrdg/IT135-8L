<?php
class User 
{
    public $name;
    private $contact_number;
    public $shipping_address;
    public $disc_priv;
    public $payment_method;
    private $order;
    
    function __construct($name, $contact_number, $shipping_address, $disc_priv, $payment_method, $order) 
    {
        $this->name = $name;
        $this->contact_number = $contact_number;
        $this->shipping_address = $shipping_address;
        $this->disc_priv = $disc_priv;
        $this->payment_method = $payment_method;
        $this->order = $order;
    }

    function get_username()
    {
        return $this->name;
    }

    function get_contact_number()
    {
        return $this->contact_number;
    }

    function get_user_order()
    {
        return $this->order;
    }

    function ComputeSubtotal()
    {
        $subtotal = 0;
        foreach($this->order as $product)
        {
            $subtotal += ($product->product_price * $product->quantity);
        }

        return $subtotal;
    }

    
    function ComputeDiscount()
    {
        $discount = 0;
        switch ($this->disc_priv) 
        {
            case 'PWD':
                $discount = 0.20;
                break;
                
            case 'Senior':
                $discount = 0.20;
                break;
                
            case 'Student':
                $discount = 0.10;
                break;
                
            default:
                $discount = 0;
                break;
        }
        return ($this->ComputeSubtotal() * $discount);
    }
                
    function ComputeVAT()
    {
        return (($this->ComputeSubtotal() - $this->ComputeDiscount()) * 0.12);
    }

    function GetTotalAmountDue()
    {
        return ($this->ComputeVAT() + 45 + $this->ComputeSubtotal() - $this->ComputeDiscount());    
    }
}
            
class Product
{
    public $product_id;
    public $product_name;
    public $product_price;
    public $quantity;
    
    function __construct($product_id, $product_name, $product_price, $quantity)
    {
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->product_price = $product_price;
        $this->quantity = $quantity;
    }
}

function GetOrder()
{
    $product_prices = array(170, 170, 170, 170, 170, 170, 170, 190, 160, 160);
    $product_names = array("Ground Coffee Butterscotch Flavor (150g)", "Ground Coffee Bailey's Irish Cream Flavor (150g)", 
    "Ground Coffee Cookies and Cream Flavor (150g)", "Ground Coffee Double Chocolate Flavor (150g)", "Ground Coffee Hazelnut Flavor (150g)",
    "Ground Coffee Mocha Flavor (150g)", "Ground Coffee Vanilla Flavor (150g)", "Ground Coffee Premium Barako (200g)",
    "Ground Coffee Kalinga Robusta (150g)", "Blended Ground Coffee Benguet Blend (150g)");
    $order = array();
    
    for ($i=0; $i < 10; $i++) 
    { 
        $order[$i] = new Product($i, $product_names[$i], $product_prices[$i], $_POST['quantity'.$i]);    
    }
    
    return $order;
}

function CheckEmptyQuantity($user)
{
    $isEmpty = true;
    foreach($user->get_user_order() as $product)
    {
        if($product->quantity > 0)
        {
            $isEmpty = false;
        }
    }
    return $isEmpty;
}

function DisplayOrder($user)
{
    foreach($user->get_user_order() as $product)
    {
        if($product->quantity > 0)
        {
            echo '<tr>
                    <th style="text-align:left">'.$product->product_name.'</th>
                    <th>'.$product->product_price.'</th>
                    <th>'.$product->quantity.'</th>
                    <th>Php '.$product->product_price * $product->quantity.'</th>
                  </tr>';
        }
    }
}

$user = new User($_POST['name'], $_POST['contact_number'], $_POST['shipping_address'], $_POST['disc_priv'], $_POST['payment_method'], GetOrder());
if(CheckEmptyQuantity($user))
{
    echo "<script>alert('Your order is empty. Please add atleast 1 item.'); location.href='checkout.html';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>Order Details</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css" integrity="sha256-ogmFxjqiTMnZhxCqVmcqTvjfe1Y/ec4WaRj/aQPvn+I=" crossorigin="anonymous">
</head>
<body>
    <div class="grid-container">
        <div class="grid-y order grid-margin-x">
            <h4 class="cell medium-2" style="text-decoration:underline">Customer name: <?php echo $user->name; ?></h2>
            <h4 class="cell medium-2" style="text-decoration:underline">Shipping address: <?php echo $user->shipping_address; ?></h3>
            <table id="table-receipt">
            <tr>
                <th>ITEM</th>
                <th>PRICE</th>
                <th>QUANTITY</th>
                <th>TOTAL</th>
            </tr>
            <?php DisplayOrder($user); ?>
            <tr>
                <th></th>
                <th></th>
                <th style="text-align:right">Subtotal:</th>
                <th style="text-align:left">Php <?php echo $user->ComputeSubtotal();?></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th style="text-align:right">Discount:</th>
                <th style="text-align:left">- Php <?php echo $user->ComputeDiscount();?></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th style="text-align:right">VAT (12%):</th>
                <th style="text-align:left">+ Php <?php echo $user->ComputeVAT();?></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th style="text-align:right">Shipping fee:</th>
                <th style="text-align:left">+ Php 45</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th style="text-align:right">TOTAL DUE:</th>
                <th style="text-align:left; text-decoration:underline;">Php <?php echo $user->GetTotalAmountDue();?></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th style="text-align:right">Paid Through:</th>
                <th style="text-align:left"><?php echo $user->payment_method;?></th>
            </tr>
        </table>
        </div>
    </div>
</body>
</html>